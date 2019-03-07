<?php
namespace Backstage\Controller;
use Think\Controller;
class MemberController extends PublicController {
	static protected $deny  = array('edit','edit_ajax','status');
	static protected $allow = array();
    public function index(){		
		$this->member_list();		
	}
	
	protected function member_list(){
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		//二级导航
		$twoMenu=$this->getMenus('Member/'.ACTION_NAME,2);
		$this->assign('twoMenu', $twoMenu);
		$this->assign('two_title', '订单列表');
	/*@高级检索资源--start*/
		$map=array();
		$select_status=0;
		$nickname=I('nickname');
		$sex=I('sex');
		$mobile=I('mobile');
		$status=I('status');
		$starttime=I('starttime');
		$endtime=I('endtime');
		if($nickname){
			$map['nickname']=array('like','%'.$nickname.'%');
			$select_status=1;
		}
		if($mobile){
			$map['mobile']=$mobile;
			$select_status=1;
		}
		if($sex){
			$map['sex']=array('in',$sex);
			$select_status=1;
		}else{
				$sex=array(0,1,2);
				$map['sex']=array('in','1,0,2');
		}
		if(!is_array($sex)){
			$sex=str2arr($sex);	
		}
		$this->assign('sex', $sex);
		if($status){
			$map['status']=array('in',$status);
			$select_status=1;
		}else{
				$status=array(-1,1);
				$map['status']=array('in','1,-1');
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
		/*@高级检索资源--end*/
		$list = $this->lists('Member', $map ,'create_time desc',true ,false);//分页查询订单		
		$this->assign('_list', $list);
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		$this->assign('two_title', '会员列表');
		$this->display('member');
	  }
	  
	public function operate(){
		$type=I('type')?I('type'):$_GET['type'];
		switch($type){
			case 'add' :
				if(IS_POST){
					$this->add_ajax();
				}else{
					$this->add();
				}
			break;
			case 'edit' :
				if(IS_POST){
					$this->edit_ajax();
				}else{
					$this->edit();
				}
			break;
			case 'check_card':
				$this->check();
			break;				
			case 'status':
				$this->status();
			break;
			case 'download':
				$this->download();
			break;
		}
			
	  }
	/**
	 *操作函数无法直接访问
	 * 		edit()，渲染编辑页面
	 *		edit_ajax()，会员修改提交函数
	 *		status(),会员状态修改函数
	 * 		
	 */
	protected function add(){		
			$this->display('member_add');
	}
	protected function edit(){
		$map['userid']=I('id');
		$user=M('member')->where($map)->find();
		$this->assign('user_info',$user);
		$this->display('member_edit');
	}
	protected function edit_ajax(){
		$map['userid']=I('get.id');
		$data['status']=I('status');
		$data['city']=I('city');
		$data['nickname']=I('nickname');
		$data['integral']=intval(I('integral'));
		$integral=M('member')->where($map)->getField('integral');
		if($integral != $data['integral']){
			if($integral>$data['integral']){
				$data_score['score']=$integral-$data['integral'];
				$data_score['surplus']=$data['integral'];
				$data_score['type']=-1;
			}else{
				$data_score['score']=$data['integral']-$integral;
				$data_score['surplus']=$data['integral'];
				$data_score['type']=1;
			}
			$data_score['userid']=$map['userid'];
			$data_score['title']='管理员修改积分';
			$data_score['create_time']=time();
			M('score')->add($data_score);
		}
		$user=M('member')->where($map)->save($data);
		$this->success('保存成功');
	}
	protected function check(){		
			$card_num=I('card_num');
			$card=M('member_card')->where(array('id'=>$card_num))->find();
			if(!$card){
				$return['status']=0;
				$return['info']='会员卡不存在';
			}elseif($card['status']==0){
				$return['status']=1;				
			}else{
				$return['status']=0;
				$return['info']='会员卡已绑定';
			}
			$this->ajaxReturn($return);
	  }  
	protected function add_ajax(){
		$mobile=I('mobile');
		$captcha=I('captcha');
		$card_num=I('card_num');
		$mobile || $this->error('请输入用户手机');
		$captcha || $this->error('请输入验证码');
		$card_num || $this->error('请输入会员卡号');
		$map['mobile']=$mobile;
		$map['status']=1;
		$info=M('MobileCheck')->where($map)->field('check_code,create_time')->find();
		if($info['create_time']+300>=time()){
			if($captcha==$info['check_code']){	
				M('MobileCheck')->where($map)->setField('status',2);	
				$card=M('member_card')->where(array('id'=>$card_num))->find();
				if(!$card){
					$this->error('会员卡不存在');
				}elseif($card['status']==0){
					$data['user_card']=$card_num;				
				}else{
					$this->error('会员卡已绑定');			
				}
				$data['balance']=$card['money'];
				$data['mobile']=$mobile;
				M('member_card')->where(array('id'=>$card_num))->setField(array('status'=>1,'mobile'=>$mobile));
				$data['create_time']=time();
				$save=M('Member')->add($data);
				if($save){
					$this->success('保存信息成功');
				}
				$this->error('保存信息失败');
			}
		}
		$this->error('验证码错误或过期');			
	  }
	 
	protected function status(){
		$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if ( empty($id) ) {
			$this->error('请选择要操作的数据!');
		}
		$map['userid'] =   array('in',$id);
		$map['status']=I('status')?I('status'):-1;
		$status=M('Member')->save($map);
		if($status>0){
			$this->success('修改状态成功');
		}
		$this->error('修改状态失败');
	}
	/*导出CSV 导出充值记录
		*/
	protected function download()
		{
		$list=M('member')->field('userid,headimgurl,nickname,mobile,city,sex,balance,create_time,status')->order('userid asc')->select();
		$headArr="id,头像,会员昵称,会员手机号,所在城市,性别,余额,创建时间,状态\n";
		$data=iconv('utf-8','gb2312',$headArr);
		foreach ($list as $k=>$v){
			$v['nickname']			= 		iconv('utf-8','gb2312',$v['nickname']);
			$v['city']			= 		iconv('utf-8','gb2312',$v['city']);
			if($v['sex']==2){
			$v['sex'] = 		iconv('utf-8','gb2312','女');	
			}else if($v['sex']==1){
			$v['sex'] = 		iconv('utf-8','gb2312','男');	
			}else{
			$v['sex'] = 		iconv('utf-8','gb2312','保密');	
			}
			if($v['status']==-1){
			$v['status'] = 		iconv('utf-8','gb2312','禁用');	
			} 
			if($v['status']==1){
			$v['status'] = 		iconv('utf-8','gb2312','正常');	
			}
			$v['create_time']  	= 		time_format($v['create_time'],'Y-m-d H:i:s');
			foreach($v as $key=>$vo){
				$array[]=$vo;
			}
			$data.=implode(',',$array)."\n";
			unset($v);
			unset($array);
			}
			$filename ="会员数据表".date('Ymd').'.csv';
			header("Content-type:text/csv"); 
			header("Content-Disposition:attachment;filename=".$filename); 
			header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
			header('Expires:0'); 
			header('Pragma:public'); 
			echo $data; 
	}
	
}