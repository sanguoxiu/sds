if (uid == '0') {
	m_l();
} else {
	$('#login').html('');
	$('#weibo_login').html('');
	$('#tencent_login').html('');
}
function m_l() {
	$('#login').html('');
	$('#login').append('<form method="post" action="member.php?action=login"><table><tr><td><input type="text" name="username" placeholder="UID/用户名" required="" tabindex="1001"></td><td><a href="javascript:void(0);" onclick="m_r()">注册帐号</a></td></tr><tr><td><input type="password" name="password" placeholder="密　码" required=""  tabindex="1002"></td><td><input type="submit" value="登录" class="sbt"  tabindex="1003"/></td></tr></table></form>');
}
function m_r() {
	$('#login').html('');
	$('#login').append('<form method="post" action="member.php?action=register"><table><tr><td><input type="text" name="username" placeholder="用户名" required=""  tabindex="1001"></td><td><input type="text" name="email" placeholder="E-mail" required=""  tabindex="1003"></td><td></td></tr><tr><td><input type="password" name="password" placeholder="密　码" required=""  tabindex="1002"></td><td><input type="submit" value="注册" class="sbt"  tabindex="1005"/><span><a href="javascript:void(0);" onclick="m_l()">返回登陆</a></span></td></tr></table></form>');
}
function switch_b_r(a) {
	$('#bind_menu_l').removeClass('bind_selected');
	$('#bind_menu_r').addClass('bind_selected');
	$('#bind_r').removeClass('hide');
	$('#bind_l').addClass('hide');
}
function switch_b_l(a) {
	$('#bind_menu_r').removeClass('bind_selected');
	$('#bind_menu_l').addClass('bind_selected');
	$('#bind_l').removeClass('hide');
	$('#bind_r').addClass('hide');
}
function loading() {
	$('#loading').removeClass('hide');
	$('#pop_mask').removeClass('hide');
}
function hideloading() {
	$('#loading').addClass('hide');
	$('#pop_mask').addClass('hide');
}
function skin_show(a) {
	$('#skin_show').removeClass('hide');
	$('#skin_show').html('');
	$('#skin_show').append('<img src="assets/skin/' + a + '.png" title="点击关闭大图" onclick="skin_hide()" />');
}
function skin_hide() {
	$('#skin_show').addClass('hide');
}

function save_isgx() {
	$('#save_result').html('');
	v_bk = $('#v_bk').val();
	v_bj = $('#v_bj').val();
	v_xx = $('#v_xx').val();
	v_bk_n = $('#v_bk_n').val();
	v_bj_n = $('#v_bj_n').val();
	v_xx_n = $('#v_xx_n').val();
	v_bktype = $('#v_bktype').val();
	v_xxtype = $('#v_xxtype').val();
	if (!v_bk) {
		$('#save_result').html('保存失败,还没有选择边框');
	} else if (!v_bj) {
		$('#save_result').html('保存失败,还没有选择背景');
	} else if (!v_xx) {
		$('#save_result').html('保存失败,还没有选择形象');
	} else {
		$.post('ajax.php?a=save_isgx&hash=' + formhash, {
			uid: uid,
			data: v_bk + "|" + v_bj + "|" + v_xx + "|" + v_bktype + "|" + v_xxtype + "|" + v_bk_n + "|" + v_bj_n + "|" + v_xx_n,
			time: timestamp,
		},
		function(data) {
			var result_text;
			switch (data) {
			case '1':
				result_text = '保存成功！';
				break;
			case '2':
				result_text = '边框没有选择！';
				break;
			case '3':
				result_text = '背景没有选择！';
				break;
			case '4':
				result_text = '形象没有选择！';
				break;
			case '5':
				result_text = '这套形象已经保存过了！';
				break;
			case '6':
				result_text = '保存的太快啦，请稍候再试！';
				break;
			case '7':
				result_text = '非法请求！';
				break;
			case '8':
				result_text = '请求超时！';
				break;
			case '9':
				result_text = '最多保存500套三国秀！';
				break;
			case '10':
				result_text = '未知错误！';
				break;
			case '99':
				result_text = '来源不可信！请刷新页面';
				break;
			}
			$('#save_result').html(result_text);
		})
	}
}
function isgxPage(a, b) {
	$.get('ajax.php?a=get_isgx_page&k=' + uid + '&page=' + b + '&hash=' + formhash, {},
	function(data) {
		$('#text_page').removeClass('hide');
		$("#text_page").html(data);
	});
	$('#v_isgx_page').val(b);
	isgx(a);
}
function osgxPage(a, b) {
	if ($('#osgx_search_text').val()) {
		$('#v_uid').val($('#osgx_search_text').val());
	}
	var o_uid = $('#v_uid').val();
	$.get('ajax.php?a=get_osgx_page&k=' + o_uid + '&page=' + b + '&hash=' + formhash, {},
	function(data) {
		$('#text_page').removeClass('hide');
		$("#text_page").html(data);
	});
	$('#v_osgx_page').val(b);
	osgx(a);
}
function get_all_save_page(a, b) {
	$.get('ajax.php?a=get_all_save_page&page=' + b + '&hash=' + formhash, {},
	function(data) {
		$('#text_page').removeClass('hide');
		$("#text_page").html(data);
	});
	$('#v_all_save_page').val(b);
	get_all_save(a);
}

function isgx(a) {
	$('.main_left li.menu_selected').removeClass('menu_selected');
	$('#' + a).addClass('menu_selected');
	$('#nav2').html($('#' + a).children('a').html());
	$('#nav3').html('');
	$('#text_content').html('');
	if (a == 'get_isgx') {
		var isgx_page = $('#v_isgx_page').val();
		loading();
		$.getJSON('ajax.php?a=get_isgx&k=' + uid + '&page=' + isgx_page + '&hash=' + formhash,
		function(result) {
			if (result == '') {
				$('#text_content').append('没有保存的三国秀哦！赶紧去保存吧！');
				hideloading();
				return;
			} else if (result.data == '99') {
				$('#text_content').append('请求来源不可信，请刷新页面重试！');
				hideloading();
				return;
			}
			var bk = bj = xx = info = '';
			$.each(result,
			function(i, data) {
				var param = new Array();
				var sgxinfo = data.data;
				var isgx_id = data.id;
				param = sgxinfo.split('|');
				bk = param[0];
				bj = param[1];
				xx = param[2];
				bktype = param[3];
				xxtype = param[4];
				bk_n = param[5];
				bj_n = param[6];
				xx_n = param[7];
				info += '<span id="isgx_content_' + isgx_id + '">';
				info += '<div class="isgx" title="当前三国秀搭配&#10;边框：' + bk_n + '&#10;背景：' + bj_n + '&#10;形象：' + xx_n + '">';
				info += '<div class="cbj"><img src="./assets/background/' + bj + '.png" /></div>';
				if (xxtype == "2") {
					info += '<div class="cxx"><object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="103" height="169" hspace="-28"><param name="movie" value="./assets/avatar/' + xx + '.swf"><param name="quality" value="High"><param name="wmode" value="transparent"><embed src="./assets/avatar/' + xx + '.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" width="103" height="169" hspace="-28" wmode="transparent"></object></div>';
				} else {
					info += '<div class="cxx"><img src="./assets/avatar/' + xx + '.png" /></div>'
				}
				if (bktype == "2") {
					info += '<div class="cbk"><object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="148" height="208" hspace="-28"><param name="movie" value="./assets/border/' + bk + '1.swf"><param name="quality" value="High"><param name="wmode" value="transparent"><embed src="./assets/border/' + bk + '1.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" width="148" height="208" hspace="-28" wmode="transparent"></object></div>';
				} else {
					info += '<div class="cbk"><img src="./assets/border/' + bk + '1.png" /></div>'
				}
				info += '</div>';
				info += '<div id="isgx_info" class="isgx_info">';
				info += '<p>保存时间：' + data.time + '</p>';
				info += '<div id="isgx_sina_share_' + isgx_id + '" class="isgx_sina_share"><a href="javascript:void(0);" onclick="isgx_sina_share(\'' + isgx_id + '\',\'' + bk + '\',\'' + bj + '\',\'' + xx + '\',\'' + bk_n + '\',\'' + bj_n + '\',\'' + xx_n + '\')"><img src="./images/sina_share.gif" /></a></div><div id="isgx_delete_' + isgx_id + '" class="isgx_delete hide"><a href="javascript:void(0);" onclick="isgx_delete(\'' + isgx_id + '\')">删除</a></div><div id="isgx_share_result_' + isgx_id + '" class="isgx_share_result"></div>';
				info += '</div>';
				info += '</span>';
				$('#text_content').html(info);
				hideloading();
			})
		}).fail(function() {
			$('#text_content').html('');
			$('#text_content').append('获取已经保存的三国秀失败，可尝试刷新下网页。');
			hideloading();
		})
	}
}
function get_other_input() {
	if ($('#get_other_input').hasClass('menu_selected')) return;
	$('.main_left li.menu_selected').removeClass('menu_selected');
	$('#get_other_input').addClass('menu_selected');
	$('#nav2').html($('#get_other_input').children('a').html());
	$('#nav3').html('');
	$('#text_content').html('');
	$('#text_page').removeClass('hide');
	$('#text_page').html('');
	$('#text_page').append('<p>请输入他人uid或者用户名：<input type="text" value="" id="osgx_search_text" name="search_text" maxlength="50" class="input_text" /><input id="osgx_search_submit" type="submit" class="input_submit" onclick="osgxPage(\'get_osgx\', 1);" value="查看" /><p>');
}
function osgx(a) {
	$('#text_content').html('');
	if (a == 'get_osgx') {
		if (v_uid == '') {
			$('#text_content').append('UID/用户名不能为空');
			return
		}
		var o_uid = $('#v_uid').val();
		var osgx_page = $('#v_osgx_page').val();
		loading();
		$.getJSON('ajax.php?a=get_osgx&k=' + o_uid + '&page=' + osgx_page + '&hash=' + formhash,
		function(result) {
			if (result == '') {
				$('#text_content').append('Ta还没有保存的三国秀哦！换个人试试吧！');
				hideloading();
				return;
			} else if (result == '99') {
				$('#text_content').append('请求来源不可信，请刷新页面重试！');
				hideloading();
				return;
			}
			var bk = bj = xx = info = '';
			$.each(result,
			function(i, data) {
				var param = new Array();
				var sgxinfo = data.data;
				var isgx_id = data.id;
				param = sgxinfo.split('|');
				bk = param[0];
				bj = param[1];
				xx = param[2];
				bktype = param[3];
				xxtype = param[4];
				bk_n = param[5];
				bj_n = param[6];
				xx_n = param[7];
				info += '<span id="isgx_content_' + isgx_id + '">';
				info += '<div class="isgx" title="当前三国秀搭配&#10;边框：' + bk_n + '&#10;背景：' + bj_n + '&#10;形象：' + xx_n + '">';
				info += '<div class="cbj"><img src="./assets/background/' + bj + '.png" /></div>';
				if (xxtype == "2") {
					info += '<div class="cxx"><object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="103" height="169" hspace="-28"><param name="movie" value="./assets/avatar/' + xx + '.swf"><param name="quality" value="High"><param name="wmode" value="transparent"><embed src="./assets/avatar/' + xx + '.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" width="103" height="169" hspace="-28" wmode="transparent"></object></div>';
				} else {
					info += '<div class="cxx"><img src="./assets/avatar/' + xx + '.png" /></div>'
				}
				if (bktype == "2") {
					info += '<div class="cbk"><object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="148" height="208" hspace="-28"><param name="movie" value="./assets/border/' + bk + '1.swf"><param name="quality" value="High"><param name="wmode" value="transparent"><embed src="./assets/border/' + bk + '1.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" width="148" height="208" hspace="-28" wmode="transparent"></object></div>';
				} else {
					info += '<div class="cbk"><img src="./assets/border/' + bk + '1.png" /></div>';
				}
				info += '</div>';
				info += '<div id="isgx_info" class="isgx_info">';
				info += '<p>保存者：' + data.username + '</p>';
				info += '<p>保存时间：' + data.time + '</p>';
				info += '<div id="isgx_sina_share_' + isgx_id + '" class="isgx_sina_share"><a href="javascript:void(0);" onclick="isgx_sina_share(\'' + isgx_id + '\',\'' + bk + '\',\'' + bj + '\',\'' + xx + '\',\'' + bk_n + '\',\'' + bj_n + '\',\'' + xx_n + '\')"><img src="./images/sina_share.gif" /></a></div><div id="isgx_share_result_' + isgx_id + '" class="isgx_share_result"></div>';
				info += '</div>';
				info += '</span>';
				$('#text_content').html(info);
				hideloading();
			})
		}).fail(function() {
			$('#text_content').html('');
			$('#text_content').append('获取已经保存的三国秀失败，可尝试刷新下网页。');
			hideloading();
		});
		$('#v_uid').val(o_uid);
	}
}

function get_all_save(a) {
	$('.main_left li.menu_selected').removeClass('menu_selected');
	$('#' + a).addClass('menu_selected');
	$('#nav2').html($('#' + a).children('a').html());
	$('#nav3').html('');
	$('#text_content').html('');
	if (a == 'get_all_save') {
		var all_save_page = $('#v_all_save_page').val();
		loading();
		$.getJSON('ajax.php?a=get_all_save&page=' + all_save_page + '&hash=' + formhash,
		function(result) {
			if (result == '') {
				$('#text_content').append('没有保存的三国秀哦！赶紧去保存吧！');
				hideloading();
				return;
			} else if (result.data == '99') {
				$('#text_content').append('请求来源不可信，请刷新页面重试！');
				hideloading();
				return;
			}
			var bk = bj = xx = info = '';
			$.each(result,
			function(i, data) {
				var param = new Array();
				var sgxinfo = data.data;
				var isgx_id = data.id;
				var star_id = 'sgx_' + isgx_id;
				param = sgxinfo.split('|');
				bk = param[0];
				bj = param[1];
				xx = param[2];
				bktype = param[3];
				xxtype = param[4];
				bk_n = param[5];
				bj_n = param[6];
				xx_n = param[7];
				if (data.average_score == 0) {
					average_score = '暂无评分';
					progerss = '0';
				} else if (data.average_score > 0 && data.average_score <= 1.5) {
					average_score = '难看搭配(' + data.average_score + ')';
					progerss = '-16';
				} else if (data.average_score > 1.5 && data.average_score <= 2.5) {
					average_score = '大众搭配(' + data.average_score + ')';
					progerss = '-32';
				} else if (data.average_score > 2.5 && data.average_score <= 3.5) {
					average_score = '一般搭配(' + data.average_score + ')';
					progerss = '-48';
				} else if (data.average_score > 3.5 && data.average_score <= 4.5) {
					average_score = '极品搭配(' + data.average_score + ')';
					progerss = '-64';
				} else if (data.average_score > 4.5 && data.average_score <= 5) {
					average_score = '神级搭配(' + data.average_score + ')';
					progerss = '-80';
				}
				$('#v_star').val(data.v_average_score);
                info += '<span id="isgx_content_' + isgx_id + '">';
				info += '<div class="isgx" title="当前三国秀搭配&#10;边框：' + bk_n + '&#10;背景：' + bj_n + '&#10;形象：' + xx_n + '">';
				info += '<div class="cbj"><img src="./assets/background/' + bj + '.png" /></div>';
				if (xxtype == "2") {
					info += '<div class="cxx"><object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="103" height="169" hspace="-28"><param name="movie" value="./assets/avatar/' + xx + '.swf"><param name="quality" value="High"><param name="wmode" value="transparent"><embed src="./assets/avatar/' + xx + '.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" width="103" height="169" hspace="-28" wmode="transparent"></object></div>';
				} else {
					info += '<div class="cxx"><img src="./assets/avatar/' + xx + '.png" /></div>';
				}
				if (bktype == "2") {
					info += '<div class="cbk"><object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="148" height="208" hspace="-28"><param name="movie" value="./assets/border/' + bk + '1.swf"><param name="quality" value="High"><param name="wmode" value="transparent"><embed src="./assets/border/' + bk + '1.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" width="148" height="208" hspace="-28" wmode="transparent"></object></div>';
				} else {
					info += '<div class="cbk"><img src="./assets/border/' + bk + '1.png" /></div>';
				}
				info += '</div>';
				info += '<div id="isgx_info" class="isgx_info">';
				info += '<p>保存者：' + data.username + '</p>';
				info += '<p>保存时间：' + data.time + '</p>';
				info += '<div id="isgx_sina_share_' + isgx_id + '" class="isgx_sina_share"><a href="javascript:void(0);" onclick="isgx_sina_share(\'' + isgx_id + '\',\'' + bk + '\',\'' + bj + '\',\'' + xx + '\',\'' + bk_n + '\',\'' + bj_n + '\',\'' + xx_n + '\')"><img src="./images/sina_share.gif" /></a></div><div id="isgx_delete_' + isgx_id + '" class="isgx_delete hide"><a href="javascript:void(0);" onclick="isgx_delete(\'' + isgx_id + '\')">删除</a></div><div id="isgx_share_result_' + isgx_id + '" class="isgx_share_result"></div>';
                info += '</div>';
				info += '</span>';
				$('#text_content').html(info);
				hideloading();
			})
		}).fail(function() {
			$('#text_content').html('');
			$('#text_content').append('获取已经保存的三国秀失败，可尝试刷新下网页。');
			hideloading();
		})
	}
}

function isgx_delete_show() {
	$('.isgx_delete').removeClass('hide');
	$('#delete_bar').html('<a href="javascript:void(0);" onclick="isgx_delete_hide()">点我退出删除模式</a>');
}
function isgx_delete_hide() {
	$('.isgx_delete').addClass('hide');
	$('#delete_bar').html('<a href="javascript:void(0);" onclick="isgx_delete_show()">点我进入删除模式</a>');
}

function itemop(i, v) {
	var h = v > 0 ? '-' + (v * 16) + 'px': '0';
	$('#star_' + i).css('background-position', '0px ' + h);
	var param = new Array();
	var type = '';
	param = i.split('_');
	type = param[0];
	if (type == 'a') {
		var result_text;
		switch (v) {
		case 1:
			result_text = '人人都有';
			break;
		case 2:
			result_text = '烂大街了';
			break;
		case 3:
			result_text = '一般般啦';
			break;
		case 4:
			result_text = '比较稀有';
			break;
		case 5:
			result_text = '太稀有了';
			break;
		default:
			result_text = '';
			break;
		}
	} else if (type == 'c') {
		var result_text;
		switch (v) {
		case 1:
			result_text = '白板武将';
			break;
		case 2:
			result_text = '不是很强';
			break;
		case 3:
			result_text = '一般强度';
			break;
		case 4:
			result_text = '非常强力';
			break;
		case 5:
			result_text = '神级武将';
			break;
		default:
			result_text = '';
			break;
		}
	} else if (type == 's') {
		var result_text;
		switch (v) {
		case 1:
			result_text = '非常难看';
			break;
		case 2:
			result_text = '比较难看';
			break;
		case 3:
			result_text = '一般般啦';
			break;
		case 4:
			result_text = '比较好看';
			break;
		case 5:
			result_text = '非常好看';
			break;
		default:
			result_text = '';
			break;
		}
	} else if (type == 'ach') {
		var result_text;
		switch (v) {
		case 1:
			result_text = '非常容易';
			break;
		case 2:
			result_text = '比较容易';
			break;
		case 3:
			result_text = '一般般啦';
			break;
		case 4:
			result_text = '比较困难';
			break;
		case 5:
			result_text = '非常困难';
			break;
		default:
			result_text = '';
			break;
		}
/*	} else if (type == 'sgx') {
		var result_text;
		switch (v) {
		case 1:
			result_text = '难看搭配';
			break;
		case 2:
			result_text = '大众搭配';
			break;
		case 3:
			result_text = '一般搭配';
			break;
		case 4:
			result_text = '极品搭配';
			break;
		case 5:
			result_text = '神级搭配';
			break;
		default:
			result_text = '';
			break;
		}*/
	}
	$('#score_result').html(result_text);
}
function itemclk(i, v) {
	var param = new Array();
	var type = '';
	param = i.split('_');
	type = param[0];
	$('#score_result').html('评分中……');
	$.post('ajax.php?a=score_' + type + '&hash=' + formhash, {
		v: v,
		a_n: i,
	},
	function(data) {
		var result_text;
		switch (data) {
		case '1':
			result_text = '评分成功';
			break;
		case '2':
			result_text = '非法请求';
			break;
		case '3':
			result_text = '缺少参数';
			break;
		case '4':
			result_text = '您已评过';
			break;
		case '5':
			result_text = '未知错误';
			break;
		}
		$('#score_result').html(result_text);
	})
}
function itemset(i) {
	var v = $('#v_star').val();
	var h = v > 0 ? '-' + (v * 16) + 'px': '0';
	$('#star_' + i).css('background-position', '0px ' + h);
	$('#score_result').html('');
}
function sgx_sina_share() {
	$('#save_result').html('');
	v_bk = $('#v_bk').val();
	v_bj = $('#v_bj').val();
	v_xx = $('#v_xx').val();
	v_bk_n = $('#v_bk_n').val();
	v_bj_n = $('#v_bj_n').val();
	v_xx_n = $('#v_xx_n').val();
	v_bktype = $('#v_bktype').val();
	v_xxtype = $('#v_xxtype').val();
	wid = $('#v_wid').val();
	if (!v_bk) {
		$('#save_result').html('分享失败,还没有选择边框');
	} else if (!v_bj) {
		$('#save_result').html('分享失败,还没有选择背景');
	} else if (!v_xx) {
		$('#save_result').html('分享失败,还没有选择形象');
	} else {
		$.post('ajax.php?a=sgx_sina_share&hash=' + formhash, {
			data: v_bk + '|' + v_bj + '|' + v_xx + '|' + v_bktype + '|' + v_xxtype + '|' + v_bk_n + '|' + v_bj_n + '|' + v_xx_n,
		},
		function(data) {
			var result_text;
			switch (data) {
			case '1':
				result_text = '分享成功！';
				break;
			case '2':
				result_text = '边框没有选择！';
				break;
			case '3':
				result_text = '背景没有选择！';
				break;
			case '4':
				result_text = '形象没有选择！';
				break;
			case '5':
				result_text = '这套形象已经保存过了！';
				break;
			case '6':
				result_text = '操作过于频繁，请稍候再试';
				break;
			case '7':
				result_text = '非法请求！';
				break;
			case '8':
				result_text = '请求超时！';
				break;
			case '9':
				result_text = '最多保存10套三国秀！';
				break;
			case '10':
				result_text = '未知错误！';
				break;
			case '11':
				result_text = '暂不支持动态三国秀！';
				break;
			case '12':
				result_text = '请使用微博登陆后再分享！';
				break;
			case '99':
				result_text = '来源不可信！请刷新页面';
				break;
			}
			$('#save_result').html(result_text);
		})
	}
}
function isgx_sina_share(id, bk, bj, xx, bk_n, bj_n, xx_n) {
	$('#isgx_share_result_' + id).html('分享中，请稍候……');
	v_bktype = '1';
	v_xxtype = '1';
	wid = $('#v_wid').val();
	if (!v_bk || !v_bj || !v_xx || !v_bk_n || !v_bj_n || !v_xx_n) {
		$('#isgx_share_result_' + id).html('分享失败,参数不全！');
	} else {
		$.post('ajax.php?a=sgx_sina_share&hash=' + formhash, {
			data: bk + '|' + bj + '|' + xx + '|' + v_bktype + '|' + v_xxtype + '|' + bk_n + '|' + bj_n + '|' + xx_n,
		},
		function(data) {
			var result_text;
			switch (data) {
			case '1':
				result_text = '分享成功！';
				break;
			case '2':
				result_text = '边框没有选择！';
				break;
			case '3':
				result_text = '背景没有选择！';
				break;
			case '4':
				result_text = '形象没有选择！';
				break;
			case '5':
				result_text = '这套形象已经保存过了！';
				break;
			case '6':
				result_text = '操作过于频繁，请稍候再试';
				break;
			case '7':
				result_text = '非法请求！';
				break;
			case '8':
				result_text = '请求超时！';
				break;
			case '9':
				result_text = '最多保存10套三国秀！';
				break;
			case '10':
				result_text = '未知错误！';
				break;
			case '11':
				result_text = '暂不支持动态三国秀！';
				break;
			case '12':
				result_text = '请使用微博登陆后再分享！';
				break;
			case '99':
				result_text = '来源不可信！请刷新页面';
				break;
			}
			$('#isgx_share_result_' + id).html(result_text);
		})
	}
}
function skin_sina_share() {
	$('#share_result').html('分享中，请稍候……');
	v_sid = $('#v_sid').val();
	v_sname = $('#v_sname').val();
	wid = $('#v_wid').val();
	if (!v_sid) {
		$('#share_result').html('分享失败,');
	} else {
		$.post('ajax.php?a=skin_sina_share&hash=' + formhash, {
			sid: v_sid,
			sname: v_sname,
		},
		function(data) {
			var result_text;
			switch (data) {
			case '1':
				result_text = '分享成功！';
				break;
			case '2':
				result_text = '没有选择皮肤！';
				break;
			case '3':
				result_text = '背景没有选择！';
				break;
			case '4':
				result_text = '形象没有选择！';
				break;
			case '5':
				result_text = '这套形象已经保存过了！';
				break;
			case '6':
				result_text = '操作过于频繁，请稍候再试';
				break;
			case '7':
				result_text = '非法请求！';
				break;
			case '8':
				result_text = '请求超时！';
				break;
			case '9':
				result_text = '最多保存10套三国秀！';
				break;
			case '10':
				result_text = '未知错误！';
				break;
			case '11':
				result_text = '暂不支持动态三国秀！';
				break;
			case '12':
				result_text = '请使用微博登陆后再分享！';
				break;
			case '99':
				result_text = '来源不可信！请刷新页面';
				break;
			}
			$('#share_result').html(result_text);
		})
	}
}
function isgx_delete(id) {
	$('#isgx_share_result_' + id).html('删除中，请稍候……');
	if (!id) {
		$('#isgx_share_result_' + id).html('分享失败,参数不全！')
	} else {
		$.post('ajax.php?a=isgx_delete&hash=' + formhash, {
			id: id,
		},
		function(data) {
			var result_text;
			switch (data) {
			case '2':
				result_text = '删除失败';
				break;
			case '7':
				result_text = '非法请求！';
				break;
			case '12':
				result_text = '未知错误！';
				break;
			case '99':
				result_text = '来源不可信！请刷新页面';
				break;
			}
			$('#isgx_share_result_' + id).html(result_text);
			if (data == '1') {
				$('#isgx_content_' + id).html('');
			}
		})
	}
}
function search_text() {
	$('#text_page').html('');
	var search_name = $('#search_text').val();
	var search_type = $('#v_search_type').val();
	var type_name;
	switch (search_type) {
	case 'avatarshow':
		type_name = '三国秀';
		break;
	case 'character':
		type_name = '武将';
		break;
	case 'ach':
		type_name = '战功';
		break;
	case 'skin':
		type_name = '皮肤';
		break;
	}
	if (!search_name) {
		return;
	}
	loading();
	$.getJSON('ajax.php?a=search_text&n=' + search_name + '&t=' + search_type + '&hash=' + formhash,
	function(result) {
		if (!result) return;
		if (result.length == 0) {
			$('#text_page').html('没有找到名字和 <font color="red"><b>' + search_name + '</b></font> 相关的' + type_name);
			hideloading();
			return;
		}
		$('#text_page').html('');
		if (search_type == 'avatarshow') {
			$.each(result,
			function(i, data) {
				$('#sgxsyj').removeClass('hide');
				if (timestamp - data.time <= 3 * 24 * 60 * 60) {
					$('#text_page').append('<span id="a_' + data.aid + '" class="list new"><a href="javascript:void(0);" onclick="get_info(\'a_' + data.aid + '\')">' + data.name + '</span>');
				} else if (timestamp - data.time <= 2 * 24 * 60 * 60) {
					$('#text_page').append('<span id="a_' + data.aid + '" class="list yesterday"><a href="javascript:void(0);" onclick="get_info(\'a_' + data.aid + '\')">' + data.name + '</span>');
				} else if (timestamp - data.time <= 24 * 60 * 60) {
					$('#text_page').append('<span id="a_' + data.aid + '" class="list today"><a href="javascript:void(0);" onclick="get_info(\'a_' + data.aid + '\')">' + data.name + '</span>');
				} else {
					$('#text_page').append('<span id="a_' + data.aid + '" class="list"><a href="javascript:void(0);" onclick="get_info(\'a_' + data.aid + '\')">' + data.name + '</span>');
				}
				hideloading();
			})
		} else if (search_type == 'character') {
			$.each(result,
			function(i, data) {
				if (timestamp - data.time <= 3 * 24 * 60 * 60) {
					$('#text_page').append('<span id="c_' + data.cid + '" class="list new"><a href="javascript:void(0);" onclick="get_info(\'c_' + data.cid + '\')">' + data.name + '</span>');
				} else if (timestamp - data.time <= 2 * 24 * 60 * 60) {
					$('#text_page').append('<span id="c_' + data.cid + '" class="list yesterday"><a href="javascript:void(0);" onclick="get_info(\'c_' + data.cid + '\')">' + data.name + '</span>');
				} else if (timestamp - data.time <= 24 * 60 * 60) {
					$('#text_page').append('<span id="c_' + data.cid + '" class="list today"><a href="javascript:void(0);" onclick="get_info(\'c_' + data.cid + '\')">' + data.name + '</span>');
				} else {
					$('#text_page').append('<span id="c_' + data.cid + '" class="list"><a href="javascript:void(0);" onclick="get_info(\'c_' + data.cid + '\')">' + data.name + '</span>');
				}
				hideloading();
			})
		} else if (search_type == 'ach') {
			$.each(result,
			function(i, data) {
				if (timestamp - data.time <= 3 * 24 * 60 * 60) {
					$('#text_page').append('<span id="ach_' + data.achid + '" class="list new"><a href="javascript:void(0);" onclick="get_info(\'ach_' + data.achid + '\')">' + data.name + '</span>');
				} else if (timestamp - data.time <= 2 * 24 * 60 * 60) {
					$('#text_page').append('<span id="ach_' + data.achid + '" class="list yesterday"><a href="javascript:void(0);" onclick="get_info(\'ach_' + data.achid + '\')">' + data.name + '</span>');
				} else if (timestamp - data.time <= 24 * 60 * 60) {
					$('#text_page').append('<span id="ach_' + data.achid + '" class="list today"><a href="javascript:void(0);" onclick="get_info(\'ach_' + data.achid + '\')">' + data.name + '</span>');
				} else {
					$('#text_page').append('<span id="ach_' + data.achid + '" class="list"><a href="javascript:void(0);" onclick="get_info(\'ach_' + data.achid + '\')">' + data.name + '</span>');
				}
				hideloading();
			})
		} else if (search_type == 'skin') {
			$.each(result,
			function(i, data) {
				if (timestamp - data.time <= 3 * 24 * 60 * 60) {
					$('#text_page').append('<span id="s_' + data.sid + '" class="list new"><a href="javascript:void(0);" onclick="get_info(\'s_' + data.sid + '\')">' + data.name + '</span>');
				} else if (timestamp - data.time <= 2 * 24 * 60 * 60) {
					$('#text_page').append('<span id="s_' + data.sid + '" class="list yesterday"><a href="javascript:void(0);" onclick="get_info(\'s_' + data.sid + '\')">' + data.name + '</span>');
				} else if (timestamp - data.time <= 24 * 60 * 60) {
					$('#text_page').append('<span id="s_' + data.sid + '" class="list today"><a href="javascript:void(0);" onclick="get_info(\'s_' + data.sid + '\')">' + data.name + '</span>');
				} else {
					$('#text_page').append('<span id="s_' + data.sid + '" class="list"><a href="javascript:void(0);" onclick="get_info(\'s_' + data.sid + '\')">' + data.name + '</span>');
				}
				hideloading();
			})
		}
	}).fail(function() {
		$('#text_page').html('');
		$('#text_page').append('加载失败，请重新搜索！！');
		hideloading();
	})
}
function level_calculate() {
	var num_s = $('#level_start').val();
	var num_e = $('#level_end').val();
	var num_d = $('#exp_day').val();
	var level_exp = '0';
	if (num_s == '' || num_e == '' || num_d == '') {
		$('#t_level_result').html('');
		$('#t_level_result').append('等级不能为空！');
		return;
	}
	var level_s = parseInt(num_s);
	var level_e = parseInt(num_e);
	var exp_day = parseInt(num_d);
	if (level_s < 0 || level_s > 200 || level_e < 0 || level_e > 200) {
		$('#t_level_result').html('');
		$('#t_level_result').append('等级无效！');
		return;
	}
	if (level_s >= level_e) {
		$('#t_level_result').html('');
		$('#t_level_result').append('等级非法！');
		return;
	}
	var level = new Array(0, 50, 100, 150, 230, 330, 410, 490, 570, 690, 890, 1010, 1130, 1250, 1400, 1700, 2000, 2300, 2600, 3000, 3600, 4000, 4400, 4800, 5300, 6100, 6600, 7100, 7600, 8300, 9300, 9800, 10300, 10800, 11500, 12500, 13000, 13500, 14000, 14700, 15700, 16200, 16700, 17200, 17600, 18900, 19400, 19900, 20400, 20900, 21900, 22500, 23100, 23700, 24300, 25400, 26000, 26600, 27200, 27800, 29000, 29600, 30200, 30800, 31400, 32700, 33500, 34300, 35100, 35900, 37300, 38100, 38900, 39700, 40500, 42000, 42800, 43600, 44400, 45200, 46700, 47500, 48300, 49100, 49900, 50700, 52200, 53100, 54000, 54900, 56400, 57400, 58400, 59400, 60400, 62400, 63100, 64400, 65400, 66400, 68400, 69400, 70400, 71400, 72400, 74400, 75400, 76400, 77400, 78400, 80400, 81400, 82400, 83400, 84400, 86400, 87400, 88400, 89400, 90400, 92400, 93400, 94400, 95400, 96400, 98400, 99400, 100400, 101400, 102400, 104400, 105400, 106400, 107400, 108400, 110400, 111400, 112400, 113400, 114400, 116400, 117400, 118400, 119400, 120400, 122400, 123400, 124400, 125400, 126400, 128400, 130500, 132700, 135000, 137400, 139900, 142500, 145200, 148000, 150900, 153900, 157000, 160200, 163500, 166900, 170400, 174000, 177700, 181500, 185400, 189400, 193500, 197700, 202000, 206400, 210900, 215500, 220200, 225000, 229900, 234900, 240000, 245300, 251245, 257835, 265069, 272947, 281469, 290636, 300448, 310904, 322004, 333748, 346137, 359171, 372849, 387171, 402137, 417748, 434004, 450904);
	level_exp = (level[level_e] - level[level_s]);
	level_day = Math.floor(level_exp / exp_day) + 1;
	$('#t_level_result').html('');
	$('#t_level_result').append('从 ' + level_s + ' 级到 ' + level_e + ' 级共需经验 ' + level_exp + ' ,大概需要 ' + level_day + ' 天！');
}
function civil_calculate() {
	var num_s = $('#civil_start').val();
	var num_e = $('#civil_end').val();
	var num_d = $('#exp_day').val();
	var civil_exp = '0';
	if (num_s == '' || num_e == '' || num_d == '') {
		$('#t_civil_result').html('');
		$('#t_civil_result').append('文功等级不能为空！');
		return;
	}
	var civil_s = parseInt(num_s);
	var civil_e = parseInt(num_e);
	var exp_day = parseInt(num_d);
	if (civil_s < 0 || civil_s > 50 || civil_e < 0 || civil_e > 50) {
		$('#t_civil_result').html('');
		$('#t_civil_result').append('等级无效！');
		return;
	}
	if (civil_s >= civil_e) {
		$('#t_civil_result').html('');
		$('#t_civil_result').append('等级非法！');
		return;
	}
	var civil = new Array(0,100,300,600,1000,1500,2100,2800,3600,4500,5500,6600,7800,9100,10500,12000,13600,15300,17100,19000,21000,23100,25300,27600,30000,32500,35100,37800,40600,43500,46500,49600,52800,56100,59500,63000,66600,70300,74100,78000,82000,86100,90300,94600,99000,103500,108100,112800,117600,122500,127500);
	civil_exp = (civil[civil_e] - civil[civil_s]);
	civil_day = Math.floor(civil_exp / exp_day) + 1;
	$('#t_civil_result').html('');
	$('#t_civil_result').append('从 ' + civil_s + ' 级到 ' + civil_e + ' 级共需文功 ' + civil_exp + ' ,大概需要 ' + civil_day + ' 天！');
}
function guild_calculate() {
	var num_s = $('#guild_start').val();
	var num_e = $('#guild_end').val();
	var guild_exp = guild_money = 0;
	if (num_s == '' || num_e == '') {
		$('#t_guild_result').html('');
		$('#t_guild_result').append('等级不能为空！');
		return;
	}
	var guild_s = parseInt(num_s);
	var guild_e = parseInt(num_e);
	if (guild_s < 1 || guild_s > 10 || guild_e < 1 || guild_e > 10) {
		$('#t_guild_result').html('');
		$('#t_guild_result').append('等级无效！');
		return;
	}
	if (guild_s >= guild_e) {
		$('#t_guild_result').html('');
		$('#t_guild_result').append('等级非法！');
		return;
	}
	var honer = new Array(0,6270,24640,72600,171600,420750,732600,1153460,1691360,2171180);
	var money = new Array(0,180,735,2250,5460,13770,24420,39690,59520,78810);
	guild_exp = (honer[guild_e-1] - honer[guild_s-1]);
	guild_money = (money[guild_e-1] - money[guild_s-1]);
	$('#t_guild_result').html('');
	$('#t_guild_result').append('公会从 ' + guild_s + ' 级到 ' + guild_e + ' 级共需荣誉 ' + guild_exp + ' ,需要资金 ' + guild_money + '！');
}
