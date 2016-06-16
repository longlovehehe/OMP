<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 19:03:14
         compiled from "..\template\modules\agents\agents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:298845735b4723ccfc6-17346295%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff98c17aca521a3996d855e3e04e000127cb4253' => 
    array (
      0 => '..\\template\\modules\\agents\\agents.tpl',
      1 => 1437362616,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '298845735b4723ccfc6-17346295',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5735b4724bf309_70038967',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5735b4724bf309_70038967')) {function content_5735b4724bf309_70038967($_smarty_tpl) {?><div class="toptoolbar "><a href="?m=agents&a=agents_save" class="button orange"><?php echo L("新增代理商");?>
</a></div><h2 class="title"><span class='ellipsis2' style='max-width: 350px;height: 20px;'><?php echo L("代理商管理");?>
</h2><div class="toolbar"><form action="?m=agents&a=agents_item" id="form" method="post"><input autocomplete="off"  name="modules" value="agents" type="hidden" /><input autocomplete="off"  name="action" value="agents_item" type="hidden" /><input autocomplete="off"  name="page" value="0" type="hidden" /><h3 class="title"><?php echo L("基本属性");?>
</h3><div class="line"><label><?php echo L("编号");?>
：</label><input  autocomplete="off"  class="autosend" name="ag_number" type="text" /></div><div class="line none"><label><?php echo L("登陆帐号");?>
：</label><input  autocomplete="off"  class="autosend" name="ag_id" type="text" /></div><div class="line"><label><?php echo L("代理商名称");?>
：</label><input  autocomplete="off"  class="autosend" name="ag_name" type="text" /></div><div class="line"><label><?php echo L("联系人姓名");?>
：</label><input  autocomplete="off"  class="autosend" name="ag_admin_name" type="text" /></div><div class="line"><label><?php echo L("电话");?>
：</label><input  autocomplete="off"  class="autosend" name="ag_phone" type="text" /></div><div class="line"><label><?php echo L("E-Mail");?>
：</label><input  autocomplete="off"  class="autosend" name="ag_mail" type="text" /></div><div class="buttons right"><a form="form" class="button submit"><i class="icon-search"></i><?php echo L("查询");?>
</a></div></form></div><div class="toolbar"><a id="delall" class="button"><?php echo L("批量删除");?>
</a></div><div class="content"></div><div id="dialog-confirm" class="hide" title="<?php echo L('删除选中项');?>
？"><p><?php echo L("确定要删除选中的企业用户吗");?>
？</p></div><div id="dialog-confirm-batch" class="hide" title="<?php echo L('更新选中项');?>
？"><p><?php echo L("确定要批量更新选中的企业用户吗");?>
？</p></div><?php }} ?>