<?php
namespace Backstage\Controller;
use Think\Controller;
class SplitController extends PublicController {
	static protected $deny  = array('split_submit','lianpay','split_ok');
	static protected $allow = array('split_notify');
	 protected function _initialize(){
		 parent::_initialize();
		vendor('Lianpay.Rsafunction');
		vendor('Lianpay.Corefunction');         
		vendor('Lianpay.Md5function');  
		vendor('Lianpay.Securityfunction');		           
		vendor('Lianpay.Submit'); 	
	 } 		
    public function index(){
		$map=array();
		$select_status=0;
		$username	= 	I('username');
		$orderid	= 	I('orderid');
		$name		= 	I('name');
		$bankNum	= 	I('bank_num');
		$status=I('status');
		$starttime=I('starttime');
		$endtime=I('endtime');
		if($username&&$username!="不限"){
			$map['username']=array('like','%'.$username.'%');
			$select_status=1;
		}
		if($orderid){
			$map['no_order']=array('like','%'.$orderid.'%');
			$select_status=1;
		}
		if($status){
			$map['status']=array('in',$status);
			$select_status=1;
		}
		if(!is_array($status)){
			$status=str2arr($status);	
		}
		$this->assign('status', $status);
		if($name){
			$map['name']=array('like','%'.$name.'%');
			$select_status=1;
		}
		if($bankNum){
			$map['bank_num']=$bankNum;
			$select_status=1;
		}
		if($starttime){
			if($endtime){
				$start=strtotime($starttime." 00:00:00");
				$end=strtotime($endtime." 23:59:59");
			$map['create_time'] = array(array('egt',$start),array('elt',$end),'and');
			}else{
			$start=strtotime($starttime." 00:00:00");
			$map['create_time']=array('egt',$start);
			}
			$select_status=1;
		}else{
			if($end){
			$end=strtotime($endtime." 23:59:59");
			$map['create_time']=array('elt',$end);
			$select_status=1;
			}
		}
		$select_member=M('admin_user')->field('userid,username')->select();
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		$this->assign('select_status',$select_status);
		$this->assign('select_member', $select_member);
		$list = $this->lists('split_access', $map ,'create_time desc',true ,false);//分页查询订单
		$this->assign('_list',$list );
       $this->display('split');
	}
	public function operate(){
		$type=I('type')?I('type'):$_GET['type'];
		switch($type){
			case 'add' :
				if(IS_POST){
					$this->split_submit();
				}else{
					$this->display('split_add');
				}
			break;
		}
			
	  }
	protected function split_submit(){
			$array=I('post.');
			$array['name'] 	|| $this->error('请输入真实姓名');
			$array['bank_num'] || $this->error('请输入银行卡号');
			$array['money'] || $this->error('请输入转账金额');
			//新增订单
			$split['userid']=is_login();
			$split['username']=get_username();
			$split['no_order']=get_split_chang();
			$split['name']=$array['name'];
			$split['money']=$array['money'];
			$split['bank_num']=$array['bank_num'];
			$split['create_time']=time();
			$split_add=M('split_access')->add($split);
			if($split_add>0){
				$data['no_order']=$split['no_order'];
				$data['dt_order']=time_format(time(),'YmdHis');
				$data['money_order']=$split['money'];
				$data['acct_name']=$split['name'];
				$data['card_no']=$split['bank_num'];
				$data['info_order']='分账订单';
				$data['flag_card']='0';
				$data['notify_url'] = 'http://dev.weibanker.cn/shadow/mast/Llpay/split_notify';
				$data['api_version'] = '1.0';
				$return=$this->lianpay($data);
				if($return['ret_code']=='0000'){
					$split_ok_return=$this->split_ok($data['no_order']);
					if($split_ok_return==1){
					$this->success('转账成功');	
					}else{
						$this->error($split_ok_return);	
					}
					
				}else{
					$this->error($return['ret_msg']);
				}
			
			}else{
				$this->error('网络错误');
			}
	}
	protected function lianpay($data){
				$llpay_config=C('llpay_config');
				$parameter = array (
					"oid_partner" 	=> trim($llpay_config['oid_partner']),
					"sign_type" 	=> trim($llpay_config['sign_type']),
					"no_order" 		=> $data['no_order'],
					"dt_order" 		=> $data['dt_order'],
					"money_order" 	=> $data['money_order'],
					"acct_name" 	=> $data['acct_name'],
					"card_no" 		=> $data['card_no'],
					"info_order" 	=> $data['info_order'],
					"flag_card" 	=> $data['flag_card'],
					"notify_url" 	=> $data['notify_url'],
					//"platform" => $platform,
					"api_version" 	=> $data['api_version']
				);
			$llpay_payment_url = 'https://instantpay.lianlianpay.com/paymentapi/payment.htm';
			$llpaySubmit = new \LLpaySubmit($llpay_config);
			//对参数排序加签名
			$sortPara = $llpaySubmit->buildRequestPara($parameter);
			//传json字符串
			$json = json_encode($sortPara);
			$parameterRequest = array (
			"oid_partner" => trim($llpay_config['oid_partner']),
			"pay_load" => ll_encrypt($json,$llpay_config['LIANLIAN_PUBLICK_KEY']) //请求参数加密	
			);
			$html_text = $llpaySubmit->buildRequestJSON($parameterRequest,$llpay_payment_url);
			return json_decode($html_text,true);
	
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
	protected function split_ok($data){
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