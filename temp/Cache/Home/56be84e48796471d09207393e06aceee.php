<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($webtitle); ?></title>
<meta name="keywords" content="<?php echo ($ckeywords); ?><?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($cdescription); ?><?php echo ($description); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>pub.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>yiku.css"/>

<!--  
<script type="text/javascript" src="<?php echo ($webpath); ?>ck6/ckplayer.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo ($webpath); ?>jwplayer/jwplayer.js" charset="utf-8"></script>
-->

<script type="text/javascript" src="<?php echo ($webpath); ?>js/ntv_utils.js"></script>

<script type="text/javascript" src="<?php echo ($webpath); ?>jwplayer/jwplayer.js"></script>

 <!-- version 7 license key ---> 
<script type="text/javascript">jwplayer.key="38uAPADVt3eQaliBV2/DIi2ia+QhrVz0lhwLMg==";</script>

<!-- version 6 license key 
<script type="text/javascript">jwplayer.key="1EvDyEOEmASaZ4l1JdY3+WuYm+qrkzrBtucHrw==";</script>
--->

</head>

<body onLoad="InitDoc()" onUnload="close_player()" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">

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
<div class="mybox">
    <div class="wapper">
        <!--当前位置 开始-->
        <div class="dq">
            当前位置：<?php echo ($navtitle); ?> <?php echo ($playname); ?>
        </div>
        <!--当前位置 结束-->
        <!--播放 开始-->
        <div class="bf" style="text-align:center;background-color: #ff0000;">
              <!--
            <div class="bf1"><?php echo ($player); ?></div>
             -->
            <table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center" colspan="5" bgcolor="#000000">
                        <div id="fxplayer"></div>
                    </td>
                </tr>
            </table>
        </div>
        <!--播放 结束-->
        
        <!--详情 开始-->
        <div class="xq">
            <!--左边 开始-->
            <div class="left2">
            
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
                                        <?php if(is_array($video['son'])): $ii = 0; $__LIST__ = $video['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ppvodson): ++$ii;$mod = ($ii % 2 )?><?php if($ppvodson['playcount'] == 1): ?><img src="<?php echo ($tplpath); ?>images/play_icon.png" onmouseover="this.src='<?php echo ($tplpath); ?>images/play_icon_on.png'" onmouseout="this.src='<?php echo ($tplpath); ?>images/play_icon.png'" style="cursor:pointer;" onclick="to_play('<?php echo ($webpath); ?>?s=video/play/id/<?php echo ($id); ?>/ver/<?php echo ($ii); ?>/ctype/vod');"></img>
                                             <?php else: ?>
                                                 <?php if($ii == $ppvodson['playcount']): ?><a href="<?php echo ($webpath); ?>?s=video/play/id/<?php echo ($id); ?>/ver/<?php echo ($ii); ?>/ctype/vod" target="_blank" style="background-color:#999;"><?php echo ($ppvodson["playname"]); ?></a>
                                                 <?php else: ?>
                                                     <a href="<?php echo ($webpath); ?>?s=video/play/id/<?php echo ($id); ?>/ver/<?php echo ($ii); ?>/ctype/vod" target="_blank"><?php echo ($ppvodson["playname"]); ?></a><?php endif; ?><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                                <div class="clear"></div>
                            <!--剧集 结束-->
                            
                            <div class="clear">&nbsp;</div>
                        </div>
                        
                        <div <?php if($hasver == 1): ?>class="show"<?php else: ?>class="hide"<?php endif; ?>>
                            <!--剧集 开始-->
                            <div class="juji">
                                    <?php if(is_array($vers)): $ii = 0; $__LIST__ = $vers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$ii;$mod = ($ii % 2 )?><?php if($ii == 1): ?><a href="<?php echo ($webpath); ?>?s=video/play/id/<?php echo ($id); ?>/ver/<?php echo ($ii); ?>" target="_blank" style="background-color:#999;">第<?php echo ($ii); ?>节</a>
                                        <?php else: ?>
                                            <a href="<?php echo ($webpath); ?>?s=video/play/id/<?php echo ($id); ?>/ver/<?php echo ($ii); ?>" target="_blank">第<?php echo ($ii); ?>节</a><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>
                                <div class="clear"></div>
                            </div>
                            <!--剧集 结束-->
                            <div class="clear">&nbsp;</div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?> 
                </div>

                <!--广告 开始-->
<!--                 <div class="banner2"><?php echo get_cms_ads('play_700_90');?></div> -->
                <!--广告 结束-->
                <!--猜你喜欢 开始-->
                <div class="cnxh_bofang fix">
                    <div class="cnxh_title" title="猜你喜欢" onclick="change(this)">
                        <span>猜你喜欢</span>
                        <label>GUESS YOU LIKE</label>
                    </div>
                    <!--最近更新 开始-->
                    <div id="猜你喜欢" class="show">
                        <ul class="rb2-1 list1-1" id="hot_video" href="<?php echo ($webpath); ?>index.php?s=my/show/id/hot_video/cid/<?php echo ($cid); ?>/limit/5">
                            
                        </ul>
                        <div class="clear" style="height:15px;">&nbsp;</div>
                    </div>
                    <!--最近更新 结束-->
                </div>
                <!--猜你喜欢 结束-->
                <!--评论 开始-->
                <div class="pl" id="Comments">
                
                </div>
                <!--评论 结束-->
            </div>
            <!--左边 结束-->
            <!--右边 开始-->
            <div class="clear"></div>
        </div>
        <!--详情 结束-->
    <script type="text/javascript" src="<?php echo ($webpath); ?>views/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo ($webpath); ?>views/js/system.js"></script>
    <script type="text/javascript" src="<?php echo ($tplpath); ?>yiku.js"></script>
    <script type="text/javascript">
        var superHTML5 = 0;
        var superFLV = 0;
        var isPC = false;

        $(document).ready(function(){
            var name='<?php echo ($title); ?>';
            var num='<?php echo ($playname); ?>';
            var url=window.location.href;
            CheckAdd(name,'gxhis',url,num)
            var URL = document.URL.split('.html');
            URL = URL[0].match(/\d+.*/g)[0].match(/\d+/g);
            var Count = URL.length;
            var sid = URL[(Count-1)]*1;
            var array = new Array();

           if (window.applicationCache) {
                  superHTML5 = 1;
              } else {
                  superHTML5 = 0;
              }
               
           var fls = flashChecker();
           if(fls.f){
               superFLV = 1;
           }else{
               superFLV = 0;
           }
           
           isPC = IsPC();
          
           /*
                switch(url_html_play)
                {
                    case 1://每集生成时的播放
                        
                        var URL = Player.Url.split(html_file_suffix+'?');
                        URL = URL[1].split('-');
                        Count = URL.length;
                        
                        if (Count == 2)
                        {
                            array['sid'] = 0;
                        }else{
                            array['sid'] = URL[2]*1;
                        }
                        

                        
                        
                        array['id'] = URL[0]*1;
                        array['pid'] = URL[1]*1;        
                        break;
                    case 2:
                        var URL = Player.Url.split(html_file_suffix);
                        URL = URL[0].split('/');
                        var Count = URL.length;
                        URL = URL[Count-1].split('-');
                        Count = URL.length;
                        
                        if (Count == 2)
                        {
                            array['sid'] = 0;
                        }else{
                            array['sid'] = URL[2]*1;
                        }
                        array['id'] = URL[0]*1;
                        array['pid'] = URL[1]*1;        
                        break;
                    default: //动态模式下面的加载播放器
                        var URL = Player.Url.split(html_file_suffix);
                        URL = URL[0].split('/');
                        var Count = URL.length;
                        URL = URL[Count-1].split('-');
                        Count = URL.length;
                        //console.log(URL);
                        if (Count == 2)
                        {
                            array['sid'] = 0;
                        }else{
                            array['sid'] = URL[2]*1;
                        }
                        array['id'] = URL[0]*1;
                        array['pid'] = URL[1]*1;        
                        break;
                }
            
            
            var type = playlistArr[array['sid']];
            
            video_detail_tag_change2(type,10,'play_name_','play_ji_','on','off','show','hide');
           */
        });

        function IsPC()  
        {  
             var userAgentInfo = navigator.userAgent;  
             var Agents = new Array("Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod");  
             var flag = true;  
             for (var v = 0; v < Agents.length; v++) {  
                 if (userAgentInfo.indexOf(Agents[v]) > 0) { flag = false; break; }  
             }  
             return flag;  
        }

        function flashChecker() {
            var hasFlash = 0; //是否安装了flash
            var flashVersion = 0; //flash版本
            if (document.all) {
              var swf = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
              if (swf) {
                hasFlash = 1;
                VSwf = swf.GetVariable("$version");
                flashVersion = parseInt(VSwf.split(" ")[1].split(",")[0]);
              }
            } else {
              if (navigator.plugins && navigator.plugins.length > 0) {
                var swf = navigator.plugins["Shockwave Flash"];
                if (swf) {
                  hasFlash = 1;
                  var words = swf.description.split(" ");
                  for (var i = 0; i < words.length; ++i) {
                    if (isNaN(parseInt(words[i]))) continue;
                    flashVersion = parseInt(words[i]);
                  }
                }
              }
            }
            return { f: hasFlash, v: flashVersion };
          }
          
        var playbyjw = false;

        function set_localpara()
        {
            var value = "";
            /*if(form1.chk_autoplay.checked)
            {
                value="autoplay=autostart";
            }
            else
            {
                value="autoplay=no";
            }
            document.cookie = value;
            */
            if(form1.chk_player.checked)
            {
               value="player=jw";
            }
            else
            {
               value="player=adobe";
            }
            document.cookie = value;
        }

        function is_jwplayer()
        {
            var strcookie=document.cookie;
            if(strcookie.indexOf("jw")>=0)
            {
                return true;
            }
            else
            {
               return false;
            }
        }

        function is_autoplay()
        {
            var strcookie=document.cookie;
            if(strcookie.indexOf("autostart")>=0)
            {
                return true;
            }
            else
            {
               return false;
            }
        }

        function set_captions(mode,title)
        {
         var modetext="Playback";
         if(mode=="live")
         {
            modetext="Live streaming";
         }
         var tl_text = "<font color='#FFFFFF' size='5'>" + title +"</font>";
         var tp_text = "<font color='#FFFFFF' style='font-size: 20pt; font-weight: 700'>" + modetext + "</font>";
         
            // tl.innerHTML = tl_text;
            // tp.innerHTML = tp_text;
        }

        function play_flv(w,h,url,livemode,tl)
        {
            
            var autoplay = true;            //is_autoplay();
                 var usejw    = true;            //is_jwplayer();
                // set_captions(livemode,tl);
                 if(usejw && livemode!="live")
                 {
                        jwplayer('fxplayer').setup({
                        file:   url,
                        image:  'jwplayer/jwplayer.jpg',
                        title:  tl ,
                        width:  w,
                        height: h,
                        autostart: autoplay,
                        logo: {
                            //file: '<?php echo ($webpath); ?>views/images/player_logo.png',
                            link: ''
                        },          
                        abouttext: "关于方讯",
                        aboutlink: "",              
                        //aspectratio: '16:9',
                        startparam: 'start'
                     });
                     playbyjw = true;
                }
                else
                {
                    //play(w,h,url,livemode,autoplay);
                    jwplayer('fxplayer').setup({
                        file:   url,
                        image:  'jwplayer/jwplayer.jpg',
                        title:  tl ,
                        width:  w,
                        height: h,              
                        autostart: autoplay,
                        logo: {
                            //file: '<?php echo ($webpath); ?>views/images/player_logo.png',
                            link: ''
                        },          
                        abouttext: "关于方讯",
                        aboutlink: ""               
                        //aspectratio: '16:9',
                        //startparam: 'start'
                     });
                     playbyjw = true;
                
                
                }
                
        }

        function close_player()
        {
             if(playbyjw)
             {
                jwplayer().stop();
             }
        }

         function getUrlParam(name) 
         { 
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); 
                var r = window.location.search.substr(1).match(reg); 
                if (r != null) 
                {
                    return unescape(r[2]);
                }
                else
                {
                    return null; 
                }
            } 

         function playVod(url,title)
         {
            var h = 480;
            var w = 640;
            play_flv(w,h,url,"",title);
         }
         
         function playLive(url,title)
         {
            var h = 480;
            var w = 640;
            play_flv(w,h,url,"live",title);
         }

         function playHTML5(url,title)
         {
            var text = "<video src=\"" + url + "\" controls=\"controls\" autoplay=\"autoplay\" width=\"640px\" height=\"360px\">";  //
                    text = text + "<font color='#FFFFFF'>您的浏览器不支持   HTML5 !</font>";
                text = text + "</video>";

                var doc = "<body bgcolor=\"#000000\">" + 
                          "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" height=\"100%\" >" +
                          "<tr>" +
                          "<td align=\"center\">"  + 
                          text +
                          "</td></tr></table></body>";
            fxplayer.innerHTML = text;
                //document.write(text);
         }
         
         function play_rtsp(url, title){
                var text = "<object type=\"application/x-vlc-plugin\" pluginspage=\"http://www.videolan.org/\" id=\"vlc\" events=\"false\" width=\"704\" height=\"576\">";
                text = text + " <param name=\"mrl\" value=\"" + url + "\" />";
                text = text + " <param name=\"volume\" value=\"50\" />";
                text = text + " <param name=\"autoplay\" value=\"true\" />";
                text = text + " <param name=\"loop\" value=\"false\" />";
                text = text + " <param name=\"fullscreen\" value=\"true\" />";
                text = text + " <param name=\"controls\" value=\"true\" />";
                text = text + " </object>";
                fxplayer.innerHTML = text;
            
            }
         
         function playHLS(url,title) {
           set_captions("vod",title);
           //location.href = url;
           playHTML5(url,title);
         }
         
         function playMP4(url,title)
         {
           set_captions("vod",title);
           playHTML5(url,title);
         }
         
         function gen_rtsp_live_url(host, app, stream, token, port){
                var url   = "rtsp://"  + host + ":" + port + "/" + app + "/" + stream;
                return url;  
         }
         
         function gen_rtmp_live_url(host,app,stream,token,port)
         {
             var url   = "rtmp://"  + host + ":" + port + "/" + app + "/" + stream;
            var npos = host.indexOf(":");
            if(npos>0)
            {
                url = "rtmp://"  + host.substr(0,npos) + "/" + app + "/" + stream;
            }

            if(token!="")
            {
                url = url + "?token=" + token;
            }
            else{
                url = url + "?token=";
            }
             return url;
         }
         
         function gen_flv_vod_url(host,app,stream,ver,token)
         {
             var url  = "http://"  + host + "/sps/" + app + "/" + stream + ".flv?ver=" + ver;
             if(token!="")
             {
                 url = url + "&token=" + token;
             }
             return url;
         }
         
         function gen_mp4_url(host,app,stream,ver,token)
         {
             //var   url= "http://" + host + "/media/mp4/" + app + "/" + stream + "/" + stream;
             var   url= "http://" + host + "/mp4/" + app + "/" + stream + "/" + stream;
             if(ver>=0)
             {
                url = url + "_v" + ver;
             }
             url    = url  + ".mp4";
             if(token!="")
             {
                 url = url + "?token=" + token;
             }else{
                url = url + "?token=";
             }
             return url;
         }
         
         function gen_hls_url(host,app,stream,ver,token)
         {
            var d = new Date();
            var url  = "http://"  + host + "/m3u8/" + app + "/" + stream + ".m3u8?from=mgr";
            if(ver!=null)
            {
               url = url + "&ver=" + ver;
            }
         // url = url + "&uid=m" + d.getTime();
            if(token!="")
             {
                 url = url + "&token=" + token;
             }
            
            return url;
         }


        function InitDoc()
        {
           var url    = '<?php echo ($url); ?>';
           var app    = '<?php echo ($app); ?>';
           var stream = '<?php echo ($stream); ?>';
           var live   = '<?php echo ($ctype); ?>';
           var host   = '<?php echo ($host); ?>';
           var ver    = '<?php echo ($ver); ?>';
           var format = '<?php echo ($format); ?>';
           var tl     = "<?php echo $title;?>";//getUrlParam("title");
           var port   = '<?php echo ($port); ?>';
           var token  = "<?php echo $token;?>";
           
         //  var autoplay = is_autoplay();
        //  var jwplayer = is_jwplayer();
            var  uid     = getUrlParam("uid");
            if(uid=="" || uid==null)
            {
               uid     = ntv_uuid(16,16);
            }
               
           if(url!="" && url!=null)
           {
                return play_stream(url);
           }
           
           if(app==null || stream==null)
           {
                fxplayer.innerHTML= "<font color=\"#FFFFFF\">Load stream error!</font>";
                return;
           }

           if(tl==null || tl=="")
           {
               tl = app + " - " + stream;
           }

           if(port==null || port=="")
           {
               port = "1935";
           }
           
           if((host==null) || (host == ""))
           {
                host  = document.location.host;
            }
            if((ver==null) || (ver == ""))
            {
                ver="-1";
            }
            if(format==null)
            {
                 format="flv";
            }
               
           if(live=="live")
           {
             if(isPC){
                 if(format=="flv")
                 {
                    url  = gen_rtmp_live_url(host,app,stream,token,port);
                    url  = url + "&live=1&uid=" + uid + "&sid=" + uid; 
                    playLive(url,tl);
                 }
                 else if(format=="hls")
                 {
                    url = gen_hls_url(host,app,stream,null,token);
                    url  = url +  "&live=1&uid=" + uid + "&sid=" + uid;
                    playHLS(url,tl);
                 }else if(format == "rtsp"){
                     url = gen_rtsp_live_url(host, app, stream, token, port);
                    play_rtsp(url, tl);
                 }
             }else{
                url = gen_hls_url(host,app,stream,null,token);
                url  = url +  "&live=1" +  "&uid=" + uid + "&sid=" + uid;
                playHLS(url,tl);        
             }
           }
           else
           {      
              // alert("flv:" + superFLV + "; html5:" + superHTML5);
              
               if(isPC){
                   if(superFLV == 1){
                       url = gen_flv_vod_url(host,app,stream, ver,token);
                       url  = url + "&uid=" + uid + "&sid=" + uid; 
                       playVod(url,tl);
                    }else if(superHTML5 == 1){
                       url = gen_mp4_url(host,app,stream,ver,token);
                       url  = url + "&uid=" + uid + "&sid=" + uid;  
                       playMP4(url,tl);
                   }else{
                       url = gen_hls_url(host,app,stream,ver,token);
                       url  = url + "&uid=" + uid + "&sid=" + uid;  
                       playHLS(url,tl);
                   }
               }else{
                   url = gen_hls_url(host,app,stream,ver,token);
                   url  = url + "&uid=" + uid + "&sid=" + uid;  
                   playHLS(url,tl);
                       
               }

               /*
              if(format=="flv")
              {
                 url = gen_flv_vod_url(host,app,stream,ver,token);
                 playVod(url,tl);
              }
              else if(format=="mp4")
              {
                  url = gen_mp4_url(host,app,stream,ver,token);
                  playMP4(url,tl);
              }
              else if(format=="hls")
              {
                  url = gen_hls_url(host,app,stream,ver,token);
                  playHLS(url,tl); 
              }
               */
           }
           window.focus();
        }

        function close_player()
        {
             if(playbyjw)
             {
                jwplayer().stop();
             }
        }

        function play_stream(para)
        {
            var url = para;
            
            /*
            if(url=="" || url==null)
            {
                url = form2.media_url.value;
                if(url=="" || url==null)
                {
                    return;
                }
                location.href = "autoplayer.php?media_url=" + escape(url);
                return;
            }
            
            
            if(url.indexof("rtsp://") >= 0){
                var text = "<OBJECT classid=\"clsid:9BE31822-FDAD-461B-AD51-BE1D1C159921\" id=\"vlc\"";
                    text = text + " codebase=\"http://download.videolan.org/pub/videolan/vlc/0.8.6c/win32/axvlc.cab\" ";  
                    text = text + " width=\"600\" height=\"480\" id=\"vlc\" events=\"True\">";  
                    text = text + " <param name=\"MRL\" value=\"" + url + "\" />";  
                    text = text + " <param name=\"Src\" value=\"\" />";  
                    text = text + " <param name=\"ShowDisplay\" value=\"True\" />";  
                    text = text + " <param name=\"AutoLoop\" value=\"False\" />";  
                    text = text + " <param name=\"AutoPlay\" value=\"True\" />";  
                    text = text + " <param name=\"Time\" value=\"True\"/>";
                    text = text + " <EMBED pluginspage=\"http://www.videolan.org\"";  
                    text = text + "   type=\"application/x-vlc-plugin\"";  
                    text = text + "   version=\"VideoLAN.VLCPlugin.2\"";  
                    text = text + "   width=\"600\"";  
                    text = text + "   height=\"480\"";     
                    text = text + "   text=\"Waiting for video\"";  
                    text = text + "   name=\"vlc\" >";
                    text = text + "</EMBED> ";
                    text = text + "</OBJECT> ";
                    
                    fxplayer.innerHTML = text;
            }else{
                form2.media_url.value = url;
                if(url.indexOf('.m3u8')>=0)
                {
                    playHLS(url,"");    
                }
                else if(url.indexOf('.flv')>=0)
                {
                    playVod(url,"");
                }
                else if(url.indexOf('.mp4')>=0)
                {
                    playMP4(url,"");
                }
                else
                {
                    playLive(url,"Living stream");
                }
            }
            */
        }

    </script>
    <?php echo ($inserthits); ?>
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
</div>

<!--wapper 结束-->
</body>
</html>