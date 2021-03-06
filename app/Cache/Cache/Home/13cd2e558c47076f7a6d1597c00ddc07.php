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
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/mescroll.min.css?v=1.6">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css?v=1.3">
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/common.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/mescroll.min.js"></script>
	<style type="text/css">
		.order-container{
			height:100%;
			padding-top:8.2rem;
			top:0;
		}
		.order-nav-wrap{
			z-index:100;
		}
		.a-get-ticket,.a-to-appraise{
			display: inline-block;
			width: 7.5rem;
			height: 2.7rem;
			text-align: center;
			line-height: 2.5rem;
			border-radius: 2.7rem;
			border: 1px solid #ababab;
			margin-left: .5rem;
			border-color: #a98858;
			color: #a98858;
			/* margin-top:1rem; */
		}
		.order-link{
			position:relative;
		}
		.a-get-ticket{
			position: absolute;
			bottom: .6rem;
			right: .9rem;
		}
	</style>
</head>
<body style="-webkit-tap-highlight-color:rgba(0,0,0,0)">
	<div class="title-info">
		<a href="https://dev170.weibanker.cn/lvsk/www/jinfeng/#ProfileTab" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		我的订单
	</div>
	<div class="order-nav-wrap clearfix">
		<div class="left order-nav active" data-id="1">待支付</div>
		<div class="left order-nav" data-id="2">待收货</div>
		<div class="left order-nav" data-id="3">待评价</div>
		<div class="left order-nav" data-id="4">已完成</div>
	</div>
	<div class="order-container mescroll" id="mescroll">
		<div id="dataList">
			
		</div>
	</div>

	<!-- 提示弹窗 -->
	<div class="tips-box" style="display: none;"></div>

	<div class="tips-box" style="display: none"></div>
	<script type="text/javascript">
		$(function(){
			var tabId = GetQueryString("id");
			var curNavIndex = tabId,
			    oTab = document.getElementsByClassName("order-nav"),
			    len = oTab.length;
			    
            renderTab(tabId);

            //已发货的status已被占用为3，因此这里当url.id为3时，赋值为4，当url.id为4时，赋值为5
            // if(curNavIndex >= 3){
            //   curNavIndex = (curNavIndex==3? 4:5)
            // }
		    
			$(".order-nav").click(function(){
				var i=Number($(this).attr("data-id"));
				if(curNavIndex!=i){
					//更改列表条件

					curNavIndex=i;
					$(this).addClass("active").siblings().removeClass("active");
					//重置列表数据
					mescroll.resetUpScroll();
				}
			})

			// $(".pay-order-btn").on("click",function(){
			// 	$(".pay-popup").show();
			// })
			// $(".black-mask,.icon-close").on("click",function(){
			// 	$(".pay-popup").hide();
			// })

			//模拟select效果
			function select(e) {
				var value = $(e).find("option:selected").text();
				$(e).siblings(".mark-tips").text(value);
			}

			//创建MeScroll对象,内部已默认开启下拉刷新,自动执行up.callback,刷新列表数据;
			var mescroll = new MeScroll("mescroll", {
				//上拉加载的配置项
				up: {
					callback: getListData, //上拉回调,此处可简写; 相当于 callback: function (page) { getListData(page); }
					noMoreSize: 4, //如果列表已无数据,可设置列表的总数量要大于半页才显示无更多数据;避免列表数据过少(比如只有一条数据),显示无更多数据会不好看; 默认5
					empty: {
						icon: "/zhouzf/www/tcm/template/Tcm/images/empty.png", //图标,默认null
						tip: "您还没有相关的订单"
					},
					clearEmptyId: "dataList", //相当于同时设置了clearId和empty.warpId; 简化写法;默认null
					page:{
						num:0,
						size:5
					}
				}
			});
	        

			/*联网加载列表数据  page = {num:1, size:5}; num:当前页 从1开始, size:每页数据条数 */
			function getListData(page){
				//联网加载数据
				var dataIndex=curNavIndex; //记录当前联网的nav下标,防止快速切换时,联网回来curNavIndex已经改变的情况;
				var pageIndex = page.num-1;
				getListDataFromNet(dataIndex, pageIndex, page.size, function(pageData){
					//联网成功的回调,隐藏下拉刷新和上拉加载的状态;
					//mescroll会根据传的参数,自动判断列表如果无任何数据,则提示空;列表无下一页数据,则提示无更多数据;
					//console.log("dataIndex="+dataIndex+", curNavIndex="+curNavIndex+", pageIndex="+pageIndex+", page.size="+page.size+", pageData.length="+pageData.length);
					mescroll.endSuccess(pageData.length);

					//设置列表数据
					setListData(pageData,dataIndex);
				}, function(){
					//联网失败的回调,隐藏下拉刷新和上拉加载的状态;
	                mescroll.endErr();
				});
			}

			/*联网加载列表数据*/
			function getListDataFromNet(curNavIndex,pageNum,pageSize,successCallback,errorCallback) {
	        	$.ajax({
	                type: 'POST',
	                url: '<?php echo U('About/ajax_order_list');?>',
					data:{
						start:pageNum,
						limit:pageSize,
						status:curNavIndex
					},
	                dataType: 'json',
	                success: function(data){
				    	console.log(data)
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

			/*设置列表数据
			 * pageData 当前页的数据
			 * dataIndex 数据属于哪个nav */
			function setListData(pageData,dataIndex){
				var listDom=$("#dataList");
				var listArray = [];
				for(var i = 0; i<pageData.length;i++){
					var item = pageData[i];
					var str = '<div class="order-item" data-id="'+item.orderid+'">'+
								'<div class="order-top clearfix">'+
									'<div class="order-shop left">订单时间：'+ getLocalTime(item.create_time)+'</div>'+
									'<div class="order-state right">'+checkStatus(item.status,item.is_trace) +'</div>'+
								'</div>';
					var str2 = '';
					for(var j = 0; j<item.goods_list.length;j++){
						var goodsItem = item.goods_list[j];
						var goodsInfo = item.goods_list[j].info;
						str2 +='<li><div class="order-link clearfix">'+
								'<div class="order-img-wrap left" style="padding: 0;"><img style="width:100%;height:100%;" src="'+goodsInfo.img_url+'"></div>'+
								'<div class="order-title left">'+goodsInfo.goodsname+'</div>'+
								'<div class="order-payInfo right">'+
									'<div class="order-money">积分：'+goodsInfo.integral_pay+'</div>'+
									'<div class="order-num">数量：'+goodsItem.num+'</div>'+
								'</div>'+
								'</div></li>';
					}
					str+='<div class="order-info">'+
						'<ul>'+str2+'</ul></div>'+
						'<div class="order-bottom">'+
							'<span class="order-text">共'+item.goods_list.length+'件商品</span>'+
							'<span class="order-all">合计：<i class="fs-14">'+item.pay_integral+'&nbsp积分</i></span>'+
						'</div>'+
					'<div class="order-btn-wrap">'+isCancel(item.status,item.orderid)+toReceive(item.status,item.orderid,item.is_trace)+toAppraise(item.status,goodsInfo.goodsid,item.orderid)+
						'<a href="<?php echo U('orderEdit');?>/id/'+item.orderid+'" class="order-btn-4">订单详情</a>'+
					'</div></div>';
					listDom.append(str);
				}
			}
			
			//是否显示评价按钮
			function toAppraise(status,goodsid,orderid){
				if(status=="3"){
						return '<a href="javascript:void(0);" class="a-to-appraise click-comment" data-id="'+goodsid+'" data-oid="'+orderid+'">评价</a>'
				}else{
					return ''
				}
			}
			//是否显示确认收货按钮
			function toReceive(status,orderid,is_trace){
				if(status=="2" && is_trace=='2'){
					return '<a href="javascript:;" class="order-btn-4 confirm" data-id="'+orderid+'" >确认收货</a>'
				}else{
					return ''
				}
			}
			//时间转换
			    function getLocalTime(nS) {
					return new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
				}
			//是否显示 取消订单 和 付款 按钮
			function isCancel(status,orderid){
				if(status == "1"){
					return '<a href="javascript:;" data-id="'+orderid+'" class="order-btn-1">取消订单</a>'+
					'<a href="<?php echo U('Order/payType');?>/id/'+orderid+'" class="order-btn-2 pay-order-btn">付款</a>';
				}else{
					return ''
				}
			}
			
			//判断订单状态
			function checkStatus(status,is_trace){
				switch(status){
					case "1":
						return '待支付';
					break;
					case "2":
					    switch(is_trace){
					    	case "1":
								return '已支付(未发货)';
							break;
					    	case "2":
								return '已发货';
							break;
					    }
						
					break;
					case "3":
						return '待评价';
					break;
					case "4":
						return '已完成';
					break;
				}
			}

			//获取连接参数
			function GetQueryString(name) {
			    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
			    var r = window.location.search.substr(1).match(reg);
			    if (r != null) {
			        return unescape(r[2]);
			    }

			    return null;
			}

			//判断tab的渲染项
			function renderTab(tabId){
                for(var j = 0; j < len; j++){
            	    oTab[j].className = "left order-nav"
	            }
	            if(oTab[tabId - 1]){
				    oTab[tabId - 1].className += " active";
	            }
			}
            

            //确认收货
			$(document).on('click','.confirm',function(){
				var orderid=$(this).attr('data-id');
				var url="<?php echo U('order_confirm');?>";
				var query ={};
				query['id']=orderid;
				query['status'] =3;
				$.post(url,query).success(function(res){
					console.log(res)

					if(res.status==1){
						console.log("res.status==1")
						setTimeout(function(){
							window.location.href="<?php echo U('About/order');?>?id=3";
						}, 2000);


					}else{
					    console.log("error")
					    return false;
					}
				})
			})

			$(document).on('click','.order-btn-1',function(){
			var orderid=$(this).attr('data-id');
			var t_this=$(this);
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
					mescroll.resetUpScroll();
					 },1500);
					return false;
				}else{
				popup(res.info);
				return false;
				}
				});
			}else{
				popup("网络错误");
				return false;
			}
				
			})

			//评价按钮
			$(document).on('click','.click-comment',function(){
				var order=$(this).attr('data-oid');
				var goodsid=$(this).attr('data-id');
				window.location.href="<?php echo U('About/comment');?>/orderid/"+order+"/goodsid/"+goodsid; 
			})
			

		})

	</script>
</body>
</html>