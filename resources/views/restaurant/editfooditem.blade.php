@extends('layouts.restaurant');

@section('styling')

    <link href="css/filestyleBootstrap.css" rel="stylesheet">
    <script src="js/filestyleBootstrap.js" type="text/javascript"></script>
    <link href="css/editFoodItem.css" rel="stylesheet" type="text/css">

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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="edit-form">
                    <h3 class="title"><i class="fa fa-pencil-square-o"></i> Edit item</h3>
                    @foreach($foodItem as $f)
                        <form action="editFoodItem" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="container-fluid edit-form-container">
                            <div class="row">
                                <div class="col-md-5 img-container">
                                    @if( $f->imageSource != null || $f->imageSource != '')
                                        <img id="itemImg" src="{{ $f->imageSource }}" class="img-responsive item-img">
                                    @else
                                        <img id="itemImg" src="/images/noImage.png" class="img-responsive item-img">
                                    @endif

                                    <div class="btn-group">
                                        <div title="change/upload image" class="fileUpload btn btn-change btn-default">
                                            <span><i class="fa fa-upload fa-fw fa-2x"></i></span>
                                            <input name="changedImage" type="file" class="upload" id="changeImage"/>
                                        </div>
                                        <input id="delStatus" type="hidden" value="no" name="delStatus">
                                        <div id="removeImg" title="remove image" class="btn btn-remove btn-default">
                                            <i class="fa fa-trash fa-fw fa-2x"></i>
                                        </div>
                                        <div id="resetImg" title="reset changes" class="btn btn-reset btn-default">
                                            <i class="fa fa-refresh fa-fw fa-2x"></i>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-7">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="label feild-label">Item ID</p>
                                                <input type="hidden" name="imageName" value="{{ $f->imageName }}">
                                                <input type="hidden" name="oldImg" value="{{ $f->imageSource }}">
                                                <input type="text" name="itemId" class="form-control" value="{{ $f->itemId }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="label feild-label">Item Name</p>
                                                <input type="text" name="itemName" class="form-control" value="{{ $f->itemName }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="label feild-label">Description</p>
                                                <textarea type="text" name="description" rows="3" class="form-control" value="{{ $f->description }}"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="label feild-label">Category</p>
                                                <select style="width: 100%" name="subCategory" class="form-control">
                                                    <option value="{{ $f->subCategoryId }}" selected>{{ $f->subCategoryName }}</option>
                                                    @foreach($cat as $c)

                                                        <option value="{{ $c->subCatedgoryId }}" >{{ $c->subCategoryName }}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="label feild-label">Price</p>
                                                <input type="number" name="price" class="form-control" placeholder="Rs." value="{{ $f->price }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="label feild-label">Discount %</p>
                                                <input type="number" name="discount" class="form-control" min="0" max="100" value="0" value="{{ $f->discount }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-block btn-save">
                                                    <i class="fa fa-save"></i> Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="js/editFoodItem.js"></script>

@endsection