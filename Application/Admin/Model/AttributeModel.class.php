<?php
namespace Admin\Model;
use Think\Model;
class AttributeModel extends Model 
{
	protected $insertFields = array('attr_name','attr_type','attr_option_values','type_id');
	protected $updateFields = array('id','attr_name','attr_type','attr_option_values','type_id');
	protected $_validate = array(
		array('attr_name', 'require', '属性名称不能为空！', 1, 'regex', 3),
		array('attr_name', '1,30', '属性名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('attr_type', 'number', '属性的类型0：唯一 1：可选必须是一个整数！', 2, 'regex', 3),
		array('attr_option_values', '1,150', '属性的可选值，多个可选值用，隔开的值最长不能超过 150 个字符！', 2, 'length', 3),
		array('type_id', 'require', '所在的类型的id不能为空！', 1, 'regex', 3),
		array('type_id', 'number', '所在的类型的id必须是一个整数！', 1, 'regex', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($attr_name = I('get.attr_name'))
			$where['attr_name'] = array('like', "%$attr_name%");
		if($attr_type = I('get.attr_type'))
			$where['attr_type'] = array('eq', $attr_type);
		if($attr_option_values = I('get.attr_option_values'))
			$where['attr_option_values'] = array('like', "%$attr_option_values%");
		if($type_id = I('get.type_id'))
			$where['type_id'] = array('eq', $type_id);
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
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
	}
	// 删除前
	protected function _before_delete($option)
	{
		if(is_array($option['where']['id']))
		{
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
	/************************************ 其他方法 ********************************************/
}