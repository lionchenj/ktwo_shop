<?php
namespace Backstage\Controller;
use Think\Controller;
class StoreController extends PublicController {
    public function index(){
		$map=array();
		$select_status=0;
		$branch_name=I('branch_name');
		$status=I('status');
		$poi_id=I('poi_id');
		$starttime=I('starttime');
		$endtime=I('endtime');
		if($branch_name){
			$map['branch_name']=array('like','%'.$branch_name.'%');
			$select_status=1;
		}
		if($poi_id){
			$map['poi_id']=$poi_id;
			$select_status=1;
		}
		if($status){
			$map['status']=array('in',$status);
			$select_status=1;
		}else{
				$status=array(1,2,3);
				$map['status']=array('in','1,2,3');
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
		
		$list = $this->lists('store', $map ,'id asc',true ,false);//分页查询订单
		$this->assign('_list', $list);
		//分类数据
		$classify = this_tree(1);
		$futures = this_tree(2);
		$shares = this_tree(3);
		$this->assign('classify', $classify);
		$this->assign('futures', $futures);
		$this->assign('shares', $shares);
		$this->display('store');
	  }
	  public function operate(){
		$type=I('type');
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
			$area=$this->get_area();
			$area=json_encode($area);
			$this->assign('area', $area);
			$this->display('store_add');
	}
	protected function add_ajax(){
			$list=S('wechat_get_store');
			$sarea_id=S('wechat_get_sarea_id');
			$map_poi_id=I('map_poi_id');
			foreach($list as $key =>$vo){
				if($vo['sosomap_poi_uid']==$map_poi_id){
					$store=$vo;
				}
			}
			if($store){
				unset($store['pic_urls']);//之后自主添加
				unset($store['card_id_list']);//之后自主添加
				$data=$store;
			}
			$data['sarea_id']=$sarea_id;
			$data['pic_list']=I('pic_list');
			$data['contract_phone']=I('contract_phone');
			$data['hour']=I('hour');
			$data['credential']=I('credential');
			
			$api_data['map_poi_id']=$map_poi_id;
			$pic['list']=str2arr($data['pic_list']);
			$api_data['pic_list']=json_encode($pic);
			$api_data['contract_phone']=$data['contract_phone'];
			$api_data['hour']=$data['hour'];
			$api_data['credential']=$data['credential'];
			$api_data['company_name']='';
			$api_data['card_id']='';
			vendor('Wechat.Wechat');
			$wechatConfig=array(
			'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
			'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
			);
			$model = new \Wechat($wechatConfig);
			$res=$model->addStore($api_data);
			if($res['errcode']==0){
				$data['audit_id']=$res['data']['audit_id'];
				$data['create_time']=time();
				M('store')->add($data);
				$this->success('添加门店成功',U('index'));
			}
			$this->error($data);
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