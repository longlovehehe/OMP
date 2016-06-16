<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:24:52
         compiled from "..\static\script\autoselect.js" */ ?>
<?php /*%%SmartyHeaderCode:5381574cf5f40f87b9-18931526%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c1f8ae192dc0e1aa25128b3c6706d84d9386f4f' => 
    array (
      0 => '..\\static\\script\\autoselect.js',
      1 => 1428975150,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5381574cf5f40f87b9-18931526',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf5f4104334_50415599',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf5f4104334_50415599')) {function content_574cf5f4104334_50415599($_smarty_tpl) {?>$(function ($) {
    $(".autoselect").bind('change', function () {
        var tdata = eval($(this).attr('data'));
        var data = tdata[0];
        var to = $("#" + data.to);
        var url = to.attr("action") + "&" + data.field + "=" + $(this).val();

        var owner = to;
        $.ajax({
            url: url,
            success: function (result) {
                if (data.view == "true") {
                    owner.html("<option value=''><?php echo L('全部');?>
</option>" + result);
                } else {
                    owner.html(result);
                }
            }
        });
    });
});
<?php }} ?>