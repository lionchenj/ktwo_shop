<?php
namespace Home\Controller;
use Think\Controller;
class AboutController extends PublicController {
	public function guserinfo(){
		   $userid = array('access_token'=>$_COOKIE['access_token']);
		   $userInfo = getUserInfoShop($userid);
		   return $userInfo;
	}
	public function index(){
			$userInfo = $this->guserinfo();
			$this->assign('userinfo',$userInfo);
			$this->display('index');
	}
	public function about(){
		$map['userid']=is_login();
		$info=M('member')->where($map)->field('nickname,headimgurl,address_province,address_city,address_area,address_info')->find();
		$this->assign('info',$info);
		$this->display('change-data');
	}
	public function change_name(){
		$map['userid']=is_login();
		$nickname=M('member')->where($map)->getField('nickname');
		$this->assign('nickname',$nickname);
		$this->display('change-name');
	}
	public function change_address(){
		$map['userid']=is_login();
		$info=M('member')->where($map)->field('address_province,address_city,address_area,address_info')->find();
		$this->assign('info',$info);
		$this->display('change-address');
	}
	public function golden(){
			$this->display('my-wallet-golden');
	}

	public function order_confirm(){
		$orderid=I('id');
		$status=I('status');
		$list = M('order')->where("orderid=$orderid")->setField('status',$status);
		M('order')->where("orderid=$orderid")->setField('is_trace',2);
		$this->success($list);
	}
	// public function change(){
	// 	    $map['userid']=is_login();
	// 		$map['type']=array('in','1,4');//充值记录
	// 		$recharge=M('transaction')->where($map)->select();
	// 		$this->assign('recharge',$recharge);
	// 		$this->display('change');
	// }
	// public function consumption(){
	// 		$map['userid']=is_login();
	// 		$map['type']=2;//消费
	// 		$recharge=M('transaction')->where($map)->select();
	// 		$this->assign('recharge',$recharge);
	// 		$this->display('consumption');
	// }
	//public function power(){
			/*预留卡券列表*/
			//$this->display('vip-power');
	//}
	// public function openvipcard(){
	// 		$mobile=get_user_info('mobile');
	// 		$mobile || $this->redirect('Login/index');
	// 		$user_card=M('member')->where(array('userid'=>is_login()))->getField('user_card');
	// 		$this->assign('user_card',$user_card);
	// 		$this->display('open-vipCard');
	// }
	// public function recharge_edit(){
	// 		if(IS_POST){
	// 			$post=I('post.');
	// 			$post['num'] || $this->error('网络错误');
	// 			$post['carid'] || $this->error('网络错误');
	// 			$map['id']=$post['carid'];
	// 			$map['status']=1;
	// 			$money=M('reg_card')->where($map)->getField('money');
				
	// 			if($money<=0){
	// 				$this->error('网络错误');
	// 			}
	// 			$goodsname=$money."元充值卡";
			
	// 			$money=$post['num']*$money;
	// 			$order['orderid']=get_recharge_chang();
	// 			$order['userid']=is_login();
	// 			$order['num']=$post['num'];
	// 			$order['money']=$money;
	// 			$order['goodsid']=$post['carid'];
	// 			$order['create_time']=time();
	// 			$orderid=M('recharge')->add($order);
	// 			if($orderid>0){
	// 				$orderid_list.=$order['orderid'];
	// 			}else{
	// 				$this->error('网络错误');
	// 			}
	// 			unset($order);
	// 			$pay_data['no_order']=get_payid_chang();
	// 			$pay_data['oid_partner']=C('LLPAY_PARTNER')?C('LLPAY_PARTNER'):'201709210000942976';
	// 			$pay_data['money']=$money;
	// 			$pay_data['orderid_list']=$orderid_list;
	// 			$pay_data['create_time']=time();
	// 			$payid=M('pay_llipay')->add($pay_data);
				
	// 			if($payid>0){
	// 				$pay_data['num']=$post['num'];
	// 				$pay_data['goodsname']=$goodsname;
	// 				$return=$this->wxllpay($pay_data);
	// 				if($return){
	// 					$return_data['type']=1;
	// 					$return_data['data']=$return;
	// 					$return_data['payid']=$payid;
	// 					$this->success($return_data);
	// 				}else{
	// 						$this->error($return);
	// 				}
	// 			}else{
	// 				$this->error('网络错误');
	// 			}
	// 		}else{
	// 			$map['id']=I('id');
	// 			$map['status']=1;
	// 			$info=M('reg_card')->where($map)->find();
	// 			$info || $this->_empty();
	// 			$mobile=get_user_info('mobile');
	// 			$this->assign('_info',$info);
	// 			$this->assign('mobile',$mobile);
	// 			$this->assign('carid',$map['id']);
	// 			$this->display('recharge-detail');
	// 		}
	// }
	// public function free_recharge(){
	// 	if(IS_POST){
	// 			$post=I('post.');
	// 			$post['money'] || $this->error('网络错误');
	// 			$goodsname="充值".$post['money']."元";
			
	// 			$money=$post['money'];
	// 			$order['orderid']=get_recharge_chang();
	// 			$order['userid']=is_login();
	// 			$order['money']=$money;
	// 			$order['create_time']=time();
	// 			$order['message']='自由充值';
	// 			$orderid=M('recharge')->add($order);
	// 			if($orderid>0){
	// 				$orderid_list.=$order['orderid'];
	// 			}else{
	// 				$this->error('网络错误');
	// 			}
	// 			unset($order);
	// 			$pay_data['no_order']=get_payid_chang();
	// 			$pay_data['oid_partner']=C('LLPAY_PARTNER')?C('LLPAY_PARTNER'):'201709210000942976';
	// 			$pay_data['money']=$money;
	// 			$pay_data['orderid_list']=$orderid_list;
	// 			$pay_data['create_time']=time();
	// 			$payid=M('pay_llipay')->add($pay_data);
				
	// 			if($payid>0){
	// 				$pay_data['num']=1;
	// 				$pay_data['goodsname']=$goodsname;
	// 				$return=$this->wxllpay($pay_data);
	// 				if($return){
	// 					$return_data['type']=1;
	// 					$return_data['data']=$return;
	// 					$return_data['payid']=$payid;
	// 					$this->success($return_data);
	// 				}else{
	// 				$this->error('网络错误');
	// 				}
	// 			}else{
	// 				$this->error('网络错误');
	// 			}
	// 		}else{
	// 		$card['status']=1;
	// 		$list=M('reg_card')->where($card)->select();
	// 		$this->assign('_list',$list);
	// 		$this->display('my-wallet-recharge');
	// 		}
	// }
	// public function my_money(){
	// 	$this->display('my-wallet-golden');
	// }
	public function order(){
		$this->display('order');
	}
	public function score(){
		$map['userid']=is_login();
		$userInfo = $this->guserinfo();
		//$score=M('member')->where($map)->getField('integral');
		// $score2money=C('SCORE_MONEY')?C('SCORE_MONEY'):1;
		// $score2money=$score2money*$score;
		$this->assign('score',$userInfo['score']);
		//$this->assign('score2money',$score2money);
		$_list=M('score')->where($map)->select();
		//print_r($_list);exit;
		$this->assign('_list',$_list);
		
		$this->display('score');
	}
	public function ajax_order_list(){
		$start=I('start')?I('start'):0;
		$limit=I('limit')?I('limit'):5;
		$status=I('status')?I('status'):0;
		$map['status']=$status;
		$map['userid']=is_login();
		$list=M('order')->where($map)->order("create_time desc")->limit($start,$limit)->select();
		foreach($list as $kk =>$_list){
		$array=str2arr($_list['goodsinfo'],',');
		foreach($array as $key =>$vo){
			$array2=str2arr($vo,'|');
			$goodsid[]=$array2[0];
			$data[$key]['goodsid']=$array2[0];
			$data[$key]['num']=$array2[1];
			$data[$key]['info']=M('goods')->where(array('goodsid'=>$array2[0]))->find();
		}
		$list[$kk]['goods_list']=$data;
		}
		$this->success($list);
	}
	// public function ajax_card_list(){
	// 	$type=I('type')?I('type'):1;
	// 	$start=I('start')?I('start'):0;
	// 	$limit=I('limit')?I('limit'):5;
	// 	$map['userid']=is_login();
	// 	$map['type']=$type;
	// 	$list=M('member_get_card')->where($map)->order('status desc')->limit($start,$limit)->select();
	// 	foreach($list as $key =>$_list){
	// 	if($type==1){
	// 	$card=M('card')->where(array('id'=>$_list['cardid'],'type'=>'代金券'))->find();
	// 	$list[$key]['cardname']=$card['name'];
	// 	$card_id=$card['card_id'];
	// 	$card_info=M('cash')->where(array('id'=>$card_id))->find();
	// 	$list[$key]['reduce']=$card_info['reduce'];
	// 	$list[$key]['least']=$card_info['least'];
	// 	$list[$key]['time']=time_format($card_info['end_time']);
	// 	}
	// 	if($type==2){
	// 	$card=M('card')->where(array('id'=>$_list['cardid'],'type'=>'兑换券'))->find();
	// 	$store=$card['store'];
	// 	if((int)$store>0){
	// 		$store=M('cinema')->where(array('id'=>$store))->getField('name');
	// 	}else{
	// 		$store='全部门店';
	// 	}
	// 	$list[$key]['store']=$store;
	// 	$list[$key]['time']=time_format($card['create_time']+3600*24*30);
	// 	$list[$key]['cardname']=$card['name'];
	// 	}
		
	// }
	// $this->success($list);
	// }
	//查询订单信息
	// public function edit(){
	// 		$orderid=I('orderid');
	// 		$orderid || E();
	// 		if(IS_POST){
	// 			if(substr($orderid, 0, 1 )=='x'){
	// 			$map['orderid']=$orderid;
	// 			$map['status']=2;
	// 			$data = M('offline_order')->where($map)->find();//查询订单
	// 			}else{
	// 			$map['orderid']=$orderid;
	// 			$map['userid']=is_login();
	// 			$map['status']=2;
	// 			$data = M('order')->where($map)->find();//查询订单
	// 			}
	// 			if($data['surplus']<I('num')){
	// 				$this->error('卡券数量不足，请刷新页面后尝试');
	// 			}
	// 			$add['orderid']=$orderid;
	// 			$add['link_sign']=get_link_sign();
	// 			$add['num']=I('num');
	// 			$add['surplus']=I('num');
	// 			$add['goodsid']=$data['goodsid'];
	// 			$add['create_time']=time();
	// 			$add['userid']=is_login();
	// 			$add_submit=M('distribution')->add($add);
	// 			if($add_submit>0){
	// 				if(substr($orderid, 0, 1 )=='x'){
	// 					M('offline_order')->where($map)->setDec('surplus',I('num'));
	// 				if($data['surplus']==I('num')){
	// 					M('offline_order')->where($map)->setField('status',3);
	// 				}
	// 				}else{
	// 				M('order')->where($map)->setDec('surplus',I('num'));
	// 				if($data['surplus']==I('num')){
	// 					M('order')->where($map)->setField('status',3);
	// 				}
	// 				}
	// 				$this->success($add['link_sign']);
	// 			}else{
	// 				$this->error('网络错误');
	// 			}
				
	// 		}else{
	// 			if(substr($orderid, 0, 1 )=='x'){
	// 			$map['orderid']=$orderid;
	// 			$data = M('offline_order')->where($map)->find();//查询订单
	// 			}else{
	// 			$map['orderid']=$orderid;
	// 			$map['userid']=is_login();
	// 			$data = M('order')->where($map)->find();//查询订单
	// 			}
	// 			$this->assign('data', $data);
	// 			$this->display('distri-tickets');
	// 		}
	// }
	// public function receive(){
	// 	if(IS_POST){
	// 		$id=I('code');
	// 		$link_data=M('distribution')->where(array('id'=>$id))->find();
	// 		$thunk=M('user_get_card')->where(array('OuterStr'=>$link_data['link_sign']))->find();
	// 		if($thunk){
	// 			M('distribution')->where($map)->setField('status',-1);
	// 			$this->error('卡券已领取');exit;
	// 		}
	// 		if(!empty($link_data['two_userid'])){
	// 			if($link_data['two_userid']!=is_login()){
	// 				$this->error('卡券已领取');exit;
	// 			}
	// 		}
	// 		$data['two_userid']=is_login();
	// 		$data['status']=I('status')?I('status'):0;
	// 		$data['address']=I('address')?I('address'):'';
	// 		$data['update_time']=time();
	// 		$save=M('distribution')->where(array('id'=>$id,'status'=>array('not in','-1')))->setField($data);
	// 		if($save){
	// 			$this->success();
	// 		}else{
	// 			$this->error('操作失败');
	// 		}
	// 	}else{
	// 	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	// 	$url = "$protocol$_SERVER[HTTP_HOST]";
	// 	$link_sign=I('id');
	// 	$link_sign || E();
	// 	$map['link_sign']=$link_sign;
	// 	$thunk=M('user_get_card')->where(array('OuterStr'=>$link_sign))->find();
	// 	if($thunk){
	// 		M('distribution')->where($map)->setField('status',-1);
	// 	}
	// 	$data = M('distribution')->where($map)->find();//查询订单
	// 	if($data['two_userid']){
	// 		if($data['userid']!=is_login() && $data['two_userid']!=is_login()){
	// 			E('页面不存在');exit;
	// 		}
	// 	}
	// 	if(empty($data['two_userid']) && $data['userid']!=is_login()){
	// 		M('distribution')->where($map)->setField('two_userid',is_login());
	// 	}
	// 	unset($map);
	// 	$map['orderid']=$data['orderid'];
	// 	$map['status']=array('in','2,3');
	// 	if(substr($data['orderid'], 0, 1 )=='x'){
	// 	$order = M('offline_order')->where($map)->find();//查询订单	
	// 	}else{
	// 	$order = M('order')->where($map)->find();//查询订单
	// 	}
	// 	$this->assign('data', $data);
	// 	$this->assign('order', $order);
	// 	vendor('Wechat.Wechat');
	// 	$wechatConfig=array(
	// 	'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wx3707459bb86392f8',
	// 	'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'56301b10a249960f3cee8cd7ed1d7973',
	// 	);
	// 	$model = new \Wechat($wechatConfig);
	// 	$res=$model->getSignPackage();
	// 	$this->assign('getSignPackage',json_encode($res));
	// 	$cardId=M('goods')->where(array('id'=>1))->getField('cardid');
	// 	for($i=0;$i<$data['num'];$i++){
	// 	$addCard[$i]['cardId']=$cardId;
	// 	$sign=$model->getJsSign($cardId,$link_sign);
	// 	$addCard[$i]['cardExt']=json_encode($sign);
	// 	}
	// 	$addCard=json_encode($addCard);
	// 	$this->assign('addCard',$addCard);
	// 	$this->display('distri-result');
	// 	}
	// }
	public function distribution(){
		$orderid=I('orderid');
		$orderid || E();
		$map['orderid']=$orderid;
		$map['userid']=is_login();
		$data = M('distribution')->where($map)->select();//查询订单
		$this->assign('_list', $data);
		$this->assign('orderid', $orderid);
		$this->display('distribution-list');
	}
	public function code_list(){
		$id=I('id');
		$id || E();
		//未实现 查询code列表
		$this->display('last-result');
	}
	public function two_edit(){
			$distributionid=I('id');
			if(empty($distributionid)){
			$distributionid=$_GET['id'];	
			}
			$distributionid || E();
			if(IS_POST){
				$map['id']=$distributionid;
				$map['status']=2;
				$data = M('distribution')->where($map)->find();//查询订单
				if($data['surplus']<I('num')){
					$this->error('卡券数量不足，请刷新页面后尝试');
				}
				$add['orderid']=$data['orderid'];
				$add['link_sign']=get_link_sign2();
				$add['num']=I('num');
				$add['distributionid']=$distributionid;
				$add['goodsid']=$data['goodsid'];
				$add['create_time']=time();
				$add['status']=1;
				$add['userid']=is_login();
				$add_submit=M('distribution_two')->add($add);
				if($add_submit>0){
					M('distribution')->where($map)->setDec('surplus',I('num'));
					$this->success($add['link_sign']);
				}else{
					$this->error('网络错误');
				}
				
			}else{
				$map['id']=$distributionid;
				$map['status']=2;
				$data = M('distribution')->where($map)->find();//查询订单
				$this->assign('data', $data);
				$this->display('distri-tickets2');
			}
	}
	public function two_receive(){
		if(IS_POST){
			$id=I('code');
			$link_data=M('distribution_two')->where(array('id'=>$id))->find();
			$thunk=M('user_get_card')->where(array('OuterStr'=>$link_data['link_sign']))->find();
			if($thunk){
				M('distribution_two')->where($map)->setField('status',-1);
				$this->error('卡券已领取');exit;
			}
			if(!empty($link_data['two_userid'])){
				if($link_data['two_userid']!=is_login()){
					$this->error('卡券已领取');exit;
				}
			}
			$data['two_userid']=is_login();
			$data['status']=I('status')?I('status'):0;
			$data['address']=I('address')?I('address'):'';
			$data['update_time']=time();
			$save=M('distribution_two')->where(array('id'=>$id,'status'=>array('not in','-1')))->setField($data);
			if($save){
				$this->success();
			}else{
				$this->error('操作失败');
			}
		}else{
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = "$protocol$_SERVER[HTTP_HOST]";
		$link_sign=I('id');
		$link_sign || E();
		$map['link_sign']=$link_sign;
		$thunk=M('user_get_card')->where(array('OuterStr'=>$link_sign))->find();
		if($thunk){
			M('distribution_two')->where($map)->setField('status',-1);
		}
		$data = M('distribution_two')->where($map)->find();//查询订单
		if($data['two_userid']){
			if($data['userid']!=is_login() && $data['two_userid']!=is_login()){
				E('页面不存在');exit;
			}
		}
		if(empty($data['two_userid']) && $data['userid']!=is_login()){
			M('distribution_two')->where($map)->setField('two_userid',is_login());
		}
		unset($map);
		$map['orderid']=$data['orderid'];
		$map['status']=array('in','2,3');
		if(substr($data['orderid'], 0, 1 )=='x'){
		$order = M('offline_order')->where($map)->find();//查询订单	
		}else{
		$order = M('order')->where($map)->find();//查询订单
		}
		$this->assign('data', $data);
		$this->assign('order', $order);
		vendor('Wechat.Wechat');
		$wechatConfig=array(
		'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wx3707459bb86392f8',
		'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'56301b10a249960f3cee8cd7ed1d7973',
		);
		$model = new \Wechat($wechatConfig);
		$res=$model->getSignPackage();
		$this->assign('getSignPackage',json_encode($res));
		$cardId=M('goods')->where(array('id'=>1))->getField('cardid');
		for($i=0;$i<$data['num'];$i++){
		$addCard[$i]['cardId']=$cardId;
		$sign=$model->getJsSign($cardId,$link_sign);
		$addCard[$i]['cardExt']=json_encode($sign);
		}
		$addCard=json_encode($addCard);
		$this->assign('addCard',$addCard);
		$this->display('distri-result');
		}
	}
	public function distribution2(){
		$orderid=I('orderid');
		$orderid || E();
		$map['distributionid']=$orderid;
		$map['userid']=is_login();
		$data = M('distribution_two')->where($map)->select();//查询订单
		$this->assign('_list', $data);
		$this->assign('orderid', $orderid);
		$this->display('distribution-list2');
	}
	/*-------------------------- 支付相关----------------------------------------------------*/
	public function wxllpay($array){
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$url = "$protocol$_SERVER[HTTP_HOST]";
			$user_info=session(MODULE_NAME.'_user_openid');
			
			$data['no_order']=$array['no_order'];
			$data['oid_partner']=C('LLPAY_PARTNER')?C('LLPAY_PARTNER'):'201709210000942976';//连连商户号
			$data['biz_partner']='109001';
			$data['money_order']=$array['money'];//计算价钱总和
			//$data['user_id']=$user_info['openid'];//用户id
			$data['pay_type']='12';//微信公众号支付代码
			$data['dt_order']=date('YmdHis',time());
			$data['openid']=$user_info['openid'];//微信用户openid
			$data['appid']=C('WECHAT_APPID')?C('WECHAT_APPID'):'wx3707459bb86392f8';
			$data['notify_url']=$url.__ROOT__.'/home/pay/recharge.html';//异步通知接收地址
			$data['sign_type']='RSA';
			$data['risk_item']='pass';
			$res=wechat_pay($data);
			if($res['ret_code']=='0000'){
				$payLoad=$res['dimension_url'];
				return $payLoad;
			}else{
				return false;
			}
	}
	public function wechat_return(){
			$id=I('payid');
			$data['no_order']=M('pay_llipay')->where(array('id'=>$id))->getField('no_order');
			if($data['no_order']){
				$res=llquery($data['no_order']);
				if($res==1){
					$this->recharge_ok($data);
					$this->success();exit;
				}
				}
				$this->error($data['no_order']);
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
	public function setUserInfo(){
		$data=I('post.');
		$data || $this->error('网络错误');
		if($data['nickname']){
			$save['nickname']=$data['nickname'];
		}
		if($data['headimgurl']){
			$save['headimgurl']=$data['headimgurl'];
		}
		if($data['address_info']){
			$data['area'] || $this->error('请选择省市区');
			$data['address_info'] || $this->error('请填写详细地址');
			$area=str2arr($data['area'],' ');
			$save['address_province']=$area[0];
			$save['address_city']=$area[1];
			$save['address_area']=$area[2];
			$save['address_info']=$data['address_info'];
		}
		if($save){
			$map['userid']=is_login();
			$save['update_time']=time();
			$status=M('member')->where($map)->save($save);
			if($status){
				$this->success();
			}
		}
		 $this->error('网络错误');
	}
	public function collection_list(){
		$userid=is_login();
		$list = M()
            ->table('collection as a')
            ->where("a.userid=".$userid)
            ->join("goods as g on a.goodsid=g.goodsid")
            ->select();
		$this->assign('_list',$list);
		$this->display('my-collect');
	}
	public function del_collection(){
		$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
		$map['id'] =   array('in',$id);
		M('collection')->where($map)->delete();
	}
	public function del_order(){
		$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
		$map['orderid'] =   array('in',$id);
		$map['status'] = 1;
		$map['userid'] = is_login();
		$order=M('order')->where($map)->find();
		$order || $this->error('订单不存在。');
		if($order['integral']>0){
			$user_integral=M('member')->where(array('userid'=>$order['userid']))->getField('integral');
			M('member')->where(array('userid'=>$order['userid']))->setInc('integral',$order['integral']);
			$data_score['score']=$order['integral'];
			$data_score['surplus']=$order['integral']+$user_integral;
			$data_score['type']=1;
			$data_score['userid']=$order['userid'];
			$data_score['title']='线上订单取消退还';
			$data_score['create_time']=time();
			M('score')->add($data_score);	
		}
		$del=M('order')->where(array('orderid'=>$order['orderid']))->setField('status',-1);
		if($del){
			$this->success();
		}else{
		$this->error('网络错误!');	
		}
		
	}
	public function orderEdit(){
		$orderid=I('id');
		$orderid || $this->_empty();
		$order = M('order')->where(array('orderid'=>$orderid,'userid'=>is_login()))->find();
		$array=str2arr($order['goodsinfo'],',');
		foreach($array as $key =>$vo){
			$array2=str2arr($vo,'|');
			$goodsid[]=$array2[0];
			$data[$key]['goodsid']=$array2[0];
			$data[$key]['num']=$array2[1];
			$data[$key]['info']=M('goods')->where(array('goodsid'=>$array2[0]))->find();
		}
		$expressid = $order['expressid'];
		$order['expressname'] = M('express')->where("id=$expressid")->getField('expressname');
		$order['goods_list']=$data;
		//dump($order);
		$this->assign('data',$order);
		$this->display('order-detail');
	}
	public function getyouhui(){
		$id=I('id');
		$id || $this->error('网络错误');
		$map['cardid']=$id;
		$map['userid']=is_login();
		$map['type']=1;
		$map['status']=0;
		$thunk=M('member_get_card')->where($map)->find();
		if(empty($thunk)){
			$add['cardid']=$id;
			$add['userid']=is_login();
			$add['type']=1;
			$add['status']=0;
			$add['create_time']=time();
			$add_id=M('member_get_card')->add($add);
			if($add_id>0){
			$this->success();	
			}
			$this->error('网络错误');
		}else{
		$this->error('无法重复领取');	
		}
	}
	public function collection(){
		$id=I('goodsid');
		$status=I('status');
		$id || $this->error('网络错误');
		$status || $this->error('网络错误');
		if($status==1){
			$add['userid']=is_login();
			$add['goodsid']=$id;
			$add['create_time']=time();
			M('collection')->add($add);		
		}
		if($status==-1){
			$add['userid']=is_login();
			$add['goodsid']=$id;
			$add_id=M('collection')->where($add)->delete();		
		}
		
	}
	public function comment(){
		$goodsid=I('goodsid');
		$orderid=I('orderid');
		$goodsid || $this->error('网络错误');
		$orderid || $this->error('网络错误');
		$this->display('shop-appraise');
		
	}
	public function comment_ajax(){
		$goodsid=I('goodsid');
		$orderid=I('orderid');
		$title=I('title');
		$goodsid || $this->error('网络错误');
		$orderid || $this->error('网络错误');
		$title || $this->error('网络错误');
		$add['title']=$title;
		$add['orderid']=$orderid;
		$add['goodsid']=$goodsid;
		$userInfo = $this->guserinfo();
		$add['headimgurl']=$userInfo['head_imgurl'];
		$add['nickname']=$userInfo['nickname'];
		$add['status']=0;
		$add['create_time']=time();
		$add=M('comment')->add($add);
		if($add){
			M('order')->where(array('orderid'=>$orderid))->setField('status',4);
			$this->success();
		}
		 $this->error('网络错误');
		
	}
	public function get_duihuan(){
		$orderid=I('orderid');
		$goodsid=I('goodsid');
		$orderid || $this->error('网络错误');
		$goodsid || $this->error('网络错误');
		$map['userid']=is_login();
		$map['orderid']=$orderid;
		$map['status']=2;
		$goodsinfo=M('order')->where($map)->getField('goodsinfo');
		$goodsinfo || $this->error('网络错误');
		$check=0;
		$i=0;
		$array=str2arr($goodsinfo,',');
		foreach($array as $key =>$vo){
			$array2=str2arr($vo,'|');
			$arr_goodsid=$array2[0];
			if($arr_goodsid==$goodsid){
				$num=$array2[1];
				$check=1;
			}
			$c_key['userid']=is_login();
			$c_key['goodsid']=$arr_goodsid;
			$c_key['orderid']=$orderid;
			$c_key['type']=2;
			$c_check=M('member_get_card')->where($c_key)->find();
			if(empty($c_check)){
				$i++;
			}
		}
		if($check==0){
			$this->error('网络错误');
		}
		$get_card['userid']=is_login();
		$get_card['goodsid']=$goodsid;
		$get_card['orderid']=$orderid;
		$get_card['type']=2;
		$get_card_check=M('member_get_card')->where($get_card)->find();
		if($get_card_check){
		$this->error('已经领过了，请勿重复领取');
		}
		$get_card['cardid']=M('goods')->where(array('goodsid'=>$goodsid))->getField('duihuan_id');
		$get_card['status']=0;
		$get_card['create_time']=time();
		$get_card['num']=$num;
		$add=M('member_get_card')->add($get_card);
		if($add>0){
			if($i==1){
				M('order')->where($map)->setField('status',3);
			}
			$this->success();
		}
		$this->error('网络错误');
	}
	public function card_edit(){
		$id=I('id');
		$id || $this->error('网络错误');
		$upto=M('user_get_card')->where(array('OuterStr'=>$id))->find();
		if($upto){
		M('member_get_card')->where(array('id'=>$id))->setField('status',1);
		}
		$data=M('member_get_card')->where(array('id'=>$id))->find();
		$type=$data['type'];
		if($type==1){
		$card=M('card')->where(array('id'=>$data['cardid'],'type'=>'代金券'))->find();
		$data['cardname']=$card['name'];
		$card_id=$card['card_id'];
		$card_info=M('cash')->where(array('id'=>$card_id))->find();
		$data['reduce']=$card_info['reduce'];
		$data['least']=$card_info['least'];
		$data['starttime']=time_format($card_info['start_time']);
		$data['endtime']=time_format($card_info['end_time']);
		}
		if($type==2){
		$card=M('card')->where(array('id'=>$data['cardid'],'type'=>'兑换券'))->find();
		$store=$card['store'];
		if((int)$store>0){
			$store=M('cinema')->where(array('id'=>$store))->getField('name');
		}else{
			$store='全部门店';
		}
		$data['store']=$store;
		$data['starttime']=time_format($card['create_time']);
		$data['endtime']=time_format($card['create_time']+3600*24*30);
		$data['cardname']=$card['name'];
		vendor('Wechat.Wechat');
		$wechatConfig=array(
		'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wx3707459bb86392f8',
		'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'56301b10a249960f3cee8cd7ed1d7973',
		);
		$model = new \Wechat($wechatConfig);
		$res=$model->getSignPackage();
		$this->assign('getSignPackage',json_encode($res));
		$cardId=M('gift')->where(array('id'=>$card['card_id']))->getField('card_id');
		for($i=0;$i<$data['num'];$i++){
		$addCard[$i]['cardId']=$cardId;
		$sign=$model->getJsSign($cardId,$id);
		$addCard[$i]['cardExt']=json_encode($sign);
		}
		$addCard=json_encode($addCard);
		$this->assign('addCard',$addCard);
		$this->assign('id',$id);
		}
		$this->assign('data',$data);
		if($type==1){
		$this->display('ticket-detail-1');
		}
		if($type==2){
		$this->display('ticket-detail-2');
		}
		
	}
	public function ajax_get_card(){
		$id=I('id');
		$id || $this->error('网络错误');
		$res=M('user_get_card')->where(array('OuterStr'=>$id))->find();
		if($res){
			M('member_get_card')->where(array('id'=>$id))->setField('status',1);
			$this->error();
		}else{
			$this->success();
		}
		
	}
}