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
	   
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/tcm/member.html" class="current">会员列表</a> </div>
	<?php if(!empty($twoMenu)): ?><div  class="quick-actions_homepage">
		<ul class="quick-actions">
			<?php if(is_array($twoMenu)): foreach($twoMenu as $key=>$two_menu): ?><li> <a href="/tcm/<?php echo ($two_menu["tip"]); ?>"> <i class="<?php echo ($two_menu["icon"]); ?>"></i><?php echo ($two_menu["title"]); ?></a> </li><?php endforeach; endif; ?>
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
										<label class="control-label">昵称:</label>
										<div class="controls"><input name="nickname" type="text" class="span3" placeholder="昵称(模糊查找)" value="<?php echo ($_GET['nickname']?$_GET['nickname']:''); ?>"/> </div>
									</div>
									<div class="control-group">
										<label class="control-label">会员手机号:</label>
										<div class="controls"><input name="mobile" type="text" class="span3" placeholder="会员手机号(精确查找)" value="<?php echo ($_GET['mobile']?$_GET['mobile']:''); ?>"/> </div>
									</div>
									
                                    <div class="control-group">
										<label class="control-label">性别</label>
										<div class="controls">
											<?php if(empty($_GET['sex'])): ?><label><input type="checkbox" name="sex[]" checked="checked" value="2"/>女士</label>
											<label><input type="checkbox" name="sex[]" checked="checked" value="1"/>先生</label>
											<label><input type="checkbox" name="sex[]" checked="checked" value="0"/>保密</label>
										<?php else: ?>
				
										<?php if(in_array(2,$sex)): ?><label><input type="checkbox" name="sex[]" checked="checked" value="2"/>女士</label>
										<?php else: ?>
										<label><input type="checkbox" name="sex[]" value="2"/>女士</label><?php endif; ?>
										<?php if(in_array(1,$sex)): ?><label><input type="checkbox" name="sex[]" checked="checked" value="1"/>先生</label>
										<?php else: ?>
										<label><input type="checkbox" name="sex[]" value="1"/>先生</label><?php endif; ?>
										<?php if(in_array(0,$sex)): ?><label><input type="checkbox" name="sex[]" checked="checked" value="0"/>保密</label>
										<?php else: ?>
										<label><input type="checkbox" name="sex[]" value="0"/>保密</label><?php endif; endif; ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">状态</label>
										<div class="controls">
										<?php if(empty($_GET['status'])): ?><label><input type="checkbox" name="status[]" checked="checked" value="1"/>正常</label>
											<label><input type="checkbox" name="status[]" checked="checked" value="-1"/>禁用</label>
										<?php else: ?>
				
										<?php if(in_array(1,$status)): ?><label><input type="checkbox" name="status[]" checked="checked" value="1"/>正常</label>
										<?php else: ?>
										<label><input type="checkbox" name="status[]" value="1"/>正常</label><?php endif; ?>
										<?php if(in_array(-1,$status)): ?><label><input type="checkbox" name="status[]" checked="checked" value="-1"/>禁用</label>
										<?php else: ?>
										<label><input type="checkbox" name="status[]" value="-1"/>禁用</label><?php endif; endif; ?>
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
            <h5>会员列表</h5>
			
            <span class="label label-info <?php if(($select_status) != "1"): ?>click-show<?php else: ?>click-hide<?php endif; ?>"><?php if(($select_status) != "1"): ?><i class="icon-search"></i>高级检索<?php else: ?><i class="icon-minus-sign"></i>关闭检索</span><?php endif; ?></span> </div>
          <div class="widget-content">
		  <form name="myform" id="myform" method="post">
			<?php if(($_Auth) == "1"): ?><span class="btn" url="<?php echo U('operate',array('type'=>'add'));?>" onclick="window.location.href='<?php echo U('operate',array('type'=>'add'));?>'" style="padding:8px 12px;color:#333;background-color:#fff;border: 1px solid #ddd;"> <i class="icon-plus"></i> 新建会员</span>
			<span class="btn ajax-post confirm" url="<?php echo U('operate');?>" target-form="ids" style="padding:8px 12px;color:#333;background-color:#fff;border: 1px solid #ddd;"> <i class="icon-trash"></i> 批量禁用</span>
			<span class="btn" onclick='window.location.href="<?php echo U('operate',array('type'=>'download'));?>"' target-form="ids" style="padding:8px 12px;color:#333;background-color:#fff;border: 1px solid #ddd;"> <i class="icon-circle-arrow-down"></i> 数据下载</span><?php endif; ?>
			<table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
				  <th>头像</th>
				  <th>会员昵称</th>
				  <th>会员手机号</th>
				  <th>所在城市</th>
				  <th>性别</th>
				  <th>创建时间</th>
				  <th>状态</th>
				  <?php if(($_Auth) == "1"): ?><th>操作</th><?php endif; ?>
                </tr>
              </thead>
              <tbody>
                <tr>
				<div style="display:none"><input  type="checkbox" class="ids" name="type" value="status" checked="checked" /></div>
				<?php if(is_array($_list)): foreach($_list as $key=>$vo): ?><td align="center" valign="middle"><input type="checkbox" class="ids" name="id[]" value="<?php echo ($vo["userid"]); ?>"  /></td>
				  <td align="center" valign="middle"><img  width="50px"src="<?php echo ($vo["headimgurl"]); ?>"></td>
				  <td align="center" valign="middle"><?php echo ($vo["nickname"]); ?></td>
				  <td align="center" valign="middle"><?php echo ($vo["mobile"]); ?></td>
                  <td align="center" valign="middle"><?php echo ($vo["city"]); ?></td>
				  <td>
					<?php if(($vo["sex"]) == "0"): ?>保密<?php endif; ?>
					<?php if(($vo["sex"]) == "1"): ?>先生<?php endif; ?>
					<?php if(($vo["sex"]) == "2"): ?>女士<?php endif; ?>
				  </td>
				  <td align="center" valign="middle"><?php echo (time_format($vo["create_time"],'Y-m-d H:i:s')); ?></td>
				  <td>
					<?php if(($vo["status"]) == "-1"): ?>禁用<?php endif; ?>
					<?php if(($vo["status"]) == "1"): ?>正常<?php endif; ?>
				  </td>
				  <?php if(($_Auth) == "1"): ?><td>
					<span class="fr">
					<a class="btn btn-primary btn-mini" href="<?php echo U('operate',array('type'=>'edit','id'=>$vo['userid']));?>">详情</a>
					<?php if(($vo["status"]) == "1"): ?><a class="btn btn-danger btn-mini confirm ajax-get" href="<?php echo U('operate',array('type'=>'status','id'=>$vo['userid'],'status'=>-1));?>">禁用</a>
					<?php else: ?>
					<a class="btn btn-success btn-mini confirm ajax-get" href="<?php echo U('operate',array('type'=>'status','id'=>$vo['userid'],'status'=>1));?>">启用</a><?php endif; ?>
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

<script src="/tcm/template/Maruti/js/jquery.min.js"></script> 
<script src="/tcm/template/Maruti/js/jquery.ui.custom.js"></script> 
<script src="/tcm/template/Maruti/js/bootstrap.min.js"></script> 
<script src="/tcm/template/Maruti/js/select2.min.js"></script> 
 <script src="/tcm/template/Maruti/js/bootstrap-datepicker.js"></script>
 <script src="/tcm/template/Maruti/js/bootstrap-colorpicker.js"></script>
<script src="/tcm/template/Maruti/js/jquery.dataTables.min.js"></script> 
 <script src="/tcm/template/Maruti/js/jquery.uniform.js"></script>
<script src="/tcm/template/Maruti/js/maruti.js"></script> 
<script src="/tcm/template/Maruti/js/maruti.tables.js"></script>
 <script src="/tcm/template/Maruti/js/maruti.form_common.js"></script>
<script src="/tcm/template/Maruti/js/maruti.popup.js"></script>
<script src="/tcm/template/Maruti/js/maruti.ajax.js"></script>
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