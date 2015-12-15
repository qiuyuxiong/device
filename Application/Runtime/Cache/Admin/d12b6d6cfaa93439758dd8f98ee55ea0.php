<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<title>设备信息管理中心 - <?php echo ($_page_title); ?> </title>

<!--[if lt IE 9]>
<script type="text/javascript" src="/device/Public/Admin/lib/html5.js"></script>
<script type="text/javascript" src="/device/Public/Admin/lib/respond.min.js"></script>
<script type="text/javascript" src="/device/Public/Admin/lib/PIE_IE678.js"></script>
<![endif]-->
<script type="text/javascript" charset="utf-8" src="/device/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/device/Public/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/device/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" language="javascript" src="/device/Public/datepicker/jquery-1.7.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/device/Public/datepicker/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/device/Public/datepicker/datepicker_zh-cn.js"></script>
<link href="/device/Public/Admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/device/Public/Admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/device/Public/Admin/lib/iconfont/iconfont.css" rel="stylesheet" type="text/css" />
<link href="/device/Public/Admin/lib/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/device/Public/Admin/css/page.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]>
<link href="/device/Public/Admin/lib/font-awesome/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if IE 6]>
<script type="text/javascript" src="/device/Public/Admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->



<title>属性列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 首页 <span class="c-gray en">&gt;</span> 属性管理 <span class="c-gray en">&gt;</span> 属性列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
	 <div class="text-c"> 
	 <form action="" method="get">
	 <p>
按商品类型显示：<select onchange="location.href='/device/index.php/Admin/Attribute/lst/type_id/'+this.value;">
	<option value="">选择类型</option>
	<?php foreach ($typeData as $k => $v): if($v['id'] == $typeId) $select = 'selected="selected"'; else $select = ''; ?>
	<option <?php echo ($select); ?> value="<?php echo ($v["id"]); ?>"><?php echo ($v["type_name"]); ?></option>
	<?php endforeach; ?>
</select>
</p>
    <input type="text" class="input-text" style="width:250px" placeholder="输入属性名称" id="" name="attr_name" value="<?php echo I('get.attr_name'); ?>">
    <input type="text" class="input-text" style="width:270px" placeholder="属性的类型0：唯一 1：可选" id="" name="attr_type" value="<?php echo I('get.attr_type'); ?>"><br />
    <input type="text" class="input-text" style="width:270px" placeholder="属性的可选值，多个可选值用，隔开" id="" name="attr_option_values" value="<?php echo I('get.attr_option_values'); ?>">
    <input type="text" class="input-text" style="width:250px" placeholder="所在的类型的id" id="" name="type_id" value="<?php echo I('get.type_id'); ?>"><br />
    <input type="submit" class="btn btn-success" value="搜属性" />
    </form>
  </div>
  <div class="cl pd-5 bg-1 bk-gray">
    <span class="l">
      <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a>
      <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('750','','添加属性','/device/index.php/Admin/Attribute/add')"><i class="icon-plus"></i> 添加属性</a>
    </span>
    <span class="r">共有数据：<strong><?php echo count($data);?></strong> 条</span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr>
        <th scope="col" colspan="7">属性管理</th>
      </tr>
      <tr class="text-c">
        <th width="25"><input type="checkbox" value="" name=""></th>
        <th width="40">ID</th>
        <th >属性名称</th>
            <th >属性的类型0：唯一 1：可选</th>
            <th >属性的可选值，多个可选值用，隔开</th>
            <th >所在的类型的id</th>
			<th width="60">操作</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $k => $v): ?>
      <tr class="text-c tron">
        <td><input type="checkbox" value="" name=""></td>
        <td><?php echo $v['id']; ?></td>
        <td><?php echo $v['attr_name']; ?></td>
				<td><?php echo $v['attr_type']; ?></td>
				<td><?php echo $v['attr_option_values']; ?></td>
				<td><?php echo $v['type_id']; ?></td>
        <td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('1','750','','类型编辑','<?php echo U("edit?id=".$v["id"]."&p=".I("get.p",1)); ?>')" style="text-decoration:none"><i class="icon-edit"></i></a> <a title="删除" href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p',1)); ?>" onclick='return confirm("你确定要删除吗？");' class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
      </tr>
  <?php endforeach;?>
   		<?php if(preg_match('/\d/', $page)): ?>  
        <tr><td align="right" nowrap="true" colspan="99" height="30"><?php echo $page; ?></td></tr> 
        <?php endif; ?>
    </tbody>
  </table>
</div>


<footer class="footer">

版权所有 &copy; 设备信息管理中心所有，并保留所有权利。</footer>
</body>
</html>
<script type="text/javascript" src="/device/Public/Admin/lib/jquery.min.js"></script> 
<script type="text/javascript" src="/device/Public/Admin/lib/Validform_v5.3.2.js"></script> 
<script type="text/javascript" src="/device/Public/Admin/lib/layer1.8/layer.min.js"></script> 
<script type="text/javascript" src="/device/Public/Admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/device/Public/Admin/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="/device/Public/Admin/js/H-ui.admin.doc.js"></script>
<script type="text/javascript" charset="utf-8" src="/device/Public/Admin/js/tron.js"></script>