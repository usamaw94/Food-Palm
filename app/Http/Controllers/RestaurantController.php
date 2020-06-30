<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Category;
use App\CatRest;
use App\FoodItem;
use App\MainCategory;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\File;

class RestaurantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:restaurant');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resID = Auth::user()->id;

        $catCount = DB::select('SELECT count(*) AS "itemCount" FROM categories WHERE restaurantId = ?',[$resID]);

        $catCounts = $catCount[0]->itemCount;


        $foodItemCount = DB::select('SELECT count(*) AS "itemCount" FROM food_items WHERE restaurantId = ? AND categoryId != ?',[$resID,7]);

        $foodCount = $foodItemCount[0]->itemCount;

        $dealItemCount = DB::select('SELECT count(*) AS "itemCount" FROM food_items WHERE restaurantId = ? AND categoryId = ?',[$resID,7]);

        $dealCount = $dealItemCount[0]->itemCount;

        $branchItemCount = DB::select('SELECT count(*) AS "itemCount" FROM branches WHERE restaurantId = ?',[$resID]);

        $branchCount = $branchItemCount[0]->itemCount;

        $counts = array(
            'catCount'  => $catCounts,
            'foodCount' => $foodCount,
            'dealCount' => $dealCount,
            'branchCount' => $branchCount
        );

        return view('restaurant.dashboard')->with($counts);
    }

    public function categoryIndex()
    {
        $resID = Auth::user()->id;

        $mainCat = DB::select('SELECT * FROM main_categories');


        $cat = DB::select('SELECT categories.subCategoryId, categories.subCategoryName , categories.categoryId , categories.restaurantId ,
        main_categories.categoryName
        FROM categories JOIN main_categories ON  categories.categoryId = main_categories.categoryId AND categories.restaurantId = :resID',['resID' => $resID]);

        $results = array(
            'mainCat'  => $mainCat,
            'cat' => $cat,
        );

        return view('restaurant.categories')->with($results);
    }

    public function addCategory(Request $request){

        $cat_rests = DB::select('SELECT count(*) AS "Rows" FROM cat_rests WHERE categoryId = ? AND restaurantId = ?',[$request->mainCat,$request->resId]);

        $count = $cat_rests[0]->Rows;

        if($count == 0){
            $cr =new CatRest();
            $cr->categoryId =$request->mainCat;
            $cr->restaurantId =$request->resId;
            $cr->save();
        }

        $c =new Category();
        $c->subCategoryName =$request->name;
        $c->categoryId =$request->mainCat;
        $c->restaurantId =$request->resId;
        $c->save();
        return redirect('/categories');
    }

    public function editCategory(Request $request){

        $resID = Auth::user()->id;

        $cat_rests = DB::select('SELECT count(*) AS "Rows" FROM cat_rests WHERE categoryId = ? AND restaurantId = ?',[$request->mainCat,$resID]);

        $count = $cat_rests[0]->Rows;

        if($count == 0){
            $cr =new CatRest();
            $cr->categoryId =$request->mainCat;
            $cr->restaurantId =$request->resId;
            $cr->save();
        }

        $update = DB::update("UPDATE categories SET subCategoryName = '".$request->catName."' , categoryId = '".$request->mainCat."'
        where subCategoryId = ?", [$request->catID]);

    }

    public function deleteCategory(Request $request){

        $delete = DB::delete("DELETE FROM categories WHERE subCategoryId=?",[$request->catId]);

    }


    public function foodItemIndex(){

        $resID = Auth::user()->id;

        $cat = DB::select('SELECT categories.subCategoryId, categories.subCategoryName , categories.categoryId , categories.restaurantId ,
        main_categories.categoryName
        FROM categories JOIN main_categories ON  categories.categoryId = main_categories.categoryId AND main_categories.categoryId != ? AND categories.restaurantId = ?',[7,$resID]);

        $foodItems = DB::select('SELECT food_items.itemId, food_items.itemName, food_items.description, food_items.restaurantId, food_items.imageSource,
        food_items.subCategoryId, food_items.categoryId, food_items.price, food_items.discount,
        categories.subCategoryName , categories.categoryId , categories.restaurantId,
        main_categories.categoryName
        FROM food_items INNER JOIN categories ON food_items.subCategoryId = categories.subCategoryId
        INNER JOIN main_categories ON food_items.categoryId = main_categories.categoryId
        AND main_categories.categoryName != ? AND food_items.restaurantId = ?',['Deals',$resID]);

        $foodCategories = DB::select('SELECT main_categories.categoryId , main_categories.categoryName
        FROM main_categories JOIN cat_rests
        ON main_categories.categoryId = cat_rests.categoryId
        AND cat_rests.restaurantId = ?
        AND main_categories.categoryName != ?',[$resID,'Deals']);

        $foodItemCount = DB::select('SELECT count(*) AS "itemCount" FROM food_items WHERE categoryId != ?',[7]);

        $foodCount = $foodItemCount[0]->itemCount;

        $results = array(
            'cat' => $cat,
            'foodItems' => $foodItems,
            'foodCount' => $foodCount,
            'foodCategories' => $foodCategories
        );

        return view('restaurant.fooditems')->with($results);
    }

    public function addFoodItem(Request $request){

        $dbName = 'foodpalm';
        $tableName = 'food_items';

        $info = DB::select('SELECT `AUTO_INCREMENT`FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ? AND   TABLE_NAME   = ?',[$dbName,$tableName]);

        $autoInc = $info[0]->AUTO_INCREMENT;

        $resID = Auth::user()->id;

        $resName = Auth::user()->res_name;

        $imgName = $resName."_menu_".$autoInc;

        $img = $request->itemImg;

        if($img != null || $img != ''){

            $extension = $request->itemImg->extension();

            $storeImg = $request->itemImg->storeAs( '' , $imgName.".".$extension , 'upload');

            $imgPath  = '/uploads/'.$storeImg;
        } else {

            $imgPath = '';
        }

        $mainCat = DB::select('SELECT categoryId FROM categories WHERE 	subCategoryId = :catID',['catID' => $request->subCategory]);



        $mCat = $mainCat[0]->categoryId;

        $f =new FoodItem();
        $f->itemName =  $request->itemName;
        $f->description = $request->description;
        $f->restaurantId = $resID;
        $f->imageSource = $imgPath;
        $f->imageName = $imgName;
        $f->subCategoryId =$request->subCategory;
        $f->categoryId = $mCat;
        $f->price = $request->price;
        $f->discount = $request->discount;
        $f->save();

        return redirect('/fooditems');
    }

    public function deleteFoodItem($id){

        $item = DB::select('SELECT imageSource FROM food_items WHERE itemId = :id',['id' => $id]);

        $imgPath = $item[0]->imageSource;

        if( $imgPath != null || $imgPath != ''){
            $image_path = public_path().$imgPath;
            unlink($image_path);
        }

        $delete = DB::delete("DELETE FROM food_items WHERE itemId=?",[$id]);
    }

    public function getFoodItem(Request $request){

        $resID = Auth::user()->id;

        $cat = DB::select('SELECT * FROM categories WHERE restaurantId = :resID',['resID' => $resID]);

        $foodItem = DB::select('SELECT food_items.itemId, food_items.itemName, food_items.description, food_items.restaurantId,
        food_items.imageSource, food_items.imageName, food_items.subCategoryId, food_items.price, food_items.discount,
        categories.subCategoryName , categories.categoryId , categories.restaurantId
        FROM food_items JOIN categories ON food_items.subCategoryId = categories.subCategoryId
        AND food_items.itemId = :id',['id' => $request->itemId]);


        $subCatId = $foodItem[0]->subCategoryId;

        $cat = DB::select('SELECT * FROM categories WHERE restaurantId = ? AND 	subCategoryId != ?',[$resID,$subCatId]);

//        $item = DB::select('SELECT * FROM food_items WHERE itemId = :id',['id' => $request->itemId]);

        $results = array(
            'cat' => $cat,
            'foodItem' => $foodItem,
        );

        return view('restaurant.editfooditem')->with($results);
    }

    public function editFoodItem(Request $request){
        $del = $request->delStatus;
        $reset = $request->changedImage;
        $imgName = $request->imageName;

        if($del == 'yes'){

            $delPath = $request->oldImg;

            $del_img = public_path().$delPath;
            unlink($del_img);

            $imgPath = "";

        } elseif($reset == '' || $reset == null && $del == 'no') {

            $imgPath = $request->oldImg;

        }elseif($reset != null || $reset != '' && $del == 'no'){

            $extension = $request->changedImage->extension();

            $storeImg = $request->changedImage->storeAs( '' , $imgName.".".$extension , 'upload');

            $imgPath  = '/uploads/'.$storeImg;
        }

        $mainCat = DB::select('SELECT categoryId FROM categories WHERE 	subCategoryId = :catID',['catID' => $request->subCategory]);

        $mCat = $mainCat[0]->categoryId;

        $update = DB::update("UPDATE food_items SET itemName = '".$request->itemName."' , description = '".$request->description."' ,
         imageSource = '".$imgPath."' ,  subCategoryId = '".$request->subCategory."' ,  categoryId = '".$mCat."' ,
          price = '".$request->price."' ,  discount = '".$request->discount."'
           where itemId = ?", [$request->itemId]);

        return redirect('/fooditems');
    }

    public function allFoodItems(){

        $resID = Auth::user()->id;

        $foodItems = DB::select('SELECT food_items.itemId, food_items.itemName, food_items.description, food_items.restaurantId, food_items.imageSource,
        food_items.subCategoryId, food_items.categoryId, food_items.price, food_items.discount,
        categories.subCategoryName , categories.categoryId , categories.restaurantId,
        main_categories.categoryName
        FROM food_items INNER JOIN categories ON food_items.subCategoryId = categories.subCategoryId
        INNER JOIN main_categories ON food_items.categoryId = main_categories.categoryId
        AND main_categories.categoryName != ? AND food_items.restaurantId = ?',['Deals',$resID]);

        $title = "All food items";

        $results = array(
            'title' => $title,
            'foodItems' => $foodItems,
        );

        return view('restaurant.allfooditems')->with($results);
    }

    public function foodCategory(Request $request){

        $id = $request->id;
        $name = $request->name;

        $resID = Auth::user()->id;

        $foodItems = DB::select('SELECT food_items.itemId, food_items.itemName, food_items.description, food_items.restaurantId, food_items.imageSource,
        food_items.subCategoryId, food_items.categoryId, food_items.price, food_items.discount,
        categories.subCategoryName , categories.categoryId , categories.restaurantId,
        main_categories.categoryName
        FROM food_items INNER JOIN categories ON food_items.subCategoryId = categories.subCategoryId
        INNER JOIN main_categories ON food_items.categoryId = main_categories.categoryId
        AND food_items.categoryId = ? AND food_items.restaurantId = ?',[$id,$resID]);

        $results = array(
            'title' => $name,
            'foodItems' => $foodItems,
        );

        return view('restaurant.foodcategory')->with($results);
    }

    public function deals(){

        $resID = Auth::user()->id;

        $deals = DB::select('SELECT food_items.itemId, food_items.itemName, food_items.description, food_items.restaurantId, food_items.imageSource,
        food_items.subCategoryId, food_items.categoryId, food_items.price, food_items.discount,
        categories.subCategoryName , categories.categoryId , categories.restaurantId,
        main_categories.categoryName
        FROM food_items INNER JOIN categories ON food_items.subCategoryId = categories.subCategoryId
        INNER JOIN main_categories ON food_items.categoryId = main_categories.categoryId
        AND main_categories.categoryName = ? AND food_items.restaurantId = ?',['Deals',$resID]);

        $cat = DB::select('SELECT * FROM categories WHERE categoryId = ? AND restaurantId = ?',[7,$resID]);

        $results = array(
            'deals' => $deals,
            'cat' => $cat,
        );

        return view('restaurant.deals')->with($results);
    }

    public function addDeal(Request $request){

        $dbName = 'foodpalm';
        $tableName = 'food_items';

        $info = DB::select('SELECT `AUTO_INCREMENT`FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ? AND   TABLE_NAME   = ?',[$dbName,$tableName]);

        $autoInc = $info[0]->AUTO_INCREMENT;

        $resID = Auth::user()->id;

        $resName = Auth::user()->res_name;

        $imgName = $resName."_deal_".$autoInc;

        $img = $request->dealImg;

        if($img != null || $img != ''){

            $extension = $request->dealImg->extension();

            $storeImg = $request->dealImg->storeAs( '' , $imgName.".".$extension , 'upload');

            $imgPath  = '/uploads/'.$storeImg;
        } else {

            $imgPath = '';
        }

        $mainCat = DB::select('SELECT categoryId FROM categories WHERE 	subCategoryId = :catID',['catID' => $request->category]);


        $mCat = $mainCat[0]->categoryId;

        $f =new FoodItem();
        $f->itemName =  $request->dealName;
        $f->description = $request->description;
        $f->restaurantId = $resID;
        $f->imageSource = $imgPath;
        $f->imageName = $imgName;
        $f->subCategoryId =$request->category;
        $f->categoryId = $mCat;
        $f->price = $request->price;
        $f->discount = 0;
        $f->save();

        return redirect('/deals');

    }

    public function deleteDeal($id){

        $item = DB::select('SELECT imageSource FROM food_items WHERE itemId = :id',['id' => $id]);

        $imgPath = $item[0]->imageSource;

        if( $imgPath != null || $imgPath != ''){
            $image_path = public_path().$imgPath;
            unlink($image_path);
        }

        $delete = DB::delete("DELETE FROM food_items WHERE itemId=?",[$id]);
    }

    public function branches(){

        $resID = Auth::user()->id;

        $branches = DB::select('SELECT * FROM branches WHERE restaurantId = :resID',['resID' => $resID]);

        $results = array(
            'branches' => $branches,
        );

        return view('restaurant.branch')->with($results);
    }

}
