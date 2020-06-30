@extends('layouts.restaurant');

@section('styling')

    <link href="/css/categories.css" rel="stylesheet" type="text/css">

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
        <a class="active" href="/categories">Categories</a>
        <a href="#">Deals</a>
        <a href="#">Branches</a>
    </div>

@endsection

@section('content')

    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="main-heading-container">
                    <h3 class="main-heading">FOOD CATEGORIES</h3>
                    <hr class="seperator-purpel">
                </div>

                <div id="categoryPanelTrigger" class="add-new-category">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="panel-heading col-md-10 col-sm-10 col-xs-10">
                                <p>Add new Category</p>
                            </div>
                            <div class="panel-indicator col-md-2 col-sm-2 col-xs-2">
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="addCategoryPanel" class="add-new-category-panel">
                    <div class="container-fluid">
                        <form action="addCategory" method="post">

                            {{ csrf_field() }}

                            <input type="hidden" name="resId" value="{{ Auth::user()->id }}" readonly required>

                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <p class="label feild-label">Category Name</p>
                                    <input type="text" name="name" class="form-control" autofocus required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <p class="label feild-label">Select main category</p>
                                    <select style="width: 100%" name="mainCat" class="form-control">

                                        @foreach($mainCat as $mCat)

                                            <option value="{{ $mCat->categoryId }}" >{{ $mCat->categoryName }}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-offset-8 col-md-3">
                                    <button type="submit" class="btn btn-block btn-add-category"> <i class="fa fa-plus-square-o"></i> &nbsp;Add Category
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="container-fluid category-list-container">
                    <h3 class="container-heading"><i class="fa fa-list-ul"></i> Category list</h3>
                    <div class="row">
                        <div class="col-md-12" id="reload">
                            <table class="table table-responsive table-hover">
                                <tr>
                                    <th class="table-heading">
                                        Category Name
                                    </th>
                                    <th class="table-heading">
                                        Main category
                                    </th>
                                    <th class="table-heading">
                                        Actions
                                    </th>
                                </tr>

                                @foreach($cat as $c)

                                <tr>
                                    <td>
                                        {{ $c->subCategoryName }}
                                    </td>
                                    <td>
                                        {{ $c->categoryName }}
                                    </td>
                                    <td>
                                        <i title="Edit" class="actions fa fa-edit fa-fw editCat" data-toggle="modal" data-catID="{{ $c->subCatedgoryId }}" data-catName="{{ $c->subCategoryName }}" data-mainCat="{{ $c->categoryId }}" data-target="#editCategory"></i>
                                        <i title="Delete" class="actions fa fa-trash-o fa-fw delCat" data-toggle="modal" data-catID="{{ $c->subCatedgoryId }}" data-catName="{{ $c->subCategoryName }}" data-target="#deleteCategory"></i>
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

    <div class="modal fade" id="editCategory" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content edit-category">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="modal-heading"><i class="fa fa-edit"></i> Edit category</h4>
                            </div>
                        </div>
                        <hr class="seperator-full">
                        <form id="editCategoryForm">
                            {{csrf_field()}}
                            <input id="categoryID" type="hidden" name="catID">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="form-label">Category name</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="categoryName" name="catName" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="form-label">Main Category</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select id="mainCategory" name="mainCat" class="form-control">

                                        @foreach($mainCat as $mCat)

                                            <option value="{{ $mCat->categoryId }}" >{{ $mCat->categoryName }}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <hr class="seperator-full2">
                            <div class="row">
                                <div class="col-md-offset-5 col-md-4">
                                    <div class="btn btn-block btn-save-changes" id="updateCat">
                                        <i class="fa fa-save fa-fw"></i> Save
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-block btn-default" data-dismiss="modal">
                                        <i class="fa fa-times"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="deleteCategory" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content delete-category">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="modal-heading"><i class="fa fa-trash-o"></i> Delete category</h4>
                            </div>
                        </div>
                        <hr class="seperator-full">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="modal-data">Are you sure you want to delete this category : '<span id="catName"></span>'</p>
                            </div>
                        </div>
                        <form id="deleteCategoryForm">
                            <input id="catID" name="catId" type="hidden">
                            <div class="row">
                                <div class="col-md-offset-5 col-md-4">
                                    <div class="btn btn-block btn-danger" id="deleteCat">
                                        <i class="fa fa-check"></i> Yes
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-block btn-default" data-dismiss="modal">
                                        <i class="fa fa-times"></i> No
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')

    <script src="js/categories.js"></script>

@endsection