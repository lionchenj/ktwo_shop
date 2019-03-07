<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends Controller {
	public function _empty(){
	 	$this->redirect('/404.html');
	 }
	protected function _initialize(){
		$config = api('Config/lists');
        C($config);
		if(is_login()){
		$goodslist=M('goods')->where(array('status'=>3))->field('goodsid')->select();
		if(!empty($goodslist)){
			$goodsid_list=array_column($goodslist,'goodsid');
			$num_map['goodsid']=array('in',$goodsid_list);
		}else{
			$num_map['goodsid']=0;
		}
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
    public function index(){
			$class['pid']=0;
			$class['type']=1;
			$class['level']=1;
			$class['status']=1;
			$class_list=M('category')->where($class)->field('id,title')->order('sort asc')->select();
			foreach ($class_list as $key =>$val){
				$goods_list=array();
				$data[$val['id']]['title']=$val['title'];
				$map['pid']=$val['id'];
				$map['status']=1;
				$classid=M('category')->where($map)->field('id')->select();
				//dump($classid);
				if($classid){
					$classid=array_column($classid,'id');
					$goods['classid']=array('in',$classid);
					$goods['status']=3;
					$goods['recommend']=1;
					$goods_list=M('goods')->where($goods)->field('goodsid,goodsname,img_url,money,integral_pay')->order('recommend_time desc')->limit(4)->select();
					$data[$val['id']]['list']=$goods_list;
				}
				if(empty($goods_list)){
					unset($data[$val['id']]);
				}
			}
			//首页轮播
			$banner1 = M('banner')->where(array('status'=>1,'type'=>1))->limit(3)->select();
			//首页推荐轮播
			$banner2 = M('banner')->where(array('status'=>1,'type'=>2))->limit(3)->select();
			//首页推荐商品
			$banner3 = M('banner')->where(array('status'=>1,'type'=>3))->limit(2)->select();
			$where['type']=1;
			$tree = D('Category')->getTree(0,$where,'id,title,sort,pid,status,level');
	        $this->assign('tree', $tree);
			//print_r($tree);exit;
			$this->assign('banner1', $banner1);
			$this->assign('banner2', $banner2);
			$this->assign('banner3', $banner3);
			$this->assign('data', $data);
			$this->display('shop-index');
	}
	   /**
     * 显示分类树，仅支持内部调
     * @param  array $tree 分类树
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function tree($tree = null){
        C('_SYS_GET_CATEGORY_TREE_') || $this->_empty();
        $this->assign('tree', $tree);
        $this->display('tree');
    }

	public function goods(){
			$id=I('id');
			$id||$this->_empty();
			$map['goodsid']=$id;
			$map['status']=3;
			$goods=M('goods')->where($map)->find();
			$goods || $this->_empty();
			if($goods['banner']){
			$goods['banner']=str2arr($goods['banner']);
			}
			// if($goods['youhui_id']){
			// $goods['youhui_id']=str2arr($goods['youhui_id']);
			// }
			// if(!empty($goods['youhui_id'])){
			// $goods['youhui_num']=count($goods['youhui_id']);
			// 	foreach($goods['youhui_id'] as $key =>$vo){
			// 	$youhui_map['id']=M('card')->where(array('id'=>$vo))->getField('card_id');
			// 	$youhui[$vo]=M('cash')->where($youhui_map)->find();
			// 	}
			// }else{
			// 	$goods['youhui_num']=0;
			// }
			// if($goods['out_type_2']==1){
			// 	$store=M('card')->where(array('id'=>$goods['duihuan_id']))->getField('store');
			// 	if((int)$store>0){
			// 		$store=M('cinema')->where(array('id'=>$store))->getField('name');
			// 	}else{
			// 		$store='全部门店';
			// 	}
			// }
			$comment_map['status']=1;
			$comment_map['goodsid']=$id;
			$comment=M('comment')->where($comment_map)->select();
			
			// if(is_login()){
			// $collection=M('collection')->where(array('goodsid'=>$id,'userid'=>is_login()))->find();
			// if($collection){
			// 	$collection=1;
			// }else{
			// 	$collection=0;
			// }
			// }else{
			// 	$collection=0;	
			// }
			//$this->assign('collection', $collection);
			$this->assign('comment', $comment);
			//$this->assign('youhui', $youhui);
			$this->assign('data', $goods);
			//$this->assign('store', $store);
			$this->display('shop-detail');
	}
}