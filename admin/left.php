<?php require_once './common.inc.php'; ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chili-1.7.pack.js"></script>
<script type="text/javascript" src="js/jquery.easing.js"></script>
<script type="text/javascript" src="js/jquery.dimensions.js"></script>
<script type="text/javascript" src="js/jquery.accordion.js"></script>
<script language="javascript">
	jQuery().ready(function(){
		jQuery('#navigation').accordion({
			header: '.head',
			navigation1: true, 
			event: 'click',
			fillSpace: true,
			animated: 'bounceslide'
		});
	});
</script>
<style type="text/css">
a {
	color: #15c;
	text-decoration: none;
}

.head {
	color: #009900;
}

body {
	background: #e5e5e5;
}

<!--
body {
	margin: 0px;
	padding: 0px;
	font-size: 12px;
}

#navigation {
	margin: 0px;
	padding: 0px;
	width: 147px;
}

#navigation a.head {
	cursor: pointer;
	background: url(images/main_34.gif) no-repeat scroll;
	display: block;
	font-weight: bold;
	margin: 0px;
	padding: 5px 0 5px;
	text-align: center;
	font-size: 12px;
	text-decoration: none;
}

#navigation ul {
	border-width: 0px;
	margin: 0px;
	padding: 0px;
	text-indent: 0px;
}

#navigation li {
	list-style: none;
	display: inline;
}

#navigation li li a {
	display: block;
	font-size: 12px;
	text-decoration: none;
	text-align: center;
	padding: 3px;
}

#navigation li li a:hover {
	background: url(images/tab_bg.gif) repeat-x;
	border: solid 1px #adb9c2;
}
-->
</style>
</head>
<body>
	<div style="height: 100%;">
<?php
// 1:超级管理员
// 2:数据管理员
// 3:管理员
if ($_SESSION ['admin'] == "1") {
	echo <<<SGS
<ul id="navigation">
    <li><a class="head">成员管理</a>
		<ul>
			<li><a href="admin.php?action=m_l" target="rightFrame">成员查看</a></li>
			<li><a href="admin.php?action=m_a" target="rightFrame">成员添加</a></li>
			<li><a href="admin.php?action=m_m" target="rightFrame">成员修改</a></li>
			<li><a href="admin.php?action=m_d" target="rightFrame">成员删除</a></li>
		</ul>
	</li>
	<li><a class="head">三国秀管理</a>
		<ul>
			<li><a href="admin.php?action=a_l" target="rightFrame">三国秀查看</a></li>
			<li><a href="admin.php?action=a_a" target="rightFrame">三国秀添加</a></li>
			<li><a href="admin.php?action=a_m" target="rightFrame">三国秀修改</a></li>
			<li><a href="admin.php?action=a_d" target="rightFrame">三国秀删除</a></li>
		</ul>
	</li>
	<li><a class="head">三国秀智能更新</a>
		<ul>
			<li><a href="admin.php?action=a_auto_border" target="rightFrame">检测边框</a></li>
			<li><a href="admin.php?action=a_auto_border_d" target="rightFrame">检测动态边框</a></li>
			<li><a href="admin.php?action=a_auto_background" target="rightFrame">检测背景</a></li>
			<li><a href="admin.php?action=a_auto_avatar" target="rightFrame">检测形象</a></li>
			<li><a href="admin.php?action=a_auto_avatar_d" target="rightFrame">检测动态形象</a></li>
		</ul>
	</li>
	<li><a class="head">战功管理</a>
		<ul>
			<li><a href="admin.php?action=ach_l" target="rightFrame">战功查看</a></li>
			<li><a href="admin.php?action=ach_a" target="rightFrame">战功添加</a></li>
			<li><a href="admin.php?action=ach_m" target="rightFrame">战功修改</a></li>
			<li><a href="admin.php?action=ach_d" target="rightFrame">战功删除</a></li>
		</ul>
	</li>
	<li><a class="head">武将管理</a>
		<ul>
			<li><a href="admin.php?action=c_l" target="rightFrame">武将查看</a></li>
			<li><a href="admin.php?action=c_a" target="rightFrame">武将添加</a></li>
			<li><a href="admin.php?action=c_m" target="rightFrame">武将修改</a></li>
			<li><a href="admin.php?action=c_d" target="rightFrame">武将删除</a></li>
		</ul>
	</li>
	<li><a class="head">皮肤管理</a>
		<ul>
			<li><a href="admin.php?action=s_l" target="rightFrame">皮肤查看</a></li>
			<li><a href="admin.php?action=s_a" target="rightFrame">皮肤添加</a></li>
			<li><a href="admin.php?action=s_m" target="rightFrame">皮肤修改</a></li>
			<li><a href="admin.php?action=s_d" target="rightFrame">皮肤删除</a></li>
		</ul>
	</li>
	<li><a class="head">==以下为商城管理==</a></li>
	<li><a class="head">三国秀商城</a>
		<ul>
			<li><a href="admin.php?action=a_add" target="rightFrame">添加三国秀商城</a></li>
			<li><a href="admin.php?action=a_add_jq" target="rightFrame">节气秀模版</a></li>
			<li><a href="admin.php?action=a_add_pf" target="rightFrame">皮肤秀模版</a></li>
			<li><a href="admin.php?action=a_add_bz" target="rightFrame">标准秀模版</a></li>
    </ul>
	</li>
	<li><a class="head">武将商城</a>
		<ul>
			<li><a href="admin.php?action=c_week_free" target="rightFrame">周免模版</a></li>
			<li><a href="admin.php?action=c_trial" target="rightFrame">武将试卖</a></li>
			<li><a href="admin.php?action=c_final" target="rightFrame">正式价格</a></li>
			<li><a href="admin.php?action=c_yinliang" target="rightFrame">银两武将</a></li>
    </ul>
	</li>
	<li><a class="head">皮肤商城</a>
		<ul>
			<li><a href="admin.php?action=s_add" target="rightFrame">添加商城皮肤</a></li>
    </ul>
	</li>

</ul>
SGS;
} else if ($_SESSION ['admin'] == "2") {
	echo <<<SGS
<ul id="navigation">
	<li><a class="head">成员管理</a>
		<ul>
			<li><a href="admin.php?action=m_l" target="rightFrame">成员查看</a></li>
			<li><a href="admin.php?action=m_a" target="rightFrame">成员添加</a></li>
		</ul>
	</li>
	<li><a class="head">三国秀管理</a>
		<ul>
			<li><a href="admin.php?action=a_l" target="rightFrame">三国秀查看</a></li>
			<li><a href="admin.php?action=a_a" target="rightFrame">三国秀添加</a></li>
		</ul>
	</li>
	<li><a class="head">三国秀智能更新</a>
		<ul>
			<li><a href="admin.php?action=a_auto_border" target="rightFrame">检测边框</a></li>
			<li><a href="admin.php?action=a_auto_border_d" target="rightFrame">检测动态边框</a></li>
			<li><a href="admin.php?action=a_auto_background" target="rightFrame">检测背景</a></li>
			<li><a href="admin.php?action=a_auto_avatar" target="rightFrame">检测形象</a></li>
			<li><a href="admin.php?action=a_auto_avatar_d" target="rightFrame">检测动态形象</a></li>
		</ul>
	</li>
	<li><a class="head">战功管理</a>
		<ul>
			<li><a href="admin.php?action=ach_l" target="rightFrame">战功查看</a></li>
			<li><a href="admin.php?action=ach_a" target="rightFrame">战功添加</a></li>
		</ul>
	</li>
	<li><a class="head">武将管理</a>
		<ul>
			<li><a href="admin.php?action=c_l" target="rightFrame">武将查看</a></li>
			<li><a href="admin.php?action=c_a" target="rightFrame">武将添加</a></li>
		</ul>
	</li>
	<li><a class="head">皮肤管理</a>
		<ul>
			<li><a href="admin.php?action=s_l" target="rightFrame">皮肤查看</a></li>
			<li><a href="admin.php?action=s_a" target="rightFrame">皮肤添加</a></li>
		</ul>
	</li>
	<li><a class="head">==以下为商城管理==</a></li>
	<li><a class="head">三国秀商城</a>
		<ul>
			<li><a href="admin.php?action=a_add" target="rightFrame">添加三国秀商城</a></li>
			<li><a href="admin.php?action=a_add_jq" target="rightFrame">节气秀模版</a></li>
			<li><a href="admin.php?action=a_add_pf" target="rightFrame">皮肤秀模版</a></li>
			<li><a href="admin.php?action=a_add_bz" target="rightFrame">标准秀模版</a></li>
    </ul>
	</li>
	<li><a class="head">武将商城</a>
		<ul>
			<li><a href="admin.php?action=c_week_free" target="rightFrame">周免模版</a></li>
			<li><a href="admin.php?action=c_trial" target="rightFrame">武将试卖</a></li>
			<li><a href="admin.php?action=c_final" target="rightFrame">正式价格</a></li>
			<li><a href="admin.php?action=c_yinliang" target="rightFrame">银两武将</a></li>
        </ul>
	</li>
	<li><a class="head">皮肤商城</a>
		<ul>
			<li><a href="admin.php?action=s_add" target="rightFrame">添加商城皮肤</a></li>
    </ul>
	</li>

</ul>
SGS;
} else if ($_SESSION ['admin'] == "3") {
	echo <<<SGS
<ul id="navigation">
	<li><a class="head">成员管理</a>
		<ul>
			<li><a href="admin.php?action=m_l" target="rightFrame">成员查看</a></li>
		</ul>
	</li>
	<li><a class="head">三国秀管理</a>
		<ul>
			<li><a href="admin.php?action=a_l" target="rightFrame">三国秀查看</a></li>
		</ul>
	</li>
	<li><a class="head">战功管理</a>
		<ul>
			<li><a href="admin.php?action=ach_l" target="rightFrame">战功查看</a></li>
		</ul>
	</li>
	<li><a class="head">武将管理</a>
		<ul>
			<li><a href="admin.php?action=c_l" target="rightFrame">武将查看</a></li>
		</ul>
	</li>
	<li><a class="head">皮肤管理</a>
		<ul>
			<li><a href="admin.php?action=s_l" target="rightFrame">皮肤查看</a></li>
		</ul>
	</li>

</ul>
SGS;
}
?>
</div>
</body>
</html>
