/**
 * Unicorn Admin Template
 * Diablo9983 -> diablo9983@gmail.com
**/
$(document).ready(function(){
	
	$("#form-wizard").formwizard({ 
		formPluginEnabled: true,
		validationEnabled: true,
		focusFirstInput : true,
		disableUIStyles : true,
	
		formOptions :{
			success: function(data){$("#status").fadeTo(500,1,function(){ $(this).html("<span>Form was submitted!</span>").fadeTo(5000, 0); })},
			beforeSubmit: function(data){alert(1)},
			dataType: 'json',
			resetForm: true
		},
		validationOptions : {
			rules: {
				mobile: "required",
				money: "required",
				goodsname:"required",
				captcha: "required"
			},
			messages: {
				mobile: "请输入正确手机号码",
				money: "请输入订单金额",
				goodsname: "请输入订单说明",
				captcha: "请输入验证码",	
			},
			errorClass: "help-inline",
			errorElement: "span",
			highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).parents('.control-group').removeClass('error');
			}
		}
	});	
});
