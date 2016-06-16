<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 09:32:03
         compiled from "..\template\modules\device\rs_option.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1620157352e93c7ef00-87564666%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc7435e83fd5c3a153cfea604c3a6c40e83a5140' => 
    array (
      0 => '..\\template\\modules\\device\\rs_option.tpl',
      1 => 1452756387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1620157352e93c7ef00-87564666',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'e_vcr_id' => 0,
    'list' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57352e93dcafd3_33467304',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57352e93dcafd3_33467304')) {function content_57352e93dcafd3_33467304($_smarty_tpl) {?><?php if ($_REQUEST['d_deployment_id']==''){?>

<?php }else{ ?>
<option onclick="cancel()" <?php if (!$_smarty_tpl->tpl_vars['e_vcr_id']->value){?> selected="selected" <?php }?> value="" d_deployment_id="0"  style="color: #000" d_recnum="0" diff_rec="0" d_have="0"><?php echo L("不选择任何设备");?>
</option>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<option <?php if ($_smarty_tpl->tpl_vars['e_vcr_id']->value==$_smarty_tpl->tpl_vars['item']->value['d_id']){?> selected="selected" <?php }?> text ="pxx" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_id'];?>
" d_deployment_id="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_deployment_id'];?>
" style="font-size:16px" d_recnum="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_recnum'];?>
" diff_rec="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_recnum']-$_smarty_tpl->tpl_vars['item']->value['sum_rec'];?>
" d_have = "<?php echo $_smarty_tpl->tpl_vars['item']->value['d_recnum']-$_smarty_tpl->tpl_vars['item']->value['sum_rec'];?>
"><?php echo L("设备名称");?>
：<?php echo $_smarty_tpl->tpl_vars['item']->value['d_name'];?>
 <?php echo L("外网IP");?>
：【<?php echo $_smarty_tpl->tpl_vars['item']->value['d_ip2'];?>
】<?php echo L("内网IP");?>
：【<?php echo $_smarty_tpl->tpl_vars['item']->value['d_ip1'];?>
】</option>
<option value="" disabled="disabled" >【<?php echo L("可用/总并发数");?>
：<?php echo $_smarty_tpl->tpl_vars['item']->value['d_recnum']-$_smarty_tpl->tpl_vars['item']->value['sum_rec'];?>
 / <?php echo $_smarty_tpl->tpl_vars['item']->value['d_recnum'];?>
】</option>
<?php }
if (!$_smarty_tpl->tpl_vars['item']->_loop) {
?>
<option value="" disabled="disabled" style="color: #000" d_recnum="0" diff_rec="0"><?php echo L("该区域下没有可使用设备");?>
</option>
<?php } ?>
<?php }?>


<script type="text/javascript">
	function cancel()
	{
		// $("#e_vcr_id").find("option[text='px']").attr("selected",false);
		// $("#e_vcr_id option[text='px']").attr("selected", false); 
		$("#e_vcr_id").find("option[text='pxx']").attr("selected",false);
		$("#e_has_vcr").val('0');
		$("#e_rs_rec").val('0');
		$(".cur_e_rs_rec").html('0');
		$('#e_rs_rec-error').remove();
		// $("#e_vcr_id").find("option[text='px']").attr("selected",true);
		// $("#e_vcr_id option[text='px']").attr("selected", true); 
	}
</script><?php }} ?>