<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>方讯--用户注册</title>
<meta name="keywords" content="方讯" />
<meta name="description" content="方讯" />
<jsp:include page="../webpage/jq_css.jsp" ></jsp:include>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>style.css?v1.0.3"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>pub.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>yiku.css"/>

<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/system.js"></script>
<script type="text/javascript" src="<?php echo ($tplpath); ?>yiku.js"></script>

 <?php 
 session_start();                                   //用于在$_SESSION中获取验证码的值
?>

<script type="text/javascript">
$(document).ready(function() {
	if($("input[type='text']").val()=="请输入正确的手机号"){
		$("input[type='text']").css({color:"#aaa"});
		$("textarea").css({color:"#aaa"});
	}
	input_init();
	function input_init(){
		$("input[type='text']").focus(function(){
			$(this).css({color:"#666"});
			if($(this).val()==this.defaultValue){ 
				$(this).val(""); 
			} 
		}).blur(function(){
			if($(this).val()=='') {
				$(this).val(this.defaultValue);
				$(this).css({color:"#aaa"});
			}
		});
	}
	
	$("body").keypress(function(e) { 
		if (e.which == 13) { 
			submit();
		} 
	}); 


});

function submit(){
		if ($("#ue").val() && $("#pd").val()) {
			var ue = $("#ue").val();
			var pd = $("#pd").val();
			
			$.ajax({
				type:"get",
				url: "?s=login/ajaxcheck/username/" + ue + "/userpwd/" + pd,
		        dataType: "json",
		        async: true,
		        success: function (data) {
					if(data){
						document.location=home;
					}else{
						alert(data.msg);
						$("#pd").val("");
					}
		        },
		        error:function(XMLHttpRequest, textStatus, errorThrown){
		        	alert("服务器正忙，请稍后再试。给您带来的不便，请您谅解!");
		        }
		    });
		}else{
			if($("#ue").val() ==""){
				alert("请输入用户名!");
				return false;
			}
			if($("#pd").val() ==""){
				alert("请输入密码!");
				return false;
			}
		}
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
                <li><input id="email" name="email" type="text" placeholder="邮箱"/></li>
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
    	<div class="sub_main_title">登录</div>
    	<div class="sub_content pad_b">
        	<div class="sub_login">
        		<form action="?s=Login/ajaxcheck" method="post">
            	<ul>
                	<li>
                        <div>
                        	<input type="text" id="username" name="username" class="sub_login_user radius5" value="请输您的邮箱" />
                        </div>
                        <div class="clra"></div>
                        <div class="verify_div">&nbsp;</div>
                    </li>
                    <li>
                        <div>
                        	<input type="password" id="userpwd" name="userpwd" class="sub_login_password radius5" />
                        </div>
                        <div class="clra"></div>
                        <div class="verify_div">&nbsp;</div>
                    </li>
                    <li>
                    	<input type="submit" value="登录" class="orange_btn radius5" />
                    </li>
                    <li class="sub_login_link">
                    	<div class="lfloat">还没有帐号，<a href="?s=Login/Register">点此注册</a></div>
            			<div class="rfloat"><a href="?s=Login/fog_pwd">忘记密码</a></div>
                    </li>
                </ul>
                </form>
                <div class="clra"></div>
            </div>
            
            <div class="sub_other_line"><div>使用其他帐号登录</div></div>
            <ul class="sub_other_link">
            	<li><a href="#" class="weixin" onclick="loginWithSnp('weixin');"></a><div>微信</div></li>
                <li><a href="javascript:;" class="qq" onclick="loginWithSnp('qq');"></a><div>QQ</div></li>
                <li><a href="#" class="weibo" onclick="loginWithSnp('weibo');"></a><div>微博</div></li>
            </ul>
            
            <div class="clra"></div>
        </div>
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

<!-- QQLogin -S- -->
<script type="text/javascript">
/**跳转链接*/
var g = function (url) {
	location.href = url;
};
function loginWithSnp (snp) {
    switch (snp) {
    case "weixin":
//    	g("/web/tl_wxQrc.xhtml");
    	g("/web/tl_wxl.xhtml");
        break;
    case "qq":
    	g("/web/tl_qql.xhtml");
        break;
    case "weibo":
    	g("/web/tl_wbl.xhtml");
        break;
    }
}
</script>
</body>
</html>