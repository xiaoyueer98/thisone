<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>群组管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/admin_all.js"></script>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<form action="?s=Admin/Group/Show" method="post" id="gxform" name="gxform">

<input type="hidden" name="id" id="id" value="<?php echo ($id); ?>" />
<input type="hidden" name="tid" id="tid" value="<?php echo ($tid); ?>" />
<input type="hidden" name="title" id="title" value="<?php echo ($title); ?>" />
<input type="hidden" name="cid" id="cid" value="<?php echo ($cid); ?>" />
<input type="hidden" name="channel_id" id="channel_id" value="<?php echo ($channel_id); ?>" />
<input type="hidden" name="actor" id="actor" value="<?php echo ($actor); ?>" />
<input type="hidden" name="inputer" id="inputer" value="<?php echo ($inputer); ?>" />
<input type="hidden" name="starttime" id="starttime" value="<?php echo ($starttime); ?>" />
<input type="hidden" name="endtime" id="endtime" value="<?php echo ($endtime); ?>" />
<input type="hidden" name="picurl" id="picurl" value="<?php echo ($picurl); ?>" />
<input type="hidden" name="content" id="content" value="<?php echo ($content); ?>" />
<input type="hidden" name="title" id="title" value="<?php echo ($title); ?>" />
<input type="hidden" name="channel_mcid" value="<?php echo ($channel_mcid); ?>" />

<tr class="table_title">
	<td colspan="12">可推流用户 
		<span class="fr">  
			<!--  
	   		<a href="?s=Admin/Video/Add/type/live/type/live/id/<?php echo ($vid); ?>/tid/<?php echo ($tid); ?>" class="no">返回</a>
	   		-->
	   		<input type="submit" value="返回" class="bginput" onclick="gxform.action='?s=Admin/Videopushwhitelist/Returnvideo';" />
	   	</span>		
	</td>
</tr>
<tr class="tr">
<td colspan="11">搜索用户&nbsp;<input onFocus="this.value=''" type="text" name="keyword" id="keyword" size="35" maxlength="50" value="<?php echo ((urldecode($keyword))?(urldecode($keyword)):'可搜索(用户名,email)'); ?>" style="color:#999;"> <input type="submit" value="搜索" class="bginput"/></td>
</tr>  
<tr class="list_head ct">
  <td width="60">ID</td>
  <td >用户名称</td>
  <td width="100">注册时间</td>
  <td width="80">状态</td>     
</tr>
<?php if(is_array($list_user)): $i = 0; $__LIST__ = $list_user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><tr class="tr ct">
  <td align="left"><input name="ids[]" type="checkbox" value="<?php echo ($gxcms["id"]); ?>" class="noborder"><?php echo ($gxcms["id"]); ?></td>
  <td align="left"><?php echo (htmlspecialchars($gxcms["username"])); ?></td>
  <td style="padding:0px"><?php echo (date('Y-m-d',$gxcms["jointime"])); ?></td>
  <td style="padding:0px"><?php if(($gxcms['status'])  ==  "1"): ?><a href="?s=Admin/Group/Status/id/<?php echo ($gxcms["id"]); ?>/sid/0" title="点击将该群拉为黑名单">正常</a><?php else: ?><a href="?s=Admin/Group/Status/id/<?php echo ($gxcms["id"]); ?>/sid/1" title="点击将该群设为正常群组"><font color="red">锁定</font></a><?php endif; ?></td>
  <!--  
  <td style="padding:0px">
  	<a href="?s=Admin/Videopushwhitelist/Del/id/<?php echo ($gxcms["id"]); ?>/vid/<?php echo ($vid); ?>/tid/<?php echo ($tid); ?>" title="点击删除群组" class="operator_danger" onClick="return confirm('禁止该组成员观看此直播?')">删除</a>
  </td>
  -->
</tr><?php endforeach; endif; else: echo "" ;endif; ?> 
<tr class="tr pages"><td colspan="12"><?php echo ($listpages); ?></td></tr>
<tr class="tr">
	<td colspan="12">
		<input type="button" id="checkall" value="全/反选" class="bginput"> 
		<input type="submit" value="批量删除" onClick="if(confirm('删除后将无法还原,确定要删除吗?')){gxform.action='?s=Admin/Videopushwhitelist/Delall';}else{return false;}" class="bginput"/>
		<input type="submit" value="添加推流" onClick="gxform.action='?s=Admin/Videopushwhitelist/Add/';" class="bginput"/>
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