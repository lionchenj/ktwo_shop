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
	<title>天辅安中医馆会员卡详情</title>
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/common.css">
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
	<div class="vip-power-wrap">
		<div class="power-title">
			会员卡详情
		</div>
		<div class="power-detail">
			<ul class="power-list">
				<li class="clearfix">
					<span class="left power-label">特权说明</span>
					<span class="left power-text">您可以使用本卡卷享受天辅安中医馆的会员服务。<br>
					<br>
					</span>
				</li>
				<li class="clearfix">
					<span class="left power-label">有效日期</span>
					<span class="left power-text">2017.09.16-2050.01.01</span>
				</li>
				<li class="clearfix">
					<span class="left power-label">电话</span>
					<span class="left power-text">江华馆<a href="tel:0750-3376666">  0750-3376666</a></span>
					<span class="right power-text">新会馆<a href="tel:0750-6688000">  0750-6688000</a></span>
				</li>
				<li class="clearfix">
					<span class="left power-label">使用须知</span>
					<span class="left power-text">
						1、请于结账前出示；<br>
						2、本卡具有消费、充值功能；<br>
						3、本卡可用于馆内所有项目消费;<br>
						4、本卡适应于天辅安中医馆各门店；<br>
						5、若本卡遗失请及时挂失、补办费用10元。<br>
					</span>
				</li>
			</ul>
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