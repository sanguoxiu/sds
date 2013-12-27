<?php
function count_init() { // 访问量
	$date = date ( "m-d" );
	$sql_d = DB::query ( "SELECT * FROM count where date='$date'" );
	$num = mysql_num_rows ( $sql_d );
	if ($num == 0) {
		DB::query ( "INSERT INTO `count` (`date`) VALUES ('$date');" );
	}
	DB::query ( "UPDATE count SET count=count+1 WHERE date='total' OR date='{$date}'" );
}
function visitor_log() { // 访问详情记录
	global $siteurl;
	$time = date ( "Y-m-d H:i:s" );
	$ip = $_SERVER ["REMOTE_ADDR"];
	$address = $siteurl;
	$user = $_SESSION ['username'];
	$sql = "INSERT INTO visitor (date,ip,address,user) VALUES ('$time','$ip','$address','$user')";
	DB::query ( $sql );
}
function count_get($a) { // 获取总计/今日访问量
	$date = date ( "m-d" );
	if ($a == "total") {
		$data = DB::fetch_first ( "SELECT * FROM count WHERE date = 'total' " );
		return $data ['count'];
	} else if ($a == "today") {
		$data = DB::fetch_first ( "SELECT * FROM count WHERE date = '{$date}' " );
		return $data ['count'];
	}
}
function online() { // 统计在线人数
	$time_s = date ( "Y-m-d H:i:s" );
	$time_e_t = mktime ( date ( "H" ), date ( "i" ) - 10, date ( "s" ), date ( "m" ), date ( "d" ), date ( "Y" ) );
	$time_e = date ( "Y-m-d H:i:s", $time_e_t );
	$query = DB::query ( "SELECT DISTINCT ip FROM visitor WHERE date <= '{$time_s}' AND date >= '{$time_e}' AND `user` != '' " );
	$online_number = mysql_num_rows ( $query );
	if ($online_number == '0') {
		$online_number = '1';
	}
	return $online_number;
}