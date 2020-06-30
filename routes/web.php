<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('users/logout','Auth\LoginController@userLogout');

Route::get('/admin/login' , 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login/submit' , 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/admin', 'AdminController@index');
Route::get('/admin/logout','Auth\AdminLoginController@logout');


Route::get('/restaurant/login' , 'Auth\RestaurantLoginController@showLoginForm')->name('restaurant.login');
Route::post('/restaurant/login/submit' , 'Auth\RestaurantLoginController@login')->name('restaurant.login.submit');
Route::get('/restaurant/logout','Auth\RestaurantLoginController@logout');
Route::post('/restaurantSignup', 'Auth\RestaurantLoginController@signup');

Route::get('/restaurant', 'RestaurantController@index');

Route::get('/categories', 'RestaurantController@categoryIndex');
Route::post('/addCategory', 'RestaurantController@addCategory');
Route::any('/editCategory', 'RestaurantController@editCategory');
Route::any('/deleteCategory', 'RestaurantController@deleteCategory');

Route::get('/fooditems', 'RestaurantController@foodItemIndex');
Route::post('/addFoodItem', 'RestaurantController@addFoodItem');
Route::any('/deleteFoodItem/{id}', 'RestaurantController@deleteFoodItem');
Route::post('/getFoodItem', 'RestaurantController@getFoodItem');
Route::post('/editFoodItem', 'RestaurantController@editFoodItem');
Route::get('/allFoodItems', 'RestaurantController@allFoodItems');
Route::any('/foodCategory', 'RestaurantController@foodCategory');
Route::any('/deals', 'RestaurantController@deals');
Route::post('/addDeal', 'RestaurantController@addDeal');
Route::any('/deleteDeal/{id}', 'RestaurantController@deleteDeal');
Route::any('/branches', 'RestaurantController@branches');


Route::post('/branch/signup', 'Auth\BranchLoginController@signup')->name('branch.signup');
Route::get('/branch/login' , 'Auth\BranchLoginController@showLoginForm')->name('branch.login');
Route::post('/branch/login/submit' , 'Auth\BranchLoginController@login')->name('branch.login.submit');
Route::get('/branch/logout','Auth\BranchLoginController@logout');

Route::get('/branch', 'BranchController@index');
Route::get('/branchOrder', 'BranchController@branchOrder');
Route::get('/orderDetails/{id}/{amount}' , 'BranchController@orderDetails');
Route::get('/processOrder/{id}' , 'BranchController@processOrder');
Route::get('/tableOrder', 'BranchController@tableOrder');
Route::get('/reserveTable/{id}', 'BranchController@reserveTable');


Route::get('/restaurantBranchSignup','Controller@rbsignup');

//Route::get('/restaurantBranchLogin','Controller@rblogin');