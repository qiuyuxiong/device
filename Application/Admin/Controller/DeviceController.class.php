<?php 

	namespace Admin\Controller;
	use Think\Controller;
	class DeviceController extends IndexController{
		/*
		*	添加设备
		*
		*/
		public function add(){
			//处理表单
			if(IS_POST){
				$model = D('Devices');
				
				if($model->create(I('post.'),1)){
					if($model->add()){
						$this->success('添加设备成功',U('lst'));
						exit;
					}
				}
				//如果上面执行失败，显示失败原因
				$error = $model->getError();
				$this->error($error);
			}

			// 取出所有的设备类型
	    	$typeModel = M('Type');
	    	$typeData = $typeModel->select();
	    	$this->assign('typeData', $typeData);
	    	// 取出所有的设备分类
	    	$catModel = D('Category');
	    	$catData = $catModel->getTree();
	    	$this->assign('catData', $catData);
	    	// 取出所有的品牌
	    	$brandModel = M('Brand');
	    	$brandData = $brandModel->select();
	    	$this->assign('brandData', $brandData);
			//$this->setPageBtn('添加设备','设备列表',U('lst?p='.I('get.p')));
			//显示视图
			$this->display();
		}

		//显示设备列表
		public function lst(){

			$model = D('Devices');

			//获取带翻页的数据
			$data = $model->search();

			$this->assign(array(
					'data'=>$data['data'],
					'page'=>$data['page'],
				));
			
			$this->assign('daData',$daData);
			$this->display();
		}

		public function edit(){

			if(IS_POST){
				$model = D('Devices');
				if($model->create(I('post.'),2)){
					if(false!==$model->save()){
						$this->success('修改成功',U('lst?p='.I('get.p')));
						exit;
					}
				}

				$this->error($model->getError());
			}

			$id = I('get.id');

			$model = D('Devices');

			$data = $model->find($id);
			// 取出所有的设备类型
	    	$typeModel = M('Type');
	    	$typeData = $typeModel->select();
	    	$this->assign('typeData', $typeData);
	    	// 取出所有的设备分类
	    	$catModel = D('Category');
	    	$catData = $catModel->getTree();
	    	$this->assign('catData', $catData);
	    	// 取出所有的品牌
	    	$brandModel = M('Brand');
	    	$brandData = $brandModel->select();

	    	// 取出当前设备扩展分类的数据
	    	$gcModel = M('DeviceCat');
	    	$extCatId = $gcModel->field('cat_id')->where(array('device_id'=>array('eq', $id)))->select();
	    	$this->assign('extCatId', $extCatId);
	    	
	    	// 取出当前设备的属性数据
	    	$gaModel = M('DeviceAttr');
	    	// SELECT a.*,b.attr_name FROM dev_device_attr a LEFT JOIN dev_attribute b ON a.attr_id=b.id
	    	$gaData = $gaModel->field('a.*,b.attr_name,b.attr_type,b.attr_option_values')->alias('a')->join('LEFT JOIN dev_attribute b ON a.attr_id=b.id')->where(array('a.device_id'=>array('eq', $id)))->order('a.attr_id ASC')->select();
	    	/**************************** 取出当前设备属性不存在的后添加的新的属性 **************************/
			// 循环属性数组取出当前设备已经拥有的属性ID
			$attr_id = array();
			foreach ($gaData as $k => $v)
			{
				$attr_id[] = $v['attr_id'];
			}
			$attr_id = array_unique($attr_id);
			// 取出当前类型下的后添加的新属性
			$attrModel = M('Attribute');
			$otherAttr = $allAttrId = $attrModel->field('id attr_id,attr_name,attr_type,attr_option_values')->where(array('type_id'=>array('eq', $data['type_id']), 'id'=>array('not in', $attr_id)))->select();
			if($otherAttr)
			{
				// 把新的属性和原属性合并起来
				$gaData = array_merge($gaData, $otherAttr);
				// 重新根据attr_id字段重新排序这个合并之后二维数组
				usort($gaData, 'attr_id_sort');
			}

	    	$this->assign('gaData', $gaData);
	    	$this->assign('brandData', $brandData);
			$this->assign('data',$data);
			//$this->setPageBtn('修改设备','设备列表',U('lst?p='.I('get.p')));
			$this->display();
		}

		public function delete(){
			$model = D('Devices');

			$model->delete(I('get.id'));

			$this->success('删除成功',U('lst?p='.I('get.p')));
		}

		// AJAX获取属性根据类型的ID
	    public function ajaxGetAttr()
	    {
	    	$typeId = I('get.type_id');
	    	$attrModel = M('Attribute');
	    	// 根据类型ID取属性
	    	$attrData = $attrModel->where(array('type_id'=>array('eq', $typeId)))->order('id ASC')->select();
			echo json_encode($attrData);
	    }
	}