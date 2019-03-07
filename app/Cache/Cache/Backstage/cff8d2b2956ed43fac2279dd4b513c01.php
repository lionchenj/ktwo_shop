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
.select2-container{
	width:150px;
}
.controls span{
	margin-right:5px;
}
.uploader{
display:none;
}
</style>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/tcm/auth.html" class="current">权限管理</a> </div>
	<h1><?php if(!empty($auth)): ?>修改角色<?php else: ?>新建角色<?php endif; ?></h1>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5><?php if(!empty($auth)): ?>修改角色<?php else: ?>新建角色<?php endif; ?></h5>
							</div>
							<div class="widget-content nopadding">
								<form action="/tcm/Auth/operate/type/edit/id/20.html" method="post" class="myform form-horizontal">
									<div class="control-group">
										<label class="control-label">角色名:</label>
										<div class="controls">
											<input  type="text" name="title" class="span2" placeholder="角色名" value="<?php echo ($auth["title"]); ?>"/>
											<div id="error_name" ><error class="color-red hidden"></error></div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">角色说明:</label>
										<div class="controls">
											<input  type="text" name="description" class="span2" placeholder="角色说明" value="<?php echo ($auth["description"]); ?>"/>
											<div id="error_name" ><error class="color-red hidden"></error></div>
										</div>
									</div>
									<div class="form-actions">
										<button id="submit" type="submit" class="btn btn-success"><?php if(!empty($auth)): ?>保存<?php else: ?>创建<?php endif; ?></button>
											<button type="button" class="btn btn-warning"  onclick="window.location.href='/tcm/auth.html'">返回</button>
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
<script src="/tcm/template/Maruti/js/address.js"></script>
<script src="/tcm/template/Maruti/js/jquery.ui.custom.js"></script> 
<script src="/tcm/template/Maruti/js/bootstrap.min.js"></script> 
<script src="/tcm/template/Maruti/js/select2.min.js"></script>
<script src="/tcm/template/Maruti/js/pinyin.js"></script>
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
$("input").blur(function(){
    var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	case "title":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入角色名");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
	case "description":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入角色说明");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
	}
})
</script>
<script>
$(".myform").submit(function(){
	var stat=1;
	var description=$("input[name='description']").val();
	if(description.length==0){
		$("input[name='description']").addClass('redborder');
		$("input[name='description']").siblings('div').find('error').html("<span>*</span>请输入角色说明");
		$("input[name='description']").siblings('div').find('error').removeClass('hidden');
		stat=0;
		}
	var title=$("input[name='title']").val();
	if(title.length==0){
		$("input[name='title']").addClass('redborder');
		$("input[name='title']").siblings('div').find('error').html("<span>*</span>请输入角色名");
		$("input[name='title']").siblings('div').find('error').removeClass('hidden');
		stat=0;
		}
	if(stat==0){
			return false;
	}else{
		var url=$(this).attr('action');
		var query = {};
		query['title']=title;
		query['description']=description;
		$.post(url,query).success(function(data){
				 if (data.status==1) {
					 $('#popbox .controls').html('保存成功');
						center($("#popbox"));
						 setTimeout(function(){
						<?php if(!empty($auth)): ?>location.reload();
						<?php else: ?>
							location.href='/tcm/auth.html';<?php endif; ?>						 
											 
                    },1500);
				 }else{
				 $('#popbox .controls').html(data.info);
					center($("#popbox"));
					return false;
				 }
		})
		return false;
	}
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