<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends PublicController {
    public function lists(){
			$class=I('class');
			$title=I('title');
			if($class){
				$title=M('category')->where(array('id'=>$class))->getField('title');
				$map['classid']=$class;
			}
			if($title){
				$class=M('category')->where(array('title'=>$title))->getField('id');
				$map['classid']=$class;
			}
			if(!$class && !$title){
				E();exit;
			}
			$map['status']=3;
			$lists=M('goods')->where($map)->order('recommend desc,recommend_time desc,create_time desc')->select();
			$this->assign('lists',$lists);
			$this->assign('title',$title);
			$this->display('shop-list');
	}
}