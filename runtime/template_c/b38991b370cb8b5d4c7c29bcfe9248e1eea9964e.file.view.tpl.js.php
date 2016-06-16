<?php /* Smarty version Smarty-3.1.11, created on 2016-05-23 13:36:33
         compiled from "..\static\script\modules\enterprise\view.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:29782574296e1646384-94772533%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b38991b370cb8b5d4c7c29bcfe9248e1eea9964e' => 
    array (
      0 => '..\\static\\script\\modules\\enterprise\\view.tpl.js',
      1 => 1458797089,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29782574296e1646384-94772533',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574296e16e6631_54657437',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574296e16e6631_54657437')) {function content_574296e16e6631_54657437($_smarty_tpl) {?>var request = eval($("span.request").text());
var request = request[0];
var e_id = request.e_id;
$("div.autoactive[action=view]").addClass("active");
$("#stop_status").click(function () {
        notice("<?php echo L('操作进行中');?>
");
        $.ajax({
                url: "?modules=enterprise&action=stop&e_id=" + e_id,
                dataType: "json",
                success: function (result) {
                        notice(result.msg, "?m=enterprise&a=view&e_id=" + e_id);
                }
        });
});
$("#start_status").click(function () {
        notice("<?php echo L('操作进行中');?>
");
        $.ajax({
                url: "?modules=enterprise&action=start&e_id=" + e_id,
                dataType: "json",
                success: function (result) {
                        notice(result.msg, "?m=enterprise&a=view&e_id=" + e_id);
                }
        });
});
$("#initdb").click(function () {
        $("#dialog-confirm-warn").dialog({
                resizable: false,
                width: 440,
                height: 240,
                modal: true,
                buttons: {
                        "重建": function () {
                                notice("<?php echo L('正在重建中，请稍候');?>
");
                                $(this).dialog("close");
                                $.ajax({
                                        url: "?modules=enterprise&action=initdb&e_id=" + e_id,
                                        dataType: "json",
                                        success: function (result) {
                                                notice(result.msg);
                                        }
                                });
                        },
                        "取消": function () {
                                $(this).dialog("close");
                        }
                }
        });
});

//企业迁移操作按钮点击事件
$("#move_enterprise").click(function(){
    $("span[name=notice]").remove();
    var e_id = $("#e_id").val();
    //获取符合迁移条件的代理
    $.ajax({
        url: "?modules=enterprise&action=move_enterprise",
        dataType: "json",
        data: {e_id:e_id},
        success: function (data) {
            if(data!='nothing'){
                //判断是否获取到符合条件的代理
                if(data.list.length>0){
                    var html = '<input type="hidden" id="e_id" value="'+e_id+'" />';
                    html+='<div style="height:130px;overflow-x:hidden;overflow:auto;">';
                    for(var i=0; i<data.list.length; i++){
                        html+='<div>';
                        html+='<input type="radio" onclick="removeNotice()" name="e_agents_id" value="'+data.list[i].ag_number+'" ag_name="'+data.list[i].ag_name+'" />'+data.list[i].ag_name+'&nbsp;&nbsp;&nbsp;';
                        html+='</div>';
                    }
                    html+="</div>";
                    $("#dialog-move").html(html); 
                }else{
                    notice("<?php echo L('未获取到符合迁移条件的代理');?>
");
                    exit();
                }
            }else{
                notice("<?php echo L('企业代理为二级代理，运营管理员没有权限进行迁移操作');?>
");
                exit();
            }
        }
    });

    //显示符合迁移条件的代理弹出框
    $("#dialog-move").dialog({
        resizable: false,
        width: 400,
        height: 250,
        modal: true,
        buttons: {
        "<?php echo L('确认');?>
": function () {
            //获取选中的代理商的id 
            var  e_agents_id= $("input[name=e_agents_id]:radio:checked").val();
            if(!e_agents_id){
                if($("span[name=notice]").length<1){
                    var notice = "<?php echo L('请选择要迁移到的代理');?>
";
                    $("<span name='notice' style='color:red;'>*"+notice+"</span>").insertBefore(".ui-dialog-buttonset");
                }
                exit();
            }
            var ag_name = $("input[name=e_agents_id]:radio:checked").attr("ag_name");
            //点击确认弹出确认迁移的弹出层
            $(this).dialog("close");
            $("#notice").html("<?php echo L('迁移目标为');?>
"+"：【"+ag_name+"】");
            $("#dialog-notice").dialog({
                resizable: false,
                width: 400,
                height: 180,
                modal: true,
                buttons: {
                //进行迁移操作
                "<?php echo L('迁移');?>
": function () {
                    //点击确认迁移进行的操作
                    $(this).dialog("close");
                    $.ajax({
                        url: "?modules=enterprise&action=change_enterprise",
                        data: {e_id:e_id,e_agents_id:e_agents_id},
                        success: function (result) {
                            if(result=='yes'){
                               layer.msg("<?php echo L('迁移成功');?>
 ",{
                                    icon: 1,
                                    time: 2000, //2秒关闭（如果不配置，默认是3秒）
                                },function(){
                                    location.replace("?m=enterprise&a=index");
                                }); 
                            }else{
                                notice("<?php echo L('迁移失败请检查后重试');?>
");
                                exit();
                            }
                        }
                    });
                },
                    "<?php echo L('取消');?>
": function () {
                        $(this).dialog("close");
                    }
                }
            });
        },
            "<?php echo L('取消');?>
": function () {
                $(this).dialog("close");
            }
        }
    });
})

//分配代理时的提示信息清除
function removeNotice(){
    $("span[name=notice]").remove();
}<?php }} ?>