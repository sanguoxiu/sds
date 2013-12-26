<?php
/**********************************************/
//
// s_l.php -- 皮肤查看
//
/**
 * *******************************************
 */
require_once 'header.php';
$num = DB::result_first ( "SELECT count(*) FROM `skin` " );
$page = new APage($num,20);


$sql = "SELECT * FROM `skin` {$page->limit};";
$result = DB::fetch_all ( $sql );

echo <<<SGS
<table border='1' bordercolor='#0000FF' width='80%' id='show'>
<tr>
  <td height='21'><font color='#800080'><b>皮肤id</b></font></td>
		<td height='21'><b><font color='#800080'>皮肤名字</font></b></td>
		<td height='21'><b><font color='#800080'>皮肤简介</font></b></td>
</tr>
SGS;

foreach ( $result as $data ) {
	$date = date ( 'Y-m-d H:i:s', $data ['regtime'] );
	echo "
<tr>
		<td>", $data ['sid'], "</td>
		<td>", $data ['name'], "</td>
		<td>", $data ['tips'], "</td>

</tr>";
}
echo "</table>";
echo $page->fpage();
?>
</body>
</html>