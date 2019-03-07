<?php
/**检测是否为开发者模式且是否为超级管理员**/
function is_admin(){
	if(C('DEVELOPER') && is_login()==C('ADMIN_USERID')){
		return true;
	}
	return false;
}
/**
*根据用户id获取用户登录名
*
*/
function get_username($data=''){
	if(empty($data)){
		$data=is_login();
	}
	return M('AdminUser')->where(array('userid'=>$data))->getField('username');
}
/**
*根据用户id获取用户昵称
*
*/
function get_nickname($data=''){
	if(empty($data)){
		$data=is_login();
	}
	$nickname=M('AdminUser')->where(array('userid'=>$data))->getField('nickname');
	return $nickname?$nickname:M('AdminUser')->where(array('userid'=>$data))->getField('username');
}
/**
*根据用户id获取会员昵称
*
*/
function get_member_name($data){
	$nickname=M('Member')->where(array('userid'=>$data))->getField('nickname');
	return $nickname?$nickname:M('Member')->where(array('userid'=>$data))->getField('username');
}


/**
*后台用户账号加密非常规md5加密
*/
function ucenter_md5($str, $key = ''){
	$key=$key?$key:C('DATA_AUTH_KEY');
	return '' === $str ? '' : md5(sha1($str) . $key);
}
/*根据商品id获取商品封面图*/
function get_goods_img_url($goodsid){
	$img_url=M('goods')->where(array('goodsid'=>$goodsid))->getField('img_url');
	if($img_url && file_exists($img_url)){
		return $img_url;
	}else{
		return "data/default/goods.jpg";
	}
}
/*根据商品id获取商品名称*/
function get_goods_goodsname($goodsid){
	$goodsname=M('goods')->where(array('id'=>$goodsid))->getField('name');
	
		return $goodsname;
}
/*根据订单id获取订单详情*/
function get_orderinfo($orderid='',$item='goodsname'){
	return M('order')->where(array('orderid'=>$orderid))->getField($item);
	
}
/*根据会员id获取会员vip招募信息*/
function get_member_viporder($userid,$item='num'){
	$return =0;
	switch($item){
		case 'num':
			$return=M('vip_order')->where(array('userid'=>$userid))->count();
		break;
		case 'true':
			$return=M('vip_order')->where(array('userid'=>$userid,'status'=>1))->count();
		break;
		case 'money':
			$money=M('vip_order')->where(array('userid'=>$userid,'status'=>1))->sum('money');
			$return=$money?$money:0;
		break;
	}
	return $return;
}
/*根据会员id获取会员订单信息*/
function get_member_order($userid,$item='num'){
	$return =0;
	switch($item){
		case 'num':
			$return=M('order')->where(array('userid'=>$userid))->count();
		break;
		case 'true':
			$return=M('order')->where(array('userid'=>$userid,'status'=>1))->count();
		break;
		case 'money':
			$money=M('order')->where(array('userid'=>$userid,'status'=>1))->sum('money');
			$return=$money?$money:0;
		break;
	}
	return $return;
}
/**
	分类树（专属此项目）
 */
function this_tree($type) {
    // 创建Tree
    $tree = array();
	//1.获取第一级
	$map['type']=$type;
	$map['level']=1;
	$map['status']=1;
	$tree=M('Category')->where($map)->field('id,title')->order('sort')->select();
	foreach($tree as $key =>$data){
		$tree[$key]['_']=get_child_tree($data['id']);
	}
    return $tree;
}
function get_child_tree($id,$type=true){
	$array=M('Category')->field('id,title')->where(array('pid'=>$id,'status'=>1))->order('sort')->select();
	if($array){
		$data['id']=0;
		$data['title']='不限';
		foreach($array as $key =>$vo){
			$array[$key]['_']=get_child_tree($vo['id'],false);
			if(empty($array[$key]['_'])){
				unset($array[$key]['_']);
			}else{
				foreach($array[$key]['_'] as $k =>$ll){
					$data['_'][]=$ll;
				}
			}
		}
		if($type){
		array_unshift($array,$data);
		}
		return $array;
	}
	return '';
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
function get_split_chang(){
		$string=get_orderid_string(6);
		$map['no_order']=time_format(time(),'Ymd').$string;
		$thunk=M('split_access')->where($map)->getField('id');
		if($thunk){
			get_split_chang();
		}else{
			return $map['no_order'];
		}
		
}
function get_offline_orderid_chang(){
		$string=get_orderid_string(6);
		$map['orderid']='x'.time_format(time(),'Ymd').$string;
		$thunk=M('offline_order')->where($map)->getField('id');
		if($thunk){
			get_offline_orderid_chang();
		}else{
			return $map['orderid'];
		}
		
}
/**
 * 导入excel文件
 * @param  string $file excel文件路径
 * @return array        excel文件内容数组
 */
function import_excel($file){
    // 判断文件是什么格式
    $type = pathinfo($file);
    $type = strtolower($type["extension"]);
    $type=$type==='csv' ? $type : 'Excel5';
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    // 判断使用哪种格式
    $objReader = PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file);
    $sheet = $objPHPExcel->getSheet(0);
    // 取得总行数
    $highestRow = $sheet->getHighestRow();
    // 取得总列数
    $highestColumn = $sheet->getHighestColumn();
    //循环读取excel文件,读取一条,插入一条
    $data=array();
    //从第一行开始读取数据
    for($j=1;$j<=$highestRow;$j++){
        //从A列读取数据
        for($k='A';$k<=$highestColumn;$k++){
            // 读取单元格
            $data[$j]=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
        }
    }
    return $data;
}
function import_order($file){
    // 判断文件是什么格式
    $type = pathinfo($file);
    $type = strtolower($type["extension"]);
    //$type=$type==='csv' ? $type : 'Excel5';
	if($type==='csv'){
		$type='csv';
	}
	if($type==='xlsx'){
		$type='Excel2007';
	}
	if($type==='xls'){
		$type='Excel5';
	}
	
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    // 判断使用哪种格式
    $objReader = PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file);
    $sheet = $objPHPExcel->getSheet(0);
    // 取得总行数
    $highestRow = $sheet->getHighestRow();
    // 取得总列数
    $highestColumn = $sheet->getHighestColumn();
    //循环读取excel文件,读取一条,插入一条
    $data=array();
    //从第一行开始读取数据
    for($j=2;$j<=$highestRow;$j++){
        //从A列读取数据
        for($k='A';$k<=$highestColumn;$k++){
            // 读取单元格
            $data[$j][$k]=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
        }
    }
    return $data;
}
function get_group_name($id){
	return M('group')->where(array('id'=>$id))->getField('name');
}
function get_member_html($openid){
		$userinfo=M('member')->where(array('openid'=>$openid))->field('nickname,headimgurl')->find();
		if(empty($userinfo)){
			return "未知用户";
		}else{
			return	'<img  style="margin-right:15px" width="50px" src="'.$userinfo['headimgurl'].'">'.$userinfo['nickname'];
		}
}
function get_member_nickname($openid){
		$userinfo=M('member')->where(array('openid'=>$openid))->getField('nickname');
		if(empty($userinfo)){
			return "";
		}else{
			return	$userinfo;
		}
}
function get_select_quit_cinema($cinemaId){
	$list=M('user_consume_card')->field('id,StaffOpenId,CreateTime')->select();
	$string=array();
	foreach($list as $key =>$val){
		$thunk=get_member_cinemaId($val['StaffOpenId'],$val['CreateTime']);
		if($thunk==$cinemaId){
			$string[]=$val['id'];
		}
	}
	return $string;
	
}
function get_member_cinemaId($openid,$create_time){
		$map['openid']=$openid;
		$map['start_time']=array('elt',$create_time);
		$map['end_time']=array('egt',$create_time);
		$map['status']=-1;
		$cinema_id=M('exchange_user_access')->where($map)->getField('cinema_id');
		if(empty($cinema_id)){
			$map['end_time']=0;
			$map['status']=1;
			$cinema_id=M('exchange_user_access')->where($map)->getField('cinema_id');
		}
		if(empty($cinema_id)){
			return 0;
		}else{
			return $cinema_id;
		}
}
function get_member_cinema($openid,$create_time){
		$map['openid']=$openid;
		$map['start_time']=array('elt',$create_time);
		$map['end_time']=array('egt',$create_time);
		$map['status']=-1;
		$cinema_id=M('exchange_user_access')->where($map)->getField('cinema_id');
		if(empty($cinema_id)){
			$map['end_time']=0;
			$map['status']=1;
			$cinema_id=M('exchange_user_access')->where($map)->getField('cinema_id');
		}
		if(empty($cinema_id)){
			return "未知电影院";
		}else{
			return	M('cinema')->where(array('id'=>$cinema_id))->getField('name');
		}
}
function get_cinemaId_cinema($cinemaid){
	return	M('cinema')->where(array('id'=>$cinemaid))->getField('name');
}
function is_supplier(){
	$uid=is_login();
	$gid=M('auth_group_access')->where(array('uid'=>$uid))->getField('group_id');
	if($gid==2){
		return true;
	}
	return false;
}
function get_cinema_username(){
	$map['username']=get_username();
	return M('cinema')->where($map)->getField('id');
}

function get_type_name($type){
	switch($type){
		case "GROUPON":
			$res="团购券";
		break;
		case "CASH":
			$res="代金券";
		break;
		case "DISCOUNT":
			$res="折扣券";
		break;
		case "GIFT":
			$res="兑换券";
		break;
		case "GENERAL_COUPON":
			$res="优惠券";
		break;
		case "CODE_TYPE_QRCODE": 
			$res="二维码显示code";
		break;
		case "CODE_TYPE_BARCODE":
			$res="一维码显示code";
		break;
		case "CODE_TYPE_ONLY_QRCODE": 
			$res="二维码不显示code";
		break;
		case "CODE_TYPE_TEXT": 
			$res="仅code类型";
		break;
		case "CODE_TYPE_NONE": 
			$res="无code类型";
		break;
	}
	return $res;
}
function get_color_name($color){
	switch($color){
		case "#63b359":
			$res="Color010";
		break;
		case "#2c9f67":
			$res="Color020";
		break;		
		case "#509fc9":
			$res="Color030";
		break;		
		case "#5885cf":
			$res="Color040";
		break;		
		case "#9062c0":
			$res="Color050";
		break;		
		case "#d09a45":
			$res="Color060";
		break;		
		case "#e4b138":
			$res="Color070";
		break;		
		case "#ee903c":
			$res="Color080";
		break;		
		case "#f08500":
			$res="Color081";
		break;		
		case "#a9d92d":
			$res="Color082";
		break;		
		case "#dd6549":
			$res="Color090";
		break;	
		case "#cc463d":
			$res="Color100";
		break;			
		case "#cf3e36":
			$res="Color101";
		break;	
		case "#5E6671":
			$res="Color102";
		break;			
	}
	return $res;
}

function get_week_id($name){
	switch(strtolower($name)){
		case 'monday':
			$res=1;
		break;
		case 'tuesday':
			$res=2;
		break;
		case 'wednesday':
			$res=3;
		break;
		case 'thursday':
			$res=4;
		break;
		case 'friday':
			$res=5;
		break;
		case 'saturday':
			$res=6;
		break;
		case 'sunday':
			$res=7;
		break;
	}
	return $res;
}
function change_week($str){
	switch ($str) {
		case '1':
		return "周一";
		break;
		case '2':
		return "周二";
		break;
		case '3':
		return "周三";
		break;
		case '4':
		return "周四";
		break;
		case '5':
		return "周五";
		break;
		case '6':
		return "周六";
		break;
		case '7':
		return "周日";
		break;
		case '1,2':
		return "周一至周二";
		break;
		case '1,3':
		return "周一、周三";
		break;
		case '1,4':
		return "周一、周四";
		break;
		case '1,5':
		return "周一、周五";
		break;
		case '1,6':
		return "周一、周六";
		break;
		case '1,7':
		return "周一、周日";
		break;
		case '2,3':
		return "周二至周三";
		break;
		case '2,4':
		return "周二、周四";
		break;
		case '2,5':
		return "周二、周五";
		break;
		case '2,6':
		return "周二、周六";
		break;
		case '2,7':
		return "周二、周日";
		break;
		case '3,4':
		return "周三至周四";
		break;
		case '3,5':
		return "周三、周五";
		break;
		case '3,6':
		return "周三、周六";
		break;
		case '3,7':
		return "周三、周日";
		break;
		case '4,5':
		return "周四至周五";
		break;
		case '4,6':
		return "周四、周六";
		break;
		case '4,7':
		return "周四、周日";
		break;
		case '5,6':
		return "周五至周六";
		break;
		case '5,7':
		return "周五、周日";
		break;
		case '6,7':
		return "周六至周日";
		break;
		case '1,2,3':
		return "周一至周三";
		break;
		case '1,2,4':
		return "周一至周二、周四";
		break;
		case '1,2,5':
		return "周一至周二、周五";
		break;
		case '1,2,6':
		return "周一至周二、周六";
		break;
		case '1,2,7':
		return "周一至周二、周日";
		break;
		case '1,3,4':
		return "周一、周三至周四";
		break;
		case '1,3,5':
		return "周一、周三、周五";
		break;
		case '1,3,6':
		return "周一、周三、周六";
		break;
		case '1,3,7':
		return "周一、周三、周日";
		break;
		case '1,4,5':
		return "周一、周四至周五";
		break;
		case '1,4,6':
		return "周一、周四、周六";
		break;
		case '1,4,7':
		return "周一、周四、周日";
		break;
		case '1,5,6':
		return "周一、周五至周六";
		break;
		case '1,5,7':
		return "周一、周五、周日";
		break;
		case '1,6,7':
		return "周一、周六至周日";
		break;
		case '2,3,4':
		return "周二至周四";
		break;
		case '2,3,5':
		return "周二至周三、周五";
		break;
		case '2,3,6':
		return "周二至周三、周六";
		break;
		case '2,3,7':
		return "周二至周三、周日";
		break;
		case '2,4,5':
		return "周二、周四至周五";
		break;
		case '2,4,6':
		return "周二、周四、周六";
		break;
		case '2,4,7':
		return "周二、周四、周日";
		break;
		case '2,5,6':
		return "周二、周五至周六";
		break;
		case '2,5,7':
		return "周二、周五、周日";
		break;
		case '2,6,7':
		return "周二、周六至周日";
		break;
		case '3,4,5':
		return "周三至周五";
		break;
		case '3,4,6':
		return "周三至周四、周六";
		break;
		case '3,4,7':
		return "周三至周四、周日";
		break;
		case '3,5,6':
		return "周三、周五至周六";
		break;
		case '3,5,7':
		return "周三、周五、周日";
		break;
		case '3,6,7':
		return "周三、周六至周日";
		break;
		case '4,5,6':
		return "周四至周六";
		break;
		case '4,5,7':
		return "周四至周五、周日";
		break;
		case '4,6,7':
		return "周四、周六至周日";
		break;
		case '5,6,7':
		return "周五至周日";
		break;
		case '1,2,3,4':
		return "周一至周四";
		break;
		case '1,2,3,5':
		return "周一至周三、周五";
		break;
		case '1,2,3,6':
		return "周一至周三、周六";
		break;
		case '1,2,3,7':
		return "周一至周三、周日";
		break;
		case '1,2,4,5':
		return "周一至周二、周四至周五";
		break;
		case '1,2,4,6':
		return "周一至周三、周六";
		break;
		case '1,2,4,7':
		return "周一至周三、周日";
		break;
		case '1,2,5,6':
		return "周一至周二、周五至周六";
		break;
		case '1,2,5,7':
		return "周一至周二、周五至周日";
		break;
		case '1,2,6,7':
		return "周一至周二、周六至周日";
		break;
		case '1,3,4,5':
		return "周一、周三至周五";
		break;
		case '1,3,4,6':
		return "周一、周三至周六";
		break;
		case '1,3,4,7':
		return "周一、周三至周四、周日";
		break;
		case '1,3,5,6':
		return "周一、周三、周五至周六";
		break;
		case '1,3,5,7':
		return "周一、周三、周五、周日";
		break;
		case '1,3,6,7':
		return "周一、周三、周六至周日";
		break;
		case '1,4,5,6':
		return "周一、周四至周六";
		break;
		case '1,4,5,7':
		return "周一、周四至周五、周日";
		break;
		case '1,4,6,7':
		return "周一、周四、周六至周日";
		break;
		case '1,5,6,7':
		return "周一、周五至周日";
		break;
		case '2,3,4,5':
		return "周二至周五";
		break;
		case '2,3,4,6':
		return "周二至周四、周六";
		break;
		case '2,3,4,7':
		return "周二至周四、周日";
		break;
		case '2,3,5,6':
		return "周二至周三、周五至周六";
		break;
		case '2,3,5,7':
		return "周二至周三、周五、周日";
		break;
		case '2,3,6,7':
		return "周二至周三、周六至周日";
		break;
		case '2,4,5,6':
		return "周二、周四至周六";
		break;
		case '2,4,5,7':
		return "周二、周四至周五、周日";
		break;
		case '2,4,6,7':
		return "周二、周四、周六至周日";
		break;
		case '2,5,6,7':
		return "周二、周五至周日";
		break;
		case '3,4,5,6':
		return "周三至周六";
		break;
		case '3,4,5,7':
		return "周三至周五、周日";
		break;
		case '3,4,6,7':
		return "周三至周四、周六至周日";
		break;
		case '3,5,6,7':
		return "周三、周五至周日";
		break;
		case '4,5,6,7':
		return "周四至周日";
		break;
		case '1,2,3,4,5':
		return "周一至周五";
		break;
		case '1,2,3,4,6':
		return "周一至周四、周六";
		break;
		case '1,2,3,4,7':
		return "周一至周四、周日";
		break;
		case '1,2,3,5,6':
		return "周一至周三、周五至周六";
		break;
		case '1,2,3,5,7':
		return "周一至周三、周五至周日";
		break;
		case '1,2,3,6,7':
		return "周一至周三、周六至周日";
		break;
		case '1,2,4,5,6':
		return "周一至周二、周四至周六";
		break;
		case '1,2,4,5,7':
		return "周一至周二、周四至周五、周日";
		break;
		case '1,2,4,6,7':
		return "周一至周二、周四、周六至周日";
		break;
		case '1,2,5,6,7':
		return "周一至周二、周五至周日";
		break;
		case '1,3,4,5,6':
		return "周一、周三至周六";
		break;
		case '1,3,4,5,7':
		return "周一、周三至周五、周日";
		break;
		case '1,3,4,6,7':
		return "周一、周三至周四、周六至周日";
		break;
		case '1,3,5,6,7':
		return "周一、周三、周五至周日";
		break;
		case '1,4,5,6,7':
		return "周一、周四至周日";
		break;
		case '2,3,4,5,6':
		return "周二至周六";
		break;
		case '2,3,4,5,7':
		return "周二至周日";
		break;
		case '2,3,4,6,7':
		return "周二至周四、周六至周日";
		break;
		case '2,3,5,6,7':
		return "周二至周三、周五至周日";
		break;
		case '2,4,5,6,7':
		return "周二、周四至周日";
		break;
		case '3,4,5,6,7':
		return "周三至周日";
		break;
		case '1,2,3,4,5,6':
		return "周一至周六";
		break;
		case '1,2,3,4,5,7':
		return "周一至周五、周日";
		break;
		case '1,2,3,5,6,7':
		return "周一至周三、周五至周日";
		break;
		case '1,2,4,5,6,7':
		return "周一至周二、周四至周日";
		break;
		case '1,3,4,5,6,7':
		return "周一、周三至周日";
		break;
		case '2,3,4,5,6,7':
		return "周二至周日";
		break;
		case '1,2,3,4,5,6,7':
		return "周一至周日";
		break;
	default:
		return "";
		break;
	}
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
function get_charge_orderid_chang(){
		$string=get_orderid_string(6);
		$map['orderid']=time_format(time(),'Ymd').$string;
		$thunk=M('recharge')->where($map)->getField('orderid');
		if($thunk){
			get_charge_orderid_chang();
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
/*------------------------------------------------------------------two--------------------------------------------------*/
/** 画圆角
 * @param $radius 圆角位置
 * @param $color_r 色值0-255
 * @param $color_g 色值0-255
 * @param $color_b 色值0-255
 * @return resource 返回圆角
 */
function get_lt_rounder_corner($radius, $color_r, $color_g, $color_b,$img_path)
{
    // 创建一个正方形的图像
    $img = imagecreatetruecolor($radius, $radius);
    // 图像的背景
    $bgcolor = imagecolorallocate($img, $color_r, $color_g, $color_b);
    $fgcolor = imagecolorallocate($img, 0, 0, 0);
    imagefill($img, 0, 0, $bgcolor);
    // $radius,$radius：以图像的右下角开始画弧
    // $radius*2, $radius*2：已宽度、高度画弧
    // 180, 270：指定了角度的起始和结束点
    // fgcolor：指定颜色
    imagefilledarc($img, $radius, $radius, 0, 0, 180, 270, $fgcolor, IMG_ARC_PIE);
    // 将弧角图片的颜色设置为透明
    imagecolortransparent($img, $fgcolor);
	imagepng($img,$img_path.'img.png');   
    return $img;
}
 /* @param $im  底图
 * @param $dst_x 画出的图的（0，0）位于底图的x轴位置
 * @param $dst_y 画出的图的（0，0）位于底图的y轴位置
 * @param $image_w 画的图的宽
 * @param $image_h 画的图的高
 * @param $radius 圆角的值
 */
function imagebackgroundmycard($image_w, $image_h, $radius,$img_path)
{
	$im = imagecreatetruecolor($image_w, $image_h);
	$bgcolor = imagecolorallocate($im, 0, 0, 0);
	imagefill($im, 0, 0, $bgcolor);
    $resource = imagecreatetruecolor($image_w+$radius*2, $image_h+$radius*2);
    $bgcolor = imagecolorallocate($resource, 255, 255, 255);//该图的背景色	
    imagefill($resource, 0, 0, $bgcolor);
    $lt_corner = get_lt_rounder_corner($radius, 255, 255, 255,$img_path);//圆角的背景色

    // lt(左上角)
    imagecopymerge($resource, $lt_corner, 0, 0, 0, 0, $radius, $radius, 100);
    // lb(左下角)
    $lb_corner = imagerotate($lt_corner, 90, 0);
    imagecopymerge($resource, $lb_corner, 0, $image_h + $radius, 0, 0, $radius, $radius, 100);
    // rb(右上角)
    $rb_corner = imagerotate($lt_corner, 180, 0);
    imagecopymerge($resource, $rb_corner, $image_w + $radius, $image_h + $radius, 0, 0, $radius, $radius, 100);
    // rt(右下角)
    $rt_corner = imagerotate($lt_corner, 270, 0);
    imagecopymerge($resource, $rt_corner, $image_w + $radius, 0, 0, 0, $radius, $radius, 100);
	
    imagecopy($resource, $im, $radius, $radius, 0, 0, $image_w, $image_h);
	imagepng($resource,$img_path.'im.png');   
}


function two($logo,$value,$path,$radius,$name){
import('Org.Two');
$errorCorrectionLevel = 'M';//容错级别   
$matrixPointSize = 6;//生成图片大小
$img_path='./data/Picture/Two/'.$path;

if(!file_exists($img_path)){
	$oldmask = umask(0);  
     mkdir($img_path,0777);
	 umask($oldmask);  
}
QRcode::png($value, $img_path.'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2); 
$QR = $img_path.'qrcode.png';  
$QR = imagecreatefromstring(file_get_contents($QR));      
$QR_width = imagesx($QR);//二维码图片宽度   
$QR_height = imagesy($QR);//二维码图片高度

if ($logo !== FALSE) {//是否存在logo
    $logo = imagecreatefromstring(file_get_contents($logo));   
    $logo_width = imagesx($logo);//logo图片宽度   
    $logo_height = imagesy($logo);//logo图片高度 
 if ($radius !== FALSE) {//是否存在logo
	 imagebackgroundmycard($logo_width, $logo_height,$radius,$img_path);
	 $im = $img_path.'im.png';  
    $im = imagecreatefromstring(file_get_contents($im));   
    $radius_width = imagesx($im);//logo图片宽度   
    $radius_height = imagesy($im);//logo图片高度   
    $radius_qr_width = ($QR_width+ 50) / 5 ;   
    $scale = $radius_height/$radius_qr_width;   
    $radius_qr_height = $radius_height/$scale;   
    $from_width = ($QR_width - $radius_qr_width) / 2;   
    //重新组合图片并调整大小   
    imagecopyresampled($QR, $im, $from_width, $from_width, 0, 0, $radius_qr_width,$radius_qr_height, $radius_width, $radius_height);   
}	
    $logo_qr_width = $QR_width / 5;   
    $scale = $logo_width/$logo_qr_width;   
    $logo_qr_height = $logo_height/$scale;   
    $from_width = ($QR_width - $logo_qr_width) / 2;   
    //重新组合图片并调整大小   
    imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,   
    $logo_qr_height, $logo_width, $logo_height);   
}
 
//输出图片   
imagepng($QR, $img_path.$name.'.png');  
$img_url=substr($img_path.$name.'.png',1);  
return $img_url;
}
function get_user_mobile($userid){
	$mobile=M('member')->where(array('userid'=>$userid))->getField('mobile');
	return $mobile;
}
function get_card_num_string(){
		$string=get_rand_string(8);
		$map['card_num']=$string;
		$thunk=M('member')->where(array('user_card'=>$string))->getField('id');
		$thunk2=M('member_card')->where($map)->getField('id');
		if($thunk||$thunk2){
			get_card_num_string();
		}else{
			return $map['card_num'];
		}
}
function get_access_groupname($uid){
	$access['uid']=$uid;
	$groupid=M('auth_group_access')->where($access)->getField('group_id');	
	$group['id']=$groupid;
	$return=M('auth_group')->where($group)->getField('title');
	return $return;
	}
function get_member_level($uid){
		$map['id']=M('member')->where(array('userid'=>$uid))->getField('level');
		return M('level')->where($map)->getField('name');
		
}
/*快递鸟接口*/
/**
 * Json方式 查询订单物流轨迹
 */
// function getOrderTracesByJson($LogisticCode,$ShipperCode){
// 	$requestData= "{'OrderCode':'','ShipperCode':'".$ShipperCode."','LogisticCode':'".$LogisticCode."'}";
	
// 	$datas = array(
//         'EBusinessID' => C('EBusinessID'),
//         'RequestType' => '1002',
//         'RequestData' => urlencode($requestData) ,
//         'DataType' => '2',
//     );
//     $datas['DataSign'] = encrypt($requestData, C('AppKey'));
// 	$result=sendPost(C('ReqURL'), $datas);
// 	return $result;
// }
 
// /**
//  *  post提交数据 
//  * @param  string $url 请求Url
//  * @param  array $datas 提交的数据 
//  * @return url响应返回的html
//  */
// function sendPost($url, $datas) {
//     $temps = array();	
//     foreach ($datas as $key => $value) {
//         $temps[] = sprintf('%s=%s', $key, $value);		
//     }	
//     $post_data = implode('&', $temps);
//     $url_info = parse_url($url);
// 	if(empty($url_info['port']))
// 	{
// 		$url_info['port']=80;	
// 	}
//     $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
//     $httpheader.= "Host:" . $url_info['host'] . "\r\n";
//     $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
//     $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
//     $httpheader.= "Connection:close\r\n\r\n";
//     $httpheader.= $post_data;
//     $fd = fsockopen($url_info['host'], $url_info['port']);
//     fwrite($fd, $httpheader);
//     $gets = "";
// 	$headerFlag = true;
// 	while (!feof($fd)) {
// 		if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
// 			break;
// 		}
// 	}
//     while (!feof($fd)) {
// 		$gets.= fread($fd, 128);
//     }
//     fclose($fd);  
    
//     return $gets;
// }

// /**
//  * 电商Sign签名生成
//  * @param data 内容   
//  * @param appkey Appkey
//  * @return DataSign签名
//  */
// function encrypt($data, $appkey) {
//     return urlencode(base64_encode(md5($data.$appkey)));
// }
