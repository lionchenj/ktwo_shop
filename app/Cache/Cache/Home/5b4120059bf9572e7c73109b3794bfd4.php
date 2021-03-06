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
	<title>中医馆商城填写收货信息</title>
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
		填写收货信息
	</div>
	<div class="edit-wrap">
		<form action="">
			<div class="edit-item">
				<label for="" class="edit-label"><span>姓</span><span>名</span>：</label>
				<input type="text" name="name" id="name" class="edit-input" placeholder="请输入您的姓名" value="<?php echo ($receipt["name"]); ?>">
			</div>
			<div class="edit-item">
				<label for="" class="edit-label">手机号码：</label>
				<input type="tel" name="phone" id="phone" class="edit-input"
				placeholder="请输入您的手机号码"  value="<?php echo ($receipt["mobile"]); ?>">
			</div>
			<div class="edit-item">
				<label for="" class="edit-label">收货地址：</label>
				<input type="text" name="address" id="address" class="edit-input"
				placeholder="请输入您的收货地址" value="<?php echo ($receipt["address"]); ?>">
			</div>
			<div class="btn-wrap">
				<button type="button" class="save-btn">保存</button>
			</div>
		</form>
	</div>
	<!-- 提示弹窗 -->
	<div class="tips-box" style="display: none;"></div>
	<script type="text/javascript">
		$(function(){
			$(".save-btn").on("click",function(){
				var regMobile=/^1[3,4,5,6,7,8,9]\d{9}$/;
				var name = $("#name").val();
				var phone = $("#phone").val();
				var address = $("#address").val();
				if(name==""){
					popup("姓名不能为空");
					return false;
				}else{
					if(phone==""){
						popup("手机号码不能为空");
						return false;
					}else if(phone!="" && !regMobile.test(phone)){
						popup("请输入正确的手机号码");
						return false;
					}else{
						if(address==""){
							popup("收货地址不能为空");
							return false;
						}
					}
				}
				var url="<?php echo U('receipt');?>";
					var query ={};
					query['name']=name;
					query['mobile']=phone;
					query['address']=address;
					$.post(url,query).success(function(res){
					if(res.status==1){
						popup("保存成功");
						window.location.href="<?php echo U('about/index');?>";
						return false;
					}else{
						popup("网络错误");
						return false;
					}
					});
			})
		})
	</script>
</body>
</html>