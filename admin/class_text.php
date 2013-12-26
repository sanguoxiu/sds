<?php

class TEXT {
	function m_a() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=m_a" method="POST">
<table style="width:500px !important" >
<tr><td>帐号：</td><td><input type="text" name="username" size="20"></td></tr>
<tr><td>密码：</td><td><input type="text" name="password" size="20"></td></tr>
<tr><td>权限：</td><td><select name="adminid" size="1">
<!--option value="1" selected>超级管理员</option>
<option value="2">数据管理员</option>
<option value="3">管理员</option-->
<option value="99">vip</option>
<option value="0" selected>会员</option>
</select></td></tr>
<tr><td><input type="submit" value="添加帐号" /></td></tr>
</table>
</form>
SGS;
	}
	function m_m() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=m_m" method="POST">
<table style="width:500px !important" >
<tr><td>UID：</td><td><input type="text" name="uid" size="20"></td></tr>
<tr><td>帐号：</td><td><input type="text" name="username" size="20"></td></tr>
<tr><td>密码：</td><td><input type="text" name="password" size="20"></td></tr>
<tr><td>权限：</td><td><select name="adminid" size="1">
<option value="1" selected>超级管理员</option>
<option value="2">数据管理员</option>
<option value="3">管理员</option>
<option value="99">vip</option>
<option value="0" selected>会员</option>
</select></td></tr>
<tr><td><input type="submit" value="修改信息" /></td></tr>
</table>
</form>
SGS;
	}
	function m_d() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=m_d" method="POST">
<table style="width:500px !important" >
<tr><td>帐号：</td><td><input type="text" name="username" size="20"></td></tr>
<tr><td><input type="submit" value="删除帐号" /></td></tr>
</table>
</form>
<p><font color="red">提示：删除数据后无法恢复，请慎重！！</font></p>
SGS;
	}
	function a_a() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=a_a" method="POST">
<table style="width:500px !important" >
<tr><td>三国秀id：</td><td><input type="text" name="aid" size="20"></td></tr>
<tr><td>名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>简介：</td><td><input type="text" name="tips" size="20"></td></tr>
<tr><td>三国秀分类：</td><td><select name="type" size="1">
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
<tr><td>图片id：</td><td><input type="text" name="pid" size="20"></td></tr>
<tr><td>三国秀类型：</td><td><select name="pictype" size="1">
<option value="1" selected>静态</option>
<option value="2">动态</option>
</select></td></tr>
<tr><td><input type="submit" value="添加三国秀" /></td></tr>
</table>
</form>
SGS;
	}
	function a_m() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=a_m" method="POST">
<table style="width:500px !important" >
<tr><td>三国秀id(必填)：</td><td><input type="text" name="aid" size="20"></td></tr>
<tr><td>名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>简介：</td><td><input type="text" name="tips" size="20"></td></tr>
<tr><td>三国秀分类：</td><td><select name="type" size="1">
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
<tr><td>图片id：</td><td><input type="text" name="pid" size="20"></td></tr>
<tr><td>三国秀类型：</td><td><select name="pictype" size="1">
<option value="1" selected>静态</option>
<option value="2">动态</option>
</select></td></tr>
<tr><td><input type="submit" value="修改三国秀" /></td></tr>
</table>
</form>
SGS;
	}
	function a_d() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=a_d" method="POST">
<table style="width:500px !important" >
<tr><td>三国秀id：</td><td><input type="text" name="aid" size="20"></td></tr>
<tr><td><input type="submit" value="删除三国秀" /></td></tr>
</table>
</form>
<p><font color="red">提示：删除数据后无法恢复，请慎重！！</font></p>
SGS;
	}
	function a_auto_border() {
        check_new_show('border', 'png');
	}
	function a_auto_border_d() {
        check_new_show('border', 'swf');
	}
	function a_auto_background() {
        check_new_show('background', 'png');
	}
	function a_auto_avatar() {
        check_new_show('avatar', 'png');
	}
	function a_auto_avatar_d() {
        check_new_show('avatar', 'swf');
	}
	function a_add() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=a_add" method="POST">
<table style="width:500px !important" >
<tr><td>名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>价格：</td><td><input type="text" name="cost" size="20"></td></tr>
<tr><td>时限：</td><td><select name="period" size="1">
<option value="">时限</option>
<option value="1">1天</option>
<option value="3">3天</option>
<option value="7">7天</option>
<option value="8">31天</option>
<option value="5">一年</option>
<option value="9">永久</option>
</select></td></tr>
<tr><td>开始时间（YYYY-mm-dd）：</td><td><input type="text" name="time_s" size="20" maxlength="10" ></td></tr>
<tr><td>结束时间（YYYY-mm-dd）：</td><td><input type="text" name="time_e" size="20" maxlength="10" ></td></tr>
<tr><td>介绍：</td><td><input type="text" name="tips" size="20"></td></tr>
<tr><td><input type="submit" value="添加商城三国秀" /></td></tr>
</table>
</form>
SGS;
	}
	function a_add_jq() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=a_add_jq" method="POST">
<table>
<tr><td>边框：</td><td><input type="text" name="name1" size="20"></td>
<td>价格1：</td><td><input type="text" name="cost1" size="20"></td>
<td>时限：</td><td><select name="period1" size="1">
<option value="">时限</option>
<option value="1">1天</option>
<option value="3">3天</option>
<option value="7">7天</option>
<option value="8">31天</option>
<option value="5">一年</option>
<option value="9">永久</option>
</select></td>
<td>价格2：</td><td><input type="text" name="cost2" size="20"></td>
<td>时限：</td><td><select name="period2" size="1">
<option value="">时限</option>
<option value="1">1天</option>
<option value="3">3天</option>
<option value="7">7天</option>
<option value="8">31天</option>
<option value="5">一年</option>
<option value="9">永久</option>
</select></td><td>价格3：</td><td><input type="text" name="cost3" size="20"></td>
<td>时限：</td><td><select name="period3" size="1">
<option value="">时限</option>
<option value="1">1天</option>
<option value="3">3天</option>
<option value="7">7天</option>
<option value="8">31天</option>
<option value="5">一年</option>
<option value="9">永久</option>
</select></td></tr>
<tr><td>背景：</td><td><input type="text" name="name2" size="20"></td>
<td>价格1：</td><td><input type="text" name="cost4" size="20"></td>
<td>时限：</td><td><select name="period4" size="1">
<option value="">时限</option>
<option value="1">1天</option>
<option value="3">3天</option>
<option value="7">7天</option>
<option value="8">31天</option>
<option value="5">一年</option>
<option value="9">永久</option>
</select></td>
<td>价格2：</td><td><input type="text" name="cost5" size="20"></td>
<td>时限：</td><td><select name="period5" size="1">
<option value="">时限</option>
<option value="1">1天</option>
<option value="3">3天</option>
<option value="7">7天</option>
<option value="8">31天</option>
<option value="5">一年</option>
<option value="9">永久</option>
</select></td><td>价格3：</td><td><input type="text" name="cost6" size="20"></td>
<td>时限：</td><td><select name="period6" size="1">
<option value="">时限</option>
<option value="1">1天</option>
<option value="3">3天</option>
<option value="7">7天</option>
<option value="8">31天</option>
<option value="5">一年</option>
<option value="9">永久</option>
</select></td></tr>
<tr><td>形象：</td><td><input type="text" name="name3" size="20"></td>
<td>价格1：</td><td><input type="text" name="cost7" size="20"></td>
<td>时限：</td><td><select name="period7" size="1">
<option value="">时限</option>
<option value="1">1天</option>
<option value="3">3天</option>
<option value="7">7天</option>
<option value="8">31天</option>
<option value="5">一年</option>
<option value="9">永久</option>
</select></td>
<td>价格2：</td><td><input type="text" name="cost8" size="20"></td>
<td>时限：</td><td><select name="period8" size="1">
<option value="">时限</option>
<option value="1">1天</option>
<option value="3">3天</option>
<option value="7">7天</option>
<option value="8">31天</option>
<option value="5">一年</option>
<option value="9">永久</option>
</select></td><td>价格3：</td><td><input type="text" name="cost9" size="20"></td>
<td>时限：</td><td><select name="period9" size="1">
<option value="">时限</option>
<option value="1">1天</option>
<option value="3">3天</option>
<option value="7">7天</option>
<option value="8">31天</option>
<option value="5">一年</option>
<option value="9">永久</option>
</select></td></tr>
<tr><td>套装价格</td><td><input type="text" name="cost10" size="20"></td></tr>
<tr><td>开始时间（YYYY-mm-dd）：</td><td><input type="text" name="time_s" size="20" maxlength="10" ></td></tr>
<tr><td>结束时间（YYYY-mm-dd）：</td><td><input type="text" name="time_e" size="20" maxlength="10" ></td></tr>
<tr><td>节气名字：</td><td><input type="text" name="tips" size="20"></td></tr>
<tr><td><input type="submit" value="添加节气三国秀" /></td></tr>
</table>
</form>
SGS;
	}
	function a_add_bz() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=a_add_bz" method="POST">
<table style="width:500px !important" >
<tr><td>名字：</td><td><input type="text" name="name" size="20" value="标准版"></td></tr>
<tr><td>开始时间（YYYY-mm-dd）：</td><td><input type="text" name="time_s" size="20" maxlength="10" ></td></tr>
<tr><td>结束时间（YYYY-mm-dd）：</td><td><input type="text" name="time_e" size="20" maxlength="10" ></td></tr>
<tr><td><input type="submit" value="添加标准三国秀" /></td></tr>
</table>
</form>
SGS;
	}
	function a_add_pf() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=a_add_pf" method="POST">
<table style="width:500px !important" >
<tr><td>名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>开始时间（YYYY-mm-dd）：</td><td><input type="text" name="time_s" size="20" maxlength="10" ></td></tr>
<tr><td>结束时间（YYYY-mm-dd）：</td><td><input type="text" name="time_e" size="20" maxlength="10" ></td></tr>
<tr><td><input type="submit" value="添加皮肤三国秀" /></td></tr>
</table>
</form>
SGS;
	}
	function c_a() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=c_a" method="POST">
<table style="width:500px !important" >
<tr><td>武将id：</td><td><input type="text" name="cid" size="20"></td></tr>
<tr><td>名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>简介：</td><td><input type="text" name="tips" size="20"></td></tr>
<tr><td>国籍：</td><td><select name="country" size="1">
<option value="">国籍</option>
<option value="1">魏</option>
<option value="2">蜀</option>
<option value="3">吴</option>
<option value="4">群</option>
<option value="5">神</option>
<option value="6">其他</option>
</select></td></tr>
<tr><td>扩展包：</td><td><select name="ex" size="1">
<option value="">扩展包选择</option>
<option value="1">标准版</option>
<option value="2">风</option>
<option value="3">火</option>
<option value="4">林</option>
<option value="5">山</option>
<option value="6">SP</option>
<option value="7">将1</option>
<option value="8">将2</option>
<option value="9">将3</option>
<option value="10">OL</option>
<option value="11">3v3</option>
<option value="12">新1v1</option>
<option value="13">国战</option>
<option value="99">其他</option>
</select></td></tr>
<tr><td><input type="submit" value="添加武将" /></td></tr>
</table>
</form>
SGS;
	}
	function c_week_free() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=c_week_free" method="POST">
<table style="width:500px !important" >
<tr><td>武将1：</td><td><input type="text" name="name1" size="20"></td></tr>
<tr><td>武将2：</td><td><input type="text" name="name2" size="20"></td></tr>
<tr><td>武将vip：</td><td><input type="text" name="name3" size="20"></td></tr>
<tr><td>开始时间（YYYY-mm-dd）：</td><td><input type="text" name="time_s" size="20" maxlength="10" ></td></tr>
<tr><td>结束时间（YYYY-mm-dd）：</td><td><input type="text" name="time_e" size="20" maxlength="10" ></td></tr>
<tr><td><input type="submit" value="添加周免武将" /></td></tr>
</table>
</form>
SGS;
	}
	function c_trial() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=c_trial" method="POST">
<table style="width:500px !important" >
<tr><td>武将名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>价格：</td><td><input type="text" name="cost" size="20"></td></tr>
<tr><td>开始时间：</td><td><input type="text" name="time_s" size="20"></td></tr>
<tr><td>结束时间：</td><td><input type="text" name="time_e" size="20"></td></tr>
<tr><td><input type="submit" value="添加试卖武将" /></td></tr>
</table>
</form>
SGS;
	}
	function c_final() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=c_final" method="POST">
<table style="width:500px !important" >
<tr><td>武将名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>价格：</td><td><input type="text" name="cost" size="20"></td></tr>
<tr><td>开始时间：</td><td><input type="text" name="time_s" size="20"></td></tr>
<tr><td><input type="submit" value="添加正式上架武将" /></td></tr>
</table>
</form>
SGS;
	}
	function c_yinliang() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=c_yinliang" method="POST">
<table style="width:500px !important" >
<tr><td>武将名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>价格（银两）：</td><td><input type="text" name="yinliang" size="20"></td></tr>
<tr><td>开始时间：</td><td><input type="text" name="time_s" size="20"></td></tr>
<tr><td><input type="submit" value="添加银两武将" /></td></tr>
</table>
</form>
SGS;
	}
	function c_m() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=c_m" method="POST">
<table style="width:500px !important" >
<tr><td>武将id：</td><td><input type="text" name="cid" size="20"></td></tr>
<tr><td>名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>简介：</td><td><input type="text" name="tips" size="20"></td></tr>
<tr><td>国籍：</td><td><select name="country" size="1">
<option value="">国籍</option>
<option value="1">魏</option>
<option value="2">蜀</option>
<option value="3">吴</option>
<option value="4">群</option>
<option value="5">神</option>
<option value="6">其他</option>
</select></td></tr>
<tr><td>扩展包：</td><td><select name="ex" size="1">
<option value="">扩展包选择</option>
<option value="1">标准版</option>
<option value="2">风</option>
<option value="3">火</option>
<option value="4">林</option>
<option value="5">山</option>
<option value="6">SP</option>
<option value="7">将1</option>
<option value="8">将2</option>
<option value="9">将3</option>
<option value="10">OL</option>
<option value="11">3v3</option>
<option value="12">新1v1</option>
<option value="13">国战</option>
<option value="99">其他</option>
</select></td></tr>
<tr><td><input type="submit" value="修改武将" /></td></tr>
</table>
</form>
SGS;
	}
	function c_d() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=c_d" method="POST">
<table style="width:500px !important" >
<tr><td>武将id：</td><td><input type="text" name="cid" size="20"></td></tr>
<tr><td><input type="submit" value="删除武将" /></td></tr>
</table>
</form>
<p><font color="red">提示：删除数据后无法恢复，请慎重！！</font></p>
SGS;
	}
	function ach_a() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=ach_a" method="POST">
<table style="width:500px !important" >
<tr><td>战功id：</td><td><input type="text" name="achid" size="20"></td></tr>
<tr><td>名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>简介：</td><td><input type="text" name="tips" size="20"></td></tr>
<tr><td>战功点：</td><td><input type="text" name="point" size="20"></td></tr>
<tr><td>图片id：</td><td><input type="text" name="pid" size="20"></td></tr>
<tr><td>游戏模式：</td><td><input type="text" name="gamemode" size="20"></td></tr>
<tr><td>开始时间(YYYY-mm-dd)：</td><td><input type="text" name="time_s" size="20"></td></tr>
<tr><td>结束时间(YYYY-mm-dd)：</td><td><input type="text" name="time_e" size="20"></td></tr>
<tr><td>分类：</td><td><select name="type" size="1">
<option value="">分类选择</option>
<option value="1">综</option>
<option value="2">3v3</option>
<option value="3">1v1</option>
<option value="4">标</option>
<option value="5">风</option>
<option value="6">火</option>
<option value="7">林</option>
<option value="8">山</option>
<option value="9">SP</option>
<option value="10">将1</option>
<option value="11">将2</option>
<option value="12">将3</option>
<option value="20">神</option>
<option value="99">活动</option>
</select></td></tr>
<tr><td>武将战功的国籍：</td><td><select name="ex" size="1">
<option value="">选择国籍</option>
<option value="1">魏</option>
<option value="2">蜀</option>
<option value="3">吴</option>
<option value="4">群</option>
<option value="5">神</option>
</select></td></tr>
<tr><td><input type="submit" value="添加战功" /></td></tr>
</table>
</form>
SGS;
	}
	function ach_m() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=ach_m" method="POST">
<table style="width:500px !important" >
<tr><td>战功id：</td><td><input type="text" name="achid" size="20"></td></tr>
<tr><td>名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>简介：</td><td><input type="text" name="tips" size="20"></td></tr>
<tr><td>战功点：</td><td><input type="text" name="point" size="20"></td></tr>
<tr><td>图片id：</td><td><input type="text" name="pid" size="20"></td></tr>
<tr><td>游戏模式：</td><td><input type="text" name="gamemode" size="20"></td></tr>
<tr><td>开始时间(YYYY-mm-dd)：</td><td><input type="text" name="time_s" size="20"></td></tr>
<tr><td>结束时间(YYYY-mm-dd)：</td><td><input type="text" name="time_e" size="20"></td></tr>
<tr><td>分类：</td><td><select name="type" size="1">
<option value="">分类选择</option>
<option value="1">综</option>
<option value="2">3v3</option>
<option value="3">1v1</option>
<option value="4">标</option>
<option value="5">风</option>
<option value="6">火</option>
<option value="7">林</option>
<option value="8">山</option>
<option value="9">SP</option>
<option value="10">将1</option>
<option value="11">将2</option>
<option value="12">将3</option>
<option value="20">神</option>
<option value="99">活动</option>
</select></td></tr>
<tr><td>武将战功的国籍：</td><td><select name="ex" size="1">
<option value="">选择国籍</option>
<option value="1">魏</option>
<option value="2">蜀</option>
<option value="3">吴</option>
<option value="4">群</option>
<option value="5">神</option>
</select></td></tr>
<tr><td><input type="submit" value="修改战功" /></td></tr>
</table>
</form>
SGS;
	}
	function ach_d() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=ach_d" method="POST">
<table style="width:500px !important" >
<tr><td>战功id：</td><td><input type="text" name="achid" size="20"></td></tr>
<tr><td><input type="submit" value="删除战功" /></td></tr>
</table>
</form>
<p><font color="red">提示：删除数据后无法恢复，请慎重！！</font></p>
SGS;
	}
	function s_a() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=s_a" method="POST">
<table style="width:500px !important" >
<tr><td>皮肤id：</td><td><input type="text" name="sid" size="20"></td></tr>
<tr><td>名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>简介：</td><td><input type="text" name="tips" size="20"></td></tr>
<tr><td>对应武将的国籍：</td><td><select name="country" size="1">
<option value="">选择国籍</option>
<option value="1">魏</option>
<option value="2">蜀</option>
<option value="3">吴</option>
<option value="4">群</option>
<option value="5">神</option>
</select></td></tr>
<tr><td><input type="submit" value="添加皮肤" /></td></tr>
</table>
</form>
SGS;
	}
	function s_m() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=s_m" method="POST">
<table style="width:500px !important" >
<tr><td>皮肤id：</td><td><input type="text" name="sid" size="20"></td></tr>
<tr><td>名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>简介：</td><td><input type="text" name="tips" size="20"></td></tr>
<tr><td>对应武将的国籍：</td><td><select name="country" size="1">
<option value="">选择国籍</option>
<option value="1">魏</option>
<option value="2">蜀</option>
<option value="3">吴</option>
<option value="4">群</option>
<option value="5">神</option>
</select></td></tr>
<tr><td><input type="submit" value="修改皮肤" /></td></tr>
</table>
</form>
SGS;
	}
	function s_d() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=s_d" method="POST">
<table style="width:500px !important" >
<tr><td>皮肤id：</td><td><input type="text" name="sid" size="20"></td></tr>
<tr><td><input type="submit" value="删除皮肤" /></td></tr>
</table>
</form>
<p><font color="red">提示：删除数据后无法恢复，请慎重！！</font></p>
SGS;
	}
	function s_add() {
		echo <<<SGS
<form action="{$_SERVER[PHP_SELF]}?action=s_add" method="POST">
<table style="width:500px !important" >
<tr><td>名字：</td><td><input type="text" name="name" size="20"></td></tr>
<tr><td>价格：</td><td><input type="text" name="cost" size="20"></td></tr>
<tr><td>时限：</td><td><select name="period" size="1">
<option value="">时限</option>
<option value="1">1天</option>
<option value="3">3天</option>
<option value="7">7天</option>
<option value="8">31天</option>
<option value="5">一年</option>
<option value="9" selected >永久</option>
</select></td></tr>
<tr><td>开始时间（YYYY-mm-dd）：</td><td><input type="text" name="time_s" size="20" maxlength="10" ></td></tr>
<tr><td>结束时间（YYYY-mm-dd）：</td><td><input type="text" name="time_e" size="20" maxlength="10" ></td></tr>
<tr><td>介绍：</td><td><input type="text" name="tips" size="20"></td></tr>
<tr><td><input type="submit" value="添加商城皮肤" /></td></tr>
</table>
</form>
SGS;
	}

}