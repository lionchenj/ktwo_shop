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
	<title>天辅安中医馆</title>
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/style.css">
	<script type="text/javascript" src="/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/common.js"></script>
</head>
<body class="bg-white">
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		我的钱包
	</div>
	<div class="wallet-container">
		<div class="wallet-top">
			<a href="<?php echo U('About/money');?>" class="wallet-link active">
				<div class="wallet-icon">
					<img src="/tcm/template/Tcm/images/white-coin.png">
				</div>
				<div class="wallet-name">
					余额
				</div>
			</a>
			<a href="<?php echo U('free_recharge');?>" class="wallet-link">
				<div class="wallet-icon">
					<img src="/tcm/template/Tcm/images/white-card.png">
				</div>
				<div class="wallet-name">
					充值
				</div>
			</a>
			<a href="<?php echo U('About/golden');?>" class="wallet-link">
				<div class="wallet-icon">
					<img src="/tcm/template/Tcm/images/white-rest.png">
				</div>
				<div class="wallet-name">
					佣金
				</div>
			</a>
		</div>
		<div class="wallet-middle">
			<div class="wallet-rest clearfix">
				<span class="left wallet-label">￥账户余额</span>
				<span class="right wallet-money"><?php echo ($balance); ?></span>
			</div>
			<ul class="wallet-list">
				<li class="clearfix" onclick="window.location.href='<?php echo U('About/change');?>'" >
					<span class="left wallet-left">充值</span>
					<span class="right wallet-right"><?php echo ($recharge_sum); ?>元</span>
				</li>
				<li class="clearfix" onclick="window.location.href='<?php echo U('About/consumption');?>'">
					<span class="left wallet-left" >消费</span>
					<span class="right wallet-right"><?php echo ($transaction_sum); ?>元</span>
				</li>
				<li class="clearfix">
					<span class="left wallet-left">佣金</span>
					<span class="right wallet-right"><?php echo ($commission_sum); ?>元</span>
				</li>
			</ul>
		</div>
		<div class="wallet-card">
		<?php if(is_array($_list)): foreach($_list as $key=>$vo): ?><a href="<?php echo U('About/recharge_edit',array('id'=>$vo['id']));?>" class="wallet-card-link" style="background-image: url(/tcm/template/Tcm/images/card-bg3.png);">
				<div class="wc-top">
					<?php echo ($vo["money"]); ?>元充值卡
				</div>
				
				<div class="wc-bottom" <?php if(empty($vo['title'])): ?>style="opacity:0"<?php endif; ?>>
				
					<?php echo ($vo["title"]); ?>
				</div>
				
			</a><?php endforeach; endif; ?>	
		</div>
	</div>
</body>
</html>