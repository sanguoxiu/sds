<?php
require_once './source/common.inc.php';

if ($_GET ['action'] == 'logout') {
	if ($_GET ['hash'] == $formhash) {
		$_SESSION=array();
		showmessage ( '您已经退出登录了！', dreferer (), 2 );
	} else {
		showmessage ( '非法请求，请刷新页面后重试！', dreferer (), 2 );
	}
} else if ($_SESSION ['uid'] ) {
	showmessage ( '您已经登录了~', dreferer (), 2 );
} else if ($_GET ['action'] == 'sina_bind') {
    $wid = $_SESSION['wid'];
    if(!$_SESSION['wid'])
        showmessage ( '授权异常，请重新登陆后再试', 'index.php' );
    if ($_POST['type'] == '1') {
		if (! $_POST ['username']) {
			showmessage ( '用户名不能为空！！',  dreferer () );
		} else if (! $_POST ['password']) {
			showmessage ( '密码不能为空！！',  dreferer () );
		} else if (! $_POST ['email']) {
			showmessage ( '邮箱不能为空！！',  dreferer () );
		} else {
			$username = daddslashes ( $_POST ['username'] );
			$email = daddslashes ( $_POST ['email'] );
			$password = md5 ( ENCRYPT_KEY . md5 ( $_POST ['password'] ) . ENCRYPT_KEY );
			$time = TIMESTAMP;
			$ip = $_SERVER ["REMOTE_ADDR"];
			reg_control ( $time, $ip );
			if (! $username || ! $password || ! $email)
				showmessage ( '您输入的信息不完整', 'index.php' );
			if (preg_match ( '/[<>\'\\"]/i', $username ))
				showmessage ( '用户名中有被禁止使用的关键字', 'index.php' );
			if (! preg_match ( "/([\w\.\_]{2,10})@(\w{1,}).([a-z]{2,4})/", $email ))
				showmessage ( '邮箱格式不正确',  dreferer () );
			if (strlen ( $username ) < 6)
				showmessage ( '用户名至少要6个字符(即2个中文 或 6个英文)，请修改', dreferer (), 5 );
			if (strlen ( $username ) > 15)
				showmessage ( '用户名过长，请修改', dreferer (), 5 );
			$un = strtolower ( $username );
			if (strexists ( $un, 'admin' ) || strexists ( $un, 'guanli' ))
				showmessage ( '用户名不和谐，请修改', dreferer (), 5 );
			$user = DB::fetch_first ( "SELECT * FROM member WHERE username='{$username}'" );
			if ($user)
				showmessage ( '该用户名已经存在',  dreferer () );
			$uid = DB::insert ( 'member', array (
					'username' => $username,
					'password' => $password,
					'email' => $email,
					"regip" => $ip,
					"regtime" => $time,
			) );
			$bind = DB::fetch_first ( "SELECT uid FROM member WHERE username='{$username}'" );
			$bind_uid = $bind['uid'];
            if (!$bind)
				showmessage ( '绑定失败，获取uid失败',  dreferer () );
			$wid = DB::insert ( 'weibo', array (
					'uid' => $bind_uid,
					'wid' => $wid,
			) );
                if ($wid){
					do_login ( $username );
					showmessage ( "绑定成功， 下次使用微博就可以直接登陆了哦~！", dreferer (), 3 );
                }else{
					showmessage ( '绑定失败，写入绑定关系失败',  dreferer () );
                }
		}
    }else if ($_POST['type'] == '2') {
		if (! $_POST ['username']) {
			showmessage ( '用户名不能为空！！',  dreferer () );
		} elseif (! $_POST ['password']) {
			showmessage ( '密码不能为空！！',  dreferer () );
		} else {
            $username = daddslashes ( $_POST ['username'] );
			$password = md5 ( ENCRYPT_KEY . md5 ( $_POST ['password'] ) . ENCRYPT_KEY );
			$un = strtolower ( $username );
			if (strlen ( $username ) > 15)
				showmessage ( '用户名过长，请修改', dreferer (), 5 );
			$user = DB::fetch_first ( "SELECT * FROM member WHERE username='{$username}' AND password='{$password}'" );
			$uid = DB::fetch_first ( "SELECT * FROM member WHERE uid='{$username}' AND password='{$password}'" );
			if ($user) {
				$username = $user ['username'];
				$bind = DB::fetch_first ( "SELECT uid FROM member WHERE username='{$username}'" );
				$bind_uid = $bind['uid'];
    	       	if (!$bind)
					showmessage ( '绑定失败，获取uid失败', dreferer () );
				$wid = DB::insert ( 'weibo', array (
						'uid' => $bind_uid,
						'wid' => $wid,
				) );
                if ($wid){
					do_login ( $username );
					showmessage ( "绑定成功， 下次使用微博就可以直接登陆了哦！", dreferer (), 1 );
                }else{
					showmessage ( '绑定失败，写入绑定关系失败', dreferer () );
                }
			} else if ($uid) {
				$username = $uid ['username'];
				$bind = DB::fetch_first ( "SELECT uid FROM member WHERE username='{$username}'" );
				$bind_uid = $bind['uid'];
    	       	if (!$bind)
					showmessage ( '绑定失败，获取uid失败',  dreferer () );
				$wid = DB::insert ( 'weibo', array (
						'uid' => $bind_uid,
						'wid' => $wid,
				) );
                if ($wid){
					do_login ( $username );
					showmessage ( "绑定成功， 下次使用微博就可以直接登陆了哦！", dreferer (), 1 );
                }else{
					showmessage ( '绑定失败，写入绑定关系失败', dreferer () );
                }
			} else {
				showmessage ( '对不起，您的用户名或密码错误，请重新登陆.', dreferer (), 3 );
			}
		}
	}
	include SGS_ROOT.'./template/default/sina_bind.php';
	exit ();
} else if ($_GET ['action'] == 'tencent_bind') {
    $tid = $_SESSION['openid'];
    if(!$tid)
        showmessage ( '授权异常，请重新登陆后再试', 'index.php' );
    if ($_POST['type'] == '1') {
		if (! $_POST ['username']) {
			showmessage ( '用户名不能为空！！',  dreferer () );
		} else if (! $_POST ['password']) {
			showmessage ( '密码不能为空！！',  dreferer () );
		} else if (! $_POST ['email']) {
			showmessage ( '邮箱不能为空！！',  dreferer () );
		} else {
			$username = daddslashes ( $_POST ['username'] );
			$email = daddslashes ( $_POST ['email'] );
			$password = md5 ( ENCRYPT_KEY . md5 ( $_POST ['password'] ) . ENCRYPT_KEY );
			$time = TIMESTAMP;
			$ip = $_SERVER ["REMOTE_ADDR"];
			reg_control ( $time, $ip );
			if (! $username || ! $password || ! $email)
				showmessage ( '您输入的信息不完整', 'index.php' );
			if (preg_match ( '/[<>\'\\"]/i', $username ))
				showmessage ( '用户名中有被禁止使用的关键字', 'index.php' );
			if (! preg_match ( "/([\w\.\_]{2,10})@(\w{1,}).([a-z]{2,4})/", $email ))
				showmessage ( '邮箱格式不正确',  dreferer () );
			if (strlen ( $username ) < 6)
				showmessage ( '用户名至少要6个字符(即2个中文 或 6个英文)，请修改', dreferer (), 5 );
			if (strlen ( $username ) > 15)
				showmessage ( '用户名过长，请修改', dreferer (), 5 );
			$un = strtolower ( $username );
			if (strexists ( $un, 'admin' ) || strexists ( $un, 'guanli' ))
				showmessage ( '用户名不和谐，请修改', dreferer (), 5 );
			$user = DB::fetch_first ( "SELECT * FROM member WHERE username='{$username}'" );
			if ($user)
				showmessage ( '该用户名已经存在',  dreferer () );
			$uid = DB::insert ( 'member', array (
					'username' => $username,
					'password' => $password,
					'email' => $email,
					"regip" => $ip,
					"regtime" => $time,
			) );
			$bind = DB::fetch_first ( "SELECT uid FROM member WHERE username='{$username}'" );
			$bind_uid = $bind['uid'];
            if (!$bind)
				showmessage ( '绑定失败，获取uid失败',  dreferer () );
			$tid = DB::insert ( 'tencent', array (
					'uid' => $bind_uid,
					'tid' => $tid,
			) );
                if ($tid){
					do_login ( $username );
					showmessage ( "绑定成功， 下次使用QQ就可以直接登陆了哦~！", dreferer (), 3 );
                }else{
					showmessage ( '绑定失败，写入绑定关系失败',  dreferer () );
                }
		}
    }else if ($_POST['type'] == '2') {
		if (! $_POST ['username']) {
			showmessage ( '用户名不能为空！！',  dreferer () );
		} elseif (! $_POST ['password']) {
			showmessage ( '密码不能为空！！',  dreferer () );
		} else {
            $username = daddslashes ( $_POST ['username'] );
			$password = md5 ( ENCRYPT_KEY . md5 ( $_POST ['password'] ) . ENCRYPT_KEY );
			$un = strtolower ( $username );
			if (strlen ( $username ) > 15)
				showmessage ( '用户名过长，请修改', dreferer (), 5 );
			$user = DB::fetch_first ( "SELECT * FROM member WHERE username='{$username}' AND password='{$password}'" );
			$uid = DB::fetch_first ( "SELECT * FROM member WHERE uid='{$username}' AND password='{$password}'" );
			if ($user) {
				$username = $user ['username'];
				$bind = DB::fetch_first ( "SELECT uid FROM member WHERE username='{$username}'" );
				$bind_uid = $bind['uid'];
    	       	if (!$bind)
					showmessage ( '绑定失败，获取uid失败', dreferer () );
				$tid = DB::insert ( 'tencent', array (
						'uid' => $bind_uid,
						'tid' => $tid,
				) );
                if ($tid){
					do_login ( $username );
					showmessage ( "绑定成功， 下次使用QQ就可以直接登陆了哦！", dreferer (), 1 );
                }else{
					showmessage ( '绑定失败，写入绑定关系失败', dreferer () );
                }
			} else if ($uid) {
				$username = $uid ['username'];
				$bind = DB::fetch_first ( "SELECT uid FROM member WHERE username='{$username}'" );
				$bind_uid = $bind['uid'];
    	       	if (!$bind)
					showmessage ( '绑定失败，获取uid失败',  dreferer () );
				$tid = DB::insert ( 'tencent', array (
						'uid' => $bind_uid,
						'tid' => $tid,
				) );
                if ($tid){
					do_login ( $username );
					showmessage ( "绑定成功， 下次使用QQ就可以直接登陆了哦！", dreferer (), 1 );
                }else{
					showmessage ( '绑定失败，写入绑定关系失败', dreferer () );
                }
			} else {
				showmessage ( '对不起，您的用户名或密码错误，请重新登陆.', dreferer (), 3 );
			}
		}
	}
	include SGS_ROOT.'./template/default/tencent_bind.php';
	exit ();
} else if ($_GET ['action'] == 'register') {
	if ($_POST) {
		if (! $_POST ['username']) {
			showmessage ( '请输入用户名', 'index.php' );
		} elseif (! $_POST ['password']) {
			showmessage ( '请输入密码', 'index.php' );
		} elseif (! $_POST ['email']) {
			showmessage ( '请输入您的邮箱', 'index.php' );
		} else {
			$username = daddslashes ( $_POST ['username'] );
			$email = daddslashes ( $_POST ['email'] );
			$password = md5 ( ENCRYPT_KEY . md5 ( $_POST ['password'] ) . ENCRYPT_KEY );
			$time = TIMESTAMP;
			$ip = $_SERVER ["REMOTE_ADDR"];
			reg_control ( $time, $ip );
			if (! $username || ! $password || ! $email)
				showmessage ( '您输入的信息不完整', 'index.php' );
			if (preg_match ( '/[<>\'\\"]/i', $username ))
				showmessage ( '用户名中有被禁止使用的关键字', 'index.php' );
			if (! preg_match ( "/([\w\.\_]{2,10})@(\w{1,}).([a-z]{2,4})/", $email ))
				showmessage ( '邮箱格式不正确', 'index.php' );
			if (strlen ( $username ) < 6)
				showmessage ( '用户名至少要6个字符(即2个中文 或 6个英文)，请修改', dreferer (), 5 );
			if (strlen ( $username ) > 15)
				showmessage ( '用户名过长，请修改', dreferer (), 5 );
			$un = strtolower ( $username );
			if (strexists ( $un, 'admin' ) || strexists ( $un, 'guanli' ))
				showmessage ( '用户名不和谐，请修改', dreferer (), 5 );
			$user = DB::fetch_first ( "SELECT * FROM member WHERE username='{$username}'" );
			if ($user)
				showmessage ( '该用户名已经存在', 'index.php' );
			$uid = DB::insert ( 'member', array (
					'username' => $username,
					'password' => $password,
					'email' => $email,
					"regip" => $ip,
					"regtime" => $time,
			) );
			do_login ( $username );
			showmessage ( "注册成功，您的用户名是 <b>{$username}</b> 记住了哦~！", dreferer (), 3 );
		}
	}
} else if ($_GET ['action'] == 'login') {
	if ($_POST) {
		if ($_POST ['username'] && $_POST ['password']) {
			$username = daddslashes ( $_POST ['username'] );
			$password = md5 ( ENCRYPT_KEY . md5 ( $_POST ['password'] ) . ENCRYPT_KEY );
			$un = strtolower ( $username );
			if (strlen ( $username ) > 15)
				showmessage ( '用户名过长，请修改', dreferer (), 5 );
			$user = DB::fetch_first ( "SELECT * FROM member WHERE username='{$username}' AND password='{$password}'" );
			$uid = DB::fetch_first ( "SELECT * FROM member WHERE uid='{$username}' AND password='{$password}'" );
			if ($user) {
				$username = $user ['username'];
                if($user ['lastlogintime'] != '0') {
                $lastlogintime_text = '上次登陆时间 ' . date('Y-m-d H:i:s', $user ['lastlogintime']);
                }
				do_login ( $username );
				showmessage ( "亲爱的 {$username} 欢迎回来！  {$lastlogintime_text}", dreferer (), 3 );
			} else if ($uid) {
				$username = $uid ['username'];
                if($uid ['lastlogintime'] != '0') {
                	$lastlogintime_text = '上次登陆时间 ' . date('Y-m-d H:i:s', $uid ['lastlogintime']);
                }
				do_login ( $username );
				showmessage ( "亲爱的 {$username} 欢迎回来！  {$lastlogintime_text}", dreferer (), 3 );
			} else {
				showmessage ( '对不起，您的用户名或密码错误，请重新登陆.', 'index.php', 3 );
			}
		}
	}
} else {
	showmessage ( '正在带您返回首页，请稍候.', 'index.php', 1 );
}

