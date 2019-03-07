<?php
namespace Backstage\Controller;
use Think\Controller;
class ExcountController extends PublicController {
    public function index(){
		$map=array();
		$select_status=0;
		$cinema=I('cinema');
		$exuserId=I('exuser');
		$starttime=I('starttime');
		$endtime=I('endtime');
		//判断是否是供应商用户
		$is_supplier=is_supplier();
		if($is_supplier){
			$cinema=get_cinema_username();
			$cinema_list_map['id']=$cinema;
		}
		if($starttime){
			if($endtime){
				$start=strtotime($starttime." 00:00:00");
				$end=strtotime($endtime." 23:59:59");
			$map['CreateTime'] = array(array('egt',$start),array('elt',$end),'and');
			}else{
			$start=strtotime($starttime." 00:00:00");
			$map['CreateTime']=array('egt',$start);
			}
			$select_status=1;
		}else{
			if($end){
			$end=strtotime($endtime." 23:59:59");
			$map['CreateTime']=array('elt',$end);
			$select_status=1;
			}
		}
		if($cinema){
			$id_list=get_select_quit_cinema($cinema);
			if(!empty($id_list)){
			$map['id']=array('in',$id_list);	
			}
			if($exuserId){
			$map['StaffOpenId']=$exuserId;
			}
			if(I('cinema')){
			$select_status=1;
			}
			
		}
		$cinema_list_map['status']=1;
		$cinema_list=M('cinema')->where($cinema_list_map)->select();
		$this->assign('cinema', $cinema_list);
		foreach($cinema_list as $key =>$vo){
			$id=$vo['id'];
			$openid_list=M('exchange_user_access')->where(array('cinema_id'=>$id))->field('openid')->select();
			foreach($openid_list as $kk =>$dl){
				$nickname=get_member_nickname($dl['openid']);
				if(trim($nickname)){
					$data[$kk]['name']=$nickname;
					$data[$kk]['openid']=$dl['openid'];
				}else{
					unset($data[$kk]);
				}
			}
			if($data){
				$exuser[$id]=$data;
			}
		}
		$exuser_json=json_encode($exuser);
		$this->assign('exuser', $exuser_json);
		$this->assign('select_status', $select_status);
		//核销订单
		$list=M('user_consume_card')->where($map)->field('StaffOpenId,CreateTime')->select();
		//核销量列表
		$consume_list=M('user_consume_card')->where($map)->field('DATE_FORMAT(FROM_UNIXTIME(CreateTime),"%m-%d") as time,count(id) as num')->group(' DATE_FORMAT(FROM_UNIXTIME(CreateTime),"%m-%d")')->select();
		//核销总数
		$consume_num=M('user_consume_card')->where($map)->count('id');
		//核销人员列表
		$consume_user=M('user_consume_card')->where($map)->field('StaffOpenId as user,count(id) as num')->group('StaffOpenId')->select();
		
		//所在影院
		foreach($list as $key =>$_list){
			$cinemaId=get_member_cinemaId($_list['StaffOpenId'],$_list['CreateTime']);
			if($cinemaId>0){
				if(isset($consume_cinema[$cinemaId])){
						$consume_cinema[$cinemaId]++;
					}else{
						$consume_cinema[$cinemaId]=1;
					}
				$groupId=M('cinema')->where(array('id'=>$cinemaId))->getField('group');
				if($groupId>0){
					if(isset($consume_group[$groupId])){
						$consume_group[$groupId]++;
					}else{
						$consume_group[$groupId]=1;
					}
					
				}
				}
		}
		arsort($consume_user);
		arsort($consume_cinema);
		arsort($consume_group);
		$this->assign('consume_list', $consume_list);
		$this->assign('consume_num', $consume_num);
		$this->assign('consume_user', $consume_user);
		$this->assign('consume_cinema', $consume_cinema);
		$this->assign('consume_group', $consume_group);
		
		//二级导航
		$twoMenu=$this->getMenus('Exchange/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$this->display('excount');
	  }
}