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

﻿
<title>我的桌面</title>
</head>
<body>
<div class="pd-20" style="padding-top:20px;">
  <p class="f-20 text-success">欢迎使用设备信息管理系统</p>
  <p>登录用户：<?php echo session('username');?> </p>
  <p>登录IP：<?php echo ($server['REMOTE_ADDR']); ?>  登录时间：<?php echo ($server['time']); ?></p>

  <table class="table table-border table-bordered table-bg mt-20">
    <thead>
      <tr>
        <th colspan="2" scope="col">服务器信息</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th width="200">服务器计算机名</th>
        <td><span id="lbServerName"><?php echo ($server['SERVER_NAME']); ?></span></td>
      </tr>
      <tr>
        <td>服务器IP地址</td>
        <td><?php echo ($server['SERVER_ADDR']); ?></td>
      </tr>
      <tr>
        <td>服务器域名</td>
        <td><?php echo ($server['REQUEST_URI']); ?></td>
      </tr>
      <tr>
        <td>服务器端口 </td>
        <td><?php echo ($server['SERVER_PORT']); ?></td>
      </tr>
      <tr>
        <td>服务器版本 </td>
        <td><?php echo ($server['SERVER_SOFTWARE']); ?></td>
      </tr>
      <tr>
        <td>本文件所在文件夹 </td>
        <td><?php echo ($server['SCRIPT_FILENAME']); ?></td>
      </tr>
      <tr>
        <td>服务器操作系统 </td>
        <td><?php echo ($server['HTTP_USER_AGENT']); ?></td>
      </tr>
      <tr>
        <td>系统所在文件夹 </td>
        <td><?php echo ($server['SystemRoot']); ?></td>
      </tr>
      <tr>
        <td>服务器脚本超时时间 </td>
        <td><?php echo ($server['REMOTE_PORT']); ?>秒</td>
      </tr>
      
      
      <tr>
        <td>服务器当前时间 </td>
        <td><?php echo date('Y-m-d H:i:s');?></td>
      </tr>
    
      <tr>
        <td>当前SessionID </td>
        <td><?php echo ($server['HTTP_COOKIE']); ?></td>
      </tr>
      <tr>
        <td>当前系统用户名 </td>
        <td><?php echo session('username');?></td>
      </tr>
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