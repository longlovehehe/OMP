<?php /* Smarty version Smarty-3.1.11, created on 2016-05-23 13:36:37
         compiled from "..\template\viewer\input.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17357574296e5996d21-05969102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11f37aa15afa7507f35813ab779891b10f2f4194' => 
    array (
      0 => '..\\template\\viewer\\input.tpl',
      1 => 1452756387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17357574296e5996d21-05969102',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574296e5a04332_82371322',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574296e5a04332_82371322')) {function content_574296e5a04332_82371322($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
    <label class="title1  autocheck"><div class="title1" style="min-width:80px;"><input type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
" class="allcheckbox" name="checkbox1[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['code'];?>
"/><?php echo L(((string)$_smarty_tpl->tpl_vars['item']->value['name']));?>
</div> </label>
<?php } ?><?php }} ?>