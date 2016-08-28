<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>添加/编辑视频</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>

<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/admin_all.js"></script>
<script language="javascript" type="text/javascript" charset="utf-8" src="./views/editor/kindeditor.js"></script>
<script language="javascript" type="text/javascript" charset="utf-8" src="./views/editor/lang/zh_CN.js"></script>

<script src="./views/mobiscroll/js/zepto.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.zepto.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.core.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.scroller.js" type="text/javascript"></script>

<script src="./views/mobiscroll/js/mobiscroll.datetime.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.select.js" type="text/javascript"></script>

<script src="./views/mobiscroll/js/mobiscroll.scroller.ios.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.scroller.android.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.scroller.android-ics.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.scroller.wp.js" type="text/javascript"></script>

<script src="./views/mobiscroll/js/mobiscroll.i18n.zh.js" type="text/javascript"></script>

<link href="./views/mobiscroll/css/mobiscroll.scroller.css" rel="stylesheet" type="text/css" />
<link href="./views/mobiscroll/css/mobiscroll.scroller.android.css" rel="stylesheet" type="text/css" />
<link href="./views/mobiscroll/css/mobiscroll.scroller.android-ics.css" rel="stylesheet" type="text/css" />
<link href="./views/mobiscroll/css/mobiscroll.scroller.ios.css" rel="stylesheet" type="text/css" />
<link href="./views/mobiscroll/css/mobiscroll.scroller.sense-ui.css" rel="stylesheet" type="text/css" />
<link href="./views/mobiscroll/css/mobiscroll.scroller.wp.css" rel="stylesheet" type="text/css" />

<link href="./views/mobiscroll/css/mobiscroll.animation.css" rel="stylesheet" type="text/css" />
    

</head>
<body> 
<?php if(($id)  >  "0"): ?><form name="gxform" action="?s=Admin/Video/Updatelive" method="post" id="gxform" onsubmit="return check();">
	<input type="hidden" name="id" value="<?php echo ($id); ?>">
<?php else: ?>
	<form name="gxform" action="?s=Admin/Video/Insertlive" method="post" id="gxform" onsubmit="return check();"><?php endif; ?>
<input type="hidden" name="cid" value="<?php echo ($cid); ?>" />
<input type="hidden" name="filename" value="<?php echo ($filename); ?>" />
<input type="hidden" name="color" value="#FF0000" />
<input type="hidden" name="hits" value="<?php echo (($hits)?($hits):'0'); ?>" />
<input type="hidden" name="keywords" value="<?php echo (($keywords)?($keywords):''); ?>" />
<input type="hidden" name="area" value="<?php echo (($area)?($area):''); ?>" />
<input type="hidden" name="inputer" value="<?php echo (($inputer)?($inputer):''); ?>" />
<input type="hidden" name="downurl" value="<?php echo (($downurl)?($downurl):''); ?>" />
<input type="hidden" name="selftitle" value="<?php echo (($selftitle)?($selftitle):''); ?>" />
<input type="hidden" name="selfkeywords" value="<?php echo (($selfkeywords)?($selfkeywords):''); ?>" />
<input type="hidden" name="selfdescription" value="<?php echo (($selfdescription)?($selfdescription):''); ?>" />
<input type="hidden" name="scoreer" value="<?php echo (($scoreer)?($scoreer):'1'); ?>" />
<input type="hidden" name="letter" value="<?php echo (($letter)?($letter):''); ?>" />
<input type="hidden" name="monthhits" value="<?php echo (($monthhits)?($monthhits):''); ?>" />
<input type="hidden" name="weekhits" value="<?php echo (($weekhits)?($weekhits):''); ?>" />
<input type="hidden" name="dayhits" value="<?php echo (($dayhits)?($dayhits):''); ?>" />
<input type="hidden" name="up" value="<?php echo (($up)?($up):''); ?>" />
<input type="hidden" name="down" value="<?php echo (($down)?($down):''); ?>" />
<input type="hidden" name="addtime" value="<?php echo (($addtime)?($addtime):''); ?>" />
<input type="hidden" name="reurl" value="<?php echo (($reurl)?($reurl):''); ?>" />
<input type="hidden" name="addtime" value="<?php echo (date('Y-m-d H:i:s',$addtime)); ?>" /> 
<input type="hidden" name="subid" value="<?php echo ($subid); ?>" />
<input type="hidden" name="channel_id" value="<?php echo ($channel_id); ?>" />

<input type="hidden" name="tid" value="<?php echo ($tid); ?>" />

<table cellpadding="0" cellspacing="0" class="boxadd">
<tr class="tabs_title">
    <td>
    	<span id="tabs" class="fl">
    		<a class="on" href="javascript:void(0)" name="1,2" hideFocus='true'><?php echo ($tpltitle); ?>直播</a>
    	</span>    
    	<span class="fr"><a href="?s=Admin/Video/Show" class="no">返回数据管理</a></span>
    </td>
</tr>
<tr><td>
<div id="showtab_1" style="border-top:1px solid #C6DCF2;">
<ul><li class="l">名称：<input name="title" id="title" type="text" class="input" maxlength="255" value="<?php echo ($title); ?>"></li>
	<li class="r">频道分类：<select name="cid" class="select" onchange="changeCat(this.value)">
		<?php if(is_array($list_channel_video)): $i = 0; $__LIST__ = $list_channel_video;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($gxcms["id"]); ?>" <?php if(($gxcms["id"])  ==  $channel_id): ?>selected<?php endif; ?>><?php echo ($gxcms["cname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select>
	</li>
</ul>
<ul>
	<li class="l" style="width:60px; ">频道：</li>
	<li style="float:left; line-height:36px;" id="subchannel_list"></li>
</ul>
<ul>
	<li class="l">主持：<input name="actor" type="text" class="input" maxlength="255" value="<?php echo ($actor); ?>" title="半角逗号分隔"></li>
</ul>
<ul>
	<li class="l">录入：<input name="inputer" type="text" class="input" maxlength="255" value="<?php echo ($inputer); ?>" title="半角逗号分隔"></li>
</ul>
<ul>
	<li class="l" style="width:60px; ">时段：</li>
	<li style="float:left; line-height:36px;" >开始时间：
		<input name="starttime" id="liveStratField" type="text" value="<?php echo (date('Y-m-d H:i',$starttime)); ?>"/>
		&nbsp;&nbsp;&nbsp;结束时间:
		<input name="endtime" id="liveEndField" type="text" value="<?php echo (date('Y-m-d H:i',$endtime)); ?>"/>
	</li>
</ul>
<ul>
<li class="l">海 报：<input name="picurl" id="picurl" type="text" class="input" maxlength="255" value="<?php echo ($picurl); ?>"></li>
<li class="r" style="padding-top:5px">
	<iframe src="?s=Admin/Upload/Show/mid/video" scrolling="no" topmargin="0" width="300" height="28" marginwidth="0" marginheight="0" frameborder="0" align="left"></iframe>
</li>
</ul>
<ul style="height:260px;line-height:260px;padding:5px 0px">
	<li style="padding-left:22px;float:left;">直播简介：</li>
	<li style="float:left"><textarea id="content" name="content" style="width:760px;height:250px;"><?php echo ($content); ?></textarea></li>
</ul>
<ul >
	<li class="l" style="width:60px;">用户权限：</li>
	<li style="float:left; line-height:36px;">
	<!--  
		<input type="radio" class="radio" name="auth" value="1" onClick="onAuth()" <?php if(($auth)  ==  "1"): ?>checked="checked"<?php endif; ?>>开放</input>
		<input type="radio" class="radio" name="auth" value="0" onClick="onAuth()" <?php if(($auth)  ==  "0"): ?>checked="checked"<?php endif; ?>>不开放</input>
		&nbsp;&nbsp;&nbsp;
	
		<a href="?s=Admin/Videoplaywhitelist/Show/vid/<?php echo ($id); ?>/tid/<?php echo ($tid); ?>" id="authtype_0" style="color:#00f;">可观看用户</a>
		<a href="?s=Admin/Videopushwhitelist/Show/vid/<?php echo ($id); ?>/tid/<?php echo ($tid); ?>" id="authtype_1" style="color:#00f;">可推流用户</a>
		-->
		<input type="submit" value="设置观看用户" class="bginput" onclick="gxform.action='?s=Admin/Videoplaywhitelist/Show/videotype/live';" />
		&nbsp;&nbsp;&nbsp;
		<input type="submit" value="可推流用户" class="bginput" onclick="gxform.action='?s=Admin/Videopushwhitelist/Show';" />
		
	</li>
</ul>

<!--  
<ul>
	<li class="l" style="width:60px;">视频等级：</li>
	<li style="float:left; line-height:36px;">
		<?php if(is_array($levels)): $k = 0; $__LIST__ = $levels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$k;$mod = ($k % 2 )?><input type="radio" class="radio" name="userlevel" value="<?php echo ($gxcms["id"]); ?>" <?php if($level == $gxcms['id']): ?>checked="checked"<?php endif; ?> /><?php echo ($gxcms["name"]); ?>
		 	<?php if($k == 8): ?><br/><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>	
	</li>
</ul>
-->
<ul>
<li style="margin-left:70px;text-align:left;padding-top:5px"><input class="bginput" type="submit" name="submit" value=" 提 交 " > <input class="bginput" type="reset" name="Input" value=" 重 置 " ></li>
</ul>
</div>
</td></tr>

</table>
</form>
<script type="text/javascript">
var cid = '<?php echo ($cid); ?>';
var channel_mcid = '<?php echo ($channel_mcid); ?>';
var channel_id = '<?php echo ($channel_id); ?>';
var subchannel_id = "<?php echo ($subid); ?>";
// startTime = "<?php echo ($starttime); ?>";
//var endTime = "<?php echo ($endtime); ?>";

var editor;
KindEditor.ready(function(K){
    editor = K.create('#content', {
	resizeType : 1,
	allowPreviewEmoticons : false,
	allowImageUpload : false,
	items : [
	'source', '|', 'fontsize', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
	'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
	'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'unlink', 'about']
})});
var $content = $('#content').val();
	document.getElementById("gxform").onreset = function(){
	KindEditor.html('content', $content);
}
	
function formatDate(timestamp){
	var d = new Date(timestamp * 1000);    //根据时间戳生成的时间对象
	var yn = d.getFullYear();
	var mn = d.getMonth() + 1;
	var dd = d.getDate();
	var h = d.getHours();
	var m = d.getMinutes();
	var s = d.getSeconds();
	var ym = "" + mn;
	var yd = "" + dd;
	
	if(mn < 10){
		ym = "0" + mn;
	}

	if(dd < 10){
		yd = "0" + dd;
	}

	if(h < 10){
		h = "0" + h;
	}

	if(m < 10){
		m = "0" + m;
	}

	if(s < 10){
		s = "0" + s;
	}

	var dateStr = yn + "-" + ym + "-" + yd + " " + h + ":" + m;
	return dateStr;
}
	
$(function () {
    var curr = new Date().getFullYear();
    var fun = function () {
        $('#liveStratField').scroller('destroy').scroller({
            preset: 'datetime',
            minDate: new Date(2015, 3, 10, 9, 22),
            maxDate: new Date(2050, 7, 30, 15, 44),
            invalid: { daysOfWeek: [0, 6], daysOfMonth: ['5/1', '12/24', '12/25'] },
            theme: 'android-ics light',
            mode: 'mixed',
            lang: 'zh',
            display: 'modal',
            animate: 'slidehorizontal'
        });
        
        $('#liveEndField').scroller('destroy').scroller({
            preset: 'datetime',
            minDate: new Date(2015, 3, 10, 9, 22),
            maxDate: new Date(2050, 7, 30, 15, 44),
            invalid: { daysOfWeek: [0, 6], daysOfMonth: ['5/1', '12/24', '12/25'] },
            theme: 'android-ics light',
            mode: 'mixed',
            lang: 'zh',
            display: 'modal',
            animate: 'slidehorizontal'
        });
    }
    $('.settings select').bind('change', function () {
        fun();
    });
    fun();	
//    document.getElementById("liveStratField").value = formatDate(startTime);
 //   document.getElementById("liveEndField").value = formatDate(endTime);
});

window.onload = function(){
	if (isNaN(parseInt(subchannel_id)) == true) 
		subchannel_id = 1;
	changeCat(channel_id, subchannel_id);
	onAuth();
};

function onAuth(){
	var videoAuth = document.getElementsByName("auth");
	var aut0 = document.getElementById("authtype_0");
	var count = videoAuth.length;

	for(var i=0; i<count; i++){
		if(videoAuth[i].checked){
			if(videoAuth[i].value == 1){
				aut0.style.visibility = "hidden";
			}else{
				aut0.style.visibility = "visible";
			}
		}
	}
}

function check(){
	var title = $("#title").val();
	var startTime = $("#liveStratField").val();
	var endTime = $("#liveEndField").val();
	
    if (title == "" || title.length == 0) {
    	alert("名称不能为空");
    	return false;
    }
    
    var mids = document.getElementsByName("channel_mcid");
    if(mids.length < 1){
    	alert("没有发布频道");
    	return false;
    }
    
    var i = 0;
    for(i =0; i < mids.length; i++){
    	if(mids[i].checked){
    		break;
    	}
    }
    
    if(i == mids.length){
    	alert("至少得选择一个发布频道");
    	return false;
    }
    
    if(startTime == "" || startTime.length == 0){
    	alert("直播开始时间不能为空");
    	return false;
    }
    
    if(endTime == "" || endTime.length == 0){
    	alert("直播结束时间不能为空");
    	return false;
    }
    
    var startTimestamp = Date.parse(new Date(startTime));
    startTimestamp = startTimestamp / 1000;
    
    var endTimestamp = Date.parse(new Date(endTime));
    endTimestamp = endTimestamp / 1000;
    
    if((endTimestamp - startTimestamp)/60 < 5){
    	alert("结束时间必须晚于开始时间五分钟以上开始时间");
    	return false;
    }
    return true;
    
    
}

function changeCat(id, mcid){
	$.ajax({
		type:'get',
		url:'?s=Admin/video/ajaxsubchannel/id/'+id+'/mcid/'+mcid,
		success:function(html){
			$("#subchannel_list").html(html);
		}
	})
}

function removePlayList(i)
{
	var returns = window.confirm('兄弟，你真要删除？');
	if (returns == true)
	{
		$('#table__playlist_'+i).remove();
	}
}

</script>
<style>
#footer, #footer a:link, #footer a:visited {
	clear:both;
	color:#0072e3;
	font:12px/1.5 Arial;
	margin-top:10px;
	text-align:center;
	white-space:nowrap;
}
</style>
<div id="footer">程序版本：<?php echo C("cms_var");?>&nbsp;&nbsp;&nbsp;&nbsp;Copyright © 2015-2016 All rights reserved</div>
</body>
</html>