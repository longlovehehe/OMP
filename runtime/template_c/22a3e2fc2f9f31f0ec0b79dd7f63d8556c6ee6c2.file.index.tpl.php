<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:25:47
         compiled from "..\template\modules\gprs\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26139574cf62bdf5765-09724280%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22a3e2fc2f9f31f0ec0b79dd7f63d8556c6ee6c2' => 
    array (
      0 => '..\\template\\modules\\gprs\\index.tpl',
      1 => 1461229731,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26139574cf62bdf5765-09724280',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf62c0af0d2_05076564',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf62c0af0d2_05076564')) {function content_574cf62c0af0d2_05076564($_smarty_tpl) {?>﻿<h2 class="title"><?php echo L("流量卡管理");?>
</h2><div class="toptoolbar"><a href="?m=gprs&a=gprs_add" class="button orange"><?php echo L("办理入库");?>
</a></div><div class="toolbar"><form action="?m=gprs&a=gprs_item" id="form" method="post"><input autocomplete="off"  name="modules" value="gprs" type="hidden" /><input autocomplete="off"  name="action" value="gprs_item" type="hidden" /><input autocomplete="off"  name="page" value="0" type="hidden" /><div class="line"><label><?php echo L("名称");?>
：</label><input autocomplete="off"  class="autosend" name="g_name" type="text" /></div><div class="line"><label><?php echo L("ICCID");?>
：</label><input autocomplete="off"  class="autosend" name="g_iccid" type="text" /></div><div class="line"><label><?php echo L("IMSI");?>
：</label><input autocomplete="off"  class="autosend" name="g_imsi" type="text" /></div><div class="line"><label><?php echo L("Number");?>
：</label><input autocomplete="off"  class="autosend" name="g_number" type="text" /></div><div class="line"><label><?php echo L("状态");?>
：</label><select name="g_status"><option value=""><?php echo L("全部");?>
</option><option value="2"><?php echo L("未绑定");?>
</option><option value="1"><?php echo L("启用");?>
</option><option value="0"><?php echo L("停用");?>
</option></select></div><div class="line"><label><?php echo L("所属企业");?>
：</label><select  name="g_e_id" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['g_e_id'];?>
" class="autofix" action="?m=gprs&a=e_option"><option value=""><?php echo L("全部");?>
</option></select></div><div class="line"><label><?php echo L("系统号码");?>
：</label><input autocomplete="off"  class="autosend" name="g_u_number" type="text" /></div><div class="line"><label><?php echo L("批次");?>
：</label><input autocomplete="off"  class="autosend" name="g_batch" type="text" /></div><div class="line"><label><?php echo L("开卡日");?>
：</label><input autocomplete="off"  class="autosend" name="g_a_date" type="text" /></div><div class="line"><label><?php echo L("入库单号");?>
：</label><input autocomplete="off"  class="autosend" name="g_in_number" type="text" /></div><div class="line"><label><?php echo L("所属代理商");?>
：</label><select  name="g_agents_id" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['g_agents_id'];?>
" class="autofix" action="?m=gprs&a=ag_option"><option value=""><?php echo L("全部");?>
</option><option value="0"><?php echo L("OMP");?>
</option></select></div><div class="line"><label><?php echo L("入库时间");?>
：</label><input autocomplete="off" name="g_intime" type="text" /></div><div class="buttons right"><a form="form" class="button submit"><?php echo L("查询");?>
</a></div></form></div><div class="toolbar"><a id="delall" class="button"><?php echo L("批量删除");?>
</a><a id="refreshall" class="refreshall button" data="?m=gprs&a=refresh" ><?php echo L("分配代理商");?>
</a><a name="up_or_down" type="up" class="button"><?php echo L("批量启用");?>
</a><a name="up_or_down" type="down" class="button"><?php echo L("批量停用");?>
</a><form action="?m=gprs&a=bind_gprs" class="batch hide" id="batch"  method="post"><div class="line"><label><?php echo L("代理商");?>
：</label><select name="agents" class="autofix" action="?m=gprs&a=ag_option" required="true"><option value="0"><?php echo L("OMP");?>
</option></select></div><a id="batch_submit" class="button"><?php echo L("批量分配");?>
</a></form></div><div><table class="full"><tr class='head' style="height: 35px;" type="gprs" url="?m=gprs&action=gprs_item"><td width="110px" class="clickPage"><?php echo L("流量卡列表");?>
</td><td width="490px" class="clickPage" style="text-align:right;"><?php echo L("显示条数");?>
：</td><td width="50px" onclick="clickPage(this)" class="clickPage" <?php echo $_SESSION['color'][10];?>
 onmouseover="this.style.cursor='pointer'">10</td><td width="50px" onclick="clickPage(this)" class="clickPage" <?php echo $_SESSION['color'][20];?>
 onmouseover="this.style.cursor='pointer'">20</td><td width="50px" onclick="clickPage(this)" class="clickPage" <?php echo $_SESSION['color'][50];?>
 onmouseover="this.style.cursor='pointer'">50</td></tr></table></div><div class="content"></div><div id="dialog-confirm" class="hide" title="<?php echo L('删除选中项');?>
?"><p><?php echo L("确定要删除选中的流量卡吗");?>
?</p></div><div id="dialog-bind" class="hide" title="<?php echo L('更新选中项');?>
?"><p><?php echo L("确定要进行此操作吗");?>
?</p></div><div id="dialog-update" class="hide" title="<?php echo L('更新选中项');?>
?"><p><?php echo L("确定要进行此操作吗");?>
?</p></div>
<?php }} ?>