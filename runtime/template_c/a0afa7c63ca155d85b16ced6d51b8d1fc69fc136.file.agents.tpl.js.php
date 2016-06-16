<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 19:03:14
         compiled from "..\static\script\modules\agents\agents.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:321805735b472cd9860-57802568%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0afa7c63ca155d85b16ced6d51b8d1fc69fc136' => 
    array (
      0 => '..\\static\\script\\modules\\agents\\agents.tpl.js',
      1 => 1430202932,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '321805735b472cd9860-57802568',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5735b472cfcaf8_67565390',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5735b472cfcaf8_67565390')) {function content_5735b472cfcaf8_67565390($_smarty_tpl) {?>$("#delall").click(function () {
    var checkd = "";
    $("input.cb:checkbox:checked").each(function () {
        checkd += $(this).val() + ",";
    });
    if (checkd == "") {
        notice(L("未选中任何代理商"));
    } else {
        $("#dialog-confirm").dialog({
            resizable: false,
            height: 180,
            modal: true,
            buttons: {
                "<?php echo L('删除');?>
": function () {
                    $(this).dialog("close");
                    notice(L("正在删除"));
                    $.ajax({
                        url: "?modules=agents&action=batchdel",
                        data: $("form.data").serialize(),
                        success: function (result) {
                            /**
                             if (result == 0) {
                             notice("没有记录被删除。非停用状态企业无法直接删除");
                             } else {
                             notice("成功删除" + result + "记录");
                             }*/
                            notice("<?php echo L('成功删除');?>
 " + result + " <?php echo L('个代理商');?>
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
});

<?php }} ?>