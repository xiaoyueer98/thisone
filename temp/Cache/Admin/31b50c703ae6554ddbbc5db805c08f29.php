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

<?php if(($array[id] > 0)): ?><form id="form1" name="form1" action="?s=Admin/Self/Update" method="post">

    <input type="hidden" name="id" value="<?php echo ($array[id]); ?>">

<?php else: ?>

    <form id="form1" action="?s=Admin/Self/Insert" method="post" name="form1"><?php endif; ?>



  <table width="100%" border="0" cellspacing="1" cellpadding="3" class="table">

    <tr class="list_head ct">

      <td colspan="2" style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;添加手工 <input type="hidden" name="id" value="<?php echo ($array[id]); ?>"></td>

    </tr>

    <tr class="tr">

      <td align="center">分 类<?php echo ($array[cid]); ?></td>

      <td><select name="cid" id="cid">

        <option value="0">分 类<?php echo ($array[cid]); ?></option>
        
        <?php
       	foreach($typeArr as $gxcms){
        	if ($gxcms['fid'] == 0){
        ?>
        	<optgroup label="<?php echo ($gxcms["name"]); ?>"></optgroup>
        <?php
            }
            foreach($typeArr as $gxcmss){
                if ($gxcmss['fid'] == $gxcms['id'])
                {
        ?>
        	<option value="<?php echo ($gxcmss["id"]); ?>" <?php if(($gxcmss["id"])  ==  $array[cid]): ?>selected<?php endif; ?> >&nbsp;&nbsp;<?php echo ($gxcmss["name"]); ?></option>
        <?php
                }
            }
        }
        ?>

      </select></td>

    </tr>

    <tr class="tr">

      <td width="13%" align="center">标 题</td>

      <td width="87%"><input name="title" type="text" id="title" size="60" value="<?php echo ($array[title]); ?>" /></td>

    </tr>

    <tr class="tr">

      <td align="center">链 接</td>

      <td><input name="link" type="text" id="link" value="<?php echo ($array[link]); ?>" size="60" /></td>

    </tr>

    <tr class="tr">

      <td align="center">描述1</td>

      <td><textarea name="content1" cols="60" rows="6" id="content1"><?php echo ($array[content1]); ?></textarea>

      <br /></td>

    </tr>

    <tr class="tr">

      <td align="center">描述2</td>

      <td><textarea name="content" cols="60" rows="6" id="content"><?php echo ($array[content]); ?></textarea></td>

    </tr>

    <tr class="tr">

      <td align="center">图 片</td>

      <td><div style="float:left"><input name="picurl" id="picurl" type="text" value="<?php echo ($array[picurl]); ?>" maxlength="100" style="width:300px"></div>        <iframe src="?s=Admin/Upload/Show/mid/slide" scrolling="No" topmargin="0" width="350" height="28" marginwidth="0" marginheight="0" frameborder="0" align="left"></iframe></td>

    </tr>

    <tr class="tr">

      <td align="center">颜 色</td>

      <td><input name="color" type="text" id="color" size="10" value="<?php echo ($array[color]); ?>" /> 

        填写颜色值：如 FF0000</td>

    </tr>

    <tr class="tr">

      <td align="center">排 序</td>

      <td><input name="orders" type="text" id="orders" size="10" value="<?php echo ($array[orders]); ?>" /></td>

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