function wechatSetConf(data){
	wx.config({

    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。

    appId: data.appId, // 必填，公众号的唯一标识

    timestamp: data.timestamp, // 必填，生成签名的时间戳

    nonceStr: data.nonceStr, // 必填，生成签名的随机串

    signature: data.signature,// 必填，签名，见附录1

    jsApiList: [
            'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'hideMenuItems',
            'showMenuItems',
            'hideAllNonBaseMenuItem',
            'showAllNonBaseMenuItem',
            'translateVoice',
            'startRecord',
            'stopRecord',
            'onRecordEnd',
            'playVoice',
            'pauseVoice',
            'stopVoice',
            'uploadVoice',
            'downloadVoice',
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'getNetworkType',
            'openLocation',
            'getLocation',
            'hideOptionMenu',
            'showOptionMenu',
            'closeWindow',
            'scanQRCode',
            'chooseWXPay',
            'openProductSpecificView',
            'addCard',
            'chooseCard',
            'openCard'
        ],

});
wx.ready(function () {
	//1.微信分享数据
	var shareData={};
	shareData['title']=data.share['title'];
	shareData['desc']=data.share['desc'];
	shareData['imgUrl']=data.share['imgUrl'];
	shareData['success']=function (res) {
		 if (res.errMsg == 'sendAppMessage:ok') {
            if (Wfriend == '1') {
                shareok();
            }
        } else if (res.errMsg == 'shareTimeline:ok') {
            if (WfriendLine == '1') {
                shareok();
            }
        } else if (res.errMsg == 'shareQQ:ok') {
            if (QQfriend == '1') {       
                shareok();
            }
        }
	};
	shareData['cancel'] = function (res) {
		$(".error-tips").text(res);
		$(".error-tips").fadeIn();
		setTimeout(function(){
			$(".error-tips").fadeOut();
		},800)
	}
	wx.onMenuShareAppMessage(shareData);
    wx.onMenuShareTimeline(shareData);
    wx.onMenuShareQQ(shareData);
    wx.onMenuShareWeibo(shareData);
    wx.onMenuShareQZone(shareData);
	function shareok(){
		$(".error-tips").text("分享成功");
		$(".error-tips").fadeIn();
		setTimeout(function(){
			$(".error-tips").fadeOut();
		},800)
	}
	//添加卡券
	document.querySelector('#addCard').onclick = function () {
		 $('.click').attr('disabled',"true");
		 $('#addCard').attr('disabled',"true");
		wx.addCard({
		  cardList: data.addCard,
		  success: function (res) {
		  },
		  cancel: function (res) {
			  popup("用户取消领取");
			  setTimeout(function(){
			  $('.click').removeAttr("disabled"); 
			  $('#addCard').removeAttr("disabled"); 
			  },2000);
              
          },
          fail:function(res){
				popup("领取失败");
				setTimeout(function(){
				$('.click').removeAttr("disabled"); 
				$('#addCard').removeAttr("disabled"); 
				},2000);
                
           
          }
		  
		});
	};
})
wx.error(function (res) {
		$(".error-tips").text('用户取消');
		$(".error-tips").fadeIn();
		setTimeout(function(){
		$(".error-tips").fadeOut();
		},800)
});
}