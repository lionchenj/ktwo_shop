$("#hidePW a").click(function(){
	$("#hidePW").addClass('hidden');
	$("#updatePW").removeClass('hidden');
});
$(".savePassword").click(function(){
	var newPassword=$("input[name='newPassword']").val();
	var confirmPassword=$("input[name='confirmPassword']").val();
	 if(newPassword.length==0){
			$("input[name='newPassword']").addClass('redborder');
			$("input[name='newPassword']").siblings('div').find('error').html("<span>*</span>请输入新密码");
			$("input[name='newPassword']").siblings('div').find('error').removeClass('hidden');
			return false;
		}
	if(confirmPassword.length==0){
			$("input[name='confirmPassword']").addClass('redborder');
			$("input[name='confirmPassword']").siblings('div').find('error').html("<span>*</span>请输入确认密码");
			$("input[name='confirmPassword']").siblings('div').find('error').removeClass('hidden');
			return false;
	}
	if(newPassword!=confirmPassword){
			$("input[name='newPassword']").addClass('redborder');
			$("input[name='confirmPassword']").addClass('redborder');
			$("input[name='confirmPassword']").siblings('div').find('error').html("<span>*</span>两次输入的密码不一致");
			$("input[name='confirmPassword']").siblings('div').find('error').removeClass('hidden');
			return false;
	}
	var url=$(this).attr('data-url');
	var query={};
	query['password']=newPassword;
	 $.post(url,query).success(function(data){
				 if (data.status==1) {
					$("#updatePW").addClass('hidden');
					$("#hidePW").removeClass('hidden');
                    $('#popbox .controls').html('修改密码成功，请记住新密码！')
					center($("#popbox"));
				 }else{
					 switch(data.info)
					 {
						case -1:
						$("input[name='newPassword']").addClass('redborder');
						$("input[name='confirmPassword']").addClass('redborder');
						$("input[name='newPassword']").siblings('div').find('error').html("<span>*</span>请输入密码");
						$("input[name='newPassword']").siblings('div').find('error').removeClass('hidden');
						break;
						default:
						alert("未知错误请联系管理员");
						break;
					 }
				 }
			 })
	return false;
	
})
$("input").blur(function(){
  
  var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	case "newPassword":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入新密码");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "confirmPassword":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入确认密码");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "email":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入邮箱地址");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else if(!/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/.test(vlaue)){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入正确邮箱地址");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "nickname":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入昵称");
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
	var email=$("input[name='email']").val();
	var nickname=$("input[name='nickname']").val();
	 var stat=1;
	if(email.length==0){
			$("input[name='email']").addClass('redborder');
			$("input[name='email']").siblings('div').find('error').html("<span>*</span>请输入邮箱地址");
			$("input[name='email']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}else if(!/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/.test(email)){
			$("input[name='email']").addClass('redborder');
			$("input[name='email']").siblings('div').find('error').html("<span>*</span>请输入正确邮箱地址");
			$("input[name='email']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		if(nickname.length==0){
			$("input[name='nickname']").addClass('redborder');
			$("input[name='nickname']").siblings('div').find('error').html("<span>*</span>请输入昵称");
			$("input[name='nickname']").siblings('div').find('error').removeClass('hidden');
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
				 }else{
					 switch(data.info)
					 {
						case -2:
						$("input[name='email']").addClass('redborder');
						$("input[name='email']").siblings('div').find('error').html("<span>*</span>请输入邮箱地址");
						$("input[name='email']").siblings('div').find('error').removeClass('hidden');
						break;
						case -1:
						$("input[name='nickname']").addClass('redborder');
						$("input[name='nickname']").siblings('div').find('error').html("<span>*</span>请输入昵称");
						$("input[name='nickname']").siblings('div').find('error').removeClass('hidden');
						break;
						case -3:
						$("input[name='email']").addClass('redborder');
						$("input[name='email']").siblings('div').find('error').html("<span>*</span>请输入正确邮箱地址");
						$("input[name='email']").siblings('div').find('error').removeClass('hidden');
						break;
						case -4:
						$("input[name='email']").addClass('redborder');
						$("input[name='email']").siblings('div').find('error').html("<span>*</span>邮箱被占用");
						$("input[name='email']").siblings('div').find('error').removeClass('hidden');
						break;
						default:
						alert("未知错误请联系管理员");
						break;
					 }
				 }
			})
			return false;
			}
})
