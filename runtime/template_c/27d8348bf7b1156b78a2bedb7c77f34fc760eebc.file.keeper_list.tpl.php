<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:24:49
         compiled from "..\template\modules\terminal\keeper_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11158574cf5f10923e1-30938100%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27d8348bf7b1156b78a2bedb7c77f34fc760eebc' => 
    array (
      0 => '..\\template\\modules\\terminal\\keeper_list.tpl',
      1 => 1438071214,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11158574cf5f10923e1-30938100',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf5f10f0001_10276342',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf5f10f0001_10276342')) {function content_574cf5f10f0001_10276342($_smarty_tpl) {?><h2 class="title"><?php echo L("Keeper管理");?>
</h2><div class="toolbar"><form action="?m=terminal&a=keeper_list_item" id="form" method="post"><input autocomplete="off"  name="modules" value="terminal" type="hidden" /><input autocomplete="off"  name="action" value="keeper_list_item" type="hidden" /><input autocomplete="off"  name="page" value="0" type="hidden" /><div class="line"><label><?php echo L("昵称");?>
：</label><input autocomplete="off"  class="autosend" name="rm_nickname" type="text" /></div><div class="line"><label><?php echo L("号码");?>
：</label><input autocomplete="off"  class="autosend" name="rm_id" type="text" /></div><div class="line buttons right"><a form="form" class="button submit"><i class="icon-search"></i><?php echo L("查询");?>
</a></div></form></div><div class="content"></div><?php }} ?>