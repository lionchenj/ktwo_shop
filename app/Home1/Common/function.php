<?php
function get_user_auth($field='uid'){
    $user = session(MODULE_NAME.'_user_auth');
    if (empty($user)) {
        return 0;
    } else {
        return session(MODULE_NAME.'user_auth_sign') == data_auth_sign($user) ? $user[$field] : '';
    }
}
function get_user_info($field='userid'){
    $user = M('member')->where(array('userid'=>is_login()))->find();
    if (empty($user)) {
        return 0;
    } else {
        return $user[$field];
    }
}
function set_user_auth($data){
    $uid=get_user_auth();
	return M('member')->where(array('userid'=>$uid))->setField($data);
}
function get_rand_string($length){
				$chars = '0123456789'; 
				$return =''; 
				for ( $i = 0; $i < $length; $i++ ) 
				{ 
					$return .= $chars[ mt_rand(0, strlen($chars) - 1) ]; 
				} 
					return $return;

}
function Rsasign($data) {
	$priKey='-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDQKDq3m8wuTQPFn6XMoW87WrDpTF216odMCxcNqv2Jyexe72Us
W+HH0BDIKLuyEjgSflMOMzahrcamwUNpEldTKkmqSIOZ2ZWrEbiv4ofBLj00q97C
RsKKwKZmWlUQ6xJ6LrQhoXqVeoK9dHqQ+KHZ4xHz7BHLnrGubA/N4vuplQIDAQAB
AoGBAIPAQtH+ObFAq9eFIgMwVuAhmgJAhLvlEvfNuSy8greY6BR6v/XgvjqjdkvK
hGrEX1tNO7KsNbMF88uOXeV+Z2gmpQ0MHLBztXogqTKNaRe4Md5hovNzCDoU3zIu
RZgwWCY+/FLBO3Jy4n4tQZ1Jelf4Z0KuFMIgNcwUyeh124YNAkEA82JbfB2QNMsu
puNha7hzLjJParqLmJ5DcbjGFhpogPKtAsdzoU5pO3cR8uLEcLCTwlz1LDnGHBzS
sAHoKwEYCwJBANryaxy9pRILo7kGLWMkthZACnpTFFYAmbQSPCybI+gZ2TYanzds
vCBnidxaMqZ4EBqgbMwnPNTkKQqWMYGSKN8CQF4jbClcsfuJn3jTuEnXJU34DbnF
f9s/U+z3wD6qZkOCGiNaDEKXNqLWkm21ArBnzC9Aj2BU1GjpSSDlC+0eVjMCQQCs
OOnWZrqUskErxlcnWHY+lEtpozYo3DoLMhjRQYuCA+sfKtu4vjhRCQChKvYSifio
6S4LfIXWNE6wPCpe8HhjAkAFKbsSenCG5KCX70hL72Tn6fITejh+yMFHzWB1b7vA
dDD804+Yi3iczj9W20fCy47y2LxhZXm6z+IddTEzZU0P
-----END RSA PRIVATE KEY-----';
	//$key=C('LLPAY_PRIVATE')?C('LLPAY_PRIVATE'):$priKey;
	//转换为openssl密钥，必须是没有经过pkcs8转换的私钥
    $res = openssl_get_privatekey($priKey);
	//var_dump($res);
	//调用openssl内置签名方法，生成签名$sign
    openssl_sign($data, $sign, $res,OPENSSL_ALGO_MD5);

	//释放资源
    openssl_free_key($res);
    
	//base64编码
	//$sign=urlencode($sign);
	$sign = base64_encode($sign);
	file_put_contents("log.txt","key:".$priKey."\n", FILE_APPEND);
	file_put_contents("log.txt","签名原串:".$data."\n", FILE_APPEND);
	file_put_contents("log.txt","签名后:".$sign."\n", FILE_APPEND);
	//return urlencode($sign);
    return $sign;
}
function Rsasign2($data) {
	$priKey='-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDQKDq3m8wuTQPFn6XMoW87WrDpTF216odMCxcNqv2Jyexe72Us
W+HH0BDIKLuyEjgSflMOMzahrcamwUNpEldTKkmqSIOZ2ZWrEbiv4ofBLj00q97C
RsKKwKZmWlUQ6xJ6LrQhoXqVeoK9dHqQ+KHZ4xHz7BHLnrGubA/N4vuplQIDAQAB
AoGBAIPAQtH+ObFAq9eFIgMwVuAhmgJAhLvlEvfNuSy8greY6BR6v/XgvjqjdkvK
hGrEX1tNO7KsNbMF88uOXeV+Z2gmpQ0MHLBztXogqTKNaRe4Md5hovNzCDoU3zIu
RZgwWCY+/FLBO3Jy4n4tQZ1Jelf4Z0KuFMIgNcwUyeh124YNAkEA82JbfB2QNMsu
puNha7hzLjJParqLmJ5DcbjGFhpogPKtAsdzoU5pO3cR8uLEcLCTwlz1LDnGHBzS
sAHoKwEYCwJBANryaxy9pRILo7kGLWMkthZACnpTFFYAmbQSPCybI+gZ2TYanzds
vCBnidxaMqZ4EBqgbMwnPNTkKQqWMYGSKN8CQF4jbClcsfuJn3jTuEnXJU34DbnF
f9s/U+z3wD6qZkOCGiNaDEKXNqLWkm21ArBnzC9Aj2BU1GjpSSDlC+0eVjMCQQCs
OOnWZrqUskErxlcnWHY+lEtpozYo3DoLMhjRQYuCA+sfKtu4vjhRCQChKvYSifio
6S4LfIXWNE6wPCpe8HhjAkAFKbsSenCG5KCX70hL72Tn6fITejh+yMFHzWB1b7vA
dDD804+Yi3iczj9W20fCy47y2LxhZXm6z+IddTEzZU0P
-----END RSA PRIVATE KEY-----';
	//$key=C('LLPAY_PRIVATE')?C('LLPAY_PRIVATE'):$priKey;
	//转换为openssl密钥，必须是没有经过pkcs8转换的私钥
    $res = openssl_get_privatekey($priKey);
	//var_dump($res);
	//调用openssl内置签名方法，生成签名$sign
    openssl_sign($data, $sign, $res,OPENSSL_ALGO_MD5);

	//释放资源
    openssl_free_key($res);
    
	//base64编码
	//$sign=urlencode($sign);
	$sign = base64_encode($sign);
	file_put_contents("log.txt","key:".$priKey."\n", FILE_APPEND);
	file_put_contents("log.txt","签名原串:".$data."\n", FILE_APPEND);
	file_put_contents("log.txt","签名后:".$sign."\n", FILE_APPEND);
	return urlencode($sign);
    //return $sign;
}
function llquery($orderid){
			$str='';
			$array=[];
			$array['oid_partner']=C('LLPAY_PARTNER')?C('LLPAY_PARTNER'):'201709210000942976';
			$array['no_order']=$orderid;
			$array['sign_type']='RSA';
			//$array['type_dc']='0';
			ksort($array);
			foreach($array as $key=>$value){
				if($value!=''){
					$str.=$key.'='.$value.'&';
				}	
			}
			
			$str=substr($str,0,strlen($str)-1);
			$array['sign']=Rsasign($str);
			$res=getHttpResponseJSON('https://o2o.lianlianpay.com/offline_api/queryOrder.htm',$array);
			$data=json_decode($res,true);
			return $data;
			if($data['result_pay']=='SUCCESS'){
				return 1;
			}else{
				return 0;
			}
	}
function query($orderid){
			$str='';
			$array=[];
			$array['oid_partner']=C('LLPAY_PARTNER')?C('LLPAY_PARTNER'):'201709210000942976';
			$array['no_order']=$orderid;
			$array['sign_type']='RSA';
			$array['type_dc']='0';
			ksort($array);
			foreach($array as $key=>$value){
				if($value!=''){
					$str.=$key.'='.$value.'&';
				}	
			}
			
			$str=substr($str,0,strlen($str)-1);
			$array['sign']=Rsasign($str);
			$res=getHttpResponseJSON('https://wallet.lianlianpay.com/llwalletapi/orderquery.htm',$array);
			$data=json_decode($res,true);
			if($data['result_pay']=='SUCCESS'){
				return 1;
			}else{
				return 0;
			}
	}
/********************************************************************************/

/**RSA验签
 * $data待签名数据(需要先排序，然后拼接)
 * $sign需要验签的签名,需要base64_decode解码
 * 验签用连连支付公钥
 * return 验签是否通过 bool值
 */
function Rsaverify($data, $sign)  {
	//读取连连支付公钥文件
	$pubKey = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCSS/DiwdCf/aZsxxcacDnooGph
3d2JOj5GXWi+q3gznZauZjkNP8SKl3J2liP0O6rU/Y/29+IUe+GTMhMOFJuZm1ht
AtKiu5ekW0GlBMWxf4FPkYlQkPE0FtaoMP3gYfh+OwI+fIRrpW3ySn3mScnc6Z70
0nU/VYrRkfcSCbSnRwIDAQAB
-----END PUBLIC KEY-----';/*连连支付公钥*/

	//转换为openssl格式密钥
    $res = openssl_get_publickey($pubKey);

	//调用openssl内置方法验签，返回bool值
    $result = (bool)openssl_verify($data, base64_decode($sign), $res,OPENSSL_ALGO_MD5);
	//释放资源
    openssl_free_key($res);

	//返回资源是否成功
    return $result;
}
	/**
 * 远程获取数据，POST模式
 * 注意：
 * @param $url 指定URL完整路径地址
 * @param $para 请求的数据
 * return 远程输出的数据
 */
function getHttpResponseJSON($url, $para) {
    //echo $url;
    $json = json_encode($para);     
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //信任任何证书
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                          
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                 
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json))         
    );
    $responseText = curl_exec($curl);
    file_put_contents("log.txt","返回值:".$responseText."\n", FILE_APPEND);  
    curl_close($curl);
    return $responseText;
}
/*//下订单基本参数
			$data['openid']//微信用户openid
			$data['user_id']//用户id
			$data['no_order']//下单号
			$data['appid']//商家公众号appId
			$data['dt_order']//下单时间
			$data['money_order']//计算价钱总和
			$data['oid_partner']//连连商户号
			$data['busi_partner']//虚拟商品代码
			$data['col_oidpartner']//连连商户号
			$data['notify_url']//异步通知接收地址
			$data['pay_type']//微信公众号支付代码=W
			$data['sign_type']='RSA';
			//风险控制参数
			
			$risk['user_info_mercht_userno']//用户id
			$risk['goods_name']//商品名
			$risk['user_info_dt_register']//用户注册时间
			$risk['cinema_name']//电影院名称
			$risk['book_phone']//商家电话
			$risk['cinema_addr_ province']="430000";
			$risk['dt_play']=$data['dt_order'];//下单时间
			$risk['goods_count']//商品数量
			$risk['frms_ware_category']='1006';//商品代码 1006:电影票



*/
function wechat_pay($data){
	$str='';
	ksort($data);
	foreach($data as $key=>$value){
		if($value){
			$str.=$key.'='.$value.'&';
		}	
	}
	
	$str=substr($str,0,strlen($str)-1);
	
	$data['sign']=Rsasign2($str);
	$res=getHttpResponseJSON('https://o2o.lianlianpay.com/offline_api/createOrder_init.htm',$data);
	
	//$res=getHttpResponseJSON('https://wallet.lianlianpay.com/llwalletapi/combinepay.htm',$data);
	$res=json_decode($res,true);
	return $res;
}

//随机生成订单代码
function get_orderid_string($length){
				$chars = '0123456789'; 
				$return =''; 
				for ( $i = 0; $i < $length; $i++ ) 
				{ 
					$return .= $chars[ mt_rand(0, strlen($chars) - 1) ]; 
				} 
					return $return;

	}
function get_orderid_chang(){
		$string=get_orderid_string(6);
		$map['orderid']=time_format(time(),'Ymd').$string;
		$thunk=M('order')->where($map)->getField('id');
		if($thunk){
			get_orderid_chang();
		}else{
			return $map['orderid'];
		}
		
}
function get_recharge_chang(){
		$string=get_orderid_string(6);
		$map['orderid']=time_format(time(),'Ymd').$string;
		$thunk=M('recharge')->where($map)->getField('orderid');
		if($thunk){
			get_recharge_chang();
		}else{
			return $map['orderid'];
		}
		
}
function get_payid_chang(){
		$string=get_orderid_string(4);
		$map['no_order']=time().$string;
		$thunk=M('pay_llipay')->where($map)->getField('id');
		if($thunk){
			get_payid_chang();
		}else{
			return $map['no_order'];
		}
		
}
function get_link_sign(){
		$string=get_string(4,2);
		$map['link_sign']=$string.time_format(time(),'Ymd');
		$thunk=M('distribution')->where($map)->getField('id');
		if($thunk){
			get_link_sign();
		}else{
			return $map['link_sign'];
		}
		
}
function get_link_sign2(){
		$string=get_string(5,2);
		$map['link_sign']=$string.time_format(time(),'Ymd');
		$thunk=M('distribution_two')->where($map)->getField('id');
		if($thunk){
			get_link_sign2();
		}else{
			return $map['link_sign'];
		}
		
}
function rand_user_string(){
		$string=get_string(8,1);
		$map['user_card']=$string;
		$thunk=M('member')->where($map)->getField('userid');
		if($thunk){
			rand_user_string();
		}else{
			return $map['user_card'];
		}
		
}
/*微信检测函数*/
function isweixin(){
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if(strpos($user_agent, 'MicroMessenger') === false){
			return 2;
		}else{
			return 1;
		}
	}
function get_level_name($id){
	return M('level')->where(array('id'=>$id,'status'=>1))->getField('name');
}	
