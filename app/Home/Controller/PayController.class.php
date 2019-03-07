<?php
namespace Home\Controller;
use Think\Controller;
class PayController extends Controller {
	protected function _initialize(){
		$config = api('Config/lists');
		C($config);
	}	
	public function notify(){
			$notify_info = $GLOBALS['HTTP_RAW_POST_DATA'];
			$file = dirname(__DIR__).'/lianlian.txt';
			file_put_contents($file, $notify_info,FILE_APPEND);
			header("Content-Type: application/json; charset=UTF-8");
			$data=json_decode($notify_info,true);
			if($data['no_order']){
				$res=llquery($data['no_order']);
				if($res){
					$this->order_ok($data);
				}
			}
				$return['ret_code']='0000';
				$return['ret_msg']="交易成功";
				$this->ajaxReturn($return,'json');
	}
	public function notify2(){
			$notify_info = $GLOBALS['HTTP_RAW_POST_DATA'];
			$file = dirname(__DIR__).'/lianlian.txt';
			file_put_contents($file, $notify_info,FILE_APPEND);
			header("Content-Type: application/json; charset=UTF-8");
			$data=json_decode($notify_info,true);
			if($data['no_order']){
				$res=llquery($data['no_order']);
				if($res){
					$this->order_ok2($data);
				}
			}
				$return['ret_code']='0000';
				$return['ret_msg']="交易成功";
				$this->ajaxReturn($return,'json');
	}
	
	public function order_ok($data){
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
			$order_data['status']=2;
			$order_data['update_time']=time();
			$order=M('order')->where($map)->setField($order_data);
			if($order){
			$transaction['id']=get_transaction_id();
			$transaction['userid']=M('order')->where($map)->getField('userid');
			$transaction['type']=2;
			$transaction['orderid']=$map['orderid'];
			$transaction['money']=$save_data['money_order'];
			$transaction['title']='线上订单消费';
			$transaction['create_time']=time();
			M('transaction')->add($transaction);
			//.积分处理	
			$user_integral=M('member')->where(array('userid'=>$transaction['userid']))->getField('integral');
			$add_scr=$transaction['money']*C('MONEY_SCORE');
			M('member')->where(array('userid'=>$transaction['userid']))->setInc('integral',$add_scr);
			$data_score['score']=$add_scr;
			$data_score['surplus']=$add_scr+$user_integral;
			$data_score['type']=1;
			$data_score['userid']=$transaction['userid'];
			$data_score['title']='线上订单消费';
			$data_score['create_time']=time();
			M('score')->add($data_score);
			}
	}
	} 
	public function order_ok2 ($data){
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
			M('offline_order')->where($map)->setField('status',2);
			$transaction['id']=get_transaction_id();
			$transaction['userid']=M('offline_order')->where($map)->getField('userid');
			$transaction['type']=2;
			$transaction['orderid']=$map['orderid'];
			$transaction['money']=$save_data['money_order'];
			$transaction['title']='线下订单消费';
			$transaction['create_time']=time();
			M('transaction')->add($transaction);
		}
		
	}
	public function recharge(){
			$notify_info = $GLOBALS['HTTP_RAW_POST_DATA'];
			$file = dirname(__DIR__).'/lianlian.txt';
			file_put_contents($file, $notify_info,FILE_APPEND);
			header("Content-Type: application/json; charset=UTF-8");
			$data=json_decode($notify_info,true);
			
			if($data['no_order']){
				$res=llquery($data['no_order']);
				if($res){
					$this->recharge_ok($data);
				}
			}
				$return['ret_code']='0000';
				$return['ret_msg']="交易成功";
				$this->ajaxReturn($return,'json');
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
	public function return_url(){
			$notify_info = $GLOBALS['HTTP_RAW_POST_DATA'];
			$file = dirname(__DIR__).'/lianlian.txt';
			file_put_contents($file, $notify_info,FILE_APPEND);
			header("Content-Type: application/json; charset=UTF-8");
			$data=json_decode($notify_info,true);
			if($data['no_order']){
				$res=llquery($data['no_order']);
				if($res){
					$this->order_ok($data);
					$this->redirect('Home/about/index');
				}
			}
	}
}