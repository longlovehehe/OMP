<?php /* Smarty version Smarty-3.1.11, created on 2016-05-21 16:53:22
         compiled from "..\template\modules\enterprise\allusers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2676157402202a2b260-60667500%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a5c007fd83413e7e61d1a257e0d08907dddb104' => 
    array (
      0 => '..\\template\\modules\\enterprise\\allusers.tpl',
      1 => 1456971391,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2676157402202a2b260-60667500',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57402202c23158_34887532',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57402202c23158_34887532')) {function content_57402202c23158_34887532($_smarty_tpl) {?><div class="toolbar mactoolbar"><a href="?m=enterprise&a=index" class="button "><?php echo L("企业管理");?>
</a><a href="?m=enterprise&a=allusers" class="button active"><?php echo L("用户搜索");?>
</a><a href1="?m=device&a=vcrs" class="button none"><?php echo L("车辆管理");?>
</a></div><h2 class="title"><?php echo L(((string)$_smarty_tpl->tpl_vars['title']->value));?>
</h2><div class="toolbar"><form action="?m=enterprise&action=all_user_item" id="form" method="get"><input autocomplete="off"  name="page" value="0" type="hidden" /><input autocomplete="off"  name="num" value="100" type="hidden" /><h3 class="title"><?php echo L("基本属性");?>
</h3><div class="line"><label><?php echo L("姓名");?>
：</label><input value='<?php echo $_REQUEST['u_name'];?>
' autocomplete="off"  class="autosend" name="u_name" type="text" /></div><div class="line"><label><?php echo L("号码");?>
：</label><input value='<?php echo $_REQUEST['u_number'];?>
' autocomplete="off"  class="autosend" name="u_number" type="text" /></div><div class="line"><label><?php echo L("用户类型");?>
：</label><select name="u_sub_type"><option value=""><?php echo L("全部");?>
</option><option value="1"><?php echo L("手机用户");?>
</option><option value="2"><?php echo L("调度台用户");?>
</option><option value="3"><?php echo L("GVS用户");?>
</option></select></div><div class="line"><label><?php echo L("订购产品");?>
：</label><select name="u_product_id" class="autofix" action="?m=product&a=option" ><option value=""><?php echo L("全部");?>
</option></select></div><div class="line"><label><?php echo L("用户分类");?>
：</label><select name="u_attr_type" ><option value=""><?php echo L("全部");?>
</option><option value="1"><?php echo L("测试");?>
</option><option value="0"><?php echo L("商用");?>
</option></select></div><h3 class="title"><?php echo L("详细属性");?>
<a class="toggle alink" data="detailed"><?php echo L("展开");?>
↓</a></h3><div class="detailed none"><div class="line none"><label><?php echo L("头像");?>
：</label><select name="u_pic"><option value=""><?php echo L("全部");?>
</option><option value="1"><?php echo L("有头像");?>
</option><option value="0"><?php echo L("无头像");?>
</option></select></div><div class="line none"><label><?php echo L("性别");?>
：</label><select name="u_sex"><option value=""><?php echo L("全部");?>
</option><option value="M"><?php echo L("男");?>
</option><option value="F"><?php echo L("女");?>
</option></select></div><div class="line"><label><?php echo L("手机号");?>
：</label><input autocomplete="off"  class="autosend" name="u_mobile_phone" type="text" /></div><div class="line none"><label>UDID：</label><input autocomplete="off"  class="autosend" name="u_udid" type="text" /></div><div class="line"><label>IMSI：</label><input autocomplete="off"  class="autosend" name="u_imsi" type="text" /></div><div class="line"><label>IMEI：</label><input autocomplete="off"  class="autosend" name="u_imei" type="text" /></div><div class="line"><label>ICCID：</label><input autocomplete="off"  class="autosend" name="u_iccid" type="text" /></div><div class="line"><label>MAC：</label><input autocomplete="off"  class="autosend" name="u_mac" type="text" /></div><div class="line"><label><?php echo L("终端类型");?>
：</label><input autocomplete="off"  class="autosend" name="u_terminal_type" type="text" /></div></div><div class="buttons right"><a form="form" class="button waitsubmit"><i class="icon-search"></i><?php echo L("查询");?>
</a></div></form></div><div class="content"></div><?php }} ?>