<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 10:08:35
         compiled from "..\template\modules\terminal\index_list_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2577257353723b151a1-99727204%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36c6f308096e55caec6c88d73c4b4780c40a2156' => 
    array (
      0 => '..\\template\\modules\\terminal\\index_list_item.tpl',
      1 => 1448515086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2577257353723b151a1-99727204',
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
  'unifunc' => 'content_57353723ee1d08_82952384',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57353723ee1d08_82952384')) {function content_57353723ee1d08_82952384($_smarty_tpl) {?><form class="data"><table class="base full"><tr class='head'><th width="10px"><input autocomplete="off"  type="checkbox" id="checkall" /></th><th class="" width="30px"><?php echo L("状态");?>
</th><th class="" width="120px">IMEI</th><th class="" width="70px"><?php echo L("终端型号");?>
</th><th class="" width="150px"><?php echo L("序列号");?>
</th><th class="" width="90px"><?php echo L("系统号码");?>
</th><th class="" width="50px"><?php echo L("详情");?>
</th><th class="" colspan="3" width="200px" style="text-align: center;"><?php echo L("操作");?>
</th></tr><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['list']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['list']['iteration']++;
?><tr><input type="hidden" name="md_type<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['list']['iteration'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['md_type'];?>
"><input type="hidden" name="md_type_name<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['list']['iteration'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['md_type'];?>
"><td class=""><input autocomplete="off"  type="checkbox" name="checkbox[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['md_imei'];?>
" class="cb" <?php if ($_smarty_tpl->tpl_vars['item']->value['md_binding']==1){?><?php }?> /><input type="hidden" name="md_id<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['list']['iteration'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['md_id'];?>
"/></td><td><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['md_imei'];?>
<?php $_tmp1=ob_get_clean();?><?php echo get_isbind($_smarty_tpl->tpl_vars['item']->value['md_binding'],$_tmp1);?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['md_imei'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['md_type'];?>
</td><td title="<?php echo $_smarty_tpl->tpl_vars['item']->value['md_serial_number'];?>
"><?php echo mbsubstr($_smarty_tpl->tpl_vars['item']->value['md_serial_number'],20);?>
</td><td><?php echo get_bindnum($_smarty_tpl->tpl_vars['item']->value['md_imei']);?>
</td><!-- |get_imei_ep --><td><a title="IMEI:<?php echo $_smarty_tpl->tpl_vars['item']->value['md_imei'];?>
<br /><?php echo L('终端型号');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['md_type'];?>
<br /><?php echo L('序列号');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['md_serial_number'];?>
<br /><?php echo L('所属代理商');?>
:<?php echo getompman($_smarty_tpl->tpl_vars['item']->value['ag_name']);?>
<br ><?php echo L('所属企业');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['e_name'];?>
<br /><?php echo L('系统号码');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['md_binding_user'];?>
<br /><?php echo L('入库单号');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['md_in_number'];?>
<br /><?php echo L('入库时间');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['md_time'];?>
<br /><?php echo L('批次');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['md_batch'];?>
<br /><?php echo L('名称');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['md_name'];?>
<br /><?php echo L('备注');?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['md_remarks'];?>
<br />" class="link tips_title"><span class="icon hand"></span></a></td><td <?php if ($_smarty_tpl->tpl_vars['item']->value['md_binding']==0){?> style="padding-left: 13px;" <?php }?>><?php if ($_smarty_tpl->tpl_vars['item']->value['md_binding']==0){?><?php echo L("无");?>
<?php }else{ ?><?php if (get_isstat($_smarty_tpl->tpl_vars['item']->value['md_imei'])==1){?><a class="link edit start_stop " md_stat="<?php echo get_isstat($_smarty_tpl->tpl_vars['item']->value['md_imei']);?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['md_imei'];?>
"  href="javascript:void(0);"><img class="enable" src='images/Enable1.png' onMouseOver="this.src='images/enable_pass.png'" onMouseOut="this.src='images/Enable1.png'"></a><!-- <?php echo L("启用");?>
 --></a><?php }elseif(get_isstat($_smarty_tpl->tpl_vars['item']->value['md_imei'])==0){?><a class="link edit start_stop" md_stat="<?php echo get_isstat($_smarty_tpl->tpl_vars['item']->value['md_imei']);?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['md_imei'];?>
"  href="javascript:void(0);"><img class="disable" src='images/Disable1.png' onMouseOver="this.src='images/disable_pass.png'" onMouseOut="this.src='images/Disable1.png'"></a><!-- <?php echo L("停用");?>
 --></a><?php }?><?php }?></td><td><?php if ($_smarty_tpl->tpl_vars['item']->value['md_binding']==1){?><a href="javascript:void(0);"  class="link edit dis set_gray" ><img class="edit" src='images/edit.png' onMouseOver="this.src='images/edit_pass.png'" onMouseOut="this.src='images/edit.png'"/></a><!-- <?php echo L("编辑");?>
 --></a><a id="del" class="mrlf15 link dis set_gray"><img class="delete" src='images/delete.png' onMouseOver="this.src='images/delete_pass.png'" onMouseOut="this.src='images/delete.png'"/></a><!-- <?php echo L("删除");?>
 --></a><?php }else{ ?><a href="?m=terminal&a=term_edit&md_imei=<?php echo $_smarty_tpl->tpl_vars['item']->value['md_imei'];?>
"  class="link edit"><img class="edie" src='images/edit.png' onMouseOver="this.src='images/edit_pass.png'" onMouseOut="this.src='images/edit.png'"/></a><!-- <?php echo L("编辑");?>
 --></a><a id="del" class="mrlf15 link <?php if ($_smarty_tpl->tpl_vars['item']->value['status']=='yes'){?>msg<?php }?>" onclick="del_term(this,'<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['list']['iteration'];?>
','<?php echo $_smarty_tpl->tpl_vars['item']->value['md_imei'];?>
')"><img class="delete" src='images/delete.png' onMouseOver="this.src='images/delete_pass.png'" onMouseOut="this.src='images/delete.png'"/><!-- <?php echo L("删除");?>
 --></a><input type="hidden" name="list_id" value="<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['list']['iteration'];?>
" /><?php }?></td><td><a href="?m=terminal&a=history&th_imei=<?php echo $_smarty_tpl->tpl_vars['item']->value['md_imei'];?>
" class="link edit view"></a></td></tr><?php } ?></table><?php if ($_smarty_tpl->tpl_vars['list']->value!=null){?><div class="page none_select rich"><div class="num"><?php echo $_smarty_tpl->tpl_vars['numinfo']->value;?>
</div><div class="turn"><a page="<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
" class="prev"><?php echo L("上一页");?>
</a><a page="<?php echo $_smarty_tpl->tpl_vars['next']->value;?>
" class="next"><?php echo L("下一页");?>
</a></div></div><?php }?></form><div class="buttom"><span class="img_start"><?php echo L("启用");?>
</span><span class="img_stop"><?php echo L("停用");?>
</span><span class="img_unbind"><?php echo L("未绑定");?>
</span></div>
<script>
   (function () {
        $("a.start_stop").each(function(){
            $(this).on("click",function(){
                setstatus(this);
        });
    });
    })();
</script>
<?php }} ?>