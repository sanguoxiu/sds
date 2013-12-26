<?php
define ( 'IN_SGS', true );
define ( 'SGS_ROOT', substr ( dirname ( __FILE__ ), 0, - 6 ) );
define ( 'TIMESTAMP', time () );

ob_start ();
session_start ();



header ( 'Content-type: text/html; charset=utf-8' );
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );

require_once SGS_ROOT . './config/config.php';
require_once SGS_ROOT . './source/function/function_core.php';
require_once SGS_ROOT . './source/function/function_count.php';
require_once SGS_ROOT . './source/function/function_member.php';
require_once SGS_ROOT . './source/class/class_db.php';
require_once SGS_ROOT . './source/class/class_debug.php';
require_once SGS_ROOT . './source/class/class_error.php';
require_once SGS_ROOT . './source/class/class_memcache.php';
require_once SGS_ROOT . './source/class/class_page.php';
require_once SGS_ROOT . './source/class/saetv2.ex.class.php';
require_once SGS_ROOT . './source/class/class_qqconnect.php';

DEBUG::INIT();

$u = new SaeTOAuthV2(WB_AKEY, WB_SKEY);
$code_url = $u->getAuthorizeURL(WB_CALLBACK_URL);
$sgs = new QQConnect();
$qq_url = $sgs->qq_loginurl();

if (! defined ( 'SYS_KEY' ))
	define ( 'ENCRYPT_KEY', md5 ( "123456" ) );
else
	define ( 'ENCRYPT_KEY', SYS_KEY );
$formhash = substr ( md5 ( substr ( TIMESTAMP, 0, 5 ) . $_SESSION ['username'] . $_SESSION ['uid'] . $_SESSION ['lastlogintime'] . ENCRYPT_KEY . SGS_ROOT ), 8, 8 );
if ($_SERVER ['QUERY_STRING'] == '') {
	$string = '';
} else {
	$string = '?' . $_SERVER ['QUERY_STRING'];
}
$siteurl = htmlspecialchars ( 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['PHP_SELF'] . $string );

if (! defined ( 'NO_COUNT' )) {
	count_init ();
}
$count_a = count_get ( "total" );
$count_t = count_get ( "today" );
//$count_o = online ();
//visitor_log ();
