<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'	=>	'mysql',
	'DB_HOST'	=>	'localhost',
	'DB_USER'	=>	'root',
	'DB_PWD'	=>	'3834616',
	'DB_PORT'	=>	'3306',
	'DB_NAME'	=>	'device',
	'DB_PREFIX'	=>	'dev_',
	'DB_CHARSET'	=>	'utf8',

	/*****图片相关的配置******/
	'IMG_maxSize' => '3M',
	'IMG_exts' => array('jpg','pjpeg','bmp','gif','png','jpeg'),
	'IMG_rootPath' => './Public/Uploads/',
	/***修改I函数底层过滤时使用的函数****/
	'DEFAULT_FILTER'        =>  'trim,removeXSS',

	/***MD5加密密钥***/

	'MD5_KEY'	=>	'qiuyuxiong',
);