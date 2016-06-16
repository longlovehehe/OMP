<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:24:51
         compiled from "..\template\modules\enterprise\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14179574cf5f322cdf6-64353123%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c03de206875f0c3419aef63cc7f09b4f822ed40' => 
    array (
      0 => '..\\template\\modules\\enterprise\\index.tpl',
      1 => 1457077695,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14179574cf5f322cdf6-64353123',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf5f3401a53_48998476',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf5f3401a53_48998476')) {function content_574cf5f3401a53_48998476($_smarty_tpl) {?><div class="toolbar mactoolbar"><a href="?m=enterprise&a=index" class="button active"><?php echo L("企业管理");?>
</a><a href="?m=enterprise&a=allusers" class="button "><?php echo L("用户搜索");?>
</a><a href="?m=device&a=vcrs" class="button none"><?php echo L("车辆管理");?>
</a></div><h2 class="title"><?php echo L("企业管理");?>
</h2><div class="toptoolbar"><a href="?m=enterprise&a=add" class="button orange"><?php echo L("新增企业");?>
</a></div><div class="toolbar"><form action="?m=enterprise&a=index_item" id="form" method="post"><input autocomplete="off"  name="modules" value="enterprise" type="hidden" /><input autocomplete="off"  name="action" value="index_item" type="hidden" /><input autocomplete="off"  name="page" value="0" type="hidden" /><div class="line"><label><?php echo L("企业编号");?>
：</label><input autocomplete="off"  class="autosend" name="e_id" type="text" /></div><div class="line"><label><?php echo L("企业名称");?>
：</label><input autocomplete="off"  class="autosend" name="e_name" type="text" /></div><div class="line"><label><?php echo L("区域");?>
：</label><select value="" name="e_area" class="autofix autoselect" data='[{ "to": "e_mds_id","field": "d_area","view":"true" }]' action="?m=area&a=option"><option value="@"><?php echo L("全部");?>
</option></select></div><div class="line"><label><?php echo L("状态");?>
：</label><select name="e_status"><option value=""><?php echo L("全部");?>
</option><option value="1"><?php echo L("启用");?>
</option><option value="0"><?php echo L("不启用");?>
</option><option value="2"><?php echo L("发布处理中");?>
</option><option value="3"><?php echo L("发布失败");?>
</option><option value="5"><?php echo L("企业创建中");?>
</option><option value="6"><?php echo L("企业删除中");?>
</option><option value="7"><?php echo L("企业迁移中");?>
</option><option value="8"><?php echo L("企业迁移失败");?>
</option><option value="9"><?php echo L("企业创建失败");?>
</option></select></div><div class="line"><label><?php echo $_SESSION['ident'];?>
-Server：</label><select value="" name="e_mds_id" id="e_mds_id" class="autofix"  data='' action="?m=device&action=mds_option&view=true"><option value=""><?php echo L("全部");?>
</option></select></div><div class="line"><label><?php echo L("创建者");?>
：</label><select value="" name="e_create_name" class="autofix autoselect" action="?m=enterprise&a=create_option"><option value=""><?php echo L("全部");?>
</option></select></div><div class="buttons right"><a form="form" class="button submit"><?php echo L("查询");?>
</a></div></form></div><div class="toolbar"><a id="delall" class="button"><?php echo L("批量删除");?>
</a><a id="refreshall" class="refreshall button" data="?m=enterprise&a=refresh" ><?php echo L("批量状态刷新");?>
</a></div><div><table class="full"><tr class='head' style="height: 35px;" type="ent" url="?m=enterprise&action=index_item"><td width="110px" class="clickPage"><?php echo L("企业列表");?>
</td><td width="490px" class="clickPage" style="text-align:right;"><?php echo L("显示条数");?>
：</td><td width="50px" onclick="clickPage(this)" class="clickPage" <?php echo $_SESSION['color'][10];?>
 onmouseover="this.style.cursor='pointer'">10</td><td width="50px" onclick="clickPage(this)" class="clickPage" <?php echo $_SESSION['color'][20];?>
 onmouseover="this.style.cursor='pointer'">20</td><td width="50px" onclick="clickPage(this)" class="clickPage" <?php echo $_SESSION['color'][50];?>
 onmouseover="this.style.cursor='pointer'">50</td></tr></table></div><div class="content"></div><div id="dialog-confirm" class="hide" title="<?php echo L("删除选中项");?>
?"><p><?php echo L("确定要删除选中的企业吗");?>
?</p></div><?php }} ?>