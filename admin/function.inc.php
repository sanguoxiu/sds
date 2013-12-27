<?php

function check_permission($a) {
	$param = explode ( "_", $a );
	switch ($param [1]) {
        case "l" : //查看
			$need_permission = "1,2,3";
        	break;
        case "a" : //添加
			$need_permission = "1,2";
        	break;
        case "add" : //三国秀商城添加
			$need_permission = "1,2";
        	break;
        case "m" : //修改
			$need_permission = "1";
        	break;
        case "d" : //删除
			$need_permission = "1";
        	break;
        case "week" : //周免
			$need_permission = "1,2";
        	break;
        case "trial" : //试用
			$need_permission = "1,2";
        	break;
        case "final" : //正式
			$need_permission = "1,2";
        	break;
        case "yinliang" : //银两
			$need_permission = "1,2";
        	break;
        case "auto" : //智能更新
			$need_permission = "1,2";
        	break;
	}
	$premission = explode ( ",", $need_permission );
	if (! in_array ( $_SESSION ['admin'], $premission )) {
		echo ( '权限不足' );
        exit();
	}
}
function admin_echo($a) {
	$param = explode ( "_", $a );
    if ($param[1] != 'l') {
		TEXT::$a();
    }
}


/**
 * ***************************************** 帐号管理函数开始 ******************************************
 */
function m_a() { // 添加帐号
	if ($_POST) {
		if (! $_POST ['username']) {
			echo '帐号不能为空';
		} elseif (! $_POST ['password']) {
			echo '密码不能为空';
		} else {
			$uid = daddslashes ( $_POST ['uid'] );
			$username = daddslashes ( $_POST ['username'] );
			$password = md5 ( ENCRYPT_KEY . md5 ( $_POST ['password'] ) . ENCRYPT_KEY );
			$adminid = daddslashes ( $_POST ['adminid'] );
			if (! $username || ! $password || !isset($adminid) ) {
				echo "信息不完整";
				exit ();
			}
			if ($adminid != '0' && $adminid != '99' ) {
				echo "权限选择错误";
				exit ();
			}
			if (preg_match ( '/[<>\'\\"]/i', $username ))
				showmessage ( '用户名中有被禁止使用的关键字', 'index.php' );
			if (strlen ( $username ) < 6) {
				echo '用户名至少要6个字符(即2个中文 或 6个英文)，请修改';
				exit ();
			}
			if (strlen ( $username ) > 15) {
				echo '用户名过长，不得超过15个字符';
				exit ();
			}
			$user = DB::fetch_first ( "SELECT * FROM `member` WHERE `username`='{$username}'" );
			if ($user) {
				echo '用户名已经存在';
				exit ();
			}
			$uid = DB::insert ( 'member', array (
					'username' => $username,
					'password' => $password,
					'adminid' => $adminid,
					'regip' => "手动添加",
					'regtime' => TIMESTAMP,

			) );
			echo "新账号：{$username} 添加成功！";
		}
	}
}
function m_m() { // 修改信息
	if ($_POST) {
		if (! $_POST ['uid']) {
			echo 'uid不能为空';
		} else {
			$uid = daddslashes ( $_POST ['uid'] );
			$username = daddslashes ( $_POST ['username'] );
			$password = md5 ( ENCRYPT_KEY . md5 ( $_POST ['password'] ) . ENCRYPT_KEY );
			$adminid = daddslashes ( $_POST ['adminid'] );
			$data = array (
					'uid' => $uid 
			);
			if ($username) {
				$m_username = array (
						'username' => $username 
				);
				$data += $m_username;
			}
			if ($_POST ['password']) {
				$m_password = array (
						'password' => $password 
				);
				$data += $m_password;
			}
			if ($adminid) {
				$m_adminid = array (
						'adminid' => $adminid 
				);
				$data += $m_adminid;
			}
			if ($adminid == "0") {
				$m_adminid2 = array (
						'adminid' => $adminid 
				);
				$data += $m_adminid2;
			}
			if (! $username && ! $password && !isset($adminid) ) {
				echo "至少有一项要修改";
				exit ();
			}
			$user = DB::fetch_first ( "SELECT * FROM `member` WHERE `uid`='{$uid}'" );
			if (! $user) {
				echo '用户名不存在';
				exit ();
			}
			if ($user ['uid'] == "1") {
				echo "作死！竟敢修改这个帐号！！！";
				exit ();
			}
			$uid = DB::update ( 'member', $data, "`uid`='{$uid}'" );
			echo "帐号：{$user['username']} 的信息修改成功！";
		}
	}
}
function m_d() { // 删除帐号
	if ($_POST) {
		if (! $_POST ['username']) {
			echo '帐号不能为空';
		} else {
			$username = daddslashes ( $_POST ['username'] );
			if (! $username) {
				echo "信息不完整";
				exit ();
			}
			$user = DB::fetch_first ( "SELECT * FROM `member` WHERE `username`='{$username}'" );
			if (! $user) {
				echo '用户名不存在';
				exit ();
			}
			if ($user ['adminid'] == "1" || $user ['adminid'] == "2" || $user ['adminid'] == "3") {
				echo "管理员帐号不能被删除";
				exit ();
			}
			$uid = DB::delete ( 'member', "username='{$username}'" );
			echo "帐号：{$username} 删除成功！";
		}
	}
}

/**
 * ***************************************** 帐号管理函数结束 ******************************************
 */

/**
 * ***************************************** 三国秀管理函数开始 ******************************************
 */
function a_a() { // 添加三国秀
	if ($_POST) {
		if (! $_POST ['aid']) {
			echo '三国秀id不能为空';
		} elseif (! $_POST ['name']) {
			echo '名字不能为空';
		} else {
			$aid = daddslashes ( $_POST ['aid'] );
			$name = daddslashes ( $_POST ['name'] );
			$tips = daddslashes ( $_POST ['tips'] );
			$type = daddslashes ( $_POST ['type'] );
			$pid = daddslashes ( $_POST ['pid'] );
			$pictype = daddslashes ( $_POST ['pictype'] );
			if (! $aid || ! $name || ! $type || ! $pid || ! $pictype) {
				echo "信息不完整";
				exit ();
			}
			if (strlen ( $name ) > 24) {
				echo '名字过长，不得超过24个字符';
				exit ();
			}
			$result = DB::fetch_first ( "SELECT * FROM `avatarshow` WHERE `aid`='{$aid}'" );
			if ($result) {
				echo '这个三国秀已经存在了';
				exit ();
			}
			$a = DB::insert ( 'avatarshow', array (
					'aid' => $aid,
					'name' => $name,
					'tips' => $tips,
					'type' => $type,
					'pid' => $pid,
					'pictype' => $pictype,
					'time' => TIMESTAMP,

			) );
			echo "三国秀：{$name} 添加成功！";
            switch($type) {
                case '1' : $d_type = 'a';break;
                case '2' : $d_type = 'b';break;
                default  : $d_type = 'c';break;
            }
            delete_memcache('list', 'a', $d_type, $type);
            delete_memcache('info', 'a', '', $aid);
		}
	}
}
function a_m() { // 修改三国秀
	if ($_POST) {
		if (! $_POST ['aid']) {
			echo 'aid不能为空';
		} else {
			$aid = daddslashes ( $_POST ['aid'] );
			$name = daddslashes ( $_POST ['name'] );
			$tips = daddslashes ( $_POST ['tips'] );
			$type = daddslashes ( $_POST ['type'] );
			$pid = daddslashes ( $_POST ['pid'] );
			$pictype = daddslashes ( $_POST ['pictype'] );
			$data = array (
					'aid' => $aid 
			);
			if ($name) {
				$a_name = array (
						'name' => $name 
				);
				$data += $a_name;
			}
			if ($tips) {
				$a_tips = array (
						'tips' => $tips 
				);
				$data += $a_tips;
			}
			if ($type) {
				$a_type = array (
						'type' => $type 
				);
				$data += $a_type;
			}
			if ($pid) {
				$a_pid = array (
						'pid' => $pid 
				);
				$data += $a_pid;
			}
			if ($pictype) {
				$a_pictype = array (
						'pictype' => $pictype 
				);
				$data += $a_pictype;
			}
			if (! $name && ! $tips && ! $type && ! $pid && ! $pictype) {
				echo "至少有一项要修改";
				exit ();
			}
			$result = DB::fetch_first ( "SELECT * FROM `avatarshow` WHERE `aid`='{$aid}'" );
			if (! $result) {
				echo '三国秀不存在';
				exit ();
			}
			$uid = DB::update ( 'avatarshow', $data, "aid='{$aid}'" );
			echo "三国秀：{$result['name']} 的信息修改成功！";
            switch($result['type']) {
                case '1' : $d_type = 'a';break;
                case '2' : $d_type = 'b';break;
                default  : $d_type = 'c';break;
            }
            delete_memcache('list', 'a', $d_type, $result['type']);
            delete_memcache('info', 'a', '', $aid);
        }
	}
}
function a_d() { // 删除三国秀
	if ($_POST) {
		if (! $_POST ['aid']) {
			echo '三国秀不能为空';
		} else {
			$aid = daddslashes ( $_POST ['aid'] );
			if (! $aid) {
				echo "信息不完整";
				exit ();
			}
			$result = DB::fetch_first ( "SELECT * FROM `avatarshow` WHERE `aid`='{$aid}'" );
			if (! $result) {
				echo '三国秀不存在';
				exit ();
			}
			$uid = DB::delete ( 'avatarshow', "aid='{$aid}'" );
			echo "三国秀：{$result['name']} 删除成功！";
            switch($result['type']) {
                case '1' : $d_type = 'a';break;
                case '2' : $d_type = 'b';break;
                default  : $d_type = 'c';break;
            }
            delete_memcache('list', 'a', $d_type, $result['type']);
            delete_memcache('info', 'a', '', $aid);
		}
	}
}

/**
 * ***************************************** 三国秀管理函数结束 ******************************************
 */

 
 
 /**
 * ***************************************** 三国秀商城管理函数开始 ******************************************
 */
 function a_add() {
	if ($_POST) {
		if (! $_POST ['name']) {
			echo '名字不能为空';
		} else {
			$name = daddslashes ( $_POST ['name'] );
			$cost = daddslashes ( $_POST ['cost'] );
			$period = daddslashes ( $_POST ['period'] );
			$time_s = daddslashes ( $_POST ['time_s'] );
			$time_e = daddslashes ( $_POST ['time_e'] );
			$tips = daddslashes ( $_POST ['tips'] );
            $timestr1 = strtotime($time_s); 
            $timestr2 = strtotime($time_e); 
			if (! $name || ! $period || ! $time_s ) {
				echo "信息不完整";
				exit ();
			}
			if ($timestr1 =="") {
				echo "日期有误";
				exit ();
			}
 			if ($period !="1" && $period !="3" && $period !="5" && $period !="7" && $period !="8" && $period !="9" ) {
				echo "时限选择有误";
				exit ();
			}
            $avatarshow = DB::fetch_first ( "SELECT aid FROM `avatarshow` WHERE `name`='{$name}' " );
			if (!$avatarshow ) {
				echo '三国秀名字错误';
				exit ();
			}
            $aid = $avatarshow['aid'];
            $result = DB::fetch_first ( "SELECT aid FROM `shop_a` WHERE `time_s`='{$timestr1}' AND `cost`='{$cost}' AND `period`='{$period}'  AND `aid`='{$aid}'  " );
			if ($result ) {
				echo '这个三国秀信息已经添加过了';
				exit ();
			}
            $insert = DB::insert ( '`shop_a`', array (
					'aid' => $avatarshow['aid'],
					'cost' => $cost,
					'period' => $period,
					'time_s' => $timestr1,
					'time_e' => $timestr2,
					'tips' => $tips,
			));
            if ($insert){
                echo "三国秀添加成功！<br>三国秀：<font color=\"red\">{$name}</font>";
            	delete_memcache('shop', 'a', '', $aid);
            }else{
            	echo '未知错误';
            }
		}
	}
}


 function a_add_jq() {
	if ($_POST) {
		if (! $_POST ['name1'] ||! $_POST ['name2'] ||! $_POST ['name3']) {
			echo '套装的名字必须完整';
		} else {
			for($i=1;$i<=3;$i++){
				${name.$i} = daddslashes ( $_POST ['name'.$i] );
			}
			for($j=1;$j<=10;$j++){
				${cost.$j} = daddslashes ( $_POST ['cost'.$j] );
			}
			for($k=1;$k<=9;$k++){
				${period.$k} = daddslashes ( $_POST ['period'.$k] );
			}
			$time_s = daddslashes ( $_POST ['time_s'] );
			$time_e = daddslashes ( $_POST ['time_e'] );
			$tips = daddslashes ( $_POST ['tips'] );
            $timestr1 = strtotime($time_s);
            $timestr2 = strtotime($time_e);
			if (! $time_s || ! $time_e || ! $tips ) {
				echo "信息不完整";
				exit ();
			}
			if ($timestr1 =="" ||$timestr2 =="") {
				echo "日期有误";
				exit ();
			}
 			if ($period1 !="1" && $period1 !="3" && $period1 !="5" && $period1 !="7" && $period1 !="8" && $period1 !="9" ) {
				echo "时限选择有误";
				exit ();
			}
            $avatarshow1 = DB::fetch_first ( "SELECT aid FROM `avatarshow` WHERE `name`='{$name1}' " );
            $avatarshow2 = DB::fetch_first ( "SELECT aid FROM `avatarshow` WHERE `name`='{$name2}' " );
            $avatarshow3 = DB::fetch_first ( "SELECT aid FROM `avatarshow` WHERE `name`='{$name3}' " );
			if (!$avatarshow1 || !$avatarshow2 || !$avatarshow3 ) {
				echo '三国秀名字错误';
				exit ();
			}
            $result = DB::fetch_first ( "SELECT aid FROM `shop_a` WHERE `time_s`='{$timestr1}' AND `cost`='{$cost10}' AND `period`='9'  " );
			if ($result ) {
				echo '这组三国秀信息已经添加过了';
				exit ();
			}
			for($m=1;$m<=9;$m++){
				$n=floor(($m+2)/3);
				if($n == "1"){
					$tips_l = $tips."节气三国秀边框";
				}else if($n == "2"){
					$tips_l = $tips."节气三国秀背景";
				}else if($n == "3"){
					$tips_l = $tips."节气三国秀形象";
				}
				if(${cost.$m}&&${period.$m})
					$insert = DB::insert ( '`shop_a`', array (
					'aid' => ${avatarshow.$n}['aid'],
					'cost' => ${cost.$m},
					'period' => ${period.$m},
					'time_s' => $time_s,
					'tips' => $tips_l,
				));
				if ($insert){
                    switch ($m) {
                        case 1 : echo '三国秀的边框数据添加<font color="red">成功</font>！<br>'; break;
                        case 2 : echo '三国秀的背景数据添加<font color="red">成功</font>！<br>'; break;
                        case 3 : echo '三国秀的形象数据添加<font color="red">成功</font>！<br>'; break;
                        case 4 : echo '三国秀的边框数据添加<font color="red">成功</font>！<br>'; break;
                        case 5 : echo '三国秀的背景数据添加<font color="red">成功</font>！<br>'; break;
                        case 6 : echo '三国秀的形象数据添加<font color="red">成功</font>！<br>'; break;
                        case 7 : echo '三国秀的边框数据添加<font color="red">成功</font>！<br>'; break;
                        case 8 : echo '三国秀的背景数据添加<font color="red">成功</font>！<br>'; break;
                        case 9 : echo '三国秀的形象数据添加<font color="red">成功</font>！<br>'; break;
                    }
 				delete_memcache('shop', 'a', '', ${avatarshow.$n}["aid"]);
                }else{
                    switch ($m) {
                        case 1 : echo '三国秀的边框数据添加<font color="red">失败</font>！<br>'; break;
                        case 2 : echo '三国秀的背景数据添加<font color="red">失败</font>！<br>'; break;
                        case 3 : echo '三国秀的形象数据添加<font color="red">失败</font>！<br>'; break;
                        case 4 : echo '三国秀的边框数据添加<font color="red">失败</font>！<br>'; break;
                        case 5 : echo '三国秀的背景数据添加<font color="red">失败</font>！<br>'; break;
                        case 6 : echo '三国秀的形象数据添加<font color="red">失败</font>！<br>'; break;
                        case 7 : echo '三国秀的边框数据添加<font color="red">失败</font>！<br>'; break;
                        case 8 : echo '三国秀的背景数据添加<font color="red">失败</font>！<br>'; break;
                        case 9 : echo '三国秀的形象数据添加<font color="red">失败</font>！<br>'; break;
                    }
                }
			}
			if($cost10)
				$insert_tz1 = DB::insert ( '`shop_a`', array (
				'aid' => $avatarshow1['aid'],
				'cost' => $cost10,
				'period' => '9',
				'time_s' => $timestr1,
				'time_e' => $timestr2,
				'tips' => $tips.'节气三国秀礼包',
			));
			if($cost10)
				$insert_tz2 = DB::insert ( '`shop_a`', array (
				'aid' => $avatarshow2['aid'],
				'cost' => $cost10,
				'period' => '9',
				'time_s' => $timestr1,
				'time_e' => $timestr2,
				'tips' => $tips.'节气三国秀礼包',
			));
			if($cost10)
				$insert_tz3 = DB::insert ( '`shop_a`', array (
				'aid' => $avatarshow3['aid'],
				'cost' => $cost10,
				'period' => '9',
				'time_s' => $timestr1,
				'time_e' => $timestr2,
				'tips' => $tips.'节气三国秀礼包',
			));
			if($insert_tz1 && $insert_tz2 && $insert_tz3 ) {
				echo '套装添加成功';
				delete_memcache('shop', 'a', '', $avatarshow1["aid"]);
				delete_memcache('shop', 'a', '', $avatarshow2["aid"]);
				delete_memcache('shop', 'a', '', $avatarshow3["aid"]);
            }else{
				echo '套装添加失败';
			}
		}
	}
}


 function a_add_bz() {
	if ($_POST) {
		if (! $_POST ['name']) {
			echo '名字不能为空';
		} else {
			$name = daddslashes ( $_POST ['name'] );
			$time_s = daddslashes ( $_POST ['time_s'] );
			$time_e = daddslashes ( $_POST ['time_e'] );
            $timestr1 = strtotime($time_s); 
            $timestr2 = strtotime($time_e); 
			if (! $name || ! $time_s || ! $time_e ) {
				echo "信息不完整";
				exit ();
			}
			if ($timestr1 =="") {
				echo "日期有误";
				exit ();
			}
            $avatarshow = DB::fetch_first ( "SELECT aid FROM `avatarshow` WHERE `name`='{$name}' " );
			if (!$avatarshow ) {
				echo '三国秀名字错误';
				exit ();
			}
			$aid = $avatarshow['aid'];
            $result = DB::fetch_first ( "SELECT aid FROM `shop_a` WHERE `aid`='{$aid}' AND `time_s`='{$timestr1}' " );
			if ($result ) {
				echo '这个三国秀信息已经添加过了';
				exit ();
			}
            $insert = DB::insert ( '`shop_a`', array (
					'aid' => $avatarshow['aid'],
					'cost' => '99999',
					'period' => '9',
					'time_s' => $timestr1,
					'time_e' => $timestr2,
					'tips' => '购买武将礼包赠送',
			));
            if ($insert){
                echo "三国秀添加成功！<br>三国秀：<font color=\"red\">{$name}</font>";
            	delete_memcache('shop', 'a', '', $avatarshow["aid"]);
            }else{
            	echo '未知错误';
            }
		}
	}
}

 function a_add_pf() {
	if ($_POST) {
		if (! $_POST ['name']) {
			echo '名字不能为空';
		} else {
			$name = daddslashes ( $_POST ['name'] );
			$time_s = daddslashes ( $_POST ['time_s'] );
			$time_e = daddslashes ( $_POST ['time_e'] );
            $timestr1 = strtotime($time_s); 
            $timestr2 = strtotime($time_e); 
			if (! $name || ! $time_s || ! $time_e ) {
				echo "信息不完整";
				exit ();
			}
			if ($timestr1 =="") {
				echo "日期有误";
				exit ();
			}
            $avatarshow = DB::fetch_first ( "SELECT aid FROM `avatarshow` WHERE `name`='{$name}' " );
			if (!$avatarshow ) {
				echo '三国秀名字错误';
				exit ();
			}
			$aid = $avatarshow['aid'];
            $result = DB::fetch_first ( "SELECT aid FROM `shop_a` WHERE `aid`='{$aid}' AND `time_s`='{$timestr1}' " );
			if ($result ) {
				echo '这个三国秀信息已经添加过了';
				exit ();
			}
            $insert = DB::insert ( '`shop_a`', array (
					'aid' => $avatarshow['aid'],
					'cost' => '99999',
					'period' => '9',
					'time_s' => $timestr1,
					'time_e' => $timestr2,
					'tips' => '购买皮肤礼包赠送',
			));
            if ($insert){
                echo "三国秀添加成功！<br>三国秀：<font color=\"red\">{$name}</font>";
             	delete_memcache('shop', 'a', '', $avatarshow["aid"]);
           }else{
            	echo '未知错误';
            }
		}
	}
}






 /**
 * ***************************************** 三国秀商城管理函数结束 ******************************************
 */
 
 
/**
 * ***************************************** 武将管理函数开始 ******************************************
 */
function c_a() { // 添加武将
	if ($_POST) {
		if (! $_POST ['cid']) {
			echo '武将id不能为空';
		} elseif (! $_POST ['name']) {
			echo '武将名字不能为空';
		} else {
			$cid = daddslashes ( $_POST ['cid'] );
			$name = daddslashes ( $_POST ['name'] );
			$tips = daddslashes ( $_POST ['tips'] );
			$country = daddslashes ( $_POST ['country'] );
			$ex = daddslashes ( $_POST ['ex'] );
			if (! $cid || ! $name || ! $country || ! $ex) {
				echo "信息不完整";
				exit ();
			}
			if (strlen ( $name ) > 15) {
				echo '名字过长，不得超过15个字符';
				exit ();
			}
			$result = DB::fetch_first ( "SELECT * FROM `character` WHERE `cid`='{$cid}'" );
			if ($result) {
				echo '这个武将已经存在了';
				exit ();
			}
			$a = DB::insert ( '`character`', array (
					'cid' => $cid,
					'name' => $name,
					'tips' => $tips,
					'country' => $country,
					'ex' => $ex,
					'time' => TIMESTAMP,


			) );
			echo "武将：{$name} 添加成功！";
            delete_memcache('list', 'c', 'c', $country);
            delete_memcache('list', 'c', 'e', $ex);
            delete_memcache('info', 'c', '', $cid);
		}
	}
}
function c_m() { // 修改武将
	if ($_POST) {
		if (! $_POST ['cid']) {
			echo '武将id不能为空';
		} else {
			$cid = daddslashes ( $_POST ['cid'] );
			$name = daddslashes ( $_POST ['name'] );
			$tips = daddslashes ( $_POST ['tips'] );
			$country = daddslashes ( $_POST ['country'] );
			$ex = daddslashes ( $_POST ['ex'] );
			$data = array (
					'cid' => $cid 
			);
			if ($name) {
				$c_name = array (
						'name' => $name 
				);
				$data += $c_name;
			}
			if ($tips) {
				$c_tips = array (
						'tips' => $tips 
				);
				$data += $c_tips;
			}
			if ($country) {
				$c_country = array (
						'country' => $country 
				);
				$data += $c_country;
			}
			if ($ex) {
				$c_ex = array (
						'ex' => $ex 
				);
				$data += $c_ex;
			}
			if (! $name && ! $tips && ! $country && ! $ex) {
				echo "至少有一项要修改";
				exit ();
			}
			$result = DB::fetch_first ( "SELECT * FROM `character` WHERE `cid`='{$cid}'" );
			if (! $result) {
				echo '武将不存在';
				exit ();
			}
			$uid = DB::update ( '`character`', $data, "cid='{$cid}'" );
			echo "武将：{$result['name']} 的信息修改成功！";
            delete_memcache('list', 'c', 'c', $result['country']);
            delete_memcache('list', 'c', 'e', $result['ex']);
            delete_memcache('info', 'c', '', $cid);
		}
	}
}
function c_d() { // 删除武将
	if ($_POST) {
		if (! $_POST ['cid']) {
			echo '武将id不能为空';
		} else {
			$cid = daddslashes ( $_POST ['cid'] );
			if (! $cid) {
				echo "信息不完整";
				exit ();
			}
			$result = DB::fetch_first ( "SELECT * FROM `character` WHERE `cid`='{$cid}'" );
			if (! $result) {
				echo '武将不存在';
				exit ();
			}
			$uid = DB::delete ( '`character`', "cid='{$cid}'" );
			echo "武将：{$result['name']} 删除成功！";
            delete_memcache('list', 'c', 'c', $result['country']);
            delete_memcache('list', 'c', 'e', $result['ex']);
            delete_memcache('info', 'c', '', $cid);
		}
	}
}

/**
 * ***************************************** 武将管理函数结束 ******************************************
 */



/**
 * ***************************************** 武将商城函数开始 ******************************************
 */


function c_week_free() {
	if ($_POST) {
		if (! $_POST ['name1']) {
			echo '武将不能为空';
		} else {
			$name1 = daddslashes ( $_POST ['name1'] );
			$name2 = daddslashes ( $_POST ['name2'] );
			$name3 = daddslashes ( $_POST ['name3'] );
			$time_s = daddslashes ( $_POST ['time_s'] );
			$time_e = daddslashes ( $_POST ['time_e'] );
            $timestr1 = strtotime($time_s); 
            $timestr2 = strtotime($time_e); 
			if (! $name1 || ! $name2 || ! $name3 || ! $time_s || ! $time_e  ) {
				echo "信息不完整";
				exit ();
			}
			if ($timestr1 =="" || $timestr2 =="") {
				echo "日期有误";
				exit ();
			}
            $character1 = DB::fetch_first ( "SELECT cid FROM `character` WHERE `name`='{$name1}' " );
            $character2 = DB::fetch_first ( "SELECT cid FROM `character` WHERE `name`='{$name2}' " );
            $character3 = DB::fetch_first ( "SELECT cid FROM `character` WHERE `name`='{$name3}' " );
			if (!$character1 || !$character2 || !$character3 ) {
				echo '武将名字错误';
				exit ();
			}
            $result = DB::fetch_first ( "SELECT cid FROM `shop_c` WHERE `time_s`='{$timestr1}' AND `time_e`='{$timestr2}'  " );
			if ($result ) {
				echo '这批周免已经添加过了';
				exit ();
			}
            $insert1 = DB::insert ( '`shop_c`', array (
					'cid' => $character1['cid'],
					'time_s' => strtotime($time_s),
					'time_e' => strtotime($time_e),
					'tips' =>  '每周免费武将',
			));
            $insert2 = DB::insert ( '`shop_c`', array (
					'cid' => $character2['cid'],
					'time_s' => strtotime($time_s),
					'time_e' => strtotime($time_e),
					'tips' =>  '每周免费武将',
			));
            $insert3 = DB::insert ( '`shop_c`', array (
					'cid' => $character3['cid'],
					'time_s' => strtotime($time_s),
					'time_e' => strtotime($time_e),
					'tips' =>  '每周免费武将(vip)',
			));
            if ($insert1 && $insert2 && $insert3 ){
                echo "每周免费武将添加成功！<br>免费武将<font color=\"red\">{$name1}</font>、<font color=\"red\">{$name2}</font>，会员免费武将<font color=\"red\">{$name3}</font>";
            	delete_memcache('shop', 'c', '', $character1['cid']);
            	delete_memcache('shop', 'c', '', $character2['cid']);
            	delete_memcache('shop', 'c', '', $character3['cid']);
            }else{
            	echo '未知错误';
            }
		}
	}
}

function c_trial() {
	if ($_POST) {
		if (! $_POST ['name']) {
			echo '武将名字不能为空';
		} else {
			$name = daddslashes ( $_POST ['name'] );
			$cost = daddslashes ( $_POST ['cost'] );
			$time_s = daddslashes ( $_POST ['time_s'] );
			$time_e = daddslashes ( $_POST ['time_e'] );
            $timestr1 = strtotime($time_s); 
            $timestr2 = strtotime($time_e); 
			if (! $name || ! $cost || ! $time_s || ! $time_e  ) {
				echo "信息不完整";
				exit ();
			}
			if ($timestr1 =="" || $timestr2 =="") {
				echo "日期有误";
				exit ();
			}
            $character = DB::fetch_first ( "SELECT cid FROM `character` WHERE `name`='{$name}' " );
			if (!$character) {
                echo '武将名字错误/或者武将库中没有这个武将，请到武将管理中查看是否有这个武将';
				exit ();
			}
			$cid = $character['cid'];
            $result = DB::fetch_first ( "SELECT cid FROM `shop_c` WHERE `cid` = '{$cid}' AND `cost` != '0' AND `time_s`='{$timestr1}' " );
			if ($result ) {
				echo '这个武将已经添加过了';
				exit ();
			}
            $insert = DB::insert ( '`shop_c`', array (
					'cid' => $cid,
					'cost' => $cost,
					'time_s' => strtotime($time_s),
					'time_e' => strtotime($time_e),
					'tips' =>  '新武将试卖',
			));
            if ($insert){
                echo "试卖武将 <font color=\"red\">{$name}</font> 添加成功！";
            	delete_memcache('shop', 'c', '', $cid);
            }else{
            	echo '未知错误';
            }
		}
	}
}


function c_final() {
	if ($_POST) {
		if (! $_POST ['name']) {
			echo '武将名字不能为空';
		} else {
			$name = daddslashes ( $_POST ['name'] );
			$cost = daddslashes ( $_POST ['cost'] );
			$time_s = daddslashes ( $_POST ['time_s'] );
            $timestr1 = strtotime($time_s); 
			if (! $name || ! $cost || ! $time_s ) {
				echo "信息不完整";
				exit ();
			}
			if ($timestr1 =="") {
				echo "日期有误";
				exit ();
			}
            $character = DB::fetch_first ( "SELECT cid FROM `character` WHERE `name`='{$name}' " );
			if (!$character) {
                echo '武将名字错误/或者武将库中没有这个武将，请到武将管理中查看是否有这个武将';
				exit ();
			}
			$cid = $character['cid'];
            $result = DB::fetch_first ( "SELECT cid FROM `shop_c` WHERE `cid` = '{$cid}' AND `cost` != '0' AND `time_s`='{$timestr1}' " );
			if ($result ) {
				echo '这个武将已经添加过了';
				exit ();
			}
			$insert = DB::insert ( '`shop_c`', array (
					'cid' => $cid,
					'cost' => $cost,
					'time_s' => strtotime($time_s),
					'tips' =>  '新武将正式价格',
			));
            if ($insert){
                echo "正式价格武将 <font color=\"red\">{$name}</font> 添加成功！";
            	delete_memcache('shop', 'c', '', $cid);
           }else{
            	echo '未知错误';
            }
		}
	}
}


function c_yinliang() {
	if ($_POST) {
		if (! $_POST ['name']) {
			echo '武将名字不能为空';
		} else {
			$name = daddslashes ( $_POST ['name'] );
			$yinliang = daddslashes ( $_POST ['yinliang'] );
			$time_s = daddslashes ( $_POST ['time_s'] );
            $timestr1 = strtotime($time_s); 
			if (! $name || ! $yinliang || ! $time_s ) {
				echo "信息不完整";
				exit ();
			}
			if ($timestr1 =="") {
				echo "日期有误";
				exit ();
			}
            $character = DB::fetch_first ( "SELECT cid FROM `character` WHERE `name`='{$name}' " );
			if (!$character) {
                echo '武将名字错误/或者武将库中没有这个武将，请到武将管理中查看是否有这个武将';
				exit ();
			}
			$cid = $character['cid'];
            $result = DB::fetch_first ( "SELECT cid FROM `shop_c` WHERE `cid` = '{$cid}' AND `cost` = '0' AND `time_s`='{$timestr1}' " );
			if ($result ) {
				echo '这个武将已经添加过了';
				exit ();
			}
			$insert = DB::insert ( '`shop_c`', array (
					'cid' => $cid,
					'cost' => "0",
					'time_s' => strtotime($time_s),
                	'tips' =>  "银两武将上架，价格{$yinliang}银两",
			));
            if ($insert){
                echo "银两武将 <font color=\"red\">{$name}</font> 添加成功！";
             	delete_memcache('shop', 'c', '', $cid);
           }else{
            	echo '未知错误';
            }
		}
	}
}



/**
 * ***************************************** 武将商城函数结束 ******************************************
 */


/**
 * ***************************************** 战功管理函数开始 ******************************************
 */
function ach_a() { // 添加战功
	if ($_POST) {
		if (! $_POST ['achid']) {
			echo '战功id不能为空';
		} elseif (! $_POST ['name']) {
			echo '战功名字不能为空';
		} else {
			$achid = daddslashes ( $_POST ['achid'] );
			$name = daddslashes ( $_POST ['name'] );
			$tips = daddslashes ( $_POST ['tips'] );
			$point = daddslashes ( $_POST ['point'] );
			$pid = daddslashes ( $_POST ['pid'] );
			$gamemode = daddslashes ( $_POST ['gamemode'] );
			$time_s = strtotime ( daddslashes ( $_POST ['time_s'] ) );
			$time_e = strtotime ( daddslashes ( $_POST ['time_e'] ) );
			$type = daddslashes ( $_POST ['type'] );
			$ex = daddslashes ( $_POST ['ex'] );
			$data = array (
					'achid' => $achid,
					'name' => $name,
					'tips' => $tips,
					'point' => $point,
					'pid' => $pid,
					'type' => $type,
					'time' => TIMESTAMP,


			);
			if ($_POST ['time_s']) {
				$ach_time_s = array (
						'time_s' => $time_s 
				);
				$data += $ach_time_s;
			}
			if ($_POST ['time_e']) {
				$ach_time_e = array (
						'time_e' => $time_e 
				);
				$data += $ach_time_e;
			}
			if ($ex) {
				$ach_ex = array (
						'ex' => $ex 
				);
				$data += $ach_ex;
			}
			if ($gamemode) {
				$ach_gamemode = array (
						'gamemode' => $gamemode 
				);
				$data += $ach_gamemode;
			}
			if ($gamemode == "0") {
				$ach_gamemode2 = array (
						'gamemode' => $gamemode 
				);
				$data += $ach_gamemode2;
			}
			if (! $achid || ! $name || ! $tips || ! $point || ! $pid || ! $type) {
				echo "信息不完整";
				exit ();
			}
			if (strlen ( $name ) > 18) {
				echo '名字过长，不得超过18个字符';
				exit ();
			}
			$result = DB::fetch_first ( "SELECT * FROM `ach` WHERE `achid`='{$achid}'" );
			if ($result) {
				echo '这个战功已经存在了';
				exit ();
			}
			$a = DB::insert ( 'ach', $data );
			echo "战功：{$name} 添加成功！";
            delete_memcache('list', 'ach', 't', $type);
            delete_memcache('list', 'ach', 'e', $ex);
            delete_memcache('info', 'ach', '', $achid);
		}
	}
}
function ach_m() { // 修改战功
	if ($_POST) {
		if (! $_POST ['achid']) {
			echo '战功id不能为空';
		} else {
			$achid = daddslashes ( $_POST ['achid'] );
			$name = daddslashes ( $_POST ['name'] );
			$tips = daddslashes ( $_POST ['tips'] );
			$point = daddslashes ( $_POST ['point'] );
			$pid = daddslashes ( $_POST ['pid'] );
			$gamemode = daddslashes ( $_POST ['gamemode'] );
			$time_s = strtotime ( daddslashes ( $_POST ['time_s'] ) );
			$time_e = strtotime ( daddslashes ( $_POST ['time_e'] ) );
			$type = daddslashes ( $_POST ['type'] );
			$ex = daddslashes ( $_POST ['ex'] );
			$data = array (
					'achid' => $achid 
			);
			if ($name) {
				$ach_name = array (
						'name' => $name 
				);
				$data += $ach_name;
			}
			if ($tips) {
				$ach_tips = array (
						'tips' => $tips 
				);
				$data += $ach_tips;
			}
			if ($point) {
				$ach_point = array (
						'point' => $point 
				);
				$data += $ach_point;
			}
			if ($pid) {
				$ach_pid = array (
						'pid' => $pid 
				);
				$data += $ach_pid;
			}
			if ($gamemode) {
				$ach_gamemode = array (
						'gamemode' => $gamemode 
				);
				$data += $ach_gamemode;
			}
			if ($_POST ['time_s']) {
				$ach_time_s = array (
						'time_s' => $time_s 
				);
				$data += $ach_time_s;
			}
			if ($_POST ['time_e']) {
				$ach_time_e = array (
						'time_e' => $time_e 
				);
				$data += $ach_time_e;
			}
			if ($type) {
				$ach_type = array (
						'type' => $type 
				);
				$data += $ach_type;
			}
			if (! $name && ! $tips && ! $point && ! $pid && ! $gamemode && ! $time_s && ! $time_e && ! $type && ! $ex) {
				echo "至少有一项要修改";
				exit ();
			}
			$result = DB::fetch_first ( "SELECT * FROM `ach` WHERE `achid`='{$achid}'" );
			if (! $result) {
				echo '战功不存在';
				exit ();
			}
			$uid = DB::update ( 'ach', $data, "achid='{$achid}'" );
			echo "战功：{$result['name']} 的信息修改成功！";
            delete_memcache('list', 'ach', 't', $result['type']);
            delete_memcache('list', 'ach', 'e', $result['ex']);
            delete_memcache('info', 'ach', '', $achid);
		}
	}
}
function ach_d() { // 删除战功
	if ($_POST) {
		if (! $_POST ['achid']) {
			echo '战功id不能为空';
		} else {
			$achid = daddslashes ( $_POST ['achid'] );
			if (! $achid) {
				echo "信息不完整";
				exit ();
			}
			$result = DB::fetch_first ( "SELECT * FROM `ach` WHERE `achid`='{$achid}'" );
			if (! $result) {
				echo '战功不存在';
				exit ();
			}
			$uid = DB::delete ( 'ach', "achid='{$achid}'" );
			echo "战功：{$result['name']} 删除成功！";
            delete_memcache('list', 'ach', 't', $result['type']);
            delete_memcache('list', 'ach', 'e', $result['ex']);
            delete_memcache('info', 'ach', '', $achid);
		}
	}
}

/**
 * ***************************************** 战功管理函数结束 ******************************************
 */

/**
 * ***************************************** 皮肤管理函数开始 ******************************************
 */
function s_a() { // 添加皮肤
	if ($_POST) {
		if (! $_POST ['sid']) {
			echo '皮肤id不能为空';
		} elseif (! $_POST ['name']) {
			echo '皮肤名字不能为空';
		} else {
			$sid = daddslashes ( $_POST ['sid'] );
			$name = daddslashes ( $_POST ['name'] );
			$tips = daddslashes ( $_POST ['tips'] );
			$country = daddslashes ( $_POST ['country'] );
			$cid = substr($sid,0,strlen($sid)-2);
            $data = array (
					'sid' => $sid,
					'name' => $name,
					'tips' => $tips,
					'country' => $country,
					'character' => $cid,
					'time' => TIMESTAMP,
			);
            if (! $sid || ! $name || ! $country ) {
				echo "信息不完整";
				exit ();
			}
			if (strlen ( $name ) > 30) {
				echo '名字过长，不得超过30个字符';
				exit ();
			}
			$result = DB::fetch_first ( "SELECT * FROM `skin` WHERE `sid`='{$sid}'" );
			if ($result) {
				echo '这个皮肤已经存在了';
				exit ();
			}
			$a = DB::insert ( 'skin', $data );
			echo "皮肤：{$name} 添加成功！";
            delete_memcache('list', 's', 'c', $country);
            delete_memcache('info', 's', '', $sid);
        }
	}
}
function s_m() { // 修改皮肤
	if ($_POST) {
		if (! $_POST ['sid']) {
			echo '皮肤id不能为空';
		} else {
			$sid = daddslashes ( $_POST ['sid'] );
			$name = daddslashes ( $_POST ['name'] );
			$tips = daddslashes ( $_POST ['tips'] );
			$country = daddslashes ( $_POST ['country'] );
			$cid = substr($sid,0,strlen($sid)-2);
			$data = array (
					'sid' => $sid,
					'character' => $cid
			);
			if ($name) {
				$s_name = array (
						'name' => $name 
				);
				$data += $s_name;
			}
			if ($tips) {
				$s_tips = array (
						'tips' => $tips 
				);
				$data += $s_tips;
			}
			if ($country) {
				$s_country = array (
						'country' => $country 
				);
				$data += $s_country;
			}
			if (! $name && ! $tips && ! $country) {
				echo "至少有一项要修改";
				exit ();
			}
			$result = DB::fetch_first ( "SELECT * FROM `skin` WHERE `sid`='{$sid}'" );
			if (! $result) {
				echo '皮肤不存在';
				exit ();
			}
			$uid = DB::update ( 'skin', $data, "sid='{$sid}'" );
			echo "皮肤：{$result['name']} 的信息修改成功！";
            delete_memcache('list', 's', 'c', $result['country']);
            delete_memcache('info', 's', '', $sid);
		}
	}
}
function s_d() { // 删除皮肤
	if ($_POST) {
		if (! $_POST ['sid']) {
			echo '皮肤id不能为空';
		} else {
			$sid = daddslashes ( $_POST ['sid'] );
			if (! $sid) {
				echo "信息不完整";
				exit ();
			}
			$result = DB::fetch_first ( "SELECT * FROM `skin` WHERE `sid`='{$sid}'" );
			if (! $result) {
				echo '皮肤不存在';
				exit ();
			}
			$uid = DB::delete ( 'skin', "sid='{$sid}'" );
			echo "皮肤：{$result['name']} 删除成功！";
            delete_memcache('list', 's', 'c', $result['country']);
            delete_memcache('info', 's', '', $sid);
		}
	}
}

/**
 * ***************************************** 皮肤管理函数结束 ******************************************
 */
 
 
 /**
 * ***************************************** 皮肤商城管理函数结束 ******************************************
 */
 function s_add() {
	if ($_POST) {
		if (! $_POST ['name']) {
			echo '名字不能为空';
		} else {
			$name = daddslashes ( $_POST ['name'] );
			$cost = daddslashes ( $_POST ['cost'] );
			$period = daddslashes ( $_POST ['period'] );
			$time_s = daddslashes ( $_POST ['time_s'] );
			$time_e = daddslashes ( $_POST ['time_e'] );
			$tips = daddslashes ( $_POST ['tips'] );
            $timestr1 = strtotime($time_s); 
            $timestr2 = strtotime($time_e); 
			if (! $name || ! $cost || ! $period || ! $time_s ) {
				echo '信息不完整';
				exit ();
			}
			if ($timestr1 == "") {
				echo '日期有误';
				exit ();
			}
 			if ($period != '1' && $period != '3' && $period != '5' && $period != '7' && $period != '8' && $period != '9' ) {
				echo "时限选择有误";
				exit ();
			}
            $skin = DB::fetch_first ( "SELECT sid FROM `skin` WHERE `name`='{$name}' " );
			if (!$skin ) {
				echo '皮肤名字错误';
				exit ();
			}
            $result = DB::fetch_first ( "SELECT sid FROM `shop_s` WHERE `time_s`='{$timestr1}' AND `cost`='{$cost}' AND `period`='{$period}'  " );
			if ($result ) {
				echo '这个皮肤信息已经添加过了';
				exit ();
			}
            $insert = DB::insert ( '`shop_s`', array (
					'sid' => $skin['sid'],
					'cost' => $cost,
					'period' => $period,
					'time_s' => strtotime($time_s),
					'time_e' => strtotime($time_e),
					'tips' => $tips,
			));
            if ($insert){
                echo "皮肤添加成功！<br>皮肤名字：<font color=\"red\">{$name}</font>";
            	delete_memcache('shop', 's', '', $skin["sid"]);
            }else{
            	echo '未知错误';
            }
		}
	}
}
 /**
 * ***************************************** 三国秀商城管理函数结束 ******************************************
 */
 

 /**
 * ***************************************** 三国秀智能更新函数开始 ******************************************
 */
 
function check_new_show($type,$pictype) {
    if ($type == 'border' && $pictype =='png') {
        $param = 'type = 1';
    }else if ($type =='border' && $pictype =='swf'){
        $param = 'type = 1';
    }else if ($type =='background'){
        $param = 'type >= 2';
    }else if ($type =='avatar' && $pictype =='png'){
        $param = 'type >= 3';
    }else if ($type =='avatar' && $pictype =='swf'){
        $param = 'type >= 3';
    }
    ${$type} = DB::fetch_first ( "SELECT aid, pid FROM `avatarshow` WHERE {$param} ORDER BY aid DESC LIMIT 1" );
    $pre_aid = ${$type}['aid'] - 1;
    $next_aid = ${$type}['aid'] + 1;
    $pre_pid = ${$type}['pid'] - 1;
    $next_pid = ${$type}['pid'] + 1;
    server_curl($type, $next_pid, $pictype,$next_aid);
}

function server_curl($type, $pid, $pictype,$aid) {
    if ($type == 'border') {
        $path = 'simplified/AvatarShow/border/'.$pid.'1';
    }else if ($type == 'background') {
        $path = 'AvatarShow/background/'.$pid;
    }else if ($type == 'avatar') {
        $path = 'AvatarShow/avatar/'.$pid;
    }
	${$type. 'url'} = "http://web.sanguosha.com/220/assets/" . $path . '.' .$pictype;
    ${$type. 'ch'} = curl_init();
    ${$type. 'timeout'} = 10;
    curl_setopt(${$type. 'ch'}, CURLOPT_URL, ${$type. 'url'});
    curl_setopt(${$type. 'ch'}, CURLOPT_HEADER, 1);
    curl_setopt(${$type. 'ch'}, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt(${$type. 'ch'}, CURLOPT_CONNECTTIMEOUT, ${$type. 'timeout'});
    ${$type. 'contents'} = curl_exec(${$type. 'ch'});
    if (preg_match("/404/", ${$type. 'contents'})) {
        ${$type. '_result'} = 0;
    } else {
        ${$type. '_result'} = 1;
    }
    curl_result($type, ${$type. '_result'}, $pictype, $path, $pid, $aid);
}

function curl_result($type, $check, $pictype, $path, $pid, $aid) {
    if ($type == 'border' && $pictype =='png') {
        $name = '边框';
		$v_pictype = 1 ;
		$img_show = "<img style='float:left;' border='0' src='http://web.sanguosha.com/220/assets/{$path}.{$pictype}'>";
    }else if ($type == 'border' && $pictype =='swf') {
        $name = '动态边框';
		$v_pictype = 2 ;
		$img_show = "<object classid='clsid:D27CDB6E-AE6D-11CF-96B8-444553540000' id='obj1' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0' border='0' width='148' height='208' hspace='-28'><param name='movie' value='http://web.sanguosha.com/220/assets/{$path}.{$pictype}'><param name='quality' value='High'><param name='wmode' value='transparent'><embed src='http://web.sanguosha.com/220/assets/{$path}.{$pictype}' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' name='obj1' width='148' height='208' hspace='-28' wmode='transparent'></object>";
    }elseif ($type == 'background') {
        $name = '背景';
		$v_pictype = 1 ;
		$img_show = "<img style='float:left;' border='0' src='http://web.sanguosha.com/220/assets/{$path}.{$pictype}'>";
    }else if ($type == 'avatar' && $pictype =='png') {
        $name = '形象';
		$v_pictype = 1 ;
		$img_show = "<img style='float:left;' border='0' src='http://web.sanguosha.com/220/assets/{$path}.{$pictype}'>";
    }else if ($type == 'avatar' && $pictype =='swf') {
        $name = '动态形象';
		$v_pictype = 2 ;
		$img_show = "<object classid='clsid:D27CDB6E-AE6D-11CF-96B8-444553540000' id='obj1' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0' border='0' width='148' height='208' hspace='-28'><param name='movie' value='http://web.sanguosha.com/220/assets/{$path}.{$pictype}'><param name='quality' value='High'><param name='wmode' value='transparent'><embed src='http://web.sanguosha.com/220/assets/{$path}.{$pictype}' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' name='obj1' width='148' height='208' hspace='-28' wmode='transparent'></object>";
    }
    if ($check == 0) {
        echo '暂时没有检测到新的'.$name.'<br>';
    }else if ($check == 1) {
        echo <<<SGS
{$img_show}
<form action="{$_SERVER[PHP_SELF]}?action=a_a" method="POST">
<table style="width:500px !important" >
<tr><td>名字：</td><td><input type="text" name="name" size="20" /></td></tr>
<tr><td>简介：</td><td><input type="text" name="tips" size="20" /></td></tr>
<tr><td>三国秀分类：</td><td><select name="type" size="1" />
<option value="">三国秀类型</option>
<option value="1">边框</option>
<option value="2">背景</option>
<option value="3">标准版形象</option>
<option value="4">amo*Q形象</option>
<option value="5">节日形象</option>
<option value="6">节气形象</option>
<option value="7">星座形象</option>
<option value="8">皮肤形象</option>
<option value="9">活动形象</option>
<option value="10">萌之形象</option>
<option value="11">阿狸形象</option>
<option value="12">国战形象</option>
<option value="13">其他形象</option>
</select></td></tr>
<tr><td><input type="submit" value="添加三国秀" /></td></tr>
</table>
<input type="hidden" name="aid" size="20" value="{$aid}" />
<input type="hidden" name="pid" size="20" value="{$pid}" />
<input type="hidden" name="pictype" size="20" value="{$v_pictype}" />
</form>
SGS;
    }
}

 /**
 * ***************************************** 三国秀智能更新函数结束 ******************************************
 */
 

function get_info_pre($a) {//添加时，显示上一个道具，以便查看id
	if  ($a == 'a_a') {
		$border = DB::fetch_first ( "SELECT * FROM `avatarshow` WHERE `type` = '1' ORDER BY aid DESC ;");
		$background = DB::fetch_first ( "SELECT * FROM `avatarshow` WHERE `type` = '2' ORDER BY aid DESC ;");
		$avatar = DB::fetch_first ( "SELECT * FROM `avatarshow` WHERE `type` != '1' AND `type` != '2' ORDER BY aid DESC ;");
        echo <<<SGS
<table style="width:500px !important" >
<tr>
		<td height='21'><b><font color='#800080'>三国秀id</font></b></td>
		<td height='21'><b><font color='#800080'>名字</font></b></td>
		<td height='21'><b><font color='#800080'>图片id</font></b></td>
</tr>
<tr>
		<td>{$border ['aid']}</td>
		<td>{$border ['name']}</td>
		<td>{$border ['pid']}</td>
</tr>
<tr>
		<td>{$background ['aid']}</td>
		<td>{$background ['name']}</td>
		<td>{$background ['pid']}</td>
</tr>
<tr>
		<td>{$avatar ['aid']}</td>
		<td>{$avatar ['name']}</td>
		<td>{$avatar ['pid']}</td>
</tr>
</table>
SGS;
    }else if  ($a == 'ach_a') {
		$ach1 = DB::fetch_first ( "SELECT * FROM `ach` WHERE achid < 50000 ORDER BY achid DESC ;");
		$ach2 = DB::fetch_first ( "SELECT * FROM `ach` WHERE achid >= 50000 ORDER BY achid DESC ;");
        echo <<<SGS
<table style="width:500px !important" >
<tr>
		<td height='21'><b><font color='#800080'>战功id</font></b></td>
		<td height='21'><b><font color='#800080'>名字</font></b></td>
		<td height='21'><b><font color='#800080'>图片id</font></b></td>
</tr>
<tr>
		<td>{$ach1 ['achid']}</td>
		<td>{$ach1 ['name']}</td>
		<td>{$ach1 ['pid']}</td>
</tr>
<tr>
		<td>{$ach2 ['achid']}</td>
		<td>{$ach2 ['name']}</td>
		<td>{$ach2 ['pid']}</td>
</tr>
</table>
SGS;
    }else if  ($a == 'c_a') {
		$character = DB::fetch_first ( "SELECT * FROM `character` ORDER BY id DESC ;");
        echo <<<SGS
<table style="width:500px !important" >
<tr>
		<td height='21'><b><font color='#800080'>武将id</font></b></td>
		<td height='21'><b><font color='#800080'>名字</font></b></td>
</tr>
<tr>
		<td>{$character ['cid']}</td>
		<td>{$character ['name']}</td>
</tr>
</table>
SGS;
    }else if  ($a == 's_a') {
		$skin = DB::fetch_first ( "SELECT * FROM `skin` ORDER BY id DESC ;");
        echo <<<SGS
<table style="width:500px !important" >
<tr>
		<td height='21'><b><font color='#800080'>皮肤id</font></b></td>
		<td height='21'><b><font color='#800080'>名字</font></b></td>
</tr>
<tr>
		<td>{$skin ['sid']}</td>
		<td>{$skin ['name']}</td>
</tr>
</table>
SGS;
    }else if  ($a == 'c_week_free') {
		$shop_c = DB::fetch_first ( "SELECT * FROM `shop_c` WHERE cost = 0 ORDER BY time_s DESC LIMIT 1 ;");
        $time_s = date('Y-m-d', $shop_c ['time_s']);
        $time_e = date('Y-m-d', $shop_c ['time_e']);
        echo <<<SGS
<table style="width:500px !important" >
<tr>
		<td height='21'><b><font color='#800080'>上次开始时间</font></b></td>
		<td height='21'><b><font color='#800080'>上次结束时间</font></b></td>
</tr>
<tr>
		<td>{$time_s}</td>
		<td>{$time_e}</td>
</tr>
</table>
SGS;
    }
}


function delete_memcache ($param, $category, $type='', $value='') {
    if ($param == 'list') {
    	MCACHE::delete( $param . $category . '_' . $type . '_' . $value );
    }else if ($param == 'info') {
    	MCACHE::delete( $param . $category . '_' . $value );
    }else if ($param == 'shop') {
    	MCACHE::delete( $param . $category . '_' . $value );
    }
}
