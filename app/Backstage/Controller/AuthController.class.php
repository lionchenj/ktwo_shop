<?php
namespace Backstage\Controller;
use Think\Controller;
class AuthController extends PublicController {
	static protected $deny  = array();
	static protected $allow = array('updateinfo');
	public function index(){
		$twoMenu=$this->getMenus('Auth/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		$map['status']=1;
		$map['type']=1;
		$map['module']='Backstage';
		$list = $this->lists('auth_group', $map ,'id asc',true ,false);//分页查询订单
		$this->assign('_list', $list);
		$this->display('auth_list');
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
			case 'add' :
				if(IS_POST){
					$this->add_ajax();
				}else{
					$this->add();
				}
			break;
			case 'role' :
				if(IS_POST){
					$this->role_ajax();
				}else{
					$this->role();
				}
			break;
			case 'auth' :
				if(IS_POST){
					$this->auth_ajax();
				}else{
					$this->auth();
				}
			break;
			case 'status':
				$this->status();
			break;	
		}			
	} 
	protected function add(){
		$this->display('auth_add');
	}
	protected function add_ajax(){
		$data=I('post.');
		$data['title']||$this->error('角色名不能为空');
		$data['description']||$this->error('角色说明不能为空');
		$data['status']=1;
		$data['type']=1;
		$data['module']='Backstage';
		$add=M('auth_group')->add($data);
		if($add){
			$this->success('创建成功');
		}else{
			$this->error('创建失败');
		}
	}
	protected function edit(){
		$id=I('id');
		$auth=M('auth_group')->where(array('id'=>$id))->find();
		$this->assign('auth',$auth);
		$this->display('auth_add');
	}
	protected function edit_ajax(){
		$data=I('post.');
		$id=I('get.id');
		$data['title']||$this->error('角色名不能为空');
		$data['description']||$this->error('角色说明不能为空');
		$data['status']=1;
		$data['type']=1;
		$data['module']='Backstage';
		$data['update_time']=time();
		$add=M('auth_group')->where(array('id'=>$id))->save($data);
		if($add){
			$this->success('创建成功');
		}else{
			$this->error('创建失败');
		}
	}
	protected function role(){
		$this->display('auth_add');
	}
	protected function role_ajax(){
		
	}
	protected function auth(){
$array=M('auth_group')->where(array('id'=>I('id')))->getField('rules');
$array=str2arr($array);
$this->assign('array',$array);	
		$this->display('auth_access');
	}
	protected function auth_ajax(){
		$group_id=$_GET['id'];
		$list=I('list');
		$list=array_unique($list); 
		$list||$this->error('必须拥有1个权限');
		$group_id||$this->error('网络错误');
		sort($list);
		$data['rules']=arr2str($list);
		$data['update_time']=time();
		$array=M('auth_group')->where(array('id'=>$group_id))->setField($data);
		if($array){
			$this->success('保存成功');
		}
		$this->error('网络错误');
		
	}
	protected function status(){
		$group_id=$_GET['id'];
		$list=M('auth_group_access')->where(array('group_id'=>$group_id))->select();
		if($list){
			$this->error('请将该角色组成员移动到其他角色组后，再次操作！');
		}
		M('auth_group')->where(array('id'=>$group_id))->delete();
		$this->success('操作成功');
		
	}
}