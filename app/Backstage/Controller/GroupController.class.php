<?php
namespace Backstage\Controller;
use Think\Controller;
class GroupController extends PublicController {
	static protected $deny  = array('add','add_ajax');
	static protected $allow = array();
    public function index(){
		$map=array();
		$select_status=0;
		$name=I('name');
		$starttime=I('starttime');
		$endtime=I('endtime');
		if($name){
			$map['name']=array('like','%'.$name.'%');
			$select_status=1;
		}
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
		$this->assign('select_status', $select_status);
		
		$list = $this->lists('group', $map ,'id asc',true ,false);//分页查询订单
		$this->assign('_list', $list);
		//二级导航
		
		$twoMenu=$this->getMenus(CONTROLLER_NAME.'/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);		
		$this->assign('two_title', '门店管理');
		$this->display('group');
	  }
	public function operate(){
		$type=I('type')?I('type'):$_GET['type'];
		switch($type){
			case 'add' :
				if(IS_POST){
					$this->add_ajax();
				}else{
					$this->add();
				}
			break;
		}
			
	 }
	protected function add(){
		$this->display('group_add');
	}
	protected function add_ajax(){
		$data['name']=I('name');
		$data['create_time']=time();
		$add=M('group')->add($data);
		if($add>0){
			$this->success('添加门店成功',U('index'));
		}
		$this->error($data);
	} 
}