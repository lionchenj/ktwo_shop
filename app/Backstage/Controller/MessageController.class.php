<?php
namespace Backstage\Controller;
use Think\Controller;
class MessageController extends Controller {
	protected function _initialize(){
		define("TOKEN", "masswise");
	}
    public function index(){
		if (isset($_GET['echostr'])) {
			$this->valid();
		}else if(isset($_GET['setMenu'])){
			$this->setMenu();
			
		}else{
			$this->responseMsg();
		}
			
			
	}
	 public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            header('content-type:text');
            echo $echoStr;
            exit;
        }
    }
	public function responseMsg(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)){
           $file ='wx_messages.txt';
			file_put_contents($file, $postStr,FILE_APPEND);
			header("Content-Type: application/json; charset=UTF-8");
			$Msg = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
				if($Msg['MsgType']=='event'){
					switch ($Msg['Event']){
						case 'user_get_card':
						$this->user_get_card($Msg);
						break;
						case 'card_pass_check':
						//卡券审核通过处理，此项目暂不开发;
						break;
						case 'user_consume_card':
						$this->user_consume_card($Msg);
						break;
						case 'user_gifting_card':
						$this->user_gifting_card($Msg);
						break;
						default:
						echo '0000';
						break;
						
					}
				}
				
			
        }else{
            $file ='wx_messages.txt';
			file_put_contents($file, '有推送事件，但未获取数据',FILE_APPEND);
            exit;
        }
    }
	  private function checkSignature(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
	private function user_get_card($data){
		$theck=M('user_get_card')->where(array('UserCardCode'=>$data['UserCardCode']))->find();
		if(empty($theck)){
			$add['ToUserName']=$data['ToUserName'];
			$add['FromUserName']=$data['FromUserName'];
			$add['CreateTime']=$data['CreateTime'];
			$add['MsgType']=$data['MsgType'];
			$add['Event']=$data['Event'];
			$add['CardId']=$data['CardId'];
			$add['IsGiveByFriend']=$data['IsGiveByFriend'];			
			$add['FriendUserName']=$data['FriendUserName'];
			$add['UserCardCode']=$data['UserCardCode'];
			$add['OuterStr']=$data['OuterStr'];
			M('user_get_card')->add($add);
		}
		
	}
	private function user_gifting_card($data){
		$theck=M('user_gifting_card')->where(array('UserCardCode'=>$data['UserCardCode']))->find();
		if(empty($theck)){
			$add['ToUserName']=$data['ToUserName'];
			$add['FromUserName']=$data['FromUserName'];
			$add['CreateTime']=$data['CreateTime'];
			$add['MsgType']=$data['MsgType'];
			$add['Event']=$data['Event'];
			$add['CardId']=$data['CardId'];
			$add['IsReturnBack']=$data['IsReturnBack'];
			$add['FriendUserName']=$data['FriendUserName'];
			$add['UserCardCode']=$data['UserCardCode'];
			$add['IsChatRoom']=$data['IsChatRoom'];
			M('user_get_card')->where(array('FromUserName'=>$add['FromUserName'],'UserCardCode'=>$data['UserCardCode']))->setField('status',-1);
			M('user_gifting_card')->add($add);
		}
		
	}
	private function user_consume_card($data){
		$theck=M('user_consume_card')->where(array('UserCardCode'=>$data['UserCardCode']))->find();
		if(empty($theck)){
			$add['ToUserName']=$data['ToUserName'];
			$add['FromUserName']=$data['FromUserName'];
			$add['CreateTime']=$data['CreateTime'];
			$add['MsgType']=$data['MsgType'];
			$add['Event']=$data['Event'];
			$add['CardId']=$data['CardId'];
			$add['UserCardCode']=$data['UserCardCode'];
			$add['ConsumeSource']=$data['ConsumeSource'];
			$add['LocationName']=$data['LocationName'];
			$add['StaffOpenId']=$data['StaffOpenId'];
			$add['VerifyCode']=$data['VerifyCode'];
			$add['RemarkAmount']=$data['RemarkAmount'];
			$add['OuterStr']=$data['OuterStr'];
			$add['LocationId']=$data['LocationId'];
			$abc=M('user_consume_card')->add($add);
			$this->ajaxReturn($add,'json');
		}
		
	}
	private function setMenu(){		
		$list=M('wechatmenu')->where(array('pid'=>0))->order('sort')->select();
		$data=array();
		foreach($list as $k=>$v){
			$menu=array();
			$sub_menu=M('wechatmenu')->where(array('pid'=>$v['id']))->order('sort')->select();
			$menu['name']=$v['title'];
			if(!$sub_menu){
				$menu['url']=$v['link'];
				$menu['type']='view';
			}else{
				foreach($sub_menu as $vv){
					$sub=array();
					$sub['type']='view';
					$sub['url']=$vv['link'];
					$sub['name']=$vv['title'];
					$menu['sub_button'][]=$sub;
				}
			}
			$data['button'][]=$menu;
		}
	vendor('Wechat.Wechat');
	$wechatConfig=array(
		'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
		'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
	);
	//echo(json_encode($data));
	$model = new \Wechat($wechatConfig);
	$res=$model->set_menu(json_encode($data,JSON_UNESCAPED_UNICODE));
	$this->ajaxReturn($res,'json');
	}
	
}