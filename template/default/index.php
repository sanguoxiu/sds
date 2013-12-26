<?php
if (! defined ( 'IN_SGS' ))	exit ( 'Access Denied' );
include SGS_ROOT . './template/default/header.php';
include SGS_ROOT . './template/default/nav.php';
?>
<div class="main content">
	<div id="main_left" class="main_left"></div>
	<div class="main_right">
		<div id="right_nav" class="right_nav">
			<ul>
				<li><a href="./"> 首页 </a></li>
				<li id="nav1" class="r_n_n"></li>
				<li id="nav2" class="r_n_n"></li>
				<li id="nav3" class="r_n_n"></li>
			</ul>
			<input id="search_submit" type="submit" class="search_submit input_submit hide" value="搜索" />
            <input type="text" value="" id="search_text" name="search_text" maxlength="50" class="search_text input_text hide" />
		</div>
		<div class="right_content">
			<div id="text_page" class="text_page hide"></div>
			<div id="text_content_a" class="text_content_a">
				<div id="text_content" class="text_content">
					<!--main内容部分开始-->

					<!--main内容部分结束-->
				</div>
				<div id="text_content_s" class="text_content_s">
					<div id="skin_show" class="skin_show hide"></div>
					<div id="sgxsyj" class="sgxsyj hide">
						<span> 三国秀试衣间 </span>
						<div id="compose" class="compose">
							<div id="bjing" class="cbj">
								<img src="./images/default_bj.png" />
							</div>
							<div id="xxiang" class="cxx">
								<img src="./images/default_xx.png" />
							</div>
							<div id="bkuang" class="cbk">
								<img src="./images/default_bk.png" />
							</div>
						</div>
						<div id="sgx_info" class="sgx_info">
							<ul>
								<li class="title">当前搭配的三国秀为</li>
								<li id="sgx_1">边框：唯我独尊</li>
								<li id="sgx_2">背景：王者擂台</li>
								<li id="sgx_3">形象：绝世高手</li>
							</ul>
						</div>
						<div class="sgx_submit">
							<input id="save_sgx" type="submit" class="button" value="保存当前三国秀" />
							<input id="sgx_sina_share" type="submit" class="button" value="分享当前三国秀" />
						</div>
						<div id="save_result" class="save_result"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="loading" class="loading hide"><img src="./images/loading.gif">载入中...</div>
<div id="pop_mask" class="mod_pop_mask hide"></div>
<div class="hide">
<input type="hidden" id="v_star" name="v_star">
<input type="hidden" id="v_bk" name="v_bk" value="8" />
<input type="hidden" id="v_bj" name="v_bj" value="15" />
<input type="hidden" id="v_xx" name="v_xx" value="405" />
<input type="hidden" id="v_bk_n" name="v_bk_n" value="唯我独尊" />
<input type="hidden" id="v_bj_n" name="v_bj_n" value="王者擂台" />
<input type="hidden" id="v_xx_n" name="v_xx_n" value="绝世高手" />
<input type="hidden" id="v_bktype" name="v_bktype" value="1" />
<input type="hidden" id="v_xxtype" name="v_xxtype" value="1" />
<input type="hidden" id="v_sid" name="v_sid" value="" />
<input type="hidden" id="v_sname" name="v_sname" value="" />
<input type="hidden" id="v_search_type" name="v_search_type" value="" />
<input type="hidden" id="v_isgx_page" name="v_isgx_page" value="1" />
<input type="hidden" id="v_osgx_page" name="v_osgx_page" value="1" />
<input type="hidden" id="v_all_save_page" name="v_all_save_page" value="1" />
<input type="hidden" id="v_uid" name="v_uid" value="" />
</div>
<?php
include SGS_ROOT . './template/default/footer.php';
?>
