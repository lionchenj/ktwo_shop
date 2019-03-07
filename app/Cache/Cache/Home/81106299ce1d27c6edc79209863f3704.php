<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="apple-mobile-web-app-capable" content="yes"/><!-- 是否启用 WebApp 全屏模式 -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/><!-- 设置状态栏的背景颜色 -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no,email=no"/><!-- 禁止数字识自动别为电话号码 --><!-- 不让android识别邮箱 -->
	<title>一路绽放</title>
	<link rel="stylesheet" type="text/css" href="/shadow/mast/template/Cinema/css/common.css">
	<link rel="stylesheet" type="text/css" href="/shadow/mast/template/Cinema/css/style.css?v=1.5">
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/resize.js"></script>
</head>
<body class="bg-white">
	<div class="form-container">
		<form action="">
			<div class="f-img">
				<img src="/shadow/mast/template/Cinema/images/main-title.png" alt="">
			</div>
			<div class="f-item">
				<input type="tel" placeholder="请输入手机号码" class="f-input" id="phone">
			</div>
			<div class="f-item clearfix">
				<input type="tel" placeholder="请输入验证码" class="f-input left" id="code" style="width: 60%">
				<button type="button" class="f-btn right" onclick="countTime(this)" style="width: 40%">获取验证码</button>
			</div>
			<div class="f-btn-item">
				<button type="submit" class="f-submit">登录</button>
			</div>
		</form>
	</div>
<!-- 验证提示框 -->
	<div class="error-tips" style="display: none;"></div>
	<script>
		//弹窗提示方法
		function popup(msg){
			$(".error-tips").text(msg);
			$(".error-tips").fadeIn();
			setTimeout(function(){
				$(".error-tips").fadeOut();
			},800)
		}

		//获取验证码倒计时
		function countTime(ele){
				var regMobile=/^1[3,4,5,6,7,8,9]\d{9}$/;
				var phone = $("#phone").val();
				if(phone==""){
					popup("手机号码不能为空");
					return false;
				}else if(phone!="" && !regMobile.test(phone)){
					popup("请输入正确的手机号码");
					return false;
			}
			var t1 = 60;
			var timer = null;
			timer = setInterval(function(){
				t1--;
				if(t1>=0){
					ele.innerHTML = t1+"s";
					ele.setAttribute("disabled","disabled");
				}else{
					ele.innerHTML = "重新获取验证码";
					clearInterval(timer);
					ele.removeAttribute("disabled");
				}
			},1000);
			
				var url="<?php echo U('mobile_check');?>";
				var query ={};
				query['mobile']=phone;
				$.post(url,query).success(function(res){
					if(res.status==1){
					popup("发送成功");
					}else{
					popup("发送失败，"+res.info);
					}
				});
			
		}
		$(function(){
			$(".f-submit").on("click",function(){
				var regMobile=/^1[3,4,5,6,7,8,9]\d{9}$/;
				var phone = $("#phone").val();
				var code = $("#code").val();
				if(phone==""){
					popup("手机号码不能为空");
					return false;
				}else if(phone!="" && !regMobile.test(phone)){
					popup("请输入正确的手机号码");
					return false;
				}else{
					if(code==""){
						popup("验证码不能为空");
						return false;
					}
				}
				var url="<?php echo U('submit');?>";
				var query ={};
				query['mobile']=phone;
				query['code']=code;
				$.post(url,query).success(function(res){
					if(res.status==1){
						location.href="<?php echo U('About/index');?>";
					}else{
					popup(res.info);
					}
				});
				return false;
			})
		})
	</script>
</body>
</html>