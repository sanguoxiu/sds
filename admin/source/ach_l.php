<?php
/**********************************************/
//
// ach_l.php -- 战功查看
//
/**
 * *******************************************
 */
require_once 'header.php';
$num = DB::result_first ( "SELECT count(*) FROM `ach` " );
$page = new APage($num,20);


$sql = "SELECT * FROM `ach` {$page->limit};";
$result = DB::fetch_all ( $sql );

echo <<<SGS
<table border='1' bordercolor='#0000FF' width='80%' id='show'>
<tr>
		<td height='21'><b><font color='#800080'>战功id</font></b></td>
		<td height='21'><b><font color='#800080'>名字</font></b></td>
		<td height='21'><b><font color='#800080'>简介</font></b></td>
		<td height='21'><b><font color='#800080'>战功点</font></b></td>
		<td height='21'><b><font color='#800080'>图片id</font></b></td>
		<td height='21'><b><font color='#800080'>分类</font></b></td>
</tr>
SGS;

foreach ( $result as $data ) {
	switch ($data ['type']) {
		case "1" :
			$type = "综";
			break;
		case "2" :
			$type = "3v3";
			break;
		case "3" :
			$type = "1v1";
			break;
		case "4" :
			$type = "标";
			break;
		case "5" :
			$type = "风";
			break;
		case "6" :
			$type = "火";
			break;
		case "7" :
			$type = "林";
			break;
		case "8" :
			$type = "山";
			break;
		case "9" :
			$type = "SP";
			break;
		case "10" :
			$type = "将1";
			break;
		case "11" :
			$type = "将2";
			break;
		case "12" :
			$type = "将3";
			break;
		case "20" :
			$type = "神";
			break;
		case "99" :
			$type = "活";
			break;
	}
	echo "
<tr>
		<td>", $data ['achid'], "</td>
		<td>", $data ['name'], "</td>
		<td>", $data ['tips'], "</td>
		<td>", $data ['point'], "</td>
		<td>", $data ['pid'], "</td>
		<td>", $type, "</td>
</tr>";
}
echo "</table>";
echo $page->fpage();
?>
</body>
</html>