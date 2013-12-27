<?php
require_once './source/common.inc.php';
$title = "访客统计";
include SGS_ROOT . './template/default/header.php';
include SGS_ROOT . './template/default/nav.php';
echo '<div id="container" style="height: 400px; margin: 40px auto"></div>';
include SGS_ROOT . './template/default/footer.php';
function stats() {
	$count_data = "";
	for($i = 29; $i >= 0; $i --) {
		$time = mktime ( date ( "H" ), date ( "i" ), date ( "s" ), date ( "m" ), date ( "d" ) - $i, date ( "Y" ) );
		$times = date ( "m-d", $time );
		$timesy = date ( "Y", $time );
		$timesm = date ( "m", $time ) - 1;
		$timesd = date ( "d", $time );
		$data = DB::fetch_first ( "SELECT * FROM count WHERE date='$times'" );
		if ($data ['count'] == "") {
			$count = "0";
		} else {
			$count = $data ['count'];
		}
		$count_data .= "[Date.UTC({$timesy},{$timesm},{$timesd}),{$count}],";
	}
	return $count_data;
}
$stats = stats ();
?>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
var chart;chart=new Highcharts.Chart({chart:{renderTo:"container",backgroundColor:"#f0f0f0",type:"spline"},title:{text:"三国杀ol资料站 访客统计"},xAxis:{type:"datetime",dateTimeLabelFormats:{year:"%Y",month:"%b '%y",day:"%m-%d"}},yAxis:{title:{text:"访问量"},min:0},tooltip:{formatter:function(){return"<b>"+this.series.name+"</b><br/>"+Highcharts.dateFormat("%Y-%m-%d",this.x)+" PV: "+this.y+""}},series:[{name:"访问量",data:[<?php echo $stats; ?>]}],credits:{enabled:false},exporting:{enabled:false}});
</script>