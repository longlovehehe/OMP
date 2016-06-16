<?php /* Smarty version Smarty-3.1.11, created on 2016-05-21 16:53:23
         compiled from "..\static\script\modules\enterprise\allusers.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:28145574022034765a0-86837759%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '41bf49e54c7cb5346b1032edd462839c667dec78' => 
    array (
      0 => '..\\static\\script\\modules\\enterprise\\allusers.tpl.js',
      1 => 1418699678,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28145574022034765a0-86837759',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5740220347a425_50083032',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5740220347a425_50083032')) {function content_5740220347a425_50083032($_smarty_tpl) {?>$(".waitsubmit").click(function () {
    $(this).addClass("submit");
    $("input[name=page]").val(0);
    send();
});<?php }} ?>