<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:55:59
         compiled from "..\static\script\before.js" */ ?>
<?php /*%%SmartyHeaderCode:214475762234ff0a746-41820753%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15e33db587244ff70e1c0f24e9571cdc3617f5b0' => 
    array (
      0 => '..\\static\\script\\before.js',
      1 => 1466049256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214475762234ff0a746-41820753',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576223500126d5_59296355',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576223500126d5_59296355')) {function content_576223500126d5_59296355($_smarty_tpl) {?>function L(str) {
    if (typeof (window.lang[str]) !== 'undefined') {
        str = window.lang[str];
    }
    return str;
}
jQuery.validator.addMethod("u_mobile_phone", function (value, element) {
    var length = value.length;
    var flag = false;
    //var mob = /^\s*\+?\s*(\(\s*\d+\s*\)|\d+)(\s*-?\s*(\(\s*\d+\s*\)|\s*\d+\s*))*\s*$/;
    //var mob = /^\d{7,11}$/;
    var mob = /^\d+$/;
    if (mob.test(value) || length == 0) {
        flag = true;
    }
    return flag;
}, "<?php echo L('手机号码格式错误');?>
");

jQuery.validator.addMethod("p_desc", function (value, element) {
    var length = value.length;
    var flag = true;
    if (length >= 1000) {
        flag = false;
    }
    return flag;
}, "<?php echo L('已超出最大长度限制');?>
");
jQuery.validator.addMethod("u_udid", function (value, element) {
    var length = value.length;
    var flag = false;
    var mob = /^\s*$|^(?!(?:\d+|[a-zA-Z]+)$)[\da-zA-Z]{40}$/i;
    if ((length == 0 && mob.test(value)) || (length == 40 && mob.test(value))) {
        flag = true;
    }
    return flag;
}, "<?php echo L('必须为40位的字母和数字');?>
");
jQuery.validator.addMethod("u_imsi", function (value, element) {
    var length = value.length;
    var flag = false;
    var mob = /^\s*$|^[0-9]{15}$/i;
    if ((length == 0 && mob.test(value)) || (length == 15 && mob.test(value))) {
        flag = true;
    }
    return flag;
}, "<?php echo L('必须为15位数字');?>
");
jQuery.validator.addMethod("u_imei", function (value, element) {
    var length = value.length;
    var flag = false;
    var mob = /^\s*$|^[0-9a-zA-Z]{15}$/i;
    if ((length == 0 && mob.test(value)) || (length == 15 && mob.test(value))) {
        flag = true;
    }
    return flag;
}, "<?php echo L('必须为15位数字或字母');?>
");

jQuery.validator.addMethod("u_meid", function (value, element) {
    var length = value.length;
    var flag = false;
    var mob = /^\s*$|^[0-9a-zA-Z]{14}$/i;
    if ((length == 0 && mob.test(value)) || (length == 14 && mob.test(value))) {
        flag = true;
    }
    return flag;
}, "<?php echo L('必须为14位数字或字母');?>
");

jQuery.validator.addMethod("u_iccid", function (value, element) {
    var length = value.length;
    var flag = false;
    var mob = /^\s*$|^[0-9a-zA-Z]{19}$|^[0-9a-zA-Z]{20}$/i;
    if (mob.test(value)) {
        flag = true;
    }
    return flag;
}, "<?php echo L('长度为19或20位的数字或字母');?>
");

jQuery.validator.addMethod("u_iccid1", function (value, element) {
    var length = value.length;
    var flag = false;
    var mob = /^\S*$|^[0-9a-zA-Z]{19}$|^[0-9a-zA-Z]{20}$/i;
    if (mob.test(value)) {
        flag = true;
    }
    return flag;
}, "<?php echo L('长度为19或20位的数字或字母');?>
");
jQuery.validator.addMethod("u_mac", function (value, element) {
    var length = value.length;
    var flag = false;
    var mob = /^\s*$|[A-F\d]{2}[A-F\d]{2}[A-F\d]{2}[A-F\d]{2}[A-F\d]{2}[A-F\d]{2}/i;
    if (length == 12 && mob.test(value) || length == 0) {
        flag = true;
    }
    return flag;
}, "<?php echo L('需按照002F163D2B60的形式，只包含数字和字母');?>
");
function getnum() {
    var checkd = [];
    $("input.cb:checkbox:checked").each(function () {
        checkd.push($(this).val());
    });

    $("#num").html(checkd.length);
}<?php }} ?>