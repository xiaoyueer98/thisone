<?php
/**
 * Created by PhpStorm.
 * User: lx
 * Date: 2016/7/25
 * Time: 10:30
 */
//创建直播
function create_live(&$error){
    $ret=check_login();
    if($ret==false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    $c = M('Channel');
    $id = $_POST['id'];
    $tid = $_POST['tid'];
    $actor=$_POST['actor'];
    $title=$_POST['title'];
    $cdescription=$_POST['content'];
    $inputer=$_POST['inputer'];
    $_POST['level'] = $_POST['userlevel'];
    $_POST['ctype'] = "live";
    $where['id'] = $_POST['channel_mcid'];
    $channel = $c->where($where)->find();
    $app = $channel['cfile'];
    $_POST['playurl'] = "|||".$app.'|'.randomkeys(16).'|flv|live|';
    $_POST['vodplay'] = empty($_POST['vodplay']) ? 0 : implode('$$$$$$', $_POST['vodplay']);
    $stime = $_POST['starttime'];
    $etime = $_POST['endtime'];
    $_POST['starttime'] = strtotime($stime);
    $_POST['endtime'] = strtotime($etime);

    $_POST['stype_mcid'] = empty($_POST['stype_mcids']) ? 0 : implode(',', $_POST['stype_mcids']);

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
    $data['vid'] = $id;
    $data['status'] = 1;
    $this->VideoplaywhiteDB->where('vid='.$tid)->save($data);
    $this->VideopushwhiteDB->where('vid='.$tid)->save($data);

    cookie('video_cid',intval($_POST["cid"]));
    return true;
}

//删除直播
function delete_live($app,$stream,$ver,&$error){
    $ret=check_login();
    if($ret==false){
        header("Location: ../auth/right_error.html?error=notauthorized");
    }
    $_SESSION['mstoken']=$ret;
    $media_host = C('mserver_url');
    $location="http://".$media_host."/mserver/interface/stream/?app=delete_file&application=$app&stream=$stream&version=$ver&token=$ret";
    return simple_call2($location,$error);
}
//登录验证
function check_login(){
    if (empty($_POST['login_name']) || empty($_POST['password'])) {
        $this->error('管理员帐号必须填写！');
        return false;
    }
    $where = array();
    $where['user'] = $_POST['login_name'];
    $rs  = D("Admin.Master");
    $list= $rs->where($where)->find();
    //使用用户名、密码和状态的方式进行认证
    if (NULL == $list) {
        $this->error('管理员帐号不存在！');
        return false;
    }
    if ($list['pwd'] != md5(trim($_POST['login_pwd']))) {
        $this->error('用户密码错误,请重新输入！');
        return false;
    }
    // 缓存访问权限
    $_SESSION[C('USER_AUTH_KEY')] = $list['id'];
    $_SESSION['usertype']         = $list['usertype'];
    $_SESSION['user']             = $list['user'];

    //创建流媒体服务器用户
    $arr['username'] = $where['user'];
    $arr['password'] = $list['pwd'];
    $error = '';

    $name = $arr['username'];
    $r = load_user($name);
    if($r == false){
        create_user($arr, $error);
    }

    //保存登陆信息
    $data = array();
    $data['id']         = $list['id'];
    $data['logincount'] = array('exp','logincount+1');
    $data['loginip']    = get_client_ip();
    $data['logintime']  = time();
    $rs->save($data);
    redirect(C('cms_admin').'?s=Admin/Index');
    return true;
}