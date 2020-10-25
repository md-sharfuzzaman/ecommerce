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
        })
    })



});