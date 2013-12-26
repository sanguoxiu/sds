<?php
/**********************************************/
//
// c_l.php -- 武将查看
//
/**
 * *******************************************
 */
require_once 'header.php';
$num = DB::result_first ( "SELECT count(*) FROM `character` " );
$page = new APage($num,20);


$sql = "SELECT * FROM `character` {$page->limit};";
$result = DB::fetch_all ( $sql );

echo <<<SGS
<table border='1' bordercolor='#0000FF' width='80%' id='show'>
<tr>
  <td height='21'><font color='#800080'><b>武将id</b></font></td>
		<td height='21'><b><font color='#800080'>武将名字</font></b></td>
		<td height='21'><b><font color='#800080'>武将简介</font></b></td>
		<td height='21'><b><font color='#800080'>国籍</font></b></td>
		<td height='21'><b><font color='#800080'>类型</font></b></td>
</tr>
SGS;

foreach ( $result as $data ) {
	switch ($data ['ex']) {
		case "1" :
			$ex = "标";
			break;
		case "2" :
			$ex = "风";
			break;
		case "3" :
			$ex = "火";
			break;
		case "4" :
			$ex = "林";
			break;
		case "5" :
			$ex = "山";
			break;
		case "6" :
			$ex = "SP";
			break;
		case "7" :
			$ex = "将1";
			break;
		case "8" :
			$ex = "将2";
			break;
		case "9" :
			$ex = "将3";
			break;
		case "10" :
			$ex = "OL";
			break;
		case "11" :
			$ex = "3v3";
			break;
		case "12" :
			$ex = "新1v1";
			break;
		case "13" :
			$ex = "国战";
			break;
		case "99" :
			$ex = "其他";
			break;
	}
	switch ($data ['country']) {
		case "1" :
			$country = "魏";
			break;
		case "2" :
			$country = "蜀";
			break;
		case "3" :
			$country = "吴";
			break;
		case "4" :
			$country = "群";
			break;
		case "5" :
			$country = "神";
			break;
		case "6" :
			$country = "其他";
			break;
	}
	echo "
    <tr>
		<td>", $data ['cid'], "</td>
		<td>", $data ['name'], "</td>
		<td>", $data ['tips'], "</td>
		<td>", $country, "</td>
		<td>", $ex, "</td>
</tr>";
}
echo "</table>";
echo $page->fpage();
?>
</body>
</html>