<?php
namespace Backstage\Controller;
use Think\Controller;
class UpdatecardController extends Controller {

	public function index(){
		$config = api('Config/lists');
		C($config);
		vendor('Wechat.Wechat');
			$wechatConfig=array(
				'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
				'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
			);
		$model = new \Wechat($wechatConfig);
		$data['offset']=0;
		$data['count']=1;
		$data['status_list']=array('CARD_STATUS_VERIFY_OK');
		$res=$model->getBatch($data);
		if($res['errcode']==0){
			for($i=0;$i<$res['total_num']/10;$i++){
				$data['offset']=$i*10;
				$data['count']=10;
				$data['status_list']=array('CARD_STATUS_VERIFY_OK');
				$res=$model->getBatch($data);
				foreach($res['card_id_list'] as $val){
					$gift=M('gift')->where(array('card_id'=>$val))->find();
					$card=M('card')->where(array('card_id'=>$gift['id']))->find();
					if($card['status']==0){
						M('card')->where(array('card_id'=>$gift['id']))->save(array('status'=>1));
					}
					if(!$card){
						$array=$model->get_card_code(array('card_id'=>$val));
						
						$newcard['card_id']=$array["card"][strtolower($array["card"]["card_type"])]["base_info"]['id'];												
						$newcard['code_type']=get_type_name($array["card"][strtolower($array["card"]["card_type"])]["base_info"]['code_type']);
						$id=M('gift')->add($newcard);
						$card['type']=get_type_name($array["card"]["card_type"]);
						$card['status']=1;
						$card['name']=$array["card"][strtolower($array["card"]["card_type"])]["base_info"]['title'];
						$card['card_id']=$id;
						$card['create_time']=time();
						M('card')->add($card);
					}
				}
			}
		}
		$data['offset']=0;
		$data['count']=1;
		$data['status_list']=array('CARD_STATUS_DELETE');
		$res=$model->getBatch($data);
		if($res['errcode']==0){
			for($i=0;$i<$res['total_num']/10;$i++){
				$data['offset']=$i*10;
				$data['count']=10;
				$data['status_list']=array('CARD_STATUS_DELETE');
				$res=$model->getBatch($data);
				foreach($res['card_id_list'] as $val){
					$gift=M('gift')->where(array('card_id'=>$val))->find();
					M('card')->where(array('card_id'=>$gift['id']))->save(array('status'=>-1));					
				}
			}
		}
	}
}