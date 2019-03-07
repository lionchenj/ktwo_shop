<?php
namespace Backstage\Controller;
use Think\Controller;
class ExchangeController extends PublicController {
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
		
		$list = $this->lists('user_consume_card', $map ,'CreateTime desc',true ,false);//分页查询订单
		$this->assign('_list', $list);
		//二级导航
		$twoMenu=$this->getMenus(CONTROLLER_NAME.'/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$this->assign('two_title', '核销列表');
		
		$this->display('exchange');
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
			case 'ajax_get_store' :
				if(IS_POST){
					$this->wechat_get_store();
				}
			break;
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
			$userid=I('id');
			$userid || $this->_empty();
			$user_info=M('Member')->where(array('userid'=>$userid))->find();
			$this->assign('user_info', $user_info);
			$this->display('member_edit');
		}
	
	/*会员状态*/ 
   public function status(){
	$id = I('id');
	$poi_id=M('store')->where(array('id'=>$id))->getField('poi_id');
	if($poi_id){
	$data['poi_id']=$poi_id;
	vendor('Wechat.Wechat');
	$wechatConfig=array(
	'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
	'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
	);
	$model = new \Wechat($wechatConfig);
	$res=$model->delStore($data);
	if($res['errcode']==0){
		$map['id'] = $id;
		$map['status']=-1;
		$status=M('store')->save($map);
		if($status>0){
			$this->success('修改状态成功');
			}
		}
	}
	$this->error('修改状态失败');
}
	 protected function wechat_get_store(){
		$array=I('post.');
		if($array['name'] && $array['keyword']){
		$area_id=M('area')->where(array('name'=>$array['name']))->getField('id');
			if($area_id){
				vendor('Wechat.Wechat');
				$wechatConfig=array(
				'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
				'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
				);
				$model = new \Wechat($wechatConfig);
				$res=$model->getStoreList($area_id,$array['keyword']);
				S('wechat_get_store',$res);
				S('wechat_get_sarea_id',$area_id);
				 $this->success($res);
			}
		}
		$this->success();
	  }
	protected function get_store_list(){
				vendor('Wechat.Wechat');
				$wechatConfig=array(
				'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
				'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
				);
				$model = new \Wechat($wechatConfig);
				$data['offset']=0;
				$data['limit']=10;
				$res=$model->getStorePage($data);
					if($res['errcode']==0){
					$list=$res['business_list'];
					foreach($list as $key => $vo){
						$store_data['pic_list']=arr2str(array_column($vo['base_info']['photo_list'], 'photo_url'));
						$store_data['hour']=$vo['base_info']['open_time'];
						$store_data['branch_name']=$name=$vo['base_info']['business_name'];
						$store_data['address']=$vo['base_info']['address'];
						$store_data['city']=$vo['base_info']['city'];
						$store_data['province']=$vo['base_info']['province'];
						$store_data['longitude']=$vo['base_info']['longitude'];
						$store_data['latitude']=$vo['base_info']['latitude'];
						$store_data['poi_id']=$vo['base_info']['poi_id'];
						$store_data['status']=$vo['base_info']['status'];
						$store_data['district']=$vo['base_info']['district'];
						$store_data['qualification_num']=$vo['base_info']['qualification_num'];
						$store_data['qualification_name']=$vo['base_info']['qualification_name'];
						$store_id=M('store')->where(array('branch_name'=>$name))->getField('id');
						if($store_id){
							M('store')->where(array('branch_name'=>$name))->setField($store_data);
						}else{
							M('store')->add($store_data);
						}
						
					}
				}
	}
	 
}