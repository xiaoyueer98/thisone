<?php
/**
 * Created by PhpStorm.
 * User: lx
 * Date: 2016/9/2
 * Time: 9:58
 */
ini_set("display_errors", "On");
error_reporting(E_ALL);
class MycenterAction extends HomeAction{
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
        $logtime=$arr['logtime'];
        $email=$arr['email'];
        $status=$arr['status'];
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
        /*
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
                */
        $this->assign('list_video',$list_video);
        $this->assign('arr',$arr);
        $this->assign('email',$email);
        $this->assign('status',$status);
        $this->assign('logtime',$logtime);
//        $this->assign('pages',$listpages['listpages']);
        $this->display("new/mycare");
    }

    //我的直播、点播
    public function personal_my(){
        $arr1 = $this->checklogin();
        $uid = $arr1['id'];
        $logtime=$arr1['logtime'];
        $email=$arr1['email'];
        $status=$arr1['status'];
        $ctype = $_REQUEST['type'];
        file_put_contents('log.txt', "personal_my id:$uid\n", FILE_APPEND);
        $where['uid'] = $uid;
        $where['ctype'] = $ctype;


        $list=M('mycenter')->where($where)->select();
        $arr=array();
        $count = count($list);
        for($i=0;$i<count($list);$i++){
            $arr[$i]=$list[$i]['vid'];
        }
        $arr = array(1577,1578,1579);
        $vod_video=M("video")->where(array('id'=>array('IN',$arr)))->select();
        $count = count($vod_video);
        file_put_contents('log.txt', "video count:$count\n", FILE_APPEND);
        $this->assign('list_video',$vod_video);
        $this->assign('logtime',$logtime);
        $this->assign('email',$email);
        $this->assign('status',$status);
        if($ctype=='live'){
            $this->display("new/personal_mylive");
        }else{
            $this->display("new/personal_myvod");
        }
    }

    //设置资料
    public function reset(){
        $list = $this->checklogin();
        $id=$list[id];
        $email=$list[email];
        $status=$list[status];
        $username=$list[username];
        $this->assign("id",$id);
        $this->assign("username",$username);
        $this->assign("email",$email);
        $this->assign("status",$status);
        $this->display("new/reset");
    }
    //更新资料
    public function updateinfo(){
        if(isset($_POST['submit'])){
            $where['id']=$_POST['id'];
            $user['username']=$_POST['username'];
            $user['email']=$_POST['email'];
            if(M("user")->where($where)->save($user)){
                echo "<script>alert('修改成功！');</script>";
                $this->display('user_login');
            }else{
                echo "<script>alert('修改失败！');</script>";
                $this->display('edit');
            }
        }
    }
    //修改密码展示页
    public function repwd()
    {
        $this->display("new/repwd");
    }
    //修改密码
    public function modifypwd(){
        $list = $this->checklogin();
        $where['id']=$list[id];
        $userpwd=md5($_POST['userpwd']);
        if($userpwd!=$list['userpwd']){
            echo"您输入的密码不正确，请重新输入！";
        }
        $userpwd1=$_POST['userpwd1'];
        $userpwd2=$_POST['userpwd2'];
        if($userpwd1!=$userpwd2){
            echo "您两次输入的密码不一致，请重新输入！";
        }
        $arr=M("user")->where($where)->setField('userpwd',$userpwd1);
        if(empty($arr)){
            $this->redirect('Mycenter/setpwd',array('id'=> $where),1,'修改密码失败，请重新修改...');
        }else{
            $this->redirect('Index/index',array('id'=> $where),1,'密码修改成功，请重新登录...');
        }


    }
    //创建直播
    public function createlive(){

        /*
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
        */
        $arr = $this->checklogin();
        $logtime=$arr['logtime'];
        $email=$arr['email'];
        $status=$arr['status'];
        $type = $_REQUEST['type'];
        file_put_contents('log.txt', "type:$type \n", FILE_APPEND);
        $where['id'] = $_GET['id'];
        $con['pid'] = '1';
        $con['ctype'] = "live";
        $list_channel_video = M('Channel')->where($con)->select();
        $channel_id = $list_channel_video[0]['id'];
        $tid = $_REQUEST['tid'];
        if(!get_channel_son($channel_id)){
            $con['pid'] = $channel_id;
            $c = M('channel');
            $son = $c->where($con)->select();
            $subid = $son[0]['id'];
        }else{
            $con['pid'] = get_channel_sqlin($channel_id);
            $subid = 0;
        }

        if(($tid == null) || ($tid == "")){
            $tid = randonumkeys(8);   /// a temp id for auth
        }
        $array['addtime']  = time();
        $array['starttime'] = time();
        $array['endtime'] = time() + 60*30;

        $array['inputer']  = $_SESSION['user'];
        $this->assign('logtime', $logtime);
        $this->assign('email', $email);
        $this->assign('status', $status);
        $this->assign('channel_id', $channel_id);
        $this->assign('subid', $subid);
        $this->assign('list_channel_video',$list_channel_video);
        $this->assign($array);

        $this->display("new/create_live");

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
        /*
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
        */
        $arr = $this->checklogin();
        $logtime=$arr['logtime'];
        $email=$arr['email'];
        $status=$arr['status'];
        $type = $_REQUEST['type'];
        file_put_contents('log.txt', "type:$type \n", FILE_APPEND);
        $where['id'] = $_GET['id'];
        $con['pid'] = '2';
        $con['ctype'] = "vod";
        $list_channel_video = M('Channel')->where($con)->select();

        if($_GET['cid']){
            $array['cid'] = intval($_GET['cid']);
        }else{
            $array['cid'] = cookie('video_cid');
        }

        $array['addtime']  = time();
        $array['inputer']  = $_SESSION['user'];
        $array['checktime']= 'checked';

        $channel_id = $list_channel_video[0]['id'];
        if(!get_channel_son($channel_id)){
            $con['pid'] = $channel_id;
            $c = M('channel');
            $son = $c->where($con)->select();
            $subid = $son[0]['id'];
        }else{
            $con['pid'] = get_channel_sqlin($channel_id);
            $subid = 0;
        }

        $array['inputer']  = $_SESSION['user'];
        $this->assign('logtime', $logtime);
        $this->assign('email', $email);
        $this->assign('status', $status);
        $this->assign('channel_id', $channel_id);
        $this->assign('subid', $subid);
        $this->assign('list_channel_video',$list_channel_video);
        $this->assign($array);

        $this->display("new/create_vod");
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
            $this->del($val);
        }
        redirect($_SESSION['video_reurl']);
    }

    public function del(){
        $list = $this->checklogin();
        $where['vid']=$_GET['id'];
        $row=M('Mycenter')->where($where)->delete();
        if($row==0){
            redirect('Mycenter/mycare',array('id'=>$list),1,'删除失败...');
        }else{
            redirect('Mycenter/mycare',1,'删除成功...');
        }

    }

    public function uploadfile()
    {
//        var_dump($_REQUEST);
        error_reporting(E_ALL | E_STRICT);
        import('ORG.Util.Uploadhandler');
        $upload_handler = new UploadHandler();
    }
}