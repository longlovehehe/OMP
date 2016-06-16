<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 09:32:03
         compiled from "..\template\modules\device\ss_option.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3006357352e93eb1781-85684760%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c59d57675bb9426c92258e5a146d4abc14fd1ad3' => 
    array (
      0 => '..\\template\\modules\\device\\ss_option.tpl',
      1 => 1452756387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3006357352e93eb1781-85684760',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'e_ss_id' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57352e9407cc43_95573284',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57352e9407cc43_95573284')) {function content_57352e9407cc43_95573284($_smarty_tpl) {?><?php if ($_REQUEST['d_deployment_id']==''){?>
<option value="" d_recnum="0" disabled="disabled" style="color: #000" diff_rec="0" ><?php echo L("请先选择一个SS");?>
</option>
<?php }else{ ?>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<option <?php if ($_smarty_tpl->tpl_vars['e_ss_id']->value==$_smarty_tpl->tpl_vars['item']->value['d_id']){?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_id'];?>
" d_deployment_id="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_deployment_id'];?>
" style="font-size:16px" d_space_free="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_space_free'];?>
" d_space="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_space'];?>
" ><?php echo L("设备名称");?>
：<?php echo $_smarty_tpl->tpl_vars['item']->value['d_name'];?>
 <?php echo L("外网IP");?>
：【<?php echo $_smarty_tpl->tpl_vars['item']->value['d_ip2'];?>
】<?php echo L("内网IP");?>
：【<?php echo $_smarty_tpl->tpl_vars['item']->value['d_ip1'];?>
】</option>
<option value="" disabled="disabled" >【<?php echo L("可用/总空间");?>
：<?php echo $_smarty_tpl->tpl_vars['item']->value['d_space_free'];?>
 / <?php echo $_smarty_tpl->tpl_vars['item']->value['d_space'];?>
 M】</option>
<?php }
if (!$_smarty_tpl->tpl_vars['item']->_loop) {
?>
<option value="" disabled="disabled" style="color: #000" d_recnum="0" diff_rec="0"><?php echo L("该区域下没有可使用设备");?>
</option>
<?php } ?>
<?php }?>


<?php }} ?>