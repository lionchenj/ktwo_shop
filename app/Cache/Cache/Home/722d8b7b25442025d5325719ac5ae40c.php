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
	<link rel="stylesheet" type="text/css" href="/shadow/mast/template/Cinema/css/style.css?v=1.0">
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/resize.js"></script>
	<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/clipboard.min.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/Wechat.js"></script>	
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/picker.min.js"></script>	
</head>
<body>
	<div class="result-container">
		<div class="big-card">
			<div class="big-wrap">
				<img src="/shadow/mast/template/Cinema/images/big-poster.png" class="big-img">
			</div>
			<div class="big-wrap">
				<div class="big-title">电影券：一路绽放</div>
				<div class="big-info"><?php echo ($data["num"]); ?> 张</div>
			</div>
			<div class="big-wrap-2">
				<div class="result-box-1">
					<div class="result-time">可用时间: 2017.11.23-2017.11.28</div>
					<div class="result-btn-box clearfix">
							<?php if(($data["status"]) == "-1"): if(($order["goodsid"]) == "1"): ?><button type="button" class="result-btn" disabled>
								已领取</button><?php endif; ?>
							<?php if(($order["goodsid"]) == "2"): ?><button type="button" class="result-btn result-click half-btn right" id="showCode">
									查看code码</button><?php endif; endif; ?>
						<?php if(($data["status"]) == "0"): ?><button type="button" class="result-btn half-btn left two_card">分发卡劵</button>						
							<?php if(($order["goodsid"]) == "1"): ?><button type="button" class="result-btn half-btn right" id="showCard">
								领取到卡包</button><?php endif; ?>
							<?php if(($order["goodsid"]) == "2"): ?><button type="button" class="result-btn result-click half-btn right" id="addCode">
								兑换code码</button><?php endif; endif; ?>
						<?php if(($data["status"]) == "1"): if(($order["goodsid"]) == "1"): ?><button type="button" class="result-btn" id="showCard">
								领取到卡包</button><?php endif; ?>
							<?php if(($order["goodsid"]) == "2"): ?><button type="button" class="result-btn result-click" id="showCode">
								查看code码</button><?php endif; endif; ?>
						<?php if(($data["status"]) == "2"): ?><button type="button" class="result-btn two_card">分发卡劵</button><?php endif; ?>	
						
					</div>
				</div>
			</div>
		</div>
		<!-- 验证提示框 -->
		<div class="error-tips" style="display: none;">
			选择的城市不能超过三个
		</div>
		<button type="button" id="addCard" style="display: none;"></button>
		<!-- 选择城市领取卡券 -->
		<div class="popupCity Card_add" style="display: none">
			<div class="popup-container">
				<div class="popup-title">选择城市领取卡券</div>
				<i class="icon-close abs close-popup" id=""></i>
				<div class="popup-item">
					<input type="text" name="city" class="popup-input" id="city" placeholder="请选择所在城市" readonly="readonly" onfocus="this.blur()">
					<i class="icon-angle abs"></i>
				</div>
				<div class="popup-btn">
					<button type="button" class="get-btn" id="submitCard">领取卡券</button>
				</div>
			</div>
		</div>
		<div class="popupCity Code_add" style="display: none">
			<div class="popup-container">
				<div class="popup-title">选择城市兑换卡券</div>
				<i class="icon-close abs close-popup" id=""></i>
				<div class="popup-item">
					<input type="text" name="city2" class="popup-input" id="city2" placeholder="请选择所在城市" readonly="readonly" onfocus="this.blur()">
					<i class="icon-angle abs"></i>
				</div>
				<div class="popup-btn">
					<button type="button" class="get-btn" id="submitCode">兑换卡券</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/city.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/city-picker-2.js?v=1.3"></script>
	<script type="text/javascript">
		//弹窗提示方法
		function popup(msg){
			$(".error-tips").text(msg);
			$(".error-tips").fadeIn();
			setTimeout(function(){
				$(".error-tips").fadeOut();
			},800)
		}
		$(function(){
			$('body').on('touchmove', function(e) {
				e.preventDefault();
			});
		})
	</script>
	<script type="text/javascript">
	var wechat_data=<?php echo ($getSignPackage); ?>;
		wechat_data['share']={};
		wechat_data['share']['title']='亲！你可以领取<?php echo ($data["num"]); ?>张《一路绽放》电影票';
		wechat_data['share']['desc']='《一路绽放》是由湖南双鼎文化传媒有限公司和上海映艺文化传播有限公司共同出品。田巧林任出品人，黄礼高任制片，邵进执导。张杨果而、孔琳、彭皓锋、李颖、李景涛、崔程程共同演绎的都市励志情感故事。';
		wechat_data['share']['imgUrl']='http://dev.weibanker.cn/shadow/yise/data/Picture/2017-09-22/59c49cff948df.png';
		wechat_data['addCard']=<?php echo ($addCard); ?>;
		wechatSetConf(wechat_data);
	</script>
	<script type="text/javascript">
		$('#showCard').click(function(){
			var num=<?php echo ($data["num"]); ?>;
			if(num>100){
				popup("每次最多领取100张卡券");
				return false;
			}
			$(".Card_add").show();
				
		})
		$(".close-popup").click(function(){
			$(".Card_add").hide();
			$(".Code_add").hide();
		})
		$('#submitCard').click(function(){
		var address=$("input[name='city']").val();
		if(address.length==0){
			popup('请选择城市');
			return false;
		}
			var url="/shadow/mast/Home/About/receive/id/GFOO20171026.html";
				var query = {};
				query['code']=<?php echo ($data["id"]); ?>;
				query['status']=1;
				query['address']=address;
				$.post(url,query).success(function(res){
					if(res.status==1){
						$('#addCard').click();
						$(".Card_add").hide();
					}else{
					popup(res.info);
					return false;
					}
				})
				
		})
		
	</script>
	<script type="text/javascript">
	$('#showCode').click(function(){
		window.location.href="<?php echo U('code_list',array('id'=>$data['link_sign']));?>";
		return false;
	})
	$('#addCode').click(function(){
			$(".Code_add").show();
				
	})
	$('#submitCode').click(function(){
		var address=$("input[name='city']").val();
		if(address.length==0){
			popup('请选择城市');
			return false;
		}
			var url="/shadow/mast/Home/About/receive/id/GFOO20171026.html";
				var query = {};
				query['code']=<?php echo ($data["id"]); ?>;
				query['status']=1;
				query['address']=address;
				$.post(url,query).success(function(res){
					if(res.status==1){
						window.location.href="<?php echo U('code_list',array('id'=>$data['link_sign']));?>";
						$(".Code_add").hide();
					}else{
					popup(res.info);
					return false;
					}
				})
				
		})
	</script>
	<script type="text/javascript">
		$('.two_card').click(function(){
				var url="/shadow/mast/Home/About/receive/id/GFOO20171026.html";
				var query = {};
				query['code']=<?php echo ($data["id"]); ?>;
				query['status']=2;
				$.post(url,query).success(function(res){
					if(res.status==1){
						window.location.href="<?php echo U('two_edit',array('id'=>$data['id']));?>";
						$(".Code_add").hide();
					}else{
					popup(res.info);
					return false;
					}
				})
	})
	</script>
</body>
</html>