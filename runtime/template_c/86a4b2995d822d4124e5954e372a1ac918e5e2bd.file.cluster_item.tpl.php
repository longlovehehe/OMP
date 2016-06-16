<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:25:40
         compiled from "..\template\modules\device\cluster_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4053574cf6248a0899-44680390%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86a4b2995d822d4124e5954e372a1ac918e5e2bd' => 
    array (
      0 => '..\\template\\modules\\device\\cluster_item.tpl',
      1 => 1444720687,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4053574cf6248a0899-44680390',
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
  'unifunc' => 'content_574cf624a2b176_10254566',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf624a2b176_10254566')) {function content_574cf624a2b176_10254566($_smarty_tpl) {?>

<form class="data">
    <table class="base full">
        <tr class='head'>
            <th width="40px"><?php echo L("序号");?>
</th>
            <th width="40px"><?php echo L("部署ID");?>
</th>
            <th width="120px"><?php echo L("名称");?>
</th>
            <th width="120px"><?php echo L("备注");?>
</th>
            <th width="150px"><?php echo L("操作");?>
</th>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
        <tr>
            <td><?php echo ($_smarty_tpl->tpl_vars['key']->value+1)+10*($_smarty_tpl->tpl_vars['page']->value);?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['cluster_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['cluster_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['cluster_desc'];?>
</td>  
            <td>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['status']=='yes'){?>
                <a title="<?php echo L('此部署下有设备在用不能编辑');?>
" class="link dis"><?php echo L("编辑");?>
</a>
                |<a title="<?php echo L('此部署下有设备在用不能删除');?>
" class="link dis"><?php echo L("删除");?>
</a>
                <?php }else{ ?>
                <a href="?m=device&a=cluster_edit&cluster_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['cluster_id'];?>
" class="link"><?php echo L("编辑");?>
</a>
                |<a onclick="del_cluster('<?php echo $_smarty_tpl->tpl_vars['item']->value['cluster_id'];?>
');" class="link"><?php echo L("删除");?>
</a>
                <?php }?>
                
            </td>
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