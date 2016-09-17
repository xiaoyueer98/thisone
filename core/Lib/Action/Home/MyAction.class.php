<?php
class MyAction extends HomeAction{
    public function index(){
		$this->show();
	}
    public function show(){
		$id = !empty($_GET['id'])?$_GET['id']:'hot';
		file_put_contents('log.txt', "show   id:$id\n", FILE_APPEND);
		$this->display('new/my_'.trim($id));
	}					
}
?>