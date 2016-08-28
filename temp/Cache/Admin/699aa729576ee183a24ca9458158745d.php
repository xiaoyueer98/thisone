<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>添加/编辑视频</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>

<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/admin_all.js"></script>
<script language="javascript" type="text/javascript" charset="utf-8" src="./views/editor/kindeditor.js"></script>
<script language="javascript" type="text/javascript" charset="utf-8" src="./views/editor/lang/zh_CN.js"></script>

</head>
<body> 
<form name="transcode_from" action="?s=Admin/Mserver/Transcoding" method="post" id="gxform" >
<input type="hidden" name="cid" value="<?php echo ($cid); ?>" />
<input type="hidden" name="filename" value="<?php echo ($filename); ?>" />
<table cellpadding="0" cellspacing="0" class="boxadd">
<tr class="tabs_title">
    <td>
    	<span id="tabs" class="fl">
   			<a class="on" href="javascript:void(0)" name="1,2" hideFocus='true'>编码转换</a>
   		</span>
   		<span class="fr">
   			<a href="?s=Admin/Mserver/Show/sflag/0" class="no">返回</a>
   		</span>
	</td>
</tr>
<tr><td>
<div id="showtab_1" style="border-top:1px solid #C6DCF2;">
<ul>
	<li class="r">文件:<?php echo $filename;?></li>
</ul>
<ul>
<li class="r">频道分类：<select name="cid" class="select" onchange="changeCat(this.value)">
	<?php if(is_array($list_channel_video)): $i = 0; $__LIST__ = $list_channel_video;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($gxcms["id"]); ?>" <?php if(($gxcms["id"])  ==  $cid): ?>selected<?php endif; ?>><?php echo ($gxcms["cname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	</select>
</li>
<li class="r">转换标准：<select name="tid" class="select">
	<?php if(is_array($list_transcode_info)): $i = 0; $__LIST__ = $list_transcode_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($gxcms["id"]); ?>" <?php if(($gxcms["tid"])  ==  $tid): ?>selected<?php endif; ?>><?php echo ($gxcms["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	</select>
</li>
</ul>
<ul>
	<li class="l" style="width:60px; ">发布频道：</li>
	<li style="float:left; line-height:36px;" id="subchannel_list"></li>
</ul>
</div>
<ul>
	<li style="margin-left:70px;text-align:left;padding-top:5px">
		<input class="bginput" type="submit" name="submit" value=" 转码" > 
		<input class="bginput" type="button" name="Input" value=" 关闭 "  onclick="window.location.href='?s=Admin/Mserver/Show'">
	</li>
</ul>
</td></tr>
</table>
</form>
<script type="text/javascript">
var cid = '<?php echo ($cid); ?>';
var channel_mcid = '<?php echo ($channel_mcid); ?>';
window.onload = function(){
	if (isNaN(parseInt(cid)) == true) cid = 1;

	changeCat(cid,channel_mcid);	
};
//
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

function addvideo(cid){
	//window.open(url,"播放","location=no,status=no,z-look=yes");
	window.open("./view/admin/mserver_streams.html?cid=vod", "添加视频");
}

function changeCat(id,mcid){
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