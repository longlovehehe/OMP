<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:25:48
         compiled from "..\static\script\modules\gprs\index.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:17382574cf62cad4db6-14989880%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '757cf0028f156f74907c309b2f4daaf57105c91f' => 
    array (
      0 => '..\\static\\script\\modules\\gprs\\index.tpl.js',
      1 => 1464656916,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17382574cf62cad4db6-14989880',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf62cbd6af9_47390557',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf62cbd6af9_47390557')) {function content_574cf62cbd6af9_47390557($_smarty_tpl) {?>/* The file is auto create */
function edit_gprs(obj,id,imei){
   var shtml = '<img class="save" src="images/save.png" onMouseOver="this.src=\'images/save_pass.png\'" onMouseOut="this.src=\'images/save.png\'"/>';
   var chtml = '<img class="cancel1" src="images/cancel1.png" onMouseOver="this.src=\'images/cancel1_pass.png\'" onMouseOut="this.src=\'images/cancel1.png\'"/>';
   var ehtml = '<img class="edit" src="images/edit.png" onMouseOver="this.src=\'images/edit_pass.png\'" onMouseOut="this.src=\'images/edit.png\'"/>';
   var dhtml = '<img class="delete" src="images/delete.png" onMouseOver="this.src=\'images/delete_pass.png\'" onMouseOut="this.src=\'images/delete.png\'"/>';
   $("td").children().prop("disabled","true");
   $("a").addClass("dis");
   $(obj).removeClass("dis");
   $(obj).next().removeClass("dis");
    $(obj).parent().parent().each(function(){
        $(this).children().children().removeAttr("disabled","");
        $(this).children().children().removeClass("inputnothing").addClass("inputfocs");
        $(obj).removeClass("inputfocs");
        $(obj).next().removeClass("inputfocs");
        $(obj).parent().next().children().removeClass("inputfocs").addClass("inputnothing");
        $(obj).parent().prev().children().removeClass("inputfocs").addClass("inputnothing");
        $(obj).parent().prev().prev().children().removeClass("inputfocs").addClass("inputnothing");
        $(obj).parent().prev().prev().prev().prev().prev().prev().prev().children().removeClass("inputfocs").addClass("inputnothing");
    }); 
    $("input[name=g_binding_user"+id+"]").attr("disabled","true");
    $("input[name=g_binding_user"+id+"]").css("border","none");
    $("input[name=md_time"+id+"]").attr("disabled","true");
    $("input[name=md_time"+id+"]").css("border","none");
   
    var select=$("input[name=select"+id+"]").val();
    $(obj).parent().prev().prev().prev().prev().html(select);
    var g_iccid=$("input[name=g_iccid"+id+"]").val();
    var g_imsi=$("input[name=g_imsi"+id+"]").val();
    var g_number=$("input[name=g_number"+id+"]").val();
    var g_id=$("input[name=g_id"+id+"]").val();
    var md_type=$("select[name=md_type"+id+"]").val();

    var md_type_name=$("input[name=md_type_name"+id+"]").val();
    var md_serial_number=$("input[name=md_serial_number"+id+"]").val();
    var tl_system_num=$("input[name=tl_system_num"+id+"]").val();
    var md_time=$("input[name=md_time"+id+"]").val();
    var md_id=$("input[name=md_id"+id+"]").val();
    $("select[name=md_type"+id+"]").change(function(){
        
       md_type_name=$("select[name=md_type"+id+"] option:selected").text();
        md_type=$("select[name=md_type"+id+"] option:selected").val();
        $("input[name=md_type_name"+id+"]").val(md_type_name);
        $("input[name=md_type"+id+"]").val(md_type);
    });
//ICCID验证
    var iccid_match = /^[0-9a-zA-Z]{19}$|^[0-9a-zA-Z]{20}$/i;
    var imsi_match = /^\s*$|^[0-9]{15}$/i;
    //var imsi_match = /^[0-9]{15}$/i;
    var number_match = /^\d+$/;
    //var number_match = /^\s*$|^1\d{10}$/;
    if(!iccid_match.test(g_iccid)){
        $(obj).html(shtml);
          var index=layer.tips("<?php echo L('请输入19或20位数字字母');?>
", $(obj).parent().prev().prev().prev().prev().prev().prev(),{
              tips:[1, '#A83A3A'],
          });
          return;
    }else if(!imsi_match.test(g_imsi)){
        $(obj).html(shtml);
          var index=layer.tips("<?php echo L('请输入15位数字');?>
", $(obj).parent().prev().prev().prev().prev().prev(),{
              tips:[1, '#A83A3A'],
          });
          return;
    }else if(!number_match.test(g_number)){
        $(obj).html(shtml);
          var index=layer.tips("<?php echo L('请输入正确手机号格式');?>
", $(obj).parent().prev().prev().prev().prev(),{
              tips:[1, '#A83A3A'],
          });
          return;
    }else{
        layer.closeAll('tips');
    }

    if($(obj).children().attr('class')=="save"){
        $.ajax({
            url:'?m=gprs&a=check_edit',
            data:{g_id:g_id,g_iccid:g_iccid,g_imsi:g_imsi,g_number:g_number},
            success:function(msg){
                if(msg==1){
                    var index=layer.tips("<?php echo L('此ICCID已存在');?>
", $(obj).parent().prev().prev().prev().prev().prev().prev(),{
                                  tips:[1, '#A83A3A'],
                              });
                }else if(msg==2){
                    var index=layer.tips("<?php echo L('此IMSI已存在');?>
", $(obj).parent().prev().prev().prev().prev().prev(),{
                                  tips:[1, '#A83A3A'],
                              });
                }else if(msg==3){
                    var index=layer.tips("<?php echo L('此Number已存在');?>
", $(obj).parent().prev().prev().prev().prev(),{
                                  tips:[1, '#A83A3A'],
                              });
                }else{
                    $.ajax({
                        url:'?m=gprs&a=save_gprs',
                        dataType:"json",
                        data:{g_id:g_id,g_iccid:g_iccid,g_imsi:g_imsi,g_number:g_number,do:"edit"},
                        success:function(msg){
                            if(msg.status==0){
                                layer.msg(msg.msg);
                                $(obj).parent().prev().prev().prev().prev().html(md_type_name);
                               $("input.cb").removeAttr("disabled");
                                $("a").removeClass("dis");
                                $("tr").each(function(){
                                    if($(this).children().eq(7).text()!=""&&$(this).children().eq(7).text()!="-"){
                                        $(this).children().eq(8).children().addClass("dis");
                                    }
                                });
                                var test = "ICCID:"+msg.info.g_iccid+"<br />IMSI:"+msg.info.g_imsi+"<br />Number:"+msg.info.g_number+"<br /><?php echo L('所属代理');?>
:"+msg.info.ag_name+"<br /><?php echo L('所属企业');?>
:"+msg.info.e_name+"<br /><?php echo L('系统号码');?>
:"+msg.info.ag_phone+"<br /><?php echo L('入库日期');?>
:"+msg.info.g_intime;
                                $(obj).parent().prev().prev().children().attr("title",test);
                                $(obj).parent().parent().each(function(){
                                    $(this).children().children().attr("disabled","true");
                                    $("input[name=g_id"+id+"]").prev().removeAttr("disabled");
                                    $(this).children().children().removeClass("inputfocs").addClass("inputnothing");
                                    $(obj).removeClass("inputnothing");
                                    $(obj).next().removeClass("inputnothing");
                                    $("a.tips_title").removeAttr("disabled");
                                    $(obj).html(ehtml);
                                    $(obj).next().html(dhtml);
                                    $(obj).next().attr("onclick","editStatus(this,'"+msg.info.g_iccid+"');");
                                    exit();
                                }); 
                            }else{
                                layer.msg(msg.msg);
                                $(this).children().children().removeClass("inputfocs").addClass("inputnothing");
                                $("input[name=g_id"+id+"]").prev().removeAttr("disabled");
                                $(obj).removeClass("inputnothing");
                                $("a.tips_title").removeAttr("disabled");
                                $(obj).next().removeClass("inputnothing");
                            }
                        }
                    });
                }
            }
        });

    }
    // $(obj).html("<?php echo L('保存');?>
");
    // $(obj).next().html("<?php echo L('取消');?>
");
    $(obj).html(shtml);
    $(obj).next().html(chtml);
    $(obj).next().attr("onclick","cancel(this,'"+id+"','"+imei+"');");
}

function cancel(obj,id,imei){
    var ehtml = '<img class="edit" src="images/edit.png" onMouseOver="this.src=\'images/edit_pass.png\'" onMouseOut="this.src=\'images/edit.png\'"/>';
    var dhtml = '<img class="delete" src="images/delete.png" onMouseOver="this.src=\'images/delete_pass.png\'" onMouseOut="this.src=\'images/delete.png\'"/>';
    $("input.cb").removeAttr("disabled");
    $("a").removeClass("dis");
    $(this).children().children().removeAttr("disabled","");
     var md_type_name=$("input[name=md_type_name"+id+"]").val();
     if($(obj).children().attr('class')=='cancel1'){
          $(obj).parent().prev().prev().prev().prev().html(md_type_name);
           $(obj).parent().parent().each(function(){
                            $(this).children().children().attr("disabled","true");
                            $("input[name=g_id"+id+"]").prev().removeAttr("disabled");
                            $(this).children().children().removeClass("inputfocs").addClass("inputnothing");
                            $(obj).removeClass("inputnothing");
                            $(obj).next().removeClass("inputnothing");
                            $(obj).prev().html(ehtml);
                            $(obj).html(dhtml);
                            $("a.tips_title").removeAttr("disabled");
                            // $(obj).attr("onclick","del_term(this,'"+id+"');");
                            $(obj).attr("onclick","editStatus(this,'"+imei+"');");
                            exit();
            }); 
    }
}

    //批量删除
    $("#delall").click(function () {
        var checkd = "";
        var num = 0;
        $("input.cb:checkbox:checked").each(function () {
            num++;
            if($(this).attr("g_binding")!='1'){
                checkd += $(this).val() + ",";
            }
        });
        //alert(checkd);return false;
        if (checkd === "") {
            notice("<?php echo L('未选中任何流量卡或流量卡绑定状态');?>
");
        } else {
            $("#dialog-confirm").dialog({
            resizable: false,
                    height: 180,
                    modal: true,
                    buttons: {
                        "<?php echo L('删除');?>
": function () {
                        $(this).dialog("close");
                            $.ajax({
                            url: "?modules=gprs&action=batch_del_gprs",
                                    data: $("form.data").serialize(),
                                    success: function (result) {
                                    var fail = num - result;
                                    //, "+fail+"个流量卡已绑定不能进行删除操作。
                                    layer.msg("<?php echo L('成功删除');?>
 " + result + " <?php echo L('个流量卡');?>
",{
                                    icon: 1,
                                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                }, function(){
                                    send();
                                });
                                    }
                            });
                        },
                        "<?php echo L('取消');?>
": function () {
                            $(this).dialog("close");
                        }
                    }
            });
        }
    });
    
$("a#batch_toggle").click(function () {
    $("form.move_user").hide();
    $("form.move_u_default_pg").hide();
    $("form.batch").toggle();
});

//启用或停用流量卡
function editStatus(self,iccid){
    var self = $(self);
    var status = self.attr('status');
    if(status=='1'){
        var remark = './images/disable.png';
        var remark1 = '<img src=\'images/Disable1.png\' onMouseOver="this.src=\'images/disable_pass.png\'" onMouseOut="this.src=\'images/Disable1.png\'">';
        status='0'
    }else if(status=='3'){
        status=='3';
    }else{
        var remark = './images/enable.png';
        var remark1 = '<img src=\'images/Enable1.png\' onMouseOver="this.src=\'images/enable_pass.png\'" onMouseOut="this.src=\'images/Enable1.png\'">';
        status='1'
    }
    $.ajax({
        url:'?m=gprs&a=set_stat',
        dataType:"json",
        data:{g_iccid:iccid,g_status:status},
        success:function(msg){
            if(msg.status==2)
            {
                layer.msg("<?php echo L('删除成功');?>
",{
                    icon: 1,
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                },function(){
                    send();
                }); 
            }
            else if(msg.status==-2){
                layer.msg("<?php echo L('删除失败');?>
");
            }
            else if(msg.status==-1){
                layer.msg("<?php echo L('修改失败');?>
");
            }else{
                layer.msg("<?php echo L('修改成功');?>
");
                self.html(remark1);
                self.attr('status',status);
                self.parent().prev().prev().prev().prev().prev().prev().children().attr('src',remark);
            }
        }
    });
}

//批量绑定代理商
$("#refreshall").click(function(){
    $("#batch").toggle();
})

$("#batch_submit").click(function(){
    //获取流量卡的id
    var checkd = "";
    var isbind = false;
    $("input.cb:checkbox:checked").each(function () {
        /*if($(this).attr('g_binding')!='1')
        {*/
            checkd += $(this).val() + ",";
        /*}else{
            isbind = true;
        }*/
    });
    //获取代理商的num
    var agents = $("select[name=agents]").val();
    if (checkd === "") {
        /*if(isbind==true){
           notice("<?php echo L('选中的流量卡已全部绑定,无法进行分配代理操作');?>
");
        }else{*/
           notice("<?php echo L('未选中任何流量卡');?>
");
        //}
    } else {
        $("#dialog-bind").dialog({
            resizable: false,
            height: 180,
            modal: true,
            buttons: {
            "<?php echo L('确定操作');?>
": function () {
                $(this).dialog("close");
                $.ajax({
                    url: "?modules=gprs&action=bind_gprs",
                    data: {g_ids:checkd,agents:agents},
                    success: function (result) {
                        layer.msg("<?php echo L('成功分配');?>
 " + result + " <?php echo L('个流量卡');?>
",{
                        icon: 1,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            send();
                        });
                    }
                });
            },
            "<?php echo L('取消');?>
": function () {
                    $(this).dialog("close");
                }
            }
        });
    }
})
/*(function () {
    var url = $("select#e_mds_id").attr("action");
    url += "&d_area=@";
    $.ajax({
        url: url,
        success: function (result) {
            $("select#e_mds_id").html(result);
        }
    }); 
})();*/

$("a[name=up_or_down]").click(function () {
    var checkd = "";
    var type = $(this).attr("type");
    var status = '';
    var msg = '';
    if(type=='up'){
        status = '1';
        msg = '批量启用';
    }else{
        status = '0';
        msg = '批量停用';
    }
    var num = 0;
    $("input.cb:checkbox:checked").each(function () {
        num++;
        //if($(this).attr("g_binding")=='1'){
            checkd += $(this).val() + ",";
        //}
    });

    if (checkd == "") {
        //或选中的流量卡全部未绑定
        notice("<?php echo L('未选中任何流量卡');?>
");
    } else {
        $("#dialog-update").dialog({
            resizable: false,
            height: 180,
            modal: true,
            buttons: {
                "<?php echo L('确定操作');?>
": function () {
                    $(this).dialog("close");
                    $.ajax({
                        url: "?modules=gprs&action=change_gprs_status",
                        //dataType:"json",
                        data: {ids:checkd,status:status},
                        success: function (result) {
                            send();
                            /*var fail = num - result;
                            layer.msg("<?php echo L('绑定成功');?>
 " + result + " <?php echo L('个流量卡');?>
, "+fail+"个流量卡未绑定不能进行更新操作。",{
                                icon: 1,
                                time: 3000 //2秒关闭（如果不配置，默认是3秒）
                                }, function(){
                                    send();
                                }
                            );*/
                        }
                    });
                }
            },
            "<?php echo L('取消');?>
": function () {
                $(this).dialog("close");
            }
        })
    }
});<?php }} ?>