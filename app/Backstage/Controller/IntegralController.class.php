<?php
namespace Backstage\Controller;
use Think\Controller;
class IntegralController extends PublicController {
		public function index(){
			$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
			$this->assign('_Auth', $editAuth);
			$map=array();
			$select_status=0;						
			$starttime=I('starttime');
			$endtime=I('endtime');
			$mobile=I('mobile');
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
			if($mobile){
				$userid=M('score')->where("user_mobile=$mobile")->getField('userid');
				
				$map['userid']=$userid;
				$select_status=1;
			}
			
			$map['score']=array('gt',0);
			
			$this->assign('select_status', $select_status);			
			$list = $this->lists('score', $map ,'create_time desc',true ,false);//分页查询订单
			foreach ($list as $key => $value) {
				$userid = $value['userid'];
				$list[$key]['mobile'] = M('score')->where("userid=$userid")->getField('user_mobile');
				
			}
			$this->assign('_list', $list);
			$this->assign('score_sum', $score_sum);
			$this->assign('score_count', $score_count);
			$this->display('integral');	
			
		}
public function operate(){
			$type=I('get.type');
			switch($type){				
				case 'download':
				$this->download();
				break;
				
			}
		}	
		/*导出CSV 导出充值记录
		*/
		protected function download()
		{
		$orderid=session('Excel_array');
		$map['orderid']=array('in',$orderid);
		$list=M('recharge')->where($map)->field('orderid,userid,money,create_time,operator')->order('create_time desc')->select();
		$headArr="订单号,充值手机号码,充值金额,创建时间,操作人员\n";
		$data=iconv('utf-8','gb2312',$headArr);
		foreach ($list as $k=>$order){
			$order['orderid'] 		= 		iconv('utf-8','gb2312',$order['orderid']);
			$order['userid'] 		= 		iconv('utf-8','gb2312',get_user_mobile($order['userid']));
			$order['money']			= 		iconv('utf-8','gb2312',$order['money']);
			$order['create_time']  	= 		time_format($order['create_time'],'Y-m-d H:i:s');
			if(empty($order['operator'])){
			$order['operator'] = 		iconv('utf-8','gb2312','线上充值订单');	
			}else{
			$order['operator'] = 		iconv('utf-8','gb2312',get_nickname($order['operator']));
			}
			foreach($order as $key=>$vo){
				$array[]=$vo;
			}
			$data.=implode(',',$array)."\n";
			unset($order);
			unset($array);
			}
			$filename ="充值记录数据表".date('Ymd').'.csv';
			header("Content-type:text/csv"); 
			header("Content-Disposition:attachment;filename=".$filename); 
			header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
			header('Expires:0'); 
			header('Pragma:public'); 
			echo $data; 
	}		
}