<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($webtitle); ?></title>
<meta name="keywords" content="<?php echo ($ckeywords); ?><?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($cdescription); ?><?php echo ($description); ?>">
<link href="/template/LnewY/css/Common.css" rel="stylesheet" type="text/css" />
<link href="/template/LnewY/css/channel.css" rel="stylesheet" type="text/css" />
<link href="/template/LnewY/css/content.css" rel="stylesheet" type="text/css" />
<script language="javascript">var SitePath='<?php echo ($webpath); ?>';var SiteMid='<?php echo ($mid); ?>';var SiteCid='<?php echo ($cid); ?>';var SiteId='<?php echo ($id); ?>';</script>
<script type="text/javascript" src="/template/LnewY/js/jquery.min.js"></script>
<script type="text/javascript" src="/template/LnewY/js/Common.js"></script>
</head>

<body>
<div class="header">
		<div class="topBar">
		<div class="w960">
			<div class="Top-sign fa-left">
				<div class="TopUser" id="TopUser">
hi，                
<script language="javaScript"> 
now = new Date(),hour = now.getHours() 
if(hour < 6){document.write("凌晨好，为了您的家人，该休息了，注意身体哦！")} 
else if (hour < 9){document.write("早上好，早起的鸟有食吃！")} 
else if (hour < 12){document.write("上午好，用最珍贵的上午时间处理好一天的事情吧！")} 
else if (hour < 14){document.write("中午好，该吃饭了！")} 
else if (hour < 17){document.write("下午好，大起精神，等待下班！")} 
else if (hour < 19){document.write("傍晚好，去河边，享受吧！")} 
else if (hour < 22){document.write("晚上好，该看中国好声音了！")} 
else {document.write("夜里好，为了您的家人，该休息了，注意身体哦！")} 

</script>                
                
               </div>
			</div>
			<div class="Top-a fa-right">
				<p>
					<!--<a id="a-home" href="javascript:void(0);" onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://www.yiyi.cc/')">设为首页</a>
					<em>&nbsp;</em>-->
					<a id="a-sc" href="javascript:void(0);javascript:try{ window.external.AddFavorite('<?php echo ($weburl); ?>','<?php echo ($webname); ?>'); } catch(e){ (window.sidebar)?window.sidebar.addPanel('<?php echo ($webname); ?>','<?php echo ($weburl); ?>',''):alert('请使用按键 Ctrl+d，<?php echo ($webname); ?>'); }">加入收藏</a>
					<em>&nbsp;</em>
				<a href="/index.php?s=Guestbook" id="a-gbook" class="color">网站留言</a><!--
					<em>&nbsp;</em>
					<a href="/live/" id="a-tvh">在线直播</a>
					<em>&nbsp;</em>
					<a href="/new.html" id="a-new">最新更新</a>--></p>
			</div>
		</div>
	</div>
	<div class="headerContent clearfix">
			<div class="headerLogo fa-left">
				<a href="/" target="_self">
					<img src="/template/LnewY/images/headerLogoBg.png" width="210" height="57" title="一一影院" alt="一一影院">
				</a>
				<!--<span>yiyi影院(www.yiyi.cc)</span>-->
			</div>
			<div class="headerSearch fa-right">
				<div class="SearchTop">
					<div class="FormSearch">
					<form id="search_form" target="_top" onSubmit="return clickCount();" action="/index.php?s=video/search/" method="POST">
						<div class="searchForm clearfix" id="searchForm">
							<input class="searchInput" type="text" autocomplete="off" name="wd" id="wd" value="请在此处输入影片片名或演员名称。" onfocus="if(this.value=='请在此处输入影片片名或演员名称。'){this.value='';}" onblur="if(this.value==''){this.value='请在此处输入影片片名或演员名称。';};">
							<input type="submit" value="" class="searchSubmit">
						</div>
					</form>
					</div>
					<div class="headerHistory" id="headerHistory">
						<span class="spanB">
							<a href="/index.php?s=top10" target="_blank">影视排行榜</a>
						</span>
						<a href="javascript:void(0);" onclick="ToggleRecord();" class="headerHistoryBtn" id="headerHistoryBtn">观看记录</a>
						<div class="clear">
						</div>
						<div class="historyContent" id="historyContent" style="display: none; ">
							<div id="historyClose" class="historyClose">
								<a href="javascript:void(0);" onclick="TrunRecord(0);return false;">清空记录</a>|<a href="" class="historyCloseBtn" onclick="ToggleRecord();return false;">关闭</a>
							</div>
							<div class="historyList" id="historyList">
								<ul class="ulHistoryList clearfix"></ul>
								<script>PlayRecords();</script>
							</div>
						</div>
					</div>
				</div>
				<div class="searchHotWords" id="searchHotWords">热门搜索：<?php echo ($hotkey); ?>
				</div>
			</div>
	</div>
	<div class="menuBar">
		<div class="menu w960 fa-clear">
			<ul class="menulistA">
            
				<li <?php if($model == 'index'): ?>class="current"<?php endif; ?> onMouseOver="smenuTab(0);"><a target="_self" href="/">首页</a></li>
                
                <?php $tag['name'] = 'menu'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><li  onMouseOver="smenuTab(<?php echo ($menu["id"]); ?>);" <?php if(($menu['id'] == $cid) or ($menu['id'] == $pid)): ?>class="current"<?php endif; ?>><a target="_self" href="<?php echo ($menu["showurl"]); ?>"><?php echo ($menu["cname"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                
                
				<li  onMouseOver="smenuTab(1);"><a target="_self" href="/tv/" style="display:none;">电视剧</a></li>
				<li  onMouseOver="smenuTab(2);"><a target="_self" href="/movie/"  style="display:none;">电影</a></li>
				<li  onMouseOver="smenuTab(3);"><a target="_self" href="/cartoon/"  style="display:none;">经典动漫</a></li>
				<li  onMouseOver="smenuTab(4);"><a target="_self" href="/film8/"  style="display:none;">综艺娱乐</a></li>
                
                
                
				<li  onMouseOver="smenuTab(0);"><a target="_self" href="/index.php?s=top10">排 行 榜</a></li>
				<li  onMouseOver="smenuTab(0);"><a target="_self" href="<?php echo getspecialurl();;?>">专题</a></li>
				<li  onMouseOver="smenuTab(0);"><a target="_self" href="/index.php?s=tv">电视直播</a></li>
			</ul>
		</div>
		<!-- // Menu End -->
	</div>
	<div class="navBar">
		<div class="nav w960 fa-clear" id="showList">
			<div class="index-tags fa-clear">
				<div class="index-tags-tv fa-left" id="index-tags">
					<label class="tv">电视剧：</label>
                  <?php $tag['name'] = 'menu';$tag['ids'] = '2'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($menuson["showurl"]); ?>" target="_blank"><?php echo ($menuson["cname"]); ?></a><em>|</em><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
				</div>
                
				<div class="index-tags-movie fa-right">
					<label class="movie">电影：</label>
                    
                      <?php $tag['name'] = 'menu';$tag['ids'] = '1'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($menuson["showurl"]); ?>" target="_blank"><?php echo ($menuson["cname"]); ?></a><em>|</em><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
          
				</div>
			</div>
            
			<div class="index-tags fa-clear" id="index-tagsb">
				<div class="index-tags-movie sline">
					<label class="movie">电影：</label>
                      <?php $tag['name'] = 'menu';$tag['ids'] = '1'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($menuson["showurl"]); ?>" target="_blank"><?php echo ($menuson["cname"]); ?></a><em>|</em><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
				</div>
			</div>
            
            
			<div class="index-tags fa-clear">
				<div class="index-tags-tv sline" id="index-tagsa">
					<label class="tv">电视剧：</label>
          <?php $tag['name'] = 'menu';$tag['ids'] = '2'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($menuson["showurl"]); ?>" target="_blank"><?php echo ($menuson["cname"]); ?></a><em>|</em><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
          
				</div>
			</div>
            
            
			<div class="index-tags fa-clear" id="index-tagsc">
				<div class="index-tags-dm sline">
					</div>
			</div>
			<div class="index-tags fa-clear" id="index-tagsd">
				<div class="index-tags-zy sline">
					</div>
			</div>
		</div>
		<!-- // Nav End -->
		<SCRIPT language="javascript" type="text/javascript">
		function smenuTab(index) {
			$("#showList .index-tags").stop(true,false).hide().eq(index).stop(true,false).show();
		}
		smenuTab(0)
		</SCRIPT>

	</div>
</div>

<div class="wrap w960">
  <div class="maxBox">
    <div class="box">
      <div class="video-box">
        <div class="d-title">
          <h2><?php echo ($title); ?>(<?php echo ($cname); ?>)</h2>
          <dl>
            <dd><a class="pCollect" id="pCollect" href="javascript:void(0);" onclick="yiyi.user.Collect()">收藏</a></dd>
            <dd><a class="pRss" id="pRss" href="javascript:void(0);" onclick="yiyi.user.Rss();">订阅</a></dd>
          </dl>
        </div>
        <div class="introduce" id="introduce">
          <div class="vod-img"><a href="#"><img onerror="this.src='<?php echo ($webpath); ?>views/images/nophoto.jpg'" src="<?php echo ($picurl); ?>" alt="爱回家(TVB电视剧)"></a></div>
          <div class="vod-c">
            <div class="vod_bigc">
              <div class="vod_l">
                <div class="info">
                  <dl class="Actor">
                    <dt>主演：</dt>
                    <dd>
                      <?php if(!empty($actor)): ?><?php echo (get_actor_url($actor)); ?>
                        <?php else: ?>
                        未知<?php endif; ?>
                    </dd>
                  </dl>
                  <dl class="status">
                    <dt>状态：</dt>
                    <dd>
                      <?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?>
                        <?php else: ?>
                        完结<?php endif; ?>
                    </dd>
                  </dl>
                  <dl class="Lang">
                    <dt>语言：</dt>
                    <dd>粤语发音 中文字幕</dd>
                  </dl>
                  <dl class="Age">
                    <dt>年份：</dt>
                    <dd><?php echo ($year); ?></dd>
                  </dl>
                  <dl class="Type">
                    <dt>类型：</dt>
                    <dd><a href="<?php echo ($showurl); ?>"><?php echo ($cname); ?></a> <?php echo (eku_stype_url($stype_mcid,$cid)); ?></span></dd>
                  </dl>
                  <dl class="Direct">
                    <dt>导演：</dt>
                    <dd>
                      <?php if(!empty($director)): ?><?php echo ($director); ?>
                        <?php else: ?>
                        未知<?php endif; ?>
                    </dd>
                  </dl>
                  <dl class="Time">
                    <dt>时间：</dt>
                    <dd><?php echo (get_color_date('Y-m-d H:i:s',$addtime,'#999')); ?></dd>
                  </dl>
                  <dl class="gather">
                    <dt>集数：</dt>
                    <dd>265集</dd>
                  </dl>
                  <dl class="Intr">
                    <dt>剧情：</dt>
                    <dd><span><?php echo (get_replace_html(htmlspecialchars_decode($content),0,100)); ?>...</span><a href="#Introduce">详细剧情</a></dd>
                  </dl>
                </div>
              </div>
              <div class="vod_r" id="ad_300_01">
              <?php echo get_cms_ads('play_250_250');?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wrap w960" id="ad_960_02"></div>
  <div class="maxBox"> 
    
    <!--百度影音-->
    <?php if(is_array($ppplay)): $i = 0; $__LIST__ = $ppplay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 )?><div class="box Video-list">
        <div class="play-list b mb">
          <div class="title">
            <h3><span class="p_{{$video.playname}}"></span><?php echo ($video["playername"]); ?> <span class="tips">( <a href="http://dl.p2sp.baidu.com/BaiduPlayer/un2/BaiduPlayerNetSetup_100820182.exe

" target="_blank">点击下载百度影音播放器(2013年03月25号最新高速版）</a> )</span></h3>
            <span class="pa order hascoll"> 排序：<a id="desc_1" class="desc" href="javascript:void(0);" onclick="desc(1,1,this)">降序</a> <em>|</em> <a id="asc_1" href="javascript:void(0);" class="asc asc_on" onclick="desc(0,1,this)">升序</a> </span> </div>
          <div id="play_1">
            <ul>
              <?php if(is_array($video['son'])): $ii = 0; $__LIST__ = $video['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ppvodson): ++$ii;$mod = ($ii % 2 )?><li> <a target='_blank' title='<?php echo ($ppvodson["playname"]); ?>' href='<?php echo ($ppvodson["playurl"]); ?>'><?php echo ($ppvodson["playname"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </div>
        </div>
      </div><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
  <div class="wrap w960" id="ad_960_03"></div>
  <div class="maxBox mb10">
    <div class="box BigBox">
      <div class="title">
        <h3>热门<?php echo ($cname); ?>：</h3>
      </div>
      <div class="hotVideo">
        <ul class="pic-list">
        <?php $tag['name'] = 'video';$tag['limit'] = '7';$tag['cid'] = ''.$cid.'';$tag['order'] = 'score desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <a class="play-pic" href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"> <img src="<?php echo ($video["picurl"]); ?>" style="display: block; "> <span class="play-icon">&nbsp;</span>
            <label class="bg">&nbsp;</label>
            <label class="time">全集</label>
            </a>
            <p> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> </p>
            <p class="txt">
            <?php if(!empty($actor)): ?><?php echo (get_actor_url($video["actor"])); ?>
                        <?php else: ?>
                        未知<?php endif; ?>
            </p>
          </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>  
        </ul>
      </div>
    </div>
  </div>
  <a name="Introduce" id="Introduce"></a>
  <div class="maxBox mb10">
    <div class="box BigBox">
      <div class="title">
        <h3>《<?php echo ($title); ?><?php echo ($cname); ?>》剧情介绍：</h3>
      </div>
      <div class="introduction">
        <p><?php echo (htmlspecialchars_decode($content)); ?></p>
        <p>&nbsp;</p>
      </div>
    </div>
  </div>
  <div class="maxBox mb10">
    <div class="box BigBox">
      <div class="title">
        <h3>《<?php echo ($title); ?><?php echo ($cname); ?>》评论：</h3>
      </div>
      <div class="introduction"> 
        <!-- UY BEGIN -->
        <div id="uyan_frame"></div>
        <script type="text/javascript" id="UYScript" src="http://v1.uyan.cc/js/iframe.js?UYUserId=<?php echo ($youyan_id); ?>" async=""></script> 
        <!-- UY END --> 
      </div>
    </div>
  </div>
</div>

<!--网站底部-->
<div class="foot">
	<p class="copyrighten"><?php echo ($copyright); ?></p>
	<p class="copyrighten2"> Copyright © 2007 - 2011 <a href="<?php echo ($weburl); ?>"><?php echo ($webname); ?></a> Some Rights Reserved <?php echo ($icp); ?> <?php echo ($tongji); ?> <a href="<?php echo ($baidusitemap); ?>">sitemap</a> <a href="<?php echo ($googlesitemap); ?>">sitemap</a><br /></p>
	<span style="display:none;"><script language="javascript" type="text/javascript" src="http://js.users.51.la/15665491.js"></script></span>
</div>

</div>
<!--wapper 结束-->

</body>
</html>