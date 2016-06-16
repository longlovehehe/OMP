<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:55:59
         compiled from "..\template\modules\system\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:295205762234f6731c7-72357306%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6341db7267f524bdfb49ddd1bdb6305316e24dd7' => 
    array (
      0 => '..\\template\\modules\\system\\index.tpl',
      1 => 1437362616,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '295205762234f6731c7-72357306',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'en' => 0,
    'device' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762234f78c607_71154235',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762234f78c607_71154235')) {function content_5762234f78c607_71154235($_smarty_tpl) {?>
<!-- 基本信息 -->
<div class="userinfo">
    <h2 class="title _3_jpg" ><em class='none'><?php echo L("帐号信息");?>
</em></h2>
    <div class="uname"><?php echo L("姓名");?>
：<?php echo $_SESSION['own']['om_id'];?>
</div>
    <ul class="list admintype">
        <li><label class='title'><?php echo L("管理员级别");?>
：</label><?php echo level($_SESSION['own']['om_id']);?>
</li>
        <li title='<?php echo mod_area_name($_SESSION['own']['om_area']);?>
'><label class='title'><?php echo L("管辖区域");?>
：</label><span class='ellipsis2' style='width: 240px;'><?php echo mod_area_name($_SESSION['own']['om_area'],'option');?>
</span></li>
        <li><label class='title'><?php echo L("管辖企业");?>
：</label><?php echo $_smarty_tpl->tpl_vars['en']->value;?>
</li>
        <li><label class='title'><?php echo L("管辖设备");?>
：</label><?php echo $_smarty_tpl->tpl_vars['device']->value;?>
</li>
    </ul>
    <!--帐号状态-->
    <ul class="list logininfo">
        <li><?php echo L("上次登录地址");?>
：<?php echo $_SESSION['own']['om_lastlogin_ip'];?>
</li>
        <li><?php echo L("上次登录时间");?>
：<?php echo $_SESSION['own']['om_lastlogin_time'];?>
</li>
    </ul>
</div>
<div class="anbbs">
    <h2 class="title" ><?php echo L("系统公告");?>
</h2>

    <p class='info none'><?php echo L("提示：公告往下滚动，查看更多");?>
</p>
    <form class="none" id="form" action="?m=system&a=index_item" method="post" >
        <div  class="toolbar ">
            <input autocomplete="off"  name="page" value="-1" type="hidden" />
            <input autocomplete="off"  type="hidden" value="10" name="num" />
            <a form="form" class="submit none"></a>
        </div>
    </form>
    <div class="content "></div>
</div>
<?php }} ?>