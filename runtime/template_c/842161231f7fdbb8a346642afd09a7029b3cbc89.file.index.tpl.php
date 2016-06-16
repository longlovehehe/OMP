<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:25:42
         compiled from "..\template\modules\log\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14043574cf6268f6ed0-24401950%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '842161231f7fdbb8a346642afd09a7029b3cbc89' => 
    array (
      0 => '..\\template\\modules\\log\\index.tpl',
      1 => 1428044656,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14043574cf6268f6ed0-24401950',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf626a56823_02816938',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf626a56823_02816938')) {function content_574cf626a56823_02816938($_smarty_tpl) {?><style>
    .toolbar label{
        margin-right: 5px;
    }
    .toolbar label input{
        position: relative;
        top: 2px;
    }
</style>
<h2 class="title"><?php echo L(((string)$_smarty_tpl->tpl_vars['title']->value));?>
</h2><script  <?php echo 'type="ready"';?>
>$('nav a.log').addClass('active');</script><form id="form" action="?modules=log&action=index_item" method="post"><div class="toolbar"><input autocomplete="off"  name="modules" value="log" type="hidden" /><input autocomplete="off"  name="action" value="index_item" type="hidden" /><input autocomplete="off"  name="page" value="0" type="hidden" /><div class="line"><label><?php echo L("日志级别");?>
：</label><select name="el_level" style="width:130px;" value="<?php echo $_REQUEST['el_level'];?>
" class="autoedit"><option value=""><?php echo L("全部");?>
</option><option value="2"><?php echo L("错误");?>
</option><option value="1"><?php echo L("警告");?>
</option><option value="0"><?php echo L("信息");?>
</option></select></div><div class="line"><label><?php echo L("日志编号");?>
：</label><input autocomplete="off"  class="autosend" el_id="true" name="el_id" type="text" /></div><?php if ($_SESSION['own']['om_id']=='admin'){?><div class="line"><label><?php echo L("来源用户");?>
：</label><input autocomplete="off"  class="autosend" name="el_user" type="text" /></div><?php }?><div class="line"><label><?php echo L("日志内容");?>
：</label><input autocomplete="off"  class="autosend" name="el_content" type="text" /></div><div class="line"><label><?php echo L("创建时间");?>
：</label><input autocomplete="off"  class="datepicker start" name="start" type="text" datatime='true' /><span>-</span><input autocomplete="off"  class="datepicker end" name="end" type="text" datatime="true" /></div></div><div class="toolbar"><label><?php echo L("来源模块");?>
：</label><label><input autocomplete="off"  type="checkbox" name="el_type[]" value="7"/><?php echo L("登录模块");?>
</label><label><input autocomplete="off"  type="checkbox" name="el_type[]" value="1"/><?php echo L("企业模块");?>
</label><label><input autocomplete="off"  type="checkbox" name="el_type[]" value="2"/><?php echo L("设备模块");?>
</label><?php if ($_SESSION['own']['om_id']=='admin'){?><label><input autocomplete="off"  type="checkbox" name="el_type[]" value="3"/><?php echo L("角色模块");?>
</label><?php }?><?php if ($_SESSION['own']['om_id']=='admin'){?><label><input autocomplete="off"  type="checkbox" name="el_type[]" value="4"/><?php echo L("区域模块");?>
</label><?php }?><label><input autocomplete="off"  type="checkbox" name="el_type[]" value="5"/><?php echo L("产品模块");?>
</label><label><input autocomplete="off"  type="checkbox" name="el_type[]" value="8"/><?php echo L("公告模块");?>
</label><a form="form" class="button submit" style="margin-left: 10px"><?php echo L("查询");?>
</a></div></form><div class="content"></div><?php }} ?>