/*地址初始化*/
function area_restart(data){
	var area=data.data_area;
	var province='';
	var city='';
	var county='';
	var town='';
	var put_province=data.put_province;
	var put_city=data.put_city;
	var put_area=data.put_area;
	//省份初始化
	province+='<select id="province_list">';
	province+='<option value ="请选择">请选择</option>';
	area.province.forEach(function(e){
			province+='<option value ="'+e+'">'+e+'</option>';
	})
	province+='</select>';
	$(put_province).html(province);
	//城市初始化
	city+='<select id="city_list">';
	city+='<option value ="请选择">请选择</option>';
	city+='</select>';
	$(put_city).html(city);
	//区/县初始化
	county+='<select id="area_list">';
	county+='<option value ="请选择">请选择</option>';
	county+='</select>';
	$(put_area).html(county);
	//省份关联
	$(document).on('change','#province_list',function(){
		var city='';
		var change_province=$('#province_list').val();
		if(change_province){
			if(area.city[change_province]){
			$("#s2id_city_list").find('span').html('请选择');
			city+='<option value ="">请选择</option>';
			area.city[change_province].forEach(function(i,e){
				city+='<option value ="'+i+'">'+i+'</option>';
			})
			$("#city_list").html(city);
			$(put_city).removeClass('hide');
			$(put_area).addClass('hide');
			$("#store").find('error').addClass('hidden');
			}else{
			$(put_city).addClass('hide');
			$(put_area).addClass('hide');				
			}
		}
	});
	//城市关联
	$(document).on('change','#city_list',function(){
		var county='';
		var change_city=$('#city_list').val();
		if(change_city){
			if(area.area[change_city]){
			county+='<option value ="">请选择</option>';
			area.area[change_city].forEach(function(i,e){
				county+='<option value ="'+i+'">'+i+'</option>';
			})
			$("#area_list").html(county);
			$(put_area).removeClass('hide');
			$("#store").find('error').addClass('hidden');
			}else{
			$(put_area).addClass('hide');	
			}
		}
	});
	
}