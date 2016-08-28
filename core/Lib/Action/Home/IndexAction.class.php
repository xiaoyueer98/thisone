<?php
class IndexAction extends HomeAction{
    public function index(){
		$lock = RUNTIME_PATH.'Install/install.lock';
		if (!is_file($lock)) {
			$this->assign("jumpUrl",C('cms_admin').'?s=Admin/Install');
			$this->error('您还没安装本程序，请运行 install.php 进入安装!');
		}
		
		$is_mobile = isMobile();
		$_SESSION['is_mobile'] = $is_mobile;
		$this->assign('index_hdp_show',C('index_hdp_show'));
		$this->assign('model','index');	
		$this->assign('webtitle',C('web_name'));
		$this->display('index');
    }
}
?>
