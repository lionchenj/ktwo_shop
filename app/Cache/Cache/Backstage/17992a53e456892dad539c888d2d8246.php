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
    <div id="breadcrumb"> <a href="/zhouzf/www/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/zhouzf/www/tcm/integral.html" class="current">积分管理</a> </div>
	<?php if(!empty($twoMenu)): ?><div  class="quick-actions_homepage">
		<ul class="quick-actions">
			<?php if(is_array($twoMenu)): foreach($twoMenu as $key=>$two_menu): ?><li> <a href="/zhouzf/www/tcm/<?php echo ($two_menu["tip"]); ?>"> <i class="<?php echo ($two_menu["icon"]); ?>"></i><?php echo ($two_menu["title"]); ?></a> </li><?php endforeach; endif; ?>
		</ul>
	  </div>
	<?php else: ?>
	 <h1><?php echo ($two_title); ?></h1><?php endif; ?>
  </div>
  <div class="container-fluid">
		 <div class="row-fluid">
					<div class="span12">
						<div class="widget-box widget-plain">
							<div class="center">
								 <ul class="stat-boxes stat-boxes2">
      <li>
        <div class="left peity_bar_good"><span>2,4,9,7,12,10,12</span></div>
        <div class="right">  积分变动 </div>
      </li>
     <!--  <li>
        <div class="left peity_bar_neutral"><span>20,15,18,14,10,9,9,9</span></div>
        <div class="right"> <strong><?php echo ($score_count); ?></strong> 积分人数 </div>
      </li> -->
	  </ul>
							</div>
						</div>
					</div>
	</div>
                
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
								<form action="/zhouzf/www/tcm/integral.html" method="get" class="form-horizontal">
									<div class="control-group">
										<label class="control-label">手机号:</label>
										<div class="controls"><input name="mobile" type="text" class="span3" placeholder="手机号(精确查找)" value="<?php echo ($_GET['mobile']?$_GET['mobile']:''); ?>"/> </div>
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
            <h5>积分记录列表</h5>
            <span class="label label-info <?php if(($select_status) != "1"): ?>click-show<?php else: ?>click-hide<?php endif; ?>"><?php if(($select_status) != "1"): ?><i class="icon-search"></i>高级检索<?php else: ?><i class="icon-minus-sign"></i>关闭检索</span><?php endif; ?></span> </div>
          <div class="widget-content">
		  <form name="myform" id="myform" method="post">
		 
			<table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                  <th>记录时间</th>                 
				  <th>用户手机号码</th>			   
				  <th>改变积分</th>
				  <th>剩余积分</th>
				  <th>说明</th>
                </tr>
              </thead>
              <tbody>
                <tr>
				<?php if(is_array($_list)): foreach($_list as $key=>$vo): ?><td><input type="checkbox" class="ids" name="id[]" value="<?php echo ($vo["id"]); ?>"  /></td>
                  <td><?php echo (time_format($vo["create_time"],'Y-m-d H:i:s')); ?></td>                  
				  <td><?php echo ($vo["mobile"]); ?></td>
			  
				    <td style="color:red">-<?php echo ($vo["score"]); ?></td>
	
				<td><?php echo ($vo["surplus"]); ?></td>
				<td><?php echo ($vo["title"]); ?></td>	 
                </tr><?php endforeach; endif; ?>
              </tbody>
            </table>
			</form>
			<div style="display:none">
										<input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  name="image2" multiple="multiple" style="width:100%;opacity:0;filter:alpha(opacity=0);" id="inputfile"/>
			</div>
			 <div class="dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_full_numbers">
			<?php echo ($_page); ?>
			 </div>
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
<script src="/zhouzf/www/tcm/template/Maruti/js/select2.min.js"></script>  
<script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap-datepicker.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap-colorpicker.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.form_common.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.dataTables.min.js"></script> 
 <script src="/zhouzf/www/tcm/template/Maruti/js/jquery.uniform.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/fullcalendar.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.dashboard1.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.popup.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
var data={"num":{"1":"677","2":"771","3":"356","4":"570","5":"315","6":"640","7":"464","8":"1256","9":"297","10":"1494","11":"301","12":"242","13":"285","14":"873","15":"422","16":"807","17":"521","18":"288","19":"181","20":"304","21":"501","22":"162","23":"195","24":"573","25":"359","26":"501","27":"316","28":"239","29":"256","30":"772","31":"1236"},"order":{"1":24,"2":15,"3":31,"4":58,"5":19,"6":32,"7":17,"8":10,"9":17,"10":40,"11":81,"12":29,"13":36,"14":38,"15":21,"16":11,"17":57,"18":11,"19":17,"20":94,"21":16,"22":15,"23":19,"24":28,"25":16,"26":7,"27":73,"28":15,"29":4,"30":13,"31":17}};
;
var order=[];  var num=[];
 for (var i = 1; i <= 31;i +=1) {
        num.push([i, data['num'][i]]);
        order.push([i, data['order'][i]]);
    }
index_charts(order,num,{ min: 0, max: 2000});	
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
$("#type .dropdown-menu li a").click(function(){
	var typeid=$(this).attr('data-id');
	var type=$(this).html();
	$("input[name='type']").val(typeid);
	$(this).parent().parent().siblings('.type').html(type);
	if(typeid=='0'){
		$('#futures').hide();
		$('#classify').hide();
		$('#shares').hide();
	}else if(typeid=='1'){
		$('#futures').hide();
		$('#classify').show();
		$('#shares').hide();
	}else if(typeid=='2'){
	$('#futures').show();
		$('#classify').hide();
		$('#shares').hide();
	}else if(typeid=='3'){
		$('#futures').hide();
		$('#classify').hide();
		$('#shares').show();
	}

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