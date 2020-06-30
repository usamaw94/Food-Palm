<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SignUp Final</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' href='/icons/logo.png' type='image/x-icon'>
    <script src="/js/jquery-3.1.1.js"></script>
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="/css/filestyleBootstrap.css" rel="stylesheet">
    <script src="/js/filestyleBootstrap.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/select2-4.0.3/dist/css/select2.min.css" rel="stylesheet">
    <script src="/select2-4.0.3/dist/js/select2.min.js"></script>

    <link href="/css/signup-final.css" rel="stylesheet">
</head>
<body>
<img src="/images/logo1.png" class="logo">
<div class="container-fluid">
    <div class="row">
        <div class="signup-left col-md-3">
            <div class="left-heading-container">
                <a title="Home" href="/"><div class="go-back">
                        <i class="fa fa-chevron-left"></i>
                    </div></a>
                <p class="font-regular">SIGN UP</p>
                <hr class="seperator-white">
            </div>
            <div class="signup-option-container">
                <ul class="list-unstyled">
                    <li id="showRegisterResturant" class="signup-option" ><div class="list-pointer list-active"></div><p>RESTAURANT</p></li>
                    <li id="showRegisterBranch" class="signup-option" ><div class="list-pointer"></div><p>BRANCH</p></li>
                </ul>
            </div>
            <div class="login-container">
                <a href="/branch/login" class="login-link font-regular">ALREADY<br>REGISTERED ?<br><i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>



        <div class="signup-right col-md-offset-3 col-md-9 col-sm-offset-2 col-sm-9 col-xs-offset-0 col-xs-11">
            <div class="mobile-content container-fluid">
                <div class="col-md-12">
                    <h2 class="signup-mobile-heading font-regular font-orange">SIGNUP AS</h2>
                    <h3 class="signup-options-container">
                        <span id="mShowRegisterRestaurant" class="mobile-signup-option m-active">RESTAURANT</span>
                        <span> / </span>
                        <span id="mShowRegisterBranch" class="mobile-signup-option">BRANCH</span></h3>

                    <h4 onclick="window.location.href='/branch/login'" class="mobile-login">ALREADY REGISTERED ?</h4>
                </div>
            </div>
            <div id="registerResturant" class="restaurant-form-container">
                <h1 class="signup-heading font-regular font-orange">SIGNUP AS <span class="font-extra-bold">RESTAURANT</span></h1>
                <hr class="seperator-orange">
                <div class="signup-form-container container-fluid">



                    <form action="/restaurantSignup" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="feilds-container row">
                            <div class="form-label col-md-12">
                                <p>RESTAURANT NAME</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="restaurant" class="form-control{{ $errors->has('restaurant') ? ' form-error' : '' }}" value="{{ old('restaurant') }}">
                            </div>
                            @if ($errors->has('restaurant'))
                                <div class="col-md-9">
                                    <p class="font-bold font-red">{{ $errors->first('restaurant') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="feilds-container row">
                            <div class="form-label col-md-12">
                                <p>RESTAURANT LOGO</p>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group image-preview">
                                    <input name="logo" type="text" placeholder="Upload resturant logo image" class="form-control image-preview-filename{{ $errors->has('logoImg') ? ' form-error' : '' }}" readonly> <!-- don't give a name === doesn't send on POST/GET -->
                                    <div class="input-group-btn">
                                        <!-- image-preview-clear button -->
                                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                            <span class="glyphicon glyphicon-remove"></span> Clear
                                        </button>
                                        <!-- image-preview-input -->
                                        <div class="btn btn-default image-preview-input">
                                            <i class="fa fa-upload" aria-hidden="true"></i>


                                            <input type="file" accept="image/png, image/jpeg, image/gif, image/jpg" name="logoImg" value="{{ old('logoImg') }}"/> <!-- rename it -->


                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('logoImg'))
                                <div class="col-md-9">
                                    <p class="font-bold font-red">{{ $errors->first('logoImg') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="feilds-container row">
                            <div class="form-label col-md-12">
                                <p>DESCRIPTION</p>
                            </div>
                            <div class="col-md-9">
                                <textarea rows="3" name="description" class="form-control" value="{{ old('description') }}"></textarea>
                            </div>
                        </div>
                        <div class="feilds-container row">
                            <div class="form-label col-md-12">
                                <p>PASSWORD</p>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' form-error' : '' }}">
                            </div>
                            @if ($errors->has('password'))
                                <div class="col-md-9">
                                    <p class="font-bold font-red">{{ $errors->first('password') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="feilds-container row">
                            <div class="form-label col-md-12">
                                <p>RE-ENTER PASSWORD</p>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                        <div class="feilds-container row">
                            <div class="col-md-offset-6 col-md-3">
                                <button type="submit" class="btn btn-block btn-submit">
                                    <i class="fa fa-arrow-right"></i>&nbsp; SIGN UP
                                </button>
                            </div>
                        </div>
                    </form>






                </div>
            </div>







            <div id="registerBranch" class="branch-form-container">
                <h1 class="signup-heading font-regular font-orange">SIGNUP AS <span class="font-extra-bold">BRANCH</span></h1>
                <hr class="seperator-orange">
                <div class="signup-form-container container-fluid">



                    <form action="/branch/signup" method="post">

                        {{csrf_field()}}


                        <div class="feilds-container row">
                            <div class="form-label col-md-12">
                                <p>SELECT RESTAURANT</p>
                            </div>
                            <div class="col-md-9">
                                <select id="select-resturant" style="width: 100%" name="brestaurant" class="form-control signup-select {{ $errors->has('brestaurant') ? ' form-error' : '' }}" value="{{ old('brestaurant') }}">

                                    @foreach($restaurants as $r)

                                        <option value="{{ $r->id }}" >{{$r->res_name}}</option>

                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('brestaurant'))
                                <div class="col-md-9">
                                    <p class="font-bold font-red">{{ $errors->first('brestaurant') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="feilds-container row">
                            <div class="form-label col-md-12">
                                <p>CITY</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="city" class="form-control{{ $errors->has('city') ? ' form-error' : '' }}" value="{{ old('city') }}">
                            </div>
                            @if ($errors->has('city'))
                                <div class="col-md-9">
                                    <p class="font-bold font-red">{{ $errors->first('city') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="feilds-container row">
                            <div class="form-label col-md-12">
                                <p>AREA</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="area" class="form-control{{ $errors->has('area') ? ' form-error' : '' }}" value="{{ old('area') }}">
                            </div>
                            @if ($errors->has('area'))
                                <div class="col-md-9">
                                    <p class="font-bold font-red">{{ $errors->first('area') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="feilds-container row">
                            <div class="form-label col-md-12">
                                <p>IS HOME DELIVERY AVAILABLE</p>
                            </div>
                            <div class="col-md-9">
                                <select type="password" name="homeDelivery" class="form-control">
                                    <option value="true">Yes</option>
                                    <option value="false">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="feilds-container row">
                            <div class="form-label col-md-12">
                                <p>IDENTIFY YOUR LOCATION</p>
                            </div>
                            @if ($errors->has('latitude'))
                                <div class="col-md-9">
                                    <p class="font-bold font-red">{{ $errors->first('latitude') }}</p>
                                </div>
                            @endif
                            <div class="col-md-9">
                                <input type="hidden" id="latitude" name="latitude" readonly>
                                <input type="hidden" id="longitude" name="longitude" readonly>
                                <input type="text" placeholder="Search any location" id="pac-input" class="form-control" onkeydown="if (event.keyCode == 13) {return false;}">
                                <div id="googleMap" class="google-map"></div>
                                <p class="font-bold font-orange">*Select location by clicking on the map</p>
                            </div>
                        </div>

                        <div class="feilds-container row">
                            <div class="form-label col-md-12">
                                <p>PASSWORD</p>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="bpassword" class="form-control{{ $errors->has('bpassword') ? ' form-error' : '' }}" value="{{ old('bpassword') }}">
                            </div>
                            @if ($errors->has('bpassword'))
                                <div class="col-md-9">
                                    <p class="font-bold font-red">{{ $errors->first('bpassword') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="feilds-container row">
                            <div class="form-label col-md-12">
                                <p>RE-ENTER PASSWORD</p>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="bpassword_confirmation" class="form-control">
                            </div>
                        </div>
                        <div class="feilds-container row">
                            <div class="col-md-offset-6 col-md-3">
                                <button type="submit" class="btn btn-block btn-submit">
                                    <i class="fa fa-arrow-right"></i>&nbsp; SIGN UP
                                </button>
                            </div>
                        </div>
                    </form>





                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/maps.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsaBSLRpDtQYzD5md-bnOYP61GBRN9oac&libraries=places&callback=myMap"></script>
<script src="/js/signup-final.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".signup-select").select2({
            placeholder: "Select resturant to enter branch"
        });
    });
</script>
</body>
</html>