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


<center>
<div class="pd-20">
    <div id="text-c">
        <p>
            <span class="tab-front btn-success input-text" style="cursor:pointer;">基本信息</span>
            <span class="tab-back btn-success input-text" style="cursor:pointer;">设备描述</span>
            
            <span class="tab-back btn-success input-text" style="cursor:pointer;">设备属性</span>
            
        </p>
    </div>
    <div id="tabbody-div">
        <form name="main_form" align="center" class="Huiform" method="POST" action="/device/index.php/Admin/Device/add" enctype="multipart/form-data">
            <!-- 基本信息 -->
            <table class="table_content" cellspacing="1" cellpadding="3" width="100%">
                <tr>
                    
                    <td>
                        <input type="text" placeholder="设备名称" name="device_name" autocomplete="off" class="input-text" style=" width:150px">
                    </td>
                </tr>
                <tr>
                   
                    <td>
                        <input type="text" placeholder="设备数量" name="device_number" autocomplete="off" class="input-text" style=" width:150px">
                    </td>
                </tr>
                <tr>
                    
                    <td>
                    <span>设备图片：</span>
                        <input size="60" type="file" name="device_img" value="" autocomplete="off"  style=" width:150px"/>
                        
                    </td>
                </tr>
                <tr>
                    
                    <td>
                    <span style="margin-left:-70px">设备分类：</span>
                        <select name="cat_id">
                            <option value="">选择分类</option>
                            <?php foreach ($catData as $k => $v): ?>
                                <option value="<?php echo ($v["id"]); ?>"><?php echo str_repeat('&nbsp;',$v['level'] * 6); echo ($v["cat_name"]); ?></option>
                            <?php endforeach; ?>
                        </select>
                        
                    </td>
                </tr>
                <tr>
                    
                    <td>
                        <span style="margin-left:-33px">扩展分类：</span>
                        <input onclick="$(this).parent().append($(this).next('select').clone());" type="button" class="btn-success" value="添加" />
                        <select name="ext_cat_id[]">
                            <option value="">选择分类</option>
                            <?php foreach ($catData as $k => $v): ?>
                                <option value="<?php echo ($v["id"]); ?>"><?php echo str_repeat('&nbsp;',$v['level'] * 6); echo ($v["cat_name"]); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    
                    <td>
                        <span style="margin-left:-35px">品牌：</span>
                        <select name="brand_id">
                            <option value="">选择品牌</option>
                            <?php foreach ($brandData as $k => $v): ?>
                                <option value="<?php echo ($v["id"]); ?>"><?php echo ($v["brand_name"]); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>

                
            </table>
            <!-- 描述 -->
            <table class="table_content" cellspacing="1" cellpadding="3" width="100%" style="display:none;">
                <tr>
                    <td>
                        <textarea id="device_desc" name="device_desc"></textarea>
                    </td>
                </tr>
            </table>
          
            <!-- 属性 -->
            <table class="table_content" cellspacing="1" cellpadding="3" width="100%" style="display:none;">
                <tr><td>
                设备类型：<select name="type_id">
                    <option value="">选择类型</option>
                    <?php foreach ($typeData as $k => $v): ?>
                        <option value="<?php echo ($v["id"]); ?>"><?php echo ($v["type_name"]); ?></option>
                    <?php endforeach; ?>
                </select>
                </td></tr>
                <tr><td id="attr_container"></td></tr>
            </table>
            
            <table cellspacing="1" cellpadding="3" width="100%">
                <tr>
                    <td align="center">
                        <input type="submit" class="btn btn-success" value="添加" />
                        <input type="reset" class="btn" value="重置" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
</center>
<script>
// 点击按钮切换table
$("div#text-c p span").click(function(){
    // 获取点击的是第几个按钮
    var i = $(this).index();
    // 显示第i个table
    $(".table_content").eq(i).show();
    // 隐藏其他的table
    $(".table_content").eq(i).siblings(".table_content").hide();
    // 把原来选中的取消选中状态
    $(".tab-front").removeClass("tab-front").addClass("tab-back");
    // 切换点击的按钮的样式为选中状态
    $(this).removeClass("tab-back").addClass("tab-front");
});

$("#promote_start_time").datepicker(); 
$("#promote_end_time").datepicker(); 
UE.getEditor('device_desc', {
    "initialFrameWidth" : "100%",   // 宽
    "initialFrameHeight" : 400,      // 高
    "maximumWords" : 10000            // 最大可以输入的字符数量
});

// 当选择类型时执行AJAX取出类型的属性
$("select[name=type_id]").change(function(){
    // 获取选中的类型的id
    var type_id = $(this).val();
    if(type_id != "")
    {
        $.ajax({
            type : "GET",
            // 大U生成的地址默认带后缀，如：/index.php/Admin/device/ajaxGetAttr.html/type_id/+type_id
            // 第三个参数就是去掉.html后缀否则TP会报错
            url : "<?php echo U('ajaxGetAttr', '', FALSE); ?>/type_id/"+type_id,
            dataType : "json",
            success : function(data)
            {
                var html = "";
                // 循环服务器返回的属性的JSON数据
                $(data).each(function(k,v){
                    html += "<p>";
                    html += v.attr_name + " : ";
                    // 根据属性的类型生成不同的表单元素：
                    // 1. 如果属性是可选的那么就有一个+号
                    // 2. 如果属性有可选值就是一个下拉框
                    // 3. 如果属性是唯一的就生成一个文本框
                    if(v.attr_type == 1)
                        html += " <a onclick='addnew(this);' href='javascript:void(0);'>[+]</a> ";
                    // 判断是否有可选值
                    if(v.attr_option_values == "")
                        html += "<input type='text' name='ga["+v.id+"][]' class='input-text' style='width:150px' />";
                    else
                    {
                        // 先把可选值转化成数组
                        var _attr = v.attr_option_values.split(",");
                        html += "<select name='ga["+v.id+"][]'>";
                        html += "<option value=''>请选择</option>";
                        // 循环每个可选值构造option
                        for(var i=0; i<_attr.length; i++)
                        {
                            html += "<option value='"+_attr[i]+"'>"+_attr[i]+"</option>";
                        }
                        html += "</select>";
                    }
                   
                    html += "</p>";
                });
                $("#attr_container").html(html);
            }
        }); 
    }
    else
        $("#attr_container").html("");
});

// 点击+号
function addnew(a)
{
    // 选中a标签所在的p标签
    var p = $(a).parent();
    // 先获取A标签中的内容
    if($(a).html() == "[+]")
    {
        // 把p克隆一份
        var newP = p.clone();
        // 把克隆出来的P里面的a标签变成-号
        newP.find("a").html("[-]");
        // 放在后面
        p.after(newP);
    }
    else
        p.remove();
}
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