<?php
return array(
	/* 主题设置 */
	'VIEW_PATH'=>'./template/',//模板路径
	'DEFAULT_THEME' =>  'Tcm',  // 默认模板主题名称
	'DATA_CACHE_PREFIX' => 'home_', // 缓存前缀
	'DATA_CACHE_TYPE'   => 'File', // 数据缓存类型
	'TMPL_L_DELIM'=>'{',//模版变量输出开始记号
    'TMPL_R_DELIM'=>'}',//模版变量输出结束记号
	/* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__IMAGES__'    => __ROOT__ . '/template/Tcm/images',
        '__CSS__'    => __ROOT__ . '/template/Tcm/css',
        '__JS__'     =>  __ROOT__ . '/template/Tcm/js',
		'__MEDIA__'     =>  __ROOT__ . '/template/Tcm/media',
	),	
	/* SESSION 和 COOKIE 配置 */
	'SESSION_PREFIX' => 'session_home', //session前缀
	'COOKIE_PREFIX'  => 'cookie_home_', // Cookie前缀 避免冲突
	'DATA_AUTH_KEY' => '3bf1114a986ba87ed28f',//数据加密key
		
);