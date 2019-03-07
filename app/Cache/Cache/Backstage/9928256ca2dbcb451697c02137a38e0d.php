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
    <div id="breadcrumb"> <a href="/zhouzf/www/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/zhouzf/www/tcm/order.html" class="current">线上订单列表</a> </div>
	<?php if(!empty($twoMenu)): ?><div  class="quick-actions_homepage">
		<ul class="quick-actions">
			<?php if(is_array($twoMenu)): foreach($twoMenu as $key=>$two_menu): ?><li> <a href="/zhouzf/www/tcm/<?php echo ($two_menu["tip"]); ?>"> <i class="<?php echo ($two_menu["icon"]); ?>"></i><?php echo ($two_menu["title"]); ?></a> </li><?php endforeach; endif; ?>
		</ul>
	  </div>
	<?php else: ?>
	 <h1><?php echo ($two_title); ?></h1><?php endif; ?>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map" <?php if(($select_status) != "1"): ?>style="display:none"<?php endif; ?>>
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>高级检索</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="<?php echo U('index');?>" method="get" class="form-horizontal">
									<div class="control-group">
										<label class="control-label">订单号:</label>
										<div class="controls"><input name="orderid" type="text" class="span3" placeholder="订单号" value="<?php echo ($_GET['orderid']?$_GET['orderid']:''); ?>"/> </div>
									</div>
									<div class="control-group">
										<label class="control-label">手机号码:</label>
										<div class="controls"><input name="mobile" type="text" class="span3" placeholder="手机号码" value="<?php echo ($_GET['mobile']?$_GET['mobile']:''); ?>"/> </div>
									</div>
<!--                                     <div class="control-group">
										<label class="control-label">商品名称</label>
										<div class="controls " id="goodsname">
											<div class="btn-group">
												<input type="text" name="goodsid" style="display:none" value="<?php echo ($_GET['goodsid']?$_GET['goodsid']:0); ?>"/>
												<button type="button" class="btn goodsname" onclick="javascript:;"><?php if(empty($_GET['goodsid'])): ?>不限<?php else: echo (get_goods_goodsname($_GET['goodsid'])); endif; ?></button>
												<button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
												<ul class="dropdown-menu">
												<li>
												<a href="javascript:;" data-id="0">不限</a></li>
												<?php if(is_array($select_goods)): foreach($select_goods as $key=>$vo): ?><li><a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?>
												</ul>
											</div>
										</div>
									</div> -->
                                    <div class="control-group">
										<label class="control-label">积分区间</label>
										<div class="controls">
											<label><input type="radio" name="money"  value="1" <?php if(($_GET['money']) == "1"): ?>checked=checked<?php endif; ?> />< 500</label>
											<label><input type="radio" name="money" value="2" <?php if(($_GET['money']) == "2"): ?>checked=checked<?php endif; ?> />500 ~ 3000</label>
											<label><input type="radio" name="money"  value="3" <?php if(($_GET['money']) == "3"): ?>checked=checked<?php endif; ?> />>3000</label>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label">订单状态</label>
										<div class="controls">
										<?php if(empty($_GET['status'])): ?><label><input type="checkbox" name="status[]"  value="1"/>未支付</label>
											<label><input type="checkbox" name="status[]" value="2"/>已支付</label>
											<label><input type="checkbox" name="status[]"  value="3"/>待评价</label>
											<label><input type="checkbox" name="status[]"  value="4"/>已完成</label>
										<?php else: ?>
										<?php if(in_array(1,$status)): ?><label><input type="checkbox" name="status[]" checked="checked" value="1"/>未支付</label>
										<?php else: ?>
											<label><input type="checkbox" name="status[]" value="1"/>未支付</label><?php endif; ?>
										<?php if(in_array(2,$status)): ?><label><input type="checkbox" name="status[]" checked="checked" value="2"/>已支付</label>
										<?php else: ?>
										<label><input type="checkbox" name="status[]" value="2"/>已支付</label><?php endif; ?>
										<?php if(in_array(3,$status)): ?><label><input type="checkbox" name="status[]" checked="checked" value="3"/>待评价</label>
										<?php else: ?>
										<label><input type="checkbox" name="status[]" value="3"/>待评价</label><?php endif; ?>
										<?php if(in_array(4,$status)): ?><label><input type="checkbox" name="status[]" checked="checked" value="4"/>已完成</label>
										<?php else: ?>
										<label><input type="checkbox" name="status[]" value="4"/>已完成</label><?php endif; endif; ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">物流状态</label>
										<div class="controls"><!-- <input name="orderid" type="text" class="span3" placeholder="订单号" value="<?php echo ($_GET['orderid']?$_GET['orderid']:''); ?>"/>  -->
								            <select  name="trace" class="form-control" size="0.5">
								            	   <option size='2' value="0" >请选择</option>
                                                   <option size='2' value="1" <?php if($_GET['trace'] == 1): ?>selected<?php endif; ?> >未发货</option>
                                                   <option size='2' value="2" <?php if($_GET['trace'] == 2): ?>selected<?php endif; ?> >已发货</option>
                                            </select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">快递公司:</label>
										<div class="controls"><!-- <input name="orderid" type="text" class="span3" placeholder="订单号" value="<?php echo ($_GET['orderid']?$_GET['orderid']:''); ?>"/>  -->
								            <select  name="expressid" class="form-control" size="0.5">
								            	<option size='2' value="0" >请选择物流</option>
								            	<?php if(is_array($express)): foreach($express as $key=>$v): if($_GET['expressid'] == $v['id']){ $select = 'selected="selected"'; }else{ $select = ''; } ?>
                                                   <option size='2' value="<?php echo ($v["id"]); ?>" <?php echo $select ?> ><?php echo ($v["expressname"]); ?></option><?php endforeach; endif; ?>
                                            </select>
										</div>
									</div>                              
                                    <div class="control-group">
                                        <label class="control-label">时间区间</label>
                                        <div class="controls">
                                            <input type="text" name="starttime" data-date="<?php echo time_format(null,'Y-m-d');?>" data-date-format="yyyy-mm-dd" value="<?php echo ($_GET['starttime']); ?>" placeholder="开始时间 格式YYYY-MM-DD" class="datepicker" /> --
											<input type="text" name="endtime" data-date="<?php echo time_format(null,'Y-m-d');?>" data-date-format="yyyy-mm-dd" value="<?php echo ($_GET['endtime']); ?>" placeholder="结束时间 格式YYYY-MM-DD" class="datepicker" /><span style="margin-left:25px;">(开始时间默认为00:00:00、结束时间默认为23:59:59)</span>
                                        </div>
                                    </div>

									
									
                                    
									<div class="form-actions">
										<button type="submit" class="btn btn-success">立即查询</button>
									</div>
								</form>
							</div>
						</div>						
					</div>
				</div>
                
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>线上订单列表</h5>
            <span class="label label-info <?php if(($select_status) != "1"): ?>click-show<?php else: ?>click-hide<?php endif; ?>"><?php if(($select_status) != "1"): ?><i class="icon-search"></i>高级检索<?php else: ?><i class="icon-minus-sign"></i>关闭检索</span><?php endif; ?></span> </div>
          <div class="widget-content">
		  <form name="myform" id="myform" method="post">
		  <?php if(($_Auth) == "1"): ?><span class="btn ajax-post confirm" url="<?php echo U('operate',array('type'=>'status'));?>" target-form="ids" style="padding:8px 12px;color:#333;background-color:#fff;border: 1px solid #ddd;"> <i class="icon-trash"></i> 批量删除</span>
		<span class="btn" onclick='window.location.href="<?php echo U('operate',array('type'=>'download'));?>"' target-form="ids" style="padding:8px 12px;color:#333;background-color:#fff;border: 1px solid #ddd;"> <i class="icon-circle-arrow-down"></i> 数据下载</span><?php endif; ?>
			<table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                  <th>订单号</th>
                  <th>商品详情</th>
				  <th>买家姓名</th>
				  <th>积分</th>
				  <th>快递公司</th>
				  <th>物流状态</th>
				  <th>下单时间</th>
				  <th>状态</th>
				  <?php if(($_Auth) == "1"): ?><th>操作</th><?php endif; ?>
                </tr>
              </thead>
              <tbody>
                <tr>
				<?php if(is_array($_list)): foreach($_list as $key=>$vo): ?><td><input type="checkbox" class="ids" name="id[]" value="<?php echo ($vo["orderid"]); ?>"  /></td>
                  <td><?php echo ($vo["orderid"]); ?></td>
                  <td><?php echo ($vo["goodsname"]); ?></td>
				  <td><?php echo ($vo["name"]); ?></td>

                  <td><?php echo ($vo["pay_integral"]); ?></td>
                  <td><?php echo ($vo["expressid"]); ?></td>
                  <td>
                  	<?php if(($vo["is_trace"]) == "1"): ?>未发货<?php endif; ?>
					<?php if(($vo["is_trace"]) == "2"): ?>已发货<?php endif; ?>
				 </td>
				  <td><?php echo (time_format($vo["create_time"],'Y-m-d H:i:s')); ?></td>
				  <td>
					<?php if(($vo["status"]) == "1"): ?>待支付<?php endif; ?>
					<?php if(($vo["status"]) == "2"): ?>已支付<?php endif; ?>
					<?php if(($vo["status"]) == "3"): ?>待评价<?php endif; ?>
					<?php if(($vo["status"]) == "4"): ?>已完成<?php endif; ?>
				  </td>
				   <?php if(($_Auth) == "1"): ?><td>
					<span class="fr">
					<a class="btn btn-primary btn-mini" href="<?php echo U('operate',array('id'=>$vo['orderid'],'type'=>'edit'));?>">详情</a>
					<a class="btn btn-danger btn-mini confirm ajax-get" href="<?php echo U('operate',array('id'=>$vo['orderid'],'type'=>'status'));?>">删除</a>
					</span>
					</td><?php endif; ?>
                </tr><?php endforeach; endif; ?>
              </tbody>
            </table>
			</form>
			 <div class="dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_full_numbers">
			<?php echo ($_page); ?>
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
$(document).on('click','.click-show',function(){
$("#select_map").show();
$(this).html('<i class="icon-minus-sign"></i>关闭检索</span>');
$(this).addClass('click-hide');
$(this).removeClass('click-show');	

})
$(document).on('click','.click-hide',function(){
$("#select_map").hide();
$(this).html('<i class="icon-search"></i>高级检索</span> ');
$(this).addClass('click-show');
$(this).removeClass('click-hide');	

})
$("#goodsname .dropdown-menu li a").click(function(){
	var goodsid=$(this).attr('data-id');
	var goodsname=$(this).html();
	$("input[name='goodsid']").val(goodsid);
	$(this).parent().parent().siblings('.goodsname').html(goodsname);

})
$("#nickname .dropdown-menu li a").click(function(){
	var userid=$(this).attr('data-id');
	var nickname=$(this).html();
	$("input[name='userid']").val(userid);
	$(this).parent().parent().siblings('.nickname').html(nickname);

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