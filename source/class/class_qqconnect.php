<?php

class QQConnect {
	var $conifg = array();
	// 定义变量
	function QQConnect() {
		$this -> conifg['appid'] 	= TX_APPID;
		$this -> conifg['appkey'] 	= TX_APPKEY;
		$this -> conifg['scope'] 	= TX_SCOPE;
		$this -> conifg['callback'] = TX_CALLBACK;
	}

	// 登录地址
	function qq_loginurl() {
		$callback = $this -> conifg['callback'];
		$_SESSION['state'] = md5(uniqid(rand(), true));
		$login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
		 . $this -> conifg['appid'] . "&redirect_uri=" . urlencode($callback)
		 . "&state=" . $_SESSION['state']
		 . "&scope=" . $this -> conifg['scope'];
		return $login_url;
	} 

	// 获取access_token
	function qq_callback($code) {
		$callback = $this -> conifg['callback'];
		$token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
		 . "client_id=" . $this -> conifg['appid'] . "&redirect_uri=" . urlencode($callback)
		 . "&client_secret=" . $this -> conifg['appkey'] . "&code=" . $code;

		$response = file_get_contents($token_url);
		if (strpos($response, "callback") !== false) {
			$lpos = strpos($response, "(");
			$rpos = strrpos($response, ")");
			$response = substr($response, $lpos + 1, $rpos - $lpos -1);
			$msg = json_decode($response);
			if (isset($msg -> error)) {
				$error = "<h3>error:</h3>" . $msg -> error;
				$error .= "<h3>msg  :</h3>" . $msg -> error_description;
				die($error);
			} 
		} 

		$params = array();
		parse_str($response, $params);
		$_SESSION["access_token"] = $params["access_token"];
	} 

	// 获取 Open id
	function get_openid() {
		$graph_url = "https://graph.qq.com/oauth2.0/me?access_token=" . $_SESSION['access_token'];

		$str = file_get_contents($graph_url);
		if (strpos($str, "callback") !== false) {
			$lpos = strpos($str, "(");
			$rpos = strrpos($str, ")");
			$str = substr($str, $lpos + 1, $rpos - $lpos -1);
		} 

		$user = json_decode($str);
		if (isset($user -> error)) {
			$error = '<h6>错误代码:' . $user -> error . '</h6>';
			$error .= '<p>提示:' . $user -> error_description . '</p>';
			die($error);
		} 
		$_SESSION["openid"] = $user -> openid;
	} 
	
	// 获取昵称
	function get_nicknames($access_token, $open_id)
	{
		$user_info_url = 'https://graph.qq.com/user/get_user_info?';
		
		$url = $user_info_url
			. 'oauth_consumer_key='. $this -> conifg['appid']
			. '&access_token=' . $access_token
			. '&openid='. $open_id . '&format=json';
		
		$str = file_get_contents($url);	
		
		$user_info = json_decode($str);
		
		if ( $user_info->ret !== 0 )
		{
			$error = '<h6>错误代码:' . $user_info -> ret . '</h6>';
			$error .= '<p>提示:' . $user_info -> msg . '</p>';
		}
		
		return $user_info;
	}
}