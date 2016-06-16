<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 19:07:17
         compiled from "..\template\modules\agents\agents_save.tpl" */ ?>
<?php /*%%SmartyHeaderCode:245415735b5654ca839-82083817%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e363999243e567e09c4f8872a9e67590dcf3b909' => 
    array (
      0 => '..\\template\\modules\\agents\\agents_save.tpl',
      1 => 1462762765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '245415735b5654ca839-82083817',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'data' => 0,
    'res' => 0,
    'info' => 0,
    'phone_num' => 0,
    'dispatch_num' => 0,
    'gvs_num' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5735b5657c4461_69578779',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5735b5657c4461_69578779')) {function content_5735b5657c4461_69578779($_smarty_tpl) {?><h2 class="title"><?php echo L(((string)$_smarty_tpl->tpl_vars['title']->value));?>
</h2><script src="script/plugins/intlTelInput.js"></script><form id="form" class="base mrbt10" action="?modules=agents&action=save&ag_number=<?php echo $_smarty_tpl->tpl_vars['data']->value;?>
"><input autocomplete="off"  value="0" name="ag_parent_id" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['res']->value['do'];?>
" name="do" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_level'];?>
" name="ag_level" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_path'];?>
" name="ag_path" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_phone_num'];?>
" name="diff_phone" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_dispatch_num'];?>
" name="diff_dispatch" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_gvs_num'];?>
" name="diff_gvs" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['phone_num']->value;?>
" name="phone_num" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['dispatch_num']->value;?>
" name="dispatch_num" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['gvs_num']->value;?>
" name="gvs_num" type="hidden" /><input autocomplete="off"  value='<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_area'];?>
' name="ag_area" type="hidden" /><div class="block"><label class="title"><?php echo L("编号");?>
：</label><?php if ($_smarty_tpl->tpl_vars['res']->value['do']=="edit"){?><input chinese="true" autocomplete="off"   maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_number'];?>
" name="ag_number" type="text" required="true" readonly="true" /><?php }else{ ?><input chinese="true" autocomplete="off"   maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['data']->value;?>
" name="ag_number" type="text" required="true" readonly="true" /><?php }?></div><div class="block none"><label class="title"><?php echo L("登陆帐号");?>
：</label><?php if ($_smarty_tpl->tpl_vars['res']->value['do']=="edit"){?><input chinese="true" autocomplete="off"   maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_id'];?>
" name="ag_id" type="text" required="true" readonly="true" /><?php }else{ ?><input chinese="true" autocomplete="off"  maxlength="32" name="ag_id" type="text" required="true" /><?php }?></div><div class="block"><label class="title"><?php echo L("密码");?>
：</label><input autocomplete="off" maxlength="32" id="password" paswd="true" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_pswd'];?>
" name="ag_pswd" type="password" required="true" /><?php if ($_smarty_tpl->tpl_vars['res']->value['do']=="edit"){?><label class="show_passwd" style="font-size: 12px;color: #a43838;"><?php echo L("查看密码");?>
</label><?php }?></div><div class="block"><label class="title"><?php echo L("代理商名称");?>
：</label><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_name'];?>
"  maxlength="32" chinese="true" name="ag_name" type="text" required="true" /></div><div class="block"><label class="title"><?php echo L("地址");?>
：</label><input  autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_addr'];?>
"  maxlength="32"  name="ag_addr" type="text" required="true" /></div><div class="block"><label class="title"><?php echo L("名字");?>
：</label><input  maxlength="32" autocomplete="off"  maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_conname'];?>
" placeholder="<?php echo L('名字');?>
" chinese="true" name="ag_conname" type="text"  required="true" /></div><div class="block"><label class="title"><?php echo L("姓氏");?>
：</label><input  maxlength="32" autocomplete="off"   maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_username'];?>
" placeholder="<?php echo L('姓氏');?>
" chinese="true" name="ag_username" type="text"  required="true" /></div><div class="block"><label class="title"><?php echo L("手机号");?>
：</label><input class="mobile-number" mobile1="true" type="text" style="height: 28px;width: 245px;border:1px solid #ccc;" name="ag_phone" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_phone'];?>
" /></div><div class="block"><label class="title"><?php echo L("邮箱");?>
：</label><input autocomplete="off"  maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_mail'];?>
" name="ag_mail" type="text" required="true"  email="true"  /></div><div class="block"><label class="title"><?php echo L("联系传真");?>
：</label><input fox="true"  maxlength="64" autocomplete="off" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_fox'];?>
" maxlength="32" name="ag_fox" type="text" /></div><div class="block"><label class="title" style="float:left;"><?php echo L("备注");?>
：</label><textarea autocomplete="off" maxlength="100" name="ag_remark" remark="true" style="width:240px;height:100px;padding:5px;"><?php echo $_smarty_tpl->tpl_vars['info']->value['ag_remark'];?>
</textarea></div><div class="block"><label class="title"><?php echo L("区域");?>
：</label><select name="ag_area" class="autofix <?php if ($_smarty_tpl->tpl_vars['res']->value['do']=="edit"){?>autoeditselect<?php }?>" <?php if ($_smarty_tpl->tpl_vars['res']->value['do']=="edit"){?>disabled<?php }?> value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['ag_area'], ENT_QUOTES, 'UTF-8', true);?>
'  action="?m=area&a=option" selected="true" data='[{ "to": "e_mds_id","field": "d_area","view":"false" }]'><option value='@'><?php echo L("未选择");?>
</option></select></div><div class="block none "><label maxlength="32" class="title"><?php echo L("企业用户数");?>
：</label><input  maxlength="32" autocomplete="off"  value='<?php echo $_smarty_tpl->tpl_vars['info']->value['ag_user_num'];?>
' name="ag_user_num" type="text"  readonly /></div><hr /><div class="block"><label class="title"><?php echo L("分配手机用户数");?>
：</label><input  maxlength="32"  autocomplete="off"  maxlength="32" value='<?php echo (($tmp = @$_smarty_tpl->tpl_vars['info']->value['ag_phone_num'])===null||$tmp==='' ? 0 : $tmp);?>
' range="[0,999999999]" name="ag_phone_num" type="text" required="true" digits ="true" /></div><div class="block"><label class="title"><?php echo L("分配调度台用户数");?>
：</label><input  maxlength="32"  autocomplete="off"  maxlength="32" value='<?php echo (($tmp = @$_smarty_tpl->tpl_vars['info']->value['ag_dispatch_num'])===null||$tmp==='' ? 0 : $tmp);?>
' range="[0,999999999]" name="ag_dispatch_num" type="text"  digits ="true" /></div><div class="block"><label class="title"><?php echo L("分配GVS用户数");?>
：</label><input  maxlength="32" autocomplete="off"  maxlength="32" value='<?php echo (($tmp = @$_smarty_tpl->tpl_vars['info']->value['ag_gvs_num'])===null||$tmp==='' ? 0 : $tmp);?>
' range="[0,999999999]" name="ag_gvs_num" type="text"  digits ="true" /></div><div class="buttons mrtop40"><a goto="?m=agents&a=index" form="form" class="ajaxpost_a button normal"><?php echo L("保存");?>
</a><a class="goback button"><?php echo L("取消");?>
</a></div></form><?php }} ?>