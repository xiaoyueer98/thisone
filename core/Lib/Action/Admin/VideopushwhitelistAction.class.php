<?php
/**
 * @name    用户管理模块
 * @package GXCMS.Administrator
 * @link    www.gxcms.com
 */
class VideopushwhitelistAction extends AdminAction{
	 private $VideoDB;	
	 private $UserDB;
	 private $VideopushwhiteDB;
	 
	 public function _initialize(){
	 	parent::_initialize();
	 	$this->UserDB  =D('Admin.User');
	 	$this->VideopushwhiteDB = D('Admin.Video_push_white_list');
    }
	// 用户管理
    public function show(){
        $id = $_POST['id'];
        $tid = $_POST['tid'];

		$keyword = trim($_REQUEST['keyword']);
		if($tid == 0){
		  $vwhere['vid'] = $id;
		}else{
		  $vwhere['vid'] = $tid;
		}

		file_put_contents('log.txt', "video push white list vid:$id; tid:$tid 33\n", FILE_APPEND);
		$white_list = $this->VideopushwhiteDB->where($vwhere)->select();
		if(count($white_list) > 0){
    		for($i = 0; $i < count($white_list); $i++){
    		    $d = $white_list[$i]['uid'];
    		    $arr[$i] = $d;
    		    file_put_contents('log.txt', "====== show d:$d \n", FILE_APPEND);
    		}
    		$map['id'] = array('in', $arr);
		
    		if (($keyword) && ($keyword != "可搜索(用户名,email)")) {
    		    $where['username']     = array('like','%'.$keyword.'%');
    		    $where['email'] = array('like','%'.$keyword.'%');
    		    $where['_logic']       = 'or';
    		    $map['_complex'] = $where;
    		}
    		
    		$count = $this->UserDB->where($map)->count('id');
    		file_put_contents('log.txt', "============= keyword:$keyword; vid:$id;count:$count \n", FILE_APPEND);
    		$member_page  = !empty($_GET['p'])?$_GET['p']:1;
    		$member_url   = U('Admin-Videopushwhite/Show',array('keyword'=>urlencode($keyword),'p'=>''),false,false);
    		$listpages  = get_cms_page($count,C('web_admin_pagenum'),$member_page,$member_url,'个成员');
    		$listgroup = $this->UserDB->where($map)->order('jointime desc')->limit(C('web_admin_pagenum'))->page($member_page)->select();
		}
		
		$this->saveinfo(false);
		$this->assign('vid', $id);
		$this->assign('tid', $tid);
		$this->assign('keyword',$keyword);
		$this->assign($listpages);
		$this->assign('list_user',$listgroup);
        $this->display('./views/admin/video_push_white_list_show.html');
    }
    
	// 用户添加与编辑表单
    public function add(){
        $keyword = trim($_REQUEST['kd']);
		$vid = $_POST['id'];
		$tid = $_POST['tid'];
		file_put_contents('log.txt', "======add vid:$vid; tid:$tid \n", FILE_APPEND);
		if(($vid == null) || ($vid == "")){
		  $gwhere['vid'] = $tid;
		}else{
		    $gwhere['vid'] = $vid;
		}
		$whiteList = $this->VideopushwhiteDB->where($gwhere)->select();
		
		$whitecount = count($whiteList);
		$arr= Array();
		if($whitecount > 0){
    		for($i = 0; $i < $whitecount; $i++){
    		    $d = $whiteList[$i]['uid'];
    		    $arr[$i] = $d;
    		    file_put_contents('log.txt', "=======d:$d\n", FILE_APPEND);
    		}
    
    		$map['id'] = Array('not in', $arr);
		}

		file_put_contents('log.txt', "addddd kd:$keyword \n", FILE_APPEND);
		if (($keyword) && ($keyword != "可搜索(用户名,email)")) {
            $where['username']     = array('like','%'.$keyword.'%');
			$where['email'] = array('like','%'.$keyword.'%');
			$where['_logic']       = 'or';
		    $map['_complex'] = $where;
		}
		
		$group_page  = !empty($_GET['p'])?$_GET['p']:1;
		if(count($map) > 0){
		    $group_count = $this->UserDB->where($map)->count('id');	
		    $list = $this->UserDB->where($map)->order('jointime desc')->limit(C('web_admin_pagenum'))->page($group_page)->select();
		}else{
		    $group_count = $this->UserDB->count('id');
		    $list = $this->UserDB->order('jointime desc')->limit(C('web_admin_pagenum'))->page($group_page)->select();
		}
		file_put_contents('log.txt', "=================groupcount:$group_count; \n", FILE_APPEND);
		
		$group_url   = U('Admin-Videopushwhite/Add',array('keyword'=>urlencode($keyword),'p'=>''),false,false);
		$listpages  = get_cms_page($group_count,C('web_admin_pagenum'),$group_page,$group_url,'个用户');

		$this->saveinfo(false);
		$this->assign('keyword',$keyword);
		$this->assign($listpages);
		$this->assign('list_user',$list);
		$this->assign('id', $vid);
		$this->assign('tid', $tid);
		$this->assign('id', $vid);
		$this->display('./views/admin/video_push_white_list_add.html');
    }
    
    public function addwhitelist($vid, $gid){
        //用户中心
        $data['vid'] = $vid;
        $data['uid'] = $gid;
        $data['jointime'] = time();
        $data['status'] = 0;
        $this->VideopushwhiteDB->add($data);
        
        unset($data);
    }
    
    public function addo(){
        $vid = $_POST['id'];
        $tid = $_POST['tid'];
        
        if(($vid == null)||($vid == "")){
            file_put_contents('log.txt', "add do 111 tid:$tid \n", FILE_APPEND);
            $t = $tid;    
        }else{
            file_put_contents('log.txt', "add do 222 \n", FILE_APPEND);
            $t = $vid;
        }
        
        file_put_contents('log.txt', "3333 vid:$t \n", FILE_APPEND);
        if(empty($_POST['ids'])){
            $this->error('请选择需要添加的群组!');
        }
        $array = $_POST['ids'];
        foreach($array as $val){
            $this->addwhitelist($t, intval($val));
        }
       
       //redirect($_SERVER['HTTP_REFERER']);  
        $this->add();
    }
    
	// 删除用户
	public function del(){
	    $uid = $_REQUEST['uid'];
	    $vid = $_POST['id'];
	    $tid = $_POST['tid'];
	    
	    file_put_contents('log.txt', "del uid:$uid;vid:$vid;tid:$tid \n", FILE_APPEND);
	    if(($vid == null) || ($vid == "")){
	        $t = $tid;
	    }else{
	        $t = $vid;
	    }
	    
	    file_put_contents('log.txt', "del t:$t \n", FILE_APPEND);
		$this->delpushwhitelist(intval($uid), $t);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	// 删除用户All
    public function delall(){
		if(empty($_POST['ids'])){
			$this->error('请选择需要删除的群组!');
		}
		$array = $_POST['ids'];
		
		$tid = $_POST['tid'];
		$vid = $_POST['id'];
		
		if(($vid == null) || ($vid == "")){
		    $t = $tid;
		}else{
		    $t = $vid;
		}		
		
		foreach($array as $val){
			$this->delpushwhitelist(intval($val), $t);
		}
		//redirect($_SERVER['HTTP_REFERER']);
		$this->show();
    }
	// 删除用户资料等信息
    public function delpushwhitelist($uid, $vid){
		//用户中心
	//	$where['id'] = $id;
	//	$this->GroupDB->where($where)->delete();
		//群成员	
		
        file_put_contents('log.txt', "delpushwhitelist uid:$uid;vid:$vid \n", FILE_APPEND);
		$where['uid'] = $uid;
		$where['vid'] = $vid;
		$this->VideopushwhiteDB->where($where)->delete();
		unset($where);
    }	
    
    public function returnvideo(){
        $con['pid'] = '0';
        $con['ctype'] = "live";
        $list_channel_video = M('Channel')->where($con)->select();
        $this->saveinfo(true, $list_channel_video);  
    }
    
    public function saveinfo($is_return, $list_channel_video=null){
        $title = $_POST['title'];
    
        $id = $_POST['id'];
        $tid = $_POST['tid'];
    
        $cid = $_POST['cid'];
        $actor = $_POST['actor'];
        $inputer = $_POST['inputer'];
        $starttime = $_POST['starttime'];
        $endtime = $_POST['endtime'];
        $picurl = $_POST['picurl'];
        $content = $_POST['content'];
        $subid = $_POST['channel_mcid'];
    
        file_put_contents('log.txt', "returnvideo  channel_id:$cid;subid:$subid \n", FILE_APPEND);
        file_put_contents('log.txt', "saveinfo  vid:$id;tid:$tid \n", FILE_APPEND);
         
        $this->assign('title', $title);
        $this->assign('cid', $cid);
        $this->assign('actor', $actor);
        $this->assign('inputer', $inputer);
        $this->assign('picurl', $picurl);
        $this->assign('content', $content);
        $this->assign('tid', $tid);
        $this->assign('id', $id);
    
        if($is_return){
            $this->assign('starttime', strtotime($starttime));
            $this->assign('endtime', strtotime($endtime));
            $this->assign('subid', $subid);
            $this->assign('id', $id);
            $this->assign('list_channel_video',$list_channel_video);
            $this->assign('channel_id', $cid);
            $this->display('./views/admin/video_live_add.html');
        }else{
            $this->assign('starttime', $starttime);
            $this->assign('endtime', $endtime);
            $this->assign('channel_mcid', $subid);
            $this->assign('vid', $id);
        }
    
    }    
}
?>