<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:25:39
         compiled from "..\template\modules\device\cluster.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3331574cf623b20fa0-43370568%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e0f8d54f9fcc63c358b283d423622919424dcb4' => 
    array (
      0 => '..\\template\\modules\\device\\cluster.tpl',
      1 => 1447754480,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3331574cf623b20fa0-43370568',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf623c26b53_77042344',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf623c26b53_77042344')) {function content_574cf623c26b53_77042344($_smarty_tpl) {?><div class="toolbar "><a href="?m=device&a=server" class="button none"><?php echo L("部署管理");?>
</a><a href="?m=device&a=vcr" class="button none"><?php echo L("VCR管理");?>
</a><a href="?m=device&a=vcrs" class="button none"><?php echo L("VCR-S管理");?>
</a></div><h2 class="title"><?php echo L(((string)$_smarty_tpl->tpl_vars['title']->value));?>
</h2><div class="toptoolbar"><a href="?m=device&a=cluster_add" class="button orange"><?php echo L("新增部署ID");?>
</a></div><form id="form" action="?modules=device&action=cluster_item" method="post"><div class="toolbar"><input autocomplete="off"  name="page" value="0" type="hidden" /><input autocomplete="off"  name="num" value="10" type="hidden" /><input autocomplete="off"  form="form" class="button submit" type="hidden"/></div></form><div class="content"></div><form id="form" class="base mrbt10" ><input autocomplete="off"  name="d_id" class="d_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['d_id'];?>
" type="hidden" /><input autocomplete="off"  name="d_area1" class="d_area" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['d_area'];?>
" type="hidden" /><input autocomplete="off"  name="d_ip1" id="d_ip1" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['d_ip1'];?>
" type="hidden" /><input autocomplete="off"  name="d_port1" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['d_port1'];?>
" type="hidden" /><input autocomplete="off"  name="d_ip2" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['d_ip2'];?>
" type="hidden" /><input autocomplete="off"  name="d_port2" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['d_port2'];?>
" type="hidden" /><input autocomplete="off"  name="d_type" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['d_type'];?>
" type="hidden" /><div  id="light" class="white_content" style="height: 320px;"><div style="background-color:#DCE0E1;"><div style="float:left;width: 20px;">&nbsp;</div><div class="c_dir"><?php echo L("新增区域");?>
</div></div><br /><div class="block"><?php echo L("设备名称");?>
：<input readonly autocomplete="off"  style="width: 150px;"  maxlength="32"   name="d_name" value="" type="text" /></div><br /><div class="block"><?php echo L("已有区域");?>
：<span class="d_area"></span></div><div class="block"><label><?php echo L("增加区域");?>
：</label><select name="d_area[]" class="moreselect" size="5" multiple="true"></select></div><div class="buttons mrtop40" style="float: right;"><a class="button normal" onclick="do_set();"><?php echo L("保存");?>
</a><a class=" button" onclick="closed();"><?php echo L("取消");?>
</a></div></div></form><div id="dialog-confirm" class="hide" title="<?php echo L('删除选中项');?>
？"><p><?php echo L("确定要删除选中的设备吗");?>
?</p></div><?php }} ?>