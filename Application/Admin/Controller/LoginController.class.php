<?php

	namespace Admin\Controller;
	use Think\Controller;

	class LoginController extends Controller{

		public function login(){

			if(IS_POST){
				$model = D('Admin');
				//var_dump(I('post.'));exit;
				if($model->validate($model->_login_validate)->create('',7)){
					if(true==$model->login()){
						$this->success('登录成功',U('Index/index'));
						exit;
					}
				}

				$this->error($model->getError());
			}
			$this->display();
		}

		public function chkcode(){
			$Verify = new \Think\Verify();
			$Verify->entry();
		}

		public function logout(){
			session(null);
			$this->success('退出登录成功',U('login'));
		}
	}