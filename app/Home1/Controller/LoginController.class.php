<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
		$url=$_SERVER['HTTP_REFERER'];
		$url || $url=U('Index/index');
		$this->assign('url',$url);
		$this->display('login');
	}
	public function submit(){
		$mobile=I('mobile');
		$code=I('code');
		$mobile || $this->error('请输入手机号码');
		$code 	|| 	$this->error('请输入验证码');
		$map['mobile']=$mobile;
		$map['status']=1;
		$info=M('MobileCheck')->where($map)->field('check_code,create_time')->find();
		if($info['create_time']+300>=time()){
			if($code==$info['check_code']){
				$userinfo=M('member')->where(array('mobile'=>$mobile))->find();
				if($userinfo['userid']>0){
					if($userinfo['status']>0){
						$auth = array(
							'uid'			=> $userinfo['userid'],
						);
						session(MODULE_NAME.'_user_auth', $auth);
						session(MODULE_NAME.'user_auth_sign', data_auth_sign($auth));
					}else{
						$this->error('账号被禁用，请联系客服');
					}
					$true=1;
				}else{
					if(is_login()){
					$save['mobile']=$mobile;
					$save['level']=2;
					$save['update_time']=time();
					$save['user_card']=rand_user_string();
					M('member')->where(array('userid'=>is_login()))->save($save);
					$true=1;	
					}else{
					$add['mobile']=$mobile;
					$add['nickname']=$mobile;
					$add['level']=2;
					$add['create_time']=time();
					$add['user_card']=rand_user_string();
					$uid=M('member')->add($add);
					if($uid>0){
						$auth = array(
							'uid'			=> $uid,
						);
						session(MODULE_NAME.'_user_auth', $auth);
						session(MODULE_NAME.'user_auth_sign', data_auth_sign($auth));
						$true=1;
					}
				}
				}
			}
		}
		if($true){
				M('MobileCheck')->where($map)->setField('status',2);
				$this->success();
		}
		$this->error('验证码错误或过期');
}
	public function mobile_check(){
		$mobile=I('mobile');
		$mobile || $this->error('请输入手机号码');
		$map['mobile']=$mobile;
		$map['status']=1;
		M('MobileCheck')->where($map)->setField('status',2);
		$code=get_rand_string(4);
		$random=get_rand_string(6);
		$time=time();
		$url="https://yun.tim.qq.com/v5/tlssmssvr/sendsms?sdkappid=1400048524&random=".$random;
		$data['tel']['nationcode']="86";
		$data['tel']['mobile']=$mobile;
		$data['type']=0;
		$data['msg']=$code."为您的登录验证码，请于5分钟内填写。如非本人操作，请忽略本短信。";
		$data['sig']= hash("sha256","appkey=f239878114460cee80ba9999a0494337&random=".$random."&time=".$time."&mobile=".$mobile,FALSE);
		$data['time']=$time;
		$data['extend']='';
		$data['ext']='';
		$data=json_encode($data);
		$res=json_decode(httpPost($url,$data),true);
		if($res['result']==0){
			$add['mobile']=$mobile;
			$add['check_code']=$code;
			$add['create_time']=time();
			$add['status']=1;
			M('MobileCheck')->add($add);
			$this->success();
		}else{
			$this->error($res['errmsg']);
		}
	}
}		