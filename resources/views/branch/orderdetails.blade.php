@extends('layouts.branch');

@section('styling')

    <link href="/css/orderDetails.css" rel="stylesheet" type="text/css">

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


                <div class="container-fluid order-details-container">
                    <h3 class="container-heading"><i class="fa fa-info"></i> Order details</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="order-id">Order Id : {{ $id }}</h4>
                            <table class="table table-details">
                                <tr>
                                    <th class="table-heading">Item Name</th>
                                    <th class="table-heading">Quantity</th>
                                    <th class="table-heading">Price</th>
                                </tr>

                                @foreach($orderDetails as $od)

                                    <tr>
                                        <td class="table-data">{{ $od->ItemDealName }}</td>
                                        <td class="table-data">{{ $od->quantity }}</td>
                                        <td class="table-data">{{ $od->quantity }} x {{ $od->price }}</td>
                                    </tr>

                                @endforeach

                            </table>
                            <div class="btn btn-accept" onclick="window.location.href='/processOrder/{{ $id }}'">
                                &nbsp;<i class="fa fa-check"></i> Accept&nbsp;
                            </div>
                            <h4 class="order-price">Total Price : {{$amount}} Rs</h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')



@endsection