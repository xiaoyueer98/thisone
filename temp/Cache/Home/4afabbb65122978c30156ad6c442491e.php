<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($description); ?>">
<title><?php echo ($webtitle); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>pub.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>yiku.css"/>
<script type="text/javascript" src="js/tab.js"></script>
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
    	 <?php if($username == ''): ?><a href="javascript:void(0)" id="login_btn">登录</a><a href="avascript:void(0)" id="reg_btn" >注册</a> 
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
        <form action="form_action.asp" method="get">
            <ul>
                <li class="error"><p>账号或密码错误</p></li>
                <li><input id="user" name="user" type="text" placeholder="用户名"/></li>
                <li><input id="pswd" name="pswd" type="text" placeholder="密码"/></li>
                <li class="fix">
                    <input class="fl_l" id="vCode" name="vCode" type="text" placeholder="请输入验证码"/>
                    <span class="fl_r"><img src="/video/template/default/images/yzm.png"></span>
                </li>
            </ul>
            <div class="backpswd_btn_con fix">
                <a href="" class="register_btn fl_l">还没账号，点此注册</a>
                <a href="" class="backpswd_btn2 fl_r">忘记密码</a>
            </div>
            <input type="submit" class="submit_btn" id="Submit" value="登录" />
        </form>
    </div>
    <div class="register_con disun">
        <form action="form_action.asp" method="get">
            <ul>
                <li class="error"><p>账号或密码错误</p></li>
                <li><input id="user" name="user" type="text" placeholder="用户名"/></li>
                <li><input id="pswd" name="pswd" type="text" placeholder="密码"/></li>
                <li class="fix">
                    <input class="fl_l" id="vCode" name="vCode" type="text" placeholder="请输入验证码"/>
                    <span class="fl_r"><img src="/video/template/default/images/yzm.png"></span>
                </li>
            </ul>
            <div class="xieyi fix">
                <span class="checked"></span>
                <p>我已阅读并同意相关服务条款</p>
            </div>
            <input type="submit" class="submit_btn" value="注册" id="Submit" />
        </form>
    </div>
</div>



<!--wapper 开始-->
<div class="wapper">
	<!--列表 开始-->
    <div class="list">
   		<!--左边 开始-->
        <div class="left1">
            <!--最近更新电视剧 开始-->
            <div class="right1 left1-1">
            <div class="bg">
            	<h1><span>最近更新<?php echo ($cname); ?></span></h1>
                <!--热榜 开始-->
                <ul class="ph2">
                <?php $tag['name'] = 'video';$tag['cid'] = ''.$cid.'';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?>><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank"><?php echo ($video["title"]); ?></a><span>03-02</span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                </ul>
                <!--热榜 结束-->
            </div>
            </div>
            <!--最近更新电视剧 结束-->
            <!--电视剧热播榜 开始-->
            <div class="right1 left1-1">
            <div class="bg">
            	<h1><span><?php echo ($cname); ?>热播榜</span></h1>
                <!--热榜 开始-->
                <ul class="ph2">
                <?php $tag['name'] = 'video';$tag['cid'] = ''.$cid.'';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?>><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank"><?php echo ($video["title"]); ?></a><span><?php echo ($video["hits"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                </ul>
                <!--热榜 结束-->
            </div>
            </div>
            <!--电视剧热播榜 结束-->
            <!--广告 开始-->
            <div class="banner1">
            <?php echo get_cms_ads('list_250_250');?>
            </div>
            <!--广告 结束-->
        </div>
        <!--左边 结束-->
        <!--右边 开始-->
        <div class="right2">
            <div class="right2-1">
            	<span class="h1"><?php echo ($cname); ?></span><img src="<?php echo ($tplpath); ?>images/xian1.jpg" />
                <!--检索条件 开始-->
                <div class="right2-2">
                	<span> 共找到<strong> <?php echo ($count); ?></strong> 条与 <strong>"<?php echo ($keyword); ?></strong>" 的相关结果 </span>
                </div>
            </div>
            
            <!--最近更新 开始-->
            <div id="最近更新" class="show">
                <ul class="rb2-1 list1-1">
                <?php $tag['name'] = 'video';$tag['limit'] = '20';$tag['order'] = ''.$order.''; $__LIST__ = get_tag_gxsearch($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li>
                        <a href="<?php echo ($video["readurl"]); ?>" class="img" target="_blank"><span><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?><?php else: ?>完结<?php endif; ?></span><i></i><img src="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>"/></a>
                        <a href="<?php echo ($video["readurl"]); ?>" class="title" target="_blank"><?php echo ($video["title"]); ?></a>
                        <p class="title1"><?php echo (get_actor_url(get_replace_html($video["actor"],0,10))); ?></p>
                    </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>   
                    
                    
                </ul>
                <div class="clear">&nbsp;</div>
                <!----分页 开始---->
                <?php if($count > 10): ?><div class="pag"><?php echo ($pages); ?></div><?php endif; ?>
                <!----分页 结束---->
            </div>
            <!--最近更新 结束-->
            
            <!--列表 结束-->
        </div>
        <!--右边 结束-->
    </div>
    <!--列表 结束-->
<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/system.js"></script>
<script type="text/javascript" src="<?php echo ($tplpath); ?>yiku.js"></script>
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
<!--wapper 结束-->
</body>
</html>