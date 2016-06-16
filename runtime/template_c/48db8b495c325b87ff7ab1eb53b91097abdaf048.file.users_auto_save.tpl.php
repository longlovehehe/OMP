<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 10:08:00
         compiled from "..\template\modules\enterprise\users_auto_save.tpl" */ ?>
<?php /*%%SmartyHeaderCode:886573537000109e4-63017903%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48db8b495c325b87ff7ab1eb53b91097abdaf048' => 
    array (
      0 => '..\\template\\modules\\enterprise\\users_auto_save.tpl',
      1 => 1446035442,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '886573537000109e4-63017903',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'list' => 0,
    'phone_num' => 0,
    'dispatch_num' => 0,
    'gvs_num' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57353700446ce8_76398900',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57353700446ce8_76398900')) {function content_57353700446ce8_76398900($_smarty_tpl) {?><h2 class="title"><?php echo L("批量新增企业用户");?>
</h2><form id="form" class="base mrbt10" target="ifr"><input autocomplete="off"  value="enterprise" name="modules" type="hidden" /><input autocomplete="off"  value="users_auto_save_shell" name="action" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" name="e_id" type="hidden" /><input autocomplete="off"  value="0" name="step" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['list']->value['e_mds_phone']-$_smarty_tpl->tpl_vars['phone_num']->value;?>
" name="e_mds_phone" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['list']->value['e_mds_dispatch']-$_smarty_tpl->tpl_vars['dispatch_num']->value;?>
" name="e_mds_dispatch" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['list']->value['e_mds_gvs']-$_smarty_tpl->tpl_vars['gvs_num']->value;?>
" name="e_mds_gvs" type="hidden" /><div class="block"><div class="radioset" id="radioset" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_sub_type'];?>
"><input autocomplete="off"  class="checked_radio" value="1" type="radio" id="radio_user" name="u_sub_type"  checked="checked" /><label for="radio_user"><?php echo L("手机用户");?>
</label><input autocomplete="off" class="checked_radio"  value="2" type="radio" id="radio_shelluser" name="u_sub_type" /><label for="radio_shelluser"><?php echo L("调度台用户");?>
</label><input autocomplete="off" class="checked_radio"  value="3" type="radio" id="radio_gvsuser" name="u_sub_type" /><label for="radio_gvsuser"><?php echo L("GVS用户");?>
</label></div></div><h3 class="title"><?php echo L("基本属性");?>
</h3><hr /><div class="block"><label class="title"><?php echo L("起始帐号");?>
：</label><input autocomplete="off"   maxlength="32" name="u_auto_pre" type="text" required="true" digits="true" u_number="true" /></div><div class="block"><label class="title"><?php echo L("数量");?>
：</label><input autocomplete="off"   maxlength="32" name="u_auto_number" u_auto_number="true" type="text"  digits="true"  /><span id="num_sure" style="color:#A43838;" class="surenum "> <?php echo L("手机用户当前最大可输入");?>
<?php echo $_smarty_tpl->tpl_vars['list']->value['e_mds_phone']-$_smarty_tpl->tpl_vars['phone_num']->value;?>
</span></div><div class="block"><label class="title"><?php echo L("密码");?>
：</label><div class="line"><label><input autocomplete="off"  value="1" name="u_auto_pwd" type="radio" /><?php echo L("与帐号相同");?>
</label></div><div class="line"><label><input autocomplete="off"  value="0" name="u_auto_pwd" type="radio" checked="checked" /><?php echo L("随机生成");?>
</label></div></div><div class="block sw user shelluser"><label class="title"><?php echo L("默认群组");?>
：</label><select value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_default_pg'];?>
" name="u_default_pg" class="autofix autoedit" action="?m=enterprise&a=groups_option&safe=true&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"><option value=""><?php echo L("未指定");?>
</option></select></div><div class="block sw user"><label class="title"><?php echo L("订购产品");?>
：</label><select value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_product_id'];?>
" name="u_product_id" class="autofix autoedit" action="?m=product&a=option&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" ><option value=""><?php echo L("无");?>
</option></select></div><div class="block sw user none"><div class="block" style="float:left"><label class="title" style=""><?php echo L("增值功能");?>
：</label></div><div class="title" style="width:220px; border:1px solid #ccc; padding: 10px;"><div id="product_select" class="autofix  autocheck"  value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['u_p_function'], ENT_QUOTES, 'UTF-8', true);?>
" action="?m=product&a=ip_option&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"></div></div><div class="title " style="width:220px; border:1px solid #ccc; padding: 10px;"><div id="product_select" class="autofix  autocheck"  value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['u_p_function'], ENT_QUOTES, 'UTF-8', true);?>
" action="?m=product&a=ip_option&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"></div></div></div><div class="block"><label class="title"><?php echo L("部门");?>
：</label><select value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_ug_id'];?>
" name="u_ug_id" class="autofix autoedit" action="?modules=api&action=get_groups_list&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"><option value=""><?php echo L("未指定");?>
</option></select></div><div class="block radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_active_state'];?>
"><div class="line"><label class="title"><?php echo L("用户状态");?>
：</label><label class="radiotext"><input autocomplete="off"  value="1" name="u_active_state" type="radio"  checked="checked" /><span><?php echo L("启用");?>
</span></label><label class="radiotext"><input autocomplete="off"  value="0" name="u_active_state" type="radio" /><span><?php echo L("停用");?>
</span></label></div></div><div id="u_only_show_my_grp" class="sw user  shelluser block radio" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['u_only_show_my_grp'])===null||$tmp==='' ? 0 : $tmp);?>
"><label class="title"><?php echo L("只显示本部门");?>
：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" class="u_only_show_my_grp" name="u_only_show_my_grp" type="radio"   /><?php echo L("启用");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" class="u_only_show_my_grp" name="u_only_show_my_grp" type="radio" checked="checked"  /><?php echo L("停用");?>
</label></div></div><div class="block radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_attr_type'];?>
"><div class="line"><label class="title"><?php echo L("用户分类");?>
：</label><label class="radiotext"><input autocomplete="off"  value="1" name="u_attr_type" type="radio"  /><span><?php echo L("测试");?>
</span></label><label class="radiotext"><input autocomplete="off"  value="0" name="u_attr_type" type="radio" checked="checked"  /><span><?php echo L("商用");?>
</span></label></div></div><div class="sw user block"><label class="title"><?php echo L("GPS定位上报方式");?>
：</label><select name="u_gis_mode" class="autoedit" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['u_gis_mode'])===null||$tmp==='' ? 3 : $tmp);?>
"><option value="0"><?php echo L("不上报");?>
</option><option value="1"><?php echo L("强制百度智能定位");?>
</option><option value="3"><?php echo L("强制百度GPS定位");?>
</option><option value="4"><?php echo L("强制GPS定位");?>
</option><option value="2"><?php echo L("客户端设置");?>
</option></select></div><div class="block radio sw user" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_auto_config'];?>
"><label class="title"><?php echo L("自动登录开关");?>
：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" name="u_auto_config" type="radio" /><?php echo L("开");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" name="u_auto_config" type="radio" checked="checked" /><?php echo L("关");?>
</label></div></div><div class="auto_config <?php if ($_smarty_tpl->tpl_vars['item']->value['u_auto_config']==0){?>hide<?php }?> "><div class="block radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_gprs_genus'];?>
"><label class="title"><?php echo L("流量卡所属");?>
：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" name="u_gprs_genus" type="radio" /><?php echo L("用户自有");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" name="u_gprs_genus" type="radio" checked="checked" /><?php echo L("运营商提供");?>
</label></div></div><div class="block radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_auto_run'];?>
"><label class="title"><?php echo L("强制开机启动");?>
：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" name="u_auto_run" type="radio" /><?php echo L("启用");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" name="u_auto_run" type="radio" checked="checked" /><?php echo L("停用");?>
</label></div></div><div class="block radio" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['u_checkup_grade'])===null||$tmp==='' ? 1 : $tmp);?>
"><label class="title"><?php echo L("程序检查更新");?>
：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" name="u_checkup_grade" type="radio" /><?php echo L("启用");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" name="u_checkup_grade" type="radio" checked="checked" /><?php echo L("停用");?>
</label></div></div><div class="block radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_encrypt'];?>
"><label class="title"><?php echo L("信令加密");?>
：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" name="u_encrypt" type="radio" /><?php echo L("启用");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" name="u_encrypt" type="radio" checked="checked" /><?php echo L("停用");?>
</label></div></div><div class="sw user block radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_audio_mode'];?>
"><div class="line radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_audio_mode'];?>
"><label class="title"><?php echo L("语音通话方式");?>
：</label><label class="radiotext"><input autocomplete="off"  value="0" name="u_audio_mode" type="radio"  /><span><?php echo L("移动电话");?>
</span></label><label class="radiotext"><input autocomplete="off"  value="1" name="u_audio_mode" type="radio" checked="checked"  /><span><?php echo L("VoIP电话");?>
</span></label></div></div></div><div class="buttons mrtop40"><a id="create" class="button normal"><?php echo L("生成");?>
</a><a class="goback button" action="?m=enterprise&a=users&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"><?php echo L("取消");?>
</a></div></form><div class="makeing info_text hide"><h2 class="title "><?php echo L("正在生成中，目前已处理");?>
 <span id="u_step_text"></span> <?php echo L("个，还差");?>
 <span id="u_step_number_text"></span> <?php echo L("个");?>
</h2><progress max="<?php echo $_smarty_tpl->tpl_vars['data']->value['max'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['value'];?>
" class="progress"></progress></div><iframe id="iframe" name="ifr" class="display_box hide"></iframe>
<?php }} ?>