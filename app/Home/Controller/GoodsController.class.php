<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
	protected function _initialize(){
		$config = api('Config/lists');
        C($config);
		if(is_login()){
		$num_map['userid']=is_login();
		$num=M('cart')->where($num_map)->sum('num');
		if(empty($num)){
				$num=0;
		}
		}else{
			$num=0;
		}
		$this->assign('_shopnum', $num);
	}
    public function lists(){
			$class=I('class');
			$title=I('title');
			if($class){
				//$title=M('category')->where(array('id'=>$class))->getField('title');
				$map['classid']=$class;
			}
			if($title){
				//$class=M('category')->where(array('title'=>$title))->getField('id');
				//$map['classid']=$class;
				$map['goodsname']=array('LIKE','%'.$title.'%');
			}
			if(!$class && !$title){
				$this->_empty();exit;
			}
			$map['status']=3;
			$lists=M('goods')->where($map)->order('recommend desc,recommend_time desc,create_time desc')->select();
			$this->assign('lists',$lists);
			$this->assign('title',$title);
			$this->display('shop-list');
	}
	public function _empty(){
	 	$this->redirect('/404.html');
	 }
}