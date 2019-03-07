<?php
namespace Backstage\Controller;
use Think\Controller;
class LlpayController extends Controller {
	 protected function _initialize(){
		vendor('Lianpay.Rsafunction');
		vendor('Lianpay.Corefunction');         
		vendor('Lianpay.Md5function');  
		vendor('Lianpay.Securityfunction');		           
		vendor('Lianpay.Submit'); 	
	 }
	public function split_notify(){
			$notify_info = $GLOBALS['HTTP_RAW_POST_DATA'];
			$file = dirname(__DIR__).'/lianlian.txt';
			file_put_contents($file, $notify_info,FILE_APPEND);
			header("Content-Type: application/json; charset=UTF-8");
			$data=json_decode($notify_info,true);
			if($data['no_order']){
				$this->split_ok($data['no_order']);
			}
				$return['ret_cod']='0000';
				$return['ret_msg']="交易成功";
				$this->ajaxReturn($return,'json');
	}
	public function split_ok($data){
				$llpay_config=C('llpay_config');
				$parameter = array (
					"oid_partner" 	=> trim($llpay_config['oid_partner']),
					"sign_type" 	=> trim($llpay_config['sign_type']),
					"no_order" 		=> $data,
					"api_version" 	=> '1.0'
				);
			$llpay_payment_url = 'https://instantpay.lianlianpay.com/paymentapi/queryPayment.htm';
			$llpaySubmit = new \LLpaySubmit($llpay_config);
			//对参数排序加签名
			$sortPara = $llpaySubmit->buildRequestPara($parameter);
			//传json字符串
			$json =$sortPara;
			$html_text = $llpaySubmit->buildRequestJSON($json,$llpay_payment_url);
			$return=json_decode($html_text,true);
			if($return['ret_code']=='0000'){
			$return_data['status']=1;
			$return_data['return_json']=json_encode($return);
			$return_data['oid_paybill']=$return['oid_paybill'];
			$return_data['update_time']=time();
			M('split_access')->where(array('no_order'=>$data,'status'=>0))->setField($return_data);
			return 1;
			}else{
			$return_data['status']=0;
			$return_data['return_json']=json_encode($return);
			$return_data['update_time']=time();
			M('split_access')->where(array('no_order'=>$data))->setField($return_data);
			return $return['ret_msg'];
			}
			
	
	}
}