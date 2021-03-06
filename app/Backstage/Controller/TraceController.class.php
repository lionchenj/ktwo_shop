<?php
namespace Backstage\Controller;
use Think\Controller;
class TraceController extends PublicController {
	  
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
		$list=M('order')->where($map)->field('orderid,userid,pay_integral,status,create_time,pay_type')->order('create_time desc')->select();
		$headArr="订单号,收货手机号码,积分数量,订单状态,创建时间,支付方式\n";
		$data=iconv('utf-8','gb2312',$headArr);
		foreach ($list as $k=>$order){
			$id = $order['userid'];
			$mobile = M('receipt')->where("userid=$id")->getField('mobile');
			$order['orderid'] 		= 		iconv('utf-8','gb2312',$order['orderid']);
			$order['userid'] 		= 		iconv('utf-8','gb2312',$mobile);
			$order['pay_integral']			= 		iconv('utf-8','gb2312',$order['pay_integral']);
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
			$order['pay_type'] = 		iconv('utf-8','gb2312','积分支付');	
			} 
			foreach($order as $key=>$vo){
				$array[]=$vo;
			}
			$data.=implode(',',$array)."\n";
			unset($order);
			unset($array);
			}
			$filename ="线上订单数据表".date('Ymd').'.csv';
			header("Content-type:text/csv"); 
			header("Content-Disposition:attachment;filename=".$filename); 
			header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
			header('Expires:0'); 
			header('Pragma:public'); 
			echo $data; 
	    }

	    public function index(){
	     	$map=array();
			/*$user_cinema=M('AdminUser')->where(array('userid'=>is_login()))->getField('cinema');
			if($user_cinema>0){
					$map['admin_user_id']=is_login();
			}*/
			
			$select_status=0;
			$orderid=I('orderid');
			$mobile=I('mobile');
			$express = I('expressid');
			if($express){
				$re = M('express')->where(array('id'=>$express))->find();
				if($re){
					$map['expressid']=$re['id'];
				}else{
					$map['expressid']=0;
				}	
			}
			if($mobile){
				$user=M('receipt')->where(array('mobile'=>$mobile))->find();
				if($user){
					$map['userid']=$user['userid'];
				}else{
					$map['userid']=0;
				}			
				$this->assign('mobile', $mobile);
			}
			$map['is_trace']=array('in','1');
			$map['status']=array('in','2');
			$this->assign('status', $status);
			//dump($map);
			$this->assign('select_status', $select_status);
			$list = $this->lists('order', $map ,'create_time desc',true ,false);//分页查询订单
			//dump($list);
			foreach ($list as $key => $value) {
				$result = explode(',', $value['goodsinfo']);
				foreach ($result as $k => $v) {
	                  $Arr = explode('|', $v);
	                  $re = M('goods')->where("goodsid=$Arr[0]")->find();
	                  $arr[$value['orderid']] .= $re['goodsname'].'---共'.$Arr[1].'件,';
	                  $list[$key]['goodsname'] = $arr[$value['orderid']];
				  }
				$list[$key]['goodsname'] = rtrim($list[$key]['goodsname'], ",");
				$id = $list[$key]['expressid'];
				$re = M('express')->where("id=$id")->find();
				$list[$key]['expressid'] = $re['expressname'];
			}
			// $a = getOrderTracesByJson('811964898856','SF');
	  //    	dump($a);
			$this->assign('_list', $list);
			//快递公司
			$express = M('express')->select();
			$this->assign('express',$express);
			/*@高级检索资源*/
			$select_goods=M('goods')->field('id,name')->select();
			$this->assign('select_goods', $select_goods);
			$select_member=M('member')->field('userid,nickname')->select();
			$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
			$this->assign('_Auth', $editAuth);
			$this->assign('select_member', $select_member);
			//二级导航
			$twoMenu=$this->getMenus('order/'.ACTION_NAME,2);

			$this->assign('twoMenu', $twoMenu);
			$this->assign('two_title', '物流单管理');
			$Excel_array=M('order')->where($map)->field('orderid')->order('create_time desc')->select();
			$Excel_array=array_column($Excel_array,'orderid');
			$Excel_array=arr2str($Excel_array);
			session('Excel_array',$Excel_array);
	     	$this->display('order-trace');
	    }

	    public function tracelist(){
           $id = array_unique((array)I('id',0));
           $trace = I('trace',0);
		   //$id = is_array($id) ? implode(',',$id) : $id;
		   if(!$id[0]){
		   	  $data['status'] = 2;
		   	  $data['info'] = '请选择订单';
              $this->ajaxReturn($data);
		   }
		   foreach($id as $k=>$v){
		   	  if(!$trace[$v]){
		   	  	$data['status'] = 2;
			   	$data['info'] = '请填写物流号';
	            $this->ajaxReturn($data);
		   	  }else{
		   	  	$save['traces_number'] = $trace[$v];
		   	  	$save['is_trace'] = 2;
		   	  	$save['trace_time'] = time();
		   	  	M('order')->where("orderid=$v")->save($save);
		   	  }
		   }
		   $data['status'] = 1;
		   $data['info'] = '提交成功！';
		   $data['url'] = U('Trace/index');
	       $this->ajaxReturn($data);

	    }
}