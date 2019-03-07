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
</style>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/tcm/member.html" class="current">会员管理</a> </div>
	<h1>会员详情</h1>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>会员详情</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="/tcm/Member/operate/type/edit/id/650.html" method="post" class="myform form-horizontal">
									<div class="control-group">
									<label class="control-label">昵称:</label>										
										<input type="text" name="userid" style="display:none" value="<?php echo ($user_info["userid"]); ?>"/>
										<div class="controls">
											<input  type="text" name="nickname" class="span3" placeholder="昵称" value="<?php echo ($user_info["nickname"]); ?>"/>
											<div><error class="color-red hidden"></error></div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">会员卡号:</label>
										<div class="controls"><input type="text" class="span2" placeholder="会员卡号" value="<?php echo ($user_info["user_card"]); ?>" disabled /> </div>
									</div>
									<div class="control-group">
										<label class="control-label">手机号:</label>
										<div class="controls"><input type="text" class="span2" placeholder="手机号" value="<?php echo ($user_info["mobile"]); ?>" disabled /> </div>
									</div>
									<div class="control-group">
										<label class="control-label">余额:</label>
										<div class="controls"><input type="text" class="span2" placeholder="余额" value="<?php echo ($user_info["balance"]); ?>" disabled /> </div>
									</div>
									<div class="control-group">
										<label class="control-label">积分:</label>
										<div class="controls"><div type="text" class="span2 int" id="integral1"><?php echo ($user_info["integral"]); ?></div> <span class="btn" style="padding:8px 12px;color:#333;background-color:#fff;border: 1px solid #ddd;" id="add_integral"> <i class="icon-plus"></i> 增加积分</span>
									<span id="sub_integral" class="btn"  style="padding:8px 12px;color:#333;background-color:#fff;border: 1px solid #ddd;"> <i class="icon-minus"></i>减少积分 </span><input type="hidden" name="integral" class="span2 int" placeholder="积分" value="<?php echo ($user_info["integral"]); ?>" id="integral"/>
									</div>									
									</div>
									<div class="control-group">
										<label class="control-label">性别:</label>
										<div class="controls">
											<label><input type="radio" name="sex"  value="0" <?php if(($user_info['sex']) == "0"): ?>checked=checked<?php endif; ?> />女士</label>
											<label><input type="radio" name="sex" value="1" <?php if(($user_info['sex']) == "1"): ?>checked=checked<?php endif; ?> />先生</label>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">所在城市:</label>
										<div class="controls">
											<input  type="text" name="city" class="span3" placeholder="所在城市" value="<?php echo ($user_info["city"]); ?>"/>
											<div><error class="color-red hidden"></error></div>
										</div>
									</div>
									 <div class="control-group">
										<label class="control-label">创建时间:</label>
										<div class="controls"><input type="text" class="span2" placeholder="创建时间" value="<?php echo (time_format($user_info["create_time"],'Y-m-d H:i:s')); ?>" disabled /> </div>
									</div>
									 <div class="control-group">
										<label class="control-label">会员等级:</label>
										<div class="controls">
										<?php echo (get_member_level($user_info['userid'])); ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">会员状态:</label>
										<div class="controls">
											<label><input type="radio" name="status" value="1" <?php if(($user_info['status']) == "1"): ?>checked=checked<?php endif; ?> />正常</label>
											<label><input type="radio" name="status"  value="-1" <?php if(($user_info['status']) == "-1"): ?>checked=checked<?php endif; ?> />禁用</label>
											
										</div>
									</div>
                                    
									<div class="form-actions">
										<button id="submit" type="submit" class="btn btn-success ajax-post" url="" target-form="myform">保存</button>
											<button type="button" class="btn btn-warning"  onclick="window.location.href='/tcm/member.html'">返回</button>
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
<script>
$("#goodsname .dropdown-menu li a").click(function(){
	var goodsid=$(this).attr('data-id');
	var goodsname=$(this).html();
	$("input[name='goodsid']").val(goodsid);
	$(this).parent().parent().siblings('.goodsname').html(goodsname);

})
$('#add_integral').click(function(){
	var html="";
	html+='<div class="control-group">';
	html+='<label class="control-label">增加积分:</label>';	
	html+='<input  type="text" name="add_i" class="int"  value="0"  />';
	html+='</div>';
	$('#popbox .form-actions').addClass('add');
	$('#popbox .controls').html(html);
	center($("#popbox"));	
})
$('#sub_integral').click(function(){
	var html="";
	html+='<div class="control-group">';
	html+='<label class="control-label">减少积分:</label>';	
	html+='<input  type="text" name="sub_i" class="int"  value="0"  />';
	html+='</div>';
	$('#popbox .form-actions').addClass('sub');
	$('#popbox .controls').html(html);
	center($("#popbox"));	
})
$(document).on('click','.sub .btn-info',function(){
	$('.sub').removeClass('sub');
	var sub=$('input[name="sub_i"]').val();
	var now=$('input[name="integral"]').val();
	now=parseInt(now)-parseInt(sub);	
	if(now<0){
		now=0;
	}
	$('#integral').val(now);
	$('#integral1').html(now);
})
$(document).on('click','.add .btn-info',function(){
	$('.add').removeClass('add');
	var add=$('input[name="add_i"]').val();
	var now=$('input[name="integral"]').val();
	now=parseInt(add)+parseInt(now);
	$('input[name="integral"]').val(now);
	$('#integral1').html(now);
})
//数据格式验证int
$(document).on('change',".int",function(){
	var val=parseInt($(this).val());
	if(isNaN(val)||val==0 ){
		$(this).val(1);
	}else{
		$(this).val(val);
		}
		change_money();
})
function change_money(){
	var num=$("input[name='num']").val();
	var monthly=$("input[name='monthly']").val();
	var money ='<?php echo ($money); ?>';
	money =num*monthly*money;
	$("input[name='money']").val(money);
}
$("input").blur(function(){
    var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	case "nickname":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入会员昵称");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
	case "city":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入会员所在城市");
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