<?php
namespace Backstage\Controller;
use Think\Controller;
use Think\Hook;
class GoodsController extends PublicController { 
    public function index(){
		$map=array();
		$select_status=0;
		$status=I('status');
		$type=I('type');
		$classid=I('classid');
		$starttime=I('starttime');
		$endtime=I('endtime');
		if($status){
			$map['status']=array('in',$status);
			$select_status=1;
		}else{
				$status=array(0,2,3);
				$map['status']=array('in','0,2,3');
		}
		if(!is_array($status)){
			$status=str2arr($status);	
		}
		$this->assign('status', $status);
		if($classid){
			$classid=str2arr($classid);
			foreach ( $classid as $key =>$vo){
				if($key==0){
				$map['_string'].="FIND_IN_SET(".$vo.",classid)";
				}else{
					$map['_string'].=" AND FIND_IN_SET(".$vo.",classid)";
				}
			}
		}
		if($starttime){
			if($endtime){
				$start=strtotime($starttime." 00:00:00");
				$end=strtotime($endtime." 23:59:59");
			$map['create_time'] = array(array('egt',$start),array('elt',$end),'and');
			}else{
			$start=strtotime($starttime." 00:00:00");
			$map['create_time']=array('egt',$start);
			}
			$select_status=1;
		}else{
			if($end){
			$end=strtotime($endtime." 23:59:59");
			$map['create_time']=array('elt',$end);
			$select_status=1;
			}
		}
		$this->assign('select_status', $select_status);
		
		$list = $this->lists('Goods', $map ,'goodsname asc',true ,false);//分页查询订单
		$this->assign('_list', $list);
		//分类数据
		$classify = this_tree(1);
		$this->assign('classify', $classify);
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		$twoMenu=$this->getMenus('Goods/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$this->display('goods');
	  }
	  public function add(){
		   if(IS_POST){
			   $array=I('post.');
			   $array['details']=$_POST['details'];
			   $array['parameter']=$_POST['parameter'];
			   $goodsname=$array['goodsname'];
			   $chunk_goodsname=M('goods')->where(array('goodsname'=>$goodsname,'status'=>array('gt',0)))->getField('goodsid');
			   if($chunk_goodsname){
				   $this->error(-1);
			   }
				
				$array['create_time']=time();
				$add=M('goods')->add($array);
				if($add){
					$message_data['goodsid']=$add;
					$message_data['title']="商品：".$data['goodsname']."，创建成功！";
					$message_data['create_time']=time();
					M('goods_message')->add($message_data);
					$this->success('新增成功',U('index'));
				}else{
					$this->error($data);
				}
		   }else{
		$classify = this_tree(1);
		$this->assign('classify', $classify);
		// $card_map['type']='兑换券';
		// $card_map['status']=1;
		// $card=M('card')->where($card_map)->select();
		// $this->assign('card', $card);
		// $youhui_map['type']='代金券';
		// $youhui_map['status']=1;
		// $youhui=M('card')->where($youhui_map)->select();
		// $this->assign('youhui', $youhui);
		 Hook::add("adminArticleEdit", "\Addons\EditorForAdmin\EditorForAdminAddon");
		$this->display('goods_add');  
		   }
		  
	  }
	  /*@详情
	  *
	  */
	  public function edit(){
		  if(IS_POST){
			  $array=I('post.');
			  $array['details']=$_POST['details'];
			  $array['parameter']=$_POST['parameter'];
			  $array['goodsid'] || $this->error(-404);
			   $goodsname=$array['goodsname'];
			   $chunk_goodsname=M('goods')->where(array('goodsname'=>$goodsname,'status'=>array('gt',0)))->getField('goodsid');
			   if($chunk_goodsname){
				   if($chunk_goodsname!= $array['goodsid']){
				   $this->error(-1);
				   }
			   }
			  
				$array['update_time']=time();
				$add=M('goods')->where(array('goodsid'=> $array['goodsid']))->setField($array);
				if($add){
					$this->success('保存成功');
				}else{
					$this->error($data);
				}
		  }else{
			$goodsid=I('id');
			$goodsid || E();
			$goods=M('goods')->where(array('goodsid'=>$goodsid))->find();
			$goods['youhui_id']=str2arr($goods['youhui_id']);
			$goods['banner']=explode(',',$goods['banner']);
			$this->assign('data', $goods);
			$classify = this_tree(1);
			$futures = this_tree(2);
			$shares = this_tree(3);
			$this->assign('classify', $classify);
			$this->assign('futures', $futures);
			$this->assign('shares', $shares);
		// 	$card_map['type']='兑换券';
		// $card_map['status']=1;
		// $card=M('card')->where($card_map)->select();
		// $this->assign('card', $card);
		// $youhui_map['type']='代金券';
		// $youhui_map['status']=1;
		// $youhui=M('card')->where($youhui_map)->select();
		// $this->assign('youhui', $youhui);
		 Hook::add("adminArticleEdit", "\Addons\EditorForAdmin\EditorForAdminAddon");
			$this->display('goods_edit');  
			}
			
	  }
	
	/*会员状态*/ 
   public function goods_status(){
	$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
	$map['goodsid'] =   array('in',$id);
	$map['status']=I('status')?I('status'):-1;
	if(I('status')==3){
	$map['uptime']=time();
	}
	$status=M('Goods')->save($map);
	if($status>0){
		$this->success('修改状态成功');
	}
	$this->error('修改状态失败');
}
	/*推荐状态*/
	public function recommend(){
	$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
	$map['goodsid'] =   array('in',$id);
	$map['recommend']=I('status')?I('status'):0;
	$map['recommend_time']=time();
	$status=M('Goods')->save($map);
	if($status>0){
		$this->success('修改状态成功');
	}
	$this->error('修改状态失败');
}
}