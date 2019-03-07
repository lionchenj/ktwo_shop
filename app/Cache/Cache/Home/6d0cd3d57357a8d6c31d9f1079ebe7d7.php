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
	<title>中医馆商城选择优惠券</title>
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/style.css">
	<script type="text/javascript" src="/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/common.js"></script>
</head>
<body>
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		选择优惠券
	</div>
	<div class="choose-wrap">
	<?php if(empty($list)): ?><div id="null-box" style="text-align:center;padding-top: 1.4rem;">
			<img src="/tcm/template/Tcm/images/empty.png" style="width: 11rem;height: 11rem;">
			<div style="color: #999;font-size: 1.6rem;line-height: 3rem;margin-top: 1.4rem;">
				您还没有优惠券
			</div>
		</div>
	<?php else: ?>
	<?php if(is_array($list)): foreach($list as $key=>$_list): ?><div class="shop-t-item clearfix">
			<a href="<?php echo u('addOrder',array('cardid'=>$_list['cardid'],'reduce'=>$_list['reduce']));?>" class="choose-link">
				<div class="t-row-1 left"><?php echo ($_list["reduce"]); ?></div>
				<div class="t-row-2 left">
					<div class="t-row-item1">优惠券</div>
					<div class="t-row-item2">
						满<?php echo ($_list["least"]); ?>元立减
					</div>
					<div class="t-row-item3">
						(截至<?php echo (time_format($_list["end_time"])); ?>)
					</div>
				</div>
				<div class="t-state">
					可使用
				</div>
			</a>
		</div><?php endforeach; endif; endif; ?>
		
	</div>
</body>
</html>