<?php
if (! defined ( 'IN_SGS' ))
	exit ( 'Access Denied' );
function daddslashes($string, $force = 0, $strip = FALSE) {
	! defined ( 'MAGIC_QUOTES_GPC' ) && define ( 'MAGIC_QUOTES_GPC', get_magic_quotes_gpc () );
	if (! MAGIC_QUOTES_GPC || $force) {
		if (is_array ( $string )) {
			foreach ( $string as $key => $val ) {
				$string [$key] = daddslashes ( $val, $force, $strip );
			}
		} else {
			$string = addslashes ( $strip ? stripslashes ( $string ) : $string );
		}
	}
	$string = dhtmlspecialchars ($string);
	return $string;
}

function dhtmlspecialchars($string, $flags = null) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlspecialchars($val, $flags);
		}
	} else {
		if($flags === null) {
			$string = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);
			if(strpos($string, '&amp;#') !== false) {
				$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1', $string);
			}
		} else {
			if(PHP_VERSION < '5.4.0') {
				$string = htmlspecialchars($string, $flags);
			} else {
				if(strtolower(CHARSET) == 'utf-8') {
					$charset = 'UTF-8';
				} else {
					$charset = 'ISO-8859-1';
				}
				$string = htmlspecialchars($string, $flags, $charset);
			}
		}
	}
	return $string;
}

function showmessage($msg = '', $redirect = '', $delay = 3) {
	$msg = $redirect ? "<p>{$msg}</p><ins><a href=\"{$redirect}\">如果您的浏览器没有自动跳转，请点击这里</a></ins><meta http-equiv=\"refresh\" content=\"{$delay};url={$redirect}\" />" : "<p>{$msg}</p>";
	echo <<<SGS
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>系统提示 - 三国杀online资料站</title>
<link rel="Bookmark" href="./images/favicon.ico" >
<link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" href="./template/default/css/style.css?v={TIMESTAMP}" type="text/css" />
</head>
<body>
<div class="wrapper">
<div class="header-bar">
<div class="header content clearfix">
<a id="hraeder-link" href="./" rel="index" title="首页">
<img class="logo" src="./images/logo.png" alt="三国杀online资料站"></a>
<div id ="login" class="login"></div>
</div>
</div>
SGS;
include SGS_ROOT . './template/default/nav.php';
echo '<div class="message_box"><div class="message_text">' . $msg . '</div></div>';
echo <<<SGS
<div class="footer-bar">
	<div class="footer content clearfix">
		<ul>
			<li>Copyright &copy; 2013 Angel&#39;s SDS -<a href="./">Sanguosha-Data-Station</a></li>
		</ul>
	</div>
</div>
</div>
</body>
</html>
SGS;
    exit ();
}
function dreferer() {
	return $_SERVER ['HTTP_REFERER'] && ! strexists ( $_SERVER ['HTTP_REFERER'], 'member' ) ? $_SERVER ['HTTP_REFERER'] : './';
}
function strexists($string, $find) {
	return ! (strpos ( $string, $find ) === FALSE);
}
function copyright_date() {
	$year = date('Y', TIMESTAMP);
    if ($year != '2013'){
    	return ' - ' . $year;
    }
}






	