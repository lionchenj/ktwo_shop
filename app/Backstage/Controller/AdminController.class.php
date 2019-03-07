<?php
namespace Backstage\Controller;
use Think\Controller;
class AdminController extends PublicController {
	static protected $deny  = array('edit','edit_ajax','status');
	static protected $allow = array();
    public function index(){		
		$this->member_list();		
	}
	
	protected function member_list(){
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		//二级导航
		$twoMenu=$this->getMenus('Auth/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$this->assign('two_title', '订单列表');
	/*@高级检索资源--start*/
	$group_map['module']=MODULE_NAME;
	$group_map['type']=1;
	$group_map['status']=1;
	$group_list=M('auth_group')->where($group_map)->field('id,title')->select();
	$this->assign('group_list', $group_list);
		$map=array();
		$select_status=0;
		$nickname=I('nickname');
		$group=I('group');
		$status=I('status');
		$starttime=I('starttime');
		$endtime=I('endtime');
		if($nickname){
			$map['nickname']=array('like','%'.$nickname.'%');
			$select_status=1;
		}
		if($group){
			$map['userid']=array('in',$this->get_group_access($group));
			$select_status=1;
		}
		if($status){
			$map['status']=array('in',$status);
			$select_status=1;
		}else{
				$status=array(-1,1);
				$map['status']=array('in','1,-1');
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
		$this->assign('select_status', $select_status);
		/*@高级检索资源--end*/
		$list = $this->lists('AdminUser', $map ,'create_time desc',true ,false);//分页查询订单		
		$this->assign('_list', $list);
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		$this->assign('two_title', '管理员列表');
		$this->display('admin');
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
			case 'check_card':
				$this->check();
			break;				
			case 'status':
				$this->status();
			break;	
		}
			
	  }
	/**
	 *操作函数无法直接访问
	 * 		edit()，渲染编辑页面
	 *		edit_ajax()，会员修改提交函数
	 *		status(),会员状态修改函数
	 * 		
	 */
	protected function add(){
	$group_map['module']=MODULE_NAME;
	$group_map['type']=1;
	$group_map['status']=1;
	$group_list=M('auth_group')->where($group_map)->field('id,title')->select();
	$this->assign('group_list', $group_list);
	$cinema=M('cinema')->where(array('status'=>1))->field('id,name')->select();
	$this->assign('cinema', $cinema);	
			$this->display('admin_add');
	}
	protected function edit(){
		$access['uid']=$map['userid']=I('id');
		$user=M('AdminUser')->where($map)->find();
		$user['groupid']=M('auth_group_access')->where($access)->getField('group_id');	
		$this->assign('data',$user);
		$group_map['module']=MODULE_NAME;
		$group_map['type']=1;
		$group_map['status']=1;
		$group_list=M('auth_group')->where($group_map)->field('id,title')->select();
		$this->assign('group_list', $group_list);
	
		$this->display('admin_edit');
	}
	protected function edit_ajax(){
		$userid=I('userid');
		$email=I('email');
		$userid || $this->error('网络错误');
		$email || $this->error('请输入绑定邮箱');
		$map['userid']=$userid;
		$info=M('AdminUser')->where($map)->find();
		if(empty($info)){
			$this->error('网络错误');
		}
			
				$save['userid']=$userid;
				$data['email']=$email;		
				$data['update_time']=time();
				$add=M('AdminUser')->where($save)->save($data);
				if($add){
					$groupid=M('auth_group_access')->where(array('uid'=>$userid))->getField('group_id');	
					if($groupid!=I('group')){
					$access['group_id']=I('group');
					M('auth_group_access')->where(array('uid'=>$userid))->setField($access);	
					}
					$this->success('保存成功');
				}
				$this->error('网络错误');
	}
	protected function check(){		
			$card_num=I('card_num');
			$card=M('member_card')->where(array('card_num'=>$card_num))->find();
			if(!$card){
				$return['status']=0;
				$return['info']='会员卡不存在';
			}elseif($card['status']==0){
				$return['status']=1;				
			}else{
				$return['status']=0;
				$return['info']='会员卡已绑定';
			}
			$this->ajaxReturn($return);
	  }  
	protected function add_ajax(){
		$username=I('username');
		$password=I('password');
		$email=I('email');
		$cinema=I('cinema');
		$username || $this->error('请输入登陆账号');
		$password || $this->error('请输入密码');
		$email || $this->error('请输入绑定邮箱');
		$map['username']=$username;
		$info=M('AdminUser')->where($map)->find();
		if($info){
			$this->error('登陆账号已存在');
		}
			
				$data['username']=$username;
				$data['password']=ucenter_md5($password);
				$data['email']=$email;
				$data['nickname']=$username;
				$data['cinema']=$cinema;
				$data['create_time']=time();
				$add=M('AdminUser')->add($data);
				if($add){
					$access['uid']=$add;
					$access['group_id']=I('group');
					M('auth_group_access')->add($access);
					$this->success('新增管理员成功',U('index'));
				}
				$this->error('网络错误');
	}
	
	protected function status(){
		$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
		$map['userid'] =   array('in',$id);
		$map['status']=I('status')?I('status'):-1;
		$status=M('Member')->save($map);
		if($status>0){
			$this->success('修改状态成功');
		}
		$this->error('修改状态失败');
	}
	protected function get_group_access($group){
		$map['group_id']=$group;
		$return=M('auth_group_access')->where($map)->field('uid')->select();
		$return=array_column($return,'uid');
		return $return;
		
	}
	
}