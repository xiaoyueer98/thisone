<?php
/**
 * Created by PhpStorm.
 * User: lx
 * Date: 2016/9/2
 * Time: 9:58
 */
//ini_set("display_errors", "On");
//error_reporting(E_ALL);
class MycenterAction extends HomeAction{
    private $VideoDB;
    private $UserDB;
    private $MycenterDB;
    private $VideoplaywhiteDB;
    private $VideopushwhiteDB;


    public function get_uid_by_email($email){
        $UserDB = M('user');
        $where['email'] = $email;
        $user = $UserDB->where($where)->find();
        return $user['id'];
    }
    
    public function get_app_by_cid($cid){
        $Channel = M('channel');
        $where['id'] = $cid;
        $cn = $Channel->where($where)->find();
        return $cn['cfile'];
    }
    
    public function get_file_name($playurl){
        $name = explode("/", $playurl);
        $count = count($name);
        return $name[$count - 1];
    }

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
       // $this->assign('list_video', $vod_video);
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
        $VideoDB = M('video');
        for($i=0;$i<count($a);$i++) {
            $where['vid']=$a[$i];//用户观看的视频的id
            $list=$VideoDB->where($where)->find();
            $list_video[$i]=$list;
        }


//        if(empty($list_video)){
//            echo "您没有关注的视频！";
//        }
//        $video_count = $this->MycenterDB->where($where)->count('vid');//查找该用户所观看视频的数量
//        $video_page  = !empty($_GET['p'])?$_GET['p']:1;$video_page = intval($video_page);
//        $video_url   = U('User/Myvod',array('p'=>''),false,false);
//        $listpages     = get_cms_page($video_count,C('user_page_cm'),$video_page,$video_url,'条视频',false);
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
            $list=M("user")->where($user)->find();
            if(!empty($list)){
                echo "该用户名已经存在，请重新输入！";
            }
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
        $arr = $this->checklogin();
        $logtime=$arr['logtime'];
        $email=$arr['email'];
        $username=$arr['username'];
        $status=$arr['status'];
        $type = $_REQUEST['type'];
        file_put_contents('log.txt', "type:$type \n", FILE_APPEND);
        $where['id'] = $_GET['id'];
        //$con['pid'] = '1';
        $con['pid'] = array('neq',0);
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
        $this->assign('username', $username);
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
        $cid = $_POST['type'];
        $where['id'] = $cid;
        $channel = $c->where($where)->find();
        $app = $channel['cfile'];

        
        $_POST['playurl'] = "|". $_SERVER['HTTP_HOST']."||".$app.'|'.randomkeys(16).'|flv|live|';
        $_POST['vodplay'] = empty($_POST['vodplay']) ? 0 : implode('$$$$$$', $_POST['vodplay']);
        $vodplay = $_POST['vodplay'];

        file_put_contents('log.txt', "=-=-=-=-=- vodplay:$vodplay\n", FILE_APPEND);
        $_POST['cid'] = $_POST['type'];
        file_put_contents('log.txt', "=-=-=-=-=- cid:$cid\n", FILE_APPEND);

        if (strpos($_POST['picurl'],'://') > 0) {
            $down = D('Down');
            $_POST['picurl']= $down->down_img(trim($_POST['picurl']));
            $picUrl = $_POST['picurl'];
        }
        
        $stime = $_POST['starttime'];
        $etime = $_POST['endtime'];
        $_POST['starttime'] = strtotime($stime);
        $_POST['endtime'] = strtotime($etime);

        $_POST['stype_mcid'] = empty($_POST['stype_mcids']) ? 0 : implode(',', $_POST['stype_mcids']);
    }

    public function insertlive(){

        file_put_contents('log.txt', "insertlive....... \n", FILE_APPEND);
        $VideoDB = M('video');
        $data['title'] = $_POST['title'];
        $data['cid'] = $_POST['cid'];
        $data['intro'] = $_POST['intro'];
        $data['actor'] = $_POST['zhuchi'];
        $data['ctype'] = $_POST['ctype'];
        $data['playurl'] = $_POST['playurl'];
        $data['picurl'] = $_POST['picurl'];
        $data['addtime'] = time();
        $data['starttime'] = $_POST['starttime'];
        $data['endtime'] = $_POST['endtime'];
        $data['status'] = $_POST['display'];
        $limit['id']=$_POST['vid'];
        $MycenterDB = M('mycenter');
        if(empty($_POST['vid'])) {

            file_put_contents('log.txt', "title:" . $data['title'] . ";cid:" . $data['cid'] . ";intro:" . $data['intro'] . ";ctype:" . $data['ctype'] . "\n", FILE_APPEND);
            file_put_contents('log.txt', "playurl:" . $data['playurl'] . ";picurl:" . $data['picurl'] . ";addtime:" . $data['addtime'] . ";starttime:" . $data['starttime'] . ";endtime:" . $data['endtime'] . "\n", FILE_APPEND);
            $id = $VideoDB->add($data);
            if ($id !== false) {
                $email = $_POST['email'];

                $uid = $this->get_uid_by_email($email);
                file_put_contents('log.txt', "insert live uid:$uid\n", FILE_APPEND);

                $data1['ctype'] = "live";
                $data1['vid'] = $id;
                $data1['uid'] = $uid;
                $data1['roompwd'] = $_POST['room_num'];
                $result = $MycenterDB->add($data1);
                if (false == $result) {
                    $where['id']=$id;
                    $VideoDB->where($where)-delete();
                    $this->error('直播添加失败!');
                    $this->assign("jumpUrl", C('cms_admin') .'?s=Mycenter/createlive');
                }else{
                    $this->success('直播添加成功！');
                    $this->assign("jumpUrl",C('cms_admin').'?s=Mycenter/createlive');
                }
            }
        }else{
            //编辑视频
            $limit2['vid']=$_POST['vid'];
            $result3=$VideoDB->where($limit)->save($data);
            if(false!==$result3 ){
                $data1['roompwd'] = $_POST['room_num'];
                $result2=$MycenterDB->where($limit2)->save($data1);
                $this->success('编辑视频成功！');
                $this->assign("jumpUrl",C('cms_admin').'?s=Mycenter/updateplayinfo');
            }else{
                $this->error('编辑视频失败,请重新填写!');
                $this->assign("jumpUrl",C('cms_admin').'?s=Mycenter/updateplayinfo');
            }
        }
    }

    // 新增视频保存到数据库-后置操作
//    public function _after_insertlive(){
//       // echo "ssssssssssss";die();
//        file_put_contents('log.txt', "_after_insertlive id:$id; tid:$tid \n", FILE_APPEND);
//
//        cookie('video_cid',intval($_POST["cid"]));
//        $this->success('直播添加成功,继续添加新视频！');
//    }

    //创建点播
    public function createvod(){

        $arr = $this->checklogin();
        $logtime=$arr['logtime'];
        $email=$arr['email'];
        $status=$arr['status'];
        $type = $_REQUEST['type'];
        file_put_contents('log.txt', "email:$email;type:$type \n", FILE_APPEND);
        $where['id'] = $_GET['id'];
        $con['pid'] = array('neq',0);
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
        $this->assign('email', $email);
        $this->assign($array);

        $this->display("new/create_vod");
    }

    public function _before_insertvod(){
        file_put_contents('log.txt', "=-=-=-=-=- _before_insert\n", FILE_APPEND);
        $_POST['level'] = $_POST['userlevel'];

        $title = $_POST['title'];
        $cid = $_POST['cid'];
        $picUrl = $_POST['picurl'];
        $upload2 = $_POST['upload2'];
        $converse = $_POST['converse'];
        $down_power = $_POST['down_power'];
        $intro = $_POST['intro'];
        $_POST['ctype'] = "vod";
        $display = $_POST['display'];
        $playurl = $_POST['playurl'];
        $src_id = $_POST['src_id'];
        
        file_put_contents('log.txt', "src_id:".$src_id."\n", FILE_APPEND);
        $tid = 6;    //default;
        if($converse == 1){
            $tid = 6;
        }else if($converse == 2){
            $tid = 4;
        }else if($converse == 3){
            $tid = 1;
        }

        $_POST['tid'] = $tid;
        file_put_contents('log.txt', "picurl:$picUrl\n", FILE_APPEND);
        file_put_contents('log.txt', "playurl:$playurl\n", FILE_APPEND);
        if (strpos($_POST['picurl'],'://') > 0) {
            $down = D('Down');
            $_POST['picurl']= $down->down_img(trim($_POST['picurl']));
            $picUrl = $_POST['picurl'];
        }

        if($down_power == 1){
            $_POST['downurl'] = $_POST['picurl'];
        }

        $src_name = $this->get_file_name($playurl);
        $host = $_SERVER['HTTP_HOST'];
        $port = $_SERVER['HTTP_PORT'];
        $app_info = $this->get_app_by_cid($cid);
      //  $stream = randomkeys(16);
        $playurl = "|".$host."|".$port."|".$app_info."|".$src_id."|flv|vod|";
        $_POST['playurl'] = $playurl;
        
        file_put_contents('log.txt', "display:$display;name:$title;type:$cid;picurl:$picUrl;upload2:$upload2;converse:$converse;down_power:$down_power;intro:$intro\n", FILE_APPEND);
        $down_power = $_POST['down_power'];
        
        $vodplay = $_POST['vodplay'];

        file_put_contents('log.txt', "=-=-=-=-=- vodplay:$vodplay\n", FILE_APPEND);
        $_POST['cid'] = $cid;
        $cid = $_POST['cid'];
        file_put_contents('log.txt', "=-=-=-=-=- cid:$cid\n", FILE_APPEND);


        //   $_POST['stype_mcid'] = empty($_POST['stype_mcids']) ? 0 : implode(',', $_POST['stype_mcids']);



        //  $this->weiRepalce();//伪原创
        //  $this->replaceKey();//更新内链接替换
        //print_r($_POST['vodplay']);exit;
    }
    // 新增视频保存到数据库
    public function insertvod(){
        file_put_contents('log.txt', "=-=-=-=-=- insert vod\n", FILE_APPEND);
        $arr=$this->checklogin();
        $VideoDB = M('video');
        $data['title'] = $_POST['title'];
        $data['cid'] = $_POST['cid'];
        $data['intro'] = $_POST['intro'];
        $data['ctype'] = $_POST['ctype'];
        $data['playurl'] = $_POST['playurl'];
        $data['picurl'] = $_POST['picurl'];
        $data['addtime'] = time();
        $data['status'] = $_POST['display'];
        $data['downurl'] = $_POST['downurl'];
        $data['tid'] =  $_POST['tid'];
        
        $vid = $_POST['vid'];
        
        file_put_contents('log.txt', "tttt tid:".$data['tid']."\n", FILE_APPEND);
        $MycenterDB=M('Mycenter');
        if($vid){
            $where['id'] = $vid;
            $id = $VideoDB->where($where)->save($data);
            if(false!== $id){
                $this->success('成功修改视频信息！');
                $this->assign("jumpUrl",C('cms_admin').'?s=Mycenter/updateplayinfo');
            }else{
                $this->success('修改视频信息失败，请重新修改！');
                $this->assign("jumpUrl",C('cms_admin').'?s=Mycenter/updateplayinfo');
            }
        }else{
            $id = $VideoDB->add($data);
            if(false!== $id){
                $data1['uid']=$arr['id'];
                $data1['vid']=$id;
                $data1['ctype']=$_POST['ctype'];
                $result2=$MycenterDB->add($data1);
                if($result2){
                    $this->success('视频添加成功！');
                    $this->assign("jumpUrl",C('cms_admin').'?s=Mycenter/createvod');
                }else{
                    $this->success('视频添加失败，请返回重新添加！');
                    $this->assign("jumpUrl",C('cms_admin').'?s=Mycenter/createvod');
                }
            }else{
                $this->success('视频添加失败，请返回重新添加！');
                $this->assign("jumpUrl",C('cms_admin').'?s=Mycenter/createvod');
            }
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
        $type = $_GET['type'];
        $this->delfile($_GET['id']);
        $this->assign('type', $type);
        $this->personal_my();
    }
    
    // 删除静态文件与图片
    public function delfile($id){
        //删除静态文件
        $VideoDB = M("video");
        $array = $VideoDB->field('id,cid,picurl,title,playurl')->where('id = '.intval($id))->find();
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
        unset($where);
        $where['id'] = $id;
        $VideoDB->where($where)->delete();
        unset($where);
        //删除观看主录
        $UserVDB = M('userview');
        $where['did'] = $id;
        $UserVDB->where($where)->delete();
        unset($where);
        //删除相关评论
        $CommDB = M('comment');
        $where['did'] = $id;
        $where['mid'] = 1;
        $CommDB->where($where)->delete();
        unset($where);
        //删除我的记录
        $MyCenter = M('mycenter');
        $where['vid'] = $id;
        $MyCenter->where($where)->delete();
    }

    /**
     * 上传图片和视频方法
     */
    public function uploadfile()
    {
//        var_dump($_REQUEST);
        error_reporting(E_ALL | E_STRICT);
        import('ORG.Util.Uploadhandler');
        $upload_handler = new UploadHandler();
    }

    //修改直播和修改点播页面
    public function updateplayinfo(){
        $arr = $this->checklogin();
        $logtime=$arr['logtime'];
        $email=$arr['email'];
       // $status=$arr['status'];
        $vid = $_REQUEST['vid'];
        $type = $_REQUEST['type'];
        if(empty($vid) || empty($type))
        {
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
        $where['id'] = $vid;
        $where['ctype'] = $type;
        $video = M('video')->where($where)->find();
        if(empty($video))
        {
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
        
        $cid = $video['cid'];
        $downurl = $video['downurl'];
        $display = $video['status'];
        $picurl=$video['picurl'];
        $actor=$video['actor'];
        $tid = $video['tid'];
        if(($tid >= 1) && ($tid <= 3)){
            $tid = 3;
        }else if(($tid > 3) && ($tid <= 5)){
            $tid = 2;
        }else{
            $tid = 1;
        }
        $limit['vid']=$vid;
        $list=M('mycenter')->where($limit)->find();
        $roompwd=$list['roompwd'];
        $con['pid'] = array('neq',0);
        $con['ctype'] = "vod";
        
        file_put_contents('log.txt', "display:$display; tid:$tid\n", FILE_APPEND);
        $list_channel_video = M('Channel')->where($con)->select();
        $this->assign('logtime', $logtime);
        $this->assign('actor', $actor);
        $this->assign('roompwd', $roompwd);
        $this->assign('email', $email);
        $this->assign('display', $display);
        $this->assign($video);
        $this->assign('picurl',$picurl);
        $this->assign("list_channel_video", $list_channel_video);
        $this->assign('vid', $vid);
        $this->assign('cid', $cid);
        $this->assign('tid', 2);
        $this->assign('downurl', $downurl);
        
        file_put_contents('log.txt', "type:$type\n", FILE_APPEND);
        if($type == "vod")
        {
            $this->display("new/update_vod");
        } else
        {
            $this->display("new/update_live");
        }

    }

    public function onlive()
    {
        $arr = $this->checklogin();
//        echo "<pre>";var_dump($arr);echo "</pre>";
        $username = $arr['username'];
        $userpwd = $_SESSION['force_userpwd'];
        $vid = $_REQUEST['vid'];
        $type = "live";
        if(empty($vid) || empty($type))
        {
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
        $where['id'] = $vid;
        $where['ctype'] = $type;
        $video = M('video')->where($where)->select();
        $str= M('video')->where($where)->getField('playurl');
        //$str="|103.231.69.228||uploadvod|ui6egjjol8s7b32r|flv|vod|";
        $play=explode('|',$str);
        $videoplayurl=$play['1'].'/'.$play['3'].'/'.$play['4'];
        if(empty($video))
        {
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
        $this->assign('username', $username);
        $this->assign('userpwd', $userpwd);
        $this->assign('videoplayurl', $videoplayurl);
        $this->assign($video[0]);

        $this->display("new/currentLive");
    }
    
    public function group_chat(){
        $this->display("new/chat");
    }
    
    public function transcode_do(){
        $filename = $_REQUEST['filename'];
        $cid = $_REQUEST['cid'];
        $converse = $_REQUEST['converse'];
        file_put_contents('log.txt', "filename:$filename;cid:$cid;converse:$converse \n", FILE_APPEND);
        $tid = 6;    //default;
        if($converse == 1){
            $tid = 6;
        }else if($converse == 2){
            $tid = 4;
        }else if($converse == 3){
            $tid = 1;
        }
        
        $t = M('transcode_info');
        $where['id'] = $tid;
        file_put_contents('log.txt', "tid:$tid\n", FILE_APPEND);
        $transcode_info = $t->where($where)->find();
        $video_bitrate = $transcode_info['video_bitrate'];
        $audio_bitrate = $transcode_info['audio_bitrate'];
        $width = $transcode_info['width'];
        $height = $transcode_info['height'];
        
        file_put_contents('log.txt', "v_bit:$video_bitrate;a_bit:$audio_bitrate;w:$width;h:$height\n", FILE_APPEND);
        
        $ret = check_login();
        file_put_contents('log.txt', "transcode_do 111......\n", FILE_APPEND);
        if($ret == false){
            file_put_contents('log.txt', "transcode_do 222......\n", FILE_APPEND);
            header("Location: ../auth/right_error.html?error=notauthorized");
        }else{
            $_SESSION['mstoken'] = $ret;
        }
        
        $app_info = $this->get_app_by_cid($cid);
        $src_id = randomkeys(16);
        
        $media_host = C('mserver_url');
        $webpath = C('web_path');
        $querystr = "application=$app_info&src=$filename&src_id=$src_id&video_bitrate=$video_bitrate&audio_bitrate=$audio_bitrate&width=$width&height=$height&token=$ret";
        $url      = "http://".$media_host."/mserver/interface/transcode/?app=transcode&".$querystr;
        $ret = transcode($url);
        if($ret !== true){
            file_put_contents('log.txt', "ret:$ret \n", FILE_APPEND);
        } 
        
        $data['status'] = 'success';
        $data['src_id'] = $src_id;
        $this->ajaxReturn($data);
    }
    
    public function transcode_percent(){
        $src_id = $_REQUEST['src_id'];
        file_put_contents('log.txt', "src_id:$src_id \n", FILE_APPEND);
        
        $media_host = C('mserver_url');
        $ret = check_login();
        if($ret == false){
            header("Location: ../auth/right_error.html?error=notauthorized");
        }else{
            $_SESSION['mstoken'] = $ret;
        }
        
        $done_stream_array = get_duty_array("done", $ret);
        $count = count($done_stream_array);
        
        for($i = 0; $i < $count; $i++){
            if($src_id == $done_stream_array[$i]['src_id']){
                $transcode['src_id'] = $src_id;
                $transcode['percent'] = 100;
                $transcode['status'] = 'done';
                file_put_contents('log.txt', "done percent:100\n", FILE_APPEND);
                $this->ajaxReturn($transcode);
                return;
            }
        }
        
        unset($count);
        
        $waiting_stream_array = get_duty_array("waiting", $ret);
        $count = count($waiting_stream_array);
        for($i = 0; $i < $count; $i++){
            if($src_id == $waiting_stream_array[$i]['src_id']){
                $transcode['src_id'] = $src_id;
                $percent = $waiting_stream_array[$i]['encode_progress'];
                $percent = substr($percent, 0, strlen($percent) - 1);
                $transcode['percent'] = $percent;
                $transcode['status'] = 'waiting';
                file_put_contents('log.txt', "waiting percent:".$percent."\n", FILE_APPEND);
                $this->ajaxReturn($transcode);
                return;
            }
        }
        
        unset($count);
        $working_stream_array = get_duty_array("working", $ret);
        
        $count = count($working_stream_array);
        for($i = 0; $i < $count; $i++){
            if($src_id == $working_stream_array[$i]['src_id']){
                $data['src_id'] = $src_id;
                $percent = $working_stream_array[$i]['encode_progress'];
                $percent = substr($percent, 0, strlen($percent) - 1);
                $data['percent'] = $percent;
                $data['status'] = 'working';
                file_put_contents('log.txt', "working percent:".$percent."\n", FILE_APPEND);
                $this->ajaxReturn($data);
                return;
            }
        }

    }

    //我的直播、点播
    public function historyvod(){
        $arr1 = $this->checklogin();
        $uid = $arr1['id'];
        $logtime=$arr1['logtime'];
        $email=$arr1['email'];
        $status=$arr1['status'];
        file_put_contents('log.txt', "personal_my id:$uid\n", FILE_APPEND);
        $where['uid'] = $uid;

        $list=M('mycenter')->where($where)->select();
        $arr=array();
        $count = count($list);
        for($i=0;$i<count($list);$i++){
            $arr[$i]=$list[$i]['vid'];
        }
        $vod_video=M("video")->where(array('id'=>array('IN',$arr)))->select();
        $count = count($vod_video);
        file_put_contents('log.txt', "video count:$count\n", FILE_APPEND);
        $this->assign('list_video',$vod_video);
        $this->assign('logtime',$logtime);
        $this->assign('email',$email);
        $this->assign('status',$status);
        $this->assign('uid', $uid);

        $this->display("new/history_vod");
    }
}
