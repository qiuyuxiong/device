<?php

	namespace Admin\Model;
	use Think\Model;

	class DevicesModel extends Model{


		protected $insertFields = array('device_name','device_number','cat_id','brand_id','type_id','is_delete','device_desc');
		protected $updateFields = array('id','device_name','device_number','cat_id','brand_id','type_id','is_delete','device_desc');
		protected $_validate = array(
			array('device_name', 'require', '设备名称不能为空！', 1, 'regex', 3),
			array('device_name', '1,45', '设备名称的值最长不能超过 45 个字符！', 1, 'length', 3),
			array('device_number', 'number', '设备数量只能是整数！', 1, 'regex', 3),
			array('cat_id', 'require', '主分类的id不能为空！', 1, 'regex', 3),
			array('cat_id', 'number', '主分类的id必须是一个整数！', 1, 'regex', 3),
			array('brand_id', 'number', '品牌的id必须是一个整数！', 2, 'regex', 3),
			
			array('type_id', 'number', 'y设备类型id必须是一个整数！', 2, 'regex', 3),
			
			array('is_delete', 'number', '是否放到回收站：1：是，0：否必须是一个整数！', 2, 'regex', 3),
		);
		



		// 后台的设备列表时搜索的方法
		public function search($pageSize = 5, $isDelete = 0)
		{
			/**************************************** 搜索 ****************************************/
			// 是否是回收站的设备
			//$where['is_delete'] = array('eq', $isDelete);
			if($device_name = I('get.device_name'))
				$where['device_name'] = array('like', "%$device_name%");
			if($cat_id = I('get.cat_id'))
				$where['cat_id'] = array('eq', $cat_id);
			if($brand_id = I('get.brand_id'))
				$where['brand_id'] = array('eq', $brand_id);
			
			if($type_id = I('get.type_id'))
				$where['type_id'] = array('eq', $type_id);
			//数量的搜索
			$start_number = I('get.start_number');
			$end_number = I('get.end_number');
			if($start_number && $end_number){
				$where['device_number'] = array('between',array($start_number,$end_number));
			}elseif($start_number){
				$where['device_number'] = array('egt',$start_number);
			}elseif($end_number){
				$where['device_number'] = array('elt',$end_number);
			}
			//是否删除的搜索
			$is_delete = I('get.is_delete',-1);
			if($is_delete!=-1){
				$where['is_delete'] = array('eq',$is_delete);
			}

			/****排序*****/

			$orderby = 'id';
			$orderway = 'asc';
			$odby = I('get.odby');
			if($odby && in_array($odby,array('id_asc','id_desc','device_number_asc','device_number_desc'))){
				if($odby == 'id_desc'){
					$orderway = 'desc';
				}elseif($odby=='device_number_asc'){
					$orderby = 'device_number';
				}elseif($odby=='device_number_desc'){
					$orderby = 'device_number';
					$orderway = 'desc';
				}
			}
			$startaddtime = I('get.start_addtime');
			$endaddtime = I('get.end_addtime');
			if($startaddtime && $endaddtime)
				$where['addtime'] = array('between', array(strtotime("$startaddtime 00:00:00"), strtotime("$endaddtime 23:59:59")));
			elseif($startaddtime)
				$where['addtime'] = array('egt', strtotime("$startaddtime 00:00:00"));
			elseif($endaddtime)
				$where['addtime'] = array('elt', strtotime("$endaddtime 23:59:59"));
			/************************************* 翻页 ****************************************/
			$count = $this->alias('a')->where($where)->count();
			$page = new \Think\Page($count,$pageSize);
			// 配置翻页的样式
			$page->setConfig('prev', '上一页');
			$page->setConfig('next', '下一页');
			$data['page'] = $page->show();
			/************************************** 取数据 ******************************************/
			$data['data'] = $this->where($where)->limit($page->firstRow.','.$page->listRows)->order("$orderby $orderway")->select();
			return $data;
		}
		// 添加前
		protected function _before_insert(&$data, $option)
		{
			// 获取当前时间存到数据库中
			$data['addtime'] = time();
			
			if(isset($_FILES['device_img']) && $_FILES['device_img']['error'] == 0)
			{
				$ret = uploadOne('device_img', 'devices', array(
					array(150, 150, 2),
				));
				if($ret['ok'] == 1)
				{
					$data['device_img'] = $ret['images'][0];
					$data['sm_img'] = $ret['images'][1];
				}
				else 
				{
					$this->error = $ret['error'];
					return FALSE;
				}
			}
		}
		// 设备基本信息插入到数据库中之后
		protected function _after_insert($data, $option)
		{
			/**************** 处理设备的扩展分类 ********************/
			$eci = I('post.ext_cat_id');
			if($eci)
			{
				$gcModel = M('DeviceCat');
				foreach ($eci as $v)
				{
					// 如果分类为空就跳过处理下一个
					if(empty($v))
						continue;
					$gcModel->add(array(
						'device_id' => $data['id'],
						'cat_id' => $v,
					));
				}
			}
			
			/******************** 处理设备属性的数据 *********************/
			$ga = I('post.ga');
			
			if($ga)
			{
				$gaModel = M('DeviceAttr');
				foreach ($ga as $k => $v)
				{
					foreach ($v as $k1 => $v1)
					{
						if(empty($v1))
							continue ;
						
						$gaModel->add(array(
							'device_id' => $data['id'],
							'attr_id' => $k,
							'attr_value' => $v1,
							
						));
					}
				}
			}
			
		}
		// 修改前
		protected function _before_update(&$data, $option)
		{
			/************* 判断设备类型有没有被修改， 如果修改了类型，那么就删除原来的设备属性 ***************/
			// 先取出原来的类型是什么
			if(I('post.old_type_id') != $data['type_id'])
			{
				// 删除当前设备所有之前的属性
				$gaModel = M('DeviceAttr');
				$gaModel->where(array('device_id'=>array('eq', $option['where']['id'])))->delete();
			}
			
			if(isset($_FILES['device_img']) && $_FILES['device_img']['error'] == 0)
			{
				$ret = uploadOne('device_img', 'devices', array(
					array(150, 150, 2),
				));
				if($ret['ok'] == 1)
				{
					$data['device_img'] = $ret['images'][0];
					$data['sm_img'] = $ret['images'][1];
				}
				else 
				{
					$this->error = $ret['error'];
					return FALSE;
				}
				deleteImage(array(
					I('post.old_device_img'),
					I('post.old_sm_img'),
		
				));
			}
		}
		// 在修改了设备表的基本信息之后
		protected function _after_update($data, $option)
		{
			/**************** 处理设备的扩展分类 ********************/
			$eci = I('post.ext_cat_id');
			$gcModel = M('DeviceCat');
			// 先清除设备原扩展分类数据
			$gcModel->where(array('device_id'=>array('eq', $option['where']['id'])))->delete();
			// 如果有新的数据就再添加一遍
			if($eci)
			{
				foreach ($eci as $v)
				{
					// 如果分类为空就跳过处理下一个
					if(empty($v))
						continue;
					$gcModel->add(array(
						'device_id' => $option['where']['id'],
						'cat_id' => $v,
					));
				}
			}
			
			/****************************** 修改设备属性的代码 ***************************/
			// 处理新属性
			$ga = I('post.ga');
			
			$gaModel = M('DeviceAttr');
			if($ga)
			{
				foreach ($ga as $k => $v)
				{
					foreach ($v as $k1 => $v1)
					{
						if(empty($v1))
							continue ;
						
						$gaModel->add(array(
							'device_id' => $option['where']['id'],
							'attr_id' => $k,
							'attr_value' => $v1,
							
						));
					}
				}
			}
			// 处理原属性
			$oldga = I('post.old_ga');
			
			// 循环所更新一遍所有的旧属性
			foreach ($oldga as $k => $v)
			{
				foreach ($v as $k1 => $v1)
				{
					// 要修改的字段
					$oldField = array('attr_value' => $v1);
					
					
					$gaModel->where(array('id'=>array('eq', $k1)))->save($oldField);
				}
			}
		}
		// 删除前
		protected function _before_delete($option)
		{
			if(is_array($option['where']['id']))
			{
				$this->error = '不支持批量删除';
				return FALSE;
			}
			$images = $this->field('device_img,sm_img')->find($option['where']['id']);
			deleteImage($images);
			/****************************** 先删除设备的其他的信息 ********************************/
			// 扩展分类
			$model = M('DeviceCat');
			$model->where(array('device_id'=>array('eq', $option['where']['id'])))->delete();
			
			// 设备属性
			$model = M('DeviceAttr');
			$model->where(array('device_id'=>array('eq', $option['where']['id'])))->delete();
			
			$model->where(array('device_id'=>array('eq', $option['where']['id'])))->delete();
		}
		/************************************ 其他方法 ********************************************/
		
		/**
		 * 转化设备属性ID为设备属性字符串
		 *
		 */
		public function convertDeviceAttrIdToDeviceAttrStr($gaid)
		{
			if($gaid)
			{
				$sql = 'SELECT GROUP_CONCAT( CONCAT( b.attr_name,  ":", a.attr_value ) SEPARATOR  "<br />" ) gastr FROM dev_device_attr a LEFT JOIN dev_attribute b ON a.attr_id = b.id WHERE a.id IN ('.$gaid.')';
				$ret = $this->query($sql);
				return $ret[0]['gastr'];
			}
			else 
				return '';
		}
		// 前台设备搜索功能使用的方法
	
	}









		