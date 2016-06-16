<?php /* Smarty version Smarty-3.1.11, created on 2016-05-23 13:36:35
         compiled from "..\template\modules\enterprise\users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2500574296e32e7561-75185092%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '669822fec8476218b3b09c28f883a59ea047d3da' => 
    array (
      0 => '..\\template\\modules\\enterprise\\users.tpl',
      1 => 1460104922,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2500574296e32e7561-75185092',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'page' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574296e3963962_05836214',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574296e3963962_05836214')) {function content_574296e3963962_05836214($_smarty_tpl) {?>    <?php echo $_smarty_tpl->getSubTemplate ("modules/enterprise/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<h2 class="title"><span class='ellipsis2' style='max-width: 350px;height: 20px;'><?php echo mbsubstr($_smarty_tpl->tpl_vars['data']->value['e_name'],20);?>
</span> - <?php echo L("企业用户");?>
</h2><div class="toptoolbar  p20"><a href="?m=enterprise&a=users_save&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" class="button orange"><?php echo L("新增企业用户");?>
</a><a href="?m=enterprise&a=users_auto_save&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" class="button orange"><?php echo L("批量新增企业用户");?>
</a></div><div class="toolbar"><form action="?m=enterprise&a=users_item&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" id="form" method="post"><input autocomplete="off"  name="modules" value="enterprise" type="hidden" /><input autocomplete="off"  name="action" value="users_item" type="hidden" /><input autocomplete="off"  name="e_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" type="hidden" /><input autocomplete="off"  name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" type="hidden" /><h3 class="title"><?php echo L("基本属性");?>
</h3><div class="line"><label><?php echo L("姓名");?>
：</label><input value='<?php echo $_REQUEST['u_name'];?>
' autocomplete="off"  class="autosend" name="u_name" type="text" /></div><div class="line"><label><?php echo L("号码");?>
：</label><input value='<?php echo $_REQUEST['u_number'];?>
' autocomplete="off"  class="autosend" name="u_number" type="text" /></div><div class="line"><label><?php echo L("用户类型");?>
：</label><select name="u_sub_type"><option value=""><?php echo L("全部");?>
</option><option value="1"><?php echo L("手机用户");?>
</option><option value="2"><?php echo L("调度台用户");?>
</option><option value="3"><?php echo L("GVS用户");?>
</option></select></div><div class="line"><label><?php echo L("订购产品");?>
：</label><select name="u_product_id" class="autofix" action="?m=product&a=option&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" ><option value=""><?php echo L("全部");?>
</option></select></div><div class="line none"><label><?php echo L("默认群组");?>
：</label><select name="u_default_pg" class="autofix" action="?m=enterprise&a=groups_option&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"><option value=""><?php echo L("全部");?>
</option></select></div><div class="line"><label><?php echo L("部门");?>
：</label><select name="u_ug_id" class="autofix" action="?modules=api&action=get_groups_list&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" ><option value=""><?php echo L("全部");?>
</option></select></div><div class="line"><label><?php echo L("用户分类");?>
：</label><select name="u_attr_type" ><option value=""><?php echo L("全部");?>
</option><option value="1"><?php echo L("测试");?>
</option><option value="0"><?php echo L("商用");?>
</option></select></div><div class="line none"><div class="line" style="float:left;width: 50px;"><label class="title" style=""><?php echo L("增值功能");?>
：</label></div><div class="line" style="width:640px;"><div id="product_select" class="autofix  autocheck"  value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['u_p_function'], ENT_QUOTES, 'UTF-8', true);?>
" action="?m=product&a=ip_option&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"></div></div></div><h3 class="title"><?php echo L("详细属性");?>
<a class="toggle alink" data="detailed"><?php echo L("展开");?>
↓</a></h3><div class="detailed none"><div class="line none"><label><?php echo L("头像");?>
：</label><select name="u_pic"><option value=""><?php echo L("全部");?>
</option><option value="1"><?php echo L("有头像");?>
</option><option value="0"><?php echo L("无头像");?>
</option></select></div><div class="line none"><label><?php echo L("性别");?>
：</label><select name="u_sex"><option value=""><?php echo L("全部");?>
</option><option value="M"><?php echo L("男");?>
</option><option value="F"><?php echo L("女");?>
</option></select></div><div class="line none"><label><?php echo L("手机号");?>
：</label><input autocomplete="off"  class="autosend" name="u_mobile_phone" type="text" /></div><div class="line none"><label>UDID：</label><input autocomplete="off"  class="autosend" name="u_udid" type="text" /></div><div class="line"><label>IMSI：</label><input autocomplete="off"  class="autosend" name="u_imsi" type="text" /></div><div class="line"><label>IMEI：</label><input autocomplete="off"  class="autosend" name="u_imei" type="text" /></div><div class="line"><label>ICCID：</label><input autocomplete="off"  class="autosend" name="u_iccid" type="text" /></div><div class="line"><label>MAC：</label><input autocomplete="off"  class="autosend" name="u_mac" type="text" /></div><div class="line"><label><?php echo L("终端类型");?>
：</label><input autocomplete="off"  class="autosend" name="u_terminal_type" type="text" /></div></div><div class="buttons right"><a form="form" class="button submit" style="margin-right: 60px"><i class="icon-search"></i><?php echo L("查询");?>
</a></div></form></div><div class="toolbar"><a id="delall" class="button"><?php echo L("批量删除");?>
</a><a id="batch_toggle" class="button green"><?php echo L("选中项批量修改");?>
</a><a id="move_user" class="button green"><?php echo L("选中项移动到企业");?>
</a><a id="move_u_default_pg" class="button green"><?php echo L("选中项分配到群组");?>
</a><form class="batch hide" id="batch" action="?modules=enterprise&action=users_item&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"><input type="hidden" name="submit_type" value="batch"><div class="line"><label style="width:100px;"><?php echo L("订购产品");?>
：</label><select name="u_product_id" class="autofix" action="?m=product&a=option&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" required="true"><option value=""><?php echo L("清除产品信息");?>
</option><option selected='selected' value="%"><?php echo L("保留产品信息");?>
</option></select></div><div class="line"><input name="isused" type="checkbox" value="on"/><label><?php echo L("次月生效");?>
</label></div><br/><div class="line"><label style="width:100px;"><?php echo L("GPS上报方式");?>
：</label><select name="u_gis_mode"><option selected='selected' value="%"><?php echo L("保留上报方式");?>
</option><option value="0"><?php echo L("不上报");?>
</option><option value="1"><?php echo L("强制百度智能定位");?>
</option><option value="3"><?php echo L("强制百度GPS定位");?>
</option><option value="4"><?php echo L("强制GPS定位");?>
</option><option value="2"><?php echo L("客户端设置");?>
</option></select></div><div class="line"><label style="width:100px;"><?php echo L("拍传接收号码");?>
：</label><select name="u_mms_default_rec_num" class="autofix" action="?m=enterprise&a=shelluser&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" required="true"><option selected='selected' value="%"><?php echo L("保留拍传接收号码");?>
</option><option value=""><?php echo L("无");?>
</option></select></div><div class="line"><label style="width:100px;"><?php echo L("所属部门");?>
：</label><select name="u_ug_id" class="autofix" action="?modules=api&action=get_groups_list&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" required="true"><option value=""><?php echo L("清除部门信息");?>
</option><option selected='selected' value="%"><?php echo L("保留部门信息");?>
</option></select></div><div class="line"><label style="width:100px;"><?php echo L("一键告警号码");?>
：</label><select name="u_alarm_inform_svp_num" class="autofix" action="?m=enterprise&a=shelluser&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" required="true"><option selected='selected' value="%"><?php echo L("保留一键告警号码");?>
</option><option value=""><?php echo L("无");?>
</option><option value="@"><?php echo L("自定义");?>
</option></select><input class="none" style="margin-left:10px;width:120px;border-style: ridge;border-width:1px" maxlength="11" type="text" check_number="true" u_alarm_inform_svp_num="true" name="u_alarm_inform_svp_num" value="%"><label id="u_alarm_inform_svp_num-error" class="error none" style="color:#a43838" for="u_alarm_inform_svp_num"><?php echo L("该号码不存在");?>
</label></div><br/><div class="line"><label style="width:100px;"><?php echo L("用户分类");?>
：</label><select name="u_attr_type"><option selected='selected' value="%"><?php echo L("保留用户分类");?>
</option><option value="1"><?php echo L("测试");?>
</option><option value="0"><?php echo L("商用");?>
</option></select></div><div class="line"><label style="width:100px;"><?php echo L("只显示本部门");?>
：</label><select name="u_only_show_my_grp"><option selected='selected' value="%"><?php echo L("保留当前选择");?>
</option><option value="1"><?php echo L("启用");?>
</option><option value="0"><?php echo L("停用");?>
</option></select></div><div class="line none"><label><?php echo L("默认群组");?>
：</label><select name="u_default_pg" class="autofix" action="?m=enterprise&a=groups_option&safe=true&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" required="true"><option value=""><?php echo L("清除群组信息");?>
</option><option selected='selected' value="%"><?php echo L("保留群组信息");?>
</option></select></div><div class="buttons right"><a id="batch_submit" class="button" style="margin-right: 60px"><?php echo L("批量修改");?>
</a></div></form><!--批量修改企业用户增值功能--><form class="move_user hide"><div class="line"><label><?php echo L("移动至该企业");?>
：</label><select name="to_e_id" class="autofix" action="?modules=enterprise&action=index_item&do=console&ec_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"><option value=''><?php echo L("未选择");?>
</option></select></div><div class="buttons right"><a id="move_all" class="button" style="margin-right: 60px"><?php echo L("批量移动");?>
</a></div></form><form class="move_u_default_pg hide"><div class="line"><label><?php echo L("分配至该群组");?>
：</label><select name="move_u_default_pg" class="autofix" action="?modules=api&action=get_ptt_member_list&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" required="true"><option value=''><?php echo L("未选择");?>
</option></select></div><div class="line"><label><?php echo L("设置成员级别");?>
：</label><input autocomplete="off"  name="move_u_level" value="" range='[0,255]' /></div><div class="line none"><label><input autocomplete="off"  name="move_u_hangup" type="checkbox" /><?php echo L("被叫挂断权限");?>
</label></div><div class="line"><label><input autocomplete="off"  name="move_u_default" type="checkbox" /><?php echo L("设为默认组");?>
</label></div><div class="buttons right"><a id="groups_move_all" class="button" style="margin-right: 60px"><?php echo L("批量分配");?>
</a></div></form></div><div><table class="full"><tr class='head' style="height: 35px;" type="user" url="?m=enterprise&action=users&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"><td width="110px" class="clickPage"><?php echo L("用户列表");?>
</td><td width="490px" class="clickPage" style="text-align:right;"><?php echo L("显示条数");?>
：</td><td width="50px" onclick="clickPage(this)" class="clickPage" <?php echo $_SESSION['color'][10];?>
 onmouseover="this.style.cursor='pointer'">10</td><td width="50px" onclick="clickPage(this)" class="clickPage" <?php echo $_SESSION['color'][20];?>
 onmouseover="this.style.cursor='pointer'">20</td><td width="50px" onclick="clickPage(this)" class="clickPage" <?php echo $_SESSION['color'][50];?>
 onmouseover="this.style.cursor='pointer'">50</td></tr></table></div><div class="content"></div><div id="dialog-confirm" class="hide" title="<?php echo L('删除选中项');?>
？"><p><?php echo L("确定要删除选中的企业用户吗");?>
？</p></div><div id="dialog-confirm-batch" class="hide" title="<?php echo L('更新选中项');?>
？"><p><?php echo L("确定要批量更新选中的企业用户吗");?>
？</p></div><script  <?php echo 'type="ready"';?>
>$("input[name=u_alarm_inform_svp_num]").keydown(function(event){if(event.keyCode == 13){return false;}});$("input[name=move_u_level]").keydown(function(event){if(event.keyCode == 13){return false;}});$("#delall").click(function () {var checkd = "";$("input.cb:checkbox:checked").each(function () {checkd += $(this).val() + ",";});if (checkd === "") {notice("<?php echo L("未选中任何企业用户");?>
");} else {$("#dialog-confirm").dialog({resizable: false,height: 180,modal: true,buttons: {"<?php echo L("删除");?>
": function () {$(this).dialog("close");$.ajax({url: "?modules=enterprise&action=users_del&e_id=" + e_id,data: $("form.data").serialize(),success: function (result) {notice("<?php echo L("成功删除");?>
 " + result + " <?php echo L("个企业用户");?>
");var page = $("input[name=page]").val();$.ajax({url: "?modules=enterprise&action=getusernum&e_id=" + e_id + "&page=" + page,datatype: "html",success: function (result) {if (result == 0) {setTimeout(function () {send("prev");}, 888);} else {setTimeout(function () {send("stay");}, 888);}}});}});},"<?php echo L("取消");?>
": function () {$(this).dialog("close");}}});}});$("#move_all").click(function () {var checkd = "";var to_e_id = $("select[name=to_e_id]").val();$("input.cb:checkbox:checked").each(function () {checkd += $(this).val() + ",";});if (checkd === "") {notice("<?php echo L('未选中任何企业用户');?>
");} else if (to_e_id == "" || to_e_id == null) {notice("<?php echo L('未选中转移企业');?>
");} else {var data = "to_e_id=" + to_e_id + '&';data += $("form.data").serialize();$.ajax({url: "?m=enterprise&a=users_move&e_id=" + e_id,data: data,dataType: "json",success: function (result) {if (result.status == 0) {notice(result.msg);} else {notice(result.msg);}send();}});}});$("#groups_move_all").click(function () {var checkd = "";var move_u_default_pg = $("select[name=move_u_default_pg]").val();if ($("input[name=move_u_default]").is(":checked")) {$.ajax({url: "?m=enterprise&a=getimpgroups&pg_number=" + move_u_default_pg + "&e_id=" + e_id,method: "GET",dataType: 'json',success: function (result) {if (result.status == "-1") {notice(result.msg);exit();}}});}$("input.cb:checkbox:checked").each(function () {checkd += $(this).val() + ",";});if (checkd === "") {notice("<?php echo L('未选中任何企业用户');?>
");} else if (move_u_default_pg == "") {notice("<?php echo L('未选中转移群组');?>
");} else if ($("form.move_u_default_pg").valid()) {var data = $("form.move_u_default_pg").serialize() + "&" + $("form.data").serialize();$.ajax({url: "?m=enterprise&a=groups_users_move&e_id=" + e_id,data: data,dataType: "json",success: function (result) {notice(result.msg);send();}});}});$("#batch_submit").click(function () {var checkd = "";$("input.cb:checkbox:checked").each(function () {checkd += $(this).val() + ",";});if (checkd === "") {notice("<?php echo L('未选中任何企业用户');?>
");} else {var data = $("form#batch").serialize() + "&" + $("form.data").serialize();$("#dialog-confirm-batch").dialog({resizable: false,height: 180,modal: true,buttons: {"<?php echo L("更新");?>
": function () {$(this).dialog("close");$.ajax({url: "?modules=enterprise&action=users_batch&e_id=" + e_id,data: data,success: function () {send();}});},"<?php echo L("取消");?>
": function () {$(this).dialog("close");}}});}});$("#batch_add").click(function () {var checkd = "";$("input.cb:checkbox:checked").each(function () {checkd += $(this).val() + ",";});if (checkd === "") {notice("<?php echo L('未选中任何企业用户');?>
");} else {var data = $("form.product").serialize() + "&" + $("form.data").serialize();$("#dialog-confirm-batch").dialog({resizable: false,height: 180,modal: true,buttons: {"<?php echo L("更新");?>
": function () {$(this).dialog("close");$.ajax({url: "?modules=enterprise&action=users_batch_p&e_id=" + e_id,data: data,success: function () {send();}});},"<?php echo L("取消");?>
": function () {$(this).dialog("close");}}});}});</script><?php }} ?>