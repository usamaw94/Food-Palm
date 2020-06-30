@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Branch Dashboard</div>

                <div class="panel-body">
                    You are logged in as BRANCH

                    <button class="btn btn-default">
                        <a href="branch/logout">Logout</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
