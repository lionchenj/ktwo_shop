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
	<title>天辅安中医馆代金券详情</title>
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/style.css?v=1.0">
	<script type="text/javascript" src="/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/common.js"></script>
	<style type="text/css" media="screen">
		.coupon-item{
			display: block;
			padding:0 1rem;
			text-indent: 0;
		}
		.coupon-item::before{
			top: 1.1rem;
		}
		.coupon-right{
			width: 70%;
		}
		.a-used{
			background-color: #ccc;
		}
	</style>
</head>
<body class="bg-white">
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		代金券详情
	</div>
	<div class="coupon-container">
		<div class="coupon-wrap">
			<div class="coupon-top">
				<img src="/tcm/template/Tcm/images/logo.png">
			</div>
			<div class="coupon-info">
				<div class="coupon-title">天辅安医馆</div>
				<div class="coupon-type"><?php echo ($data["reduce"]); ?>元代金券</div>
				<div class="coupon-btn-wrap">
					<a href="shop-index.html" class="coupon-btn">去首页</a>
					<!-- <a href="javascript:void(0);" class="coupon-btn a-used">已过期</a> -->
					<!-- <a href="javascript:void(0);" class="coupon-btn a-used">已使用</a> -->
				</div>
				<div class="coupon-date">
					有效期<?php echo ($data["starttime"]); ?>至<br>
					<?php echo ($data["endtime"]); ?>
				</div>
			</div>
			<div class="coupon-text">
				<div class="coupon-item clearfix">
					<span class="coupon-left left">使用须知：</span>
					<span class="coupon-right left">不可与单品优惠叠加使用到店支付使用订单满<?php echo ($data["least"]); ?>元可用，最高优惠<?php echo ($data["reduce"]); ?>元</span>
				</div>
				
				<!-- <div class="coupon-item"></div>
				<div class="coupon-item"></div>
				<div class="coupon-item">不可与单品优惠叠加使用</div>
				<div class="coupon-item">到店支付使用</div>
				<div class="coupon-item">订单满499元可用，最高优惠100元</div> -->
			</div>
			<!-- <div class="coupon-link-wrap">
				<a href="javascript:;" class="coupon-link clearfix">
					<span>使用须知</span>
					<span class="arrow-right"></span>
				</a>
				<a href="javascript:;" class="coupon-link clearfix">
					<span>适用门店</span>
					<span class="arrow-right"></span>
				</a>
			</div> -->
		</div>
	</div>
</body>
</html>