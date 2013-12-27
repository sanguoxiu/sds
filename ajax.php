<?php
error_reporting (0);  //防止报错后，影响json输出！
// define ( 'NO_COUNT', true );
require_once './source/common.inc.php';
if (! $_SESSION ['uid']) {
	exit ( 'Access Denied' );
}
$action = daddslashes ( $_GET ['a'] );
$key = daddslashes ( $_GET ['k'] );
$hash = daddslashes ( $_GET ['hash'] );
if ($hash != $formhash) {
	echo '99';
	exit ();
}
if ($action == 'list') {
	if (MCACHE::isAvailable ( $action.$key )) {
		$data = MCACHE::get ( $action.$key );
    } else {
		$param = explode ( '_', $key );
		if ($param [0] == 'c') {
			$table = 'character';
			if ($param [1] == 'c') {
				$type = 'country';
			} else if ($param [1] == 'e') {
				$type = 'ex';
			}
		} else if ($param [0] == 'a') {
			$table = 'avatarshow';
			$type = 'type';
		} else if ($param [0] == 'ach') {
			$table = 'ach';
			if ($param [1] == 't') {
				$type = 'type';
			} else if ($param [1] == 'e') {
				$type = 'ex';
			}
		} else if ($param [0] == 's') {
			$table = 'skin';
			if ($param [1] == 'c') {
				$type = 'country';
			} else if ($param [1] == 'e') {
				$type = 'ex';
			}
		}
		$value = $param [2];
		
		$data = array ();
		$sql = "SELECT * FROM `{$table}` WHERE {$type} = '{$value}' ORDER BY {$param[0]}id";
		$query = DB::query ( $sql );
		while ( $result = DB::fetch ( $query ) ) {
			$data [] = $result;
		}
        MCACHE::save ( $action.$key, $data );
	}
	echo json_encode ( $data );
} else if ($action == 'info') {
	if (MCACHE::isAvailable ( $action.$key )) {
		$data = MCACHE::get ( $action.$key );
	} else {
		$param = explode ( '_', $key );
		if ($param [0] == 'c') {
			$table = 'character';
			$value = $param [1];
			$data = array ();
			$sql = "SELECT * FROM `{$table}` WHERE {$param[0]}id = '{$value}' ";
			// echo $sql;
			$query = DB::query ( $sql );
			$result = DB::fetch ( $query );
			$cid = $result ['cid'];
			$score = DB::result_first ( "SELECT SUM(value) FROM `score_character` WHERE cid = '{$cid}' " );
			$amount = DB::result_first ( "SELECT COUNT(`value`) FROM `score_character` WHERE cid = '{$cid}' " );
			$average = $score / $amount;
			$average_score = round ( $average, 1 );
			$v_average_score = round ( $average_score, 0 );
			$amount = array (
					'amount' => $amount 
			);
			$result = array_merge ( $result, $amount );
			$average_score = array (
					'average_score' => $average_score 
			);
			$result = array_merge ( $result, $average_score );
			$v_average_score = array (
					'v_average_score' => $v_average_score 
			);
			$result = array_merge ( $result, $v_average_score );
			$data [] = $result;
			MCACHE::save ( $action.$key, $data );
		} else if ($param [0] == 'ach') {
			$table = 'ach';
			$value = $param [1];
			$data = array ();
			$sql = "SELECT * FROM `{$table}` WHERE {$param[0]}id = '{$value}' ";
			// echo $sql;
			$query = DB::query ( $sql );
			$result = DB::fetch ( $query );
			$achid = $result ['achid'];
			$score = DB::result_first ( "SELECT SUM(value) FROM `score_ach` WHERE achid = '{$achid}' " );
			$amount = DB::result_first ( "SELECT COUNT(`value`) FROM `score_ach` WHERE achid = '{$achid}' " );
			$average = $score / $amount;
			$average_score = round ( $average, 1 );
			$v_average_score = round ( $average_score, 0 );
			$amount = array (
					'amount' => $amount 
			);
			$result = array_merge ( $result, $amount );
			$average_score = array (
					'average_score' => $average_score 
			);
			$result = array_merge ( $result, $average_score );
			$v_average_score = array (
					'v_average_score' => $v_average_score 
			);
			$result = array_merge ( $result, $v_average_score );
			$time_s = array (
					'time_s' => date ( 'Ymd', $result ['time_s'] ) 
			);
			$result = array_merge ( $result, $time_s );
			$time_e = array (
					'time_e' => date ( 'Ymd', $result ['time_e'] ) 
			);
			$result = array_merge ( $result, $time_e );
			$data [] = $result;
			MCACHE::save ( $action.$key, $data );
		} else if ($param [0] == 'a') {
			$table = 'avatarshow';
			$value = $param [1];
			$data = array ();
			$sql = "SELECT * FROM `{$table}` WHERE {$param[0]}id = '{$value}' ";
			// echo $sql;
			$query = DB::query ( $sql );
			$result = DB::fetch ( $query );
			$aid = $result ['aid'];
			$score = DB::result_first ( "SELECT SUM(value) FROM `score_avatarshow` WHERE aid = '{$aid}' " );
			$amount = DB::result_first ( "SELECT COUNT(`value`) FROM `score_avatarshow` WHERE aid = '{$aid}' " );
			$average = $score / $amount;
			$average_score = round ( $average, 1 );
			$v_average_score = round ( $average_score, 0 );
			$amount = array (
					'amount' => $amount 
			);
			$result = array_merge ( $result, $amount );
			$average_score = array (
					'average_score' => $average_score 
			);
			$result = array_merge ( $result, $average_score );
			$v_average_score = array (
					'v_average_score' => $v_average_score 
			);
			$result = array_merge ( $result, $v_average_score );
			$data [] = $result;
			MCACHE::save ( $action.$key, $data );
		} else if ($param [0] == 's') {
			$table = 'skin';
			$value = $param [1];
			$data = array ();
			$sql = "SELECT * FROM `{$table}` WHERE {$param[0]}id = '{$value}' ";
			// echo $sql;
			$query = DB::query ( $sql );
			$result = DB::fetch ( $query );
			$sid = $result ['sid'];
			$score = DB::result_first ( "SELECT SUM(value) FROM `score_skin` WHERE sid = '{$sid}' " );
			$amount = DB::result_first ( "SELECT COUNT(`value`) FROM `score_skin` WHERE sid = '{$sid}' " );
			$average = $score / $amount;
			$average_score = round ( $average, 1 );
			$v_average_score = round ( $average_score, 0 );
			$amount = array (
					'amount' => $amount 
			);
			$result = array_merge ( $result, $amount );
			$average_score = array (
					'average_score' => $average_score 
			);
			$result = array_merge ( $result, $average_score );
			$v_average_score = array (
					'v_average_score' => $v_average_score 
			);
			$result = array_merge ( $result, $v_average_score );
			$data [] = $result;
			MCACHE::save ( $action.$key, $data );
		}
	}
	echo json_encode ( $data );
} else if ($action == 'shop') {
	if (MCACHE::isAvailable ( $action.$key )) {
		$data = MCACHE::get ( $action.$key );
	} else {
		$param = explode ( '_', $key );
		if ($param [0] == 'c') {
			$table = 'shop_c';
			$value = $param [1];
			$data = array ();
			$sql = "SELECT * FROM `{$table}` WHERE {$param[0]}id = '{$value}' ORDER BY time_s";
			// echo $sql;
			$query = DB::query ( $sql );
			while ( $result = DB::fetch ( $query ) ) {
				$time_s = array (
						'time_s' => date ( 'Ymd', $result ['time_s'] ) 
				);
				$result = array_merge ( $result, $time_s );
				$time_e = array (
						'time_e' => date ( 'Ymd', $result ['time_e'] ) 
				);
				$result = array_merge ( $result, $time_e );
				$data [] = $result;
			}
			MCACHE::save ( $action.$key, $data );
		} else if ($param [0] == 'ach') {
			$table = 'shop_ach';
			$value = $param [1];
			$data = array ();
			$sql = "SELECT * FROM `{$table}` WHERE {$param[0]}id = '{$value}' ";
			$query = DB::query ( $sql );
			while ( $result = DB::fetch ( $query ) ) {
				$data [] = $result;
			}
			MCACHE::save ( $action.$key, $data );
		} else if ($param [0] == 'a') {
			$table = 'shop_a';
			$value = $param [1];
			$data = array ();
			$sql = "SELECT * FROM `shop_a` WHERE {$param[0]}id = '{$value}' ORDER BY time_s";
			// echo $sql;
			$query = DB::query ( $sql );
			while ( $result = DB::fetch ( $query ) ) {
				$time_s = array (
						'time_s' => date ( 'Ymd', $result ['time_s'] ) 
				);
				$result = array_merge ( $result, $time_s );
				$time_e = array (
						'time_e' => date ( 'Ymd', $result ['time_e'] ) 
				);
				$result = array_merge ( $result, $time_e );
				$data [] = $result;
			}
			MCACHE::save ( $action.$key, $data );
		} else if ($param [0] == 's') {
			$table = 'shop_s';
			$value = $param [1];
			$data = array ();
			$sql = "SELECT * FROM `{$table}` WHERE {$param[0]}id = '{$value}' ";
			// echo $sql;
			$query = DB::query ( $sql );
			while ( $result = DB::fetch ( $query ) ) {
				$time_s = array (
						'time_s' => date ( 'Ymd', $result ['time_s'] ) 
				);
				$result = array_merge ( $result, $time_s );
				$time_e = array (
						'time_e' => date ( 'Ymd', $result ['time_e'] ) 
				);
				$result = array_merge ( $result, $time_e );
				$data [] = $result;
			}
			MCACHE::save ( $action.$key, $data );
		}
	}
	echo json_encode ( $data );
} else if ($action == 'save_isgx') {
	$save_uid = daddslashes ( $_POST ['uid'] );
	$save_data = daddslashes ( $_POST ['data'] );
	$save_time = daddslashes ( $_POST ['time'] );
	$save_param = explode ( '|', $save_data );
	$save_bk = $save_param [0];
	$save_bj = $save_param [1];
	$save_xx = $save_param [2];
	if (preg_match ( '/[^\d- ]/', $save_bk )) {
		echo '7';
		exit ();
	}
	if (preg_match ( '/[^\d- ]/', $save_bj )) {
		echo '7';
		exit ();
	}
	if (preg_match ( '/[^\d- ]/', $save_xx )) {
		echo '7';
		exit ();
	}
	if (! $save_bk) {
		echo '2';
		exit ();
	}
	if (! $save_bj) {
		echo '3';
		exit ();
	}
	if (! $save_xx) {
		echo '4';
		exit ();
	}
	if ($save_uid != $_SESSION ['uid']) {
		echo '7';
		exit ();
	}
	if (TIMESTAMP - $save_time > 300) {
		echo '8';
		exit ();
	}
	$result = DB::fetch_first ( "SELECT * FROM `sgx_save` WHERE uid = '{$save_uid}' AND data = '{$save_data}' " );
	if ($result) {
		echo '5';
		exit ();
	}
	$last = DB::fetch_first ( "SELECT * FROM `sgx_save` WHERE uid = '{$save_uid}' ORDER BY time DESC " );
	if (TIMESTAMP - $last ['time'] < 10) {
		echo '6';
		exit ();
	}
	$amount = DB::result_first ( "SELECT COUNT('data') FROM `sgx_save` WHERE uid = '{$save_uid}' " );
	if ($amount > 500) {
		echo '9';
		exit ();
	}
	$insert = DB::insert ( 'sgx_save', array (
			'uid' => $save_uid,
			'data' => $save_data,
			"time" => TIMESTAMP 
	) );
	if ($insert) {
		echo '1';
		exit ();
	} else {
		echo '10';
		exit ();
	}
	/* 
     case "1" : result_text = "保存成功！"; break;
     case "2" : result_text = "边框没有选择！"; break;
     case "3" : result_text = "背景没有选择！"; break;
     case "4" : result_text = "形象没有选择！"; break;
     case "5" : result_text = "这套形象已经保存过了！"; break;
     case "6" : result_text = "操作过于频繁，请稍候再试"; break;
     case "7" : result_text = "非法请求！"; break;
     case "8" : result_text = "请求超时！"; break;
     case "9" : result_text = "最多保存500套三国秀！"; break;
     case "10" : result_text = "未知错误！"; break;
	 */
} else if ($action == 'get_isgx') {
	$get_uid = daddslashes ( $_GET ['k'] );
	if ($get_uid != $_SESSION ['uid'])
		exit ();
	$num = DB::result_first ( "SELECT count(*) FROM sgx_save WHERE uid = '{$get_uid}' " );
    if ($num != 0 ){
		$page = new Page($num, 10);
    	$data = array ();
    	$sql = "SELECT * FROM `sgx_save` WHERE uid = '{$get_uid}' ORDER BY id DESC {$page->limit} ";
    	$query = DB::query ( $sql );
		while ( $result = DB::fetch ( $query ) ) {
			$time = array (
					'time' => date ( 'Y-m-d', $result ['time'] ) 
			);
			$result = array_merge ( $result, $time );
			$data [] = $result;
		}
    } else {
    	$data [] ='';
    }
	echo json_encode ( $data );
} else if ($action == 'get_isgx_page') {
	$get_uid = daddslashes ( $_GET ['k'] );
	if ($get_uid != $_SESSION ['uid'])
		exit ();
	$num = DB::result_first ( "SELECT count(*) FROM sgx_save WHERE uid = '{$get_uid}' " );
	$page = new Page($num, 10, 'isgxPage', 'get_isgx');
    $fpage = $page->fpage(array(3,4,5,6,7,2,8));
    if ($num != 0 ){
    	echo $fpage . '<div id="delete_bar" class="delete_bar"><a href="javascript:void(0);" onclick="isgx_delete_show()">点我进入删除模式</a></div>';
    }
} else if ($action == 'isgx_delete') {
	$uid = $_SESSION ['uid'];
	$id = daddslashes ( $_POST ['id'] );
	$result = DB::fetch_first ( "SELECT * FROM `sgx_save` WHERE id = '{$id}' AND uid = '{$uid}' " );
	if (! $result) {
		echo '2';
		exit ();
	}
	$data = array (
			'id' => $id,
			'uid' => $uid 
	);
	$delete = DB::delete ( 'sgx_save', $data, 1 );
	if ($delete) {
		echo '1';
	} else {
		echo '12';
	}
} else if ($action == 'get_osgx') {
	$uid = daddslashes ( $_GET ['k'] );
	$result = DB::fetch_first ( "SELECT * FROM `sgx_save` WHERE uid = '{$uid}' " );
    if ($result) {
		$uid = $uid;
    } else {
		$search_uid_result = DB::result_first ( "SELECT uid FROM `member` WHERE username = '{$uid}' " );
        if ($search_uid_result) {
        	$uid = $search_uid_result;
        } else {
        	$uid = 0;
        }

	}
    if ($uid != 0) {
		$num = DB::result_first ( "SELECT count(*) FROM sgx_save WHERE uid = '{$uid}' " );
		$page = new Page($num, 10);
		$sql = "SELECT * FROM `sgx_save` WHERE uid = '{$uid}' ORDER BY id DESC {$page->limit}";
    } else {
		$sql = "SELECT * FROM `sgx_save` WHERE uid = '{$uid}' ORDER BY id DESC";
    }
	$data = array ();
	$query = DB::query ( $sql );
	while ( $result = DB::fetch ( $query ) ) {
        $username = DB::result_first ( "SELECT username FROM `member` WHERE uid = {$result['uid']} " );
		$time = array (
				'time' => date ( 'Y-m-d', $result ['time'] ) 
		);
		$result = array_merge ( $result, $time );
        $username = array (
				'username' => $username
		);
		$result = array_merge ( $result, $username );
		$data [] = $result;
	}
	echo json_encode ( $data );    
} else if ($action == 'get_osgx_page') {
	$uid = daddslashes ( $_GET ['k'] );
	$result = DB::fetch_first ( "SELECT * FROM `sgx_save` WHERE uid = '{$uid}' " );
    if ($result) {
		$uid = $uid;
    } else {
		$search_uid_result = DB::result_first ( "SELECT uid FROM `member` WHERE username = '{$uid}' " );
        if ($search_uid_result) {
        	$uid = $search_uid_result;
        } else {
        	$uid = 0;
        }

	}
    if ($uid != 0) {
    	$num = DB::result_first ( "SELECT count(*) FROM sgx_save WHERE uid = '{$uid}' " );
		$page = new Page($num, 10, 'osgxPage', 'get_osgx');
        $fpage = $page->fpage(array(3,4,5,6,7,2,8));
    } else {
		$fpage = '';
    }
    echo $fpage . '请输入他人uid或者用户名：<input type="text" value="" id="osgx_search_text" name="search_text" maxlength="50" class="input_text" /><input id="osgx_search_submit" type="submit" class="input_submit" onclick="osgxPage(\'get_osgx\');" value="查看" />';
} else if ($action == 'get_all_save') {
	$num = DB::result_first ( "SELECT count(*) FROM sgx_save " );
	$page = new Page($num, 10);
    $data = array ();
    $sql = "SELECT * FROM `sgx_save` ORDER BY id DESC {$page->limit} ";
    $query = DB::query ( $sql );
	while ( $result = DB::fetch ( $query ) ) {
        $username = DB::result_first ( "SELECT username FROM `member` WHERE uid = {$result['uid']} " );
        /*$sgxid = $result ['id'];
		$score = DB::result_first ( "SELECT SUM(value) FROM `score_skin` WHERE sid = '{$sgxid}' " );
		$amount = DB::result_first ( "SELECT COUNT(`value`) FROM `score_skin` WHERE sid = '{$sgxid}' " );
		$average = $score / $amount;
		$average_score = round ( $average, 1 );
		$v_average_score = round ( $average_score, 0 );
		$amount = array (
				'amount' => $amount 
		);
		$result = array_merge ( $result, $amount );
		$average_score = array (
				'average_score' => $average_score 
		);
		$result = array_merge ( $result, $average_score );
		$v_average_score = array (
				'v_average_score' => $v_average_score 
		);
		$result = array_merge ( $result, $v_average_score );*/
		$time = array (
			'time' => date ( 'Y-m-d', $result ['time'] ) 
		);
		$result = array_merge ( $result, $time );
        $username = array (
			'username' => $username
		);
		$result = array_merge ( $result, $username );
		$data [] = $result;
	}    
	echo json_encode ( $data );
} else if ($action == 'get_all_save_page') {
	$num = DB::result_first ( "SELECT count(*) FROM sgx_save " );
	$page = new Page($num, 10, 'get_all_save_page', 'get_all_save');
	$fpage = $page->fpage(array(3,4,5,6,7,2,8));
    echo $fpage;
} else if ($action == 'check_save_num') {
	$uid = $_SESSION ['uid'];
	$data_num = DB::result_first ( "SELECT COUNT(data) FROM `sgx_save` WHERE uid = '{$uid}' " );
	echo $data_num;
} else if ($action == 'score_a') {
	$point = daddslashes ( $_POST ['v'] );
	$name = daddslashes ( $_POST ['a_n'] );
	$param = explode ( "_", $name );
	$uid = $_SESSION ['uid'];
	$aid = $param [1];
	if ($point == "" || $name == "") {
		echo '3';
		exit ();
	}
	if ($point != "1" && $point != "2" && $point != "3" && $point != "4" && $point != "5") {
		echo "2";
		exit ();
	}
	if ($param [0] != "a") {
		echo '2';
		exit ();
	}
	if (preg_match ( '/[^\d- ]/', $param [1] )) {
		echo '2';
		exit ();
	}
	$result = DB::fetch_first ( "SELECT * FROM `score_avatarshow` WHERE uid = '{$uid}' AND aid = '{$aid}' " );
	if ($result) {
		echo '4';
		exit ();
	}
	$insert = DB::insert ( 'score_avatarshow', array (
			'uid' => $uid,
			'aid' => $aid,
			"value" => $point 
	) );
	if ($insert) {
        MCACHE::delete('infoa_'.$aid);
		echo "1";
	} else {
		echo "5";
	}
	/*
	case "1" : result_text = "评分成功"; break;
	case "2" : result_text = "非法请求"; break;
	case "3" : result_text = "缺少参数"; break;
	case "4" : result_text = "您已评过"; break;
	case "5" : result_text = "未知错误"; break;
	*/
} else if ($action == 'score_c') {
	$point = daddslashes ( $_POST ['v'] );
	$name = daddslashes ( $_POST ['a_n'] );
	$param = explode ( "_", $name );
	$uid = $_SESSION ['uid'];
	$cid = $param [1];
	if ($point == "" || $name == "") {
		echo '3';
		exit ();
	}
	if ($point != "1" && $point != "2" && $point != "3" && $point != "4" && $point != "5") {
		echo "2";
		exit ();
	}
	if ($param [0] != "c") {
		echo '2';
		exit ();
	}
	if (preg_match ( '/[^\d- ]/', $param [1] )) {
		echo '2';
		exit ();
	}
	$result = DB::fetch_first ( "SELECT * FROM `score_character` WHERE uid = '{$uid}' AND cid = '{$cid}' " );
	if ($result) {
		echo '4';
		exit ();
	}
	$insert = DB::insert ( 'score_character', array (
			'uid' => $uid,
			'cid' => $cid,
			"value" => $point 
	) );
	if ($insert) {
		echo "1";
        MCACHE::delete('infoc_'.$cid);
	} else {
		echo "5";
	}
	/*
	 case "1" : result_text = "评分成功"; break;
     case "2" : result_text = "非法请求"; break;
     case "3" : result_text = "缺少参数"; break;
     case "4" : result_text = "您已评过"; break;
     case "5" : result_text = "未知错误"; break;
	 */
} else if ($action == 'score_s') {
	$point = daddslashes ( $_POST ['v'] );
	$name = daddslashes ( $_POST ['a_n'] );
	$param = explode ( "_", $name );
	$uid = $_SESSION ['uid'];
	$sid = $param [1];
	if ($point == "" || $name == "") {
		echo '3';
		exit ();
	}
	if ($point != "1" && $point != "2" && $point != "3" && $point != "4" && $point != "5") {
		echo "2";
		exit ();
	}
	if ($param [0] != "s") {
		echo '2';
		exit ();
	}
	if (preg_match ( '/[^\d- ]/', $param [1] )) {
		echo '2';
		exit ();
	}
	$result = DB::fetch_first ( "SELECT * FROM `score_skin` WHERE uid = '{$uid}' AND sid = '{$sid}' " );
	if ($result) {
		echo '4';
		exit ();
	}
	$insert = DB::insert ( 'score_skin', array (
			'uid' => $uid,
			'sid' => $sid,
			"value" => $point 
	) );
	if ($insert) {
		echo "1";
        MCACHE::delete('infos_'.$sid);
	} else {
		echo "5";
	}
	/*
	 case "1" : result_text = "评分成功"; break;
     case "2" : result_text = "非法请求"; break;
     case "3" : result_text = "缺少参数"; break;
     case "4" : result_text = "您已评过"; break;
     case "5" : result_text = "未知错误"; break;
	 */
} else if ($action == 'score_ach') {
	$point = daddslashes ( $_POST ['v'] );
	$name = daddslashes ( $_POST ['a_n'] );
	$param = explode ( "_", $name );
	$uid = $_SESSION ['uid'];
	$achid = $param [1];
	if ($point == "" || $name == "") {
		echo '3';
		exit ();
	}
	if ($point != "1" && $point != "2" && $point != "3" && $point != "4" && $point != "5") {
		echo "2";
		exit ();
	}
	if ($param [0] != "ach") {
		echo '2';
		exit ();
	}
	if (preg_match ( '/[^\d- ]/', $param [1] )) {
		echo '2';
		exit ();
	}
	$result = DB::fetch_first ( "SELECT * FROM `score_ach` WHERE uid = '{$uid}' AND achid = '{$achid}' " );
	if ($result) {
		echo '4';
		exit ();
	}
	$insert = DB::insert ( 'score_ach', array (
			'uid' => $uid,
			'achid' => $achid,
			"value" => $point 
	) );
	if ($insert) {
		echo "1";
        MCACHE::delete('infoach_'.$achid);
	} else {
		echo "5";
	}
	/*
	case "1" : result_text = "评分成功"; break;
    case "2" : result_text = "非法请求"; break;
    case "3" : result_text = "缺少参数"; break;
    case "4" : result_text = "您已评过"; break;
    case "5" : result_text = "未知错误"; break;
	 */
} else if ($action == 'sgx_sina_share') {
	$c = new SaeTClientV2 ( WB_AKEY, WB_SKEY, $_SESSION ['token'] ['access_token'] );
	$share_data = daddslashes ( $_POST ['data'] );
	$share_param = explode ( '|', $share_data );
	$share_bk = $share_param [0];
	$share_bj = $share_param [1];
	$share_xx = $share_param [2];
	$share_bk_name = $share_param [5];
	$share_bj_name = $share_param [6];
	$share_xx_name = $share_param [7];
	if (preg_match ( '/[^\d- ]/', $share_bk )) {
		echo '7';
		exit ();
	}
	if (preg_match ( '/[^\d- ]/', $share_bj )) {
		echo '7';
		exit ();
	}
	if (preg_match ( '/[^\d- ]/', $share_xx )) {
		echo '7';
		exit ();
	}
	if (! $share_bk || ! $share_bk_name) {
		echo '2';
		exit ();
	}
	if (! $share_bj || ! $share_bj_name) {
		echo '3';
		exit ();
	}
	if (! $share_xx || ! $share_xx_name) {
		echo '4';
		exit ();
	}
	if ($share_param [3] == "2" || $share_param [4] == "2") {
		echo '11';
		exit ();
	}
	$text = "三国秀搭配大比拼！{$share_bk_name}+{$share_bj_name}+{$share_xx_name}，这套三国秀是不是很漂亮呢！！ 三国杀ol资料站有更多三国秀搭配哦~ @三国杀ol资料站";
	$url = "http://sanguosha.sinaapp.com/images/{$share_bk}-{$share_bj}-{$share_xx}.png";
	$ret = $c->upload_url_text ( $text, $url );
	if (isset ( $ret ['error_code'] ) && $ret ['error_code'] > 0) {
		echo '12';
	} else {
		echo '1';
	}
} else if ($action == 'skin_sina_share') {
	$c = new SaeTClientV2 ( WB_AKEY, WB_SKEY, $_SESSION ['token'] ['access_token'] );
	$sid = daddslashes ( $_POST ['sid'] );
	$sname = daddslashes ( $_POST ['sname'] );
	$param = explode ( '*', $sname );
	if (preg_match ( '/[^\d- ]/', $sid )) {
		echo '7';
		exit ();
	}
	if (! $sid) {
		echo '2';
		exit ();
	}
	if ($share_param [3] == "2" || $share_param [4] == "2") {
		echo '11';
		exit ();
	}
	$text = "{$param[0]}，三国杀online{$param[1]}皮肤来袭！皮肤好不好，你说了算！！ @三国杀ol资料站";
	$url = "http://web.sanguosha.com/220/assets/winnerGeneral/full/{$sid}.png";
	$ret = $c->upload_url_text ( $text, $url );
	if (isset ( $ret ['error_code'] ) && $ret ['error_code'] > 0) {
        //echo $ret ['error_code'];
		echo '12';
	} else {
		echo '1';
	}
} else if ($action == 'search_text') {
	$search_name = daddslashes ( $_GET ['n'] );
	$search_type = daddslashes ( $_GET ['t'] );
	if (! $search_name) {
		exit ();
	}
	if ($search_type != 'character' && $search_type != 'avatarshow' && $search_type != 'ach' && $search_type != 'skin') {
		exit ();
	}
	$data = array ();
	$sql = "SELECT * FROM `{$search_type}` WHERE name LIKE '%{$search_name}%' ";
	$query = DB::query ( $sql );
	while ( $result = DB::fetch ( $query ) ) {
		$data [] = $result;
	}
	echo json_encode ( $data );
}
