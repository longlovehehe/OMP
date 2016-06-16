<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 09:31:46
         compiled from "..\template\modules\device\mds_option.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1189557352e827c40a4-67324416%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da860d24d649ae8f683413bd2929885c26cd3c81' => 
    array (
      0 => '..\\template\\modules\\device\\mds_option.tpl',
      1 => 1452756387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1189557352e827c40a4-67324416',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'e_mds_id' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57352e8292f576_48465580',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57352e8292f576_48465580')) {function content_57352e8292f576_48465580($_smarty_tpl) {?><?php if ($_REQUEST['d_area']=='@'){?>
<option value="" d_user="0" disabled="disabled" style="color: #000" d_phone_user="0" d_dispatch_user="0" d_gvs_user="0" d_call="0" diff_phone="0" diff_dispatch="0" diff_gvs="0"><?php echo L("请先选择一个区域");?>
</option>
<?php }else{ ?>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<option <?php if ($_smarty_tpl->tpl_vars['e_mds_id']->value==$_smarty_tpl->tpl_vars['item']->value['d_id']){?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_id'];?>
" d_deployment_id="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_deployment_id'];?>
" style="font-size:16px" d_user="<?php echo modusercall($_smarty_tpl->tpl_vars['item']->value['diff_user']);?>
" d_phone_user="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_phone_user'];?>
" d_dispatch_user="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_dispatch_user'];?>
" d_gvs_user="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_gvs_user'];?>
" d_call="<?php echo $_smarty_tpl->tpl_vars['item']->value['diff_call'];?>
" diff_phone="<?php echo $_smarty_tpl->tpl_vars['item']->value['diff_phone'];?>
" diff_dispatch="<?php echo $_smarty_tpl->tpl_vars['item']->value['diff_dispatch'];?>
" diff_gvs="<?php echo $_smarty_tpl->tpl_vars['item']->value['diff_gvs'];?>
"><?php echo L("设备名称");?>
：<?php echo $_smarty_tpl->tpl_vars['item']->value['d_name'];?>
【<?php echo $_smarty_tpl->tpl_vars['item']->value['d_ip2'];?>
】</option>
<option value="" disabled="disabled" >【<?php echo L("可用用户数");?>
：<?php echo modusercall($_smarty_tpl->tpl_vars['item']->value['diff_user']);?>
 | <?php echo L("可用手机用户数");?>
：<?php echo $_smarty_tpl->tpl_vars['item']->value['diff_phone'];?>
 | <?php echo L("可用调度台用户数");?>
：<?php echo $_smarty_tpl->tpl_vars['item']->value['diff_dispatch'];?>
 | <?php echo L("可用GVS用户数");?>
：<?php echo $_smarty_tpl->tpl_vars['item']->value['diff_gvs'];?>
】</option>
<?php }
if (!$_smarty_tpl->tpl_vars['item']->_loop) {
?>
<option value="" disabled="disabled" style="color: #000" d_user="0" d_phone_user="0" d_dispatch_user="0" d_gvs_user="0" d_call="0" diff_phone="0" diff_dispatch="0" diff_gvs="0"><?php echo L("该区域下没有可使用设备");?>
</option>
<?php } ?>
<?php }?>


<?php }} ?>