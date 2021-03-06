@extends('layouts.branch');

@section('styling')

    <link href="/css/branchOrders.css" rel="stylesheet" type="text/css">

@endsection

@section('sideNavContent')

    <div id="mySidenav" class="sidenav">
        <div class="logo-container">
            <center>
                <span><img src="/images/logo3-white.png" class="brand-logo"></span>
                <span><img src="/icons/Multiply-50.png" class="close-btn"></span>
            </center>
        </div>
        <a href="/branch">Home</a>
        <a class="active" href="/branchOrder">Orders</a>
        <a href="/tableOrder">Table Orders</a>
    </div>

@endsection

@section('content')

    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="main-heading-container">
                    <h3 class="main-heading">ORDERS</h3>
                    <hr class="seperator-purple">
                </div>


                <div class="container-fluid order-list-container">
                    <h3 class="container-heading"><i class="fa fa-list-ul"></i> Order list</h3>
                    <div class="row">
                        <div class="col-md-12">

                            @foreach($orders as $o)

                            <div class="row order">
                                <div class="col-md-6 col-sm-6">
                                    <h3 class="order-id">Order Id: {{ $o->orderId }}</h3>
                                    <h4 class="name">{{ $o->cname }}</h4>
                                    <h4 class="city">{{ $o->city }}</h4>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <h4 class="price">Rs. {{ $o->amount }}</h4>
                                    <h4 class="order-type">Order type : {{ $o->orderType }}</h4>
                                    <div class="btn btn-default btn-process" onclick="window.location.href='/orderDetails/{{ $o->orderId }}/{{ $o->amount }}'">
                                        &nbsp;<i class="fa fa-check"></i> Process&nbsp;
                                    </div>
                                </div>
                            </div>

                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')



@endsection