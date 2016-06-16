<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:25:49
         compiled from "..\template\modules\gprs\gprs_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24974574cf62d7eeda1-79445366%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f2886693dcf7f24a4f6edd423c498484e4a1491' => 
    array (
      0 => '..\\template\\modules\\gprs\\gprs_item.tpl',
      1 => 1451974467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24974574cf62d7eeda1-79445366',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'item' => 0,
    'numinfo' => 0,
    'prev' => 0,
    'next' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf62db7d0f2_36605190',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf62db7d0f2_36605190')) {function content_574cf62db7d0f2_36605190($_smarty_tpl) {?><form class="data"><table class="base full"><tr class='head'><th width="20px"><input autocomplete="off"  type="checkbox" id="checkall" /></th><th width="30px"><?php echo L("状态");?>
</th><th width="90px"><?php echo L("名称");?>
</th><th width="150px">ICCID</th><th width="90px">Number</th><th width="100px"><?php echo L("系统号码");?>
</th><th width="40px"><?php echo L("详情");?>
</th><th colspan="3" width="205px" style="text-align: center;"><?php echo L("操作");?>
</th></tr><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['list']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['list']['iteration']++;
?><tr><td class=""><input autocomplete="off" type="checkbox" name="checkbox[]" g_status="<?php echo $_smarty_tpl->tpl_vars['item']->value['g_status'];?>
" g_binding="<?php echo $_smarty_tpl->tpl_vars['item']->value['g_binding'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['g_id'];?>
" class="cb" /><input type="hidden" name="g_id<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['list']['iteration'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['g_id'];?>
"/></td><td><?php if ($_smarty_tpl->tpl_vars['item']->value['g_binding']==0){?><img src="./images/unbind.png" /><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['item']->value['g_status']==1){?><img id="remark" src="./images/enable.png" /><?php }else{ ?><img id="remark" src="./images/disable.png" /><?php }?><?php }?></td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['g_name'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['g_iccid'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['g_number'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['g_u_number'];?>
</td><td><a title="ICCID:<?php echo $_smarty_tpl->tpl_vars['item']->value['g_iccid'];?>
<br />IMSI:<?php echo $_smarty_tpl->tpl_vars['item']->value['g_imsi'];?>
<br />Number:<?php echo $_smarty_tpl->tpl_vars['item']->value['g_number'];?>
<br /><?php echo L('所属代理商');?>
:<?php echo getompman($_smarty_tpl->tpl_vars['item']->value['ag_name']);?>
<br ><?php echo L('所属企业');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['e_name'];?>
<br /><?php echo L('系统号码');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['g_u_number'];?>
<br /><?php echo L('入库时间');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['g_intime'];?>
<br /><?php echo L('批次');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['g_batch'];?>
<br /><?php echo L('开卡日期');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['g_a_date'];?>
<br /><?php echo L('入库单号');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['g_in_number'];?>
<br /><?php echo L('备注');?>
1:<?php echo $_smarty_tpl->tpl_vars['item']->value['g_one_remarks'];?>
<br /><?php echo L('备注');?>
2:<?php echo $_smarty_tpl->tpl_vars['item']->value['g_two_remarks'];?>
" class="link tips_title"><span class="icon hand"></span></a></td><td<?php if ($_smarty_tpl->tpl_vars['item']->value['g_binding']==0){?> style="padding-left: 13px;" <?php }?>><!-- class="link edit start_stop" --><?php if ($_smarty_tpl->tpl_vars['item']->value['g_binding']==1){?><a class="link edit"  href="javascript:void(0);" onclick="editStatus(this,'<?php echo $_smarty_tpl->tpl_vars['item']->value['g_iccid'];?>
');" status="<?php echo $_smarty_tpl->tpl_vars['item']->value['g_status'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['g_iccid'];?>
"><?php if ($_smarty_tpl->tpl_vars['item']->value['g_status']==1){?><img class="enable" src='images/Enable1.png' onMouseOver="this.src='images/enable_pass.png'" onMouseOut="this.src='images/Enable1.png'"></a><!-- <?php echo L("停用");?>
 --><?php }else{ ?><img class="disable" src='images/Disable1.png' onMouseOver="this.src='images/disable_pass.png'" onMouseOut="this.src='images/Disable1.png'"></a><!-- <?php echo L("启用");?>
 --><?php }?></a><?php }else{ ?><?php echo L("无");?>
<?php }?></td><td><?php if ($_smarty_tpl->tpl_vars['item']->value['g_binding']==1){?><a href="javascript:void(0);"  class="link edit dis set_gray" ><img class="edit" src='images/edit.png' onMouseOver="this.src='images/edit_pass.png'" onMouseOut="this.src='images/edit.png'"/></a><!-- <?php echo L("编辑");?>
 --></a><a id="del" class="mrlf15 link dis set_gray"><img class="delete" src='images/delete.png' onMouseOver="this.src='images/delete_pass.png'" onMouseOut="this.src='images/delete.png'"/></a><!-- <?php echo L("删除");?>
 --></a><?php }else{ ?><a href="?m=gprs&a=gprs_edit&g_iccid=<?php echo $_smarty_tpl->tpl_vars['item']->value['g_iccid'];?>
&g_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['g_id'];?>
"  class="link edit"><img class="edie" src='images/edit.png' onMouseOver="this.src='images/edit_pass.png'" onMouseOut="this.src='images/edit.png'"/></a><!-- <?php echo L("编辑");?>
 --></a><a id="del" class="mrlf15 link <?php if ($_smarty_tpl->tpl_vars['item']->value['status']=='yes'){?>msg<?php }?>" status="3" onclick="editStatus(this,'<?php echo $_smarty_tpl->tpl_vars['item']->value['g_iccid'];?>
')"><img class="delete" src='images/delete.png' onMouseOver="this.src='images/delete_pass.png'" onMouseOut="this.src='images/delete.png'"/></a><!-- <?php echo L("删除");?>
 --></a><?php }?></td><td><a href="?m=gprs&a=history_gprs&g_iccid=<?php echo $_smarty_tpl->tpl_vars['item']->value['g_iccid'];?>
&g_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['g_id'];?>
" class="link edit view"></a></td></tr><?php } ?></table><?php if ($_smarty_tpl->tpl_vars['list']->value!=null){?><div class="page none_select rich"><div class="num"><?php echo $_smarty_tpl->tpl_vars['numinfo']->value;?>
</div><div class="turn"><a page="<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
" class="prev"><?php echo L("上一页");?>
</a><a page="<?php echo $_smarty_tpl->tpl_vars['next']->value;?>
" class="next"><?php echo L("下一页");?>
</a></div></div><?php }?><div class="buttom"><span class="img_start"><?php echo L("启用");?>
</span><span class="img_stop"><?php echo L("停用");?>
</span><span class="img_unbind"><?php echo L("未绑定");?>
</span></div></form>
<?php }} ?>