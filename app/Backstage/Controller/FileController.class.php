<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Backstage\Controller;
use Think\Controller;
use COM\Upload;
/**
 * 文件控制器
 * 主要用于下载模型的文件上传和下载
 */

class FileController extends Controller {
	
	protected function _initialize(){
		$config = api('Config/lists');
		C($config);
	}	
	
	public function uploadPicture2($flei){
        //TODO: 用户登录检测

        /* 返回标准数据 */
        $return  = array('status' => 1, 'info' => '上传成功', 'data' => '');

        /* 调用文件上传组件上传文件 */
        $Picture = D('Picture');
        $pic_driver = C('PICTURE_UPLOAD_DRIVER');
		
        $info=$Picture->upload(
            $flei,
            C('PICTURE_UPLOAD'),
            C('PICTURE_UPLOAD_DRIVER'),
            C("UPLOAD_{$pic_driver}_CONFIG")
        ); //TODO:上传到远程服务器
		//dump($info);exit;
        /* 记录图片信息 */
        if($info){
            $return['status'] = 1;
            $return = array_merge($info['imageFile'], $return);
        } else {
            $return['status'] = 0;
            $return['info']   = $Picture->getError();
        }

        /* 返回JSON数据 */
        return $return;
    }
	/* 上传图片 */
	public function EditUpload(){
		/* 上传配置 */
		$setting =  C('PICTURE_UPLOAD');
		/* 调用文件上传组件上传文件 */
		$this->uploader = new Upload($setting, 'Local');
		$info   = $this->uploader->upload($_FILES);
		if($info){
			$url = C('PICTURE_UPLOAD.rootPath').$info['upload']['savepath'].$info['upload']['savename'];
			$url = str_replace('./', '/', $url);
			$true=oss_upload($url);
			if($true){
			 $return['path'] =C('OOS_SEVER').$url;
			}
			$info['fullpath'] = $return['path'];
			}
			$fn=$_GET['CKEditorFuncNum'];
			$str="<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction('".$fn."','".$return['path']."','上传成功')</script>";
			exit($str);
		 
	}
	public function update(){
		$array=$this->uploadPicture2($_FILES);
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$protocol_url = "$protocol$_SERVER[HTTP_HOST]";
		//$true=oss_upload($array['path']);
		//if($true){
			 //$return['status'] = 1;
			// $return['path'] =C('OOS_SEVER').$array['path'].C('OOS_AUTH');
		//}else{
			 //$return['status'] = 0;
		//}
		// $this->ajaxReturn($return);
		$array['path']=$protocol_url.__ROOT__.$array['path'];
		 $this->ajaxReturn($array);
	}
	public function updateWechat(){
		$array=$this->uploadWechat($_FILES);
		if($array['path']){
			$path=ltrim($array['path'],'./');
			$path='./'.$path;
			$path=realpath($path);
			vendor('Wechat.Wechat');
			$wechatConfig=array(
			'appId'=>C('WECHAT_APPID')?C('WECHAT_APPID'):'wxed18712a9562d8c2',
			'appSecret'=>C('WECHAT_APPSECRET')?C('WECHAT_APPSECRET'):'0a742023e4322f39a069da0bb6ae59cd',
			);
			$model = new \Wechat($wechatConfig);
			$res=$model->uplodeImages($path);
			if($res['url']){
				$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
				$protocol_url = "$protocol$_SERVER[HTTP_HOST]";
				$return['status']=1;
				$return['wx_img']=$res['url'];
				$return['url']=$protocol_url.__ROOT__.$array['path'];
				$this->ajaxReturn($return);
			}else{
				$return['status']=0;
				$return['info']='图片同步微信服务器失败';
				$this->ajaxReturn($return);
			}
		}else{
			$return['status']=0;
			$return['info']=$array['info'];
			$this->ajaxReturn($return);
		}
	}
	
	public function uploadWechat($flei){
        //TODO: 用户登录检测

        /* 返回标准数据 */
        $return  = array('status' => 1, 'info' => '上传成功', 'data' => '');

        /* 调用文件上传组件上传文件 */
        $Picture = D('Picture');
        $pic_driver = C('PICTURE_UPLOAD_DRIVER');
		
        $info=$Picture->upload(
            $flei,
            C('WECHAT_UPLOAD'),
            C('PICTURE_UPLOAD_DRIVER'),
            C("UPLOAD_{$pic_driver}_CONFIG")
        ); //TODO:上传到远程服务器
		//dump($info);exit;
        /* 记录图片信息 */
        if($info){
            $return['status'] = 1;
            $return = array_merge($info['imageFile'], $return);
        } else {
            $return['status'] = 0;
            $return['info']   = $Picture->getError();
        }

        /* 返回JSON数据 */
        return $return;
    }
	
	 public function httpPost($url,$array) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 500);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $array);

	$res = curl_exec($ch);
	curl_close($ch);

    return $res;
  }
}
