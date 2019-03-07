<?php
namespace Backstage\Controller;
use Think\Controller;
class ExmemberController extends PublicController {
	static protected $deny  = array('edit','edit_ajax','status');
	static protected $allow = array();
    public function index(){
		
	/*@高级检索资源--start*/
		$map=array();
		$select_status=0;
		$nickname=I('nickname');
		$cinema=I('cinema');
		$is_supplier=is_supplier();
		if($is_supplier){
			$cinema=get_cinema_username();
			$cinema_list_map['id']=$cinema;
		}
		if($nickname){
			$map['nickname']=array('like','%'.$nickname.'%');
			$select_status=1;
		}
		//判断是否塞选电影院
		if($cinema){
			$cinema_map['status']=1;
			$cinema_map['cinema_id']=$cinema;
			$openid_list=M('exchange_user_access')->where($cinema_map)->field('openid')->select();
			$openid_list=array_column($openid_list,'openid');
			$map['openid']=array('in',$openid_list);
			$select_status=1;
		}else{
			$cinema_map['status']=1;
			$openid_list=M('exchange_user_access')->where($cinema_map)->field('openid')->select();
			$openid_list=array_column($openid_list,'openid');
			$map['openid']=array('in',$openid_list);
		}
		$this->assign('select_status', $select_status);
		$cinema_list_map['status']=1;
		$cinema_list=M('cinema')->where($cinema_list_map)->select();
		$this->assign('cinema', $cinema_list);
		//
		/*@高级检索资源--end*/
		$list = $this->lists('Member', $map ,'create_time desc',true ,false);//分页查询订单
		$this->assign('_list', $list);
		
		$twoMenu=$this->getMenus('Exchange/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$this->assign('two_title', '核销人员列表');
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		$this->display('exuser');
	  }
	  
	public function operate(){
		$type=I('type');
		if(empty($type)){
			$type=$_GET['type'];
		}
		switch($type){
			case 'add' :
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
	/**
	 *操作函数无法直接访问
	 * 		edit()，渲染编辑页面
	 *		edit_ajax()，会员修改提交函数
	 *		status(),会员状态修改函数
	 * 		
	 */
	protected function edit(){
			$cinema_map['status']=1;
			$openid_list=M('exchange_user_access')->where($cinema_map)->field('openid')->select();
			$openid_list=array_column($openid_list,'openid');
			$map['status']=1;
			$map['nickname']=array('neq','');
			$map['openid']=array('not in',$openid_list);
			$member=M('Member')->where($map)->field('nickname')->select();
			$is_supplier=is_supplier();
			if($is_supplier){
			$cinema=get_cinema_username();
			$cinema_list_map['id']=$cinema;
			}
			$cinema_list_map['status']=1;
			$cinema_list=M('cinema')->where($cinema_list_map)->select();
			$this->assign('cinema', $cinema_list);
			$this->assign('member', $member);
			$this->display('exuser_add');
	  }
	protected function edit_ajax(){
		$data['cinema_id']=I('cinema');
		$data['openid']=I('member');
		$data['start_time']=time();
		$save=M('exchange_user_access')->add($data);
		if($save){
			$this->success('保存信息成功');
		}
		$this->error('保存信息失败');
	  }
	
	protected function status(){
		$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
		$membet_map['userid'] =   array('in',$id);
		$member=M('Member')->where($membet_map)->field('openid')->select();
		$openid_list=array_column($member,'openid');
		$where['openid']=array('in',$openid_list);
		$where['status']=1;
		$map['status']=I('status')?I('status'):-1;
		$map['end_time']=time();
		$status=M('exchange_user_access')->where($where)->save($map);
		if($status>0){
			$this->success('修改状态成功');
		}
		$this->error('修改状态失败');
	}
}