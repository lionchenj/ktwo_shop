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
	<title>中医馆分类</title>
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css?v=1.4">
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/resize.js"></script>
</head>
<body>
	<div class="title-info">
		分类
	</div>
	<div class="search-wrap clearfix">
		<div class="left search-item1">
		<form id="search" action="<?php echo U('Goods/lists');?>" method="get">
			<div class="search-input">
				<input type="text" name="title" placeholder="请输入商品关键字">
			</div>
			<div class="search-btn">
				<input  type="submit"><i class="icon-search"></i></input>
			</div>
		</form>	
		</div>
		<div class="left search-item2">
			<a href="<?php echo U('Order/card');?>" class="s-link">
				<i class="icon-shopCar"></i>
			</a>
		</div>
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
<!-- 	<div class="nav-list clearfix">
		<a href="<?php echo U('Shop/index');?>" class="left nav-item">
			<i class="icon-nav-index "></i>
			<div class="nav-name ">
				首页
			</div>
		</a>
		<a href="<?php echo U('Classify/index');?>" class="left nav-item">
			<i class="icon-nav-type active"></i>
			<div class="nav-name active">
				分类
			</div>
		</a>
		<a href="<?php echo U('Order/card');?>" class="left nav-item">
			<i class="icon-nav-shopcar"></i>
			<div class="nav-name">
				购物车
			</div>
			<span class="tips-circle"><?php echo ($_shopnum); ?></span>
		</a>
		<a href="<?php echo U('About/index');?>" class="left nav-item">
			<i class="icon-nav-user"></i>
			<div class="nav-name">
				个人中心
			</div>
		</a>
	</div> -->
<script type="text/javascript">
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