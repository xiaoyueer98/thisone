<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>付费观看记录</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/admin_all.js"></script>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<tr class="table_title"><td colspan="12">收费视频观看记录</td></tr>
<tr class="ct list_head">
  <td width="60">编号</td>
  <td >视频名称</td>
  <td width="100">观看人</td>
  <td width="140">观看时间</td>
  <td width="50">操作</td>
</tr>
<form action="?s=Admin/Userview/Delall" method="post" name="gxform" id="gxform">
<?php if(is_array($list_view)): $i = 0; $__LIST__ = $list_view;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><tr class="tr ct">
  <td class="lt"><input name="ids[]" type="checkbox" value="<?php echo ($gxcms["id"]); ?>" class="noborder"><?php echo ($gxcms["id"]); ?></td>
  <td class="lt" style=" white-space:normal;"><?php echo get_color_title($gxcms['title'].$gxcms['intro'],$gxcms['color']);?></td>  
  <td class="td"><?php echo ($gxcms["username"]); ?></td>
  <td class="td"><?php echo (date('Y-m-d H:i:s',$gxcms["viewtime"])); ?></td>
  <td class="td"><a href="?s=Admin/Userview/Del/id/<?php echo ($gxcms["id"]); ?>" onClick="return confirm('确定删除该观看记录吗?')" title="点击删除观看记录">删除</a></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?> 
<tr><td colspan="5" class="tr pages"><?php echo ($listpages); ?></td></tr>
<tr class="tr"><td colspan="5"><input type="button" id="checkall" value="全/反选" class="bginput"> <input type="submit" value="批量删除" onClick="return confirm('删除后将无法还原,确定要删除吗?')" class="bginput"/> <input type="submit" value="清空记录" onClick="if(confirm('清空数据后将无法还原,确定要清空吗?')){gxform.action='?s=Admin/Userview/Delclear';}else{return false}" class="bginput"/></td></tr> 
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