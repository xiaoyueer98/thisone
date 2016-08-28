<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
	$sClient = get_aws_client();
	$ListResponse = $sClient->list_buckets();	

	$blist = $ListResponse->body->Buckets->Bucket;
?>
<head>
<title>用户管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/admin_all.js"></script>
 <!-- 
<script src="/video/js/dist/aws-sdk.min.js"></script>
<script src="/video/js/dist/aws-sdk.js"></script>
-->
<script type="text/javascript">
	function do_delete(bname){
		if(bname == "bucket-001"){
			alert("桶 bucket-001 用于接收测试转码文件，不能删除");
			return;
		}
	}
</script>
</head>
<body>
<div>ssssssssss:<?php echo ($sClient); ?></div>
<div>vvvv:<?php echo ($ListResponse); ?></div>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<form action="?s=Admin/User/Show" method="post" id="gxform" name="gxform">
<tr class="table_title">
	<td colspan="12">云存储</td>
</tr> 
<tr class="list_head ct">
  <td >桶名称</td>
  <td width="100">创建时间</td>  
  <td width="180">操作</td>
</tr>
<?php
		foreach ($blist as $bucket) {
			$bname = $bucket->Name;
		?>
		<tr class="tr ct">
			<td><a href="?s=Admin/Aws/Showobject/bucket/<?php echo ($bname); ?>"><?php echo $bucket->Name;?></a></td>
			<td><?php echo $bucket->CreationDate;?></td>
			<td>
			<a href="javascript:do_delete('<?php echo $bname;?>')" title="点击删除桶" class="operator_danger">删除</a>
			</td>
		</tr>
<?php
		}
?>
<tr class="tr pages"><td colspan="12"><?php echo ($listpages); ?></td></tr>

<!--  
<tr class="tr"><td colspan="12">
	<input type="submit" value="添加桶" class="bginput"/></td>
</tr> 
-->
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