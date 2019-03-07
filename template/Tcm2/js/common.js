//弹窗提示方法
function popup(msg){
	$(".tips-box").text(msg);
	$(".tips-box").fadeIn();
	setTimeout(function(){
		$(".tips-box").fadeOut();
	},800);
}