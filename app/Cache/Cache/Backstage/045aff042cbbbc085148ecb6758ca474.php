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
    <div id="breadcrumb"> <a href="/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/tcm/cinema.html" class="current">中医馆管理</a> </div>
	<h1><?php if(empty($cinema)): ?>新增中医馆<?php else: ?>中医馆详情<?php endif; ?></h1>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5><?php if(empty($cinema)): ?>新增中医馆<?php else: ?>中医馆详情<?php endif; ?></h5>
							</div>
							<div class="widget-content nopadding">
								<form action="/tcm/Cinema/operate/type/add.html" method="post" class="myform form-horizontal">
									<div class="control-group">
										<label class="control-label">中医馆名称:</label>
										<div class="controls">
											<input  type="text" name="name" class="span3" placeholder="中医馆名称" value="<?php echo ($cinema["name"]); ?>"/>
											<div id="error_name" ><error class="color-red hidden"></error></div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label"<?php if(empty($cinema["group"])): ?>disabled<?php endif; ?>>所属集团:</label>
										<div class="controls">
											<?php if(empty($cinema)): ?><select id="group">
											<option value ="请选择">请选择</option>
											<?php if(is_array($group)): foreach($group as $key=>$_list): ?><option value ="<?php echo ($_list["id"]); ?>" <?php if(($cinema["group"]) == $_list["id"]): ?>selected="selected"<?php endif; ?>><?php echo ($_list["name"]); ?></option><?php endforeach; endif; ?>
											</select>
											<div id="error_group" ><error class="color-red hidden"></error></div>
											<?php else: ?>
											<span><?php echo (get_group_name($cinema["group"])); ?></span><?php endif; ?>
										</div>
									</div>
									<div class="control-group">
									<label class="control-label">地理位置:</label>
									<div class="controls" id="store">
										<?php if(empty($cinema)): ?><span id="province">
											</span>
											<span id="city" class="hide" >
											</span>
											<span id="area" class="hide" >
											</span>
											<span id="address">
												<input  type="text" name="keyword" class="span3" placeholder="详细地址" value=""/>
											</span>
											<div><error class="color-red hidden"></error>
										</div>
										<?php else: ?>
										
										<span><?php echo ($cinema["province"]); ?></span><span><?php echo ($cinema["city"]); ?></span><span><?php echo ($cinema["area"]); ?></span><span><?php echo ($cinema["keyword"]); ?></span><?php endif; ?>
										</div>
									</div>
									<div class="control-group">
											<label class="control-label">登陆账号:</label>
											<div class="controls">
											<?php if(empty($cinema)): ?><input  type="text" name="username" class="span3" placeholder="登陆账号" value=""/>
												<div><error class="color-red hidden"></error></div>
											<?php else: ?>
											<span>
											<?php echo ($cinema["username"]); ?>
											</span><?php endif; ?>
											</div>
									</div>
									<div class="form-actions">
										<button id="submit" type="submit" class="btn btn-success"><?php if(empty($cinema)): ?>添加中医馆<?php else: ?>修改中医馆<?php endif; ?></button>
											<button type="button" class="btn btn-warning"  onclick="window.location.href='/tcm/cinema.html'">返回</button>
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
	var area_json={
		data_area:<?php echo ($area); ?>,
		put_province:'#province',
		put_city:'#city',
		put_area:'#area',
		put_town:'#town',
	}
	area_restart(area_json);
</script>
<script>

$("input").blur(function(){
    var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	case "name":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入中医馆名称");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	case "username":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入登录账号");
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
	var name=$("input[name='name']").val();
	var username=$("input[name='username']").val();
	var stat=1;
	if(name.length==0){
		$("input[name='name']").addClass('redborder');
		$("input[name='name']").siblings('div').find('error').html("<span>*</span>请输入中医馆名称");
		$("input[name='name']").siblings('div').find('error').removeClass('hidden');
		stat=0;
		}
				
				<?php if(empty($cinema)): ?>if(username.length==0){
	$("input[name='username']").addClass('redborder');
	$("input[name='username']").siblings('div').find('error').html("<span>*</span>请输入登陆账号");
	$("input[name='username']").siblings('div').find('error').removeClass('hidden');
	stat=0;
	}
			
	var group=$("#group").val();
	if(group=='' || group==undefined || group=='请选择'){
			$("#error_group").find('error').html("<span>*</span>请选择所属集团");
			$("#error_group").find('error').removeClass('hidden');
			stat=0;
	}
			
	if($("#province").hasClass('hide')){
		$("#store").find('error').html("<span>*</span>请选择省份");
		$("#store").find('error').removeClass('hidden');
		return false;
	}else{
		var province=$("#province_list").val();
		if(province=='' || province==undefined || province=='请选择'){
			$("#store").find('error').html("<span>*</span>请选择省份");
			$("#store").find('error').removeClass('hidden');
			return false;
		}
	}
			
	if($("#city").hasClass('hide')){
		$("#store").find('error').html("<span>*</span>请选择城市");
		$("#store").find('error').removeClass('hidden');
		return false;
	}else{
		var city=$("#city_list").val();
		if(city=='' || city==undefined || city=='请选择'){
			$("#store").find('error').html("<span>*</span>请选择城市");
			$("#store").find('error').removeClass('hidden');
			return false;
		}
	}
	if($("#area").hasClass('hide')){
		var area='';
	}else{
		var area=$("#area_list").val();
		if(area=='' || area==undefined || area=='请选择'){
			$("#store").find('error').html("<span>*</span>请选择区/镇");
			$("#store").find('error').removeClass('hidden');
			return false;
		}
	}
	var keyword=$("input[name='keyword']").val();
	if(keyword.length==0){
		$("#store").find('error').html("<span>*</span>请输入详细地址");
		$("#store").find('error').removeClass('hidden');
		return false;
	}
	$("#store").find('error').addClass('hidden');<?php endif; ?>
	if(stat==0){

			return false;
	}else{

		var url=$(this).attr('action');
		var query = {};
		query['name']=name;
		<?php if(empty($cinema)): ?>query['group']=group;
		query['province']=province;
		query['city']=city;
		query['area']=area;
		query['keyword']=keyword;
		query['username']=username;<?php endif; ?>
		$.post(url,query).success(function(data){
		
				 if (data.status==1) {
					 $('#popbox .controls').html('保存成功');
						center($("#popbox"));
						 setTimeout(function(){
                        if (data.url) {
                            location.href=data.url;
							return false;
                        }else{
                            location.reload();
                        }
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