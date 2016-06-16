<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:24:52
         compiled from "..\template\modules\enterprise\index_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24509574cf5f4b1e494-51254529%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1cfbf9adb48469423581c7592c561e688d2ed914' => 
    array (
      0 => '..\\template\\modules\\enterprise\\index_item.tpl',
      1 => 1462762765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24509574cf5f4b1e494-51254529',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lang' => 0,
    'list' => 0,
    'item' => 0,
    'numinfo' => 0,
    'prev' => 0,
    'next' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf5f4e04847_20719087',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf5f4e04847_20719087')) {function content_574cf5f4e04847_20719087($_smarty_tpl) {?>
<form class="data">
    <table class="base full">
        <tr class='head'>
            <th width="20px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>
            <?php if ($_smarty_tpl->tpl_vars['lang']->value=='en_US'){?>
                <th width="60px">E.ID</th>
            <?php }else{ ?>
                <th width="60px"><?php echo L("编号");?>
</th>
            <?php }?>
            <th width="190px"><?php echo L("企业名称");?>
</th>
            <th width="60px"><?php echo L("用户总数");?>
</th>
            <th width="60px"><?php echo L("手机");?>
</th>
            <th width="60px"><?php echo L("调度台");?>
</th>
            <th width="60px"><?php echo L("GVS");?>
</th>
            <th class="rich " width="100px"><?php echo L("区域");?>
</th>
            <th class="rich " width="80px"><?php echo L("状态");?>
</th>
            <th class="rich none" width="120px"><?php echo $_SESSION['ident'];?>
-Server</th>
            <th class="rich none" width="120px">VCR</th>
            <th width="50px"><?php echo L("操作");?>
</th>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <tr title="<?php echo L('企业编号');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['e_id'];?>
】<br /><?php echo L('企业名称');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['e_name'];?>
】<br /><?php echo L('区域');?>
: 【<?php echo mod_area_name($_smarty_tpl->tpl_vars['item']->value['e_area']);?>
】<br /><?php echo L('状态');?>
: 【<?php echo modifierStatus($_smarty_tpl->tpl_vars['item']->value['e_status']);?>
】 <br /><?php echo $_SESSION['ident'];?>
-Server: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['mds_d_name'];?>
】<br/><?php echo $_SESSION['ident'];?>
-RS: 【<?php if ($_smarty_tpl->tpl_vars['item']->value['rs_d_name']){?><?php echo $_smarty_tpl->tpl_vars['item']->value['rs_d_name'];?>
<?php }else{ ?><?php echo L('无');?>
<?php }?>】<br/><?php echo $_SESSION['ident'];?>
-SS: 【<?php if ($_smarty_tpl->tpl_vars['item']->value['ss_d_name']){?><?php echo $_smarty_tpl->tpl_vars['item']->value['ss_d_name'];?>
<?php }else{ ?><?php echo L('无');?>
<?php }?>】<br/><?php echo L('创建者');?>
:【<?php echo getompman($_smarty_tpl->tpl_vars['item']->value['e_create_name']);?>
】<br/><?php echo L('企业创建时间');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['e_create_time'];?>
】">
            <td><input autocomplete="off"  type="checkbox" name="checkbox[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['e_id'];?>
" class="cb" <?php if ($_smarty_tpl->tpl_vars['item']->value['e_id']==999999){?>disabled<?php }?>/></td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['e_id'];?>
</td>
            <td><span class='ellipsis' style='width: 430px'><?php echo mbsubstr($_smarty_tpl->tpl_vars['item']->value['e_name'],24);?>
</span></td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['e_mds_users'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['e_mds_phone'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['e_mds_dispatch'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['e_mds_gvs'];?>
</td>
            <td class="rich "><?php echo mbsubstr(mod_area_name($_smarty_tpl->tpl_vars['item']->value['e_area']),5);?>
</td>
            <td class="rich "><?php echo modifierStatus($_smarty_tpl->tpl_vars['item']->value['e_status']);?>
</td>
            <td class="rich none"><?php echo $_smarty_tpl->tpl_vars['item']->value['mds_d_ip1'];?>
</td>
            <td class="rich none"><?php echo $_smarty_tpl->tpl_vars['item']->value['vcr_d_ip1'];?>
</td>
            <td><a href="?m=enterprise&a=view&e_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['e_id'];?>
" class="link"><?php echo L("管理");?>
</a></td>
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