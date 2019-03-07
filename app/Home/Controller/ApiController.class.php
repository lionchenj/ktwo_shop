<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
    public function index(){
	    $type=I('get.url');
        if(IS_POST){
            $data=$_POST;
            switch($type){
            //接口列表
                case 'ShopCollectCart':$this->ShopCollectCart($data);break;
                default:
                $this->display('page-404');break; 
            }
	    }
	}

	protected  function _check($post_input, $keys_array){
        foreach($keys_array as $key => $a_must_key){
            if(!array_key_exists($a_must_key, $post_input)){
                $ret_arr         = array();
                $ret_arr['errno'] = '400';
                $ret_arr['errmsg']='缺少参数：'.$a_must_key;
                $this->ajaxReturn($ret_arr,'JSON');
            }
        }
    }

    protected  function ShopCollectCart($data)
    {
    	/*$data参数			
			"userid": 	用户id 		必填	
		*/
		$keys = array('userid');
		$check=$this->_check($data,$keys);
		if($check){
			return $check;
		}
		$where_data['userid'] = $data['userid'];
		$result['cart'] = M('cart')->where($where_data)->sum('num');
		if(!$result['cart']){
			$result['cart'] = 0;
		}
		$result['collect'] = M('collection')->where($where_data)->count();
		if(!$result['collect']){
           $result['collect'] = 0;
		}
		$ret_arr         = array();
        $ret_arr['errno'] = '0';
        $ret_arr['errmsg'] = 'SUCCESS';
        $ret_arr['data'] = $result;
        return $this->ajaxReturn($ret_arr,'JSON');

    }
}