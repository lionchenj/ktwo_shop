<?php
namespace Backstage\Controller;
use Think\Controller;
class CardController extends PublicController {
    public function index(){
		$this->get_card_list();
		$map['status']=array('egt',0);
		$map['type']=array(array('eq','代金券'),array('eq','兑换券'),'or');		
		$list = $this->lists('card', $map ,'id asc',true ,false);//分页查询订单
		$this->assign('_list', $list);
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
//二级导航
		$twoMenu=$this->getMenus(CONTROLLER_NAME.'/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$this->assign('two_title', '卡券列表');
		$this->display('card');
	  }
	public function get_card_list(){
		$data['offset']=0;
		$data['count']=10;
		$data['status_list']=array('CARD_STATUS_VERIFY_OK');
		vendor('Wechat.Wechat');
			$wechatConfig=array(
				'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
				'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
			);
			$model = new \Wechat($wechatConfig);
			$res=$model->getBatch($data);	
		foreach($res['card_id_list'] as $value){
			$map['card_id']=$value;
			$gift=M('gift')->where($map)->find();
			$where['card_id']=$gift['id'];
			$where['status']=0;
			$where['type']='兑换券';
			M('card')->where($where)->setField('status',1);
		}
	}
	public function operate(){
		$type=I('get.type');
		switch($type){
			case 'edit' :
				if(I('get.card_type')=='代金券'){
					if(IS_POST){
						$this->cash_edit_ajax();
					}else{
						$this->cash_edit();
					}
				}elseif(I('get.card_type')=='兑换券'){
					if(IS_POST){
						$this->gift_edit_ajax();
					}else{
						$this->gift_edit();
					}
				}else{
						E();
				}
			break;
			case 'add' :					
					$this->add();
			break;
			case 'get_card' :
				$this->get_card();
			break;
			case 'del':
				$this->status();
			break;	
			case 'select_type':
				$this->select_type();
			break;
			case 'gift_add_ajax':
				$this->gift_add_ajax();
			break;
			case 'cash_add_ajax':
				$this->cash_add_ajax();
			break;
		}
			
	  }	
	protected function gift_add_ajax(){
			$array=I('post.');
			if(trim($array['logo_url'])){
				$data['logo_url']=trim($array['logo_url']);
			}
			
			if(trim($array['code_type'])){
				$data['code_type']=trim($array['code_type']);
			}
			if(trim($array['brand_name'])){
				$data['brand_name']=trim($array['brand_name']);
			}
			if(trim($array['title'])){
				$data['title']=trim($array['title']);
			}
			if(trim($array['color'])){
				$data['color']=trim($array['color']);
			}
			if(trim($array['notice'])){
				$data['notice']=trim($array['notice']);
			}
			if(trim($array['description'])){
				$data['description']=trim($array['description']);
			}
			if(trim($array['date_info']['type'])){
				$data['date_info']['type']=$array['date_info']['type'];
			}
			switch($array['date_info']['type']){
				case 'DATE_TYPE_FIX_TERM':
					$data['date_info']['fixed_term']=intval($array['date_info']['fixed_term']);
					$data['date_info']['fixed_begin_term']=intval($array['date_info']['fixed_begin_term']);
				break;
				case 'DATE_TYPE_FIX_TIME_RANGE':
					$data['date_info']['begin_timestamp']=strtotime($array['date_info']['begin_timestamp']);
					$data['date_info']['end_timestamp']=strtotime($array['date_info']['end_timestamp']);
				break;
			}			
			if(trim($array['sku']['quantity'])){
				$data['sku']['quantity']=intval($array['sku']['quantity']);
			}
			
			if(trim($array['service_phone'])){
				$data['service_phone']=$array['service_phone'];
			}
			if(trim($array['get_limit'])){
				$data['get_limit']=intval($array['get_limit']);
			}else{
				$data['get_limit']=1;
			}
			$data['use_custom_code']=false;
			$data['bind_openid']=false;
			if(trim($array['custom_url_name'])){
				$data['custom_url_name']=trim($array['custom_url_name']);
			}
			if(trim($array['custom_url'])){
				$data['custom_url']=trim($array['custom_url']);
			}
			if(trim($array['custom_url_sub_title'])){
				$data['custom_url_sub_title']=$array['custom_url_sub_title'];
			}
			if($array['icon_url_list']){
				$advance['abstract']['abstract']=$array['abstract'];
				$advance['abstract']['icon_url_list']=$array['icon_url_list'];
			}
			if($array['text_image_list']){				
				foreach($array['text_image_list'] as $key=>$value){
					$advance['text_image_list'][]=$text_img;
				}								
			}
			if($array['business_service']){
				$advance['business_service']=$array['business_service'];
			}
			if($array['can_use_with_other_discount']=='不与其他优惠共享'){
				$advance['use_condition']['can_use_with_other_discount']=false;
			}else if($array['can_use_with_other_discount']=='可与其他优惠共享'){
				$advance['use_condition']['can_use_with_other_discount']=true;
			}
			if($array['least_cost']){
				$advance['use_condition']['least_cost']=(float)($array['least_cost'])*100;
			}
			if($array['object_use_for']){
				$advance['use_condition']['object_use_for']=trim($array['object_use_for']);
			}
			if($array['accept_category']){
				$advance['use_condition']['accept_category']=trim($array['accept_category']);
			}
			if($array['reject_category']){
				$advance['use_condition']['reject_category']=trim($array['reject_category']);
			}
			if(trim($array['time_limit'])=='1'){
				foreach($array['time_limit_type'] as $value){
					$limit['type']=trim($value);						
					$advance['time_limit'][]=$limit;																			
				}
			}else{
				$week=array('MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY','SUNDAY');
				foreach($week as $value){			
						$limit['type']=trim($value);
						$advance['time_limit'][]=$limit;									
				}
			}
			$card['card']['card_type']="GIFT";
			$card['card']['gift']['base_info']=$data;
			if($advance){
				$card['card']['gift']['advanced_info']=$advance;
			}										
			vendor('Wechat.Wechat');
			$wechatConfig=array(
				'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
				'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
			);
			$model = new \Wechat($wechatConfig);

			$res=$model->create_card($card);
			if($res['errcode']==0){
						
				$simple_card['code_type']=get_type_name($array['code_type']);
				$simple_card['card_id']=$res['card_id'];
				$simple_card['img_url']=$array['img_url'];
				$simple_card['brand_url']=$array['brand_url'];
				$simple_card['text_image_list']=trim($_POST['htm']);
				$id=M('gift')->add($simple_card);
				$newcard['store']=$array['store'];
				$newcard['name']=$data['title'];			
				$newcard['card_id']=$id;
				$newcard['create_time']=time();
				$newcard['type']=$array['type'];	
				M('card')->add($newcard);
				$this->success('创建成功');
			}else{
				$this->error($res);
			}
	}
	protected function add(){
		$info=I('post.');
		if($info){
			S('add_session',$info);
		}else{			
			$info=S('add_session');
		}		
		
		if($info['use']==0){
			$info['store']=0;
		}
		$this->assign('data',$info);
		switch ($info['type']){
			case 'GIFT':
				$this->display('gift_edit');
			break;
			case 'CASH':
				$this->display('cash_edit');
			break;
		}
	}
	protected function get_card(){
		$id=I('get.card_id');
		$res['card_id']=M('gift')->where(array('id'=>$id))->getField('card_id');
		$data['action_name']='QR_CARD';
		$data['expire_seconds']='1800';
		$data['action_info']['card']['card_id']=$res['card_id'];
		$data['action_info']['card']['is_unique_code']=false;
		vendor('Wechat.Wechat');
			$wechatConfig=array(
				'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
				'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
			);
		$model = new \Wechat($wechatConfig);
		$res=$model->get_card_qrcode($data);
		if($res['errcode']==0){
			header('Location:'.$res['show_qrcode_url']);
		}else{
			exit;
		}
		
	}
	protected function gift_edit_ajax(){
			$id=I('get.id');
			$card['card_id']=M('card as b')->join('join __GIFT__ as a on a.id=b.card_id')->where(array('b.id'=>$id))->getField('a.card_id');
			$array=I('post.');
			if(trim($array['logo_url'])){
				$data['logo_url']=trim($array['logo_url']);
			}
			if(trim($array['code_type'])){
				$data['code_type']=trim($array['code_type']);
			}
			if(trim($array['color'])){
				$data['color']=trim($array['color']);
			}
			if(trim($array['notice'])){
				$data['notice']=trim($array['notice']);
			}
			if(trim($array['description'])){
				$data['description']=trim($array['description']);
			}
			if(trim($array['date_info']['type'])){
				$data['date_info']['type']=$array['date_info']['type'];
			}
			switch($array['date_info']['type']){
				case 'DATE_TYPE_FIX_TERM':
					$data['date_info']['fixed_term']=intval($array['date_info']['fixed_term']);
					$data['date_info']['fixed_begin_term']=intval($array['date_info']['fixed_begin_term']);
				break;
				case 'DATE_TYPE_FIX_TIME_RANGE':
					$data['date_info']['begin_timestamp']=strtotime($array['date_info']['begin_timestamp']);
					$data['date_info']['end_timestamp']=strtotime($array['date_info']['end_timestamp']." 23:59:59");
				break;
			}			
			if(trim($array['sku']['quantity'])){
				$data['sku']['quantity']=intval($array['sku']['quantity']);
			}
			
			if(trim($array['service_phone'])){
				$data['service_phone']=$array['service_phone'];
			}
			if(trim($array['get_limit'])){
				$data['get_limit']=intval($array['get_limit']);
			}else{
				$data['get_limit']=1;
			}
			$data['bind_openid']=false;
			if(trim($array['custom_url_name'])){
				$data['custom_url_name']=trim($array['custom_url_name']);
			}
			if(trim($array['custom_url'])){
				$data['custom_url']=trim($array['custom_url']);
			}
			if(trim($array['custom_url_sub_title'])){
				$data['custom_url_sub_title']=$array['custom_url_sub_title'];
			}
			if($array['icon_url_list']){
				$advance['abstract']['abstract']=$array['abstract'];
				$advance['abstract']['icon_url_list']=$array['icon_url_list'];
			}
			$text_image_list_id='';
		
			if($array['text_image_list']){				
				foreach($array['text_image_list'] as $key=>$value){		
					$advance['text_image_list'][]=$text_img;
				}					
			}
			if($array['business_service']){
				$advance['business_service']=$array['business_service'];
			}
			if($array['object_use_for']){
				$advance['use_condition']['object_use_for']=trim($array['object_use_for']);
			}
			if($array['accept_category']){
				$advance['use_condition']['accept_category']=trim($array['accept_category']);
			}
			if($array['reject_category']){
				$advance['use_condition']['reject_category']=trim($array['reject_category']);
			}
			if(trim($array['time_limit'])=='1'){
				foreach($array['time_limit_type'] as $value){					
					$limit['type']=trim($value);						
					$advance['time_limit'][]=$limit;																			
				}
			}else{
				$week=array('MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY','SUNDAY');
				foreach($week as $value){			
						$limit['type']=trim($value);
						$advance['time_limit'][]=$limit;									
				}
			}			
			$card['gift']['base_info']=$data;
			if($advance){
				$card['gift']['advanced_info']=$advance;
			}							
			vendor('Wechat.Wechat');
			$wechatConfig=array(
				'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
				'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
			);
			
			$model = new \Wechat($wechatConfig);
			$res=$model->update_card($card);
			if($res['errcode']==0){			
				$simple_card['code_type']=get_type_name($array['code_type']);
				$simple_card['img_url']=$array['img_url'];
				$simple_card['brand_url']=$array['brand_url'];
				$simple_card['text_image_list']=trim($_POST['htm']);
				M('gift')->where(array('id'=>I('get.id')))->save($simple_card);
				$newcard['store']=$array['store'];			
				$newcard['card_id']=$id;
				$newcard['update_time']=time();
				$newcard['type']=$array['type'];	
				M('card')->where(array('card_id'=>I('get.id')))->save($newcard);						
				$this->success('修改成功');
			}else{
				$this->error($res);
			}
	}
	protected function gift_edit(){
		$id=I('id');
		$info=M('card as b')->join('join __GIFT__ as a on a.id=b.card_id')->where(array('b.id'=>$id))->find();
		$data['card_id']=$info['card_id'];
		vendor('Wechat.Wechat');
		$wechatConfig=array(
			'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
			'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
		);
		$model = new \Wechat($wechatConfig);
		$res=$model->get_card_code($data);
		$card=$res['card'][strtolower($res['card']['card_type'])]['base_info'];
		$card['advanced_info']=$res['card'][strtolower($res['card']['card_type'])]['advanced_info'];		
		$card['type']=$res['card']['card_type'];
		//$card['time_limit']=$info['time_limit'];
		$card['img_url']=$info['img_url'];
		$card['brand_url']=$info['brand_url'];
		if(!is_null($card['advanced_info']['use_condition']['can_use_with_other_discount'])){
				$card['can_use_with_other_discount']=$card['advanced_info']['use_condition']['can_use_with_other_discount']?2:1;
		}
		$time_limit='';			
		foreach($card["advanced_info"]["time_limit"] as $key=>$value){
			$time_limit.=get_week_id($value['type']).',';
		}
		
		$time_limit=array_unique(explode(',',substr($time_limit,0,strlen($time_limit)-1)));	
		$card['time_limit_week']=$time_limit;	
		$card['time_limit_week_str']=implode(',',$time_limit);		
		if(trim($info['text_image_list'])){
			$this->assign('html',$info['text_image_list']);
		}
		$this->assign('info',$card);		
		$array['type']=$card['type'];
		$array['store']=$info['store'];
		$this->assign('data',$array);
		$this->display('gift_edit');				
	}
	protected function cash_add_ajax(){
		$data['reduce']=I('reduce');
		$data['brand_name']=I('brand_name');
		$data['img_url']=I('img_url');		
		$data['color']=I('color');
		$data['num']=I('num');		
		$data['end_time']=strtotime(I('end_time'))+86399;
		$data['start_time']=strtotime(I('start_time'));			
		$data['can_use_with_other_discount']=I('can_use_with_other_discount');
		$data['least']=I('least');
		$data['description']=I('description');
		$id=M('cash')->add($data);
		$newcard['store']=I('store');
		$newcard['name']=I('title');
		$newcard['create_time']=time();
		$newcard['status']=1;
		$newcard['name']=I('title');	
		$newcard['card_id']=$id; 
		$newcard['type']=I('type');
		M('card')->add($newcard);
		$this->success();
	}	
	protected function cash_edit(){
		
		$id=I('id');
		$info=M('cash as a')->join('__CARD__ as b on a.id=b.card_id')->where(array('b.id'=>$id))->find();
		$this->assign('data',array('type'=>'CASH','store'=>$info['store']));
		$this->assign('info',$info);
		$this->display('cash_edit');
	}
	protected function cash_edit_ajax(){
		$id=I('get.id');
		$card_id=M('card')->where(array('id'=>$id))->getField('card_id');			
		$data['reduce']=I('reduce');
		$data['brand_name']=I('brand_name');
		$data['img_url']=I('img_url');		
		$data['color']=I('color');
		$data['num']=I('num');		
		$data['end_time']=strtotime(I('end_time'))+86399;
		$data['start_time']=strtotime(I('start_time'));				
		$data['can_use_with_other_discount']=I('can_use_with_other_discount');
		$data['least']=I('least');
		$data['description']=I('description');
		M('cash')->where(array('id'=>$card_id))->save($data);
		$array['name']=I('title');
		$array['store']=I('store');
		$array['update_time']=time();
		$array['status']=1;
		$array['type']=I('type');
		M('card')->where(array('id'=>$id))->save($array);
		$this->success();
	}
	protected function status(){
		$id=I('get.id');
		M('card')->where(array('card_id'=>$id))->save(array('status'=>'-1'));
		$this->ajaxReturn(array('status'=>1,'info'=>'删除成功','url'=>__ROOT__.'/card.html'));
	}	
	protected function select_type(){
		$member=M('admin_user')->where(array('status'=>1,'userid'=>array('neq','1')))->select();
		$this->assign('info',$member);
		$group=M('group')->where(array('status'=>1))->select();
		$this->assign('group',$group);
		$this->assign('IS_LOGIN',is_login());
		$this->display('select_card');
	}
	/*public function upload(){
		if(!empty($_FILES)){
			$return  = array('status' => 1, 'info' => '上传成功', 'data' => '');

			$Picture = D('Picture');
			$pic_driver = C('PICTURE_UPLOAD_DRIVER');
			
			$info=$Picture->upload(
				$_FILES,
				C('EXCEL_UPLOAD'),
				C('PICTURE_UPLOAD_DRIVER'),
				C("UPLOAD_{$pic_driver}_CONFIG")
			); //TODO:上传到远程服务器
			//dump($info);exit;
			if($info){
				$return['status'] = 1;
				$return = array_merge($info['imageFile'], $return);
			} else {
				$return['status'] = 0;
				$return['info']   = $Picture->getError();
				$this->ajaxReturn($return);
			}
			$return['path']=DOC_ROOT.$return['path'];
			$array=import_excel($return['path']);
			foreach($array as $key=>$value){
				$res=M('code')->where(array('code'=>$value))->find();
				if(!$res){
					$data['code']=$value;
					M('code')->add($data);
				}
			}
			$this->ajaxReturn($return);
		}else{
			$this->error('没有上传文件');
		}
	}*/
}