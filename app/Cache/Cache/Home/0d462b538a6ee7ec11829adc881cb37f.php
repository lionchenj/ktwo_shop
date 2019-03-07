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
	<title>商城首页</title>
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css?v=1.4">
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/common.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/swiper.min.js"></script>
	<style type="text/css">
		.a-shop-wrap{
			padding-bottom:6.4rem;
		}
		.type-wrap {
			position: static;
        }
		.nav-item {
		    width: 33.3%;
		}
		.nav-list{
			height: 50px;
		}
		.nav-item {
		    padding-top: .5rem;
		}
		.nav-name.active {
		    color: rgb(2, 95, 167);
		}
		.nav-name {
		    font-size: 1rem;
		}
		.nav-list i{
			background-size: 19px;
		}
		.nav-name {
		    line-height: 1.7rem;
		}
			
	</style>
</head>
<body>
	<div class="title-info">
		<!-- <a href="https://dev170.weibanker.cn/lvsk/www/jinfeng/" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a> -->
		首页推荐
	</div>
	<div class="shop-swiper-wrap">
		<div class="swiper-container swiper1">
		  	<div class="swiper-wrapper">
		  		<?php if(is_array($banner1)): foreach($banner1 as $key=>$v1): ?><div class="swiper-slide">
			    		<a href="<?php echo ($v1["link"]); ?>" class="inline-block"><img src="<?php echo ($v1["img_path"]); ?>"></a>
			    	</div><?php endforeach; endif; ?>
		  	</div>
		  	<div class="swiper-pagination"></div>
		</div>
	</div>
	<div class="shop-recommend">
		<div class="recommend-title">编辑推荐</div>
		<div class="recommend-wrap clearfix">
			<div class="recommend-item left">
				<div class="swiper-container swiper2">
				  	<div class="swiper-wrapper">
				  		<?php if(is_array($banner2)): foreach($banner2 as $key=>$v2): ?><div class="swiper-slide">
				    		<a href="<?php echo ($v2["link"]); ?>" class="inline-block"><img src="<?php echo ($v2["img_path"]); ?>"></a>
				    	</div><?php endforeach; endif; ?>
				  	</div>
				  	<div class="swiper-pagination"></div>
				</div>
			</div>
			<div class="recommend-item left">
				<?php if(is_array($banner3)): foreach($banner3 as $key=>$v3): ?><a href="<?php echo ($v3["link"]); ?>" class="inline-block">
						<img src="<?php echo ($v3["img_path"]); ?>">
					</a><?php endforeach; endif; ?>
			</div>
		</div>
	</div>
	<div class="a-shop-wrap">
		<!-- <?php if(is_array($data)): foreach($data as $key=>$vo): ?><div class="shop-recommend">
			<div class="recommend-title"><?php echo ($vo["title"]); ?></div>
			<div class="recommend-wrap clearfix">
				<?php if(is_array($vo['list'])): foreach($vo['list'] as $key=>$_list): ?><div class="goods-item left">
					<a href="<?php echo U('goods',array('id'=>$_list['goodsid']));?>" class="goods-link">
						<img src="<?php echo ($_list["img_url"]); ?>">
						<div class="item-title">
							<?php echo ($_list["goodsname"]); ?>
						</div>
						<div class="item-money">
							积分：<?php echo ($_list["integral_pay"]); ?>
						</div>
					</a>
					<div class="shop-btn clearfix">
						<a href="javascript:;" class="add-card shop-list-btn left" data-id="<?php echo ($_list["goodsid"]); ?>">加入购物车</a>
						<a href="<?php echo U('Order/addOrder',array('id'=>$_list['goodsid'].'|1'));?>" class="add-order shop-list-btn right" data-id="<?php echo ($_list["goodsid"]); ?>">立即下单</a>
					</div>
				</div><?php endforeach; endif; ?>
			</div>
		</div><?php endforeach; endif; ?> -->
		<div class="shop-recommend">
			<div class="recommend-title">
				商品分类
			</div>

			<div class="type-wrap clearfix">
				<div class="left type-menu">
					<?php if(is_array($tree)): foreach($tree as $key=>$data): ?><div class="type-item <?php if(($key) == "0"): ?>active<?php endif; ?>" data-id="<?php echo ($data["id"]); ?>">
							<?php echo ($data["title"]); ?>
						</div><?php endforeach; endif; ?>	
				</div>
				<div class="left type-list">
					<?php if(is_array($tree)): foreach($tree as $key=>$data): ?><div class="type-box" id="type-<?php echo ($data["id"]); ?>" <?php if(($key) != "0"): ?>style="display: none"<?php endif; ?>>
							<?php if(is_array($data['_'])): foreach($data['_'] as $key=>$vo): ?><a href="<?php echo U('Goods/lists',array('class'=>$vo['id']));?>">
								<div class="type-top">
									<?php echo ($vo["title"]); ?>
								</div>
							</a><?php endforeach; endif; ?>
						</div><?php endforeach; endif; ?>
				</div>
			</div>
		    <!-- <div class="type-wrap clearfix">
				<div class="left type-menu">
				<div class="type-item active" data-id="78">
						理疗项目			</div><div class="type-item " data-id="79">
						中药2			</div>	
				</div>
				<div class="left type-list">
				<div class="type-box" id="type-78">
						<a href="/zhouzf/www/tcm/Home/Goods/lists/class/83?id=xiao">
							<div class="type-top">
								小儿推拿					</div>
						</a><a href="/zhouzf/www/tcm/Home/Goods/lists/class/82?id=tui">
							<div class="type-top">
								推拿按摩					</div>
						</a><a href="/zhouzf/www/tcm/Home/Goods/lists/class/80?id=zhen">
							<div class="type-top">
								针灸					</div>
						</a>			</div><div class="type-box" id="type-79" style="display: none">
						<a href="/zhouzf/www/tcm/Home/Goods/lists/class/81">
							<div class="type-top">
								中药2 二级					</div>
						</a>			</div>		</div>
			</div>	 -->		
		</div> 	 
		<div class="shop-recommend">
		    <div class="recommend-title">退货说明</div>
		    <div class="regoods">退货说明
		    </div>
		</div>

	</div>
	<div class="nav-list clearfix">
		<a href="<?php echo U('Shop/index');?>" class="left nav-item">
			<i class="icon-nav-index active"></i>
			<div class="nav-name active">
				商城
			</div>
		</a>
		<a href="https://dev170.weibanker.cn/lvsk/www/jinfeng/#ProfileTab" class="left nav-item">
			<i class="icon-nav-user"></i>
			<div class="nav-name">
				个人中心
			</div>
		</a>
		<a href="https://dev170.weibanker.cn/lvsk/www/jinfeng/#MyWallet" class="left nav-item">
			<i class="icon-nav-type"></i>
			<div class="nav-name">
				钱包
			</div>
		</a>
	</div>
	<div class="tips-box" style="display: none"></div>
	<script type="text/javascript">
		$(function(){
			var mySwiper1 = new Swiper('.swiper1', {
				loop : true,
				autoplay: {
				    delay: 2000,
				    stopOnLastSlide: false,
				    disableOnInteraction: true,
			    },
				pagination: {
			      el: '.swiper-pagination'
			    },
			})

			var mySwiper2 = new Swiper('.swiper2', {
				loop : true,
				autoplay: {
				    delay: 3000,
				    stopOnLastSlide: false,
				    disableOnInteraction: true,
			    },
				pagination: {
			      el: '.swiper-pagination'
			    },
			})
			$(".add-card").click(function(){
					var url="<?php echo U('order/addCard');?>";
					var query ={};
					var actoken = getCookie('access_token');
					query['id']=$(this).attr('data-id');
					console.log(actoken);
					if(!actoken){
						window.location.href = 'https://dev170.weibanker.cn/lvsk/www/jinfeng/';
					}
					$.post(url,query).success(function(res){
					if(res.status==1){
						 window.location.href="<?php echo U('order/card');?>";
						}else{
						popup(res.info);
						}
					});
			})

			function getCookie(name)
				{
				    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");

				    if(arr=document.cookie.match(reg))
				        return unescape(arr[2]);
				    else
				        return null;
				}
		})

	$(function(){
		$(".type-item").on("click",function(){
			var attr = $(this).attr("data-id");
			$(this).addClass("active").siblings().removeClass("active");
			$("#type-"+attr).show().siblings().hide();
		})
		$(".search-btn").click(function(){
		var title=$("input[name='title']").val();
		if(title.length>0){
			$("#search").submit();
		}else{
		return false;
		}
		})
	})

	</script>
</body>
</html>