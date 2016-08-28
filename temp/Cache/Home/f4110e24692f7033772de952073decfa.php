<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($webtitle); ?></title>
<meta name="keywords" content="<?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($description); ?>">
<link href="/template/2345/css/global.css" rel="stylesheet" type="text/css" />
<link href="/template/2345/css/video.common.css" rel="stylesheet" type="text/css" />
<link href="/template/2345/css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/template/2345/js/xquery2.20.min.js"></script>
<script type="text/javascript" src="/template/2345/js/libnew.min.js"></script>
<script type="text/javascript" src="/template/2345/js/common.min.js"></script>
<script type="text/javascript" src="/template/default/js/jquery.js"></script>
<script type="text/javascript" src="/template/2345/js/topFuc.130115.js"></script>
<script type="text/javascript">
var ie6Load=false;
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<script type="text/javascript" src="/template/2345/js/xtop.nav.min.js"></script>
<div class="header" id="fheader">
  <div class="headerNav">
    <div class="left"> <a target="_self" href="<?php echo ($webpath); ?>" 
      <?php if($model == 'index'): ?>class="headerNavSelected"<?php endif; ?>
      >首页</a><i></i>
      <?php $tag['name'] = 'menu'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><a onfocus="this.blur();" href="<?php echo ($menu["showurl"]); ?>" 
        <?php if(($menu['id'] == $cid) or ($menu['id'] == $pid)): ?>class="headerNavSelected"<?php endif; ?>
        ><?php echo ($menu["cname"]); ?></a><i></i><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
    </div>
    <div class="right">
      <p class="pLinks"> <a target="_self" href="/index.php?s=Guestbook">我要求片</a><i></i> <a target="_self" href="/index.php?s=Tv">电视直播</a><i></i> <a target="_self" href="/index.php?s=special/lists">影视专题</a><i></i> </p>
    </div>
  </div>
  <div class="headerContent clearfix">
    <div class="left">
      <div class="headerLogo"><a href="<?php echo ($weburl); ?>" target="_self"><img src="/template/2345/images/logo.png" width="210" height="57" title="<?php echo ($webname); ?>" alt="<?php echo ($webname); ?>"></a><span>目前共有<em><?php echo ($allMovieCount); ?></em>部影片</span> </div>
      <div class="headerSearch">
        <form action="/index.php?s=video/search/" method="post" >
          <div class="searchForm clearfix" >
            <input class="searchInput" id="wd" name="wd" type="text" value="<?php echo ($keyword); ?>" autocomplete="off" style="color:#999;">
            <input type="submit" value="" class="searchSubmit" >
          </div>
          <p class="searchHotWords" > <?php echo ($hotkey); ?> </p>
        </form>
      </div>
    </div>
    
    
    
    <div class="right">
    
      <div class="headerHistory" id="headerHistory">
      <i></i><span class="spanB"><a href="/index.php?s=top10" target="_blank">影视排行榜</a></span><i></i>
      
      <a href="javascript:void(0);" onclick="fnToggleRecord();return false;" class="headerHistoryBtn" id="headerHistoryBtn">观看记录</a>
        <div class="clear"></div>
        
        <div class="historyContent" id="historyContent" style="display:none;">
          <div id="historyClose" class="historyClose" style="display:none;"><a href="javascript:void(0);" onclick="fnTrunRecord();return false;">清空记录</a>|<a href="" class="historyCloseBtn" onclick="fnCloseRecord();return false;">关闭</a></div>
          
          <div class="historyList" id="historyList">
          </div>
          
        </div>
      </div>
      
    </div>
    
    
    
    
    
  </div>
</div>


<div class="main">
	<div class="row">
        <div class="videoFocus clearfix m10" id="videoFocus">
            <a href="javascript:void(000);" onclick="return false;" target="_self" id="videoFocus_Left_Btn" class="pngMap btnLeft"></a>
            <div id="videoFocus_Con" class="videoFocusPicCon">
                <div id="focusA" style="width:9999px">
					<div id='focus'>
                    <ul>
                    
                    	<?php $tag['name'] = 'slide';$tag['fid'] = '1';$tag['order'] = 'oid asc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$slide): ++$i;$mod = ($i % 2 );?><li>
                       		<div class="pngMap focusPic">
                       			<img src="<?php echo ($slide["picurl"]); ?>" width="168" height="224" alt="<?php echo ($slide["title"]); ?>">
                       			<i class="pngMap picHoverBg"><a href="<?php echo ($slide["link"]); ?>" target="_blank"></a></i>
                     		</div>
                       		<span class="sTit">
	                       		<a href="<?php echo ($slide["link"]); ?>" target="_blank" title="<?php echo ($slide["title"]); ?>">
	                       			<?php echo ($slide["title"]); ?>
	                       		</a>
                       		</span>
                       	</li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                        
                      </ul>
					</div>
                    
                    
                    
                </div>
            </div>
            <a href="javascript:void(111);" onclick="return false;" target="_self" id="videoFocus_Right_Btn" class="pngMap btnRight"></a>
        </div>
	</div>
    
    <!-- movie start -->
    <div class="mod_z m10 clearfix">
    	<div class="col_a">
        	<div class="mod_a" id="slideA">
            	<div class="th_a"><a href="<?php echo get_channel_name(1,'showurl');?>" target="_blank" class="aMark" title="好看的电影" id="movie"><span class="sMark">电影</span></a><a href="<?php echo get_channel_name(1,'showurl');?>" class="aMore">更多>></a>
            	<p class="pTabList" id="slideA_Tab">
                
          <a rel="nofollow" href="javascript:void(10.1);" target="_self" class="selected" >最新</a><i></i>
          <?php $tag['name'] = 'menu';$tag['ids'] = '1'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($menuson["showurl"]); ?>" target="_blank"><?php echo ($menuson["cname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            	  </p>
            	</div>
                <div class="tb_a">
                	<div id="slideA_Con">
                    <div>
                    	                    	<div class="slideCon" name="movie_tab_content" id="movie_tab_content_5" >
                        <ul class="ul_picTxtA ulPic_widthA clearfix">
                        	         
                                <?php $tag['name'] = 'video';$tag['cid'] = '1';$tag['limit'] = '15';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li>
                                <div class="pic">
                                    <img src="<?php echo ($video["picurl"]); ?>" width="110" height="147" loadsrc="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>">
                                    <i class="iTxt"><i class="iTxtBg"></i><span class="sTime"><em class="left"></em><em class="right"><?php echo ($video["year"]); ?></em></span></i>
                                    <i class="pngMap picHoverBg"><a rel="nofollow" href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"></a></i>
                                </div>
                                <span class="sName"><a rel="nofollow" href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a></span>
                                <span class="sDes"><?php echo ($video["actor"]); ?></span>
                            </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                            
                                                  </ul>
                                                  
                        <ul class="ul_txtA ulTxt_widthA clearfix">
                        <?php $tag['name'] = 'video';$tag['limit'] = '15,10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><a rel="nofollow" href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>                                                           

                    	                    	  </ul>
                    	</div>
                        
                      </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="col_b">
        	<div class="mod_c">
            	<div class="th_c"><span class="sMark">电影分类</span></div>
                <div class="tb_c">
                	<dl class="videoSortList clearfix">
                		                    	<dt>按类型</dt>
                        <dd>
                        
                <?php
                 $dystypetag = gettypetag(1);
                ?>
                <?php if(is_array($dystypetag)): $i = 0; $__LIST__ = $dystypetag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><span><a rel="nofollow" href="<?php echo getstypetaglink(1,$item['m_cid']);?>" target="_blank"><?php echo ($item["m_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?> 
                        
                        
                        
                                                                                                                
                      </dd>
                                  
                                            	<dt>按地区</dt>
                        <dd>
                        
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/内地" target="_blank">内地</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/香港" target="_blank">香港</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/台湾" target="_blank">台湾</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/韩国" target="_blank">韩国</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/美国" target="_blank">美国</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/泰国" target="_blank">泰国</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/日本" target="_blank">日本</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/其他" target="_blank">其他</a></span> 


                      </dd>
                                            	<dt>按年代</dt>
                        <dd>
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/year/2013" target="_blank">2013</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/year/2012" target="_blank">2012</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/year/2011" target="_blank">2011</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/year/2010" target="_blank">2010</a></span> 
                      </dd>
                                            	<dt>按明星</dt>
                        <dd>
                        	                        	                        	<span><a rel="nofollow" href="/index.php?s=video/search/actor/舒淇" target="_blank">舒淇</a></span>
                        	                        	                        	                        	<span><a rel="nofollow" href="/index.php?s=video/search/actor/赵奕欢" target="_blank">赵奕欢</a></span>
                        	                        	                        	                        	<span><a rel="nofollow" href="/index.php?s=video/search/actor/刘德华" target="_blank">刘德华</a></span>
                        	                        	                        	                        	<span><a rel="nofollow" href="/index.php?s=video/search/actor/成龙" target="_blank">成龙</a></span>
                      </dd>
                  </dl>
                </div>
                <div class="th_c"><span class="sMark"><a href="/index.php?s=top10">电影排行榜</a></span><a href="/index.php?s=top10" class="aMore" rel="nofollow" rel="nofollow">更多排行>></a></div>
                <div class="tb_c">
                	<ul class="ul_rank ulTxt_widthB clearfix">
                    <?php $tag['name'] = 'video';$tag['cid'] = '1';$tag['limit'] = '15';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><i <?php if($i < 4): ?>class="iFirst"<?php endif; ?>><?php echo ($i); ?></i><a rel="nofollow" href="<?php echo ($video["showurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo (get_replace_html($video["title"],0,14)); ?></a><span class="sScore"><em><?php echo ($video["hits"]); ?></em></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                    </ul>                              	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                        </ul>
                </div>
            </div>
        </div> 
    </div>
    <div class="mod_bottom"></div>
    <!-- movie end -->
    <!-- 广告ad start -->
    <div class="ekucmsad">
        <?php echo get_cms_ads('inde_960_90');?>
	</div>
    <!-- 广告ad end -->
    
    <!-- tv start -->
    <div class="mod_z m5 clearfix">
    	<div class="col_a">
        	<div class="mod_a" id="slideB">
            	<div class="th_a">
            		<a href="<?php echo get_channel_name(2,'showurl');?>" target="_blank" class="aMark" title="好看的电视剧" id="tv">
            			<span class="sMark">电视剧</span>
            		</a>
            		<a href="<?php echo get_channel_name(2,'showurl');?>" class="aMore">更多>></a>
            		<p class="pTabList" id="slideB_Tab">
                    
          <a rel="nofollow" href="javascript:void(10.1);" target="_self" class="selected" >最新</a><i></i>
          <?php $tag['name'] = 'menu';$tag['ids'] = '2'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($menuson["showurl"]); ?>" target="_blank"><?php echo ($menuson["cname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                    
                    
           		  </p>
            	</div>
                <div class="tb_a">
                	<div id="slideB_Con">
                    <div>
                    	                        <div class="slideCon" id="tv_tab_content_1" name="tv_tab_content" >
                            <ul class="ul_picTxtA ulPic_widthA clearfix">


                                <?php $tag['name'] = 'video';$tag['cid'] = '2';$tag['limit'] = '15';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li>
                                <div class="pic">
                                    <img src="<?php echo ($video["picurl"]); ?>" width="110" height="147" loadsrc="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>">
                                    <i class="iTxt"><i class="iTxtBg"></i><span class="sTime"><em class="right"><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?>集
                        <?php else: ?>
                        完结<?php endif; ?></em></span></i>
                                    <i class="pngMap picHoverBg"><a rel="nofollow" href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"></a></i>
                                </div>
                                <span class="sName"><a rel="nofollow" href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a></span>
                                <span class="sDes"><?php echo ($video["actor"]); ?></span>
                            </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>



                                               	  </ul>
                            <ul class="ul_txtA ulTxt_widthA clearfix">
                            
                        <?php $tag['name'] = 'video';$tag['cid'] = '2';$tag['limit'] = '15,10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><a rel="nofollow" href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>                                                           
                            
                            
                                                  </ul>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col_b">
        	<div class="mod_c">
            	<div class="th_c"><span class="sMark">电视剧分类</span></div>
                <div class="tb_c">
                	<dl class="videoSortList clearfix">
                    	                    	<dt>按类型</dt>
                        <dd>
                <?php
                 $dystypetag = gettypetag(2);
                ?>
                <?php if(is_array($dystypetag)): $i = 0; $__LIST__ = $dystypetag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><span><a rel="nofollow" href="<?php echo getstypetaglink(1,$item['m_cid']);?>" target="_blank"><?php echo ($item["m_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?> 
                      </dd>
                                            	<dt>按地区</dt>
                        <dd>
                        
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/内地" target="_blank">内地</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/香港" target="_blank">香港</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/台湾" target="_blank">台湾</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/韩国" target="_blank">韩国</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/美国" target="_blank">美国</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/泰国" target="_blank">泰国</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/日本" target="_blank">日本</a></span> 
            <span><a href="/index.php?s=video/lists/id/1/order/addtime/area/其他" target="_blank">其他</a></span> 
                        
                      </dd>
                                            	<dt>按年代</dt>
                        <dd>
                        
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/year/2013" target="_blank">2013</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/year/2012" target="_blank">2012</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/year/2011" target="_blank">2011</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/year/2010" target="_blank">2010</a></span> 
                        
                      </dd>
                                            	<dt>按明星</dt>
                        <dd>
                        	                        	                        	<span><a rel="nofollow" href="/index.php?s=video/search/actor/张根硕" target="_blank">张根硕</a></span>
                        	                        	                        	                        	<span><a rel="nofollow" href="/index.php?s=video/search/actor/陈浩民" target="_blank">陈浩民</a></span>
                        	                        	                        	                        	<span><a rel="nofollow" href="/index.php?s=video/search/actor/杨幂" target="_blank">杨幂</a></span>
                        	                        	                        	                        	<span><a rel="nofollow" href="/index.php?s=video/search/actor/唐嫣" target="_blank">唐嫣</a></span>
                      </dd>
                  </dl>
                </div>
                <div class="th_c"><span class="sMark"><a href="/index.php?s=top10">电视剧排行榜</a></span><a href="/index.php?s=top10" class="aMore" rel="nofollow">更多排行>></a></div>
                <div class="tb_c">
                	<ul class="ul_rank ulTxt_widthB clearfix">
                        <?php $tag['name'] = 'video';$tag['cid'] = '2';$tag['limit'] = '15';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><i <?php if($i < 4): ?>class="iFirst"<?php endif; ?>><?php echo ($i); ?></i><a rel="nofollow" href="<?php echo ($video["showurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo (get_replace_html($video["title"],0,14)); ?></a><span class="sScore"><em><?php echo ($video["hits"]); ?></em></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                  	</ul>                               	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                        </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mod_bottom"></div>
    <!-- tv end -->
    
    <!-- subjects start -->
    <div class="mod_d m5">
    	<div class="th_d">
        	<span class="sMark">影视专题</span>
        	<span class="right">
            <?php $tag['name'] = 'special';$tag['limit'] = '7';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$special): ++$i;$mod = ($i % 2 );?><a  href="<?php echo ($special["readurl"]); ?>" target="_blank"><?php echo ($special["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
         		<a href="/index.php?s=special/lists" class="aMore" rel="nofollow">更多专题>></a>
        	</span>
        </div>
        <div class="tb_d" id="slideF_Con">
        	<ul class="ul_picA ulPic_widthC clearfix">
            
            <?php $tag['name'] = 'special';$tag['limit'] = '8';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$special): ++$i;$mod = ($i % 2 );?><li ><a  href="<?php echo ($special["readurl"]); ?>" target="_blank"><img src="<?php echo ($special["logo"]); ?>" loadsrc="<?php echo ($special["logo"]); ?>" width="168" height="90"><?php echo ($special["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            
          
          </ul>
        </div>
    </div>
    <div class="mod_bottom"></div>
    <div class="mod_z m5 clearfix">
    	<div class="col_a">
        	<div class="mod_a" id="slideC">
            	<div class="th_a"><a href="<?php echo get_channel_name(3,'showurl');?>" target="_blank" class="aMark" title="好看的动漫"><span class="sMark" id="comic">动漫</span></a><a href="<?php echo get_channel_name(3,'showurl');?>" class="aMore">更多>></a>
            	</div>
                <div class="tb_a">
                	<div id="slideC_Con">
                    <div>
                    	                        <div class="slideCon" id="comic_tab_content_42" name="comic_tab_content" >
                        <ul class="ul_picTxtA ulPic_widthA clearfix" >
                                       					                           
                                                                                   
                                <?php $tag['name'] = 'video';$tag['cid'] = '3';$tag['limit'] = '15';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li>
                                <div class="pic">
                                    <img src="<?php echo ($video["picurl"]); ?>" width="110" height="147" loadsrc="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>">
                                    <i class="iTxt"><i class="iTxtBg"></i><span class="sTime"><em class="right"><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?>集
                        <?php else: ?>
                        完结<?php endif; ?></em></span></i>
                                    <i class="pngMap picHoverBg"><a rel="nofollow" href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"></a></i>
                                </div>
                                <span class="sName"><a rel="nofollow" href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a></span>
                                <span class="sDes"><?php echo ($video["actor"]); ?></span>
                            </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                            
                            
                            
                                       					           					                            <li>
       					                          </ul>
                        </div>
                        
                        
                      </div>
                    </div>

                    <div class="mod_b paddingB" id="slideF">
                        <div class="tb_b" id="slideG_Con">
                        	<div>
                          </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="col_b">
        	<div class="mod_c">
            	<div class="th_c"><span class="sMark">动漫分类</span></div>
                <div class="tb_c">
                	<dl class="videoSortList clearfix">
                    	                    	<dt>按类型</dt>
                        <dd>
                        
                <?php
                 $dystypetag = gettypetag(3);
                ?>
                <?php if(is_array($dystypetag)): $i = 0; $__LIST__ = $dystypetag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><span><a rel="nofollow" href="<?php echo getstypetaglink(1,$item['m_cid']);?>" target="_blank"><?php echo ($item["m_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?> 
                        
                        
                        
                      </dd>
                                            	<dt>按地区</dt>
                        <dd>
                        
            <span><a href="/index.php?s=video/lists/id/3/order/addtime/area/内地" target="_blank">内地</a></span> 
            <span><a href="/index.php?s=video/lists/id/3/order/addtime/area/香港" target="_blank">香港</a></span> 
            <span><a href="/index.php?s=video/lists/id/3/order/addtime/area/台湾" target="_blank">台湾</a></span> 
            <span><a href="/index.php?s=video/lists/id/3/order/addtime/area/韩国" target="_blank">韩国</a></span> 
            <span><a href="/index.php?s=video/lists/id/3/order/addtime/area/美国" target="_blank">美国</a></span> 
            <span><a href="/index.php?s=video/lists/id/3/order/addtime/area/泰国" target="_blank">泰国</a></span> 
            <span><a href="/index.php?s=video/lists/id/3/order/addtime/area/日本" target="_blank">日本</a></span> 
            <span><a href="/index.php?s=video/lists/id/3/order/addtime/area/其他" target="_blank">其他</a></span> 
                        
                        
                        
                      </dd>
                                            	<dt>按年代</dt>
                        <dd>
            <span><a href="/index.php?s=video/lists/id/3/order/addtime/year/2013" target="_blank">2013</a></span> 
            <span><a href="/index.php?s=video/lists/id/3/order/addtime/year/2012" target="_blank">2012</a></span> 
            <span><a href="/index.php?s=video/lists/id/3/order/addtime/year/2011" target="_blank">2011</a></span> 
            <span><a href="/index.php?s=video/lists/id/3/order/addtime/year/2010" target="_blank">2010</a></span> 
                      </dd>
                  </dl>
                </div>
                <div class="th_c paddingC"><span class="sMark"><a href="/index.php?s=top10">动漫排行榜</a></span><a href="/index.php?s=top10" class="aMore" rel="nofollow">更多排行>></a></div>
                <div class="tb_c">
                	<ul class="ul_rank ulTxt_widthB clearfix">
                        <?php $tag['name'] = 'video';$tag['cid'] = '3';$tag['limit'] = '15';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><i <?php if($i < 4): ?>class="iFirst"<?php endif; ?>><?php echo ($i); ?></i><a rel="nofollow" href="<?php echo ($video["showurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo (get_replace_html($video["title"],0,14)); ?></a><span class="sScore"><em><?php echo ($video["hits"]); ?></em></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                    </ul>               		                    	                		                    	                		                    	                		                    	                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mod_bottom"></div>
	<!-- comic end -->    
    
    <div class="ekucmsad">
        <?php echo get_cms_ads('inde_960_90_2');?>
	</div>
    <!-- 广告ad end -->
    
    <!-- banner2 start -->
    <!-- <div class="ivy1000"><img src="/images/upload/file/c48b1399943d4c43c002f98c9a13d318.jpg" width="1000" height="90"></div> -->
    <!-- banner2 end -->
    
    <!-- variety start -->
    <div class="mod_z m10 clearfix">
    	<div class="col_a">
        	<div class="mod_a" id="slideD">
            	<div class="th_a"><a href="<?php echo get_channel_name(4,'showurl');?>" target="_blank" class="aMark" title="好看的娱乐节目" id="variety"><span class="sMark">综艺</span></a><a href="<?php echo get_channel_name(4,'showurl');?>" class="aMore" rel="nofollw">更多>></a>
           		</div>
                <div class="tb_a">
                	<div id="slideD_Con">
                    <div>
                    	                		<div class="slideCon" id="variety_tab_content_20" name="variety_tab_content" >
                        <ul class="ul_picTxtA ulPic_widthA clearfix">
                                <?php $tag['name'] = 'video';$tag['cid'] = '4';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li>
                                <div class="pic">
                                    <img src="<?php echo ($video["picurl"]); ?>" width="110" height="147" loadsrc="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>">
                                    <i class="iTxt"><i class="iTxtBg"></i><span class="sTime"><em class="right"><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?>期
                        <?php else: ?>
                        完结<?php endif; ?></em></span></i>
                                    <i class="pngMap picHoverBg"><a rel="nofollow" href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"></a></i>
                                </div>
                                <span class="sName"><a rel="nofollow" href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a></span>
                                <span class="sDes"><?php echo ($video["actor"]); ?></span>
                            </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
						                          </ul>
                                                  
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col_b">
        	<div class="mod_c">
            	<div class="th_c"><span class="sMark">热门综艺</span></div>
                <div class="tb_c">
                	<p class="pHotLabel clearfix">
                        <?php $tag['name'] = 'video';$tag['cid'] = '4';$tag['limit'] = '10';$tag['order'] = 'score desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><a href="<?php echo ($video["showurl"]); ?>" target="_blank"><?php echo (get_replace_html($video["title"],0,8)); ?></a><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                    
                    
               	  </p>
                </div>
                <div class="th_c"><span class="sMark"><a href="/index.php?s=top10">综艺排行榜</a></span></div>
                <div class="tb_c">
                	<ul class="ul_rank ulTxt_widthB clearfix">
                        <?php $tag['name'] = 'video';$tag['cid'] = '4';$tag['limit'] = '10';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><i <?php if($i < 4): ?>class="iFirst"<?php endif; ?>><?php echo ($i); ?></i><a rel="nofollow" href="<?php echo ($video["showurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo (get_replace_html($video["title"],0,14)); ?></a><span class="sScore"><em><?php echo ($video["hits"]); ?></em></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                    </ul>
                  	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                    	                                        </ul>
                </div>
            </div>
            
            <!-- <div class="ivy208"><a href=""><img src="" width="208" height="60"></a></div> -->
        </div> 
    </div>
    <div class="mod_bottom"></div>
    <!-- variety end -->  
<style>
.yq{ width:998px; height:auto; border:1px #CDCDCD solid; overflow:hidden; margin-top:10px; background-color:#FFF;}
.bg1{ background:url(images/bg4.jpg) repeat-x; width:956px; height:auto; margin-left:1px; margin-top:1px; overflow:hidden;}
.yq h1{ width:auto; height:24px; line-height:24px; font-size:14px; padding-left:18px; padding-top:5px;}
.yq1{ width:996px; height:auto; line-height:24px; padding-left:2px; padding-bottom:10px; padding-top:3px;}
.yq1 a{ margin-left:15px; color:#245fb3;}
.yq1 a:hover{ text-decoration:underline;}

</style>  
  
    <div class="yq">
   	<div class="bg1">
    	<h1>友情链接</h1>
        <div class="yq1">
        <?php $tag['name'] = 'link';$tag['limit'] = '100';$tag['order'] = 'type asc,oid desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): ++$i;$mod = ($i % 2 );?><a href="<?php echo ($link["url"]); ?>" target="_blank"><?php echo (get_replace_html($link["title"],0,8)); ?></a><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
       <div class="clear"></div>
        </div>
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




<script type="text/javascript" src="/template/2345/js/default.min.js?v=14"></script>

</body>
</html>