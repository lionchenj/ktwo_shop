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
.table th, .table td {
    border-top: 1px solid #ddd;
    line-height: 20px;
    padding: 8px;
    text-align: left;
	vertical-align:middle;
}

</style>
<div id="content">
   <div id="content-header">
    <div id="breadcrumb"> <a href="/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/tcm/auth.html" class="current">权限管理</a> </div>
	<?php if(!empty($twoMenu)): ?><div  class="quick-actions_homepage">
		<ul class="quick-actions">
			<?php if(is_array($twoMenu)): foreach($twoMenu as $key=>$two_menu): ?><li> <a href="/tcm/<?php echo ($two_menu["tip"]); ?>"> <i class="<?php echo ($two_menu["icon"]); ?>"></i><?php echo ($two_menu["title"]); ?></a> </li><?php endforeach; endif; ?>
		</ul>
	  </div>
	<?php else: ?>
	 <h1><?php echo ($two_title); ?></h1><?php endif; ?>
  </div>
  <div class="container-fluid">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>权限列表</h5>
           </div>
          <div class="widget-content">
		  <form action="/tcm/Auth/operate/type/auth/id/17.html" method="post" class="myform form-horizontal">
			<table class="table table-bordered table-striped">
              <thead>
                <tr>
				  <th>顶级模块</th>
				  <th>二级模块</th>
                  <th>权限列表</th>				 
                </tr>
              </thead>
              <tbody>				
                <tr>
				<td colspan="2">首页</td>
				<td><input  type="checkbox" name="list[]" <?php if(in_array(3,$array)): ?>checked="true"<?php endif; ?> value="3" />查看</td>
                </tr>
				<tr>
				<td rowspan="2">门店管理</td>
				<td>中医馆集团</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(4,$array)): ?>checked="true"<?php endif; ?> value="4"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(5,$array)): ?>checked="true"<?php endif; ?> value="5"/>操作</span>
				</td>
                </tr>
				<tr>
				<td>中医馆</td>
				<td>
				<span><input  type="checkbox" name="list[]"<?php if(in_array(24,$array)): ?>checked="true"<?php endif; ?>  value="24"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(6,$array)): ?>checked="true"<?php endif; ?>  value="6"/>操作</span>
                </td>
				</tr>
				<tr>
				<td colspan="2">卡券管理</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(32,$array)): ?>checked="true"<?php endif; ?> value="32"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(8,$array)): ?>checked="true"<?php endif; ?>  value="8"/>操作</span>
				</td>
				</tr>
				<tr>
				<td rowspan="2">订单管理</td>
				<td>线上订单</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(9,$array)): ?>checked="true"<?php endif; ?>  value="9"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(10,$array)): ?>checked="true"<?php endif; ?> value="10"/>操作</span>
				</td>
                </tr>
				<tr>
				<td>线下订单</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(25,$array)): ?>checked="true"<?php endif; ?>  value="25"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(15,$array)): ?>checked="true"<?php endif; ?>  value="15"/>操作</span>
                </td>
				</tr>
				<tr>
				<td rowspan="3">代客充值</td>
				<td>购买充值卡</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(17,$array)): ?>checked="true"<?php endif; ?>  value="17"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(38,$array)): ?>checked="true"<?php endif; ?>  value="38"/>操作</span>
				</td>
                </tr>
				<tr>
				<td>卡号充值</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(27,$array)): ?>checked="true"<?php endif; ?>  value="27"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(30,$array)): ?>checked="true"<?php endif; ?>  value="30"/>操作</span>
                </td>
				</tr>
				<tr>
				<td>任意充值</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(35,$array)): ?>checked="true"<?php endif; ?>  value="35"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(37,$array)): ?>checked="true"<?php endif; ?>  value="37"/>操作</span>
                </td>
				</tr>
				<tr>
				<td rowspan="3">会员管理</td>
				<td>会员列表</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(2,$array)): ?>checked="true"<?php endif; ?>  value="2"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(11,$array)): ?>checked="true"<?php endif; ?>  value="11"/>操作</span>
				</td>
                </tr>
				<tr>
				<td>会员卡列表</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(19,$array)): ?>checked="true"<?php endif; ?>  value="19"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(22,$array)): ?>checked="true"<?php endif; ?>  value="22"/>操作</span>
                </td>
				</tr>
				<tr>
				<td>会员等级管理</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(28,$array)): ?>checked="true"<?php endif; ?>  value="28"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(31,$array)): ?>checked="true"<?php endif; ?>  value="31"/>操作</span>
                </td>
				</tr>
				<tr>
				<td colspan="2">数据统计</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(39,$array)): ?>checked="true"<?php endif; ?>  value="39"/>查看</span>
                </td>
				</tr>
				<tr>
				<td rowspan="3">核销管理</td>
				<td>核销列表</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(12,$array)): ?>checked="true"<?php endif; ?>  value="12"/>查看</span>
                </td>
                </tr>
				<tr>
				<td>核销统计</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(26,$array)): ?>checked="true"<?php endif; ?>  value="26"/>查看</span>
                </td>
				</tr>
				<tr>
				<td>核销人员</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(34,$array)): ?>checked="true"<?php endif; ?>  value="34"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(13,$array)): ?>checked="true"<?php endif; ?>  value="13"/>操作</span>
                </td>
				</tr>
				<tr>
				<td rowspan="2">充值管理</td>
				<td>充值记录</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(1,$array)): ?>checked="true"<?php endif; ?>  value="1"/>查看</span>
                <span><input  type="checkbox" name="list[]" <?php if(in_array(41,$array)): ?>checked="true"<?php endif; ?>  value="23"/>操作</span>
				</td>
                </tr>
				<tr>
				<td>充值卡管理</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(18,$array)): ?>checked="true"<?php endif; ?>  value="18"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(23,$array)): ?>checked="true"<?php endif; ?>  value="23"/>操作</span>
                </td>
				</tr>
				<tr>
				<td rowspan="2">权限管理</td>
				<td>角色组</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(20,$array)): ?>checked="true"<?php endif; ?>  value="20"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(21,$array)): ?>checked="true"<?php endif; ?>  value="21"/>操作</span>
                </td>
                </tr>
				<tr>
				<td>管理员</td>
				<td>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(29,$array)): ?>checked="true"<?php endif; ?>  value="29"/>查看</span>
				<span><input  type="checkbox" name="list[]" <?php if(in_array(36,$array)): ?>checked="true"<?php endif; ?>  value="36"/>操作</span>
                </td>
				</tr>
				</foreach>
              </tbody>
            </table>
			<div class="form-actions">
				<button type="submit"  class="btn btn-success ajax-post"  target-form="myform">保存</button>
				<button type="button" class="btn btn-warning"  onclick="window.location.href='/tcm/auth.html'">返回</button>
			</div>
			</form>
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