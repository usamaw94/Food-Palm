$(document).ready(function(){
    $('#showRegisterResturant').click(function(){

        $('#registerBranch').hide();
        $('#showRegisterResturant').addClass('active')
        $('#showRegisterBranch').removeClass('active');
        $('#registerResturant').fadeIn('fast');
    });

    $('#showRegisterBranch').click(function(){
        $('#registerResturant').hide();
        $('#showRegisterBranch').addClass('active');
        $('#showRegisterResturant').removeClass('active')
        $('#registerBranch').fadeIn('fast');
    });
});