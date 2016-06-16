<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 09:05:14
         compiled from "..\template\modules\terminal\index_type_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:55745735284a86bcb1-87979201%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f849e62c23e1a904b8b5fdc5499bb997c036b70' => 
    array (
      0 => '..\\template\\modules\\terminal\\index_type_item.tpl',
      1 => 1437966530,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '55745735284a86bcb1-87979201',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'item' => 0,
    'numinfo' => 0,
    'prev' => 0,
    'next' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5735284a990c74_48908130',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5735284a990c74_48908130')) {function content_5735284a990c74_48908130($_smarty_tpl) {?><table class="base full"><tr class='head'><th width="100px" class=""><?php echo L("序号");?>
</th><th><?php echo L("终端型号");?>
</th><th><?php echo L("终端图片");?>
</th><th width="100px"><?php echo L("操作");?>
</th></tr><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['list']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['list']['iteration']++;
?><tr><td><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['list']['iteration'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['tt_type'];?>
</td><td  height="40px;"><img src="?m=terminal&a=show_pic&pid=<?php echo $_smarty_tpl->tpl_vars['item']->value['tt_pic'];?>
"  onclick="start_big('<?php echo $_smarty_tpl->tpl_vars['item']->value['tt_pic'];?>
',this);"  style="width: 50px;"></td><td><a href="javascript:void(0);"  class="link" onclick="replace('<?php echo $_smarty_tpl->tpl_vars['item']->value['tt_type'];?>
');"><?php echo L("编辑");?>
</a><?php if (get_used($_smarty_tpl->tpl_vars['item']->value['tt_type'])==0){?><a class="mrlf5 link" onclick="del_type('<?php echo $_smarty_tpl->tpl_vars['item']->value['tt_type'];?>
');" ><?php echo L("删除");?>
</a><?php }else{ ?><a class="mrlf5 link dis" ><?php echo L("删除");?>
</a><?php }?></td></tr><?php } ?></table><?php if ($_smarty_tpl->tpl_vars['list']->value!=null){?><div class="page none_select rich"><div class="num"><?php echo $_smarty_tpl->tpl_vars['numinfo']->value;?>
</div><div class="turn"><a page="<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
" class="prev"><?php echo L("上一页");?>
</a><a page="<?php echo $_smarty_tpl->tpl_vars['next']->value;?>
" class="next"><?php echo L("下一页");?>
</a></div></div><?php }?><?php }} ?>