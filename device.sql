create database device;

use device;

create table dev_devices(
	id mediumint unsigned not null auto_increment,
	device_name varchar(45) not null comment '设备名称',
	cat_id smallint unsigned not null comment '主分类的id',
	brand_id smallint unsigned not null comment '品牌的id',
	type_id mediumint unsigned not null default '0' comment '设备类型id',
	device_img varchar(150) not null default '' comment '设备图片',
	sm_img varchar(150) not null default '' comment '设备缩略图',
	device_number int unsigned not null default 0 comment '设备数量',
	device_desc longtext comment '设备描述',
	is_delete tinyint unsigned not null default '0' comment '是否已经删除，1：已经删除 0：未删除',
	addtime int unsigned not null comment '添加时间',
	primary key(id),
	key device_number(device_number),
	key is_delete(is_delete),
	key addtime(addtime)
)engine=MyISAM default charset=utf8;


CREATE TABLE dev_brand
(
	id smallint unsigned not null auto_increment,
	brand_name varchar(45) not null comment '设备品牌名称',
	site_url varchar(150) not null comment '设备品牌网站地址',
	logo varchar(150) not null default '' comment '设备logo',
	primary key (id)
)engine=MyISAM default charset=utf8 comment '设备品牌表';


CREATE TABLE dev_category
(
	id smallint unsigned not null auto_increment,
	cat_name varchar(30) not null comment '分类名称',
	parent_id smallint unsigned not null default '0' comment '上级分类的ID，0：代表顶级',
	search_attr_id varchar(100) not null default '' comment '筛选选属性ID，多个ID用逗号隔开',
	primary key (id)
)engine=MyISAM default charset=utf8 comment '设备分类表';

########################## RBAC ################################

CREATE TABLE dev_privilege
(
	id smallint unsigned not null auto_increment,
	pri_name varchar(30) not null comment '权限名称',
	module_name varchar(20) not null comment '模块名称',
	controller_name varchar(20) not null comment '控制器名称',
	action_name varchar(20) not null comment '方法名称',
	parent_id smallint unsigned not null default '0' comment '上级权限的ID，0：代表顶级权限',
	primary key (id)
)engine=MyISAM default charset=utf8 comment '权限表';


CREATE TABLE dev_role_privilege
(
	pri_id smallint unsigned not null comment '权限的ID',
	role_id smallint unsigned not null comment '角色的id',
	key pri_id(pri_id),
	key role_id(role_id)
)engine=MyISAM default charset=utf8 comment '角色权限表';


CREATE TABLE dev_role
(
	id smallint unsigned not null auto_increment,
	role_name varchar(30) not null comment '角色名称',
	primary key (id)
)engine=MyISAM default charset=utf8 comment '角色表';

CREATE TABLE dev_admin_role
(
	admin_id tinyint unsigned not null comment '管理员的id',
	role_id smallint unsigned not null comment '角色的id',
	key admin_id(admin_id),
	key role_id(role_id)
)engine=MyISAM default charset=utf8 comment '管理员角色表';


CREATE TABLE dev_admin
(
	id tinyint unsigned not null auto_increment,
	username varchar(30) not null comment '账号',
	password char(32) not null comment '密码',
	is_use tinyint unsigned not null default '1' comment '是否启用 1：启用0：禁用',
	primary key (id)
)engine=MyISAM default charset=utf8 comment '管理员';

CREATE TABLE dev_type
(
	id tinyint unsigned not null auto_increment,
	type_name varchar(30) not null comment '类型名称',
	primary key(id)
)engine=MyISAM default charset=utf8 comment '设备类型';


CREATE TABLE dev_attribute
(
	id mediumint unsigned not null auto_increment,
	attr_name varchar(30) not null comment '属性名称',
	attr_type tinyint unsigned not null default '0' comment '属性的类型0：唯一 1：可选',
	attr_option_values varchar(150) not null default '' comment '属性的可选值，多个可选值用，隔开',
	type_id tinyint unsigned not null comment '所在的类型的id',
	primary key(id),
	key type_id(type_id)
)engine=MyISAM default charset=utf8 comment '属性';

CREATE TABLE dev_device_attr
(
	id int unsigned not null auto_increment,
	device_id mediumint unsigned not null comment '设备的id',
	attr_id mediumint unsigned not null comment '属性的id',
	attr_value varchar(150) not null default '' comment '属性的值',
	primary key(id),
	key device_id(device_id),
	key attr_id(attr_id)
)engine=MyISAM default charset=utf8 comment '设备属性';


CREATE TABLE dev_device_cat
(
	device_id mediumint unsigned not null comment '设备id',
	cat_id smallint unsigned not null comment '分类id',
	key device_id(device_id),
	key cat_id(cat_id)
)engine=MyISAM default charset=utf8 comment '设备扩展分类表';