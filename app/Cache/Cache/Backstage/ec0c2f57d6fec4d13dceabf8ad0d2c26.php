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
	background: #f6f6f8 url(/tcm/template/Maruti/images/wechatHead.png) no-repeat center 5px;
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
	padding: 21px 12px 12px;
    min-height: 137px;
    height: auto;
    text-align: center;
}
.x-logo-area{
	position: relative;
    margin-bottom: 7px;
    line-height: 42px;
    color: #8d8d8d;
    margin-top: -40px;
}
.x-logo{
	display: block;
    width: 38px;
    height: 38px;
    margin: 0 auto;
    border-radius: 22px;
    -moz-border-radius: 22px;
    -webkit-border-radius: 22px;
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
    background-color: #f4f5f9;
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
    padding-left: 5em;
    clear: both;
    color: #8d8d8d;
    line-height: 1.6;
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
									<span class="x-logo"><img <?php if($info['img_url']): ?>src="<?php echo ($info["img_url"]); ?>"<?php elseif(empty($info['img_url']) && $info['logo_url']): ?>src="<?php echo ($info["logo_url"]); ?>"<?php else: ?>src="/tcm/template/Maruti/images/people.png"<?php endif; ?>" alt="" class="x-logo-img" id="x-brand-logo"></span>
									<div class="x-brand-name" id="x-brand-name"><?php if(empty($info['brand_name'])): ?>商户名<?php else: echo ($info['brand_name']); endif; ?></div>
								</div>
								<div class="x-tick-msg">
									<div id="x-title" class="x-card-name"><?php echo ($info["title"]); ?></div>
									<span class="x-btn-use" <?php if(!empty($info['color'])): ?>style="background:<?php echo ($info["color"]); ?>;color:#FFF;"<?php endif; ?>>使用</span>
								</div>
							</div>
							<div class="x-card-usage">
								<ul>
									<li style="display: none">
										<span class="x-usage-label" id="x-condition-label">使用条件：</span>
										<span id="x-condition"></span>
									</li>
									<li>
										<span class="x-usage-label" id="x-limit-label">可用时间：</span>
										<span id="x-limit-date"><?php if($info['date_info']['type'] == 'DATE_TYPE_FIX_TIME_RANGE'): echo (date("Y.m.d",$info['date_info']['begin_timestamp'])); ?>-<?php echo (date("Y.m.d",$info['date_info']['end_timestamp'])); ?>,
										<?php elseif($info['date_info']['type'] == 'DATE_TYPE_FIX_TERM'): ?>										
										<?php echo date('Y.m.d',time()+$info['date_info']['fixed_begin_term']*24*60*60);?>-<?php echo date('Y.m.d',time()+$info['date_info']['fixed_begin_term']*24*60*60+$info['date_info']['fixed_term']*24*60*60);?>,<?php endif; ?>
										</span>
										<span id="x-limit-time"><?php if(empty($info['time_limit_week_str'])): ?>周一至周日<?php else: echo (change_week($info['time_limit_week_str'])); endif; ?></span>
										<span id="x-limit-hour"></span>
										<span id="x-limit-hour-2"></span>
									</li>
								</ul>
							</div>
						</div>
						<div class="x-card-cell" <?php if(empty($info["advanced_info"]["abstract"])): ?>style="display: none"<?php else: ?>style="display: block"<?php endif; ?>>
							<ul class="x-list">
								<li class="x-card-section">
									<div class="x-img-panel">
										<div class="x-card-intro">
											<div class="x-cover-wrap" id="x-cover-wrap">
												<img <?php if($info['brand_url']): ?>src="<?php echo ($info["brand_url"]); ?>"<?php elseif(empty($info['img_url']) && $info['logo_url']): ?>src="<?php echo ($info["advanced_info"]["abstract"]["icon_url_list"]["0"]); ?>"<?php endif; ?> alt="">
											</div>
											<div class="x-cover-summary">
												<span class="x-icon-go"></span>
												<span id="x-abstract"><?php echo ($info["advanced_info"]["abstract"]["abstract"]); ?></span>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div class="x-shop-detail x-last-cell">
							<ul class="x-list">
								<li class="x-card-section">
									<div class="x-li-panel">
										<p>适用门店</p>
									</div>
									<span class="x-icon-go"></span>
								</li>
								<li class="x-card-section">
									<div class="x-li-panel">
										<p>公众号</p>
									</div>
									<span class="x-icon-go"></span>
								</li>
							</ul>
						</div>
						<div class="x-custom-deatil">
							<ul class="x-list">
								<li class="x-card-section">
									<div class="x-li-panel clearfix">
										<span class="x-custom-label" id="custom-label"><?php if(empty($info['custom_url_name'])): ?>自定义入口（选填）<?php else: echo ($info["custom_url_name"]); endif; ?></span>
										<span class="x-custom-area">
											<span class="x-custom-tip" id="custom-tips"><?php echo ($info["custom_url_sub_title"]); ?></span>
											<span class="x-icon-go"></span>
										</span>
									</div>
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
							<?php if($info["type"] == CASH): ?><div class="control-group">
									<label class="control-label">减免金额:</label>
									<div class="controls">
										<input type="text" name="reduce_cost" class="span3" id="reduceMoney" placeholder="减免金额" value="<?php echo ($info['reduce_cost']/100); ?>"/>元
										<div><error class="color-red hidden"></error></div>
									</div>
								</div>
							<?php elseif($info["type"] == DISCOUNT): ?>
								<div class="control-group">
									<label class="control-label">折扣额度:</label>
									<div class="controls">
										<input type="text" name="discount" class="span3" id="discountNum" placeholder="输入1到9.9之间的数字，精确到小数点后1位" value="<?php echo ($info['discount']); ?>"/>折
										<div><error class="color-red hidden"></error></div>
									</div>
								</div><?php endif; ?>
							</div>
							<div class="control-group">
								<label class="control-label">商户名:</label>
								<div class="controls">
									<input  type="text" name="brand_name" id="brandName" class="span3" placeholder="商户名" value="<?php echo ($info["brand_name"]); ?>" <?php if(!empty($info)): ?>disabled="disabled"<?php endif; ?>/>
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
											<img <?php if($info['img_url']): ?>src="<?php echo ($info["img_url"]); ?>"<?php elseif(empty($info['img_url']) && $info['logo_url']): ?>src="<?php echo ($info["logo_url"]); ?>"<?php else: ?>src="/tcm/template/Maruti/images/img_add.jpg"<?php endif; ?>>
										</a>
									</div>
									<div><error class="color-red hidden"></error></div>
									<div class="span2 sm-coverImg"><input type="hidden" name="logo_url" value="<?php echo ($info["logo_url"]); ?>"><input type="hidden" name="img_url" value="<?php echo ($info["img_url"]); ?>"></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">标题:</label>
								<div class="controls">
									<input  type="text" name="title" id="title" class="span3" placeholder="标题不超过9个字符" value="<?php echo ($info["title"]); ?>"  <?php if(!empty($info)): ?>disabled="disabled"<?php endif; ?>/>
									<div><error class="color-red hidden"></error></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">卡券颜色:</label>
								<div class="controls color-button">
									<div class="btn-group">
										<input type="text" name="color" style="display:none" value="<?php echo (get_color_name($info['color'])); ?>"/>
										<button type="button" class="btn" id="card-color" <?php if(!empty($info)): ?>style="background:<?php echo ($info["color"]); ?>"<?php endif; ?> onclick="javascript:;"><?php if(empty($info)): ?>颜色<?php else: echo (get_color_name($info["color"])); endif; ?></button>
										<button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
										<ul class="dropdown-menu" id="colorList">
											<li><a href="javascript:;" data-id="Color010" style="background:#63b359">Color010</a></li>
											<li><a href="javascript:;" data-id="Color020" style="background:#2c9f67">Color020</a></li>
											<li><a href="javascript:;" data-id="Color030" style="background:#509fc9">Color030</a></li>
											<li><a href="javascript:;" data-id="Color040" style="background:#5885cf">Color040</a></li>
											<li><a href="javascript:;" data-id="Color050" style="background:#9062c0">Color050</a></li>
											<li><a href="javascript:;" data-id="Color060" style="background:#d09a45">Color060</a></li>
											<li><a href="javascript:;" data-id="Color070" style="background:#e4b138">Color070</a></li>
											<li><a href="javascript:;" data-id="Color080" style="background:#ee903c">Color080</a></li>
											<li><a href="javascript:;" data-id="Color081" style="background:#f08500">Color081</a></li>
											<li><a href="javascript:;" data-id="Color082" style="background:#a9d92d">Color082</a></li>
											<li><a href="javascript:;" data-id="Color090" style="background:#dd6549">Color090</a></li>
											<li><a href="javascript:;" data-id="Color100" style="background:#cc463d">Color100</a></li>
											<li><a href="javascript:;" data-id="Color101" style="background:#cf3e36">Color101</a></li>
											<li><a href="javascript:;" data-id="Color102" style="background:#5E6671">Color102</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">有效期:</label>
								<div class="controls">
									<label id="time1">
										<input type="radio" name="date_info[type]" <?php if($info['date_info']['type'] == 'DATE_TYPE_FIX_TERM'): ?>disabled<?php endif; if(!empty($info['date_info']['type'])): if($info['date_info']['type'] == 'DATE_TYPE_FIX_TIME_RANGE'): ?>checked="true"<?php endif; else: ?>checked="true"<?php endif; ?> value="DATE_TYPE_FIX_TIME_RANGE">固定日期<input type="text" name="date_info[begin_timestamp]" data-date="" data-date-format="yyyy-mm-dd" value="<?php if($info['date_info']['type'] == 'DATE_TYPE_FIX_TIME_RANGE'): echo (date("Y-m-d",$info['date_info']['begin_timestamp'])); endif; ?>" placeholder="开始时间" class="datepicker" id="time1-1" style="margin-left: 10px;" <?php if($info['date_info']['type'] == 'DATE_TYPE_FIX_TERM'): ?>disabled<?php endif; ?>/> -- <input type="text" name="date_info[end_timestamp]" data-date="" data-date-format="yyyy-mm-dd" value="<?php if($info['date_info']['type'] == 'DATE_TYPE_FIX_TIME_RANGE'): echo (date("Y-m-d",$info["date_info"]["end_timestamp"])); endif; ?>" placeholder="结束时间" class="datepicker" id="time1-2" <?php if($info['date_info']['type'] == 'DATE_TYPE_FIX_TERM'): ?>disabled<?php endif; ?>/>
									</label>
									<label id="time2">
										<input type="radio" name="date_info[type]" <?php if($info['date_info']['type'] == 'DATE_TYPE_FIX_TIME_RANGE'): ?>disabled<?php endif; if($info['date_info']['type'] == 'DATE_TYPE_FIX_TERM'): ?>checked="true"<?php endif; ?> value="DATE_TYPE_FIX_TERM">
											领取后，
											<select name="date_info[fixed_begin_term]" id="time2-1" <?php if($info['date_info']['type'] == 'DATE_TYPE_FIX_TIME_RANGE'): ?>disabled<?php endif; ?>>
													<option value="0" <?php if($info['date_info']['type'] == 'DATE_TYPE_FIX_TERM'): if(($date_info[fixed_begin_term]) == "0"): ?>selected<?php endif; else: ?>selected<?php endif; ?> value="DATE_TYPE_FIX_TERM">当天</option>
													<option value="30" <?php if(($date_info[fixed_begin_term]) == "1"): ?>selected<?php endif; ?>>1天</option>
													<option value="90" <?php if(($date_info[fixed_begin_term]) == "2"): ?>selected<?php endif; ?>>2天</option>
												</select>
											生效，有效天数
											<select name="date_info[fixed_term]" id="time2-2" <?php if($info['date_info']['type'] == 'DATE_TYPE_FIX_TIME_RANGE'): ?>disabled<?php endif; ?>>
												<option value="30" <?php if($info['date_info']['type'] == 'DATE_TYPE_FIX_TERM'): if(($date_info[fixed_term]) == "30"): ?>selected<?php endif; else: ?>selected<?php endif; ?>>30天</option>
												<option value="90" <?php if(($date_info[fixed_term]) == "90"): ?>selected<?php endif; ?>>90天</option>
												<option value="180" <?php if(($date_info[fixed_term]) == "180"): ?>selected<?php endif; ?>>180天</option>
											</select>
									</label>
									<div><error class="color-red hidden"></error></div>
								</div>
							</div>
							<div class="control-group" id="allTime">
								<label class="control-label">可用时段:</label>
								<div class="controls">
									<label id="useTime1"><input type="radio" name="time_limit" <?php if(empty($info['time_limit_week']) or count($info['time_limit_week']) == 7): ?>checked="true"<?php endif; ?> value="0">全部时段</label>
									<label id="useTime2"><input type="radio" name="time_limit" <?php if($info['time_limit_week'] and count($info['time_limit_week']) != 7): ?>checked="true"<?php endif; ?>value="1">部分时段</label>
								</div>
								<div class="week-wrap" id="timeList" style="display: <?php if($info['time_limit_week'] and count($info['time_limit_week']) != 7 ): ?>block<?php else: ?>none<?php endif; ?>;">
									<label class="control-label">日期:</label>
									<div class="controls" id="weekList">
										<label class="inlineLabel"><input type="checkbox" name="time_limit_type[]" <?php if(in_array('1',$info['time_limit_week'])): ?>checked="true"<?php endif; ?> data-id="1" value='MONDAY ' >周一</label>
										<label class="inlineLabel"><input type="checkbox" name="time_limit_type[]" <?php if(in_array('2',$info['time_limit_week'])): ?>checked="true"<?php endif; ?> data-id="2" value='TUESDAY ' >周二</label>
										<label class="inlineLabel"><input type="checkbox" name="time_limit_type[]" <?php if(in_array('3',$info['time_limit_week'])): ?>checked="true"<?php endif; ?> data-id="3" value='WEDNESDAY ' >周三</label>
										<label class="inlineLabel"><input type="checkbox" name="time_limit_type[]" <?php if(in_array('4',$info['time_limit_week'])): ?>checked="true"<?php endif; ?> data-id="4" value='THURSDAY ' >周四</label>
										<label class="inlineLabel"><input type="checkbox" name="time_limit_type[]" <?php if(in_array('5',$info['time_limit_week'])): ?>checked="true"<?php endif; ?> data-id="5" value='FRIDAY ' >周五</label>
										<label class="inlineLabel"><input type="checkbox" name="time_limit_type[]" <?php if(in_array('6',$info['time_limit_week'])): ?>checked="true"<?php endif; ?> data-id="6" value='SATURDAY ' >周六</label>
										<label class="inlineLabel"><input type="checkbox" name="time_limit_type[]" <?php if(in_array('7',$info['time_limit_week'])): ?>checked="true"<?php endif; ?> data-id="7" value='SUNDAY ' >周日</label>
									</div>
									<div><error class="color-red hidden"></error></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">领券限制(选填):</label>
								<div class="controls">
									<input type="text" name="get_limit" class="span3" id="ticketPiece" placeholder="如不填则默认1张" value="<?php echo ($info["get_limit"]); ?>"/>张
									<div><error class="color-red hidden"></error></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">使用条件:</label>
								<div class="controls">
									<div id="condition-list">															
										<div id="gift-condition">											
												<div class="gift-c1">
													<label class="inlineLabel"><input type="checkbox" id="gift-box" name="cashLabel" <?php if(!empty($info)): if($info['advanced_info']['use_condition']['least_cost'] or $info['advanced_info']['use_condition']['object_use_for']): ?>checked="true" disabled<?php else: ?>disabled<?php endif; else: endif; ?>>消费条件</label>
													
													<?php if(!empty($info)): if($info['advanced_info']['use_condition']['least_cost']): ?><span><input class="span4" type="text" disabled value="<?php echo ($info['advanced_info']['use_condition']['least_cost']/100); ?>">元可用</span>
														<?php elseif($info['advanced_info']['use_condition']['object_use_for']): ?>														
															<span><input class="span4" type="text" disabled value="<?php echo ($info['advanced_info']['use_condition']['object_use_for']); ?>">可用</span><?php endif; ?>
													<?php else: ?>
														<div id="gift-item" style="display:none;">
															消费
															<select name="giftSelect" id="giftSelect">
																<option value="1" <?php if(!empty($info['advanced_info']['use_condition']['least_cost'])): ?>selected<?php endif; ?> >金额</option>
																<option value="2" <?php if(!empty($info['advanced_info']['use_condition']['object_use_for'])): ?>selected<?php endif; ?>>指定商品</option>
															</select>
															<span>
																<span id="giftMoney">满 <input type="text" name="least_cost" class="span2">元可用</span>
																<span id="giftGoods" style="display:none;"><input type="text" name="object_use_for" class="span2">可用</span>
															</span>
														</div><?php endif; ?>
													
													
													
												</div>
										</div>									
									</div>
									<div class="use-condition-3">
										<label class="inlineLabel" style="margin-top: 3px;margin-right: 20px;">优惠共享</label>
										<?php if(!empty($info['can_use_with_other_discount'])): if($info['can_use_with_other_discount'] == 1): ?><input id="shareChoose" class="span4" type="text" disabled value="不与其他优惠共享">
											<?php elseif($info['can_use_with_other_discount'] == 2): ?><input id="shareChoose" class="span4" type="text" disabled value="可与其他优惠共享">
											<?php else: ?>-<?php endif; ?>
										<?php else: ?>
										<select name="can_use_with_other_discount" id="shareChoose" >
											<option value=" " >请选择</option>
											<option value="不与其他优惠共享" >不与其他优惠共享</option>
											<option value="可与其他优惠共享" >可与其他优惠共享</option>
										</select><?php endif; ?>
									</div>
									<div class="use-condition-4">使用条件的设置会在券上展示，请务必仔细确认。</div>
									<div><error class="color-red hidden"></error></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">封面图片:</label>
								<div class="controls" id="coverWrap1">
									<div class="coverImgTips">
										图片建议尺寸：850像素*350像素，大小不超过2M。
									</div>
									<input type="file" name="icon_url_list" id="uploadBtn1" accept="image/bmp,image/png,image/jpeg,image/jpg,image/gif" >
									<div class="span2">
										<a class="thumbnail imgadd" href="javascript:;" onclick="getElementById('uploadBtn1').click()">
											<img  <?php if($info['brand_url']): ?>src="<?php echo ($info["brand_url"]); ?>"<?php elseif(empty($info['img_url']) && $info['logo_url']): ?>src="<?php echo ($info["advanced_info"]["abstract"]["icon_url_list"]["0"]); ?>"<?php else: ?>src="/tcm/template/Maruti/images/img_add.jpg"<?php endif; ?>>
										</a>
									</div>
									<div><error class="color-red hidden"></error></div>
									<div class="span2 sm-coverImg"><input type="hidden" name="icon_url_list[]" value="<?php echo ($info["advanced_info"]["abstract"]["icon_url_list"]["0"]); ?>"><input type="hidden" name="brand_url" value="<?php echo ($info["brand_url"]); ?>"></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">封面简介:</label>
								<div class="controls">
									<input type="text" name="abstract" class="span5" id="coverDes" placeholder="请输入封面简介,不超过12个字" value="<?php echo ($info["advanced_info"]["abstract"]["abstract"]); ?>"/>
									<div><error class="color-red hidden"></error></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">优惠说明:</label>
								<div class="controls">
									<div id="discount-text" style="margin-top: 6px;">
									<?php if($info['can_use_with_other_discount'] or $info['advanced_info']['use_condition']['least_cost'] or $info['advanced_info']['use_condition']['object_use_for'] ): if($info['can_use_with_other_discount'] == 1): ?>不与其他优惠共享;<?php endif; ?>
										<?php if($info['can_use_with_other_discount'] == 2): ?>可与其他优惠共享;<?php endif; ?>
										<?php if($info['advanced_info']['use_condition']['least_cost']): ?>消费满<?php echo ($info['advanced_info']['use_condition']['least_cost']/100); ?>元可用;
														<?php elseif($info['advanced_info']['use_condition']['object_use_for']): ?>														
															购买<?php echo ($info['advanced_info']['use_condition']['object_use_for']); ?>可用;<?php endif; ?>
									<?php else: ?>
										（本行是非自定义内容，无须填写）<?php endif; ?>
									</div>
									<input type="hidden" name="description_ex" id="discount-hideText" value="">															
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
							<div class="control-group">
								<label class="control-label">图文介绍(选填):</label>
								<div class="controls">
									<div class="articleTips">
										图片建议尺寸：900像素*500像素，大小不超过2M。至少上传一组图文，最多输入5000字。
									</div>
									<a href="javascript:;" class="btn btn-success" id="article-add">添加</a>
									<div class="article-perview" <?php if($html): ?>style="display:block"<?php else: ?>style="display:none"<?php endif; ?>>
										<?php echo ($html); ?>
									</div>
									
									<div class="article-cont" style="display: <?php if(empty($info['advanced_info']['text_image_list'])): ?>none<?php else: ?>block<?php endif; ?>">
										<div class="article-img">
											<a class="thumbnail imgadd" href="javascript:;" onclick="getElementById('uploadBtn2').click()">
												<i class="icon-picture"></i>
											</a>
										</div>
										<div class="article-area">
											<textarea name="text_image_list_text[]" placeholder="图文内容建议上传商品、服务、环境等优质图片，并辅之以简单描述"></textarea>
										</div>
										<div class="article-btn">
											<a href="javascript:;" class="btn btn-success" id="article-yes">确定</a>
											<a href="javascript:;" class="btn" id="article-no">清空</a>
										</div>
										<input type="file" name="image_url[]" id="uploadBtn2" accept="image/bmp,image/png,image/jpeg,image/jpg,image/gif" >
									</div>
								</div>
							</div>
							<div class="control-group">
								<div class="span12">
									<div class="widget-title">
										<span class="icon">
											<i class="icon-th-large"></i>
										</span>
										<h5>商户介绍(选填)</h5>
									</div>
									<div class="widget-content">
										<div class="control-group">
											<label class="control-label">电话:</label>
											<div class="controls">
												<input type="text" name="service_phone" class="span3" placeholder="手机或固话" value="<?php echo ($info["service_phone"]); ?>">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" style="padding-top: 12px">商店服务:</label>
											<div class="controls">
												<label class="inlineLabel"><input type="checkbox" name="business_service[]" <?php if(in_array('BIZ_SERVICE_FREE_WIFI',$info['advanced_info']['business_service'])): ?>checked="true"<?php endif; ?> value="BIZ_SERVICE_FREE_WIFI"/>免费WIFI</label>
												<label class="inlineLabel"><input type="checkbox" name="business_service[]" <?php if(in_array('BIZ_SERVICE_WITH_PET',$info['advanced_info']['business_service'])): ?>checked="true"<?php endif; ?> value="BIZ_SERVICE_WITH_PET"/>可带宠物</label>
												<label class="inlineLabel"><input type="checkbox" name="business_service[]" <?php if(in_array('BIZ_SERVICE_FREE_PARK',$info['advanced_info']['business_service'])): ?>checked="true"<?php endif; ?> value="BIZ_SERVICE_FREE_PARK"/>免费停车</label>
												<label class="inlineLabel"><input type="checkbox" name="business_service[]" <?php if(in_array('BIZ_SERVICE_DELIVER',$info['advanced_info']['business_service'])): ?>checked="true"<?php endif; ?> value="BIZ_SERVICE_DELIVER"/>可外卖</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="control-group">
								<div class="span12">
									<div class="widget-title">
										<span class="icon">
											<i class="icon-th-large"></i>
										</span>
										<h5>自定义入口(选填)</h5>
									</div>
									<div class="widget-content">
										<div class="control-group">
											<label class="control-label">入口名称:</label>
											<div class="controls">
												<input type="text" name="custom_url_name" class="span3" id="custom-name" placeholder="最多5个字符" value="<?php echo ($info["custom_url_name"]); ?>">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">引导语(选填):</label>
											<div class="controls">
												<input type="text" name="custom_url_sub_title" class="span3" id="custom-text" placeholder="最多6个字符" value="<?php echo ($info["custom_url_sub_title"]); ?>">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">点击跳转:</label>
											<div class="controls">
												http://<input type="text" name="custom_url" class="span3" value="<?php echo ($info["custom_url"]); ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="control-group">
								<div class="span12">
									<div class="widget-title">
										<span class="icon">
											<i class="icon-th-large"></i>
										</span>
										<h5>使用设置</h5>
									</div>
									<div class="widget-content">
										<div class="control-group">
											<label class="control-label">卡券库存:</label>
											<div class="controls">
												<input  type="text" name="sku[quantity]" class="span3" placeholder="卡券库存" value="<?php echo ($info["sku"]["total_quantity"]); ?>" <?php if(!empty($info)): ?>disabled="disabled"<?php endif; ?>/>
												<div><error class="color-red hidden"></error></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">核销码型:</label>
											<div class="controls code_type-button">
												<div class="btn-group">
													<input type="text" name="code_type" style="display:none" value="<?php echo ($info["code_type"]); ?>"/>
													<button type="button" class="btn" id="code_type" onclick="javascript:;"><?php if(empty($info)): ?>核销码型<?php else: echo (get_type_name($info["code_type"])); endif; ?></button>
													<button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
													<ul class="dropdown-menu">
														<li><a href="javascript:;" data-id="CODE_TYPE_QRCODE">二维码显示code</a></li>
														<li><a href="javascript:;" data-id="CODE_TYPE_BARCODE">一维码显示code</a></li>
														<li><a href="javascript:;" data-id="CODE_TYPE_ONLY_QRCODE">二维码不显示code</a></li>
														<li><a href="javascript:;" data-id="CODE_TYPE_TEXT">仅code类型</a></li>
														<li><a href="javascript:;" data-id="CODE_TYPE_NONE">无code类型</a></li>
													</ul>
												</div>
											</div>
										</div>
										<?php if(!empty($data)): ?><input type="hidden" name="store" value="<?php echo ($data['store']); ?>"><?php endif; ?>
										<div class="control-group">
											<label class="control-label">提醒:</label>
											<div class="controls">
												<input  type="text" name="notice" class="span5" placeholder="上限为16个汉字" <?php if($info['notice']): ?>value="<?php echo ($info["notice"]); ?>"<?php else: ?>value="请出示二维码核销卡券。"<?php endif; ?>/>
												<div><error class="color-red hidden"></error></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<button id="submit" type="button" class="btn btn-success"><?php if(empty($info)): ?>创建卡券<?php else: ?>修改卡券<?php endif; ?></button>
									<button type="button" class="btn btn-warning"  <?php if(!empty($info)): ?>onclick="window.location.href='/tcm/card.html'"<?php else: ?>onclick="window.location.href='<?php echo U('card/operate',array('type'=>'select_type'));?>'"<?php endif; ?>>返回</button>
							</div>
							<input type="file" accept="image/*"  name="image2" style="width:100%;opacity:0;filter:alpha(opacity=0);" id="inputfile"/>
						</form>
						<div id="root" data-link="/tcm"></div>
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
document.write( " <script src='/tcm/template/Maruti/js/preview.js?v= " + Math.random() + " '></s" + "cript> " )
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
		case "deal_detail":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入团购详情");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
		case "least_cost":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入起用金额");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
		case "reduce_cost":
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
		case "discount":
		var reg = /^([1-9])(\.\d)?$/;
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入打折额度");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else if(!reg.test(vlaue)){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>折扣额度只能是大于1且小于10的数字");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
		case "default_detail":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入优惠详情");
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
		case "notice":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入提醒");
			$(this).siblings('div').find('error').removeClass('hidden');
			$("#submit").attr("disabled",true);
	}else{
		$(this).removeClass('redborder');
		$(this).siblings('div').find('error').html("");
		$(this).siblings('div').find('error').addClass('hidden');
		$("#submit").attr("disabled",false);
	}
	break;
		case "quantity":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入库存");
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
		case "abstract":
	if(vlaue.length==0){
			$(this).addClass('redborder');
			$(this).siblings('div').find('error').html("<span>*</span>请输入封面简介");
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
	var quantity=$("input[name='sku[quantity]']").val();
	var notice=$("input[name='notice']").val();
	var type=$("input[name='type']").val();
	var color=$("input[name='color']").val();
	var code_type=$("input[name='code_type']").val();
	var abstract_title = $("input[name='abstract']").val();
	var logo_img=$("input[name='logo_url']").val();
	var abstract_img = $("input[name='icon_url_list[]']").val();
	var stat=1;
		if(title.length==0){
			$("input[name='title']").addClass('redborder');
			$("input[name='title']").siblings('div').find('error').html("<span>*</span>请输入标题");
			$("input[name='title']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		
		if(logo_img.length==0){
			$('#popbox .controls').html('请上传商户头像');
			center($("#popbox"));
			stat=0;
		}
		if(color.length==0){
			$('#popbox .controls').html('请选择合适的颜色');
			center($("#popbox"));
			stat=0;
		}
		if(abstract_img.length==0){
			$('#popbox .controls').html('请上传封面图片');
			center($("#popbox"));
			stat=0;
		}
		if(abstract_title.length==0){
			$("input[name='abstract']").addClass('redborder');
			$("input[name='abstract']").siblings('div').find('error').html("<span>*</span>请输入封面简介");
			$("input[name='abstract']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}		
		if(brand_name.length==0){
			$("input[name='brand_name']").addClass('redborder');
			$("input[name='brand_name']").siblings('div').find('error').html("<span>*</span>请输入商户名");
			$("input[name='brand_name']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		if(quantity.length==0){
			$("input[name='quantity']").addClass('redborder');
			$("input[name='quantity']").siblings('div').find('error').html("<span>*</span>请输入库存");
			$("input[name='quantity']").siblings('div').find('error').removeClass('hidden');
			stat=0;
		}
		
		if(code_type.length==0){
			$('#popbox .controls').html('请选择核销码型');
			center($("#popbox"));
			stat=0;
		}
		if($("input[name='deal_detail']").length > 0){
			var deal_detail=$("input[name='deal_detail']").val();
			if(deal_detail.length==0){
				$("input[name='deal_detail']").addClass('redborder');
				$("input[name='deal_detail']").siblings('div').find('error').html("<span>*</span>请输入团购详情");
				$("input[name='deal_detail']").siblings('div').find('error').removeClass('hidden');
				stat=0;
			}														
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
	if(stat==0){
		return false;
	}else{
	var htm=$('.article-perview').html();
	var data=$('.myform').serialize();
	if(htm){
		data+='&htm='+htm;
	}
	<?php if(empty($info)): ?>var url='<?php echo U('operate',array('type'=>gift_add_ajax));?>';
	<?php else: ?>
		var url='<?php echo U('operate',array('type'=>edit,'card_type'=>'兑换券','id'=>$_GET['id']));?>';<?php endif; ?>
		$.post(url,data).success(function(data){
			if (data.status==1) {
				$('#popbox .controls').html('保存成功');
						center($("#popbox"));
						 
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