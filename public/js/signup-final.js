///////////////////////////////////////////////////////

//$(document).ready(function(){
//    $('#showRegisterResturant').click(function(){
//
//        $('#registerBranch').hide();
//        $('#showRegisterResturant div').addClass('list-active')
//        $('#showRegisterBranch div').removeClass('list-active');
//        $('#registerResturant').fadeIn('slow');
//    });
//
//    $('#showRegisterBranch').click(function(){
//        $('#registerResturant').hide();
//        $('#showRegisterBranch div').addClass('list-active');
//        $('#showRegisterResturant div').removeClass('list-active')
//        $('#registerBranch').fadeIn('slow');
//    });
//});

$('#showRegisterResturant').on('click', function() {
    $('#registerBranch').hide();
    $('#showRegisterResturant div').addClass('list-active')
    $('#showRegisterBranch div').removeClass('list-active');
    $('#registerResturant').fadeIn('slow');
});

$('#showRegisterBranch').on('click', function() {
    $('#registerResturant').hide();
    $('#showRegisterBranch div').addClass('list-active');
    $('#showRegisterResturant div').removeClass('list-active');
    $('#registerBranch').fadeIn('slow');
    google.maps.event.trigger(window,'resize',{});
});

$('#mShowRegisterRestaurant').on('click', function() {
    $('#registerBranch').hide();
    $('#mShowRegisterRestaurant').addClass('m-active');
    $('#mShowRegisterBranch').removeClass('m-active');
    $('#registerResturant').fadeIn('slow');
});

$('#mShowRegisterBranch').on('click', function() {
    $('#registerResturant').hide();
    $('#mShowRegisterBranch').addClass('m-active');
    $('#mShowRegisterRestaurant').removeClass('m-active');
    $('#registerBranch').fadeIn('slow');
    google.maps.event.trigger(window,'resize',{});
});