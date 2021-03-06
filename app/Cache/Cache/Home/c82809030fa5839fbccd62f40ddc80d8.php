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
	<title>卡券分发列表</title>
	<link rel="stylesheet" type="text/css" href="/shadow/mast/template/Cinema/css/common.css">
	<link rel="stylesheet" type="text/css" href="/shadow/mast/template/Cinema/css/style.css?v=1.2">
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/resize.js"></script>
</head>
<body class="scroll-box">
	<div class="new-container list-distance"> 
		<div class="tickets-list">
		<?php if(!empty($_list)): if(is_array($_list)): foreach($_list as $key=>$data): ?><div class="tickets-item">
				<a href="<?php echo U('two_receive',array('id'=>$data['link_sign']));?>" class="tickets-link clearfix">
					<img src="/shadow/mast/template/Cinema/images/sm-poster.png" class="movie-img left">
					<div class="movie-info left list-info">
						<div class="movie-info-1">一路绽放:<?php echo ($data["num"]); ?>张</div>
						<div class="movie-info-sm">分发卡券</div>
						<div class="movie-info-sm"><?php echo (time_format($data["create_time"],'Y-m-d H:i:s')); ?></div>
					</div>
					<div class="list-right right">
						<i class="icon-arrow"></i>
						<?php if(($data["status"]) == "-1"): ?><div class="tickets-state finished-state">
							已领取
							</div><?php endif; ?>
						<?php if(($data["status"]) == "0"): ?><div class="tickets-state">
								待处理
						</div><?php endif; ?>
						<?php if(($data["status"]) == "1"): ?><div class="tickets-state">
								待领取
						</div><?php endif; ?>
						<?php if(($data["status"]) == "2"): ?><div class="tickets-state finished-state">
								选择再次分配
						</div><?php endif; ?>
					</div>
				</a>
			</div><?php endforeach; endif; ?>
			<?php else: ?>
			 暂无数据<?php endif; ?>
		</div>
		<div class="back-to-index">
			<a href="<?php echo U('edit',array('orderid'=>$orderid));?>" class="back-btn">返回分配页</a>
		</div>
	</div>
	<script type="text/javascript">
		$(function(){
			$(".new-container").css("minHeight",window.innerHeight);
		})
	</script>
</body>
</html>