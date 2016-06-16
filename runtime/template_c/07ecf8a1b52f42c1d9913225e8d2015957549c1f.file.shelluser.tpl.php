<?php /* Smarty version Smarty-3.1.11, created on 2016-05-23 13:36:37
         compiled from "..\template\modules\enterprise\shelluser.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23082574296e5364ca7-23208395%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '07ecf8a1b52f42c1d9913225e8d2015957549c1f' => 
    array (
      0 => '..\\template\\modules\\enterprise\\shelluser.tpl',
      1 => 1411524916,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23082574296e5364ca7-23208395',
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
  'unifunc' => 'content_574296e53c6749_39660855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574296e53c6749_39660855')) {function content_574296e53c6749_39660855($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
</option>
<?php } ?><?php }} ?>