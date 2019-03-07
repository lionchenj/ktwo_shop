<?php
namespace Home\Controller;
use Think\Controller;
/**
 *公共控制器
 *		$deny，	禁止通过url访问的方法（优先级高于$allow且高于权限）;
 *		$allow，允许通过url访问的方法（优先级高于权限）;
 * 		_empty()，空操作处理方法
 *		lists()，通用数据分页方法
 *		visit(),访问记录方法
 *		checkAuth();权限认证
 * 		
 */
class PublicController extends Controller {
	static protected $deny  = array('lists','visit');
	static protected $allow = array();
	public function _empty(){
	 	$this->redirect('/404.html');
	 }
    protected function _initialize(){
		$config = api('Config/lists');
        C($config);
        //setcookie('access_token','0WBs2dKg7p3PDffu0b7YwtDs5Ln5MZLR',time()+36000,'/');
        //dump($_COOKIE);
        if(empty($_COOKIE['access_token'])){
        	$this->redirect('Login/index');
        }else{
        	$id = array('access_token'=>$_COOKIE['access_token']);
		    $userInfo = getUserInfoShop($id);
        	$auth = array('uid'	=> $userInfo['userid']);
			session(MODULE_NAME.'_user_auth', $auth);
			session(MODULE_NAME.'user_auth_sign', data_auth_sign($auth));
        }
        // }
		// if(empty(is_login())){
		// 	$this->redirect('Login/index');
			
		// }else{
		// 	$auth = session(MODULE_NAME.'_user_auth');
		// 	$auth['status']=1;
		// 	session(MODULE_NAME.'_user_auth', $auth);
		// 	session(MODULE_NAME.'user_auth_sign', data_auth_sign($auth));	
			
		// }
		$goodslist=M('goods')->where(array('status'=>3))->field('goodsid')->select();
		if(!empty($goodslist)){
			$goodsid_list=array_column($goodslist,'goodsid');
			$num_map['goodsid']=array('in',$goodsid_list);
		}else{
			$num_map['goodsid']=0;
		}
		// $userid = array('access_token'=>$_COOKIE['access_token']);
		// $userInfo = getUserInfoShop($userid);
		$num_map['userid']=is_login();
		//dump($num_map);
		$num=M('cart')->where($num_map)->sum('num');
			if(empty($num)){
				$num=0;
		}
		$this->assign('_shopnum', $num);
		$this->visit();
	}
	 protected function visit(){
		$visit_session=session(MODULE_NAME.'_visit');
		if(empty($visit_session)){
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$visit_data['visit_link']=$url;
			$visit_data['create_time']=time();
			$visit_data['visit_model']=MODULE_NAME;
			$visit_data['userid']=is_login();
			$visit=M('visit')->add($visit_data);
			if($visit>0){
			session(MODULE_NAME.'_visit',$visit);
			}
		}else{
			M('visit')->where(array('id'=>$visit_session))->setField('userid',is_login());
		}
	}
	 // protected function wechatLogin(){
		// vendor('Wechat.Wechat');
		// $wechatConfig=array(
		// 'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wx3707459bb86392f8',
		// 'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'56301b10a249960f3cee8cd7ed1d7973',
		// );
		// $model = new \Wechat($wechatConfig);
		// $res=$model->getUserInfo($_GET['code']);
		// if($res['status']==1){
		// 	$userInfo=$res['userInfo'];
		// 	if($userInfo['openid']){
		// 		unset($userInfo['tagid_list']);
		// 		$checkMember=M('member')->where(array('openid'=>$userInfo['openid']))->getField('userid');
		// 		if($checkMember){
		// 			$userInfo['update_time']=time();
		// 			M('member')->where(array('userid'=>$checkMember))->setField($userInfo);
		// 			$auth = array(
		// 				'uid'			=> $checkMember,
		// 				'openid'		=> $userInfo['openid'],
		// 				'status'     	=> 1,
		// 				'nickname'		=> $userInfo['nickname'],
		// 				'headimgurl'	=> $userInfo['headimgurl'],
		// 			);
		// 			session(MODULE_NAME.'_user_auth', $auth);
		// 			session(MODULE_NAME.'user_auth_sign', data_auth_sign($auth));
		// 		}else{
		// 			session(MODULE_NAME.'_user_openid', $userInfo);
		// 		}
		// 	}
		// }else{
		// 	header("Location: ".$res['url']); exit;
		// }
	 // }
	
}