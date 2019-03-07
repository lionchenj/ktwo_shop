<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo C('WEB_SITE_TITLE');?></title><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/bootstrap.min.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/fullcalendar.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/maruti-style.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/maruti-media.css" class="skin-color" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/maruti-popup.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/uniform.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/select2.css" />
<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/colorpicker.css" />
   <link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/datepicker.css" />
</head>
<body>
<!--Header-part-->
<section name="top">
	<div id="header">
	  <h1><a href="/">锦丰商城后台管理系统</a></h1>
	</div>
	<!--close-Header-part--> 

	<!--top-Header-messaages-->
	<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
	<!--close-top-Header-messaages--> 

	<!--top-Header-menu-->
	<div id="user-nav" class="navbar navbar-inverse">
	  <ul class="nav">
		<li class="" ><a title="" href="/zhouzf/www/tcm/about.html"><i class="icon icon-user"></i> <span class="text"><?php echo get_nickname();?></span></a></li>
		<?php $_head_set_auth=$__controller__->checkAuth(MODULE_NAME.'/Constant/index'); ?>
		<?php if(($_head_set_auth) == "1"): ?><li class=""><a title="" href="/zhouzf/www/tcm/constant.html"><i class="icon icon-cog"></i> <span class="text">设置</span></a></li><?php endif; ?>
		<li class=""><a id="outlogin" href="javascript:;" url="/zhouzf/www/tcm/outlogin.html"><i class="icon icon-share-alt"></i> <span class="text">退出登录</span></a></li>
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
<div id="sidebar"><a href="/zhouzf/www/tcm/index.html" class="visible-phone"><i class="icon icon-home"></i> 首页</a>
  <ul>
	<?php if(is_array($__base_menu__)): foreach($__base_menu__ as $key=>$menu): ?><li><a href="/zhouzf/www/tcm/<?php echo ($menu["tip"]); ?>"><i class="icon <?php echo ($menu["icon"]); ?>"></i> <span><?php echo ($menu["title"]); ?></span></a></li><?php endforeach; endif; ?>
  </ul>
</div>
</section>
</head>
<body>
	
	<!---->
	<!-- 主体 -->
	   

<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.min.js"></script> 
<style>
.classifyContainer {
    background-color: #fff;
    border: 1px solid #e6e6e6;
    color: #848484;
    font-size: 14px;
    padding: 6px 20px;
}
.classifyContainer dl {
    border-bottom: 1px dashed #dcdcdc;
    height: 36px;
    line-height: 36px;
    overflow: hidden;
    width: 100%;
}
.classifyContainer dt, .classifyContainer .keyword {
    float: left;
    padding-right: 8px;
    text-align: right;
    width: 70px;
}
.classifyContainer dd {
    cursor: pointer;
    float: left;
    margin-right: 12px;
}
.classifyContainer dd span {
    padding: 2px 6px;
}
.classifyContainer .active, classifyContainer dd span:hover {
    background-color: #3d9fe1;
    border-radius: 4px;
    color: #fff;
}
.classifyContainer > div {
    height: 46px;
    line-height: 46px;
}
</style>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/zhouzf/www/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/zhouzf/www/tcm/goods.html" class="current">商品管理</a> </div>
	<h1>商品详情</h1>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>商品详情</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="/zhouzf/www/tcm/Goods/edit/id/70.html" method="post" class="myform form-horizontal">
									<div class="control-group">
										<label class="control-label">商品名称:</label>
										<input name="goodsid" type="hidden" class="span3"  value="<?php echo ($data["goodsid"]); ?>"/>
										<div class="controls"><input name="goodsname" type="text" class="span3" placeholder="商品名称" value="<?php echo ($data["goodsname"]); ?>"/>
										<div><error class="color-red hidden"></error></div></div>
									</div>
                                            
                                    <div class="control-group">
                                        <label class="control-label">商品封面:</label>
                                        <div class="controls">
										<img class="goods_img" style="width:150px" src="<?php if(empty($data['img_url'])): ?>/zhouzf/www/tcm/template/Maruti/images/add.jpg<?php else: echo ($data["img_url"]); endif; ?>" onclick="getElementById('inputfile').click()">
										<input class="common-text required imageFile" name="img_url" value="<?php echo ($data["img_url"]); ?>" type="hidden">
										<div style="display:none">
										<input type="file" accept="image/*"  name="image2" multiple="multiple" style="width:100%;opacity:0;filter:alpha(opacity=0);" id="inputfile"/>
										</div>
										
                                    </div>
									</div>
									<div class="control-group" id="classify">
										<label class="control-label">选择分类:</label>
										<div class="controls ">
											<div class="classifyContainer">
											<?php if(is_array($classify)): foreach($classify as $key=>$list): ?><dl>
													<dt data-id="<?php echo ($list["id"]); ?>"><?php echo ($list["title"]); ?></dt>
													<?php if(!empty($list['_'])): if(is_array($list['_'])): foreach($list['_'] as $key_2=>$list_): if(($key_2) > "0"): ?><dd>
														<span class="" <?php if(!empty($list_['_'])): ?>data-tab<?php endif; ?> <?php if(($list_['id']) == $data['classid']): ?>active<?php endif; ?> data-id="<?php echo ($list_["id"]); ?>"><?php echo ($list_["title"]); ?></span>
													</dd><?php endif; endforeach; endif; endif; ?>
													
												</dl><?php endforeach; endif; ?>	
												
											</div>
												
										</div>
									</div>
                                    <!-- <div class="control-group">
										<label class="control-label">默认价格:</label>
			
										<div class="controls"><input name="money" type="text" class="span3" placeholder="售价" value="<?php echo ($data["money"]); ?>"/><div><error class="color-red hidden"></error></div></div>
									</div> -->
									<div class="control-group">
										<label class="control-label">积分兑换价:</label>
			
										<div class="controls"><input name="integral_pay" type="text" class="span3" placeholder="积分兑换价" value="<?php echo ($data["integral_pay"]); ?>"/><div><error class="color-red hidden"></error></div></div>
									</div>
									<div class="control-group">
										<label class="control-label">限购（选填）:</label>
										<div class="controls"><input name="limit" type="text" class="span3 int" placeholder="限购数量 0表示不限购" value="<?php echo ($data["limit"]); ?>"/><div><error class="color-red hidden"></error></div></div>
									</div>
									<div class="control-group">
										<label class="control-label">库存:</label>
										<div class="controls"><input name="inventory" type="text" class="span3 int" placeholder="限购数量 0表示不限购" value="<?php echo ($data["inventory"]); ?>"/><div><error class="color-red hidden"></error></div></div>
									</div>
									<div class="control-group">
								<label class="control-label">发货方式:</label>
								<div class="controls">
									<div id="condition-list">															
										<div id="gift-condition">
												<div class="gift-c1">
													<label class="inlineLabel"><input type="checkbox" name="out_type_1" <?php if(($data['out_type_1']) == "1"): ?>checked<?php endif; ?>>物流</label>																																																																
												</div>
												<!-- <div class="gift-c1">
													<label class="inlineLabel"><input type="checkbox" id="gift-box" name="out_type_2" <?php if(($data['out_type_2']) == "1"): ?>checked<?php endif; ?>>兑换券</label>																									
														<div id="gift-item"  <?php if(($data['out_type_1']) == "1"): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>
															<select name="giftSelect"id="giftSelect">
															<?php if(is_array($card)): foreach($card as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(($data['duihuan_id']) == $vo['id']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
															</select>
														</div>																																							
												</div> -->
										</div>									
									</div>
									<div><error class="color-red hidden"></error></div>
								</div>
							</div>
							<div class="control-group">
							<div class="span12">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-picture"></i>
								</span>
								<h5>商品轮播</h5>
							</div>
							<div class="widget-content">
								<ul class="thumbnails">
								<?php if(is_array($data["banner"])): foreach($data["banner"] as $key=>$list_): ?><li class="span2">
										<a class="thumbnail lightbox_trigger" href="<?php echo ($list_); ?>">
											<img src="<?php echo ($list_); ?>" alt="" >
										</a>
										<div class="actions">
											<a class="item" title="" href="javascript:;"><i class="icon-pencil icon-white"></i></a>
											<a class="remove" title="" href="javascript:;"><i class="icon-remove icon-white"></i></a>
										</div>
									</li><?php endforeach; endif; ?>
									<li class="span2">
										<a class="thumbnail imgadd" href="javascript:;" onclick="getElementById('inputfile2').click()">
											<img src="/zhouzf/www/tcm/template/Maruti/images/img_add.jpg" alt="" >
										</a>
									</li>
								</ul>
								<div style="display:none">
									<input type="file" accept="image/*"  name="image2" multiple="multiple" style="width:100%;opacity:0;filter:alpha(opacity=0);" id="item"/>
									<input type="file" accept="image/*"  name="image2" multiple="multiple" style="width:100%;opacity:0;filter:alpha(opacity=0);" id="inputfile2"/>
								</div>
							</div>
							</div>
						</div>
								
									<div class="control-group">
                                        <label class="control-label">商品详情</label>
                                        <div class="controls">
											<textarea name="details" id="details"><?php echo ($data["details"]); ?></textarea>
											<?php echo hook('adminArticleEdit',array('name'=>'details','value'=>$data['details']));?>
                                        </div>
                                    </div>	
									<div class="control-group">
                                        <label class="control-label">商品规格</label>
                                        <div class="controls">
											<textarea name="parameter" id="parameter"><?php echo ($data["parameter"]); ?></textarea>
											<?php echo hook('adminArticleEdit',array('name'=>'parameter','value'=>$data['parameter']));?>
                                        </div>
                                    </div>									
									<div class="form-actions">
										<button type="submit" class="btn btn-success">保存</button>
											<button type="button" class="btn btn-warning"  onclick="window.location.href='/zhouzf/www/tcm/goods.html'">返回</button>
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

<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.ui.custom.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap.min.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/select2.min.js"></script> 
 <script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap-datepicker.js"></script>
 <script src="/zhouzf/www/tcm/template/Maruti/js/bootstrap-colorpicker.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/jquery.dataTables.min.js"></script> 
 <script src="/zhouzf/www/tcm/template/Maruti/js/jquery.uniform.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.js"></script> 
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.tables.js"></script>
 <script src="/zhouzf/www/tcm/template/Maruti/js/maruti.form_common.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.popup.js"></script>
<script src="/zhouzf/www/tcm/template/Maruti/js/maruti.ajax.js"></script>
<script>
$(document).ready(function(){
	var typeid='<?php echo ($data['type']); ?>';
	if(typeid=='0'){
		$('#futures').hide();
		$('#classify').hide();
		$('#shares').hide();
	}else if(typeid=='1'){
		$('#futures').hide();
		$('#classify').show();
		$('#shares').hide();
	}else if(typeid=='2'){
	$('#futures').show();
		$('#classify').hide();
		$('#shares').hide();
	}else if(typeid=='3'){
		$('#futures').hide();
		$('#classify').hide();
		$('#shares').show();
	}
	var classid='<?php echo ($data['classid']); ?>';
	classid=classid.split(",");
	if(classid!=''){
		$(".classifyContainer dl dd span").each(function(i){
				var data=$(this).attr('data-id');
					if($.inArray(data,classid)>=0){
					$(this).click();
					}				
		})
		}
})
$("#type .dropdown-menu li a").click(function(){
	var typeid=$(this).attr('data-id');
	var type=$(this).html();
	$("input[name='type']").val(typeid);
	$(this).parent().parent().siblings('.type').html(type);
	if(typeid=='0'){
		$('#futures').hide();
		$('#classify').hide();
		$('#shares').hide();
	}else if(typeid=='1'){
		$('#futures').hide();
		$('#classify').show();
		$('#shares').hide();
	}else if(typeid=='2'){
	$('#futures').show();
		$('#classify').hide();
		$('#shares').hide();
	}else if(typeid=='3'){
		$('#futures').hide();
		$('#classify').hide();
		$('#shares').show();
	}

})
$(".classifyContainer dl dd span").click(function(){
	$(this).parent().parent().parent().find('span').removeClass('active');
	$(this).addClass('active');
	if($(this).hasClass('data-tab')){
	var data=$(this).attr('data-id');
		if(data){
			$(".class-tab").hide();
			$(".class-tab dd span").removeClass('active');
			$(".class-"+data+" dd span").eq(0).addClass('active');
			$(".class-"+data).show();
		}
		}
})
$(".classifyContainer dl dd span").each(function(i){
	if($(this).hasClass('active')){
		var data=$(this).attr('data-id');
		if(data){
			//$(".class-tab").hide();
			$(".class-"+data+" dd span").eq(0).addClass('active');
			$(".class-"+data).show();
		}
	}
});
$("input").blur(function(){
  
  var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	case "goodsname":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入商品名称");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "inventory":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入库存数量");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "integral_pay":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入积分兑换价");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
			$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "num":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入总手数");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		var val=parseInt(vlaue);
		if(isNaN(val)){
			val =0;
		}
		$(this).val(val);
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "money":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入售价");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		var val=parseFloat(vlaue);
		if(isNaN(val)){
			val =0;
		}
		val=val.toFixed(2);
		$(this).val(val);
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "member_money":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入vip优惠价");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
	var val=parseFloat(vlaue);
		if(isNaN(val)){
			val =0;
		}
		val=val.toFixed(2);
		$(this).val(val);
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "vip_start_time":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入vip招募开启时间");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "vip_end_time":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入vip招募结束时间");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "vip_num":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入vip招募份数");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
		var val=parseInt(vlaue);
		if(isNaN(val)){
			val =0;
		}
		$(this).val(val);
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "vip_money":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入vip优惠价");
			$(this).siblings('div').find('error').removeClass('hidden')
	}else{
	var val=parseFloat(vlaue);
		if(isNaN(val)){
			val =0;
		}
		val=val.toFixed(2);
		$(this).val(val);
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden')
	}
	break;
	case "limit":
	if(vlaue.length>0){		
	var val=parseInt(vlaue);
		if(isNaN(val)){
			val =0;
		}
		$(this).val(val);
	}
	break;
  }
 
});
$(".myform").submit(function(){
	details.sync();
	parameter.sync();
	var goodsname=$("input[name='goodsname']").val();
	var img_url=$("input[name='img_url']").val();
	var money=$("input[name='money']").val();
	var details2=$("#details").val();
	var parameter2=$("#parameter").val();
	var out_type_1=$("input[name='out_type_1']").is(":checked");
	var out_type_2=$("input[name='out_type_2']").is(":checked");
	var classid='';
		$("#classify .classifyContainer dl dd span").each(function(i){
		
		if($(this).hasClass('active')){
		var data=$(this).attr('data-id');
			if(data>0){
			classid+=data+",";
			}
		}
		})
		if(classid!=''){
			classid=classid.substring(0,classid.length-1);
		}
	var stat=1;
	if(goodsname.length==0){
			$("input[name='goodsname']").addClass('redborder');
			$("input[name='goodsname']").siblings('div').find('error').html("<span>*</span>请输入商品名称");
			$("input[name='goodsname']").siblings('div').find('error').removeClass('hidden');
			stat=0;
	}
	if(img_url.length==0){
			 $('#popbox .controls').html('请上传商品图片');
			center($("#popbox"));
			return false;
	}
	if(classid.length==0){
			 $('#popbox .controls').html('请选择商品分类');
			center($("#popbox"));
			return false;
	}
	if(money==''){
			$("input[name='money']").addClass('redborder');
			$("input[name='money']").siblings('div').find('error').html("<span>*</span>请输入售价");
			$("input[name='money']").siblings('div').find('error').removeClass('hidden');
			stat=0;
	}else if(money<=0){
			$("input[name='money']").addClass('redborder');
			$("input[name='money']").siblings('div').find('error').html("<span>*</span>售价必须大于0");
			$("input[name='money']").siblings('div').find('error').removeClass('hidden');
			stat=0;
	}	
	if(!out_type_1 && !out_type_2){
		 $('#popbox .controls').html('请选择发货方式');
			center($("#popbox"));
			return false;
	}
	if(out_type_1){
		out_type_1=1;
	}else{
		out_type_1=0;
	}
	if(out_type_2){
		out_type_2=1;
	}else{
		out_type_2=0;
	}
	var duihuan_id=$("#giftSelect").val();
	var youhui_id='';
	$("input[name='youhui']").each(function(i){
		
		if($(this).is(":checked")){
		var data=$(this).val();
			if(data>0){
			youhui_id+=data+",";
			}
		}
		})
		if(youhui_id!=''){
			youhui_id=youhui_id.substring(0,youhui_id.length-1);
		}
	if(stat==0){
			return false;
		}else{
		var iamges_list='';
		$('.span2').each(function(e){
		if(!$(this).is(":hidden")){
			var img_url=$(this).find('.lightbox_trigger').attr('href');
			if(img_url){
			iamges_list+=img_url+',';
			}
		}
		})
		
		if(iamges_list==''){
			$('#popbox .controls').html('请上传轮播图片');
			center($("#popbox"));
			return false;
		}
		if(iamges_list!=''){
			iamges_list=iamges_list.substring(0,iamges_list.length-1);
		}
			var url=$(this).attr('action');
			var query = {};
			query['goodsid']=$("input[name='goodsid']").val();
			query['goodsname']=goodsname;
			query['img_url']=$("input[name='img_url']").val();
			query['money']=money;
			query['classid']=classid;
			query['out_type_1']=out_type_1;
			query['out_type_2']=out_type_2;
			query['duihuan_id']=duihuan_id;
			query['youhui_id']=youhui_id;
			query['banner']=iamges_list;
			query['details']=details2;
			query['parameter']=parameter2;
			query['limit']=$("input[name='limit']").val();
			query['inventory']=$("input[name='inventory']").val();
			query['integral_pay']=$("input[name='integral_pay']").val();
			 $.post(url,query).success(function(data){
				 if (data.status==1) {
					 $('#popbox .controls').html('修改商品成功');
						center($("#popbox"));
						 
				 }else{
					 switch(data.info)
					 {
						case -1:
						$("input[name='goodsname']").addClass('redborder');
						$("input[name='goodsname']").siblings('div').find('error').html("<span>*</span>商品名已存在");
						$("input[name='goodsname']").siblings('div').find('error').removeClass('hidden');
						break;
						default:
						alert("未知错误请联系管理员");
						break;
					 }
				 }
			});
	}	
	return false;	
})
$(document).on('click','.remove',function(){
	$(this).parent().parent('li').toggle(400);
});
$(document).on('click','.item',function(){
	$(".thumbnails li").removeClass('default');
	$(this).parent().parent('li').addClass('default');
	$("#item").click();
});
</script>
<script type="text/javascript">	
 $("#inputfile").change(function(){
     //创建FormData对象
     var data = new FormData();
     //为FormData对象添加数据
     //
     $.each($('#inputfile')[0].files, function(i, file) {
         data.append('imageFile', file);
     });
     $.ajax({
         url:"<?php echo U('File/update');?>",
         type:'POST',
         data:data,
         cache: false,
         contentType: false,    //不可缺
         processData: false,    //不可缺
         success:function(data){
			console.log(data);
				if(data.status==1){
				
				var url=data.path;
				$('.imageFile').val(url);
				var click="getElementById('inputfile').click()"
				$(".goods_img").attr('src',url);
				}
			   
         }
     });
		})
		 $("#inputfile2").change(function(){
     //创建FormData对象
     var data = new FormData();
     //为FormData对象添加数据
     //
     $.each($('#inputfile2')[0].files, function(i, file) {
         data.append('imageFile', file);
     });
     $.ajax({
         url:"<?php echo U('File/update');?>",
         type:'POST',
         data:data,
         cache: false,
         contentType: false,    //不可缺
         processData: false,    //不可缺
         success:function(data){
			console.log(data);
				if(data.status==1){
				
				var url=data.path;
				$('#imageFile').val('');
				var b='';
					b+='<li class="span2">';
					b+='<a class="thumbnail lightbox_trigger" href="'+url+'">';
					b+='<img src="'+url+'" alt="" >';
					b+='</a>';
					b+='<div class="actions">';
					b+='<a class="item" title="" href="javascript:;"><i class="icon-pencil icon-white"></i></a>';
					b+='<a class="remove" title="" href="javascript:;"><i class="icon-remove icon-white"></i></a>';
					b+='</div>';
					b+='</li>';
					b+='<li class="span2">';
					b+='<a class="thumbnail imgadd" href="javascript:;" onclick="getElementById(\'inputfile2\').click()">';
					b+='<img src="/zhouzf/www/tcm/template/Maruti/images/img_add.jpg" alt="" >';
					b+='</a>';
					b+='</li>';
					$('.imgadd').parent('li').remove();
					$('.thumbnails').append(b);
				}
			   
         }
     });
		})
		$("#item").change(function(){
     //创建FormData对象
     var data = new FormData();
     //为FormData对象添加数据
     //
     $.each($('#item')[0].files, function(i, file) {
         data.append('imageFile', file);
     });
     $.ajax({
         url:"<?php echo U('File/update');?>",
         type:'POST',
         data:data,
         cache: false,
         contentType: false,    //不可缺
         processData: false,    //不可缺
         success:function(data){
			console.log(data);
				if(data.status==1){
				
				var url=data.path;
				$('#item').val('');
				$(".thumbnails .default .lightbox_trigger").attr('href',url);
				$(".thumbnails .default .lightbox_trigger img").attr('src',url);
				}
			   
         }
     });
		})		
</script>
</body>


	
	<!-- /主体 -->

	<!-- 底部 -->
	<section name="footer">
	<div class="row-fluid">
		  <div id="footer" class="span12"> 2017 &copy; 锦丰商城后台管理系统  ——广州群智提供技术支持</div>
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