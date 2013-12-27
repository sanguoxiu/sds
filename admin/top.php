<?php require_once './common.inc.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
a {
	color: #15c;
	text-decoration: none;
}

span {
	font-size: 12px;
	color: #000000;
	padding-right: 10px;
}

<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

.STYLE1 {
	font-size: 12px;
	color: #000000;
}

.STYLE5 {
	font-size: 12
}

.STYLE7 {
	font-size: 12px;
	color: #FFFFFF;
}

.STYLE7 a {
	font-size: 12px;
	color: #FFFFFF;
}

a img {
	border: none;
}
-->
</style>
</head>

<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="57" background="images/main_03.gif">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="378" height="57">
							<img style="margin-left:45px;" border="0" src="images/button_logo.png" />
						</td>
						<td>&nbsp;</td>
						<td width="281" valign="bottom">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="33" height="27">
										<img src="images/main_05.gif" width="33" height="27" />
									</td>
									<td width="248" background="images/main_06.gif">
										<table width="225" border="0" align="center" cellpadding="0"
											cellspacing="0">
											<tr>
												<td height="17">
													<div align="right">
														<a href="javascript:void(0)" target="rightFrame">
															<img src="images/pass.gif" width="69" height="17" />
														</a>
													</div>
												</td>
												<td>
													<div align="right">
														<a href="javascript:void(0)" target="rightFrame">
															<img src="images/user.gif" width="69" height="17" />
														</a>
													</div>
												</td>
												<td>
													<div align="right">
														<a
															href="../../member.php?action=logout&hash=<?php echo $formhash; ?>"
															target="_parent">
															<img src="images/quit.gif" alt=" " width="69" height="17" />
														</a>
													</div>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="30" background="images/main_31.gif">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="8" height="30">
							<img src="images/main_28.gif" width="8" height="30" />
						</td>
						<td width="147" background="images/main_29.gif">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="24%">&nbsp;</td>
									<td width="43%" height="20" valign="bottom" class="STYLE1">管理菜单</td>
									<td width="33%">&nbsp;</td>
								</tr>
							</table>
						</td>
						<td width="39">
							<img src="images/main_30.gif" width="39" height="30" />
						</td>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="20" valign="bottom">
										<span>当前登录用户：<?php echo $_SESSION['username']; ?></span>
										<span>管理权限：<?php echo $admin; ?></span>
										<span>
											<a href="right.php" target="rightFrame">返回管理首页</a>
										</span>
										<span>
											<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>"
												target="_blank">返回资料站首页</a>
										</span>
									</td>
									<td valign="bottom" class="STYLE1">
										<div align="right"></div>
									</td>
								</tr>
							</table>
						</td>
						<td width="17">
							<img src="images/main_32.gif" width="17" height="30" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>

