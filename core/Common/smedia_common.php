<?php
/**
 * the interfaces for application of mserver
 */
function get_application(){
    file_put_contents('log.txt', "get_application aaa.......\n", FILE_APPEND);
    /*
    $media_host = C('media_host');
    $media_pwd = C('media_pwd');
    $media_user = C('media_user');
    */
   // $media_host = "192.168.10.187";
   // $media_host = "218.241.196.196";
   /*
   $media_host = "127.0.0.1";
    $user_name = "admin";
    $media_pwd = "fangxun";
    
    $_SESSION["mstoken"] = "";
    $url = 'http://'.$media_host.'/mserver/interface/application/?app=get';
    if(strpos($url,"islogin")===FALSE && is_login($media_host)===FALSE){
        get_media_token($media_host, $user_name, $media_pwd);
    }
    */
    $media_host = C('mserver_url');
    $url = 'http://'.$media_host.'/mserver/interface/application/?app=get';
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    $application_array = array();
    $realurl = $url.'&token='.$_SESSION["mstoken"];
    
    $node = get_root_node($realurl,"applications");
    if($node===FALSE)
    {
        return $application_array;
    }
    $nodeList =  $node->getElementsByTagName("application");
    for ($i = 0; $i < $nodeList->length; $i++)
    {
		$sub_node    = $nodeList->item($i);
		$app_name    = @$sub_node->getAttribute('name');
		$sub_nodeList= $sub_node->getElementsByTagName ('para');
	  
		$para_array = array();
		for ($j = 0; $j < $sub_nodeList->length; $j++)
		{
			$sub_node    = $sub_nodeList->item($j);
			$name        = @$sub_node-> getAttribute('name');
			$value       = @$sub_node-> getAttribute('value');
			$para_array[$j] = array($name,$value);
		}

		$application_array[$app_name] = $para_array;
    }

    return $application_array;
}

function add_application($app, $audio_only='off', $live_on = 'off', $vod_path = '')
{
    $media_host = C('mserver_url');
	$location = "http://".$media_host."/mserver/interface/application/?app=add&application=$app&".
	            "audio_only=$audio_only&allow_live=$live_on&vod_path=$vod_path";
	$ret = check_login();
	if($ret == false){
	    header("Location: ../auth/right_error.html?error=notauthorized");
	}
	
	$_SESSION['mstoken'] = $ret;
	$realurl = $location.'&token='.$ret;
	return simple_call($realurl);
}

function remove_application($app){
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    
    $media_host = C('mserver_url');
	$location = "http://".$media_host."/mserver/interface/application/?app=remove_application&application=$app&token=$ret";
	return simple_call($location);   
}

/**
 *the interfaces for DVR of mserver 
 */

function is_instr($str,$needle)
{
    if(strstr($str,$needle)===FALSE)
    {
        return "false";
    }
    else
    {
        return "true";
    }
}

function get_dvr_config($appname)
{
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    
    $media_host = C('mserver_url');
    
    $paras = array();
    $location = "http://".$media_host."/mserver/interface/application/?app=get_dvr_paras&application=$appname&token=$ret";
    $node     = get_root_node($location,"application");
    if($node===FALSE)
    {
        return FALSE;
    }

    $nodeList  =  $node->getElementsByTagName ("para");
    for ($i=0; $i < $nodeList->length; $i++)
    {
        $sub_node  = $nodeList->item($i);
        $name      = @$sub_node->getAttribute('name');
        $value     = @$sub_node->getAttribute('value');
        if($name!="")
        {
            $paras[$name] = $value;
        }
    }
    return $paras;
}

function set_dvr_formats($app,$formats)
{
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    
    $token = $ret;
    $media_host = C('mserver_url');
    
    $location = "http://".$media_host."/mserver/interface/application/?app=open_dvr&application=$app&token=$token";
    $ret = simple_call($location);
    if($ret!==TRUE)
    {
        return $ret;
    }

    $location = "http://".$media_host."/mserver/interface/application/?app=set_dvr_format&application=$app&formats=$formats&token=$token";
    $ret = simple_call($location);
    if($ret!==TRUE)
    {
        return $ret;
    }

    return TRUE;
}

function open_dvr(){
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    
    $media_host = C('mserver_url');
    $url = "http://'.$media_host.'/mserver/interface/application/?app=open_dvr&token=$ret";  
    return simple_call($location);
}

function close_dvr($app_name='__Default'){
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    
    $media_host = C('mserver_url');
    $url = 'http://'.$media_host.'/mserver/interface/application/?app=close_dvr&token='.$ret;
    
    return simple_call($url);    
}

function set_dvr_format($app_name='__Default', $formats='flv;hls'){
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    
    $media_host = C('mserver_url');
    $url = 'http://'.$media_host.'/mserver/interface/application/?app=set_dvr_format&formats='.$formats.'&token='.$ret;
    
    return simple_call($location);    
}

/**
 * the interfaces for tv stream of mserver
 */
function add_tv_streams($app_name='__Default', $tv_streams='flv;hls'){
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    
    $media_host = C('mserver_url');
    $url = 'http://'.$media_host.'/mserver/interface/application/?app=add_tv_streams&tv_streams='.$tv_streams.'&token='.$ret;

   return simple_call($location); 
}

function remove_tv_streams($app_name='__Default', $tv_streams='flv;hls'){
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    
    $media_host = C('mserver_url');
    $url = 'http://'.$media_host.'/mserver/interface/application/?app=add_tv_streams&tv_streams='.$tv_streams.'&token='.$ret;

    return simple_call($location);
}

function republish($app_name, $pub_to, $pub_app=''){ 
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    
    $media_host = C('mserver_url');
    $url = 'http://'.$media_host.'/mserver/interface/application/?app=republish&application='.$app_name.'&pub_to='.$pub_to.'&pub_app='.$pub_app.'&token='.$ret;
    
    return simple_call($location);    
}

function remove_republish($app_name){
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    
    $media_host = C('mserver_url');
    $url = 'http://'.$media_host.'/mserver/interface/application/?app=get_active_streams&application='.$app_name.'&token='.$ret;
    
    return simple_call($location);
}

/**
 * the interface for stream of mserver
 */
function get_active_streams($application){
    
    $ret = check_login();
    file_put_contents('log.txt', "get_active_streams 111....ret:$ret..\n", FILE_APPEND);
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }else{
        $_SESSION['mstoken'] = $ret;
    }
    
    $media_host = C('mserver_url');
	$location = "http://".$media_host."/mserver/interface/stream/?app=get_active&application=$application&token=$ret";
	$node     = get_root_node($location,"streams");
	if($node===FALSE)
	{
		return FALSE;
	}

	$nodeList =  $node->getElementsByTagName("stream");
	if($nodeList->length<=0)
	{
		return FALSE;
	}
	else
	{
		return $nodeList;
	}
}

function close_active_stream($application,$stream)
{
    $ret = check_login();
    file_put_contents('log.txt', "close_active_stream 111......\n", FILE_APPEND);
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }else{
        $_SESSION['mstoken'] = $ret;
    }
    
    $media_host = C('mserver_url');
    
    $location = "http://".$media_host."/mserver/interface/stream/?app=close_stream&application=$application&stream=$stream&token=$ret";
    return simple_call($location);
}

function sort_active_items($nodeList)
{
    $nodes = array();
    for ($i = 0; $i < $nodeList->length; $i++)
    {
        $sub_node    = $nodeList->item($i);
        $key         = $sub_node->getAttribute('application').$sub_node-> getAttribute('stream')."_".$i;
        $nodes[$key] = $sub_node;
    }
    krsort($nodes,SORT_STRING);
    return $nodes;
}

function get_streams($application,&$count,$pageno=1,$force_update="no"){
    file_put_contents('log.txt', "get_streams......$application;$count;$pageno;$force_update\n", FILE_APPEND);
    $media_host = C('mserver_url');
    $url = "http://".$media_host."/mserver/interface/stream/?app=get&application=$application";
    $ret = check_login();
    file_put_contents('log.txt', "get_streams 111......\n", FILE_APPEND);
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }else{
        $_SESSION['mstoken'] = $ret;
    }

    $realurl = $url.'&token='.$_SESSION['mstoken'];
	$node     = get_root_node($realurl,"streams");
	if($node===FALSE)
	{
		return FALSE;
	}
	$count    = intval(@$node->getAttribute('count'));
	$nodeList =  $node->getElementsByTagName("stream");
	if($nodeList->length<=0)
	{
		return FALSE;
	}
	else
	{
		return $nodeList;
	};    
}

function get_stream_versions($app, $stream, $format, $pageno="1", $force_update="no")
{
        $nodeList = TRUE;

        file_put_contents('log.txt', " app:$app; stream:$stream \n", FILE_APPEND);
         
        
        $media_host = C('mserver_url');
        $ret = check_login();
        file_put_contents('log.txt', "get_stream_vers 111......\n", FILE_APPEND);
        if($ret !== false){
            header("Location: ../auth/right_error.html?error=notauthorized");
        }else{
            $_SESSION['mstoken'] = $ret;
        }

        $location = "http://".$media_host."/mserver/interface/stream/?app=get_stream_files&application=$app" .
        "&stream=$stream&format=$format&pageno=$pageno&force_update=$force_update&token=".$_SESSION['mstoken'];
         //print_r($location);
        $node = get_root_node($location,"stream_files");
        //print_r($node);die();
        if($node===FALSE)
        {
            $nodeList = FALSE;
        }else {
            $nodeList = $node->getElementsByTagName("file");
           // print_r($nodeList);
            if ($nodeList->length <= 0) {
                //echo "111";
                $nodeList = FALSE;
            }
        }
        //print_r($nodeList);die();
        return $nodeList;
}


function remove_stream($app_name, $stream){
    $media_host = C('mserver_url');
	$location = "http://".$media_host."/mserver/interface/stream/?app=remove_stream&application=$app_name&stream=$stream";
	return simple_call2($location,$des);
}

function get_files($app_name, $stream, $fotmat='flv;ts'){
    $media_host = C('mserver_url');
    $media_pwd = C('media_pwd');
    $media_user = C('media_user');
    
    $url = 'http://'.$media_host.'/mserver/interface/stream/?app=get_files&application='.$app_name.'&stream='.$stream.'&format='.$fotmat;
    
    $result = post_mserver($url);    
}


/**
 * the interfaces for streaming of mserver 
 * @param string $id
 */
/*===========================streaming====================================*/
/**
 * 查询视频流转换任务
 * @param string $id
 */
function get_streaming($id=""){
    $media_host = C('mserver_url');
    $media_pwd = C('media_pwd');
    $media_user = C('media_user');
    
    $stream_array = array();
    $url = 'http://'.$media_host.'/mserver/interface/streaming/?app=get&id='.$id;
    
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    $realurl = $url.'&token='.$_SESSION["mstoken"];
    
	$node = get_root_node($realurl,"streamings");
	if($node===FALSE)
	{
		return $stream_array;
	}

	$nodeList =  $node->getElementsByTagName("streaming");
	for ($i = 0; $i < $nodeList->length; $i++)
	{
		$para_array  = array();
		$sub_node    = $nodeList->item($i);
		$sub_nodeList= $sub_node->getElementsByTagName("para");
		for ($j = 0; $j < $sub_nodeList->length; $j++)
		{
			$para_node  = $sub_nodeList->item($j);
			$key        = $para_node->getAttribute('name');
			$value      = $para_node->getAttribute('value');
			$para_array[$key] = $value;
		}
		$stream_array[$i] = $para_array;
	}

	return $stream_array;
}

function add_streaming($arr){
      
    $media_host = C('mserver_url');
    
    $url = 'http://'.$media_host.'/mserver/interface/streaming/?app=add';
    
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    
    $qstring  = "";
    if ($arr){
        foreach ($arr as $key => $value)
        {
            $qstring .= "&" . $key . "=" . urlencode($value);
        }
    }
    
    $url .= $qstring."&token=".$ret;
    //echo $location;
    file_put_contents('log.txt', "=== add_streaming:$url \n", FILE_APPEND);
    return simple_call($url);
    
}

function start_streaming($id){
    $media_host = C('mserver_url');
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    
    $url = 'http://'.$media_host.'/mserver/interface/streaming/?app=start&id='.$id;
    
    $realurl = $url.'&token='.$_SESSION["mstoken"];
    return simple_call($realurl);
}

function del_streaming($id)
{
    $media_host = C('mserver_url');
    $url = 'http://'.$media_host.'/mserver/interface/streaming/?app=delete&id='.$id;
    
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    $realurl = $url.'&token='.$_SESSION["mstoken"];
    return simple_call($realurl);
}

function stop_streaming($id){
    $media_host = C('mserver_url');
    
    $url = 'http://'.$media_host.'/mserver/interface/streaming/?app=stop&id='.$id;
    
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    $realurl = $url.'&token='.$_SESSION["mstoken"];
    
   return simple_call($realurl);   
}

/**
 * the interfaces for auth of mserver
 */
function get_auth_info($app_name, $method){
    $media_host = C('mserver_url');
    $media_pwd = C('media_pwd');
    $media_user = C('media_user');
    $url = 'http://'.$media_host.'/mserver/interface/auth/?app=get_auth_info&application='.$app_name.'&method='.$method;
    
    $result = post_mserver($url);
    
}

function open_auth($app_name, $method, $auth_url=''){
    $media_host = C('mserver_url');
    $media_pwd = C('media_pwd');
    $media_user = C('media_user');
    $url = 'http://'.$media_host.'/mserver/interface/auth/?app=open_auth&application='.$app_name.'&method='.$method;
    
    $result = post_mserver($url);    
}

function close_auth($app_name, $method){
    $media_host = C('mserver_url');
    $media_pwd = C('media_pwd');
    $media_user = C('media_user');
    $url = 'http://'.$media_host.'/mserver/interface/auth/?app=close_auth&application='.$app_name.'&method='.$method;
    
    $result = post_mserver($url);
}

function set_stream_token($app_name, $method, $stream, $stream_token){
    $media_host = C('mserver_url');
    $media_pwd = C('media_pwd');
    $media_user = C('media_user');
    $url = 'http://'.$media_host.'/mserver/interface/auth/?app=set_stream_token&application='.$app_name.'&method='.$method.'&stream_token='.$stream_token;
    
    $result = post_mserver($url);    
}

function get_whitelist(){
    $media_host = C('mserver_url');
    $media_pwd = C('media_pwd');
    $media_user = C('media_user');
    $url = 'http://'.$media_host.'/mserver/interface/auth/?app=get_whitelist';
    
    $result = post_mserver($url);    
}

function set_whitelist($ips){
    $media_host = C('mserver_url');
    $media_pwd = C('media_pwd');
    $media_user = C('media_user');
    $url = 'http://'.$media_host.'/mserver/interface/auth/?app=set_whitelist&ips='.$ips;
    
    $result = post_mserver($url);    
}

function update_interface_token($new_token){
    $media_host = C('mserver_url');
    $media_pwd = C('media_pwd');
    $media_user = C('media_user');
    $url = 'http://'.$media_host.'/mserver/interface/auth/?app=update_interface_token&new_token='.$new_token;
    
    $result = post_mserver($url);    
}

/**
 * the interfaces for system of mserver
 */
function restart_mserver(){
    $media_host = C('mserver_url');
    $media_pwd = C('media_pwd');
    $media_user = C('media_user');
    $url = 'http://'.$media_host.'/mserver/interface/system/?app=restart';

    $result = post_mserver($url);
}


function get_system_info(){
    $media_host = C('mserver_url');
    $arr_sys = array();
    
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    $url = 'http://'.$media_host.'/mserver/interface/system/?app=get_system_info&token='.$ret;
    $node  = get_root_node($url,"system_info");
    
    $update_time = $node->getAttribute('update_time');
    file_put_contents('log.txt', "update time $update_time \n", FILE_APPEND);
    
    $mem_node = $node->getElementsByTagName("memory");
    $len = $mem_node->length;
    
    if($len > 0){
        $mem_nodei = $mem_node->item(0);
        file_put_contents('log.txt', "eeeeee len=$len sss\n", FILE_APPEND);
        $mem_total = $mem_nodei->getAttribute('total');
        $mem_used = $mem_nodei->getAttribute('used');
        $mem_free = $mem_nodei->getAttribute('free');
    
        $arr_mem['total'] = $mem_total;
        $arr_mem['used'] = $mem_used;
        $arr_mem['free'] = $mem_free;
        
        $arr_sys['momery'] = $arr_mem;
        file_put_contents('log.txt', "total $mem_total;$mem_used;$mem_free \n", FILE_APPEND);
    }

    $cpu_node = $node->getElementsByTagName("cpu");
    $len = $cpu_node->length;
    
    if($len > 0){
        $cpu_nodei = $cpu_node->item(0);
        file_put_contents('log.txt', "cpu $len \n", FILE_APPEND);
        $cpu_free = $cpu_nodei->getAttribute('free');
        $arr_sys['cpu'] = $cpu_free;
        file_put_contents('log.txt', "cpu free $cpu_free \n", FILE_APPEND);
    }

    $subnodeList = $node->getElementsByTagName("partition");
    $len =  $subnodeList->length;
    file_put_contents('log.txt', "sss part:$len \n", FILE_APPEND);
    
    $arr_sys['par'] = $subnodeList;
    
    $arr_par = array();
    for ($i = 0; $i < $subnodeList->length; $i++)
    {
        $arr         = array();
        $sub_node    = $subnodeList->item($i);
        $arr['name']       = $sub_node->getAttribute('name');
        $arr['total'] = $sub_node->getAttribute('total_size');
        $arr['used'] = $sub_node->getAttribute('used');
        
        $name = $arr['name'];
        $total = $arr['total'];
        $used = $arr['used'];
        file_put_contents('log.txt', "===== name:$name;$total;$used \n", FILE_APPEND);
        $arr_par[] = $arr;
    }
    $arr_sys['par'] = $arr_par;
    
    $t = $arr_sys['par'];
    for($i = 0; $i < count($t); $i++){
        $n = $t[$i]['name'];
        file_put_contents("log.txt", "===No.$i name:$n \n", FILE_APPEND);
    }
    
    return $arr_sys;
}

/**
 * transcode
 */
/*=====================transcode=====================================*/
function transcode($url){
    return simple_call($url);    
}

function transcode_query_status($src_id, $status='done', $token){
   $media_host = C('mserver_url');
    $url = 'http://'.$media_host.'/mserver/interface/transcode/?app=query_status&src_id='.$src_id.'&token='.$token;
    
    $transcode_array = array();

    $node = get_root_node($url, 'transcode');
    file_put_contents('log.txt', "transcode_query_status 111 \n", FILE_APPEND);
    if($node===FALSE)
    {
        return transcode_array;
    }
    
    file_put_contents('log.txt', "vvvvvvv \n", FILE_APPEND);
    $nodeList  =  $node->getElementsByTagName ("transcode_duty");
    $coun = count($nodeList);

    file_put_contents('log.txt', "transcode_query_status count:$coun \n", FILE_APPEND);
    $sub_node    = $nodeList->item(0);
    $arr["src_id"]       = @$sub_node->getAttribute('src_id');
    $arr["src_file"]     = @$sub_node->getAttribute('src_file');
    $arr["application"]  = @$sub_node->getAttribute('application');
    $arr["bitrate"]      = @$sub_node->getAttribute('bitrate');
    $arr["bitrate_audio"]= @$sub_node->getAttribute('bitrate_audio');
    $arr["height"]       = @$sub_node->getAttribute('height');
    $arr["width"]        = @$sub_node->getAttribute('width');
    $arr["result"]       = @$sub_node->getAttribute('result');
    $arr["work_duration"]= @$sub_node->getAttribute('work_duration');
    $arr["end_time"]     = @$sub_node->getAttribute('end_time');
    $arr["start_time"]   = @$sub_node->getAttribute('start_time');
    $arr["add_time"]     = @$sub_node->getAttribute('add_time');
    $arr["status"]       = @$sub_node->getAttribute('status');
    $arr["error_des"]    = @$sub_node->getAttribute('error_des');
    $arr["encode_progress"] = @$sub_node->getAttribute('encode_progress');
    return $arr;    
    
}

function get_duty_array($status, $token)
{
    $media_host = C('mserver_url');
    $url   = "http://".$media_host."mserver/interface/transcode/?app=query_status&status=$status&token=$token";
    $node  = get_root_node($url,"transcode");
    if($node===FALSE)
    {
        return FALSE;
    }
    $arr_duties = array();
    $nodeList  =  $node->getElementsByTagName ("transcode_duty");
    for ($i = 0; $i < $nodeList->length; $i++)
    {
        $arr         = array();
        $sub_node    = $nodeList->item($i);
        $arr["src_id"]       = @$sub_node->getAttribute('src_id');
        $arr["src_file"]     = @$sub_node->getAttribute('src_file');
        $arr["application"]  = @$sub_node->getAttribute('application');
        $arr["bitrate"]      = @$sub_node->getAttribute('bitrate');
        $arr["bitrate_audio"]= @$sub_node->getAttribute('bitrate_audio');
        $arr["height"]       = @$sub_node->getAttribute('height');
        $arr["width"]        = @$sub_node->getAttribute('width');
        $arr["result"]       = @$sub_node->getAttribute('result');
        $arr["work_duration"]= @$sub_node->getAttribute('work_duration');
        $arr["end_time"]     = @$sub_node->getAttribute('end_time');
        $arr["start_time"]   = @$sub_node->getAttribute('start_time');
        $arr["add_time"]     = @$sub_node->getAttribute('add_time');
        $arr["status"]       = @$sub_node->getAttribute('status');
        $arr["error_des"]    = @$sub_node->getAttribute('error_des');
        $arr["encode_progress"] = @$sub_node->getAttribute('encode_progress');
        $arr_duties[] = $arr;
    }
    return $arr_duties;
}


function load_app_tags($app,$reload)
{
    $app_tags_name = get_app_tags_name($app);
    if(isset($_SESSION[$app_tags_name])==FALSE || $reload===TRUE)
    {
        $_SESSION[$app_tags_name] = get_para_array(get_app_tags_file($app));
    }
    return TRUE;
}

function save_app_tags($app)
{
    $app_tags_name = get_app_tags_name($app);
    if(isset( $_SESSION[$app_tags_name])==FALSE)
    {
        return FALSE;
    }
    $filename = get_app_tags_file($app);
    $handle = fopen($filename,"w");
    if($handle===FALSE)
    {
        return FALSE;
    }

    $count   = 0;
    $context = "";
    foreach($_SESSION[$app_tags_name] as $key=>$value)
    {
        if($value=="") continue;
        $context = $context . "$key=$value\n";
        if($count++>=100)
        {
            if(fwrite($handle,$context)===FALSE)
            {
                fclose($handle);
                return False;
            }
            $count   = 0;
            $context = "";
        }
    }

    if(fwrite($handle,$context)===FALSE)
    {
        fclose($handle);
        return FALSE;
    }
    else
    {
        fclose($handle);
        return TRUE;
    }
}

function get_app_tags_name($app)
{
    return $app.".tags";
}

function get_app_tags_file($app)
{
    global $g_ntv_stream_tags_path;
    return $g_ntv_stream_tags_path . $app . ".tags";
}

function add_stream_tag($app,$stream,$ver,$tag)
{
    load_app_tags($app,TRUE);
    $app_tags_name = get_app_tags_name($app);
    $key = get_stream_key($stream,$ver);
    $_SESSION[$app_tags_name][$key] = $tag;
    return save_app_tags($app);
}

function get_stream_tag($app,$stream,$ver)
{
    $app_tags_name = get_app_tags_name($app);
    $key = get_stream_key($stream,$ver);
    if(isset($_SESSION[$app_tags_name][$key])==FALSE)
    {
        return "";
    }
    return $_SESSION[$app_tags_name][$key];
}

function remove_stream_tag($app,$stream,$ver)
{
    load_app_tags($app,TRUE);
    $app_tags_name = get_app_tags_name($app);
    $key = get_stream_key($stream,$ver);
    $_SESSION[$app_tags_name][$key] = "";
    return save_app_tags($app);
}

function get_stream_key($stream,$ver)
{
    $key = $stream;
    if($ver!=-1)
    {
        $key = $key . "_v" . $ver;
    }
    return $key;
}

function get_date_str($time)
{
    if(strlen($time)==0)
        return "";
    else
        return date("Y-m-d H:i:s",$time);
}

function get_encode_paras(&$arr)
{
    $paras = "H.264/AAC ";
    if(intval($arr['bitrate'])<=0)
    {
        $paras = $paras . "no-encode";
    }
    else
    {
        $paras = $paras . $arr['bitrate'] . "Kbps";
    }
    if(intval($arr['width'])>0)
    {
        $paras = $paras . " " . $arr['width'] . "x" . $arr['height'];
    }
    return $paras;
}

/**
 * ==========================media source files==========================
 */
function qurey_files($url)
{
    $location = $url;
    $node     = get_root_node($location,"files");
    if($node===FALSE)
    {
        return FALSE;
    }
    $fie_array = array();
    $nodeList  =  $node->getElementsByTagName ("file");
    for ($i = 0; $i < $nodeList->length; $i++)
    {
        $sub_node= $nodeList->item($i);
        $name    = @$sub_node->getAttribute('name');
        $type    = @$sub_node->getAttribute('type');
        $mtime   = @$sub_node->getAttribute('modifytime');
        $size    = @$sub_node->getAttribute('size');
        $duration= @$sub_node->getAttribute('duration');
         
        $array   = array("name"=>$name,
            "type"=>$type,
            "mtime"=>$mtime,
            "size"=>$size,
            "duration"=>$duration
        );
        $fie_array[] = $array;
    }

    return $fie_array;
}
function delete_ver($app,$stream,$ver,&$error){
    $ret=check_login();
    //print_r($ret);die();
    if($ret==false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    $_SESSION['mstoken']=$ret;
    $media_host = C('mserver_url');
    $location="http://".$media_host."/mserver/interface/stream/?app=delete_file&application=$app&stream=$stream&version=$ver&token=$ret";
    //print_r($location);echo "1111";die();
    //return simple_call2($location,$error);
    $r = simple_call2($location,$error);
    file_put_contents('log.txt', "delete_ver error:".$error, FILE_APPEND);
    return $r;
}
function delete_file($filename,&$error)
{
    file_put_contents('log.txt', "delete file $filename \n", FILE_APPEND);
    
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    $media_host = C('mserver_url');
    $location = "http://".$media_host."/mserver/interface/transcode/?app=delete_file&filename=$filename&token=$ret";
    return simple_call2($location,$error);
}

function delete_files($filenames,&$error)
{
    file_put_contents('log.txt', "delete_files $filenames \n", FILE_APPEND);
    $arr = explode(",",$filenames);
    foreach ($arr as $filename)
    {
        if($filename=="") continue;
        if(!delete_file($filename,$error))
        {
            return FALSE;
        }
    }
}

function get_mjpeg($app, $stream, $starttime, $endtime, $ver){
    file_put_contents('log.txt', "11111 \n", FILE_APPEND);
    $ret = check_login();
    file_put_contents('log.txt', "222 $ret\n", FILE_APPEND);
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    file_put_contents('log.txt', "333 \n", FILE_APPEND);
    $media_host = C('mserver_url');
    $_SESSION['mstoken'] = $ret;
    $url = 'http://'.$media_host.'mjpeg/'.$app.'/'.$stream.'.xml?starttime='.$starttime.'&token='.$ret;
    $node  = get_root_node($url,"videoshots");    
    file_put_contents('log.txt', "444 \n", FILE_APPEND);
    $file_array = array();
    $nodeList  =  $node->getElementsByTagName ("image");
    $sub_node= $nodeList->item(0);
    file_put_contents('log.txt', "555 \n", FILE_APPEND);
    $href = @$sub_node->getAttribute('href');
    $thumbnail = @$sub_node->getAttribute('thumbnail');
    file_put_contents('log.txt', "666 \n", FILE_APPEND);
    $fie_array['href'] = $href;
    $file_array['thumbnail'] = $thumbnail;
    return $file_array;
}

function get_connections($app, $stream){     
    file_put_contents('log.txt', "get_connections $app  $stream \n", FILE_APPEND);
    
    $ret = check_login();
    if($ret == false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    
    $_SESSION['mstoken'] = $ret;
    $media_host = C('mserver_url');
    
    $location = "http://".$media_host."/mserver/interface/stat/?app=get_clients&application=$app&stream=$stream&token=$ret";
    
    $node = get_root_node($location,"connections_statistic");
    
    file_put_contents('log.txt', "----------------- node:$node \n", FILE_APPEND);
    
    return $node;
}

function get_static_nodelist($node,$node_tag)
{
    $nodeList =  $node->getElementsByTagName($node_tag);
    if($nodeList->length<=0)
    {
        return FALSE;
    }
    $sub_node = $nodeList->item(0); //root
    $nodeList =  $sub_node->getElementsByTagName("stat_item");
    if($nodeList->length<=0)
    {
        return FALSE;
    }
    return $nodeList;
}

/*=========================user operator=============================*/
function create_user(&$arr,&$error)
{
    $media_host = C('mserver_url');
    $paras = "";
    foreach($arr as $key=>$value)
    {
        $paras = $paras . "$key=" . urlencode($value) . "&";
    }
    $paras = rtrim($paras,"&");
    $location = "http://".$media_host."/mserver/interface/aaa/?app=create_user&" . $paras;
    //echo $location;
    return simple_call2($location,$error);
}

function load_users()
{
    $media_host = C('mserver_url');
    $location = "http://".$media_host."/mserver/interface/aaa/?app=load_users";
    $node     = get_root_node($location,"users");
    if($node===FALSE)
    {
        return FALSE;
    }
    $nodeList =  $node->getElementsByTagName("user");
    if($nodeList->length<=0)
    {
        return FALSE;
    }
    else
    {
        return $nodeList;
    }
}

function load_user($username)
{
    $media_host = C('mserver_url');
    $location = "http://".$media_host."/mserver/interface/aaa/?app=load_user&username=$username";
    $node     = get_root_node($location,"users");
    if($node===FALSE)
    {
        return FALSE;
    }
    $nodeList =  $node->getElementsByTagName("user");
    if($nodeList->length<=0)
    {
        return FALSE;
    }
    else
    {
        return $nodeList;
    }
}

function has_admin_user()
{
    $media_host = C('mserver_url');
    $des = "";
    $url = "http://".$media_host."/mserver/interface/aaa/?app=has_admin_user";
    return simple_call2($url,$des);
}

function init_admin_user($pwd,&$des)
{
    $media_host = C('mserver_url');
    $url = "http://".$media_host."/mserver/interface/aaa/?app=create_admin_user&pwd=$pwd";
    return simple_call2($url,$des);
}

function is_admin_user()
{
    return $_SESSION["username"]=="admin"?TRUE:FALSE;
}

function change_pwd($oldpwd,$newpwd)
{
    $media_host = C('mserver_url');
    if(is_logined()==FALSE)
    {
        return FALSE;
    }
    $url = "http://".$media_host."/mserver/interface/aaa/?app=change_pwd&oldpwd=$oldpwd&newpwd=$newpwd";
    return simple_call($url);
}

function is_logined()
{
    if(isset( $_SESSION["isLogin"])==FALSE || $_SESSION["isLogin"] != "yes")
    {
        return FALSE;
    }
    if(isset($_SESSION["ua_time"])==FALSE || time() - $_SESSION["ua_time"]>=60*60)
    {
        return FALSE;
    }
    
    $_SESSION["ua_time"] = time();
    return TRUE;
}


require("./core/Common/interface_client.php");
?>
