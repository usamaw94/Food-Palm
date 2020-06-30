/**
 * Created by Haier on 6/17/2017.
 */
$(document).ready(function() {
    $("#categoryPanelTrigger").click(function () {
        $('#addCategoryPanel').slideToggle('slow');
        $(".panel-indicator i").toggleClass("fa-angle-down fa-angle-up");
    });
});

$(document).on("click", ".editCat", function(){
    var id=$(this).attr('data-catID');
    var name=$(this).attr('data-catName');
    var main=$(this).attr('data-mainCat');

    $('#categoryID').val(id);
    $('#categoryName').val(name);
    $('#mainCategory').val(main);

});

$(document).on("click", ".delCat", function(){

    var id=$(this).attr('data-catID');
    var name=$(this).attr('data-catName');

    $('#catID').val(id);
    $('#catName').text(name);
});

$(document).on("click", "#updateCat", function(){
    var url="editCategory";
    var data=$('#editCategoryForm').serialize();


    $.ajax({
        url:url,
        data:data,
        datatype:"json",
        method:"GET",
        success:function(){
            $('#reload').load("/categories #reload");
            $('#editCategory').modal('toggle');
        }
    });
});

$(document).on("click", "#deleteCat", function(){
    var url="deleteCategory";
    var data=$('#deleteCategoryForm').serialize();


    $.ajax({
        url:url,
        data:data,
        datatype:"json",
        method:"GET",
        success:function(){
            $('#reload').load("/categories #reload");
            $('#deleteCategory').modal('toggle');
        }
    });
    $('#editCategoryForm').trigger("reset");
});