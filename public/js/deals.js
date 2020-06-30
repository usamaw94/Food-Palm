$(document).ready(function() {
    $("#dealPanelTrigger").click(function () {
        $('#makeDealPanel').slideToggle('slow');
        $(".panel-indicator i").toggleClass("fa-angle-down fa-angle-up");
    });

    $("#searchBar").focus(function(){
        $("#searchFilters").slideDown('slow');
    });

    $("#searchBar").blur(function(){
        $("#searchFilters").slideUp('slow');
    });

    $("#dealCategoryTrigger").click(function () {
        $('#dealsByCategoryPanel').slideToggle('slow');
        $(this).toggleClass('deals-by-category-active');
        $(".indicator i").toggleClass("fa-plus-circle fa-minus-circle");
    });
});

$(document).on("click", ".viewDetails", function(){
    var id=$(this).attr('data-itemID');
    var name=$(this).attr('data-itemName');
    var subCat=$(this).attr('data-subCategory');
    var price=$(this).attr('data-price');
    var description=$(this).attr('data-description');
    var img =$(this).attr('data-img');

    if(img == null || img == ''){
        img = '/images/noImage.png';
    }

    $("#dealID").text(id);
    $('#dealName').text(name);
    $("#dealImg").attr("src",img);
    $('#subCategory').text(subCat);
    $('#price').text(price);
    $('#description').text(description);
});

$(document).on("click", ".btn-delete-deal", function(){
    var id=$(this).attr('data-itemId');

    $('#itemId').text(id);
});

$(document).on("click", "#deleteDeal", function(){

    var id = $('#itemId').text();

    var url = "deleteDeal/"+id;

    $.ajax({
        url:url,
        data:id,
        datatype:"json",
        method:"GET",
        success:function(){

            $('#reload').load("/deals #reload");
            $('#deleteDeal').modal('toggle');
        }
    });
});

$(document).on("click", "#openComboPanel", function(){
    $('#comboPanel').slideToggle('slow');
    $( "#openComboPanel" ).toggleClass( "btn-add-combo-border" )

});
