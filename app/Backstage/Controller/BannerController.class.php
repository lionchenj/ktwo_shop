<?php
namespace Backstage\Controller;
use Think\Controller;
use Think\Hook;
class BannerController extends PublicController {
    public function index(){
		$map=array();
		$select_status=0;
		$title=I('title');
		$status=I('status');
		$starttime=I('starttime');
		$endtime=I('endtime');
		if($title){
			$map['title']=array('LIKE',"%".$title."%");
			$select_status=1;
		}
		if($status){
			$map['status']=array('in',$status);
			$select_status=1;
		}else{
				$status=array(1,0);
				$map['status']=array('in','1,0');
		}
		if(!is_array($status)){
			$status=str2arr($status);	
		}
		$this->assign('status', $status);
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
		$list = $this->lists('Banner', $map ,'type asc,create_time desc',true ,false);//分页查询订单
		$this->assign('_list', $list);
		/*@高级检索资源*/
		$this->display('banner');
	  }
	  /*@详情
	  *
	  */
	  public function edit(){
		  if(IS_POST){
			 $id=I('id');
			 $id || $this->error("缺失必要参数:ID");
			 $info=M('banner')->where(array('id'=>$id))->find();
			 $info || $this->error("id错误");
			 $main_data['title']=I('title');
			 $main_data['img_path']=I('img_path');
			 $main_data['type']=I('type');
			 $main_data['link']=I('link');
			 $main_data['update_time']=time();
			 $save=M('banner')->where(array('id'=>$id))->setField($main_data);
			 if($save){
				$this->success('保存成功！'); 
			 }
			 $this->error("保存失败！"); 
		  }else{
			$id=I('id');
			$id || E('');
			$info=M('banner')->where(array('id'=>$id))->find();
			$info || E('');
			$this->assign('info', $info);
			$this->display('banner_edit');
			}
			
	  }
	   /*@详情
	  *
	  */
	  public function add(){
		  if(IS_POST){
			 $main_data['title']=I('title');
			 $main_data['img_path']=I('img_path');
			 $main_data['link']=I('link');
			 $main_data['type']=I('type');
			 $main_data['create_time']=time();
			 $save=M('banner')->add($main_data);
			 if($save){
				$this->success('新增轮播成功！',U('index')); 
			 }
			 $this->error("新增失败！"); 
		  }else{
			$this->display('banner_edit');
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
	$status=M('Banner')->save($map);
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
	$status=M('Banner')->save($map);
	if($status>0){
		$this->success('修改状态成功');
	}
	$this->error('修改状态失败');
}
}