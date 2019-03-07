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
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/calc.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/picker.min.js"></script>
</head>
<body>
	<div class="new-container" style="padding-bottom: 4.2rem">
		<div class="top-ticket">
			<div class="ticket-info clearfix">
				<div class="left">
					<img class="sm-poster" src="/shadow/mast/template/Cinema/images/sm-poster.png">
				</div>
				<div class="ticket-text left">
					<div class="ticket-title">一路绽放</div>
					<div class="ticket-keywords">爱情 都市 励志 | 2D</div>
					<div class="ticket-time">2017-11-23上映 | 108分钟</div>
				</div>
			</div>
		</div>
		<div class="buyForm-wrap">
			<form action="#" id="buyForm">
				<div class="buyForm-1">
					<div class="form-item clearfix">
						<span class="form-label-1 left">购票看电影</span>
						<span class="money left"><?php echo ($card_1['money']); ?></span>
						<div class="form-input right">
							<button type="button" class="calc-btn reduce-btn" onclick="calc(this)">-</button>
							<input type="number" name="distriNumber1" class="input-item int" value="0">
							<button type="button" class="calc-btn add-btn" onclick="calc(this)">+</button>
						</div>
					</div>
					<div class="choose-item clearfix">
						<span class="left choose-text">你的团队的观影城市（最多选择三个）</span>
						<button type="button" class="right choose-btn" id="more-city">更多城市</button>
					</div>
					<div class="city-item clearfix" id="city-wrap">
						<span class="left city-box">长沙市</span>
						<span class="left city-box">株洲市</span>
						<span class="left city-box">湘潭市</span>
						<span class="left city-box">衡阳市</span>
						<span class="left city-box">岳阳市</span>
					</div>
				</div>
				<div class="buyForm-2">
					<div class="other-item clearfix">
						<span class="form-label-1 left">上面没有你的城市在这里买</span>
						<span class="money left"><?php echo ($card_2['money']); ?></span>
						<div class="form-input right">
							<button type="button" class="calc-btn reduce-btn" onclick="calc(this)">-</button>
							<input type="number" name="distriNumber2" class="input-item int" value="0">
							<button type="button" class="calc-btn add-btn" onclick="calc(this)">+</button>
						</div>
					</div>
					<!--<div class="explain-item">
						（文案说明非指定城市购票价格不一样....）
					</div>-->
				</div>
				<div class="buyForm-3">
					<div class="inputText-item clearfix">
						<label for="" class="inputText-label left">姓名/</label>
						<div class="right">
							<input type="text" name="" class="inputText-box" id="username" placeholder="请填写您的姓名">
						</div>
					</div>
					<div class="inputText-item clearfix">
						<label for="" class="inputText-label left">手机号/</label>
						<div class="right">
							<input type="tel" name="" class="inputText-box" id="mobilephone" placeholder="请填写您的手机号">
						</div>
					</div>
					<div class="inputText-item clearfix">
						<label for="" class="inputText-label left">选择团队/</label>
						<div class="right">
							<input type="text" name="group" class="inputText-box" id="teamBtn" placeholder="请选择团队" readonly="readonly" onfocus="this.blur();">
						</div>
					</div>
				</div>
				<div class="form-bottom buyForm-bottom clearfix">
					<div class="form-bottom-left left">
						数量:<span class="all-number">0</span>
					</div>
					<div class="form-bottom-right right">
						<span class="form-label-3">
							总价:<i class="total-price">0.00</i>
						</span>
						<button type="button" class="submit-btn">提交订单</button>
					</div>
				</div>
			</form>
		</div>
		<!-- 验证提示框 -->
		<div class="error-tips" style="display: none;">
			选择的城市不能超过三个
		</div>
		<div id="dishes_delete" style="display: none;">
		</div>

	</div>
	<script>var city=<?php echo ($city); ?>;</script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/city-picker.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/team.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/team-picker.js"></script>
	<script type="text/javascript">
		
		function popup(msg){
			$(".error-tips").text(msg);
			$(".error-tips").fadeIn();
			setTimeout(function(){
				$(".error-tips").fadeOut();
			},1200)
		}
		$(function(){
			var wh = window.innerHeight,
			h = $(".top-ticket").innerHeight();
			$(".all-city,.buyForm-wrap").css("height",wh-h);

			//点击前五个城市
			$(".city-item").on("touchend",'.city-box',function(){
				var that = $(this);
				var isChecked = that.hasClass("checked-city");
				var checkedLen = that.parent().find(".checked-city").length;
				if(checkedLen<=3 && isChecked && checkedLen!=1){
					that.removeClass('checked-city');
				}else if(checkedLen<3 && !isChecked){
					that.addClass('checked-city');
				}else if(checkedLen==1 && isChecked){
					popup("至少选择一个城市");
				}else{
					popup("选择的城市不能超过三个");
				}
			})
	})
	
		$(".submit-btn").click(function(){
				var regMobile=/^1[3,4,5,6,7,8,9]\d{9}$/;
				var name = $("#username").val();
				var phone = $("#mobilephone").val();
				var group = $("#teamBtn").val();
				var city=''
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
						if(group==""){
							popup("团队不能为空");
							return false;
						}
					}
				}
				var num1=$('input[name="distriNumber1"]').val();
				var num2=$('input[name="distriNumber2"]').val();
				if(num1==0 && num2==0){
					popup("请先选购电影票");
					return false;
				}
				if(num1>0){
					$(".checked-city").each(function(){
					city+=$(this).text()+",";
					})
					if(city==''){
					popup("请至少选择一个城市");
					return false;
					}
					city=city.substring(0,city.length-1);
				}
				var data={};
				data['username']=name;
				data['mobile']=phone;
				data['num1']=num1;
				data['city']=city;
				data['num2']=num2;
				data['group']=group;
				var url="/shadow/mast/Home/submit/index.html";
				var query = data;
				$.post(url,query).success(function(res){
					if(res.status==1){
						if(res.info.type==1){
						res.info.data=JSON.parse(res.info.data);
						$('#dishes_delete').attr('pay_id',res.info.payid);
						callpay(res.info.data);
						}else{
						popup('快捷支付');
						var url2="<?php echo U('kjllpay',array('payid'=>abc));?>";
						url2=url2.replace('abc',res.info.data);
						window.location.href=url2;
						}
					}else{
					popup(res.info);
					}
				});
		});
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
					window.location.href="<?php echo U('About/index');?>";
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
		$('.calc-btn').click(function(){
			
			change_money_num();
		})
		//数据格式验证int
		$(document).on('change',".int",function(){
		var val=parseInt($(this).val());
			if(isNaN(val)){
				$(this).val(0);
			}else{
				$(this).val(val);
			}
			change_money_num()
		})
		function change_money_num(){
			var num1=$('input[name="distriNumber1"]').val();
			var num2=$('input[name="distriNumber2"]').val();
			var num=parseInt(num1)+parseInt(num2);
			var money1=<?php echo ($card_1['money']); ?>;
			var money2=<?php echo ($card_2['money']); ?>;
			var money=(num1*money1)+(num2*money2);
			$('.all-number').html(num);
			$('.total-price').html(money.toFixed(2));
			
		}
	</script>
</body>
</html>