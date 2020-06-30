@extends('layouts.branch');

@section('styling')

    <link href="css/branchDashboard.css" rel="stylesheet" type="text/css">

@endsection

@section('sideNavContent')

    <div id="mySidenav" class="sidenav">
        <div class="logo-container">
            <center>
                <span><img src="/images/logo3-white.png" class="brand-logo"></span>
                <span><img src="/icons/Multiply-50.png" class="close-btn"></span>
            </center>
        </div>
        <a class="active" href="/branch">Home</a>
        <a href="/branchOrder">Orders</a>
        <a href="/tableOrder">Table Orders</a>
    </div>

@endsection

@section('content')

    <div class="content container-fluid">
        <div class="options-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <a href="/branchOrder">
                                    <div class="category">
                                        <h2>Orders</h2>
                                        <h4>{{ $orderCount }} order(s)</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <a href="/tableOrder">
                                    <div class="branches">
                                        <h2>Table orders</h2>
                                        <h4>{{ $tableCount }} order(s)</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')



@endsection