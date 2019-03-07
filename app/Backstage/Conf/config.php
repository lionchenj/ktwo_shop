<?php
return array(
	/* 主题设置 */
	'VIEW_PATH'=>'./template/',//模板路径
	'DEFAULT_THEME' =>  'Maruti',  // 默认模板主题名称
	'DATA_CACHE_PREFIX' => 'back_', // 缓存前缀
	'DATA_CACHE_TYPE'   => 'File', // 数据缓存类型
	'TMPL_L_DELIM'=>'[{',//模版变量输出开始记号
    'TMPL_R_DELIM'=>'}]',//模版变量输出结束记号
	/* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__IMAGES__'    => __ROOT__ . '/template/Maruti/images',
        '__CSS__'    => __ROOT__ . '/template/Maruti/css',
        '__JS__'     =>  __ROOT__ . '/template/Maruti/js',
		'__IMG__'     =>  __ROOT__ . '/template/Maruti/img',		
		'__STATIC__'	=> __ROOT__ .'/Addons/EditorForAdmin'
    ),
	  /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'session_back', //session前缀
    'COOKIE_PREFIX'  => 'cookie_back_', // Cookie前缀 避免冲突
	'DATA_AUTH_KEY' => '3bf1114a986ba87ed28f',//数据加密key
	//上传配置
	'ATTACHMENT_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xml,xls,xlsx,csv', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './data/Attachment/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //附件上传配置（文件上传类配置）
	 /* 图片上传相关配置 */
    'PICTURE_UPLOAD' => array(
		'mimes'    => '', //允许上传的文件MiMe类型
		'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
		'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
		'autoSub'  => true, //自动子目录保存文件
		'subName'  => array('date', 'Y-m-d'), //子目录创建方式,[0]-函数名,[1]-参数,多个参数使用数组
		'rootPath' => './data/Picture/', //保存根路径
		'savePath' => '', //保存路径
		'saveName' => array('uniqid', ''), //上传文件命名规则,[0]-函数名,[1]-参数,多个参数使用数组
		'saveExt'  => '', //文件保存后缀,空则使用原后缀
		'replace'  => false, //存在同名是否覆盖
		'hash'     => true, //是否生成hash编码
		'callback' => false, //检测文件是否存在回调函数,如果存在返回文件信息数组
    ), //图片上传相关配置（文件上传类配置）
	 /* 图片上传相关配置 */
    'PICTURE_UPLOAD' => array(
		'mimes'    => '', //允许上传的文件MiMe类型
		'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
		'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
		'autoSub'  => true, //自动子目录保存文件
		'subName'  => array('date', 'Y-m-d'), //子目录创建方式,[0]-函数名,[1]-参数,多个参数使用数组
		'rootPath' => './data/Picture/', //保存根路径
		'savePath' => '', //保存路径
		'saveName' => array('uniqid', ''), //上传文件命名规则,[0]-函数名,[1]-参数,多个参数使用数组
		'saveExt'  => '', //文件保存后缀,空则使用原后缀
		'replace'  => false, //存在同名是否覆盖
		'hash'     => true, //是否生成hash编码
		'callback' => false, //检测文件是否存在回调函数,如果存在返回文件信息数组
    ), //图片上传相关配置（文件上传类配置）
	//微信 上传图文消息内的图片
	'WECHAT_UPLOAD' => array(
		'mimes'    => '', //允许上传的文件MiMe类型
		'maxSize'  => 1*1024*1024, //上传的文件大小限制 (0-不做限制)
		'exts'     => 'jpg,png', //允许上传的文件后缀
		'autoSub'  => true, //自动子目录保存文件
		'subName'  => array('date', 'Y-m-d'), //子目录创建方式,[0]-函数名,[1]-参数,多个参数使用数组
		'rootPath' => './data/Picture/', //保存根路径
		'savePath' => '', //保存路径
		'saveName' => array('uniqid', ''), //上传文件命名规则,[0]-函数名,[1]-参数,多个参数使用数组
		'saveExt'  => '', //文件保存后缀,空则使用原后缀
		'replace'  => false, //存在同名是否覆盖
		'hash'     => true, //是否生成hash编码
		'callback' => false, //检测文件是否存在回调函数,如果存在返回文件信息数组
    ), //图片上传相关配置（文件上传类配置）
	
    'PICTURE_UPLOAD_DRIVER'=>'local',
    //本地上传文件驱动配置
    'UPLOAD_LOCAL_CONFIG'=>array(),
    'UPLOAD_BCS_CONFIG'=>array(
        'AccessKey'=>'',
        'SecretKey'=>'',
        'bucket'=>'',
        'rename'=>false
    ),
    'UPLOAD_QINIU_CONFIG'=>array(
        'accessKey'=>'__ODsglZwwjRJNZHAu7vtcEf-zgIxdQAY-QqVrZD',
        'secrectKey'=>'Z9-RahGtXhKeTUYy9WCnLbQ98ZuZ_paiaoBjByKv',
        'bucket'=>'onethinktest',
        'domain'=>'onethinktest.u.qiniudn.com',
        'timeout'=>3600,
    ),
	/* 文件上传相关配置 */
    'DOWNLOAD_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => 'doc,docx,jpg,gif,png,jpeg', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './data/Download/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //下载模型上传配置（文件上传类配置）

    /* 编辑器图片上传相关配置 */
    'EDITOR_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './data/Editor/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ),
	'EXCEL_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => 'xls,xlsx,csv', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './data/Excel/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //附件上传配置（文件上传类配置）
	/*邮件默认配置，当后台未配置邮件时默认使用*/
	'MAIL_ADDRESS'=>'m89520@163.com', // 邮箱地址
	'MAIL_SMTP'=>'smtp.163.com', // 邮箱SMTP服务器
	'MAIL_LOGINNAME'=>'m89520', // 邮箱登录帐号
	'MAIL_PASSWORD'=>'lmx920318', // 邮箱密码
	'MAIL_CHARSET'=>'UTF-8',//编码
	'MAIL_AUTH'=>true,//邮箱认证
	'MAIL_HTML'=>true,//true HTML格式 false TXT格式
	'MALL_SWITCH'=>1,//邮件开关（1:开，其他：关闭，谨慎使用-关闭可能导致部分功能失效）
	//连连支付
	'llpay_config'=>array(
	'oid_partner'=>'201709210000942976',//商户编号是商户在连连钱包支付平台上开设的商户号码，为18位数字，如：201306081000001016	
	//商户私钥
	'RSA_PRIVATE_KEY' =>'-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCRSts5LLM0uySvGpGqKOIBhKHblbcu8eyClg+HRvqVkIGob7Qa
+8E8u6PZq7P/+No8UxXxn/1fmEWF6pK0XjZICFO0gxf+3F6XzWeLVb6PDhm3Qasb
Pbauct/dzlEI9pKyOk0V6Z9yxEngPpbCJJws6ZmEJje0EjKmhRd2w60v8QIDAQAB
AoGAJKYAJCzdSzjFaRHHmmdTktR0y2G5YjMN2GanphTGUoGv4t/CS2gjdwFRtC82
aSPJUJwYlekoTTuolb30oWB+Sk3bwng9dvUKDqt2y8R54UbjJe/RHGC9H3PB6hs6
aes2rGytHjvLG0ts53KvKxQShTvl1NHa16yvTKV3ZGJw250CQQDBdAo+obWoNAFJ
5Uio0jG561Oqz/bfB71BCpwr0TwmhSrvMxqS1CxHAxT530P3f2XUP0DPJQKPw+HO
1bsLvJGTAkEAwESVKPHA02TN9hFFRd56NsRAFI48PHeHtJtrBts2Q1ZdcdLfCCqD
Y0W6OYLEOz3ttvLWB2cJqdhY4tsj9S766wJABvjhraQyYd+N9FXZKox40lSS7WMV
aLBkt8VkH4go/NJr27chzAztk5me1eqgDnl++AlXkp+o2fmbV9MILMIdFQJBAKQA
XDNGs7IdxElmxe4pLZpVoEtoYB074DfAcnSwvAKIQsD6nGA800H0kjrIPlZCJujt
Dn/V9jo4Xuly/6L+Ze0CQDSDTFoyjnqhHNVnd03NMwOdLYgEA8763GR6TSq0km47
pwx0Pd1AZD5sCLmeSLZcT9k/m6FCvfJ1VAbFZEimfYA=
-----END RSA PRIVATE KEY-----',
	//连连银通公钥
	'LIANLIAN_PUBLICK_KEY'=>'-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCSS/DiwdCf/aZsxxcacDnooGph3d2JOj5GXWi+
q3gznZauZjkNP8SKl3J2liP0O6rU/Y/29+IUe+GTMhMOFJuZm1htAtKiu5ekW0GlBMWxf4FPkYlQ
kPE0FtaoMP3gYfh+OwI+fIRrpW3ySn3mScnc6Z700nU/VYrRkfcSCbSnRwIDAQAB
-----END PUBLIC KEY-----',
	'key'=>'TW00601704003565',
	'sign_type'=>strtoupper('RSA'),
	'input_charset'=>strtolower('utf-8'),
	),
);