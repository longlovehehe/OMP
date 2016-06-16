<?php /* Smarty version Smarty-3.1.11, created on 2016-05-23 13:36:35
         compiled from "..\template\modules\enterprise\nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4269574296e3973372-85380663%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '063cb22516e02fa3216ebfb84c5900761dffb15a' => 
    array (
      0 => '..\\template\\modules\\enterprise\\nav.tpl',
      1 => 1462762765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4269574296e3973372-85380663',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'ep' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574296e3af9dc5_25313304',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574296e3af9dc5_25313304')) {function content_574296e3af9dc5_25313304($_smarty_tpl) {?><div class="navicon"><div class="mask_e_view"></div><div class="toolbar e_view clear"><div class="ListIcon autoactive" action="view"><div class="Icon icon1 _1_jpg"></div><div class="ListIconItem"><h3><a href="?m=enterprise&amp;a=view&amp;e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"><?php echo L("企业信息");?>
</a></h3><p><?php echo L("查看企业信息、启用停用企业，以及数据同步重建");?>
</p></div></div><?php if ($_smarty_tpl->tpl_vars['data']->value['e_id']==999999){?><?php }else{ ?><div class="ListIcon autoactive none" action="admins"><div class="Icon icon2 _3_jpg"></div><div class="ListIconItem "><h3><a href="?m=enterprise&amp;a=admins&amp;e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"><?php echo L("企业管理员");?>
</a></h3><p><?php echo L("查看当前选择的企业的管理员，创建删除等");?>
</p></div></div><div class="ListIcon autoactive "  action="usergroup"><div class="Icon icon5 _5_jpg"></div><div class="ListIconItem "><h3><a href="?m=enterprise&amp;a=usergroup&amp;e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"><?php echo L("企业部门");?>
</a></h3><p><?php echo L("企业部门分配创建等");?>
</p></div></div><div class="ListIcon autoactive"  action="groups"><div class="Icon icon4 _4_jpg"></div><div class="ListIconItem "><h3><a href="?m=enterprise&amp;a=groups&amp;e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" ><?php echo L("企业群组");?>
</a></h3><p><?php echo L("企业群组配置删除等");?>
</p></div></div><div class="ListIcon autoactive" action="users"><div class="Icon icon3  _2_jpg "></div><div class="ListIconItem"><h3><a href="?m=enterprise&amp;a=users&amp;e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" ><?php echo L("企业用户");?>
</a></h3><p><?php echo L("批量新增删除，修改转移企业用户，企业用户群组分配等");?>
</p></div></div><div class="ListIcon autoactive"  action="index"><div class="Icon icon4 _4_jpg"></div><div class="ListIconItem "><h3><a href="?m=enterprise&amp;a=contract&amp;e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" ><?php echo L("用户合同");?>
</a></h3><p><?php echo L("企业用户合同批量新增、编辑及用户合同历史记录等");?>
</p></div></div><div class="ListIcon autoactive" action="export"><div class="Icon icon7 _7_jpg"></div><div class="ListIconItem"><h3><a href="?m=enterprise&amp;a=export&amp;e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
"><?php echo L("导入导出");?>
</a></h3><p><?php echo L("导入导出企业用户、群组、通讯录、区域等信息");?>
</p></div></div><?php if ($_smarty_tpl->tpl_vars['ep']->value['e_sync']!="0"&&$_smarty_tpl->tpl_vars['ep']->value['e_status']=="1"){?><div id='sync' class="ListIcon"  action="export"><div class="Icon icon6 _6_jpg"></div><div class="ListIconItem"><h3><a><?php echo L("数据同步");?>
</a></h3><p><?php echo L("下发设备信息至服务器");?>
</p></div></div><?php }?><div id="dialog-confirm-sync" class="hide" title="<?php echo L('操作开始确认提示');?>
"><p><?php echo L("开始同步吗");?>
？</p></div><script>$("#sync").click(function () {$("#dialog-confirm-sync").dialog({resizable: false,width: 440,height: 240,modal: true,buttons: {"<?php echo L("开始同步");?>
": function () {notice("<?php echo L("正在同步中，请稍候");?>
");$(this).dialog("close");$.ajax({url: "?modules=enterprise&action=sync&e_id=<?php echo $_smarty_tpl->tpl_vars['ep']->value['e_id'];?>
",dataType: "json",async: true,success: function (result) {notice(result.msg, "?m=enterprise&a=view&e_id=<?php echo $_smarty_tpl->tpl_vars['ep']->value['e_id'];?>
");}});},"<?php echo L("取消");?>
": function () {$(this).dialog("close");}}});});$("div.autoactive").click(function () {var href = $(this).find("a").attr("href");window.location.href = href;});</script><?php }?><script>$("div.autoactive").click(function () {var href = $(this).find("a").attr("href");window.location.href = href;});</script></div></div>
<?php }} ?>