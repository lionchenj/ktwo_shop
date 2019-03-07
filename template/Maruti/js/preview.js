$(function(){
	var root = $('#root').attr('data-link');
	var divTop = $(".phone-wrap").offset().top;
	$(window).on("scroll",function(){
		var sTop = $(window).scrollTop();
		if(sTop >= divTop){
			$(".phone-wrap").css({
				position: 'fixed',
				top: '20px',
				left:'20px'
			});
		}else{
			$(".phone-wrap").css({
				position: 'absolute',
				top: '16px',
				left:'0'
			});
		}
	});

	$("#brandHead").on("change",function(){
		var data = new FormData();
		$.each($('#brandHead')[0].files, function(i, file){
         data.append('imageFile', file);
		});
		$.ajax({
			url:root+"/File/updateWechat.html",
			type:'POST',
			data:data,
			cache: false,
			contentType: false,    //不可缺
			processData: false,    //不可缺
			success:function(data){
				if(data.status==1){
					$("#headWrap .span2").eq(1).remove();
					var str = '<div class="span2 sm-coverImg">'+
								'<input type="hidden" name="logo_url" value="'+data.wx_img+'">'+
								'<input type="hidden" name="img_url" value="'+data.url+'">'+
								'</div>';
					$('#headWrap').find('.imgadd img').attr("src",data.url);			
					$("#headWrap").append(str);
					$("#x-brand-logo").attr("src",data.url);
					$("#headWrap error").addClass("hidden");
				}else{
					$('#popbox .controls').html(data.info);
					center($("#popbox"));
				}
			}
		})
	})

	$("#uploadBtn1").on("change",function(){
		var data = new FormData();
		$.each($('#uploadBtn1')[0].files, function(i, file){
         data.append('imageFile', file);
		});
		$.ajax({
			url:root+"/File/updateWechat.html",
			type:'POST',
			data:data,
			cache: false,
			contentType: false,    //不可缺
			processData: false,    //不可缺
			success:function(data){
				if(data.status==1){
					$("#coverWrap1 .span2").eq(1).remove();
					var str = '<div class="span2 sm-coverImg">'+
								'<input type="hidden" name="icon_url_list[]" value="'+data.wx_img+'">'+
								'<input type="hidden" name="brand_url" value="'+data.url+'">'+
								'</div>';
					$('#coverWrap1').find('.imgadd img').attr("src",data.url);						
					$("#coverWrap1").append(str);
					$(".x-card-cell").show();
					$("#x-cover-wrap img").attr("src",data.url);
					$("#coverWrap1 error").addClass("hidden");
				}else{
					$('#popbox .controls').html(data.info);
					center($("#popbox"));
				}
			}
		})
	})

	$("#uploadBtn2").on("change",function(){
		var data = new FormData();
		$.each($('#uploadBtn2')[0].files, function(i, file){
         data.append('imageFile', file);
		});
		$.ajax({
			url:root+"/File/updateWechat.html",
			type:'POST',
			data:data,
			cache: false,
			contentType: false,    //不可缺
			processData: false,    //不可缺
			success:function(data){
				if(data.status==1){
					var str = '<a class="thumbnail imgadd" href="javascript:;" onclick="getElementById('+"'uploadBtn2'"+').click()">'+
								'<img src="'+data.url+'" alt="" >'+
								'<input type="hidden" name="icon_url_list" id="wx-src" value="'+data.wx_img+'">'+
								'<input type="hidden" name="img_url" value="'+data.url+'">'+								
								'</a>';
					$("#uploadBtn2").parents(".article-cont").find(".article-img").html(str);
					$("#uploadBtn2").val("");
				}else{
					$('#popbox .controls').html(data.info);
					center($("#popbox"));
				}
			}
		})
	})

	$("#article-add").on("click",function(){
		$(".article-cont").show();
	})

	$("#article-no").on("click",function(){
		$(".article-cont,.article-perview").hide();
		$(".article-perview").html("");
		$(".article-cont .article-img").html('<a class="thumbnail imgadd" href="javascript:;" onclick="getElementById('+"'uploadBtn2'"+').click()"><i class="icon-picture"></i></a>');
		$(".article-cont .article-area textarea").val("");
	})

	$("#article-yes").on("click",function(){
		var imgSrc = $(".article-img").find("img").attr("src");
		var wxSrc = $(".article-img").find("#wx-src").val();
		var text = $(".article-area textarea").val();
		var num=$('.article-perItem').length;
		if(imgSrc&&text){
			var str = '<div class="article-perItem">'+
						'<div class="article-p-wrap">'+
							'<img src="'+imgSrc+'" alt="">'+
							'<input type="hidden" name="text_image_list['+num+'][image_url]" value="'+wxSrc+'">'+
							'<input type="hidden" name="text_image_list['+num+'][img_url]" value="'+imgSrc+'">'+
						'</div>'+
						'<div class="article-p-text">'+text+'</div>'+
						'<input type="hidden" name="text_image_list['+num+'][text]" value="'+text+'">'+
						'</div>';
			$(".article-perview").show();
			$(".article-perview").append(str);
			$(".article-cont .article-img").html('<a class="thumbnail imgadd" href="javascript:;" onclick="getElementById('+"'uploadBtn2'"+').click()"><i class="icon-picture"></i></a>');
			$(".article-cont .article-area textarea").val("");
		}else{
			$('#popbox .controls').html("图片和描述都不能为空");
			center($("#popbox"));
		}
	})

	/*预览效果*/

	function perviewText(e1,e2){
		$(e2).text(e1.val());
	}

	function ValidateDate(beginDate,endDate) {
        if (beginDate.length > 0 && endDate.length>0) {
            var sDate = new Date(beginDate.replace(/\./g, "\/"));
            var eDate= new Date(endDate.replace(/\./g, "\/"));
            if (sDate >= eDate) {
            	$('#popbox .controls').html("开始日期要小于结束日期");
				center($("#popbox"));
				return false;
            }else{
            	return true;
            }
        }
    }

    function checkDate(num){
    	if(num<10){
    		return "0"+num;
    	}else{
    		return num;
    	}
    }

    function getNowDate(){
    	var date = new Date();
    	return date.getFullYear()+"-"+checkDate(date.getMonth()+1)+"-"+checkDate(date.getDate());
    }

    function addDate(d,add){
		var a = new Date(d);
		a = a.valueOf();
		a = a + add * 24 * 60 * 60 * 1000;
		a = new Date(a);
		return a;
	}

	$("#brandName").on("input",function(){
		perviewText($(this),"#x-brand-name");
	})

	$("#title").on("input",function(){
		perviewText($(this),"#x-title");
	})

	$("#colorList li a").on("click",function(){
		var color = $(this).css("backgroundColor");
		$(".phone-wrap").css("backgroundColor",color);
		$(".x-btn-use").css({
			"backgroundColor":color,
			"color":"#fff"
		});
	})

	$("#time1-1").datepicker().on("changeDate",function(){
		var isChecked = $("#time1 input[type=radio]").prop("checked");
		var startDate = $(this).val().replace(/\-/g,".");
		var endDate = $("#time1-2").val().replace(/\-/g,".");
		var str = (isChecked&&endDate&&ValidateDate(startDate,endDate))?(startDate+"-"+endDate+"，"):"";
		$("#x-limit-date").text(str);
	})

	$("#time1-2").datepicker().on("changeDate",function(){
		var isChecked = $("#time1 input[type=radio]").prop("checked");
		var endDate = $(this).val().replace(/\-/g,".");
		var startDate = $("#time1-1").val().replace(/\-/g,".");
		var str = (isChecked&&startDate&&ValidateDate(startDate,endDate))?(startDate+"-"+endDate+"，"):"";
		$("#x-limit-date").text(str);
	})

	$("#time1 input[type=radio]").on("change",function(){
		var isChecked = $(this).prop("checked");
		var startDate = $("#time1-1").val().replace(/\-/g,".");
		var endDate = $("#time1-2").val().replace(/\-/g,".");
		var str = (isChecked&&startDate&&endDate&&ValidateDate(startDate,endDate))?(startDate+"-"+endDate+"，"):"";
		$("#x-limit-date").text(str);
	})

	$("#time2 input[type=radio]").on("change",function(){
		var isChecked = $(this).prop("checked");
		var time = getNowDate();
		var d1 = $("#time2-1").val();
		var d2 = $("#time2-2").val();
		var ad1 = addDate(time,d1);
		var ad_date1 = ad1.getFullYear()+"."+checkDate(ad1.getMonth()+1)+"."+checkDate(ad1.getDate());
		var ad2 = addDate(addDate(time,d1),d2);
		var ad_date2 = ad2.getFullYear()+"."+checkDate(ad2.getMonth()+1)+"."+checkDate(ad2.getDate());
		var str = isChecked ? (ad_date1+"-"+ad_date2+"，"):"";
		$("#x-limit-date").text(str);
		if(isChecked){
			$("#time1 input").removeClass("redborder");
			$("#time1").siblings("div").find("error").addClass("hidden");
		}
	})

	$("#time2-1").on("change",function(){
		var isChecked = $("#time2 input[type=radio]").prop("checked");
		var time = getNowDate();
		var d1 = $("#time2-1").val();
		var d2 = $("#time2-2").val();
		var ad1 = addDate(time,d1);
		var ad_date1 = ad1.getFullYear()+"."+checkDate(ad1.getMonth()+1)+"."+checkDate(ad1.getDate());
		var ad2 = addDate(addDate(time,d1),d2);
		var ad_date2 = ad2.getFullYear()+"."+checkDate(ad2.getMonth()+1)+"."+checkDate(ad2.getDate());
		var str = isChecked ? (ad_date1+"-"+ad_date2+"，"):"";
		$("#x-limit-date").text(str);
	})

	$("#time2-2").on("change",function(){
		var isChecked = $("#time2 input[type=radio]").prop("checked");
		var time = getNowDate();
		var d1 = $("#time2-1").val();
		var d2 = $("#time2-2").val();
		var ad1 = addDate(time,d1);
		var ad_date1 = ad1.getFullYear()+"."+checkDate(ad1.getMonth()+1)+"."+checkDate(ad1.getDate());
		var ad2 = addDate(addDate(time,d1),d2);
		var ad_date2 = ad2.getFullYear()+"."+checkDate(ad2.getMonth()+1)+"."+checkDate(ad2.getDate());
		var str = isChecked ? (ad_date1+"-"+ad_date2+"，"):"";
		$("#x-limit-date").text(str);
	})

	$("#useTime1 input").on("change",function(){
		var isChecked = $(this).prop("checked");
		if(isChecked){
			$("#timeList").hide();
		}else{
			$("#timeList").show();
		}
		$("#x-limit-time").text("周一至周日");
	})
	$("#useTime2 input").on("change",function(){
		var isChecked = $(this).prop("checked");
		if(isChecked){
			$("#timeList").show();
		}else{
			$("#timeList").hide();
		}
	})

	$("#weekList input").on("change",function(){
		var len = $("#weekList input:checked").length;
		var array = [];
		var str = "";
		if(len>0){
			$("#weekList input:checked").each(function(i,value){
				var dataId = $(this).attr("data-id");
				array.push(dataId);
			})
			str = array.toString();
			$("#x-limit-time").text(getWeek(str));
		}else{
			$("#x-limit-time").text("");
		}
	})

	$("#addTimeBtn1").on("click",function(){
		$(this).parent().hide();
		$("#x-main-timeWrap").show();
	})
	$("#addTimeBtn2").on("click",function(){
		$(this).hide();
		$("#addTimeBtn3").hide();
		$("#addTimeBtn4").show();
		$(".x-wrap-time").eq(1).show();
	})
	$("#addTimeBtn3").on("click",function(){
		$("#x-main-timeWrap").hide();
		$("#d-time1 input").val("");
		$("#addTimeBtn1").parent().show();
	})
	$("#addTimeBtn4").on("click",function(){
		$(this).hide();
		$("#addTimeBtn2").show();
		$("#addTimeBtn3").show();
		$(".x-wrap-time").eq(1).hide();
		$("#d-time2 input").val("");
	})

	$("#d-time1-1").on("blur",function(){
		var v1 = $(this).val();
		var v2 = $("#d-time1-2").val();
		$("#x-limit-hour").text(checkTime(v1,v2));
	})
	$("#d-time1-2").on("blur",function(){
		var v1 = $("#d-time1-1").val();
		var v2 = $(this).val();
		$("#x-limit-hour").text(checkTime(v1,v2));
	})
	$("#d-time2-1").on("blur",function(){
		var v1 = $(this).val();
		var v2 = $("#d-time2-2").val();
		$("#x-limit-hour-2").text(checkTime(v1,v2));
	})
	$("#d-time2-2").on("blur",function(){
		var v1 = $("#d-time2-1").val();
		var v2 = $(this).val();
		$("#x-limit-hour-2").text(checkTime(v1,v2));
	})
	
	$("#coverDes").on("input",function(){
		var display = $(".x-card-cell").css("display");
		var val = $(this).val();
		if(display == "block"){
			$("#x-abstract").text(val);
		}else{
			$("#x-abstract").text("");
		}
	})
	
	$("#custom-name").on("input",function(){
		var v1 = $(this).val();
		v1?$("#custom-label").text(v1):$("#custom-label").text("自定义入口（选填）");
	})
	
	$("#custom-text").on("input",function(){
		var v1 = $(this).val();
		v1?$("#custom-tips").text(v1):$("#custom-tips").text("");
	})
	
	$("#condition-list").on("change","#discount-box",function(){
		var isChecked = $(this).prop("checked");
		isChecked?$("#discount-area").show():$("#discount-area").hide().find("input").val("");
		if(!isChecked){
			var v1 = $("#discountNum").val();
			var isSelected = $("#shareChoose").val();
			var v2 = "";
			var v3 = "";	
			var v4 = isSelected?$("#shareChoose").val():"";
			setDesc1(v1,v2,v3,v4);
			$(".x-card-usage li").eq(0).hide();
			$("#x-condition").text("");
		}
	})
	
	$("#condition-list").on("change","#cash-box-1",function(){
		var isChecked = $(this).prop("checked");
		isChecked?$("#cash-item-1").show():$("#cash-item-1").hide().find("input").val("");
		if(!isChecked){
			var v1 = $("#reduceMoney").val();
			var isChecked_2 = $("#cash-box-2").prop("checked");
			var isSelected = $("#shareChoose").val();
			var v2 = "";
			var v3 = isChecked_2?$("#canUse-2").val():"";
			var v4 = isChecked_2?$("#notUse-2").val():"";
			var v5 = isSelected?$("#shareChoose").val():"";
			setDesc2(v1,v2,v3,v4,v5);
			if(v3||v4){
				$(".x-card-usage li").eq(0).show();
				var s1 = v3 ? "适用于"+v3+"；" : "";
				var s2 = v4 ? "不适用于"+v4+"；" : "";
				$("#x-condition").text(s1+s2);
			}else if(!v2&&!v3&&!v4){
				$(".x-card-usage li").eq(0).hide();
				$("#x-condition").text("");
			}
		}
	})
	
	$("#condition-list").on("change","#cash-box-2",function(){
		var isChecked = $(this).prop("checked");
		isChecked?$("#cash-item-2").show():$("#cash-item-2").hide().find("input").val("");
		if(!isChecked){
			var v1 = $("#reduceMoney").val();
			var isChecked_1 = $("#cash-box-1").prop("checked");
			var isSelected = $("#shareChoose").val();
			var v2 = isChecked_1?$("#cash-money").val():"";;
			var v3 = "";
			var v4 = "";
			var v5 = isSelected?$("#shareChoose").val():"";
			setDesc2(v1,v2,v3,v4,v5);
			if(v2){
				$(".x-card-usage li").eq(0).show();
				var s1 = v2 ? "消费满"+v2+"元可用；" : "";
				$("#x-condition").text(s1);
			}else if(!v2&&!v3&&!v4){
				$(".x-card-usage li").eq(0).hide();
				$("#x-condition").text("");
			}
		}
	})
	
	$("#condition-list").on("change","#gift-box",function(){
		var isChecked_2 = $(this).prop("checked");
		isChecked_2?$("#gift-item").show():$("#gift-item").hide().find("input").val("");
		if(!isChecked_2){
			$(".x-card-usage li").eq(0).hide();
		}
		setDesc3();
	})
	
	$("#condition-list").on("change","#giftSelect",function(){
		var s_value = $(this).val();
		if(s_value=="1"){
			$("#giftMoney").show().siblings().hide().find("input").val("");
			$(".x-card-usage li").eq(0).hide();
		}else if(s_value=="2"){
			$("#giftGoods").show().siblings().hide().find("input").val("");
			$(".x-card-usage li").eq(0).hide();
		}
		setDesc3();
	})
	$(".use-condition-3").on("change","#shareChoose",function(){			
		setDesc3();
	})
	$("#change").on("input","#discountNum",function(){
		var v1 = $(this).val();
		var isChecked = $("#discount-box").prop("checked");
		var isSelected = $("#shareChoose").val();
		var v2 = isChecked?$("#canUse").val():"";
		var v3 = isChecked?$("#notUse").val():"";	
		var v4 = isSelected?$("#shareChoose").val():"";
		setDesc1(v1,v2,v3,v4);
	})
	$("#condition-list").on("input","#canUse,#notUse",function(){
		var v1 = $("#discountNum").val();
		var isChecked = $("#discount-box").prop("checked");
		var isSelected = $("#shareChoose").val();
		var v2 = isChecked?$("#canUse").val():"";
		var v3 = isChecked?$("#notUse").val():"";	
		var v4 = isSelected?$("#shareChoose").val():"";
		setDesc1(v1,v2,v3,v4);
		if(isChecked && (v2||v3)){
			$(".x-card-usage li").eq(0).show();
			var s1 = v2 ? "适用于"+v2+"；" : "";
			var s2 = v3 ? "不适用于"+v3+"；" : "";
			$("#x-condition").text(s1+s2);
		}
	})
	$("#shareChoose").on("change",function(){
		var typeText = $("#type").text();
		switch(typeText){
			case "折扣券":
				var v1 = $("#discountNum").val();
				var isChecked = $("#discount-box").prop("checked");
				var isSelected = $("#shareChoose").val();
				var v2 = isChecked?$("#canUse").val():"";
				var v3 = isChecked?$("#notUse").val():"";	
				var v4 = isSelected?$("#shareChoose").val():"";
				setDesc1(v1,v2,v3,v4);
			break;
			case "代金券":
				var v1 = $("#reduceMoney").val();
				var isChecked_1 = $("#cash-box-1").prop("checked");
				var isChecked_2 = $("#cash-box-2").prop("checked");
				var isSelected = $("#shareChoose").val();
				var v2 = isChecked_1?$("#cash-money").val():"";
				var v3 = isChecked_2?$("#canUse-2").val():"";
				var v4 = isChecked_2?$("#notUse-2").val():"";
				var v5 = isSelected?$("#shareChoose").val():"";
				setDesc2(v1,v2,v3,v4,v5);
			break;
			case "兑换券":
				setDesc3();
			break;
			case "团购券":
				var isSelected = $("#shareChoose").val();
				var v1 = isSelected?$("#shareChoose").val():"";
				setDesc4(v1);
			break;
			case "优惠券":
				var isSelected = $("#shareChoose").val();
				var v1 = isSelected?$("#shareChoose").val():"";
				setDesc4(v1);
			break;
			default:
			break;
		}
		
	})
	
	$("#ticketPiece").on("input",function(){
		var v1 = $(this).val();
		v1?$("#user-know").text("每人限领"+v1+"张"):$("#user-know").text("");
	})
	
	$("#change").on("input","#reduceMoney",function(){
		var v1 = $(this).val();
		var isChecked_1 = $("#cash-box-1").prop("checked");
		var isChecked_2 = $("#cash-box-2").prop("checked");
		var isSelected = $("#shareChoose").val();
		var v2 = isChecked_1?$("#cash-money").val():"";
		var v3 = isChecked_2?$("#canUse-2").val():"";
		var v4 = isChecked_2?$("#notUse-2").val():"";
		var v5 = isSelected?$("#shareChoose").val():"";
		setDesc2(v1,v2,v3,v4,v5);
	})
	$("#condition-list").on("input","#canUse-2,#notUse-2,#cash-money",function(){
		var v1 = $("#reduceMoney").val();
		var isChecked_1 = $("#cash-box-1").prop("checked");
		var isChecked_2 = $("#cash-box-2").prop("checked");
		var isSelected = $("#shareChoose").val();
		var v2 = isChecked_1?$("#cash-money").val():"";
		var v3 = isChecked_2?$("#canUse-2").val():"";
		var v4 = isChecked_2?$("#notUse-2").val():"";
		var v5 = isSelected?$("#shareChoose").val():"";
		setDesc2(v1,v2,v3,v4,v5);
		if((isChecked_1||isChecked_2) && (v2||v3||v4)){
			$(".x-card-usage li").eq(0).show();
			var s1 = v2 ? "消费满"+v2+"元可用；":"";
			var s2 = v3 ? "适用于"+v3+"；" : "";
			var s3 = v4 ? "不适用于"+v4+"；" : "";
			$("#x-condition").text(s1+s2+s3);
		}
	})
	
	$("#title").on("input",function(){
		if($("#type").text()=='兑换券'){
			setDesc3();
		}
	});
	$("#condition-list").on("input","#giftGoods input,#giftMoney input",function(){
		setDesc3();
		var n_v1 = $("#giftMoney input").val();
		var n_v2 = $("#giftGoods input").val();
		var isChecked_2 = $("#gift-box").prop("checked");
		if(isChecked_2 && $("#giftSelect").val()=="1" && n_v1){
			$(".x-card-usage li").eq(0).show();
			$("#x-condition").text("消费满"+n_v1+"元可用");
		}else if(isChecked_2 && $("#giftSelect").val()=="2" && n_v2){
			$(".x-card-usage li").eq(0).show();
			$("#x-condition").text("购买"+n_v2+"可用");
		}else{
			$(".x-card-usage li").eq(0).hide();
		}
		
	})
	
})

function setDesc1(v1,v2,v3,v4){
	var str1 = "凭此券消费打"+v1+"折";
	var str2 = "适用于"+v2;
	var str3 = "不适用于"+v3;
	var str4 = v4;
	var str0 = "；";
	if(v1&&v2&&v3&&v4){
		$("#discount-text").text(str1+str0+str2+str0+str3+str0+str4);
	}else if(v1&&!v2&&!v3&&!v4){
		$("#discount-text").text(str1);
	}else if(!v1&&v2&&!v3&&!v4){
		$("#discount-text").text(str2);
	}else if(!v1&&!v2&&v3&&!v4){
		$("#discount-text").text(str3);
	}else if(!v1&&!v2&&!v3&&v4){
		$("#discount-text").text(str4);
	}else if(v1&&v2&&!v3&&!v4){
		$("#discount-text").text(str1+str0+str2);
	}else if(v1&&!v2&&v3&&!v4){
		$("#discount-text").text(str1+str0+str3);
	}else if(v1&&!v2&&!v3&&v4){
		$("#discount-text").text(str1+str0+str4);
	}else if(!v1&&v2&&v3&&!v4){
		$("#discount-text").text(str2+str0+str3);
	}else if(!v1&&v2&&!v3&&v4){
		$("#discount-text").text(str2+str0+str4);
	}else if(!v1&&!v2&&v3&&v4){
		$("#discount-text").text(str3+str0+str4);
	}else if(v1&&v2&&v3&&!v4){
		$("#discount-text").text(str1+str0+str2+str0+str3);
	}else if(v1&&!v2&&v3&&v4){
		$("#discount-text").text(str1+str0+str3+str0+str4);
	}else if(!v1&&v2&&v3&&v4){
		$("#discount-text").text(str2+str0+str3+str0+str4);
	}else if(!v1&&!v2&&!v3&&!v4){
		$("#discount-text").text("（本行是非自定义内容，无须填写）");
	}
}

function setDesc2(v1,v2,v3,v4,v5){
	var str1 = "价值"+v1+"元代金券一张";
	var str2 = "消费满"+v2+"元可用";
	var str3 = "适用于"+v3; 
	var str4 = "不适用于"+v4;
	var str5 = v5;
	var str0 = "；";
	if(v1&&v2&&v3&&v4&&v5){
		$("#discount-text").text(str1+str0+str2+str0+str3+str0+str4+str0+str5);
	}else if(v1&&!v2&&!v3&&!v4&&!v5){
		$("#discount-text").text(str1);
	}else if(!v1&&v2&&!v3&&!v4&&!v5){
		$("#discount-text").text(str2);
	}else if(!v1&&!v2&&v3&&!v4&&!v5){
		$("#discount-text").text(str3);
	}else if(!v1&&!v2&&!v3&&v4&&!v5){
		$("#discount-text").text(str4);
	}else if(!v1&&!v2&&!v3&&!v4&&v5){
		$("#discount-text").text(str5);
	}else if(v1&&v2&&!v3&&!v4&&!v5){
		$("#discount-text").text(str1+str0+str2);
	}else if(v1&&!v2&&v3&&!v4&&!v5){
		$("#discount-text").text(str1+str0+str3);
	}else if(v1&&!v2&&!v3&&v4&&!v5){
		$("#discount-text").text(str1+str0+str4);
	}else if(v1&&!v2&&!v3&&!v4&&v5){
		$("#discount-text").text(str1+str0+str5);
	}else if(!v1&&v2&&v3&&!v4&&!v5){
		$("#discount-text").text(str2+str0+str3);
	}else if(!v1&&v2&&!v3&&v4&&!v5){
		$("#discount-text").text(str2+str0+str4);
	}else if(!v1&&v2&&!v3&&!v4&&v5){
		$("#discount-text").text(str2+str0+str5);
	}else if(!v1&&!v2&&v3&&v4&&!v5){
		$("#discount-text").text(str3+str0+str4);
	}else if(!v1&&!v2&&v3&&!v4&&v5){
		$("#discount-text").text(str3+str0+str5);
	}else if(!v1&&!v2&&!v3&&v4&&v5){
		$("#discount-text").text(str4+str0+str5);
	}else if(v1&&v2&&v3&&!v4&&!v5){
		$("#discount-text").text(str1+str0+str2+str0+str3);
	}else if(v1&&!v2&&v3&&v4&&!v5){
		$("#discount-text").text(str1+str0+str3+str0+str4);
	}else if(v1&&!v2&&!v3&&v4&&v5){
		$("#discount-text").text(str1+str0+str4+str0+str5);
	}else if(!v1&&v2&&v3&&v4&&!v5){
		$("#discount-text").text(str2+str0+str3+str0+str4);
	}else if(!v1&&v2&&v3&&!v4&&v5){
		$("#discount-text").text(str2+str0+str3+str0+str5);
	}else if(!v1&&!v2&&v3&&v4&&v5){
		$("#discount-text").text(str3+str0+str4+str0+str5);
	}else if(v1&&v2&&v3&&v4&&!v5){
		$("#discount-text").text(str1+str0+str2+str0+str3+str0+str4);
	}else if(v1&&v2&&v3&&!v4&&v5){
		$("#discount-text").text(str1+str0+str2+str0+str3+str0+str5);
	}else if(!v1&&v2&&v3&&v4&&v5){
		$("#discount-text").text(str2+str0+str3+str0+str4+str0+str5);
	}else if(!v1&&!v2&&!v3&&!v4&&!v5){
		$("#discount-text").text("（本行是非自定义内容，无须填写）");
	}
}

function setDesc3(){
	var v1 = $("#title").val();
	var isChecked_1 = $("#gift-box").prop("checked");
	var isSelected_1 = $("#shareChoose").val();
	var s1 = $("#giftSelect").val();
	var str0 = "；";
	var str1 = v1;
	var v2,str2 = "";
	var v3 = isSelected_1?$("#shareChoose").val():"";
	var str3 = v3;
	if(isChecked_1 && s1=="1"){//金额
		v2 = $("#giftMoney input").val();
		str2 = "消费满"+v2+"元可用";
	}else if(isChecked_1 && s1=="2"){//指定商品
		v2 = $("#giftGoods input").val();
		str2 = "购买"+v2+"可用";
	}
	if(v1&&v2&&v3){
		$("#discount-text").text(str1+str0+str2+str0+str3);
	}else if(v1&&!v2&&!v3){
		$("#discount-text").text(str1);
	}else if(!v1&&v2&&!v3){
		$("#discount-text").text(str2);
	}else if(!v1&&!v2&&v3){
		$("#discount-text").text(str3);
	}else if(v1&&v2&&!v3){
		$("#discount-text").text(str1+str0+str2);
	}else if(v1&&!v2&&v3){
		$("#discount-text").text(str1+str0+str3);
	}else if(!v1&&v2&&v3){
		$("#discount-text").text(str2+str0+str3);
	}else if(!v1&&!v2&&!v3){
		$("#discount-text").text("（本行是非自定义内容，无须填写）");
	}
}

function setDesc4(v1){
	v1?$("#discount-text").text(v1):$("#discount-text").text("")
}

function checkTime(v1,v2){
	if(validateTime(v1)&&validateTime(v2)){
		if(v1 == v2){
			$('#popbox .controls').html("两个时间不能相等");
			center($("#popbox"));
			return "";
		}else{
			return v1+"-"+v2;
		}
	}else if(v1 && !validateTime(v1)){
		$('#popbox .controls').html("第一个时间格式不对");
			center($("#popbox"));
		return "";
	}else if(v2 && !validateTime(v2)){
		$('#popbox .controls').html("第二个时间格式不对");
			center($("#popbox"));
		return "";
	}
}

function validateTime(time){
	var reg= /^([0-1][0-9]|2[0-4]):([0-5][0-9])$/;
	if(reg.test(time)){
		return true;
	}else{
		return false;
	}
}

function getWeek(str){
	switch (str) {
		case '1':
		return "周一";
		break;
		case '2':
		return "周二";
		break;
		case '3':
		return "周三";
		break;
		case '4':
		return "周四";
		break;
		case '5':
		return "周五";
		break;
		case '6':
		return "周六";
		break;
		case '7':
		return "周日";
		break;
		case '1,2':
		return "周一至周二";
		break;
		case '1,3':
		return "周一、周三";
		break;
		case '1,4':
		return "周一、周四";
		break;
		case '1,5':
		return "周一、周五";
		break;
		case '1,6':
		return "周一、周六";
		break;
		case '1,7':
		return "周一、周日";
		break;
		case '2,3':
		return "周二至周三";
		break;
		case '2,4':
		return "周二、周四";
		break;
		case '2,5':
		return "周二、周五";
		break;
		case '2,6':
		return "周二、周六";
		break;
		case '2,7':
		return "周二、周日";
		break;
		case '3,4':
		return "周三至周四";
		break;
		case '3,5':
		return "周三、周五";
		break;
		case '3,6':
		return "周三、周六";
		break;
		case '3,7':
		return "周三、周日";
		break;
		case '4,5':
		return "周四至周五";
		break;
		case '4,6':
		return "周四、周六";
		break;
		case '4,7':
		return "周四、周日";
		break;
		case '5,6':
		return "周五至周六";
		break;
		case '5,7':
		return "周五、周日";
		break;
		case '6,7':
		return "周六至周日";
		break;
		case '1,2,3':
		return "周一至周三";
		break;
		case '1,2,4':
		return "周一至周二、周四";
		break;
		case '1,2,5':
		return "周一至周二、周五";
		break;
		case '1,2,6':
		return "周一至周二、周六";
		break;
		case '1,2,7':
		return "周一至周二、周日";
		break;
		case '1,3,4':
		return "周一、周三至周四";
		break;
		case '1,3,5':
		return "周一、周三、周五";
		break;
		case '1,3,6':
		return "周一、周三、周六";
		break;
		case '1,3,7':
		return "周一、周三、周日";
		break;
		case '1,4,5':
		return "周一、周四至周五";
		break;
		case '1,4,6':
		return "周一、周四、周六";
		break;
		case '1,4,7':
		return "周一、周四、周日";
		break;
		case '1,5,6':
		return "周一、周五至周六";
		break;
		case '1,5,7':
		return "周一、周五、周日";
		break;
		case '1,6,7':
		return "周一、周六至周日";
		break;
		case '2,3,4':
		return "周二至周四";
		break;
		case '2,3,5':
		return "周二至周三、周五";
		break;
		case '2,3,6':
		return "周二至周三、周六";
		break;
		case '2,3,7':
		return "周二至周三、周日";
		break;
		case '2,4,5':
		return "周二、周四至周五";
		break;
		case '2,4,6':
		return "周二、周四、周六";
		break;
		case '2,4,7':
		return "周二、周四、周日";
		break;
		case '2,5,6':
		return "周二、周五至周六";
		break;
		case '2,5,7':
		return "周二、周五、周日";
		break;
		case '2,6,7':
		return "周二、周六至周日";
		break;
		case '3,4,5':
		return "周三至周五";
		break;
		case '3,4,6':
		return "周三至周四、周六";
		break;
		case '3,4,7':
		return "周三至周四、周日";
		break;
		case '3,5,6':
		return "周三、周五至周六";
		break;
		case '3,5,7':
		return "周三、周五、周日";
		break;
		case '3,6,7':
		return "周三、周六至周日";
		break;
		case '4,5,6':
		return "周四至周六";
		break;
		case '4,5,7':
		return "周四至周五、周日";
		break;
		case '4,6,7':
		return "周四、周六至周日";
		break;
		case '5,6,7':
		return "周五至周日";
		break;
		case '1,2,3,4':
		return "周一至周四";
		break;
		case '1,2,3,5':
		return "周一至周三、周五";
		break;
		case '1,2,3,6':
		return "周一至周三、周六";
		break;
		case '1,2,3,7':
		return "周一至周三、周日";
		break;
		case '1,2,4,5':
		return "周一至周二、周四至周五";
		break;
		case '1,2,4,6':
		return "周一至周三、周六";
		break;
		case '1,2,4,7':
		return "周一至周三、周日";
		break;
		case '1,2,5,6':
		return "周一至周二、周五至周六";
		break;
		case '1,2,5,7':
		return "周一至周二、周五至周日";
		break;
		case '1,2,6,7':
		return "周一至周二、周六至周日";
		break;
		case '1,3,4,5':
		return "周一、周三至周五";
		break;
		case '1,3,4,6':
		return "周一、周三至周六";
		break;
		case '1,3,4,7':
		return "周一、周三至周四、周日";
		break;
		case '1,3,5,6':
		return "周一、周三、周五至周六";
		break;
		case '1,3,5,7':
		return "周一、周三、周五、周日";
		break;
		case '1,3,6,7':
		return "周一、周三、周六至周日";
		break;
		case '1,4,5,6':
		return "周一、周四至周六";
		break;
		case '1,4,5,7':
		return "周一、周四至周五、周日";
		break;
		case '1,4,6,7':
		return "周一、周四、周六至周日";
		break;
		case '1,5,6,7':
		return "周一、周五至周日";
		break;
		case '2,3,4,5':
		return "周二至周五";
		break;
		case '2,3,4,6':
		return "周二至周四、周六";
		break;
		case '2,3,4,7':
		return "周二至周四、周日";
		break;
		case '2,3,5,6':
		return "周二至周三、周五至周六";
		break;
		case '2,3,5,7':
		return "周二至周三、周五、周日";
		break;
		case '2,3,6,7':
		return "周二至周三、周六至周日";
		break;
		case '2,4,5,6':
		return "周二、周四至周六";
		break;
		case '2,4,5,7':
		return "周二、周四至周五、周日";
		break;
		case '2,4,6,7':
		return "周二、周四、周六至周日";
		break;
		case '2,5,6,7':
		return "周二、周五至周日";
		break;
		case '3,4,5,6':
		return "周三至周六";
		break;
		case '3,4,5,7':
		return "周三至周五、周日";
		break;
		case '3,4,6,7':
		return "周三至周四、周六至周日";
		break;
		case '3,5,6,7':
		return "周三、周五至周日";
		break;
		case '4,5,6,7':
		return "周四至周日";
		break;
		case '1,2,3,4,5':
		return "周一至周五";
		break;
		case '1,2,3,4,6':
		return "周一至周四、周六";
		break;
		case '1,2,3,4,7':
		return "周一至周四、周日";
		break;
		case '1,2,3,5,6':
		return "周一至周三、周五至周六";
		break;
		case '1,2,3,5,7':
		return "周一至周三、周五至周日";
		break;
		case '1,2,3,6,7':
		return "周一至周三、周六至周日";
		break;
		case '1,2,4,5,6':
		return "周一至周二、周四至周六";
		break;
		case '1,2,4,5,7':
		return "周一至周二、周四至周五、周日";
		break;
		case '1,2,4,6,7':
		return "周一至周二、周四、周六至周日";
		break;
		case '1,2,5,6,7':
		return "周一至周二、周五至周日";
		break;
		case '1,3,4,5,6':
		return "周一、周三至周六";
		break;
		case '1,3,4,5,7':
		return "周一、周三至周五、周日";
		break;
		case '1,3,4,6,7':
		return "周一、周三至周四、周六至周日";
		break;
		case '1,3,5,6,7':
		return "周一、周三、周五至周日";
		break;
		case '1,4,5,6,7':
		return "周一、周四至周日";
		break;
		case '2,3,4,5,6':
		return "周二至周六";
		break;
		case '2,3,4,5,7':
		return "周二至周日";
		break;
		case '2,3,4,6,7':
		return "周二至周四、周六至周日";
		break;
		case '2,3,5,6,7':
		return "周二至周三、周五至周日";
		break;
		case '2,4,5,6,7':
		return "周二、周四至周日";
		break;
		case '3,4,5,6,7':
		return "周三至周日";
		break;
		case '1,2,3,4,5,6':
		return "周一至周六";
		break;
		case '1,2,3,4,5,7':
		return "周一至周五、周日";
		break;
		case '1,2,3,5,6,7':
		return "周一至周三、周五至周日";
		break;
		case '1,2,4,5,6,7':
		return "周一至周二、周四至周日";
		break;
		case '1,3,4,5,6,7':
		return "周一、周三至周日";
		break;
		case '2,3,4,5,6,7':
		return "周二至周日";
		break;
		case '1,2,3,4,5,6,7':
		return "周一至周日";
		break;
	default:
		return "";
		break;
	}
}