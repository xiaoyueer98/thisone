<?php
/**
 * @name    系统管理后台入口
 * @package GXCMS.Administrator
 * @link    www.gxcms.com
 */
class IndexAction extends AdminAction{
	
	public function _initialize(){
	 	parent::_initialize();
	 	C('TMPL_FILE_NAME','./views/admin/..');
	 }
 
    public function index(){
        $this->display('index2');
    }
	
    public function left(){
        $this->display('left2');
    }
	
    public function top(){
        $this->display('top');
    }	
	
    public function main(){
		$this->create_channel();
		$channels = M('Channel');
		$videos = M("Video");
		$livewhere['pid'] = array('neq','0');
		$livewhere['ctype'] = 'live';
		$livecids = $channels->where($livewhere)->select();
		$vodwhere['pid'] = array('neq',0);
		$vodwhere['ctype'] = 'vod';
		$vodcids = $channels->where($vodwhere)->select();
		
		$tvwhere['pid'] = array('neq',0);
		$tvwhere['ctype'] = 'tv';
		$tvcids = $channels->where($tvwhere)->select();

		
		$con = "";
		for($i = 0; $i < count($livecids); $i++){
		    if($i == 0){
		          $con = 'cid='.$livecids[$i]['id'];
		    }else{
		        $con = $con.' OR cid='.$livecids[$i]['id'];
		    }
		}
		if($i > 0){
    		$live_count = count($videos->where($con)->select());
		}else{
		    $live_count = 0;
		}
		
		for($i = 0; $i < count($vodcids); $i++){
		    if($i == 0){
		        $con = 'cid='.$vodcids[$i]['id'];
		    }else{
		        $con = $con.' OR cid='.$vodcids[$i]['id'];
		    }
		}
		if($i > 0){
		    $vod_count = count($videos->where($con)->select());
		}else{
		    $vod_count = 0;
		}		
		
		for($i = 0; $i < count($tvcids); $i++){
		    if($i == 0){
		        $con = 'cid='.$tvcids[$i]['id'];
		    }else{
		        $con = $con.' OR cid='.$tvcids[$i]['id'];
		    }
		}
		if($i > 0){
		    $tv_count = count($videos->where($con)->select());
		}else{
		    $tv_count = 0;
		}
/*        print_r($vod_count);
        echo "</br>";
        print_r($tv_count);
        echo "</br>";
        print_r($live_count);die();*/
		$this->assign("live_count", $live_count);
		$this->assign("vod_count", $vod_count);
		$this->assign("tv_count", $tv_count);
		$this->assign("reg_user_count", 3);
		$this->assign("online_user_count", 1);
        $this->display('main');
    }

    public function menuMap(){
    	$this->display('menu_map');
    }
}
?>