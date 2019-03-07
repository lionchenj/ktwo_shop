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

</style>
		<div id="content">
			<div id="content-header">
                <div id="breadcrumb">
                    <a href="/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>首页</a>
                    <a href="/tcm/wechatmenu.html" class="tip-bottom">公众号菜单管理</a>
					 <a  class="tip-bottom current" ><?php echo ($meta_title); ?></a>
                </div>
        		<h1><?php echo ($meta_title); ?></h1>
				
			</div>
			
			<div class="container-fluid">
            <div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5><?php echo ($meta_title); ?></h5>
							</div>
							<div class="widget-content nopadding">
								<form id="updateform" action="/tcm/Wechatmenu/add/pid/15.html" method="POST" class="form-horizontal">
									<?php if(!empty($category)): ?><div class="control-group">
										<label class="control-label">上级分类:</label>
										<input class="common-text required" name="pid" size="50" value="<?php echo ($category['id']); ?>" type="hidden">
										<div class="controls"><input type="text" class="3" placeholder="用户名" value="<?php echo ($category['title']); ?>" disabled="disabled"/></div>
									</div><?php endif; ?>
                                    <div class="control-group">
										<label class="control-label">分类名称:</label>
										<input class="common-text required" name="id" size="50" value="<?php echo ($id); ?>" type="hidden">
										<input class="common-text required" name="type" size="50" value="<?php echo ($type); ?>" type="hidden">
										<div class="controls"><input name="title" type="text" class="3" placeholder="分类名称" value="<?php echo ($array["title"]); ?>" />
										<div><error class="color-red hidden"></error></div></div>
										
									</div>
									<div class="control-group">
										<label class="control-label">排序:</label>
										<div class="controls"><input name="sort" type="text" class="span1 int"  value="<?php echo ($array['sort']?$array['sort']:0); ?>" />
										<div><error class="color-red hidden"></error></div></div>
										
									</div>
									<div class="control-group">
										<label class="control-label">链接:</label>
										<div class="controls"><input name="link" type="text" class="span20" placeholder="链接" value="<?php echo ($array["link"]); ?>" />
										<div><error class="color-red hidden"></error></div></div>
										
									</div>
									
                          
									<div class="form-actions">
										<button type="submit" class="btn btn-success ajax-post">保存</button>
									</div>
								</form>
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
<script src="/tcm/template/Maruti/js/bootstrap-colorpicker.js"></script>
<script src="/tcm/template/Maruti/js/bootstrap-datepicker.js"></script>
<script src="/tcm/template/Maruti/js/jquery.uniform.js"></script>
<script src="/tcm/template/Maruti/js/select2.min.js"></script>
<script src="/tcm/template/Maruti/js/maruti.js"></script>
<script src="/tcm/template/Maruti/js/maruti.form_common.js"></script>
<script src="/tcm/template/Maruti/js/maruti.popup.js"></script>
<script>
$("input").blur(function(){
  
  var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	case "title":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入分类名称");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "link":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入链接");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	}
 
});
//数据格式验证int
$(document).on('change',".int",function(){
	var val=parseInt($(this).val());
	if(isNaN(val) || val==0){
		$(this).val(0);
	}else{
		$(this).val(val);
		}
})
$("#updateform").submit(function(){
	var stat=1;
	var title=$("input[name='title']").val();	
	if(title.length==0){
		$("input[name='title']").addClass('redborder');
		$("input[name='title']").siblings('div').find('error').html("<span>*</span>请输入分类名称");
		$("input[name='title']").siblings('div').find('error').removeClass('hidden');
		stat=0;
	}
	var link=$("input[name='link']").val();	
	if(link.length==0){
		$("input[name='link']").addClass('redborder');
		$("input[name='link']").siblings('div').find('error').html("<span>*</span>请输入链接");
		$("input[name='link']").siblings('div').find('error').removeClass('hidden');
		stat=0;
	}
	if(stat==0){
		return false;
	}else{
		var url=$(this).attr('action');
		var query = $(this).serialize();
		 $.post(url,query).success(function(data){
			 if (data.status==1) {
				 $('#popbox .controls').html(data.info);
					center($("#popbox"));
					setTimeout(function(){
					if (data.url) {
						location.href=data.url;
					}else{
						location.reload();
					}
				},1500);
			 }else{
				 switch(data.info)
				 {
					case -1:
					$("input[name='title']").addClass('redborder');
					$("input[name='title']").siblings('div').find('error').html("<span>*</span>请输入分类名称");
					$("input[name='title']").siblings('div').find('error').removeClass('hidden');
					break;
					case -2:
					$("input[name='title']").addClass('redborder');
					$("input[name='title']").siblings('div').find('error').html("<span>*</span>分类名称已存在");
					$("input[name='title']").siblings('div').find('error').removeClass('hidden');
					break;
					default:
					alert("未知错误请联系管理员");
					break;
				 }
			 }
		})
		return false;
		}
})

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