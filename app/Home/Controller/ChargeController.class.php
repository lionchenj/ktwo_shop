<?php
namespace Home\Controller;
use Think\Controller;
class ChargeController extends Controller {
    public function index(){
		
			$map['status']=1;
			$list=M('reg_card')->where($map)->select();
			$this->assign('_list',$list);
			$this->display('recharge');
	}
	public function recharge_edit(){
		if(is_login()){
			session(MODULE_NAME.'_up_url',null);
			$this->redirect('About/recharge_edit',array('id'=>I('id')));
		}else{
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$originUrl = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			session(MODULE_NAME.'_up_url',$originUrl);
				$map['id']=I('id');
				$map['status']=1;
				$info=M('reg_card')->where($map)->find();
				$info || $this->_empty();
				$mobile=get_user_info('mobile');
				$this->assign('_info',$info);
				$this->assign('mobile',$mobile);
				$this->assign('carid',$map['id']);
				$this->display('recharge-detail');
		}
	}
}		