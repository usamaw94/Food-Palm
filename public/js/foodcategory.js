$(document).ready(function() {
    $("#productPanelTrigger").click(function () {
        $('#addProductPanel').slideToggle('slow');
        $(".panel-indicator i").toggleClass("fa-plus fa-minus");
    });

    $("#searchBar").focus(function(){
        $("#searchFilters").slideDown('slow');
    });

    $("#searchBar").blur(function(){
        $("#searchFilters").slideUp('slow');
    });
});

$(document).on("click", ".viewDetails", function(){
    var id=$(this).attr('data-itemID');
    var name=$(this).attr('data-itemName');
    var cat=$(this).attr('data-category');
    var subCat=$(this).attr('data-subCategory');
    var price=$(this).attr('data-price');
    var discount=$(this).attr('data-discount');
    var img =$(this).attr('data-img');

    if(img == null || img == ''){
        img = '/images/noImage.png';
    }


    $("#foodItemID").val(id);
    $("#foodItemImg").attr("src",img);
    $('#itemID').text(id);
    $('#itemName').text(name);
    $('#category').text(cat);
    $('#subCategory').text(subCat);
    $('#price').text(price);
    $('#discount').text(discount);
});

$(document).on("click", ".btn-delete-item", function(){
    var id=$(this).attr('data-itemId');

    $('#itemId').text(id);
});

$(document).on("click", "#deleteFoodItem", function(){

    var id = $('#itemId').text();

    var url = "deleteFoodItem/"+id;

    $.ajax({
        url:url,
        data:id,
        datatype:"json",
        method:"GET",
        success:function(){

            $('#reload').load("/foodCategory #reload");
            $('#deleteItem').modal('toggle');
        }
    });
});