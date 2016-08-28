<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>方讯--用户注册</title>
<meta name="keywords" content="方讯" />
<meta name="description" content="方讯" />
<jsp:include page="../webpage/jq_css.jsp" ></jsp:include>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>style.css?v1.0.5"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>pub.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>yiku.css"/>

<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/system.js"></script>
<script type="text/javascript" src="<?php echo ($tplpath); ?>yiku.js"></script>

 <?php 
 session_start();                                   //用于在$_SESSION中获取验证码的值
?>

<script type="text/javascript">
	// 增加手机号验证
	$(document).ready(function() {
	});
	
	var res="0";
	var bool="0";
	function getNumber(o){
		var mobilePhone = document.getElementById("mobilePhone").value;
		var code = document.getElementById("imgVerifyCode").value;
		if (code != "") {
			var mo = /^[\u4e00-\u9fa5]+$/;
			if (!mo.test(code)) {
                alert("请填写图片中正确的汉字");
                changeImg();
				return false;
            }
		} else {
			alert("请输入图形验证码");
			changeImg();
			return false;
		}		

		var bool="0";
		if(checkmobile()){
			bool="1";
		}
		if(res=="1"&&bool=="1"){
			$.ajax({
				type : "post",
				url : "web_getCodeNew.xhtml",
				dataType : "json",
				data : {
					'mobilePhone' : mobilePhone,
					'code' : code
				},
				async : true,
				success : function(data) {
					if(data){
						if(data[0] == "200"){
							bool = "1";
							document.getElementById("send").innerHTML="验证码信息已发送到"+mobilePhone+"请查收";
							time(o);							
						}else if(data[0] == "-1"){
							alert("图形验证码不正确，请重新输入");
					//		time(o);
							bool="0"
							changeImg();
							return false;							
						}else if(data[0] == "-2"){
							alert("这个手机号今天已经超过请求次数，请明天再试");
						//	time(o);
							bool="0"
							changeImg();
							return false;								
						}else{
							alert("验证码发送失败，请确认手机号码的正确或稍后再试");
						//	time(o);
							bool="0"
							changeImg();							
							return false;							
						}	
					}else{
						alert("验证码发送失败，请确认手机号码的正确或稍后再试");
					//	time(o);
						bool="0"
						changeImg();
						return false;						
					}
					
					/*
					if (data && data[0] == "200") {
						bool="1";
						document.getElementById("send").innerHTML="验证码信息已发送到"+mobilePhone+"请查收";
						time(o);
					} else {
						alert("验证码发送失败，请确认手机号码的正确或稍后再试");
						time(o);
						bool="0"
						return false;
					}
					*/
				},
				buttons : $("#button"),
				error : function(jqXHR, textStatus, errorThrown) {
					///alert("服务器没有返回数据，可能服务器忙，请重试");
				},
				onError : "",
				onWait : ""
			});
		}
	}
	
	/**
	 * 验证手机号码
	 */
	function checkmobile(){
		var mobilePhone = document.getElementById("mobilePhone").value;
		if (mobilePhone != "") {
			var mo = /^1[3|4|5|8][0-9]{9}?$/;
			if (!mo.test(mobilePhone)) {
                alert("请填写正确的手机号码");
				return false;
            }
		} else {
			alert("请输入手机号码");
			return false;
		}
		$.ajax({
			type : "post",
			url : "web_isRegMobile.xhtml",
			dataType : "json",
			data : {
				'mobile' : mobilePhone
			},
			async : true,
			success : function(data) {
				if (data && data[0] == "1") {
					res="1";
					return true
				} else {
					alert("该手机号码已绑定，请直接登录");
					res="0";
					 ///document.getElementById("mobilePhone").focus();
					return false;
				}
			},
			buttons : $("#button"),
			error : function(jqXHR, textStatus, errorThrown) {
				///alert("服务器没有返回数据，可能服务器忙，请重试");
			},
			onError : "",
			onWait : ""
		})
		return true
	}
	
	/**
	 * 到下一步
	 */
	function nexttr(){
		var mobilePhone = document.getElementById("mobilePhone").value;
		
		if (!checkmobile()) {
			return false;
		}
		
		if((verifyCode!="") && (imgVerifyCode != "")){
			$.ajax({
				type : "post",
				url : "web_exeCode.xhtml",
				dataType : "json",
				data : {
					'mobilePhone' : mobilePhone
				},
				async : true,
				success : function(data) {
					if (data && data[0] == "200") {
						res="1";
						document.forms["resForm"].submit();
						return true;
					} else {
						res="0";
						alert("短信验证码输入有误,请确认");
						return false;
					}
				},
				buttons : $("#button"),
				error : function(jqXHR, textStatus, errorThrown) {
					///alert("服务器没有返回数据，可能服务器忙，请重试");
				},
				onError : "",
				onWait : ""
			})
		}
	}
	
	/**
	*  注册
	 **/ 
	 function check(){
		 var username = document.getElementById("user_name");
		 var password = document.getElementById("password");
		 var verifycode = document.getElementById("verifycode");
		 var email = document.getElementById("email");
		
		 if((username.value == null) || (username.value == "")){
			 alert("用户名不能为空");
			// username.fouce();
			 return false;
		 }
		 
		 if((password.value == null) || (password.value == "")){
			 alert("密码不能为空")
			// password.fouce();
			 return false;
		 }
		 
		 if((verifycode.value == null) || (verifycode.value == "")){
			 alert("请输入图片验证码");
			 return false;
		 }
		 
		 if((email.value == null) || (email.value == "")){
			 alert("请输入邮箱");
			 return false;
		 }
		 return true;
	}
	 
	 
	//点击换一张验证码
	function changeImg() {

		var imgSrc = document.getElementById("imageCode");
	    var src = imgSrc.src; 
	    var newSrc = chgUrl(src);
	    imgSrc.src = newSrc;  
	}
	
	//时间戳   
	//为了使每次生成图片不一致，即不让浏览器读缓存，所以需要加上时间戳   
	function chgUrl(url) {
		var timestamp = (new Date()).valueOf();
		url = url + "/timestamp/" + timestamp;   
		return url;
	}
</script>
</head>

<body>
<?php
	$username = $_SESSION['force_user'];
?>

<script language="javascript">
var SitePath='<?php echo ($webpath); ?>';var SiteMid='<?php echo ($mid); ?>';var SiteCid='<?php echo ($cid); ?>';var SiteId='<?php echo ($id); ?>'; var username='<?php echo ($username); ?>';

function fxsearch()
{
	var wd = document.getElementById('wd').value;
	var url = '<?php echo getsearchurl();;?>';
	window.location = url+'wd/'+wd;
}
function changeImg() {
    var imgSrc = document.getElementById("imageCode");
    var src = imgSrc.src;
    var newSrc = chgUrl(src);
    imgSrc.src = newSrc;
}

//时间戳
//为了使每次生成图片不一致，即不让浏览器读缓存，所以需要加上时间戳
function chgUrl(url) {
    var timestamp = (new Date()).valueOf();
    url = url + "/timestamp/" + timestamp;
    return url;
}
function login(){
	var url = "?s=Login/Login";
	window.location = url;
}

function register(){
	var url = "?s=Login/Register";
	window.location = url;
}

function usercenter(){
	var url = "?s=User/Fusershow";
	window.location = url;
}
</script>
<script type="text/javascript" src="<?php echo ($tplpath); ?>yiku.js"></script>
<!--头部 开始-->
<div class="top">
	<a href="<?php echo ($webpath); ?>" class="logo"><img src="/video/template/default/images/logo1.png"></a>
    <!--搜索 开始-->
	<div class="ss">
    	<div class="ss1 fix">
        	<form id="searchForm" name="searchForm" method="post" action="<?php echo getsearchurl();;?>">
            
            <input id="wd" name="wd"  autocomplete="off"type="text" <?php echo (($keyword)?($keyword):'请输入关键字'); ?> />
            <a href="javascript:void(0);" onclick="fxsearch();">
            </a>
            </form>
        </div>
        <div class="ss2">
            <?php echo ($hotkey); ?>
        </div>
    </div>
    <!--搜索 结束-->
   <!--  <a href="<?php echo ($webpath); ?>index.php?s=top10" class="ph"></a> -->
    <div class="top1">
    	 <?php if($username == ''): ?><a href="javascript:void(0)" id="login_btn">登录</a><a href="javascript:void(0)" id="reg_btn" >注册</a>
	    <!-- 	<a href="javascript:login()" id="login_btn">登录</a><a href="javascript:register()" id="reg_btn" >注册</a>  -->
	    	 <!--  
	        <a href="<?php echo ($webpath); ?>index.php?s=Guestbook" style="color:#F00">我要求片</a>|
	        -->
	     <?php else: ?>	
	     
	     	<a href="javascript:void(0);" class="top1-1" id="user_old_list_a" onblur="this.blur();"><?php echo ($username); ?></a>
	     	<div class="jilu" id="user_old_list">
	        	<span class="jilu1"></span>
	            <div class="jilu3" id="user_old_list_content">
	                <a href="javascript:usercenter()" class="jilu1-2"><span class="jilu3-1">个人中心</span></a>
	                <a href="?s=Login/Logout" class="jilu1-2"><span class="jilu3-1">退出登录</span></a>
	            </div>
	            <span class="jilu2"></span>
        	</div><?php endif; ?>
        <a href="javascript:void(0);" class="top1-1" id="play_old_list_a" onblur="this.blur();">观看记录</a>
    	<!--观看记录 开始-->
        <div class="jilu" id="play_old_list">
        	<span class="jilu1"></span>
            <div class="jilu3" id="play_old_list_content">
                
                <div class="jilu1-3"><a href="#" class="qk">全部清空</a></div>
            </div>
            <span class="jilu2"></span>
        </div>
        <!--观看记录 结束-->
        
    </div>
</div>
<div class="lines"></div>
<!--头部 结束-->
<!--导航 开始-->
<div class="nav">
	<div class="nav1">
		<ul class="nav1-1">
            <li><a href="<?php echo ($webpath); ?>" <?php if($model == 'index'): ?>class="on"<?php endif; ?>>首页</a></li>
            
            <?php $tag['name'] = 'menu'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><li><a onfocus="this.blur();" href="<?php echo ($menu["showurl"]); ?>" <?php if(($menu['id'] == $cid) or ($menu['id'] == $pid)): ?>class="on"<?php endif; ?>><?php echo ($menu["cname"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            <!--  
            <a href="<?php echo getspecialurl();;?>">专题</a>
            <a href="/index.php?s=tv">直播</a>
            -->
		</ul>
		<!--  
        <p class="nav1-2">
        
        <?php $tag['name'] = 'self';$tag['cid'] = '9';$tag['limit'] = '4'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$self): ++$i;$mod = ($i % 2 );?><a href="<?php echo ($self["link"]); ?>"target="_blank" style="color:<?php echo ($self["color"]); ?>"><?php echo ($self["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>    
            
        </p>
        -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(e){
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
    });
})
</script>
<!--导航 结束-->
<div class="login_and_register">
    <div class="header fix">
        <span class="logo fl_l"><img src="/video/template/default/images/logo2.png"></span>
        <a class="fl_r close" href="javascript:void(0)"></a>
    </div>
    <div class="login_con">
        <form action="?s=Login/ajaxcheck" method="post">
            <ul>
                <li class="error"><p>账号或密码错误</p></li>
                <li><input id="username" name="username" type="text" placeholder="用户名"/></li>
                <li><input id="userpwd" name="userpwd" type="password" placeholder="密码"/></li>
                <li class="fix">
                    <input class="fl_l" id="verifycode" name="verifycode" type="text" placeholder="请输入验证码"/>
                    <img id="imageCode" class="upload_verifycode_img" src="?s=/Login/showImage" title="看不清可单击图片刷新" onclick="changeImg()"/>
                </li>
            </ul>
            <div class="backpswd_btn_con fix">
                <a href="" class="register_btn fl_l">还没账号，点此注册</a>
                <a href="?s=Login/fog_pwd" class="backpswd_btn2 fl_r">忘记密码</a>
            </div>
            <input type="submit" class="submit_btn" name="submit" value="登录" />
        </form>
    </div>
    <div class="register_con disun">
        <form action="?s=Login/Register_do" method="post">
            <ul>
                <li class="error"><p>账号或密码错误</p></li>
                <li><input id="user_name" name="user_name" type="text" placeholder="用户名"/></li>
                <li><input id="password" name="password" type="password" placeholder="密码"/></li>
                <li class="fix">
                    <input class="fl_l" id="verifycode" name="verifycode" type="text" placeholder="请输入验证码"/>
                    <img id="imageCode" class="upload_verifycode_img" src="?s=/Login/showImage" title="看不清可单击图片刷新" onclick="changeImg()"/>
                </li>
            </ul>
            <div class="xieyi fix">
                <span class="checked"></span>
                <p>我已阅读并同意相关服务条款</p>
            </div>
            <input type="submit" class="submit_btn" value="注册" id="submit" />
        </form>
    </div>
</div>


<div class="width1000">
	<div class="sub_breadcrumb_nav">
    	
    </div>
    <div class="sub_main">
    	<div class="sub_main_title">用户注册</div>
    	<form action="?s=Login/Register_do/webpath<?php echo ($webpath); ?>" method="post" name="resForm"
				id="resForm" autocomplete="off" onsubmit="return check()">
    	<div class="sub_content pad_tb">
        	<div class="form546" style="margin-top:20px;">
            	<ul>
                	<li>
                    	<div class="form546_title"><span class="fc_red">*</span>用户名：</div>
                        <div class="lfloat">
                        	<input type="text" id="user_name" name="user_name" class="radius5 width416" onblur="checkmobile()"/>
                        </div>
                        <div class="clra"></div>
                        <div class="form546_ts" id="tip">用户名必须以6-20位的字母，数字或下划线组成</div>
                        <div class="verify_div">
                        	<div id="mobilePhoneTip" ></div>
                        </div>
                    </li>
                	<li>
                    	<div class="form546_title"><span class="fc_red">*</span>密&nbsp;&nbsp;码：</div>
                        <div class="lfloat">
                        	<input type="password" id="password" name="password" class="radius5 width416" />
                        </div>
                        <div class="clra"></div>
                        <div class="form546_ts" id="tip">密码请使用4_16位字母数字或下划线组成</div>
                        <div class="verify_div">
                        	<div id="mobilePhoneTip" ></div>
                        </div>
                    </li>       
               		<li>
                    	<div class="form546_title"><span class="fc_red">*</span>邮&nbsp;&nbsp;箱：</div>
                        <div class="lfloat">
                        	<input type="text" id="email" name="email" class="width416 radius5" />
                        </div>
                        <div class="clra"></div>
                        <div class="form546_ts" id="tip">邮箱用来找回密码并且作为登陆账号</div>
                        <div class="verify_div">
                        	<div id="mobilePhoneTip" ></div>
                        </div>
                    </li>                                  
                	<li>
                    	<div class="form546_title"><span class="fc_red">*</span>图片验证码：</div>
                        <div class="upload_img3 mtop5">
                        	<div class="rupload5">
	                        	<input type="text" id="verifycode" name="verifycode" class="radius5" />
								<img id="imageCode" class="upload_verifycode_img" src="?s=/Login/showImage" title="看不清可单击图片刷新" onclick="changeImg()"/>   
							</div> 
	                        <div class="clra"></div>
	                        <div class="form546_ts" id="tip">请填写图片中的字母</div>
	                        <div class="verify_div">
	                        	<div id="mobilePhoneTip" ></div>
	                        </div>							                	
                        </div>
                    </li>     
                </ul>
            </div>
            
            <div class="line1_div tlc">
            	<input type="submit" value="注册" class="green_btn1 radius5" onclick="check()"/>
            </div>
            <div class="clra"></div>      
            <div class="have_user">已有帐号，<a href="?s=Login/Login">点此登录</a></div>
        </div>
        </form>
    </div>
       <?php echo get_cms_ads('duilian_quanzhan');?>
   <?php echo get_cms_ads('fumeiti_quanzhan');?>
    <!--版权 开始-->
    <div class="bq">  
   		<?php echo ($copyright); ?>
        <p style="height:8px;"></p>

        Copyright © 2011 - 2016 <a href="<?php echo ($weburl); ?>"><?php echo ($webname); ?></a> Some Rights Reserved <?php echo ($icp); ?> <?php echo ($tongji); ?> <a href="<?php echo ($baidusitemap); ?>">sitemap</a> <a href="<?php echo ($googlesitemap); ?>">sitemap</a><br />
        <span style="display:none;"><script language="javascript" type="text/javascript" src="http://js.users.51.la/15665491.js"></script></span>
    </div>
    <!--版权 结束-->
</div>

</body>
</html>