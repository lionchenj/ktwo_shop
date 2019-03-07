<?php
namespace Home\Controller;
use Think\Controller;
class SubmitController extends PublicController {
    public function index(){
		if(IS_POST){
			$card_1=M('goods')->where(array('id'=>1))->getField('money');
			$card_2=M('goods')->where(array('id'=>2))->getField('money');
			$post=I('post.');
			if(empty($post['num1']) && empty($post['num2'])){
				$this->error('请先选购电影票');
			}
			if(empty($post['username'])){
				$this->error('请填写姓名');
			}
			if(empty($post['mobile'])){
				$this->error('请填写手机号码');
			}
			if(empty($post['group'])){
				$this->error('请填写团队');
			}
			$money1=0;
			$orderid_list='';
			if($post['num1']){
				$order['orderid']=get_orderid_chang();
				$order['userid']=is_login();
				$order['num']=$post['num1'];
				$money1=$order['money']=$card_1*$order['num'];
				$order['goodsname']=M('goods')->where(array('id'=>1))->getField('name');
				$order['goodsid']=1;
				$order['name']=$post['username'];
				$order['mobile']=$post['mobile'];
				$order['surplus']=$post['num1'];
				$order['city']=$post['city'];
				$order['group']=$post['group'];
				$order['create_time']=time();
				$orderid1=M('order')->add($order);
				if($orderid1>0){
					$orderid_list.=$order['orderid'].",";
				}else{
					$this->error('网络错误');
				}
				unset($order);
			}
			if($post['num2']){
				$order['orderid']=get_orderid_chang();
				$order['userid']=is_login();
				$order['num']=$post['num2'];
				$money2=$order['money']=$card_2*$order['num'];
				$order['goodsname']=M('goods')->where(array('id'=>2))->getField('name');;
				$order['goodsid']=2;
				$order['name']=$post['username'];
				$order['mobile']=$post['mobile'];
				$order['surplus']=$post['num2'];
				$order['group']=$post['group'];
				$order['create_time']=time();
				$orderid2=M('order')->add($order);
				if($orderid2>0){
					$orderid_list.=$order['orderid'].",";
				}else{
					$this->error('网络错误');
				}
				unset($order);
			}
			$pay_data['no_order']=get_payid_chang();
			$pay_data['oid_partner']='201709210000942976';
			$pay_data['money']=$money1+$money2;
			$pay_data['orderid_list']=$orderid_list;
			$pay_data['create_time']=time();
			$payid=M('pay_llipay')->add($pay_data);
				if($payid>0){
					$pay_data['num']=$post['num1']+$post['num2'];
					$return=$this->wxllpay($pay_data);
					if($return){
						$return_data['type']=1;
						$return_data['data']=$return;
						$return_data['payid']=$payid;
						$this->success($return_data);
					}else{
						$return_data['type']=2;
						$save['no_order']=get_payid_chang();
						$id=M('pay_llipay')->where(array('id'=>$payid))->setField($save);
						if($id){
						$return_data['data']=$payid;
						$this->success($return_data);
						}
							$this->error('网络错误');
					}
				}else{
					$this->error('网络错误');
				}
			
		}else{
			$province=M('city')->field('province')->order('id asc')->group('province')->select();
			$province=array_column($province,'province');
			$i=0;
			foreach($province as $key =>$vo){
				$data[$i]['name']=$vo;
				$data[$i]['sub']=M('city')->where(array('province'=>$vo))->field('city as name')->select();
				$i++;
			}
			$city=json_encode($data);
			$card_1=M('goods')->where(array('id'=>1))->field('id','money','cardid')->find();
			$card_2=M('goods')->where(array('id'=>2))->field('id','money')->find();
			$this->assign('card_1', $card_1);
			$this->assign('card_2', $card_2);
			$this->assign('city', $city);
			$this->display('buy-tickets');
		}
	}
	//查询订单信息
	public function query($data){
			$str='';
			$array=[];
			$array['oid_partner']=$data['oid_partner'];
			$array['no_order']=$data['no_order'];
			$array['dt_order']=$data['dt_order'];
			$array['sign_type']='RSA';
			$array['type_dc']='0';
			$array['oid_paybill']=$data['oid_paybill'];
			ksort($array);
			foreach($array as $key=>$value){
				if($value!=''){
					$str.=$key.'='.$value.'&';
				}	
			}
			
			$str=substr($str,0,strlen($str)-1);
			$array['sign']=Rsasign($str);
			$res=getHttpResponseJSON('https://wallet.lianlianpay.com/llwalletapi/orderquery.htm',$array);
			echo $res;
	}
	public function notify(){
			$notify_info = $GLOBALS['HTTP_RAW_POST_DATA'];
			$file = dirname(__DIR__).'/lianlian.txt';
			file_put_contents($file, $notify_info,FILE_APPEND);
			header("Content-Type: application/json; charset=UTF-8");
			$data=json_decode($notify_info,true);
			if($data['no_order']){
				//$this->split_ok($data['no_order']);
			}
				$return['ret_cod']='0000';
				$return['ret_msg']="交易成功";
				$this->ajaxReturn($return,'json');
	}
	public function wxllpay($array){
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$url = "$protocol$_SERVER[HTTP_HOST]";
			$user_info=session(MODULE_NAME.'_user_auth');
			$data['openid']=$user_info['openid'];//微信用户openid
			$data['user_id']=$user_info['openid'];//用户id
			$data['no_order']=$array['no_order'];
			$data['appid']=C('WECHAT_APPID')?C('WECHAT_APPID'):'wx3707459bb86392f8';
			$data['dt_order']=date('YmdHis',time());
				//下订单基本参数

			$data['money_order']=$array['money'];//计算价钱总和
			$data['oid_partner']="201709210000942976";//连连商户号
			$data['busi_partner']='101001';//虚拟商品代码
			$data['col_oidpartner']='201709210000942976';//连连商户号
			$data['notify_url']=$url.__ROOT__.'/home/pay/notify.html';//异步通知接收地址
			$data['pay_type']='W';//微信公众号支付代码
			$data['sign_type']='RSA';
			//风险控制参数
			
			$risk['user_info_mercht_userno']=$data['user_id'];//用户id
			$risk['goods_name']="长沙市电影票";
			$risk['user_info_dt_register']=date('YmdHis',M('member')->where(array('userid'=>is_login()))->getField('create_time'));//用户注册时间
			$risk['cinema_name']="湖南双鼎文化传媒有限公司";
			$risk['book_phone']="13314212345";//商家电话
			$risk['cinema_addr_province']="430000";
			$risk['dt_play']=$data['dt_order'];
			$risk['goods_count']=$array['num'];
			$risk['frms_ware_category']='1017';//风险控制参数
			$res=wechat_pay($data,$risk);
			if($res['ret_code']=='0000'){
				$payLoad=json_encode($res['payLoad'],true);
				return $payLoad;
			}else{
				return false;
			}
	}
	public function kjllpay(){
		/*	//下订单基本参数

			$data['version']//版本号 1.1
			$data['app_request']//3
			$data['user_id']//用户id
			$data['no_order']//下单号
			$data['dt_order']//下单时间
			$data['money_order']//计算价钱总和
			$data['oid_partner']//连连商户号
			$data['busi_partner']//虚拟商品代码101001
			$data['notify_url']//异步通知接收地址
			$data['url_return']//支付完成后返回的页面地址
			$data['name_goods']//商品名称
			$data['sign_type']='RSA';
			//风险控制参数
			
			$risk['user_info_mercht_userno']//用户id
			$risk['goods_name']//商品名
			$risk['user_info_dt_register']//用户注册时间
			$risk['cinema_name']//电影院名称
			$risk['book_phone']//商家电话
			$risk['cinema_addr_province']="430000";
			$risk['dt_play']=$data['dt_order'];//下单时间
			$risk['goods_count']//商品数量
			$risk['frms_ware_category']='1006';//商品代码 1017:电影票


*/
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$url = "$protocol$_SERVER[HTTP_HOST]";
	$payid=I('payid');
	$payid || E();
	$order=M('pay_llipay')->where(array('id'=>$payid))->find();
	if(empty($order)){
		 E();
	}
	$user_info=session(MODULE_NAME.'_user_auth');
	$data['user_id']=$user_info['openid'];//用户id
	$data['version']='1.1';
	$data['app_request']='3';
	$data['oid_partner']="201709210000942976";
	$data['busi_partner']='101001';
	$data['notify_url']=$url.__ROOT__.'/home/pay/notify.html';
	$data['url_return']=$url.__ROOT__.'/home/about/index.html';
	$data['no_order']=$order['no_order'];
	$data['sign_type']='RSA';
	$data['money_order']=$order['money'];
	$data['dt_order']=date('YmdHis',time());
	$data['name_goods']='一路绽放电影票';
	$risk['user_info_mercht_userno']=$data['user_id'];//用户id
	$risk['goods_name']="长沙市电影票";
	$risk['user_info_dt_register']=date('YmdHis',M('member')->where(array('userid'=>is_login()))->getField('create_time'));//用户注册时间
	$risk['cinema_name']="湖南双鼎文化传媒有限公司";
	$risk['book_phone']="13314212345";//商家电话
	$risk['cinema_addr_province']="430000";
	$risk['dt_play']=$data['dt_order'];
	$risk['goods_count']='1';
	$risk['frms_ware_category']='1017';//风险控制参数
	$str='';
	$data['risk_item']=json_encode($risk);
		ksort($data);
	foreach($data as $key=>$value){
		if($value){
			$str.=$key.'='.$value.'&';
		}	
	}
	
	$str=substr($str,0,strlen($str)-1);	
	$data['sign']=Rsasign($str);
	$url='https://wap.lianlianpay.com/payment.htm';
	$para=json_encode($data);
	echo "<form id='llpaysubmit' name='llpaysubmit' action='" . $url . "' method='POST'>";
	
		echo"<input type='hidden' name='req_data' value='" . $para . "'/>";

    echo"<input style='display:none' type='submit' value='submit'></form>";
	echo"<script>document.forms['llpaysubmit'].submit();</script>";
	}
	
	public function wechat_return(){
			$id=I('payid');
			$data['no_order']=M('pay_llipay')->where(array('id'=>$id))->getField('no_order');
			if($data['no_order']){
				$res=query($data['no_order']);
				if($res){
					$this->order_ok($data);
					$this->success();exit;
				}
				}
				$this->error($data['no_order']);
	}
	public function order_ok ($data){
		$map['no_order']=$data['no_order'];
		$map['status']=0;
		$save_data['money_order']=$data['money_order'];
		$save_data['oid_paybill']=$data['oid_paybill'];
		$save_data['status']=1;
		$save=M('pay_llipay')->where($map)->setField($save_data);
		if($save){
			unset($map['status']);
			$order_list=M('pay_llipay')->where($map)->getField('orderid_list');
			unset($map);
			$map['orderid']=array('in',$order_list);
			M('order')->where($map)->setField('status',2);
		}
	}
}