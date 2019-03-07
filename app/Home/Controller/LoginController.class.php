<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
	    protected function _initialize(){
		$config = api('Config/lists');
        C($config);
	}
    public function index(){
		// $openid=session(MODULE_NAME.'_user_openid');
		// $this->assign('openid',$openid);
		// $originUrl=session(MODULE_NAME.'_up_url');
		// if($originUrl){
		// 	$this->assign('url',$originUrl);
		// }else{
		// 	$url=$_SERVER["HTTP_REFERER"];
		// 	$this->assign('url',$url);
		// }
		// $this->display('login');
        header('location:https://dev170.weibanker.cn/lvsk/www/jinfeng/');
	}

}		