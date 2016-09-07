<?php
/**
 * Created by PhpStorm.
 * User: lx
 * Date: 2016/9/2
 * Time: 9:58
 */
class MycenterAction1 extends HomeAction{
    private $VideoDB;
    private $UserDB;
    private $MycenterDB;
    private $VideoplaywhiteDB;
    private $VideopushwhiteDB;

    public function checklogin(){
        $userid   = intval($_COOKIE['gx_userid']);
        $username = $_COOKIE['gx_username'];
        $userpwd  = $_COOKIE['gx_userpwd'];
        if ($userid) {
            $rs = M("User");
            $where['id'] = array('eq',$userid);
            $list = $rs->where($where)->find();
            if(($username == $list['username'])&&($userpwd == $list['userpwd'])){
                return $list;
            }
        }
        $this->assign("jumpUrl",'index.php?s=User/Login');
        $this->error('登陆超时或未登陆,请重新登陆!');
    }

    //我的关注
    public function mycare(){
        $arr = $this->checklogin();
        $where['uid'] = $arr['id'];//用户id
        $result=$_COOKIE['gxhis'];
        $result=explode('/id/',$result);
        $arr_id=array();
        for ($i=1;$i<count($result);$i++){
            $voide_ar=explode('/ver/',$result[$i]);
            if(count($voide_ar)>1){
                $arr_id[$i]=$voide_ar[0];
            }
        }
        $a=array_values($arr_id);
        $list_video=array();
        for($i=0;$i<count($a);$i++) {
            $where['vid']=$a[$i];//用户观看的视频的id
            $list=$this->VideoDB-->where($where)->find();
            $list_video[$i]=$list;
        }
//        if(empty($list_video)){
//            echo "您没有关注的视频！";
//        }
//        $video_count = $this->MycenterDB->where($where)->count('vid');//查找该用户所观看视频的数量
//        $video_page  = !empty($_GET['p'])?$_GET['p']:1;$video_page = intval($video_page);
//        $video_url   = U('User/Myvod',array('p'=>''),false,false);
//        $listpages     = get_cms_page($video_count,C('user_page_cm'),$video_page,$video_url,'条视频',false);
        $list_video = array (
            0 =>
                array (
                    'id' => '1590',
                    'cid' => '42',
                    'title' => 'CCTVNEWS',
                    'intro' => '',
                    'keywords' => '',
                    'color' => '#FF0000',
                    'actor' => '',
                    'director' => '',
                    'content' => '',
                    'picurl' => 'video/20160220/cctvnewstv.jpg',
                    'area' => '中国',
                    'language' => '国语',
                    'year' => '2000',
                    'serial' => '0',
                    'addtime' => '1455855436',
                    'hits' => '46',
                    'monthhits' => '3',
                    'weekhits' => '1',
                    'dayhits' => '1',
                    'hitstime' => '1463888742',
                    'stars' => '2',
                    'status' => '1',
                    'up' => '0',
                    'down' => '0',
                    'playurl' => '|58.200.131.2|1935|livetv|cctv16|flv|live|',
                    'downurl' => '',
                    'inputer' => 'admin',
                    'reurl' => '',
                    'letter' => 'C',
                    'score' => '0.0',
                    'scoreer' => '1',
                    'genuine' => '0',
                    'vodplay' => '0',
                    'stype_mcid' => '0',
                    'selftitle' => '',
                    'selfkeywords' => '',
                    'selfdescription' => '',
                    'starttime' => '0',
                    'endtime' => '0',
                    'level' => '1',
                    'ctype' => 'tv',
                ),
            1 =>
                array (
                    'id' => '1589',
                    'cid' => '42',
                    'title' => '香港卫视',
                    'intro' => '',
                    'keywords' => '',
                    'color' => '#FF0000',
                    'actor' => '',
                    'director' => '',
                    'content' => '',
                    'picurl' => 'video/20160220/xianggangweishi.jpg',
                    'area' => '中国',
                    'language' => '国语',
                    'year' => '2000',
                    'serial' => '0',
                    'addtime' => '1455855436',
                    'hits' => '109',
                    'monthhits' => '2',
                    'weekhits' => '2',
                    'dayhits' => '2',
                    'hitstime' => '1471941637',
                    'stars' => '4',
                    'status' => '1',
                    'up' => '0',
                    'down' => '0',
                    'playurl' => '|||fxtv|hktv|flv|live|',
                    'downurl' => '',
                    'inputer' => 'admin',
                    'reurl' => '',
                    'letter' => 'X',
                    'score' => '10.0',
                    'scoreer' => '1',
                    'genuine' => '0',
                    'vodplay' => '0',
                    'stype_mcid' => '0',
                    'selftitle' => '',
                    'selfkeywords' => '',
                    'selfdescription' => '',
                    'starttime' => '0',
                    'endtime' => '0',
                    'level' => '1',
                    'ctype' => 'tv',
                ),
            2 =>
                array (
                    'id' => '1587',
                    'cid' => '42',
                    'title' => 'CCTV-9',
                    'intro' => '',
                    'keywords' => '',
                    'color' => '',
                    'actor' => '',
                    'director' => '',
                    'content' => '',
                    'picurl' => 'video/20160220/beijingtv.jpg',
                    'area' => '中国',
                    'language' => '国语',
                    'year' => '2000',
                    'serial' => '',
                    'addtime' => '1455855398',
                    'hits' => '42',
                    'monthhits' => '1',
                    'weekhits' => '1',
                    'dayhits' => '1',
                    'hitstime' => '1471941647',
                    'stars' => '3',
                    'status' => '1',
                    'up' => '0',
                    'down' => '0',
                    'playurl' => '|||fxtv|CCTV-9|flv|live|',
                    'downurl' => '',
                    'inputer' => 'admin',
                    'reurl' => '',
                    'letter' => 'C',
                    'score' => '10.0',
                    'scoreer' => '1',
                    'genuine' => '0',
                    'vodplay' => '0',
                    'stype_mcid' => '0',
                    'selftitle' => '',
                    'selfkeywords' => '',
                    'selfdescription' => '',
                    'starttime' => '0',
                    'endtime' => '0',
                    'level' => '1',
                    'ctype' => 'tv',
                ),

        );
        $this->assign('list_video',$list_video);
//        $this->assign('pages',$listpages['listpages']);
        $this->display("/new/Personal_Center");
    }

    //我的直播、点播
    public function personal_my(){
        $arr = $this->checklogin();
        $where['uid'] = $arr['id'];
        $where['ctype'] = $_REQUEST['type'];
        if($where['type']=='live'){
            $list=M('mycenter')->where($where)->select();
            $arr=array();
            for($i=0;$i<count($list);$i++){
                $arr['id']=$list['vid'];
            }
            $live_video=$this->VideoDB->where($arr)->select();
            $this->assign('list_video',$live_video);
            $this->display();
        }else{
            $list=M('mycenter')->where($where)->select();
            $arr=array();
            for($i=0;$i<count($list);$i++){
                $arr['id']=$list[$i]['vid'];
            }
            $vod_video=M("video")->where($arr)->select();
            $this->assign('list_video',$vod_video);
//            echo "<pre>";var_dump($vod_video);echo "</pre>";
            $this->display("/new/on_demand");
        }


    }

    //设置资料
    public function reset(){
        $list = $this->checklogin();
        $id=$list[id];
        $email=$list[email];
        $username=$list[username];
        $this->assign("id",$id);
        $this->assign("username",$username);
        $this->assign("email",$email);
        $this->display("new/Modify_data");
    }
    //更新资料
    public function updateinfo(){
        if(isset($_POST['submit'])){
            $where['id']=$_POST['id'];
            $user['username']=$_POST['username'];
            $user['email']=$_POST['email'];
            $user['userpwd']=md5($_POST['userpwd']);
            if(M("user")->where($where)->save($user)){
                echo "<script>alert('修改成功！');</script>";
                $this->display('user_login');
            }else{
                echo "<script>alert('修改失败！');</script>";
                $this->display('edit');
            }
        }
    }

    //创建直播
    public function createlive(){

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
    public function _before_insertlive(){
        $uid   = intval($_COOKIE['gx_userid']);
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
        $data['roompwd']=$_POST['roompwd'];
        $tid = $_POST['tid'];
        $data['roompwd']=$_POST['roompwd'];//房间密码
        $data['uid']   = intval($_COOKIE['gx_userid']);
        file_put_contents('log.txt', "_after_insertlive id:$id; tid:$tid \n", FILE_APPEND);
        $data['vid'] = $id;
        $data['status'] = 1;
        $data['ctype'] = "live";
        $this->MycenterDB->add($data);
        $this->VideoplaywhiteDB->where('vid='.$tid)->save($data);
        $this->VideopushwhiteDB->where('vid='.$tid)->save($data);

        cookie('video_cid',intval($_POST["cid"]));
        $this->success('直播添加成功,继续添加新视频！');
    }

    //创建点播
    public function createvod(){
        $this->_before_insert();
        if ($this->VideoDB->create()) {
            if (false!==$this->VideoDB->save()) {
                $this->assign("jumpUrl",$_SESSION['video_reurl']);
            }else{
                $this->error("点播视频添加失败!");
            }
        }else{
            $this->error($this->VideoDB->getError());
        }
    }
    public function _before_insertvod(){
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



        $this->weiRepalce();//伪原创
        $this->replaceKey();//更新内链接替换
        //print_r($_POST['vodplay']);exit;
    }
    // 新增视频保存到数据库
    public function insertvod(){
        file_put_contents('log.txt', "=-=-=-=-=- insert\n", FILE_APPEND);
        if($this->VideoDB->create()){
            $id = $this->VideoDB->add();
            $data['ctype'] = "vod";
            $data['vid'] = $id;
            $data['uid ']= intval($_COOKIE['gx_userid']);
            if(false==$this->MycenterDB->add($data)){
                $this->error('视频添加失败!');
            }
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
    public function _after_insertvod(){
        file_put_contents('log.txt', "=-=-=-=-=- _after_insert\n", FILE_APPEND);
        cookie('video_cid',intval($_POST["cid"]));
        $this->success('视频添加成功,继续添加新视频！');
    }

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

    public function delfile($id){
        M("video_play_white_list")->where('vid='.$id)->delete();
        M("video_push_white_list")->where('vid='.$id)->delete();

        //删除静态文件
        $array = M("video")->field('id,cid,picurl,title,playurl')->where('id = '.intval($id))->find();
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
        M("video")->where($where)->delete();
        unset($where);
        //删除观看主录
        $where['did'] = $id;
        M("user_view")->where($where)->delete();
        unset($where);
        //删除相关评论
        $where['did'] = $id;
        $where['mid'] = 1;
        M("comment")->where($where)->delete();
    }

    public function del(){
        $this->delfile($_GET['id']);
        redirect($_SESSION['video_reurl']);
    }


}