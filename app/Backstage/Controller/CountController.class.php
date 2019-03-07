<?php
namespace Backstage\Controller;
use Think\Controller;
class CountController extends PublicController {
    public function index(){
		/*@1.pv统计
		*/
		$map=array();
		$starttime=I('starttime');
		$endtime=I('endtime');
		$trace = I('trace');
        $goodsid = I('goodsid');
        //dump($goodsid);
		if($starttime){
			if($endtime){
				$start=strtotime($starttime." 00:00:00");
				$end=strtotime($endtime." 23:59:59");
			$map['create_time'] = array(array('egt',$start),array('elt',$end),'and');
			}else{
			$start=strtotime($starttime." 00:00:00");
			$map['create_time']=array('egt',$start);
			}
		}else{
			if($end){
			$end=strtotime($endtime." 23:59:59");
			$map['create_time']=array('elt',$end);
			}
		}
		$pv=M('visit')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%d") as time,count(id) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%d")')->select();
		// $member_list=M('Member')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d") as time,count(userid) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d")')->select();
		
		
		// $member_num=M('Member')->where($map)->count('userid');
		
		// $userid=I('userid');
		// if(empty($userid)){
		// 	$userid=is_login();
		// }
		// $group=M('auth_group_access')->where(array('uid'=>$userid))->getField('group_id');
		// if($group==2){
		// 	$username=M('AdminUser')->where(array('userid'=>$userid))->getField('username');
		// 	$cinema=M('cinema')->where(array('username'=>$username))->getField('id');
		// 	$list=M('AdminUser')->where(array('cinema'=>$cinema))->select();
			
		// 	if($list){
		// 	$list=array_column($list,'userid');
		// 	$list=arr2str($list,',');
		// 	$map['admin_user_id']=array('in',$list);
		// 	$re_map['operator']=array('in',$list);
		// 	}else{
		// 	$map['admin_user_id']=-999;
		// 	$re_map['operator']=-999;
		// 	}
		// if($userid==is_login()){
		// 	$user=M('admin_user')->where(array('userid'=>$map['admin_user_id']))->select();
		// }else{
		// 	$group2=M('auth_group_access')->where(array('uid'=>is_login()))->getField('group_id');
		// 	if($group2==1){
		// 	$user=M('admin_user')->select();
		// 	}
		// }
		// }else if($group!=1){
		// 	$map['admin_user_id']=$userid;
		// 	$re_map['operator']=$userid;
		// 	if($userid!=is_login()){
		// 	$group2=M('auth_group_access')->where(array('uid'=>is_login()))->getField('group_id');
		// 	if($group2==1){
		// 	$user=M('admin_user')->select();
		// 	}elseif($group2==2){
		// 	$username=M('AdminUser')->where(array('userid'=>is_login()))->getField('username');
		// 	$cinema=M('cinema')->where(array('username'=>$username))->getField('id');
		// 	$list=M('AdminUser')->where(array('cinema'=>$cinema))->select();
		// 	if($list){
		// 		$list=array_column($list,'userid');
		// 		$list=arr2str($list,',');
		// 		$user=M('admin_user')->where(array('userid'=>array('in',$list)))->select();
		// 	}
		// 	}
		// 	}
			
		// }else{
		// 	$user=M('admin_user')->select();
			
		// }
		
		$re_map['status']=2;
		if($map['create_time']){
		$re_map['create_time']=$map['create_time'];
		}
		if($trace){
			$map['is_trace'] = $trace;
		}
		if($goodsid){
			$gid = $goodsid."|";
			$map['goodsinfo']=array('like',"%$gid%");
		}
		// $recharge_list=M('recharge')->where($re_map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d") as time,count(orderid) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d")')->select();
		
		// $recharge_num=M('recharge')->where($re_map)->count('orderid');
		// $recharge_sum=M('recharge')->where($re_map)->sum('money');
		$order=M('order')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%d") as time,count(orderid) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%d")')->select();
		// $offline_order=M('offline_order')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%d") as time,count(orderid) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%d")')->select();
		
		for ($i=1;$i<=31;$i++){
			$pv_data[$i]=0;
			$or_data[$i]=0;
		}
		foreach($pv as $key=>$val){
			$pv_data[(int)$val['time']]=$val['num'];
		}
		foreach($order as $key=>$val){
			$or_data[(int)$val['time']]=$val['num'];
		}
		// foreach($offline_order as $key=>$val){
		// 	$or_data[(int)$val['time']]=$or_data[(int)$val['time']]+$val['num'];
		// }
		$data['num']=$pv_data;
		$data['order']=$or_data;
		if(IS_POST){
			$type=I('type');
			switch($type){
				case "char":
				$this->ajaxReturn($data);
				break;			
			}
		}else{
		//下单量列表
		$order_list=M('order')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d") as time,count(orderid) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d")')->select();
		// $offline_order_list=M('offline_order')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d") as time,count(orderid) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d")')->select();
		
		$order_num=M('order')->where($map)->count('orderid');
		// $offline_order_num=M('offline_order')->where($map)->count('orderid');
		// $order_num=$order_num+$offline_order_num;
		$map['status']=array('in','2,3,4');
		$order_true_num=M('order')->where($map)->count('orderid');
		// $offline_order_true_num=M('offline_order')->where($map)->count('orderid');
		
		$order_true_list=M('order')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d") as time,count(orderid) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d")')->select();
		// $offline_order_true_list=M('offline_order')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d") as time,count(orderid) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d")')->select();
		
		$order_true_money=M('order')->where($map)->sum('pay_integral');
		// $offline_order_true_money=M('offline_order')->where($map)->sum('money');
		$order_money_list=M('order')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d") as time,sum(pay_integral) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d")')->select();
		// $offline_order_money_list=M('offline_order')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d") as time,sum(money) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d")')->select();
		// $recharge_money=M('recharge')->where($re_map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d") as time,sum(money) as money')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%m-%d")')->select();
		if(empty($order_true_money)){
			$order_true_money=0;
		}
		if(empty($offline_order_true_money)){
			$offline_order_true_money=0;
		}
		//$order_true_money=$order_true_money+$offline_order_true_money;
		/*$city_order=M('order')->where($map)->field('city,group')->select();
		foreach($city_order as $key =>$vo){
			if(!empty($vo['city'])){
				$arr=str2arr($vo['city']);
				foreach($arr as $k =>$name){
					if(isset($city_data[$name])){
						$city_data[$name]++;
					}else{
						$city_data[$name]=1;
					}
				}
			}
			if(!empty($vo['group'])){
					if(isset($group_data[$vo['group']])){
						$group_data[$vo['group']]++;
					}else{
						$group_data[$vo['group']]=1;
					}
				}
		}
		arsort($city_data);*/
		/*arsort($group_data);*/
		$data=json_encode($data);
		$goods = M('goods')->where(array('status'=>3))->select();
		$this->assign('goods',$goods);
		$this->assign('data', $data);
		$this->assign('user', $user);
		$this->assign('order_list', $order_list);
		$this->assign('offline_order_list', $offline_order_list);
		
		$this->assign('order_true_list', $order_true_list);
		$this->assign('offline_order_true_list', $offline_order_true_list);
		
		$this->assign('offline_order_money_list', $offline_order_money_list);
		$this->assign('order_money_list', $order_money_list);
		$this->assign('member_list', $member_list);
		
		$this->assign('order_num', $order_num);
		$this->assign('member_num', $member_num);
		
		$this->assign('order_true_num', $order_true_num);
		$this->assign('offline_order_true_num', $offline_order_true_num);
		
		$this->assign('order_true_money', $order_true_money);
		$this->assign('recharge_data', $recharge_list);
		$this->assign('recharge_num', $recharge_num);
		$this->assign('recharge_sum', $recharge_sum);
		$this->assign('recharge_money', $recharge_money);
		$this->assign('group_data', $group_data);
		//二级导航
		$twoMenu=$this->getMenus(CONTROLLER_NAME.'/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$this->display('count');
		}
	  }
}