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
    <form class="Huiform" name='main_form' method="post" action="/device/index.php/Admin/Role/add.html">
        
      <input type="text" placeholder="角色名称" name="role_name" autocomplete="off" value="" class="input-text" style=" width:150px"><br />

      <span style="margin-left:-75px;">权限列表:</span><br />
      
        <?php foreach($priData as $k=>$v):?>
                    <?php echo str_repeat('&nbsp;',$v['level']*6);?>
                    <input level="<?php echo ($v["level"]); ?>" type="checkbox" name="pri_id[]" value="<?php echo ($v["id"]); ?>" /><?php echo ($v["pri_name"]); ?><br />
        <?php endforeach;?>
        
      <input type="submit" class="btn btn-success" value="添加" />
      <input type="reset" class="btn" value="重置" />

    </form>
  </div>
  </div>
<script>
// 让提交只能点一次
$(":submit").click(function(){
    var sec = 3;
    $(this).attr('disabled', 'disabled');
    $(this).val(sec + "秒之后提交");
    var _this = $(this);
    setInterval(function(){
        if(--sec==0)
            $("form[name=main_form]").submit();
        else
            _this.val(sec + "秒之后提交");
        _this.val();
    }, 1000);

});

// 为所有的选择框绑定点击事件
$(":checkbox").click(function(){
    // 先取出当前权限的level值是多少
    var cur_level = $(this).attr("level");
    // 判断是选中还是取消
    if($(this).attr("checked"))
    {
        var tmplevel = cur_level; // 给一个临时的变量后面要进行减操作
        // 先取出这个复选框所有前面的复选框
        var allprev = $(this).prevAll(":checkbox");
        // 循环每一个前面的复选框判断是不是上级的
        $(allprev).each(function(k,v){
            // 判断是不是上级的权限
            if($(v).attr("level") < tmplevel)
            {
                tmplevel--; // 再向上提一级
                $(v).attr("checked", "checked");
            }
        });
        // 所有子权限也选中
        // 先取出这个复选框所有前面的复选框
        var allprev = $(this).nextAll(":checkbox");
        // 循环每一个前面的复选框判断是不是上级的
        $(allprev).each(function(k,v){
            // 判断是不是上级的权限
            if($(v).attr("level") > cur_level)
                $(v).attr("checked", "checked");
            else
                return false;   // 遇到一个平级的权限就停止循环后面的不用再判断了
        });
    }
    else
    {
        // 先取出这个复选框所有前面的复选框
        var allprev = $(this).nextAll(":checkbox");
        // 循环每一个前面的复选框判断是不是上级的
        $(allprev).each(function(k,v){
            // 判断是不是上级的权限
            if($(v).attr("level") > cur_level)
                $(v).removeAttr("checked");
            else
                return false;   // 遇到一个平级的权限就停止循环后面的不用再判断了
        });
    }
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