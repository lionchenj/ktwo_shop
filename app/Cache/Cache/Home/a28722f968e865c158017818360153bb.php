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
	<title>天辅安中医馆充值详情</title>
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/style.css">
	<script type="text/javascript" src="/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/common.js"></script>
	<style>
		input.num-input[disabled]{
			color: #d36954;
			background-color:#fff;
			opacity:1
		}
	</style>
</head>
<body>
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		<?php echo ($_info["money"]); ?>元充值卡
	</div>
	<div class="card-list">
		<ul>
			<li class="card-detail-item" style="background-image: url(/tcm/template/Tcm/images/card-bg.png)">
				<a href="javascript:;" class="card-link">
					<span class="card-money-1">
						<?php echo ($_info["money"]); ?>元
					</span>
					<?php if(!empty($_info['title'])): ?><div class="card-money-2">
						（<?php echo ($_info["title"]); ?>）
					</div><?php endif; ?>
				</a>
			</li>
		</ul>
		<div class="recharge-btn">
			<a href="javascript:;" class="recharge-link">
				立刻充值
			</a>
		</div>
	</div>
	<div class="detail-cont">
		<div class="detail-nav">
			<div class="detail-nav-item active" id="detail-nav-1">
				充值卡详情
			</div>
			<div class="detail-nav-item" id="detail-nav-2">
				使用规则
			</div>
			<div class="detail-nav-item" id="detail-nav-3">
				常见问题
			</div>
		</div>
		<div class="detail-text">
			<div class="detail-t-1">
			<?php echo ($_info["info"]); ?>
			</div>
			<div class="detail-t-2" style="display: none">
			<?php echo ($_info["auth"]); ?>
			</div>
			<div class="detail-t-3" style="display: none">
			<?php echo ($_info["help"]); ?>
			</div>
		</div>
	</div>
	
	<!-- 支付弹窗 -->
	<div class="popup-box" style="display: none">
		<div class="black-mask"></div>
		<div class="popup-pay">
			<i class="icon-close"></i>
			<div class="popup-info">充值信息</div>
			<div class="popup-form">
				<form action="" id="pay-form">
					<div class="popup-item">
						<label class="popup-label">数量</label>
						<div class="right">
							<button type="button" class="num-btn reduce-btn" id="reduce-btn" onclick="calc(this)"></button>
							<input type="text" name="num" class="num-input" id="num-input" value="1" disabled>
							<button type="button" class="num-btn add-btn" id="add-btn" onclick="calc(this)"></button>
						</div>
					</div>
					<div class="popup-text clearfix">
						<div class="popup-t-left left">支付金额</div>
						<div class="popup-t-right right" id="submit_money">
							￥<?php echo ($_info["money"]); ?>元
						</div>
					</div>
					<div class="popup-btn">
						<button type="submit" class="popup-submit">立即购买</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- 提示弹窗 -->
	<div class="tips-box" style="display: none;"></div>
	<div id="dishes_delete" style="display: none;">
	<?php if(empty($mobile)): ?><script type="text/javascript">
		$(".recharge-link").on("click",function(){
				window.location.href='<?php echo U('Login/index');?>';
			})
	</script>		
	<?php else: ?>
	<script type="text/javascript">
		//加减方法
		function calc(ele){
			var input = $(ele).siblings("input");
			var n1 = input.val();
			var cName = $(ele).attr("class").split(" ");
			var	money=<?php echo ($_info["money"]); ?>;
			var flag;
			$.each(cName,function(i){
				if(cName[i]=="reduce-btn"){
					flag = true;
				}else if(cName[i]=="add-btn"){
					flag = false;
				}
			})
			if(flag){
				if(n1>0){
					n1--;
				}else{
					return false;
				}
				if(n1==0){
				$(".popup-submit").attr('disabled','disabled');
				}else{
				$(".popup-submit").removeAttr('disabled');
				}
				input.val(n1).change();
				money=n1*money;
				$("#submit_money").html("￥"+money+"元");
				
			}else{
				n1++;
				if(n1==0){
				$(".popup-submit").attr('disabled','disabled');
				}else{
				$(".popup-submit").removeAttr('disabled');
				}
				input.val(n1).change();
				money=n1*money;
				$("#submit_money").html("￥"+money+"元");
			}
		}
		$(function(){
			$(".detail-nav-item").on("click",function(){
				$(this).addClass("active").siblings().removeClass("active");
				$(".detail-t-"+this.id.split("-")[2]).show().siblings().hide();
			})

			$(".recharge-link").on("click",function(){
				$(".popup-box").show();
			})

			$(".popup-submit").on("click",function(){
				var num = $("input[name='num']").val();
				var data={};
				data['num']=num;
				data['carid']='<?php echo ($carid); ?>';
				var url="<?php echo U('About/recharge_edit');?>";
				var query = data;
				$.post(url,query).success(function(res){
					if(res.status==1){
						if(res.info.type==1){
						res.info.data=JSON.parse(res.info.data);
						$('#dishes_delete').attr('pay_id',res.info.payid);
						callpay(res.info.data);
						}
					}else{
					alert(JSON.stringify(res.info))
					popup(res.info);
					}
				});
			return false;	
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
					window.location.href="<?php echo U('About/money');?>";
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
			$(".black-mask,.icon-close").on("click",function(){
				$(".popup-box").hide();
			})
		})
	</script><?php endif; ?>
</body>
</html>