<?php
/**********************************************/
//
// a_l.php -- 三国秀查看
//
/**
 * *******************************************
 */
require_once 'header.php';
$num = DB::result_first ( "SELECT count(*) FROM `avatarshow` " );
$page = new APage($num,20);


$sql = "SELECT * FROM `avatarshow` {$page->limit};";
$result = DB::fetch_all ( $sql );

echo <<<SGS
<table border='1' bordercolor='#0000FF' width='80%' id='show'>
<tr>
		<td height='21'><b><font color='#800080'>三国秀id</font></b></td>
		<td height='21'><b><font color='#800080'>名字</font></b></td>
		<td height='21'><b><font color='#800080'>简介</font></b></td>
		<td height='21'><b><font color='#800080'>类型</font></b></td>
		<td height='21'><b><font color='#800080'>图片id</font></b></td>
		<td height='21'><b><font color='#800080'>图片类型</font></b></td>
</tr>
SGS;

foreach ( $result as $data ) {
	switch ($data ['type']) {
		case "1" :
			$type = "边框";
			break;
		case "2" :
			$type = "背景";
			break;
		case "3" :
			$type = "标准版形象";
			break;
		case "4" :
			$type = "amo*Q形象";
			break;
		case "5" :
			$type = "节日形象";
			break;
		case "6" :
			$type = "节气形象";
			break;
		case "7" :
			$type = "星座形象";
			break;
		case "8" :
			$type = "皮肤形象";
			break;
		case "9" :
			$type = "活动形象";
			break;
		case "10" :
			$type = "萌之形象";
			break;
		case "11" :
			$type = "阿狸形象";
			break;
		case "12" :
			$type = "国战形象";
			break;
		case "13" :
			$type = "其他形象";
			break;
	}
	switch ($data ['pictype']) {
		case "1" :
			$pictype = "静态";
			break;
		case "2" :
			$pictype = "动态";
			break;
	}
	echo "
  <tr>
		<td>", $data ['aid'], "</td>
		<td>", $data ['name'], "</td>
		<td>", $data ['tips'], "</td>
		<td>", $type, "</td>
		<td>", $data ['pid'], "</td>
		<td>", $pictype, "</td>
</tr>";
}
echo "</table>";
echo $page->fpage();
?>
</body>
</html>