<?php
error_reporting(0);
header("content-type:image/png");
//获得GET值
$border = $_GET['border'];
$background = $_GET['background'];
$avatar = $_GET['avatar'];

//定义三国秀图片地址
$im = imageCreatefrompng("./sgx_default.png");
$bj = imageCreatefrompng("http://web.sanguosha.com/220/assets/AvatarShow/background/" . $background . ".png");
$bk = imageCreatefrompng("http://web.sanguosha.com/220/assets/simplified/AvatarShow/border/" . $border . "1.png");
$xx = imageCreatefrompng("http://web.sanguosha.com/220/assets/AvatarShow/avatar/" . $avatar . ".png");

//生成图片
imagecopy($im, $bj, 29, 22, 0, 0, 103, 169);
imagecopy($im, $xx, 29, 22, 0, 0, 103, 169);
imagecopy($im, $bk, 0, 0, 0, 0, 148, 208);
imagepng($im);
echo " BY:sanguosha.sinaapp.com";
imagedestroy($im);
?>
