<?php /* Smarty version Smarty-3.1.11, created on 2016-05-23 13:36:37
         compiled from "..\template\api\get_groups_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18197574296e515d3b5-40471169%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50d4e64c971a30d27bd1466ed5c1615f4f6c8874' => 
    array (
      0 => '..\\template\\api\\get_groups_list.tpl',
      1 => 1409728133,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18197574296e515d3b5-40471169',
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
  'unifunc' => 'content_574296e51c6b44_39167661',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574296e51c6b44_39167661')) {function content_574296e51c6b44_39167661($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ug_id'];?>
"><?php echo modugpath($_smarty_tpl->tpl_vars['item']->value['ug_path']);?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['ug_name'];?>
</option>
<?php } ?><?php }} ?>