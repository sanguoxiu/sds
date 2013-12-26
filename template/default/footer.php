<?php if(!defined('IN_SGS')) exit('Access Denied'); ?>
<div class="footer-bar">
<div class="footer content clearfix">
<ul>
<li>Copyright &copy; 2013 <?php echo copyright_date();?>Angel&#39;s SDS - <a href="./">Sanguosha-Data-Station</a></li>
<li><a href="./stat.html" target="_blank">累计访问：<b><?php echo "$count_a"; ?></b>次</a></li>
<li><a href="./stat.html" target="_blank">今日访问：<b><?php echo "$count_t"; ?></b>次</a></li>
<li><?php echo DEBUG::output();?></li>
<li><?php if (MCACHE::enable ()) echo 'Memcached' ;?></li>
</ul>
</div>
</div>
</div>
<!--[if lte IE 6]><script type="text/javascript" src="./source/js/ie6_tips.js"></script><![endif]-->
<script type="text/javascript"><?php if($_SESSION['uid']) {echo "var login=\"1\";var uid=\"".$_SESSION['uid']."\";var username=\"".$_SESSION['username']."\";var formhash=\"".$formhash."\";var timestamp=\"".TIMESTAMP."\";";}else{echo "var login=\"0\";var uid=\"0\";var username=\"0\";var timestamp=\"".TIMESTAMP."\";";}?></script>
<script type="text/javascript" src="./source/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="./source/js/main.js?v=<?php echo TIMESTAMP;?>"></script>
<script type="text/javascript" src="./source/js/common.js?v=<?php echo TIMESTAMP;?>"></script>
</body>
</html>