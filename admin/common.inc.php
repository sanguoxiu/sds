<?php
require_once '../source/common.inc.php'; // 加载前台通用文件。

if ($_SESSION ['admin'] == '1') {
	$admin = "超级管理员";
} else if ($_SESSION ['admin'] == '2') {
	$admin = "数据管理员";
} else if ($_SESSION ['admin'] == '3') {
	$admin = "管理员";
} else {
	echo '<script>top.location=\'../../index.php\';</script>';
	exit ();
}