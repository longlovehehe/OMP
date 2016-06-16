<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:25:43
         compiled from "..\template\modules\log\index_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14378574cf6277f16a6-56836555%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e6ddb4261f03e925ffabc17004ebf20a7db7032' => 
    array (
      0 => '..\\template\\modules\\log\\index_item.tpl',
      1 => 1426834200,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14378574cf6277f16a6-56836555',
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
  'unifunc' => 'content_574cf62798b980_41906575',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf62798b980_41906575')) {function content_574cf62798b980_41906575($_smarty_tpl) {?>
<form class="data">
    <table class="base full">
        <tr class='head'>
            <th width="70px"><?php echo L("日志级别");?>
</th>
            <th width="70px"><?php echo L("日志编号");?>
</th>
            <th width="60px"><?php echo L("来源模块");?>
</th>
            <th width="60px"><?php echo L("来源用户");?>
</th>
            <th width="75px"><?php echo L("创建时间");?>
</th>
            <th><?php echo L("日志内容");?>
</th>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <tr title="<?php echo L('日志级别');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['el_level'];?>
】<br /><?php echo L('日志编号');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['el_id'];?>
】<br /><?php echo L('来源模块');?>
: 【<?php echo logType($_smarty_tpl->tpl_vars['item']->value['el_type']);?>
】<br /><?php echo L('来源用户');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['el_user'];?>
】<br /><?php echo L('创建时间');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['el_time'];?>
】<br /><?php echo L('日志内容');?>
: 【<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['el_content'], ENT_QUOTES, 'UTF-8', true);?>
】">
            <td><?php echo logLevel($_smarty_tpl->tpl_vars['item']->value['el_level']);?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['el_id'];?>
</td>
            <td><?php echo logType($_smarty_tpl->tpl_vars['item']->value['el_type']);?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['el_user'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['el_time'];?>
</td>
            <td><span class="ellipsis" style="width: 360px"><?php echo $_smarty_tpl->tpl_vars['item']->value['el_content'];?>
</span></td>
        </tr>
        <?php } ?>
    </table>
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
</form>
<?php }?>

<?php }} ?>