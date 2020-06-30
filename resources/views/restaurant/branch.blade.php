@extends('layouts.restaurant');

@section('styling')

    <link href="/css/branches.css" rel="stylesheet" type="text/css">

@endsection

@section('sideNavContent')

    <div id="mySidenav" class="sidenav">
        <div class="logo-container">
            <center>
                <span><img src="/images/logo3-white.png" class="brand-logo"></span>
                <span><img src="/icons/Multiply-50.png" class="close-btn"></span>
            </center>
        </div>
        <a href="/restaurant">Home</a>
        <a href="/fooditems">Food Items</a>
        <a href="/categories">Categories</a>
        <a href="#">Deals</a>
        <a class="active" href="/branches">Branches</a>
    </div>

@endsection

@section('content')

    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="main-heading-container">
                    <h3 class="main-heading">BRANCHES</h3>
                    <hr class="seperator-green">
                </div>


                <div class="container-fluid branch-list-container">
                    <h3 class="container-heading"><i class="fa fa-list-ul"></i> Branches list</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive table-hover">
                                <tr>
                                    <th class="table-heading">
                                        Branch id
                                    </th>
                                    <th class="table-heading">
                                        Area
                                    </th>
                                    <th class="table-heading">
                                        City
                                    </th>
                                </tr>


                                @foreach($branches as $b)

                                <tr>
                                    <td>
                                        {{ $b->id }}
                                    </td>
                                    <td>
                                        {{ $b->branchArea }}
                                    </td>
                                    <td>
                                        {{ $b->city }}
                                    </td>
                                </tr>

                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')



@endsection