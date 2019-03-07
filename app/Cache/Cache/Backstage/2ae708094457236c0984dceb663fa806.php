<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo C('WEB_SITE_TITLE');?></title><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="/tcm/template/Maruti/css/bootstrap.min.css" />
<link rel="stylesheet" href="/tcm/template/Maruti/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="/tcm/template/Maruti/css/fullcalendar.css" />
<link rel="stylesheet" href="/tcm/template/Maruti/css/maruti-style.css" />
<link rel="stylesheet" href="/tcm/template/Maruti/css/maruti-media.css" class="skin-color" />
<link rel="stylesheet" href="/tcm/template/Maruti/css/maruti-popup.css" />
<link rel="stylesheet" href="/tcm/template/Maruti/css/uniform.css" />
<link rel="stylesheet" href="/tcm/template/Maruti/css/select2.css" />
<link rel="stylesheet" href="/tcm/template/Maruti/css/colorpicker.css" />
   <link rel="stylesheet" href="/tcm/template/Maruti/css/datepicker.css" />
</head>
<body>
<!--Header-part-->
<section name="top">
	<div id="header">
	  <h1><a href="/">天辅安中医馆管理系统</a></h1>
	</div>
	<!--close-Header-part--> 

	<!--top-Header-messaages-->
	<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
	<!--close-top-Header-messaages--> 

	<!--top-Header-menu-->
	<div id="user-nav" class="navbar navbar-inverse">
	  <ul class="nav">
		<li class="" ><a title="" href="/tcm/about.html"><i class="icon icon-user"></i> <span class="text"><?php echo get_nickname();?></span></a></li>
		<?php $_head_set_auth=$__controller__->checkAuth(MODULE_NAME.'/Constant/index'); ?>
		<?php if(($_head_set_auth) == "1"): ?><li class=""><a title="" href="/tcm/constant.html"><i class="icon icon-cog"></i> <span class="text">设置</span></a></li><?php endif; ?>
		<li class=""><a id="outlogin" href="javascript:;" url="/tcm/outlogin.html"><i class="icon icon-share-alt"></i> <span class="text">退出登录</span></a></li>
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
<div id="sidebar"><a href="/tcm/index.html" class="visible-phone"><i class="icon icon-home"></i> 首页</a>
  <ul>
	<?php if(is_array($__base_menu__)): foreach($__base_menu__ as $key=>$menu): ?><li><a href="/tcm/<?php echo ($menu["tip"]); ?>"><i class="icon <?php echo ($menu["icon"]); ?>"></i> <span><?php echo ($menu["title"]); ?></span></a></li><?php endforeach; endif; ?>
  </ul>
</div>
</section>
</head>
<body>
	
	<!---->
	<!-- 主体 -->
	   
<style>
.select2-container{
	width:150px;
}
.controls span{
	margin-right:5px;
}
.exuser{
	display:none;
}
</style>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>首页</a></div>
  </div>
  <?php if(!empty($twoMenu)): ?><div  class="quick-actions_homepage">
		<ul class="quick-actions">
			<?php if(is_array($twoMenu)): foreach($twoMenu as $key=>$two_menu): ?><li> <a href="/tcm/<?php echo ($two_menu["tip"]); ?>"> <i class="<?php echo ($two_menu["icon"]); ?>"></i><?php echo ($two_menu["title"]); ?></a> </li><?php endforeach; endif; ?>
		</ul>
	  </div><?php endif; ?>
  <div class="container-fluid">
  <div class="row-fluid" id="select_map">
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
										<label class="control-label">门店名称:</label>
										<div class="controls">
										<select name="cinema" id="cinema">
											<option value ="0">不限</option>
											<?php if(is_array($cinema)): foreach($cinema as $key=>$_cinema): ?><option <?php if(($_cinema["id"]) == $_GET['cinema']): ?>selected="selected"<?php endif; ?> value ="<?php echo ($_cinema["id"]); ?>"><?php echo ($_cinema["name"]); ?></option><?php endforeach; endif; ?>
										</select>
										</div>
									</div>
									<div class="control-group exuser">
										<label class="control-label">核销员:</label>
										<div class="controls">
											<select name="exuser" id="exuser">
											<option value ="0">不限</option>
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
   <div class="row-fluid">
	<div class="chart hide" ></div>
					<div class="span12">
						<div class="widget-box widget-plain">
							<div class="center">
				<ul class="stat-boxes stat-boxes2">
      <li>
        <div class="left peity_bar_good"><span>2,4,9,7,12,10,12</span></div>
        <div class="right"> <strong><?php echo ($consume_num); ?></strong> 核销量 </div>
      </li>
    </ul>
							</div>
						</div>
					</div>
	</div>
  </div>
  
	
				<div class="row-fluid">
					<div class="span4">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-eye-open"></i>
								</span>
								<h5>核销量</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>日期</th>
											<th>数量</th>
										</tr>
									</thead>
									<tbody>
									<?php if(is_array($consume_list)): foreach($consume_list as $key=>$vo1): ?><tr>
											<td><?php echo ($vo1["time"]); ?></td>
											<td><?php echo ($vo1["num"]); ?></td>
										</tr><?php endforeach; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-arrow-right"></i>
								</span>
								<h5>所在门店</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>门店</th>
											<th>数量</th>
										</tr>
									</thead>
									<tbody>
									<?php if(is_array($consume_cinema)): foreach($consume_cinema as $key=>$vo2): ?><tr>
											<td><?php echo (get_cinemaid_cinema($key)); ?></td>
											<td><?php echo ($vo2); ?></td>
										</tr><?php endforeach; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-file"></i>
								</span>
								<h5>中医馆集团</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>集团</th>
											<th>数量</th>
										</tr>
									</thead>
									<tbody>
										<?php if(is_array($consume_group)): foreach($consume_group as $key=>$vo3): ?><tr>
											<td><?php echo (get_group_name($key)); ?></td>
											<td><?php echo ($vo3); ?></td>
										</tr><?php endforeach; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span4">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-arrow-right"></i>
								</span>
								<h5>核销人员</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>昵称</th>
											<th>数量</th>
										</tr>
									</thead>
									<tbody>
									<?php if(is_array($consume_user)): foreach($consume_user as $key=>$vo5): ?><tr>
											<td><?php echo (get_member_nickname($vo5["user"])); ?></td>
											<td><?php echo ($vo5["num"]); ?></td>
										</tr><?php endforeach; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
</div>
<script src="/tcm/template/Maruti/js/excanvas.min.js"></script> 
<script src="/tcm/template/Maruti/js/jquery.min.js"></script> 
<script src="/tcm/template/Maruti/js/jquery.ui.custom.js"></script> 
<script src="/tcm/template/Maruti/js/bootstrap.min.js"></script> 
<script src="/tcm/template/Maruti/js/jquery.flot.min.js"></script> 
<script src="/tcm/template/Maruti/js/jquery.flot.resize.min.js"></script> 

<script src="/tcm/template/Maruti/js/select2.min.js"></script>  
<script src="/tcm/template/Maruti/js/bootstrap-datepicker.js"></script>
<script src="/tcm/template/Maruti/js/bootstrap-colorpicker.js"></script>
<script src="/tcm/template/Maruti/js/maruti.form_common.js"></script>
<script src="/tcm/template/Maruti/js/jquery.dataTables.min.js"></script> 
 <script src="/tcm/template/Maruti/js/jquery.uniform.js"></script>
<script src="/tcm/template/Maruti/js/fullcalendar.min.js"></script> 
<script src="/tcm/template/Maruti/js/maruti.js"></script>
<script src="/tcm/template/Maruti/js/maruti.dashboard_def.js"></script>
<script src="/tcm/template/Maruti/js/maruti.popup.js"></script> 
<script src="/tcm/template/Maruti/js/jquery.peity.min.js"></script>
<script>
$(document).on('change','#cinema',function(){
	cinema_change();
})
cinema_change(1);
function cinema_change(type=0){
var cinema_id=$("#cinema").val();
	var exuser=<?php echo ($exuser); ?>;
	var exuser_def="<?php echo ($_GET['exuser']); ?>";
	if(cinema_id==0){
		$('.exuser').hide();
	}else if(cinema_id>0){
		$('.exuser').show();
		if(type==0){
			$("#s2id_exuser").find('span').html('不限');
		}
		var b='';
			b+='<option value ="0">不限</option>';
		if(exuser[cinema_id]){
			exuser[cinema_id].forEach(function(i,e){
			if(type==1){
			if(exuser_def==i.openid){
				b+='<option selected="selected" value ="'+i.openid+'">'+i.name+'</option>';
			}else{
				b+='<option value ="'+i.openid+'">'+i.name+'</option>';
			}
			}else{
				b+='<option value ="'+i.openid+'">'+i.name+'</option>';
			}
			})
		}
		$('#exuser').html(b);
		
	}
	return false;
}

</script>


	
	<!-- /主体 -->

	<!-- 底部 -->
	<section name="footer">
	<div class="row-fluid">
		  <div id="footer" class="span12"> 2017 &copy; 天辅安中医馆管理系统  ——广州群智提供技术支持</div>
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