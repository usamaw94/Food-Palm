<?php

namespace App\Http\Controllers\Auth;

use App\Branch;
use App\Http\Requests\SignupBranch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BranchLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:branch', ['except' => 'logout']);
    }

    public function showLoginForm(){
        $restaurants = DB::select('SELECT * FROM restaurants');

        return view('auth.branch-login',compact('restaurants'));
    }

    public function login(Request $request){
        // Validate the form data

        $this->validate($request, [
            'id' => 'required',
            'rid' => 'required',
            'password' => 'required'
        ]);

        // Attempt to log in

        if (Auth::guard('branch')->attempt(['id' => $request->id , 'restaurantId' => $request->rid , 'password' => $request->password],  $request->remember)) {
            //if successful then redirect to thier intended location

            return redirect()->intended('/branch');
        }

        // if unsuccessful, then redirect back to login with form data

        return redirect()->back()->withInput($request->only('id','rid','remember'))->with("error","Incorrect credentials");
    }

    public function signup(SignupBranch $request){

        $resImg = DB::select('SELECT res_img FROM restaurants WHERE id = ?',[$request->brestaurant]);

        $image = $resImg[0]->res_img;

        $b =new Branch;

        $b->branchArea =$request->area;
        $b->city =$request->city;
        $b->restaurantId =$request->brestaurant;
        $b->resImage =$image;
        $b->latitude =$request->latitude;
        $b->longitude =$request->longitude;
        $b->homeDeliveryStatus =$request->homeDelivery;
        $b->password = bcrypt($request->bpassword);
        $b->save();
        return redirect('/');
    }

    public function logout()
    {
        Auth::guard('branch')->logout();
        return redirect('/');
    }
}
