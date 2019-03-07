$("input").blur(function(){
  
  var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	
	case "WEB_SITE_TITLE":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入网站的标题");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "MAIL_ADDRESS":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入邮箱地址");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "MAIL_SMTP":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入邮箱SMTP服务器");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "MAIL_LOGINNAME":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入邮箱登录帐号");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "MAIL_PASSWORD":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入邮箱密码");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "MALL_SWITCH":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入邮箱开关");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "WEB_TITLE":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入官网标题");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "WEB_KEYWORDS":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入官网关键字");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "WEB_DESCRIPTION":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入官网描述");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	
  }
 
});
$("#updateform").submit(function(){
	var WEB_SITE_TITLE=$("input[name='WEB_SITE_TITLE']").val();
	var MAIL_ADDRESS=$("input[name='MAIL_ADDRESS']").val();
	
	var MAIL_SMTP=$("input[name='MAIL_SMTP']").val();
	var MAIL_LOGINNAME=$("input[name='MAIL_LOGINNAME']").val();
	
	var MAIL_PASSWORD=$("input[name='MAIL_PASSWORD']").val();
	var MALL_SWITCH=$("input[name='MALL_SWITCH']").val();
	
	var SYS_SPLT_SCALE=$("input[name='SYS_SPLT_SCALE']").val();
	 var stat=1;
	if(WEB_SITE_TITLE.length==0){
			$("input[name='WEB_SITE_TITLE']").addClass('redborder');
			$("input[name='WEB_SITE_TITLE']").siblings('div').find('error').html("<span>*</span>请输入网站的标题");
			$("input[name='WEB_SITE_TITLE']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		if(MAIL_ADDRESS.length==0){
			$("input[name='MAIL_ADDRESS']").addClass('redborder');
			$("input[name='MAIL_ADDRESS']").siblings('div').find('error').html("<span>*</span>请输入邮箱地址");
			$("input[name='MAIL_ADDRESS']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		if(MAIL_SMTP.length==0){
			$("input[name='MAIL_SMTP']").addClass('redborder');
			$("input[name='MAIL_SMTP']").siblings('div').find('error').html("<span>*</span>请输入邮箱SMTP服务器");
			$("input[name='MAIL_SMTP']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		if(MAIL_LOGINNAME.length==0){
			$("input[name='MAIL_LOGINNAME']").addClass('redborder');
			$("input[name='MAIL_LOGINNAME']").siblings('div').find('error').html("<span>*</span>请输入邮箱登录帐号");
			$("input[name='MAIL_LOGINNAME']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		if(MAIL_PASSWORD.length==0){
			$("input[name='MAIL_PASSWORD']").addClass('redborder');
			$("input[name='MAIL_PASSWORD']").siblings('div').find('error').html("<span>*</span>请输入邮箱密码");
			$("input[name='MAIL_PASSWORD']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		if(MALL_SWITCH.length==0){
			$("input[name='MALL_SWITCH']").addClass('redborder');
			$("input[name='MALL_SWITCH']").siblings('div').find('error').html("<span>*</span>请输入邮箱开关");
			$("input[name='MALL_SWITCH']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		
		if(stat==0){
			return false;
		}else{
			var url=$(this).attr('action');
			var query = $(this).serialize();
			 $.post(url,query).success(function(data){
				 if (data.status==1) {
					 $('#popbox .controls').html('保存信息成功');
						center($("#popbox"));
						 setTimeout(function(){
                        if (data.url) {
                            location.href=data.url;
                        }else{
                            location.reload();
                        }
                    },1500);
				 }else{
						alert("未知错误请联系管理员");
					 }
			})
			return false;
			}
return false;			
})
$("#updateform2").submit(function(){
	 var stat=1;
	
		if(stat==0){
			return false;
		}else{
			var url=$(this).attr('action');
			var query = $(this).serialize();
			 $.post(url,query).success(function(data){
				 if (data.status==1) {
					 $('#popbox .controls').html('保存信息成功');
						center($("#popbox"));
						 setTimeout(function(){
                        if (data.url) {
                            location.href=data.url;
                        }else{
                            location.reload();
                        }
                    },1500);
				 }else{
						alert("未知错误请联系管理员");
					 }
			})
			return false;
			}
return false;			
})