<?php /* Smarty version Smarty-3.1.11, created on 2016-05-23 13:36:32
         compiled from "..\template\modules\enterprise\view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24827574296e03c93e4-68963215%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e11cfb63860140cc071ffc82ee3102bb3066c9ae' => 
    array (
      0 => '..\\template\\modules\\enterprise\\view.tpl',
      1 => 1462762765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24827574296e03c93e4-68963215',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'phone_num' => 0,
    'dispatch_num' => 0,
    'gvs_num' => 0,
    'info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574296e0aab105_50533588',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574296e0aab105_50533588')) {function content_574296e0aab105_50533588($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("modules/enterprise/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<h2 class="title"><span title="<?php echo $_smarty_tpl->tpl_vars['data']->value['e_name'];?>
" class='ellipsis2 ctips' style='max-width: 350px;height: 20px;'><?php echo mbsubstr($_smarty_tpl->tpl_vars['data']->value['e_name'],20);?>
</span> - <?php echo L("企业信息");?>
</h2><?php if ($_smarty_tpl->tpl_vars['data']->value['e_sync']!="0"){?><?php }?><div class="form mrbt20"><div class="block "><label class="title"><?php echo L("企业编号");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
</span></div><div class="block "><label class="title"><?php echo L("企业名称");?>
：</label><span title='<?php echo $_smarty_tpl->tpl_vars['data']->value['e_name'];?>
' class='ellipsis2 ctips' style='max-width: 350px;height: 20px;'><?php echo mbsubstr($_smarty_tpl->tpl_vars['data']->value['e_name'],20);?>
</span></div><div class="block "><label class="title"><?php echo L("企业注册号");?>
：</label><span title='<?php echo $_smarty_tpl->tpl_vars['data']->value['e_regis_code'];?>
' class='ellipsis2 ctips' style='max-width: 350px;height: 20px;'><?php echo mbsubstr($_smarty_tpl->tpl_vars['data']->value['e_regis_code'],20);?>
</span></div><div class="block "><label class="title"><?php echo L("企业地址");?>
：</label><span title='<?php echo $_smarty_tpl->tpl_vars['data']->value['e_addr'];?>
' class='ellipsis2 ctips' style='max-width: 350px;height: 20px;'><?php echo mbsubstr($_smarty_tpl->tpl_vars['data']->value['e_addr'],20);?>
</span></div><div class="block "><label class="title"><?php echo L("企业位置");?>
：</label><span><?php echo mbsubstr($_smarty_tpl->tpl_vars['data']->value['e_location'],20);?>
</span></div><div class="block"><label class="title"><?php echo L("行业");?>
：</label><span><?php echo mbsubstr($_smarty_tpl->tpl_vars['data']->value['e_industry'],20);?>
</span></div><div class="block"><label class="title"><?php echo L("联系人");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['data']->value['e_contact_name'];?>
</span>&nbsp;<span><?php echo mbsubstr($_smarty_tpl->tpl_vars['data']->value['e_contact_surname'],20);?>
</span></div><div class="block"><label class="title"><?php echo L("电话");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['data']->value['e_contact_phone'];?>
</span></div><div class="block"><label class="title"><?php echo L("传真");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['data']->value['e_contact_fox'];?>
</span></div><div class="block"><label class="title"><?php echo L("邮箱");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['data']->value['e_contact_mail'];?>
</span></div><div class="block"><label class="title"><?php echo L("备注");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['data']->value['e_remark'];?>
</span></div><div class="block "><label class="title"><?php echo L("区域");?>
：</label><span><?php echo mod_area_name($_smarty_tpl->tpl_vars['data']->value['e_area']);?>
</span></div><div class="block "><label class="title"><?php echo L("状态");?>
：</label><span title='<?php echo L("不启用");?>
|<?php echo L("启用");?>
|<?php echo L("处理中");?>
|<?php echo L("发布失败");?>
，<?php echo L("启用时不能迁移".((string)$_SESSION['ident'])."-Server,只有具有录制功能才能迁移VCR。处于处理中时无法编辑企业");?>
。<?php echo L("当前状态");?>
<?php echo modifierStatus($_smarty_tpl->tpl_vars['data']->value['e_status']);?>
'><?php echo modifierStatus($_smarty_tpl->tpl_vars['data']->value['e_status']);?>
 <span style="font-size: 16px;color: red;"><?php if ($_smarty_tpl->tpl_vars['data']->value['e_status']==3){?>(<?php echo L("错误码");?>
:403)<?php }elseif($_smarty_tpl->tpl_vars['data']->value['e_status']==4){?>(<?php echo L("错误码");?>
:404)<?php }?></span></span></div><div class="block "><label class="title"><?php echo L(((string)$_SESSION['ident'])."-Server");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['data']->value['mds_d_name'];?>
<!-- 【<?php echo $_smarty_tpl->tpl_vars['data']->value['mds_d_ip1'];?>
】 --></span></div><div class="block "><label class="title"><?php echo $_SESSION['ident'];?>
-RS：</label><span><?php echo $_smarty_tpl->tpl_vars['data']->value['rs_name'];?>
</span></div><div class="block "><label class="title"><?php echo $_SESSION['ident'];?>
-SS：</label><span><?php echo $_smarty_tpl->tpl_vars['data']->value['ss_name'];?>
</span></div><div class="block "><label class="title"><?php echo L("企业用户数");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['phone_num']->value+$_smarty_tpl->tpl_vars['dispatch_num']->value+$_smarty_tpl->tpl_vars['gvs_num']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['data']->value['e_mds_users'];?>
</span></div><div class="block none"><label class="title"><?php echo L("并发数");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['data']->value['e_mds_call'];?>
</span></div><div class="block "><label class="title"><?php echo L("手机用户数");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['phone_num']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['data']->value['e_mds_phone'];?>
</span></div><div class="block "><label class="title"><?php echo L("调度台用户数");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['dispatch_num']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['data']->value['e_mds_dispatch'];?>
</span></div><div class="block "><label class="title"><?php echo L("GVS用户数");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['gvs_num']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['data']->value['e_mds_gvs'];?>
</span></div><!--管理员信息--><h2 class="title"> <?php echo L("管理员信息");?>
</h2><div class="block "><label class="title"><?php echo L("管理员ID");?>
：</label><span title='<?php echo $_smarty_tpl->tpl_vars['info']->value['em_id'];?>
'  style='max-width: 350px;height: 20px;'><?php echo mbsubstr($_smarty_tpl->tpl_vars['info']->value['em_id'],20);?>
</span></div><div class="block none"><label class="title"><?php echo L("管理员密码");?>
：</label><span style='max-width: 350px;height: 20px;'><?php echo $_smarty_tpl->tpl_vars['info']->value['em_pswd'];?>
</span></div><div class="block"><label class="title"><?php echo L("管理员名称");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['info']->value['em_admin_name'];?>
</span>&nbsp;<span><?php echo $_smarty_tpl->tpl_vars['info']->value['em_surname'];?>
</span></div><div class="block "><label class="title"><?php echo L("管理员电话");?>
：</label><span title='<?php echo $_smarty_tpl->tpl_vars['info']->value['em_phone'];?>
' style='max-width: 350px;height: 20px;'><?php echo mbsubstr($_smarty_tpl->tpl_vars['info']->value['em_phone'],20);?>
</span></div><div class="block"><label class="title"><?php echo L("管理员邮箱");?>
：</label><span style='max-width: 350px;height: 20px;'><?php echo $_smarty_tpl->tpl_vars['info']->value['em_mail'];?>
</span></div><?php if ($_smarty_tpl->tpl_vars['data']->value['e_has_vcr']=="1"){?><div class="block none"><label class="title"><?php echo L("VCR");?>
：</label><span><?php echo $_smarty_tpl->tpl_vars['data']->value['vcr_d_ip1'];?>
</span></div><?php }?><div class="buttons mrtop40"><a href="?m=enterprise&a=edit&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" class="button " title='<?php echo L("编辑企业名称状态功能等信息");?>
'><?php echo L("编辑企业信息");?>
</a><a href="?m=enterprise&a=admins_edit&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
&em_id=<?php echo $_smarty_tpl->tpl_vars['info']->value['em_id'];?>
" class="button " title='<?php echo L("编辑企业管理员信息");?>
'><?php echo L("编辑管理员信息");?>
</a><?php if ($_smarty_tpl->tpl_vars['data']->value['e_mds_id']>0){?><?php if ($_smarty_tpl->tpl_vars['data']->value['e_status']=="1"){?><a id="stop_status" class="button red" title="<?php echo L('停用该企业，销户');?>
"><?php echo L("停用该企业");?>
</a><?php }elseif($_smarty_tpl->tpl_vars['data']->value['e_status']=="0"){?><a id="start_status" class="button normal" title="<?php echo L('启用该企业，开户');?>
"><?php echo L("启用该企业");?>
</a><?php }?><?php }?><a href="?m=enterprise&a=move_device&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" class="button " title='<?php echo L("迁移".((string)$_SESSION['ident'])."-设备信息");?>
'><?php echo L("迁移设备");?>
</a><?php if ($_smarty_tpl->tpl_vars['data']->value['e_id']!='999999'){?><?php if ($_SESSION['ag']['ag_level']!='1'){?><a href="javascript:;" id="move_enterprise" class="button" title="<?php echo L('迁移所属');?>
"><?php echo L("迁移所属");?>
</a><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['data']->value['e_status']=="0"||$_smarty_tpl->tpl_vars['data']->value['e_status']=="1"||$_smarty_tpl->tpl_vars['data']->value['e_status']=="2"||$_smarty_tpl->tpl_vars['data']->value['e_status']=="3"){?><a id="initdb" class="button purple none " title="<?php echo L('重新建立企业用户表');?>
"><?php echo L("企业数据重建");?>
</a><?php }?><a href="?m=enterprise&a=enterprise_history&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" class="button" title="<?php echo L('企业变更记录');?>
"><?php echo L("企业变更记录");?>
</a><?php if ($_smarty_tpl->tpl_vars['data']->value['e_sync']!="0"&&$_smarty_tpl->tpl_vars['data']->value['e_status']!="3"){?><a id="sync" class="button green none" title="<?php echo L('企业数据下发至子设备');?>
"><?php echo L("企业数据同步");?>
</a><?php }?></div></div><div id="dialog-confirm-warn" class="hide" title="<?php echo L('重要操作确认');?>
？"><p><?php echo L("确认要重建该企业数据？该操作会导致该企业所有用户，企业群组，企业日志，企业通讯录数据丢失。");?>
<br />[<?php echo L("一般在创建企业时，如果未能正常使用时，才考虑该项");?>
！]<br /><span class="red">如果您不知道此项是做什么用的，请不要点击！</span></p></div><div id="dialog-move" class="hide" title="<?php echo L('区域以及许可符合迁移条件的目标');?>
" style="overflow:auto"><input type="hidden" id="e_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" /></div><div id="dialog-notice" class="hide" title="<?php echo L('确认迁移');?>
"><p id="notice" style="font-size:18px"><?php echo L("确认要迁移该企业？该操作会改变该企业所属代理、企业创建者以及企业下的用户绑定的流量卡和终端的所属代理。");?>
</p><br /><p class="red" style="font-size:15px"><?php echo L("迁移后，企业内终端以及流量卡等信息的所属均会更改， 是否继续迁移");?>
？</p></div><?php }} ?>