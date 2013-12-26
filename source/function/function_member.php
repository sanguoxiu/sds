<?php
function do_login($username) {
	$user = DB::fetch_first ( "SELECT * FROM member WHERE username='{$username}'" );
	$_SESSION ['uid'] = $uid = $user ['uid'];
	$_SESSION ['username'] = $user ['username'];
	$_SESSION ['lastlogintime'] = $user ['lastlogintime'];
	$_SESSION ['admin'] = $user ['adminid'];
	$lastlogintime = DB::update ( 'member', array ('lastlogintime' => TIMESTAMP ), "uid='{$uid}'" );
}
function reg_control($time, $ip) { // 注册控制
	$control_time = $time - 600;
	$result = DB::fetch_first ( "SELECT * FROM member WHERE regip='{$ip}' AND regtime > '{$control_time}'" );
	if ($result)
		showmessage ( '注册过于频繁，请稍候再试。', 'index.php' );
}