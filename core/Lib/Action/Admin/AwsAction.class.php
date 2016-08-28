<?php
/**
 * @name    用户管理模块
 * @package GXCMS.Administrator
 * @link    www.gxcms.com
 */
// require the amazon sdk for php library
//require_once '';

class AwsAction extends AdminAction{
	 private $UserDB;	
     private $UserVDB;
	 private $GbookDB;
	 private $CommDB;
	 private $ChannelDB;
	 
	 private $sClient;
	 
	 public function _initialize(){
	 	parent::_initialize();
	 	
	 	$this->UserDB  =D('Admin.User');
		$this->UserVDB =D('Admin.Userview');
		$this->GbookDB =D('Admin.Gbook');
		$this->CommDB  =D('Admin.Comment');
		$this->ChannelDB =D('Admin.Channel');
    }
    
	// 用户管理
    public function show(){          
 //       $Connection->create_bucket('bucket-002');
        
/*
        $ListResponse = $this->sClient->list_buckets();
        file_put_contents('log.txt', "=======6666 \n", FILE_APPEND);
        $blist = $ListResponse->body->Buckets->Bucket;
        file_put_contents('log.txt', "=======7777 \n", FILE_APPEND);
        $this->assign('blist', $blist);
*/
        $this->display('./views/admin/aws_show.html');
    }
    
    public function addblucket(){
        
    }
    
    public function showobject(){
        $bucket = $_REQUEST['bucket'];
        
        file_put_contents('log.txt', "========== bucket:$bucket \n", FILE_APPEND);
        $this->assign('bucketname', $bucket);
        $this->display('./views/admin/aws_show_object.html');
    }
    
    public function upload(){
        $bucket = $_REQUEST['bucket'];
        $this->assign('bucketname', $bucket);
        $this->display('./views/admin/aws_object_upload.html');
    }
   
    public function ajaxuploading(){
        $bucket = $_REQUEST['bucket'];
        $filename = $_REQUEST['filename'];
        
        file_put_contents('log.txt', "==== vv $bucket;$filename \n", FILE_APPEND);
        $this->assign('bucketname', $bucket);
        $this->assign('filename', $filename);
        $this->assign('is_transcoded', 0);
        $this->assign('src_id', "");
        $this->assign('aws_format', "");
        $this->display('./views/admin/aws_uploading.html');
    }
    
   public function deleteobject(){
       $bucket = $_REQUEST['bucket'];
       $filename = $_REQUEST['filename'];
       
       file_put_contents('log.txt', "delete object $bucket/$filename \n", FILE_APPEND);
       $this->assign('bucketname', $bucket);
       $this->assign('filename', $filename);
       $this->assign('isdelete', 1);
       $this->display('./views/admin/aws_show_object.html');
   }
   
   public function transcode(){
       $bucket = $_REQUEST['bucket'];
       $filename = $_REQUEST['filename'];
       $aws_format = C('aws_format');
       
       file_put_contents('log.txt', "====== transcode $bucket;$filename \n", FILE_APPEND);
       $this->assign('aws_format', $aws_format);
       $this->assign('bucketname', $bucket);
       $this->assign('filename', $filename);
       $this->display('./views/admin/aws_transcode.html');
   }
   
   public function downloading(){
      $bucket = $_REQUEST['bucket'];
      $filename = $_REQUEST['filename'];
      
      file_put_contents('log.txt', "downloading $bucket;$filename \n", FILE_APPEND);
      $this->assign('bucketname', $bucket);
      $this->assign('filename', $filename);
      $this->display('./views/admin/aws_downloading.html');
   }
   
   public function uploading(){
       $bucket = $_REQUEST['bucket'];
       $filename = $_REQUEST['filename'];
       $src_id = $_REQUEST['src_id'];
       $is_transcoded = $_REQUEST['is_transcoded'];

       $this->assign('bucketname', $bucket);
       $this->assign('filename', $filename);
       $this->assign('is_transcoded', $is_transcoded);
       
       if($is_transcoded === '1'){
           file_put_contents('log.txt', "uploading...\n", FILE_APPEND);
           $aws_format = C('aws_format');
           $this->assign('src_id', $src_id);
           $this->assign('aws_format', $aws_format);
       }else{
           file_put_contents('log.txt', "uploading...333\n", FILE_APPEND);
           $this->assign('src_id', "");
           $this->assign('aws_format', "");           
       }
       
       $this->display('./views/admin/aws_uploading.html');
   }
   
   public function transcode_config(){
       $filename = $_REQUEST['filename'];
       
       file_put_contents('log.txt', "transcode_config: $filename \n", FILE_APPEND);
       $this->assign('filename', $filename);
       $this->display('./views/admin/aws_transcode_config.html');
   }
   
   public function transcode_do(){
       $filename = $_REQUEST['filename'];
       $src_id = $_REQUEST['src_id'];
        
       file_put_contents('log.txt', "transcode_do src_id:$src_id \n", FILE_APPEND);
       $ret = check_login();
       file_put_contents('log.txt', "upload streams 111......\n", FILE_APPEND);
       if($ret == false){
           file_put_contents('log.txt', "upload streams 222......\n", FILE_APPEND);
           header("Location: ../auth/right_error.html?error=notauthorized");
       }else{
           $_SESSION['mstoken'] = $ret;
       }
       $webpath = C('web_path');
       $media_host = C('mserver_url');
   
       $video_bitrate = C('aws_video_bitrate');
       $width = C('aws_video_width');
       $height = C('aws_video_height');
   
       $_SESSION['transcode'] = 0;
       $callback = "&callback=http://".$media_host.$webpath."views/admin/transcodeback.php";
       $querystr = "application=vod&src=$filename&src_id=$src_id&video_bitrate=$video_bitrate&&width=$width&height=$height&token=$ret";
       $url      = "http://".$media_host."/mserver/interface/transcode/?app=transcode&".$querystr.$callback;
   
       $ret = transcode($url);
   }
   
   public function get_download_percent(){
       file_put_contents('log.txt', "=====bvbv \n", FILE_APPEND);
       $d = $_SESSION['downloadpercent'];
       file_put_contents('log.txt', "get_download_percent[$d] \n", FILE_APPEND);
        $data = $d;
        $this->ajaxReturn($data,'');
   }
   
   public function get_transcode_percent(){
       $src_id = $_REQUEST['src_id'];
       
       file_put_contents('log.txt', "get_transcode_percent src_id:$src_id \n", FILE_APPEND);

       
       $tran = $_SESSION['transcode'];
       
       if($tran == 1){
           $data['progress'] = "100%";
           $data['duration'] = "";
           $data['status'] = 1;
       }else{
           $t = $_SESSION['mstoken'];
           $arr = array();
            
           $arr = transcode_query_status($src_id, "working", $t);
           $count = count($arr);
           
           file_put_contents('log.txt', "fff count:$count \n", FILE_APPEND);
           if($count < 2){
                $data['status'] = 0;
           }else{
               $data['progress'] = $arr['encode_progress'];
               $data['duration'] = $arr['work_duration'];
               $data['status'] = 1;
               
               $pre = $data['progress'];
               file_put_contents('log.txt', "get_transcode_percent $pre\n", FILE_APPEND);
           }
       }

       $this->ajaxReturn($data);
   }
   
   public function get_upload_percent(){
       $d = $_SESSION['uploadpercent'];
       $t = $_SESSION['filetype'];
       file_put_contents('log.txt', "get_upload_percent[$d] \n", FILE_APPEND);
       $data['percent'] = $d;
       $data['type'] = $t;
       $this->ajaxReturn($data,'');
   }
   
   public function play(){
       $bucket = $_REQUEST['bucket'];
       $filename = $_REQUEST['filename'];
       
       file_put_contents('log.txt', "=== file:$filename;bucket:$bucket \n", FILE_APPEND);
       $f = explode(".", $filename);
       $fe = $f[1];
       file_put_contents('log.txt', "== format:$fe \n", FILE_APPEND);
       if($fe != "mp4"){
           $this->error("桶内只能播放mp4格式的文件");
       }else{
           $app = $bucket;
           $stream = $filename;
           
           $this->assign('app', $app);
           $this->assign('stream', $stream);
           $this->assign('format', $fe);
           
           $this->display('./views/admin/aws_play.html');
       }
   }
   
    public function set_config(){
       $flash = $_POST['flash'];
       $hls = $_POST['hls'];
       $mp4 = $_POST['mp4'];
       $jpeg_big = $_POST['jpeg-big'];
       $jpeg_lit = $_POST['jpeg-lit'];
       $video_bitrate = $_POST['video_bitrate'];
       $video_rate = $_POST['video_rate'];
       $video_width = $_POST['video_width'];
       $video_height = $_POST['video_height'];
       $bucket = $_POST['bucketname'];
       $filename = $_POST['filename'];
       
       $arr = array();
       
       $arr['flash'] = $flash;
       $arr['hls'] = $flash;
       $arr['mp4'] = $mp4;
       $arr['jpeg-big'] = $jpeg_big;
       $arr['jpeg-lit'] = $jpeg_lit;
       $arr['video_bitrate'] = $video_bitrate;
       $arr['video_rate'] = $video_rate;
       $arr['video_width'] = $video_width;
       $arr['video_height'] = $video_height;
       
       $file = "config/tserver.config";
       
       $bucket = $_REQUEST['bucket'];
       $filename = $_REQUEST['filename'];
        
       file_put_contents('log.txt', "====== set_config $bucket;$filename \n", FILE_APPEND);
       
       if(file_put_contents($file, $arr)){
          $this->error("写入配置出错");
       }else{
          $this->assign('bucketname', $bucket);
            $this->assign('filename', $filename);
            $this->display('./views/admin/aws_transcode.html');
       }
           
       /*
       $str = file_get_contents($file);
       file_put_contents('log.txt', "set_config:$str \n", FILE_APPEND);
       */
   }
   
	// 用户添加与编辑表单
    public function add(){
		$user_id = $_GET['id'];
		if ($user_id>0) {
            $where['id'] = $user_id;
			$array = $this->UserDB->where($where)->find();
			$array['tpltitle'] = '编辑';
		}else{
			$array['id']      =0;
			$array['money']   =0;
			$array['duetime'] = time();
			$array['level'] = 1;
			$array['tpltitle']= '添加';
		}

		$tree = M('level')->findAll();

		$this->assign('levels', $tree);
		$this->assign($array);
        $this->display('./views/admin/user_add.html');
    }
	// 用户添加入库
	public function insert() {
	    $_POST['level'] = $_POST['userlevel'];
		if($this->UserDB->create()) {
			if($this->UserDB->add()) {
				$this->assign("jumpUrl",C('cms_admin').'?s=Admin/User/Show');
    			$this->success('添加用户成功！');
            }else{
                $this->error('添加用户失败!');
            }
		}else{
			$this->error($this->UserDB->getError());
		}
	}
	public function _before_update(){
	    $_POST['level'] = $_POST['userlevel'];
		$where['username'] = trim($_POST['username']);
		$where['email']    = trim($_POST['email']);
		$where['_logic']   = 'or';
		$list = $this->UserDB->field('id,username,email')->where($where)->find();
		if(!empty($list)){
			if(intval($_POST['id']) != $list['id']){
				$this->error('用户名或邮箱已经存在,请重新填写!');
			}
		}
	}	
	// 更新用户
	public function update(){
		if ($this->UserDB->create()) {
			if (false !== $this->UserDB->save()) {
			    $this->assign("jumpUrl",C('cms_admin').'?s=Admin/User/Show');
				$this->success('更新用户信息成功！');
			}else{
				$this->error("更新用户信息失败!");
			}
		}else{
			$this->error($this->UserDB->getError());
		}
	}
	// 删除用户
	public function del(){
		if ($_GET['id'] == 1){
			$this->error("系统默认用户,不能删除!");
		}
		$this->deluser(intval($_GET['id']));
		redirect($_SERVER['HTTP_REFERER']);
	}
	// 删除用户All
    public function delall(){
		if(empty($_POST['ids'])){
			$this->error('请选择需要删除的用户!');
		}
		$array = $_POST['ids'];
		foreach($array as $val){
			$this->deluser(intval($val));
		}
		redirect($_SERVER['HTTP_REFERER']);
    }
	// 删除用户资料等信息
    public function deluser($id){
		//用户中心
		$where['id'] = $id;
		$this->UserDB->where($where)->delete();
		//付费观看记录	
		$this->UserVDB->where(array('uid',$where['id']))->delete();
		unset($where);
		//留言
		$where['uid'] = $id;
		$this->GbookDB->where($where)->delete();
		unset($where);
		//评论
		$where['uid'] = $id;
		$this->CommDB->where($where)->delete();
    }	
	// 删除未登录用户
	public function delnum(){
		$where['lognum'] = array('lt',2);
		$where['id']     = array('gt',1);
		$this->UserDB->where($where)->delete();
		$this->success('不活跃用户删除成功！');
	}
	// 隐藏与显示用户
    public function status(){
		$where['id'] = $_GET['id'];
		if(intval($_GET['sid'])){
			$this->UserDB->where($where)->setField('status',1);
		}else{
			$this->UserDB->where($where)->setField('status',0);
		}
		redirect($_SERVER['HTTP_REFERER']);
    }										
}
?>