<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>用户中心设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<script language="JavaScript">
var isVideoTranscoding = false;
var isAudioTranscoding = false;
$(document).ready(function(){	
	var i = 0;
	onOnlyAudio();
		
	var protocolObj = document.getElementById("protocol");
	for(i = 0; i < protocolObj.options.length; i++){
		if(protocolObj.options[i].value == "<?php echo ($protocol); ?>"){
			protocolObj.options[i].selected = true;
		}
	}
	
	var bitrateObj = document.getElementById("bitrate");
	for(i = 0; i < bitrateObj.options.length; i++){
		if(bitrateObj.options[i].value == "<?php echo ($bitrate); ?>"){
			bitrateObj.options[i].selected = true;
		}
	}
	
	var bitrateaudioObj = document.getElementById("bitrate_audio");
	for(i = 0; i < bitrateaudioObj.options.length; i++){
		if(bitrateaudioObj.options[i].value == "<?php echo ($bitrate_audio); ?>"){
			bitrateaudioObj.options[i].selected = true;
		}
	}
	
	var tohostObj = document.getElementById("to_host");
	for(i = 0; i < tohostObj.options.length; i++){
		if(tohostObj.options[i].value == "<?php echo ($to_host); ?>"){
			tohostObj.options[i].selected = true;
		}
	}
	onServer();
});

function onOnlyAudio(){
	var onlyAudioObj = document.getElementById("audio_only");
	var activateVideo = document.getElementById("use_transcode");
	var activateAudio = document.getElementById("use_audio_transcode");
	var videoBlock = document.getElementById("video");
	var trVideoObj = document.getElementById("tr_video");
	var trAudioObj = document.getElementById("tr_audio");
	
	if(onlyAudioObj.checked){
		isVideoTranscoding = false;	
		videoBlock.style.visibility = "hidden";
	}else{
		videoBlock.style.visibility = "visible";
		if(activateVideo.checked){
			isVideoTranscoding = true;
		}else{
			isVideoTranscoding = false;
		}
	}
	
	if(activateAudio.checked){
		trAudioObj.style.visibility = "visible";
		isAudioTranscoding = true;
	}else{
		trAudioObj.style.visibility = "hidden";
		isAudioTranscoding = false;
	}
	
	if(isVideoTranscoding){
		trVideoObj.style.visibility = "visible";
	}else{
		trVideoObj.style.visibility = "hidden";
	}
}

function onServer(){
	var serverObj = document.getElementById("to_host");
	var otherObj = document.getElementById("otherServer");

	var selvalue = serverObj.value;

	if(selvalue == 'localhost'){
		otherObj.style.visibility="hidden";
	}else{
		otherObj.style.visibility="visible";
	}
}

function formCheck(){
	var streamName = document.getElementById("name");
//	var streamProtocol = document.getElementById("protocol");
	var streamUrl = document.getElementById("source_url");
	var videoWidth = document.getElementById("width");
	var videoheight = document.getElementById("heigh");
	var serverName = document.getElelmentById("to_server");
	var application = document.getElelmentById("application");
	var steam = document.getElementById("stream");
	
	if(streamName.value == ""){
		alert("名称不能有空");
		return false;
	}
	
	if(streamUrl.value == ""){
		alert("URL 不能为空");
		return false;
	}
	
	if(serverName.value == ""){
		alert("服务器不能为空");
		return false;
	}
	
	if(application.value == ""){
		alert("频道不能为空");
		return false;
	}
	
	if(stream.value == ""){
		alert("流名不能为空");
		return false;
	}
	
}
</script>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
  <tr>
    <td colspan="10" class="table_title">
    	<?php if(($id)  ==  "0"): ?><span class="fl">添加串流</span> 
    	<?php else: ?>
    		<span class="fl">编辑串流</span><?php endif; ?>
    	<span class="fr"><a href="?s=Admin/Mserver/Streaming">返回</a></span>
    </td>
  </tr>
  
<form action="?s=Admin/Mserver/AddStreamingDoing" method="post" id="gxform" onSubmit="return formCheck()">
  <tr class="table_title">
    <td colspan="2">源：</td>
  </tr>   
<tr class="ji">
  <td class="left">名称</td>
  <td>
  	<input type="text" name="name" id="name" value="<?php echo urldecode($name); ?>" maxlength="256" size="50" />
  	<input type="hidden" name="id" size="14" value="<?php echo ($id); ?>"></td>
  </td>
</tr>  
<tr class="ji">
  <td class="left">协议</td>
  <td>
  	<select name="protocol" id="protocol" class="select" >
  		<option value='rtmp'>rtmp</option>
  		<option value='rtsp'>rtsp</option>
  		<option value='rtsps'>rtsps</option>
  		<option value='rtp'>rtp</option>
  		<option value='udp'>udp</option>
  		<option value='mms'>mms</option>
  		<option value='mmsh'>mmsh</option>
  		<option value='http'>http</option>
  		<option value='file'>file</option>
  	</select>
  </td>
</tr>
<tr class="ji">
  <td class="left">URL</td>
  <td><input type="text" name="source_url" id="source_url" value="<?php echo urldecode($source_url); ?>" maxlength="256" size="50" /></td>
</tr> 
<tr class="ji">
  <td class="left">媒体</td>
  <td>
  	<input name="audio_only" id="audio_only" type="checkbox" value="1" onClick="onOnlyAudio()" <?php if(($audio_only)  ==  "on"): ?>checked<?php endif; ?>>仅限音频</input>
  	<span id="video">
  	<input name="use_transcode" id="use_transcode" type="checkbox" value="1" onClick="onOnlyAudio()" <?php if(($use_transcode)  ==  "on"): ?>checked<?php endif; ?>>开启视频转码</input>
  	</span>
  	<input name="use_audio_transcode" id="use_audio_transcode" type="checkbox" value="1" onClick="onOnlyAudio()" <?php if(($use_audio_transcode)  ==  "on"): ?>checked<?php endif; ?>>开启音频转码</input>
  </td>
</tr> 
<tr class="ji" id="tr_video" name="tr_video" style="visibility:hidden;">
  <td class="left">视频转码</td>
  <td>
  		<span>分辨率：</span>
  		<input name="width" id="width" type="text" value="<?php echo ($width); ?>" size="10" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"></input>
  		<span>X</span>
  		<input name="height" id="height" type="text" value="<?php echo ($height); ?>" size="10" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"></input>
  		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  		<span>码率：</span>
  		<select name="bitrate" id="bitrate" class="select">
  			<option value='100'>100</option>
  			<option value='200'>200</option>
  			<option value='300'>300</option>
  			<option value='500' selected>500</option>
  			<option value='800'>800</option>
  			<option value='1000'>1000</option>
  			<option value='1200'>1200</option>
  			<option value='1500'>1500</option>
  		</select>
  </td>
</tr> 
<tr class="ji" name="tr_audio" id="tr_audio" style="visibility:hidden;">
  <td class="left">音频转码</td>
  <td>
  		<span>码率：</span>
  		<select name="bitrate_audio" id="bitrate_audio" class="select">
  			<option value='20'>100</option>
  			<option value='32'>200</option>
  			<option value='48'>300</option>
  			<option value='56' selected>500</option>
  			<option value='64'>800</option>
  			<option value='72'>1000</option>
  			<option value='96'>1200</option>
  		</select>
  </td>
</tr> 
<tr class="table_title">
  <td colspan="2">串流到：</td>
</tr> 
<tr class="ji">
  <td class="left">服务器</td>
  <td>
  		<select name="to_host" id="to_host" class="select" onchange="onServer()">
  			<option value='localhost'>本地服务器</option>
  			<option value='remote'>其它服务器</option>
  		</select>
  		<span id="otherServer" style="visibility:hidden;">
  		<input type="text" name="to_server" id="to_server" value="<?php echo urldecode($to_server); ?>" size="50">请输入服务器的IP或域名</input>
  		</span>
  </td>
</tr>   
<tr class="ji">
  <td class="left">频道名称</td>
  <td>
  		<input type="text" name="application" id="application" value="<?php echo urldecode($application); ?>" size="50"></input>
  </td>
</tr> 
<tr class="ji">
  <td class="left">流名称</td>
  <td>
  		<input type="text" name="stream" id="stream" value="<?php echo urldecode($stream); ?>" size="50"></input>
  </td>
</tr>   
 

<tr class="tr">
  <td colspan="2"><input type="hidden" name="setting_sub" value="true">
    <input class="bginput" type="submit" name="submit" value="确定">
    <input class="bginput" type="button" name="Input" value="取消" onClick="window.location.href='?s=Admin/Mserver/Streaming'" >
  </td>
</tr>
</form>
</table>
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