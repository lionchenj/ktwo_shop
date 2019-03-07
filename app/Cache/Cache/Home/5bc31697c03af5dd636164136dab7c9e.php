<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="apple-mobile-web-app-capable" content="yes"/><!-- 是否启用 WebApp 全屏模式 -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/><!-- 设置状态栏的背景颜色 -->
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no"/><!-- 禁止数字识自动别为电话号码 --><!-- 不让android识别邮箱 -->
	<title>一路绽放</title>
	<link rel="stylesheet" type="text/css" href="/shadow/mast/template/Cinema/css/common.css">
	<link rel="stylesheet" type="text/css" href="/shadow/mast/template/Cinema/css/style.css">
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/resize.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/PxLoader.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/PxLoaderVideo.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/PxLoaderImage.js"></script>
	<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/Wechat.js"></script>	
	
</head>
<body>
	<div class="container">
		<div class="loading-bg">
			<div  class="loading-num">
				<img src="/shadow/mast/template/Cinema/images/loading.gif">
				<div id="progress">0%</div>
			</div>
		</div>
		<div class="main-1">
			<div class="main1-t1">听听我的回忆吗？</div>
			<div class="main1-t2">点我来听</div>
		</div>
		<div class="all-screen-btn" id="btn-2" onclick="scendVideoPlay()" style="display: none"></div>
		<div class="video-container v-wrap-2" id="video-wrap-2">
			<video src="/shadow/mast/template/Cinema/media/video-2.mp4" id="video-2" preload="auto"  webkit-playsinline="true" playsinline="true" x5-video-player-type="h5" x5-video-player-fullscreen="true" x-webkit-airplay="true" style="object-fit:fill"></video>
			<div class="video-jump" style="font-size: 1.4rem;color:#fff;position: absolute;top:10%;right:3%;border:1px solid #fff;padding:.5rem;">跳过视频</div>
		</div>
		<div class="main-2 none" id="main-2">
			<div class="main-p1 abs"><img src="/shadow/mast/template/Cinema/images/p1.png"></div>
			<div class="main-p2 abs"><img src="/shadow/mast/template/Cinema/images/p2.png"></div>
			<div class="main-p3 abs"><img src="/shadow/mast/template/Cinema/images/p3.png"></div>
			<div class="main-people abs"><img src="/shadow/mast/template/Cinema/images/all-people.png"></div>
			<div class="main-title abs"><img src="/shadow/mast/template/Cinema/images/white-title.png"></div>
			<div class="main-time abs"><img src="/shadow/mast/template/Cinema/images/white-time.png"></div>
			<div class="main-btn abs">
				<div class="main-btn-wrap"><a href="http://dx1.datazan.cn/1.mp4" class="inline-block">观看完整片花</a></div>
				<div class="main-btn-wrap"><a href="<?php echo U('submit/index');?>" class="inline-block">购票观看电影</a></div>
				<div class="main-btn-wrap ticket-btn"><a href="<?php echo U('about/index');?>" class="inline-block">查看我的卡券</a></div>
			</div>
			<div class="footer-text abs">
				<img src="/shadow/mast/template/Cinema/images/white-footer.png">
			</div>
		</div>
		<div class="music-switch">
			<img src="/shadow/mast/template/Cinema/images/music-on.png" class="music-on">
			<img src="/shadow/mast/template/Cinema/images/music-off.png" class="music-off">
		</div>
		<audio style="display:none" id="musicBox" preload="auto" src="http://dx1.datazan.cn/music.mp3"></audio>
	</div>
	<!-- 验证提示框 -->
		<div class="error-tips" style="display: none;">
		</div>
	<script type="text/javascript" src="/shadow/mast/template/Cinema/js/iphone-inline-video.min.js"></script>
	<script type="text/javascript">
		var v2 = document.getElementById('video-2');
		var wrap2 = document.getElementById('video-wrap-2');
		var btn2 = document.getElementById("btn-2");
		var music = document.getElementById("musicBox");
		var flag = false;
		var u = navigator.userAgent;
		var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1;
		var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
		if(isiOS){
			enableInlineVideo(v2);
		}
		function scendVideoPlay(){
		    $(btn2).hide();
			$(".main1-t2").removeClass("fade-animate");
		    $(".main-1").hide();
			v2.play();
		}

		function loadImg(){
			var preCur = 0,$process = $("#progress");
			var imgArr=[];
			imgArr.push('/shadow/mast/template/Cinema/images/color-bg.png');
			$('img').each(function(i){
				var imgSrc=$(this).attr('src');
				if(imgSrc){
					imgArr.push(imgSrc);
				}
			})
			var loader = new PxLoader(),imgArr;
			for(var i = 0;i < imgArr.length;i++) {
				var pxImg = new PxLoaderImage(imgArr[i]);
				loader.add(pxImg);
			}
			loader.addProgressListener(function(e) {
				$process.text(parseInt((e.completedCount/e.totalCount)*100)+"%");
			});
			loader.addCompletionListener(function(e) {
				if(e.completedCount==e.totalCount){
					setTimeout(function(){
						$(".loading-bg").hide();
						playAll();
					},800);
				}
			})
			loader.start();
		}
		function playAll(){
			setTimeout(function(){
				$(".main1-t1").addClass("fade-animate");
			},500);
			setTimeout(function(){
				$(".main1-t1").removeClass("fade-animate");
			},1000);
			setTimeout(function(){
				$(".main1-t2").addClass("fade-animate");
				$(btn2).show();
			},2000);

			v2.addEventListener("ended",function(){
				$(v2).fadeOut();
				$(".main-2").fadeIn();
				$(".main-p1").addClass("fadeAnimate-1");
				$(".main-p2").addClass("fadeAnimate-2");
				$(".main-p3").addClass("fadeAnimate-3");
				$(".main-title").addClass("fadeAnimate-4-1");
				$(".main-time").addClass("fadeAnimate-4-2");
				$(".main-btn").addClass("fadeAnimate-4-3");
				$(".main-people").addClass("fadeAnimate-5");
			})
		}
		function loadVideo(){
			var loader2 = new PxLoader();
			var pxVideo = new PxLoaderVideo('/shadow/mast/template/Cinema/media/video-2.mp4');
			loader2.add(pxVideo);
			loader2.addCompletionListener(function(e) {
				console.log(e.completedCount/e.totalCount);
			});
		}
		function loadMusic(){
			document.addEventListener("WeixinJSBridgeReady", function () {
				music.load();
			}, false);
			music.addEventListener("canplaythrough",function(){
				$("#progress").text("50%");
				music.play();
				loadImg();
			})
		}
		$(function(){
			$(document).on('touchmove','body',function(i){
				i.preventDefault();
			});
			loadMusic();
			loadVideo();
			$(".music-on").on("click",function(){
				music.pause();
				$(this).addClass("music-right");
				$(".music-off").addClass("music-left");
			});
			$(".music-off").on("click",function(){
				music.play();
				$(this).removeClass("music-left");
				$(".music-on").removeClass("music-right");
			})
			$('.video-jump').on('click',function(){
				// $('.video-container').removeclass('v-wrap-2');
				$('#video-2').hide();
				window.location.href="<?php echo U('index');?>";
				// $('.main-2').show();
			})
		})
	</script>
	<script type="text/javascript">
	var wechat_data=<?php echo ($getSignPackage); ?>;
		wechat_data['share']={};
		wechat_data['share']['title']='《一路绽放》11月23日感恩节全国同步上映！';
		wechat_data['share']['desc']='此通道是电影《一路绽放》唯一指定电影票预购通道！';
		wechat_data['share']['imgUrl']='https://wx.datazan.cn/sample/Uploads/Picture/2017-09-30/59cf6ef5c109b.png';
		wechatSetConf(wechat_data);
	</script>

</body>
</html>