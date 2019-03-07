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
	   
<style>
.counter{
    border: medium none;
    height: 27px;
    line-height: 27px;
    outline: medium none;
    padding: 0;
    text-align: center;
    vertical-align: top;
    width: 50px;
}
</style>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/zhouzf/www/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/zhouzf/www/tcm/order.html" class="current">订单列表</a> </div>
	<h1>订单详情</h1>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>订单详情</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="/zhouzf/www/tcm/Order/operate/id/20181226820625/type/edit.html" method="get" class="myform form-horizontal">
									<div class="control-group">
										<label class="control-label">订单号:</label>
											<input type="text" name="orderid" style="display:none" value="<?php echo ($order_info["orderid"]); ?>"/>
										<div class="controls"><input name="orderid" type="text" class="span3" placeholder="订单号" value="<?php echo ($order_info["orderid"]); ?>" disabled /> </div>
									</div>
                                    <div class="control-group">
										<label class="control-label">商品名称</label>
										<div class="controls " >
											
												<input type="text"  class="span3" value="<?php echo ($order_info['goodsname']); ?>" disabled />
			
											
										</div>
									</div>                     
                                    <!-- <div class="control-group">
                                        <label class="control-label">总数</label>
                                        <div class="controls">
										<input type="text" name="num" class="counter int" value="<?php echo ($order_info["num"]); ?>" disabled/>
                                        </div>
                                    </div> -->
									<div class="control-group">
                                        <label class="control-label">支付积分</label>
                                        <div class="controls">
										<input type="text"  name="pay_integral" class="span3" value="<?php echo ($order_info["pay_integral"]); ?> " disabled  >
                                        </div>
                                    </div>
								<!-- 	<div class="control-group">
                                        <label class="control-label">选择城市</label>
                                        <div class="controls">
										<input type="text"  value="<?php echo ($order_info["city"]); ?>" disabled>
                                        </div>
                                    </div> -->
									<div class="control-group">
                                        <label class="control-label">交易时间</label>
                                        <div class="controls">
										<input type="text"  value="<?php echo (time_format($order_info["create_time"],'Y-m-d H:i:s')); ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">快递公司</label>
                                        <div class="controls">
										<input type="text"  value="<?php echo ($expressname); ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">物流号</label>
                                        <div class="controls">
										<input type="text"  name="traces_number" value="<?php echo ($order_info["traces_number"]); ?>">
                                        </div>
                                    </div>
                                    
									<div class="control-group">
                                        <label class="control-label">买家姓名</label>
                                        <div class="controls">
										<input type="text"  name="name" value="<?php echo ($order_info["name"]); ?>">
                                        </div>
                                    </div>
									<div class="control-group">
                                        <label class="control-label">买家联系号码</label>
                                        <div class="controls">
										<input type="text" name="mobile" value="<?php echo ($order_info["mobile"]); ?>" >
                                        </div>
                                    </div>
									<div class="control-group">
										<label class="control-label">订单状态</label>
										<div class="controls">
											<label><input type="radio" name="status"  value="1" disabled <?php if(($order_info['status']) == "1"): ?>checked=checked<?php endif; ?> />未支付</label>
											<label><input type="radio" name="status" value="2" disabled <?php if(($order_info['status']) == "2"): ?>checked=checked<?php endif; ?> />已支付</label>
											<label><input type="radio" name="status"  value="3" disabled <?php if(($order_info['status']) == "3"): ?>checked=checked<?php endif; ?> />待评价</label>
											<label><input type="radio" name="status"  value="4" disabled <?php if(($order_info['status']) == "4"): ?>checked=checked<?php endif; ?> />已完成</label>
											<label><input type="radio" name="status"  value="-1" disabled <?php if(($order_info['status']) == "-1"): ?>checked=checked<?php endif; ?> />无效订单</label>
										</div>
									</div> 
                                    <div class="control-group">
                                        <label class="control-label">物流信息：</label>
                                        <?php if($order_info['is_trace']==1){ ?>
                                        <div class="controls">暂无物流信息</div>
                                        <?php }else{ ?>

                                        
                                        <div class="controls ">
                                        	<?php if($express->State == 0){ ?>
                                        	货物已发出----暂无轨迹信息
                                        	<?php }else{ ?>
                                        	       正式发货</br>
                                                   <?php echo (time_format($order_info["trace_time"],'Y-m-d H:i:s')); ?></br>
	                                        	<?php foreach($express->Traces as $k=>$v){ ?>
	                                        	   
	                                        	           |</br>
	                                        	           |</br>
	                                        	           |</br>
	                                        	   <?php echo ($v->AcceptStation); ?></br>
	                                        	   <?php echo ($v->AcceptTime); ?></br>
	                                        	<?php }?>
	                                        	
                                        	<?php } ?>
                                        </div>
                                        <?php } ?>
                                    </div>

									<div class="form-actions">
										<button type="submit" class="btn btn-success ajax-post" url="" target-form="myform">保存</button>
											<button type="button" class="btn btn-warning"  onclick="window.location.href='<?php if(($change) == "0"): ?>/zhouzf/www/tcm/offlineorder.html<?php else: ?>/zhouzf/www/tcm/order.html<?php endif; ?>'">返回</button>
									</div>
								</form>
							</div>
						</div>						
					</div>
				</div>
       
      </div>
    </div>
  </div>
</div>

<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.ui.custom.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/select2.min.js"></script> 
 <script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap-datepicker.js"></script>
 <script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap-colorpicker.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.dataTables.min.js"></script> 
 <script src="/zhouzf/www/tcm/template/Maruti/js/jquery.uniform.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.tables.js"></script>
 <script src="/zhouzf/www/tcm/template/Maruti/js/maruti.form_common.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.popup.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.ajax.js"></script>
<script>
$("#goodsname .dropdown-menu li a").click(function(){
	var goodsid=$(this).attr('data-id');
	var goodsname=$(this).html();
	$("input[name='goodsid']").val(goodsid);
	$(this).parent().parent().siblings('.goodsname').html(goodsname);

})
//数据格式验证int
$(document).on('change',".int",function(){
	var val=parseInt($(this).val());
	if(isNaN(val) || val==0){
		$(this).val(1);
	}else{
		$(this).val(val);
		}
		change_money();
})
$("#expressid").click(function(){
	$('.express').removeClass('hide');
})

$('.express').click(function(){
	$('.express').addClass('hide');
})

</script>
</body>


	
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