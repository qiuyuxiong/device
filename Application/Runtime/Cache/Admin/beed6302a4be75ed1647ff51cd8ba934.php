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



<title>设备列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 首页 <span class="c-gray en">&gt;</span> 设备管理 <span class="c-gray en">&gt;</span> 设备列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
     <div class="text-c"> 
     <form action="" method="get">
    <input type="hidden" name="p" value="1" />
    <input type="text" class="input-text" style="width:250px" placeholder="输入设备名称" id="" name="device_name" value="<?php echo I('get.device_name'); ?>">
    <input type="text" class="input-text" style="width:250px" placeholder="输入起始数量" id="" name="start_number" value="<?php echo I('get.start_number'); ?>">~<input type="text" class="input-text" style="width:250px" placeholder="输入结束数量" id="" name="end_number" value="<?php echo I('get.end_number'); ?>"><br />

        <input type="text" class="input-text" style="width:250px" placeholder="输入主分类的id" id="" name="cat_id" value="<?php echo I('get.cat_id'); ?>">

        <input type="text" class="input-text" style="width:250px" placeholder="输入品牌的id" id="" name="brand_id" value="<?php echo I('get.brand_id'); ?>">

        <input type="text" class="input-text" style="width:250px" placeholder="输入设备类型id" id="" name="type_id" value="<?php echo I('get.type_id'); ?>"><br />
            
    
     <input type="text" class="input-text" style="width:250px" placeholder="输入起始时间" id="start_addtime" name="start_addtime" value="<?php echo I('get.start_addtime'); ?>">~<input type="text" class="input-text" style="width:250px" placeholder="输入结束时间" id="end_addtime" name="end_addtime" value="<?php echo I('get.end_addtime'); ?>">
        是否删除：<input type="radio" class="input-radio" name="is_delete" value="-1" <?php if(I('get.is_delete', -1) == -1) echo 'checked="checked"'; ?> />全部
                <input type="radio" class="input-radio" name="is_delete" value="1" <?php if(I('get.is_delete', -1) == 1) echo 'checked="checked"'; ?> />是
                <input type="radio" class="input-radio" name="is_delete" value="0" <?php if(I('get.is_delete', -1) == 0) echo 'checked="checked"'; ?> />否

        <input type="submit" class="btn btn-success" value="搜设备" /><br />
                
        排序方式：<input onclick="parentNode.submit();" type="radio" name="odby" value="id_asc" <?php if(I('get.odby', 'id_asc') == 'id_asc') echo 'checked="checked"'; ?> />根据添加时间升序
                <input onclick="parentNode.submit();" type="radio" name="odby" value="id_desc" <?php if(I('get.odby') == 'id_desc') echo 'checked="checked"'; ?> />根据添加时间降序
        <input onclick="parentNode.submit();" type="radio" name="odby" value="device_number_asc" <?php if(I('get.odby') == 'device_number_asc') echo 'checked="checked"'; ?> />根据数量升序
        <input onclick="parentNode.submit();" type="radio" name="odby" value="device_number_desc" <?php if(I('get.odby') == 'device_number_desc') echo 'checked="checked"'; ?> />根据数量降序<br />
    
    </form>
  </div>
  <div class="cl pd-5 bg-1 bk-gray">
    <span class="l">
      <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a>
      <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('750','','添加设备','/device/index.php/Admin/Device/add')"><i class="icon-plus"></i> 添加设备</a>
    </span>
    <span class="r">共有数据：<strong><?php echo count($data);?></strong> 条</span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr>
        <th scope="col" colspan="9">设备管理</th>
      </tr>
      <tr class="text-c">
        <th width="25"><input type="checkbox" value="" name=""></th>
        <th>id</th>
        <th>添加时间</th>
        <th>设备名称</th>
        <th>设备图片</th>
        <th>设备数量</th>
        <th>设备描述</th>
        
        <th>是否删除</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $k => $v): ?>
     <tr class="text-c tron">
        <td><input type="checkbox" value="" name=""></td>
        <td><?php echo ($v["id"]); ?></td>
        <form action="/device/index.php/Admin/Device/lst.html?p=1&device_name=&start_number=&end_number=&cat_id=&brand_id=&type_id=&start_addtime=&end_addtime=&is_delete=-1&odby=id_asc/id/<?php echo ($v["id"]); ?>" method="get"></form>
        <td><?php echo date('Y-m-d H:i:s', $v['addtime']); ?></td>
        <td><?php echo ($v["device_name"]); ?></td>
        <td><img src="<?php echo (UPLOAD_IMG); ?>/<?php echo ($v["sm_img"]); ?>" /></td>
        <td><?php echo ($v["device_number"]); ?></td>
        <td><?php echo ($v["device_desc"]); ?></td>
        
        <td><?php echo $v['is_delete'] == 1 ? '是' : '否'; ?></td>
      
        <td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('1','750','','设备编辑','<?php echo U("edit?id=".$v["id"]."&p=".I("get.p",1)); ?>')" style="text-decoration:none"><i class="icon-edit"></i></a> <a title="删除" href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p',1)); ?>" onclick='return confirm("你确定要删除吗？");' class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
    </tr>
    <?php endforeach; ?>
    <tr><td colspan="9"><?php echo ($page); ?></td></tr>
    
    </tbody>
  </table>
</div>

<script>
$("#start_addtime").datepicker({ dateFormat: "yy-mm-dd" });
$("#end_addtime").datepicker({ dateFormat: "yy-mm-dd" });
</script>

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