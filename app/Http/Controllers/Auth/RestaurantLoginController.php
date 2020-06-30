<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\SignupRestaurant;
use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RestaurantLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:restaurant', ['except' => 'logout']);
    }

    public function showLoginForm(){
        return view('auth.restaurant-login');
    }

    public function login(Request $request){
        // Validate the form data

        $this->validate($request, [
            'id' => 'required',
            'password' => 'required'
        ]);

        // Attempt to log in

        if (Auth::guard('restaurant')->attempt(['id' => $request->id , 'password' => $request->password],  $request->remember)) {
            //if successful then redirect to thier intended location

            return redirect()->intended('/restaurant');
        }

        // if unsuccessful, then redirect back to login with form data

        return redirect()->back()->withInput($request->only('id','remember'))->with("error","Incorrect credentials");
    }

    public function signup(SignupRestaurant $request){

        $imgName = $request->restaurant;

        $extension = $request->logoImg->extension();

        $storeImg = $request->logoImg->storeAs( '' , $imgName.".".$extension , 'upload');

        $path  = '/uploads/'.$storeImg;

        $r =new Restaurant;
        $r->res_name = $request->restaurant;
        $r->description =$request->description;
        $r->res_img = $path;
        $r->password = bcrypt($request->password);
        $r->save();

        return redirect('/');
    }

    public function logout()
    {
        Auth::guard('restaurant')->logout();
        return redirect('/');
    }
}
