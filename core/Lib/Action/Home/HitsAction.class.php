<?php
/**
 * @name    点击次数模块
 * @package GXCMS.Administrator
 *
 */
class HitsAction extends HomeAction{
	private $UserDB;
	private $VideoDB;
	private $CareDB;
	//静态模式JS展示人气
    public function show(){
		$id	  = intval($_GET['id']);
		$mid  = trim($_GET['mid']);
		$type = trim($_GET['type']);
		$rs   = M($mid);
		$array = $rs->field('id,hits,monthhits,weekhits,dayhits,hitstime')->where('id='.$id)->find();
		if($array && $type == 'insert'){
			if(C('web_hits_way')){
			$this->hits_insert_adv($mid,$array);
			}else{
			$this->hits_insert($mid,$array);	
			}
		}else{
			if($array){
				echo("document.write('".$array[$type]."');");
			}else{
				echo("document.write('0');");
			}
		}
    }
    
    
    /**
	 * 处理各模块的人气值刷新
	 * @param $mid   模型  eg:video
	 * @param $array 
	 */
	public function hits_insert($mid,$array){
		//初始化值
		$hits['hits']      = $array['hits'];
		$hits['monthhits'] = $array['monthhits'];
		$hits['weekhits']  = $array['weekhits'];
		$hits['dayhits']   = $array['dayhits'];
		$new = getdate();
		$old = getdate($array['hitstime']);
		//月
		if($new['year'] == $old['year'] && $new['mon'] == $old['mon']){
			$hits['monthhits'] ++;
		}else{
			$hits['monthhits'] = 1;
		}
		//周
		$weekStart = mktime(0,0,0,$new["mon"],$new["mday"],$new["year"]) - ($new["wday"] * 86400);//本周开始时间,本周日0点0
		$weekEnd   = mktime(23,59,59,$new["mon"],$new["mday"],$new["year"]) + ((6 - $new["wday"]) * 86400);//本周结束时间,本周六12点59
		if($array['hitstime'] >= $weekStart && $array['hitstime'] <= $weekEnd){
			$hits['weekhits'] ++;
		}else{
			$hits['weekhits'] = 1;
		}
		//日
		if($new['year'] == $old['year'] && $new['mon'] == $old['mon'] && $new['mday'] == $old['mday']){
			$hits['dayhits'] ++;
		}else{
			$hits['dayhits'] = 1;
		}
		//更新数据库
		$hits['id']       = $array['id'];
		$hits['hits']     = $hits['hits']+1;
		$hits['hitstime'] = time();
		$rs = M($mid);
		$rs->save($hits);
		return $hits;
	}
	
    
	/**
	 * 处理各模块的人气值刷新,对于高访问量站，采用延迟更新
	 * @param $mid   模型  eg:video
	 * @param $array 
	 */
	public function hits_insert_adv($mid,$array){
		//初始化值
		$hits['hits']      = $array['hits'];
		$hits['monthhits'] = $array['monthhits'];
		$hits['weekhits']  = $array['weekhits'];
		$hits['dayhits']   = $array['dayhits'];
		$new = getdate();
		$old = getdate($array['hitstime']);
		//月
		if($new['year'] == $old['year'] && $new['mon'] == $old['mon']){
			$step['monthhits'] =1;
		}else{
			$step['monthhits'] =1;
			$hits['monthhits'] =0;
		}
		//周
		$weekStart = mktime(0,0,0,$new["mon"],$new["mday"],$new["year"]) - ($new["wday"] * 86400);//本周开始时间,本周日0点0
		$weekEnd   = mktime(23,59,59,$new["mon"],$new["mday"],$new["year"]) + ((6 - $new["wday"]) * 86400);//本周结束时间,本周六12点59
		if($array['hitstime'] >= $weekStart && $array['hitstime'] <= $weekEnd){
			$step['weekhits'] =1;
			
		}else{
			$step['weekhits'] = 1;
			$hits['weekhits'] = 0;
		}
		//日
		if($new['year'] == $old['year'] && $new['mon'] == $old['mon'] && $new['mday'] == $old['mday']){
			$step['dayhits'] = 1;
		}else{
			$step['dayhits'] = 1;
			$hits['dayhits'] = 0;
		}
	
		$step['hits']=1;
		//延迟更新
		$arrkey=array('hits','monthhits','weekhits','dayhits');
		$Hits=D('Home.Hits');
		foreach($arrkey as $v){
		$step[$v]=$Hits->setLazy($v,"id=".$hits['id'],$step[$v],C('web_hits_time'));
		}
		if($step['dayhits']===false){
			return true;
		}else{
		foreach($arrkey as $val){
		$hits[$val]  = $hits[$val]+$step[$val];	
		}
		$hits['id']        = $array['id'];
		$hits['hitstime']  = time();
		$rs = M($mid);
		$rs->save($hits);
		return $hits;
		}
		
	}

//	public function _before_hit_care(){
//		$status=$_POST['status'];
//		$vid=$_POST['id'];
//		$where['username'] = $_SESSION['force_user'];
//		$arr = $this->UserDB->where($where)->select();
//		$uid = $arr[id];
//		$list = $this->CareDB->where('uid'==$uid)->select();
//	}
	//点击关注
	public function hit_care(){
		//获取状态，1表示已经关注，0表示没有关注
		$status=$_POST['status'];
		$vid=$_POST['id'];//获取视频id
		$where['username'] = $_SESSION['force_user'];//获取登录的用户名
		$arr = $this->UserDB->where($where)->select();
		$uid = $arr[id];//登录的用户的id
		$list = $this->CareDB->where('uid'==$uid)->select();
		if($status){
			if (!empty($list)){
				if($this->CareDB->create()){
					if(false==$this->CareDB->delete()){
						$this->error('无法取消关注');
					}else{
						$data['uid']=$uid;
						$data['vid']=$vid;
						$this->CareDB->delete($data);
						$this->success('取消关注');
					}
				}else{
					$this->error($this->CareDB->getError());
				}
			}else{
				if($this->CareDB->create()){
					if(false==$this->CareDB->add()){
						$this->error('关注失败!');
					}else{
						$data['uid']=$uid;
						$data['vid']=$vid;
						$this->CareDB->save($data);
						$this->success('关注成功');
					}
				}else{
					$this->error($this->CareDB->getError());
				}
			}
		}else{
			if($this->CareDB->create()){
				if(false==$this->CareDB->add()){
					$this->error('关注失败!');
				}else{
					$data['uid']=$uid;
					$data['vid']=$vid;
					$this->CareDB->save($data);
					$this->success('关注成功');
				}
			}else{
				$this->error($this->CareDB->getError());
			}
		}


	}
	//个人中心-》我的关注房间列表
	public function video_care(){
		$where['username'] = $_SESSION['force_user'];
		$arr = $this->UserDB->where($where)->select();
		$uid = $arr[id];
		$list = $this->CareDB->where('uid'==$uid)->select();
		$where2['id']=$list['vid'];
		$list2 = $this->VideoDB->where($where2) - select();
		$this->assign('list2', $list2);
		$this->display('my_care');

	}
	
	
}
?>