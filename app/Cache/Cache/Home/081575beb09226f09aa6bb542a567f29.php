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
	<title>天辅安中医馆我的卡券</title>
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/mescroll.min.css?v=1.6">
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/style.css">
	<script type="text/javascript" src="/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/common.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/mescroll.min.js"></script>
	<style>
		.shop-t-cont2 .t-row-1{
			font-size:3rem;
		}
		.shop-t-cont1 .t-row-1{
			font-size:5.5rem;
		}
		.t-row-item1{
			font-size:2rem;
		}
	</style>
</head>
<body>
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		我的卡券
	</div>
	<div class="shop-t-nav clearfix">
		<div class="shop-nav-tab left active" data-id="1">
			代金券
		</div>
		<div class="shop-nav-tab left" data-id="2">
			兑换券
		</div>
	</div>
	<div class="shop-t-container">
		<div class="mescroll" id="mescroll">
			<div id="dataList">
				<!-- <a href="ticket-detail-1.html" class="shop-t-item clearfix">
					<div class="t-row-1 left">5</div>
					<div class="t-row-2 left">
						<div class="t-row-item1">代金券</div>
						<div class="t-row-item2">
							满5元立减
						</div>
						<div class="t-row-item3">
							(截至2017年8月11号)
						</div>
					</div>
					<div class="t-state">
						可使用
					</div>
				</a>
				<a href="ticket-detail-1.html" class="shop-t-item clearfix be-used">
					<div class="t-row-1 left">10</div>
					<div class="t-row-2 left">
						<div class="t-row-item1">代金券</div>
						<div class="t-row-item2">
							满99元立减
						</div>
						<div class="t-row-item3">
							(截至2017年8月11号)
						</div>
					</div>
					<div class="t-state">
						已使用
					</div>
				</a>
				<a href="ticket-detail-1.html" class="shop-t-item clearfix be-used">
					<div class="t-row-1 left">10</div>
					<div class="t-row-2 left">
						<div class="t-row-item1">代金券</div>
						<div class="t-row-item2">
							满99元立减
						</div>
						<div class="t-row-item3">
							(截至2017年8月11号)
						</div>
					</div>
					<div class="t-state">
						已失效
					</div>
				</a> -->
			</div>
		</div>
		<!--<div class="shop-t-cont2 mescroll" id="mescroll-2" style="display: none">
			<div id="dataList2">
				<!-- <a href="ticket-detail-2.html" class="shop-t-item clearfix">
					<div class="t-row-1 left">针灸</div>
					<div class="t-row-2 left">
						<div class="t-row-item1">兑换券</div>
						<div class="t-row-item2">
							各大门店
						</div>
						<div class="t-row-item3">
							(截至2017年8月11号)
						</div>
					</div>
					<div class="t-state">
						可使用
					</div>
				</a>
				<a href="ticket-detail-2.html" class="shop-t-item clearfix be-used">
				 	<div class="t-row-1 left">按摩</div>
					<div class="t-row-2 left">
						<div class="t-row-item1">兑换券</div>
						<div class="t-row-item2 t-some-shop">
							广州黄埔店、广州黄埔店、 广州黄埔店、广州黄埔店
						</div>
						<div class="t-row-item3">
							(截至2017年8月11号)
						</div>
					</div>
					<div class="t-state">
						已使用
					</div>
				</a>
				<a href="ticket-detail-2.html" class="shop-t-item clearfix be-used">
					<div class="t-row-1 left">理疗</div>
					<div class="t-row-2 left">
						<div class="t-row-item1">兑换券</div>
						<div class="t-row-item2 t-some-shop">
							广州黄埔店、广州黄埔店、 广州黄埔店、广州黄埔店
						</div>
						<div class="t-row-item3">
							(截至2017年8月11号)
						</div>
					</div>
					<div class="t-state">
						已失效
					</div>
				</a> -->
				<!-- <div id="null-box" style="text-align:center;padding-top: 1.4rem;display: none">
					<img src="images/empty.png" style="width: 11rem;height: 11rem;">
					<div style="color: #999;font-size: 1.6rem;line-height: 3rem;margin-top: 1.4rem;">
						您还没有兑换券
					</div>
				</div> -->
			<!--</div>
		</div> -->
	</div>
	<script>
		$(function(){
			var curNavIndex = 1;//代金券1;兑换券2;
			var emptyTips = '';
			/*初始化菜单*/
			$(".shop-nav-tab").on("click",function(){
				var i=Number($(this).attr("data-id"));
				if(curNavIndex!=i){
					//更改列表条件
					curNavIndex=i;
					$(this).addClass("active").siblings().removeClass("active");
					//重置列表数据
					mescroll.resetUpScroll();
				}
				if(curNavIndex == "1"){
					emptyTips = '您还没有相关的代金券'
				}else if(curNavIndex == "2"){
					emptyTips = '您还没有相关的兑换券'
				}
			})
			
			var mescroll = new MeScroll("mescroll", {
				//上拉加载的配置项
				up: {
					callback: getListData, //上拉回调,此处可简写; 相当于 callback: function (page) { getListData(page); }
					noMoreSize: 4, //如果列表已无数据,可设置列表的总数量要大于半页才显示无更多数据;避免列表数据过少(比如只有一条数据),显示无更多数据会不好看; 默认5
					empty: {
						icon: "/tcm/template/Tcm/images/empty.png", //图标,默认null
						tip: emptyTips
					},
					clearEmptyId: "dataList", //相当于同时设置了clearId和empty.warpId; 简化写法;默认null
					page:{
						num:0,
						size:5
					}
				}
			});

			/*联网加载列表数据  page = {num:1, size:10}; num:当前页 从1开始, size:每页数据条数 */
			function getListData(page){
				//联网加载数据
				var dataIndex=curNavIndex; //记录当前联网的nav下标,防止快速切换时,联网回来curNavIndex已经改变的情况;
				var pageIndex = page.num-1;
				getListDataFromNet(dataIndex, pageIndex, page.size, function(pageData){
					//联网成功的回调,隐藏下拉刷新和上拉加载的状态;
					//mescroll会根据传的参数,自动判断列表如果无任何数据,则提示空;列表无下一页数据,则提示无更多数据;
					console.log("dataIndex="+mescroll+", curNavIndex="+curNavIndex+", page.num="+pageIndex+", page.size="+page.size+", pageData.length="+pageData.length);
					mescroll.endSuccess(pageData.length);
					//设置列表数据
					setListData(pageData,dataIndex);
				}, function(){
					//联网失败的回调,隐藏下拉刷新和上拉加载的状态;
	                mescroll.endErr();
				});
			}

			/*联网加载列表数据*/
			function getListDataFromNet(curNavIndex,pageNum,pageSize,successCallback,errorCallback){
	        	$.ajax({
	                type: 'POST',
	                url: '<?php echo U('About/ajax_card_list');?>',
					data:{
						start:pageNum,
						limit:pageSize,
						type:curNavIndex
					},
	                dataType: 'json',
	                success: function(data){
						console.log(data);
						var list = data.info;
						var listData =  [];
						if(list){
							for(var i = 0; i<list.length;i++){
								listData.push(list[i]);
							}
						}
						//回调
		                successCallback(listData);
					},
	                error: errorCallback
	            });
			}

			function setListData(pageData,dataIndex){
				var listDom=$("#dataList");
				var str = '';
				for (var i = 0; i < pageData.length; i++) {
					var item = pageData[i];
					if(dataIndex == "1"){
						str +='<a href="<?php echo U('card_edit');?>/id/'+item.id+'" class="shop-t-item shop-t-cont1 clearfix '+isUsedClass(item.status)+'">'+
						'<div class="t-row-1 left">'+item.reduce+'</div>'+
						'<div class="t-row-2 left">'+
							'<div class="t-row-item1">代金券</div>'+
							'<div class="t-row-item2">满'+item.least+'元立减</div>'+
							'<div class="t-row-item3">(截至'+item.time+')</div>'+
						'</div>'+
						'<div class="t-state">'+isUsedText(item.status)+'</div></a>'
					}else if(dataIndex == '2'){
						str += '<a href="<?php echo U('card_edit');?>/id/'+item.id+'" class="shop-t-item shop-t-cont2 clearfix '+isUsedClass(item.status)+'">'+
							'<div class="t-row-1 left">'+item.cardname+'</div>'+
							'<div class="t-row-2 left">'+
								'<div class="t-row-item1">兑换券</div>'+
								'<div class="t-row-item2">'+item.store+'</div>'+
								'<div class="t-row-item3">(截至'+item.time+')</div>'+
							'</div>'+
							'<div class="t-state">'+isUsedText(item.status)+'</div></a>'
					}
				}
				listDom.append(str)
			}
			
			function isUsedText(num){
				switch(num){
					case "0":
						return '可使用';
						break;
					case "-1":
						return '已失效';
						break;
					case "1":
						return '已使用';
						break;
				}
			}
			
			function isUsedClass(num){
				switch(num){
					case "0":
						return '';
						break;
					case "-1":
						return 'be-used';
						break;
					case "1":
						return 'be-used';
					break;
				}
			}
		})
	</script>
</body>
</html>