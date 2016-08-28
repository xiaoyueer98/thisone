<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($webtitle); ?></title>
<meta name="keywords" content="<?php echo ($ckeywords); ?>">
<meta name="description" content="<?php echo ($cdescription); ?>">

<link href="/template/2345/css/global.css" rel="stylesheet" type="text/css" />
<link href="/template/2345/css/detail.common.css" rel="stylesheet" type="text/css" />
<link href="/template/2345/css/movieDetail.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/template/2345/js/xquery2.20.min.js"></script>
<script type="text/javascript" src="/template/2345/js/libnew.min.js"></script>
<script type="text/javascript" src="/template/2345/js/common.min.js"></script>
<script type="text/javascript" src="/template/2345/js/detail.min.js"></script>
<script type="text/javascript" src="/template/default/js/jquery.js"></script>
<script type="text/javascript" src="/template/2345/js/topFuc.130115.js"></script>
</head>


<body>
<div class="header" id="fheader" style="height:37px;">
  <div class="headerNav">
  
    <div class="left">
    
         <a target="_self" href="<?php echo ($webpath); ?>" <?php if($model == 'index'): ?>class="headerNavSelected"<?php endif; ?>>首页</a><i></i>
            <?php $tag['name'] = 'menu'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><a onfocus="this.blur();" href="<?php echo ($menu["showurl"]); ?>" <?php if(($menu['id'] == $cid) or ($menu['id'] == $pid)): ?>class="headerNavSelected"<?php endif; ?>><?php echo ($menu["cname"]); ?></a><i></i><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
    
    
    
    </div>
    
    <div class="right">
      <p class="pLinks">
      <a target="_self" href="/index.php?s=Tv">电视直播</a>
      <i></i>
      <a target="_self" href="/index.php?s=special/lists">影视专题</a><i></i>
      </p>
      </div>
  </div>
</div>


<div class="main clearfix">
    <div class="col_b">
    	<div class="detailTxtIntro clearfix">
        	<div class="titleName clearfix">
            	<span class="sRightBtn">
            	 <a href="#say" target="_self" class="topQuickCommentBtn"></a>
           	    <a href="javascript:void(0)" class="topCollectionBtn"  onclick="add_fav_d('<?php echo ($title); ?>','<?php echo ($id); ?>');return false;">收藏</a>
            	<!-- -->
            	<div class="quickCommentNum clearfix" id="quick_com_tab"><i class="iArrow"></i></div>
            	<!-- -->
            	<div class="detailPngMap quickComment clearfix" id='comment_box' style="display:none;">  	
             <textarea  class="quickCommentArea" id='comment_textarea1' style="color:#999" onfocus='comFocus(this)' onblur='comBlur(this)'>在这里输入...</textarea>
                <div class="verificationCodeCon">
                	<input name='pImgCode' type="text" class="verificationCodeInput" value="点此输入验证码" onfocus="fnImgCodeFocus(this)" onblur="fnImgCodeBlur(this)"/><em class="emCodeImg"><img style="display:none" src="/template/2345/images/noimg.jpg" height="24" width="50"/></em>
                	<a style="display:none" href="javascript:void(0)" onclick='refreshImg(this);return false;' target='_self' class="changeBtn">看不清？换一张</a>
                </div>
            	<a href="javascript:void(0)" target="_self" class="submitBtn" onclick="submit_com('comment_textarea1');m.g('comment1').style.display='none';m.g('comment2').style.display='block';m.g('comment_header2').className='cur';m.g('comment_header1').className='';return false;">提交</a><a href="javascript:void(0)" class="closeBtn" onclick="this.parentNode.style.display='none';m.g('quick_com_tab').style.display='';return false;" target="_self">关闭</a></div></span>
                <span class="sName">

                <a href="javascript:void(0);" rel="nofollow" title="<?php echo ($title); ?>在线观看"><?php echo ($title); ?></a></span>
                <!--<span class="sScore"><em>7.5</em>分</span>-->
                
                <!--2013-04-16-->
                                <p class="doubanScore"><span>评分：</span><a href="http://movie.douban.com/subject/3415993/?source=2345" target="_blank" rel="nofollow"><?php echo ($score); ?></a>分</p>
                                <!--2013-04-16-->
                
                           </div>
            <div class="detailTxtLeft ">
            <dl class="clearfix">
<dt>主演：</dt>
                <dd>
                <?php if(!empty($actor)): ?><?php echo (get_actor_url($actor)); ?><?php else: ?>未知<?php endif; ?>
                
</dd>
                <dt>导演：</dt>
                <dd><?php if(!empty($director)): ?><?php echo ($director); ?><?php else: ?>未知<?php endif; ?></dd>
                </dl>
                  </div>
                  <div class="clear"></div> 
                <div>
	                <dl class="clearfix">
                <dt>简介：</dt>
                <dd><p id='intro'>
                <?php echo strip_tags(mb_substr($content,0,200,'utf-8'));?>
<a href="javascript:void(0)" class="showMoreBtn" onclick="toggleIntro();return false;" target="_self">展开>></a></p></dd></dl>
                        <input type="hidden" value="<?php echo strip_tags($content)?> <a href='#' class='showMoreBtn' onclick='toggleIntro();return false;' target='_self'>收起<<</a>" id='hidden_intro'/>                                                
                    </div>
<div class="clear"></div>   
                </div>
<!-- playlink start -->
        <div class="moviePlayList clearfix" style="height:40px; padding-top:6px;">
        
<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
<a class="bds_tsina"></a>
<a class="bds_qzone"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_t163"></a>
<a class="bds_mshare"></a>
<a class="bds_tqf"></a>
<a class="bds_sqq"></a>
<a class="bds_thx"></a>
<a class="bds_douban"></a>
<span class="bds_more"></span>
<a class="shareCount"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=703427" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->

        
        
        
        
        </div>
<!-- playlink end --><a name='middle'></a>  
					<div class="plotAbout">
                     
                     
  <div class="maxBox"> 
    
    
 <style>
 .box {width: 750px;position: relative;overflow: hidden;padding: 0px;border: 1px solid #E3E3E3;background: #FFF;}

.Video-list{margin-bottom: 5px;}
.Video-list .play-list{text-align:left;overflow:hidden}
.Video-list .play-list .title{height: 44px;line-height: 44px;overflow: hidden;font-size: 14px;border-bottom: 1px solid #EEE;}
.Video-list .play-list .title h3 {padding-left: 15px;font-weight: normal;color:#2F9DDA;float: left;}/*background: url(../images/h3_down.gif) no-repeat 17px;*/
.Video-list .play-list .title h3 .tips{font-size: 12px;color:#333;}
.Video-list .play-list .title h3 .tips a{color:#FA0202;}
.Video-list .play-list .title h3 .tip_icon{width:16px; height:16px; display:inline-block; position:absolute; left:14px; top:14px; background:url(../images/tip_icons.gif) 0 0 no-repeat;}
.Video-list .play-list .title h3 .tip_优酷{background-position:0 0;}
.Video-list .play-list .title h3 .tip_土豆{background-position:0 -30px;}
.Video-list .play-list .title h3 .tip_qiyi{background-position:0 -60px;}
.Video-list .play-list .title h3 .tip_奇艺{background-position:0 -60px;}
.Video-list .play-list .title h3 .tip_sina{background-position:0 -90px;}
.Video-list .play-list .title h3 .tip_letv{background-position:0 -120px;}
.Video-list .play-list .title h3 .tip_56高清{background-position:0 -150px;}
.Video-list .play-list .title h3 .tip_baidu{background-position:0 -180px;}
.Video-list .play-list .title h3 .tip_qvod{background-position:0 -210px;}
.Video-list .play-list .title h3 .tip_cntv{background-position:0 -240px;}
.Video-list .play-list .title h3 .tip_6room{background-position:0 -270px;}
.Video-list .play-list .title h3 .tip_gvod{background-position:0 -300px;}
.Video-list .play-list .title h3 .tip_baofeng{background-position:0 -330px;}
.Video-list .play-list .title h3 .tip_qq{background-position:0 -360px;}
.Video-list .play-list .title h3 .tip_qqlive{background-position:0 -360px;}
.Video-list .play-list .title h3 .tip_sohu{background-position:0 -390px;}
.Video-list .play-list .title h3 .p_土豆,.Video-list .play-list .title h3 .p_优酷,.Video-list .play-list .title h3 .p_qiyi,.Video-list .play-list .title h3 .p_奇艺,.Video-list .play-list .title h3 .p_sina,.Video-list .play-list .title h3 .p_letv,.Video-list .play-list .title h3 .p_56高清,.Video-list .play-list .title h3 .p_baidu,.Video-list .play-list .title h3 .p_qvod,.Video-list .play-list .title h3 .p_cntv,.Video-list .play-list .title h3 .p_6room,.Video-list .play-list .title h3 .p_gvod,.Video-list .play-list .title h3 .p_baofeng,.Video-list .play-list .title h3 .p_qq,.Video-list .play-list .title h3 .p_qqlive,.Video-list .play-list .title h3 .p_sohu{
	background:url(../images/tip_icons.gif) 0 6px no-repeat; width:20px; height:30px; display:inline-block;  vertical-align:middle;
}
.Video-list .play-list .title h3 .p_youku{background:url(../images/tip_icons.gif) 0 6px no-repeat;}
.Video-list .play-list .title h3 .p_土豆{background:url(../images/tip_icons.gif) 0 -24px no-repeat;}
.Video-list .play-list .title h3 .p_qiyi{background-position:0 -54px;}
.Video-list .play-list .title h3 .p_奇艺{background-position:0 -54px;}
.Video-list .play-list .title h3 .p_sina{background-position:0 -84px;}
.Video-list .play-list .title h3 .p_letv{background-position:0 -114px;}
.Video-list .play-list .title h3 .p_56高清{background-position:0 -144px;}
.Video-list .play-list .title h3 .p_baidu{background-position:0 -174px;}
.Video-list .play-list .title h3 .p_qvod{background-position:0 -204px;}
.Video-list .play-list .title h3 .p_cntv{background-position:0 -234px;}
.Video-list .play-list .title h3 .p_6room{background-position:0 -264px;}
.Video-list .play-list .title h3 .p_gvod{background-position:0 -294px;}
.Video-list .play-list .title h3 .p_baofeng{background-position:0 -324px;}
.Video-list .play-list .title h3 .p_qq{background-position:0 -354px;}
.Video-list .play-list .title h3 .p_qqlive{background-position:0 -354px;}
.Video-list .play-list .title h3 .p_sohu{background-position:0 -384px;}

.Video-list .play-list .title span.order{float: right;padding-right: 15px;font-size: 12px;}
.Video-list .play-list .title span.order em{display:inline-block; padding:0 5px; color:#999;}
.Video-list .play-list .title span.order a{font-size: 12px;}
.Video-list .play-list .title a.desc{background:url(../images/sprits.gif) 2px -1000px no-repeat; padding-left:14px; color:#666;}
.Video-list .play-list .title a.asc{background:url(../images/sprits.gif) 2px -1100px no-repeat; padding-left:14px; color:#666;}
.Video-list .play-list .title a.desc_on{font-weight:bold; color:#F00; background-position:2px -950px;}
.Video-list .play-list .title a.asc_on{font-weight:bold; color:#F00; background-position:2px -1050px;}

.Video-list .play-list ul {overflow-y:auto; padding:0 0 10px 13px; height:auto;}
.Video-list .play-list ul li{ float:left; border:1px solid #dcdcdc; background:#f2f2f2; color:#333333; display:block; width:115px; height:26px; line-height:26px; text-overflow:ellipsis; white-space:nowrap; overflow:hidden; text-align:center; margin:7px 10px 0 4px;}
.Video-list .play-list ul li a{color:#333333;}
.Video-list .play-list ul li a:hover{background:#ffbc00;color:#ffffff ;border:1px solid #ea8c00; text-decoration:none;}
.Video-list .play-list ul li a:visited{background:#ffbc00;color:#333333 ;text-decoration:none;}


 </style>   
    
    
    <!--百度影音-->
    <?php if(is_array($ppplay)): $i = 0; $__LIST__ = $ppplay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 )?><div class="box Video-list">
        <div class="play-list b mb">
          <div class="title">
            <h3><span class="p_{{$video.playname}}"></span><?php echo ($video["playername"]); ?> <span class="tips"></span></h3>
            <span class="pa order hascoll"> 排序：<a id="desc_1" class="desc" href="javascript:void(0);" onclick="desc(1,1,this)">降序</a> <em>|</em> <a id="asc_1" href="javascript:void(0);" class="asc asc_on" onclick="desc(0,1,this)">升序</a> </span> </div>
          <div id="play_1">
            <ul>
              <?php if(is_array($video['son'])): $ii = 0; $__LIST__ = $video['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ppvodson): ++$ii;$mod = ($ii % 2 )?><li> <a target='_blank' title='<?php echo ($ppvodson["playname"]); ?>' href='<?php echo ($ppvodson["playurl"]); ?>'><?php echo ($ppvodson["playname"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </div>
        </div>
      </div><?php endforeach; endif; else: echo "" ;endif; ?>
    
  </div>
                     
                     
                     
                     
                     
                     
                     
                      
                    </div>
                    
                    <i class="iLine m20"></i>
				 

     
	 
                <a name='comment' id="comment_mao"></a>
				
         <div class="commentList">
         	<!--2013-04-16-->
        	<div class="mod_c clearfix">
            <a target='_self' href="javascript:void(0)" onclick="m.g('comment2').style.display='none';m.g('comment1').style.display='block';this.className='cur';m.g('comment_header2').className='';return false;" class="cur" id="comment_header1">影评</a><a name="say" id="say"></a> </div>
            <!--2013-04-16-->
            
            <!--2013-04-16-->
            <div class="commentCon" style="display:block" id='comment1'>
                
                    <!-- UY BEGIN -->
                    <div id="uyan_frame"></div>
              <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=<?php echo ($youyan_id); ?>"></script>
                    <!-- UY END -->
                
                
            </div>
             <div class="commentCon" style="display:none;" id='comment2'>
                 <div class="commentForm m15">
                     <div class='commentFormBg clearfix'>

                             <p class="pTit"><span class="sName">《巨人捕手杰克》</span>怎么样？写出你的想法</p>
                             <textarea class="conmmentArea" id='comment_textarea2' style="color:#999" onfocus='comFocus(this)' onblur='comBlur(this)'>在这里输入...</textarea>
                             <div class="verificationCodeCon clearfix">
                                 <input name="pImgCode" type="text" class="verificationCodeInput" value="点此输入验证码" onfocus="fnImgCodeFocus(this)" onblur="fnImgCodeBlur(this)"/><em class="emCodeImg"><img style="display:none" src="/template/2345/images/noimg.jpg" height="24" width="50"/></em>
                                 <a style="display:none" href="javascript:void(0)" onclick='refreshImg(this);return false;' target='_self' class="changeBtn">看不清？换一张</a>
                             </div>
                             <a href="#comment" class="submitBtn"  onclick="submit_com('comment_textarea2');return false;" target="_self">提交</a>
                             <input type="hidden" id="hidden_comment"/>
                             <span class="sConmmentTips">Enter快捷提交</span>
                     </div>
                 </div>
                                  <div class="commentOurs clearfix">

                     <ul class="ul_txtA clearfix" id="comment_ul">
                                                  <li><div class="bottomLine clearfix">
                                 <p>挺好的</p><span class="sTime">2013-07-22</span>
                             </div></li>
                                                  <li><div class="bottomLine clearfix">
                                 <p>很好看</p><span class="sTime">2013-07-22</span>
                             </div></li>
                                                  <li><div class="bottomLine clearfix">
                                 <p>我想两个头的大的是隆下小的是国王</p><span class="sTime">2013-07-21</span>
                             </div></li>
                                                  <li><div class="bottomLine clearfix">
                                 <p>这个片子非常好情节扣人心</p><span class="sTime">2013-07-21</span>
                             </div></li>
                                                  <li><div class="bottomLine clearfix">
                                 <p>很好</p><span class="sTime">2013-07-21</span>
                             </div></li>
                                                  <li><div class="bottomLine clearfix">
                                 <p>这是一部非常好的电影，外国人真的想象力特别好。能把一则童话故事变成一部电影。很好，蛮刺激，不错的电影。</p><span class="sTime">2013-07-20</span>
                             </div></li>
                                                  <li><div class="bottomLine clearfix">
                                 <p>这个主角就是那部《温暖的尸体》的主角</p><span class="sTime">2013-07-20</span>
                             </div></li>
                                                  <li><div class="bottomLine clearfix">
                                 <p>没意思</p><span class="sTime">2013-07-20</span>
                             </div></li>
                                                  <li><div class="bottomLine clearfix">
                                 <p>好无聊啊</p><span class="sTime">2013-07-20</span>
                             </div></li>
                                                  <li><div class="bottomLine clearfix">
                                 <p>我一个人看有点怕</p><span class="sTime">2013-07-20</span>
                             </div></li>
                                    </ul>

                                   </div>
           </div>
            <!--2013-04-16-->

            
        </div>
				
		
<div class="plotAbout m10">
        	<div class="mod_c clearfix"><a href="javascript:void(0)" onclick="show_video('type');return false;" class="cur" id='type_video_title'>同类热播影片</a>
        	        	</div>
            <div class="plotAboutCon clearfix" style="display:block" id='type_video_con'>
            	<ul class="ul_picTxtA ulPic_widthA m10 clearfix"  id='xload_mod_d1'>
                
                
                <?php $tag['name'] = 'video';$tag['cid'] = ''.$cid.'';$tag['limit'] = '5';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li>
                        <div class="pic" onmouseover="this.className='pic picHover'" onmouseout="this.className='pic'"> 
                        	<img width="110" height="147"  src="<?php echo ($video["picurl"]); ?>" loadsrc="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>">
                            <i class="detailPngMap iTxt"><span class="sTime"><em class="left"><?php echo ($video["year"]); ?></em><em class="right"><em class="eScore"><?php echo ($video["score"]); ?></em>分</em></span></i>
                            <i class="detailPngMap picHoverBg"><a  href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"></a></i> 
                        </div>
                        <span class="sName"><a href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a></span>
                    </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>   
                
                
                
                
                                   </ul>
            </div>
            
            <div class="plotAboutCon clearfix" id='actor_video_con'>
            	<ul class="ul_picTxtA ulPic_widthA m10 clearfix"  id='xload_mod_d2'>
            	                </ul>
            </div>
            
        </div>
    </div>
	<div class="col_a">
   	  <div class="detailPicIntro">
        	<div class="pic" onmouseover="this.className='pic picHover'" onmouseout="this.className='pic'">
                <img alt="<?php echo ($title); ?>" src="<?php echo ($picurl); ?>"  width="195" height="260">
                                                <i class="detailPngMap playBtn">
                
                <a href="javascript:void(0);" class='opt-dy-view' opt-id="89956" title="<?php echo ($title); ?>" rel="nofollow"></a></i>
            </div>
                        <div class="txt m10">
                <p><span class="sTit">类型：</span><span class="sStyle"><a href="<?php echo ($showurl); ?>"><?php echo ($cname); ?></a> <?php echo (eku_stype_url($stype_mcid,$cid)); ?></span></span></p>
                <p><span class="sTit">地区：</span><span class="sAddress"><?php echo (($area)?($area):'未录入'); ?></span></p>
				<p><span class="sTit">年代：</span><?php echo (($year)?($year):'未录入'); ?></p>
				<p><span class="sTit">语言：</span><?php echo (($lang)?($lang):'未录入'); ?></p>            </div>
        </div>
   	  <div class="mod_a m10">
   	    <div class="th_a"><span class="sMark">热门排行榜</span></div>
            <div class="tb_a">
            	<div class="tabList clearfix">
                    <div class="tabLabel"><a id='rankTab1' onmouseover="showRank(1);" href="javascript:void(0);" class="cur" >最新</a><i class="iLine"></i>
                    <a id='rankTab2' onmouseover="showRank(2);"  href="javascript:void(0);">最热</a></div>
                    <div class="tabCon">
                    
                    
                    	<ul class="ul_rank clearfix" id='rank1'>
                        <?php $tag['name'] = 'video';$tag['cid'] = ''.$cid.'';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><i <?php if($i < 4): ?>class="iFirst"<?php endif; ?>><?php echo ($i); ?></i><span class='sName'><a title="<?php echo ($video["title"]); ?>" target="_blank" href="<?php echo ($video["readurl"]); ?>"><?php echo (get_replace_html($video["title"],0,14)); ?></a></span><span class="sScore"><em><?php echo ($video["score"]); ?></em></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                      
                      </ul>
                        <ul class="ul_rank clearfix" id='rank2' style="display:none">
                        <?php $tag['name'] = 'video';$tag['cid'] = ''.$cid.'';$tag['limit'] = '10';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><i <?php if($i < 4): ?>class="iFirst"<?php endif; ?>><?php echo ($i); ?></i><span class='sName'><a title="<?php echo ($video["title"]); ?>" target="_blank" href="<?php echo ($video["readurl"]); ?>"><?php echo (get_replace_html($video["title"],0,14)); ?></a></span><span class="sScore"><em><?php echo ($video["score"]); ?></em></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                      </ul>
                    </div>
                </div>
            </div>
      </div>
   	  <div class="mod_a m10">
   	    <div class="th_a"><span class="sMark">专题推荐</span></div>
            <div class="tb_a">
            	<div class="tabList clearfix">
            	  <div class="tabCon">
                   	  <ul class="ul_rank clearfix"  id="rank_list5">
                     <?php $tag['name'] = 'special';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$special): ++$i;$mod = ($i % 2 );?><li><a href="<?php echo ($special["readurl"]); ?>" title="<?php echo ($special["title"]); ?>" id='rankl5_1'><?php echo ($special["title"]); ?></a><span class="sScore"><em></em></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                    </ul>
                  </div>
              </div>
            </div>
      </div>
               
    </div>


    
    <div class="clear"></div>
    
    <div class="rightScroll" style="top: 240px; display: block;" id='rightMenu'>
        <a href="javascript:window.scrollTo(0, 0);" class="goTop m8" id='goTop' target="_self"></a>
    </div>
    
</div>
</div>

<div class="footer">
  <div class="footerContent clearfix" style="text-align:center;">
    
    <div style="margin-top:10px; text-align:center;"><?php echo ($copyright); ?></div>
    <div style="text-align:center;">
          <dt style="padding-top:6px;">投诉与建议</dt>
          <dt style="width:500px; margin:auto; text-align:center; padding-left:396px; padding-top:0px;"><a href="/index.php?s=Guestbook" target="_blank" id="footerAdviceBtn" class="footerAdviceBtn">任何你想说的</a></dt>
    </div>
    
        <a href="<?php echo ($weburl); ?>"><?php echo ($webname); ?></a> Some Rights Reserved <?php echo ($icp); ?> <?php echo ($tongji); ?> <a href="<?php echo ($baidusitemap); ?>">sitemap</a> <a href="<?php echo ($googlesitemap); ?>">sitemap</a><br />
        <span style="display:none;"><script language="javascript" type="text/javascript" src="http://js.users.51.la/15665491.js"></script></span>
    
</div>




<!--[if IE 6]>
<script src="/template/2345/js/DD_belatedPNG_0.0.8a-min.js"></script>
<script>
DD_belatedPNG.fix('.pngMap');
</script>
<![endif]--> 
   <?php echo get_cms_ads('duilian_quanzhan');?>
   <?php echo get_cms_ads('fumeiti_quanzhan');?>


<script type="text/javascript">
function desc(a, b, c) {
				if (c.className.indexOf('_on') == -1) {
					if (a == 0) {
						document.getElementById('desc_' + b).className = 'desc';
						c.className = 'asc asc_on';
					} else {
						document.getElementById('asc_' + b).className = 'asc';
						c.className = 'desc desc_on';
					}
					document.getElementById('play_' + b).innerHTML = '<ul'+(b=="999"?" class=\"Dlist\"":"")+'>' + document.getElementById('play_' + b).getElementsByTagName('ul')[0].innerHTML.toLowerCase().split('</li>').reverse().join('</li>').substring(5) + '</li></ul>';
				}
}
  
  
</script>
</body>
</html>