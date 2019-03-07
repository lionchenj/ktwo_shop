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
	<title>中医馆商品列表</title>
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/style.css">
	<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Tcm/css/mescroll.min.css">
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/common.js"></script>
	<script type="text/javascript" src="/zhouzf/www/tcm/template/Tcm/js/mescroll.min.js"></script>
</head>
<body>
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		<?php echo ($title); ?>
	</div>
	<div class="shop-goods clearfix mescroll" id="mescroll">
		<div class="mescroll-bounce">
		<?php if(is_array($lists)): foreach($lists as $key=>$vo): ?><div class="goods-item left">
				<a href="<?php echo U('Shop/goods',array('id'=>$vo['goodsid']));?>" class="goods-link">
					<img src="<?php echo ($vo["img_url"]); ?>">
					<div class="item-title">
						<?php echo ($vo["name"]); ?>
					</div>
					<div class="item-money">
						积分：<?php echo ($vo["integral_pay"]); ?>
					</div>
				</a>
				<div class="shop-btn clearfix">
					<a href="javascript:;" class="add-card shop-list-btn left" data-id="<?php echo ($vo["goodsid"]); ?>">加入购物车</a>
					<a href="javascript:;" class="add-order shop-list-btn right   choose" data-id="<?php echo ($_list["goodsid"]); ?>" data-href="<?php echo U('Order/addOrder',array('id'=>$vo['goodsid'].'|'));?>">立即下单</a>
				</div>
			</div><?php endforeach; endif; ?>	
		</div>
	</div>
	<input type="text" name="area" style="display: none" placeholder="请选择" id="area" value="1">

	<div class="fixed-btn fb-1">
		<a href="<?php echo U('order/card');?>">
			<img src="/zhouzf/www/tcm/template/Tcm/images/shopcar-icon.png">
			<div class="fixed-text">
				购物车
			</div>
		</a>
	</div>
<!-- 	<div class="fixed-btn fb-2">
		<a href="tel:85855450">
			<img src="/zhouzf/www/tcm/template/Tcm/images/call-icon.png">
			<div class="fixed-text">
				客服热线
			</div>
		</a>
	</div> -->
	<script type="text/javascript">
		var mescroll = new MeScroll("mescroll", {
			down:{
				use:false//不启用下拉刷新
			},
			up:{
				callback: upCallback //上拉加载的回调
			}
		})
		//上拉加载的回调 page = {num:1, size:10}; num:当前页 默认从1开始, size:每页数据条数,默认10
		function upCallback(page){
			$.ajax({
				url:'',
				success:function(curPageData){
					mescroll.endByPage(curPageData.length, totalPage);
					setListData(curPageData);
				},
				error:function(){
					mescroll.endErr();
				}
			})
		}

		function setListData(curPageData){

		}
		$(".add-card").click(function(){
					var url="<?php echo U('order/addCard');?>";
					var query ={};
					query['id']=$(this).attr('data-id');
					$.post(url,query).success(function(res){
					if(res.status==1){
						 window.location.href="<?php echo U('order/card');?>"; 
						}else{
						popup(res.info);
						}
					});
			
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