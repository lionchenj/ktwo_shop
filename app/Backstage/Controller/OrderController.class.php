<?php
namespace Backstage\Controller;
use Think\Controller;
class OrderController extends PublicController {
    public function index(){
		$map=array();
		/*$user_cinema=M('AdminUser')->where(array('userid'=>is_login()))->getField('cinema');
		if($user_cinema>0){
				$map['admin_user_id']=is_login();
		}*/
		
		$select_status=0;
		$goodsid=I('goodsid');
		$orderid=I('orderid');
		$status=I('status');
		$starttime=I('starttime');
		$endtime=I('endtime');
		$money=I('money');
		$trace = I('trace');
		$userid=I('userid');
		$expressid = I('expressid');
		if($trace){
			$map['is_trace'] = $trace;
			$this->assign('trace',$trace);
		}
		if($goodsid){
			$map['goodsid']=$goodsid;
			$select_status=1;
		}
		$mobile=I('mobile');
		if($mobile){
			$user=M('score')->where(array('user_mobile'=>$mobile))->find();
			if($user){
				$map['userid']=$user['userid'];
			}else{
				$map['userid']=0;
			}			
			$this->assign('mobile', $mobile);
		}
		if($money){
			switch($money){
				case 1:
				$map['pay_integral']=array('lt',500);
				$select_status=1;
				 break;
				 case 2:
				$map['pay_integral']= array(array('egt',500),array('elt',3000),'and'); ;
				$select_status=1;
				 break;
				 case 3:
				$map['pay_integral']=array('gt',3000);
				$select_status=1;
				 break;
			}
		}
		if($expressid){
			$map['expressid']=$expressid;
		}
		if($status){
			$map['status']=array('in',$status);
			$select_status=1;
		}else{
				$status=array(2,3);
				$map['status']=array('in','2,3,4');
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
		
		$list = $this->lists('order', $map ,'create_time desc',true ,false);//分页查询订单
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
		//dump($list);
		$this->assign('_list', $list);
		/*@高级检索资源*/
		$select_goods=M('goods')->field('id,name')->select();
		$this->assign('select_goods', $select_goods);
		$select_member=M('member')->field('userid,nickname')->select();
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		$this->assign('select_member', $select_member);
		//物流公司
		$express = M('express')->select();
		$this->assign('express',$express);
		//二级导航
		$twoMenu=$this->getMenus(CONTROLLER_NAME.'/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$this->assign('two_title', '订单列表');
		$Excel_array=M('order')->where($map)->field('orderid')->order('create_time desc')->select();
		$Excel_array=array_column($Excel_array,'orderid');
		$Excel_array=arr2str($Excel_array);
		session('Excel_array',$Excel_array);
		$this->display('order');
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
			$order_info=M('order')->where(array('orderid'=>$orderid))->find();
		    $result = explode(',', $order_info['goodsinfo']);
			foreach ($result as $k => $v) {
                  $Arr = explode('|', $v);
                  $re = M('goods')->where("goodsid=$Arr[0]")->find();
                  $arr[$value['orderid']] .= $re['goodsname'].'---'.$Arr[1].'件,';
                  $order_info['goodsname'] = $arr[$value['orderid']];
			  }
			$expressid = $order_info['expressid'];
			$bm = M('express')->where("id=$expressid")->getField('bm');
			$expressname = M('express')->where("id=$expressid")->getField('expressname');
			$order_info['goodsname'] = rtrim($order_info['goodsname'], ",");
			$express = getOrderTracesByJson($order_info['traces_number'],$bm);
			//$express = getOrderTracesByJson('7132521591','JGSD');
			$this->assign('expressname',$expressname);
			$this->assign('express', json_decode($express));
			$order_info || $this->_empty();
			$this->assign('order_info', $order_info);
			$this->assign('money', $money);
			$this->assign('select_goods', $select_goods);
			$this->display('order_edit');
			
	  }
	  protected function edit_ajax(){
			  $orderid=I('orderid');
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
	
	/*删除订单*/ 
   protected function status(){
	$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
	$map['orderid'] =   array('in',$id);
	$map['status']=-1;
	$status=M('Order')->save($map);
	if($status>0){
		$this->success('删除订单成功');
	}
	$this->error('删除订单失败');
}
/*导出CSV 导出充值记录
		*/
		protected function download()
		{
		$orderid=session('Excel_array');
		$map['orderid']=array('in',$orderid);
		$list=M('order')->where($map)->field('orderid,userid,pay_integral,status,is_trace,create_time,pay_type,expressid,traces_number')->order('create_time desc')->select();
		$headArr="订单号,收货手机号码,积分数量,订单状态,物流状态,创建时间,支付方式,物流公司,物流号\n";
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
			if($order['status']==3){
			$order['status'] = 		iconv('utf-8','gb2312','待评价');	
			}
			if($order['status']==4){
			$order['status'] = 		iconv('utf-8','gb2312','已完成');	
			}
			$order['create_time']  	= 		time_format($order['create_time'],'Y-m-d H:i:s');
			if($order['pay_type']==1){
			$order['pay_type'] = 		iconv('utf-8','gb2312','积分支付');	
			}
			$expressid = $order['expressid'];
			$re = M('express')->where("id=$expressid")->getField('expressname');
			$order['expressid'] = iconv('utf-8','gb2312',$re);
			if($order['is_trace']==1){
				$order['is_trace'] = iconv('utf-8','gb2312','未发货');	
			} 
			if($order['is_trace']==2){
				$order['is_trace'] = iconv('utf-8','gb2312','已发货');	
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

	  //   public function trace(){
	  //    	$map=array();
			// /*$user_cinema=M('AdminUser')->where(array('userid'=>is_login()))->getField('cinema');
			// if($user_cinema>0){
			// 		$map['admin_user_id']=is_login();
			// }*/
			
			// $select_status=0;
			// $orderid=I('orderid');
			// $mobile=I('mobile');
			// $express = I('expressid');
			// if($express){
			// 	$re = M('express')->where(array('id'=>$express))->find();
			// 	if($re){
			// 		$map['expressid']=$re['id'];
			// 	}else{
			// 		$map['expressid']=0;
			// 	}	
			// }
			// if($mobile){
			// 	$user=M('score')->where(array('user_mobile'=>$mobile))->find();
			// 	if($user){
			// 		$map['userid']=$user['userid'];
			// 	}else{
			// 		$map['userid']=0;
			// 	}			
			// 	$this->assign('mobile', $mobile);
			// }
			// $map['status']=array('in','2');
			// $this->assign('status', $status);
			// //dump($map);
			// $this->assign('select_status', $select_status);
			// $list = $this->lists('order', $map ,'create_time desc',true ,false);//分页查询订单
			// foreach ($list as $key => $value) {
			// 	$result = explode(',', $value['goodsinfo']);
			// 	foreach ($result as $k => $v) {
	  //                 $Arr = explode('|', $v);
	  //                 $re = M('goods')->where("goodsid=$Arr[0]")->find();
	  //                 $arr[$value['orderid']] .= $re['goodsname'].'---共'.$Arr[1].'件,';
	  //                 $list[$key]['goodsname'] = $arr[$value['orderid']];
			// 	  }
			// 	$list[$key]['goodsname'] = rtrim($list[$key]['goodsname'], ",");
			// 	$id = $list[$key]['expressid'];
			// 	$re = M('express')->where("id=$id")->find();
			// 	$list[$key]['expressid'] = $re['expressname'];
			// }
			// // $a = getOrderTracesByJson('811964898856','SF');
	  // //    	dump($a);
			// $this->assign('_list', $list);
			// //快递公司
			// $express = M('express')->select();
			// $this->assign('express',$express);
			// /*@高级检索资源*/
			// $select_goods=M('goods')->field('id,name')->select();
			// $this->assign('select_goods', $select_goods);
			// $select_member=M('member')->field('userid,nickname')->select();
			// $editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
			// $this->assign('_Auth', $editAuth);
			// $this->assign('select_member', $select_member);
			// //二级导航
			// $twoMenu=$this->getMenus(CONTROLLER_NAME.'/'.ACTION_NAME,2);
			// $this->assign('twoMenu', $twoMenu);
			// $this->assign('two_title', '物流单管理');
			// $Excel_array=M('order')->where($map)->field('orderid')->order('create_time desc')->select();
			// $Excel_array=array_column($Excel_array,'orderid');
			// $Excel_array=arr2str($Excel_array);
			// session('Excel_array',$Excel_array);
	  //    	$this->display('order-trace');
	  //   }

	  //   public function tracelist(){
   //         $id = array_unique((array)I('id',0));
   //         $trace = I('trace',0);
		 //   //$id = is_array($id) ? implode(',',$id) : $id;
		 //   if(!$id[0]){
		 //   	  $data['status'] = 2;
		 //   	  $data['info'] = '请选择订单';
   //            $this->ajaxReturn($data);
		 //   }
		 //   foreach($id as $k=>$v){
		 //   	  if(!$trace[$v]){
		 //   	  	$data['status'] = 2;
			//    	$data['info'] = '请填写物流号';
	  //           $this->ajaxReturn($data);
		 //   	  }else{
		 //   	  	M('order')->where("orderid=$v")->setField('traces_number',$trace[$v]);
		 //   	  	M('order')->where("orderid=$v")->setField('status',3);
		 //   	  }
		 //   }
		 //   $data['status'] = 1;
		 //   $data['info'] = '提交成功！';
		 //   $data['url'] = U('trace');
	  //      $this->ajaxReturn($data);

	  //   }
}