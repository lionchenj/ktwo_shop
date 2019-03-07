
$(document).ready(function(){

	var login = $('#loginform');
	var recover = $('#recoverform');
	var speed = 400;

	$('#to-recover').click(function(){
		
		$("#loginform").slideUp();
		$("#recoverform").fadeIn();
	});
	$('#to-login').click(function(){
		
		$("#recoverform").hide();
		$("#loginform").fadeIn();
	});
	
	
	$('#to-login').click(function(){
	
	});
    
    if($.browser.msie == true && $.browser.version.slice(0,3) < 10) {
        $('input[placeholder]').each(function(){ 
       
        var input = $(this);       
       
        $(input).val(input.attr('placeholder'));
               
        $(input).focus(function(){
             if (input.val() == input.attr('placeholder')) {
                 input.val('');
             }
        });
       
        $(input).blur(function(){
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.val(input.attr('placeholder'));
            }
        });
    });

        
        
    }
});
$("input").blur(function(){
  
  var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	case "username":
		if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).parent().siblings('error').html("<span>*</span>请输入用户名");
			$(this).parent().siblings('error').show();
		}else if(!/^[a-zA-Z][a-zA-Z0-9]{3,11}/.test(vlaue)){
			$(this).addClass('redborder');
			$(this).parent().siblings('error').html("<span>*</span>用户名必须以字母开头的4-12位的字母数字组合");
			$(this).parent().siblings('error').show();
		}else{
		$(this).removeClass('redborder');
		$(this).parent().siblings('error').html("");
		$(this).parent().siblings('error').hide();
		}
		break;
	case "password":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).parent().siblings('error').html("<span>*</span>请输入密码");
			$(this).parent().siblings('error').show();
	}else{
		$(this).removeClass('redborder');
		$(this).parent().siblings('error').html("");
		$(this).parent().siblings('error').hide();
	}
	break;
	case "email":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).parent().siblings('error').html("<span>*</span>请输入邮箱地址");
			$(this).parent().siblings('error').show();
	}else if(!/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/.test(vlaue)){
			$(this).addClass('redborder');
			$(this).parent().siblings('error').html("<span>*</span>请输入正确邮箱地址");
			$(this).parent().siblings('error').show();
	}else{
		$(this).removeClass('redborder');
		$(this).parent().siblings('error').html("");
		$(this).parent().siblings('error').hide();
	}
	break;
  }
 
});
$("#loginform").submit(function(){
  var username=$("input[name='username']").val();
  var password=$("input[name='password']").val();
  var stat=1;
  if(password.length==0){
			$("input[name='password']").addClass('redborder');
			$("input[name='password']").parent().siblings('error').html("<span>*</span>请输入密码");
			$("input[name='password']").parent().siblings('error').show();
			stat=0;
	}
	if(username.length==0){
			$("input[name='username']").addClass('redborder');
			$("input[name='username']").parent().siblings('error').html("<span>*</span>请输入用户名");
			$("input[name='username']").parent().siblings('error').show();
			stat=0;
		}else if(!/^[a-zA-Z][a-zA-Z0-9]{3,11}/.test(username)){
			$("input[name='username']").addClass('redborder');
			$("input[name='username']").parent().siblings('error').html("<span>*</span>用户名必须以字母开头的4-12位的字母数字组合");
			$("input[name='username']").parent().siblings('error').show();
			stat=0;
		}
		if(stat==0){
			return false;
		}else{
			var url=$(this).attr('action');
			var query = $(this).serialize();
			 $.post(url,query).success(function(data){
				 if (data.status==1) {
                        if (data.url) {
                            location.href=data.url;
                        }else{
                            location.reload();
                        }
				 }else{
					 switch(data.info)
					 {
						case -1:
						$("input[name='username']").addClass('redborder');
						$("input[name='username']").parent().siblings('error').html("<span>*</span>请输入用户名");
						$("input[name='username']").parent().siblings('error').show();
						break;
						case -2:
						$("input[name='username']").addClass('redborder');
						$("input[name='username']").parent().siblings('error').html("<span>*</span>用户名必须以字母开头的4-12位的字母数字组合");
						$("input[name='username']").parent().siblings('error').show();
						break;
						case -3:
						$("input[name='password']").addClass('redborder');
						$("input[name='password']").parent().siblings('error').html("<span>*</span>请输入密码");
						$("input[name='password']").parent().siblings('error').show();
						break;
						case -4:
						$("input[name='password']").addClass('redborder');
						$("input[name='password']").parent().siblings('error').html("<span>*</span>密码错误");
						$("input[name='password']").parent().siblings('error').show();
						break;
						case -5:
						$("input[name='username']").addClass('redborder');
						$("input[name='username']").parent().siblings('error').html("<span>*</span>用户名不存在");
						$("input[name='username']").parent().siblings('error').show();
						break;
						default:
						alert("未知错误请联系管理员");
						break;
					 }
				 }
			 })
			return false;
		}
  
});
$("#recoverform").submit(function(){
	var email=$("input[name='email']").val();
	 var stat=1;
	if(email.length==0){
			$("input[name='email']").addClass('redborder');
			$("input[name='email']").parent().siblings('error').html("<span>*</span>请输入邮箱地址");
			$("input[name='email']").parent().siblings('error').show();
			stat=0;
		}else if(!/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/.test(email)){
			$("input[name='email']").addClass('redborder');
			$("input[name='email']").parent().siblings('error').html("<span>*</span>请输入正确邮箱地址");
			$("input[name='email']").parent().siblings('error').show();
			stat=0;
		}
		if(stat==0){
			return false;
		}else{
			var url=$(this).attr('action');
			var query = $(this).serialize();
			 $.post(url,query).success(function(data){
				 if (data.status==1) {
					 $('form').hide();
					 $("#returnform").show();
				 }else{
					 switch(data.info)
					 {
						case -1:
						$("input[name='email']").addClass('redborder');
						$("input[name='email']").parent().siblings('error').html("<span>*</span>请输入邮箱地址");
						$("input[name='email']").parent().siblings('error').show();
						break;
						case -2:
						$("input[name='email']").addClass('redborder');
						$("input[name='email']").parent().siblings('error').html("<span>*</span>用户不存在");
						$("input[name='email']").parent().siblings('error').show();
						break;
						case -5:
						$("input[name='email']").addClass('redborder');
						$("input[name='email']").parent().siblings('error').html("<span>*</span>请勿重复提交，如若未收到邮件，请5分钟后尝试");
						$("input[name='email']").parent().siblings('error').show();
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