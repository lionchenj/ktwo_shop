<?php
namespace Backstage\Controller;
use Think\Controller;
class AreaController extends PublicController {
	static protected $deny  = array('add','ajax_add','del');
	static protected $allow = array();
    public function index(){
		
	/*@高级检索资源--start*/
		$map=array();
		$select_status=0;
		$province=I('province');
		$city=trim(I('city'));
		if($city){
			$map['city']=array('like','%'.$city.'%');
			
		}
		if($province){
			if($province=="不限"){
					header('Location:'.__ROOT__.'/area.html');
			}
			$map['province']=$province;
			$select_status=1;
		}
		$this->assign('select_status', $select_status);
		/*@高级检索资源--end*/
		$list = $this->lists('city', $map ,'id asc',true ,false);//分页查询订单
		$this->assign('_list', $list);
		//二级导航
		$province=M('area')->where(array('level'=>1))->select();
		$this->assign('province', $province);
		$twoMenu=$this->getMenus('Group/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$this->assign('two_title', '城市列表');
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		$this->display('area');
	  }
	  
	public function operate(){
		$type=I('get.type');
		switch($type){
			case 'add':
				if(IS_POST){
					$this->ajax_add();					
				}else{
					$this->add();
				}

			break;
			case 'del' :
				$this->del();
			break;
		}
			
	  }

	/**
	 *操作函数无法直接访问
	 * 		add()，渲染新增页面
	 * 		del()，渲染新增页面
	 */
	protected function add(){
			$province=M('area')->where(array('level'=>1))->select();
			$this->assign('province', $province);			
			$this->display('area_add');
	}
	protected function ajax_add(){
			$data['province']=trim(I('province'));
			$data['city']=trim(I('city'));
			$id=M('city')->add($data);
			if($id>0){
				$this->success();
			}else{
				$this->error('未知错误,请联系管理员');
			}
	}
	protected function del(){
			$id=I('id');
			$id || $this->_empty();
			if(is_array($id)){
				foreach($id as $value){
					M('city')->where(array('id'=>$value))->delete();				
				}
			}else{
				M('city')->where(array('id'=>$id))->delete();	
			}

			$this->ajaxReturn(array('status'=>1,'url'=>__ROOT__.'/area.html','info'=>'删除成功'));
			
	  }
}