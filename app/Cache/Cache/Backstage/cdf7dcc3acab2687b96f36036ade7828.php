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
	   
<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Maruti/css/base.css">
<link rel="stylesheet" type="text/css" href="/zhouzf/www/tcm/template/Maruti/css/module.css">

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/zhouzf/www/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/zhouzf/www/tcm/wechatmenu.html" class="current">公众号菜单</a> </div>
	<?php if(!empty($twoMenu)): ?><div  class="quick-actions_homepage">
		<ul class="quick-actions">
			<?php if(is_array($twoMenu)): foreach($twoMenu as $key=>$two_menu): ?><li> <a href="/zhouzf/www/tcm/<?php echo ($two_menu["tip"]); ?>"> <i class="<?php echo ($two_menu["icon"]); ?>"></i><?php echo ($two_menu["title"]); ?></a> </li><?php endforeach; endif; ?>
		</ul>
	  </div>
	<?php else: ?>
	 <h1><?php echo ($two_title); ?></h1><?php endif; ?>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12"> 
        <div class="widget-box">
          <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span>
            <h5>公众号菜单管理</h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span12 category">
			   <div class="span12" style="background-color: #e5e5e5;">
			   <span class="btn ajax-post confirm" onclick="<?php if(($topmenu) == "3"): ?>alert('一级菜单最多只能存在3个')<?php else: ?>javascript:window.location.href='<?php echo U('add');?>';<?php endif; ?>"  style="margin:5px;padding:8px 12px;color:#333;background-color:#fff;border: 1px solid #ddd;"> <i class="icon-plus"></i> 新增一级菜单</span>
			   </div>
				 <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th class="hide"><input type="checkbox"  id="title-table-checkbox" name="title-table-checkbox" /></th>
                  <th width="5%">折叠</th>
                  <th width="15%">排序</th>
				  <th width="15%">级别</th>
                  <th>名称</th>
				  <th width="15%">操作</th>
                </tr>
              </thead>
			  </table>
			  <?php echo R('Wechatmenu/tree', array($tree));?>
              </div>
            </div></div></div>
             
          
      </div>
    </div> 
  </div>
</div>
<script src="/zhouzf/www/tcm/template/Maruti/js/excanvas.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.ui.custom.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.flot.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.flot.resize.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.peity.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/fullcalendar.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.dashboard.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.popup.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.ajax.js"></script>
<script type="text/javascript">
		(function($){
			/* 分类展开收起 */
			$(".category dd").prev().find(".fold i").addClass("icon-unfold")
				.click(function(){
					var self = $(this);
					if(self.hasClass("icon-unfold")){
						self.closest("dt").next().slideUp("fast", function(){
							self.removeClass("icon-unfold").addClass("icon-fold");
						});
					} else {
						self.closest("dt").next().slideDown("fast", function(){
							self.removeClass("icon-fold").addClass("icon-unfold");
						});
					}
				});

			/* 三级分类删除新增按钮 */
			$(".category dd dd .add-sub").remove();

			/* 实时更新分类信息 */
			$(".category")
				.on("submit", "form", function(){
					var self = $(this);
					$.post(
						self.attr("action"),
						self.serialize(),
						function(data){
							/* 提示信息 */
							var name = data.status ? "success" : "error", msg;
							msg = self.find(".msg").addClass(name).text(data.info.error)
									  .css("display", "inline-block");
							setTimeout(function(){
								msg.fadeOut(function(){
									msg.text("").removeClass(name);
								});
							}, 1000);
						},
						"json"
					);
					return false;
				})
                .on("focus","input",function(){
                    $(this).data('param',$(this).closest("form").serialize());

                })
                .on("blur", "input", function(){
                    if($(this).data('param')!=$(this).closest("form").serialize()){
                        $(this).closest("form").submit();
                    }
                });
		})(jQuery);
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