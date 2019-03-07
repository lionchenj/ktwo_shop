<?php
namespace Home\Controller;
use Think\Controller;
class AutomaticController extends Controller {
    public function index(){
			$this->order_auto();
	}
	protected function order_auto(){
		$time=time()-1800;
		$map['create_time']=array('lt',$time);
		$map['status']=1;
		$map['integral']=0;
		$save['update_time']=time();
		$save['status']=-1;
		M('order')->where($map)->setField($save);
		$map['integral']=array('gt',0);
		$list=M('order')->where($map)->select();
		foreach ($list as $key =>$vo){
			$user_integral=M('member')->where(array('userid'=>$vo['userid']))->getField('integral');
			M('member')->where(array('userid'=>$vo['userid']))->setInc('integral',$vo['integral']);
			$data_score['score']=$vo['integral'];
			$data_score['surplus']=$vo['integral']+$user_integral;
			$data_score['type']=1;
			$data_score['userid']=$vo['userid'];
			$data_score['title']='线上订单取消退还';
			$data_score['create_time']=time();
			M('score')->add($data_score);
			M('order')->where(array('orderid'=>$vo['orderid']))->setField('status',-1);
		}
		
	}
}