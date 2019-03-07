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
	<title>中医馆个人资料</title>
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
		我的地址
	</div>
	<div class="data-list">
		<form action="" class="data-form">
			<ul>
				<li>
					<div class="data-item clearfix">
						<span class="data-name left">选择地区</span>
						<div class="data-input-wrap right" id="choose">
							<input type="text" name="area" class="data-input" placeholder="请选择地区" id="area" readonly onfocus="this.blur()" value="<?php echo ($info["address_province"]); ?> <?php echo ($info["address_city"]); ?> <?php echo ($info["address_area"]); ?>">
						</div>
						<span class="arrow-right"></span>
					</div>
				</li>
				<li>
					<div class="data-item address-item clearfix">
						<span class="data-name left">详细地址</span>
						<div class="data-input-wrap right">
							<textarea name="address" placeholder="请输入详细地址" id="address" class="data-textarea"><?php echo ($info["address_info"]); ?></textarea>
						</div>
					</div>
				</li>
			</ul>
			<div class="btn-wrap">
				<button type="button" class="save-btn">保存</button>
			</div>
		</form>
	</div>
	<!-- 提示弹窗 -->
	<div class="tips-box" style="display: none;"></div>
	<script type="text/javascript" src="/tcm/template/Tcm/js/city.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/picker.min.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/city-picker.js?v=1.1"></script>
	<script type="text/javascript">
		$(function(){
			$(".save-btn").on("click",function(){
				if(!$("#area").val()){
					popup("请选择地区");
					return false;
				}else{
					if(!$("#address").val()){
						popup("详细地址不能为空");
						return false;
					}
				var api_url="<?php echo U('setUserInfo');?>";
				var query ={};
				query['area']=$("#area").val();
				query['address_info']=$("#address").val();
				$.post(api_url,query).success(function(res){
				if(res.status==1){
				popup('保存成功');
				setTimeout(function(){
                            location.reload();
                    },1500);
				return false;
				}else{
				popup(res.info);
				return false;
				}
					
				})
				}
			})
		})
	</script>
</body>
</html>