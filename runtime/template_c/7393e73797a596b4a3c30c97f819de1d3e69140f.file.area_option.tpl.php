<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:24:52
         compiled from "..\template\modules\area\area_option.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12392574cf5f43947d4-43934912%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7393e73797a596b4a3c30c97f819de1d3e69140f' => 
    array (
      0 => '..\\template\\modules\\area\\area_option.tpl',
      1 => 1452756387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12392574cf5f43947d4-43934912',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'item' => 0,
    'e_area' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf5f4401df3_60374257',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf5f4401df3_60374257')) {function content_574cf5f4401df3_60374257($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['am_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['e_area']->value==$_smarty_tpl->tpl_vars['item']->value['am_id']){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['am_name'];?>
</option>
<?php } ?><?php }} ?>