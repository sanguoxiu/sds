<?php
require_once './source/common.inc.php';


//echo strtotime(20131225);
/*
$num = DB::result_first ( "SELECT count(*) FROM member " );
$page = new Page($num);

echo $page->limit;
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
echo "</table><div id='result'>";



echo $page->fpage();
echo '</div>';


echo '<script type="text/javascript" src="./source/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">

function setPage(a){
    $.get(a,
		{
		},
    function(data){
	$("#result").html(data);
    });
  };


</script>';

*/










/*
for ($i = 2000; $i<2060;$i++) {

    $result = MCACHE::delete ( 'infos_' . $i . '02' );
    if ($result) {
    echo 'infos_' . $i . '01缓存删除成功<br>';
    }else{
    echo 'infos_' . $i . '01 failed<br>';
    }
    
}

*/



/*


MCACHE::delete ( 'shopc_173' );

*/






//	$data = MCACHE::get ( 'lista_a_1' );
//var_dump($data);

/*
for ($i = 1; $i<124;$i++) {
	$sid = DB::result_first ( "SELECT sid FROM skin WHERE id='{$i}'" );
    $cid = substr($sid,0, -2);
    $data = array (
    	'character' => $cid 
    ); 
	DB::update ('skin', $data, "`id`='{$i}'");
    echo'sid：{$sid}升级成功<br>';
}*/

/*
if ($_GET['act'] == 'login') {
$bdid = trim ( $_POST ['bdid'] );
$bds = trim ($_POST ['bds']);
$res = baidu_login ( $bdid, $bds, $_POST ['tb_vcode'], $_POST ['bdvcode_md5'] ,$_POST['bdvcode_pre']);

    		switch($res ['error_code']) {
			case 0:
				preg_match('/BDUSS=(.*?);/', $res ['cookies'],$matches);
				if(!$matches[1]){$data ['msg'] = "由于某个莫名其妙的原因获取不了BDUSS、、⊙ω⊙";break;}

				$data ['msg'] = '添加成功！';
				$data ['msgx'] = 1;
				break;
			case 4:
				$data ['msg'] = '您输入的密码有误';
				$data ['msgx'] = 3;
			case 6:
				if($data ['msgx'] !=3) $data ['msg'] = '您输入的验证码有误';
				$data ['msgx'] = 3;
			case 257:
				$data ['bdid'] = $bdid;
				$data ['bds'] = $bds;
				$data ['vcodepic'] = $res ['vcodepic'];
				$data ['vcodemd5'] = $res ['vcodemd5'];
				$data ['pre'] = $res ['pre'];
				if($data ['msgx'] !=3) $data ['msgx'] = 2;
				break;
			case 120021:
				$data ['msg'] = 'ID被封了⊙ω⊙、请节哀';
				break;
			default:
				$data ['msg'] = '未知错误，错误代码：'.$res['error_code'];
		}
    
    echo $data ['msg'];
    
    
    
    
    
}else{
$res = baidu_login (random(8),random(8));
echo '<form method="post" action="./test.php?act=login" id="x_mz_add_vote_for_id" >
<input type="hidden" name="bdvcode_md5" value="'. $res ['vcodemd5'] .'">
<input type="hidden" name="bdvcode_pre" value="'. $res ['pre'] .'">
<p>请输入百度ID:</p>
<input type="text" name="bdid" style="width:100%" value="">
<p>请输入密码:</p>
<input type="password" name="bds" style="width:100%" value="">
<p>请输入验证码:</p>
<p><input type="text" name="tb_vcode" style="width:100px"><img src="'. $res ['vcodepic'] .'" style="height: 30px; position: absolute; margin-left: 10px;"></p>
<p><input type="submit" name="b"></p>
</form>';
}


function baidu_login($bdid, $bds, $vcode='', $vcodemd5='',$pre='') {
	if(!$vcode){
		$ch = curl_init('http://passport.baidu.com/v2/api/?login');
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$result = curl_exec($ch);
		curl_close($ch);
		list($header, $body) = explode("\r\n\r\n", $result);
		preg_match_all('/Set-Cookie:(.*?);/', $header, $matches);
		$cookies =trim($matches[1][0]).";".trim($matches[1][1]);
		$ch = curl_init('http://passport.baidu.com/v2/api/?login');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_COOKIE,$cookies);
		$result = curl_exec($ch);
		curl_close($ch);
		preg_match('/param1_contex : "(.*?)"/', $result,$matches);
		$token=$matches[1];
		$formdata = array (
				'staticpage' => 'http://tieba.baidu.com/tb/static-common/html/pass/v3Jump.html',
				'charset' => 'GBK',
				'token' => $token,
				'tpl' => 'tb',
				'apiver' => 'v3',
				'tt' => time().random(3,true),
				'codestring' => '',
				'safeflg' => '0',
				'u' => 'http://tieba.baidu.com/',
				'isPhone' => 'false',
				'quick_user' => '0',
				'loginmerge' => 'true',
				'logintype' => 'dialogLogin',
				'splogin' => 'rate',
				'username' => iconv('UTF-8', 'GBK', $bdid),
				'password' => $bds,
				'verifycode' => '',
				'mem_pass' => 'on',
				'ppui_logintime' => random(6,true),
				'callback' => 'parent.bd__pcbs__'.strtolower(random(6))
		);
		$pre=array(
				'cookies'=>$cookies,
				'token'=>$token
		);
		$pre=serialize($pre);
	}else{
		$pre=unserialize(base64_decode($pre));
		$cookies=$pre['cookies'];
		$formdata = array (
				'staticpage' => 'http://tieba.baidu.com/tb/static-common/html/pass/v3Jump.html',
				'charset' => 'GBK',
				'token' => $pre['token'],
				'tpl' => 'tb',
				'apiver' => 'v3',
				'tt' => time().random(3,true),
				'codestring' => $vcodemd5,
				'safeflg' => '0',
				'u' => 'http://tieba.baidu.com/',
				'isPhone' => 'false',
				'quick_user' => '0',
				'loginmerge' => 'true',
				'logintype' => 'dialogLogin',
				'splogin' => 'rate',
				'username' => iconv('UTF-8', 'GBK', $bdid),
				'password' => $bds,
				'verifycode' => $vcode,
				'mem_pass' => 'on',
				'ppui_logintime' => random(6,true),
				'callback' => 'parent.bd__pcbs__'.strtolower(random(6))
		);
		$pre=serialize($pre);
	}
	$ch = curl_init('http://passport.baidu.com/v2/api/?login');
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POST, true );
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query ( $formdata ) );
	curl_setopt($ch,CURLOPT_COOKIE,$cookies);
	$result = curl_exec($ch);
	curl_close($ch);
	preg_match_all('/Set-Cookie:.?(.*?);/', $result, $matches);
	$cookies = trim($cookies).";";
	foreach ($matches[1] as $cookie){
		$cookies =$cookies.trim($cookie).";";
	}
	preg_match('/err_no=(.*?)"/', $result,$matches);
	$result=substr($matches[0],0,-1);
	preg_match('/err_no=(.*?)&/', $result,$matches);
	$error_code=$matches[1];
	preg_match('/codeString=(.*?)&/', $result,$matches);
	$vcodemd5=$matches[1];
	$cookies=substr($cookies, 0,-1);
	return array(
		'error_code'=>$error_code,
		'vcodemd5'=>$vcodemd5,
		'cookies'=>$cookies,
		'vcodepic'=>'https://passport.baidu.com/cgi-bin/genimage?'.$vcodemd5,
		'pre'=>base64_encode($pre),
	);
}


function random($length, $numeric = 0) {
	$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed{mt_rand(0, $max)};
	}
	return $hash;
}

*/