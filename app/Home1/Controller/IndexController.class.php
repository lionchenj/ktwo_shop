<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends PublicController {
    public function index(){
			$map['userid']=is_login();
			$userinfo=M('member')->where($map)->field('nickname,headimgurl,level,balance,integral')->find();
			$userinfo['level']=get_level_name($userinfo['level']);
			$this->assign('userinfo',$userinfo);
			$this->display('index');
	}
}