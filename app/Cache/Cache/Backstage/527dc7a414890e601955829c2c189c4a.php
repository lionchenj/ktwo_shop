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
	   
<style>

</style>
		<div id="content">
			<div id="content-header">
			<div id="breadcrumb"> <a href="/zhouzf/www/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/zhouzf/www/tcm/menu.html" class="current">官网设置</a> </div>
			</div>
			
			<div class="container-fluid">
            <div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>管理系统常量配置</h5>
							</div>
							<div class="widget-content nopadding">
								<form id="updateform" action="<?php echo U('updateinfo');?>" method="get" class="form-horizontal">

									<div class="control-group">
										<label class="control-label">快递鸟电商id:</label>
										<div class="controls"><input name="EBusinessID" type="text" class="span3" placeholder="积分使用比例" value="<?php echo C('EBusinessID');?>" />
										<div><error class="color-red hidden"></error></div></div>
										
									</div>
									<div class="control-group">
										<label class="control-label">快递鸟电商key:</label>
										<div class="controls"><input name="AppKey" type="text" class="span3" placeholder="积分使用比例" value="<?php echo C('AppKey');?>" />
										<div><error class="color-red hidden"></error></div></div>
										
									</div>
									<div class="control-group">
										<label class="control-label">快递鸟接口地址:</label>
										<div class="controls"><input name="ReqURL" type="text" class="span3" placeholder="积分使用比例" value="<?php echo C('ReqURL');?>" />
										<div><error class="color-red hidden"></error></div></div>
										
									</div>
									<div class="control-group">
										<label class="control-label">X天确认收货:</label>
										<div class="controls"><input name="ConfDay" type="text" class="span3" placeholder="积分使用比例" value="<?php echo C('ConfDay');?>" />
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
			 <div class="container-fluid hide">
            <div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>官网常量配置</h5>
							</div>
							<div class="widget-content nopadding">
								<form id="updateform2" action="<?php echo U('updateinfo');?>" method="get" class="form-horizontal">
									<div class="control-group">
										<label class="control-label">官网标题:</label>
										<div class="controls"><input name="WEB_TITLE" type="text" class="span3" placeholder="官网标题" value="<?php echo C('WEB_TITLE');?>" />
										<div><error class="color-red hidden"></error></div></div>	
									</div>
									<div class="control-group">
										<label class="control-label">官网关键字:</label>
										<div class="controls"><input name="WEB_KEYWORDS" type="text" class="span8" placeholder="官网关键字" value="<?php echo C('WEB_KEYWORDS');?>" />
										<div><error class="color-red hidden"></error></div></div>
										
									</div>
									<div class="control-group">
										<label class="control-label">官网描述:</label>
										<div class="controls"><input name="WEB_DESCRIPTION" type="text" class="span8" placeholder="官网描述" value="<?php echo C('WEB_DESCRIPTION');?>" />
										<div><error class="color-red hidden"></error></div></div>
										
									</div>
									<div class="control-group">
										<label class="control-label">官网页尾标题:</label>
										<div class="controls"><input name="WEB_FOOT_TITLE" type="text" class="span3" placeholder="官网页尾标题" value="<?php echo C('WEB_FOOT_TITLE');?>" />
										<div><error class="color-red hidden"></error></div></div>	
									</div>
									<div class="control-group">
										<label class="control-label">官网页尾描述:</label>
										<div class="controls"><textarea  name="WEB_FOOT_DESCRIPTION" type="text" class="span8" placeholder="官网页尾描述" value="<?php echo C('WEB_FOOT_DESCRIPTION');?>" ><?php echo C('WEB_FOOT_DESCRIPTION');?></textarea>
										<div><error class="color-red hidden"></error></div></div>
										
									</div>
									<div class="control-group">
										<label class="control-label">官网页尾公司名称:</label>
										<div class="controls"><input name="WEB_FOOT_COMPANY_NAME" type="text" class="span3" placeholder="官网页尾公司名称" value="<?php echo C('WEB_FOOT_COMPANY_NAME');?>" />
										<div><error class="color-red hidden"></error></div></div>	
									</div>
									<div class="control-group">
										<label class="control-label">官网页尾公司联系方式:</label>
										<div class="controls"><input name="WEB_FOOT_COMPANY_CONTACT" type="text" class="span8" placeholder="官网页尾公司联系方式" value="<?php echo C('WEB_FOOT_COMPANY_CONTACT');?>" />
										<div><error class="color-red hidden"></error></div></div>	
									</div>
									<div class="control-group">
										<label class="control-label">官网页尾公司电话号码:</label>
										<div class="controls"><input name="WEB_FOOT_COMPANY_PHONE" type="text" class="span3" placeholder="官网页尾公司电话号码" value="<?php echo C('WEB_FOOT_COMPANY_PHONE');?>" />
										<div><error class="color-red hidden"></error></div></div>	
									</div>
									<div class="control-group">
										<label class="control-label">官网页尾公司联系邮箱:</label>
										<div class="controls"><input name="WEB_FOOT_COMPANY_EMAIL" type="text" class="span3" placeholder="官网页尾公司联系邮箱" value="<?php echo C('WEB_FOOT_COMPANY_EMAIL');?>" />
										<div><error class="color-red hidden"></error></div></div>	
									</div>
									<div class="control-group">
										<label class="control-label">官网页尾公司地址:</label>
										<div class="controls"><input name="WEB_FOOT_COMPANY_ADDRESS" type="text" class="span8" placeholder="官网页尾公司地址" value="<?php echo C('WEB_FOOT_COMPANY_ADDRESS');?>" />
										<div><error class="color-red hidden"></error></div></div>	
									</div>
									
									<div class="control-group">
										<label class="control-label">官网页尾二维码:</label>
										  <div class="controls">
										<img class="custom_img" style="width:150px" src="<?php echo C('WEB_FOOT_ERWEIMA');?>" onclick="getElementById('inputfile').click()">
										<input class="common-text required imageFile" name="WEB_FOOT_ERWEIMA" value="<?php echo C('WEB_FOOT_ERWEIMA');?>" type="hidden">
										<div style="display:none">
										<input type="file" accept="image/*"  name="image2" multiple="multiple" style="width:100%;opacity:0;filter:alpha(opacity=0);" id="inputfile"/>
										</div>	
                                    </div>
									</div>
									<div class="control-group">
										<label class="control-label">官网页尾二维码标语:</label>
										<div class="controls"><input name="WEB_FOOT_ERWEIMA_TITLE" type="text" class="span8" placeholder="官网页尾二维码标语" value="<?php echo C('WEB_FOOT_ERWEIMA_TITLE');?>" />
										<div><error class="color-red hidden"></error></div></div>	
									</div>
									<div class="control-group">
										<label class="control-label">官网页尾ICP:</label>
										<div class="controls"><input name="WEB_FOOT_ICP" type="text" class="span8" placeholder="官网页尾ICP" value="<?php echo C('WEB_FOOT_ICP');?>" />
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
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.min.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.ui.custom.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap.min.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap-colorpicker.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap-datepicker.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.uniform.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/select2.min.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.form_common.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.popup.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.constant.js"></script>
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
				$("input[name='WEB_CUSTOM_WECHAT']").val(url);
				var click="getElementById('inputfile').click()"
				$(".custom_img").attr('src',url);
				}
			   
         }
     });
		})
 $("#inputfile2").change(function(){
     //创建FormData对象
     var data = new FormData();
     //为FormData对象添加数据
     //
     $.each($('#inputfile2')[0].files, function(i, file) {
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
				$("input[name='WEB_WECHAT_PUBLIC']").val(url);
				var click="getElementById('inputfile2').click()"
				$(".public_img").attr('src',url);
				}
			   
         }
     });
		})		
</script>


	
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