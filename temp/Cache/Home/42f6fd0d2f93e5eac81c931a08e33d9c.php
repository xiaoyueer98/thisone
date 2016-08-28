<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($webtitle); ?></title>
<meta name="keywords" content="<?php echo ($ckeywords); ?>">
<meta name="description" content="<?php echo ($cdescription); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>pub.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>yiku.css"/>
<script language="javascript">var SitePath='<?php echo ($webpath); ?>';var SiteMid='<?php echo ($mid); ?>';var SiteCid='<?php echo ($cid); ?>';var SiteId='<?php echo ($id); ?>';</script>
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


<!--wapper 开始-->
<div class="wapper">
	<!--当前位置 开始-->
    <div class="dq">
        当前位置：<?php echo ($navtitle); ?>
    </div>
    <!--当前位置 结束-->
	<!--详情 开始-->
    <div class="xq">
        <!--左边 开始-->
        <div class="left2">
            <!--电视简介 开始-->
            <div class="left2-1">
                <div class="ds">
                	<span class="img1"><img onerror="this.src='<?php echo ($webpath); ?>views/images/nophoto.jpg'" src="<?php echo ($picurl); ?>" /></span>
                    <div class="ds1">
                    
<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<a class="bds_qzone"></a>
<a class="bds_tsina"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_t163"></a>
<span class="bds_more">更多</span>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=703427" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
		
function to_play(url){
	window.open(url);
}
</script>

<!-- Baidu Button END -->                    
                    
                    
                    </div>
                    <!--  
                    <span class="tishi">分享视频后，播放时会加速哦!</span>
                    -->
                </div>
                
                <div class="ds2">
                	<h1><?php echo ($title); ?> <span style="font-size:12px; color:#F30"><?php if($serial > 0): ?>更新至<?php echo ($serial); ?><?php else: ?>完结<?php endif; ?></span></h1>
                    <div class="ds2-1">
                    	<span>主讲：</span>
                        <p><?php if(!empty($actor)): ?><?php echo ($actor); ?><?php else: ?>未知<?php endif; ?></p>
                        <div class="clear"></div>
                    </div>
                    <div class="ds2-1">
                    	<?php if($ctype == 'live'): ?><span>开始:</span>
                    		<p><?php if(!empty($starttime)): ?><?php echo (date('Y年m月d日 H:i:s',$starttime)); ?><?php else: ?>未知<?php endif; ?></p>
                    		<span>结束:</span>
                    		<p><?php if(!empty($endtime)): ?><?php echo (date('Y年m月d日 H:i:s',$endtime)); ?><?php else: ?>未知<?php endif; ?></p>
                    	<?php else: ?>
                    		<span>摄影：</span>
                    		<p><?php if(!empty($actor)): ?><?php echo (get_actor_url($actor)); ?><?php else: ?>未知<?php endif; ?></p><?php endif; ?>
                        <div class="clear"></div>
                    </div>
                    <div class="ds2-1">
                    	<span>类型：</span>
                        <p><a href="<?php echo ($showurl); ?>"><?php echo ($cname); ?></a> <?php echo (eku_stype_url($stype_mcid,$cid)); ?></span></p>
                        <div class="clear"></div>
                    </div>
                    <!--  
                    <div class="ds2-1">
                    	<span>年代：</span>
                        <p><?php echo (($year)?($year):'未录入'); ?></p>
                        <div class="clear"></div>
                    </div>
                    -->
                    <div class="ds2-1">
                    	<span>评分：</span>
                        <p id="Scores" alttext="<?php echo ($score); ?>" title="我也来评分">加载中...
                        </p>
                        <div class="clear"></div>
                    </div>
                    
                </div>
                <div class="clear"></div>
            </div>
            <!--电视简介 结束-->

            <div class="like">
                <div id="tab" class="tab">
                    <div class="on" title="播放" onclick="change(this)"><span>播放</span></div>
                    <!--  
                    <?php if(is_array($ppplay)): $i = 0; $__LIST__ = $ppplay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 )?><div id="play_name_<?php echo ($i); ?>" <?php if($i == 1): ?>class="on"<?php else: ?>class="off"<?php endif; ?> title="<?php echo ($video["playername"]); ?>" onclick="video_detail_tag_change(<?php echo ($i); ?>,10,'play_name_','play_ji_','on','off','show','hide')"><span><?php echo ($video["playername"]); ?></span></div><?php endforeach; endif; else: echo "" ;endif; ?> 
                    -->   
                </div>
                
                <?php if(is_array($ppplay)): $i = 0; $__LIST__ = $ppplay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 )?><div id="play_ji_<?php echo ($i); ?>" <?php if($i == 1): ?>class="show"<?php else: ?>class="hide"<?php endif; ?>>
 						<!--  
                        <div class="like1-2"><span class="on5">正序</span>
                        	<span onclick="document.getElementById('play_ji_<?php echo ($i); ?>').className = 'hide';document.getElementById('play_ji_desc_<?php echo ($i); ?>').className = 'show';">倒序</span>
                        </div>
						-->
                        
                        <!--剧集 开始-->
	                        <div class="juji">
		                        	<?php if(is_array($video['son'])): $ii = 0; $__LIST__ = $video['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ppvodson): ++$ii;$mod = ($ii % 2 )?><?php if($ppvodson['playcount'] == 1): ?><img src="<?php echo ($tplpath); ?>images/play_icon.png" onmouseover="this.src='<?php echo ($tplpath); ?>images/play_icon_on.png'" onmouseout="this.src='<?php echo ($tplpath); ?>images/play_icon.png'" style="cursor:pointer;" onclick="to_play('<?php echo ($webpath); ?>?s=video/play/id/<?php echo ($id); ?>/ver/-1/ctype/<?php echo ($ctype); ?>');"></img>
		                        		 <?php else: ?>
				                             <?php if($ii == $ppvodson['playcount']): ?><a href="<?php echo ($webpath); ?>?s=video/play/id/<?php echo ($id); ?>/ver/<?php echo ($ii); ?>/ctype/<?php echo ($ctype); ?>" target="_blank" style="background-color:#999;"><?php echo ($ppvodson["playname"]); ?></a>
				                             <?php else: ?>
				                            	 <a href="<?php echo ($webpath); ?>?s=video/play/id/<?php echo ($id); ?>/ver/<?php echo ($ii); ?>/ctype/<?php echo ($ctype); ?>" target="_blank"><?php echo ($ppvodson["playname"]); ?></a><?php endif; ?><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>
		                    </div>
                        	<div class="clear"></div>
                        <!--剧集 结束-->
                        
                        <div class="clear">&nbsp;</div>
                    </div>
                    
                    <!--<div <?php if($hasver == 1): ?>class="show"<?php else: ?>class="hide"<?php endif; ?>>
                        剧集 开始
                        <div class="juji">
	                        	<?php if(is_array($vers)): $ii = 0; $__LIST__ = $vers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$ii;$mod = ($ii % 2 )?><?php if($ii == 1): ?><a href="<?php echo ($webpath); ?>?s=video/play/id/<?php echo ($id); ?>/ver/<?php echo ($ii); ?>/ctype/<?php echo ($ctype); ?>" target="_blank" style="background-color:#999;">第<?php echo ($ii); ?>节</a>
		                            <?php else: ?>
		                            	<a href="<?php echo ($webpath); ?>?s=video/play/id/<?php echo ($id); ?>/ver/<?php echo ($ii); ?>/ctype/<?php echo ($ctype); ?>" target="_blank">第<?php echo ($ii); ?>节</a><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>
                            <div class="clear"></div>
                        </div>
                        剧集 结束
                        <div class="clear">&nbsp;</div>
                    </div>--><?php endforeach; endif; else: echo "" ;endif; ?> 
            </div>     
	            <div class="like">
	                <div id="tab" class="tab">
	                    <?php if($ctype == 'live'): ?><div class="on" title="直播介绍" onclick="change(this)"><span>直播介绍</span></div>
	                    <?php else: ?>
	                    	<div class="on" title="视频介绍" onclick="change(this)"><span>视频介绍</span></div><?php endif; ?>
	                </div>

		           <div>	
		                <?php if($content == ''): ?><p style="padding:10px; line-height:24px;max-height:200px; overflow-y:auto; height:auto !important;">
		                    	暂无此视频的介绍信息
		                    </p>
	                	<?php else: ?>
		                	<p style="padding:10px; line-height:24px;max-height:200px; overflow-y:auto; height:auto !important;">
		                    	<?php echo (htmlspecialchars_decode($content)); ?>
		                    </p><?php endif; ?>
		           </div>
	                 
	            </div>
           
            
            <!--猜你喜欢 开始-->
            <div class="like">
                <div id="tab" class="tab">
                    <div class="on" title="猜你喜欢" onclick="change(this)"><span>猜你喜欢</span></div>
                </div>
                <!--最近更新 开始-->
                <div id="猜你喜欢" class="show">
                    <ul class="rb2-1 list1-1" id="hot_video" href="<?php echo ($webpath); ?>index.php?s=my/show/id/hot_video/cid/<?php echo ($cid); ?>/limit/5">
                    Loading...
                    </ul>
                    <div class="clear" style="height:15px;">&nbsp;</div>
                </div>
                <!--最近更新 结束-->
            </div>
            <!--猜你喜欢 结束-->
            <!--评论 开始-->
            
            <div class="like">
                <div id="tab" class="tab">
                    <div class="on" title="网友评论" onclick="change(this)"><span>网友评论</span></div>
                </div>
                
                <div style="padding:10px;">	
                    <!-- UY BEGIN -->
                    <div id="uyan_frame"></div>
                    <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=<?php echo ($youyan_id); ?>"></script>
                    <!-- UY END -->
                </div>
                
            </div>
            
            
            <!--评论 结束-->
        </div>
        <!--左边 结束-->
        <!--右边 开始-->
        <div class="right3">
            <!--电视剧热播榜 开始-->
            <div class="right1 left1-1">
            <div class="bg">
            	<h1><span><?php echo ($cname); ?>热播榜</span></h1>
                <!--热榜 开始-->
                <ul class="ph2">
                <?php $tag['name'] = 'video';$tag['cid'] = ''.$cid.'';$tag['limit'] = '10';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?> ><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank"><?php echo ($video["title"]); ?></a><span><?php echo ($video["hits"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>   
                    
                </ul>
                <!--热榜 结束-->
            </div>
            </div>
            <!--电视剧热播榜 结束-->
            <!--广告 开始-->
            <div class="banner1"><?php echo get_cms_ads('video_info_right_250_250');?></div>
            <!--广告 结束-->
            <!--广告 开始-->
            <div class="banner1"><?php echo get_cms_ads('video_info_right_250_250_2');?></div>
            <!--广告 结束-->
        </div>
        <!--右边 结束-->
        <div class="clear"></div>
    </div>
    <!--详情 结束-->
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