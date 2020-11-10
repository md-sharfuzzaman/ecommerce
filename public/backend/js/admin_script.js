$(document).ready(function(){


    // Check Admin Password is correct or not

    $("#current_pwd").keyup(function(){
        let current_pwd = $("#current_pwd").val();
        //console.log(current_pwd);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-pwd',
            data: {current_pwd:current_pwd},
            success: function(resp){
              
                if(resp=="false"){
                    $("#chkCurrentPwd").html("<font color=red>Current password is incorrect</font>");
                }else if(resp=="true"){
                    $("#chkCurrentPwd").html("<font color=green>Current password is correct</font>");
                }
            },
            error: function(){
               
            }
        });
    });

    $(".updateSectionStatus").click(function(){
        let status = $(this).text();
        let section_id = $(this).attr("section_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-section-status',
            data: {status: status, section_id:section_id},
            success:function(resp){
                
                if(resp['status']==0){
                    $("#section-"+section_id).html(" <a href='javascript:void(0) class='updateSectionStatus'>Inactive</a>");
                }else if(resp['status']==1){
                    $("#section-"+section_id).html(" <a href='javascript:void(0) class='updateSectionStatus'>Active</a>");
                }
            }, error:function(){
                alert('error')
            }
        })

    });

    // update category status

    $(".updateCategoryStatus").click(function(){
        let status = $(this).text();
        let category_id  = $(this).attr("category_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-category-status',
            data: {status: status, category_id:category_id},
            success:function(resp){
                
                if(resp['status']==0){
                    $("#category-"+category_id).html(" <a href='javascript:void(0) class='updateCategoryStatus'>Inactive</a>");
                }else if(resp['status']==1){
                    $("#category-"+category_id).html(" <a href='javascript:void(0) class='updateCategoryStatus'>Active</a>");
                }
            }, error:function(){
                alert('error')
            }
        })

    });


    // append category level

    $("#section_id").change(function(){
        let section_id = $(this).val();
        //alert(section_id);
        $.ajax({
            type: 'post',
            url: '/admin/append-categories-level',
            data: {section_id:section_id},
            success:function(resp){
                $("#appendCategoriesLevel").html(resp);
            },error:function(){
                alert("Error");
            }
        })
    })

    // Confirm Deletion of Record
    /* $(".confirmDelete").click(function(){
        let name = $(this).attr("name");
        if(confirm("Are you sure to delete this "+name+"?")){
            return true;
        }
        return false;
    }) */

    // confirm deletion with sweetAlert
    $(".confirmDelete").click(function(){
        let record = $(this).attr("record");
        let recordId= $(this).attr("recordid")
        let name = $(this).attr("name");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
              window.location.href="/admin/delete-"+record+"/"+recordId;
            }
        })
    })


    // Product Status

    // update Product status

    $(".updateProductStatus").click(function(){
        let status = $(this).text();
        let product_id  = $(this).attr("product_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-product-status',
            data: {status: status, product_id:product_id},
            success:function(resp){
                
                if(resp['status']==0){
                    $("#product-"+product_id).html(" <a href='javascript:void(0) class='updateProductStatus'>Inactive</a>");
                }else if(resp['status']==1){
                    $("#product-"+product_id).html(" <a href='javascript:void(0) class='updateProductStatus'>Active</a>");
                }
            }, error:function(){
                alert('error')
            }
        })

    });


    // Products Attributes Add/Remove Scripts

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="margin-top:10px; margin-left: 2px"> <input style="width: 120px" id="size" type="text" required name="size[]" value="" placeholder="Size"/><input style="width: 120px" id="sku" name="sku[]" required type="text" name="sku[]" value="" placeholder="SKU"/><input style="width: 120px" id="price" required type="number" name="price[]" value="" placeholder="Price"/><input style="width: 120px" id="stock" name="stock[]" required type="number" name="stock[]" value="" placeholder="Stock"/><a href="javascript:void(0);" class="remove_button"> Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });



});