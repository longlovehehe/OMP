<?php /* Smarty version Smarty-3.1.11, created on 2016-05-23 13:36:37
         compiled from "..\template\viewer\option_group.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21944574296e5535a92-19305610%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '856a46d08e381e877a149a1c1746a9f705b0f70d' => 
    array (
      0 => '..\\template\\viewer\\option_group.tpl',
      1 => 1442370683,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21944574296e5535a92-19305610',
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
  'unifunc' => 'content_574296e559b3b5_09366611',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574296e559b3b5_09366611')) {function content_574296e559b3b5_09366611($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
<?php } ?><?php }} ?>