<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:00
         compiled from "..\template\modules\system\index_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21165762235032f593-49708262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0efd27593bf1ce0ae8b355731a2a415bf647da8' => 
    array (
      0 => '..\\template\\modules\\system\\index_item.tpl',
      1 => 1456971391,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21165762235032f593-49708262',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'getAnList' => 0,
    'item' => 0,
    'numinfo' => 0,
    'prev' => 0,
    'next' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57622350411ec0_29352024',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57622350411ec0_29352024')) {function content_57622350411ec0_29352024($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\Code\\OP\\omp\\private\\libs\\Smarty\\plugins\\modifier.date_format.php';
?><table class="base full content">
    <tr class="head">
        <th width="100px"><?php echo L("发布日期");?>
</th>
        <th><?php echo L("公告标题");?>
</th>
        <th width="100px"><?php echo L("发布区域");?>
</th>
    </tr>

    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['getAnList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
    <tr>
        <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['an_time'],"%Y-%m-%d");?>
</td>
        <td>
            <span class="ellipsis" style="width: 450px">
                <a href="?m=system&a=pro_details&an_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['an_id'];?>
" class="alink"><?php echo $_smarty_tpl->tpl_vars['item']->value['an_title'];?>
</a>
            </span>
        </td>

        <td><span class="ellipsis" style="width: 80px"><?php echo mod_area_name($_smarty_tpl->tpl_vars['item']->value['an_area'],'option');?>
 </span> </td>
    </tr>
    <?php } ?>
</table>
<?php if ($_smarty_tpl->tpl_vars['getAnList']->value!=null){?>
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