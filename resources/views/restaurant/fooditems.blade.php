@extends('layouts.restaurant');

@section('styling')

    <link href="css/filestyleBootstrap.css" rel="stylesheet">
    <script src="js/filestyleBootstrap.js" type="text/javascript"></script>
    <link href="/css/foodItems.css" rel="stylesheet" type="text/css">

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

                <div id="productPanelTrigger" class="add-new-product">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="panel-heading col-md-10 col-sm-10 col-xs-10">
                                <p>Add new Product</p>
                            </div>
                            <div class="panel-indicator col-md-2 col-sm-2 col-xs-2">
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="addProductPanel" class="add-new-product-panel">
                    <div class="container-fluid">
                        <form action="/addFoodItem" method="post" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <p class="label feild-label">Item Name</p>
                                    <input type="text" name="itemName" class="form-control" required autofocus>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <p class="label feild-label">Description</p>
                                    <textarea type="text" name="description" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <p class="label feild-label">Image</p>
                                    <div class="input-group image-preview">
                                        <input name="logo" type="text" placeholder="Upload resturant logo image" class="form-control image-preview-filename" readonly> <!-- don't give a name === doesn't send on POST/GET -->
                                        <div class="input-group-btn">
                                            <!-- image-preview-clear button -->
                                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                <span class="glyphicon glyphicon-remove"></span> Clear
                                            </button>
                                            <!-- image-preview-input -->
                                            <div class="btn btn-default image-preview-input" style="height: 34px;padding-top: 8px;">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="itemImg"/> <!-- rename it -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <p class="label feild-label">Category</p>
                                    <select style="width: 100%" name="subCategory" class="form-control">
                                        @foreach($cat as $c)

                                            <option value="{{ $c->subCatedgoryId }}" >{{ $c->subCategoryName }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <p class="label feild-label">Price</p>
                                    <input type="number" name="price" class="form-control" placeholder="Rs." required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <p class="label feild-label">Discount %</p>
                                    <input type="number" name="discount" class="form-control" min="0" max="100" value="0" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-offset-8 col-md-3">
                                    <button type="submit" class="btn btn-block btn-add-product"> <i class="fa fa-plus-square-o"></i> &nbsp;Add Product
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="container-fluid food-items-container">
                    <div class="row">
                        <div class="view-all-product" onclick="window.location.href='/allFoodItems'">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="title col-md-8">
                                        <p>View all items</p>
                                    </div>
                                    <div class="quantity col-md-4">
                                        <p>{{ $foodCount }} items</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="food-by-category" id="foodCategoryTrigger">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="title col-md-8">
                                        <p>Food items by category</p>
                                    </div>
                                    <div class="indicator col-md-4">
                                        <p><i class="fa fa-plus-circle"></i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="food-by-category-panel" id="foodByCategoryPanel">
                            <div class="container-fluid">
                                <div class="row">
                                    @foreach($foodCategories as $fc)
                                        <div class="col-md-12 foods-category ">
                                            <form action="/foodCategory" method="post">

                                                {{ csrf_field() }}

                                                <input type="hidden" name="id" value="{{$fc->categoryId}}">
                                                <input type="hidden" name="name" value="{{ $fc->categoryName }}">
                                                <button type="submit">
                                                    <p>
                                                        {{ $fc->categoryName }}
                                                    </p>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid food-items" id="reload">

                    <h3>New items</h3>
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
                                <form action="getFoodItem" method="post">
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

    <script src="/js/foodItems.js"></script>

@endsection