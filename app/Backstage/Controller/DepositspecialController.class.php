<?php
namespace Backstage\Controller;
use Think\Controller;
class DepositspecialController extends PublicController {
		public function index(){
			if(IS_POST){
					$this->pay_ajax();
				}else{
					$this->pay();
				}		
		}
		public function operate(){
			$type=I('get.type');
			switch($type){
				case 'pay':
				if(IS_POST){
					$this->pay_ajax();
				}else{
					$this->pay();
				}					
				break;								
			}
		}
		protected function pay(){
			$twoMenu=$this->getMenus('Depositpay/index',2);		
			$this->assign('twoMenu', $twoMenu);
			$this->display('deposit_special');
		}			
		protected function pay_ajax(){
			$mobile=I('mobile');
			$code=I('captcha');
			$total=I('total');
			$money=I('money');
			$pay_type=I('pay_type');
			$mobile || $this->error('请输入手机号码');
			$code 	|| 	$this->error('请输入验证码');
			$user=M('member')->where(array('mobile'=>$mobile))->find();
			$user  || $this->error('用户不存在');
			$map['mobile']=$mobile;
			$map['status']=1;
			$info=M('MobileCheck')->where($map)->field('check_code,create_time')->find();			
			if($info['create_time']+300>=time()){
				if($code==$info['check_code']){			
				M('MobileCheck')->where($map)->setField('status',2);
						$order['orderid']=get_charge_orderid_chang();
						$order['goodsid']=0;
						$order['money']=$total;
						$order['userid']=$user['userid'];
						$order['create_time']=time();
						$order['operator']=is_login();
						$order['message']='任意充值';						
						$order['status']=1;
						M('recharge')->add($order);	
						$ll_order['no_order']=get_payid_chang();
						$ll_order['orderid_list']=$order['orderid'];
						$ll_order['money']=$total;
						$ll_order['create_time']=time();
						
					if($pay_type==3){
					$ll_order['oid_partner']='现金支付';
					M('pay_llipay')->add($ll_order);						
						$this->recharge_ok($ll_order);	
						$this->success();
					}else if($pay_type==1){
						$ll_order['oid_partner']=C('LLPAY_PARTNER')?C('LLPAY_PARTNER'):'201709210000942976';
						M('pay_llipay')->add($ll_order);						
						$res=$this->llpay($ll_order);
						$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
						$url = "$protocol$_SERVER[HTTP_HOST]".__ROOT__;
						$path=$ll_order['no_order']."/";
						$name=$ll_order['no_order'];
						$img_url=$url.two(false,$res,$path,false,$name);
						
						$this->success($img_url);
						
					}else{
					$this->error('网络错误');
					}
				}					
			}
			$this->error('验证码错误或过期');
		}		
		public function recharge_ok ($data){
			$map['no_order']=$data['no_order'];
			$map['status']=0;
			$save_data['money_order']=$data['money_order'];
			$save_data['oid_paybill']=$data['oid_order'];
			$save_data['status']=1;
			$save=M('pay_llipay')->where($map)->setField($save_data);
			if($save){
				unset($map['status']);
				$order_list=M('pay_llipay')->where($map)->getField('orderid_list');
				unset($map);
				$map['orderid']=array('in',$order_list);
				$recharge_data['status']=2;
				$recharge_data['update_time']=time();
				$recharge=M('recharge')->where($map)->setField($recharge_data);
				if($recharge){
					$recharge_info=M('recharge')->where($map)->find();
					$goods_map['id']=$recharge_info['goodsid'];
					$goods=M('reg_card')->where($goods_map)->find();
					$tar_map['id']=get_transaction_id();
					$tar_map['userid']=$recharge_info['userid'];
					$tar_map['type']=1;
					$tar_map['money']=$recharge_info['money'];
					$tar_map['title']="充值";
					$tar_map['orderid']=$order_list;
					$tar_map['create_time']=time();
					M('transaction')->add($tar_map);
					if($goods['give']>0){
					$tar_map['id']=get_transaction_id();
					$tar_map['userid']=$recharge_info['userid'];
					$tar_map['type']=4;
					$tar_map['money']=$goods['give'];
					$tar_map['title']="充值赠送";
					$tar_map['orderid']=$order_list;
					$tar_map['create_time']=time();
						M('transaction')->add($tar_map);
					}
					$money=$recharge_info['money']+$goods['give'];
					$member_map['userid']=$recharge_info['userid'];
					M('Member')->where($member_map)->setInc('balance',$money);
					
				}
			}
			
		}
	public function llpay($array){
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$url = "$protocol$_SERVER[HTTP_HOST]";
			$user_info=session(MODULE_NAME.'_user_auth');
			
			$data['no_order']=$array['no_order'];
			$data['oid_partner']=C('LLPAY_PARTNER')?C('LLPAY_PARTNER'):'201709210000942976';//连连商户号
			$data['money_order']=$array['money'];//计算价钱总和
			$data['dt_order']=date('YmdHis',time());
			$data['appid']=C('WECHAT_APPID')?C('WECHAT_APPID'):'wx3707459bb86392f8';
			$data['notify_url']=$url.__ROOT__.'/home/pay/recharge.html';//异步通知接收地址
			$data['sign_type']='RSA';
			$str='';
			ksort($data);
			foreach($data as $key=>$value){
				if($value){
					$str.=$key.'='.$value.'&';
				}	
			}
			$str=substr($str,0,strlen($str)-1);
			$data['sign']=$this->Rsasign2($str);
			$res=getHttpResponseJSON('https://o2o.lianlianpay.com/offline_api/createQrCode.htm',$data);
			$res=json_decode($res,true);
			if($res['ret_code']=='0000'){
				$payLoad=$res['dimension_url'];
				return $payLoad;
			}else{
				return false;
			}
	}
public function Rsasign2($data) {
	$priKey='-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDQKDq3m8wuTQPFn6XMoW87WrDpTF216odMCxcNqv2Jyexe72Us
W+HH0BDIKLuyEjgSflMOMzahrcamwUNpEldTKkmqSIOZ2ZWrEbiv4ofBLj00q97C
RsKKwKZmWlUQ6xJ6LrQhoXqVeoK9dHqQ+KHZ4xHz7BHLnrGubA/N4vuplQIDAQAB
AoGBAIPAQtH+ObFAq9eFIgMwVuAhmgJAhLvlEvfNuSy8greY6BR6v/XgvjqjdkvK
hGrEX1tNO7KsNbMF88uOXeV+Z2gmpQ0MHLBztXogqTKNaRe4Md5hovNzCDoU3zIu
RZgwWCY+/FLBO3Jy4n4tQZ1Jelf4Z0KuFMIgNcwUyeh124YNAkEA82JbfB2QNMsu
puNha7hzLjJParqLmJ5DcbjGFhpogPKtAsdzoU5pO3cR8uLEcLCTwlz1LDnGHBzS
sAHoKwEYCwJBANryaxy9pRILo7kGLWMkthZACnpTFFYAmbQSPCybI+gZ2TYanzds
vCBnidxaMqZ4EBqgbMwnPNTkKQqWMYGSKN8CQF4jbClcsfuJn3jTuEnXJU34DbnF
f9s/U+z3wD6qZkOCGiNaDEKXNqLWkm21ArBnzC9Aj2BU1GjpSSDlC+0eVjMCQQCs
OOnWZrqUskErxlcnWHY+lEtpozYo3DoLMhjRQYuCA+sfKtu4vjhRCQChKvYSifio
6S4LfIXWNE6wPCpe8HhjAkAFKbsSenCG5KCX70hL72Tn6fITejh+yMFHzWB1b7vA
dDD804+Yi3iczj9W20fCy47y2LxhZXm6z+IddTEzZU0P
-----END RSA PRIVATE KEY-----';
	//$key=C('LLPAY_PRIVATE')?C('LLPAY_PRIVATE'):$priKey;
	//转换为openssl密钥，必须是没有经过pkcs8转换的私钥
    $res = openssl_get_privatekey($priKey);
	//var_dump($res);
	//调用openssl内置签名方法，生成签名$sign
    openssl_sign($data, $sign, $res,OPENSSL_ALGO_MD5);

	//释放资源
    openssl_free_key($res);
    
	//base64编码
	//$sign=urlencode($sign);
	$sign = base64_encode($sign);
	file_put_contents("log.txt","key:".$priKey."\n", FILE_APPEND);
	file_put_contents("log.txt","签名原串:".$data."\n", FILE_APPEND);
	file_put_contents("log.txt","签名后:".$sign."\n", FILE_APPEND);
	return urlencode($sign);
    //return $sign;
	}
}