@extends('layouts.restaurant');

@section('styling')

    <link href="/css/filestyleBootstrap.css" rel="stylesheet">
    <script src="/js/filestyleBootstrap.js" type="text/javascript"></script>
    <link href="/css/foodcategory.css" rel="stylesheet" type="text/css">


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
        <a class="active" href="/fooditems">Food Items</a>
        <a href="/categories">Categories</a>
        <a href="#">Deals</a>
        <a href="#">Branches</a>
    </div>

@endsection

@section('content')

    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="main-heading-container">
                    <h3 class="main-heading">FOOD ITEMS</h3>
                    <hr class="seperator-red">
                </div>

                <div class="container-fluid food-items">
                    <h2>{{ $title }}</h2>
                    <div id="reload">
                        <div class="row">

                        @foreach($foodItems as $f)

                            <div class="col-md-3">
                                <div class="food-item-container">
                                    @if($f->imageSource != null || $f->imageSource != '')
                                        <img src="{{ $f->imageSource }}" class="item-image">
                                    @else
                                        <img src="/images/noImage.png" class="item-image">
                                    @endif

                                    <p class="item-discount">
                                        -{{ $f->discount }}%
                                    </p>
                                    <p class="item-name">
                                        {{ $f->itemName }}
                                    </p>
                                    <p class="item-id">
                                        Item ID : {{ $f->itemId }}
                                    </p>
                                    <p class="item-category">{{ $f->subCategoryName }} / {{ $f->categoryName }}</p>
                                    <p class="price">Rs. <span class="new-price">{{ $f->price }}</span></p>
                                    <div class="button-container">
                                        <button title="View Details" class="btn btn-item-details viewDetails" data-toggle="modal"
                                                data-itemID="{{ $f->itemId }}" data-itemName="{{ $f->itemName }}" data-category="{{ $f->categoryName }}"
                                                data-subCategory="{{ $f->subCategoryName }}" data-price="{{ $f->price }}" data-img="{{ $f->imageSource }}"
                                                data-discount="{{ $f->discount }}" data-target="#itemDetails">
                                            <i class="fa fa-eye fa-2x fa-fw"></i>
                                        </button>
                                        <div title="Delete item" class="btn btn-delete-item" data-toggle="modal" data-itemId="{{ $f->itemId }}" data-target="#deleteItem">
                                            <i class="fa fa-trash-o fa-2x fa-fw"></i>
                                        </div>
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

    <div class="modal fade" id="itemDetails" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content view-edit-details">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="modal-heading">
                                    <i class="fa fa-eye"></i> View Item
                                </h4>
                            </div>
                        </div>
                        <hr class="seperator-full">
                        <div class="row">
                            <div class="col-md-4">
                                <img id="foodItemImg" class="img-responsive">
                                <form action="/getFoodItem" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="itemId" id="foodItemID">
                                    <button class="btn btn-block btn-edit-details" type="submit"><i class="fa fa-edit"></i> Edit</button>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-responsive table-stripped view-table">
                                    <tr>
                                        <td style="border-top: none">ID :</td>
                                        <td style="border-top: none"><span id="itemID">1</span></td>
                                    </tr>
                                    <tr>
                                        <td>Name :</td>
                                        <td><span id="itemName"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Category:</td>
                                        <td><span id="category"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Sub Category:</td>
                                        <td><span id="subCategory"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Price:</td>
                                        <td><span id="price"></span> Rs.</td>
                                    </tr>
                                    <tr>
                                        <td>Discount:</td>
                                        <td><span id="discount"></span>%</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="deleteItem" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content delete-item">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="modal-heading">
                                    <i class="fa fa-trash-o"></i> Delete Item
                                </h4>
                            </div>
                        </div>
                        <hr class="seperator-full">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="modal-data">Are you sure you want to delete item having item Id : <span id="itemId"></span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-5 col-md-4">
                                <div class="btn btn-block btn-danger" id="deleteFoodItem">
                                    <i class="fa fa-check"></i> Yes
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-block btn-default" data-dismiss="modal">
                                    <i class="fa fa-times"></i> No
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')

    <script src="/js/foodcategory.js"></script>

@endsection