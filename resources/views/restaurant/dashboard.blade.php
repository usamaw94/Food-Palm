@extends('layouts.restaurant');

@section('styling')

    <link href="/css/dashboard.css" rel="stylesheet" type="text/css">

@endsection

@section('sideNavContent')

    <div id="mySidenav" class="sidenav">
        <div class="logo-container">
            <center>
                <span><img src="/images/logo3-white.png" class="brand-logo"></span>
                <span><img src="/icons/Multiply-50.png" class="close-btn"></span>
            </center>
        </div>
        <a class="active" href="/restaurant">Home</a>
        <a href="/fooditems">Food Items</a>
        <a href="/categories">Categories</a>
        <a href="#">Deals</a>
        <a href="#">Branches</a>
    </div>

@endsection

@section('content')

    <div class="content container-fluid">
        <div class="options-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <a href="/fooditems">
                                    <div class="product">
                                        <h2>Food Items</h2>
                                        <h4>{{ $foodCount }} item(s)</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="/categories">
                                    <div class="category">
                                        <h2>Categories</h2>
                                        <h4>{{ $catCount }} item(s)</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="/deals">
                                    <div class="deal">
                                        <h2>Deals</h2>
                                        <h4>{{ $dealCount }} item(s)</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="/branches">
                                    <div class="branches">
                                        <h2>Branches</h2>
                                        <h4>{{ $branchCount }} Branch(es)</h4>
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

    <script src="/js/dashboard.js"></script>

@endsection