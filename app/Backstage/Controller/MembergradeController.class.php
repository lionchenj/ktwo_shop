<?php
namespace Backstage\Controller;
use Think\Controller;
class MembergradeController extends PublicController {
		public function index(){
			$map['status']=1;
			$list = $this->lists('level', $map ,'auth_num asc',true ,false);//分页查询订单			
			$this->assign('_list', $list);
			$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
			$this->assign('_Auth', $editAuth);		
			//二级导航
			$twoMenu=$this->getMenus('Member/'.ACTION_NAME,2);
			$this->assign('twoMenu', $twoMenu);
			$this->display('member_grade');
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
			case 'edit' :
				if(IS_POST){
					$this->edit_ajax();
				}else{
					$this->edit();
				}
			break;
			case 'status' :
				$this->status();
				
			break;
			case 'change' :
				$this->change();
				
			break;
		}
			
		 }
		protected function add(){
			$this->display('member_grade_edit');
		}
		protected function add_ajax(){
			$data=I('post.');
			$data['create_time']=time();
			$data['status']=1;
			
			$add=M('level')->add($data);
			if($add){
				$this->success('新建订单成功');
			}
			$this->error('网络错误');
		}
		protected function edit(){
			$id=I('get.id');
			$data=M('level')->where(array('id'=>$id))->find();
			$this->assign('data',$data);
			$this->display('member_grade_edit');
		}
		protected function edit_ajax(){
			$id=I('get.id');
			$data=I('post.');
			$data['update_time']=time();
			$data['status']=1;			
			$add=M('level')->where(array('id'=>$id))->save($data);
			if($add){
				$this->success('保存成功');
			}
			$this->error('网络错误');
		}
		protected function status(){
			$id=I('get.id');
			$data=M('level')->where(array('id'=>$id))->setField('status',-1);
			$this->success('删除成功');
		}
		protected function change(){
			$type=M('level')->where(array('status'=>1))->getField('type');
			if($type){
				$type=0;
			}else{
				$type=1;
			}
			M('level')->where(array('status'=>1))->save(array('type'=>$type));
			$this->success('切换成功');
		}
		
}