@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Restaurant Dashboard</div>

                <div class="panel-body">
                    You are logged in as RESTAURANT

                    <button class="btn btn-default">
                        <a href="restaurant/logout">Logout</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
