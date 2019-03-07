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
	<title>中医馆商城我的收藏</title>
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css">
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/common.js"></script>
</head>
<body>
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		我的收藏
	</div>
	<div class="collect-wrap">
	<div id="null-collect" style="text-align:center;padding-top: 1.4rem; <?php if(!empty($_list)): ?>display:none<?php endif; ?>">
			<img src="/zhouzf/www/tcm/template/Tcm/images/empty.png" style="width: 11rem;height: 11rem;">
			<div style="color: #999;font-size: 1.6rem;line-height: 3rem;margin-top: 1.4rem;">
				您还没有收藏商品
			</div>
	</div>
	<?php if(is_array($_list)): foreach($_list as $key=>$data): ?><div class="collect-item">
			<div class="collect-top clearfix">
				<span class="choose-circle  all left sm-circle" data-id="<?php echo ($data["id"]); ?>"></span>
				<span class="collect-name left"><?php echo ($data["goodsname"]); ?></span>
				<span class="icon-cancel right" data-id="<?php echo ($data["id"]); ?>"></span>
			</div>
			<a href="<?php echo U('shop/goods',array('id'=>$data['goodsid']));?>" class="collect-link clearfix">
				<img src="<?php echo ($data["img_url"]); ?>" class="left">
				<div class="left collect-info">
					<div class="collect-allName"><?php echo ($data["goodsname"]); ?></div>
					<div class="collect-money">
						￥<?php echo ($data["money"]); ?>
					</div>
				</div>
				<span class="arrow-right"></span>
			</a>
		</div><?php endforeach; endif; ?>
		
	</div>
	<div class="shopCar-total del-bootom" style="<?php if(empty($_list)): ?>display:none<?php endif; ?>">
		<div class="shopCar-totalItem left">
			<span class="choose-circle big-circle"></span>
			<span class="inline-block choose-text">全选</span>
			<span class="shopCar-totalNum">0</span>
		</div>
		<div class="right">
			<a href="javascript:void(0);" class="shopCar-confirm del-collect">删除</a>
		</div>
	</div>
	<div class="tips-box" style="display: none"></div>
	<script>
		$(function(){
			/*单个删除*/
			$(".icon-cancel").on("click",function(){
				$(this).parents(".collect-item").remove();
				if($(".collect-item").length!=0){
					$(".shopCar-totalNum").text($(".collect-item .active").length);
				}else{
					$(".shopCar-totalNum").text(0);
					$(".big-circle").removeClass("active");
					$("#null-collect").show();
					$(".del-bootom").hide();
				}
					var url="<?php echo U('del_collection');?>";
					var query ={};
					query['id']=$(this).attr('data-id');
					$.post(url,query).success(function(res){
					return false;
					});
			})

			/*全选删除*/
			$(".del-collect").on("click",function(){
			var id='';
				$(".all").each(function(){
					if($(this).hasClass("active")){
						var data_id=$(this).attr('data-id');
						if(data_id){
							id+=data_id+","
						}
					}
				})
				id=id.substring(0,id.length-1)
				if(id){
					var url="<?php echo U('del_collection');?>";
					var query ={};
					query['id']=id;
					$.post(url,query).success(function(res){
					return false;
					});
				}
				$(".collect-top").find(".active").parents(".collect-item").remove();
				$(".shopCar-totalNum").text(0);
				$(".big-circle").removeClass("active");
				if($(".collect-item").length===0){
					$("#null-collect").show();
					$(".del-bootom").hide();
				}else{
					$("#null-collect").hide();
				}
			})

			/*全选*/
			$(".big-circle").on("click",function(){
				if($(this).hasClass("active")){
					$(this).removeClass("active");
					$(".sm-circle").removeClass("active");
					$(".shopCar-totalNum").text(0);
				}else{
					$(this).addClass("active");
					$(".sm-circle").addClass("active");
					$(".shopCar-totalNum").text($(".collect-item").length);
				}
			})

			/*单选*/
			$(".sm-circle").on("click",function(){
				var n1 = parseInt($(".shopCar-totalNum").text());
				if($(this).hasClass("active")){
					$(this).removeClass("active");
					$(".big-circle").removeClass("active");
					n1--;
					$(".shopCar-totalNum").text(n1);
				}else{
					$(this).addClass("active");
					n1++;
					$(".shopCar-totalNum").text(n1);
				}
				if($(".collect-top .active").length === $(".collect-item").length){
					$(".big-circle").addClass("active");
				}
			})
		})
	</script>
</body>
</html>