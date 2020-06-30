@extends('layouts.restaurant');

@section('styling')

    <link href="css/filestyleBootstrap.css" rel="stylesheet">
    <script src="js/filestyleBootstrap.js" type="text/javascript"></script>
    <link href="/css/deals.css" rel="stylesheet" type="text/css">

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
        <a class="active" href="/deals">Deals</a>
        <a href="#">Branches</a>
    </div>

@endsection

@section('content')

    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="main-heading-container">
                    <h3 class="main-heading">DEALS</h3>
                    <hr class="seperator-blue">
                </div>

                <div id="dealPanelTrigger" class="make-a-deal">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="panel-heading col-md-10 col-sm-10 col-xs-10">
                                <p>Make a Deal</p>
                            </div>
                            <div class="panel-indicator col-md-2 col-sm-2 col-xs-2">
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="makeDealPanel" class="make-a-deal-panel">
                    <div class="container-fluid">
                        <form action="addDeal" method="post" enctype="multipart/form-data" >

                            {{csrf_field()}}

                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <p class="label feild-label">Deal Name</p>
                                    <input type="text" name="dealName" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <p class="label feild-label">Description</p>
                                    <textarea type="text" name="description" rows="3" class="form-control" required></textarea>
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
                                            <div class="btn btn-default image-preview-input">
                                                <i class="fa fa-upload" aria-hidden="true" style="height: 20px;padding-top: 1px;"></i>
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="dealImg"/> <!-- rename it -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <p class="label feild-label">Deal category</p>
                                    <select style="width: 100%" name="category" class="form-control">
                                        @foreach($cat as $c)

                                            <option value="{{ $c->subCatedgoryId }}" >{{ $c->subCategoryName }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <p class="label feild-label">Price</p>
                                    <input type="number" name="price" class="form-control" placeholder="Rs.">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-offset-8 col-md-3">
                                    <button type="submit" class="btn btn-block btn-make-deal"> <i class="fa fa-plus-square-o"></i> &nbsp;Make Deal
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="container-fluid deal-items" id="reload">

                    <h3>All deals</h3>
                    <div class="row">

                        @foreach($deals as $d)

                            <div class="col-md-3">
                            <div class="deal-container">
                                @if($d->imageSource != null || $d->imageSource != '')
                                    <img src="{{ $d->imageSource }}" class="item-image">
                                @else
                                    <img src="/images/noImage.png" class="item-image">
                                @endif
                                <p class="item-name">
                                    {{ $d->itemName }}
                                </p>
                                <p class="item-id">
                                    Deal ID : {{ $d->itemId }}
                                </p>
                                <p class="category">Category : {{ $d->subCategoryName }}</p>
                                <p class="deal-description">{{ $d->description}}</p>
                                <p class="price">Rs. <span class="new-price">{{ $d->price }}</span></p>
                                <div class="button-container">
                                    <button title="View Details" class="btn btn-item-details viewDetails" data-toggle="modal"
                                            data-itemID="{{ $d->itemId }}" data-itemName="{{ $d->itemName }}"
                                            data-subCategory="{{ $d->subCategoryName }}" data-price="{{ $d->price }}" data-img="{{ $d->imageSource }}"
                                            data-description="{{ $d->description }}" data-target="#dealDetails">
                                        <i class="fa fa-eye fa-2x fa-fw"></i>
                                    </button>
                                    <button title="Delete item" class="btn btn-delete-deal" data-toggle="modal" data-itemId="{{ $d->itemId }}" data-target="#deleteDeal">
                                        <i class="fa fa-trash-o fa-2x fa-fw"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="dealDetails" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content view-edit-details">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="modal-heading">
                                    <i class="fa fa-eye"></i> View Deal
                                </h4>
                            </div>
                        </div>
                        <hr class="seperator-full">
                        <div class="row">
                            <div class="col-md-4">
                                <img id="dealImg" src="images/102.jpg" class="img-responsive">
                            </div>
                            <div class="col-md-8">
                                <table class="table table-responsive table-stripped">
                                    <tr>
                                        <td class="first-td">ID :</td>
                                        <td class="first-td"><span id="dealID"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Name :</td>
                                        <td><p id="dealName"></p></td>
                                    </tr>
                                    <tr>
                                        <td>Category:</td>
                                        <td><span id="subCategory"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Description:</td>
                                        <td><span id="description"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Price:</td>
                                        <td><span id="price"></span> Rs.</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="deleteDeal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content delete-deal">
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
                                <p class="modal-data">Are you sure you want to delete deal having Id : <span id="itemId"></span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-5 col-md-4">
                                <button class="btn btn-block btn-danger" id="deleteDeal">
                                    <i class="fa fa-check"></i> Yes
                                </button>
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

    <script src="js/deals.js"></script>

@endsection