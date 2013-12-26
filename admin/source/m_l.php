<?php
/**********************************************/
//
// m_l.php -- 成员查看
//
/**
 * *******************************************
 */
require_once 'header.php';

$num = DB::result_first ( "SELECT count(*) FROM member " );
$page = new APage($num,20);

$sql = "SELECT * FROM `member` {$page->limit};";
$result = DB::fetch_all ( $sql );

echo <<<SGS
<table border='1' bordercolor='#0000FF' width='80%' id='show'>
<tr>
  <td height='21'><font color='#800080'><b>uid</b></font></td>
		<td height='21'><b><font color='#800080'>帐号</font></b></td>
		<td height='21'><b><font color='#800080'>密码</font></b></td>
		<td height='21'><b><font color='#800080'>email</font></b></td>
		<td height='21'><b><font color='#800080'>注册ip</font></b></td>
		<td height='21'><b><font color='#800080'>注册时间</font></b></td>
		<td height='21'><b><font color='#800080'>用户组</font></b></td>
		<td height='21'><b><font color='#800080'>最后上线时间</font></b></td>
</tr>
SGS;

foreach ( $result as $data ) {
	$date = date ( 'Y-m-d H:i:s', $data ['regtime'] );
	$lastlogintime = date ( 'Y-m-d H:i:s', $data ['lastlogintime'] );
	switch ($data ['adminid']) {
		case "1" :
			$adminid = "超级管理员";
			break;
		case "2" :
			$adminid = "数据管理员";
			break;
		case "3" :
			$adminid = "管理员";
			break;
		case "99" :
			$adminid = "vip";
			break;
		case "0" :
			$adminid = "会员";
			break;
		default :
			$adminid = "未知错误";
			break;
	}
	echo "
<tr>
		<td>", $data ['uid'], "</td>
		<td>", $data ['username'], "</td>
		<td>", $data ['password'], "</td>
		<td>", $data ['email'], "</td>
		<td>", $data ['regip'], "</td>
		<td>", $date, "</td>
		<td>", $adminid, "</td>
		<td>", $lastlogintime, "</td>
</tr>";
}
echo "</table>";
echo $page->fpage();
?>
</body>
</html>