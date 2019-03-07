<?php
namespace Backstage\Controller;
use Think\Controller;
class IndexController extends PublicController {
    public function index(){
		/*@1.pv统计
		*/
		$today = strtotime(date('Y-m-d')." 00:00:00");
		$today2 = strtotime(date('Y-m-d')." 23:59:59");
		$map['create_time'] = array(array('egt',$today),array('elt',$today2),'and');
		$pv=M('visit')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%H") as time,count(id) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%H")')->select();
		$order=M('order')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(create_time),"%H") as time,count(orderid) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(create_time),"%H")')->select();
		for ($i=0;$i<=24;$i++){
			$pv_data[$i]=0;
			$or_data[$i]=0;
		}
		foreach($pv as $key=>$val){
			$pv_data[(int)$val['time']]=$val['num'];
		}
		foreach($order as $key=>$val){
			$or_data[(int)$val['time']]=$val['num'];
		}
		$pv_data[24]=$pv_data[0];
		$or_data[24]=$or_data[0];
		$vip_data[24]=$vip_data[0];
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
		$recharge_num=M('recharge')->where(array('status'=>2))->count('orderid');
		$order_num=M('order')->where($map)->count('orderid');
		$member_num=M('Member')->where($map)->count('userid');
		$map['status']=array('in','2,3,4,5');
		$order_true_num=M('order')->where($map)->count('orderid');
		$order_true_money=M('order')->where($map)->sum('pay_integral');
		if(empty($order_true_money)){
			$order_true_money=0;
		}
		$data=json_encode($data);
		$this->assign('data', $data);
		$this->assign('order_num', $order_num);
		$this->assign('recharge_num', $recharge_num);
		$this->assign('member_num', $member_num);
		$this->assign('order_true_num', $order_true_num);
		$this->assign('order_true_money', $order_true_money);
		//二级导航
		$twoMenu=$this->getMenus(CONTROLLER_NAME.'/'.ACTION_NAME,2);
		// dump($twoMenu);
		$this->assign('twoMenu', $twoMenu);
		$this->display('index');
		}
	  }
	  
	
}