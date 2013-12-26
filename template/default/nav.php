<?php
if (! defined ( 'IN_SGS' ))
	exit ( 'Access Denied' );

if ($_SESSION ['admin'] == '1') {
	$admintips = '<span><a id="admin" target="_blank" href="./admin">管理中心</a></span>';
	$usergroups = '<font color="red">超级管理员</font>';
} else if ($_SESSION ['admin'] == '2') {
	$admintips = '<span><a id="admin" target="_blank" href="./admin">管理中心</a></span>';
	$usergroups = '<font color="red">数据管理员</font>';
} else if ($_SESSION ['admin'] == '3') {
	$admintips = '<span><a id="admin" target="_blank" href="./admin">管理中心</a></span>';
	$usergroups = '<font color="red">管理员</font>';
} else if ($_SESSION ['admin'] == '99') {
	$admintips = '';
	$usergroups = '<font color="pink">Vip</font>';
} else if ($_SESSION ['admin'] == "0") {
	$admintips = '';
	$usergroups = '<font color="orange">会员</font>';
} else {
	$admintips = '';
	$usergroups = '';
}

echo '<div class="nav">';
echo <<<SGS
<ul>
<li><a id="index" class="nav_menu" href="javascript:void(0)" onmouseover="nav_change('index', 'add')" onmouseout="nav_change('index', 'remove')" >首页</a></li>
<li><a id="character" class="nav_menu" href="javascript:void(0)" onmouseover="nav_change('character', 'add')" onmouseout="nav_change('character', 'remove')" >武将</a></li>
<li><a id="skin" class="nav_menu" href="javascript:void(0)" onmouseover="nav_change('skin', 'add')" onmouseout="nav_change('skin', 'remove')" >皮肤</a></li>
<li><a id="avatarshow" class="nav_menu" href="javascript:void(0)" onmouseover="nav_change('avatarshow', 'add')" onmouseout="nav_change('avatarshow', 'remove')" >三国秀</a></li>
<li><a id="ach" class="nav_menu" href="javascript:void(0)" onmouseover="nav_change('ach', 'add')" onmouseout="nav_change('ach', 'remove')" >战功</a></li>
<li><a id="tools" class="nav_menu" href="javascript:void(0)" onmouseover="nav_change('tools', 'add')" onmouseout="nav_change('tools', 'remove')" >工具箱</a></li>
<li><a id="isgx" class="nav_menu" href="javascript:void(0)" onmouseover="nav_change('isgx', 'add')" onmouseout="nav_change('isgx', 'remove')" >我的三国秀</a></li>
<li><a target="_blank" href="http://wp.qq.com/wpa/qunwpa?idkey=30ebbc589c876544cbf77142f87497ba003dd86a3ebe89e6e868058323be76be"><img border="0" src="./images/group.png" alt="三国杀ol资料站交流群" title="三国杀ol资料站交流群"></a></li>
</ul>
SGS;
if ($_SESSION ['uid']) {
	echo '<div class="menber_info"><span>亲爱的 ' . $usergroups . ' ' . $_SESSION ['username'] . '(UID:' . $_SESSION ['uid'] . ') 欢迎您</span>' . $admintips . '<span><a href="./member.php?action=logout&hash=' . $formhash . '">注销</a></span></div>';
}
echo '</div>';