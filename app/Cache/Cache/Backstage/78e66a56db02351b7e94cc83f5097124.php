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
    <div id="breadcrumb"> <a href="/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/tcm/order.html" class="current">会员等级列表</a> </div>
	<h1><?php if(empty($data)): ?>新增会员等级<?php else: ?>会员等级详情<?php endif; ?></h1>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5><?php if(empty($data)): ?>新增会员等级<?php else: ?>会员等级详情<?php endif; ?></h5>
							</div>
							<div class="widget-content nopadding">
								<form action="/tcm/Membergrade/operate/type/add.html" method="get" class="myform form-horizontal">									
									<div class="control-group">
										<label class="control-label">等级名:</label>											
										<div class="controls"><input name="name" type="text" class="span3" placeholder="等级名" value="<?php echo ($data["name"]); ?>" />
										<div id="error_name" ><error class="color-red hidden"></error></div>
										</div>
										
									</div>
									<div class="control-group">
										<label class="control-label">条件数值:</label>											
										<div class="controls"><input name="auth_num" type="text" class="span3" placeholder="条件数值" value="<?php echo ($data["auth_num"]); ?>" /> 
										<div id="error_name" ><error class="color-red hidden"></error></div>
										</div>
										
									</div>	
									<div class="control-group">
										<label class="control-label">折扣%:</label>											
										<div class="controls"><input name="discount" type="text" class="span1" placeholder="折扣" value="<?php echo ($data["discount"]); ?>" />%
										<div id="error_name" ><error class="color-red hidden"></error></div>
										</div>
										
									</div>			
									<div class="form-actions">
										<button type="button" id="confirm_submit" class="btn btn-success ajax-post" url="" target-form="myform"><?php if(empty($data)): ?>添加<?php else: ?>保存<?php endif; ?></button>
											<button type="button" class="btn btn-warning"  onclick="window.location.href='/tcm/membergrade.html'">返回</button>
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
$(document).on('blur','input',function(){
  var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	case "name":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入等级名");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#confirm_submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#confirm_submit").attr("disabled",false);
	}
	break;
	case "auth_num":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入条件数值");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#confirm_submit").attr("disabled",true);
			
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#confirm_submit").attr("disabled",false);

	}
	break;
	case "discount":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入折扣");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#confirm_submit").attr("disabled",true);
			
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#confirm_submit").attr("disabled",false);
	}
	break;
	}
})
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
</script>
<script>

		
		$('#confirm_submit').click(function(){
			var name=$('input[name="name"]').val();	
			var stat=1;
				if(name.length==0){
					$("input[name='name']").addClass('redborder');
					$("input[name='name']").siblings('div').find('error').html("<span>*</span>请输入等级名");
					$("input[name='name']").siblings('div').find('error').removeClass('hidden');
					stat=0;
				}
			var auth_num=$('input[name="auth_num"]').val();									
			if(auth_num.length==0){
				$("input[name='auth_num']").addClass('redborder');
				$("input[name='auth_num']").siblings('div').find('error').html("<span>*</span>请输入条件数值");
				$("input[name='auth_num']").siblings('div').find('error').removeClass('hidden');
				stat=0;
			}
			var discount=$('input[name="discount"]').val();									
			if(discount==0){
				$("input[name='discount']").addClass('redborder');
				$("input[name='discount']").siblings('div').find('error').html("<span>*</span>请输入折扣");
				$("input[name='discount']").siblings('div').find('error').removeClass('hidden');
				stat=0;
			}
			if(stat){
				var url='/tcm/Membergrade/operate/type/add.html';		
				var data={};
				data['name']=name;
				data['value']=value;
				data['discount']=discount;
				$.post(url,data).success(function(data){
					if (data.status==1) {
						$('#popbox .controls').html(data['info']);
						center($("#popbox"));
						 setTimeout(function(){
						window.location.href="/tcm/membergrade.html";
						},1500);
					}else{
						$('#popbox .controls').html(data['info']);
						center($("#popbox"));
						return false;
					}
				});
			}							
		})

		function isPhone(phone) { 
			 var pattern = /^1[34578]\d{9}$/; 
			 return pattern.test(phone); 
		}
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