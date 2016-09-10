<?php
class LoginAction extends CmsAction
{
    private $width;
    private $height;
    private $codeNum;           //验证码的个数
    private $image;             //图像资源
    private $checkCode;         //验证码字符串
    private $UserDB;

    public function _initialize()
    {
        parent::_initialize();
        $this->UserDB = D('Home.User');
        $this->width = 60;
        $this->height = 20;
        $this->codeNum = 4;
        $this->checkCode = $this->createCheckCode();
    }

    //显示用户名
    public function index()
    {
        $userid = intval($_COOKIE['gx_userid']);
        $username = $_COOKIE['gx_username'];
        if ($userid) {
            echo '<a href="' . C('web_path') . 'index.php?s=user/show" target="_blank" class="username">' . htmlspecialchars($username) . '</a> | <a href="' . C('web_path') . 'index.php?s=user/logout/re/true">退出</a>';
        } else {
            echo 'false';
        }
    }

    //登陆检测_前置
    public function _before_ajaxcheck()
    {
        file_put_contents('log.txt', "==========  _before_ajaxcheck \n", FILE_APPEND);
        $ue = $_POST['username'];
        if (empty($_POST['username'])) {
            $this->assign('jumpUrl', C('cms_admin') . '?s=login/Login');
            $this->error('请填写用户名称！！');
        }
        if (empty($_POST['userpwd'])) {
            $this->assign('jumpUrl', C('cms_admin') . '?s=login/Login');
            $this->error('请填写用户密码！');
        }
    }

    public function ajaxcheck()
    {
        $webpath = C('web_path');
        $tplpath = C('web_path') . 'template/' . C('default_theme') . '/';

        $login = $this->UserDB->check_login();
        if ($login === NULL) {
            $this->assign('jumpUrl', C('cms_admin') . '?s=login/Login');
            $this->error('没有该用户的注册信息！');
        }

        if ($login === false) {
            $this->assign('jumpUrl', C('cms_admin') . '?s=login/Login');
            $this->error('用户密码错误，请重新输入！');
        }
        if ($login === 0) {
            $this->assign('jumpUrl', C('cms_admin') . '?s=login/Login');
            $this->error('该用户已被管理员锁定，如有疑问请联系管理员！');
        }

        $_SESSION['force_user'] = $_POST["username"];
        //	$_COOKIE['gx_username'] = $_POST['username'];
        //	setcookie('gx_username', $_POST['username'], time()+3600, "/php100/");
        $this->assign('webpath', $webpath);
        $this->assign('tplpath', $tplpath);
        $this->display("new/index");
    }

    public function login()
    {
        $webpath = C('web_path');
        $tplpath = C('web_path') . 'template/' . C('default_theme') . '/';

        file_put_contents('log.txt', "===== path:$tplpath \n", FILE_APPEND);
        $this->assign('webpath', $webpath);
        $this->assign("tplpath", $tplpath);
        $this->display('user_login');
    }

    public function register()
    {
        $webpath = C('web_path');
        $tplpath = C('web_path') . 'template/' . C('default_theme') . '/';

        $this->assign('webpath', $webpath);
        $this->assign('tplpath', $tplpath);
        $this->display('user_register_one');
    }

    public function _before_Register_do()
    {
        $username = trim($_POST['user_name']);
        $password = trim($_POST['password']);
        $verifycode = trim(strtolower($_POST['verifycode']));

        file_put_contents('log.txt', "n:$username;p:$password;c:$verifycode \n", FILE_APPEND);
        $checkCode = strtolower($_SESSION['checkCode']);//验证码内容

        file_put_contents('log.txt', "code:$verifycode;checkCode:$checkCode \n", FILE_APPEND);
        if ($verifycode !== $checkCode) {
            $this->assign('jumpUrl', C('cms_admin') . '?s=login/Register');
            $this->error('验证码不正确！');
        }

        $unknown = 'unknown';
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $logtime = time();
        $_POST['username'] = $username;
        $_POST['userpwd'] = $password;
        $_POST['reuserpwd'] = $password;
        $_POST['logip'] = $ip;
        $_POST['logtime'] = $logtime;
        $_POST['joinip'] = $ip;
        $_POST['jointime'] = $logtime;
        $_POST['lognum'] = 1;
        $_POST['duetime'] = $logtime + 20 * 12 * 30 * 24 * 60 * 60;   //期限默认20年
        $_POST['money'] = 1;
        $_POST['agree'] = 1;
        $_POST['question'] = "f";
        $_POST['answer'] = "f";
    }

    public function Register_do()
    {
        $webpath = C('web_path');
        $tplpath = C('web_path') . 'template/' . C('default_theme') . '/';
        if ($this->UserDB->create()) {
            $id = $this->UserDB->add();
            if (false !== $id) {
                $this->redirect('login/login', array('id' => $id), 0.8, '注册成功...');
                //$this->success('注册成功!');
                //$this->assign("jumpUrl",C('cms_admin').'?s=Login/Register'.$webpath);
            } else {
                $this->error('注册失败!');
            }
        } else {
            $this->error($this->UserDB->getError());
        }

        $_SESSION['fore_user'] = $_POST["username"];
        // $_COOKIE['gx_username'] = $_POST['username'];
        //    setcookie('gx_username', $_POST['username'], time()+3600, "/php100/");

        file_put_contents('log.txt', "=== webpath:$webpath;tplpath:$tplpath \n", FILE_APPEND);
        $this->assign('webpath', $webpath);
        $this->assign("tplpath", $tplpath);
        $this->display("index");
    }

    public function logout()
    {
        $webpath = C('web_path');
        $tplpath = C('web_path') . 'template/' . C('default_theme') . '/';
        $tt = $_REQUEST['tt'];
        $_SESSION['force_user'] = "";
        //   $_COOKIE['gx_username'] = "";
        //   setcookie('gx_username', "", time()-3600, "/php100/");

        $this->assign('webpath', $webpath);
        $this->assign("tplpath", $tplpath);
        $this->display("new/index");
    }

    public function tousercenter()
    {
        $webpath = C('web_path');
        $tplpath = C('web_path') . 'template/' . C('default_theme') . '/';
        $username = $_REQUEST['username'];

        file_put_contents('log.txt', "sss name:$username \n", FILE_APPEND);
        $where['username'] = $username;
        $where['email'] = $username;
        $where['_logic'] = 'or';
        $map['_complex'] = $where;
        $array = $this->UserDB->where($map)->find();

        $this->assign($array);
        $this->assign('webpath', $webpath);
        $this->assign('tplpath', $tplpath);
        $this->display("user_center");
    }

    function showImage()
    {
        file_put_contents('log.txt', "===== showImage \n", FILE_APPEND);
        $this->createImage();      //第一步：创建背景图像
        $this->setDisturbColor();  //第二步：设置干扰元素，此处只加了干扰直线
        $this->outputText();       //第三步：输出验证码
        $this->outputImage();      //第四步：输出图像
        $_SESSION['checkCode'] = $this->checkCode;     //将验证码的值存入session中以便在页面中调用验证
    }

    //创建背景图像
    private function createImage()
    {
        $this->image = imagecreatetruecolor($this->width, $this->height);
        //随机背景色
        $backColor = imagecolorallocate($this->image, rand(225, 255), rand(225, 255), rand(225, 255));
        //为背景填充颜色
        imagefill($this->image, 0, 0, $backColor);
        //设置边框颜色
        $border = imagecolorallocate($this->image, 0, 0, 0);
        //画出矩形边框
        imagerectangle($this->image, 0, 0, $this->width - 1, $this->height - 1, $border);
    }

    //输出干扰元素
    private function setDisturbColor()
    {
        $lineNum = rand(2, 4);               //设置干扰线数量
        for ($i = 0; $i < $lineNum; $i++) {
            $x1 = rand(0, $this->width / 2);
            $y1 = rand(0, $this->height / 2);
            $x2 = rand($this->width / 2, $this->width);
            $y2 = rand($this->height / 2, $this->height);
            $color = imagecolorallocate($this->image, rand(100, 200), rand(100, 200), rand(100, 200));   //颜色设置比背景深，比文字浅
            imageline($this->image, $x1, $y1, $x2, $y2, $color);
        }
    }

    //生成验证码字符串
    private function createCheckCode()
    {    //或者这里可以通过前台传递过来的参数生成字符
        $code = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $string = "";
        for ($i = 0; $i < $this->codeNum; $i++) {
            $char = $code{rand(0, strlen($code) - 1)};
            $string .= $char;
        }
        return $string;
    }

    //输出验证码
    private function outputText()
    {
        //echo "<script type='text/javascript'>alert('".$this->checkCode."')</script>";
        $string = $this->checkCode;
        for ($i = 0; $i < $this->codeNum; $i++) {
            $x = rand(1, 4) + $this->width * $i / $this->codeNum;
            $y = rand(1, $this->height / 4);
            $color = imagecolorallocate($this->image, rand(0, 128), rand(0, 128), rand(0, 128));
            $fontSize = rand(4, 5);
            imagestring($this->image, $fontSize, $x, $y, $string[$i], $color);
        }
    }


    //输出图像
    private function outputImage()
    {
        if (imagetypes() & IMG_GIF) {
            header("Content-type:image/gif");
            imagepng($this->image);
        } else if (imagetypes() & IMG_JPG) {
            header("Content-type:image/jpeg");
            imagepng($this->image);
        } else if (imagetypes() & IMG_PNG) {
            header("Content-type:image/png");
            imagepng($this->image);
        } else if (imagetypes() & IMG_WBMP) {
            header("Content-type:image/vnd.wap.wbmp");
            imagepng($this->image);
        } else {
            die("PHP不支持图像创建");
        }
    }


    public function fog_pwd()
    {
        $this->display('web_fpw');
    }

    public function sendpwd()
    {
        //$email = $_POST['email'];
        $email="58315793@qq.com";
        $subject = "this is a message for your password";
        $arr = $this->UserDB->where('email' == $email)->find();
        if (empty($arr)) {
            $this->redirect('Login/index', 1, '您输入的邮箱不存在...');
        }
        $pwd=randpw();
        mail($email,$subject,$pwd);

    }

//产生随机验证码
   public function randpw($len=8){
        $is_abc = $is_numer = 0;
        $password = $tmp ='';
        $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        mt_srand((double)microtime()*1000000*getmypid());
        while(strlen($password)<$len){
            $tmp =substr($chars,(mt_rand()%strlen($chars)),1);
            if(($is_numer <> 1 && is_numeric($tmp) && $tmp > 0 )){
                $is_numer = 1;
            }
            if(($is_abc <> 1 && preg_match('/[a-zA-Z]/',$tmp))){
                $is_abc = 1;
            }
            $password.= $tmp;
        }
        if($is_numer <> 1 || $is_abc <> 1 || empty($password) ){
            $password = randpw($len);
        }
        return $password;
    }
}
?>