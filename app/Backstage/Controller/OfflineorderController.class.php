<?php
namespace Backstage\Controller;
use Think\Controller;
class OfflineorderController extends PublicController {
    public function index(){
		$map=array();
		$user_cinema=M('AdminUser')->where(array('userid'=>is_login()))->getField('cinema');
		if($user_cinema>0){
				$map['admin_user_id']=is_login();
		}
		$group=M('auth_group_access')->where(array('uid'=>is_login()))->getField('group_id');
		if($group==2){
			$username=M('AdminUser')->where(array('userid'=>is_login()))->getField('username');
			$cinema=M('cinema')->where(array('username'=>$username))->getField('id');
			$list=M('AdminUser')->where(array('cinema'=>$cinema))->select();
			if($list){
			$list=array_column($list,'id');
			$map['admin_user_id']=array('in',$list);
			}else{
			$map['admin_user_id']=-999;	
			}
		}
		$select_status=0;
		$goodsid=I('goodsid');
		$orderid=I('orderid');
		$status=I('status');
		$starttime=I('starttime');
		$endtime=I('endtime');
		$money=I('money');
		$userid=I('userid');
		$mobile=I('mobile');
		if($mobile){
			$user=M('member')->where(array('mobile'=>$mobile))->find();
			if($user){
				$map['userid']=$user['userid'];
			}else{
				$map['userid']=0;
			}			
			$this->assign('mobile', $mobile);
		}
		if($goodsid){
			$map['goodsid']=$goodsid;
			$select_status=1;
		}
		
		if($money){
			switch($money){
				case 1:
				$map['money']=array('lt',500);
				$select_status=1;
				 break;
				 case 2:
				$map['money']= array(array('egt',500),array('elt',3000),'and'); ;
				$select_status=1;
				 break;
				 case 3:
				$map['money']=array('gt',3000);
				$select_status=1;
				 break;
			}
		}
		if($status){
			$map['status']=array('in',$status);
			$select_status=1;
		}else{
				$status=array(1,2,3);
				$map['status']=array('in','1,2,3');
		}
		if(!is_array($status)){
			$status=str2arr($status);	
		}
		$this->assign('status', $status);
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
		if($orderid){
			unset($map);
			$map['orderid']=$orderid;
			$select_status=1;
		}
		$this->assign('select_status', $select_status);
		//dump($map);
		$list = $this->lists('offline_order', $map ,'create_time desc',true ,false);//分页查询订单
		$this->assign('_list', $list);
		/*@高级检索资源*/
		$select_goods=M('goods')->field('id,name')->select();
		$this->assign('select_goods', $select_goods);
		$select_member=M('member')->field('userid,nickname')->select();
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		$this->assign('select_member', $select_member);
		//二级导航
		$twoMenu=$this->getMenus('Order/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$this->assign('two_title', '订单列表');
		$Excel_array=M('offline_order')->where($map)->field('orderid')->order('create_time desc')->select();
		$Excel_array=array_column($Excel_array,'orderid');
		$Excel_array=arr2str($Excel_array);
		session('Excel_array',$Excel_array);
		$this->display('offlineorder');
		
	  }
	  
	  public function operate(){
		$type=I('type');
		if(empty($type)){
			$type=$_GET['type'];
		}
		switch($type){
			case 'edit' :
				if(IS_POST){
					$this->edit_ajax();
				}else{
					$this->edit();
				}
			break;
			case 'status':
				$this->status();
			break;	
			case 'upload':
				$this->upload();
			break;
			case 'add':
				if(IS_POST){
					$this->add_ajax();
				}else{
					$this->add();
				}
			break;
			case 'add_ajax':
				$this->add_ajax();
			break;
			case 'ajax_get_balance':
				$this->get_balance();
			break;
			case 'download':
				$this->download();
				break;
		}
			
	  }
	  /*@订单详情
	  *
	  */
	  protected function edit(){
		  
			$orderid=I('id');
			$orderid || $this->_empty();
			$order_info=M('offline_order')->where(array('orderid'=>$orderid))->find();
			$order_info || $this->_empty();
			$this->assign('change',0);
			$this->assign('order_info', $order_info);
			$this->assign('money', $money);
			$this->assign('select_goods', $select_goods);
			$this->display('offlineorder_edit');
			
	  }
	  protected function edit_ajax(){
			  $orderid=I('id');
			  $orderid || $this->_empty();
			  $data['name']=I('name');
			  $data['mobile']=I('mobile');
			  $data['status']=I('status');
			  $data['update_time']=time();
			  $return=M('order')->where(array('orderid'=>$orderid))->setField($data);
			  if($return){
				  $this->success('保存成功');
			  }else{
				  $this->error('保存失败');
			  }
	  }
	   /*@新增订单
	  *
	  */
	  protected function add(){
			$this->display('offlineorder_add');			
	  }
	  protected function add_ajax(){
			$data['money']=I('money');
			$data['money']|| $this->error('请输入订单金额');
			$data['userid']=I('userid');
			$data['userid'] || $this->error('网络错误');
			$s_money=I('s_money')?I('s_money'):0;
			$res=M('member')->where(array('userid'=>$data['userid']))->find();
			$mobile=$res['mobile'];
			$map['mobile']=$mobile;
			$map['status']=1;
			M('MobileCheck')->where($map)->setField('status',2);
					switch(I('pay_type')){
						case '4':
							if($res['balance']<$s_money){
								$this->error('用户余额不足');
							}
							$add['orderid']=get_offline_orderid_chang();
							$add['userid']=$data['userid'];						  
							$add['money']=$data['money'];
							$add['s_money']=$s_money;
							$add['admin_user_id']=is_login();
							$add['status']=2;
							$add['pay_type']=4;
							$add['create_time']=time();
							$return=M('offline_order')->add($add);
							if($return){
								M('member')->where(array('userid'=>$add['userid']))->setDec('balance',$add['s_money']);
								$transaction['id']=get_transaction_id();
								$transaction['userid']=$data['userid'];
								$transaction['type']=2;
								$transaction['orderid']=$add['orderid'];
								$transaction['money']=$add['money'];
								$transaction['title']='线下订单消费';
								$transaction['create_time']=time();
								M('transaction')->add($transaction);
							}
						break;
						case '3':
							$add['orderid']=get_offline_orderid_chang();
							$add['userid']=$data['userid'];						  
							$add['money']=$data['money'];
							$add['s_money']=$s_money;
							$add['admin_user_id']=$data['userid'];
							$add['status']=2;
							$add['pay_type']=3;
							$add['create_time']=time();
							$return=M('offline_order')->add($add);
							if($return){
								$transaction['id']=get_transaction_id();
								$transaction['userid']=is_login();
								$transaction['type']=2;
								$transaction['orderid']=$add['orderid'];
								$transaction['money']=$add['money'];
								$transaction['title']='线下订单消费';
								$transaction['create_time']=time();
								M('transaction')->add($transaction);	
							}
						break;
						case '1':
						$add['orderid']=get_offline_orderid_chang();
						$add['userid']=$data['userid'];						  
						$add['money']=$data['money'];
						$add['s_money']=$s_money;
						$add['admin_user_id']=is_login();
						$add['status']=2;
						$add['pay_type']=1;
						$add['create_time']=time();
						$orderid=M('offline_order')->add($add);
						if($orderid){
						$ll_order['no_order']=get_payid_chang();
						$ll_order['orderid_list']=$add['orderid'];
						$ll_order['oid_partner']=C('LLPAY_PARTNER')?C('LLPAY_PARTNER'):'201709210000942976';
						$ll_order['money']=$add['s_money'];
						$ll_order['create_time']=time();
						M('pay_llipay')->add($ll_order);						
						$res=$this->llpay($ll_order);
						$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
						$url = "$protocol$_SERVER[HTTP_HOST]".__ROOT__;
						$path=$ll_order['no_order']."/";
						$name=$ll_order['no_order'];
						$return=$url.two(false,$res,$path,false,$name);
						}
						break;
					}													
					
					if($return){
						//1.积分处理
						$user_integral=M('member')->where(array('userid'=>$add['userid']))->getField('integral');
						$integral=I('integral');
						if($integral==1){
							if($add['s_money']==0){
								$score=I('score');
								M('member')->where(array('userid'=>$add['userid']))->setDec('integral',$score);
								$data_score['score']=$score;
								$data_score['surplus']=$user_integral-$score;
								$data_score['type']=-1;
								$data_score['userid']=$add['userid'];
								$data_score['title']='线下订单消费';
								$data_score['create_time']=time();
								M('score')->add($data_score);
							}else{
								M('member')->where(array('userid'=>$add['userid']))->setField('integral',0);
								$data_score['score']=$user_integral;
								$data_score['surplus']=0;
								$data_score['type']=-1;
								$data_score['userid']=$add['userid'];
								$data_score['title']='线下订单消费';
								$data_score['create_time']=time();
								M('score')->add($data_score);
							}
						}
							$user_integral=M('member')->where(array('userid'=>$add['userid']))->getField('integral');
							$add_scr=$add['s_money']*C('MONEY_SCORE');
							M('member')->where(array('userid'=>$add['userid']))->setInc('integral',$add_scr);
								$data_score['score']=$add_scr;
								$data_score['surplus']=$add_scr+$user_integral;
								$data_score['type']=1;
								$data_score['userid']=$add['userid'];
								$data_score['title']='线下订单消费';
								$data_score['create_time']=time();
								M('score')->add($data_score);
							
						$this->success($return);
					}else{
					$this->error('新建订单失败');
					}
				}
			
	 protected function get_balance(){
			$mobile=I('mobile');
			if(!$mobile){
				$this->error('请输入手机号码');
			}
			$money=I('money');
			$code=I('captcha');
			$code 	|| 	$this->error('请输入验证码');
			$map['mobile']=I('mobile');
			$map['status']=1;
			$info=M('MobileCheck')->where($map)->field('check_code,create_time')->find();			
			if($info['create_time']+300>=time()){	
			$user=M('member')->where(array('mobile'=>$mobile))->field('userid,user_card,level,userid,balance,integral')->find();
			if(!$user){
				$this->error('帐号不存在');
			}
			$discount_map['id']=$user['level'];
			$discount=M('level')->where($discount_map)->getField('discount');
			$discount || $discount=100;
			$user['dis_user_num']=100-(int)$discount;
			$user['dis_user_money']=$money*$user['dis_user_num']/100;
			$user['SCORE_MONEY']=C('SCORE_MONEY');
			$user['money']=$money*(int)$discount/100;
			$this->success($user);			
		}else{
			$this->error('验证码错误或过期');	
		}
	 }
	/*删除订单*/ 
   protected function status(){
	$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
	$map['orderid'] =   array('in',$id);
	$map['status']=-1;
	$status=M('offline_order')->save($map);
	if($status>0){
		$this->success('删除订单成功');
	}
	$this->error('删除订单失败');
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
			$data['notify_url']=$url.__ROOT__.'/home/pay/notify2.html';//异步通知接收地址
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
	/*导出CSV 导出充值记录
		*/
		protected function download()
		{
		$orderid=session('Excel_array');
		$map['orderid']=array('in',$orderid);
		$list=M('offline_order')->where($map)->field('orderid,userid,money,status,create_time,pay_type,admin_user_id')->order('create_time desc')->select();
		$headArr="订单号,买家手机号码,订单金额,订单状态,创建时间,支付方式,操作人员\n";
		$data=iconv('utf-8','gb2312',$headArr);
		foreach ($list as $k=>$order){
			$order['orderid'] 		= 		iconv('utf-8','gb2312',$order['orderid']);
			$order['userid'] 		= 		iconv('utf-8','gb2312',get_user_mobile($order['userid']));
			$order['money']			= 		iconv('utf-8','gb2312',$order['money']);
			if($order['status']==-1){
			$order['status'] = 		iconv('utf-8','gb2312','无效订单');	
			} 
			if($order['status']==1){
			$order['status'] = 		iconv('utf-8','gb2312','未支付');	
			}
			if($order['status']==2){
			$order['status'] = 		iconv('utf-8','gb2312','已支付');	
			}
			$order['create_time']  	= 		time_format($order['create_time'],'Y-m-d H:i:s');
			if($order['pay_type']==1){
			$order['pay_type'] = 		iconv('utf-8','gb2312','post机');	
			} 
			if($order['pay_type']==3){
			$order['pay_type'] = 		iconv('utf-8','gb2312','现金');	
			}
			if($order['pay_type']==4){
			$order['pay_type'] = 		iconv('utf-8','gb2312','余额');	
			}
			if(empty($order['admin_user_id'])){
			$order['admin_user_id'] = 		iconv('utf-8','gb2312','线上订单');	
			}else{
			$order['admin_user_id'] = 		iconv('utf-8','gb2312',get_nickname($order['admin_user_id']));
			}
			foreach($order as $key=>$vo){
				$array[]=$vo;
			}
			$data.=implode(',',$array)."\n";
			unset($order);
			unset($array);
			}
			$filename ="线下订单数据表".date('Ymd').'.csv';
			header("Content-type:text/csv"); 
			header("Content-Disposition:attachment;filename=".$filename); 
			header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
			header('Expires:0'); 
			header('Pragma:public'); 
			echo $data; 
	}
}