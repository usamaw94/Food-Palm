<!DOCTYPE html>
<html>
@section('html-head')
    <head>
        <meta charset="UTF-8">
        <title>Branch Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('icons/logo.png') }}" type='image/x-icon'>
        <script src="/js/jquery-3.1.1.js"></script>
        <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
        <link href="/css/style.css" rel="stylesheet" type="text/css">
        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                    'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        @yield('styling')
    </head>
@show
<body>
@yield('sideNavContent')
<div class="main-style" id="main">
    <div id="head" class="head-bar container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6 header-text">
                <span class="btn-menu" onclick="openCloseNav()">&#9776;</span>
                <span><a href="/branch" class="navbar-heading"> Branch Dashboard</a></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <ul class="head-right-content list-inline">
                    <li data-toggle="dropdown"><a>{{ Auth::user()->branchArea }} , {{ Auth::user()->city }} <span><img class="img-circle restaurant-logo-img" src="{{ Auth::user()->resImage }}"></span></a></li>
                    <ul class="dropdown-menu dropdown-menu-right profile-options">
                        <li><a href="branch/logout"><i class="fa fa-sign-out fa-fw"></i>&nbsp; Sign Out</a></li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>


    @yield('content')
</div>

<script src="/js/template.js"></script>
@yield('scripts')

</body>
</html>
