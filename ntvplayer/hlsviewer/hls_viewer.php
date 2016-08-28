<?php
session_start();
if(isset( $_SESSION["hlsview"])==FALSE)
{
	$_SESSION["hlsview"]   = 0;
	$_SESSION["hlsview_e"] = 0;
	$_SESSION["hlsview_d"] = 0;
}
$url = @$_REQUEST['url'];
if($url=="")
{
	exit(0);
}

$_SESSION["hlsview"] = $_SESSION["hlsview"] + 1;

echo "Total:" . $_SESSION["hlsview"] . "  ConnectError:" . $_SESSION["hlsview_e"] . "  ContentError:" . $_SESSION["hlsview_d"];
echo "<br>---------------------------------------------<br>";

$text = @file_get_contents($url);
if($text!==FALSE)
{
	if(strstr($text,"#EXTM3U")===FALSE)
	{
		$_SESSION["hlsview_d"] = $_SESSION["hlsview_d"]+1;
	}
	$text = str_replace("\n","<br>",$text);
	echo $text;
}
else
{
	$_SESSION["hlsview_e"] = $_SESSION["hlsview_e"]+1;
	echo "<font color='#FF0000' size='3'>Can't load media data!</font>";
}
?>