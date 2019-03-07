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
	<title>物流信息</title>
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
		.express-info{
			color: #212121;
			padding:  0 2rem	;
		}
		.express-info .otime{
			margin-left: 2.6rem;
			line-height: 1.2rem;
			font-size: 1.2rem;
		}
		.express-info .text{
			color: #333;
		}
		.detail-title{
			padding-top:  4.5rem;
			padding-left: 1rem;
			font-size: 1.6rem;
		}
		.detail-list{
			margin-top: -1rem;
		}
		.detail-list li{
			display: block;
			/* margin-bottom: -1rem; */
			padding-left:  1rem;
			border: 1px #000;
		}
		.detail-list li .text::before{
			content: '';
		    display: inline-block;
		    width: .6rem;
		    height: .6rem;
		    margin-right: 1.2rem ;
		    background: #BDBDBD;
		    border: .2rem solid #EEE;
		    -webkit-border-radius: 1rem;
		}
		.detail-list li::before{
			content: '';
			position:  relative;
		    display: inline-block;
		    top: -1rem;
		    width: .03rem;
		    height: 6rem;
		    padding-right: .2rem;
		    margin-bottom: -1.5rem;
		    margin-left:  .2rem;
		    background: #BDBDBD;
		    border: .2rem solid #EEE;
		}
		.detail-list li:first-child::before{
			width: 0;
			height: 0;
			padding: 0;
			border: 0;
		}
	</style>
</head>
<body>
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		物流信息
	</div>
	<div class="detail-title">
		订单状态：<?php if(($order['status']) == "1"): ?>待支付<?php endif; ?>
				 <?php if(($order['status']) == "2"): ?>已支付<?php endif; ?>
				 <?php if(($order['status']) == "3"): ?>待评价<?php endif; ?>
				 <?php if(($order['status']) == "4"): ?>已完成<?php endif; ?>
	</div>
	<div class="express-info">
		<ul class="detail-list">
            <!-- <?php if($order_info['is_trace']==1){ ?>
            <div class="controls">暂无物流信息</div>
            <?php }else{ ?> -->

            
   
            	<?php if($express->State == 0){ ?>
	            	<li>
						<div class="text">
						    货物已发出----暂无轨迹信息
					    </div>
		            </li>
            	<?php }else{ ?>
	            	<li>
						<div class="text">
						    正式发货
					    </div>
						<div class="otime">
						    <?php echo date("Y-m-d h:i:s",$order['trace_time']);?>
					    </div>
		            </li>
	                <?php foreach($express->Traces as $k=>$v){ ?>
	                <li>
						<div class="text">
						    <?php echo ($v->AcceptStation); ?>
					    </div>
						<div class="otime">
						    <?php echo ($v->AcceptTime); ?>
					    </div>
		            </li>
	                <?php }?>	
            	<?php } ?>
           <!--  <?php } ?> -->

			
			<!-- <li>
				<div class="text">
				    到达【虎门分拨中心】
			    </div>
				<div class="otime">
				    2018-12-24 13:35:16
			    </div>
            </li>
            <li>
            	<div class="text">
				    离开【虎门分拨中心】 发往【黄江】
			    </div>
				<div class="otime">
				    2018-12-24 13:35:19
			    </div>
            </li>
            <li>
            	<div class="text">
				    离开【虎门分拨中心】 发往【长安】
			    </div>
				<div class="otime">
				    2018-12-24 13:49:37
			    </div>
            </li>
            <li>
            	<div class="text">
				    到达【长安】
			    </div>
				<div class="otime">
				    2018-12-24 14:57:21
			    </div>
            </li>
            <li>
            	<div class="text">
				    快件在【长安】被签收，签收人【本人】
			    </div>
				<div class="otime">
				    2018-12-24 16:17:26
			    </div>
            </li> -->
		</ul>
	</div>

	<div class="tips-box" style="display: none"></div>
<script>

</script>
	</body>

</html>