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
	<title>天辅安中医馆我的订单</title>
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css">
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/common.js"></script>
	<style type="text/css">
		.a-cancel-order{
			border: 1px solid #ababab;
			color: #333;
		}
		/* .a-get-ticket, */
		.a-to-appraise{
			display: inline-block;
			width: 7.5rem;
			height: 2.7rem;
			text-align: center;
			line-height: 2.5rem;
			border-radius: 2.7rem;
			border: 1px solid #ababab;
			/* margin-left: .5rem; */
			border-color: #a98858;
			color: #a98858;
			/* margin-top:1rem; */
			font-size: 1.2rem;
		}
		.a-goods-item{
			padding-top: 1rem;
			position: relative;
		}
		.a-order-row{
			width: auto;
			height: 1rem;
			text-align: right;
			padding:.5rem 0;
			margin: 0 .9rem;
		}
		.a-goods-item+.a-goods-item::before{
			content: '';
			height: 1px;
			background-color: #dcdcdc;
			position: absolute;
			top: 0;
			left:.9rem;
			right: .9rem;
		}
		.goods-detail .goods-info{
			margin-top: 0;
		}
		.detail-list .express-info{
			color: #212121
		}
	</style>
</head>
<body>
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		订单详情
	</div>
	<div class="detail-info">
		<div class="detail-title">订单信息</div>
		<ul class="detail-list">
			<li>
				<span>订单编号：</span>
				<span><?php echo ($data["orderid"]); ?></span>
			</li>
			<li>
				<span>收货人姓名：</span>
				<span><?php echo ($data["name"]); ?></span>
			</li>
			<li>
				<span>收货人联系方式：</span>
				<span><?php echo ($data["mobile"]); ?></span>
			</li>
			<li>
				<span>收货地址：</span>
				<span><?php echo ($data["address"]); ?></span>
			</li>
			<li>
				<span>下单时间：</span>
				<span><?php echo (time_format($data["create_time"])); ?></span>
			</li>
			<li>
				<span>订单状态：</span>
				  <?php switch($data["status"]): case "-1": ?><span class="detail-state">无效订单</span><?php break;?>
					<?php case "1": ?><span class="detail-state">未支付</span><?php break;?>
					<?php case "2": ?><span class="detail-state">已支付(未发货)</span><?php break;?>
					<?php case "3": ?><span class="detail-state">待评价</span><?php break;?>
					<?php case "4": ?><span class="detail-state">已完成</span><?php break; endswitch;?>
			</li>
			<li>
				<span>快递公司：</span>
				<span>
					<?php echo ($data["expressname"]); ?>
		    	</span>
			</li>
			<li>
				<span>物流信息：</span>
				<?php if($data['is_trace']==1 ){ ?>
                暂无物流信息
                <?php }else{ ?>
				<a href="<?php echo U('order/trace',array('id'=>$data['orderid']));?>" class="express-info">点击查看</a>
				<?php } ?>
			</li>
		</ul>
	</div>
	<div class="goods-detail">
		<div class="detail-title">商品信息</div>
		<div class="goods-info">
			<?php if(is_array($data["goods_list"])): foreach($data["goods_list"] as $key=>$_list): ?><div class="a-goods-item">
				<a href="<?php echo U('shop/goods',array('id'=>$_list['info']['goodsid']));?>" class="order-link clearfix">
					<div class="order-img-wrap left" style="background-image: url(<?php echo ($_list['info']['img_url']); ?>);">
					</div>
					<div class="order-title left"><?php echo ($_list['info']['goodsname']); ?></div>
					<div class="order-payInfo right">
						<div class="order-money"><?php echo ($_list['info']['integral_pay']); ?></div>
						<div class="order-num">数量：<?php echo ($_list['num']); ?></div>
					</div>
				</a>
				<div class="a-order-row">
					<!-- <?php if(($data["status"]) == "2"): if(($_list['info']['out_type_2']) == "1"): ?><span class="a-get-ticket" data-id="<?php echo ($_list['info']['goodsid']); ?>" data-oid="<?php echo ($data['orderid']); ?>">领兑换券</span><?php endif; endif; ?> -->
					 <!-- <?php if(($data["status"]) == "3"): ?><a href="javascript:void(0);" class="a-to-appraise click-comment" data-id="<?php echo ($_list['info']['goodsid']); ?>">评价</a><?php endif; ?> -->
				</div> 
			</div><?php endforeach; endif; ?>
		</div>
	</div>
	<div class="detail-info">
		<div class="detail-title">订单信息</div>
		<ul class="order-list">
			<!-- <li class="clearfix">
				<span class="left fs-14 detial-big">总额</span>
				<span class="right fs-15 detail-all-money"><?php echo ($data["money"]); ?></span>
			</li> -->
			<!-- <li>
				<ul class="order-list order-detail-list">
				<?php if(($data["user_del_money"]) > "0"): ?><li class="clearfix">
						<span class="left">会员优惠</span>
						<span class="right">-<?php echo ($data["user_del_money"]); ?></span>
					</li><?php endif; ?>	
				<?php if(($data["youhui_del_money"]) > "0"): ?><li class="clearfix">
						<span class="left">代金卷</span>
						<span class="right">-<?php echo ($data["youhui_del_money"]); ?></span>
					</li><?php endif; ?>
				<?php if(($data["integral"]) > "0"): ?><li class="clearfix">
						<span class="left">积分</span>
						<span class="right">-<?php echo ($data["integral_del_money"]); ?></span>
					</li><?php endif; ?>					
				</ul>
			</li> -->
			<li class="clearfix">
				<span class="left fs-14 detial-big">支付方式</span>
				<span class="right fs-15">积分支付</span>
			</li>
			<li class="clearfix">
				<span class="left fs-14 detail-red">实付积分</span>
				<span class="right fs-15 detail-red"><?php echo ($data["pay_integral"]); ?></span>
			</li>
		</ul>
	</div>
	<div class="detail-btn-wrap">
	<?php if(($data["status"]) == "1"): ?><a href="javascript:;" data-id="<?php echo ($data["orderid"]); ?>" class="detail-btn order-btn-1 a-cancel-order">取消订单</a>
		<a href="<?php echo U('Order/payType',array('id'=>$data['orderid']));?>" class="detail-btn">立即支付</a><?php endif; ?>	
	</div>
	<div class="tips-box" style="display: none"></div>
<script>
	$(document).on('click','.order-btn-1',function(){
			var orderid=$(this).attr('data-id');
			if(orderid){
				if(!confirm('确认要取消订单吗?')){
					return false;
				}
				var url="<?php echo U('del_order');?>";
				var query ={};
				query['id']=orderid;
				$.post(url,query).success(function(res){
				if(res.status==1){
					popup('删除成功');
						setTimeout(function(){
						location.reload() 
						},1500);
						return false;
				}else{
				popup(res.info);
				return false;
				}
				});
			}else{
				popup("错误");
				return false;
			}
				
			})

$(document).on('click','.click-comment',function(){
	var order="<?php echo ($data["orderid"]); ?>";
	var goodsid=$(this).attr('data-id');
	window.location.href="<?php echo U('About/comment');?>/orderid/"+order+"/goodsid/"+goodsid; 
})
// $(document).on('click','.a-get-ticket',function(){
// 	var order=$(this).attr('data-oid');
// 	var goodsid=$(this).attr('data-id');
// 		alert(order);
// 		var url="<?php echo U('get_duihuan');?>";
// 		var query ={};
// 		query['orderid']=order;
// 		query['goodsid']=goodsid;
// 		$.post(url,query).success(function(res){
// 			if(res.status==1){
// 					popup('领取成功');
// 					setTimeout(function(){
// 						location.reload() 
// 					},1500);
// 					return false;
// 			}else{
// 				popup(res.info);
// 				return false;
// 			}
// 		})
// })
</script>
	</body>

</html>