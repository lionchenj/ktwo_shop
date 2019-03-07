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
	<title>一路绽放</title>
	<link rel="stylesheet" type="text/css" href="/shadow/mast/template/Cinema/css/common.css">
	<link rel="stylesheet" type="text/css" href="/shadow/mast/template/Cinema/css/style.css">
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/resize.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/PxLoader.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/PxLoaderImage.js"></script>
	<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/Wechat.js"></script>	
</head>
<body>
	<div class="container">
		<div class="main-2">
			<div class="main-people" style="opacity: 1"><img src="/shadow/mast/template/Cinema/images/all-people.png"></div>
			<div class="abs" style="height: 63%; left:0; bottom:0;">	
				<div class="main-title change-top"><img src="/shadow/mast/template/Cinema/images/white-title.png"></div>
				<div class="main-time  change-top2"><img src="/shadow/mast/template/Cinema/images/white-time.png"></div>
				<div class="main-btn" style="opacity: 1; margin-bottom:2%">
					<div class="main-btn-wrap"><a href="http://dx1.datazan.cn/1.mp4" class="inline-block">观看完整片花</a></div>
					<div class="main-btn-wrap"><a href="<?php echo U('submit/index');?>" class="inline-block">购票观看电影</a></div>
					<div class="main-btn-wrap ticket-btn"><a href="<?php echo U('about/index');?>" class="inline-block">查看我的卡券</a></div>
				</div>
				<div class="footer-text">
					<img src="/shadow/mast/template/Cinema/images/white-footer.png">
				</div>
			</div>
		</div>
	</div>
	<!-- 验证提示框 -->
		<div class="error-tips" style="display: none;">
		</div>
	<script type="text/javascript">
		$(function(){
			$('body').on('touchmove', function(e) {
				e.preventDefault();
			});
		})
	</script>
	<script type="text/javascript">
	var wechat_data=<?php echo ($getSignPackage); ?>;
		wechat_data['share']={};
		wechat_data['share']['title']='《一路绽放》11月23日感恩节全国同步上映！';
		wechat_data['share']['desc']='此通道是电影《一路绽放》唯一指定电影票预购通道！';
		wechat_data['share']['imgUrl']='https://wx.datazan.cn/sample/Uploads/Picture/2017-09-30/59cf6ef5c109b.png';
		wechatSetConf(wechat_data);
	</script>
	
</body>
</html>