$(document).ready(function(){
	$(".username_con").mouseenter(function(){
		$(".head_con .head_list").show();
	});
	$(".username_con").mouseleave(function(){
		$(".head_con .head_list").hide();
	});
    /*------------登录注册页面-------------*/
    $("#login_btn").click(function(){
        $(".login_and_register").show();
        $(".login_and_register .register_con").hide();
        $(".login_and_register .login_con").show();
    });
    $("#reg_btn").click(function(){
        $(".login_and_register").show();
        $(".login_and_register .register_con").show();
        $(".login_and_register .login_con").hide();
    });
    $(".backpswd_btn_con .register_btn").click(function(){
        $(".login_and_register").show();
        $(".login_and_register .register_con").show();
        $(".login_and_register .login_con").hide();
    });
    $(".login_and_register .close").click(function(){
        $(".login_and_register").hide();
        $(".mask").hide();
    });
    $("#xieyiChecked").click(function(){
    	if(!$(this).hasClass("m")){
    		$(this).addClass("m");
    	}else{
    		$(this).removeClass("m")
    	}
    })
})