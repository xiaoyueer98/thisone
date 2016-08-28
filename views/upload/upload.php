<?php

file_put_contents('log.txt', '***************** upload.......\n', FILE_APPEND);

$error       = "";
$username    = "";
$source_root = "";

$token = @$_REQUEST['token'];

$source_root = "/var/media";
file_put_contents('log.txt', '***************** upload $source_root\n', FILE_APPEND);

while($error=="")
{
    $sub_path   = @$_REQUEST['sub_path'];
    $file_name  = @$_REQUEST['file_name'];
    $tmp_path   = @$_REQUEST['tmp_path'];
    $uploader   = @$_REQUEST['uploader'];
    $start      = @$_REQUEST['start'];
    $file_size  = @$_REQUEST['file_size'];
    $duration   = "";
    $usetme     = 0;
    
    
    if($start!="")
    {
        $usetme = time() - $start;
        $duration = get_duration_readable1($usetme);
    }
    
    //检查必要参数
    if($file_name=="" || $tmp_path=="" || !file_exists($tmp_path))
    {
        $error =  "没有文件被上传!";
        break;
    }
    
    //设置上传位置
    if(strlen($sub_path)==0 || $sub_path==".")
    {
        $sub_path = rtrim($source_root,"/") . "/";
    }
    else
    {
        $sub_path = ltrim($sub_path,"/");
        $sub_path = rtrim($source_root,"/"). "/$sub_path/";
    }
    $uploaddir  = $sub_path;
    if(!file_exists($uploaddir) && !mkdir($uploaddir,0755,TRUE))
    {
        $error =  "移动文件错误. 用户上传路径不存在或不能被写入! ";
        break;
    }
    /*
    $filename   = html_entity_decode(basename($file_name));
    $filename   = str_replace(" ","", $filename);
    $filename   = iconv("utf-8", "gb2312", $filename);
    $uploadfile = $uploaddir . $filename;
    $uploadfilet= $uploadfile . randomkeys(6) . ".tmp";
    	
    if(rename($tmp_path, $uploadfilet))
    {
        if(file_exists($uploadfile))
        {
            $path_parts = pathinfo($uploadfile);
            $uploadfile = $path_parts['dirname'] . '/' . $path_parts['filename'] . randomkeys(6) . "." . $path_parts['extension'];
        }
        if(!rename($uploadfilet,$uploadfile))
        {
            unlink($uploadfilet);
            $error =  "移动文件到用户目录错误!";
        }
    }
    else
    {
        unlink($tmp_path);
        $error =  "文件改名错误!";
    }
*/
    break; //just use one file
}

if($error!="")
{
    echo json_encode(array('状态' => $error));
}
else
{
    echo json_encode(array('状态' => '成功'.$usetme));
}

function get_duration_readable1($timestamp)
{
    $h = $timestamp / 3600;
    $m = $timestamp % 3600 / 60;
    $s = $timestamp % 60;
    return sprintf("%02d:%02d:%02d",$h,$m,$s);
}

?>