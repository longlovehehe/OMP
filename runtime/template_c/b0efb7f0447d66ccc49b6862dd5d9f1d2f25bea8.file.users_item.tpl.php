<?php /* Smarty version Smarty-3.1.11, created on 2016-05-23 13:36:37
         compiled from "..\template\modules\enterprise\users_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14227574296e5cbf751-71407639%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0efb7f0447d66ccc49b6862dd5d9f1d2f25bea8' => 
    array (
      0 => '..\\template\\modules\\enterprise\\users_item.tpl',
      1 => 1456971391,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14227574296e5cbf751-71407639',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'item' => 0,
    'pg_list' => 0,
    'key' => 0,
    'val' => 0,
    'v' => 0,
    'data' => 0,
    'page' => 0,
    'numinfo' => 0,
    'prev' => 0,
    'next' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574296e6257787_38064481',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574296e6257787_38064481')) {function content_574296e6257787_38064481($_smarty_tpl) {?>
<form class="data">
    <table class="base full" >
        <tr class='head' id="user_list">
            <th width="40px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>

            <th width="160px"><?php echo L("姓名");?>
</th>
            <th width="140px"><?php echo L("号码");?>
</th>
            <th class="rich" width="100px"><?php echo L("类型");?>
</th>
            <th class="rich" width="110px"><?php echo L("订购产品");?>
</th>
            <th class="rich" width="120px"><?php echo L("所属群组");?>
</th>
            <th class="rich" width="110px"><?php echo L("部门");?>
</th>

            <th class="rich none" width="100px"><?php echo L("性别");?>
</th>
            <th class="rich none" width="100px"><?php echo L("职位");?>
</th>
            <th class="rich group none" width="100px"><?php echo L("部门");?>
</th>
            <th class="rich none" width="100px"><?php echo L("终端类型");?>
</th>
            <th class="rich none" width="100px"><?php echo L("机型");?>
</th>
            <th class="rich none" width="100px"><?php echo L("IMSI");?>
</th>
            <th class="rich none" width="100px"><?php echo L("IMEI");?>
</th>
            <th class="rich none" width="100px"><?php echo L("ICCID");?>
</th>
            <th class="rich none" width="100px"><?php echo L("MAC");?>
</th>
            <th class="rich none" width="100px"><?php echo L("蓝牙标识号");?>
</th>
            <th class="rich" width="50px"><?php echo L("详情");?>
</th>
            <th class="rich" width="50px"><?php echo L("操作");?>
</th>
            <th class="rich" width="70px"><?php echo L("历史记录");?>
</th>
        </tr>

        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <tr>
            <td><input onclick="getnum();" autocomplete="off"  type="checkbox" name="checkbox[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
" class="cb" /></td>
            <td title="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_name'];?>
"><em class="ellipsis" style="width: 265px"><?php echo mbsubstr($_smarty_tpl->tpl_vars['item']->value['u_name'],11);?>
</em></td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
</td>
            <td class="rich"><?php echo modtype($_smarty_tpl->tpl_vars['item']->value['u_sub_type']);?>
</td>
            <td title='<?php echo getEListBypid($_smarty_tpl->tpl_vars['item']->value['p_id']);?>
' class="rich"><?php echo $_smarty_tpl->tpl_vars['item']->value['p_name'];?>
</td>
            <td class="rich">
                <select style="width:100px;" class="only_show">
                    <option value="1"><?php echo L("点击查看");?>
</option>
                     <?php if ($_smarty_tpl->tpl_vars['item']->value['pg_name']!=''){?>
                            <option style="color:#b81900;">*<?php echo $_smarty_tpl->tpl_vars['item']->value['pg_name'];?>
</option>
                        <?php }?>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['pg_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
                        
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['u_number']==$_smarty_tpl->tpl_vars['key']->value){?>
                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['val']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                    <option><?php echo $_smarty_tpl->tpl_vars['v']->value['pg_name'];?>
</option>
                    <?php } ?>
                    <?php }?>
                    <?php } ?>
                </select>
            </td>
            <td class="rich"><?php echo mbsubstr($_smarty_tpl->tpl_vars['item']->value['ug_name'],3);?>
</td>

            <td class="rich none"><?php echo modsex($_smarty_tpl->tpl_vars['item']->value['u_sex']);?>
</td>
            <td class="rich none"><?php echo $_smarty_tpl->tpl_vars['item']->value['u_position'];?>
</td>
            <td class="rich none "><?php echo $_smarty_tpl->tpl_vars['item']->value['ug_name'];?>
</td>
            <td class="rich none"><?php echo $_smarty_tpl->tpl_vars['item']->value['u_terminal_type'];?>
</td>
            <td class="rich none"><?php echo $_smarty_tpl->tpl_vars['item']->value['u_terminal_model'];?>
</td>
            <td class="rich none"><?php echo $_smarty_tpl->tpl_vars['item']->value['u_imsi'];?>
</td>
            <td class="rich none"><?php echo $_smarty_tpl->tpl_vars['item']->value['u_imei'];?>
</td>
            <td class="rich none"><?php echo $_smarty_tpl->tpl_vars['item']->value['u_iccid'];?>
</td>
            <td class="rich none"><?php echo $_smarty_tpl->tpl_vars['item']->value['u_mac'];?>
</td>
            <td class="rich none"><?php echo $_smarty_tpl->tpl_vars['item']->value['u_zm'];?>
</td>
            <td class="rich"><a  <?php if ($_smarty_tpl->tpl_vars['item']->value['u_sub_type']==1){?>title="<?php echo L('号码');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
】<br /><?php echo L('姓名');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_name'];?>
】<br /><?php echo L('类型');?>
:【<?php echo modtype($_smarty_tpl->tpl_vars['item']->value['u_sub_type']);?>
】<br /><?php echo L('默认群组');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['pg_name'];?>
】<br /><?php echo L('部门');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['ug_name'];?>
】<br /><?php echo L('终端类型');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_terminal_type'];?>
】<br /><?php echo L('机型');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_terminal_model'];?>
】<br /><?php echo L('IMSI');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_imsi'];?>
】<br /><?php echo L('IMEI');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_imei'];?>
】<br /><?php echo L('ICCID');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_iccid'];?>
】<br /><?php echo L('MAC');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_mac'];?>
】<br /><?php echo L('购买日期');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_purch_date'];?>
】<br /><?php echo L('终端序列号');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_terminal_number'];?>
】"<?php }elseif($_smarty_tpl->tpl_vars['item']->value['u_sub_type']==2){?>title="<?php echo L('号码');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
】<br /><?php echo L('姓名');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_name'];?>
】<br /><?php echo L('类型');?>
:【<?php echo modtype($_smarty_tpl->tpl_vars['item']->value['u_sub_type']);?>
】<br /><?php echo L('默认群组');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['pg_name'];?>
】<br /><?php echo L('部门');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['ug_name'];?>
】"<?php }else{ ?>title="<?php echo L('号码');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
】<br /><?php echo L('姓名');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['u_name'];?>
】<br /><?php echo L('类型');?>
:【<?php echo modtype($_smarty_tpl->tpl_vars['item']->value['u_sub_type']);?>
】<br /><?php echo L('部门');?>
:【<?php echo $_smarty_tpl->tpl_vars['item']->value['ug_name'];?>
】"<?php }?> class="link tips_title"><span class="icon hand"></span></a></td>
            <td class="rich"><a href="?m=enterprise&a=users_save&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
&u_number=<?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
&do=edit&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" class="link"><?php echo L("编辑");?>
</a></td>
            <td class="rich">
                <a href="?m=enterprise&a=users_history&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
&uh_u_number=<?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
&do=edit&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"class="link view"></a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php if ($_smarty_tpl->tpl_vars['list']->value!=null){?>
    <div class="page none_select rich">
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
    <?php }?>
</form>
<?php }} ?>