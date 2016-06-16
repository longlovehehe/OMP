<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:24:52
         compiled from "..\static\script\modules\enterprise\index.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:10586574cf5f4211bf9-65193267%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec61b530f44b3f978608e74660aeae46d0369b1e' => 
    array (
      0 => '..\\static\\script\\modules\\enterprise\\index.tpl.js',
      1 => 1462529116,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10586574cf5f4211bf9-65193267',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf5f4258100_83210883',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf5f4258100_83210883')) {function content_574cf5f4258100_83210883($_smarty_tpl) {?>$(".refreshall").click(function () {
    var checkd = "";
    var url = $(this).attr("data");
    $("input.cb:checkbox:checked").each(function () {
        checkd += $(this).val() + ",";
    });
    if (checkd == "") {
        notice("<?php echo L('未选中任何企业项');?>
");
    } else {
        $.ajax({
            url: url,
            dataType: "JSON",
            data: $("form.data").serialize(),
            success: function (result) {
                notice(result.msg);
                setTimeout(function () {
                    send();
                }, 888);
            }
        });
    }
});
$("#delall").click(function () {
    var checkd = "";
    $("input.cb:checkbox:checked").each(function () {
        checkd += $(this).val() + ",";
    });
    if (checkd == "") {
        notice("<?php echo L('未选中任何企业项');?>
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
                    notice("<?php echo L('正在删除');?>
");
                    $.ajax({
                        url: "?modules=enterprise&action=index_del",
                        data: $("form.data").serialize(),
                        success: function (result) {
                            if (result == 0) {
                                notice("<?php echo L('没有企业被删除。非停用状态企业或特殊企业无法直接删除');?>
");
                            }else{
                                notice("<?php echo L('成功删除');?>
 " + result + " <?php echo L('个企业');?>
");
                            }
                            setTimeout(function () {
                                send();
                            }, 888);
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
<?php }} ?>