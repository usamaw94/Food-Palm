@extends('layouts.branch');

@section('styling')

    <link href="/css/tableOrders.css" rel="stylesheet" type="text/css">

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
        <a href="/branchOrder">Orders</a>
        <a class="active" href="/tableOrder">Table Orders</a>
    </div>

@endsection

@section('content')

    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="main-heading-container">
                    <h3 class="main-heading">TABLE ORDERS</h3>
                    <hr class="seperator-purple">
                </div>


                <div class="container-fluid order-list-container">
                    <h3 class="container-heading"><i class="fa fa-list-ul"></i> Order list</h3>
                    <div class="row">
                        <div class="col-md-12">

                            @foreach($tableOrders as $to)

                            <div class="row order">
                                <div class="col-md-6 col-sm-6">
                                    <h3 class="order-id">Table Id: {{ $to->tableId }}</h3>
                                    <h4 class="name">{{ $to->cname }}</h4>
                                    <h4 class="order-type">Persons : {{ $to->numOfPersons }}</h4>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <h4 class="order-type">Date : {{ $to->reservationDate }}</h4>
                                    <h4 class="order-type">Time : {{ $to->reservationTime }}</h4>
                                    <div class="btn btn-default btn-process" onclick="window.location.href='/reserveTable/{{ $to->tableId }}'">
                                        &nbsp;<i class="fa fa-check"></i> Reserve&nbsp;
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