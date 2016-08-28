<?php

function get_aws_client(){
    if (require_once 'AWSSDKforPHP/sdk.class.php'){
    
        define('AWS_KEY', 'M0XID340CHJ55YQPYRTS');
        define('AWS_SECRET_KEY', 'KSovQNbAAzcVjand7rW8gWbVGQDmg8uQRloFZ7js');
        define('AWS_CANONICAL_ID', 'fangxun');
        define('AWS_CANONICAL_NAME', 'fangxun');
        $HOST = '223.105.0.225';
        $PORT = 18080;
    
        file_put_contents('log.txt', "=======start aws \n", FILE_APPEND);
        // Instantiate the S3 class and point it at the desired host
    
        $sClient = new AmazonS3(array(
            'key' => AWS_KEY,
            'secret' => AWS_SECRET_KEY,
            'canonical_id' => AWS_CANONICAL_ID,
            'canonical_name' => AWS_CANONICAL_NAME,
        ));
    
         
        $sClient->set_hostname($HOST, $PORT);
        $sClient->allow_hostname_override(false);
        file_put_contents('log.txt', "=======4444 55\n", FILE_APPEND);
        $sClient->enable_path_style();
        $sClient->disable_ssl();
        return $sClient;
    }else{
        return null;
    }
}

function read_all_dir ( $dir )
{
    $result = array();
    $handle = opendir($dir);
    if ( $handle )
    {
        while ( ( $file = readdir ( $handle ) ) !== false )
        {
            if ( $file != '.' && $file != '..')
            {
                $cur_path = $dir . DIRECTORY_SEPARATOR . $file;
                if ( is_dir ( $cur_path ) )
                {
                    $result['dir'][$cur_path] = read_all_dir ( $cur_path );
                }
                else
                {
                    $result['file'][] = $file;
                }
            }
        }
        closedir($handle);
    }
    return $result;
}

function aws_uploading($bucketname, $filename, $is_transcoded = '0', $src_id="", $format=""){
    $sClient = get_aws_client();

    file_put_contents('log.txt', "aws_uploading 11\n", FILE_APPEND);
    
 //   require_once 'AWSSDKforPHP/_samples/lib/ProgressBar.php';
    file_put_contents('log.txt', "aws_uploading 22\n", FILE_APPEND);
    
    if (!$sClient->if_bucket_exists($bucketname))
    {
        $response = $sClient->create_bucket($bucketname, AmazonS3::REGION_US_E1);
        if (!$response->isOK()) die('Could not create `' . $bucketname . '`.');
    }
    
    file_put_contents('log.txt', "aws_uploading 33vvv\n", FILE_APPEND);
    $sClient->register_streaming_read_callback('read_callback');
          
    file_put_contents('log.txt', "aws_uploading $bucketname;$filename;$src_id;$format \n", FILE_APPEND);
    if($is_transcoded === '1'){
        $hls = is_instr($format,"hls");
        $flash = is_instr($format,"flash");
        $mp4 = is_instr($format,"mp4");
        $jpegb = is_instr($format,"jpegb");
        $jpegl = is_instr($format,"jpegl");   
        
        $bucket = "bucket-001";
        file_put_contents('log.txt', "aws_uploading 00 \n", FILE_APPEND);
        file_put_contents('log.txt', "sss $hls;$flash;$mp4;$jpegb;$jpegl \n", FILE_APPEND);
        $arrname = explode('.', $filename);
        if($hls == "true"){
            $dir = "fxmedia/mpeg2ts/vod/".$src_id."/".$src_id;
            file_put_contents('log.txt', "dir:$dir \n", FILE_APPEND);
            $result =  read_all_dir($dir);        
            $files = $result['file'];
            
            $count = count($files);
            
            for($i = 0; $i < $count; $i++){
                $file = $dir."/".$files[$i];
                file_put_contents('log.txt', "upload file $file \n", FILE_APPEND);
                $realname = $arrname[0]."_".$files[$i];
                $awsresponse = $sClient->create_object($bucket, $realname, array(
                    'contentType' => 'text/plain',
                    'fileUpload' => $file,
                    'acl' => AmazonS3::ACL_PUBLIC
                ));
            }
            
            file_put_contents('log.txt', "=====file count: $count \n", FILE_APPEND);
        }
           
        if($flash == "true"){
            $_SESSION['filetype'] = 'Flash';
            file_put_contents('log.txt', "aws_uploading flash \n", FILE_APPEND);
            $file = "fxmedia/flash/vod/".$src_id."/".$src_id."/000000-000000-10011.flv";
            
            $count = count($arrname);
            file_put_contents('log.txt', "=====aws_uploading=== count:$count \n", FILE_APPEND);
            
            $realname = $arrname[0].'.flv';
            file_put_contents('log.txt', "aws_uploading flash $realname;$file\n", FILE_APPEND);
            $awsresponse = $sClient->create_object($bucket, $realname, array(
                'contentType' => 'text/plain',
                'fileUpload' => $file,
                'acl' => AmazonS3::ACL_PUBLIC
            ));
            file_put_contents('log.txt', "aws_uploading flash end\n", FILE_APPEND);
            
        }
        
        file_put_contents('log.txt', "aws_uploading 11\n", FILE_APPEND);
        if($jpegb == "true"){
            $_SESSION['filetype'] = 'Jpeg-Big';
            file_put_contents('log.txt', "aws_uploading jpegb \n", FILE_APPEND);
            $file = "fxmedia/mjepg/vod/".$src_id."/".$src_id.".jpg";
            
            $realname = $arrname[0].'.jpg';
            $awsresponse = $sClient->create_object($bucket, $realname, array(
                'contentType' => 'text/plain',
                'fileUpload' => $file,
                'acl' => AmazonS3::ACL_PUBLIC
            ));            
        }
        file_put_contents('log.txt', "aws_uploading 22\n", FILE_APPEND);
        if($jpegl == "true"){
            $_SESSION['filetype'] = 'Jpeg-Lit';
            file_put_contents('log.txt', "aws_uploading jpegl \n", FILE_APPEND);
            $file = "fxmedia/mjepg/vod/".$src_id."/".$src_id."_lit.jpg";
            
            $realname = $arrname[0]."_lit.jpg";
            $awsresponse = $sClient->create_object($bucket, $realname, array(
                'contentType' => 'text/plain',
                'fileUpload' => $file,
                'acl' => AmazonS3::ACL_PUBLIC
            ));            
        }
        file_put_contents('log.txt', "aws_uploading 33 $mp4\n", FILE_APPEND);
        if($mp4 == "true"){
            $_SESSION['filetype'] = 'MP4';
            file_put_contents('log.txt', "aws_uploading mp4 \n", FILE_APPEND);
            $file = "fxmedia/mp4/vod/".$src_id."/".$src_id.".mp4";
            
            $realname = $arrname[0].".mp4";
            $awsresponse = $sClient->create_object($bucket, $realname, array(
                'contentType' => 'text/plain',
                'fileUpload' => $file,
                'acl' => AmazonS3::ACL_PUBLIC
            ));            
        }
        $_SESSION['filetype'] = 'done';
    }else{
        file_put_contents('log.txt', "aws_uploading 99 \n", FILE_APPEND);
        $file = 'sourcefile/'.$filename; 
        
        /*
        file_put_contents('log.txt', "aws_uploading $file \n", FILE_APPEND);
        $awsresponse = $sClient->create_object($bucket, $filename, array(
            'contentType' => 'text/plain',
            'fileUpload' => $file,
            'acl' => AmazonS3::ACL_PUBLIC
        ));
        */
        $awsresponse = $sClient->create_object($bucketname, $filename, array(
            'contentType' => 'text/plain',
            'fileUpload' => $file,
            'acl' => AmazonS3::ACL_PUBLIC
        ));
        
    }
    
    /*
    $r = $awsresponse->isOK();
    file_put_contents('log.txt', "aws_uploading response:$r \n", FILE_APPEND);
    $progress_bar->update($_100_percent);
    */
}

function aws_downloading($bucketname, $filename){
    $sClient = get_aws_client();
    $sClient->register_streaming_write_callback('write_callback');
    $file_resource = fopen('sourcefile/'.$filename, 'w+');
    $response = $sClient->get_object($bucketname, $filename, array(
        'fileDownload' => $file_resource));
}

function write_callback($curl_handle, $length)
{
    $total = curl_getinfo($curl_handle, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
    $transferred = curl_getinfo($curl_handle, CURLINFO_SIZE_DOWNLOAD);
    $percentage = floor(($transferred / $total) * 100);
    $_SESSION['downloadpercent'] = $percentage;
    file_put_contents('log.txt', "write_callback $percentage% \n", FILE_APPEND);
}

function read_callback($curl_handle, $file_handle, $length)
{
    $total = curl_getinfo($curl_handle, CURLINFO_CONTENT_LENGTH_UPLOAD);
    $transferred = curl_getinfo($curl_handle, CURLINFO_SIZE_UPLOAD);
    $percentage = floor(($transferred / $total) * 100);
    $_SESSION['uploadpercent'] = $percentage;
    file_put_contents('log.txt', "read_callback $percentage% \n", FILE_APPEND);
}

function get_info_name($filename){
    $info_root = "/etc/noveltv/tserver/infos/";
    $info_file = $info_root . str_replace("/","_",$filename) . ".info";
    return $info_file;
}

function get_src_id($src)
{
    $path_parts = pathinfo($src);
    $id = $path_parts['filename'];

    $allowed = "/[^a-z0-9\\-]/i";
    $id = preg_replace($allowed,"",$id);

    if(strlen($id)==0)
    {
        $id = randomkeys(16);
    }
    return $id;
}

function gen_media_info($filename)
{
    $info_file = get_info_name($filename);
    $cmd = "ffprobe $filename -show_format -show_streams >$info_file 2>&1";
    return system($cmd,$return_var);
}

function get_media_duration($filename)
{
    $info_file = get_info_name($filename);
    if(file_exists($info_file)===FALSE)
    {
        gen_media_info($filename);
    }
    $array_info = get_mediainfo_array($info_file,"FORMAT",0);
    if($array_info===FALSE)
    {
        return 0;
    }
    return intval($array_info['duration']);
}

function get_mediainfo_array($filename,$section,$index)
{
    $para_array = array();
    $i          = -1;

    $lines = file($filename);
    if($lines===FALSE)
    {
        return FALSE;
    }

    $section_start = "[".$section."]";
    $section_end   = "[/".$section."]";

    foreach ($lines as $line_num => $line)
    {
        $line = trim($line,"\r\n ");
        if($i<$index)
        {
            if(strstr($line,$section_start)!==FALSE)
            {
                $i++;
            }
            continue;
        }
        else
        {
            if(strstr($line,$section_end)!==FALSE)
            {
                break;
            }
        }
        	
        if(strstr($line,"=")==FALSE)
        {
            continue;
        }
        $key_value = explode("=", $line);
        $para_array[$key_value[0]] = $key_value[1];
    }
    if($i<$index)
    {
        return FALSE;
    }
    else
    {
        return $para_array;
    }
}

function get_version(){
    return "1.2.3";
}
?>