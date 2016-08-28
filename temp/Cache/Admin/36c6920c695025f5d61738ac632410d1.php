<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>添加/编辑群组资料</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>

<script src="./views/mobiscroll/js/zepto.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.zepto.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.core.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.scroller.js" type="text/javascript"></script>

<script src="./views/mobiscroll/js/mobiscroll.datetime.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.select.js" type="text/javascript"></script>

<script src="./views/mobiscroll/js/mobiscroll.scroller.ios.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.scroller.android.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.scroller.android-ics.js" type="text/javascript"></script>
<script src="./views/mobiscroll/js/mobiscroll.scroller.wp.js" type="text/javascript"></script>

<script src="./views/mobiscroll/js/mobiscroll.i18n.zh.js" type="text/javascript"></script>

<link href="./views/mobiscroll/css/mobiscroll.scroller.css" rel="stylesheet" type="text/css" />
<link href="./views/mobiscroll/css/mobiscroll.scroller.android.css" rel="stylesheet" type="text/css" />
<link href="./views/mobiscroll/css/mobiscroll.scroller.android-ics.css" rel="stylesheet" type="text/css" />
<link href="./views/mobiscroll/css/mobiscroll.scroller.ios.css" rel="stylesheet" type="text/css" />
<link href="./views/mobiscroll/css/mobiscroll.scroller.sense-ui.css" rel="stylesheet" type="text/css" />
<link href="./views/mobiscroll/css/mobiscroll.scroller.wp.css" rel="stylesheet" type="text/css" />

<link href="./views/mobiscroll/css/mobiscroll.animation.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(function () {
    var curr = new Date().getFullYear();
    var fun = function () {
        $('#buildtime').scroller('destroy').scroller({
            preset: 'datetime',
            minDate: new Date(2015, 3, 10, 9, 22),
            maxDate: new Date(2050, 7, 30, 15, 44),
            invalid: { daysOfWeek: [0, 6], daysOfMonth: ['5/1', '12/24', '12/25'] },
            theme: 'android-ics light',
            mode: 'mixed',
            lang: 'zh',
            display: 'modal',
            animate: 'slidehorizontal'
        });
    }
    $('.settings select').bind('change', function () {
        fun();
    });
    fun();	
    
   // document.getElementById("buildtime").value = formatDate(startTime);
});

</script>
</head>
<body>
<?php if(($id)  >  "0"): ?><form action="?s=Admin/Group/Update" method="post" name="gxform" id="gxform">
<input type="hidden" name="id" value="<?php echo ($id); ?>">
<?php else: ?>
<form action="?s=Admin/Group/Insert" method="post" name="gxform" id="gxform"><?php endif; ?>  
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<tr class="table_title">
	<td colspan="4"><?php echo ($tpltitle); ?>群组资料
		<span class="fr">
	   		<a href="?s=Admin/Group/Show" class="no">返回</a>
	   	</span>		
	</td>
</tr>
<tr class="tr rt">
<td width="100">群组名：</td>
<td colspan="3" class="lt"><input type="text" name="name" maxlength="150" style="width:200px" value="<?php echo ($name); ?>"> *</td>
</tr>
<tr class="tr rt">
<td >群组状态：</td>
<td colspan="3"class="lt"><input type="radio" name="status" value="1" checked style="border:none"/>正常&nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="0" style="border:none" <?php if(($status)  ==  "0"): ?>checked<?php endif; ?>/> 锁定</td>
</tr> 
<tr class="tr rt">
<td >到期时间：</td>
<td colspan="3"class="lt"><input type="text" name="buildtime" id="buildtime" maxlength="50" style="width:200px" value="<?php echo (date('Y-m-d H:i',$buildtime)); ?>"></td>
</tr>
<tr class="tr rt">
<td width="100">描述：</td>
<td colspan="3" class="lt"><input type="text" name="describe" maxlength="250" style="width:500px" value="<?php echo ($describe); ?>"></td>
</tr>

<tr class="tr lt">
<td colspan="4"><?php if(($id)  >  "0"): ?><input class="bginput" type="submit" name="submit" value=" 修 改" ><?php else: ?><input class="bginput" type="submit" name="submit" value="提 交"><?php endif; ?></td>
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