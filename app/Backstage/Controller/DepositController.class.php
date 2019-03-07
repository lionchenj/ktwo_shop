<?php
namespace Backstage\Controller;
use Think\Controller;
class DepositController extends PublicController {
		static protected $deny  = array();
		static protected $allow = array('mobile_check');
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