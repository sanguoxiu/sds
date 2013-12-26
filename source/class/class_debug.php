<?php
if(!defined('IN_SGS')) exit();

class DEBUG{
	function INIT(){
		$GLOBALS['debug']['time_start'] = self::getmicrotime();
	}
	function getmicrotime(){
		list($usec, $sec) = explode(' ',microtime());
		return ((float)$usec + (float)$sec);
	}
	function output(){
		$return[] = '运行时间：'.number_format((self::getmicrotime() - $GLOBALS['debug']['time_start']), 6).'秒';
		echo implode(' , ', $return);
	}
}