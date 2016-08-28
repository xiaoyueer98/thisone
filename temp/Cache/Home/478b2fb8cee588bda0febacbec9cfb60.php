<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>消费模式转换-<?php echo ($webname); ?></title>
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
    <h3>我的消费模式</h3> 
    <ul style="line-height:30px">
    <li>用户帐号：<?php echo ($username); ?></li>
    <li>用户积分：<?php echo ($money); ?></li>
 	<li>消费模式：<span style="font-weight:bold; color:red"><?php if(($pay)  ==  "1"): ?>包月<?php else: ?>扣点<?php endif; ?></span></li> 
    <?php if(($pay)  ==  "1"): ?><li>消费说明：在有效期内无限次观看收费影片</li>
    <li>到期时间：<?php echo (get_color_date('Y-m-d H:i:s',$duetime)); ?></li>
    <?php else: ?>
    <li>消费说明：每次观看收费影片将扣除<?php echo C("user_money_play");?>点</li>
    <li>升级说明：1：包月有效期限为30天 2：升级为包月用户需要使用<span style="font-weight:bold; color:red"><?php echo C("user_money_change");?></span>积分</li>
    <li style="padding-top:15px;list-style:none"><form action="?s=User/Changeupdate" method="post"><input name="id" type="hidden" value="<?php echo ($id); ?>" /><input class="bginput" name="" type="submit" value="我要包月" style="cursor:pointer"/></form></li><?php endif; ?>    
    </ul> 
</div>	
</div>
</body>
</html>