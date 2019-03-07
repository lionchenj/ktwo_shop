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
	<title>商城订单确认页面</title>
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css?v=1.4">
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/common.js"></script>
	<style type="text/css">
	.shop-order-list{
		background-color: transparent;
		margin-bottom: 0;
		padding: 0;
	}
	.a-shop-wrap{
		background-color: #fff;
		margin-bottom: .8rem;
		padding-top: 1rem;
	}
	.shop-orderRow{
		position: relative;
		margin-bottom: 0;
		/* margin-left: 1rem */
	}
	.shop-order-wrap{
		padding-bottom: 5.7rem;
	}
	.shop-rowRight{
		width: 50%;
		height: 100%;
		text-align: right;
	}
	.shop-rowRight a{
		width: 100%;
		height: 100%;
	}
	.a-shop-wrap select{
		border: none;
		outline: none;
		height: 3rem;
	}
	.shop-orderRow select{
		width: 9rem;
		/* border:1px solid #666; */
		border-radius: 0.5rem;
		padding: 0 2 0 1rem ;
		text-align: center;

	}
	.shop-arrow{
		position: absolute;
		top: .3rem;
        left: 20rem;
        transform: rotate(90deg);
        -ms-transform: rotate(90deg); /* IE 9 */
		-webkit-transform: rotate(90deg); /* Safari and Chrome */
        -o-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
	}
	</style>
</head>
<body>
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		订单确认页面
	</div>
	<div class="shop-order-wrap">
		<a href="<?php echo U('setReceipt');?>" class="shop-orderLink">
			<div class="shop-topWrap">
			<?php if(empty($receipt)): ?><div class="shop-topItem" >
				请填写收货信息
			</div>
			<?php else: ?>
				<div class="shop-topItem">
					<label class="shop-topLabel"><span>姓</span><span>名</span>：</label>
					<span class="shop-topText"><?php echo ($receipt["name"]); ?></span>
				</div>
				<div class="shop-topItem">
					<label class="shop-topLabel">手机号码：</label>
					<span class="shop-topText"><?php echo ($receipt["mobile"]); ?></span>
				</div>
				<div class="shop-topItem">
					<label class="shop-topLabel">收货地址：</label>
					<span class="shop-topText"><?php echo ($receipt["address"]); ?></span>
				</div><?php endif; ?>	
			</div>
			<span class="arrow-right"></span>
		</a>
		<div class="shop-order-list">
		<?php if(is_array($data)): foreach($data as $key=>$_list): ?><div class="a-shop-wrap">
				<a href="javascript:;" class="clearfix">
					<div class="order-img-wrap left" style="background-image: url(<?php echo ($_list["info"]["img_url"]); ?>);">
					</div>
					<div class="shopCar-middle left">
						<div class="shopCar-title"><?php echo ($_list["info"]["goodsname"]); ?></div>
						<!-- <?php if(($_list['info']['out_type_2']) == "1"): ?><div class="shop-orderTips">
							<span class="ticket-goods">兑换券商品</span>
						</div><?php endif; ?> -->
					</div>
					<div class="shopCar-right right">
						<div class="shopCar-money"><?php echo ($_list['info']['integral_pay']*$_list['num']); ?></div>
						<!-- <div class="shopCar-money"><?php echo ($_list['info']['money']*$_list['num']); ?></div> -->
						<div class="shop-orderNum">数量：<?php echo ($_list["num"]); ?></div>
					</div>
				</a>
				<div class="shop-orderRow">取货方式：物流</div>

				<div class="shop-orderRow">请选择快递公司：
								<!-- 顺丰快递 -->
								<select id="exp">
								<span class="arrow-right shop-arrow"></span>

									    <?php if(is_array($express)): foreach($express as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["expressname"]); ?></option><?php endforeach; endif; ?>
								</select>
								<span class="arrow-right shop-arrow"></span>

				</div>
				<!-- <div class="shop-orderRow">配送方式：<?php if(($_list['info']['out_type_1']) == "1"): ?>顺丰快递<?php endif; ?> <?php if(($_list['info']['out_type_2']) == "1"): ?>门店自取<?php endif; ?></div> -->
			</div><?php endforeach; endif; ?>
		<div class="shop-orderMoney">
			<!-- <div class="shop-moneyRow clearfix">
				<span class="left shop-rowLeft balck-row">总额</span>
				<span class="right shop-rowRight yellow-row"><?php echo ($money); ?></span>
			</div> -->
			<div class="shop-moneyRow clearfix">
				<span class="left shop-rowLeft balck-row">消耗积分数量</span>
				<span class="right shop-rowRight yellow-row"><?php echo ($integral); ?></span>
			</div>
			<!-- <?php if(($get_balance['dis_user_num']) > "0"): ?><div class="shop-moneyRow clearfix">
				<span class="left shop-rowLeft">会员优惠</span>
				<span class="right shop-rowRight">
					<a href="choose-tickets.html" class="red-row">
						-<?php echo ($get_balance["dis_user_num"]); ?>元
					</a>
				</span>
			</div><?php endif; ?> -->
			<!-- <div class="shop-moneyRow clearfix">
				<span class="left shop-rowLeft">选择优惠券</span>
				<span class="right shop-rowRight">
					<a href="<?php echo U('setYouhui',array('id'=>$get_balance['money']));?>" class="red-row">
						<span><?php echo ($reduce); ?></span><i class="arrow-right" style="right:0"></i>
					</a>
				</span>
			</div> -->
			<!-- <div class="shop-moneyRow clearfix" style="display:none">
				<span class="left shop-rowLeft">积分立减</span>
				<span class="right shop-rowRight red-row" style="width: 70%">
					可用积分<?php echo ($get_balance["integral"]); ?>可抵扣<?php echo ($get_balance['integral']*$get_balance['SCORE_MONEY']); ?>元
					<span class="choose-circle"></span>
				</span>
			</div> -->
		</div>
	</div>
	<div class="shopCar-total shop-order-bottom">
		<div class="shopCar-totalItem order-allPay left">
			<span id="z_money"><?php echo ($integral); ?></span>
		</div>
		<div class="right">
			<a href="javascript:void(0);" class="shopCar-confirm">立即付款</a>
		</div>
	</div>
	<div class="tips-box" style="display: none"></div>
	<script>
	// $(".choose-circle").click(function(){
	// 	var z_money=$("#z_money").html();
	// 	z_money=parseFloat(z_money);
	// 	if($(this).hasClass('active')){
	// 		$(this).removeClass("active");
	// 		var money=z_money+<?php echo ($get_balance['integral']*$get_balance['SCORE_MONEY']); ?>;
	// 		money=money.toFixed(2);
			
	// 		$("#z_money").html(money);
	// 	}else{
	// 	$(this).addClass("active");
	// 		var money=z_money-<?php echo ($get_balance['integral']*$get_balance['SCORE_MONEY']); ?>;
	// 		money=money.toFixed(2);
	// 		$("#z_money").html(money);
	// 	}
	
	// })
	$(".shopCar-confirm").click(function(){
		// if($(".choose-circle").hasClass('active')){
		// 	var status=1;
		// }else{
		// 	var status=0;
		// }
		var url="<?php echo U('add');?>";
		var query ={};
		var expreid = $('#exp option:selected').val();
		query['expid']=expreid;
	    //query['cardid']='<?php echo ($_GET['cardid']); ?>';
		$.post(url,query).success(function(res){
		if(res.status==1){
			var url="<?php echo U('payType',array('id'=>abc));?>";
			url=url.replace('abc',res.info);
			window.location.href=url;
			return false;
		}else{
			popup(res.info);
			return false;
		}
		});
		
	})
	</script>
</body>
</html>