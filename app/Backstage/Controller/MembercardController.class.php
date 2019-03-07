<?php
namespace Backstage\Controller;
use Think\Controller;
class MembercardController extends PublicController {
		public function index(){
			$map['status']=array('in','0,1');
			$list = $this->lists('member_card', $map ,'id asc',true ,false);//分页查询
			$this->assign('_list', $list);
			$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
			$this->assign('_Auth', $editAuth);		
			//二级导航
			$twoMenu=$this->getMenus('Member/'.ACTION_NAME,2);
			$this->assign('twoMenu', $twoMenu);
			$this->display('member_card');
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
				case 'status' :
					$this->status();				
				break;
			}			
		}
		protected function add(){
			$this->display('member_card_add');
		}
		protected function edit(){
			$id=I('get.id');
			$id||E('id错误');
			$info=M('member_card')->where(array('id'=>$id))->find();
			$info||E('卡号不存在');
			$this->assign('info',$info);
			$this->display('member_card_edit');
		}
		protected function edit_ajax(){
			$id=I('get.id');
			$id||$this->error('id错误');
			$data['money']=I('money');			
			$save=M('member_card')->where(array('id'=>$id))->save($data);
			if($save){
				$this->success('保存成功');
			}else{
				$this->error('网络错误');
			}
		}
		protected function add_ajax(){
			$money=I('money');
			$totalnum=I('num');
			$array=[];
			$array[0]='会员卡号';
			for($i=0;$i<$totalnum;$i++){				
				$data['status']=0;
				$data['create_time']=time();
				$data['money']=$money;
				$add=M('member_card')->add($data);
				$array[]=$add;							
			}				
			$filename=date('YmdHis')."会员卡数据表.xlsx";
			$this->getExcel($array,$filename);		
		}		
		protected function status(){
			$id=I('get.id');
			$data=M('grade')->where(array('id'=>$id))->setField('status',-1);
			$this->success('删除成功');
		}
		protected function change(){
			$type=M('grade')->where(array('status'=>1))->getField('type');
			if($type){
				$type=0;
			}else{
				$type=1;
			}
			M('grade')->where(array('status'=>1))->save(array('type'=>$type));
			$this->success('切换成功');
		}
	
		 private  function getExcel($data,$filename){
			ini_set('max_execution_time', '0');
			Vendor('PHPExcel.PHPExcel');
			$phpexcel = new \PHPExcel();
			$phpexcel->getProperties() ->setCreator("HYZ") ->setLastModifiedBy("HYZ") ->setTitle("Office 2007 XLSX Test Document") ->setSubject("Office 2007 XLSX Test Document") ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") ->setKeywords("office 2007 openxml php") ->setCategory("Test result file");
			//$phpexcel->getActiveSheet()->fromArray($data);
			foreach ($data as $key => $value){
				$phpexcel->getActiveSheet()->setCellValue('A'.($key+1),$value);
			}
			$phpexcel->getActiveSheet()->setTitle('Sheet1');
			$phpexcel->setActiveSheetIndex(0);
			$objWriter= \PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
			$filePath = './data/Excel/'.$filename; 			
			$objWriter->save($filePath);  
			$response = array( 'result' => 1, 'url' =>$filePath);
			$this->success($response);
			exit;			
		}
		
}