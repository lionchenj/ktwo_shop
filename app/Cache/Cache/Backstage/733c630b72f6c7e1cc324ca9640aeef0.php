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
.classifyContainer {
    background-color: #fff;
    border: 1px solid #e6e6e6;
    color: #848484;
    font-size: 14px;
    padding: 6px 20px;
}
.classifyContainer dl {
    border-bottom: 1px dashed #dcdcdc;
    height: 36px;
    line-height: 36px;
    overflow: hidden;
    width: 100%;
}
.classifyContainer dt, .classifyContainer .keyword {
    float: left;
    padding-right: 8px;
    text-align: right;
    width: 70px;
}
.classifyContainer dd {
    cursor: pointer;
    float: left;
    margin-right: 12px;
}
.classifyContainer dd span {
    padding: 2px 6px;
}
.classifyContainer .active, classifyContainer dd span:hover {
    background-color: #3d9fe1;
    border-radius: 4px;
    color: #fff;
}
.classifyContainer > div {
    height: 46px;
    line-height: 46px;
}
</style>
<div id="content">
 <div id="content-header">
    <div id="breadcrumb"> <a href="/zhouzf/www/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/zhouzf/www/tcm/goods.html" class="current">商品列表</a> </div>
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
								<form action="<?php echo U('index');?>" method="get" class="form-horizontal select-form">
									<div class="control-group">
										<label class="control-label">商品名称:</label>
										<div class="controls"><input name="goodsname" type="text" class="span3" placeholder="商品名称(模糊查找)" value="<?php echo ($_GET['username']?$_GET['username']:''); ?>"/> </div>
									</div>
                       
									<div class="control-group" id="classify">
										<label class="control-label">选择分类:</label>
										<div class="controls ">
											<div class="classifyContainer">
											<?php if(is_array($classify)): foreach($classify as $key=>$list): ?><dl>
													<dt data-id="<?php echo ($list["id"]); ?>"><?php echo ($list["title"]); ?></dt>
													<?php if(!empty($list['_'])): if(is_array($list['_'])): foreach($list['_'] as $key_2=>$list_): ?><dd>
														<span class="<?php if(($key_2) == "0"): ?>active<?php endif; ?> <?php if(!empty($list_['_'])): ?>data-tab<?php endif; ?>" data-id="<?php echo ($list_["id"]); ?>"><?php echo ($list_["title"]); ?></span>
													</dd><?php endforeach; endif; endif; ?>
													
												</dl>
												<?php if(!empty($list['_'])): if(is_array($list['_'])): foreach($list['_'] as $key=>$list_): if(!empty($list_['_'])): ?><dl class="class-tab class-<?php echo ($list_["id"]); ?> hide" style="height: auto; line-height: 30px">
														<dt style="min-height: 63px;"></dt>
															<?php if(is_array($list_['_'])): foreach($list_['_'] as $key=>$list__): ?><dd>
																<span data-id="<?php echo ($list__["id"]); ?>"><?php echo ($list__["title"]); ?></span>
															</dd><?php endforeach; endif; ?>
														</dl><?php endif; endforeach; endif; endif; endforeach; endif; ?>	
												
											</div>
												
									</div>
									</div>
									<div class="control-group">
										<label class="control-label">状态</label>
										<div class="controls">
										<?php if(empty($_GET['status'])): ?><label><input type="checkbox" name="status1" value="-1"/>无效商品</label>
											<label><input type="checkbox" name="status3" checked="checked" value="2"/>未上架</label>
											<label><input type="checkbox" name="status4" checked="checked" value="3"/>已上架</label>
										<?php else: ?>
				
										<?php if(in_array(-1,$status)): ?><label><input type="checkbox" name="status1" checked="checked" value="-1"/>无效商品</label>
										<?php else: ?>
										<label><input type="checkbox" name="status1" value="-1"/>无效商品</label><?php endif; ?>
					
										<?php if(in_array(2,$status)): ?><label><input type="checkbox" name="status3" checked="checked" value="2"/>未上架</label>
										<?php else: ?>
										<label><input type="checkbox" name="status3" value="2"/>未上架</label><?php endif; ?>
										<?php if(in_array(3,$status)): ?><label><input type="checkbox" name="status4" checked="checked" value="3"/>已上架</label>
										<?php else: ?>
										<label><input type="checkbox" name="status4" value="3"/>已上架</label><?php endif; endif; ?>
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
            <h5>商品列表</h5>
            <span class="label label-info <?php if(($select_status) != "1"): ?>click-show<?php else: ?>click-hide<?php endif; ?>"><?php if(($select_status) != "1"): ?><i class="icon-search"></i>高级检索<?php else: ?><i class="icon-minus-sign"></i>关闭检索</span><?php endif; ?></span> </div>
          <div class="widget-content">
		  <form name="myform" id="myform" method="post">
		  <span class="btn ajax-post confirm" url="<?php echo U('goods_status');?>" target-form="ids" style="padding:8px 12px;color:#333;background-color:#fff;border: 1px solid #ddd;"> <i class="icon-trash"></i> 批量删除</span>
		   <span class="btn" onclick=" window.location.href='<?php echo U('add');?>'" style="padding:8px 12px;color:#333;background-color:#fff;border: 1px solid #ddd;"> <i class="icon-plus"></i> 新增商品</span>
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                  <th>商品id</th>
                  <th>商品名</th>
				  <th>积分价格</th>
				  <th>创建时间</th>
				  <th>是否推荐</th>
				  <th>状态</th>
				  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                <tr>
				<?php if(is_array($_list)): foreach($_list as $key=>$vo): ?><td><input type="checkbox" class="ids" name="id[]" value="<?php echo ($vo["goodsid"]); ?>"  /></td>
                  <td><?php echo ($vo["goodsid"]); ?></td>
                  <td><?php echo ($vo["goodsname"]); ?></td>
                  <td><?php echo ($vo["integral_pay"]); ?></td>
				  <td><?php echo (time_format($vo["create_time"],'Y-m-d H:i:s')); ?></td>
				  <td style="text-align:center;">
					<?php if(($vo["recommend"]) == "0"): ?><a class="btn btn-mini ajax-get" href="<?php echo U('recommend',array('id'=>$vo['goodsid'],'status'=>1));?>">荐</a><?php endif; ?>
					<?php if(($vo["recommend"]) == "1"): ?><a class="btn btn-danger btn-mini ajax-get" href="<?php echo U('recommend',array('id'=>$vo['goodsid'],'status'=>0));?>">荐</a><?php endif; ?>
				  </td>
				  <td>
					<?php if(($vo["status"]) == "-1"): ?>无效商品<?php endif; ?>
					<?php if(($vo["status"]) == "2"): ?>未上架<?php endif; ?>
					<?php if(($vo["status"]) == "3"): ?>已上架<?php endif; ?>
				  </td>
				    <td>
					<span class="fr">
					<a class="btn btn-info btn-mini" href="<?php echo U('review/index',array('id'=>$vo['goodsid']));?>">评论</a>
					<a class="btn btn-primary btn-mini" href="<?php echo U('edit',array('id'=>$vo['goodsid']));?>">详情</a>
					<?php if(($vo["status"]) != "-1"): if(($vo["status"]) == "3"): ?><a class="btn btn-danger btn-mini confirm ajax-get" href="<?php echo U('goods_status',array('id'=>$vo['goodsid'],'status'=>2));?>">商品下架</a><?php endif; ?>
					<?php if(($vo["status"]) == "2"): ?><a class="btn btn-success btn-mini confirm ajax-get" href="<?php echo U('goods_status',array('id'=>$vo['goodsid'],'status'=>3));?>">商品上架</a><?php endif; ?>
					<a class="btn btn-danger btn-mini confirm ajax-get" href="<?php echo U('goods_status',array('id'=>$vo['goodsid'],'status'=>-1));?>">删除商品</a><?php endif; ?>
					</span>
					</td>
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
$(document).ready(function(){
	var classid='<?php echo ($_GET['classid']); ?>';
	classid=classid.split(",");
	if(classid!=''){
		$(".classifyContainer dl dd span").each(function(i){
				var data=$(this).attr('data-id');
					if($.inArray(data,classid)>=0){
					$(this).click();
					}				
		})
		}
})
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
$("#nickname .dropdown-menu li a").click(function(){
	var userid=$(this).attr('data-id');
	var nickname=$(this).html();
	$("input[name='userid']").val(userid);
	$(this).parent().parent().siblings('.nickname').html(nickname);

})
$(".classifyContainer dl dd span").click(function(){
	$(this).parent().parent().find('span').removeClass('active');
	$(this).addClass('active');
	if($(this).hasClass('data-tab')){
	var data=$(this).attr('data-id');
		if(data){
			$(".class-tab").hide();
			$(".class-tab dd span").removeClass('active');
			$(".class-"+data).show();
		}
		}
})
$(".classifyContainer dl dd span").each(function(i){
	if($(this).hasClass('active')){
		var data=$(this).attr('data-id');
		if(data){
			$(".class-tab").hide();
			$(".class-"+data).show();
		}
	}
})
$(".select-form").submit(function(){
	var goodsname=$("input[name='goodsname']").val();
	var status1=$("input[name='status1']").is(':checked');
	var status2=$("input[name='status2']").is(':checked');
	var status3=$("input[name='status3']").is(':checked');
	var status4=$("input[name='status4']").is(':checked');
	var status4=$("input[name='status4']").is(':checked');
	var starttime=$("input[name='starttime']").val();
	var endtime=$("input[name='endtime']").val();
	var status='';
	var b="";
	if(status1){
		status+=-1+",";
	}
	if(status2){
		status+=1+",";
	}
	if(status3){
		status+=2+",";
	}
	if(status4){
		status+=3+",";
	}
	if(status!=''){
	status=status.substring(0,status.length-1);
	
		b+="/status/"+status;
	}
	if(goodsname.length>0){
			b+="/goodsname/"+goodsname;
	}
		var classid='';
		$("#classify .classifyContainer dl dd span").each(function(i){
		
		if($(this).hasClass('active')){
		var data=$(this).attr('data-id');
			if(data>0){
			classid+=data+",";
			}
		}
		})
		if(classid!=''){
		classid=classid.substring(0,classid.length-1);
		b+="/classid/"+classid;
		}
		
	if(starttime.length>0){
			b+="/starttime/"+starttime;
	}
	if(endtime.length>0){
			b+="/endtime/"+endtime;
	}
	var url='<?php echo U("indexabc");?>';
		url=url.replace('abc',b);
                window.location.href=url;
                return false;
	
return false;
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