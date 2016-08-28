<?php
/**
 * @name    用户管理模块
 * @package GXCMS.Administrator
 * @link    www.gxcms.com
 */
class GroupmemberAction extends AdminAction{
	 private $GroupDB;	
	 private $UserDB;
	 private $GroupmemberDB;
	 
	 public function _initialize(){
	 	parent::_initialize();
	 	$this->GroupDB  =D('Admin.Group');
	 	$this->UserDB  =D('Admin.User');
	 	$this->GroupmemberDB = D('Admin.Groupmember');
    }
	// 用户管理
    public function show(){
        $gid = $_GET['id'];

		$keyword = trim($_REQUEST['keyword']);
		if ($keyword) {
			$where['username']     = array('like','%'.$keyword.'%');
			$where['email'] = array('like','%'.$keyword.'%');
			$where['_logic']       = 'or';
			$user_list = $this->UserDB->where($where)->select();
			$arr = Array();
			for($j = 0; $j < count($user_list); $j++){
			    $arr[$j] = $user_list[$j]['id']; 
			    
			    $u = $arr[$j];
			    file_put_contents('log.txt', "=============u: $u \n", FILE_APPEND);
			}
			
			$map['uid'] = array('in', $arr);
			
		}
		$map['gid'] = array('eq', $gid);
		
		$member_count = $this->GroupmemberDB->where($map)->count('id');
		file_put_contents('log.txt', "============= keyword:$keyword; gid:$gid;count:$member_count \n", FILE_APPEND);
		$member_page  = !empty($_GET['p'])?$_GET['p']:1;
		$member_url   = U('Admin-Groupmember/Show',array('keyword'=>urlencode($keyword),'p'=>''),false,false);
		$listpages  = get_cms_page($member_count,C('web_admin_pagenum'),$member_page,$member_url,'个成员');
		//
		
		$listmember = $this->GroupmemberDB->where($map)->order('jointime desc')->limit(C('web_admin_pagenum'))->page($member_page)->select();

		$arr = Array();;
		for($i = 0; $i < $member_count; $i++){
		    $arr[$i + 1] = $listmember[$i]['uid'];

		}

		$uwhere['id'] = Array('in', $arr);
		$list = $this->UserDB->where($uwhere)->select();//群组中用户的信息
		
		if ((empty($list)) && ($keyword)) {
		    $this->error('没有查询到您所筛选的成员!');
		}
		$this->assign('gid', $gid);
		$this->assign('keyword',$keyword);
		$this->assign($listpages);
		$this->assign('list_member',$list);
        $this->display('./views/admin/groupmember_show.html');
    }
    
	// 用户添加与编辑表单
    public function add(){
        $keyword = trim($_REQUEST['kd']);
		$gid = $_REQUEST['gid'];
		file_put_contents('log.txt', "======gid:$gid \n", FILE_APPEND);
		$gwhere['gid'] = $gid;
		$memberList = $this->GroupmemberDB->where($gwhere)->select();
		
		$membercount = count($memberList);
		if($membercount > 0){
		
    		$arr= Array();
    		for($i = 0; $i < $membercount; $i++){
    		    $arr[$i] = $memberList[$i]['uid'];
    		}
    
    		$map['id'] = Array('not in', $arr);
		}

		if ($keyword) {
            $where['username']     = array('like','%'.$keyword.'%');
			$where['email'] = array('like','%'.$keyword.'%');
			$where['_logic']       = 'or';
		    $map['_complex'] = $where;
		}
		
		$user_count = $this->UserDB->where($map)->count('id');	
		file_put_contents('log.txt', "=================usercount:$user_count; \n", FILE_APPEND);
		$user_page  = !empty($_GET['p'])?$_GET['p']:1;
		$user_url   = U('Admin-Groupmember/Add',array('keyword'=>urlencode($keyword),'p'=>''),false,false);
		$listpages  = get_cms_page($user_count,C('web_admin_pagenum'),$user_page,$user_url,'位用户');
		//

		$list = $this->UserDB->where($map)->order('jointime desc')->limit(C('web_admin_pagenum'))->page($user_page)->select();
		
		if ((empty($list)) && ($keyword)) {
		    $this->error('没有查询到您所筛选的用户!');
		}
		
		$this->assign('keyword',$keyword);
		$this->assign($listpages);
		$this->assign('list_user',$list);
		$this->assign('gid', $gid);
		$this->display('./views/admin/groupmember_add.html');
    }
    
    public function addmember($gid, $uid){
        //用户中心
        $data['uid'] = $uid;
        $data['gid'] = $gid;
        $data['jointime'] = time();
        $t= $data['jointime'];
        file_put_contents('log.txt', "===========t:$t\n", FILE_APPEND);
        $data['status'] = 1;
        $this->GroupmemberDB->add($data);
        
        unset($data);
    }
    
    public function addo(){
        $gid = $_GET['gid'];
        
        file_put_contents('log.txt', "3333 gid:$gid \n", FILE_APPEND);
        if(empty($_POST['ids'])){
            $this->error('请选择需要添加的用户!');
        }
        $array = $_POST['ids'];
        foreach($array as $val){
            $this->addmember($gid, intval($val));
        }
        redirect($_SERVER['HTTP_REFERER']);            
    }
    
    
    public function _before_insert(){
        $buildtime = $_POST['buildtime'];
        $btime = strtotime($buildtime);
        $_POST['buildtime'] = $btime;
    }
    
	// 用户添加入库
	public function insert() {
		if($this->GroupDB->create()) {
			if($this->GroupDB->add()) {
				$this->assign("jumpUrl",C('cms_admin').'?s=Admin/Group/Show');
    			$this->success('添加群组成功！');
            }else{
                $this->error('添加群组失败!');
            }
		}else{
			$this->error($this->GroupDB->getError());
		}
	}
	
	
	public function _before_update(){
		$where['name'] = trim($_POST['name']);
		$list = $this->GroupDB->field('id,name')->where($where)->find();
		if(!empty($list)){
			if(intval($_POST['id']) != $list['id']){
				$this->error('群组名已经存在,请重新填写!');
			}
		}
		
		$buildtime = $_POST['buildtime'];
		$btime = strtotime($buildtime);
		$_POST['buildtime'] = $btime;		
	}	
	// 更新用户
	public function update(){
		if ($this->GroupDB->create()) {
			if (false !== $this->GroupDB->save()) {
			    $this->assign("jumpUrl",C('cms_admin').'?s=Admin/Group/Show');
				$this->success('更新群组信息成功！');
			}else{
				$this->error("更新群组信息失败!");
			}
		}else{
			$this->error($this->GroupDB->getError());
		}
	}
	
	// 删除用户
	public function del(){
		$this->delgroup(intval($_GET['uid']), intval($_GET['gid']));
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	// 删除用户All
    public function delall(){
		if(empty($_POST['ids'])){
			$this->error('请选择需要删除的成员!');
		}
		$array = $_POST['ids'];
		$gid = $_POST['gid'];
		foreach($array as $val){
			$this->delgroup(intval($val), intval($gid));
		}
		redirect($_SERVER['HTTP_REFERER']);
    }
	// 删除用户资料等信息
    public function delgroup($uid, $gid){
		//用户中心
	//	$where['id'] = $id;
	//	$this->GroupDB->where($where)->delete();
		//群成员	
		$where['uid'] = $uid;
		$where['gid'] = $gid;
		$this->GroupmemberDB->where($where)->delete();
		unset($where);
    }	
	
	// 隐藏与显示群组
    public function status(){
		$where['id'] = $_GET['id'];
		if(intval($_GET['sid'])){
			$this->GroupDB->where($where)->setField('status',1);
		}else{
			$this->GroupDB->where($where)->setField('status',0);
		}
		redirect($_SERVER['HTTP_REFERER']);
    }										
}
?>