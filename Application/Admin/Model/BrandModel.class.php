<?php
namespace Admin\Model;
use Think\Model;
class BrandModel extends Model 
{
	protected $insertFields = array('brand_name','site_url');
	protected $updateFields = array('id','brand_name','site_url');
	protected $_validate = array(
		array('brand_name', 'require', '设备品牌名称不能为空！', 1, 'regex', 3),
		array('brand_name', '1,45', '设备品牌名称的值最长不能超过 45 个字符！', 1, 'length', 3),
		array('site_url', 'require', '设备品牌网站地址不能为空！', 1, 'regex', 3),
		array('site_url', '1,150', '设备品牌网站地址的值最长不能超过 150 个字符！', 1, 'length', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($brand_name = I('get.brand_name'))
			$where['brand_name'] = array('like', "%$brand_name%");
		if($site_url = I('get.site_url'))
			$where['site_url'] = array('like', "%$site_url%");
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
		if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0)
		{
			$ret = uploadOne('logo', 'Admin', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['logo'] = $ret['images'][0];
				$data['big_logo'] = $ret['images'][1];
				$data['mid_logo'] = $ret['images'][2];
				$data['sm_logo'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
		}
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
		if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0)
		{
			$ret = uploadOne('logo', 'Admin', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['logo'] = $ret['images'][0];
				$data['big_logo'] = $ret['images'][1];
				$data['mid_logo'] = $ret['images'][2];
				$data['sm_logo'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
			deleteImage(array(
				I('post.old_logo'),
				I('post.old_big_logo'),
				I('post.old_mid_logo'),
				I('post.old_sm_logo'),
	
			));
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
		$images = $this->field('logo,big_logo,mid_logo,sm_logo')->find($option['where']['id']);
		deleteImage($images);
	}
	/************************************ 其他方法 ********************************************/
}