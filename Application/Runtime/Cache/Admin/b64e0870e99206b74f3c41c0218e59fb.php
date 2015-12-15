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


<div class="pd-20">
<div class="text-c">
    <form class="Huiform" method="post" action="/device/index.php/Admin/Admin/edit/id/1.html">
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        <span style="margin-left:-100px;">所在角色:</span><br />
        <?php foreach($roleData as $k=>$v):?>
                       <?php if(strpos(','.$rid.',',','.$v['id'].',')!==false){ $check = 'checked="checked"'; }else{ $check = ''; } ?>
                        <input <?php echo ($check); ?>  type="checkbox" name="role_id[]" value="<?php echo ($v["id"]); ?>" /><?php echo ($v["role_name"]); ?>
                        <?php  if(($k+1)%4==0){ echo "<br />"; } ?>
                    <?php endForeach;?>
        <br />
      <input type="text" placeholder="帐号" name="username" autocomplete="off" value="<?php echo $data['username']; ?>" class="input-text" style=" width:150px"><br /><br />
      <input type="password" name="password" placeholder="密码" autocomplete="off" value="" class="input-text" style="width:150px;"><br /><br />
      
        <span>是否启用：</span>
                    <input type="radio" name="is_use" value="1" <?php if($data['is_use'] == '1') echo 'checked="checked"'; ?> />启用 
                    <input type="radio" name="is_use" value="0" <?php if($data['is_use'] == '0') echo 'checked="checked"'; ?> />禁用 
                <br /><br />
        
        
      <input type="submit" class="btn btn-success" value="修改" />
      <input type="reset" class="btn" value="重置" />

    </form>
  </div>
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