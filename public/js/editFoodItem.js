$(document).ready(function(){
    var prevImg = $('#itemImg').attr('src');

    $('#changeImage').change(function(event){
        var tmppath = URL.createObjectURL(event.target.files[0]);
        $("#itemImg").fadeIn("slow").attr('src',URL.createObjectURL(event.target.files[0]));
    });

    $('#removeImg').click(function(){
        $("#changeImg").val("");
        $("#itemImg").fadeIn("slow").attr('src','images/noImage.png');
        $("#delStatus").val('yes');
    });

    $('#resetImg').click(function(){
        $("#changeImg").val("");
        $("#itemImg").fadeIn("slow").attr('src',prevImg);
        $("#delStatus").val('no');
    });
});

