<?php
function send_mail($address, $subject, $message){
	global $_config;
	switch($_config['mail']['type']){
		case 'saemail': return saemail($address, $subject, $message);
		case 'smtp':	return smtp_mail($address, $subject, $message);
		default: return false;
	}
}

function smtp_mail($address, $subject, $message){
	global $_config;
    require_once SGS_ROOT.'./source/class/class_mail.php';
	$smtp = new smtp();
    return $smtp->send($address, $subject, $message);
}

function saemail($address, $subject, $message){
	global $_config;
	$mail = new SaeMail();
	$mail->setOpt(array(
		'from' => '三国杀ol资料站 <'.$_config['mail']['saemail']['address'].'>',
		'to' => $address,
		'smtp_host' => $_config['mail']['saemail']['smtp_server'],
		'smtp_username' => $_config['mail']['saemail']['smtp_name'],
		'smtp_password' => $_config['mail']['saemail']['smtp_pass'],
		'subject' => $subject,
		'content' => $message,
		'content_type' => 'HTML',
	));
	$mail->send();
	return true;
}