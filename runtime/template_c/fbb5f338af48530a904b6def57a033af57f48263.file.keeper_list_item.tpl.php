<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:24:50
         compiled from "..\template\modules\terminal\keeper_list_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11037574cf5f20389e9-68995534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fbb5f338af48530a904b6def57a033af57f48263' => 
    array (
      0 => '..\\template\\modules\\terminal\\keeper_list_item.tpl',
      1 => 1452838985,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11037574cf5f20389e9-68995534',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'key' => 0,
    'page' => 0,
    'item' => 0,
    'numinfo' => 0,
    'prev' => 0,
    'next' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf5f2184ab8_61156924',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf5f2184ab8_61156924')) {function content_574cf5f2184ab8_61156924($_smarty_tpl) {?><form class="data"><table class="base full"><tr class='head'><th width="100px"><?php echo L("序号");?>
</th><th class="rich" width="150px"><?php echo L("号码");?>
</th><th class="rich" width="150px"><?php echo L("昵称");?>
</th><th class="rich" width="110px"><?php echo L("终端数");?>
</th><th class="rich" width="100px"><?php echo L("详情");?>
</th></tr><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?><tr><td><?php echo ($_smarty_tpl->tpl_vars['key']->value+1)+10*$_smarty_tpl->tpl_vars['page']->value;?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['rm_id'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['rm_nickname'];?>
</td><td><?php if ($_smarty_tpl->tpl_vars['item']->value['devicesum']>0){?><?php echo $_smarty_tpl->tpl_vars['item']->value['devicesum'];?>
<?php }else{ ?>0<?php }?></td><td><?php if ($_smarty_tpl->tpl_vars['item']->value['devicesum']==0){?><a class="link edit dis" ><?php echo L("详情");?>
</a><?php }else{ ?><a href="?m=terminal&a=keeper_detail_list&rm_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['rm_id'];?>
"  class="link edit" ><?php echo L("详情");?>
</a><?php }?></td></tr><?php } ?></table><?php if ($_smarty_tpl->tpl_vars['list']->value!=null){?><div class="page none_select rich"><div class="num"><?php echo $_smarty_tpl->tpl_vars['numinfo']->value;?>
</div><div class="turn"><a page="<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
" class="prev"><?php echo L("上一页");?>
</a><a page="<?php echo $_smarty_tpl->tpl_vars['next']->value;?>
" class="next"><?php echo L("下一页");?>
</a></div></div><?php }?></form><?php }} ?>