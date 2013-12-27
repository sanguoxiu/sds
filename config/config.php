<?
if (! defined ( 'IN_SGS' ))
	exit ( 'Access Denied' );

$_config = array ();

// ------------------ 系统设定 ------------------
define ( 'SYS_KEY', 'sgs_data_station' ); // 加密密钥，留空系统自动生成
define ( 'WB_AKEY', '2181322798' );
define ( 'WB_SKEY', '0d6219186a651628f4eb5b9f42113828' );
define ( 'WB_CALLBACK_URL', 'http://sanguosha.sinaapp.com/callback.php' );
define ( 'TX_APPID', '100569179' );
define ( 'TX_APPKEY', '04e988536a57b55a2cd24af9dedc8558' );
define ( 'TX_SCOPE', 'get_user_info,add_share' );
define ( 'TX_CALLBACK', 'http://sanguosha.sinaapp.com/callback.php?auth_type=tencent' );
// -------------- END 系统设定 ------------------
                                       
// ------------------ SAE 数据库设定 ------------------
if (defined ( 'SAE_MYSQL_DB' )) {
	$_config ['db'] ['server'] = SAE_MYSQL_HOST_M;
	$_config ['db'] ['port'] = SAE_MYSQL_PORT;
	$_config ['db'] ['username'] = SAE_MYSQL_USER;
	$_config ['db'] ['password'] = SAE_MYSQL_PASS;
	$_config ['db'] ['name'] = SAE_MYSQL_DB;
	$_config ['db'] ['charset'] = 'utf8';
	$_config ['db'] ['pconnect'] = 0;
} else {
// -------------- END SAE 数据库设定 ------------------
	
// ------------------ 非BAE、SAE 数据库设定 ------------------
	$_config ['db'] ['server'] = 'localhost'; // 数据库服务器地址
	$_config ['db'] ['port'] = '3306'; // 数据库端口
	$_config ['db'] ['username'] = 'root'; // 数据库用户名
	$_config ['db'] ['password'] = ''; // 数据库密码
	$_config ['db'] ['name'] = 'sgs'; // 数据库名
	$_config ['db'] ['charset'] = 'utf8';
}
// -------------- END 非BAE、SAE 数据库设定 ------------------

// ------------------ 邮件系统设定 ------------------
/*
 * 注：选择相应的发送方式后，请填写对应的设置
 *
 * 邮件发送方式：
 * none			不发送邮件
 * saemail		SAE 用户可用，通过 SAE 的 SMTP 类发送邮件
 * smtp			其他服务器用户可用，通过 SMTP 服务器发邮件
 */
$_config['mail']['type'] = 'saemail';		// 邮件发送方式
// saemail，SAE 用户可用，通过 SAE 的 SMTP 类发送邮件，请按给出的例子修改
$_config['mail']['saemail'] = array();
$_config['mail']['saemail']['smtp_server'] = 'smtp.exmail.qq.com';	// SMTP 服务器地址
$_config['mail']['saemail']['address'] = 'no-reply@sanguoxiu.com';			// 发送者邮箱地址
$_config['mail']['saemail']['smtp_name'] = 'no-reply@sanguoxiu.com';			// SMTP 用户名
$_config['mail']['saemail']['smtp_pass'] = 'gouge521';				// SMTP 密码
// smtp 通过 SMTP 服务器发邮件，请按给出的例子修改
$_config['mail']['smtp'] = array();
$_config['mail']['smtp']['smtp_server'] = 'smtp.exmail.qq.com';	// SMTP 服务器地址
$_config['mail']['smtp']['address'] = 'no-reply@sanguoxiu.com';			// 发送者邮箱地址
$_config['mail']['smtp']['smtp_name'] = 'no-reply@sanguoxiu.com';		// SMTP 用户名
$_config['mail']['smtp']['smtp_pass'] = 'gouge521';				// SMTP 密码
// ------------------ END 邮件系统设定 ------------------


$_config ['info'] ['bdtj'] = '<script>var _hmt = _hmt || [];(function() {var hm = document.createElement("script");hm.src = "//hm.baidu.com/hm.js?6faa8678795ccf8c5c94d03aed455287";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script>';
$_config ['info'] ['sitename'] = '三国杀online资料站 - Sanguosha Data Station';
$_config ['info'] ['keyword'] = '三国杀,三国杀online,三国杀资料站,三国杀online资料站,三国秀试衣间,三国杀战功,三国杀道具,三国杀武将,三国杀皮肤,SDS';
$_config ['info'] ['description'] = '三国杀ol资料站，可查看和评价三国杀online内道具、武将、皮肤、三国秀、战功等，自己的游戏，自己说了算！！';