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
	<title>天辅安中医馆个人中心</title>
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css?v=2.8">
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/resize.js"></script>
</head>
<body>
	<div class="title-info">
		<?php echo ($userinfo["nickname"]); ?>个人中心
	</div>
	<div class="top-info clearfix">
		<div class="left info-img">
			<img src="<?php if(empty($userinfo["head_imgurl"])): ?>/zhouzf/www/tcm/template/Tcm/images/head.png<?php else: echo ($userinfo["head_imgurl"]); endif; ?>" onerror="this.src='/zhouzf/www/tcm/template/Tcm/images/head.png'">
		</div>
		<div class="left" style="width: calc(100% - 7rem);width:-webkit-calc(100% - 7rem);">
			<div class="left info-text" style="width: 62%">
				<div class="info-name">
					<?php echo ($userinfo["nickname"]); ?>
				</div>
				<!-- <div class="exp-wrap" style="width: 100%">
					<span class="exp-active" style="width:80%"></span>
				</div> -->
				<!-- <div class="info-level fs-0">
					<img src="/zhouzf/www/tcm/template/Tcm/images/level-icon.png" class="level-icon">
					<span class="level-text">会员等级</span>
					<span class="level-name"><?php echo ($userinfo["level"]); ?></span>
				</div> -->
			</div>
			<!-- <div class="right info-btn" style="padding-left: 1.3rem;margin-left:0;width: 38%">
				<a href="<?php echo U('About/recharge');?>" style="width: 100%;background-size: 100% auto;">充值</a>
			</div> -->
		</div>
	</div>
	<div class="top-info2 clearfix">
		<!-- <div class="info2-item left">
			<span class="info2-label">
				<i class="icon-account"></i>
				<i class="info2-name">账户余额</i>
			</span>
			<span class="info2-num"><?php echo ($userinfo["balance"]); ?>元</span>
		</div> -->
		<div class="info2-item left">
			<span class="info2-label">
				<i class="icon-integral"></i>
				<i class="info2-name">积分</i>
			</span>
			<span class="info2-num"><?php echo ($userinfo["score"]); ?></span>
		</div>
	</div>
	<div class="menu-list">
		<ul>
			<!-- <li>
				<a href="<?php echo U('About/money');?>" class="menu-link clearfix">
					<i class="icon-wallet left"></i>
					<div class="menu-item left">
						<span class="menu-name">我的钱包</span>
						<span class="arrow-right"></span>
					</div>
				</a>
			</li> -->
			<li>
				<a href="<?php echo U('About/order');?>" class="menu-link clearfix">
					<i class="icon-order left"></i>
					<div class="menu-item left">
						<span class="menu-name">我的订单</span>
						<span class="arrow-right"></span>
					</div>
				</a>
			</li>
			<!-- <li>
				<a href="<?php echo U('About/mycard');?>" class="menu-link clearfix">
					<i class="icon-ticket left"></i>
					<div class="menu-item left">
						<span class="menu-name">我的卡券</span>
						<span class="arrow-right"></span>
					</div>
				</a>
			</li> -->
			<li>
				<a href="<?php echo U('About/score');?>" class="menu-link clearfix">
					<i class="icon-coin left"></i>
					<div class="menu-item left">
						<span class="menu-name">我的积分</span>
						<span class="arrow-right"></span>
					</div>
				</a>
			</li>
		<!-- 	<li>
				<a href="<?php echo U('About/vipcard');?>" class="menu-link clearfix">
					<i class="icon-vip left"></i>
					<div class="menu-item left">
						<span class="menu-name">我的会员卡</span>
						<span class="arrow-right"></span>
					</div>
				</a>
			</li> -->
			<li>
				<a href="<?php echo U('Order/sReceipt');?>" class="menu-link clearfix">
					<i class="icon-recharge left"></i>
					<div class="menu-item left">
						<span class="menu-name">地址管理</span>
						<span class="arrow-right"></span>
					</div>
				</a>
			</li>
			<li>
				<a href="<?php echo U('About/collection_list');?>" class="menu-link clearfix">
					<i class="icon-collect left"></i>
					<div class="menu-item left">
						<span class="menu-name">我的收藏</span>
						<span class="arrow-right"></span>
					</div>
				</a>
			</li>
		</ul>
	</div>
	<div class="nav-list clearfix">
		<a href="<?php echo U('Index/index');?>" class="left nav-item">
			<i class="icon-nav-index"></i>
			<div class="nav-name ">
				首页
			</div>
		</a>
		<a href="<?php echo U('Classify/index');?>" class="left nav-item">
			<i class="icon-nav-type"></i>
			<div class="nav-name">
				分类
			</div>
		</a>
		<a href="<?php echo U('Order/card');?>" class="left nav-item">
			<i class="icon-nav-shopcar"></i>
			<div class="nav-name">
				购物车
			</div>
			<span class="tips-circle"><?php echo ($_shopnum); ?></span>
		</a>
		<a href="<?php echo U('About/index');?>" class="left nav-item">
			<i class="icon-nav-user active"></i>
			<div class="nav-name active">
				个人中心
			</div>
		</a>
	</div>
</body>
</html>