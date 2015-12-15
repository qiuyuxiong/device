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


<!-- 列表 -->


<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
  
  <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a>
  <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('750','','添加账号','/device/index.php/Admin/Admin/add')"><i class="icon-plus"></i> 添加账号</a>
  </span> <span class="r">共有数据：<strong><?php echo count($data);?></strong> 条</span> </div>
  <table class="table table-border table-bordered table-bg">
    <thead>
      <tr>
        <th scope="col" colspan="7">员工列表</th>
      </tr>
      <tr class="text-c">
        <th width="25"><input type="checkbox" name="" value=""></th>
        <th width="40">ID</th>
        <th width="150">登录名</th>
        <th>密码</th>
        
        <th width="100">是否已启用</th>
        <th width="70">操作</th>
      </tr>
    </thead>
    <tbody>
      
        <?php foreach ($data as $k => $v): ?>            
			<tr class="text-c tron">
        <td><input type="checkbox" value="1" name=""></td>
				<td><?php echo $v['id']; ?></td>
				<td><?php echo $v['username']; ?></td>
				<td><?php echo $v['password']; ?></td>
				

	                <td class="admin-status is_use" style="cursor:pointer;" admin_id="<?php echo ($v["id"]); ?>"><?php echo $v['is_use']==1?'<span class="label label-success radius">启用</span>':'<span class="label radius">禁用</span>'; ?></td>
        <td class="f-14 admin-manage"><a title="编辑" href="javascript:;" onclick="admin_edit('1','750','','编辑','<?php echo U('edit?id='.$v['id'].'&p='.I('get.p'));?>')" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a> 
        <?php if($v['id']>1):?>
        <a title="删除" href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p',1)); ?>" onclick='return confirm("你确定要删除吗？");' class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
	            <?php endif;?>
		        </td>
	        </tr>
        <?php endforeach; ?> 
		
        
         
        
    </tbody>
  </table>
</div>
<script>
// 为启用的td加一个事件
$(".is_use").click(function(){
	// 先获取点击的记录的ID
	var id = $(this).attr("admin_id");
	if(id == 1)
	{
		alert("超级管理员不能修改！");
		return false;
	}
	var _this = $(this);
	$.ajax({
		type : "GET",
		// 默认U函数生成的地址是带.html后缀的：/index.php/Admin/Admin/ajaxUpdateIsuse.html/id/3，这样请求这个地址会报错无法请求，所以需要让U生成的地址不要带.html后缀
		// 也就是说，如果在AJAX时使用了U函数并且后面还要再传参数就需要设置第三个参数为FALSE不生成.html后缀
		url : "<?php echo U('ajaxUpdateIsuse', '', FALSE); ?>/id/"+id,
		success : function(data)
		{
			if(data == 0)
				_this.html("<span class='label radius'>禁用</span>");
			else
				_this.html("<span class='label label-success radius'>启用</span>");
		}
	});
});
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