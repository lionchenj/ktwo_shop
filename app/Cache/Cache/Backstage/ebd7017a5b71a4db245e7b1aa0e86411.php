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
	  <h1><a href="/">天辅安中医馆管理系统</a></h1>
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
    <div id="breadcrumb"> <a href="/zhouzf/www/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/zhouzf/www/tcm/banner.html" class="current">轮播管理</a> </div>
	<h1>轮播详情</h1>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>轮播详情</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="/zhouzf/www/tcm/Banner/edit/id/71.html" method="post" class="myform form-horizontal">
									<div class="control-group">
										<label class="control-label">标题:</label>
										<input name="id" type="hidden" class="span3"  value="<?php echo ($info["id"]); ?>"/>
										<div class="controls"><input name="title" type="text" class="span3" placeholder="标题" value="<?php echo ($info["title"]); ?>"/>
										<div><error class="color-red hidden"></error></div></div>
									</div>
                                            
                                    <div class="control-group">
                                        <label class="control-label">轮播图片:</label>
                                        <div class="controls">
										<img class="img_path" style="width:150px" src="<?php if(empty($info['img_path'])): ?>/zhouzf/www/tcm/template/Maruti/images/add.jpg<?php else: echo ($info["img_path"]); endif; ?>" onclick="getElementById('inputfile').click()">
										<input class="common-text required imageFile" name="img_path" value="<?php echo ($info["img_path"]); ?>" type="hidden">
										<div style="display:none">
										<input type="file" accept="image/*"  name="image2" multiple="multiple" style="width:100%;opacity:0;filter:alpha(opacity=0);" id="inputfile"/>
										</div>
										
                                    </div>
									  <div class="control-group">
										<label class="control-label">跳转连接:</label>
										<div class="controls"><input name="link" type="text" class="span6" placeholder="跳转连接" value="<?php echo ($info["link"]); ?>"/>
										<div><error class="color-red hidden"></error></div></div>
									</div>
									<div class="control-group">
										<label class="control-label">轮播类型:</label>
											<div class="controls " id="type">
												<div class="btn-group">
												<input type="text" name="type" style="display:none" value="<?php echo ($info['type']); ?>"/>
												<button type="button" class="btn type" onclick="javascript:;"><?php if(empty($info['type'])): ?>--请选择--<?php else: if(($info["type"]) == "1"): ?>首页<?php endif; if(($info["type"]) == "2"): ?>首页推荐<?php endif; if(($info["type"]) == "3"): ?>编辑推荐商品<?php endif; endif; ?></button>
												<button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
												<ul class="dropdown-menu">
												<li><a href="javascript:;" data-id="0">--请选择-—</a></li>
												<li><a href="javascript:;" data-id="1">首页</a></li>
												<li><a href="javascript:;" data-id="2">编辑推荐</a></li>
												<li><a href="javascript:;" data-id="3">编辑推荐商品</a></li>
												</ul>
												</div>
												<error class="color-red hidden"></error>
											</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-success">保存</button>
											<button type="button" class="btn btn-warning"  onclick="window.location.href='/zhouzf/www/tcm/banner.html'">返回</button>
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
<script>
$("#type .dropdown-menu li a").click(function(){
	var typeid=$(this).attr('data-id');
	var type=$(this).html();
	$('input[name="type"]').val(typeid);
	$(this).parent().parent().siblings('.type').html(type);
	$("#type").find('error').removeClass('redborder');
	$("#type").find('error').html("");
	$("#type").find('error').addClass('hidden')
});
$("input").blur(function(){
  
  var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	case "title":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入标题");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "img_path":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请上传图片");
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
			$(this).siblings('div').find('error').html("<span>*</span>请输入跳转连接");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
	$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
  }
 
});
$(".myform").submit(function(){
	var title=$("input[name='title']").val();
	var img_path=$("input[name='img_path']").val();
	var link=$("input[name='link']").val();
	var stat=1;
	if(title.length==0){
			$("input[name='title']").addClass('redborder');
			$("input[name='title']").siblings('div').find('error').html("<span>*</span>请输入标题");
			$("input[name='title']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		if(img_path.length==0){
			$("input[name='img_path']").addClass('redborder');
			$("input[name='img_path']").siblings('div').find('error').html("<span>*</span>请上传图片");
			$("input[name='img_path']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		if(link.length==0){
			$("input[name='link']").addClass('redborder');
			$("input[name='link']").siblings('div').find('error').html("<span>*</span>请输入跳转连接");
			$("input[name='link']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
	if(stat==0){
			return false;
		}else{
			 $.post("/zhouzf/www/tcm/Banner/edit/id/71.html",$(this).serialize()).success(function(data){
				 if (data.status==1) {
					 $('#popbox .controls').html('保存成功');
						center($("#popbox"));
						 setTimeout(function(){
                        if (data.url) {
                            location.href=data.url;
                        }else{
                            location.reload();
                        }
                    },1500);
				 }else{
					 $('#popbox .controls').html('保存失败');
						center($("#popbox")); 
				 }
			});
	}	
	return false;	
})
</script>
<script type="text/javascript">	
 $("#inputfile").change(function(){
     //创建FormData对象
     var data = new FormData();
     //为FormData对象添加数据
     //
     $.each($('#inputfile')[0].files, function(i, file) {
         data.append('imageFile', file);
     });
     $.ajax({
         url:"<?php echo U('File/update');?>",
         type:'POST',
         data:data,
         cache: false,
         contentType: false,    //不可缺
         processData: false,    //不可缺
         success:function(data){
			console.log(data);
				if(data.status==1){
				
				var url=data.path;
				$('.imageFile').val(url);
				var click="getElementById('inputfile').click()"
				$(".img_path").attr('src',url);
				}
			   
         }
     });
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