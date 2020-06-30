<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/js/jquery-3.1.1.js"></script>
    <script src="/js/jquery.backstretch.min.js"></script>
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link href="/css/filestyleBootstrap.css" rel="stylesheet">
    <script src="/js/filestyleBootstrap.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/select2-4.0.3/dist/css/select2.min.css" rel="stylesheet">
    <script src="/select2-4.0.3/dist/js/select2.min.js"></script>

    <link href="/css/login-final.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-sm-6 hidden-xs">
            <div class="logo-img-container">
                <center><img src="/icons/logoWhite.png" class="img-responsive img-logo"></center>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 login-container">
            <div title="Back to home" onclick="window.location.href='/'" class="back">
                <i class="fa fa-home"></i>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="login-heading">LOGIN</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 login-tabs-container">
                        <ul class="nav nav-pills nav-justified">
                            <li class="branch active"><a href="/branch/login">Branch</a></li>
                            <li><a href="/restaurant/login">Restaurant</a></li>
                        </ul>
                        <div class="login-tabs-content tab-content">
                            <div id="branch" class="tab-pane fade in active">
                                <div class="branch-form">

                                    @if(\Illuminate\Support\Facades\Session::has('error'))
                                        <p class="login-error"><i class="fa fa-exclamation-circle"></i> &nbsp;
                                            {{ \Illuminate\Support\Facades\Session::get('error') }}
                                        </p>
                                    @endif



                                    <form action="{{ route('branch.login.submit') }}" method="post">

                                        {{ csrf_field() }}

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-cutlery fa-fw" aria-hidden="true"></i>
                                            </div>
                                            <select style="width: 100%" name="rid" class="signup-select form-control" required autofocus>
                                                <option></option>

                                                @foreach($restaurants as $r)

                                                    <option value="{{ $r->id }}" >{{$r->res_name}}</option>

                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-fw fa-location-arrow"></i>
                                                </span>
                                            <input type="text" name="id" class="form-control" placeholder="Enter branch code" value="{{ old('id') }}" required>
                                        </div>
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-fw fa-lock"></i>
                                                </span>
                                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                        </div>
                                        <center>
                                            <input type="submit" class="btn btn-default btn-login-submit" value="Login">
                                        </center>
                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row seperator-row">
                    <div class="sep1 col-md-4 col-xs-4">
                        <hr>
                    </div>
                    <div class="or col-md-4 col-xs-4">
                        OR
                    </div>
                    <div class="sep2 col-md-4 col-xs-4">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <button onclick="window.location.href='/restaurantBranchSignup'" class="btn btn-default btn-signup">
                                Signup
                            </button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".signup-select").select2({
            placeholder: "Select Resturant"
        });
    });
</script>
</body>
</html>