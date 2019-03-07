<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="apple-mobile-web-app-capable" content="yes"/><!-- 是否启用 WebApp 全屏模式 -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/><!-- 设置状态栏的背景颜色 -->
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no"/><!-- 禁止数字识自动别为电话号码 --><!-- 不让android识别邮箱 -->
	<title>中医馆个人资料</title>
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/common.css">
	<link rel="stylesheet" type="text/css" href="/tcm/template/Tcm/css/style.css">
	<script type="text/javascript" src="/tcm/template/Tcm/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/resize.js"></script>
	<script type="text/javascript" src="/tcm/template/Tcm/js/common.js"></script>
</head>
<body>
	<div class="title-info">
		<a href="javascript:history.go(-1);" class="back-link">
			<i class="icon-left-arrow"></i>返回
		</a>
		个人资料
	</div>
	<div class="data-list">
		<form action="" class="data-form">
			<ul>
				<li>
					<div class="data-item clearfix">
						<span class="data-name left">我的头像</span>
						<div class="data-img right">
							<img src="<?php echo ($info["headimgurl"]); ?>" class="upimg data-head">							
						</div>
						<span class="arrow-right"></span>
					</div>
				</li>
				<li>
					<a href="<?php echo U('About/change_name');?>" class="data-item clearfix">
						<span class="data-name left">我的昵称</span>
						<div class="data-input-wrap right">
							<?php echo ($info["nickname"]); ?>
						</div>
						<span class="arrow-right"></span>
					</a>
				</li>
				<li>
					<a href="<?php echo U('About/change_address');?>" class="data-item clearfix">
						<span class="data-name left">我的地址</span>
						<div class="data-input-wrap right">
							<span class="data-long-address"><?php echo ($info["address_province"]); echo ($info["address_city"]); echo ($info["address_area"]); echo ($info["address_info"]); ?></span>
						</div>
						<span class="arrow-right"></span>
					</a>
				</li>
			</ul>
			<input type="file" accept="image/*"  name="image2" multiple="multiple" style="width:100%;opacity:0;filter:alpha(opacity=0);" id="inputfile"/>
			<div class="btn-wrap">
				<button type="submit" class="save-btn">保存</button>
			</div>
		</form>
	</div>
	<!-- 提示弹窗 -->
	<div class="tips-box" style="display: none;"></div>
	<script type="text/javascript">
	$("#inputfile").change(function(){
     //创建FormData对象
     var data = new FormData();
     //为FormData对象添加数据
     //
	 var max=0;
     $.each($('#inputfile')[0].files, function(i, file) {
	 var size = file.size;
	  if(size > 2048000){
		max=1
		return false;
	  }
         data.append('imageFile', file);
     });
	 if(max==1){
		popup("仅支持上传2M以内的图片");
		return false;
	 }
     $.ajax({
         url:"https://wx.datazan.cn/tcm/File/update.html",
         type:'POST',
         data:data,
         cache: false,
         contentType: false,    //不可缺
         processData: false,    //不可缺
         success:function(data){
			console.log(data);
				if(data.status==1){
				$('#inputfile').val('');
				var url=data.path;
				$(".upimg").attr('src',url);	
				userinfo_save(url);
				}else{
				popup(data.info);
				return false;
				}
			   
         }
     });
	})
	$(document).on('click','.upimg',function(){
	$("#inputfile").click();
	});
	function userinfo_save(url){
		var api_url="<?php echo U('setUserInfo');?>";
				var query ={};
				query['headimgurl']=url;
				$.post(api_url,query).success(function(res){
					 location.reload();
				});
	}
	</script>
</body>
</html>