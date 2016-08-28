<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($webtitle); ?></title>
<meta name="keywords" content="<?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($description); ?>">
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">
<link href="/template/LnewY/css/Common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/template/LnewY/js/jquery.min.js"></script>
<script type="text/javascript" src="/template/LnewY/js/Common.js"></script>
<meta property="qc:admins" content="036257777761111633" />
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

<div class="wrap w960"><script src="/ad/960-90.js"></script></div>
<div class="wrap w960">
<div class="maxBox mb10 mt5" id="latest-focus">
  <div class="latest-tab">
    <ul>
      <li id="latest1" onmouseover="setTab(1);" class="active">热门影片推荐</li>
      <li id="latest2" onmouseover="setTab(2);" class="">最新电视剧</li>
      <li id="latest3" onmouseover="setTab(3);" class="">最新电影</li>
      <li id="latest4" onmouseover="setTab(4);" class="">最新动漫</li>
      <li id="latest5" onmouseover="setTab(5);" class="">最新综艺</li>
    </ul>
  </div>
  <SCRIPT language="javascript" type="text/javascript">function setTab(index) {for (var i=1;i<=5;i++){document.getElementById("latest"+i).className ="";document.getElementById("latest"+index).className ="active";document.getElementById("con_latest_"+i).style.display="none";}document.getElementById ("con_latest_"+index).style.display  ="block";}</SCRIPT>
  <div class="box box-blue-bold">
    <div id="con_latest_1" class="hot-latest active" style="display: block; ">

      <ol class="pic-list">
      
		<?php $tag['name'] = 'video';$tag['limit'] = '7';$tag['order'] = 'score desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <a class="play-pic" href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"> <img src="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>">
          <label class="bg">&nbsp;</label>
          <label class="time"><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?>集<?php else: ?>完结<?php endif; ?></label>
          </a>
          <p> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> </p>
        </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
        
      </ol>
      <!-- // pic-list End -->
      <ul class="txt-list">
      <?php $tag['name'] = 'video';$tag['limit'] = '7,12';$tag['order'] = 'score desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <span><?php echo (get_color_date('m-d',$video["addtime"],'#0060A5')); ?></span> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> / <a class="gray" href="<?php echo ($video["readurl"]); ?>"><?php if($video["serial"] > 0): ?><?php echo ($video["serial"]); ?>集<?php else: ?>完结<?php endif; ?></a> </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?> 
      </ul>
      <!-- // txt-list End --> 


    </div>
    <div id="con_latest_2" class="fa-hide" style="display: none; ">
      <ol class="pic-list">
      
		<?php $tag['name'] = 'video';$tag['cid'] = '2';$tag['limit'] = '7';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <a class="play-pic" href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"> <img src="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>">
          <label class="bg">&nbsp;</label>
          <label class="time"><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?>集<?php else: ?>完结<?php endif; ?></label>
          </a>
          <p> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> </p>
        </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
        
      </ol>
      <!-- // pic-list End -->
      <ul class="txt-list">
      <?php $tag['name'] = 'video';$tag['cid'] = '2';$tag['limit'] = '7,12';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <span><?php echo (get_color_date('m-d',$video["addtime"],'#0060A5')); ?></span> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> / <a class="gray" href="<?php echo ($video["readurl"]); ?>"><?php if($video["serial"] > 0): ?><?php echo ($video["serial"]); ?>集<?php else: ?>完结<?php endif; ?></a> </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?> 
      </ul>
      <!-- // txt-list End --> 
    </div>
    <div id="con_latest_3" class="fa-hide" style="display: none; ">

      <ol class="pic-list">
      
		<?php $tag['name'] = 'video';$tag['cid'] = '1';$tag['limit'] = '7';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <a class="play-pic" href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"> <img src="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>">
          <label class="bg">&nbsp;</label>
          <label class="time"><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?>集<?php else: ?>完结<?php endif; ?></label>
          </a>
          <p> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> </p>
        </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
        
      </ol>
      <!-- // pic-list End -->
      <ul class="txt-list">
      <?php $tag['name'] = 'video';$tag['cid'] = '1';$tag['limit'] = '7,12';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <span><?php echo (get_color_date('m-d',$video["addtime"],'#0060A5')); ?></span> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> / <a class="gray" href="<?php echo ($video["readurl"]); ?>"><?php if($video["serial"] > 0): ?><?php echo ($video["serial"]); ?>集<?php else: ?>完结<?php endif; ?></a> </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?> 
      </ul>
      <!-- // txt-list End --> 


    </div>
    <div id="con_latest_4" class="fa-hide" style="display: none; ">
    
      <ol class="pic-list">
      
		<?php $tag['name'] = 'video';$tag['cid'] = '3';$tag['limit'] = '7';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <a class="play-pic" href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"> <img src="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>">
          <label class="bg">&nbsp;</label>
          <label class="time"><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?>集<?php else: ?>完结<?php endif; ?></label>
          </a>
          <p> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> </p>
        </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
        
      </ol>
      <!-- // pic-list End -->
      <ul class="txt-list">
      <?php $tag['name'] = 'video';$tag['cid'] = '3';$tag['limit'] = '7,12';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <span><?php echo (get_color_date('m-d',$video["addtime"],'#0060A5')); ?></span> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> / <a class="gray" href="<?php echo ($video["readurl"]); ?>"><?php if($video["serial"] > 0): ?><?php echo ($video["serial"]); ?>集<?php else: ?>完结<?php endif; ?></a> </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?> 
      </ul>
      <!-- // txt-list End --> 
    
    
    </div>
    <div id="con_latest_5" class="fa-hide" style="display: none; ">
    
      <ol class="pic-list">
      
		<?php $tag['name'] = 'video';$tag['cid'] = '4';$tag['limit'] = '7';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <a class="play-pic" href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"> <img src="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>">
          <label class="bg">&nbsp;</label>
          <label class="time"><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?><?php else: ?>完结<?php endif; ?></label>
          </a>
          <p> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> </p>
        </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
        
      </ol>
      <!-- // pic-list End -->
      <ul class="txt-list">
      <?php $tag['name'] = 'video';$tag['cid'] = '4';$tag['limit'] = '7,12';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <span><?php echo (get_color_date('m-d',$video["addtime"],'#0060A5')); ?></span> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> / <a class="gray" href="<?php echo ($video["readurl"]); ?>"><?php if($video["serial"] > 0): ?><?php echo ($video["serial"]); ?><?php else: ?>完结<?php endif; ?></a> </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?> 
      </ul>
      <!-- // txt-list End --> 

    </div>
  </div>
</div>
<div class="select_list"> <span class="select_list_sTit select_list_sTV"></span>
  <dl class="select_list_style">
    <dt><span>按类型</span></dt>
    <dd  style="height:70px; overflow:hidden"> 
    <?php
    $stypetag = gettypetag(2);
    ?>
    <?php if(is_array($stypetag)): $i = 0; $__LIST__ = $stypetag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><a href="<?php echo getstypetaglink(2,$item['m_cid']);?>" target="_blank"><?php echo ($item["m_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?> 
     </dd>
  </dl>
  <dl class="select_list_address">
    <dt><span>按地区</span></dt>
    <dd  style="height:70px; overflow:hidden"> 
    <?php echo getarealist('cur',2);?>
      </dd>
  </dl>
  <dl class="select_list_year">
    <dt><span>按年代</span></dt>
    <dd style="height:70px; overflow:hidden">
    <?php echo getyearlistnew('cur',9,2);?>
    </dd>
  </dl>
  <dl class="select_list_star" name="mingxing" id="mingxing" style="display: block; ">
    <dt><span>荧幕明星</span><em>(热)</em><a href="javascript:Rmingxing(0);" name="change_star" id="change_star" class="star_changeBtn" target="_self">换一换</a></dt>
    <dd> </dd>
    <script language="javascript" type="text/javascript">Rmingxing(0);</script>
  </dl>
  <dl class="people_all_watch">
    <dt><span>推荐专题：</span></dt>
    <dd>
    
    <?php $tag['name'] = 'special';$tag['limit'] = '3';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$special): ++$i;$mod = ($i % 2 );?><span><a href="<?php echo ($special["readurl"]); ?>" target="_blank"><?php echo ($special["title"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
    
    </dd>
  </dl>
</div>
<div class="maxBox"><?php echo get_cms_ads('inde_960_90');?></div>
<!-- 电视 --> 
<a name="TV"></a>
<div class="maxBox mb10" id="tv">
  <div class="box ui-yiyi fa-clear">
    <label class="videoIco"></label>
    <div class="conBox ui-tab fa-left">
      <div class="caption fa-clear">
        <h2 class="hide-txt"></h2>
        <p class="tv-link">
          <?php $tag['name'] = 'menu';$tag['ids'] = '2'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($menuson["showurl"]); ?>" target="_blank"><?php echo ($menuson["cname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
          </p>
      </div>
      <div class="content">
        <div class="ui-tab-item  fa-clear">
          <div class="sideRow fa-left">
          
          <?php $tag['name'] = 'self';$tag['cid'] = '10';$tag['limit'] = '1'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$self): ++$i;$mod = ($i % 2 );?><div class="ui-focus"> <a class="play-pic" href="<?php echo ($self["link"]); ?>"><img src="<?php echo ($self["picurl"]); ?>" alt="" style="display: block; ">
              <label class="bg">&nbsp;</label>
              <label class="time"><?php echo ($self["title"]); ?></label>
              </a>
              <ul class="ui-focus-text">
                <li><strong>主演：</strong><?php echo ($self["content1"]); ?></li>
                <li style="height:1px; font-size:1px; line-height:1px; margin-top:10px; margin-bottom:10px; background-color:#EFEFEF;"></li>
                <li class="desc" style="font-size:12px; line-height:22px; height:90px;"><strong>简介：</strong><?php echo ($self["content"]); ?></li>
              </ul>
            </div><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>   
            
            <?php $tag['name'] = 'self';$tag['cid'] = '12';$tag['limit'] = '3'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$self): ++$i;$mod = ($i % 2 );?><div style="width:260px; height:100px; background-color:#FFF; margin-top:10px;">
            	<a href="<?php echo ($self["link"]); ?>"><img src="<?php echo ($self["picurl"]); ?>" alt="<?php echo ($self["title"]); ?>" style="border:0px;" /></a>
            </div><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            
            
            <!-- // ui-focus End -->
            
            <!-- // ui-synch End --></div>
          <div class="pic-list pic-list-focus">
            <ul>
              <?php $tag['name'] = 'video';$tag['cid'] = '2';$tag['limit'] = '9';$tag['order'] = 'score desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <a class="play-pic" href="<?php echo ($video["readurl"]); ?>"> <img src="<?php echo ($video["picurl"]); ?>" style="display: block; "> <span class="play-icon">&nbsp;</span>
                  <label class="bg">&nbsp;</label>
                  <label class="time"><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?>
                      <?php else: ?>
                      完结<?php endif; ?></label>
                  </a>
                  <p> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> </p>
                  <p class="txt"><?php echo (get_actor_url(get_replace_html($video["actor"],0,10))); ?></p>
                </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            </ul>
          </div>
          <!-- // pic-list End --> 
        </div>
        <!-- // ui-tab-item End -->
        
      </div>
    </div>
    <!-- // conBox End -->
    <div class="sideBar fa-right">
      <div class="ui-top-tab">
        <div class="caption fa-clear">
          <h3><a href="http://list.yiyi.cc/">电视剧最新更新</a></h3>
        </div>
        <div class="content">
          <ul class="ul-top">
            <?php $tag['name'] = 'video';$tag['cid'] = '2';$tag['limit'] = '10';$tag['order'] = 'score desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span><strong><?php echo (get_color_date('m-d',$video["addtime"],'#666')); ?></strong></span> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
          </ul>
        </div>
      </div>
      <!-- // topBox End -->
      
      <div class="ui-sort">
        <div class="caption">
          <h3> <a href="#">电视剧类型</a> </h3>
        </div>
        <div class="tb_c">
        
        
        
        
          <dl class="videoSortList clearfix">
            <dt>按类型</dt>
            <dd>
    <?php if(is_array($stypetag)): $i = 0; $__LIST__ = $stypetag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><span><a href="<?php echo getstypetaglink(2,$item['m_cid']);?>" target="_blank"><?php echo ($item["m_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?> 
            </dd>
            
            
            <dt>按地区</dt>
            <dd> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/area/内地" target="_blank">内地</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/area/香港" target="_blank">香港</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/area/台湾" target="_blank">台湾</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/area/韩国" target="_blank">韩国</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/area/美国" target="_blank">美国</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/area/泰国" target="_blank">泰国</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/area/日本" target="_blank">日本</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/area/其他" target="_blank">其他</a></span> 
            
             </dd>
            <dt>按年代</dt>
            <dd>
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/year/2013" target="_blank">2013</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/year/2012" target="_blank">2012</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/year/2011" target="_blank">2011</a></span> 
            <span><a href="/index.php?s=video/lists/id/2/order/addtime/year/2010" target="_blank">2010</a></span> 
             </dd>
            <dt>按明星</dt>
            <dd> <span><a href="/index.php?s=video/search/wd/张嘉译" target="_blank">张嘉译</a></span> 
            <span><a href="/index.php?s=video/search/wd/赵本山" target="_blank">赵本山</a></span> 
            <span><a href="/index.php?s=video/search/wd/吴京" target="_blank">吴京</a></span> 
            <span><a href="/index.php?s=video/search/wd/杨幂" target="_blank">杨幂</a></span> 
            </dd>
          </dl>
        </div>
      </div>
      <!-- // ui-sort End --> 
    </div>
  </div>
</div>
<!-- 电影 -->
<div class="maxBox mb10" id="Movie">
  <div class="box ui-yiyi fa-clear">
    <label class="videoIco"></label>
    <div class="conBox ui-tab fa-left">
      <div class="caption fa-clear">
        <h2 class="hide-txt"> </h2>
        <p class="tv-link">
          <?php $tag['name'] = 'menu';$tag['ids'] = '1'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($menuson["showurl"]); ?>" target="_blank"><?php echo ($menuson["cname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
        </p>
      </div>
      <div class="content">
        <div class="ui-tab-item fa-clear">
          <div class="sideRow fa-left">
          <?php $tag['name'] = 'self';$tag['cid'] = '11';$tag['limit'] = '1'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$self): ++$i;$mod = ($i % 2 );?><div class="ui-focus"> <a class="play-pic" href="<?php echo ($self["link"]); ?>"><img src="<?php echo ($self["picurl"]); ?>" alt="<?php echo ($self["title"]); ?>" style="display: block; ">
              <label class="bg">&nbsp;</label>
              <label class="time"><?php echo ($self["title"]); ?></label>
              </a>
              <ul class="ui-focus-text">
                <li><strong>主演：</strong><?php echo ($self["content1"]); ?></li>
                <li style="height:1px; font-size:1px; line-height:1px; margin-top:10px; margin-bottom:10px; background-color:#EFEFEF;"></li>
                <li class="desc"><strong>简介：</strong><?php echo ($self["content"]); ?></li>
              </ul>
            </div><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            
            <?php $tag['name'] = 'self';$tag['cid'] = '13';$tag['limit'] = '3'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$self): ++$i;$mod = ($i % 2 );?><div style="width:260px; height:100px; background-color:#FFF; margin-top:10px;">
            <a href="<?php echo ($self["link"]); ?>"><img src="<?php echo ($self["picurl"]); ?>" alt="<?php echo ($self["title"]); ?>" style="border:0px;" /></a>
            </div><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            
            <!-- // ui-synch End --></div>
          <div class="pic-list pic-list-focus">
            <ul>
              <?php $tag['name'] = 'video';$tag['cid'] = '1';$tag['limit'] = '9';$tag['order'] = 'score desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li> <a class="play-pic" href="<?php echo ($video["readurl"]); ?>"> <img src="<?php echo ($video["picurl"]); ?>" style="display: block; "> <span class="play-icon">&nbsp;</span>
                  <label class="bg">&nbsp;</label>
                  <label class="time"><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?>
                      <?php else: ?>
                      完结<?php endif; ?></label>
                  </a>
                  <p> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> </p>
                  <p class="txt">讲述由20世纪80年代至今大时代下三个年轻人</p>
                </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            </ul>
          </div>
          <!-- // pic-list End --> 
        </div>
      </div>
    </div>
    <!-- // conBox End -->
    <div class="sideBar fa-right">
      <div class="ui-top-tab">
        <div class="caption fa-clear">
          <h3><a href="#">电影排行榜</a></h3>
        </div>
        <div class="content">
          <ul class="ul-top">
            <?php $tag['name'] = 'video';$tag['cid'] = '1';$tag['limit'] = '10';$tag['order'] = 'score desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span><strong><?php echo ($video["score"]); ?> 分</strong></span> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
          </ul>
        </div>
      </div>
      <!-- // topBox End -->
      
      <div class="ui-sort">
        <div class="caption">
          <h3> <a href="#">电影类型</a> </h3>
        </div>
        <div class="tb_c">
          <dl class="videoSortList clearfix">
            <dt>按类型</dt>
            <dd>
            <?php
             $dystypetag = gettypetag(1);
            ?>
                <?php if(is_array($dystypetag)): $i = 0; $__LIST__ = $dystypetag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><span><a href="<?php echo getstypetaglink(1,$item['m_cid']);?>" target="_blank"><?php echo ($item["m_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?> 
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
            <dd> <span><a href="/index.php?s=video/search/wd/甄子丹" target="_blank">甄子丹</a></span> 
            <span><a href="/index.php?s=video/search/wd/成龙" target="_blank">成龙</a></span> 
            <span><a href="/index.php?s=video/search/wd/范冰冰" target="_blank">范冰冰</a></span> 
            <span><a href="/index.php?s=video/search/wd/周星驰" target="_blank">周星驰</a></span> 
            </dd>
          </dl>
        </div>
      </div>
      <!-- // ui-sort End --> 
    </div>
  </div>
</div>
<!-- 动漫 --> 
<a name="cartoonm" id="cartoonm"></a>
<div class="maxBox mb10" id="Cartoon">
  <div class="box ui-yiyi fa-clear">
    <label class="videoIco"></label>
    <div class="conBox ui-tab fa-left">
      <div class="caption fa-clear">
        <h2 class="hide-txt"></h2>
        <p class="tv-link"><!--A链接--></p>
      </div>
      <div class="content">
        <div class="ui-tab-item fa-clear">
          <ol class="pic-list pic-list-focus">
            <?php $tag['name'] = 'video';$tag['cid'] = '3';$tag['limit'] = '15';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li style=" height:202px;"> <a class="play-pic" href="<?php echo ($video["readurl"]); ?>"> <img src="<?php echo ($video["picurl"]); ?>" style="display: block; "> <span class="play-icon">&nbsp;</span>
                <label class="bg">&nbsp;</label>
                <label class="time"><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?>
                      <?php else: ?>
                      完结<?php endif; ?></label>
                </a>
                <p> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> </p>
              </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
          </ol>
          <!-- // pic-list End --> 
        </div>
        <!-- // ui-tab-item End -->
      </div>
    </div>
    <!-- // conBox End -->
    <div class="sideBar fa-right">
      <div class="ui-top-tab">
        <div class="caption fa-clear">
          <h3><a href="#">动漫排行榜</a></h3>
        </div>
        <div class="content">
          <ul class="ul-top">
            <?php $tag['name'] = 'video';$tag['cid'] = '3';$tag['limit'] = '10';$tag['order'] = 'score desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span><strong><?php echo (get_color_date("m-d",$video["addtime"],'#666')); ?></strong></span> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
          </ul>
        </div>
      </div>
      <!-- // topBox End -->
      
      <div class="ui-sort">
        <div class="caption">
          <h3> <a href="#">动漫类型</a> </h3>
        </div>
        <div class="tb_c">
          <dl class="videoSortList clearfix">
            <dt>按类型</dt>
            <dd>
            <?php
             $dystypetag = gettypetag(3);
            ?>
                <?php if(is_array($dystypetag)): $i = 0; $__LIST__ = $dystypetag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><span><a href="<?php echo getstypetaglink(1,$item['m_cid']);?>" target="_blank"><?php echo ($item["m_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?> 
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
      </div>
      <!-- // ui-sort End --> 
    </div>
  </div>
</div>
<!-- 综艺节目 --> 
<a name="variety" id="varietym"></a>
<div class="maxBox mb10" id="Variety">
<div class="box ui-yiyi fa-clear">
<label class="videoIco"></label>
<div class="conBox ui-tab fa-left">
  <div class="caption fa-clear">
    <h2 class="hide-txt"></h2>
    <p class="tv-link"> </p>
  </div>
  <div class="content">
    <div class="ui-tab-item  fa-clear">
      <ol class="pic-list pic-list-focus">
        <?php $tag['name'] = 'video';$tag['cid'] = '4';$tag['limit'] = '15';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li style="height:202px;"> <a class="play-pic" href="<?php echo ($video["readurl"]); ?>"> <img src="<?php echo ($video["picurl"]); ?>" style="display: block; "> <span class="play-icon">&nbsp;</span>
            <label class="bg">&nbsp;</label>
            <label class="time"><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?>
                      <?php else: ?>
                      完结<?php endif; ?></label>
            </a>
            <p> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a> </p>
          </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
      </ol>
      <!-- // pic-list End --> 
    </div>
    <!-- // ui-tab-item End -->
    <div class="mod_b paddingA">
    </div>
  </div>
</div>
<!-- // conBox End -->
<div class="sideBar fa-right">
<div class="ui-top-tab">
  <div class="caption fa-clear">
    <h3><a href="#">综艺最新更新</a></h3>
  </div>
  <div class="content">
    <ul class="ul-top">
    
            <?php $tag['name'] = 'video';$tag['cid'] = '4';$tag['limit'] = '20';$tag['order'] = 'score desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span><strong><?php echo (get_color_date("m-d",$video["addtime"],'#666')); ?></strong></span> <a href="<?php echo ($video["readurl"]); ?>" title="<?php echo ($video["title"]); ?>"><?php echo ($video["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
    
    </ul>
  </div>
</div>
<!-- // topBox End -->

<!-- // ui-sort End -->
</div>
</div>
</div>




<?php
 $stypetag = gettypetag(2);
?>
<div class="maxBox listc">
  <div class="box">
    <div class="silder-box" id="index-silder">
      <ol class="index-list">
        <li>
          <dl>
            <dt> 电视剧 </dt>
        <?php if(is_array($stypetag)): $i = 0; $__LIST__ = $stypetag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><dd><a href="<?php echo getstypetaglink(2,$item['m_cid']);?>" target="_blank"><?php echo ($item["m_name"]); ?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?> 
          </dl>
        </li>
        <li>
          <dl>
            <dt> 电影 </dt>
            <?php
             $dystypetag = gettypetag(1);
            ?>
        <?php if(is_array($dystypetag)): $i = 0; $__LIST__ = $dystypetag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><dd><a href="<?php echo getstypetaglink(1,$item['m_cid']);?>" target="_blank"><?php echo ($item["m_name"]); ?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?> 
          </dl>
        </li>
        <li>
          <dl class="dm">
            <dt> 动漫 </dt>
            <?php
             $dystypetag = gettypetag(3);
            ?>
        <?php if(is_array($dystypetag)): $i = 0; $__LIST__ = $dystypetag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><dd><a href="<?php echo getstypetaglink(3,$item['m_cid']);?>" target="_blank"><?php echo ($item["m_name"]); ?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?> 
          </dl>
        </li>
        <li>
          <dl class="zy">
            <dt> 综艺娱乐 </dt>
            <?php
             $dystypetag = gettypetag(4);
            ?>
        <?php if(is_array($dystypetag)): $i = 0; $__LIST__ = $dystypetag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><dd><a href="<?php echo getstypetaglink(4,$item['m_cid']);?>" target="_blank"><?php echo ($item["m_name"]); ?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?> 
          </dl>
        </li>
      </ol>
    </div>
    <div class="index-search fa-clear">
      <div class="FormSearch">
        <form target="_top" action="/index.php?s=video/search/" method="post">
          <div class="searchForm clearfix">
            <input class="searchInput" type="text" autocomplete="off" name="wd" id="wd" value="请在此处输入影片片名或演员名称。" onfocus="if(this.value=='请在此处输入影片片名或演员名称。'){this.value='';}" onblur="if(this.value==''){this.value='请在此处输入影片片名或演员名称。';};">
            <input type="submit" value="" class="searchSubmit">
          </div>
        </form>
      </div>
      <div class="hotKeys fa-right"> <strong> 热门搜索： </strong> <?php echo ($hotkey); ?> </div>
    </div>
  </div>
</div>














<div class="IndexLink">
  <div class="mod_cooperation">
    <center>
      <?php echo get_cms_ads('inde_960_90_2');?>
    </center>
    <h2 class="mod_tit">合作伙伴</h2>
    <div class="mod_cont">
      <ul>
      <?php $tag['name'] = 'link';$tag['limit'] = '100';$tag['order'] = 'type asc,oid desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): ++$i;$mod = ($i % 2 );?><li><a href="<?php echo ($link["url"]); ?>" target="_blank"><?php echo (get_replace_html($link["title"],0,8)); ?></a></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
      </ul>
    </div>
  </div>
</div>
<!-- 浮动 -->
<div class="rightMenu" style="display: block; position: fixed; top: 340px; " id="rightMenu"> <a href="/?s=video/lists/id/1.html" target="_self">电影</a> <a href="/?s=video/lists/id/2.html" target="_self">电视剧</a> <a href="/?s=video/lists/id/3.html" target="_self">动漫</a> <a href="/?s=video/lists/id/4.html" target="_self">综艺</a> <a href="javascript:window.scrollTo(0, 0);" target="_self" class="backTop"></a>
  <div class="fa-clear"></div>
</div>
<script type="text/javascript" src="/template/LnewY/js/SiteEnd.js"></script>
</div>

<!--网站底部-->
<div class="foot">
	<p class="copyrighten"><?php echo ($copyright); ?></p>
	<p class="copyrighten2"> Copyright © 2007 - 2011 <a href="<?php echo ($weburl); ?>"><?php echo ($webname); ?></a> Some Rights Reserved <?php echo ($icp); ?> <?php echo ($tongji); ?> <a href="<?php echo ($baidusitemap); ?>">sitemap</a> <a href="<?php echo ($googlesitemap); ?>">sitemap</a><br /></p>
	<span style="display:none;"><script language="javascript" type="text/javascript" src="http://js.users.51.la/15665491.js"></script></span>
</div>

</body>
</html>