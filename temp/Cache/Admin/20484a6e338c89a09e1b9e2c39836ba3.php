<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	$arr = get_system_info();
	$cpu = $arr['cpu'];
	$arr_mem = $arr['momery'];
	$arr_par = $arr['par'];
?>
<head>
<title>环境检测-<?php echo C("web_name");?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css?v=1001'>
<head>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<style>td{ height:22px; line-height:22px}</style>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
  <tr class="table_title">
    <td>系统信息：</td>
  </tr>
  <tr class="ji">
    <td style="height:60px;">
    <table width="600" border="0" cellspacing="1" cellpadding="10" class="table">
      <tr class="ji" style="background-color:#093">
        <td align="center" style="background-color:#fff; font-size:14px; ">
        	<img src="./views/images/admin/live.png" alt="" />
        	<div>直播节目 <font style="font-weight:bold;font-style:italic;">  <?php echo ($live_count); ?></font></div>
        </td>
        <td align="center" style="background-color:#fff; font-size:14px; ">
        	<img src="./views/images/admin/vod.png" alt="" />
        	<div>点播节目 <font style="font-weight:bold;font-style:italic;">  <?php echo ($vod_count); ?></font></div>
        </td>
        <td align="center" style="background-color:#fff; font-size:14px; ">
        	<img src="./views/images/admin/tv.png" alt="" />
        	<div>电视节目 <font style="font-weight:bold;font-style:italic;"> <?php echo ($tv_count); ?></font></div>
        </td>
        <td align="center" style="background-color:#fff; font-size:14px;">
        	<img src="./views/images/admin/reg.png" alt="" />
        	<div>注册用户   <font style="font-weight:bold;font-style:italic;"> <?php echo ($reg_user_count); ?></font></div>
        </td>
        <td align="center" style="background-color:#fff; font-size:14px; ">
        	<img src="./views/images/admin/online.png" alt="" />
        	<div>在线用户 <font style="font-weight:bold;font-style:italic;">  <?php echo ($online_user_count); ?></font></div>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
  <tr class="table_title">
    <td colspan="2">系统环境检测：</td>
  </tr>
  <tr class="ji">
    <td width="200">主机名 (IP：端口)：</td>
    <td ><?php echo $_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'].')' ?></td>
  </tr>
  <tr class="ou">
    <td>程序目录：</td>
    <td><?php echo C("web_path");?></td>
  </tr>
  <tr class="ji">
    <td>Web服务器：</td>
    <td><?php echo $_SERVER['SERVER_SOFTWARE'] ?></td>
  </tr>
  <tr class="ou">
    <td>PHP 运行方式：</td>
    <td><?php echo PHP_SAPI ?></td>
  </tr>
  <tr class="ji">
    <td>PHP版本：</td>
    <td><?php echo PHP_VERSION ?></td>
  </tr>
  <tr class="ou">
    <td>MySQL 版本：</td>
    <td><?php if (function_exists("mysql_close")) {
    		echo mysql_get_client_info();
        }else{
        	echo '不支持';
        } ?>&nbsp;&nbsp;</td>
  </tr>
  <tr class="ji">
    <td>GD库版本：</td>
    <td><?php if(function_exists('gd_info')){
    	 	$gd = gd_info();
            echo $gd['GD Version'];
    	}else{
        	echo "不支持";
        } ?></td>
  </tr>
  <tr class="ou">
    <td>最大上传限制：</td>
    <td><?php if (ini_get('file_uploads')) {
    		echo ini_get('upload_max_filesize');
        }else{
        	echo '<span style="color:red">Disabled</span>';
    } ?></td>
  </tr>
  <tr class="ji">
    <td>最大执行时间：</td>
    <td><?php echo ini_get('max_execution_time') ?>秒</td>
  </tr>
  <!--  
  <tr class="ou">
    <td>采集函数检测：</td>
    <td><?php if (ini_get('allow_url_fopen')) {
    		echo '支持';
        }else{
        	echo '<span style="color:red">不支持</span>';
    } ?></td>
  </tr>  
  -->   
</table>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
  <tr class="table_title">
    <td colspan="2">系统资源统计：</td>
  </tr>
  <tr class="ji">
    <td width="200">CPU：</td>
    <td >
    	<?php if($cpu == ""){
				echo "没获得CPU信息";
			}else{
				echo "空闲:".$cpu."%";
			} ?>
    </td>
  </tr>  
  <tr class="ou">
    <td width="200">内存：</td>
    <td >
    	<div>
    		总内存：
	    	<?php echo $arr_mem['total']."MB"; ?>
    	</div>
    	<div>
    		已使用：
	    	<?php echo $arr_mem['used']."MB"; ?>    	
    	</div>
    	<div>
    		还剩：
	    	<?php echo $arr_mem['free']."MB"; ?>    	
    	</div>    	
    </td>
  </tr>  
  <tr class="ji">
    <td width="200">硬盘：</td>
    <td > 
    	<?php
    		$len = count($arr_par);
    		for($i = 0; $i < $len; $i++){
				$name = $arr_par[$i]['name'];
				$precent = 0;
				echo $name;
				$used = $arr_par[$i]['used'];
				$total = $arr_par[$i]['total'];
				$precent = round( $used/$total * 100 , 2);
		?>
			<div class="Bar">
				<div style="width: <?php echo ($precent); ?>%;"> 
				 <span><?php echo ($precent); ?>%</span> 
				</div>
			</div>	
		<?php			
    		}
    	?>
    </volist>
    </td>
  </tr>   
</table>
<script>var version='<?php echo C("cms_var");?>';</script>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="http://union.keatv.com/app/version.js"></script>
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