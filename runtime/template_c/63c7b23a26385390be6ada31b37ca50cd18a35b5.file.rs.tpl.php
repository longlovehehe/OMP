<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:24:37
         compiled from "..\template\modules\device\rs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14556574cf5e534eba3-92817991%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '63c7b23a26385390be6ada31b37ca50cd18a35b5' => 
    array (
      0 => '..\\template\\modules\\device\\rs.tpl',
      1 => 1447754480,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14556574cf5e534eba3-92817991',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'aCluster' => 0,
    'item' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf5e5537097_02373695',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf5e5537097_02373695')) {function content_574cf5e5537097_02373695($_smarty_tpl) {?><!-- <div class="toolbar "><a href="?m=device&a=server" class="button active"><?php echo L(((string)$_SESSION['ident'])."-RS管理");?>
</a><a href="?m=device&a=vcr" class="button none"><?php echo L("VCR管理");?>
</a><a href="?m=device&a=vcrs" class="button none"><?php echo L("VCR-S管理");?>
</a></div> --><h2 class="title"><?php echo L(((string)$_smarty_tpl->tpl_vars['title']->value));?>
</h2><div class="toptoolbar"><a href="?m=device&a=rs_add&d_type=GQT-RS" class="button orange"><?php echo L("新增设备");?>
</a></div><div class="toolbar"><form action="?m=device&a=rs_item" id="form" method="post"><input autocomplete="off"  name="modules" value="device" type="hidden" /><input autocomplete="off"  name="action" value="rs_item" type="hidden" /><input autocomplete="off"  name="d_type" value="rs" type="hidden" /><input autocomplete="off"  name="page" value="0" type="hidden" /><div class="line"><label><?php echo L("ID");?>
：</label><input autocomplete="off"  class="autosend" name="d_id" type="text" /></div><div class="line"><label><?php echo L("设备名称");?>
：</label><input autocomplete="off"  class="autosend" name="d_name" type="text" /></div><div class="line"><label><?php echo L("状态");?>
：</label><select name="d_status"><option value=""><?php echo L("全部");?>
</option><option value="0"><?php echo L("处理中");?>
</option><option value="1"><?php echo L("正常");?>
</option><option value="2"><?php echo L("异常");?>
</option></select></div><div class="line"><label><?php echo L("部署ID");?>
：</label><select name="d_deployment_id"><option value=""><?php echo L("全部");?>
</option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aCluster']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['cluster_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['cluster_name'];?>
</option><?php } ?></select></div><!-- <div class="line"><label><?php echo L("区域");?>
：</label><select name="d_area" class="autofix" action="?m=area&a=option"><option value='#'><?php echo L("全部");?>
</option></select></div> --><div class="buttons right"><a form="form" class="button submit"><?php echo L("查询");?>
</a></div></form></div><div class="toolbar"><a id="delall" class="button"><?php echo L("批量删除");?>
</a><a id="refreshall" data="?m=device&a=refresh"  class="button"><?php echo L("批量状态刷新");?>
</a></div><div class="content"></div><form id="form" class="base mrbt10" ><input autocomplete="off"  name="d_id" class="d_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['d_id'];?>
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