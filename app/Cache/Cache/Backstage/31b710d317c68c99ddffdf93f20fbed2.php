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
    <div id="breadcrumb"> <a href="/shadow/mast/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/shadow/mast/split.html" class="current">分账列表</a> </div>
	<h1>分账详情</h1>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>分账详情</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="/shadow/mast/Split/operate/type/add.html" method="get" class="myform form-horizontal">
									<div class="control-group exuser">
										<label class="control-label">真实姓名:</label>
										<div class="controls">
											<input  type="text" name="name" class="span3" placeholder="请输入真实姓名" value=""/>
											<div><error class="color-red hidden"></error></div>
										</div>
									</div>			
									<div class="control-group exuser">
										<label class="control-label">银行卡号:</label>
										<div class="controls">
											<input  type="text" name="bank_num" class="span3" placeholder="请输入银行卡号" value=""/>
											<div><error class="color-red hidden"></error></div>
										</div>
									</div>									
									<div class="control-group exuser">
										<label class="control-label">转账金额:</label>
										<div class="controls">
											<input  type="text" name="money" class="span3" placeholder="请输入转账金额" value=""/>
											<div><error class="color-red hidden"></error></div>
										</div>
									</div>									

									<div class="form-actions">
										<button type="submit" class="btn btn-success ajax-post" url="" target-form="myform">保存</button>
											<button type="button" class="btn btn-warning"  onclick="window.location.href='/shadow/mast/split.html'">返回</button>
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
<script src="/shadow/mast/template/Maruti/js/maruti.ajax.js"></script>
<script>
$("input").blur(function(){
    var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	case "name":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入用户真实姓名");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
		case "money":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入转账金额");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
		case "bank_num":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入转账银行卡号");
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
$(".myform").submit(function(){
	var name=$("input[name='name']").val();
	var money=$("input[name='money']").val();
	var bank_num=$("input[name='bank_num']").val();
	var stat=1;
	if(name.length==0){
		$("input[name='name']").addClass('redborder');
		$("input[name='name']").siblings('div').find('error').html("<span>*</span>请输入用户真实姓名");
		$("input[name='name']").siblings('div').find('error').removeClass('hidden');
		stat=0;
		}
	if(money.length==0){
		$("input[name='money']").addClass('redborder');
		$("input[name='money']").siblings('div').find('error').html("<span>*</span>请输入转账金额");
		$("input[name='money']").siblings('div').find('error').removeClass('hidden');
		stat=0;
		}
	if(bank_num.length==0){
		$("input[name='bank_num']").addClass('redborder');
		$("input[name='bank_num']").siblings('div').find('error').html("<span>*</span>请输入转账银行卡号");
		$("input[name='bank_num']").siblings('div').find('error').removeClass('hidden');
		stat=0;
		}		
	if(stat==0){
			return false;
	}else{
		var url=$(this).attr('action');
		var query = {};

		query['name']=name;
		query['money']=money;
		query['bank_num']=bank_num;
		$.post(url,query).success(function(data){
				 if (data.status==1) {
					 $('#popbox .controls').html('保存成功');
						center($("#popbox"));
						 setTimeout(function(){
                        location.href='/shadow/mast/area.html';
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