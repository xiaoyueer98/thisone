<?php
/**
 * @name   视频模块
 * @package GXCMS.Administrator
 */
class VideoAction extends AdminAction{
     private $VideoDB;	
     private $UserVDB;
	 private $CommDB;
	 private $UserDB;
	 private $UserauthDB;
	 private $UsertempauthDB;
	 private $VideoplaywhiteDB;
	 private $VideopushwhiteDB;

	 public function _initialize(){
	 	parent::_initialize();
	 	$this->VideoDB =D('Admin.Video');
		$this->UserVDB =D('Admin.Userview');
		$this->CommDB  =D('Admin.Comment');
		$this->UserDB = D('Admin.User');
		$this->UserauthDB = D('Admin.Userauth');
		$this->UsertempauthDB = D('Admin.Usertempauth');
		$this->VideoplaywhiteDB =D('Admin.Video_play_white_list');
		$this->VideopushwhiteDB =D('Admin.Video_push_white_list');
    }
	// 视频列表		
    public function show(){
    	//get params
		$where  = array();
		$cid    = $_REQUEST['cid'];
		$starget  = $_REQUEST['starget'];
		$player  = $_REQUEST['player'];
		
		$status = $_REQUEST['status'];
		$serial = $_REQUEST['serial'];
		$picurl = $_REQUEST['picurl'];
		
		$keyword= urldecode(trim($_REQUEST['keyword']));
		//search condition
		if ($cid) {
			if(get_channel_son($cid)){
				$where['cid']= $cid;
			}else{
				$where['cid']= get_channel_sqlin($cid);
			}
		}
		
		if ($starget) {
		    file_put_contents('log.txt', "startget \n", FILE_APPEND);
			$where['stars']= $starget;
		}
		if ($player) {
		    file_put_contents('log.txt', "player \n", FILE_APPEND);
			$where['vodplay']= $player;
		}

		if ($status || $status==='0') {
		    file_put_contents('log.txt', "status \n", FILE_APPEND);
			$where['status'] = array('eq',intval($status));
		}
		if ($serial) {
		    file_put_contents('log.txt', "serial \n", FILE_APPEND);
			$where['serial'] = array('neq',0);
		}
		if ($picurl) {
		    file_put_contents('log.txt', "picurl \n", FILE_APPEND);
			$where['Left(picurl,7)'] = array('eq','fail://');
		}		
		if ($keyword) {
			$search['title']   = array('like','%'.$keyword.'%');
			$search['intro']   = array('like','%'.$keyword.'%');
			$search['actor']   = array('like','%'.$keyword.'%');
			$search['director']= array('like','%'.$keyword.'%');
			$search['_logic']  = 'or';
			$where['_complex'] = $search;
		}
		
		
		$starlist = array(5=>'五星',4=>'四星',3=>'三星',2=>'二星',1=>'一星');
		
		
		//
		$video['type']  = !empty($_GET['type'])?$_GET['type']:C('web_admin_ordertype');
		$video['order'] = !empty($_GET['order'])?$_GET['order']:'asc';
		$order          = $video["type"].' '.$video['order'];
		//
		$video_count = $this->VideoDB->where($where)->count('id');



		//$where['ctype']=live;
		//$list_live=$this->VideoDB->where($where)->select();


		$video_page  = !empty($_GET['p'])?intval($_GET['p']):1;
		$t1 = C('web_admin_pagenum');
		$t2 = $video_count;
		
		file_put_contents('log.txt', "111 video_page:$t2;$t1, $video_page \n", FILE_APPEND);
		$video_page  = get_cms_page_max($video_count,C('web_admin_pagenum'),$video_page);
		file_put_contents('log.txt', "222 video_page:$video_page \n", FILE_APPEND);
		$video_url   = U('Admin-Video/Show',array('cid'=>$cid,'status'=>$status,'serial'=>$serial,'picurl'=>$picurl,'type'=>$video['type'],'order'=>$video['order'],'keyword'=>urlencode($keyword),'p'=>''),false,false);
		$listpages   = get_cms_page($video_count,C('web_admin_pagenum'),$video_page,$video_url,'部视频');
		$_SESSION['video_reurl'] = $video_url.$video_page;
		//
		//$list = $this->VideoDB->where($where)->order($order)->limit(C('web_admin_pagenum'))->page($video_page)->select();

		$list = $this->VideoDB->where($where)->order($order)->limit(C('web_admin_pagenum'))->page($video_page)->select();
		file_put_contents('log.txt', "count:$video_count \n", FILE_APPEND);

		if (empty($list)) {
		    file_put_contents('log.txt', "22222222222\n", FILE_APPEND);
			if($status || $serial || $cid || $keyword){
				$this->assign("jumpUrl",C('cms_admin').'?s=Admin/Video/Show');
				$this->error('没有查询到您所筛选的视频信息,请重新选择条件!');
			}
			/*
			else{
				$this->assign("jumpUrl",C('cms_admin').'?s=Admin/Video/Add');
				if(empty($picurl))
				$this->error('还没有任何视频,请先添加一部视频!');
			}
			*/
		}

		foreach($list as $key=>$val){
			$list[$key]['cname']		=	get_channel_name($list[$key]['cid']);
			$list[$key]['channelurl']	=	U('Admin-Video/Show',array('cid'=>$list[$key]['cid']),false,false);
			$list[$key]['videourl']		=	get_read_url('video',$list[$key]['id'],$list[$key]['cid']);
			$list[$key]['stararr']		=	get_star_arr($list[$key]['stars']);
			$list[$key]['stype']		=	$this->get_stype_mcid(($list[$key]['stype_mcid']));
			$list[$key]['pp']			=	$this->get_play_list(($list[$key]['vodplay']));
			
			
		}
		//dump($this->VideoDB->getLastSql());
		$this->assign($listpages);
		$this->assign('order',$order);
		$this->assign('cid',$cid);
		$this->assign('starlist',$starlist);
		$this->assign('starget',$starget);
		$this->assign('player',$player);
		$this->assign('cplaylist',C('player_list'));
		$this->assign('keyword',$keyword);
		
		$this->assign('list_channel_video',F('_gxcms/channelvideo'));
		$this->assign('list_video',$list);
		$this->display('views/admin/video_show.html');
    }
	
    /*
     * 打开用户授权界面，设置哪些用户可以观看或推流这个流
     */
    public function Userauth(){
        $type = $_REQUEST['tyep'];   //权限类型，0， 推流权限；1.观看权限
        $stream = $_REQUEST['stream'];  //流名称

		$selectedList = $_REQUEST['selected'];
        
        $keyword = trim($_REQUEST['keyword']);
        if ($keyword) {
            $where['username']     = array('like','%'.$keyword.'%');
            $where['binary email'] = array('like','%'.$keyword.'%');
            $where['_logic']       = 'or';
        }

        $authwhere['cid'] = $stream;
        $authtemplist = $this->UsertempauthDB->where($authwhere)->select();
        if(count(authtemplist) > 0){
            $where['sid'] = array("neq", $authtemplist['id']);
        }
        $where['_logic'] = 'or';
        
        
        $user_count = $this->UserDB->where($where)->count('id');
        $user_page  = !empty($_GET['p'])?$_GET['p']:1;
        $user_url   = U('Admin-User/Show',array('keyword'=>urlencode($keyword),'p'=>''),false,false);
        $listpages  = get_cms_page($user_count,C('web_admin_pagenum'),$user_page,$user_url,'位用户');
        //

        $list = $this->UserDB->where($where)->order('jointime desc')->limit(C('web_admin_pagenum'))->page($user_page)->select();
        if (empty($list)) {
            $this->error('没有查询到您所筛选的用户!');
        }
        
        $authwhere['cid'] = $stream;
        $authtemplist = $this->UsertempauthDB->where($authwhere)->select();
        
        $this->assign('keyword',$keyword);
        $this->assign($listpages);
        $this->assign('list_user',$list);
        $this->assign('list_auth_user', $authtemplist);
        $this->assign('srtream', $stream);
        $this->assign('type', $type);
        $this->display('./views/admin/user_streams_auth.html');        
        
    }
    
    /*
     * 添加视频  打开添加视频界面, 从流媒体服务器获取流
     */

  public  function Addvideo(){
        $cid    = $_GET['cid'];
        $pageno = 1;
      //  $title = $_REQUEST['title'];

        $where = array();
        
        $c = M('channel');
        $condition['id']=$cid;
        $list_channel_video = $c->where($condition)->find();
        $len = count($list_channel_video);
        file_put_contents('log.txt', "add_vide len:$len.......\n", FILE_APPEND);
        $cfile = $list_channel_video['cfile'];
        
        $nodeList = get_streams($cfile, $count, $pageno);
        
        $length = $nodeList->length;
        $pagecount = ceil(floatval($count)/100.0);
        
        $stream_array = array();
        for ($i = 0; $i < $nodeList->length; $i++){
            $sub_node = $nodeList->item($i);
            $para_array  = array();
            
            $stream   = $sub_node->getAttribute('stream');
            $active   = $sub_node->getAttribute('active');
            $mtime    = $sub_node->getAttribute('modifytime');
            $type     = $sub_node->getAttribute('type');
            $duration = $sub_node->getAttribute('duration');
            $seq      = $sub_node->getAttribute('seq');
            $formats  = $sub_node->getAttribute('formats');
            
            $playurl =  '|||'.$cfile.'|'.$stream.'|flv|vod|';
            
            $tag      = get_stream_tag($cid,$stream,-1);
            $tag_url  = "stream_set_tag.php?application=$cid&stream=$stream&ver=-1";
            $para_array['stream'] = $stream;
            $para_array['active'] = $active;
            $para_array['mtime'] = get_time_readable($mtime);
            $para_array['type'] = $type;
 
            $durtext = get_duration_readable($duration);
            $para_array['durtext'] = $durtext;
            $para_array['seq'] = $seq;
            $para_array['formats'] = $formats;
            $para_array['playurl'] = $playurl;
            
            $s = M('Streams');
            $where['cfile'] = $stream;
            $str = $s->where($where)->find();
            if(count($str) > 0){
                $para_array['name'] = $str['name'];
            }else{
                $para_array['name'] = $stream;
            }
            
            $n = $para_array['name'];
            file_put_contents('log.txt', "======name:$n \n", FILE_APPEND);
            $stream_array[$i] = $para_array;
        }
        
        $count = count($stream_array);
        file_put_contents('log.txt', "====== count:$count; \n", FILE_APPEND);
        
//        $this->assign($array);
        $this->assign('stream_array', $stream_array);
        $this->assign("format", "flv");
        $this->assign("cid", $cfile);
        $this->assign("pageno", 1);
        $this->assign("force_update", "no");
        
        $this->assign('list_channel_video',$list_channel_video);
       // $this->display('views/admin/mserver_streams.html');
        $this->display('views/admin/checkbox.html');
    }

/**
 * 从流媒体服务器添加视频
 */
public function Addvideo_do(){
    $array['playurl'] = $_POST['playurl'];
    $array['addtime']  = $_POST['addtime'];
    $array['inputer']  = $_POST['inputer'];
    
    
    $array['checktime']= 'checked';
    $array['tpltitle'] = '添加';    
    $array['list_language']= explode(',',C('web_admin_language'));
    $array['list_area']    = explode(',',C('web_admin_area'));
    
    foreach( $array['playurl'] as $val){
        file_put_contents('log.txt', "url:$val.......\n", FILE_APPEND);
    }
    
    if($_GET['cid']){
        $array['cid'] = intval($_GET['cid']);
    }else{
        $array['cid'] = cookie('video_cid');
    }
    
    $this->assign($array);
    $this->assign('playserver',C('player_list'));
    $this->assign('list_channel_video',F('_gxcms/channelvideo'));    
    $this->display('views/admin/video_vod_add.html');
}
    /*
     * 视频转码
     */
/*
    function Transcoding(){
        $user_name = "admin";
        $media_host = "192.168.10.187";
        $media_pwd = "fangxun";
        $token = get_media_token($media_host, $user_name, $media_pwd);
        
        $this->display('views/admin/application_show.html');
    }
*/
    
	private function get_play_list($vodplay)
	{
		$array = array();
		if ($vodplay)
		{
			$vodplay_arr = explode('$$$$$$',$vodplay);
			foreach($vodplay_arr as $v)
			{
				$arr	=	array();
				$arr['cname']	=	'';
				$arr['ename']	=	$v;
				$array[] = $arr;
			}
		}
		return $array;
	}
	
	private function get_stype_mcid($stype_mcid)
	{
		if ($stype_mcid)
		{
			$m = M('stype');
			$stype_mcid_arr = explode(',',$stype_mcid);
			foreach($stype_mcid_arr as $v)
			{
				$where = array();
				$where['m_cid']= $v;
				$rs = $m->where($where)->limit(1)->select();
				if ($rs) $rs = $rs[0];
				$array[] = $rs;
			}
		}
		return $array;
	}
	
	// 添加视频与编辑视频		
    public function add(){
        $type = $_REQUEST['type'];
        file_put_contents('log.txt', "type:$type \n", FILE_APPEND);
        $where['id'] = $_GET['id'];

        if($type === "vod"){
            file_put_contents('log.txt', "add vod video#####...\n", FILE_APPEND);
            
            $con['pid'] = '0';
            $con['ctype'] = "vod";
            $list_channel_video = M('Channel')->where($con)->select();
            
    		if ($where['id']) {
    			$array = $this->VideoDB->where($where)->find();
    			if (C('web_admin_edittime')){
    				$array['checktime'] = 'checked';
    			}
    			
    			$playurl = $array['playurl'];
    			file_put_contents('log.txt', "111 url:$playurl\n", FILE_APPEND);
    			$array['playurl'] = explode('$$$$$$',$array['playurl']);
    			$array['vodplay'] = explode('$$$$$$',$array['vodplay']);
    			file_put_contents('log.txt', "222 url:$playurl\n", FILE_APPEND);
    			$array['tpltitle'] = '编辑';
    			
    			$pid = get_channel_name($array['cid'], 'pid');
    			$channel_id =  get_channel_name($pid, 'id');
    			$subid = $array['cid'];
    			
    		}else{
    			if($_GET['cid']){
    				$array['cid'] = intval($_GET['cid']);
    			}else{
    		    	$array['cid'] = cookie('video_cid');
    			}
    			    			
    			$array['addtime']  = time();
    			$array['inputer']  = $_SESSION['user'];
    			$array['checktime']= 'checked';
    			$array['tpltitle'] = '添加';
    			$cid = $array['cid'];
    			$checktime=$array['checktime'];
    			file_put_contents('log.txt', "cid:$cid;checktime:$checktime\n", FILE_APPEND);
    			
    			$channel_id = $list_channel_video[0]['id'];
    			if(!get_channel_son($channel_id)){
    			    $con['pid'] = $channel_id;
    			    $c = M('channel');
    			    $son = $c->where($con)->select();
    			    $subid = $son[0]['id'];
    			}else{
    			    $con['pid'] = get_channel_sqlin($channel_id);
    			    $subid = 0;
    			}
    		}
    		
    		$array['list_language']= explode(',',C('web_admin_language'));
    		$array['list_area']    = explode(',',C('web_admin_area'));
    		
    		$tree = M('level')->findAll();
    		
    		$this->assign('levels', $tree);
    		
    		$this->assign($array);
    		$this->assign('playserver',C('player_list'));
    		$this->assign('channel_id', $channel_id);
    		$this->assign('subid', $subid);
    		$this->assign('list_channel_video',$list_channel_video);
    	//	$this->assign('list_channel_video',F('_gxcms/channelvideo'));
    		
    		$this->display('views/admin/video_vod_add.html');
        }else{
            file_put_contents('log.txt', "add live video#####...\n", FILE_APPEND);   
            
            $con['pid'] = '0';
            $con['ctype'] = "live";
            $list_channel_video = M('Channel')->where($con)->select();
            
            if ($where['id']) {
                $array['tpltitle'] = '编辑';
    			$array = $this->VideoDB->where($where)->find();
    			if (C('web_admin_edittime')){
    				$array['checktime'] = 'checked';
    			}
    			
    			$pid = get_channel_name($array['cid'], 'pid');
    			$channel_id =  get_channel_name($pid, 'id');

    			$subid = $array['cid'];
            }else{
                $array['tpltitle'] = '添加';
                $channel_id = $list_channel_video[0]['id'];
                $tid = $_REQUEST['tid'];
                if(!get_channel_son($channel_id)){
                    $con['pid'] = $channel_id;
                    $c = M('channel');
                    $son = $c->where($con)->select();  
                    $subid = $son[0]['id'];
                }else{
                    $con['pid'] = get_channel_sqlin($channel_id);
                    $subid = 0;
                }
                
                if(($tid == null) || ($tid == "")){
                    $tid = randonumkeys(8);   /// a temp id for auth
                }
                
                file_put_contents('log.txt', "===== VideoAction tid:$tid \n", FILE_APPEND);
                $array['addtime']  = time();
                $array['starttime'] = time();
                $array['endtime'] = time() + 60*30;
                $array['inputer']  = $_SESSION['user'];
                $array['list_language']= explode(',',C('web_admin_language'));
                $array['list_area']    = explode(',',C('web_admin_area'));
                $array['level'] = 1;
                $array['auth'] = 1;
                $array['tid'] = $tid;

            }
            file_put_contents('log.txt', "############### channel_id:$channel_id;sub_id:$subid \n", FILE_APPEND);
            $tree = M('level')->findAll();
            
            $this->assign('levels', $tree);
            $this->assign('channel_id', $channel_id);
            $this->assign('subid', $subid);            
            $this->assign('list_channel_video',$list_channel_video);
            $this->assign($array);
            $this->display('views/admin/video_live_add.html');
        }
    }
	// 前置操作
	public function _before_insert(){
	    file_put_contents('log.txt', "=-=-=-=-=- _before_insert\n", FILE_APPEND);
	    $_POST['level'] = $_POST['userlevel'];
		if (strpos($_POST['picurl'],'://') > 0 && C('upload_http')) {
			$down = D('Down');
			$_POST['picurl']= $down->down_img(trim($_POST['picurl']));
		}
		
		for($i=0;$i<count($_POST['playurl']);$i++)
		{
			if (!$_POST['playurl'][$i])
			{
				unset($_POST['playurl'][$i]);
				unset($_POST['vodplay'][$i]);
			}
		}
		$_POST['playurl'] = empty($_POST['playurl']) ? 0 : implode('$$$$$$', $_POST['playurl']);
		$_POST['vodplay'] = empty($_POST['vodplay']) ? 0 : implode('$$$$$$', $_POST['vodplay']);
		$vodplay = $_POST['vodplay'];
		
		file_put_contents('log.txt', "=-=-=-=-=- vodplay:$vodplay\n", FILE_APPEND);
		$_POST['cid'] = $_POST['channel_mcid'];
		$cid = $_POST['cid'];
		file_put_contents('log.txt', "=-=-=-=-=- cid:$cid\n", FILE_APPEND);
		
		
		$_POST['stype_mcid'] = empty($_POST['stype_mcids']) ? 0 : implode(',', $_POST['stype_mcids']);
		
		/*
		$picurl = $_POST['picurl'];
		if(($picurl == null) || ($picurl == "")){
		    $playurl = $_POST['playurl'];
		    
		    file_put_contents('log.txt', "======== playurl:$playurl \n", FILE_APPEND);
		    $arr = explode("|",$playurl);
		    $host = $arr[1];
		    $port = $arr[2];
		    $app = $arr[3];
		    $stream = $arr[4];
		    $format = $arr[5];
		    $ctype = $arr[6];
		    
		    $starttime = 0;
		    
		    file_put_contents('log.txt', "======= 111 $app, $stream \n", FILE_APPEND);
		    $picurls = get_mjpeg($app, $stream, $starttime, 0, 0);
		    file_put_contents('log.txt', "======= 222 \n", FILE_APPEND);
		    $pic = $picurls[0];
		    $thumbnail = $picurls[1];
		    file_put_contents('log.txt', "picurl:$pic \n", FILE_APPEND);
		    file_put_contents('log.txt', 'thumbnail:$thumbnail \n', FILE_APPEND);
		}
		*/
		
		$this->weiRepalce();//伪原创
		$this->replaceKey();//更新内链接替换
		//print_r($_POST['vodplay']);exit;
	}	
	// 新增视频保存到数据库
	public function insert(){
	    file_put_contents('log.txt', "=-=-=-=-=- insert\n", FILE_APPEND);
		if($this->VideoDB->create()){
			$id = $this->VideoDB->add();
			if( false!== $id){
				$this->assign("jumpUrl",C('cms_admin').'?s=Admin/Video/Add/type/vod');
			}else{
				$this->error('视频添加失败!');
			}
		}else{
		    $this->error($this->VideoDB->getError());
		}
	}
	
	// 新增视频保存到数据库-后置操作
	public function _after_insert(){
	    file_put_contents('log.txt', "=-=-=-=-=- _after_insert\n", FILE_APPEND);
	    cookie('video_cid',intval($_POST["cid"]));
	    $this->success('视频添加成功,继续添加新视频！');
	}
	
	// 前置操作
	public function _before_insertlive(){
	    file_put_contents('log.txt', "=-=-=-=-=- _before_insertlive\n", FILE_APPEND);
	    $_POST['level'] = $_POST['userlevel'];
	    $_POST['ctype'] = "live";
	    
	    $c = M('Channel');
	    $where['id'] = $_POST['channel_mcid'];
	    $channel = $c->where($where)->find();
	    $app = $channel['cfile'];
	    
	    // the format is '|host:port|application|stream|format|ctype|'
	    $_POST['playurl'] = "|||".$app.'|'.randomkeys(16).'|flv|live|';
	    $_POST['vodplay'] = empty($_POST['vodplay']) ? 0 : implode('$$$$$$', $_POST['vodplay']);
	    $vodplay = $_POST['vodplay'];
	
	    file_put_contents('log.txt', "=-=-=-=-=- vodplay:$vodplay\n", FILE_APPEND);
	    $_POST['cid'] = $_POST['channel_mcid'];
	    
	    $cid = $_POST['cid'];
	    file_put_contents('log.txt', "=-=-=-=-=- cid:$cid\n", FILE_APPEND);
	
	    $stime = $_POST['starttime'];
	    $etime = $_POST['endtime'];
	    $_POST['starttime'] = strtotime($stime);
	    $_POST['endtime'] = strtotime($etime);
	
	    $_POST['stype_mcid'] = empty($_POST['stype_mcids']) ? 0 : implode(',', $_POST['stype_mcids']);

	    $this->weiRepalce();//伪原创
	    $this->replaceKey();//更新内链接替换
	    //print_r($_POST['vodplay']);exit;
	}
	
	public function insertlive(){
	    file_put_contents('log.txt', "insertlive....... \n", FILE_APPEND);
	    if($this->VideoDB->create()){
	        $id = $this->VideoDB->add();
	        if( false!== $id){
	            $_POST['id'] = $id;
	            $this->assign("jumpUrl",C('cms_admin').'?s=Admin/Video/Add/type/live');
	        }else{
	            $this->error('直播添加失败!');
	        }
	    }else{
	        $this->error($this->VideoDB->getError());
	    }	    
	}
	
	// 新增视频保存到数据库-后置操作
	public function _after_insertlive(){
	   
	    $id = $_POST['id'];
	    $tid = $_POST['tid'];
 
	    file_put_contents('log.txt', "_after_insertlive id:$id; tid:$tid \n", FILE_APPEND);
	    $data['vid'] = $id;
	    $data['status'] = 1;
	    $this->VideoplaywhiteDB->where('vid='.$tid)->save($data);
	    $this->VideopushwhiteDB->where('vid='.$tid)->save($data);

	    cookie('video_cid',intval($_POST["cid"]));
	    $this->success('直播添加成功,继续添加新视频！');
	}
	
	// 更新视频信息
	public function update(){
		$this->_before_insert();
		if ($this->VideoDB->create()) {
			if (false!==$this->VideoDB->save()) {
			    $this->assign("jumpUrl",$_SESSION['video_reurl']);
			}else{
				$this->error("编辑视频信息失败!");
			}
		}else{
			$this->error($this->VideoDB->getError());
		}
	}
	
	public function updatelive(){
	    $this->_before_insertlive();
	    if ($this->VideoDB->create()) {
	        	
	        if (false!==$this->VideoDB->save()) {
	            $url = $_SESSION['video_reurl'];
	            $this->assign("jumpUrl",$_SESSION['video_reurl']);
	        }else{
	            $this->error("编辑视频信息失败!");
	        }
	    }else{
	        $this->error($this->VideoDB->getError());
	    }	    
	}
	
	//内链关键字替换成链接
	public function replaceKey()
	{
		$m = D('Admin.Wei');
		$lists = $m->lists();
		if ($lists)
		{
			$row[0] = '刘德华';
			foreach($lists as $v)
			{
				$_POST['content'] = preg_replace('/(<a.*?>\s*)('.$v['name'].')(\s*<\/a>)/sui', '${2}', $_POST['content']);
				$_POST['content'] = str_replace($v['name'],'<a href="'.$v['link'].'" target="'.$v['target'].'">'.$v['name'].'</a>',$_POST['content']);
			}
		}
		//print_r($_POST['content']);exit;
		//echo $_POST['content'];
		//exit;
	}
	
	//伪原创替换
	public function weiRepalce()
	{
		$m = D('Admin.Wei');
		$lists = $m->replacelists();
		if ($lists)
		{
			foreach($lists as $v)
			{
				$_POST['content'] = str_replace($v['firstkey'],$v['endkey'],$_POST['content']);
			}
		}
	}
	
	// 编辑视频保存到数据库-后置操作
	public function _after_update(){
		$id = intval($_POST["id"]);
		if(C('html_cache_on')){
			$id = md5($_POST["id"]).C('html_file_suffix');
			@unlink(HTML_PATH.'Video_detail/'.$id);
			@unlink(HTML_PATH.'Video_play/'.$id);			
		}
		if(C('url_html')){
			$id = $_POST["id"];
			echo'<iframe scrolling="no" src="?s=Admin/Html/Videoid/ids/'.$id.'" frameborder="0" style="display:none"></iframe>';
		}
		$this->success('编辑视频信息成功！');	
	}
	
	// 编辑视频保存到数据库-后置操作
	public function _after_updatelive(){
	    $id = intval($_POST["id"]);
	    if(C('html_cache_on')){
	        $id = md5($_POST["id"]).C('html_file_suffix');
	        @unlink(HTML_PATH.'Video_detail/'.$id);
	        @unlink(HTML_PATH.'Video_play/'.$id);
	    }
	    if(C('url_html')){
	        $id = $_POST["id"];
	        echo'<iframe scrolling="no" src="?s=Admin/Html/Videoid/ids/'.$id.'" frameborder="0" style="display:none"></iframe>';
	    }
	    $this->success('编辑视频信息成功！');
	}

	// 删除视频
    public function del(){
		$this->delfile($_GET['id']);
		redirect($_SESSION['video_reurl']);
    }
	// 删除视频all
    public function delall(){
		if(empty($_POST['ids'])){
			$this->error('请选择需要删除的视频!');
		}	
		$array = $_POST['ids'];
		foreach($array as $val){
			$this->delfile($val);
		}
		redirect($_SESSION['video_reurl']);
    }
	// 删除静态文件与图片
    public function delfile($id){
        $this->VideoplaywhiteDB->where('vid='.$id)->delete();

        $this->VideopushwhiteDB->where('vid='.$id)->delete();
        
		//删除静态文件
		$array = $this->VideoDB->field('id,cid,picurl,title,playurl')->where('id = '.intval($id))->find();
		@unlink('./'.C('upload_path').'/'.$array['picurl']);
		@unlink('./'.C('upload_path').'-s/'.$array['picurl']);
		if(C('url_html')){
			//删除内容页
			@unlink(C('webpath').get_read_url_dir('video',$array['id'],$array['cid']).C('html_file_suffix'));
			//删除播放页
			if(C('url_html_play')){
				$count = 1;
				if(C('url_html_play') == 2){
					$count = $this->playlist($array['playurl'],$array['id'],$array['cid']);
					$count = $count[0]['playcount'];
				}
				for($i=0;$i<$count;$i++){
					$dirurl = get_play_url_dir($array['id'],$array['cid'],$i).C('html_file_suffix');
					@unlink($dirurl);
				}
			}
		}
		//删除专题收录
		$rs = new Model();
	    $rs->execute("update ".C('db_prefix')."special set mids=Replace(Replace(Replace(Replace
			(CONCAT(',,',mids,',,'),',$id,',','),',,,,',''),',,,',''),',,','')");
		//删除视频ID
		$where['id'] = $id;
		$this->VideoDB->where($where)->delete();
		unset($where);
		//删除观看主录
		$where['did'] = $id;
		$this->UserVDB->where($where)->delete();
		unset($where);
		//删除相关评论
		$where['did'] = $id;
		$where['mid'] = 1;
		$this->CommDB->where($where)->delete();
    }
	// 隐藏与显示视频
    public function status(){
		$where['id'] = $_GET['id'];
		if($_GET['sid']){
			$this->VideoDB->where($where)->setField('status',1);
		}else{
			$this->VideoDB->where($where)->setField('status',0);
		}
		redirect($_SESSION['video_reurl']);
    }
	// 批量审核与取消审核
    public function statusall(){
		if(empty($_POST['ids'])){
			$this->error('请选择需要转移的视频!');
		}	
		$where['id'] = array('in',implode(',',$_POST['ids']));
		if($_GET['sid']){
			$this->VideoDB->where($where)->setField('status',1);
		}else{
			$this->VideoDB->where($where)->setField('status',0);
		}
		redirect($_SESSION['video_reurl']);
    }	
    
	// 批量转移视频
    public function changecid(){
		if(empty($_POST['ids'])){
			$this->error('请选择需要转移的视频!');
		}	
		$cid = intval($_POST['changecid']);
		if (get_channel_son($cid)) {
			$data['cid'] = $cid;
			$where['id'] = array('in',$_POST['ids']);
			$this->VideoDB->where($where)->save($data);
			//$this->assign("jumpUrl",C('cms_admin').'?s=Admin/Video/Show');
			//$this->success('批量转移数据成功！');
			redirect($_SESSION['video_reurl']);
		}else{
			$this->error('请选择当前大类下面的子分类！');
		}
    }	
	// Ajax设置连载
    public function serial(){
		$where['id']    = $_REQUEST['id'];
		$data['serial'] = trim($_REQUEST['sid']);
		$this->VideoDB->where($where)->save($data);
		exit('ok');
    }	
	// Ajax推荐星级权重
    public function stars(){
		$where['id']   = $_GET['id'];
		$data['stars'] = intval($_GET['sid']);
		$this->VideoDB->where($where)->save($data);
		//$this->ajaxReturn($sid,'ok',1);
		exit('ok');
    }
	// Ajax批量下载图片
    public function downimg(){
		$fail = $_GET['picurl'];
		$downnum = intval(C('upload_http_down'));
		if ($fail) {
			$this->VideoDB->execute('update '.C('db_prefix').'video set picurl = REPLACE(picurl,"fail://", "http://")');
		}
		$count = $this->VideoDB->field('id,picurl')->where('Left(picurl,7)="http://" and status=1')->count('id');
		$list  = $this->VideoDB->field('id,picurl')->where('Left(picurl,7)="http://" and status=1')->limit($downnum)->order('id desc')->select();
		echo('<div style="font-size:12px;padding:5px;" id="show">');
		if (empty($list)) {
			exit('<li>没有检测到远程图片或已经下载完成!</li>');
		}else{
			echo('<li>共需要下载<font color=red>'.$count.'</font>张远程图片。</li>');
		}		
		foreach($list as $key=>$value){
			$down = D('Down');
			$data['picurl'] = $down->down_img($value['picurl']);
			if ($data['picurl'] != $value['picurl']) {
				echo('<li>'.$value['id'].'--'.$value['picurl'].'下载成功!</li>');
			}else{
				echo('<li>'.$value['id'].'--'.$value['picurl'].' <font color=red>保存失败!</font></li>');
				$data['picurl'] = str_replace("http://","fail://",$value['picurl']);
			}
			$this->VideoDB->where('id = '.$value['id'])->save($data);
		}
		echo '<li>请稍等5秒，每页批量下载'.$downnum.'张远程图片,正在准备下一次任务！</li><li style="display:none">';
		redirect(C('cms_admin').'?s=Admin/Video/Downimg',5);
		echo '</li></div>';
    }	
	// 迷你影视列表
    public function showspecial(){
		$specialid = intval($_REQUEST['id']);
		$keyword   = urldecode(trim($_REQUEST['keyword']));
		if ($keyword) {
			$search['title']  = array('like','%'.$keyword.'%');
			$search['intro']  = array('like','%'.$keyword.'%');
			$search['actor']  = array('like','%'.$keyword.'%');
			$map              = $search;
			$map['_logic']    = 'or';
			$where['_complex']= $map;
		}
		$where['status']= 1;
		$video_count = $this->VideoDB->where($where)->count('id');
		$video_page  = !empty($_GET['p'])?intval($_GET['p']):1;
		$video_url   = U('Admin-Video/Showspecial',array('id'=>$specialid,'keyword'=>urlencode($keyword),'p'=>''),false,false);
		$listpages   = get_cms_page($video_count,C('web_admin_pagenum'),$video_page,$video_url,'部视频');
		$list = $this->VideoDB->field('id,cid,title,intro,actor')->where($where)->limit(C('web_admin_pagenum'))->page($video_page)->order('addtime desc')->select();
		$this->assign($listpages);
		$this->assign('list_video',$list);
		$this->assign('keyword',$keyword);
		$this->display('views/admin/special_video.html');
    }		
	
	/*
	 * 新添加 多分类 ajax 获取类型数据
	 * 
	 */
	public function ajaxstype(){
	    file_put_contents('log.txt', "ajaxstype...... \n", FILE_APPEND);
		$list_id = intval($_GET['id']);
		$mcid = trim($_GET['mcid']);
		$mcidArr = array();
		if ($mcid)
		{
			$mcidArr = explode(',',$mcid);
		}
		$stype_data = D('Stype')->list_cat($list_id);
		$this->assign('stype_list',$stype_data);
		$this->assign('mcidArr',$mcidArr);
		$this->display('views/admin/video_ajaxstype.html');
	}
	
	/*
	 * 获取频道数据
	 */
	public function ajaxsubchannel(){
	    file_put_contents('log.txt', "111 ajaxsubchannel \n", FILE_APPEND);
	    $list_id = intval($_GET['id']);
	    $mcid = intval($_GET['mcid']);

	    file_put_contents('log.txt', "111 ajaxsubchannel $list_id;$mcid\n", FILE_APPEND);
	    $where['pid'] = $list_id;
	    $channel_data = M('Channel')->where($where)->select();
	    
	    if($mcid == 0){
            $mcid = $channel_data[0]['id'];
	    }
	    $cnt = count($channel_data);
	    file_put_contents('log.txt', "33 len:$cnt\n", FILE_APPEND);
	    $this->assign('channel_list',$channel_data);
	    $this->assign('mcid', $mcid);
	    $this->display('views/admin/video_ajaxsubchannel.html');
	    
	}
	//删除视频版本
	public function delver($app,$stream,$ver){
		//print_r($_GET['id']);die();
		$id=$_GET['id'];
		delete_ver($_GET['app'],$_GET['stream'],$_GET['ver']);
		//redirect($_SESSION['video_reurl']);
		$this->redirect('video/versions',array('id'=> $id),0.8,'删除成功...');
	}

	public function versions(){
	    $id = $_REQUEST['id'];
		//print_r($id);die();
		file_put_contents('log.txt', "versions....[$id]11 \n", FILE_APPEND);
		$where['id'] = $id;

		$video = $this->VideoDB->field('id,playurl')->where($where)->find();
		$list=$this->VideoDB->where($where)->find();
		//print_r($list);die();
		file_put_contents('log.txt', "versions....22 \n", FILE_APPEND);
		$playurl = $video['playurl'];
		file_put_contents('log.txt', "versions... $playurl \n", FILE_APPEND);

		$arr = explode("|",$playurl);
		$app = $arr[3];
		$stream = $arr[4];
        //$pageno = 1;
		//$force_update='no';

		file_put_contents('log.txt', "versions....$app:$stream \n", FILE_APPEND);
		$nodeList = get_stream_versions($app, $stream, "flv");
	    $ver = 0;
	    if($nodeList !== FALSE){
	        $len = $nodeList->length;
	        file_put_contents('log.txt', "versions.... len:$len\n", FILE_APPEND);
	        if($nodeList->length > 0){
	            $arr_duties = array();
	            for ($i = 0; $i < $nodeList->length; $i++)
	            {
	                $arr         = array();
	                $sub_node    = $nodeList->item($i);
            		$arr['stime']    = $sub_node->getAttribute('starttime');//开始时间
					$arr['tag'] = $sub_node->getAttribute('tag');//标签
				
            		$arr['duration'] = $sub_node->getAttribute('duration');//时长

            		$arr['ver']      = $sub_node->getAttribute('version');//版本编号

            		$arr['size']     = $sub_node->getAttribute('size');//视频的大小，比特

            		//$stime = $sub_node->getAttribute('stime');
					$stime = $arr['stime'];

            		$arr['stime']    = get_time_readable($stime);//开始时间，正常格式

            		$duration = $sub_node->getAttribute('duration');//

            		$arr['durtext']  = get_duration_readable($duration);//时长，正常格式

            		$size = $sub_node->getAttribute('size');

            		$arr['sizetext'] = get_filesize_readable($size);
                    $arr['stream']=$stream;

            		$arr['formats']  = $sub_node->getAttribute('formats');//转码格式
					$arr[id] = $id;
	                $arr_duties[] = $arr;
	            }
	            $this->assign("vers", $arr_duties);
	            $ver = 1;
	        }
	    } 
	    //echo "111";
	    $this->assign('ver', $ver);
		$this->assign('id', $id);
	    $this->assign("app", $app);
	    $this->assign("stream", $stream);
	    $this->display('views/admin/video_versions.html');
	}
	
	/*
	public function videoauthen(){
	    $type = $_GET['type'];
	    if($type == 0){
	        $array['tpltitle'] = "推流用户";
	    }else{
	        $array['tpltitle'] = "观看用户";
	    }
	    
	    $this->assign($array);
	    $this->display('views/admin/videoauth_show.html');
	}
	*/
	
	public function FlushData()
	{
		
	}
}
?>