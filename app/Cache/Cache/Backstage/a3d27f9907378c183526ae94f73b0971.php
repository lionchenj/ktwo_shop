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
    <div id="breadcrumb"> <a href="/zhouzf/www/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/zhouzf/www/tcm/goods.html" class="current">商品列表</a> </div>
	<h1>评论详情</h1>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>评论详情</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="/zhouzf/www/tcm/Review/edit/comment_id/26777/id/69.html" method="post" class="myform form-horizontal">
									<div class="control-group">
										<label class="control-label">评论人昵称:</label>
										<div class="controls"><input name="nickname" type="text" class="span3" placeholder="评论人昵称" value="<?php echo ($info["nickname"]); ?>"/>
										<div><error class="color-red hidden"></error></div></div>
									</div>
                                            
                                    <div class="control-group">
                                        <label class="control-label">评论人头像:</label>
                                        <div class="controls">
											<img class="img_path" style="width:150px" src="<?php if(empty($info['headimgurl'])): ?>/zhouzf/www/tcm/template/Maruti/images/add.jpg<?php else: echo ($info["headimgurl"]); endif; ?>" onclick="getElementById('inputfile').click()">
											<input class="common-text required imageFile" name="headimgurl" value="<?php echo ($info["headimgurl"]); ?>" type="hidden">
											<div style="display:none">
											<input type="file" accept="image/*"  name="image2" multiple="multiple" style="width:100%;opacity:0;filter:alpha(opacity=0);" id="inputfile"/>
											</div>										
										</div>
									</div>
									<div class="control-group">
                                        <label class="control-label">评论内容</label>
                                        <div class="controls">
											<textarea name="title" id="title" style="margin: 0px; width: 407px; height: 162px;"><?php echo ($info["title"]); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">审核状态</label>
                                        <div class="controls">
                                        	<select name='status'>
                                        		<option value="0" <?php if($info['status'] == '0' ): ?>selected<?php endif; ?>>未审核</option>
                                        		<option value="1" <?php if($info['status'] == '1' ): ?>selected<?php endif; ?>>通过</option>
                                        	</select>
                                            <!-- //<a class="btn btn-danger btn-mini confirm ajax-get" ">未审核</a> -->
                                        </div>
                                    </div>										
									<div class="form-actions">
										<button type="submit" class="btn btn-success">保存</button>
											<button type="button" class="btn btn-warning"  onclick="window.location.href='<?php echo U('review/index',array('id'=>$_GET['id']));?>'">返回</button>
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
			$(this).siblings('div').find('error').html("<span>*</span>请输入评论内容");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "headimgurl":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请上传评论人头像");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "nickname":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入评论人昵称");
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
	var title=$("#title").val();
	var headimgurl=$("input[name='headimgurl']").val();
	var nickname=$("input[name='nickname']").val();
	var stat=1;
	if(title.length==0){
			$("#title").addClass('redborder');
			$("#title").siblings('div').find('error').html("<span>*</span>请输入评论内容");
			$("#title").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		if(headimgurl.length==0){
			$("input[name='headimgurl']").addClass('redborder');
			$("input[name='headimgurl']").siblings('div').find('error').html("<span>*</span>请上传评论人头像");
			$("input[name='headimgurl']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		if(nickname.length==0){
			$("input[name='nickname']").addClass('redborder');
			$("input[name='nickname']").siblings('div').find('error').html("<span>*</span>请输入跳转连接");
			$("input[name='nickname']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
	if(stat==0){
			return false;
		}else{
			 $.post("/zhouzf/www/tcm/Review/edit/comment_id/26777/id/69.html",$(this).serialize()).success(function(data){
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