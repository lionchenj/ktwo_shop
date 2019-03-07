<?php
namespace Home\Controller;
use Think\Controller;
class LineController extends PublicController {
    public function index(){
		$mobile=get_user_info('mobile');
		if(empty($mobile)){
			$this->redirect('login');exit;
		}
		vendor('Wechat.Wechat');
		$wechatConfig=array(
		'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wx3707459bb86392f8',
		'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'56301b10a249960f3cee8cd7ed1d7973',
		);
		$model = new \Wechat($wechatConfig);
		$res=$model->getSignPackage();
		$this->assign('getSignPackage',json_encode($res));
		$this->display('index_simple');
	}
	public function login(){
		$mobile=get_user_info('mobile');
		if($mobile){
			$this->redirect('index');exit;
		}
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
				$data['mobile']=$mobile;
				$data['update_time']=time();
				$true=set_user_auth($data);
				if($true){
				M('MobileCheck')->where($map)->setField('status',2);
				$this->success();
				}
			}
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
		$url="https://yun.tim.qq.com/v5/tlssmssvr/sendsms?sdkappid=1400045802&random=".$random;
		$data['tel']['nationcode']="86";
		$data['tel']['mobile']=$mobile;
		$data['type']=0;
		$data['msg']=$code."为您的登录验证码，请于5分钟内填写。如非本人操作，请忽略本短信。";
		$data['sig']= hash("sha256","appkey=ed401c01ec2b942f9243a38a5649b86a&random=".$random."&time=".$time."&mobile=".$mobile,FALSE);
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