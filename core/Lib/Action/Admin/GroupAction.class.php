<?php
/**
 * @name    用户管理模块
 * @package GXCMS.Administrator
 * @link    www.gxcms.com
 */
class GroupAction extends AdminAction{
	 private $GroupDB;	
	 private $GroupmemberDB;
	 public function _initialize(){
	 	parent::_initialize();
	 	$this->GroupDB  =D('Admin.Group');
	 	$this->GroupmemberDB = D('Admin.Groupmember');
    }
	// 用户管理
    public function show(){
	$keyword = trim($_REQUEST['keyword']);
	file_put_contents('log.txt', "============group show keyword:$keyword\n", FILE_APPEND);
	if ($keyword) {
			$where['name']     = array('like','%'.$keyword.'%');
		$where['describe'] = array('like','%'.$keyword.'%');
		$where['_logic']       = 'or';
	}

	$group_count = $this->GroupDB->where($where)->count('id');
		$group_page  = !empty($_GET['p'])?$_GET['p']:1;
		$group_url   = U('Admin-Group/Show',array('keyword'=>urlencode($keyword),'p'=>''),false,false);
		$listpages  = get_cms_page($group_count,C('web_admin_pagenum'),$group_page,$group_url,'个群组');
		$list = $this->GroupDB->where($where)->order('buildtime desc')->limit(C('web_admin_pagenum'))->page($group_page)->select();

	for($i = 0; $i < $group_count; $i++){
		  $gid = $list[$i]['id'];
		  $mwhere['gid'] = $gid;
		  $membercount = $this->GroupmemberDB->where($mwhere)->count('id');
		  $list[$i]['mcount'] = $membercount;
		}

		if (empty($list) && ($keyword)) {
			$this->error('没有查询到您所筛选的群组!');
		}

		$this->assign('keyword',$keyword);
	    $this->assign($listpages);
		$this->assign('list_group',$list);
        $this->display('./views/admin/group_show.html');
    }
    
    /*
    //查看群成员列表
    public function showmembers(){
        $group_id = $_GET['id'];
        
        $where['gid'] = $group_id;
        $groupmember_count = $this->GroupmemberDB->where($where)->count('id');
        $groupmember_page = !empty($_GET['p'])?$_GET['p']:1;
        $groupmember_url = U('Admin-Group/Showmembers', array('keyword'=>urlencode($keyword), 'p'=>''), false, false);
      //  $listpages = get_cms_pages($groupmember_count, C('web_admin_pagenum'), $groupmember_page, $groupmember_url, '个成员');
        
        $list = $this->GroupmemberDB->where($where)->order();
        
        
    }
    */
    
	// 用户添加与编辑表单
    public function add(){
		$group_id = $_GET['id'];
		if ($group_id>0) {
            $where['id'] = $group_id;
			$array = $this->GroupDB->where($where)->find();
			$array['tpltitle'] = '编辑';
		}else{
			$array['id']      =0;
			$array['buildtime'] = time();
			$array['tpltitle']= '添加';
		}

		$this->assign($array);
        $this->display('./views/admin/group_add.html');
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
				$this->assign("jumpUrl",C('cms_admin').'?s=Admin/Group/Show');
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
		if ($_GET['id'] == 1){
			$this->error("系统默认用户,不能删除!");
		}
		$this->delgroup(intval($_GET['id']));
		redirect($_SERVER['HTTP_REFERER']);
	}
	// 删除用户All
    public function delall(){
		if(empty($_POST['ids'])){
			$this->error('请选择需要删除的群组!');
		}
		$array = $_POST['ids'];
		foreach($array as $val){
			$this->delgroup(intval($val));
		}
		redirect($_SERVER['HTTP_REFERER']);
    }
	// 删除用户资料等信息
    public function delgroup($id){
		//用户中心
		$where['id'] = $id;
		$this->GroupDB->where($where)->delete();
		//群成员	
		$this->GroupmemberDB->where(array('gid',$where['id']))->delete();
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