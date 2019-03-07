<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="apple-mobile-web-app-capable" content="yes"/><!-- 是否启用 WebApp 全屏模式 -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/><!-- 设置状态栏的背景颜色 -->
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no"/><!-- 禁止数字识自动别为电话号码 --><!-- 不让android识别邮箱 -->
	<title>天辅安中医馆我的会员卡</title>
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/common.css?v=1.0">
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/style.css">
	<script type="text/javascript" src="/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/resize.js"></script>
</head>
<body class="bg-white">
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		我的会员卡
	</div>
	<div class="vip-card-wrap">
		<div class="vip-card" style="background-image: url(/tcm/template/Tcm/images/card-bg2.png);">
			<a href="<?php echo U('About/openvipcard');?>">
				<div class="vip-top">
					<img src="/tcm/template/Tcm/images/logo.png">
					<span class="vip-name">天辅安中医馆会员卡</span>
				</div>
				<div class="vip-num"><?php echo ($user_card); ?></div>
			</a>
		</div>
		<div class="vip-link-wrap">
			<a href="<?php echo U('power');?>" class="vip-link">
				<span>我的权益</span>
				<span class="arrow-right"></span>
			</a>
		</div>
	</div>
	<script>
		$(function() {
			var backFour = $(".vip-num").text().substr(-4,4);
			var str = '<i class="snow">****</i>';
			var str2 = '<i class="snow">'+backFour+'</i>';
			$(".vip-num").html(str+str+str+str2)
		})
	</script>
</body>
</html>