<?php /* Smarty version Smarty-3.1.11, created on 2016-05-21 16:54:28
         compiled from "..\template\modules\enterprise\allusers_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15320574022442db111-52235059%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d0d7ea41dce5c2eb54fc6a6e5b43bd2c4b402d2' => 
    array (
      0 => '..\\template\\modules\\enterprise\\allusers_item.tpl',
      1 => 1433227024,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15320574022442db111-52235059',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    's' => 0,
    'list' => 0,
    'item' => 0,
    'numinfo' => 0,
    'prev' => 0,
    'next' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5740224446d6f6_48204750',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5740224446d6f6_48204750')) {function content_5740224446d6f6_48204750($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:\\Code\\OP\\omp\\private\\libs\\Smarty\\plugins\\modifier.truncate.php';
?><p class='info none'><?php echo L("需要输入完整的用户号码");?>
</p>
<p class='info none'><?php echo L("总共耗时 ".((string)$_smarty_tpl->tpl_vars['s']->value)." 毫秒");?>
</p>

<form class="data">
    <table class="base full">
        <tr class='head'>
            <th width="100px"><?php echo L("用户号码");?>
</th>
            <th class="rich" width="100px"><?php echo L("姓名");?>
</th>
            <th class="rich" width="100px"><?php echo L("企业ID");?>
</th>
            <th class="rich" width="100px"><?php echo L("企业名称");?>
</th>
            <th class="rich" width="100px"><?php echo L("用户类型");?>
</th>
            <th class="rich" width="100px"><?php echo L("用户详情");?>
</th>
        </tr>

        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
</td>
            <td><?php if (mb_strlen($_smarty_tpl->tpl_vars['item']->value['u_name'])<=5){?><?php echo $_smarty_tpl->tpl_vars['item']->value['u_name'];?>
<?php }else{ ?><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value['u_name'],5,'');?>
... <?php }?></td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['ep']['e_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['ep']['e_name'];?>
</td>
            <td class="rich"><?php echo modtype($_smarty_tpl->tpl_vars['item']->value['u_sub_type']);?>
</td>
            <td><a href='?m=enterprise&a=users&e_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['ep']['e_id'];?>
&u_number=<?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
' class='link blue'><?php echo L("用户详情");?>
</a></td>
        </tr>
        <?php } ?>
    </table>
</form>
<?php if ($_smarty_tpl->tpl_vars['list']->value!=null){?>
    <div class="page none_select">
        <div class="num"><?php echo $_smarty_tpl->tpl_vars['numinfo']->value;?>
</div>
        <div class="turn">
            <a page="<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
" class="prev"><?php echo L("上一页");?>
</a>
            <a page="<?php echo $_smarty_tpl->tpl_vars['next']->value;?>
" class="next"><?php echo L("下一页");?>
</a>
        </div>
    </div>
<?php }?><?php }} ?>