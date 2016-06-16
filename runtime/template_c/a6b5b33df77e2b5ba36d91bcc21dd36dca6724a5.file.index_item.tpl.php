<?php /* Smarty version Smarty-3.1.11, created on 2016-05-20 15:32:53
         compiled from "..\template\modules\announcement\index_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9298573ebda5923b94-34714011%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6b5b33df77e2b5ba36d91bcc21dd36dca6724a5' => 
    array (
      0 => '..\\template\\modules\\announcement\\index_item.tpl',
      1 => 1426834200,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9298573ebda5923b94-34714011',
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
  'unifunc' => 'content_573ebda5b08208_29770460',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_573ebda5b08208_29770460')) {function content_573ebda5b08208_29770460($_smarty_tpl) {?><?php if ($_SESSION['own']['om_id']!='admin'){?>
<p style="margin-bottom: 10px;"><?php echo L("提示讯息：你在这里只能看到你自己发布的公告,以及草稿");?>
</p>
<?php }?>

<form class="data">
    <table class="base full">
        <tr class='head'>
            <th width="170px"><?php echo L("公告标题");?>
</th>
            <th width="50px"><?php echo L("可见区域");?>
</th>
            <th width="50px"><?php echo L("状态");?>
</th>
            <th width="100px"><?php echo L("发布时间");?>
</th>
            <?php if ($_SESSION['own']['om_id']=='admin'){?><th width="50px"><?php echo L("发布人");?>
</th><?php }?>
            <th width="50px"><?php echo L("操作");?>
</th>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <tr title="<?php echo L('公告标题');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['an_title'];?>
】<br /><?php echo L('可见区域');?>
: 【<?php echo mod_area_name($_smarty_tpl->tpl_vars['item']->value['an_area']);?>
】<br /><?php echo L('状态');?>
: 【<?php echo an_status($_smarty_tpl->tpl_vars['item']->value['an_status']);?>
】<br /><?php echo L('发布时间');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['an_time'];?>
】">
            <td>
                <input autocomplete="off"  type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['an_area_id'];?>
" name="an_area_id">
                <span class="ellipsis" style="width: 280px">
                    <a class="alink" href="?m=announcement&a=an_details&an_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['an_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['an_title'];?>
</a>
                </span>
            </td>
            <td>
                <span class="ellipsis" style="width: 50px"><?php echo mod_area_name($_smarty_tpl->tpl_vars['item']->value['an_area'],'option');?>
</span>
            </td>
            <td><?php echo an_status($_smarty_tpl->tpl_vars['item']->value['an_status']);?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['an_time'];?>
</td>
            <td class='<?php echo notadmin("none");?>
'><?php echo $_smarty_tpl->tpl_vars['item']->value['an_user'];?>
</td>
            <td>
                <a class="link" href="?m=announcement&a=an_edit&an_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['an_id'];?>
"><?php echo L("编辑");?>
</a>
                &nbsp;
                <a id="del" class="link" data="<?php echo $_smarty_tpl->tpl_vars['item']->value['an_id'];?>
"><?php echo L("删除");?>
</a>
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

<?php }?><?php }} ?>