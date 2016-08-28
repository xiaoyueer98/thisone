<?php
//用户自定义全局操作，这样就不用在 common.php 更改了

function isMobile() {
    $mobile = array();
    static $mobilebrowser_list ='Mobile|iPhone|Android|WAP|NetFront|JAVA|OperasMini|UCWEB|WindowssCE|Symbian|Series|webOS|SonyEricsson|Sony|BlackBerry|Cellphone|dopod|Nokia|samsung|PalmSource|Xphone|Xda|Smartphone|PIEPlus|MEIZU|MIDP|CLDC';
    //note 获取手机浏览器
    if(preg_match("/$mobilebrowser_list/i", $_SERVER['HTTP_USER_AGENT'], $mobile)) {
        return 1;
    }else{
        if(preg_match('/(mozilla|chrome|safari|opera|m3gate|winwap|openwave)/i', $_SERVER['HTTP_USER_AGENT'])) {
            return 0;
        }else{
            if($_GET['mobile'] === 'yes') {
                return  1;
            }else{
                return 0;
            }
        }
    }
}

function randomkeys($length)
{
    $key    = "";
    $pattern='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
    for($i=0;$i<$length;$i++)
    {
        $key .= $pattern{mt_rand(0,35)};
    }
    return $key;
}

function randonumkeys($length)
{
    $key    = "";
    $pattern='1234567890';
    for($i=0;$i<$length;$i++){
        $key .= $pattern{mt_rand(0,10)};
    }
    return $key;
}

function get_duration_readable($timestamp)
{
    $h = $timestamp / 3600;
    $m = $timestamp % 3600 / 60;
    $s = $timestamp % 60;
    return sprintf("%02d:%02d:%02d",$h,$m,$s);
}

function get_filesize_readable($size)
{
    $m = $size / (1024*1024);
    $k = $size / 1024;
    if($m>1)
    {
        return sprintf("%.2f MB",$m);
    }
    else
    {
        return sprintf("%d KB",$k);
    }
}

function change_local_stream_status($arr, $status){
    $streams = M('streams');
    
    $len = count($arr);
    
    file_put_contents('log.txt', "=========== stream_status len:$len \n", FILE_APPEND);
    for($i = 0; $i < $len; $i++){
        $sql = $sql + $arr['src_id'];
        if($i < ($len - 1)){
           $sql = $sql + ", ";  
        }
    }
    
    $data['status'] = $status;
    file_put_contents('log.txt', "=========== stream_status sql:$sql \n", FILE_APPEND);
    $where['cfile'] = array('in', $sql);
    $streams->where($where)->save($data);
}

function get_para_array($filename)
{
    $para_array = array();
    if(!file_exists($filename))
    {
        return $para_array;
    }
    $lines = file($filename);
    if($lines===FALSE)
    {
        return $para_array;
    }
    foreach ($lines as $line_num => $line) {
        if(strstr($line,"=")==FALSE)
        {
            continue;
        }
        $line = trim($line,"\r\n");
        $key_value = explode("=", $line);
        $para_array[$key_value[0]] = $key_value[1];
    }
    return $para_array;
}

function get_time_readable($time)
{
    //date_default_timezone_set("ASIA/SHANGHAI");
    return date("Y-m-d H:i:s",$time);
}

require("./core/Common/smedia_common.php");
require("./core/Common/aws_common.php");
/*======================================================================*/
?>