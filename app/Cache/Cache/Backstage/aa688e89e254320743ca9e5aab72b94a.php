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
<style>

.box1{ 
	background-color:#FFF;
	width:430px;
	height:430px;
	border:3px solid transparent; 
	overflow: hidden !important; 
	text-align: left;
	position:absolute;
	-moz-border-image:url(/tcm/template/Maruti/img/css-border-bg.jpg) 3 3 round;  /* Old Firefox */	
	-webkit-border-image:url(/tcm/template/Maruti/img/css-border-bg.jpg) 3 3 round;    /* Safari */	
	-o-border-image:url(/tcm/template/Maruti/img/css-border-bg.jpg) 3 3 round;   /* Opera */	
	border-image:url(/tcm/template/Maruti/img/css-border-bg.jpg) 3 3 round; 
	box-shadow:8px 10px 20px #b6b6b6;
    top: 30%;
	left:30%;
	display:none;
	z-index:9999;
}  
 .normal_text {
    padding: 15px 10px;
    text-align: center;
    font-size: 14px;
    line-height: 20px;
} 
.box1 .controls{
	margin-left: 20%;
}
.box1 label{
	height:50px;
	margin-top:13px;
}
.box {
    width:100%;
    height:100%;
    position:absolute;
    top:0;
    left:0;
    z-index:2;
    background-color: grey;
    opacity: 0.5;
    /*兼容IE8及以下版本浏览器*/
    filter: alpha(opacity=30);
    display:none;
}
</style>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/tcm/member.html" class="current">会员管理</a> </div>
	<h1>新增会员</h1>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>新增会员</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="/tcm/Member/operate/type/add.html" method="get" class="myform form-horizontal">								
									<div class="control-group">
										<label class="control-label">会员卡号:</label>											
										<div class="controls"><input name="card_num" type="text" class="span3" placeholder="会员卡号"  /> 
										<div><error class="color-red hidden"></error></div>
										</div>										
									</div>									
									<div class="control-group">
                                        <label class="control-label">用户手机号码</label>
                                        <div class="controls">
										<input type="text" name="mobile" class="span3"  placeholder="用户手机号码"  >
										<div><error class="color-red hidden"></error></div>
                                        </div>
                                    </div>									
									<div class="control-group">
										<label class="control-label">短信验证码:</label>
										<div class="controls ">									
											<input type="text" name="captcha"  placeholder="短信验证码"   class="span2"  /><button type="button" class="btn btn-success" id="get_captcha">获取验证码</button><div><error class="color-red hidden"></error></div>														
										</div>
									</div>   
									<div class="form-actions">
										<button type="button" id="confirm_submit" class="btn btn-success ajax-post" url="" target-form="myform">保存</button>
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
$(document).on('blur','input',function(){
  var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	case "mobile":
	if(vlaue.length==0||isPhone(vlaue)==false){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入正确手机号码");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#confirm_submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#confirm_submit").attr("disabled",false);
	}
	break;
	
	case "captcha":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入验证码");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#confirm_submit").attr("disabled",true);
			
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#confirm_submit").attr("disabled",false);
	}
	break;
	case "card_num":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入会员卡号");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#confirm_submit").attr("disabled",true);			
	}else{		
		var data={};
		data['card_num']=vlaue;
		var url="<?php echo U('Member/operate',array('type'=>'check_card'));?>";
			$.post(url,data).success(function(data){
				if (data.status==1) {					
					$("input[name='card_num']").removeClass('redborder');
					$("input[name='card_num']").siblings('div').find('error').html("");
					$("input[name='card_num']").siblings('div').find('error').addClass('hidden');
					$("#confirm_submit").attr("disabled",false);
				}else{				
					$("input[name='card_num']").addClass('redborder');
					$("input[name='card_num']").siblings('div').find('error').html("<span>*</span>"+data.info);
					$("input[name='card_num']").siblings('div').find('error').removeClass('hidden');
					$("#confirm_submit").attr("disabled",true);	
				}
			});
	}
	break;
	}
})
//数据格式验证int
$(document).on('change',".int",function(){
	var val=parseInt($(this).val());
	if(isNaN(val) || val==0){
		$(this).val(1);
	}else{
		$(this).val(val);
		}
		
})
</script>
<script>
		$('input[name="total"]').on('change',function(){			
			var money=$(this).val();
			$('input[name="money"]').val(money);
			$('#money').show();
			$(this).val(money);
		})
		$('.box').click(function(){
		$('.box1').hide();
			$(this).hide();
		})
		$('#get_captcha').click(function(){
			var mobile=$('input[name="mobile"]').val();									
			if(isPhone(mobile)==false){
				$("input[name='mobile']").addClass('redborder');
				$("input[name='mobile']").siblings('div').find('error').html("<span>*</span>请输入正确手机号码");
				$("input[name='mobile']").siblings('div').find('error').removeClass('hidden');
				return false;
			}
			
			var url='<?php echo U('Deposit/mobile_check');?>';
			var data={};
			data['mobile']=mobile;
			data['money']=$('input[name="money"]').val();	
			$.post(url,data).success(function(data){
				if (data.status==1) {
					$('#popbox .controls').html('发送成功');
					center($("#popbox"));
					return false;
				}else{
					$('#popbox .controls').html(data['info']);
					center($("#popbox"));
					return false;
				}
			});
		})
		$('#confirm_submit').click(function(){
			var mobile=$('input[name="mobile"]').val();	
			var stat=1;
				if(isPhone(mobile)==false){
					$("input[name='mobile']").addClass('redborder');
					$("input[name='mobile']").siblings('div').find('error').html("<span>*</span>请输入正确手机号码");
					$("input[name='mobile']").siblings('div').find('error').removeClass('hidden');
					stat=0;
				}			
			var card_num=$('input[name="card_num"]').val();									
			if(card_num==0){
				$("input[name='card_num']").addClass('redborder');
				$("input[name='card_num']").siblings('div').find('error').html("<span>*</span>请输入订单说明");
				$("input[name='card_num']").siblings('div').find('error').removeClass('hidden');
				stat=0;
			}
			var captcha=$('input[name="captcha"]').val();									
			if(isPhone(mobile)==false){
				$("input[name='captcha']").addClass('redborder');
				$("input[name='captcha']").siblings('div').find('error').html("<span>*</span>请输入验证码");
				$("input[name='captcha']").siblings('div').find('error').removeClass('hidden');
				stat=0;
			}
			if(stat){
				var url='/tcm/Member/operate/type/add.html';
				var data={};
				data['mobile']=mobile;
				data['card_num']=card_num;
				data['captcha']=captcha;
				$.post(url,data).success(function(data){
					if (data.status==1) {						
						$('#popbox .controls').html('创建成功');
						center($("#popbox"));
						setTimeout(function(){						
							location.href='/tcm/member.html';						
						},1500);
					}else{
						$('#popbox .controls').html(data['info']);
						center($("#popbox"));
						return false;
					}
				});
			}							
		})		
		function isPhone(phone) { 
			 var pattern = /^1[34578]\d{9}$/; 
			 return pattern.test(phone); 
		}
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