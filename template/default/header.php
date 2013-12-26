<?php if(!defined('IN_SGS')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content="<?php echo $_config['info']['keyword']; ?>" name="keywords" />
<meta content="<?php echo $_config['info']['description']; ?>" name="description" />
<title><?php if (!empty($title)) echo "{$title} - "; echo $_config['info']['sitename'];?></title>
<link rel="Bookmark" href="/images/favicon.ico">
<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet"href="<?php echo "./template/default/css/style.css?v=".TIMESTAMP;?>" type="text/css" />
<?php echo $_config['info']['bdtj'];?>
</head>
<body>
<div class="wrapper">
<div class="header-bar">
<div class="header content clearfix">
<a id="hraeder-link" href="./" rel="index" title="首页"><img class="logo" src="./images/logo.png" alt="三国杀online资料站"></a>
<div id="login" class="login"></div>
<div id="weibo_login" class="weibo_login"><a href="<?php echo $code_url;?>"><img src="./images/weibo.png" title="微博登录"></a></div>
<div id="tencent_login" class="tencent_login"><a href="<?php echo $qq_url;?>"><img src="./images/tencent.png" title="QQ登录"></a></div>
</div>
</div>