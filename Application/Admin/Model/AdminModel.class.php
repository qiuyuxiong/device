<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model 
{
	public $_login_validate = array(
				array('username','require','用户名不能为空',1),
				array('password','require','密码不能为空',1),
				array('chkcode','require','验证码不能为空',1),
				array('chkcode','chk_chkcode','验证码不正确',1,'callback'),
			);

		public function chk_chkcode($code){
			 $verify = new \Think\Verify();    
			 return $verify->check($code);
		}
	protected $insertFields = array('username','password','cpassword','is_use');
	protected $updateFields = array('id','username','password','cpassword','is_use');
	protected $_validate = array(
		array('username', 'require', '账号不能为空！', 1, 'regex', 3),
		array('username', '1,30', '账号的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('username','','账号已经存在',1,'unique',3),
		array('password', 'require', '密码不能为空！', 1, 'regex', 1),
		array('password', '1,32', '密码的值最长不能超过 32 个字符！', 1, 'length', 1),
		array('cpassword','password','两次输入的密码必须一致！',1,'confirm',1),
		array('is_use', 'number', '是否启用 1：启用0：禁用必须是一个整数！', 2, 'regex', 3),
	);
	
		public function login(){

			$username = $this->username;
			$password = $this->password;

			$user = $this->where(array(
					'username'=>array('eq',$username),
				))->find();

			if($user){
				if($user['id']==1||$user['is_use']==1){
					if($user['password']==md5(C('MD5_KEY').$password)){
						session('id',$user['id']);
						session('username',$user['username']);
						return true;
					}else{
						$this->error = '密码不正确';
						return false;
					}
				}else{
					$this->error = '此账号被禁用';
					return false;
				}
			}else{
				$this->error="用户名不存在";
				return false;
			}
		}
	
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		// 配置翻页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->alias('a')->where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{
		$data['password'] = md5(C('MD5_KEY').$data['password']);
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{	
		if($option['where']['id']==1){
			$data['is_use'] = 1;
		}
		$roleId = I('post.role_id');
		$arModel = M('AdminRole');
		$arModel->where(array('admin_id'=>array('eq',$option['where']['id'])))->delete();
		//接收表单重新添加一遍
		if($roleId){
			foreach($roleId as $k=>$v){
				$arModel->add(array(
						'role_id'=>$v,
						'admin_id'=>$option['where']['id'],
					));
			}
		}
		//判断密码为空就不修改这个字段
		if(empty($data['password'])){
			unset($data['password']);
		}else{
			$data['password'] = md5(C('MD5_KEY').$data['password']);
		}
	}
	// 删除前
	protected function _before_delete($option)
	{	
		if($option['where']['id']){
			$this->error = '超级管理员不能被删除';
			return false;
		}
		$arModel = M('AdminRole');
		$arModel->where(array('admin_id'=>array('eq',$option['where']['id'])))->delete();
		if(is_array($option['where']['id']))
		{
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
	/************************************ 其他方法 ********************************************/

	protected function _after_insert($data,$option){
		$roleId = I('post.role_id');
		if($roleId){
			$arModel = M('AdminRole');
			foreach($roleId as $v){
				$arModel->add(array(
						'admin_id'=>$data['id'],
						'role_id'=>$v,
					));
			}
		}
	}
}