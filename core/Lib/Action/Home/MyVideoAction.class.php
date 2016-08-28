<?php

class VideoAction extends HomeAction{
    //影视列表
    public function lists(){
		//获取地址栏参数并读取栏目缓存信息
		file_put_contents('log.txt', "============ video lists ... \n", FILE_APPEND);
		$url = get_url_where();
		
		file_put_contents('log.txt', "========= video lists url:$url \n", FILE_APPEND);
		//获取栏目信息缓存
		if($url['id']){
			$list = list_search(F('_gxcms/channel'),'id='.$url['id']);
		}else{
			$list = F('_gxcms/channel');
		}
		$channel  = $list[0];
		//组合查询条件并得到本类及小类条件数据统计
		$where['status'] = array('eq',1);
		if($url['id']){
			if(get_channel_son($url['id'])){
				$where['cid'] = $url['id'];
			}else{
				$where['cid'] = get_channel_sqlin($url['id']);
			}
			$jumpurl['id']    = $url['id'];
		}
		if ($url['year']) {
			switch($url['year'])
			{
				case 1:
					$s_start = 2000;
					$s_end = 2009;
					$where['year']    = array('between',array($s_start,$s_end));
					break;
				case 2:
					$s_start = 1990;
					$s_end = 1999;
					$where['year']    = array('between',array($s_start,$s_end));
					break;
				case 3:
					$s_start = 1980;
					$s_end = 1989;
					$where['year']    = array('between',array($s_start,$s_end));
					break;
				case 4:
					$s_start = 1970;
					$s_end = 1979;
					$where['year']    = array('between',array($s_start,$s_end));
					break;
				default:
					$where['year']    = array('eq',$url['year']);
					break;
			}
			
			$jumpurl['year']  = $url['year'];
		}
		if ($url['letter']) {
			$where['letter']  = array('eq',$url['letter']);
			$jumpurl['letter']= $url['letter'];
		}
		if ($url['area']) {
			$where['area']    = array('eq',''.$url["area"].'');
			$jumpurl['area']  = urlencode($url['area']);
		}
		if ($url['order'] != 'addtime') {
			$jumpurl['order'] = $url['order'];
		}		
		
		$mcat = D('Stype')->list_cat($url['id']);
		if($url['sid']){
			
			//获取 sid 对应的名称
			$jumpurl['sid'] = $url['sid'];
			$sid = $url['sid'];
			$nav = M('Stype')->where("m_cid = {$url['sid']}")->find();
			
			
			$this->assign('nav_title_stype',$nav['m_name']);
			$where['_string']	=	"FIND_IN_SET($sid,stype_mcid)";
		}
		
		$rs = M('Video');
		$count = $rs->where($where)->count('id');
		
		//组合分页信息(强制为动态模式)
		C('url_html_channel',0);

		$totalpages = ceil($count/$channel['limit']);
		if($url['page'] > $totalpages){
			$url['page'] = $totalpages;
		}				
		$pages  = '共'.$count.'部视频&nbsp;当前:'.$url['page'].'/'.$totalpages.'页&nbsp;';
		$pages .= get_cms_page_css($url['page'],$totalpages,C('web_home_pagenum'),get_show_url('video',$jumpurl,3),false);
		//栏目模板赋值
		$channel['cid']    = $url['id'];
		$channel['order']  = $url['order'];
		$channel['page']   = $url['page'];
		$channel['letter'] = $url['letter'];
		$channel['year']   = $url['year'];
		$channel['area']   = urldecode($url['area']);
		$channel['pages']  = $pages;
		$channel['count']  = $count;
		$channel['pcount']	=	get_channel_son($url['id']);//是否有子栏目
		$m_name = '';
		if ($nav['m_name'])
		{
			$m_name = $nav['m_name'] . '-';
		}
		if ($url['page'] > 1) {
			$channel['webtitle'] = $channel['ctitle'] ? $channel['ctitle'].'-第'.$url['page'].'页-'.C('web_name') : $channel['cname'].'-第'.$url['page'].'页-'.C('web_name');
		}else{	
			$channel['webtitle'] = $channel['ctitle'] ? $m_name.$channel['ctitle'].'-'.C('web_name') : $m_name.$channel['cname'].'-'.C('web_name');
		}
		if ($channel['ckeywords']) $channel['keywords'] = $channel['ckeywords'];
		if ($channel['cdescription']) $channel['description'] = $channel['cdescription'];
		
		if($channel['pid']){
			$channel['navtitle'] = '<a href="'.C('web_path').'">首页</a> &gt; <a href="'.$channel['showurl_p'].'">'.$channel['cname_p'].'</a> &gt; <span>'.$channel['cname'].'</span>';
		}else{
			$channel['navtitle'] = '<a href="'.C('web_path').'">首页</a> &gt; <span>'.$channel['cname'].'</span>';	
		}
		if($url['sid']) $channel['navtitle'] .=  ' > '.$nav['m_name'];
		//先给bdlist标签传值后再输出模板m_cid
		//C('bdlist_ids',$where['cid']);
		C('bdlist_page',$url['page']);
		C('bdlist_where',$where);
		if (empty($channel['ctpl'])) {
			$channel['ctpl'] = 'video_list';
		}
		
		
		//新的分页机制开始
		/*
			$npage = array();
			$npage['count']			=	$count;
			$npage['totalpages']	=	$totalpages;
			$npage['curpage']		=	$url['page'];
			$npage['firstlink']		=	str_replace('{!page!}',1,get_show_url('video',$jumpurl,3));//第一页链接
			$npage['prelink']		=	str_replace('{!page!}',$url['page'] == 1 ? 1 : $url['page'] - 1,get_show_url('video',$jumpurl,3));//上一页链接
			$npage['nextlink']		=	str_replace('{!page!}',$url['page'] == $totalpages ? $totalpages : $url['page'] + 1,get_show_url('video',$jumpurl,3));//下一页链接
			$npage['lastlink']		=	str_replace('{!page!}',$totalpages,get_show_url('video',$jumpurl,3));//最后一页链接
			$halfPer				=	C('web_home_pagenum');
			for($i=$url['page']-$halfPer,$i>1 || $i=1,$j=$url['page']+$halfPer,$j<$totalpages||$j=$totalpages;$i<$j+1;$i++)
			{
				$arr = array();
				$arr['ii'] = $i;
				$arr['link'] = str_replace('{!page!}',$i,get_show_url('video',$jumpurl,3));
				$npage['list'][]	=	$arr;
			}
		*/
		
		$ekupage = get_new_page_eku($count,$url['page'],$totalpages,C('web_home_pagenum'),get_show_url('video',$jumpurl,3),false);
		//新的分页机制结束
		
		
		
		//标签调用
		$stypetag = gettypetag($channel['pid'] == 0 ? $channel['id'] : $channel['pid']);
		$this->assign($channel);
		$this->assign('stypetag',$stypetag);
		$this->assign('stypetagcount',count($stypetag));
		$this->assign('m_cid',$url['sid']);
		$this->assign('totalpages',$totalpages);
		$this->assign('ekupage',$ekupage);
		
		
		$this->assign('area',explode(',',C('web_admin_area')));
		//$this->assign('year',get_sys_year());
		
	//	file_put_contents('log.txt', "===== video lists ctpl: $channel['ctpl']\n", FILE_APPEND);
		$this->display($channel['ctpl']);
    }
    //搜索影视列表
    public function search(){
        file_put_contents('log.txt', "======== video search ==== \n", FILE_APPEND);
		//获取地址栏参数并读取缓存信息
		$str = '';
		$url = get_url_where();
		
		$list = F('_gxcms/channel');$channel = $list[999];
		//搜索条件
		$where['status'] = array('eq',1);
		if ($url['wd']) {
			$search['title']   = array('like','%'.$url['wd'].'%');
			//$search['intro'] = array('like','%'.$url['wd'].'%');
			$search['actor']   = array('like','%'.$url['wd'].'%');
			$search['director']= array('like','%'.$url['wd'].'%');
			$jumpurl['wd']     = urlencode($url['wd']);		
			$str = 	$url['wd'];
		}
		
		//主演
		if ($url['actor']) {
			$search['actor']   = array('like','%'.$url['actor'].'%');
			$jumpurl['actor']     = urlencode($url['actor']);
			$str = 	$url['actor'];
		}
		
		//导演
		if ($url['director'])
		{
			$search['director']   = array('like','%'.$url['director'].'%');
			$jumpurl['director']     = urlencode($url['director']);
			$str = 	$url['director'];
		}
		
		
		if ($url['year']) {
			$search['year']   = array('eq',$url['year']);
			$jumpurl['year']  = $url['year'];
		}
		if ($url['area']) {
			$search['area']   = array('eq','.$url["area"].');
			$jumpurl['area']  = urlencode($url['area']);
		}
		if ($url['letter']) {
			$search['letter'] = array('eq',$url['letter']);
			$jumpurl['letter']= $url['letter'];
		}		
		if ($url['id']) {
			if(get_channel_son($url['id'])){
				$where['cid'] = $url['id'];
			}else{
				$where['cid'] = get_channel_sqlin($url['id']);
			}
			$jumpurl['id']    = $url['id'];
		}
		if (isset($search)) {
			$search['_logic'] = 'or';
			$where['_complex']= $search;
		}
		if ($url['order'] != 'addtime') {
			$jumpurl['order'] = $url['order'];
		}						
		$rs = M('Video');
		$count = $rs->where($where)->count('id');
		//组合分页信息(强制为动态模式)
		C('url_html_channel',0);
		$jumpurl['p'] = '';
		$totalpages = ceil($count/$channel['video']);
		if($url['page'] > $totalpages){ 
			$url['page'] = $totalpages;
		}		
		$pages = '共'.$count.'部影片&nbsp;当前:'.$url['page'].'/'.$totalpages.'页&nbsp;';
		$pages .= get_cms_page_css($url['page'],$totalpages,C('web_home_pagenum'),str_replace('/lists','/search',get_show_url('video',$jumpurl,2)),false);
		//前台模板变量赋值
		$channel['cid']    = $url['id'];
		$channel['year']   = $url['year'];
		$channel['area']   = $url['area'];
		$channel['keyword']= $str;
		$channel['order']  = $url['order'];
		$channel['letter'] = $url['letter'];
		$channel['count']  = $count;
		$channel['page']   = $url['page'];
		$channel['pages']  = $pages;
		
		if ($url['page'] > 1) {
			$channel['webtitle'] = '搜索 '.$str.' 的结果列表 -第'.$url['page'].'页-'.C('web_name');
		}else{	
			$channel['webtitle'] = '搜索 '.$str.' 的结果列表 -'.C('web_name');
		}
		$channel['navtitle'] = '<a href="'.C('web_path').'">首页</a> &gt; <span>搜索页</span>';	
		//先给bdsearch标签传值后再输出模板
		C('bdsearch_page',$url['page']);
		C('bdsearch_where',$where);
		$this->assign($channel);
		
		$this->display('video_search');
    }	
    
    /*
    public function play_versions($app, $stream, $format, $pageno, $force_update){
        $nodeList = TRUE;
         
        file_put_contents('log.txt', " app:$app; stream:$stream \n", FILE_APPEND);
         
        
        $media_host = C('mserver_url');
        $ret = check_login();
        file_put_contents('log.txt', "get_stream_vers 111......\n", FILE_APPEND);
        if($ret == false){
            header("Location: ../auth/right_error.html?error=notauthorized");
        }else{
            $_SESSION['mstoken'] = $ret;
        }
         
        $location = "http://".$media_host."/mserver/interface/stream/?app=get_stream_files&application=$app" .
        "&stream=$stream&format=$format&pageno=$pageno&force_update=$force_update&token=".$_SESSION['mstoken'];
         
        $node = get_root_node($location,"stream_files");
        if($node===FALSE)
        {
            $nodeList = FALSE;
        }
         
        $nodeList =  $node->getElementsByTagName("file");
        if($nodeList->length<=0)
        {
            $nodeList = FALSE;
        }
        
        return $nodeList;
    }
    */
    
	//影片内容页
    public function detail(){
        file_put_contents('log.txt', "========== video detail...\n", FILE_APPEND);
        $id = $_GET['id'];
		$where['id']     = $id;
		$where['status'] = array('eq',1);
		$rs = M("Video");
		$array = $rs->where($where)->find();
		
	    $playurl = $array['playurl'];
	    $arr = explode("|",$playurl);
		if($array){
		     $ctype = $arr[6];
		    $playurl = $array['playurl'];
			$array = $this->tags_video_read($array);//变量赋值

			if($ctype == "live"){
			    $arr = explode("|",$playurl);
			    $app = $arr[3];
			    $stream = $arr[4];
			    $format = "flv";
			    $pageno = 1;
			    $force_update='no';

			    $nodeList = get_stream_versions($app, $stream, "flv", 0, 1, "no");
			    
			    $hasver = 0;
			    if($nodeList !== FALSE){
			        if($nodeList->length > 0){
                        $arr_duties = array();
                        for ($i = 0; $i < $nodeList->length; $i++)
                        {
                            $arr         = array();
                            $sub_node    = $nodeList->item($i);
                            $arr['src_id']       = @$sub_node->getAttribute('src_id');
                            $arr['src_file']     = @$sub_node->getAttribute('src_file');
                            $arr['application']  = @$sub_node->getAttribute('application');
                            $arr['bitrate']      = @$sub_node->getAttribute('bitrate');
                            $arr['bitrate_audio']= @$sub_node->getAttribute('bitrate_audio');
                            $arr['height']       = @$sub_node->getAttribute('height');
                            $arr['width']        = @$sub_node->getAttribute('width');
                            $arr['result']       = @$sub_node->getAttribute('result');
                            $arr['work_duration']= @$sub_node->getAttribute('work_duration');
                            $arr['end_time']     = @$sub_node->getAttribute('end_time');
                            $arr['start_time']   = @$sub_node->getAttribute('start_time');
                            $arr['add_time']     = @$sub_node->getAttribute('add_time');
                            $arr['status']       = @$sub_node->getAttribute('status');
                            $arr['error_des']    = @$sub_node->getAttribute('error_des');
                            $arr['encode_progress'] = @$sub_node->getAttribute('encode_progress');
                            
                            $arr_duties[] = $arr;
                        }
                        $this->assign("vers", $arr_duties);
			            $hasver = 1;
			        }
			    }
			    
			}

			file_put_contents('log.txt', "========== id:$id \n", FILE_APPEND);
			$this->assign("hasver", $hasver);
			$this->assign($array['show']);
			$this->assign($array['read']);
			$this->assign("id", $id);
			$this->display('video_detail');
		}else{
			$this->assign("jumpUrl",C('web_path'));
			$this->error('此影片已经删除或未开放,请选择观看其它节目！');
		}
    }
	//影片播放页
    public function play(){
		$id = $_GET['id'];
		file_put_contents('log.txt', "======= video play $id\n", FILE_APPEND);
		$where['id'] = $id;
		$where['status'] = array('eq',1);
		$rs = M("Video");
		$array   = $rs->where($where)->find();
		$playarr = explode('-',$where['id']);//ID与集数分隔
		if($array){            
		    
		    // the format is '|host|port|application|stream|format|ctype|'
            $url = $array['playurl'];
            
            $arr = explode("|",$url);
            $host = $arr[1];
            $port = $arr[2];
            $app = $arr[3];
            $stream = $arr[4];
            $format = $arr[5];
            $ctype = $arr[6];
            $ver = $_GET['ver'];
            
            $is_mobile = $_SESSION['is_mobile'];
            if($is_mobile == ""){
                $is_mobile = isMobile();
                $_SESSION['is_mobile'] = $is_mobile;
            }
            file_put_contents('log.txt', "====== is_mobile:$is_mobile \n", FILE_APPEND);
            file_put_contents('log.txt', "play... 111111111: $stream;$ctype;$app;$ver \n", FILE_APPEND);
            
            if($ver > 0){
                $ctype = "vod";
            }
            $array = $this->tags_video_read($array,$playarr);
            
           // $nodeList = $this->play_versions($app, $stream, "flv", 0, 1, "no");
            $nodeList = get_stream_versions($app, $stream, "flv", 0, 1, "no");
            $hasver = 0;
            if($nodeList !== FALSE){
                if($nodeList->length > 0){
                    $arr_duties = array();
                    for ($i = 0; $i < $nodeList->length; $i++)
                    {
                        $arr         = array();
                        $sub_node    = $nodeList->item($i);
                        $arr['src_id']       = @$sub_node->getAttribute('src_id');
                        $arr['src_file']     = @$sub_node->getAttribute('src_file');
                        $arr['application']  = @$sub_node->getAttribute('application');
                        $arr['bitrate']      = @$sub_node->getAttribute('bitrate');
                        $arr['bitrate_audio']= @$sub_node->getAttribute('bitrate_audio');
                        $arr['height']       = @$sub_node->getAttribute('height');
                        $arr['width']        = @$sub_node->getAttribute('width');
                        $arr['result']       = @$sub_node->getAttribute('result');
                        $arr['work_duration']= @$sub_node->getAttribute('work_duration');
                        $arr['end_time']     = @$sub_node->getAttribute('end_time');
                        $arr['start_time']   = @$sub_node->getAttribute('start_time');
                        $arr['add_time']     = @$sub_node->getAttribute('add_time');
                        $arr['status']       = @$sub_node->getAttribute('status');
                        $arr['error_des']    = @$sub_node->getAttribute('error_des');
                        $arr['encode_progress'] = @$sub_node->getAttribute('encode_progress');
                        $url = $arr['playurl'];
                        file_put_contents('log.txt', "=========== url:$url \n", FILE_APPEND);
            
                        $arr_duties[] = $arr;
                    }
                    $this->assign("vers", $arr_duties);
                    $hasver = 1;
                }
            }            
            
            file_put_contents('log.txt', "============ ctype:$ctype \n", FILE_APPEND);
            $this->assign("id", $id);
            $this->assign('hasver', $hasver);
            $this->assign($array['show']);
            $this->assign($array['read']);
            $this->assign('ctype', $ctype);
            $this->assign('app', $app);
            $this->assign('stream', $stream);
            $this->assign('host', $host);
            $this->assign('format', $format );
            $this->assign("port", $port);
            $this->assign('isMobile', $is_mobile);
			$this->display('video_play');
		}else{
		    file_put_contents('log.txt', "play... 2222222222\n", FILE_APPEND);
			$this->assign("jumpUrl",C('web_path'));
			$this->error('此影片已经删除或未开放,请选择观看其它节目！');
		}
    }
    
    public function applay(){
        $ns = $_REQUEST['ns'];
        $id = $_REQUEST['id'];
        $format = $_REQUEST['format'];
        $live = $_REQUEST['live'];
        $ver = $_REQUEST['ver'];
        
        
        file_put_contents('log.txt', "11v applay  $ns;$id;$live;$ver;$format \n", FILE_APPEND);
        $this->assign('ns', $ns);
        $this->assign('id', $id);
        $this->assign('live', $live);
        $this->assign('ver', $ver);
        $this->assign('format', $format);
        $this->display("fxplayer");
        
    }
    
	//处理评分
    public function score(){
		$where['id'] = intval($_GET['id']);
		if (!$where['id']) {
			exit('-1');
		}		
		$ajax   = intval($_GET['ajax'])*2;//前台是5分传入
		$cookie = 'movsc-'.$where['id'];
		if ($ajax && $_COOKIE[$cookie]) {
			exit('0');//重复
		}		
		$rs   = M("Video");
		$list = $rs->field('score,scoreer')->where($where)->find();
		if($list){
			if($ajax){
				$array['score']   = number_format(($list['score']*$list['scoreer']+$ajax)/($list['scoreer']+1),1);
				$array['scoreer'] = $list['scoreer']+1;
				$rs->where($where)->save($array);
				setcookie($cookie,'t',time()+intval(C('user_check_time')));
			}else{
				$array = $list;
			}
		}else{
			$array['score']   = 0.0;
			$array['scoreer'] = 0;
		}
		echo($array['score'].':'.$array['scoreer']);
    }
	//处理顶踩
    public function updown(){
		$id = intval($_GET['id']);
		if (!$id) {
			exit('-1');
		}
		$ajax   = trim($_GET['ajax']);
		$cookie = 'movud-'.$id;
		if($ajax && isset($_COOKIE[$cookie])){
			exit('0');//重复
		}
		$rs = M("Video");
		if ('up' == $ajax){
			$rs->setInc('up','id = '.$id);
			setcookie($cookie,'t',time()+intval(C('user_check_time')));
		}elseif( 'down' == $ajax){
			$rs->setInc('down','id = '.$id);
			setcookie($cookie,'t',time()+intval(C('user_check_time')));
		}
		$list = $rs->field('up,down')->find($id);
		if (empty($list)) {
			$list['up']   = 0;
			$list['down'] = 0;
		}
		echo($list['up'].':'.$list['down']);
    }	
	//影片下载
    public function down(){
		$this->display('video_down');
    }	
	//搜索提示
	public function searchSuggest()
	{
		$url = get_url_where();
		$search['title']   = array('like','%'.$url['wd'].'%');
		$rs = M('Video');
		$result = $rs->where($search)->field('id,cid,title')->limit('10')->select();
		$count	= 0;
		if ($result)
		{
			$count = count($result); 
			foreach($result as &$v)
			{
				$v['oldtitle']	=	$v['title'];
				$v['title']		=	str_replace($url['wd'],'<font color="#FF0000">'.$url['wd'].'</font>',$v['title']);
				$v['readurl']	=	get_read_url('video',$v['id'],$v['cid'],$v['jumpurl']);
				$v['tname']		=	get_channel_name($v['cid']);
			}
		}
		die(json_encode(array('result'=>$result,'c'=>$count)));
	}
	
	public function getChannelList(){
	    file_put_contents('log.txt', "=== getChannelList \n", FILE_APPEND);
	    $ctype = $_GET['ctype'];
	    file_put_contents('log.txt', "=== getChannelList $ctype \n", FILE_APPEND);
        $where['ctype'] = $ctype;
        $where['pid'] = 0;
        
        $cs = M('Channel');
        $channels = $cs->where($where)->select();
        
        /*
        for ($i = 0; $i < $channels->length; $i++){
            $c = $channels[$i];
            $ch['name'] = $c['name'];
            $ch['cfile'] = $c['cfile'];
            $ch['id'] = $c['id'];
        }
        */
        file_put_contents('log.txt', "=== getChannelList 22 \n", FILE_APPEND);
        $data = json_encode($channels);
        file_put_contents('log.txt', "=== getChannelList $data \n", FILE_APPEND);
        $this->ajaxReturn($data, '');
	}
	
	public function getSubChannelList(){
	    $pid = $_GET['pid'];
	    $where['pid'] = $pid;
	    $cs = M('Channel');
	    $channels = $cs->where($where)->select();
	    
	    $data = json_encode($channels);
	    $this->ajaxReturn($data, '', 1);
	}
	
	public function getLiveAppList(){
	    file_put_contents('log.txt', "============ getLiveAppList \n", FILE_APPEND);
	    $where['ctype'] = "live";
	    $where['ctpl'] = "video_list";
	    $rs = M('Channel');
	
	    file_put_contents('log.txt', "=== cid:$cid \n", FILE_APPEND);
	    $apps = $rs->field('id,cname,cfile')->where($where)->select();
	
	    $status = false;
	    
	    $count = count($apps);
	    if($count > 0){
	        $status = true;
	    }
	    $data = json_encode($apps);
	    $this->ajaxReturn($data, '', $status);
	}
	
	public function getLiveStreamList(){
	    file_put_contents('log.txt', "============ getLiveStreamList \n", FILE_APPEND);
	    $cid = $_GET['cid'];
	     file_put_contents('log.txt', "get cid:$cid \n", FILE_APPEND);
	    $where["cid"] = $cid;
	    $ts = M('Video');
	    $sts = $ts->field('id,title,picurl,playurl')->where($where)->select();
	     
	    $count = count($sts);

	    $data = json_encode($sts);
	    $status = false;

	    if($count > 0){
	        $status = true;
	    }	    
	    
	    $this->ajaxReturn($data, '', $status);
	}

}
?>