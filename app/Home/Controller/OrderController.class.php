<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends PublicController {
	// protected function _initialize(){
	// 	parent::_initialize();
	// }
	
    public function index(){
			$this->display('shop-index');
	}
	public function addCard(){
		$goodsid=I('id');
		$goodsid || $this->error('网络错误');
		$map['goodsid']=$goodsid;
		$map['userid']=is_login();
		$thunk=M('cart')->where($map)->find();
		$limit=M('goods')->where(array('goodsid'=>$goodsid))->getField('limit');
		$num=$this->get_order_goods_num($map['userid'],$map['goodsid']);
		if($thunk){
			if($limit>0){
				if($limit<$thunk['num']+$num+1){
					$this->error('此商品已达购买上限');
				}
			}
			$save=M('cart')->where($map)->setInc('num');
			if($save){
				$this->success();
			}
		}else{
			if($limit>0){
				if($limit<$num+1){
					$this->error('此商品已达购买上限');
				}
			}
			$map['create_time']=time();
			$add=M('cart')->add($map);
			if($add>0){
				$this->success();
			}
		}
		$this->error();
	}

	public function trace(){
		$orderid = I('id');
		$order_info = M('order')->where("orderid=$orderid")->find();
		$expressid = $order_info['expressid'];
	    $bm = M('express')->where("id=$expressid")->getField('bm');
	    $expressname = M('express')->where("id=$expressid")->getField('expressname');
	    $express = getOrderTracesByJson($order_info['traces_number'],$bm);
	    //$express = getOrderTracesByJson('7132521591','JGSD');
	    $this->assign('order',$order_info);
	    $this->assign('express', json_decode($express));
		$this->display('express-info');
	}
	public function card(){
		$userid=is_login();
		$list = M()
            ->table('cart as a')
            ->where("a.userid=".$userid." and g.status=3")
            ->join("goods as g on a.goodsid=g.goodsid")
			->field('a.cartid,a.goodsid,a.create_time,a.num,g.goodsname,g.img_url,g.money,g.integral_pay')
			->order("a.create_time desc")
            ->select();
		$this->assign('_list',$list);
		$this->display('shop-car');
		
	}
	public function del_card(){
		$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
		$map['cartid'] =   array('in',$id);
		M('cart')->where($map)->delete();
	}
	public function addOrder(){
		$id=I('id');
		if(empty($id)){
			$id=session(MODULE_NAME.'_addOrder_id');
		}
		// $reduce=I('reduce');
		// $cardid=I('cardid');
		$id || $this->_empty();
		session(MODULE_NAME.'_addOrder_id', $id);
		$array=str2arr($id,',');
		$money=0;
		$integral=0;
		foreach($array as $key =>$vo){
			$array2=str2arr($vo,'|');
			$data[$key]['goodsid']=$array2[0];
			$data[$key]['num']=$array2[1];
			$data[$key]['info']=M('goods')->where(array('goodsid'=>$array2[0]))->find();	
			$integral=$integral+$data[$key]['num']*$data[$key]['info']['integral_pay'];
			$money=$money+$data[$key]['num']*$data[$key]['info']['money'];
		}
        $express = M('express')->select();
        //dump($express);
		//dump(C('SCORE_MONEY'));
		// $get_balance=$this->get_balance($money);
		$this->assign('express',$express);
		$this->assign('integral',$integral);
		$this->assign('money',$money);
		$this->assign('data',$data);
		$receipt=M('receipt')->where(array('userid'=>is_login()))->find();
		$this->assign('receipt',$receipt);
		$this->assign('reduce',$reduce);
		$this->display('shop-order');
	}
	// protected function get_balance($money){
	
	// 		$user=M('member')->where(array('userid'=>is_login()))->field('userid,user_card,level,userid,balance,integral')->find();
	// 		$discount_map['id']=$user['level'];
	// 		$discount=M('level')->where($discount_map)->getField('discount');
	// 		$discount || $discount=100;
	// 		$user['dis_user_num']=100-(int)$discount;
	// 		$user['dis_user_money']=$money*$user['dis_user_num']/100;
	// 		$user['SCORE_MONEY']=C('SCORE_MONEY');
	// 		$user['money']=$money*(int)$discount/100;
	// 		return 	$user;	
		
	//  }
	 public function setReceipt(){
		$receipt=M('receipt')->where(array('userid'=>is_login()))->find();
		$this->assign('receipt',$receipt);
		$this->display('shop-editAddress');
	 }

	 public function sReceipt(){
		$receipt=M('receipt')->where(array('userid'=>is_login()))->find();
		$this->assign('receipt',$receipt);
		$this->display('shop-editAddr');
	 }
	 public function setYouhui(){
		$money=I('id');
		$map['a.type']=1;
		$map['a.userid']=is_login();
		$map['a.status']=0;
		$map['g.least']=array('elt',$money);
		$list = M()
            ->table('member_get_card as a')
            ->where($map)
            ->join("cash as g on a.cardid=g.id")
			->field('a.cardid,g.least,g.reduce')
			->order("a.create_time desc")
            ->select();
		$this->assign('list',$list);	
		$this->display('choose-tickets');
	 }
	 public function receipt(){
		$data=I('post.');
		$receipt=M('receipt')->where(array('userid'=>is_login()))->find();
		if($receipt){
			$data['update_time']=time();
			$save=M('receipt')->where(array('userid'=>is_login()))->setField($data);
			if($save){
				$this->success();
			}
		}else{
		$data['create_time']=time();
		$data['userid']=is_login();
		$add=M('receipt')->add($data);
			if($add >0){
				$this->success();
			}		
		}
		$this->error();
	 }
	 public function add(){
		$id=session(MODULE_NAME.'_addOrder_id');
		$id || $this->error('网络错误');
		$array=str2arr($id,',');
		$money=0;
		$integral=0;
		foreach($array as $key =>$vo){
			$array2=str2arr($vo,'|');
			$goodsid[]=$array2[0];
			$data[$key]['goodsid']=$array2[0];
			$data[$key]['num']=$array2[1];
			$data[$key]['info']=M('goods')->where(array('goodsid'=>$array2[0]))->find();	
			if($data[$key]['info']['status']!=3){
				$this->error("下单失败。".$data[$key]['info']['goodsname'].'已售罄');exit;
			}
			//限购判断
			// if($data[$key]['info']['limit']!=0){
			// 	$thunk_num=$this->get_order_goods_num(is_login(),$array2[0]);
			// 	if($data[$key]['info']['limit']<$thunk_num+$data[$key]['num']){
			// 	$this->error("下单失败。".$data[$key]['info']['goodsname'].'已达购买上限');exit;	
			// 	}
			// }
			
			$money=$money+$data[$key]['num']*$data[$key]['info']['money'];
			$integral=$integral+$data[$key]['num']*$data[$key]['info']['integral_pay'];
		}
		unset($data);
		$data['goodsinfo']=$id;
		//$data['money'] = $money;
		$data['userid']=is_login();
		//$uable_money = get_user_info('integral');
		//dump($uable_money);
		// if($uable_money<$money){
		// 	$this->error("下单失败,积分余额不足");exit;
		// }
		// $get_balance=$this->get_balance($money);
		// $data['user_del_money']=$get_balance['dis_user_money'];
		// $pay_money=$money-$get_balance['dis_user_money'];
		 // //1.确认优惠券
		 // $cradid=I('cardid');
		 // if($cradid){
			//  $crad_user_map['userid']=is_login();
			//  $crad_user_map['status']=0;
			//  $crad_user_map['cardid']=$cradid;
			//  $crad_user_map['type']=1; 
			//  $crad_user=M('member_get_card')->where($crad_user_map)->find();
			//  if($crad_user){
			// 	 //优惠金额
			// 	 $data['cardid']=$cradid;
			// 	 $data['youhui_del_money']=M('cash')->where(array('id'=>$cradid))->getField('reduce');
			// 	 $pay_money=$pay_money-$data['youhui_del_money'];
			//  }else{
			// 	$this->error("下单失败。优惠券不可用。");exit; 
				 
			//  }
		 // }
		 //2.确认是否使用积分
		  // $integral=I('integral');
		  // dump( $integral);
		  // if($integral==1){
				// $data['integral']=$get_balance['integral'];
				// $data['youhui_del_money']=$get_balance['integral']*$get_balance['SCORE_MONEY'];
				// if($pay_money>=$data['youhui_del_money']){
				// 	$pay_money=$pay_money-$data['youhui_del_money'];
				// }else{
				// 	$data['youhui_del_money']=$pay_money;
				// 	$data['integral']=$pay_money/$get_balance['SCORE_MONEY'];
				// 	$pay_money=0;
				// }
		  // }
		  $data['pay_integral']=$integral;
		  //3.获取收件人信息
		  $receipt=M('receipt')->where(array('userid'=>is_login()))->find();
		  if(!$receipt){
		  	 $this->error("付款失败。请填写收货信息");
		  }
		  $data['name']=$receipt['name'];
		  $data['mobile']=$receipt['mobile'];
		  $data['address']=$receipt['address'];
		  $data['orderid']=get_orderid_chang();
		  $data['expressid'] = $_POST['expid'];
		  $data['status']=1;
		  $data['is_trace'] = 1;
		  $data['create_time']=time();
		  $add=M('order')->add($data);
		  if($add>0){
			  $del_cart['goodsid']=array('in',$goodsid);
			  $del_cart['userid']=is_login();
			  M('cart')->where($del_cart)->delete();
			 //  if($cradid){
				// $crad_user_map['userid']=is_login();
				// $crad_user_map['status']=0;
				// $crad_user_map['cardid']=$cradid;
				// $crad_user_map['type']=1; 
				// M('member_get_card')->where($crad_user_map)->setField('status',-1);  
			 //  }
			 //  if($integral==1){
				// M('member')->where(array('userid'=>is_login()))->setDec('integral',$data['integral']);
				// $data_score['score']=$data['integral'];
				// $data_score['surplus']=M('member')->where(array('userid'=>is_login()))->getField('integral');;
				// $data_score['type']=-1;
				// $data_score['userid']=is_login();
				// $data_score['title']='线上订单消费';
				// $data_score['create_time']=time();
				// M('score')->add($data_score);
			 //  }
			  $this->success($data['orderid']);
		  }
		  $this->error($add);
		 
		 
	 }
	 public function payType(){
		$orderid=I('id');
		$orderid || $this->_empty();
		$order=M('order')->where(array('orderid'=>$orderid,'status'=>1))->getField('pay_integral');
		$order || $this->redirect('About/order');
		//$userid=is_login();
		$userid = array('access_token'=>$_COOKIE['access_token']);
		$userInfo = getUserInfoShop($userid);
		$this->assign('money',$order);
		$this->assign('balance',$userInfo['score']);
		$this->assign('orderid',$orderid);
		$this->display('choose-pay');
	 }
	 public function order_pay(){
			$orderid=I('orderid');
			$orderid || $this->error('网络错误');
			$pay_type=I('pay_type')?I('pay_type'):1;
			$money=M('order')->where(array('orderid'=>$orderid))->find();
			$userid = array('access_token'=>$_COOKIE['access_token']);
		    $userInfo = getUserInfoShop($userid);
			
			//判断库存是否足够
			$array=str2arr($money['goodsinfo'],',');
			foreach ($array as $key => $value) {
				$arr1=str2arr($value,'|');
				$goodsid = $arr1[0];
				$goods = M('goods')->where("goodsid=$goodsid")->find();
				if($arr1[1]>$goods['inventory']){
					$this->error($goods['goodsname'].'库存不足');
				}
			}
			//接入积分支付接口
            $buyshop = array(
				'access_token'=>$_COOKIE['access_token'],
				'orderid'=>$orderid,
				'score'=>$money['pay_integral'],
			);
			$result = buyScoreShop($buyshop);
			if($result->errmsg !='SUCCESS'){
				$this->error($result->errmsg);
			}
			//支付成功之后减掉库存
			foreach ($array as $key => $value) {
				$arr2=str2arr($value,'|');
				$goodsid = $arr2[0];
				$goods = M('goods')->where("goodsid=$goodsid")->setDec('inventory',$arr2[1]);
			}

			//更改订单支付状况
			$map['orderid']=array('in',$orderid);
			$order_data['status']=2;
			//$order_data['pay_type']=2;
			$order_data['update_time']=time();
			$order=M('order')->where($map)->setField($order_data);
			
			//订单消费详情
			$transaction['id']=get_transaction_id();
			$transaction['userid']=is_login();
			$transaction['type']=2;
			$transaction['orderid']=$orderid;
			$transaction['money']=$money['pay_integral'];
			$transaction['title']='线上订单消费';
			$transaction['create_time']=time();
			M('transaction')->add($transaction);

            //使用积分详情
			$data_score['score']=$money['pay_integral'];
			$data_score['surplus']=$userInfo['score']-$money['pay_integral'];
			$data_score['type']=1;
			$data_score['userid']=$transaction['userid'];
			$data_score['title']='线上订单消费';
			$data_score['create_time']=time();
			$data_score['user_mobile'] = $userInfo['mobile'];
			M('score')->add($data_score);
			$this->success();
		// }
	 }
	 
	//  public function wxllpay($array){
	// 		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	// 		$url = "$protocol$_SERVER[HTTP_HOST]";
	// 		$user_info=session(MODULE_NAME.'_user_openid');
			
	// 		$data['no_order']=$array['no_order'];
	// 		$data['oid_partner']=C('LLPAY_PARTNER')?C('LLPAY_PARTNER'):'201709210000942976';//连连商户号
	// 		$data['biz_partner']='109001';
	// 		$data['money_order']=$array['money'];//计算价钱总和
	// 		//$data['user_id']=$user_info['openid'];//用户id
	// 		$data['pay_type']='12';//微信公众号支付代码
	// 		$data['dt_order']=date('YmdHis',time());
	// 		$data['openid']=$user_info['openid'];//微信用户openid
	// 		$data['appid']=C('WECHAT_APPID')?C('WECHAT_APPID'):'wx3707459bb86392f8';
	// 		$data['notify_url']=$url.__ROOT__.'/home/pay/notify.html';//异步通知接收地址
	// 		$data['sign_type']='RSA';
	// 		$data['risk_item']='pass';
	// 		$res=wechat_pay($data);
	// 		if($res['ret_code']=='0000'){
	// 			$payLoad=$res['dimension_url'];
	// 			return $payLoad;
	// 		}else{
	// 			return false;
	// 		}
	// }
	// public function wechat_return(){
	// 		$id=I('payid');
	// 		$data['no_order']=M('pay_llipay')->where(array('id'=>$id))->getField('no_order');
	// 		if($data['no_order']){
	// 			$res=llquery($data['no_order']);
	// 			if($res){
	// 				$this->order_ok($data);
	// 				$this->success();exit;
	// 			}
	// 			}
	// 			$this->error($data['no_order']);
	// }
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
	protected function get_order_goods_num($userid,$goodsid){
			$num=0;
			$M = new \Think\Model();
			$list =$M->query("SELECT goodsinfo FROM `order` WHERE `status`>=2 AND userid=".$userid." AND (goodsinfo LIKE '".$goodsid."|%' OR goodsinfo LIKE '%,".$goodsid."|%')");
			foreach ($list as $key =>$val){
				$info=$val['goodsinfo'];
				$array=str2arr($info,',');
				foreach($array as $key =>$vo){
					$array2=str2arr($vo,'|');
					$info_goodsid=$array2[0];
					if($info_goodsid==$goodsid){
						$num=$num+$array2[1];
					}
				}
			}
			return $num;
	}
}