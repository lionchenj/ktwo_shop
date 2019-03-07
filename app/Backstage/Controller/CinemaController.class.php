<?php
namespace Backstage\Controller;
use Think\Controller;
class CinemaController extends PublicController {
	static protected $deny  = array('add','add_ajax','edit','edit_ajax','status');
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
		$map['status']=1;
		$this->assign('select_status', $select_status);
		
		$list = $this->lists('cinema', $map ,'id asc',true ,false);//分页查询订单
		$this->assign('_list', $list);
		//二级导航
		$twoMenu=$this->getMenus('Group/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		$this->assign('two_title', '电影院管理');
		$this->display('cinema');
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
			/*case 'ajax_get_store' :
				if(IS_POST){
					$this->wechat_get_store();
				}
			break;*/
			case 'del':
				$this->status();
			break;	
		}
			
	  }
	   /*@新增门店
	  *
	  */
	protected function add(){
		  //获取全国地址表
			$group_list=M('group')->select();
			$this->assign('group',$group_list);
			$area=$this->get_area();
			$area=json_encode($area);
			$this->assign('area', $area);
			$this->display('cinema_add');
	}
	protected function add_ajax(){
			$data['name']=I('name');
			$data['group']=I('group');
			$data['province']=I('province');
			$data['city']=I('city');
			$data['area']=I('area');
			$data['keyword']=I('keyword');
			$data['username']=trim(I('username'));
			$thunk=M('admin_user')->where(array('username'=>$data['username']))->getField('userid');
			if($thunk){
				$this->error('登陆账号已存在！请重新输入。');exit;
			}
			$data['create_time']=time();
			
			$add=M('cinema')->add($data);
			if($add>0){
				$user['username']=$data['username'];
				$user['password']=ucenter_md5('88888888');
				$user['nickname']=$data['username'];
				$user['create_time']=time();
				$userid=M('admin_user')->add($user);
				if($userid>0){
					$auth_group['uid']=$userid;
					$auth_group['group_id']=2;
					M('auth_group_access')->add($auth_group);
					$this->success('添加电影院成功',U('index'));
				}else{
					M('cinema')->where(array('id'=>$add))->delete();
					$this->error('网络错误');exit;
				}
				
			}
			$this->error('网络错误');
	}
			
	  /*@详情
	  *
	  */
	  protected function edit(){
			$id=I('id');
			$id || $this->_empty();
			$cinema=M('cinema')->where(array('id'=>$id))->find();
			$this->assign('cinema', $cinema);
			$group_list=M('group')->select();
			$this->assign('group',$group_list);
			$area=$this->get_area();
			$area=json_encode($area);
			$this->assign('area', $area);
			$this->display('cinema_add');
		}
	protected function edit_ajax(){
			$id=I('get.id');
			$id || $this->_empty();
			$data['name']=trim(I('name'));
			M('cinema')->where(array('id'=>$id))->save($data);
			$this->success('添加中医馆院成功',U('index'));
	}
	/*会员状态*/ 
   public function status(){
	$id = I('id');
	$thunk=M('exchange_user_access')->where(array('cinema_id'=>$id))->find();
	if($thunk){
		$this->error('删除失败，请先删除其下所以核销人员！');
	}

		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
		$map['id'] =   array('in',$id);
		$map['status']=I('status')?I('status'):-1;
		$map['update_time']=time();
		$status=M('cinema')->save($map);
		if($status>0){
			$this->success('修改状态成功');
		}
	$this->error('修改状态失败');
	}
}