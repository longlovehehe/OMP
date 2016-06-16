<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 19:03:15
         compiled from "..\template\modules\agents\agents_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:117695735b4733fffe2-72080495%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa109a27478a6dc6cb25fb383bfd010b4d3b354d' => 
    array (
      0 => '..\\template\\modules\\agents\\agents_item.tpl',
      1 => 1449054607,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '117695735b4733fffe2-72080495',
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
  'unifunc' => 'content_5735b4736af880_27220228',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5735b4736af880_27220228')) {function content_5735b4736af880_27220228($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:\\Code\\OP\\omp\\private\\libs\\Smarty\\plugins\\modifier.truncate.php';
?><form class="data"><table class="base full"><tr class='head'><th width="20px"><input autocomplete="off"  type="checkbox" id="checkall" /></th><th width="80px"><?php echo L("编号");?>
</th><th width="120px"><?php echo L("代理商名称");?>
</th><th width="50px"><?php echo L("详情");?>
</th><th width="100px"><?php echo L("区域");?>
</th><th width="100px"><?php echo L("用户总数");?>
</th><th width="60px"><?php echo L("级别");?>
</th><th width="60px"><?php echo L("操作");?>
</th></tr><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><tr ><td><input autocomplete="off"  type="checkbox" name="checkbox[]" <?php if ($_smarty_tpl->tpl_vars['item']->value['stat']==1){?>disabled<?php }else{ ?><?php }?> <?php if ($_smarty_tpl->tpl_vars['item']->value['ag_level']==0){?><?php }else{ ?>disabled<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ag_number'];?>
" class="cb" /></td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['ag_number'];?>
</td><td title="<?php echo $_smarty_tpl->tpl_vars['item']->value['ag_name'];?>
"><?php if (mb_strlen($_smarty_tpl->tpl_vars['item']->value['ag_name'])<=7){?><?php echo $_smarty_tpl->tpl_vars['item']->value['ag_name'];?>
<?php }else{ ?><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value['ag_name'],7,'');?>
... <?php }?></td><td class="rich"><a  title="<?php echo L('联系人姓名');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['ag_conname'];?>
 <?php echo $_smarty_tpl->tpl_vars['item']->value['ag_username'];?>
】<br /><?php echo L('电话');?>
: 【<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['ag_phone'])===null||$tmp==='' ? 0 : $tmp);?>
】<br /><?php echo L('邮箱');?>
: 【<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['ag_mail'])===null||$tmp==='' ? 0 : $tmp);?>
】<br />" class="link tips_title"><img src='images/pic_06.png'></a></td><td><span class="ellipsis" style="width: 60px"  <?php if ($_smarty_tpl->tpl_vars['item']->value['ag_level']==0){?><?php }else{ ?>disabled<?php }?>><?php echo mod_area_name($_smarty_tpl->tpl_vars['item']->value['ag_area'],'option');?>
</span></td><td title="<?php echo L('手机用户数');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['ag_phone_num'];?>
】<br /><?php echo L('调度台用户数');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['ag_dispatch_num'];?>
】<br /><?php echo L('GVS用户数');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['ag_gvs_num'];?>
】"><?php echo $_smarty_tpl->tpl_vars['item']->value['ag_phone_num']+$_smarty_tpl->tpl_vars['item']->value['ag_dispatch_num']+$_smarty_tpl->tpl_vars['item']->value['ag_gvs_num'];?>
</td><td title="【<?php echo L('创建者');?>
: <?php echo getompman($_smarty_tpl->tpl_vars['item']->value['ag_parent_id']);?>
】"><?php echo getaglevel($_smarty_tpl->tpl_vars['item']->value['ag_level']);?>
</td><td><?php if ($_smarty_tpl->tpl_vars['item']->value['ag_level']==0){?><a  href="?m=agents&a=agents_save&ag_number=<?php echo $_smarty_tpl->tpl_vars['item']->value['ag_number'];?>
&do=edit" class="link"><?php echo L("编辑");?>
</a><?php }else{ ?><a  href="javascript:void(0);" class="link dis"><?php echo L("编辑");?>
</a><?php }?></td></tr><?php } ?></table><?php if ($_smarty_tpl->tpl_vars['list']->value!=null){?><div class="page none_select"><div class="num"><?php echo $_smarty_tpl->tpl_vars['numinfo']->value;?>
</div><div class="turn"><a page="<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
" class="prev"><?php echo L("上一页");?>
</a><a page="<?php echo $_smarty_tpl->tpl_vars['next']->value;?>
" class="next"><?php echo L("下一页");?>
</a></div></div></form><?php }?><?php }} ?>