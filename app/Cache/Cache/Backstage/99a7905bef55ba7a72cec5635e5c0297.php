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
.select2-container{
	width:150px;
}
.controls span{
	margin-right:5px;
}
.uploader{
display:none;
}
.phone-wrap{
	position: absolute;
	width: 318px;
	padding-bottom: 150px;
    overflow: hidden;
	top:16px;
	left:0;
	background: #C9B391 url(/tcm/template/Maruti/images/wechatHead.png) no-repeat center 5px;
	line-height: 1.6;
	font-size: 14px;
	color: #222;
}
.card-body{
	margin: 64px 10px 10px;
}
.x-shop{
	margin: 0;
    padding: 0;
    border-bottom: 1px dashed #e7e7eb;
    position: relative;
    background-color: #fff;
    border-radius: 5px 5px 0 0;
    -moz-border-radius: 5px 5px 0 0;
    -webkit-border-radius: 5px 5px 0 0;
}
.x-shop-panel{
	padding: 21px 12px 5px;
    /*min-height: 137px;*/
    height: auto;
    text-align: center;
}
.x-logo-area{
	position: relative;
    margin-bottom: 7px;
    line-height: 42px;
    color: #8d8d8d;
    margin-top: 0px;
}
.x-logo{
	display: block;
    width: 38px;
    height: 38px;
    margin: 0 auto;
    border-radius: 50px;
    -moz-border-radius: 50px;
    -webkit-border-radius: 50px;
    border: 1px solid #e7e7eb;
    background-color: #fff;
}
.x-logo-img{
	display: block;
    width: 100%;
    height: 100%;
    border-radius: inherit;
    -moz-border-radius: inherit;
    -webkit-border-radius: inherit;
}
.x-tick-msg{
	margin-bottom: 6px;
}
.x-btn-use{
	min-width: 60px;
	display: inline-block;
    padding: 0 22px;
    height: 30px;
    line-height: 30px;
    vertical-align: middle;
    text-align: center;
    text-decoration: none;
    font-size: 14px;
    background-color: #C9380A;
	color:#FFF;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
}
.x-card-usage{
	text-align: left;
    padding: 0 10px 1em;
    background-color: #fff;
}
.x-card-usage ul{
	padding-left: 0;
	margin: 0;
	list-style-type: none;
}
.x-card-usage li{
	overflow: hidden;
    padding-left: 4em;
    clear: both;
    color: #8d8d8d;
    line-height: 1.6;
	font-size: 10px;
    padding-right: 4em;
    text-align: center;
}
.x-usage-label{
	float: left;
    margin-left: -5em;
    color: #222;
}
.x-last-cell{
	border-radius: 0 0 5px 5px;
    -moz-border-radius: 0 0 5px 5px;
    -webkit-border-radius: 0 0 5px 5px;
}
.x-shop-detail{
	background-color: #fff;
}
.x-list{
	padding-left: 0;
    list-style-type: none;
	margin: 0 10px;
}
.x-card-section{
	position: relative;
}
.x-li-panel{
	padding: 11px 30px 11px 0;
    border-bottom: 1px solid #e7e7eb;
}
.x-li-panel p{
	margin: 0;
}
.x-list li:last-child .x-li-panel {
    border-bottom-width: 0;
}
.x-icon-go{
	position: absolute;
    top: 36%;
    right: 5px;
    width: 16px;
    height: 15px;
    background: url(/tcm/template/Maruti/images/icon-arrow.png) 0 0 no-repeat;
}
.x-custom-deatil{
	background-color: #fff;
	margin-top: 1em;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
}
.x-supply-area{
	color: #8d8d8d;
    float: right;
}
.x-card-name{
	font-weight: normal;
    font-size: 28px;
    word-break: break-word;
    word-wrap: break-word;
}
.x-card-intro{
	position: relative;
    width: 100%;
    height: auto;
    color: #8d8d8d;
    overflow: hidden;
    padding: 0;
    word-wrap: break-word;
    word-break: break-all;
    min-height: 24px;
}
.x-cover-wrap{
	overflow: hidden;
    max-height: 116px;
    height: auto;
    padding-top: 5px;
}
.x-cover-summary{
	height: 24px;
    background: #000;
    background: rgba(0,0,0,0.7);
    margin-top: 0;
    position: absolute;
    z-index: 9;
    left: 0;
    width: 100%;
    bottom: 0;
    color: #fff;
    text-indent: 1em;
}
.x-card-cell{
	background-color: #fff;
}
.x-cover-summary .x-icon-go{
	top: 5px;
}
.inlineLabel{
	display: inline-block;
}
.week-wrap .control-label{
	padding-top: 12px;
}
.week-wrap{
	margin-top: -20px;
    margin-left: 54px;
}
.x-controls-time{
	margin:-6px 0 12px 150px;
}
.x-link{
	color:#459ae9;
}
.use-condition-4{
	margin-top: 5px;
	color:#8d8d8d;
}
.coverImgTips{
	color:#8d8d8d;
	margin-top: 6px;
}
.sm-coverImg{
	max-width: 100px;
}
.article-cont{
	width: 400px;
	border: 1px solid #d9dadc;
	padding: 10px;
}
.article-img{
	text-align: center;
}
.article-area{
	width: 100%;
	margin-top: 10px;
	padding-right: 10px;
}
.article-area textarea{
	width:386px;
	height: 100px;
	resize: none;
    overflow-y: auto;
}
.articleTips{
	margin-top: 6px;
	color: #8d8d8d;
}
.article-btn{
	text-align: right;
	margin-top: 10px;
}
.article-perview{
	width: 400px;
	height: auto;
	padding:10px;
	border: 1px solid #d9dadc;
	margin-bottom: 10px;
	background-color: #fff;
}
.article-p-text{
	padding:20px 10px;
	background-color: #f6f6f8;
	word-break:break-all;
}
.article-p-wrap img{
	width: 100%;
	max-height: 500px;
}
.article-perItem{
	margin-bottom: 20px;
}
.x-custom-label{
	float:left
}
.x-custom-area{
	float:right
}
.x-custom-tip{
	color:#8d8d8d;
}
.information li{
	display:inline;
	
}
</style>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/tcm/index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="/tcm/card.html" class="current">卡券管理</a> </div>
	<h1><?php if(empty($info)): ?>创建卡券<?php else: ?>编辑卡券<?php endif; ?></h1>
  </div>
  <div class="container-fluid">
		<div class="row-fluid" id="select_map">
			<div class="span12" style="position: relative;">
				<div class="phone-wrap"<?php if(!empty($info['color'])): ?>style="background:<?php echo ($info["color"]); ?> url(/tcm/template/Maruti/images/wechatHead.png) no-repeat center 5px"<?php endif; ?>>
					<div class="card-body">
						<div class="x-shop">
							<div class="x-shop-panel">
								<div class="x-logo-area" id="x-logo-area">
									<span class="x-logo"><img src="<?php if(empty($info["img_url"])): ?>/tcm/template/Maruti/images/people.png<?php else: echo ($info["img_url"]); endif; ?>" alt="" class="x-logo-img" id="x-brand-logo"></span>
									<div class="x-brand-name" id="x-brand-name"><?php if(empty($info['brand_name'])): ?>商户名<?php else: echo ($info['brand_name']); endif; ?></div>
								</div>
								<div class="x-tick-msg">
									<div id="x-title" class="x-card-name"><?php echo ($info["name"]); ?></div>
									<span class="x-btn-use" <?php if(!empty($info['color'])): ?>style="background:<?php echo ($info["color"]); ?>"<?php endif; ?>>去买单</span>
								</div>
							</div>
							<div class="x-card-usage">
								<ul>
									<li>
										<span class="x-usage-label" id="x-condition-label"></span>
										<span id="x-condition" <?php if($info['start_time'] and $info['end_time']): ?>style="display:block"<?php else: ?>style="display:none"<?php endif; ?>>有效期<span id="start_date"><?php if($info['start_time'] or $info['end_time']): echo (date('Y-m-d',$info["start_time"])); endif; ?></span> 00:00:00<span id="end_date"><?php if($info['start_time'] or $info['end_time']): ?>至<?php echo (date('Y-m-d',$info["end_time"])); endif; ?></span> 23:59:59</span>
									</li>
									<li>
										<span class="x-usage-label" id="x-limit-label"></span>
										<span id="x-limit-date"></span>
										<span id="x-limit-time"></span>
										<span id="x-limit-hour"></span>
										<span id="x-limit-hour-2"></span>
									</li>
								</ul>
							</div>
						</div>
						<div class="x-shop-detail x-last-cell">
							<ul class="x-list">
								<li class="x-card-section">
									<div class="x-li-panel">
										<ul class="information"><li><?php if($info['can_use_with_other_discount'] != 1): ?>不与其他优惠共享;<?php else: ?>可与其他优惠共享;<?php endif; ?></li><li><?php if($info['least']): ?>订单满<?php echo ($info["least"]); ?>元可用;<?php endif; ?></li><li><?php if($info['reduce']): ?>最高优惠<?php echo ($info["reduce"]); ?>元;<?php endif; ?></li></ul>
									</div>
								</li>
								<li class="x-card-section">
									<div class="x-li-panel">
										<p>使用须知</p>
									</div>
									<span class="x-icon-go"></span>
								</li>
								<li class="x-card-section">
									<div class="x-li-panel">
										<p>适用门店</p>
									</div>
									<span class="x-icon-go"></span>
								</li>
							</ul>
						</div>						
					</div>
				</div>
				<div class="widget-box" style="margin-left:350px;">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-align-justify"></i>
						</span>
						<?php if(empty($info)): ?><h5>创建卡券</h5><?php else: ?><h5>编辑卡券</h5><span class="icon"> 灰色项为不可更改项。</span><?php endif; ?>
					</div>
					<div class="widget-content nopadding">
						<form action="/tcm/Card/operate/type/add.html" method="post" class="myform form-horizontal">
							<div class="control-group">
									<label class="control-label">卡券类型:</label>
									<div class="controls">
										<input type="text" readonly="readonly" name="type" class="span3" value="<?php echo (get_type_name($data['type'])); ?>"/>
									</div>
							</div>
							<div id="change">
								<div class="control-group">
									<label class="control-label">减免金额:</label>
									<div class="controls">
										<input type="text" name="reduce" class="span3" id="reduceMoney" placeholder="减免金额" value="<?php echo ($info['reduce']); ?>"/>元
										<div><error class="color-red hidden"></error></div>
									</div>
								</div>
							</div>							
							<div class="control-group">
								<label class="control-label">商户名:</label>
								<div class="controls">
									<input  type="text" name="brand_name" id="brandName" class="span3" placeholder="商户名" value="<?php echo ($info["brand_name"]); ?>" />
									<div><error class="color-red hidden"></error></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">商户头像:</label>
								<div class="controls" id="headWrap">
									<div class="coverImgTips">
										图片建议尺寸：300像素*300像素，大小不超过1M。
									</div>
									<input type="file" name="brand_head" id="brandHead" accept="image/bmp,image/png,image/jpeg,image/jpg,image/gif" >
									<div class="span2">
										<a class="thumbnail imgadd" href="javascript:;" onclick="getElementById('brandHead').click()">
											<img <?php if($info['img_url']): ?>src="<?php echo ($info["img_url"]); ?>"<?php else: ?> src="/tcm/template/Maruti/images/img_add.jpg"<?php endif; ?>>
										</a>
									</div>
									<div><error class="color-red hidden"></error></div>
									<div class="span2 sm-coverImg"><input type="hidden" name="img_url" value="<?php echo ($info["img_url"]); ?>"></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">标题:</label>
								<div class="controls">
									<input  type="text" name="title" id="title" class="span3" placeholder="标题不超过9个字符" value="<?php echo ($info["name"]); ?>"  />
									<div><error class="color-red hidden"></error></div>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">卡券颜色:</label>
								<div class="controls color-button">
									<div class="btn-group">
										<input type="text" name="color" style="display:none" value="<?php echo ($info['color']); ?>"/>
										<button type="button" class="btn" id="card-color" <?php if(!empty($info)): ?>style="background:<?php echo ($info["color"]); ?>"<?php endif; ?> onclick="javascript:;"><?php if(empty($info)): ?>颜色<?php else: echo (get_color_name($info["color"])); endif; ?></button>
										<button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
										<ul class="dropdown-menu" id="colorList">
											<li><a href="javascript:;" data-id="#63b359" style="background:#63b359">Color010</a></li>
											<li><a href="javascript:;" data-id="#2c9f67" style="background:#2c9f67">Color020</a></li>
											<li><a href="javascript:;" data-id="#509fc9" style="background:#509fc9">Color030</a></li>
											<li><a href="javascript:;" data-id="#5885cf" style="background:#5885cf">Color040</a></li>
											<li><a href="javascript:;" data-id="#9062c0" style="background:#9062c0">Color050</a></li>
											<li><a href="javascript:;" data-id="#d09a45" style="background:#d09a45">Color060</a></li>
											<li><a href="javascript:;" data-id="#e4b138" style="background:#e4b138">Color070</a></li>
											<li><a href="javascript:;" data-id="#ee903c" style="background:#ee903c">Color080</a></li>
											<li><a href="javascript:;" data-id="#f08500" style="background:#f08500">Color081</a></li>
											<li><a href="javascript:;" data-id="#a9d92d" style="background:#a9d92d">Color082</a></li>
											<li><a href="javascript:;" data-id="#dd6549" style="background:#dd6549">Color090</a></li>
											<li><a href="javascript:;" data-id="#cc463d" style="background:#cc463d">Color100</a></li>
											<li><a href="javascript:;" data-id="#cf3e36" style="background:#cf3e36">Color101</a></li>
											<li><a href="javascript:;" data-id="#5E6671" style="background:#5E6671">Color102</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="control-group">
											<label class="control-label">卡券库存:</label>
											<div class="controls">
												<input  type="text" name="num" class="span3" placeholder="卡券库存" value="<?php echo ($info["num"]); ?>" />
												<div><error class="color-red hidden"></error></div>
											</div>
										</div>
										<?php if(!empty($data)): ?><input type="hidden" name="store" value="<?php echo ($data['store']); ?>"><?php endif; ?>
							<div class="control-group">
								<label class="control-label">有效期:</label>
								<div class="controls">
									<label id="time1">
										<input type="text" name="start_time" data-date="" data-date-format="yyyy-mm-dd" value="<?php if(!empty($info)): echo (date('Y-m-d',$info["start_time"])); endif; ?>" placeholder="开始时间" class="datepicker" id="time1-1" style="margin-left: 10px;" /> -- <input type="text" name="end_time" data-date="" data-date-format="yyyy-mm-dd" value="<?php if(!empty($info)): echo (date('Y-m-d',$info["end_time"])); endif; ?>" placeholder="结束时间" class="datepicker" id="time1-2" />
									</label>
									
									<div><error class="color-red hidden"></error></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">使用条件:</label>
								<div class="controls">
									<div id="condition-list">															
										<div id="gift-condition">											
												<div class="gift-c1">
													<label class="inlineLabel"><input type="checkbox" id="gift-box" name="cashLabel"<?php if(!empty($info["least"])): ?>checked<?php endif; ?>>消费条件</label>																									
														<div id="gift-item" <?php if(!empty($info["least"])): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>
															消费
															<select name="giftSelect" disabled id="giftSelect">
																<option value="1" selectet>金额
															</select>
															<span>
																<span id="giftMoney">满 <input type="text" name="least" class="span2" value="<?php echo ($info["least"]); ?>">元可用</span																
															</span>
														</div>																																							
												</div>
										</div>									
									</div>
									<div class="use-condition-3">
										<label class="inlineLabel" style="margin-top: 3px;margin-right: 20px;">优惠共享</label>										
										<select name="can_use_with_other_discount" id="shareChoose" >
											<option value="-1" <?php if($info['can_use_with_other_discount'] != 1): ?>selected<?php endif; ?>>不与其他优惠共享</option>
											<option value="1" <?php if($info['can_use_with_other_discount'] == 1): ?>selected<?php endif; ?>>可与其他优惠共享</option>
										</select>
									</div>
									<div class="use-condition-4">使用条件的设置会在券上展示，请务必仔细确认。</div>
									<div><error class="color-red hidden"></error></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">使用须知(选填):</label>
								<div class="controls">
									<div id="user-know"><?php if(!empty($info["get_limit"])): ?>每人限领<?php echo ($info["get_limit"]); ?>张<?php endif; ?></div>
									<textarea name="description" id="useText" class="span10" placeholder="请填写使用本券的注意事项，不超过300字" style="height: 100px;"><?php echo ($info["description"]); ?></textarea>
									<div><error class="color-red hidden"></error></div>
								</div>
							</div>
							<div class="form-actions">
								<button id="submit" type="button" class="btn btn-success"><?php if(empty($info)): ?>创建卡券<?php else: ?>修改卡券<?php endif; ?></button>
									<button type="button" class="btn btn-warning"  <?php if(!empty($info)): ?>onclick="window.location.href='/tcm/card.html'"<?php else: ?>onclick="window.location.href='<?php echo U('card/operate',array('type'=>'select_type'));?>'"<?php endif; ?>>返回</button>
							</div>
							<div id="root" data-link="/tcm"></div>
							<input type="file" accept="image/*"  name="image2" style="width:100%;opacity:0;filter:alpha(opacity=0);" id="inputfile"/>
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
<script src="/tcm/template/Maruti/js/address.js"></script>
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
<script>
document.write( " <script src='/tcm/template/Maruti/js/cash.js?v= " + Math.random() + " '></s" + "cript> " )
$(".color-button .dropdown-menu li a").click(function(){
	
	var colorid=$(this).attr('data-id');
	var color=$(this).css("background"); 
	var goodsname=$(this).html();
	$("input[name='color']").attr('value',colorid);
	$('#card-color').html(goodsname);
	$('#card-color').css("background",color);

})
$(".code_type-button .dropdown-menu li a").click(function(){
	
	var code_type=$(this).attr('data-id');
	var goodsname=$(this).html();
	$("input[name='code_type']").attr('value',code_type);
	$('#code_type').html(goodsname);

})
$(document).on('blur','input',function(){
  var name=$(this).attr('name');
  var vlaue=$(this).val();
  switch(name)
  {
	case "type":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请选择合适的类型");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
		case "reduce":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入减免金额");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
		
	case "title":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入标题");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else if(vlaue.length>9){
		$(this).addClass('redborder');
		$(this).siblings('div').find('error').html("<span>*</span>标题不超过9个字符");
		$(this).siblings('div').find('error').removeClass('hidden');
		$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
	case "brand_name":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入商户名");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
		case "color":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请选择颜色");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;

	}
})
</script>
<script>
$("#submit").click(function(){	
	var title=$("input[name='title']").val();
	var brand_name=$("input[name='brand_name']").val();
	var num=$("input[name='num']").val();
	var notice=$("input[name='notice']").val();
	var type=$("input[name='type']").val();
	var color=$("input[name='color']").val();
	var code_type=$("input[name='code_type']").val();
	var coverDesc = $("input[name='coverDescription']").val();
	var stat=1;
	if(title.length==0){
			$("input[name='title']").addClass('redborder');
			$("input[name='title']").siblings('div').find('error').html("<span>*</span>请输入标题");
			$("input[name='title']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
	if(brand_name.length==0){
			$("input[name='brand_name']").addClass('redborder');
			$("input[name='brand_name']").siblings('div').find('error').html("<span>*</span>请输入商户名");
			$("input[name='brand_name']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
	if(num.length==0){
			$("input[name='num']").addClass('redborder');
			$("input[name='num']").siblings('div').find('error').html("<span>*</span>请输入库存");
			$("input[name='num']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		if(color.length==0){
			$('#popbox .controls').html('请选择合适的颜色');
			center($("#popbox"));
			stat=0;
		}
		var hasValid = $("#time1 input[type=radio]").prop("checked");
		var startTime = $("#time1-1").val();
		var endTime = $("#time1-2").val();
		if(hasValid && (!startTime || !endTime)){
			if(!startTime){
				$("#time1-1").addClass('redborder');
			}
			if(!endTime){
				$("#time1-2").addClass('redborder');
			}
			$("#time1").siblings('div').find('error').html("<span>*</span>请输入时间");
			$("#time1").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		var sDate = new Date(startTime.replace(/\./g, "\/"));
		var eDate= new Date(endTime.replace(/\./g, "\/"));
		if (sDate > eDate) {
			$('#popbox .controls').html("开始日期要小于结束日期");
			center($("#popbox"));
			stat=0;
		}
	if(stat==0){
		return false;
	}else{
	var data=$('.myform').serialize();
	<?php if(empty($info)): ?>var url='<?php echo U('operate',array('type'=>cash_add_ajax));?>';
	<?php else: ?>
		var url='<?php echo U('operate',array('type'=>'edit','card_type'=>'代金券','id'=>$_GET['id']));?>';<?php endif; ?>
		$.post(url,data).success(function(data){
			if (data.status==1) {
				window.location.href='/tcm/card.html';
				return false;
			}else{
				alert(data.info.errmsg);
				return false;
			}
		});
		
	}
})
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