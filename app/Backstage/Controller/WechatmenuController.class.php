<?php
namespace Backstage\Controller;
use Think\Controller;
class WechatmenuController extends PublicController {
    public function index(){
		$map['type']=1;
        $tree = D('Wechatmenu')->getTree(0,$map,'id,title,sort,pid,status,level');
        $this->assign('tree', $tree);
        C('_SYS_GET_CATEGORY_TREE_', true); //标记系统获取分类树模板
		$editAuth=$this->checkAuth(MODULE_NAME.'/'.CONTROLLER_NAME.'/operate');//编辑权限
		$this->assign('_Auth', $editAuth);
		$topmenu=M('wechatmenu')->where(array('pid'=>0))->count();
		$twoMenu=$this->getMenus(CONTROLLER_NAME.'/index',2);
		$this->assign('twoMenu', $twoMenu);
		$this->assign('topmenu',$topmenu);
		$this->display('wechat_menu');
	  }
	   /**
     * 显示分类树，仅支持内部调
     * @param  array $tree 分类树
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function tree($tree = null){
        C('_SYS_GET_CATEGORY_TREE_') || $this->_empty();
        $this->assign('tree', $tree);
        $this->display('wechattree');
    }
	
    /* 编辑分类 */
    public function edit($id = null, $pid = 0){
        $Category = D('Wechatmenu');

        if(IS_POST){ //提交表单
			$map['pid']=I('pid');
			$map['title']=I('title');
			$map['type']=I('type');
			$id=I('id');
			$thunk=M('Wechatmenu')->where($map)->getField('id');
			if($thunk){
				if($thunk!==$id){
				 $this->error(-2);
				 }
			}
            if(false !== $Category->update()){				
				$this->setMenu();
				$this->success('保存编辑成功');
            } else {
				$this->error(-404);
            }
        } else {
            $cate = '';
            if($pid){
                /* 获取上级分类信息 */
                $cate = $Category->info($pid, 'id,title,status');
                if(!($cate && 1 == $cate['status'])){
					
                    $this->error(array('error'=>'指定的上级分类不存在或被禁用！'));
                }
            }

            /* 获取分类信息 */
            $info = $id ? $Category->info($id) : '';

            $this->assign('array',       $info);
            $this->assign('category',   $cate);
			$this->assign('id',   $id);
			 $this->assign('type', 1);
            $this->meta_title = '编辑菜单';
            $this->display('wechat_menu_edit');
        }
    }

    /* 新增分类 */
    public function add($pid = 0){
        $Category = D('Wechatmenu');

        if(IS_POST){ //提交表单
			$map['pid']=I('pid');
			$map['title']=I('title');
			$map['type']=I('type');
			$thunk=M('Wechatmenu')->where($map)->getField('id');
			if($thunk){
				 $this->error(-2);
			}
            if(false !== $Category->update()){				
				$this->setMenu();
                $this->success('新增分类成功',U('index'));
            } else {
                $this->error(-404);
            }
        } else {
            $cate = array();
            if($pid){
                /* 获取上级分类信息 */
                $cate = $Category->info($pid, 'id,title,status,level');
                if(!($cate && 1 == $cate['status'])){
                    $this->error(array('error'=>'指定的上级分类不存在或被禁用！'));
                }
            }

            /* 获取分类信息 */
            $this->assign('category', $cate);
			$this->meta_title ='新增菜单';
			$this->assign('type', 1);
            $this->display('wechat_menu_edit');
        }
    }

    /**
     * 删除一个分类
     * @author huajie <banhuajie@163.com>
     */
    public function remove(){
        $cate_id = I('id');
        if(empty($cate_id)){
            $this->error('参数错误!');
        }

        //判断该分类下有没有子分类，有则不允许删除
        $child = M('Wechatmenu')->where(array('pid'=>$cate_id))->field('id')->select();
        if(!empty($child)){
            $this->error('请先删除该分类下的子分类');
        }
        //删除该分类信息
        $res = M('Wechatmenu')->delete($cate_id);
        if($res !== false){			
			$this->setMenu();
            $this->success('删除分类成功！');
        }else{
            $this->error('删除分类失败！');
        }
    }

    /**
     * 操作分类初始化
     * @param string $type
     * @author huajie <banhuajie@163.com>
     */
    public function operate($type = 'move'){
        //检查操作参数
        if(strcmp($type, 'move') == 0){
            $operate = '移动';
        }elseif(strcmp($type, 'merge') == 0){
            $operate = '合并';
        }else{
            $this->error('参数错误！');
        }
        $from = intval(I('get.from'));
        empty($from) && $this->error('参数错误！');

        //获取分类
        $map = array('status'=>1, 'id'=>array('neq', $from));
        $list = M('Wechatmenu')->where($map)->field('id,title')->select();

        $this->assign('type', $type);
        $this->assign('operate', $operate);
        $this->assign('from', $from);
        $this->assign('list', $list);
        $this->meta_title = $operate.'分类';
        $this->display();
    }

    /**
     * 移动分类
     * @author huajie <banhuajie@163.com>
     */
    public function move(){
        $to = I('post.to');
        $from = I('post.from');
        $res = M('Wechatmenu')->where(array('id'=>$from))->setField('pid', $to);
        if($res !== false){
			$this->setMenu();
            $this->success('分类移动成功！', U('index'));
        }else{
            $this->error('分类移动失败！');
        }
    }
	private function setMenu(){		
		$list=M('wechatmenu')->where(array('pid'=>0))->order('sort')->select();
		$data=array();
		foreach($list as $k=>$v){
			$menu=array();
			$sub_menu=M('wechatmenu')->where(array('pid'=>$v['id']))->order('sort')->select();
			$menu['name']=$v['title'];
			if(!$sub_menu){
				$menu['url']=$v['link'];
				$menu['type']='view';
			}else{
				foreach($sub_menu as $vv){
					$sub=array();
					$sub['type']='view';
					$sub['url']=$vv['link'];
					$sub['name']=$vv['title'];
					$menu['sub_button'][]=$sub;
				}
			}
			$data['button'][]=$menu;
		}
	vendor('Wechat.Wechat');
	$wechatConfig=array(
		'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
		'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
	);
	//echo(json_encode($data));
	$model = new \Wechat($wechatConfig);
	$res=$model->set_menu(json_encode($data,JSON_UNESCAPED_UNICODE));
	}
}