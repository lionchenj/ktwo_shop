<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo C('WEB_SITE_TITLE');?></title><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/bootstrap.min.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/fullcalendar.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/maruti-style.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/maruti-media.css" class="skin-color" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/maruti-popup.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/uniform.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/select2.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/colorpicker.css" />
   <link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/datepicker.css" />
</head>
<body>
<!--Header-part-->
<section name="top">
	<div id="header">
	  <h1><a href="/">锦丰商城后台管理系统</a></h1>
	</div>
	<!--close-Header-part--> 

	<!--top-Header-messaages-->
	<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
	<!--close-top-Header-messaages--> 

	<!--top-Header-menu-->
	<div id="user-nav" class="navbar navbar-inverse">
	  <ul class="nav">
		<li class="" ><a title="" href="/zhouzf/www/tcm/about.html"><i class="icon icon-user"></i> <span class="text"><?php echo get_nickname();?></span></a></li>
		<?php $_head_set_auth=$__controller__->checkAuth(MODULE_NAME.'/Constant/index'); ?>
		<?php if(($_head_set_auth) == "1"): ?><li class=""><a title="" href="/zhouzf/www/tcm/constant.html"><i class="icon icon-cog"></i> <span class="text">设置</span></a></li><?php endif; ?>
		<li class=""><a id="outlogin" href="javascript:;" url="/zhouzf/www/tcm/outlogin.html"><i class="icon icon-share-alt"></i> <span class="text">退出登录</span></a></li>
	  </ul>
	</div>
	<div id="search">
	  <input type="text" placeholder="快速搜索"/>
	  <button type="submit" class="tip-left" title="搜索"><i class="icon-search icon-white"></i></button>
	</div>
	<!--close-top-Header-menu-->
</section>	
<section name="menu">
<?php $__base_menu__ = $__controller__->getMenus(); ?>
<div id="sidebar"><a href="/zhouzf/www/tcm/index.html" class="visible-phone"><i class="icon icon-home"></i> 首页</a>
  <ul>
	<?php if(is_array($__base_menu__)): foreach($__base_menu__ as $key=>$menu): ?><li><a href="/zhouzf/www/tcm/<?php echo ($menu["tip"]); ?>"><i class="icon <?php echo ($menu["icon"]); ?>"></i> <span><?php echo ($menu["title"]); ?></span></a></li><?php endforeach; endif; ?>
  </ul>
</div>
</section>
</head>
<body>
	
	<!---->
	<!-- 主体 -->
	   
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>首页</a></div>
  </div>
  <?php if(!empty($twoMenu)): ?><div  class="quick-actions_homepage">
		<ul class="quick-actions">
			<?php if(is_array($twoMenu)): foreach($twoMenu as $key=>$two_menu): ?><li> <a href="/zhouzf/www/tcm/<?php echo ($two_menu["tip"]); ?>"> <i class="<?php echo ($two_menu["icon"]); ?>"></i><?php echo ($two_menu["title"]); ?></a> </li><?php endforeach; endif; ?>
		</ul>
	  </div><?php endif; ?>
 
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12"> 
        <div class="widget-box">
          <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span>
            <h5>今日数据</h5>
            <div class="buttons"><a href="javascript:;" id="chart_update" class="btn btn-mini"><i class="icon-refresh"></i> 刷新</a></div>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span12">
                <div class="chart"></div>
              </div>
            </div></div></div>
      </div>
    </div> 
  </div>
   <div class="row-fluid">
					<div class="span12">
						<div class="widget-box widget-plain">
							<div class="center">
								 <ul class="stat-boxes stat-boxes2">
      <li>
        <div class="left peity_bar_good"><span>2,4,9,7,12,10,12</span></div>
        <div class="right"> <strong><?php echo ($order_num); ?></strong> 下单量 </div>
      </li>
      <li>
        <div class="left peity_bar_neutral"><span>20,15,18,14,10,9,9,9</span></div>
        <div class="right"> <strong><?php echo ($order_true_num); ?></strong> 成交量 </div>
      </li>
      <li>
        <div class="left peity_bar_bad" ><span>3,5,9,7,12,20,10</span></div>
        <div class="right" style="width:150px"> <strong><?php echo ($order_true_money); ?></strong> 交易积分额 </div>
      </li>
    </ul>
							</div>
						</div>
					</div>
	</div>
</div>
<script src="/zhouzf/www/tcm/template/Maruti/js/excanvas.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.ui.custom.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.flot.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.flot.resize.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.peity.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/fullcalendar.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.dashboard.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.popup.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
var data=<?php echo ($data); ?>;
var order=[];  var num=[];
 for (var i = 0; i <= 24;i +=1) {
        num.push([i, data['num'][i]]);
        order.push([i, data['order'][i]]);
    }
index_charts(order,num,{ min: 0, max: 100 });	
})
$("#chart_update").click(function(){
	var url="/zhouzf/www/tcm/index.html";
	 $.post(url,{type:"char"}).success(function(data){
		var order=[]; var vip=[]; var num=[];
		 for (var i = 0; i <= 24;i +=1) {
				num.push([i, data['num'][i]]);
				order.push([i, data['order'][i]]);
			}
		index_charts(order,num,{ min: -0, max: 2000 });	
	 })
	
})
$("#order_update").click(function(){
	var url="/zhouzf/www/tcm/index.html";
	 $.post(url,{type:"order"}).success(function(data){
		var order='';
		 for (var i = 0; i <data.length; i++) {
			order += '<div class="new-update clearfix"> <i class="icon-gift"></i> <span class="update-notice"> <a title="" href="orderedit/'+data[i]['orderid']+'.html"><strong>'+data[i].title+'</strong></a> <span>By:'+data[i].create_time+'</span> </span> <span class="update-date"><span class="update-day">'+data[i].num+'</span>手</span> </div>';
			}
		$('#order_box').html(order);
	 })
	
})
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>


	
	<!-- /主体 -->

	<!-- 底部 -->
	<section name="footer">
	<div class="row-fluid">
		  <div id="footer" class="span12"> 2017 &copy; 锦丰商城后台管理系统  ——广州群智提供技术支持</div>
	</div>
</section>	
<section name="popup">
	<div class="popup"></div>
	<div id="popbox">
			<form action="javasrcipt" class="form-vertical">
			<p class="normal_text">温馨提示</p>

			<div class="controls">
			</div>

			<div class="form-actions">
			<span class="pull-right"><input type="botton" onclick="center_out();" class="btn btn-info" value="确认" /></span>
			</div>
			</form>
	</div>
</section>	
</body>
</html>
	<!-- /底部 -->
</body>
</html>