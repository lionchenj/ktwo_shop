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
	<title>天辅安中医馆充值中心</title>
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/style.css">
	
	<script type="text/javascript" src="/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/common.js"></script>
</head>
</head>
<body class="bg-white">
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		充值中心
	</div>
	<div class="card-list mescroll" id="mescroll">
		<ul id="data-list">
		<?php if(is_array($_list)): foreach($_list as $key=>$vo): ?><li class="card-item" style="background-image: url(/tcm/template/Tcm/images/card-bg.png)">
				<a href="<?php echo U('recharge_edit',array('id'=>$vo['id']));?>" class="card-link">
					<span class="card-money-1">
						<?php echo ($vo["money"]); ?>元
					</span>
					<?php if(!empty($vo['title'])): ?><div class="card-money-2">
						（<?php echo ($vo["title"]); ?>）
					</div><?php endif; ?>
				</a>
			</li><?php endforeach; endif; ?>	
		</ul>
	</div>

</body>
</html>