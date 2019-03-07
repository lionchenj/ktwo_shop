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
	<title>天辅安中医馆我的积分</title>
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/mescroll.min.css">
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/common.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/mescroll.min.js"></script>
</head>
<body class="bg-white">
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		我的积分
	</div>
	<div class="score-title">当前积分</div>
	<div class="score-middle">
		<div class="score"><?php echo $score?$score:'0.00';?></div>
<!-- 		<div class="score-tips">
			=相当于人民币<?php echo $score2money?$score2money:'0.00';?>元
		</div> -->
	</div>
	<div class="score-detail mescroll" id="mescroll">
		<div class="fs-15">积分详情</div>
		<ul class="score-list" id="data-list">
		<?php if(is_array($_list)): foreach($_list as $key=>$vo): ?><li class="clearfix">
				<span class="left score-date"><?php echo (time_format($vo["create_time"])); ?></span>
				<?php if(($vo['type']) == "1"): ?><span class="right score-num"><?php echo ($vo["score"]); ?></span><?php endif; ?>
				<?php if(($vo['type']) == "-1"): ?><span class="right score-num">-<?php echo ($vo["score"]); ?></span><?php endif; ?>
			</li><?php endforeach; endif; ?>	
		</ul>
	</div>
	<script type="text/javascript">
		$(function(){
			var mescroll = new MeScroll("mescroll", {
				down:{
					use:false
				},
				up: {
					callback: upCallback,//上拉加载的回调
					empty:{
						wrapId :'data-list',
						icon: "",
  						tip : "暂无相关数据",
					}
				}
			});

			//上拉加载的回调 page = {num:1, size:10}; num:当前页 默认从1开始, size:每页数据条数,默认10
			function upCallback(page){
				$.ajax({
					url: '/path/to/file',
					type: 'GET',
					dataType: 'json',
					data: page,
					success:function(curPageData){
						mescroll.endByPage(curPageData.length, totalPage);
						setListData(curPageData);
					},
					error: function(e) {
						//联网失败的回调,隐藏下拉刷新和上拉加载的状态
						mescroll.endErr();
					}
				})
			}

			function setListData(curPageData){
				var listData = [];
				for (var i = 0; i < curPageData.length; i++) {
					listData.push(curPageData[i]);
				}
			}
		})
	</script>
</body>
</html>