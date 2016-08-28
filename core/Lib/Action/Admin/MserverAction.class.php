<?php
class MserverAction extends AdminAction{
    private $appDB;
    private $StreamsDB;
    
    public function _initialize(){
        parent::_initialize();
        $this->appDB = D('Admin.application');
        $this->StreamsDB = D('Admin.Streams');
    }
    
    public function show(){       
        file_put_contents('log.txt', "Mserver show.......\n", FILE_APPEND);
        $sflag = $_REQUEST['sflag'];
        $sub_path = $_REQUEST['sub_path'];
        $delf = $_REQUEST['delf'];
        $media_host = C('mserver_url');
        
        file_put_contents('log.txt', "sflag:$sflag \n", FILE_APPEND);
        $sub_path  = @$_REQUEST['sub_path'];
        $del_file  = @$_REQUEST['delf'];
        $error     = "";
        
        if(strlen($del_file)>0)
        {
            delete_files($del_file,$error);
        }
        
        file_put_contents('log.txt', "source show sub_path:$sub_path; delf:$delf \n", FILE_APPEND);
        
        $ss = M('sources');
        file_put_contents('log.txt', "ss:$ss.......\n", FILE_APPEND);
        $source = $ss->select();
        $name = $source[0]['name'];
        file_put_contents('log.txt', "sources:$name.......\n", FILE_APPEND);
               
        $ret = check_login();
        file_put_contents('log.txt', "upload streams 111......\n", FILE_APPEND);
        if($ret == false){
            file_put_contents('log.txt', "upload streams 222......\n", FILE_APPEND);
            header("Location: ../auth/right_error.html?error=notauthorized");
        }else{
            $_SESSION['mstoken'] = $ret;
        }
        
   //     $done_stream_array = get_duty_array("done", $ret);
        $stream_array = get_duty_array("working", $ret);
        $working_stream_array = get_duty_array("waiting", $ret);
        
        
        $length = count($stream_array);
        for($i = 0; $i < count($working_stream_array); $i++){
            $stream_array[$i + $length] = $working_stream_array[$i];
        }
        
    //    change_local_stream_status($done_stream_array, 2);   //get
        $dir = "\/";
        $url = "http://".$media_host."/mserver/interface/transcode/?app=files&dir=$dir&token=$ret";
        $source = qurey_files($url);

        $len = count($stream_array);
        file_put_contents('log.txt', "wait:$len\n", FILE_APPEND);
        
        $this->assign('sub_path', $sub_path);
        $this->assign('delf', $delf);
        
        $this->assign('sources', $source);
        $this->assign('stream_array', $stream_array);
        $this->assign('sflag', $sflag);
        file_put_contents('log.txt', "=================to video_show  $sflag.......\n", FILE_APPEND);
        $this->display('./views/admin/mserver_mrg.html');
    }
    
    public function add(){
        file_put_contents('log.txt', "upload add.......\n", FILE_APPEND);
        $user_name = "admin";
        $media_host = C('mserver_url');
        $media_pwd = "111111";
    
        $time = time();
        $sub_path = "";

        $ret = check_login();
        file_put_contents('log.txt', "upload streams 111......\n", FILE_APPEND);
        if($ret == false){
            file_put_contents('log.txt', "upload streams 222......\n", FILE_APPEND);
            header("Location: ../auth/right_error.html?error=notauthorized");
        }else{
            $_SESSION['mstoken'] = $ret;
        }
    
        file_put_contents('log.txt', "upload add subpath:$sub_path;token:$ret\n", FILE_APPEND);
        $this->assign('time', $time);
        $this->assign('sub_path', $sub_path);
        $this->assign('token', $ret);
        $this->assign('host', $media_host);
        //$this->display('./views/admin/mserver_upload.html');
        $this->display('./views/upload/upload.html');
    }
    
    public function Appsynchronize(){
        $apps = get_application();
        if($apps!==FALSE)
        {
            $count = count($apps);
            foreach($apps as $appname=>$app_array)
            {
                file_put_contents('log.txt', "Appsynchronize[$appname].......\n", FILE_APPEND);
                $where['name'] = $appname;
                $array = $this->appDB->where('name=$where[name]')->find();
                
                $id = $array['id'];
                file_put_contents('log.txt', "Appsynchronize[id:$id].......\n", FILE_APPEND);
                foreach($app_array as $para_value)
                {
                    file_put_contents('log.txt', "Appsynchronize add[@$para_value[0]:@$para_value[1]].......\n", FILE_APPEND);
                    $data[@$para_value[0]] = @$para_value[1];
                }
                
                C('TOKEN_ON',false);//关闭令牌验证
                if($this->appDB->create()){
                    if (empty($array)){ 
                        file_put_contents('log.txt', "aaaaaaa\n", FILE_APPEND);
                        $this->appDB->data($data)->add();
                    }else{
                        file_put_contents('log.txt', "bbbbbbbbbbbbb\n", FILE_APPEND);
                        $this->appDB->data($data)->save();
                    }
                }else{
                    file_put_contents('log.txt', "22222222222\n", FILE_APPEND);
                    $err = $this->appDB->getError();
                    file_put_contents('log.txt', "ssss:$err.......\n", FILE_APPEND);
                    
                }
            }
            
        }
        
        $this->success('与流媒体服务器同步视频成功！');
        
    }
    
    public function Upload(){
        
    }
    
    public function Streaming(){
        $streams = get_streaming();
        $count = count($streams);
        $this->assign('streams', $streams);
        $this->display('./views/admin/mserver_streaming.html');
    }
    
    public function AddStreaming(){
        file_put_contents('log.txt', "======= addStreaming... \n", FILE_APPEND);
        $arr['id'] = "0";
        $this->assign($arr);
        $this->display('./views/admin/mserver_addstreaming.html');
    }
    
    public function DoOperate(){
        $operater = $_GET['Operater'];
        $id = $_GET['Id'];
        
        file_put_contents('log.txt', "DoOperate:$operater:$id \n", FILE_APPEND);
        if($operater == "stop"){
            stop_streaming($id);
        }else if($operater == "start"){
            start_streaming($id);
        }else if($operater == "edit"){
            file_put_contents('log.txt', "==== id:$id \n", FILE_APPEND);
            $streams = get_streaming($id);
            $this->assign($streams);
            
            $stream_info = $streams[0];
            $arr['name'] = $stream_info['name'];
            $arr['protocol'] = $stream_info['protocol'];
            $arr['source_url'] = $stream_info['source_url'];
            $arr['audio_only'] = $stream_info['audio_only'];
            $arr['use_transcode'] = $stream_info['use_transcode'];
            $arr['width'] = $stream_info['width'];
            $arr['height'] = $stream_info['height'];
            $arr['bitrate'] = $stream_info['bitrate'];
            $arr['use_audio_transcode'] = $stream_info['use_audio_transcode'];
            $arr['bitrate_audio'] = $stream_info['bitrate_audio'];
            $arr['to_host'] = $stream_info['to_host'];
            $arr['to_server'] = $stream_info['to_server'];
            $arr['application'] = $stream_info['application'];
            $arr['stream'] = $stream_info['stream'];
            $arr['id'] = $stream_info['id'];
            
            $use_transcode = $arr['use_transcode'];
            $width = $arr['width'];
            $height = $arr['height'];
            file_put_contents('log.txt', "=== use_transcode:$use_transcode; $width X $height \n", FILE_APPEND);
            
            $this->assign($arr);
            $this->display('./views/admin/mserver_addstreaming.html');
            return;
        }else if($operater == "delete"){
            del_streaming($id);
        }else if($operater == "detail"){
            
        }
        
        $streams = get_streaming();
        $count = count($streams);
        $this->assign('streams', $streams);
        $this->display('./views/admin/mserver_streaming.html');
    }
    
    public function AddStreamingDoing(){
        file_put_contents('log.txt', "==== AddStreamingDoing \n", FILE_APPEND);
        $id = $_POST['id'];
        if($id == '0'){
            $arr['id'] = randomkeys(10);
        }else{
            $arr['id'] = $id;
        }
        $arr['name'] = $_POST['name'];
        $arr['protocol'] = $_POST['protocol'];
        $arr['source_url'] = $_POST['source_url'];
        
        $audio_only = $_POST['audio_only'];
        if($audio_only == 1){
            $arr['audio_only'] = "on";
        }else{  
            $use_transcode = $_POST['use_transcode'];
            if($use_transcode == 1){
                $arr['use_transcode'] = "on";
                $arr['width'] = $_POST['width'];
                $arr['height'] = $_POST['height'];
                $arr['bitrate'] = $_POST['bitrate'];                
            }
        }
        
        $use_audio_transcode = $_POST['use_audio_transcode'];
        if($use_audio_transcode == 1){
            $arr['use_audio_transcode'] = "on";
            $arr['bitrate_audio'] = $_POST['bitrate_audio'];
        }
       
        $to_host = $_POST['to_host'];
        $arr['to_host'] = $to_host;
        if($to_host == "remote"){
            $arr['to_server'] = $_POST['to_server'];
        }
        
        $arr['application'] = $_POST['application'];
        $arr['stream'] = $_POST['stream'];
        
        $ret = add_streaming($arr);
        $streams = get_streaming();
        $this->assign('streams', $streams);
        $this->display('./views/admin/mserver_streaming.html');
    }
    
    public function Transcode(){
        $media_host = C('mserver_url');
        $filename = $_REQUEST['filename'];
        
        $c = M('channel');
        $condition['pid']=0;
        $condition['ctype'] = "vod";
        $list_channel_video = $c->where($condition)->select();
        
        $t = M('transcode_info');
        $list_transcode_info = $t->select();
        
        $id =  $list_channel_video[0]['id'];
        $this->assign('list_channel_video',$list_channel_video);
        $this->assign('list_transcode_info', $list_transcode_info);
        $this->assign('filename', $filename);
        $this->assign("cid", $id);
        $this->display('./views/admin/mserver_transcode.html');
    }
    
    public function Transcoding(){
        file_put_contents('log.txt', "fff Transcoding..........\n", FILE_APPEND);
        $media_host = C('mserver_url');
        $src = $_POST['filename'];
        
        $srcname = iconv("utf-8", "gb2312", $src);
        $pysrc = CUtf8_PY::encode($src);
        
        file_put_contents('log.txt', "============== pingyin[$pysrc] \n", FILE_APPEND);
        $src_id = substr($pysrc, 0, strpos($pysrc, "."));
        
        /*
        if(!eregi("[^\x80-\xff]","$src_id"))
        {
             $src_id = randomkeys(16);
        }
        else
        {
            $s = substr($pysrc, 0, strpos($pysrc, "."));
            file_put_contents('log.txt', "1s:$s \n", FILE_APPEND);
            $src_id = preg_replace("/[^A-z0-9]/","", $s).randomkeys(6);
            file_put_contents('log.txt', "2s:$src_id \n", FILE_APPEND);
             
        }
        */
        $src_id = randomkeys(16);
        
        $channel_mcid = $_POST['channel_mcid'];
        $tid = $_POST['tid'];

        $c = M('channel');
        $where['id'] = $channel_mcid;
        $channel = $c->where($where)->find();
        $len = count($channel);
        file_put_contents('log.txt', "fff len:$len \n", FILE_APPEND);
        $app_info = $channel['cfile'];
        
        $t = M('transcode_info');
        $where['id'] = $tid;
        $transcode_info = $t->where($where)->find();
        $video_bitrate = $transcode_info['video_bitrate'];
        $audio_bitrate = $transcode_info['audio_bitrate'];
        $width = $transcode_info['width'];
        $height = $transcode_info['height'];
        
        $ret = check_login();
        file_put_contents('log.txt', "upload streams 111......\n", FILE_APPEND);
        if($ret == false){
            file_put_contents('log.txt', "upload streams 222......\n", FILE_APPEND);
            header("Location: ../auth/right_error.html?error=notauthorized");
        }else{
            $_SESSION['mstoken'] = $ret;
        }
        
        $webpath = C('web_path');
       // $callback = "&callback=http://".$media_host.$webpath."?s=Admin/Mserver/Transcodecallback";
        $callback = "&callback=http://".$media_host."{$webpath}?s=Admin/Mserver/Transcodcallback/";
        $querystr = "application=$app_info&src=$srcname&src_id=$src_id&video_bitrate=$video_bitrate&audio_bitrate=$audio_bitrate&width=$width&height=$height&token=$ret";
        $url      = "http://".$media_host."/mserver/interface/transcode/?app=transcode&".$querystr.$callback;
        
        file_put_contents('log.txt', "Transcoding $url \n", FILE_APPEND);
        
        $ret = transcode($url);
        if($ret !== true){
            file_put_contents('log.txt', "ret:$ret \n", FILE_APPEND);
        }

        $ret = check_login();
        file_put_contents('log.txt', "upload streams 111......\n", FILE_APPEND);
        if($ret == false){
            file_put_contents('log.txt', "upload streams 222......\n", FILE_APPEND);
            header("Location: ../auth/right_error.html?error=notauthorized");
        }else{
            $_SESSION['mstoken'] = $ret;
        }
        
        $stream_array = get_duty_array("working", $ret);
        $working_stream_array = get_duty_array("waiting", $ret);
    //    $done_stream_array = get_duty_array("done", $ret);
        
        $length = count($stream_array);
        for($i = 0; $i < count($working_stream_array); $i++){
            $stream_array[$i + $length] = $working_stream_array[$i];
        }
        
    //    change_local_stream_status($done_stream_array, 2);   //get 
        
        $dir = "\/";
        $url = "http://".$media_host."/mserver/interface/transcode/?app=files&dir=$dir&token=$ret";
        $source = qurey_files($url);
        
        $len = count($stream_array);
        file_put_contents('log.txt', "wait:$len\n", FILE_APPEND);
        
 //       $this->assign('sub_path', $sub_path);
 //       $this->assign('delf', $delf);
        $data['name'] = $src;
        $data['cfile'] = $src_id;
        $data['channel'] = $app_info;
        $data['active_time'] = "";
        $data['play'] = "";
        $data['status'] = 0;
        
        $this->StreamsDB->data($data)->add();
        
        $this->assign('sources', $source);
        $this->assign('stream_array', $stream_array);
        $this->assign('sflag', 1);
        $this->display("./views/admin/mserver_mrg.html");
    }
    
    public function Transcodcallback(){
        $src_id = $_GET['src_id'];
        $result = $_GET['result'];
        
        if($result == "ok"){
            
        }
        
        $this->display("./views/admin/mserver.mrg.html");
    }
    
    public function Activestreams(){
        
        $this->display("./views/admin/mserver_streams_active.html");
    }
    
    public function Connections(){
        file_put_contents("log.txt", "vvvvvvvvvvvvvvvvv \n", FILE_APPEND);
        /*
        $application = $_POST['application'];
        $stream = $_POST['stream'];
        
        $node = get_connections($application, $stream);
        if($node===FALSE)
        {
            $nodeList  = FALSE;
        }
        else
        {
            $nodeList =  $node->getElementsByTagName("application");
            $count    =  $node->getAttribute('count');
        }
     //   $this->assign("nodeList", $nodeList);
       // $this->display("./views/admin/mserver_mrg.html");
        * 
        */
        
        file_put_contents('log.txt', "rrrrrrrrrrrrrrrrrr \n", FILE_APPEND);
        $this->display("./views/admin/mserver_connections.html");
      //  $this->display("./views/admin/mserver_streams_active.html");
    }
}
?>
