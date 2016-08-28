<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>首页手工</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>

<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>

</head>

<script>

function checkAdd()

{

	if (parseInt(document.form1.cid.value) == 0)

	{

		alert('请选择分类');

		document.form1.cid.focus();

		return false;

	}

	return true;

}

</script>

<body>

<?php if(($array[id] > 0)): ?><form id="form1" name="form1" action="?s=Admin/Self/TypeUpdate" method="post">

    <input type="hidden" name="id" value="<?php echo ($array[id]); ?>">

<?php else: ?>

    <form id="form1" action="?s=Admin/Self/TypeInsert" method="post" name="form1"><?php endif; ?>



  <table width="100%" border="0" cellspacing="1" cellpadding="3" class="table">

    <tr class="list_head ct">

      <td colspan="2" style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;添加手工分类 
        <input type="hidden" name="id" value="<?php echo ($array[id]); ?>"></td>

    </tr>

    <tr class="tr">

      <td align="center">所属分类<?php echo ($array[cid]); ?></td>

      <td><select name="fid" id="fid">

        <option value="0">分 类</option>

        

        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($gxcms["id"]); ?>" <?php if(($gxcms["id"])  ==  $array[fid]): ?>selected<?php endif; ?> ><?php echo ($gxcms["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>



      </select></td>

    </tr>

    <tr class="tr">

      <td width="13%" align="center">分类名称</td>

      <td width="87%"><input name="name" type="text" id="title" size="60" value="<?php echo ($array[name]); ?>" /></td>

    </tr>

    <tr class="tr">

      <td align="center">&nbsp;</td>

      <td><input type="submit" name="button" id="button" value="  提 交  " onclick="return checkAdd();" /></td>

    </tr>

  </table>

</form>

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