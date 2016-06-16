<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:24:38
         compiled from "..\template\modules\device\rs_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22872574cf5e62ed4a2-06652443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '674675c0700caae2e9501fc96927efaf902e647e' => 
    array (
      0 => '..\\template\\modules\\device\\rs_item.tpl',
      1 => 1457343726,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22872574cf5e62ed4a2-06652443',
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
  'unifunc' => 'content_574cf5e65eedd2_46016742',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf5e65eedd2_46016742')) {function content_574cf5e65eedd2_46016742($_smarty_tpl) {?>

<form class="data">
    <table class="base full">
        <tr class='head'>
            <th width="20px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>
            <th width="40px"><?php echo L("ID");?>
</th>
            <th width="120px"><?php echo L("名称");?>
</th>
            <th width="120px"><?php echo L("内网地址");?>
</th>
            <th width="120px"><?php echo L("外网地址");?>
</th>
            <th width="80px"><?php echo L("部署ID名称");?>
</th>
            <th width="70px"><?php echo L("状态");?>
</th>
            <th width="50px"><?php echo L("详情");?>
</th>
            <th width="150px"><?php echo L("操作");?>
</th>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <tr>
            <td><input autocomplete="off"  type="checkbox" name="checkbox[]" value="<?php if ($_smarty_tpl->tpl_vars['item']->value['status']=='no'){?><?php echo $_smarty_tpl->tpl_vars['item']->value['d_id'];?>
<?php }else{ ?>0<?php }?>" class="cb" <?php if ($_smarty_tpl->tpl_vars['item']->value['status']=='yes'){?>disabled<?php }?> /></td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['d_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['d_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['d_ip1'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['d_ip2'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['cluster_name'];?>
</td>
            <!-- <td><span class="ellipsis" style="width: 60px"><?php echo mod_area_name($_smarty_tpl->tpl_vars['item']->value['d_area'],'option');?>
</span></td> -->
            <td><?php echo modDeviceStatus($_smarty_tpl->tpl_vars['item']->value['d_status']);?>
</td>
            <td class="rich"><a  title="<?php echo L('ID');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['d_id'];?>
】<br /><?php echo L('设备名称');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['d_name'];?>
】<br /><?php echo L('部署方式');?>
: 【<?php echo modDeploymentType($_smarty_tpl->tpl_vars['item']->value['d_deployment_type']);?>
】<br /><?php echo L('内网地址');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['d_ip1'];?>
】<br /><?php echo L('外网地址');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['d_ip2'];?>
】<br /><?php echo L('网络接入方式');?>
: 【<?php echo modNetworkType($_smarty_tpl->tpl_vars['item']->value['d_network_type']);?>
】<br /><?php echo L('部署ID名称');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['cluster_name'];?>
】<br /><?php echo L('已用/总并发数');?>
: 【<?php echo $_smarty_tpl->tpl_vars['item']->value['sum_recnum'];?>
|<?php echo $_smarty_tpl->tpl_vars['item']->value['d_recnum'];?>
】<br /><?php echo L('状态');?>
: 【<?php echo modDeviceStatus($_smarty_tpl->tpl_vars['item']->value['d_status']);?>
】<br />" class="link tips_title"><span class="icon hand"></span></a></td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['status']=='yes'){?>
                <a title="<?php echo L('此设备下有企业在用不能编辑');?>
" class="link dis"><?php echo L("编辑");?>
</a>
                <?php }else{ ?>
                <a href="?m=device&a=rs_edit&d_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['d_id'];?>
" class="link"><?php echo L("编辑");?>
</a>
                <?php }?>
                <!-- |<a href="javascript:void(0);" class="link" <?php if ($_smarty_tpl->tpl_vars['item']->value['d_area']!='["#"]'){?>onclick="new_creat(<?php echo $_smarty_tpl->tpl_vars['item']->value['d_id'];?>
);"<?php }else{ ?>onclick="title_notice();"<?php }?>><?php echo L("区域");?>
</a> -->|<a href="?m=device&a=rs_list&device_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['d_id'];?>
&do=rs&d_name=<?php echo $_smarty_tpl->tpl_vars['item']->value['d_name'];?>
&d_ip2=<?php echo $_smarty_tpl->tpl_vars['item']->value['d_ip2'];?>
" class="link"><?php if ($_COOKIE['lang']=='en_US'){?>Info<?php }else{ ?>详情<?php }?></a>
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