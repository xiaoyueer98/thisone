<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>留言列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/admin_all.js"></script>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<form action="?s=Admin/Guestbook/Show" method="post" name="gxform" id="gxform">
<tr class="table_title">
	<td colspan="8"><?php echo ($showname); ?>信息列表
		<?php if($eid != 1): ?><span class="fr">
		   		<a href="?s=Admin/Guestbook/Show/status/1" class="no">未审核留言 </a>
		   	</span>		
			<span class="fr">
		   		<a href="?s=Admin/Guestbook/Show" class="no">全部留言 </a>
		   	</span><?php endif; ?>	
	</td>
</tr>
<tr class="tr">
<td colspan="8"><input name="wd" onFocus="this.value=''" onBlur="if(this.value=='')this.value='可搜索(<?php echo ($showname); ?>内容,用户呢称,用户IP)'" type="text" size="35" maxlength="50" value="<?php echo (htmlspecialchars(($wd)?($wd):'可搜索留言内容,用户呢称,用户IP)')); ?>" style="color:#999;">&nbsp;<input name="type" type="hidden" value="other"><input name="eid" type="hidden" value="<?php echo ($eid); ?>"><input type="submit" value="搜 索" class="bginput" /></td>
</tr>
<tr class="list_head ct">
  <td width="60">编号ID</td>
  <td ><?php echo ($showname); ?>内容</td>
  <td width="50">查看</td>
  <td width="80">用户名</td> 
  <td width="90">用户IP</td>   
  <td width="80">时间</td>
  <td width="50">状态</td>
  <td width="120">操作</td>
</tr>
<?php if(is_array($list_gbook)): $i = 0; $__LIST__ = $list_gbook;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><tr class="tr ct">
  <td class="lt"><input name="ids[]" type="checkbox" value="<?php echo ($gxcms["id"]); ?>" class="noborder"><?php echo ($gxcms["id"]); ?></td>
  <td class="lt" style="white-space:normal;"><?php echo (remove_xss(htmlspecialchars(msubstr($gxcms["content"],0,37)))); ?><?php if(($gxcms["errid"])  >  "0"): ?>&nbsp;&nbsp;<a href="?s=Admin/Video/Add/id/<?php echo ($gxcms["errid"]); ?>"><font color="red">处理</font></a><?php endif; ?></td>
  <td class="td"><img src="./views/images/admin/comment.gif" title="查看详细信息" onClick="dialogPop('?s=Admin/Guestbook/Showid/id/<?php echo ($gxcms["id"]); ?>','<?php echo ($showname); ?>详细信息');" style="cursor:pointer;"></td>
  <td class="td"><a href="?s=Admin/Guestbook/Show/eid/<?php echo ($eid); ?>/wd/<?php echo (remove_xss(htmlspecialchars(urlencode($gxcms["username"])))); ?>"><?php echo (remove_xss(htmlspecialchars($gxcms["username"]))); ?></a></td>
  <td class="td"><a href="?s=Admin/Guestbook/Show/eid/<?php echo ($eid); ?>/wd/<?php echo ($gxcms["ip"]); ?>"><?php echo ($gxcms["ip"]); ?></a></td>
  <td class="td"><?php echo (date('Y-m-d',$gxcms["addtime"])); ?></td>
  <td class="td"><?php if(($gxcms['status'])  ==  "1"): ?><a href="?s=Admin/Guestbook/Status/id/<?php echo ($gxcms["id"]); ?>/sid/0" title="已通过审核,点击取消审核">已审</a><?php else: ?><a href="?s=Admin/Guestbook/Status/id/<?php echo ($gxcms["id"]); ?>/sid/1" title="还没通过审核,点击通过审核"><font color="red">未审</font></a><?php endif; ?></td>
  <td class="td"><a href="?s=Admin/Guestbook/Add/id/<?php echo ($gxcms["id"]); ?>" title="点击修改留言">修改</a> <a href="?s=Admin/Guestbook/Del/id/<?php echo ($gxcms["id"]); ?>" onClick="return confirm('确定删除该留言吗?')" title="点击删除留言">删除</a> <?php if(empty($gxcms["recontent"])): ?><a href="?s=Admin/Guestbook/Add/id/<?php echo ($gxcms["id"]); ?>/reid/1" title="还没有回复,点击回复"><font color="red">未回复</font></a><?php else: ?><a href="?s=Admin/Guestbook/Add/id/<?php echo ($gxcms["id"]); ?>/reid/1" title="已经回复留言,点击修改回复">已回复</a><?php endif; ?></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?> 
<tr class="tr pages"><td colspan="8"><?php echo ($listpages); ?></td></tr>
<tr class="tr"><td colspan="8"><input type="button" id="checkall" value="全/反选" class="bginput">&nbsp;&nbsp;<input type="submit" value="批量审核" class="bginput" onClick="gxform.action='?s=Admin/Guestbook/Statusall/sid/1';" />&nbsp;&nbsp;<input type="submit" value="取消审核" class="bginput" onClick="gxform.action='?s=Admin/Guestbook/Statusall/sid/0';" />&nbsp;&nbsp;<input type="submit" value="批量删除" onClick="if(confirm('删除后将无法还原,确定要删除吗?')){gxform.action='?s=Admin/Guestbook/Delall';}else{return false}"  class="bginput"/> <input type="submit" value="清空<?php echo ($showname); ?>" onClick="if(confirm('清空数据后将无法还原,确定要清空吗?')){gxform.action='?s=Admin/Guestbook/Delclear';}else{return false}" class="bginput" title="点击删除所有<?php echo ($showname); ?>内容!"/></td></tr> 
</form>
</table>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery_jqmodal.js"></script>
<link rel='stylesheet' type='text/css' href='./views/css/jquery_jqmodal.css'>
<style>#dia_title{height:25px;line-height:25px}.jqmWindow{height:200px;}</style>
<div class="jqmWindow" id="dialog">
<div id="dia_title"><span class="jqmTitle"></span><a href="javascript:void(0)" class="jqmClose" title="关闭窗口"></a></div>
<div id="dia_content"></div>
</div>
<script language="JavaScript" type="text/javascript">
//弹出浮动层 $('#dialog').jqm({modal: true, trigger: 'a.showDialog'});
$('#dialog').jqm({modal: false, trigger: '#window' , opacity:'0.1'});
</script>
<style>#dia_title{height:25px;line-height:25px}.jqmWindow{height:300px;width:500px;}</style>
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