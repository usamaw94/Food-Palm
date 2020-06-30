//$(document).ready(function() {
//    $(document).click(function () {
//        if (this.id != '#branchRequests' || this.id != '#showBranchRequest') {
//            $("#branchRequests").fadeOut('slow');
//        }
//    });
//});

$(document).ready(function(){
    $("#showBranchRequest").click(function() {
        $('#branchRequests').slideToggle('slow');
        $("#showBranchRequest").toggleClass("btn-notify");
        $("#showBranchRequest").toggleClass("btn-notify-active");
    });

    $('#closeRequests').click(function() {
        $("#branchRequests").fadeOut('slow');
        $( "#showBranchRequest" ).removeClass( "btn-notify-active" ).addClass("btn-notify" );
    });

    $(document).click(function(event) {
        if(!$(event.target).closest('#showBranchRequest').length && !$(event.target).closest('#branchRequests').length) {
            $("#branchRequests").fadeOut('slow');
            $( "#showBranchRequest" ).removeClass( "btn-notify-active" ).addClass("btn-notify" );
        }
    });

});

var nav = 0;


$(document).on("click", ".close-btn" , function(){
    document.getElementById("mySidenav").classList.remove('sidenav-change');
    document.getElementById("main").classList.remove('main-style-change');
    document.getElementById("head").classList.remove('head-bar-change');
    nav = 0;
});

function openCloseNav() {
    //alert(nav);
    if(nav == 0) {
        document.getElementById("mySidenav").classList.add('sidenav-change');
        document.getElementById("main").classList.add('main-style-change');
        document.getElementById("head").classList.add('head-bar-change');
        $('.btn-menu').addClass("btn-menu-active");
        nav = 1;
    } else if(nav == 1) {
        document.getElementById("mySidenav").classList.remove('sidenav-change');
        document.getElementById("main").classList.remove('main-style-change');
        document.getElementById("head").classList.remove('head-bar-change');
        $('.btn-menu').removeClass("btn-menu-active");
        nav = 0;
    }
}
