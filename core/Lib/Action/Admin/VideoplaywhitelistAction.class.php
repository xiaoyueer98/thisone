<?php
/**
 * @name    用户管理模块
 * @package GXCMS.Administrator
 * @link    www.gxcms.com
 */
class VideoplaywhitelistAction extends AdminAction{
	 private $VideoDB;	
	 private $UserDB;
	 private $GroupDB;
	 private $VideoplaywhiteDB;
	 private $VideopushwhiteDB;
	 private $GroupmemberDB;
	 
	 public function _initialize(){
	 	parent::_initialize();
	 	$this->GroupDB  =D('Admin.Group');
	 	$this->UserDB  =D('Admin.User');
	 	$this->VideoplaywhiteDB = D('Admin.Video_play_white_list');
	 	$this->VideopushwhiteDB = D('Admin.Video_push_white_list');
	 	$this->GroupmemberDB = D('Admin.groupmember');
    }
	// 用户管理
    public function show(){
        $id = $_POST['id'];//视频id
        $tid = $_POST['tid'];
        $videotype = $_REQUEST['videotype'];
        file_put_contents('log.txt', "fffffff type:$videotype \n", FILE_APPEND);

		$keyword = trim($_REQUEST['keyword']);
		if($tid == 0){
		  $vwhere['vid'] = $id;
		}else{
		  $vwhere['vid'] = $tid;
		}

		file_put_contents('log.txt', "video play white list id:$id; tid:$tid 33\n", FILE_APPEND);
		$white_list = $this->VideoplaywhiteDB->where($vwhere)->select();
		if(count($white_list) > 0){
    		for($i = 0; $i < count($white_list); $i++){
    		    $d = $white_list[$i]['gid'];//群组id
    		    $arr[$i] = $d;
    		    file_put_contents('log.txt', "====== show d:$d \n", FILE_APPEND);
    		}
    		$map['id'] = array('in', $arr);//已经添加的群组id，二维数组

    		if (($keyword) && ($keyword != "可搜索(群组名,群组描述)")) {
    		    $where['name']     = array('like','%'.$keyword.'%');
    		    $where['describe'] = array('like','%'.$keyword.'%');
    		    $where['_logic']       = 'or';
    		    $map['_complex'] = $where;
    		}

    		$count = $this->GroupDB->where($map)->count('id');//设置观看群组的个数
    		file_put_contents('log.txt', "============= keyword:$keyword; vid:$id;count:$count \n", FILE_APPEND);
    		$member_page  = !empty($_GET['p'])?$_GET['p']:1;
    		$member_url   = U('Admin-Videoplaywhite/Show',array('keyword'=>urlencode($keyword),'p'=>''),false,false);
    		$listpages  = get_cms_page($count,C('web_admin_pagenum'),$member_page,$member_url,'个成员');
    		$listgroup = $this->GroupDB->where($map)->order('buildtime desc')->limit(C('web_admin_pagenum'))->page($member_page)->select();//已经添加的群组的信息

    		file_put_contents('log.txt', "video play 111111 \n", FILE_APPEND);
    		for($i = 0; $i < $count; $i++){
    		    file_put_contents('log.txt', "video play aaaaa \n", FILE_APPEND);
    		    $gid = $listgroup[$i]['id'];//群组id
    		    file_put_contents('log.txt', "video play gid:$gid \n", FILE_APPEND);
    		    $mwhere['gid'] = $gid;
    		    $membercount = $this->GroupmemberDB->where($mwhere)->count('id');//每个群组成员个数
				
    		    file_put_contents('log.txt', "video play bbbbb \n", FILE_APPEND);
    		    $listgroup[$i]['mcount'] = $membercount;//设置的群组数目
    		    file_put_contents('log.txt', "video play ccccc \n", FILE_APPEND);
    		}
    		file_put_contents('log.txt', "video play 222222 \n", FILE_APPEND);
		}
		
		file_put_contents('log.txt', "show type:$videotype \n", FILE_APPEND);
		if($videotype == "live"){
		  $this->saveinfo(false);
		}else{
		  $this->save_vod_info(false);  
		}
		
		$this->assign('videotype', $videotype);
		$this->assign('id', $id);
		$this->assign('tid', $tid);
		$this->assign('keyword',$keyword);
		$this->assign($listpages);
		$this->assign('list_group',$listgroup);
        $this->display('./views/admin/video_play_white_list_show.html');
    }
    
	// 用户添加与编辑表单
    public function add(){
        $keyword = trim($_REQUEST['kd']);
		$id = $_POST['id'];
		$tid = $_POST['tid'];
		
		file_put_contents('log.txt', "====== add vid:$id; tid:$tid \n", FILE_APPEND);
		if(($id == null) || ($id == "")){
		  $gwhere['vid'] = $tid;
		}else{
		    $gwhere['vid'] = $id;
		}
		$whiteList = $this->VideoplaywhiteDB->where($gwhere)->select();
		
		$whitecount = count($whiteList);
		$arr= Array();
		if($whitecount > 0){
    		for($i = 0; $i < $whitecount; $i++){
    		    $d = $whiteList[$i]['gid'];
    		    $arr[$i] = $d;
    		    file_put_contents('log.txt', "=======add d:$d\n", FILE_APPEND);
    		}
    
    		$map['id'] = Array('not in', $arr);
		}

		file_put_contents('log.txt', "addddd kd:$keyword \n", FILE_APPEND);
		if (($keyword) && ($keyword != "可搜索(群组名,群组描述)")) {
            $where['name']     = array('like','%'.$keyword.'%');
			$where['describe'] = array('like','%'.$keyword.'%');
			$where['_logic']       = 'or';
		    $map['_complex'] = $where;
		}
		
		$group_page  = !empty($_GET['p'])?$_GET['p']:1;
		if(count($map) > 0){
		    $group_count = $this->GroupDB->where($map)->count('id');	
		    $list = $this->GroupDB->where($map)->order('buildtime desc')->limit(C('web_admin_pagenum'))->page($group_page)->select();
		}else{
		    $group_count = $this->GroupDB->count('id');
		    $list = $this->GroupDB->order('buildtime desc')->limit(C('web_admin_pagenum'))->page($group_page)->select();
		}
		file_put_contents('log.txt', "================add =groupcount:$group_count; \n", FILE_APPEND);
		
		$group_url   = U('Admin-Videoplaywhite/Add',array('keyword'=>urlencode($keyword),'p'=>''),false,false);
		$listpages  = get_cms_page($group_count,C('web_admin_pagenum'),$group_page,$group_url,'个群组');

		$this->assign('keyword',$keyword);
		$this->assign($listpages);
		$this->assign('list_group',$list);
		$this->assign('id', $id);
		$this->assign('tid', $tid);
		$this->saveinfo(false);
		$this->display('./views/admin/video_play_white_list_add.html');
    }
        
    public function addwhitelist($vid, $gid){
        //用户中心
        $data['vid'] = $vid;
        $data['gid'] = $gid;
        $data['jointime'] = time();
        $data['status'] = 0;
        $this->VideoplaywhiteDB->add($data);
        
        unset($data);
    }
    
    public function addo(){
        $id = $_POST['id'];
        $tid = $_POST['tid'];
        
        if(($id == null)||($id == "")){
            file_put_contents('log.txt', "add do 111 tid:$tid \n", FILE_APPEND);
            $t = $tid;    
        }else{
            file_put_contents('log.txt', "add do 222 \n", FILE_APPEND);
            $t = $id;
        }
        
        file_put_contents('log.txt', "3333 vid:$t \n", FILE_APPEND);
        if(empty($_POST['ids'])){
            $this->error('请选择需要添加的群组!');
        }
        $array = $_POST['ids'];
        foreach($array as $val){
            $this->addwhitelist($t, intval($val));
        }
       
      //  $s = $_SERVER['HTTP_REFERER'];
      //  file_put_contents('log.txt', "===adddo:$s \n", FILE_APPEND);
      // redirect(s); 
        $this->add();
    }
    	
	// 删除用户
	public function del(){
	    $gid = $_REQUEST['gid'];
	    $vid = $_POST['id'];
	    $tid = $_POST['tid'];
	    
	    file_put_contents('log.txt', "del gid:$gid;vid:$vid;tid:$tid \n", FILE_APPEND);
	    if(($vid == null) || ($vid == "")){
	        $t = $tid;
	    }else{
	        $t = $vid;
	    }
	    
	    file_put_contents('log.txt', "del t:$t \n", FILE_APPEND);
		$this->delplaywhitelist(intval($gid), $t);
	//	redirect($_SERVER['HTTP_REFERER']);
		$this->show();
	}
	
	// 删除用户All
    public function delall(){
		if(empty($_POST['ids'])){
			$this->error('请选择需要删除的群组!');
		}
		$array = $_POST['ids'];
		
		$tid = $_POST['tid'];
		$id = $_POST['id'];
		
		if(($id == null) || ($id == "")){
		    $t = $tid;
		}else{
		    $t = $id;
		}		
		
		foreach($array as $val){
			$this->delplaywhitelist(intval($val), $t);
		}
		//redirect($_SERVER['HTTP_REFERER']);
	   $this->show();
    }
    
	// 删除用户资料等信息
    public function delplaywhitelist($gid, $vid){
		//用户中心
	//	$where['id'] = $id;
	//	$this->GroupDB->where($where)->delete();
		//群成员	
		
        file_put_contents('log.txt', "delplaywhitelist gid:$gid;vid:$vid \n", FILE_APPEND);
		$where['gid'] = $gid;
		$where['vid'] = $vid;
		$this->VideoplaywhiteDB->where($where)->delete();
		unset($where);
    }		
    
    public function returnvideo(){
        
        $videotype = $_POST['videotype'];
        
        file_put_contents('log.txt', "returnvideo type:$videotype \n", FILE_APPEND);
        $con['pid'] = '0';
        $con['ctype'] = $videotype;
        $list_channel_video = M('Channel')->where($con)->select();
        if($videotype == "live"){
            $this->saveinfo(true, $list_channel_video);
        }else{
            $this->save_vod_info(true, $list_channel_video);
        }
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
        file_put_contents('log.txt', "saveinfo  id:$id;tid:$tid \n", FILE_APPEND);
       
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
    
    public function save_vod_info($is_return, $list_channel_video=null){
        $tpltitle = $_POST['tpltitle'];
        $title = $_POST['title'];
        $serial = $_POST['serial'];
        $picurl = $_POST['picurl'];
        $downurl = $_POST['downurl'];
        $content = $_POST['content'];
        $id = $_POST['id'];
        $tid = $_POST['tid'];
       // $playurl = $_POST['playurl'];
        $count = count($playurl);

        file_put_contents('log.txt', "==========ssss playurl:$count \n", FILE_APPEND);
        $cid = $_POST['cid'];
        $subid = $_POST['channel_mcid'];
        file_put_contents('log.txt', "save_vod_info  id:$id;tid:$tid \n", FILE_APPEND);
         
        $this->assign('title', $title);
        $this->assign('cid', $cid);
        $this->assign('serial', $serial);
        $this->assign('picurl', $picurl);
        $this->assign('content', $content);
        $this->assign('tid', $tid);
        $this->assign('id', $id);

        $this->assign('downurl', $downurl);
        if($is_return){
            $playurl = explode('$$$$$$',$_POST['playurl']);
            $vodplay = explode('$$$$$$',$_POST['vodplay']);
            file_put_contents('log.txt', "save playurl:$playurl;vodplay:$vodplay \n", FILE_APPEND);
            $this->assign('subid', $subid);
            $this->assign('id', $id);
            $this->assign("playurl", $playurl);
            $this->assign("vodplay", $vodplay);
            $this->assign('list_channel_video',$list_channel_video);
            $this->assign('channel_id', $cid);
            $this->display('./views/admin/video_vod_add.html');
        }else{
            $_POST['playurl'] = empty($_POST['playurl']) ? 0 : implode('$$$$$$', $_POST['playurl']);
            $_POST['vodplay'] = empty($_POST['vodplay']) ? 0 : implode('$$$$$$', $_POST['vodplay']);

            $playurl = $_POST['playurl'];
            $vodplay = $_POST['vodplay'];
           // var_dump($playurl);var_dump($vodplay);die();
            file_put_contents('log.txt', "save playurl:$playurl;vodplay:$vodplay \n", FILE_APPEND);
            $this->assign('playurl', $playurl);
            $this->assign('vodplay',$vodplay);
            $this->assign('channel_mcid', $subid);
            $this->assign('vid', $id);
        }
    
    }    
}
?>