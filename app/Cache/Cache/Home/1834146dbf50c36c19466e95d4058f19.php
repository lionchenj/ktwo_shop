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
	<title>选择支付方式</title>
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css">
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/common.js"></script>
	<style type="text/css">
	.shop-orderMoney{
		padding-top: 5.8rem;
	}
	.shop-moneyRow{
		font-size: 1.4rem;
		height: 5.5rem;
		line-height: 5.5rem;
	}
	.shop-moneyNum{
		background-color: #fff;
	    width: 100%;
	    padding: 0 1.2rem;
	    color: rgba(0,0,0,.6);
	    position: relative;
	    font-size: 1.4rem;
	    height: 5.5rem;
	    line-height: 5.5rem;
	    border-top: 1px solid #eee;
    	border-bottom: 1px solid #eee;
    	margin-top: .8rem;
	}
	.grey-row{
		color: rgba(0,0,0,.3);
	}
	.grey-row .choose-circle{
		border-color: rgba(115, 115, 115,.3);
	}
	.shop-moneyNum{
		margin-top: 0; 
	}
	</style>
</head>
<body>
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		选择支付方式
	</div>
	<div class="shop-orderMoney">
		<!-- <div class="shop-moneyRow clearfix">
			<span class="left shop-rowLeft">积分支付</span>
			<span class="right shop-rowRight red-row">
				<span class="choose-circle active" data-id="1"></span>
			</span>
		</div> -->
	</div>
	<div class="shop-moneyNum clearfix">
		<span class="left shop-rowLeft">支付积分</span>
		<span class="right shop-rowRight red-row"><?php echo ($money); ?></span>
	</div>
	<div class="btn-wrap" style="padding-top: 4rem">
		<button type="button" class="save-btn">提交</button>
	</div>
	<div class="tips-box" style="display: none;"></div>
	<div id="dishes_delete" style="display: none;">
	<script type="text/javascript">
		$(".choose-circle").on("click",function(){
			var temp = $(this).parents(".shop-moneyRow").hasClass("grey-row");
			if(temp){
				return false;
			}else{
				$(".choose-circle").removeClass("active");
				$(this).addClass("active");
			}
		})
		$(".save-btn").click(function(){
		// var pay_type=$(".active").attr('data-id');
		// if(!pay_type){
		// 	popup('请选择支付方式！');
		// 	return false;
		// }
		var url="<?php echo U('order_pay');?>";
		var query ={};
		query['orderid']=<?php echo ($orderid); ?>;
		//query['pay_type']=pay_type;
		$.post(url,query).success(function(res){
			if(res.status==1){
					if(res.info.type==1){
						res.info.data=JSON.parse(res.info.data);
						$('#dishes_delete').attr('pay_id',res.info.payid);
						callpay(res.info.data);
						}else{
							popup('支付成功');
							setTimeout(function(){
							window.location.href="<?php echo U('About/order');?>?id=2";							
						}, 2000);  
							
						}
					}else{
					//alert(JSON.stringify(res.info))
					popup(res.info);
					}
			})
		})
		function jsApiCall(data)
			{
				WeixinJSBridge.invoke('getBrandWCPayRequest', data,function(res){
				if(res.err_msg == "get_brand_wcpay_request:ok") {
					var id = $('#dishes_delete').attr('pay_id');
					var data={};
					data['payid']=id;
					$.ajax({
					cache:false,
					type:"POST",
					url:"<?php echo U('wechat_return');?>",
					dataType:"json",
					data:data,
					timeout:30000,
					error:function(){
					popup('支付失败');
					return false;
					}, success:function(data){
					if(data.status==1){
					window.location.href="<?php echo U('About/order');?>";
					}else{
						popup(data.info);
					}
					}
				
					})
					}
				});
			}
			function callpay(data)
			{
				if (typeof WeixinJSBridge == "undefined"){
					if( document.addEventListener ){
						document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
					}else if (document.attachEvent){
						document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
						document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
					}
				}else{
					jsApiCall(data);
				}
			}
	</script>
</body>
</html>