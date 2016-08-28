<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>成员管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/admin_all.js"></script>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<form action="?s=Admin/Groupmember/Show" method="post" id="gxform" name="gxform">
<input name="gid" type="hidden" value="<?php echo ($gid); ?>" />
<tr class="table_title">
	<td colspan="12">群成员管理
		<span class="fr">
	   		<a href="?s=Admin/Group/Show" class="no">返回</a>
	   	</span>		
	</td>
</tr>
<tr class="tr">
<td colspan="11">搜索群成员&nbsp;<input onFocus="this.value=''" type="text" name="keyword" id="keyword" size="35" maxlength="50" value="<?php echo ((urldecode($keyword))?(urldecode($keyword)):'可搜索(用户呢称,用户邮箱)'); ?>" style="color:#999;"> <input type="submit" value="搜索" class="bginput"/></td>
</tr>  
<tr class="list_head ct">
  <td width="60">ID</td>
  <td >用户名称</td>
  <td>email</td>
  <td width="100">到期时间</td>
  <td width="100">注册时间</td>
   <td width="100">登录IP</td>
  <td width="50">次数</td>
  <td width="50">状态</td>     
  <td width="80">操作</td>
</tr>
<?php if(is_array($list_member)): $i = 0; $__LIST__ = $list_member;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><tr class="tr ct">
  <?php if(($gxcms["id"])  ==  "1"): ?><td align="left"><input name="ids[]" type="checkbox" value="<?php echo ($gxcms["id"]); ?>" class="noborder" disabled><?php echo ($gxcms["id"]); ?></td>
  <?php else: ?>
  <td align="left"><input name="ids[]" type="checkbox" value="<?php echo ($gxcms["id"]); ?>" class="noborder"><?php echo ($gxcms["id"]); ?></td><?php endif; ?>
  <td align="left"><?php echo (htmlspecialchars($gxcms["username"])); ?></td>
  <td style="padding:0px"><?php echo ($gxcms["email"]); ?></td>
  <td style="padding:0px"><?php echo (date('Y-m-d',$gxcms["duetime"])); ?></td>
  <td style="padding:0px"><?php echo (date('Y-m-d',$gxcms["jointime"])); ?></td>
  <td style="padding:0px"><?php echo ($gxcms["logip"]); ?></td>
  <td style="padding:0px"><?php echo ($gxcms["lognum"]); ?></td>
  <td style="padding:0px"><?php if(($gxcms['status'])  ==  "1"): ?>正常<?php else: ?><font color="red">锁定</font><?php endif; ?></td>
  <td style="padding:0px"> 
  	<a href="?s=Admin/Groupmember/Del/uid/<?php echo ($gxcms["id"]); ?>/gid/<?php echo ($gid); ?>" class="operator_danger" title="点击删除用户">删除</a>
  </td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?> 
<tr class="tr pages"><td colspan="12"><?php echo ($listpages); ?></td></tr>
<tr class="tr">
	<td colspan="12">
		<input type="button" id="checkall" value="全/反选" class="bginput"> 
		<input type="submit" value="批量删除" onClick="if(confirm('确定要删除群成员吗?')){gxform.action='?s=Admin/Groupmember/Delall';}else{return false;}" class="bginput"/>
		<input type="submit" value="添加新成员" onClick="gxform.action='?s=Admin/Groupmember/Add/gid/<?php echo ($gid); ?>';" class="bginput"/>
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