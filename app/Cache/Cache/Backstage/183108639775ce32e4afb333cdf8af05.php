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
                    <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>首页</a>
                    <a href="about.htnl" class="tip-bottom">个人信息</a>
                </div>
        		<h1>个人信息</h1>
				
			</div>
			
			<div class="container-fluid">
            <div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>个人信息</h5>
							</div>
							<div class="widget-content nopadding">
								<form id="updateform" action="<?php echo U('updateinfo');?>" method="get" class="form-horizontal">
									<div class="control-group">
										<label class="control-label">用户名:</label>
										<div class="controls"><input type="text" class="span20" placeholder="用户名" value="<?php echo ($about["username"]); ?>" disabled="disabled"/></div>
									</div>
                                    <div class="control-group">
										<label class="control-label">昵称:</label>
										<div class="controls"><input name="nickname" type="text" class="span20" placeholder="昵称" value="<?php echo ($about["nickname"]); ?>" />
										<div><error class="color-red hidden"></error></div></div>
										
									</div>
									<div class="control-group">
										<label class="control-label">密码</label>
										<div class="controls" id="hidePW">
											<input type="password"  class="span6" placeholder="密码" value="怎么可能把密码写出来" disabled="disabled"/> <a class="text-decoration-underline color-5bb75b" href="javascript:;" >修改密码</a>
										</div>
										<div class="controls hidden" id="updatePW">
											<input type="password" name="newPassword" class="span5" placeholder="输入新密码"  /> <input name="confirmPassword" type="password"  class="span5" placeholder="输入确认密码"  /> <button type="submit" data-url="<?php echo U('savepassword');?>" class="savePassword btn btn-success">保存密码</button>
										<div><error class="color-red hidden"></error></div>
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label">绑定邮箱 :</label>
										<div class="controls"><input type="text" class="span20" name="email" placeholder="邮箱地址" value="<?php echo ($about["email"]); ?>"/>
										<div><error class="color-red hidden"></error></div>
										</div>
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
<script src="/tcm/template/Maruti/js/maruti.about.js"></script>


	
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