$(function(){
	var root=$('#root').attr('data-link');
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
			url:root+"/File/update.html",
			type:'POST',
			data:data,
			cache: false,
			contentType: false,    //不可缺
			processData: false,    //不可缺
			success:function(data){
				if(data.status==1){
					$("#headWrap .span2").eq(1).remove();
					var str = '<div class="span2 sm-coverImg">'+								
								'<input type="hidden" name="img_url" value="'+data.path+'">'+
								'</div>';
					$('.imgadd img').attr("src",data.path);
					$("#headWrap").append(str);
					$("#x-brand-logo").attr("src",data.path);
					$("#headWrap error").addClass("hidden");
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

	/*预览效果*/

	function perviewText(e1,e2){
		$(e2).text(e1.val());
	}
		function check_date() {
        	var endDate = $("#time1-2").val();
			var startDate = $("#time1-1").val();		
			if (startDate.length > 0 && endDate.length>0) {
				var sDate = new Date(startDate.replace(/\./g, "\/"));
				var eDate= new Date(endDate.replace(/\./g, "\/"));
				if (sDate > eDate) {
					$('#popbox .controls').html("开始日期要小于结束日期");
					center($("#popbox"));
					$('#x-condition').hide();
				}else{
					$("#start_date").text(startDate);
					$("#end_date").text('至'+endDate);
					$('#x-condition').show();
				}
			}else if(startDate.length > 0 ){				
				$("#start_date").text(startDate);
				$("#end_date").text('至'+startDate);
				$('#x-condition').show();
			}else if(endDate.length>0){
				$("#end_date").text('至'+endDate);
				$("#start_date").text(endDate);
				$('#x-condition').show();
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
		check_date() 
	})

	$("#time1-2").datepicker().on("changeDate",function(){
		check_date() 
	})
	$('#giftMoney input[name="least"]').on('input',function(){
		var least_money=$(this).val();
		if((/^(\+|-)?\d+$/.test( least_money.replace(/\b(0+)/gi,"") )) && least_money > 0){  
			$(this).val(least_money.replace(/\b(0+)/gi,""));
			var str='订单满'+least_money.replace(/\b(0+)/gi,"")+'元可用;';
			$('.information').find('li').eq(1).show().text(str);
			$('.information').find('li').eq(1).show();
		}else{  
			$(this).val('0');
			$('.information').find('li').eq(1).hide();
		}
	})
	$('#shareChoose').on('change',function(){
		var str='';
		var b=$(this).val();
		if(b==1){
			str='可与其他优惠共享;';
		}else if (b==-1){
			str='不与其他优惠共享;';
		}
		$('.information').find('li').eq(0).text(str);
		$('.information').find('li').eq(0).show();
	})
	$("#condition-list").on("change","#gift-box",function(){
		var isChecked_2 = $(this).prop("checked");
		if(isChecked_2){
			$("#gift-item").show();
			$('.information').find('li').eq(1).show();
		}else{
			$("#gift-item").hide().find("input").val("");
			$('.information').find('li').eq(0).text('');
			$('.information').find('li').eq(1).hide();
		}
	})
	$('#reduceMoney').on('input',function(){
		var reduce_money=Math.floor($(this).val().replace(/\b(0+)/gi,""));
		if((/^(\+|-)?\d+$/.test( reduce_money )) && reduce_money > 0){  
			$(this).val(reduce_money);
			var str='最多优惠'+reduce_money+'元;';
			$('.information').find('li').eq(2).show().text(str);
		}else{  
			$(this).val('0');
			$('.information').find('li').eq(2).hide();
		}  
		
	})
})	


