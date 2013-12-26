<?php
require_once './source/common.inc.php';


/*
$sql = 'SELECT sid FROM skin';
$query = DB::query ( $sql );
while ( $result = DB::fetch ( $query ) ) {
    $cid = floor($result['sid']/100);
    $sid = $result['sid'];
    $ex = DB::result_first( "SELECT ex FROM `character` WHERE cid = {$cid}");
    $data = array (
		'ex' => $ex 
	);
    $update = DB::update ( '`skin`', $data, "sid='{$sid}'" );
    if ($update) {
    	echo $sid .'升级成功<br>';
    }
}
*/




