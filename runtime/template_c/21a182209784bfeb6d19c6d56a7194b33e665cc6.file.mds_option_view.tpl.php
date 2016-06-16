<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:24:52
         compiled from "..\template\modules\device\mds_option_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31873574cf5f4513531-12801989%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21a182209784bfeb6d19c6d56a7194b33e665cc6' => 
    array (
      0 => '..\\template\\modules\\device\\mds_option_view.tpl',
      1 => 1457343726,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31873574cf5f4513531-12801989',
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
  'unifunc' => 'content_574cf5f4574fc9_01929858',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf5f4574fc9_01929858')) {function content_574cf5f4574fc9_01929858($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['item']->value['d_name'];?>
【<?php echo $_smarty_tpl->tpl_vars['item']->value['d_ip2'];?>
】</option>
<?php } ?><?php }} ?>