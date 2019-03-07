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
	<link rel="stylesheet" type="text/css" href="/shadow/mast/template/Cinema/css/style.css?v=1.5">
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/resize.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/calc.js"></script>
</head>
<body>
	<div class="new-container">
		<div class="distri-top-wrap">
			<div class="poster-img">
				<img src="/shadow/mast/template/Cinema/images/sm-poster.png">
			</div>
			<div class="movie-info">
				<div class="movie-info-1">一路绽放:<?php echo ($data["num"]); ?>张</div>
				<div class="movie-info-sm"><?php echo ($data["goodsname"]); ?></div>
				<div class="movie-info-sm"><?php echo ($data["surplus"]); ?>/<?php echo ($data["num"]); ?>张</div>
			</div>
		</div>
		<div class="form-wrap relative">
			<form action="buy-list.html">
				<div class="form-item clearfix">
					<span class="form-label-1 left">分配数量</span>
					<div class="form-input right">
						<button type="button" class="calc-btn reduce-btn" onclick="calc(this)">-</button>
						<input type="number" name="distriNumber" data-max="<?php echo ($data["surplus"]); ?>" class="input-item int" value="1">
						<button type="button" class="calc-btn add-btn"  onclick="calc(this)">+</button>
					</div>
				</div>
				<div class="form-bottom clearfix">
					<div class="form-label-2 left">
						合计：<span class="all-number">1张</span>
					</div>
					<?php if(($data["status"]) == "3"): ?><button type="button" class="submit-btn right" disabled>分配</button>
					<?php else: ?>
					<button type="button" class="submit-btn right">分配</button><?php endif; ?>
				</div>
			</form>
			<a href="<?php echo U('distribution2',array('orderid'=>$data['id']));?>" class="record-link abs">查看分劵记录</a>
		</div>
	</div>
	<div class="error-tips" style="display: none;">
			选择的城市不能超过三个
		</div>
	<script type="text/javascript">
	
		function popup(msg){
			$(".error-tips").text(msg);
			$(".error-tips").fadeIn();
			setTimeout(function(){
				$(".error-tips").fadeOut();
			},1200)
			}
		$(function(){
			$('body').on('touchmove', function(e) {
				e.preventDefault();
			});
		});
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
			var num=$('input[name="distriNumber"]').val();
			if(num>=<?php echo ($data["surplus"]); ?>){
				num=<?php echo ($data["surplus"]); ?>;
			}
			$('input[name="distriNumber"]').val(num);
			$('.all-number').html(num+"张");

		}
		$(document).on('click','.submit-btn',function(){
			var num=$('input[name="distriNumber"]').val();
			if(num<1){
				popup("至少分配1张卡券");
				return false;
			}
				var url="/shadow/mast/Home/About/two_edit/id/55.html";
				var query = {};
				query['orderid']='<?php echo ($data["orderid"]); ?>';
				query['num']=num;
				$.post(url,query).success(function(res){
					if(res.status==1){
						var url2="<?php echo U('two_receive',array('id'=>abc));?>";
						url2=url2.replace('abc',res.info);
						window.location.href=url2;
					}else{
						popup(res.info);
					}
					
				})
		})
	</script>
</body>
</html>