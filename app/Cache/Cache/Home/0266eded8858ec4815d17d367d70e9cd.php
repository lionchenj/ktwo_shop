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
	<title>中医馆商城评价</title>
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css">
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/common.js"></script>
</head>
<body>
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		评价
	</div>
	<div class="appraise-form">
		<form action="" class="">
			<textarea placeholder="请写下您的评价！" class="appraise-textarea" id="appraise"></textarea>
			<div class="btn-wrap">
				<button type="submit" class="save-btn">保存</button>
			</div>
		</form>
	</div>
	<!-- 提示弹窗 -->
	<div class="tips-box" style="display: none;"></div>
	<script type="text/javascript">
		$(function(){
			$(".save-btn").on("click",function(){
				if(!$("#appraise").val()){
					popup("评价不能为空");
					
					return false;
				}
				var url="<?php echo U('comment_ajax');?>";
				var query ={};
				query['orderid']="<?php echo ($_GET['orderid']); ?>";
				query['goodsid']="<?php echo ($_GET['goodsid']); ?>";
				query['title']=$("#appraise").val();
				$.post(url,query).success(function(res){
				if(res.status==1){
						popup('评论成功');
						setTimeout(function(){
						window.location.href="<?php echo U('About/order');?>?id=4";
						},1500);
						return false;
				}else{
				popup(res.info);
				return false;
				}
			})
			return false;
		})
		})
	</script>
</body>
</html>