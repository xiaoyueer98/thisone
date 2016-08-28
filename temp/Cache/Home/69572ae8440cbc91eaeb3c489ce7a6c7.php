<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($description); ?>">
<title><?php echo ($webtitle); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>pub.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>yiku.css?v1.0.7"/>
<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/jquery.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo ($webpath); ?>views/js/jquery.lazyload.js"></script>
<script type="text/javascript">
$(function() {
    $("img").lazyload({
        effect : "fadeIn"
    });
});
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


<div class="mybox">
<?php if($index_hdp_show == 1): ?><!--第一部分 开始-->
    <div class="main">
        <div id="bigbanner">
        <div id="banners">
        
            <div id="controls">
            <?php $tag['name'] = 'slide';$tag['fid'] = '1';$tag['order'] = 'oid asc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$slide): ++$i;$mod = ($i % 2 );?><li <?php if($i == 1): ?>class="active"<?php endif; ?>><a href="#" rel="banner-<?php echo ($i); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            </div>
            
            <?php $tag['name'] = 'slide';$tag['fid'] = '1';$tag['order'] = 'oid asc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$slide): ++$i;$mod = ($i % 2 );?><div class="banner_n <?php if($i == 1): ?>current<?php endif; ?>" id="banner-<?php echo ($i); ?>" >
                <a href="<?php echo ($slide["link"]); ?>" target="_blank"><img src="<?php echo ($slide["picurl"]); ?>" alt="<?php echo ($slide["title"]); ?>" width="100%" height="100%"/></a>
            </div><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
        </div>
    </div>   
        <!--右边 开始-->
        <div class="rb">
            <div class="rb1">
                <span class="on1" id="index_new_tag_1" onmouseover="video_index_tag_change(1,4,'index_new_tag_','index_new_tag_list_','on1','','ph1','ph1')">更新</span>
                <span id="index_new_tag_2" onmouseover="video_index_tag_change(2,4,'index_new_tag_','index_new_tag_list_','on1','','ph1','ph1')">直播</span>
                <span id="index_new_tag_3" style="width:52px;" onmouseover="video_index_tag_change(3,4,'index_new_tag_','index_new_tag_list_','on1','','css1','ph1')">点播</span>
                <span id="index_new_tag_4" onmouseover="video_index_tag_change(4,4,'index_new_tag_','index_new_tag_list_','on1','','ph1','ph1')">电视</span>
                <!--  
                <span id="index_new_tag_5" onmouseover="video_index_tag_change(5,5,'index_new_tag_','index_new_tag_list_','on1','','ph1','ph1')">虚拟直播</span>
                -->
                <div class="clear"></div>
            </div>
            
            <!--更新 开始-->
            <ul class="ph1" id="index_new_tag_list_1" style="display:block;">   
            <?php $tag['name'] = 'video';$tag['cid'] = '1,2,3,4,5,6';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li class="css1" ><span <span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?>><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo (get_replace_html($video["title"],0,8)); ?></a><span><?php echo (get_color_date('m-d',$video["addtime"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            </ul>
            <!--更新 结束-->
            
            <!--电影 开始-->
            <ul class="ph1" id="index_new_tag_list_2" style="display:none;">
                <?php $tag['name'] = 'video';$tag['cid'] = '1';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li class="css1"><span <span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?>><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo (get_replace_html($video["title"],0,8)); ?></a><span><?php echo (get_color_date('m-d',$video["addtime"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            </ul>
            <!--电影 结束-->
            <!--电视剧 开始-->
            <ul class="ph1" id="index_new_tag_list_3" style="display:none;">
                <?php $tag['name'] = 'video';$tag['cid'] = '2';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li class="css1"><span <span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?>><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo (get_replace_html($video["title"],0,8)); ?></a><span><?php echo (get_color_date('m-d',$video["addtime"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            </ul>
            <!--电视剧 结束-->
            <!--动漫 开始-->
            <ul class="ph1" id="index_new_tag_list_4" style="display:none;">
                <?php $tag['name'] = 'video';$tag['cid'] = '3';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li class="css1"><span <span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?>><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo (get_replace_html($video["title"],0,8)); ?></a><span><?php echo (get_color_date('m-d',$video["addtime"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            </ul>
            <!--动漫 结束-->
            
            <!--
            <ul class="ph1" id="index_new_tag_list_5">
                <?php $tag['name'] = 'video';$tag['cid'] = '3';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li class="css1"><span <span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?>><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo (get_replace_html($video["title"],0,8)); ?></a><span><?php echo (get_color_date('m-d',$video["addtime"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            </ul>
            -->
            
        </div>
        <!--右边 结束-->
        
    </div>
    <!--第一部分 结束--><?php endif; ?> 
<div class="zjrb">
    <img src="/video/template/default/images/icon002.png">
</div>
<div class="rb2">
    <ul class="rb2-1">
        <?php $tag['name'] = 'self';$tag['cid'] = '5';$tag['limit'] = '5'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$self): ++$i;$mod = ($i % 2 );?><li>
                <a href="<?php echo ($self["link"]); ?>" target="_blank" class="img"><img src="<?php echo ($self["picurl"]); ?>" alt="<?php echo ($self["title"]); ?>" /></a>
                <a href="<?php echo ($self["link"]); ?>" class="title" target="_blank"><?php echo ($self["title"]); ?></a>
                <p><?php echo ($self["content1"]); ?></p>
            </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>    
    </ul>
</div>
<!--wapper 开始-->

   
    
    
    <!--最近热播 开始-->
    
    <!--最近热播 结束-->
    <!--广告 开始-->
    <!--  
    <div class="banner"><?php echo get_cms_ads('inde_960_90');?></div>
    -->
    <!--广告 结束-->
    <!--板块 开始-->
    <div class="wapper">
        <div class="main1">
            <div class="left">
                <div class="dy">
                    <div class="dy1 con_head zhibo">
                        <div class="fl_l head_l">
                            <label></label>
                            <span><?php echo get_channel_name(1);?></span>
                            <em>LIVE VIDEO</em>
                        </div>
                        <div class="fl_r head_r">
                            <a href="<?php echo get_channel_name(1,'showurl');?>" target="_blank" class="mor">MORE>></a>
                            <p>
                                <?php $tag['name'] = 'menu';$tag['ids'] = '1'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($menuson["showurl"]); ?>" target="_blank"><?php echo ($menuson["cname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                            </p>
                        </div>
                    </div>
                    <ul class="rb2-1 dy1-2">
                    
                    <?php $tag['name'] = 'video';$tag['cid'] = '1';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li>
                            <a href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>" class="img"><img  onerror="this.src='<?php echo ($webpath); ?>views/images/nophoto.jpg'" src="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>" /></a>
                            <a href="<?php echo ($video["readurl"]); ?>" target="_blank" class="title"><?php echo (get_replace_html($video["title"],0,10)); ?></a>
                            <p><?php echo (get_actor_url(get_replace_html($video["actor"],0,10))); ?></p>
                        </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>   
                        
                    </ul>
                </div>
            </div>
            <div class="right">
                <div class="right1">
                    <div class="r_con zhibo">
                        <h1>
                            <span>热门直播榜</span>
                            <label>HOT VIDEO</label>
                        </h1>
                        <!--热榜 开始-->
                        <ul class="ph2">
                            <?php $tag['name'] = 'video';$tag['cid'] = '1';$tag['limit'] = '10';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?> ><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank"><?php echo ($video["title"]); ?></a><span><?php echo ($video["hits"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                        </ul>
                        <!--热榜 结束-->
                    </div>
                
                </div>
                <!--热播直播榜 结束-->
                   <!--  <?php $tag['name'] = 'self';$tag['cid'] = '6';$tag['limit'] = '2'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$self): ++$i;$mod = ($i % 2 );?><div class="pic"><a href="<?php echo ($self["link"]); ?>" target="_blank" ><img src="<?php echo ($self["picurl"]); ?>" alt="<?php echo ($self["title"]); ?>" /></a></div><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>        -->   
                <!--热播点播榜 开始-->
            </div>
        </div>
        <div class="main1">
            <!--左边 开始-->
            <div class="left">
                <!--点播 开始-->
                <div class="dy">
                    <div class="dy1 con_head dianbo">
                        <div class="fl_l head_l">
                            <label></label>
                            <span><?php echo get_channel_name(2);?></span>
                            <em>LIVE VIDEO</em>
                        </div>
                        <div class="fl_r head_r">
                            <a href="<?php echo get_channel_name(2,'showurl');?>" target="_blank" class="mor">MORE>></a>
                            <p>
                                <?php $tag['name'] = 'menu';$tag['ids'] = '2'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($menuson["showurl"]); ?>" target="_blank"><?php echo ($menuson["cname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                            </p>
                        </div>
                    </div>
                    <ul class="rb2-1 dy1-2">
                    
                    <?php $tag['name'] = 'video';$tag['cid'] = '2';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li>
                            <a href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>" class="img"><img  onerror="this.src='<?php echo ($webpath); ?>views/images/nophoto.jpg'" src="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>" /></a>
                            <a href="<?php echo ($video["readurl"]); ?>" target="_blank" class="title"><?php echo (get_replace_html($video["title"],0,10)); ?></a>
                            <p><?php echo (get_actor_url(get_replace_html($video["actor"],0,10))); ?></p>
                        </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>   
                    
                    </ul>
                </div>
                <!--点播 结束-->
            </div>
            <!--左边 结束-->
            <!--右边 开始-->
            <div class="right">
                <!--热播直播榜 开始-->
                
                <div class="right1">
                    <div class="r_con dianbo">
                        <h1>
                            <span>热门点播榜</span>
                            <label>HOT ON DEMAND</label>
                        </h1>
                        <!--热榜 开始-->
                        <ul class="ph2">
                            <?php $tag['name'] = 'video';$tag['cid'] = '2';$tag['limit'] = '10';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?> ><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank"><?php echo ($video["title"]); ?></a><span><?php echo ($video["hits"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                        </ul>
                        <!--热榜 结束-->
                    </div>
                </div>
                <!--热播点播榜 结束-->
                
                
                   <!--  <?php $tag['name'] = 'self';$tag['cid'] = '7';$tag['limit'] = '2'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$self): ++$i;$mod = ($i % 2 );?><div class="pic"><a href="<?php echo ($self["link"]); ?>" target="_blank" ><img src="<?php echo ($self["picurl"]); ?>" alt="<?php echo ($self["title"]); ?>" /></a></div><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>    --> 
                
                
            </div>
            <!--右边 结束-->
            <div class="clear"></div>
        </div>
        <!--板块 结束-->
        
        <!--广告 开始-->
        <!--  
        <div class="banner"><?php echo get_cms_ads('inde_960_90_2');?></div>
        -->
        <!--广告 结束-->
        
        <!--板块 开始-->
        <div class="main1">
            <!--左边 开始-->
            <div class="left">
                <!--综艺 开始-->
                <!--  
                <div class="dy dy2">
                    <div class="dy1">
                        <span class="dy1-1"><?php echo get_channel_name(4);?></span>
                        <a href="<?php echo get_channel_name(4,'showurl');?>" target="_blank" class="more"></a>
                        <p>
                            <?php $tag['name'] = 'menu';$tag['ids'] = '4'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($menuson["showurl"]); ?>" target="_blank"><?php echo ($menuson["cname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                        </p>
                    </div>
                    <ul class="rb2-1 dy1-2">
                    
                    <?php $tag['name'] = 'video';$tag['cid'] = '4';$tag['limit'] = '5';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li>
                            <a href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>" class="img"><img  onerror="this.src='<?php echo ($webpath); ?>views/images/nophoto.jpg'" src="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>" /></a>
                            <a href="<?php echo ($video["readurl"]); ?>" target="_blank" class="title"><?php echo (get_replace_html($video["title"],0,10)); ?></a>
                            <p><?php echo (get_actor_url(get_replace_html($video["actor"],0,10))); ?></p>
                        </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>   
                    
                    </ul>
                </div>
                -->
                <!--综艺 结束-->
                <!--动漫 开始-->
                <div class="dy dy2">
                    
                    <div class="dy1 con_head wangluo">
                        <div class="fl_l head_l">
                            <label></label>
                            <span><?php echo get_channel_name(3);?></span>
                            <em>LIVE VIDEO</em>
                        </div>
                        <div class="fl_r head_r">
                            <a href="<?php echo get_channel_name(3,'showurl');?>" target="_blank" class="mor">MORE>></a>
                            <p>
                                <?php $tag['name'] = 'menu';$tag['ids'] = '3'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($menuson["showurl"]); ?>" target="_blank"><?php echo ($menuson["cname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                            </p>
                        </div>
                    </div>
                    <ul class="rb2-1 dy1-2">
                    <?php $tag['name'] = 'video';$tag['cid'] = '3';$tag['limit'] = '5';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li>
                            <a href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>" class="img"><img  onerror="this.src='<?php echo ($webpath); ?>views/images/nophoto.jpg'" src="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>" /></a>
                            <a href="<?php echo ($video["readurl"]); ?>" target="_blank" class="title"><?php echo (get_replace_html($video["title"],0,10)); ?></a>
                            <p><?php echo (get_actor_url(get_replace_html($video["actor"],0,10))); ?></p>
                        </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>   
                    </ul>
                </div>
                <!--动漫 结束-->
            </div>
            <!--左边 结束-->
            <!--右边 开始-->
            <div class="right">
                <!--综艺热播榜 开始-->
                <!--  
                <div class="right1 right1-1">
                    <div class="bg">
                        <h1><span>综艺热播榜</span></h1>
                 -->
                        <!--热榜 开始-->
                        <!--  
                        <ul class="ph2">
                            <?php $tag['name'] = 'video';$tag['cid'] = '4';$tag['limit'] = '10';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?> ><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank"><?php echo ($video["title"]); ?></a><span><?php echo ($video["hits"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                        </ul>
                       -->
                        <!--热榜 结束-->
                <!--
                    </div>
                </div>
                -->
                <!--综艺热播榜 结束-->
                <!--动漫热播榜 开始-->
                <div class="right1 right1-1">
                <div class="r_con dainshi">
                    <h1>
                        <span>电视热播榜</span>
                        <label>HOT TV</label>
                    </h1>
                    <!--热榜 开始-->
                    <ul class="ph2">
                        <?php $tag['name'] = 'video';$tag['cid'] = '3';$tag['limit'] = '10';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?> ><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank"><?php echo ($video["title"]); ?></a><span><?php echo ($video["hits"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                    </ul>
                    <!--热榜 结束-->
                </div>
                </div>
                <!--动漫热播榜 结束-->
            </div>
            <!--右边 结束-->
            <div class="clear"></div>
        </div>
        <!--板块 结束-->
    </div>
    
</div>
    <!--友情链接 开始-->
    <div class="footer">
       	<div class="footer_con fix">
            <div class="dl_con fix">
                <dl class="fl_l fix">
                    <dt>方讯科技</dt>
                    <dd>
                        <a href="">首&nbsp&nbsp页</a>
                        <a href="">视频直播</a>
                        <a href="">视频点播</a>
                        <a href="">网络电视</a>
                        <a href="">网络电台</a>
                        <a href="">网络监控</a>
                    </dd>
                </dl>
                <dl class="fl_r fix">
                    <dt>友情链接</dt>
                    <dd>
                        <?php $tag['name'] = 'link';$tag['limit'] = '100';$tag['order'] = 'type asc,oid desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): ++$i;$mod = ($i % 2 );?><a href="<?php echo ($link["url"]); ?>" target="_blank"><?php echo (get_replace_html($link["title"],0,8)); ?></a><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="lines"></div>
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
    <!--友情链接 结束-->
<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/system.js"></script>
<script type="text/javascript" src="<?php echo ($tplpath); ?>yiku.js"></script>
<script>
    $(document).ready(function(){
	$("#controls li a").click(function(){
        /*Performed when a control is clicked */
	    shuffle();
	    var rel = $(this).attr("rel");
	    if ( $("#" + rel).hasClass("current") ){
	        return false;
	    }
        /* Bug Fix, thanks Dave -> added .stop(true,true) 
            to stop any ongoing animation */
	    $("#" + rel).stop(true,true).show();
	    $(".current").fadeOut().removeClass("current");
	    $("#" + rel).addClass("current");
	    $(".active").removeClass("active");
	    $(this).parents("li").addClass("active");
	    set_new_interval(5000);
	    return false;
	});
	/* 
	* Optional Pause on Hover Feature 
	* Comment out to use it
	* Thanks, Andrew 
	*/
	/*$('.banner').hover(function() {
			clearInterval(slide);
		}, function () {
			slide = setInterval( "banner_switch()", 7000 );
	});*/
    });
    function banner_switch(){
        /*This function is called on to switch the banners out when the time limit is reached */
        shuffle();
        var next = $('.banner_n.current').next('.banner_n').length ? 
            $('.banner_n.current').next('.banner_n') : $('#banners .banner_n:first');
        $(next).show();
        $(".current").fadeOut().removeClass("current");
        $(next).addClass("current");
        var next_link = $(".active").next("li").length ? $('.active').next('li') : $('#controls li:first');
        $(".active").removeClass("active");
        $(next_link).addClass('active');
    }
    $(function() {
        /*Initial timer setting */
        slide = setInterval("banner_switch()", 5000);
    });
    function set_new_interval(interval){
        /*Simply clears out the old timer interval and restarts it */
        clearInterval(slide);
        slide = setInterval("banner_switch()", interval);
    }
    function shuffle(){
        /*This function takes every .banner and changes the z-index to 1, hides them,
            then takes the ".current" banner and brings it above and shows it */
        $(".banner_n").css("z-index", 1).hide();
        $(".current").css("z-index", 2).show();
    }
    </script>
	 

<!--wapper 结束-->
</body>
</html>