<?php
namespace Backstage\Controller;
use Think\Controller;
class payController extends Controller {
	 protected function _initialize(){
		$config = api('Config/lists');
        C($config); //添加配置;
		
	}
   	/*新版支付宝扫码支付*/
 protected function alipay($data){
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = "$protocol$_SERVER[HTTP_HOST]";
		$array['itemname']=$data['goodsname'];//商品名称
		$array['orderId']=$data['orderid'];//支付宝订单号
		$array['price']=$data['money'];//支付金额
		$array['return']=C('ALIPAY_PAY_RETURN')?C('ALIPAY_PAY_RETURN'):$url."/pay/return_url";
		$array['notify']=C('ALIPAY_PAY_NOTIFY')?C('ALIPAY_PAY_NOTIFY'):$url."/pay/notify";
		$array['partnerId']=2;
		$array['payType']=1;
		ksort($array);
		$str='';
		foreach($array as $key =>$vo){
			$str.=$key."=".$vo."&";
			
		}
		$str=rtrim($str, "&");
		$key=C('ALIPAY_PAY_SIGNKEY')?C('ALIPAY_PAY_SIGNKEY'):'d5b8d516d312e544ea3a774f7159a64b';
		$string=$str.$key;
		$array['sign']=md5($string);
		$data=http_build_query($array);
		$api_url=C('ALIPAY_PAY_API')?C('ALIPAY_PAY_API'):"http://pay.waomi.com/order/gateway";
		$pay_url=$api_url."?".$data;
		header("Location: $pay_url"); 
		
	  }
	 
}