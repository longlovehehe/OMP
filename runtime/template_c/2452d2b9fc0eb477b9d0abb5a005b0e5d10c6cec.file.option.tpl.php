<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:25:49
         compiled from "..\template\viewer\option.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28816574cf62d4b2ad2-65974352%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2452d2b9fc0eb477b9d0abb5a005b0e5d10c6cec' => 
    array (
      0 => '..\\template\\viewer\\option.tpl',
      1 => 1432279498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28816574cf62d4b2ad2-65974352',
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
  'unifunc' => 'content_574cf62d5106f7_89580460',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf62d5106f7_89580460')) {function content_574cf62d5106f7_89580460($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo getompman($_smarty_tpl->tpl_vars['item']->value['name']);?>
</option>
<?php } ?><?php }} ?>