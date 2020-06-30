<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Food Palm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' href='icons/logo.png' type='image/x-icon'>
    <script src="/js/jquery-3.1.1.js"></script>
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="/css/welcome.css" rel="stylesheet">
</head>
<body>
<center>
    <img src="icons/logoWhite.png" class="img-logo">
    <hr class="seperator1">

    <button data-toggle="modal" data-target="#myModal" class="btn btn-default btn-login">LOG IN</button>

    <button onclick="window.location.href='/restaurantBranchSignup'" class="btn btn-default btn-signup">SIGN UP</button>


    <hr class="seperator2">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h1 class="modal-title">Login As</h1>
                    <ul class="list-unstyled">
                        <li><a class="modal-link" href="/branch/login">
                                &nbsp;&nbsp;Branch
                            </a></li>
                        <li><a class="modal-link" href="/restaurant/login">
                                &nbsp;&nbsp;Restaurant
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</center>
</body>
</html>