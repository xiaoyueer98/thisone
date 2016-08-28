<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网站幻灯片分类列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<style>a{ color: #666666}</style>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<tr class="table_title">
  <td colspan="3" style="background-color:#FFF"><a href="?s=Admin/Slide/addType">添加幻灯片分类</a></td>
</tr>
<tr class="table_title">
  <td colspan="2">网站幻灯片分类列表</td>
  <td>&nbsp;</td>
</tr>
<tr class="tr ct">
  <td width="159" style="text-align:left; line-height:20px; white-space:normal;"><strong>分类ID</strong></td>
  <td colspan="2" style="text-align:left; line-height:20px; white-space:normal;"><strong>分类名称</strong></td>
  </tr>
<?php if(is_array($list_slide)): $i = 0; $__LIST__ = $list_slide;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><tr class="tr ct">
  <td style="text-align:left; line-height:20px; white-space:normal;"><?php echo ($gxcms["id"]); ?></td>
<td width="948" style="text-align:left; line-height:20px; white-space:normal;"><?php echo ($gxcms["name"]); ?></td>
<td width="90" align="center"><a href="?s=Admin/Slide/addType/id/<?php echo ($gxcms["id"]); ?>">修改</a> <a href="?s=Admin/Slide/delType/id/<?php echo ($gxcms["id"]); ?>" onClick="return confirm('确定删除该幻灯分类吗?')" title="点击删除幻灯">删除</a></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
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