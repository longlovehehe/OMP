<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 09:31:33
         compiled from "..\template\modules\enterprise\add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1417057352e75530d80-23484604%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a50e69937f3acf4aea8d489e32cdd1074fd7254' => 
    array (
      0 => '..\\template\\modules\\enterprise\\add.tpl',
      1 => 1462762765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1417057352e75530d80-23484604',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'item' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57352e75734808_87055585',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57352e75734808_87055585')) {function content_57352e75734808_87055585($_smarty_tpl) {?><script src="script/plugins/intlTelInput.js"></script><h2 class="title"><?php echo L(((string)$_smarty_tpl->tpl_vars['title']->value));?>
</h2><form id="form" class="base mrbt10" action="?modules=enterprise&action=save_shell"><div class="block"><label class="title"><?php echo L("企业名称");?>
：</label><input  maxlength="64" autocomplete="off" ep_name="true"  name="e_name" type="text" required="true" /></div><div class="block"><label class="title"><?php echo L("企业注册号");?>
：</label><input maxlength="64" autocomplete="off"  name="e_regis_code" type="text" /></div><div class="block"><label class="title"><?php echo L("企业地址");?>
：</label><input  autocomplete="off"   maxlength="64" name="e_addr" type="text" required="true" /></div><div class="block"><label class="title"><?php echo L("企业位置");?>
：</label><input  autocomplete="off" maxlength="64" name="e_location" type="text"/></div><div class="block"><label class="title"><?php echo L("行业");?>
：</label><input  maxlength="64" autocomplete="off"   name="e_industry" type="text" /></div><div class="block"><label class="title"><?php echo L("名字");?>
：</label><input  maxlength="32" autocomplete="off" placeholder="<?php echo L('名字');?>
"  value='' chinese="true" name="e_contact_name" type="text"  required="true" /></div><div class="block"><label class="title"><?php echo L("姓氏");?>
：</label><input  maxlength="32" autocomplete="off" placeholder="<?php echo L('姓氏');?>
"  value='' chinese="true" name="e_contact_surname" type="text"  required="true" /></div><div class="block"><label class="title"><?php echo L("联系电话");?>
：</label><input class="mobile-number" maxlength="32" mobile1="true" type="text" style="height: 28px;width: 242px;border:1px solid #ccc;" name="e_contact_phone" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['e_contact_phone'];?>
" required="true"/></div><div class="block"><label class="title"><?php echo L("联系传真");?>
：</label><input fox="true"  autocomplete="off"  maxlength="32" name="e_contact_fox" type="text" /></div><div class="block"><label class="title"><?php echo L("邮箱");?>
：</label><input  maxlength="32" autocomplete="off"   value='' email="true" name="e_contact_mail" type="text" required="true"  /></div><div class="block"><label class="title" style="float:left;"><?php echo L("备注");?>
：</label><textarea autocomplete="off" maxlength="100" name="e_remark" remark="true" style="width:240px;height:100px;padding:5px;"></textarea></div><div class="block"><label class="title"><?php echo L("区域");?>
：</label><select name="e_area" class="autofix autoselect" action="?m=area&a=option" selected="true" data='[{ "to": "e_mds_id","field": "d_area","view":"false" }]'><option value='@'><?php echo L("未选择");?>
</option></select></div><input autocomplete="off"  value="0" name="e_status" type="hidden" checked="checked" /><div class="block none"><label class="title"><?php echo L("企业密码");?>
：</label><input  maxlength="32" autocomplete="off"  onpaste="return false"  e_pwd="true" name="e_pwd" type="text"/></div><div class="block"><label class="title"><?php echo L("请选择所属");?>
 <?php echo $_SESSION['ident'];?>
-Server：</label><select value="" id="e_mds_id" name="e_mds_id" size="10"  class=" long" action="?m=device&action=mds_option" selected="true" data='[{ "to": "e_vcr_id","field": "d_deployment_id","view":"false" }]'></select></div><div class="block "><label maxlength="32" class="title"><?php echo L("企业用户数");?>
：</label><input  maxlength="32" autocomplete="off"  value='0' name="e_mds_users" type="text"  readonly /></div><div class="block none"><label class="title"><?php echo L("企业并发数");?>
：</label><input  maxlength="32" autocomplete="off"  maxlength="32" value='0' name="e_mds_call" type="text" required="true" digits ="true" /></div><div class="block"><label class="title"><?php echo L("分配手机用户数");?>
：</label><input  maxlength="32"  autocomplete="off"  maxlength="32" value='0' name="e_mds_phone" type="text" required="true" digits ="true" /></div><div class="block"><label class="title"><?php echo L("分配调度台用户数");?>
：</label><input  maxlength="32"  autocomplete="off"  maxlength="32" value='0' name="e_mds_dispatch" type="text"  digits ="true" /></div><div class="block"><label class="title"><?php echo L("分配GVS用户数");?>
：</label><input  maxlength="32" autocomplete="off"  maxlength="32" value='0' name="e_mds_gvs" type="text"  digits ="true" /></div><div class="block"><label class="title"><?php echo L("预计并发数");?>
：</label><input  maxlength="32" autocomplete="off"  value='0' id="e_rs_rec" name="e_rs_rec" type="text"  readonly /><input id="e_has_vcr" name="e_has_vcr" type="hidden" value="0"/></div><div class="block"><label class="title"><?php echo L("请选择所属");?>
 <?php echo $_SESSION['ident'];?>
-RS：</label><select value="" id="e_vcr_id" name="e_vcr_id" size="10"  class=" long" action="?m=device&action=rs_option" ></select></div><div class="block"><label class="title"><?php echo L("请选择所属");?>
 <?php echo $_SESSION['ident'];?>
-SS：</label><select value="" id="e_ss_id" name="e_ss_id" size="10"  class=" long" action="?m=device&action=ss_option" selected="true"></select></div><h2 class="title"><?php echo L("企业管理员配置");?>
</h2><div class="block"><label class="title"><?php echo L("名字");?>
：</label><input  maxlength="32" autocomplete="off" placeholder="<?php echo L('名字');?>
"  value='' chinese="true" name="em_admin_name" type="text"  required="true" /></div><div class="block"><label class="title"><?php echo L("姓氏");?>
：</label><input  maxlength="32" autocomplete="off"  placeholder="<?php echo L('姓氏');?>
"  value='' chinese="true" name="em_surname" type="text"  required="true" /></div><div class="block"><label class="title"><?php echo L("管理员密码");?>
：</label><input  maxlength="32" autocomplete="off" value='' paswd="true" id="password" name="em_pswd" type="password" required="true"  /></div><div class="block"><label class="title"><?php echo L("手机号");?>
：</label><input class="mobile-number"  maxlength="32" mobile1="true" type="text" style="height: 28px;width: 242px;border:1px solid #ccc;" name="em_phone" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['em_phone'];?>
" required="true"/></div><div class="block"><label class="title"><?php echo L("邮箱");?>
：</label><input  maxlength="32" autocomplete="off"   value='' email="true" name="em_mail" type="text" required="true"  /></div><div class="block"><label class="title"><?php echo L("描述");?>
：</label><input chinese="true" maxlength="1024" autocomplete="off" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['em_desc'];?>
" name="em_desc" type="text" /></div><div class="buttons mrtop40"><a goto="?m=enterprise&a=index" form="form" class="ajaxpost button normal"><?php echo L("保存");?>
</a><a class="goback button"><?php echo L("取消");?>
</a></div></form><script <?php echo 'type="ready"';?>
></script>
<?php }} ?>