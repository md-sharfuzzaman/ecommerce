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
});