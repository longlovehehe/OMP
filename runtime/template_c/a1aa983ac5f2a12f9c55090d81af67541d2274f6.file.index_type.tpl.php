<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 09:05:13
         compiled from "..\template\modules\terminal\index_type.tpl" */ ?>
<?php /*%%SmartyHeaderCode:438957352849cd48a5-72501813%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a1aa983ac5f2a12f9c55090d81af67541d2274f6' => 
    array (
      0 => '..\\template\\modules\\terminal\\index_type.tpl',
      1 => 1439807259,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '438957352849cd48a5-72501813',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57352849d22ab9_51719776',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57352849d22ab9_51719776')) {function content_57352849d22ab9_51719776($_smarty_tpl) {?><h2 class="title"><?php echo L("终端类型列表");?>
</h2><div class="toptoolbar"><a href="javascript:void(0);" id="add_type" class="button orange"><?php echo L("添加终端类型");?>
</a></div><form action="?m=terminal&a=index_type_item" id="form" method="post"><input autocomplete="off"  name="modules" value="terminal" type="hidden" /><input autocomplete="off"  name="action" value="index_type_item" type="hidden" /><input autocomplete="off"  name="page" value="0" type="hidden" /><div class="buttons right none"><a form="form" class="button submit"><i class="icon-search"></i><?php echo L("查询");?>
</a></div></form><div class="content"></div><?php }} ?>