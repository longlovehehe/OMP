<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:24:38
         compiled from "..\static\script\modules\device\rs.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:18256574cf5e6074715-33444213%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fde27a6f22d0e029da5f5d1bdb3f73f0c2c2db99' => 
    array (
      0 => '..\\static\\script\\modules\\device\\rs.tpl.js',
      1 => 1444720686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18256574cf5e6074715-33444213',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf5e60b6da1_95502305',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf5e60b6da1_95502305')) {function content_574cf5e60b6da1_95502305($_smarty_tpl) {?>$("#refreshall").click(function () {
    var checkd = "";
    var url = $(this).attr("data");
    $("input.cb:checkbox:checked").each(function () {
        checkd += $(this).val() + ",";
    });
    if (checkd === "") {
        notice("<?php echo L('未选中任何项');?>
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
    if (checkd === "") {
        notice("<?php echo L('未选中任何项');?>
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
                        url: "?modules=device&action=mds_del",
                        data: $("form.data").serialize(),
                        success: function (result) {
                            notice("<?php echo L('成功删除');?>
 " + result + " <?php echo L('台设备');?>
");
                            setTimeout(function () {
                                send("prev");
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
});/* The file is auto create */
<?php }} ?>