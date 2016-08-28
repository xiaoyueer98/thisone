<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>详细评论内容</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<head>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<tr><td class="dialog-content" style="white-space:normal;"><?php echo (remove_xss(htmlspecialchars($content))); ?></td></tr> 
<tr><td class="tr ct"><?php if(($status)  ==  "1"): ?><a href="?s=Admin/Comment/Status/id/<?php echo ($id); ?>/sid/0" title="已通过审核,点击取消审核">已审</a><?php else: ?><a href="?s=Admin/Comment/Status/id/<?php echo ($id); ?>/sid/1" title="还没通过审核,点击通过审核"><font color="red">待审</font></a><?php endif; ?> <a href="?s=Admin/Comment/Add/id/<?php echo ($id); ?>" title="点击修改评论" target="_parent">修改</a> <a href="?s=Admin/Comment/Del/id/<?php echo ($id); ?>" onClick="return confirm('确定删除该评论吗?')" title="点击删除评论">删除</a></td></tr>
</table>
</body>
</html>