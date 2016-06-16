<?php /* Smarty version Smarty-3.1.11, created on 2016-05-23 13:36:37
         compiled from "..\template\api\get_enterprise_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28406574296e571df87-89224854%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcbd3f1bed5792f63e16bbd45343baaca1f1ff88' => 
    array (
      0 => '..\\template\\api\\get_enterprise_list.tpl',
      1 => 1408493880,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28406574296e571df87-89224854',
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
  'unifunc' => 'content_574296e5773ea3_40168728',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574296e5773ea3_40168728')) {function content_574296e5773ea3_40168728($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['e_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['e_name'];?>
</option>
<?php } ?><?php }} ?>