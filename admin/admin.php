<?php
define ( 'NO_COUNT', true );
require_once 'common.inc.php';
require_once 'function.inc.php';
require_once 'class_text.php';
require_once 'class_adminpage.php';

if ($_GET ['action']) {
	$a = daddslashes ( $_GET ['action'] );
	require_once "./source/{$a}.php";
}

if ($_POST) {
	check_permission ( $a );
	$a ();
} else {
	get_info_pre ( $a );
	admin_echo ( $a );
}

//echo '<script type="text/javascript" src="./js/main.js?v=' . TIMESTAMP . '"></script>';