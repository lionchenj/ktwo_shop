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
	<title>商城商品详情</title>
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css">
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/common.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/swiper.min.js"></script>
</head>
<style type="text/css">
/*shop-detail*/
.swiper-container{
	width: 100%;
	height: 100%;
}
.swiper-slide{
	width: 100%;
	height: 0;
	padding-bottom: 100%;
	position: relative;
}
.shop-detail-wrap img{
	position: absolute;
	width: 100%;
	height: 100%;
}
.shop-detail-wrap{
	padding-top: 4.4rem;
}
.shop-detail-sideBtn .fb-1 {
	z-index: 1;
}
.s-detail-3{
	font-size: 1.1rem;
}
</style>
<body>
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		<?php echo ($data["goodsname"]); ?>
	</div>
	<div class="shop-detail-wrap">
		<div class="swiper-container">
		  	<div class="swiper-wrapper">
			<?php if(is_array($data['banner'])): foreach($data['banner'] as $key=>$banner): ?><div class="swiper-slide">
		    		<img src="<?php echo ($banner); ?>">
		    	</div><?php endforeach; endif; ?>	
		  	</div>
		  	<div class="swiper-pagination"></div>
		</div>
	</div>
	<div class="s-detail-info">
		<div class="s-detail-1">积分:<?php echo ($data["integral_pay"]); ?></div>
		<div class="s-detail-2">
			<?php echo ($data["goodsname"]); ?>
		</div>
		<div class="s-detail-3">
			剩余库存<?php echo ($data["inventory"]); ?>
		</div>
		<!-- <?php if(($data['out_type_2']) == "1"): ?><div class="s-detail-3 clearfix">
			<span class="ticket-goods left">兑换券商品</span>
			<span class="s-detail-shop left">
				<i></i><span class="s-shop-str nowrap">（适用门店：<?php echo ($store); ?>）</span><i></i></span>
		</div><?php endif; ?> -->
	</div>
	<!-- <?php if(($data['youhui_num']) > "0"): ?><div class="s-detail-act">
		<div class="act-title">优惠活动(<i class="act-num"><?php echo ($data['youhui_num']); ?></i>)</div>
		<div class="act-t-list clearfix">
			<?php if(is_array($youhui)): foreach($youhui as $key=>$_list): $a=is_get_card($_list['id']) ?>
			<div class="youhui act-item left <?php if(($a) == "1"): ?>active<?php endif; ?>" data-id="<?php echo ($_list["id"]); ?>">
				<div class="act-money">￥<?php echo ($_list["reduce"]); ?></div>
				<div class="act-words">满<?php echo ($_list["least"]); ?>元立减</div>
				 <?php if(($a) == "1"): ?><div class="act-state"></div><?php endif; ?>
			</div><?php endforeach; endif; ?>
		</div>
	</div><?php endif; ?> -->
	<div class="detail-cont shop-detail-cont">
		<div class="detail-nav">
			<div class="detail-nav-item active" id="detail-nav-1">
				图文详情
			</div>
			<div class="detail-nav-item" id="detail-nav-2">
				产品参数
			</div>
			<div class="detail-nav-item" id="detail-nav-3">
				评价
			</div>
		</div>
		<div class="detail-text shop-detail-text">
			<div class="detail-t-1" style="display: block;">
				<?php echo ($data["details"]); ?>
			</div>
			<div class="detail-t-2" style="display: none;">
				<?php echo ($data["parameter"]); ?>
			</div>
			<div class="detail-t-3" style="display: none;">
				<div class="appraise-list">
				<?php if(is_array($comment)): foreach($comment as $key=>$_list): ?><div class="appraise-item clearfix">
						<div class="appraise-head left">
							<img src="<?php echo ($_list["headimgurl"]); ?>">
						</div>
						<div class="appraise-text left">
							<div class="appraise-row clearfix">
								<div class="appraise-name left"><?php echo ($_list["nickname"]); ?></div>
								<div class="appraise-date right"><?php echo (time_format($_list["create_time"],'m月d日')); ?></div>
							</div>
							<div class="appraise-cont"><?php echo ($_list["title"]); ?>
							</div>
						</div>
					</div><?php endforeach; endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="shop-detail-sideBtn">
		<div class="fixed-btn fb-1">
			<a href="<?php echo U('order/card');?>">
				<img src="/zhouzf/www/tcm/template/Tcm/images/shopcar-icon.png">
				<div class="fixed-text">
					购物车
				</div>
			</a>
		</div>
		<!-- <div class="fixed-btn fb-2">
			<a href="tel:85855450">
				<img src="/zhouzf/www/tcm/template/Tcm/images/call-icon.png">
				<div class="fixed-text">
					客服热线
				</div>
			</a>
		</div> -->
		
	</div>
	<div class="fixed-shop-detail">
		<div class="fixed-bottom-1 left">
			<span class="collect-btn <?php if(($collection) == "1"): ?>active<?php endif; ?>"></span>
			<div class="collect-text">收藏</div>
		</div>
		<div class="fixed-bottom-2 left">
			<a href="javascript:void(0);" class="add-card inline-block" data-id="<?php echo ($data["goodsid"]); ?>">加入购物车</a>
		</div>
		<div class="fixed-bottom-3 left">
			<a href="javascript:;" class="inline-block  choose"  data-href="<?php echo U('Order/addOrder',array('id'=>$data['goodsid'].'|'));?>">立即下单</a>
		</div>
		
	</div>
	<input type="text" name="area" style="display: none" placeholder="请选择" id="area" value="1">

	<div class="tips-box" style="display: none"></div>
	<script type="text/javascript">
		$(function(){
			/*轮播*/
			var mySwiper1 = new Swiper('.swiper-container', {
				loop : true,
				autoplay: {
				    delay: 3000,
				    stopOnLastSlide: false,
				    disableOnInteraction: true,
			    },
				pagination: {
			      el: '.swiper-pagination',
			      clickable :true,
			    },
			})

			/*tab切换*/
			$(".detail-nav-item").on("click",function(){
				$(this).addClass("active").siblings().removeClass("active");
				$(".detail-t-"+this.id.split("-")[2]).show().siblings().hide();
			})

			/*箭头*/
			$(".s-info-arrow").on("click",function(){
				if($(this).hasClass("active")){
					$(this).removeClass("active");
					$(".s-shop-str").addClass("nowrap");
				}else{
					$(this).addClass("active");
					$(".s-shop-str").removeClass("nowrap");
				}
			})

			// /*优惠点击领取*/
			// $(".youhui").click(function(){
			// var uid=<?php echo is_login();?>;
			// 	if(uid<=0){
			// 	popup("请先登录");
			// 	 setTimeout(function(){
			// 	 window.location.href="<?php echo U('Login/index');?>"; 
			// 	 },1500);
			// 	 return false;
			// 	}
			// 	if($(this).hasClass("active")){
			// 		popup("您已领取过")
			// 	}else{
			// 		var cardid=$(this).attr('data-id');
			// 		var url="<?php echo U('About/getyouhui');?>";
			// 		var this_=$(this);
			// 		var query ={};
			// 		query['id']=cardid;
			// 		$.post(url,query).success(function(res){
			// 		if(res.status==1){
			// 			popup("领取成功！");
			// 			this_.addClass("active");
			// 			this_.append('<div class="act-state"></div>');
			// 		}else{
			// 			popup(res.info);
			// 		}
			// 		});
					
			// 	}
			// })

			/*点击收藏*/
			$(".collect-btn").on("click",function(){
				var uid=<?php echo is_login();?>;
				if(uid<=0){
				popup("请先登录");
				 setTimeout(function(){
				 window.location.href="<?php echo U('Login/index');?>"; 
				 },1500);
				 return false;
				}
				var status=0;
				if($(this).hasClass("active")){
					$(this).removeClass("active");
					popup("取消收藏成功！");
					status=-1;
				}else{
					$(this).addClass("active");
					popup("收藏成功！");
					status=1;
				}
					var url="<?php echo U('About/collection');?>";
					var query ={};
					query['goodsid']=<?php echo ($_GET['id']); ?>;
					query['status']=status;
					$.post(url,query).success(function(res){
					return false;
					});
			})
		})
		$(".add-card").click(function(){
					var url="<?php echo U('order/addCard');?>";
					var query ={};
					var actoken = getCookie('access_token');
					console.log(actoken);
					if(!actoken){
						window.location.href = 'https://dev170.weibanker.cn/lvsk/www/jinfeng/';
					}
					query['id']=$(this).attr('data-id');
					$.post(url,query).success(function(res){
					if(res.status==1){
						 window.location.href="<?php echo U('order/card');?>"; 
						}else{
						popup(res.info);
						}
					});
		function getCookie(name) 
			{ 
			    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
			 
			    if(arr=document.cookie.match(reg))
			 
			        return unescape(arr[2]); 
			    else 
			        return null; 
			} 
			
			})
		
	</script>
	<script type="text/javascript">
		var _goods = [
	      {
	        "name": "",
	        "sub": [
	          {
	            "name": "1",
	          },
	          {
	            "name": "2",
	          },
	          {
	            "name": "3",
	          },
	          {
	            "name": "4",
	          },
	          {
	            "name": "5",
	          },
	          {
	            "name": "6",
	          },
	          {
	            "name": "7",
	          },
	          {
	            "name": "8",
	          },
	          {
	            "name": "9",
	          },
	          {
	            "name": "10",
	          },

		    ],
		    "type": 0
		  },
		]
	</script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/picker.min.js"></script>
	<script type="text/javascript">

		var nameEl = document.getElementsByClassName('choose');
		var area = document.getElementById("area");

		var first = []; /* 省，直辖市 */
		var second = []; /* 市 */
		var third = []; /* 区 */

		var selectedIndex = [0, 0, 0]; /* 默认选中的地区 */

		var checked = [0, 0, 0]; /* 已选选项 */

		function creatList(obj, list){
		  obj.forEach(function(item, index, arr){
		  var temp = new Object();
		  temp.text = item.name;
		  temp.value = index;
		  list.push(temp);
		  })
		}

		creatList(_goods, first);

		if (_goods[selectedIndex[0]].hasOwnProperty('sub')) {
		  creatList(_goods[selectedIndex[0]].sub, second);
		} else {
		  second = [{text: '', value: 0}];
		}

		if (_goods[selectedIndex[0]].sub[selectedIndex[1]].hasOwnProperty('sub')) {
		  creatList(_goods[selectedIndex[0]].sub[selectedIndex[1]].sub, third);
		} else {
		  third = [{text: '', value: 0}];
		}

		var picker = new Picker({
			data: [first, second, third],
		  selectedIndex: selectedIndex,
			title: '选择下单数量'
		});

		picker.on('picker.select', function (selectedVal, selectedIndex) {
		  var text1 = first[selectedIndex[0]].text;
		  var text2 = second[selectedIndex[1]].text;
		  var text3 = third[selectedIndex[2]] ? third[selectedIndex[2]].text : '';
		  var point = text3 ? ',' : '';
			// area.value = text1 +' '+ text2 +' '+ text3;
			area.value =text2;
			window.location.href=tarhref + area.value; 
		});
		console.log(19998)

		picker.on('picker.change', function (index, selectedIndex) {
		  if (index === 0){
		    firstChange();
		  } else if (index === 1) {
		    secondChange();
		  }

		  function firstChange() {
		    second = [];
		    third = [];
		    checked[0] = selectedIndex;
		    var first_goods = _goods[selectedIndex];
		    if (first_goods.hasOwnProperty('sub')) {
		      creatList(first_goods.sub, second);

		      var second_goods = _goods[selectedIndex].sub[0]
		      if (second_goods.hasOwnProperty('sub')) {
		        creatList(second_goods.sub, third);
		      } else {
		        third = [{text: '', value: 0}];
		        checked[2] = 0;
		      }
		    } else {
		      second = [{text: '', value: 0}];
		      third = [{text: '', value: 0}];
		      checked[1] = 0;
		      checked[2] = 0;
		    }

		    picker.refillColumn(1, second);
		    picker.refillColumn(2, third);
		    picker.scrollColumn(1, 0)
		    picker.scrollColumn(2, 0)
		  }

		  function secondChange() {
		    third = [];
		    checked[1] = selectedIndex;
		    var first_index = checked[0];
		    if (_goods[first_index].sub[selectedIndex].hasOwnProperty('sub')) {
		      var second_goods = _goods[first_index].sub[selectedIndex];
		      creatList(second_goods.sub, third);
		      picker.refillColumn(2, third);
		      picker.scrollColumn(2, 0)
		    } else {
		      third = [{text: '', value: 0}];
		      checked[2] = 0;
		      picker.refillColumn(2, third);
		      picker.scrollColumn(2, 0)
		    }
		  }

		});
	    for(var j=0;  j<nameEl.length;j++){
	    	nameEl[j].addEventListener('click', function (e) {
	    	var e = e || window.event,
	        tar = e.target || e.srcElement;
	        tarhref = tar.getAttribute("data-href")
	        console.log(tarhref)
			picker.show();
			// area.value = tarhref
		  });
		}
	</script>
</body>
</html>