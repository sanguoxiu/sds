<?php
require_once './source/common.inc.php';

if ($_GET['auth_type'] == 'tencent') {
	$sgs->qq_callback($_GET['code']);
	$sgs->get_openid();
	$result = $sgs->get_nicknames($_SESSION["access_token"], $_SESSION["openid"]);
    $tid = $_SESSION["openid"];
	$_SESSION['tname'] = $result->nickname;
	$tencent = DB::fetch_first("SELECT * FROM tencent WHERE `tid` ='{$tid}'");
	if (!$tencent) {
		showmessage ( "第一次登陆，需要绑定本站帐号，下次就可以使用QQ号直接登陆了！跳转中……", 'member.php?action=tencent_bind', 5 );
	}else{
	    $uid = $tencent['uid'];
	    $user = DB::fetch_first("SELECT * FROM member WHERE `uid` ='{$uid}'");
		$username = $user['username'];
		if($user ['lastlogintime'] != '0') {
			$lastlogintime_text = '上次登陆时间 ' . date('Y-m-d H:i:s', $user ['lastlogintime']);
		}
		do_login ( $username );
		showmessage ( "亲爱的 {$username} 欢迎回来！  {$lastlogintime_text}", 'index.php', 3 );
	}
}else{
	$o = new SaeTOAuthV2(WB_AKEY, WB_SKEY);
	if (isset($_REQUEST['code'])) {
	    $keys = array();
	    $keys['code'] = $_REQUEST['code'];
	    $keys['redirect_uri'] = WB_CALLBACK_URL;
	    try {
	        $token = $o->getAccessToken('code', $keys);
	    }
	    catch(OAuthException $e) {
	    }
	}
	if ($token) {
	    $_SESSION['token'] = $token;
	    setcookie('weibojs_' . $o->client_id, http_build_query($token));
	    $c = new SaeTClientV2(WB_AKEY, WB_SKEY, $token['access_token']);
	    $sina_user = $c->show_user_by_id($token['uid']);
	    $_SESSION['sina_url'] = "http://weibo.com/" . $token['uid'];
	    //$_SESSION['profile_image_url'] = $token['profile_image_url'];
	    //$_SESSION['login_type'] = "sina";
	    $_SESSION['wid']  = $wid = $token['uid'];
	    $_SESSION['wname'] = $sina_user['screen_name'];
	    $weibo = DB::fetch_first("SELECT * FROM weibo WHERE `wid` ='{$wid}'");
	    if (!$weibo) {
			showmessage ( "第一次登陆，需要绑定本站帐号，下次就可以使用微博直接登陆了！跳转中……", 'member.php?action=sina_bind', 5 );
	    }else{
	        $uid = $weibo['uid'];
	        $user = DB::fetch_first("SELECT * FROM member WHERE `uid` ='{$uid}'");
			$username = $user['username'];
			if($user ['lastlogintime'] != '0') {
				$lastlogintime_text = '上次登陆时间 ' . date('Y-m-d H:i:s', $user ['lastlogintime']);
			}
			do_login ( $username );
			showmessage ( "亲爱的 {$username} 欢迎回来！  {$lastlogintime_text}", 'index.php', 3 );
	    }
	} else {
			showmessage ( '新浪微博授权失败，请重试。', dreferer (), 3 );
	}
}