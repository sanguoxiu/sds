(function() {
	get_menu('index');
	index('i_index');
	$('.nav_menu').click(function() {
		if ($('#container').length > 0) {
			location = './';
		}
		if (login == '0') {
			$('#text_content').html('');
			$('#text_content').append('<font color="red">您还没有登录，请登录。</font>');
			return;
		}
		get_menu(this.id)
	});
	$('#save_sgx').click(function() {
		save_isgx();
	});
	$('#sgx_sina_share').click(function() {
		sgx_sina_share();
	});
	$('#skin_sina_share').click(function() {
		skin_sina_share();
	});
	$('#search_submit').click(function() {
		search_text();
	});
})();
function nav_change(a,b) {
    if (b == 'add'){
		$('#' + a).parent('li').addClass('a');
    }else if (b == 'remove'){
		$('#' + a).parent('li').removeClass('a');
    }
}
function get_menu(a) {
	$('#text_page').addClass('hide');
	$('#sgxsyj').addClass('hide');
	$('#main_left').html('');
	$('#nav1').html($('#' + a).html());
	$('#nav2').html('');
	$('#nav3').html('');
	$('#skin_show').addClass('hide');
	$('#v_search_type').val(a);
	if (a == 'index') {
		index('i_index');
		$('#text_content').css('width', '520px');
		$('#text_content_s').removeClass('hide');
		$('#right_nav input').addClass('hide');
		$('#main_left').append('<h1>=菜单=</h1><ul><li id="i_index" class="menu"><a href="javascript:void(0);" onclick="index(\'i_index\')">资料站简介</a></li><!--li id="i_update_info" class="menu"><a href="javascript:void(0);" onclick="index(\'i_update_info\')">更新日志</a></li--><li id="i_about_us" class="menu"><a href="javascript:void(0);" onclick="index(\'i_about_us\')">关于我们</a></li></ul>');
	} else if (a == 'character') {
		get_list('c_c_1');
		$('#text_content').css('width', '520px');
		$('#text_content_s').removeClass('hide');
		$('#right_nav input').removeClass('hide');
		$("#main_left").append('<h1>=武将=</h1><span id="country">按照国籍分类</span><ul><li id="c_c_1" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_c_1\')">魏国武将</a></li><li id="c_c_2" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_c_2\')">蜀国武将</a></li><li id="c_c_3" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_c_3\')">吴国武将</a></li><li id="c_c_4" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_c_4\')">群雄武将</a></li><li id="c_c_5" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_c_5\')">神武将</a></li></ul><span id="ex">按扩展包分类</span><ul><li id="c_e_1" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_1\')">标准版武将</a></li><li id="c_e_2" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_2\')">风包武将</a></li><li id="c_e_3" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_3\')">火包武将</a></li><li id="c_e_4" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_4\')">林包武将</a></li><li id="c_e_5" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_5\')">山包武将</a></li><li id="c_e_6" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_6\')">SP武将</a></li><li id="c_e_7" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_7\')">一将成名2011</a></li><li id="c_e_8" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_8\')">一将成名2012</a></li><li id="c_e_9" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_9\')">一将成名2013</a></li><!--li id="c_e_10" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_10\')">OL专属</a></li--><li id="c_e_11" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_11\')">3v3</a></li><li id="c_e_12" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_12\')">新1v1</a></li><li id="c_e_13" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_13\')">国战</a></li><li id="c_e_99" class="menu"><a href="javascript:void(0);" onclick="get_list(\'c_e_99\')">其他武将</a></li></ul>');
	} else if (a == 'skin') {
		get_list('s_c_1');
		$('#text_content').css('width', '520px');
		$('#text_content_s').removeClass('hide');
		$('#right_nav input').removeClass('hide');
		$("#main_left").append('<h1>=皮肤=</h1><span id="sountry">按照国籍分类</span><ul><li id="s_c_1" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_c_1\')">魏国武将</a></li><li id="s_c_2" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_c_2\')">蜀国武将</a></li><li id="s_c_3" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_c_3\')">吴国武将</a></li><li id="s_c_4" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_c_4\')">群雄武将</a></li><!--li id="s_c_5" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_c_5\')">神武将</a></li--></ul><span id="ex">按扩展包分类</span><ul><li id="s_e_1" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_1\')">标准版武将</a></li><li id="s_e_2" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_2\')">风包武将</a></li><li id="s_e_3" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_3\')">火包武将</a></li><li id="s_e_4" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_4\')">林包武将</a></li><li id="s_e_5" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_5\')">山包武将</a></li><li id="s_e_6" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_6\')">SP武将</a></li><li id="s_e_7" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_7\')">一将成名2011</a></li><li id="s_e_8" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_8\')">一将成名2012</a></li><li id="s_e_9" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_9\')">一将成名2013</a></li><!--li id="s_e_10" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_10\')">OL专属</a></li><li id="s_e_11" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_11\')">3v3</a></li><li id="s_e_12" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_12\')">新1v1</a></li--><li id="s_e_13" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_13\')">国战</a></li><!--li id="s_e_99" class="menu"><a href="javascript:void(0);" onclick="get_list(\'s_e_99\')">其他武将</a></li--></ul>');
	} else if (a == 'avatarshow') {
		get_list('a_a_1');
		$('#text_content').css('width', '520px');
		$('#text_content_s').removeClass('hide');
		$('#right_nav input').removeClass('hide');
		$('#main_left').append('<h1>=三国秀=</h1><span id="border">三国秀边框</span><ul><li id="a_a_1" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_a_1\')">全部边框</a></li></ul><span id="background">三国秀背景</span><ul><li id="a_b_2" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_b_2\')">全部背景</a></li></ul><span id="avatar">三国秀形象</span><ul><li id="a_c_3" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_c_3\')">标准版形象</a></li><li id="a_c_4" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_c_4\')">amo*Q版形象</a></li><li id="a_c_5" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_c_5\')">节日形象</a></li><li id="a_c_6" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_c_6\')">节气形象</a></li><li id="a_c_7" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_c_7\')">星座形象</a></li><li id="a_c_8" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_c_8\')">皮肤形象</a></li><li id="a_c_9" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_c_9\')">活动形象</a></li><li id="a_c_10" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_c_10\')">萌之系列形象</a></li><li id="a_c_11" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_c_11\')">阿狸系列形象</a></li><li id="a_c_12" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_c_12\')">国战形象</a></li><li id="a_c_13" class="menu"><a href="javascript:void(0);" onclick="get_list(\'a_c_13\')">其他形象</a></li></ul>');
	} else if (a == 'ach') {
		get_list('ach_t_1');
		$('#text_content').css('width', '520px');
		$('#text_content_s').removeClass('hide');
		$('#right_nav input').removeClass('hide');
		$('#main_left').append('<h1>=战功=</h1><span id="country">战功分类</span><ul><li id="ach_t_1" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_1\')">综合</a></li><li id="ach_t_2" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_2\')">3v3</a></li><li id="ach_t_3" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_3\')">1v1</a></li><li id="ach_t_4" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_4\')">标准版武将</a></li><li id="ach_t_5" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_5\')">风包武将</a></li><li id="ach_t_6" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_6\')">火包武将</a></li><li id="ach_t_7" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_7\')">林包武将</a></li><li id="ach_t_8" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_8\')">山包武将</a></li><li id="ach_t_9" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_9\')">SP武将</a></li><li id="ach_t_10" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_10\')">一将成名2011</a></li><li id="ach_t_11" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_11\')">一将成名2012</a></li><li id="ach_t_12" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_12\')">一将成名2013</a></li><li id="ach_t_20" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_20\')">神武将</a></li><li id="ach_t_99" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_t_99\')">活动</a></li></ul><span id="ex">武将分类</span><ul><li id="ach_e_1" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_e_1\')">魏国武将</a></li><li id="ach_e_2" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_e_2\')">蜀国武将</a></li><li id="ach_e_3" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_e_3\')">吴国武将</a></li><li id="ach_e_4" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_e_4\')">群雄武将</a></li><li id="ach_e_5" class="menu"><a href="javascript:void(0);" onclick="get_list(\'ach_e_5\')">神武将</a></li></ul>');
	} else if (a == 'tools') {
		tools('level');
		$('#text_content').css('width', '520px');
		$('#text_content_s').removeClass('hide');
		$('#right_nav input').addClass('hide');
		$('#main_left').append('<h1>=工具箱=</h1><span>角色相关</span><ul><li id="level" class="menu"><a href="javascript:void(0);" onclick="tools(\'level\')">升级经验查询</a></li><li id="civil" class="menu"><a href="javascript:void(0);" onclick="tools(\'civil\')">升级文功查询</a></li></ul><span>公会相关</span><ul><li id="guild" class="menu"><a href="javascript:void(0);" onclick="tools(\'guild\')">公会升级查询</a></li></ul><!--span>其他工具</span><ul><li id="m_c" class="menu"><a href="javascript:void(0);" onclick="tools(\'m_c\')">武将花费</a></li><li id="m_s" class="menu"><a href="javascript:void(0);" onclick="tools(\'m_s\')">三国秀估价</a></li></ul-->');
	} else if (a == 'isgx') {
		isgxPage('get_isgx', '1')
		$('#text_content').css('width', '800px');
		$('#text_content_s').addClass('hide');
		$('#right_nav input').addClass('hide');
		$('#main_left').append('<h1>=三国秀=</h1><ul><li id="get_isgx" class="menu"><a href="javascript:void(0);" onclick="isgxPage(\'get_isgx\', \'1\')">查看我的保存</a></li><li id="get_other_input" class="menu"><a href="javascript:void(0);" onclick="get_other_input()">查看他人保存</a></li><li id="get_all_save" class="menu"><a href="javascript:void(0);" onclick="get_all_save_page(\'get_all_save\', \'1\')">查看所有保存</a></li></ul>');
	}
}
function index(a) {
	if ($('#' + a).hasClass('menu_selected')) return;
	$('.main_left li.menu_selected').removeClass('menu_selected');
	$('#' + a).addClass('menu_selected');
	$('#nav2').html($('#' + a).children('a').html());
	if (a == 'i_index') {
		$('#text_content').css('width', '800px');
		$('#text_content_s').addClass('hide');
		$('#text_content').html('');
		$('#text_content').append('<h1>资料站简介</h1><h2>三国杀online资料站，收集了三国杀online内的武将、战功、皮肤、三国秀等的详细信息，可将三国秀。皮肤分享到微博，以及全新的评分功能，道具好不好，你说了算！！</h2>');
	} else if (a == 'i_about_us') {
		$('#text_content').css('width', '800px');
		$('#text_content_s').addClass('hide');
		$('#text_content').html('');
		$('#text_content').append('<h1>关于我们</h1><h2>我们是热爱三国杀online的一群人，欢迎加入我们。</h2><h2>QQ交流群：304309646</h2>');
	} else if (a == 'i_update_info') {
		$('#text_content').css('width', '800px');
		$('#text_content_s').addClass('hide');
		$('#text_content').html('');
		$('#text_content').append('<h1>更新日志</h1><ul><li>暂无更新信息。</li></ul>');
	}
}
function get_list(a) {
	if ($('#' + a).hasClass('menu_selected')) return;
	$('.main_left li.menu_selected').removeClass('menu_selected');
	$('#' + a).addClass('menu_selected');
	$('#nav2').html($('#' + a).children('a').html());
	$('#nav3').html('');
	$('#text_page').removeClass('hide');
	$('#text_content').html('');
	$('#skin_show').addClass('hide');
	loading();
	$.getJSON('ajax.php?a=list&k=' + a + '&hash=' + formhash,
	function(result) {
		if (!result) return;
		if (result == '99') {
			$('#text_page').html('');
			$('#text_page').append('来源不可信或者请求超时，请刷新页面重试！');
			hideloading();
			return;
		}
		if (result.length == 0) {
			$('#text_page').html('');
			$('#text_page').append('皮肤获取失败，或者该分类没有皮肤！');
			hideloading();
			return;
		}
		$('#text_page').html('');
		var param = new Array();
		var pre = '';
		param = a.split('_');
		if (param[0] == 'a') {
			$.each(result,
			function(i, data) {
				$('#sgxsyj').removeClass('hide');
				if (timestamp - data.time <= 3 * 24 * 60 * 60) {
					$('#text_page').append('<span id="a_' + data.aid + '" class="list new"><a href="javascript:void(0);" onclick="get_info(\'a_' + data.aid + '\')">' + data.name + '</a></span>');
				} else if (timestamp - data.time <= 2 * 24 * 60 * 60) {
					$('#text_page').append('<span id="a_' + data.aid + '" class="list yesterday"><a href="javascript:void(0);" onclick="get_info(\'a_' + data.aid + '\')">' + data.name + '</a></span>');
				} else if (timestamp - data.time <= 24 * 60 * 60) {
					$('#text_page').append('<span id="a_' + data.aid + '" class="list today"><a href="javascript:void(0);" onclick="get_info(\'a_' + data.aid + '\')">' + data.name + '</a></span>');
				} else {
					$('#text_page').append('<span id="a_' + data.aid + '" class="list"><a href="javascript:void(0);" onclick="get_info(\'a_' + data.aid + '\')">' + data.name + '</a></span>');
				}
				hideloading();
			})
		} else if (param[0] == 'c') {
			$.each(result,
			function(i, data) {
				if (timestamp - data.time <= 3 * 24 * 60 * 60) {
					$('#text_page').append('<span id="c_' + data.cid + '" class="list new"><a href="javascript:void(0);" onclick="get_info(\'c_' + data.cid + '\')">' + data.name + '</a></span>');
				} else if (timestamp - data.time <= 2 * 24 * 60 * 60) {
					$('#text_page').append('<span id="c_' + data.cid + '" class="list yesterday"><a href="javascript:void(0);" onclick="get_info(\'c_' + data.cid + '\')">' + data.name + '</a></span>');
				} else if (timestamp - data.time <= 24 * 60 * 60) {
					$('#text_page').append('<span id="c_' + data.cid + '" class="list today"><a href="javascript:void(0);" onclick="get_info(\'c_' + data.cid + '\')">' + data.name + '</a></span>');
				} else {
					$('#text_page').append('<span id="c_' + data.cid + '" class="list"><a href="javascript:void(0);" onclick="get_info(\'c_' + data.cid + '\')">' + data.name + '</a></span>');
				}
				hideloading();
			})
		} else if (param[0] == 'ach') {
			$.each(result,
			function(i, data) {
				if (timestamp - data.time <= 3 * 24 * 60 * 60) {
					$('#text_page').append('<span id="ach_' + data.achid + '" class="list new"><a href="javascript:void(0);" onclick="get_info(\'ach_' + data.achid + '\')">' + data.name + '</a></span>');
				} else if (timestamp - data.time <= 2 * 24 * 60 * 60) {
					$('#text_page').append('<span id="ach_' + data.achid + '" class="list yesterday"><a href="javascript:void(0);" onclick="get_info(\'ach_' + data.achid + '\')">' + data.name + '</a></span>');
				} else if (timestamp - data.time <= 24 * 60 * 60) {
					$('#text_page').append('<span id="ach_' + data.achid + '" class="list today"><a href="javascript:void(0);" onclick="get_info(\'ach_' + data.achid + '\')">' + data.name + '</a></span>');
				} else {
					$('#text_page').append('<span id="ach_' + data.achid + '" class="list"><a href="javascript:void(0);" onclick="get_info(\'ach_' + data.achid + '\')">' + data.name + '</a></span>');
				}
				hideloading();
			})
		} else if (param[0] == 's') {
			$.each(result,
			function(i, data) {
				if (timestamp - data.time <= 3 * 24 * 60 * 60) {
					$('#text_page').append('<span id="s_' + data.sid + '" class="list new"><a href="javascript:void(0);" onclick="get_info(\'s_' + data.sid + '\')">' + data.name + '</a></span>');
				} else if (timestamp - data.time <= 2 * 24 * 60 * 60) {
					$('#text_page').append('<span id="s_' + data.sid + '" class="list yesterday"><a href="javascript:void(0);" onclick="get_info(\'s_' + data.sid + '\')">' + data.name + '</a></span>');
				} else if (timestamp - data.time <= 24 * 60 * 60) {
					$('#text_page').append('<span id="s_' + data.sid + '" class="list today"><a href="javascript:void(0);" onclick="get_info(\'s_' + data.sid + '\')">' + data.name + '</a></span>');
				} else {
					$('#text_page').append('<span id="s_' + data.sid + '" class="list"><a href="javascript:void(0);" onclick="get_info(\'s_' + data.sid + '\')">' + data.name + '</a></span>');
				}
				hideloading();
			})
		}
	}).fail(function() {
		$('#text_page').html('');
		$('#text_page').append('加载失败，错误代码:' + a);
		hideloading();
	})
}
function get_info(a) {
	if ($('#' + a).hasClass('list_selected')) return;
	$('#text_page span.list_selected').removeClass('list_selected');
	$('#' + a).addClass('list_selected');
	$('#nav3').html($('#' + a).children('a').html());
	$('#skin_show').addClass('hide');
	loading();
	$.getJSON('ajax.php?a=info&k=' + a + '&hash=' + formhash,
	function(result) {
		if (!result) return;
		if (result == '99') {
			$('#text_content').html('');
			$('#text_content').append('来源不可信或者请求超时，请刷新页面重试！');
			hideloading();
			return;
		}
		var param = new Array();
		var pre = '';
		param = a.split('_');
		pre = param[0];
		if (param[0] == 'c') {
			$('#text_content').html('');
			$.each(result,
			function(i, data) {
				var country;
				var ex;
				var tips;
				switch (data.ex) {
				case '1':
					ex = '标';
					break;
				case '2':
					ex = '风';
					break;
				case '3':
					ex = '火';
					break;
				case '4':
					ex = '林';
					break;
				case '5':
					ex = '山';
					break;
				case '6':
					ex = 'SP';
					break;
				case '7':
					ex = '将1';
					break;
				case '8':
					ex = '将2';
					break;
				case '9':
					ex = '将3';
					break;
				case '10':
					ex = 'OL';
					break;
				case '11':
					ex = '3v3';
					break;
				case '12':
					ex = '新1v1';
					break;
				case '13':
					ex = '国战';
					break;
				case '99':
					ex = '其他';
					break;
				}
				switch (data.country) {
				case '1':
					country = '魏';
					break;
				case '2':
					country = '蜀';
					break;
				case '3':
					country = '吴';
					break;
				case '4':
					country = '群';
					break;
				case '5':
					country = '神';
					break;
				case '6':
					country = '其他';
					break;
				}
				if (data.tips) {
					tips = data.tips;
				} else {
					tips = '暂无武将介绍';
				}
				if (data.average_score == 0) {
					average_score = '暂无评分';
					progerss = '0';
				} else if (data.average_score > 0 && data.average_score <= 1.5) {
					average_score = '白板武将(' + data.average_score + ')';
					progerss = '-16';
				} else if (data.average_score > 1.5 && data.average_score <= 2.5) {
					average_score = '不是很强(' + data.average_score + ')';
					progerss = '-32';
				} else if (data.average_score > 2.5 && data.average_score <= 3.5) {
					average_score = '一般强度(' + data.average_score + ')';
					progerss = '-48';
				} else if (data.average_score > 3.5 && data.average_score <= 4.5) {
					average_score = '非常强力(' + data.average_score + ')';
					progerss = '-64';
				} else if (data.average_score > 4.5 && data.average_score <= 5) {
					average_score = '神级武将(' + data.average_score + ')';
					progerss = '-80';
				}
				$('#v_star').val(data.v_average_score);
				$('#text_content').append('<div class="character box"><div class="c_avatar"><img src="./assets/character/' + data.cid + '.png" /></div><div class="c_name">' + data.name + '</div><div class="c_ex">(' + ex + ')</div><div class="c_country">国籍：' + country + '</div><div class="c_id">武将ID：' + data.cid + '</div><div class="c_tips">' + tips + '</div><div class="score_tips">已有' + data.amount + '人评分，快点击下面的星星评分吧！</div><div class="c_score">武将强度指数：' + average_score + '</div><div id="star_' + a + '" class="star" style="background-position: 0px ' + progerss + 'px;"><em onclick="itemclk(\'' + a + '\', 1)" onmouseover="itemop(\'' + a + '\', 1)" onmouseout="itemset(1)" title="白板武将">白板武将</em><em onclick="itemclk(\'' + a + '\', 2)" onmouseover="itemop(\'' + a + '\', 2)" onmouseout="itemset(2)" title="不是很强">不是很强</em><em onclick="itemclk(\'' + a + '\', 3)" onmouseover="itemop(\'' + a + '\', 3)" onmouseout="itemset(3)" title="一般强度">一般强度</em><em onclick="itemclk(\'' + a + '\', 4)" onmouseover="itemop(\'' + a + '\', 4)" onmouseout="itemset(4)" title="非常强力">非常强力</em><em onclick="itemclk(\'' + a + '\', 5)" onmouseover="itemop(\'' + a + '\', 5)" onmouseout="itemset(5)" title="神级武将">神级武将</em><div id="score_result" class="score_result"></div></div></div>');
				hideloading();
			});
			get_shop(a)
		} else if (param[0] == 'a') {
			$('#text_content').html('');
			$.each(result,
			function(i, data) {
				var type;
				var ex;
				var tips;
				var average_score;
				var progerss;
				switch (data.type) {
				case '1':
					type = '边框';
					break;
				case '2':
					type = '背景';
					break;
				case '3':
					type = '标准版形象';
					break;
				case '4':
					type = 'amo*Q形象';
					break;
				case '5':
					type = '节日形象';
					break;
				case '6':
					type = '节气形象';
					break;
				case '7':
					type = '星座形象';
					break;
				case '8':
					type = '皮肤形象';
					break;
				case '9':
					type = '活动形象';
					break;
				case '10':
					type = '萌之形象';
					break;
				case '11':
					type = '阿狸形象';
					break;
				case '12':
					type = '国战形象';
					break;
				case '13':
					type = '其他形象';
					break;
				}
				if (data.tips) {
					tips = data.tips;
				} else {
					tips = '暂无介绍';
				}
				if (data.average_score == 0) {
					average_score = '暂无评分';
					progerss = '0';
				} else if (data.average_score > 0 && data.average_score <= 1.5) {
					average_score = '人人都有(' + data.average_score + ')';
					progerss = '-16';
				} else if (data.average_score > 1.5 && data.average_score <= 2.5) {
					average_score = '烂大街了(' + data.average_score + ')';
					progerss = '-32';
				} else if (data.average_score > 2.5 && data.average_score <= 3.5) {
					average_score = '一般般啦(' + data.average_score + ')';
					progerss = '-48';
				} else if (data.average_score > 3.5 && data.average_score <= 4.5) {
					average_score = '比较稀有(' + data.average_score + ')';
					progerss = '-64';
				} else if (data.average_score > 4.5 && data.average_score <= 5) {
					average_score = '非常稀有(' + data.average_score + ')';
					progerss = '-80';
				}
				$('#v_star').val(data.v_average_score);
				if (data.type == '1') {
					if (data.pictype == '2') {
						$('#text_content').append('<div class="border box"><div class="a_img_1"><object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="148" height="208" hspace="-28"><param name="movie" value=assets/border/' + data.pid + '1.swf"><param name="quality" value="High"><param name="wmode" value="transparent"><embed src="./assets/border/' + data.pid + '1.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" width="148" height="208" hspace="-28" wmode="transparent"></object></div><div class="a_name">' + data.name + '</div><div class="a_id">三国秀ID：' + data.aid + '</div><div class="a_type">所属：' + type + '</div><div class="a_tips">' + tips + '</div><div class="score_tips">已有' + data.amount + '人评分，快点击下面的星星评分吧！</div><div class="a_rare">稀有度：' + average_score + '</div><div id="star_' + a + '" class="star" style="background-position: 0px ' + progerss + 'px;"><em onclick="itemclk(\'' + a + '\', 1)" onmouseover="itemop(\'' + a + '\', 1)" onmouseout="itemset(1)" title="人人都有">人人都有</em><em onclick="itemclk(\'' + a + '\', 2)" onmouseover="itemop(\'' + a + '\', 2)" onmouseout="itemset(2)" title="烂大街了">烂大街了</em><em onclick="itemclk(\'' + a + '\', 3)" onmouseover="itemop(\'' + a + '\', 3)" onmouseout="itemset(3)" title="一般般啦">一般般啦</em><em onclick="itemclk(\'' + a + '\', 4)" onmouseover="itemop(\'' + a + '\', 4)" onmouseout="itemset(4)" title="比较稀有">比较稀有</em><em onclick="itemclk(\'' + a + '\', 5)" onmouseover="itemop(\'' + a + '\', 5)" onmouseout="itemset(5)" title="太稀有了">太稀有了</em><div id="score_result" class="score_result"></div></div></div>');
						$('#bkuang').html('');
						$('#bkuang').append('<object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="148" height="208" hspace="-28"><param name="movie" value="./assets/border/' + data.pid + '1.swf"><param name="quality" value="High"><param name="wmode" value="transparent"><embed src="./assets/border/' + data.pid + '1.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" width="148" height="208" hspace="-28" wmode="transparent"></object>');
						$('#sgx_1').html('');
						$('#sgx_1').append('边框：' + data.name);
						$('#v_bk').val(data.pid);
						$('#v_bktype').val('2');
						$('#v_bk_n').val(data.name);
						hideloading();
					} else {
						$('#text_content').append('<div class="border box"><div class="a_img_1"><img src="./assets/border/' + data.pid + '1.png" /></div><div class="a_name">' + data.name + '</div><div class="a_id">三国秀ID：' + data.aid + '</div><div class="a_type">所属：' + type + '</div><div class="a_tips">' + tips + '</div><div class="score_tips">已有' + data.amount + '人评分，快点击下面的星星评分吧！</div><div class="a_rare">稀有度：' + average_score + '</div><div id="star_' + a + '" class="star" style="background-position: 0px ' + progerss + 'px;"><em onclick="itemclk(\'' + a + '\', 1)" onmouseover="itemop(\'' + a + '\', 1)" onmouseout="itemset(1)" title="人人都有">人人都有</em><em onclick="itemclk(\'' + a + '\', 2)" onmouseover="itemop(\'' + a + '\', 2)" onmouseout="itemset(2)" title="烂大街了">烂大街了</em><em onclick="itemclk(\'' + a + '\', 3)" onmouseover="itemop(\'' + a + '\', 3)" onmouseout="itemset(3)" title="一般般啦">一般般啦</em><em onclick="itemclk(\'' + a + '\', 4)" onmouseover="itemop(\'' + a + '\', 4)" onmouseout="itemset(4)" title="比较稀有">比较稀有</em><em onclick="itemclk(\'' + a + '\', 5)" onmouseover="itemop(\'' + a + '\', 5)" onmouseout="itemset(5)" title="太稀有了">太稀有了</em><div id="score_result" class="score_result"></div></div></div>');
						$('#bkuang').html('');
						$('#bkuang').append('<img src="./assets/border/' + data.pid + '1.png" />');
						$('#sgx_1').html('');
						$('#sgx_1').append('边框：' + data.name);
						$('#v_bk').val(data.pid);
						$('#v_bktype').val('1');
						$('#v_bk_n').val(data.name);
						hideloading();
					}
				} else if (data.type == '2') {
					$('#text_content').append('<div class="background box"><div class="a_img_2"><img src="./assets/background/' + data.pid + '.png" /></div><div class="a_name">' + data.name + '</div><div class="a_id">三国秀ID：' + data.aid + '</div><div class="a_type">所属：' + type + '</div><div class="a_tips">' + tips + '</div><div class="score_tips">已有' + data.amount + '人评分，快点击下面的星星评分吧！</div><div class="a_rare">稀有度：' + average_score + '</div><div id="star_' + a + '" class="star" style="background-position: 0px ' + progerss + 'px;"><em onclick="itemclk(\'' + a + '\', 1)" onmouseover="itemop(\'' + a + '\', 1)" onmouseout="itemset(1)" title="人人都有">人人都有</em><em onclick="itemclk(\'' + a + '\', 2)" onmouseover="itemop(\'' + a + '\', 2)" onmouseout="itemset(2)" title="烂大街了">烂大街了</em><em onclick="itemclk(\'' + a + '\', 3)" onmouseover="itemop(\'' + a + '\', 3)" onmouseout="itemset(3)" title="一般般啦">一般般啦</em><em onclick="itemclk(\'' + a + '\', 4)" onmouseover="itemop(\'' + a + '\', 4)" onmouseout="itemset(4)" title="比较稀有">比较稀有</em><em onclick="itemclk(\'' + a + '\', 5)" onmouseover="itemop(\'' + a + '\', 5)" onmouseout="itemset(5)" title="太稀有了">太稀有了</em><div id="score_result" class="score_result"></div></div></div>');
					$('#bjing').html('');
					$('#bjing').append('<img src="./assets/background/' + data.pid + '.png" /></div>');
					$('#sgx_2').html('');
					$('#sgx_2').append('背景：' + data.name);
					$('#v_bj').val(data.pid);
					$('#v_bj_n').val(data.name);
					hideloading();
				} else {
					if (data.pictype == '2') {
						$('#text_content').append('<div class="avatar box"><div class="a_img_3"><object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="103" height="169" hspace="-28"><param name="movie" value="./assets/avatar/' + data.pid + '.swf"><param name="quality" value="High"><param name="wmode" value="transparent"><embed src="./assets/avatar/' + data.pid + '.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" width="103" height="169" hspace="-28" wmode="transparent"></object></div><div class="a_name">' + data.name + '</div><div class="a_id">三国秀ID：' + data.aid + '</div><div class="a_type">所属：' + type + '</div><div class="a_tips">' + tips + '</div><div class="score_tips">已有' + data.amount + '人评分，快点击下面的星星评分吧！</div><div class="a_rare">稀有度：' + average_score + '</div><div id="star_' + a + '" class="star" style="background-position: 0px ' + progerss + 'px;"><em onclick="itemclk(\'' + a + '\', 1)" onmouseover="itemop(\'' + a + '\', 1)" onmouseout="itemset(1)" title="人人都有">人人都有</em><em onclick="itemclk(\'' + a + '\', 2)" onmouseover="itemop(\'' + a + '\', 2)" onmouseout="itemset(2)" title="烂大街了">烂大街了</em><em onclick="itemclk(\'' + a + '\', 3)" onmouseover="itemop(\'' + a + '\', 3)" onmouseout="itemset(3)" title="一般般啦">一般般啦</em><em onclick="itemclk(\'' + a + '\', 4)" onmouseover="itemop(\'' + a + '\', 4)" onmouseout="itemset(4)" title="比较稀有">比较稀有</em><em onclick="itemclk(\'' + a + '\', 5)" onmouseover="itemop(\'' + a + '\', 5)" onmouseout="itemset(5)" title="太稀有了">太稀有了</em><div id="score_result" class="score_result"></div></div></div>');
						$('#xxiang').html('');
						$('#xxiang').append('<object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="103" height="169" hspace="-28"><param name="movie" value="./assets/avatar/' + data.pid + '.swf"><param name="quality" value="High"><param name="wmode" value="transparent"><embed src="./assets/avatar/' + data.pid + '.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" width="103" height="169" hspace="-28" wmode="transparent"></object>');
						$('#sgx_3').html('');
						$('#sgx_3').append('形象：' + data.name);
						$('#v_xx').val(data.pid);
						$('#v_xxtype').val('2');
						hideloading();
					} else {
						$('#text_content').append('<div class="avatar box"><div class="a_img_3"><img src="./assets/avatar/' + data.pid + '.png" /></div><div class="a_name">' + data.name + '</div><div class="a_id">三国秀ID：' + data.aid + '</div><div class="a_type">所属：' + type + '</div><div class="a_tips">' + tips + '</div><div class="score_tips">已有' + data.amount + '人评分，快点击下面的星星评分吧！</div><div class="a_rare">稀有度：' + average_score + '</div><div id="star_' + a + '" class="star" style="background-position: 0px ' + progerss + 'px;"><em onclick="itemclk(\'' + a + '\', 1)" onmouseover="itemop(\'' + a + '\', 1)" onmouseout="itemset(1)" title="人人都有">人人都有</em><em onclick="itemclk(\'' + a + '\', 2)" onmouseover="itemop(\'' + a + '\', 2)" onmouseout="itemset(2)" title="烂大街了">烂大街了</em><em onclick="itemclk(\'' + a + '\', 3)" onmouseover="itemop(\'' + a + '\', 3)" onmouseout="itemset(3)" title="一般般啦">一般般啦</em><em onclick="itemclk(\'' + a + '\', 4)" onmouseover="itemop(\'' + a + '\', 4)" onmouseout="itemset(4)" title="比较稀有">比较稀有</em><em onclick="itemclk(\'' + a + '\', 5)" onmouseover="itemop(\'' + a + '\', 5)" onmouseout="itemset(5)" title="太稀有了">太稀有了</em><div id="score_result" class="score_result"></div></div></div>');
						$('#xxiang').html('');
						$('#xxiang').append('<img src="./assets/avatar/' + data.pid + '.png" /></div>');
						$('#sgx_3').html('');
						$('#sgx_3').append('形象：' + data.name);
						$('#v_xx').val(data.pid);
						$('#v_xxtype').val('1');
						$('#v_xx_n').val(data.name);
						hideloading();
					}
				}
			});
			get_shop(a)
		} else if (param[0] == 'ach') {
			$('#text_content').html('');
			$.each(result,
			function(i, data) {
				var type;
				var ex;
				var time_s;
				var time_e;
				var time;
				var tips;
				switch (data.type) {
				case '1':
					type = '综';
					break;
				case '2':
					type = '3v3';
					break;
				case '3':
					type = '1v1';
					break;
				case '4':
					type = '标';
					break;
				case '5':
					type = '风';
					break;
				case '6':
					type = '火';
					break;
				case '7':
					type = '林';
					break;
				case '8':
					type = '山';
					break;
				case '9':
					type = 'SP';
					break;
				case '10':
					type = '将1';
					break;
				case '11':
					type = '将2';
					break;
				case '12':
					type = '将3';
					break;
				case '20':
					type = '神';
					break;
				case '99':
					type = '活';
					break;
				}
				switch (data.ex) {
				case '1':
					ex = '魏';
					break;
				case '2':
					ex = '蜀';
					break;
				case '3':
					ex = '吴';
					break;
				case '4':
					ex = '群';
					break;
				case '5':
					ex = '神';
					break;
				}
				time_s = data.time_s;
				time_e = data.time_e;
				if (time_s == '19700101') {
					if (time_e == '19700101') {
						time = '长期';
					} else {
						time = '未知';
					}
				} else {
					if (time_e == '19700101') {
						time = time_s + ' - Now';
					} else {
						time = time_s + ' - ' + time_e;
					}
				}
				if (data.tips) {
					tips = data.tips;
				} else {
					tips = '暂无介绍';
				}
				if (data.average_score == 0) {
					average_score = '暂无评分';
					progerss = '0';
				} else if (data.average_score > 0 && data.average_score <= 1.5) {
					average_score = '非常容易(' + data.average_score + ')';
					progerss = '-16';
				} else if (data.average_score > 1.5 && data.average_score <= 2.5) {
					average_score = '比较容易(' + data.average_score + ')';
					progerss = '-32';
				} else if (data.average_score > 2.5 && data.average_score <= 3.5) {
					average_score = '一般般啦(' + data.average_score + ')';
					progerss = '-48';
				} else if (data.average_score > 3.5 && data.average_score <= 4.5) {
					average_score = '比较困难(' + data.average_score + ')';
					progerss = '-64';
				} else if (data.average_score > 4.5 && data.average_score <= 5) {
					average_score = '非常困难(' + data.average_score + ')';
					progerss = '-80';
				}
				$('#v_star').val(data.v_average_score);
				$('#text_content').append('<div class="achievement box"><div class="ach_title"><img src="./assets/title/' + data.pid + '.png" /></div><div class="ach_img"><img src="./assets/image/' + data.pid + '.png" /></div><div class="ach_text"><img src="./assets/text/' + data.pid + '.png" /></div><div class="ach_name">' + data.name + '</div><div class="ach_id">战功ID：' + data.achid + '</div><div class="ach_tips">' + tips + '</div><div class="ach_time">出现时间：' + time + '</div><div class="ach_point">战功点：' + data.point + '</div><div class="score_tips_ach">已有' + data.amount + '人评分，快点击下面的星星评分吧！</div><div class="ach_hme">完成难易程度：' + average_score + '</div><div id="star_' + a + '" class="star" style="background-position: 0px ' + progerss + 'px;"><em onclick="itemclk(\'' + a + '\', 1)" onmouseover="itemop(\'' + a + '\', 1)" onmouseout="itemset(1)" title="非常容易">非常容易</em><em onclick="itemclk(\'' + a + '\', 2)" onmouseover="itemop(\'' + a + '\', 2)" onmouseout="itemset(2)" title="比较容易">比较容易</em><em onclick="itemclk(\'' + a + '\', 3)" onmouseover="itemop(\'' + a + '\', 3)" onmouseout="itemset(3)" title="一般般啦">一般般啦</em><em onclick="itemclk(\'' + a + '\', 4)" onmouseover="itemop(\'' + a + '\', 4)" onmouseout="itemset(4)" title="比较困难">比较困难</em><em onclick="itemclk(\'' + a + '\', 5)" onmouseover="itemop(\'' + a + '\', 5)" onmouseout="itemset(5)" title="非常困难">非常困难</em><div id="score_result" class="score_result"></div></div><div class="ach_com">战功完成方法推荐：开发中……</div></div>');
				hideloading();
			})
		} else if (param[0] == 's') {
			$('#text_content').html('');
			$.each(result,
			function(i, data) {
				if (data.tips) {
					tips = data.tips;
				} else {
					tips = '暂无介绍';
				}
                if (data.painter) {
                    painter = '画师：' + data.painter;
				} else {
					painter = '';
				}
				if (data.average_score == 0) {
					average_score = '暂无评分';
					progerss = '0';
				} else if (data.average_score > 0 && data.average_score <= 1.5) {
					average_score = '非常难看(' + data.average_score + ')';
					progerss = '-16';
				} else if (data.average_score > 1.5 && data.average_score <= 2.5) {
					average_score = '比较难看(' + data.average_score + ')';
					progerss = '-32';
				} else if (data.average_score > 2.5 && data.average_score <= 3.5) {
					average_score = '一般般啦(' + data.average_score + ')';
					progerss = '-48';
				} else if (data.average_score > 3.5 && data.average_score <= 4.5) {
					average_score = '比较好看(' + data.average_score + ')';
					progerss = '-64';
				} else if (data.average_score > 4.5 && data.average_score <= 5) {
					average_score = '非常好看(' + data.average_score + ')';
					progerss = '-80';
				}
				$('#v_sid').val(data.sid);
				$('#v_sname').val(data.name);
				$('#v_star').val(data.v_average_score);
				$('#text_content').append('<div class="skin box"><div class="s_img"><img src="./assets/skin/' + data.sid + '.png" width="148"/ title="皮肤名字:' + data.name + '\n点击图片查看大图" onclick="skin_show(\'' + data.sid + '\')" /></div><div class="s_name">' + data.name + '</div><div class="s_id">皮肤ID：' + data.sid + '</div><div class="s_painter">' + painter + '</div><div class="s_tips">' + tips + '</div><div class="score_tips">已有' + data.amount + '人评分，快点击下面的星星评分吧！</div><div class="s_score">皮肤审美指数：' + average_score + '</div><div id="star_' + a + '" class="star" style="background-position: 0px ' + progerss + 'px;"><em onclick="itemclk(\'' + a + '\', 1)" onmouseover="itemop(\'' + a + '\', 1)" onmouseout="itemset(1)" title="非常难看">非常难看</em><em onclick="itemclk(\'' + a + '\', 2)" onmouseover="itemop(\'' + a + '\', 2)" onmouseout="itemset(2)" title="比较难看">比较难看</em><em onclick="itemclk(\'' + a + '\', 3)" onmouseover="itemop(\'' + a + '\', 3)" onmouseout="itemset(3)" title="推荐购买">推荐购买</em><em onclick="itemclk(\'' + a + '\', 4)" onmouseover="itemop(\'' + a + '\', 4)" onmouseout="itemset(4)" title="比较好看">比较好看</em><em onclick="itemclk(\'' + a + '\', 5)" onmouseover="itemop(\'' + a + '\', 5)" onmouseout="itemset(5)" title="非常好看">非常好看</em><div id="score_result" class="score_result"></div></div><div id="skin_sina_share" class="skin_sina_share"><a href="javascript:void(0);" onclick="skin_sina_share()"><img src="./images/sina_share.gif" /></a></div><div id="share_result" class="share_result"></div></div>');
				hideloading();
			});
			get_shop(a);
		}
	}).fail(function() {
		$('#text_content').html('');
		$('#text_content').append('加载失败，错误代码:' + b);
		hideloading();
	})
}
function get_shop(a) {
	$.getJSON('ajax.php?a=shop&k=' + a + '&hash=' + formhash,
	function(result) {
		if (!result || result.length == 0) return;
		var param = new Array();
		var pre = '';
		param = a.split("_");
		pre = param[0];
		if (param[0] == 'c') {
			$('#text_content').append('<h3>武将商城上架信息</h3><div class="c_shop box"><table><tr><td style="width: 20px">ID</td><td style="width: 140px">出现时间</td><td style="width: 60px">相关价格</td><td style="width: 220px">简介</td></tr>');
			$.each(result,
			function(i, data) {
				var cost;
				var time_s;
				var time_e;
				var tips;
				if (data.cost == null) {
					cost = 'Failed';
				} else if (data.cost == '0') {
					cost = '免费';
				} else if (data.cost == '99999') {
					cost = '非卖';
				} else {
					cost = data.cost + '元宝';
				}
				if (data.time_s) {
					time_s = data.time_s;
				} else {
					time_s = '未知';
				}
				if (data.time_e != '19700101') {
					time_e = data.time_e;
				} else {
					time_e = '';
				}
				if (data.tips) {
					tips = data.tips;
				} else {
					tips = '暂无介绍';
				}
				$('#text_content table tbody').append('<tr><td style="width: 20px">' + (i + 1) + '</td><td style="width: 140px">' + time_s + ' - ' + time_e + '</td><td style="width: 60px">' + cost + '</td><td style="width: 220px">' + tips + '</td></tr>');
			});
			$('#text_content').append('</table></div>');
		} else if (param[0] == 'a') {
			$('#text_content').append('<h3>三国秀出现渠道-仅供参考</h3><div class="a_shop box"><table><tr><td style="width: 20px">ID</td><td style="width: 140px">出现时间</td><td style="width: 60px">相关价格</td><td style="width: 220px">简介</td></tr>');
			$.each(result,
			function(i, data) {
				var cost;
				var time_s;
				var time_e;
				var tips;
				var period;
				if (data.cost == null) {
					cost = 'Failed';
				} else if (data.cost == '99999') {
					cost = '非卖';
				} else {
					cost = data.cost + '元宝';
				}
				if (data.time_s) {
					time_s = data.time_s;
				} else {
					time_s = '未知';
				}
				if (data.time_e != '19700101') {
					time_e = data.time_e;
				} else {
					time_e = '未知';
				}
				if (data.tips) {
					tips = data.tips;
				} else {
					tips = '暂无介绍';
				}
				switch (data.period) {
				case '1':
					period = '/1天';
					break;
				case '3':
					period = '/3天';
					break;
				case '5':
					period = '/1年';
					break;
				case '7':
					period = '/7天';
					break;
				case '8':
					period = '/31天';
					break;
				case '9':
					period = '/永久';
					break;
				}
				$('#text_content table tbody').append('<tr><td style="width: 20px">' + (i + 1) + '</td><td style="width: 140px">' + time_s + ' - ' + time_e + '</td><td style="width: 94px">' + cost + period + '</td><td style="width: 186px">' + tips + '</td></tr>');
			});
			$('#text_content').append('</table></div>');
		} else if (param[0] == 's') {
			$('#text_content').append('<h3>皮肤出现渠道-仅供参考</h3><div class="a_shop box"><table><tr><td style="width: 20px">ID</td><td style="width: 140px">出现时间</td><td style="width: 60px">相关价格</td><td style="width: 220px">简介</td></tr>');
			$.each(result,
			function(i, data) {
				var cost;
				var time_s;
				var time_e;
				var tips;
				var period;
				if (data.cost == null) {
					cost = 'Failed';
				} else if (data.cost == '99999') {
					cost = '非卖';
				} else {
					cost = data.cost + '元宝';
				}
				if (data.time_s != '19700101') {
					time_s = data.time_s;
				} else {
					time_s = '未知';
				}
				if (data.time_e != '19700101') {
					time_e = data.time_e;
				} else {
					time_e = '未知';
				}
				if (data.time_s == '19700101' && data.time_e == '19700101') {
					time_s = time_e = '';
				}
				if (data.tips) {
					tips = data.tips;
				} else {
					tips = '暂无介绍';
				}
				switch (data.period) {
				case '1':
					period = '/1天';
					break;
				case '3':
					period = '/3天';
					break;
				case '5':
					period = '/1年';
					break;
				case '7':
					period = '/7天';
					break;
				case '8':
					period = '/31天';
					break;
				case '9':
					period = '/永久';
					break;
				}
				$('#text_content table tbody').append('<tr><td style="width: 20px">' + (i + 1) + '</td><td style="width: 140px">' + time_s + ' - ' + time_e + '</td><td style="width: 94px">' + cost + period + '</td><td style="width: 186px">' + tips + '</td></tr>');
			});
			$('#text_content').append('</table></div>');
		}
	}).fail(function() {
		$('#text_content').append('加载失败，错误代码:' + a);
		hideloading();
	})
}
function tools(a) {
	if ($('#' + a).hasClass('menu_selected')) return;
	$('.main_left li.menu_selected').removeClass('menu_selected');
	$('#' + a).addClass('menu_selected');
	$('#nav2').html($('#' + a).children('a').html());
	$('#nav3').html('');
	$('#text_page').addClass('hide');
	$('#text_content').html('');
	$('#skin_show').addClass('hide');
	if (a == 'level') {
		$('#text_content').append('<h1>经验计算器</h1><div id="t_level" class="t_level" >起始等级：<input type="number" value="0" id="level_start" name="level_start" maxlength="3" min="0" max="200" class="input_num level_start" onkeyup="this.value=this.value.replace(/\\D/g,\'\');" onafterpaste="this.value=this.value.replace(/\\D/g,\'\');"/>结束等级：<input type="number" value="" id="level_end" name="level_end" maxlength="3" min="0" max="200" class="input_num level_end" onkeyup="this.value=this.value.replace(/\\D/g,\'\');" onafterpaste="this.value=this.value.replace(/\\D/g,\'\');" /><input id="level_submit" type="submit" class="input_submit level_submit" onclick="level_calculate();" value="计算" /><input type="hidden" value="1200" id="exp_day" name="exp_day" /></div><div id="t_level_result" class="t_level_result" ></div>');
	} else if (a == 'civil') {
		$('#text_content').append('<h1>文功计算器</h1><div id="t_civil" class="t_level" >起始等级：<input type="number" value="0" id="civil_start" name="civil_start" maxlength="2" min="0" max="50" class="input_num civil_start" onkeyup="this.value=this.value.replace(/\\D/g,\'\');" onafterpaste="this.value=this.value.replace(/\\D/g,\'\');"/>结束等级：<input type="number" value="" id="civil_end" name="civil_end" maxlength="2" min="0" max="50" class="input_num civil_end" onkeyup="this.value=this.value.replace(/\\D/g,\'\');" onafterpaste="this.value=this.value.replace(/\\D/g,\'\');" /><input id="civil_submit" type="submit" class="input_submit civil_submit" onclick="civil_calculate();" value="计算" /><input type="hidden" value="150" id="exp_day" name="exp_day" /></div><div id="t_civil_result" class="t_civil_result" >武勋和勇武同样适合本工具查询，其中武勋为0-50级，勇武为0-20级。</div>');
	} else if (a == 'guild') {
		$('#text_content').append('<h1>公会升级计算器</h1><div id="t_guild" class="t_level" >起始等级：<input type="number" value="1" id="guild_start" name="guild_start" maxlength="2" min="1" max="10" class="input_num guild_start" onkeyup="this.value=this.value.replace(/\\D/g,\'\');" onafterpaste="this.value=this.value.replace(/\\D/g,\'\');"/>结束等级：<input type="number" value="" id="guild_end" name="guild_end" maxlength="2" min="1" max="10" class="input_num guild_end" onkeyup="this.value=this.value.replace(/\\D/g,\'\');" onafterpaste="this.value=this.value.replace(/\\D/g,\'\');" /><input id="level_submit" type="submit" class="input_submit guild_submit" onclick="guild_calculate();" value="计算" /></div><div id="t_guild_result" class="t_guild_result" ></div>');
	}
}