<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 10:08:32
         compiled from "..\template\modules\terminal\index_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23863573537203b1b28-69801754%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '872883d6fe5808238088493bd977730c275b5f60' => 
    array (
      0 => '..\\template\\modules\\terminal\\index_list.tpl',
      1 => 1452238674,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23863573537203b1b28-69801754',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_573537205fbab9_89659765',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_573537205fbab9_89659765')) {function content_573537205fbab9_89659765($_smarty_tpl) {?><h2 class="title"><?php echo L("终端列表");?>
</h2><div class="toptoolbar"><a href="?m=terminal&a=terminal_in" id="add_type" class="button orange"><?php echo L("终端入库");?>
</a></div><div class="toolbar"><form action="?m=terminal&a=index_list_item" id="form" method="post"><input autocomplete="off"  name="modules" value="terminal" type="hidden" /><input autocomplete="off"  name="action" value="index_list_item" type="hidden" /><input autocomplete="off"  name="page" value="0" type="hidden" /><div class="line"><label>IMEI：</label><input autocomplete="off"  class="autosend" name="md_imei" type="text" /></div><div class="line"><label><?php echo L("终端型号");?>
：</label><select  name="md_type" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['md_type'];?>
" class="autofix" action="?m=terminal&a=option"><option value=""><?php echo L("全部");?>
</option></select></div><div class="line"><label><?php echo L("序列号");?>
：</label><input autocomplete="off"  class="autosend" name="md_serial_number" type="text" /></div><div class="line"><label><?php echo L("状态");?>
：</label><select  name="md_status"><option value=""><?php echo L("全部");?>
</option><option value="2"><?php echo L("未绑定");?>
</option><option value="1"><?php echo L("启用");?>
</option><option value="0"><?php echo L("停用");?>
</option></select></div><div class="line"><label><?php echo L("所属企业");?>
：</label><select  name="md_ent_id" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['md_ent_id'];?>
" class="autofix" action="?m=terminal&a=e_option"><option value=""><?php echo L("全部");?>
</option></select></div><div class="line"><label><?php echo L("系统号码");?>
：</label><input autocomplete="off"  class="autosend" name="md_binding_user" type="text" /></div><div class="line"><label><?php echo L("批次");?>
：</label><input autocomplete="off"  class="autosend" name="md_batch" type="text" /></div><div class="line"><label><?php echo L("名称");?>
：</label><input autocomplete="off"  class="autosend" name="md_name" type="text" /></div><div class="line"><label><?php echo L("入库单号");?>
：</label><input autocomplete="off"  class="autosend" name="md_in_number" type="text" /></div><div class="line"><label><?php echo L("入库时间");?>
：</label><input autocomplete="off"  name="md_time" type="text" /></div><div class="line"><label><?php echo L("所属代理商");?>
：</label><select  name="md_parent_ag" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['md_parent_ag'];?>
" class="autofix" action="?m=terminal&a=ag_option"><option value=""><?php echo L("全部");?>
</option><option value="0"><?php echo L("OMP");?>
</option></select></div><div class="buttons right"><a form="form" class="button submit"><i class="icon-search"></i><?php echo L("查询");?>
</a></div></form></div><div class="toolbar"><a id="delall" class="button"><?php echo L("批量删除");?>
</a><a id="batch_toggle" class="button green"><?php echo L("选中项批量修改");?>
</a><a id="allstart" class="button"><?php echo L("批量启用");?>
</a><a id="allstop" class="button"><?php echo L("批量停用");?>
</a><form class="batch hide" id="batch"><div class="line"><label><?php echo L("终端型号");?>
：</label><select name="md_type" class="autofix" action="?m=terminal&a=option" required="true"><option selected='selected' value="%"><?php echo L("保留当前型号");?>
</option></select></div><div class="line"><label><?php echo L("所属代理商");?>
：</label><select  name="md_parent_ag" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['md_parent_ag'];?>
" class="autofix" action="?m=terminal&a=ag_option"><option selected='selected' value="%"><?php echo L("保留当前所属代理");?>
</option><option value="0"><?php echo L("OMP");?>
</option></select></div><a id="batch_submit" class="button"><?php echo L("批量修改");?>
</a></form></div><div><table class="full"><tr class='head' style="height: 35px;" type="ter" url="?m=terminal&action=index_list_item"><td width="110px" class="clickPage"><?php echo L("终端列表");?>
</td><td width="490px" class="clickPage" style="text-align:right;"><?php echo L("显示条数");?>
：</td><td width="50px" onclick="clickPage(this)" class="clickPage" <?php echo $_SESSION['color'][10];?>
 onmouseover="this.style.cursor='pointer'">10</td><td width="50px" onclick="clickPage(this)" class="clickPage" <?php echo $_SESSION['color'][20];?>
 onmouseover="this.style.cursor='pointer'">20</td><td width="50px" onclick="clickPage(this)" class="clickPage" <?php echo $_SESSION['color'][50];?>
 onmouseover="this.style.cursor='pointer'">50</td></tr></table></div><div class="content"></div><div id="dialog-confirm" class="hide" title="<?php echo L('删除选中项');?>
？"><p><?php echo L("确定要删除选中的设备吗");?>
？</p></div><div id="dialog-confirm-batch" class="hide" title="<?php echo L('更新选中项');?>
？"><p><?php echo L("确定要进行此操作吗");?>
？</p></div><script  <?php echo 'type="ready"';?>
>$("#batch_submit").click(function () {var checkd = "";$("input.cb:checkbox:checked").each(function () {checkd += $(this).val() + ",";});if (checkd === "") {notice("<?php echo L('未选中任何终端');?>
");} else {var data = $("form#batch").serialize() + "&" + $("form.data").serialize();$("#dialog-confirm-batch").dialog({resizable: false,height: 180,modal: true,buttons: {"<?php echo L("更新");?>
": function () {$(this).dialog("close");$.ajax({url: "?modules=terminal&action=term_batch",data: data,success: function () {send();}});},"<?php echo L("取消");?>
": function () {$(this).dialog("close");}}});}});</script><?php }} ?>