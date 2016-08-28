<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的评论-<?php echo ($webname); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>style.css?v1.0.10"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>pub.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>yiku.css"/>

<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/system.js"></script>
<script type="text/javascript" src="<?php echo ($tplpath); ?>yiku.js"></script>

</head>
<body>
<div class="width1000">
<?php
	$username = $_SESSION['force_user'];
?>

<script language="javascript">
var SitePath='<?php echo ($webpath); ?>';var SiteMid='<?php echo ($mid); ?>';var SiteCid='<?php echo ($cid); ?>';var SiteId='<?php echo ($id); ?>'; var username='<?php echo ($username); ?>';

function ekusearch()
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
<!--头部 开始-->
<div class="top">
	<a href="<?php echo ($webpath); ?>" class="logo"></a>
    <!--搜索 开始-->
	<div class="ss">
    	<div class="ss1">
        	<div id="searchSuggestContent" class="ss1-1"></div>
        	<form id="searchForm" name="searchForm" method="post" action="<?php echo getsearchurl();;?>">
        	<p>
                <img src="<?php echo ($tplpath); ?>images/tb1.jpg" />
                <input id="wd" name="wd"  autocomplete="off"type="text" <?php echo (($keyword)?($keyword):'请输入关键字'); ?> />
            </p>
            <a href="javascript:void(0);" onclick="ekusearch();"></a>
            </form>
        </div>
        <div class="ss2">
            <?php echo ($hotkey); ?>
        </div>
    </div>
    <!--搜索 结束-->
    <a href="<?php echo ($webpath); ?>index.php?s=top10" class="ph"></a>
    <div class="top1">
    	 <?php if($username == ''): ?><a href="javascript:login()" id="login_btn">登录</a>|<a href="javascript:register()" id="reg_btn" >注册</a> 
	    	 
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
<!--头部 结束-->
<!--导航 开始-->
<div class="nav">
	<div class="nav1">
		<div class="nav1-1">
            <a href="<?php echo ($webpath); ?>" <?php if($model == 'index'): ?>class="on"<?php endif; ?>>首页</a><span></span>
            
            <?php $tag['name'] = 'menu'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><a onfocus="this.blur();" href="<?php echo ($menu["showurl"]); ?>" <?php if(($menu['id'] == $cid) or ($menu['id'] == $pid)): ?>class="on"<?php endif; ?>><?php echo ($menu["cname"]); ?></a><span></span><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            <!--  
            <a href="<?php echo getspecialurl();;?>">专题</a>
            <a href="/index.php?s=tv">直播</a>
            -->
		</div>
		<!--  
        <p class="nav1-2">
        
        <?php $tag['name'] = 'self';$tag['cid'] = '9';$tag['limit'] = '4'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$self): ++$i;$mod = ($i % 2 );?><a href="<?php echo ($self["link"]); ?>"target="_blank" style="color:<?php echo ($self["color"]); ?>"><?php echo ($self["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>    
            
        </p>
        -->
	</div>
</div>
<!--导航 结束-->

	<div class="sub_breadcrumb_nav"></div>
    <div class="sub_main">
      <form action="web_dpu.xhtml" method="post" name="resForm"
				id="resForm" autocomplete="off">
		<div class="sub_main_title">个人中心</div>
    	<div class="sub_content pad_tb user_show">
	    	<div class="user_left">
				<h3><a href="?s=User/Fusershow">用户中心首页</a></h3>
<h4>我的</h4>
<ul>
<li><a href="?s=User/Myvod">可观看视频</a></li>
<li><a href="?s=User/Mylive">我的直播</a></li>
</ul>
<h4>操作记录</h4>
<ul>
<li><a href="?s=User/Vodhistory">观看记录</a></li>
<li><a href="?s=User/Livehistory">直播记录</a></li>
</ul>
<h4>管理信息</h4>
<ul>
<li><a href="?s=User/Guestbook">留言信息</a></li>
<li><a href="?s=User/Comment">评论信息</a></li>
</ul>
<!--  
<h4>积分管理</h4>
<ul>
<li><a href="?s=User/Shop">积分充值</a></li>
<li><a href="?s=User/Views">消费记录</a></li>
<li><a href="?s=User/Changepay">消费模式</a></li>
</ul>
-->
<h4>管理帐户</h4>      
<ul>
<li><a href="?s=User/Edit">修改资料</a></li>
<li><a href="?s=User/Logout">退出登录</a></li>
</ul>
			</div>
			<div class="user">
			    <h3><span style="float:right">共<?php echo ($count_video); ?>条直播记录</span>我的直播记录</h3> 
			    <?php if(is_array($list_video)): $i = 0; $__LIST__ = $list_video;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><ul style="margin-bottom:10px; clear:both">
			    <li>评论内容：<span style="font-size:12px;color:#333"><?php echo (remove_xss(htmlspecialchars($gxcms["content"]))); ?></span></li>
			    <li style="color:#999999">视频信息：<span style="font-size:12px"><?php if(($gxcms["status"])  ==  "1"): ?>已审核<?php else: ?><font color="red">未审核</font><?php endif; ?> <?php echo (date('Y-m-d H:i:s',$gxcms["addtime"])); ?></span> </li>
			    </ul><?php endforeach; endif; else: echo "" ;endif; ?> 
			    <ul class="pages"><?php if(!empty($list_comment)): ?><div class="comm-pager"><?php echo ($pages); ?></div><?php else: ?>没有直播记录。<?php endif; ?></ul>
			</div>
		</div>
	</form>	
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
</body>
</html>