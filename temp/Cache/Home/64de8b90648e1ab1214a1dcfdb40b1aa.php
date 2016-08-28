<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改用户资料-<?php echo ($webname); ?></title>
<link rel='stylesheet' type='text/css' href='./views/css/user.css'>
</head>
<div class="top"><div class="box">
	<div class="logo"><a href="./" title="返回首页"><?php echo ($webname); ?>－用户中心</a></div>
    <div class="info"><?php if(!empty($username)): ?><?php echo (htmlspecialchars($username)); ?>，欢迎您！ <a href="?s=User/Logout">退出</a><?php endif; ?> <a href="./">返回首页</a></div>
</div></div>
<div class="show">
<div class="left">
	<h3><a href="?s=User/Show">用户中心首页</a></h3>
<h4>管理信息</h4>
<ul>
<li><a href="?s=User/Guestbook">留言信息</a></li>
<li><a href="?s=User/Comment">评论信息</a></li>
</ul>
<h4>积分管理</h4>
<ul>
<li><a href="?s=User/Shop">积分充值</a></li>
<li><a href="?s=User/Views">消费记录</a></li>
<li><a href="?s=User/Changepay">消费模式</a></li>
</ul>
<h4>管理帐户</h4>      
<ul>
<li><a href="?s=User/Edit">修改资料</a></li>
<li><a href="?s=User/Logout">退出登录</a></li>
</ul>
</div>
<div class="user">
    <h3>修改资料</h3> 
    <ul style="line-height:30px"><form action="index.php?s=User/Update" method="post" id="gxform"><input name="id" type="hidden" value="<?php echo ($id); ?>" />
    <li>用户帐号：<?php echo ($username); ?></li>
    <li>用户积分：<?php echo ($money); ?></li>
    <li>联系 QQ：<input name="qq" type="text" value="<?php echo ($qq); ?>" maxlength="12"></li>
    <li>原始密码：<input name="olduserpwd" type="password" /></li>
 	<li>修改密码：<input name="userpwd" type="password" /> 不修改请留空</li>   
    <li>确认密码：<input name="reuserpwd" type="password" /> 不修改请留空</li>
    <li>密保问题：<input name="question" type="text" value="<?php echo (htmlspecialchars($question)); ?>" maxlength="20"/></li>
    <li>密保答案：<input name="answer" type="text" value="<?php echo (htmlspecialchars($answer)); ?>" maxlength="20"/></li>
    <li style="padding-top:10px"><input class="bginput" name="submit" type="submit" value="更 新" /> <input class="bginput" name="reset" type="reset" value="重 填" /></li>
	</form></ul> 
</div>	
</div>
</body>
</html>