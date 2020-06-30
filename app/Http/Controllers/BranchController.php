<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:branch');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branchID = Auth::user()->id;
        $resID = Auth::user()->restaurantId;

        $status = "Placed";

        $tstatus = "Requested";

        $orderCount = DB::select('SELECT count(*) AS "itemCount" FROM orders WHERE orderStatus=? AND restaurantId = ? AND branchCode= ?',[$status,$resID,$branchID]);

        $orderCounts = $orderCount[0]->itemCount;

        $tableCount = DB::select('SELECT count(*) AS "itemCount" FROM tableorders WHERE tableStatus=? AND restaurantId = ? AND branchCode= ?',[$tstatus,$resID,$branchID]);

        $tableCounts = $tableCount[0]->itemCount;

        $counts = array(
            'orderCount'  => $orderCounts,
            'tableCount' => $tableCounts,
        );

        return view('branch.dashboard')->with($counts);
    }

    public function branchOrder(){

        $branchID = Auth::user()->id;
        $resID = Auth::user()->restaurantId;

        $status = "Placed";

        $orders = DB::select('SELECT * FROM orders WHERE orderStatus=? AND restaurantId = ? AND branchCode= ?',[$status,$resID,$branchID]);

        $results = array(
            'orders'  => $orders,
        );

        return view('branch.branchorders')->with($results);
    }

    public function orderDetails($id,$amount){

        $orderDetails = DB::select('SELECT * FROM orderdetails WHERE orderId = ?',[$id]);

        $results = array(
            'id' => $id,
            'amount' => $amount,
            'orderDetails'  => $orderDetails
        );

        return view('branch.orderdetails')->with($results);
    }

    public function processOrder($id){

        $update = DB::update("UPDATE orders SET orderStatus = 'Processed' WHERE orderId = ?", [$id]);

        return redirect('/branchOrder');
    }

    public function tableOrder(){

        $branchID = Auth::user()->id;
        $resID = Auth::user()->restaurantId;

        $status = "Requested";

        $tableOrders = DB::select('SELECT * FROM tableorders WHERE tableStatus=? AND restaurantId = ? AND branchCode= ?',[$status,$resID,$branchID]);

        $results = array(
            'tableOrders'  => $tableOrders
        );

        return view('branch.tableorders')->with($results);
    }

    public function reserveTable($id){

        $update = DB::update("UPDATE tableorders SET tableStatus = 'Reserved' WHERE tableId = ?", [$id]);

        return redirect('/tableOrder');
    }
}
