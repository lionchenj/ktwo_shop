<?php
namespace Backstage\Controller;
use Think\Controller;
class RegcardController extends PublicController {
		public function index(){
			$twoMenu=$this->getMenus('Payorder/index',2);
			$this->assign('twoMenu', $twoMenu);
			$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
			$this->assign('_Auth', $editAuth);
			$reg_card=M('reg_card')->where(array('status'=>1))->select();
			$this->assign('_list',$reg_card);
			$this->display('payorder');
		}
		public function operate(){
			$type=I('get.type');
			switch($type){				
				case 'add':
					if(IS_POST){
						$this->add_ajax();
					}else{
						$this->add();
					}
				break;	
				case 'edit':
					if(IS_POST){
						$this->edit_ajax();
					}else{
						$this->edit();
					}
				break;				
				case 'status':
					$this->status();
				break;														
			}
		}	
		protected function add(){
			$this->display('payorder_add');
		}
		protected function add_ajax(){
			$data=I('post.');
			$data['status']=1;
			$add=M('reg_card')->add($data);
			if($add){
				$this->success('创建成功');
			}else{
				$this->error('网络错误');
			}
		}
		protected function edit(){
			$id=I('get.id');
			$card=M('reg_card')->where(array('id'=>$id))->find();
			$this->assign('card',$card);
			$this->display('payorder_add');
		}
		protected function edit_ajax(){
			
		}
		 protected function status(){
			$id = I('id');
			$thunk=M('reg_card')->where(array('id'=>$id))->setField('status',-1);
			
			$this->success('修改状态成功',U('operate',array('type'=>'pay')));
			}
}