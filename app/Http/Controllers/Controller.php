<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function rbsignup(){

        $restaurants = DB::select('SELECT * FROM restaurants');

        return view('rbsignup',compact('restaurants'));
    }

    public function rblogin(){

        $restaurants = DB::select('SELECT * FROM restaurants');

        return view('auth.rblogin',compact('restaurants'));
    }
}
