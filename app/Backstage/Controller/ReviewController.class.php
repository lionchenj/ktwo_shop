<?php
namespace Backstage\Controller;
use Think\Controller;
class ReviewController extends PublicController {
    public function index(){
		$map=array();
		$map['goodsid']=I('id');
		//$map['status']=1;
		$list = $this->lists('comment', $map ,'create_time desc',true ,false);//分页查询订单
		$this->assign('_list', $list);
		//dump($list);
		$twoMenu=$this->getMenus('Goods/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		/*@高级检索资源*/
		$this->display('review');
	  }
	  /*@详情
	  *
	  */
	  public function edit(){
		  if(IS_POST){
			 $id=I('get.comment_id');
			 $id || $this->error("缺失必要参数:ID");
			 $info=M('comment')->where(array('id'=>$id))->find();
			 $info || $this->error("id错误");
			 $main_data['title']=I('title');
			 $main_data['headimgurl']=I('headimgurl');			 
			 $main_data['goodsid']=I('get.id');
			 $main_data['nickname']=I('nickname');
			 $main_data['update_time']=time();
			 $main_data['status'] = I('status');
			 $save=M('comment')->where(array('id'=>$id))->setField($main_data);
			 if($save){
				$this->success('保存成功！'); 
			 }
			 $this->error("保存失败！"); 
		  }else{
			$id=I('get.comment_id');
			$id || E('');
			$info=M('comment')->where(array('id'=>$id))->find();
			$info || E('');
			//dump($info);
			$this->assign('info', $info);
			$this->display('review_edit');
			}
			
	  }
	   /*@详情
	  *
	  */
	  public function add(){
		  if(IS_POST){
			 $main_data['title']=I('title');
			 $main_data['headimgurl']=I('headimgurl');
			 $main_data['nickname']=I('nickname');
			 $main_data['goodsid']=I('get.id');
			 $main_data['status']=1;
			 $main_data['create_time']=time();
			 $save=M('comment')->add($main_data);
			 if($save){
				$this->success('新增轮播成功！',U('index',array('id'=>I('get.id')))); 
			 }
			 $this->error("新增失败！"); 
		  }else{
			$this->display('review_edit');
			}
			
	  }
	
	/*删除订单*/ 
   public function help_del(){
	$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
	$map['id'] =   array('in',$id);
	$map['status']=-1;
	$status=M('comment')->save($map);
	if($status>0){
		$this->success('删除成功');
	}
	$this->error('删除失败');
}
/*修改状态*/
  public function status(){
	$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
	$map['id'] =   array('in',$id);
	$map['status']=I('status')?I('status'):0;
	$status=M('comment')->save($map);
	if($status>0){
		$this->success('修改状态成功');
	}
	$this->error('修改状态失败');
}
}