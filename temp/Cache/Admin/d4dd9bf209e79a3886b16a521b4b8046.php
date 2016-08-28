<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>用户管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/admin_all.js"></script>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<form action="?s=Admin/Groupmember/Add" method="post" id="gxform" name="gxform">
<input name="gid" type="hidden" value="<?php echo ($gid); ?>" />
<tr class="table_title">
	<td colspan="12">添加新成员
		<span class="fr">
	   		<a href="?s=Admin/Groupmember/Show/id/<?php echo ($gid); ?>" class="no">返回</a>
	   	</span>		
	</td>
</tr>
<tr class="tr">
<td colspan="11">搜索用户&nbsp;<input onFocus="this.value=''" type="text" name="kd" id="kd" size="35" maxlength="50" value="<?php echo ((urldecode($kd))?(urldecode($kd)):'可搜索(用户呢称,用户邮箱)'); ?>" style="color:#999;"> <input type="submit" value="搜索" class="bginput"/></td>
</tr>  
<tr class="list_head ct">
  <td width="60">ID</td>
  <td >用户名称</td>
  <td width="50">模式</td>
  <td width="80">剩余点数</td>
  <td width="100">到期时间</td>
  <td width="100">注册时间</td>
   <td width="100">登录IP</td>
  <td width="50">次数</td>
  <td width="50">状态</td>     
</tr>
<?php if(is_array($list_user)): $i = 0; $__LIST__ = $list_user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><tr class="tr ct">
  <?php if(($gxcms["id"])  ==  "1"): ?><td align="left"><input name="ids[]" type="checkbox" value="<?php echo ($gxcms["id"]); ?>" class="noborder" disabled><?php echo ($gxcms["id"]); ?></td>
  <?php else: ?>
  <td align="left"><input name="ids[]" type="checkbox" value="<?php echo ($gxcms["id"]); ?>" class="noborder"><?php echo ($gxcms["id"]); ?></td><?php endif; ?>
  <td align="left"><?php echo (htmlspecialchars($gxcms["username"])); ?></td>
  <td style="padding:0px"><?php if(($gxcms["pay"])  ==  "1"): ?>包月<?php else: ?>扣点<?php endif; ?></td>
  <td style="padding:0px"><?php echo ($gxcms["money"]); ?>点</td>
  <td style="padding:0px"><?php echo (date('Y-m-d',$gxcms["duetime"])); ?></td>
  <td style="padding:0px"><?php echo (date('Y-m-d',$gxcms["jointime"])); ?></td>
  <td style="padding:0px"><?php echo ($gxcms["logip"]); ?></td>
  <td style="padding:0px"><?php echo ($gxcms["lognum"]); ?></td>
  <td style="padding:0px"><?php if(($gxcms['status'])  ==  "1"): ?><a href="?s=Admin/User/Status/id/<?php echo ($gxcms["id"]); ?>/sid/0" title="点击将该用户拉为黑名单">正常</a><?php else: ?><a href="?s=Admin/User/Status/id/<?php echo ($gxcms["id"]); ?>/sid/1" title="点击将该用户设为正常用户"><font color="red">锁定</font></a><?php endif; ?></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?> 
<tr class="tr pages"><td colspan="12"><?php echo ($listpages); ?></td></tr>
<tr class="tr">
	<td colspan="12">
		<input type="button" id="checkall" value="全/反选" class="bginput"> 
		<input type="submit" value="批量添加" onClick="gxform.action='?s=Admin/Groupmember/Addo/gid/<?php echo ($gid); ?>';" class="bginput"/>
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