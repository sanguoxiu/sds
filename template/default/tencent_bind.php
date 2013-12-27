<?php
if (! defined ( 'IN_SGS' ))	exit ( 'Access Denied' );
include SGS_ROOT . './template/default/header.php';
//require SGS_ROOT . './template/default/nav.php';
$title = "绑定帐号";
?>
<div class="bind">
	<div id="bind_menu_r" class="bind_menu bind_selected">
		<a id="b_r" class="" href="javascript:void(0)" onclick="switch_b_r()">
			没有帐号，注册后绑定
		</a>
	</div>
	<div id="bind_menu_l" class="bind_menu">
		<a href="javascript:void(0)" onclick="switch_b_l()">
			已有帐号，登录后绑定
		</a>
	</div>
	<div id="bind_r" class="bind_f">
        <span>欢迎您，<font color="#15c"><?php echo $_SESSION['tname'];?></font> 请输入用户名、密码、邮箱后绑定</span>
		<form method="post" action="member.php?action=tencent_bind">
            <input type="text" name="username" placeholder="用户名" value="<?php echo $_SESSION['tname'];?>" required  />
			<input type="password" name="password" placeholder="密　码" required/>
			<input type="email" name="email" placeholder="邮　箱" required/>
			<input type="hidden" name="type" value="1" />
			<input type="submit" class="sbt" value="注册后绑定帐号" />
		</form>
	</div>
	<div id="bind_l" class="bind_f hide">
        <span>欢迎您，<font color="#15c"><?php echo $_SESSION['tname'];?></font> 请输入用户名、密码。登陆后绑定</span>
		<form method="post" action="member.php?action=tencent_bind">
			<input type="text" name="username" placeholder="用户名/UID" required/>
			<input type="password" name="password" placeholder="密　码" required/>
			<input type="hidden" name="type" value="2" />
			<input type="submit" class="sbt" value="登录后绑定帐号" />
		</form>
	</div>
</div>

<?php
include SGS_ROOT . './template/default/footer.php';
?>
