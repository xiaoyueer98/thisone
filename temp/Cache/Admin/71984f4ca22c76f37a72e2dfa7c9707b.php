<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>栏目管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
</head>
<body onload="loadpara()">
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<?php if(($id)  >  "0"): ?><form action="?s=Admin/Channel/Update" method="post" name="gxform" id="gxform">
<?php else: ?>
<form action="?s=Admin/Channel/Insert" method="post" name="gxform" id="gxform"><?php endif; ?> 
<input type="hidden" name="ctpl" id="ctpl" value="<?php echo ($ctpl); ?>" />
<input type="hidden" name="mid"  id="mid"  value="<?php echo ($mid); ?>" />
<tr class="table_title"><td colspan="2"><?php echo ($tpltitle); ?>栏目：</td></tr>
<tr class="ji"><td class="rt">所属分类：</td>
<td><select name="pid" id="pid" style="width:132px">
  <option value="0">现有分类</option>
  <?php if(is_array($channel_tree)): $i = 0; $__LIST__ = $channel_tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><?php if(($gxcms["status"])  >  "0"): ?><option value="<?php echo ($gxcms["id"]); ?>" <?php if(($gxcms["id"])  ==  $pid): ?>selected<?php endif; ?>><?php echo ($gxcms["cname"]); ?></option><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?></select> * 不选择将成为一级分类</td></tr>
  <tr>
  	<tr class="tr"><td width="17%" class="rt">媒体类型：</td>
 	<td id="mainmid">
	 	<select name="stype" id="stype" style="width:132px">
		  <option value="1" <?php if(($stype)  ==  "live"): ?>selected<?php endif; ?>>视频直播 </option>
		  <option value="2" <?php if(($stype)  ==  "vod"): ?>selected<?php endif; ?>>视频点播 </option>
		  <option value="3" <?php if(($stype)  ==  "tv"): ?>selected<?php endif; ?>>TV</option>
		  <option value="4" <?php if(($stype)  ==  "file"): ?>selected<?php endif; ?>>归档视频</option>
		  </select> *
	</td> 
	<td id="submid">
		
	</td>		
  </tr>
<!--  
<tr class="tr"><td width="17%" class="rt">媒体类型：</td>
	<td id="mainmid"><select name="mid" id="mid" style="width:132px">
	  <option value="1" <?php if(($mid)  ==  "1"): ?>selected<?php endif; ?>>视频直播 </option>
	  <option value="2" <?php if(($mid)  ==  "2"): ?>selected<?php endif; ?>>视频点播 </option>
	  <option value="4" <?php if(($mid)  ==  "9"): ?>selected<?php endif; ?>>TV</option>
	  </select> *
	</td>
	<td id="submid">
		
	</td>
</tr>
-->
<tr class="ji"><td class="rt" width="25%" >频道名称：</td><td><input type="text" name="cname" id="cname" value="<?php echo ($cname); ?>" size="20" maxlength="50" class="ct"> * </td>
</tr>          
<tr class="tr"><td class="rt">频道排序：</td><td ><input type="text" name="oid"  id="oid" value="<?php echo ($oid); ?>" size="20" maxlength="6" class="ct"> * 越小越前面</td></tr>
<tr class="ji" id="channeltype">
<td class="rt">视频类型：</td>
<td><input type="text" readonly="readonly" name="ctype" id="ctype" value="<?php echo ($ctype); ?>" size="20" maxlength="100" class="ct"> * </td>
</tr>
<!--  
<tr class="ji" id="channelseo">
<td class="rt">本栏目使用的模板名：</td>
<td><input type="hidden" readonly="readonly" name="ctpl" id="ctpl" value="<?php echo ($ctpl); ?>" size="20" maxlength="100" class="ct"> * </td>
</tr> 
-->
<tr class="tr" id="trcfile">
  <td class="rt">自定义栏目英文别名：</td>
  <td><input type="text" name="cfile" id="cfile" value="<?php echo ($cfile); ?>" size="20" maxlength="50" class="ct"> * 唯一性</td>
</tr>

<tr class="tr" id="trcdvrstatus">
  <td class="rt">DVR状态：</td>
  <td>
  	<input type="radio" class="radio" name="is_dvr" value="1"checked
  		<?php if(($is_dvr)  ==  "1"): ?>checked="checked"<?php endif; ?>/>开启
  	<input type="radio" class="radio" name="is_dvr" value="0"
  		<?php if(($is_dvr)  ==  "0"): ?>checked="checked"<?php endif; ?>/>关闭
  </td>
</tr>

<tr class="tr" id="trcdvrpath">
  <td class="rt">DVR路径：</td>
  <td><input type="text" name="media_root" value="<?php echo ($media_root); ?>" maxlength="256" size="50">*</input></td>
</tr>
<tr class="tr" id="trcdvrtv">
  <td class="rt">电视流：</td>
  <td><input type="text" name="tv_streams" value="<?php echo ($tv_streams); ?>" maxlength="256" size="50">*</input></td>
</tr>
<tr class="tr" id="trcdvrformat">
  <td class="rt">DVR格式：</td>
    <td>
    <input type="checkbox" name="flash" id="flash" value="1" checked > Flash*
    <input type="checkbox" name="hls" id="hls" value="1" checked > HLS *
    <input type="checkbox" name="mp4" id="mp4" value="1"> MP4
    <input type="checkbox" name="jpegb" id="jpegb" value="1"> Jpeg-Big
    <input type="checkbox" name="jpegl" id="jpegl" value="1"> Jpeg-Lit 
  </td>
</tr>
<!--  
<tr class="ji">
  <td class="rt">栏目SEO标题：</td>
  <td><input type="text" name="ctitle" id="ctitle" value="<?php echo ($ctitle); ?>" maxlength="50" size="40"></td>
</tr>
<tr class="tr">
  <td class="rt">栏目SEO关键词：</td>
  <td><input type="text" name="ckeywords" id="ckeywords" value="<?php echo ($ckeywords); ?>" maxlength="255" size="40"></td>
</tr>
<tr class="ji">
  <td class="rt">栏目SEO简介：</td>
  <td><textarea name="cdescription" id="cdescription"  style="width:301px; height:40px"><?php echo ($cdescription); ?></textarea></td>
</tr>
<tr class="tr" id="channelwebsite" style="display:none">
  <td class="rt">外部链接地址：</td>
  <td><input type="text" name="cwebsite" id="cwebsite" value="<?php echo (($cwebsite)?($cwebsite):'http://'); ?>" maxlength="255" style="width:400px"></td>
</tr>
-->
<tr class="tr ct">
  <td colspan="2"><input type="hidden" name="id" id="id" value="<?php echo ($id); ?>">
    <input class="bginput" type="submit" value="提交" >
    <input class="bginput" type="reset" name="Input" value="重置" >
  </td>
</tr>
</form>
</table>

<script language="javascript">
function changeid(){
	var $pidval = $('#pid').val();
	var mid = 0;
	var mmidobj = document.getElementById('mainmid');
	var smidobj = document.getElementById('submid');
	
	var dvrstatusobj = document.getElementById("trcdvrstatus");
	var dvrpathobj = document.getElementById("trcdvrpath");
	var dvrtvobj = document.getElementById("trcdvrtv");
	var dvtformat = document.getElementById("trcdvrformat");

	if($pidval == 0){
		mmidobj.style.display="inline"; 
		smidobj.style.display="none"; 
		var $tplname = 'video_channel';

		var $midval = $('#stype').val();
		if($midval == 1){
			$('#ctype').val('live');
			dvrstatusobj.style.visibility="visible";
			dvrpathobj.style.visibility="visible";
			dvrtvobj.style.visibility="visible";
			dvtformat.style.visibility="visible";
		}else if($midval == 2){
			$('#ctype').val('vod');
			dvrstatusobj.style.visibility="hidden";
			dvrpathobj.style.visibility="hidden";
			dvrtvobj.style.visibility="hidden";
			dvtformat.style.visibility="hidden";
		}else if($midval == 3){
			$('#ctype').val('tv');
			dvrstatusobj.style.visibility="visible";
			dvrpathobj.style.visibility="visible";
			dvrtvobj.style.visibility="visible";
			dvtformat.style.visibility="visible";			
		}else if($midval == 4){
			$('#ctype').val('file');
			dvrstatusobj.style.visibility="hidden";
			dvrpathobj.style.visibility="hidden";
			dvrtvobj.style.visibility="hidden";
			dvtformat.style.visibility="hidden";			
		}
	}else{
		mmidobj.style.display="none"; 
		smidobj.style.display="inline";
		var n = getchannelname($pidval, "ctype");
		var $tplname = 'video_list';
	}

	$('#ctpl').val($tplname);
	showseo(1);
	/*
	var $midval = $('#ctype').val();
	if($midval == 1){
		$('#ctype').val('live');
		showseo(1);
	}else if($midval == 2){
		$('#ctype').val('vod');
		showseo(1);
	}else{ 
		$('#ctype').val('TV');
		showseo(1);
	}
	$('#ctpl').val('video'+$tplname);
	$('#mid').val(1);
	*/
};

function showDvr(n){
	var dvrstatusobj = document.getElementById("trcdvrstatus");
	var dvrpathobj = document.getElementById("trcdvrpath");
	var dvrtvobj = document.getElementById("trcdvrtv");
	var dvtformat = document.getElementById("trcdvrformat");	
	if(n == "live"){
		dvrstatusobj.style.visibility="visible";
		dvrpathobj.style.visibility="visible";
		dvrtvobj.style.visibility="visible";
		dvtformat.style.visibility="visible";			
	}else{
		dvrstatusobj.style.visibility="hidden";
		dvrpathobj.style.visibility="hidden";
		dvrtvobj.style.visibility="hidden";
		dvtformat.style.visibility="hidden";			
	}	
}

function loadpara()
{
	//hls;flv;mp4;jpeg_big;jpeg_lit

	var hls      = <?php echo is_instr($dvrs,"hls");?>;
	var flash    = <?php echo is_instr($dvrs,"flv");?>;
	var mp4      = <?php echo is_instr($dvrs,"mp4");?>;
	var jpegb    = <?php echo is_instr($dvrs,"jpeg_big");?>;
	var jpegl    = <?php echo is_instr($dvrs,"jpeg_lit");?>;

	document.all.hls.checked     = hls; 
	document.all.flash.checked   = flash; 
	document.all.mp4.checked     = mp4;
	document.all.jpegb.checked   = jpegb;
	document.all.jpegl.checked   = jpegl;
}

function showseo($val){
	if($val<9){
		//$('#cfiles').remove();
		$('#channelseo').css({display:''});
		$('#channelwebsite').css({display:"none"});	
	}else{
		//$('#cfile').after("<span id='cfiles'></span>");
		$('#cfile').val($('#cfile').val().length);
	//	$('#channelseo').css({display:"none"});
		$('#channelwebsite').css({display:''});	
	}
}

function getchannelname(id, mid){
	var n = "";
    $.ajax({
        type: 'get',
        url: "?s=Admin/Channel/ajaxgetname/id/"+id+"/mid/"+mid,
        success:function(data){
        	var d = eval('('+data+')');
			n = d.data;
			var smidobj = document.getElementById('submid');
			smidobj.style.display="inline";
			smidobj.innerHTML = n;
			showDvr(n);
			$('#ctype').val(n);
        }
    });
    return n;
}

$(document).ready(function(){
	$('mid').val(1);
	
	var ctype = $('#ctype').val();
	if(ctype == "live"){
		$('#stype').val(1);
	}else if(ctype == "vod"){
		$('#stype').val(2);
	}else if(ctype == "tv"){
		$('#stype').val(3);
	}else if(ctype == "file"){
		$('#stype').val(4);
	}
	
	
	$('#pid').change(function(){
		changeid();
	});
	$('#stype').change(function(){
		changeid();
	});
	
	changeid();
	<?php if(!empty($id)): ?>showseo(<?php echo ($mid); ?>);<?php endif; ?>
});
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