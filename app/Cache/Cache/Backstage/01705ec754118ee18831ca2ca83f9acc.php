<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo C('WEB_SITE_TITLE');?></title><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="/shadow/mast/template/Maruti/css/bootstrap.min.css" />
<link rel="stylesheet" href="/shadow/mast/template/Maruti/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="/shadow/mast/template/Maruti/css/fullcalendar.css" />
<link rel="stylesheet" href="/shadow/mast/template/Maruti/css/maruti-style.css" />
<link rel="stylesheet" href="/shadow/mast/template/Maruti/css/maruti-media.css" class="skin-color" />
<link rel="stylesheet" href="/shadow/mast/template/Maruti/css/maruti-popup.css" />
<link rel="stylesheet" href="/shadow/mast/template/Maruti/css/uniform.css" />
<link rel="stylesheet" href="/shadow/mast/template/Maruti/css/select2.css" />
<link rel="stylesheet" href="/shadow/mast/template/Maruti/css/colorpicker.css" />
   <link rel="stylesheet" href="/shadow/mast/template/Maruti/css/datepicker.css" />
</head>
<body>
<!--Header-part-->
<section name="top">
	<div id="header">
	  <h1><a href="/"></a></h1>
	</div>
	<!--close-Header-part--> 

	<!--top-Header-messaages-->
	<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
	<!--close-top-Header-messaages--> 

	<!--top-Header-menu-->
	<div id="user-nav" class="navbar navbar-inverse">
	  <ul class="nav">
		<li class="" ><a title="" href="/shadow/mast/about.html"><i class="icon icon-user"></i> <span class="text"><?php echo get_nickname();?></span></a></li>
		<li class=""><a title="" href="/shadow/mast/constant.html"><i class="icon icon-cog"></i> <span class="text">设置</span></a></li>
		<li class=""><a id="outlogin" href="javascript:;" url="/shadow/mast/outlogin.html"><i class="icon icon-share-alt"></i> <span class="text">退出登录</span></a></li>
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
<div id="sidebar"><a href="/shadow/mast/index.html" class="visible-phone"><i class="icon icon-home"></i> 首页</a>
  <ul>
	<?php if(is_array($__base_menu__)): foreach($__base_menu__ as $key=>$menu): ?><li><a href="/shadow/mast/<?php echo ($menu["tip"]); ?>"><i class="icon <?php echo ($menu["icon"]); ?>"></i> <span><?php echo ($menu["title"]); ?></span></a></li><?php endforeach; endif; ?>
  </ul>
</div>
</section>
</head>
<body>
	
	<!---->
	<!-- 主体 -->
	   
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/shadow/mast/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/shadow/mast/goods.html" class="current">卡券管理</a> </div>
	<h1>卡券详情</h1>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>卡券详情</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="/shadow/mast/Goods/operate/type/edit/id/2.html" method="post" class="myform form-horizontal">
									<div class="control-group">
										<label class="control-label">名称:</label>
										<div class="controls"><input name="name" type="text" class="span3" placeholder="名称" value="<?php echo ($info["name"]); ?>"/>
										<div><error class="color-red hidden"></error></div></div>
									</div>
									<div class="control-group">
										<label class="control-label">金额:</label>
										<input name="id" type="hidden" class="span3"  value="<?php echo ($info["id"]); ?>"/>
										<div class="controls"><input name="money" type="text" class="span3" placeholder="金额" value="<?php echo ($info["money"]); ?>"/>
										<div><error class="color-red hidden"></error></div></div>
									</div>
									
									<div class="form-actions">
										<button type="button" class="btn btn-primary" onclick="document.getElementById('inputfile').click()">导入卡券</button>
										<button type="submit" class="btn btn-success">保存</button>
										<button type="button" class="btn btn-warning"  onclick="window.location.href='/shadow/mast/goods.html'">返回</button>
									</div>
								</form>
								<div style="display:none">
										<input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  name="image2" multiple="multiple" style="width:100%;opacity:0;filter:alpha(opacity=0);" id="inputfile"/>
								</div>
							</div>
						</div>						
					</div>
				</div> 
      </div>
    </div>
  </div>
</div>

<script src="/shadow/mast/template/Maruti/js/jquery.min.js"></script> 
<script src="/shadow/mast/template/Maruti/js/jquery.ui.custom.js"></script> 
<script src="/shadow/mast/template/Maruti/js/bootstrap.min.js"></script> 
<script src="/shadow/mast/template/Maruti/js/select2.min.js"></script> 
 <script src="/shadow/mast/template/Maruti/js/bootstrap-datepicker.js"></script>
 <script src="/shadow/mast/template/Maruti/js/bootstrap-colorpicker.js"></script>
<script src="/shadow/mast/template/Maruti/js/jquery.dataTables.min.js"></script> 
 <script src="/shadow/mast/template/Maruti/js/jquery.uniform.js"></script>
<script src="/shadow/mast/template/Maruti/js/maruti.js"></script> 
<script src="/shadow/mast/template/Maruti/js/maruti.tables.js"></script>
 <script src="/shadow/mast/template/Maruti/js/maruti.form_common.js"></script>
<script src="/shadow/mast/template/Maruti/js/maruti.popup.js"></script>
<script>
$("#type .dropdown-menu li a").click(function(){
	var typeid=$(this).attr('data-id');
	var type=$(this).html();
	$("input[name='type']").val(typeid);
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
	case "name":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入名称");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "money":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入金额");
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
	var name=$("input[name='name']").val();
	var money=$("input[name='money']").val();	
	var stat=1;
	if(name.length==0){
			$("input[name='title']").addClass('redborder');
			$("input[name='title']").siblings('div').find('error').html("<span>*</span>请输入名称");
			$("input[name='title']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
	if(money.length==0){
		$("input[name='img_path']").addClass('redborder');
		$("input[name='img_path']").siblings('div').find('error').html("<span>*</span>请输入金额");
		$("input[name='img_path']").siblings('div').find('error').removeClass('hidden');
		stat=0;
	}
	if(stat==0){
			return false;
		}else{
			
			 $.post("/shadow/mast/Goods/operate/type/edit/id/2.html",$(this).serialize()).success(function(data){
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
         url:"<?php echo U('Goods/upload');?>",
         type:'POST',
         data:data,
         cache: false,
         contentType: false,    //不可缺
         processData: false,    //不可缺
         success:function(data){
			console.log(data);
				if(data.status==1){
					$('#popbox .controls').html('导入成功');
						center($("#popbox"));
						 setTimeout(function(){
                        if (data.url) {
                            location.href=data.url;
                        }else{
                            location.reload();
                        }
                    },1500);
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
		  <div id="footer" class="span12"> 2012 &copy; Marutii Admin. More Templates - Collect from</div>
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