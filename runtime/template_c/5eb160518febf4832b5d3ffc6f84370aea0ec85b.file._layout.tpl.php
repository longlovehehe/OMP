<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:55:59
         compiled from "..\template\_layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105695762234f79c008-82464468%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5eb160518febf4832b5d3ffc6f84370aea0ec85b' => 
    array (
      0 => '..\\template\\_layout.tpl',
      1 => 1461825507,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105695762234f79c008-82464468',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'style' => 0,
    'url' => 0,
    'mininav' => 0,
    'item' => 0,
    'request' => 0,
    'content' => 0,
    'script' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762234faef9d5_68645411',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762234faef9d5_68645411')) {function content_5762234faef9d5_68645411($_smarty_tpl) {?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6 lang_<?php echo $_COOKIE['lang'];?>
 can_select"> <![endif]--><!--[if IE 7 ]><html class="ie7 lang_<?php echo $_COOKIE['lang'];?>
 can_select"> <![endif]--><!--[if IE 8 ]><html class="ie8 lang_<?php echo $_COOKIE['lang'];?>
 can_select"><![endif]--><!--[if IE 9 ]><html class="ie9 lang_<?php echo $_COOKIE['lang'];?>
 can_select"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--><html class="lang_<?php echo $_COOKIE['lang'];?>
 can_select"><!--<![endif]--><head><meta charset="UTF-8"><meta http-equiv="pragma" content="max-age=2592000"><meta http-equiv="cache-control" content="max-age=2592000"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="renderer" content="webkit"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon" /><title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title><?php echo style($_smarty_tpl->tpl_vars['style']->value);?>
<script src="script/libs.before.js"></script><script src="script/autoselect.js"></script><?php echo scriptmodule('before');?>
<link  href="style/ie6.layout.adapter.css" rel="stylesheet" type="text/css" /><link href="style/layout.css"  rel="stylesheet" /><link  href="style/css.css" rel="stylesheet" type="text/css" /><!--[if lte IE 8]><?php echo scriptnocompile('libs/html5');?>
<![endif]--></head><body class="<?php echo $_GET['m'];?>
" scroll="yes"><span class="request none">[<?php echo mb_convert_encoding(htmlspecialchars(json_encode($_REQUEST), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]</span><div class="lang"><a class="lang" data="cn_ZH">中文版</a><span class='sep'>|</span><a class="lang" data="en_US">English</a><span class='sep'>|</span><a class="lang" data="zh_TW">繁體中文</a></div><div class="quicktoolbar animated none"><input autocomplete="off"  value="<?php echo $_GET['u_number'];?>
" type="text" placeholder="输入需要搜索的企业用户帐号" /><a class="search" data="?m=enterprise&a=allusers&u_number="></a></div><div class="header"><header><h1 class="title <?php if ($_COOKIE['lang']=='en_US'){?>_GQT_icon_logo_1x120_en_png<?php }else{ ?>_GQT_icon_logo_1x120_png<?php }?>"><a><?php echo L("运营管理平台");?>
</a></h1><div class="login_tips" style="overflow: hidden;" ><div class="account" ><a href="?m=system&a=index" class="link "><?php echo $_SESSION['own']['om_id'];?>
</a><a href="?m=system&a=resetpassword" class="logout"><?php echo L("修改密码");?>
</a><a href="?m=logout" class="logout"><?php echo L("注销");?>
</a><a href="?m=help&a=index" target="_blank" class="link help none"><?php echo L("帮助模块");?>
</a></div></div></header></div><section class="content" style="overflow: hidden;" ><div class="nav" ><nav><ul class="menu"><li> <a href="?m=system&a=index" class="system"><div ><?php echo L("首页");?>
</div></a></li><li><a href="?m=enterprise&a=index" href1="?m=enterprise&a=index" class="enterprise"><?php echo L("企业管理");?>
</a></li><li><a href="javascript:void(0);" class="device cluster server rs ss"><?php echo L("设备管理");?>
</a><ul class="submenu"><li><a href="?m=device&a=cluster" class="cluster"><?php echo L("部署管理");?>
</a></li><li><a href="?m=device&a=server" class="server"><?php echo L("SERVER管理");?>
</a></li><li><a href="?m=device&a=rs" class="rs"><?php echo L("RS管理");?>
</a></li><li><a href="?m=device&a=ss" class="ss"><?php echo L("SS管理");?>
</a></li></ul></li><li><a href="javascript:void(0);" class="agents keeper_list"><?php echo L("帐号管理");?>
</a><ul class="submenu"><li><a href="?m=agents&a=index"  class="agents"><?php echo L("代理商管理");?>
</a></li><li><a href="?m=terminal&a=keeper_list" class="keeper_list"><?php echo L("Keeper管理");?>
</a></li></ul></li><li><a href="javascript:void(0);" class="index_type index_list terminal_in history history_gprs gprs product"><?php echo L("业务管理");?>
</a><ul class="submenu"><li><a href="?m=terminal&a=index_type" class="index_type"><?php echo L("终端类型");?>
</a></li><li><a href="?m=terminal&a=index_list" class="index_list terminal_in history"><?php echo L("终端管理");?>
</a></li><li><a href="?m=gprs&a=index" class="gprs history_gprs"><?php echo L("流量卡管理");?>
</a></li><?php if ($_SESSION['ident']=='VT'){?><li><a href="?m=product&a=index" class="product"><?php echo L("功能管理");?>
</a></li><?php }elseif($_SESSION['ident']=='GQT'){?><li><a href="?m=product&a=index" class="product"><?php echo L("产品管理");?>
</a></li><?php }?></ul></li><li><a href="javascript:void(0);" class="report account "><?php echo L("业务统计");?>
</a><ul class="submenu"><?php if ($_smarty_tpl->tpl_vars['url']->value!=''){?><li><a href="javascript:void(0);"  class="report" id="report-jump" action="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"><?php echo L("数据报表");?>
</a></li><?php }?><li><a href="?m=account&a=index"  class="account"><?php echo L("计费报表");?>
</a></li></ul></li><?php if ($_SESSION['own']['om_id']=='admin'){?><li><a href="javascript:void(0);" class="cms manager area"><?php echo L("管理员管理");?>
</a><ul class="submenu"><li><a href="?m=cms&a=index" class="cms "><?php echo L("版本管理");?>
</a></li><li><a href="?m=manager&a=index" class="manager"><?php echo L("角色管理");?>
</a></li><li><a href="?m=area&a=index" class="area"><?php echo L("区域管理");?>
</a></li></ul></li><?php }?><li><a href="javascript:void(0);" class="log announcement sysconfig backup"><?php echo L("其他");?>
</a><ul class="submenu"><li><a href="?m=log&a=index" class="log"><?php echo L("日志管理");?>
</a></li><li><a href="?m=announcement&a=index" class="announcement"><?php echo L("公告管理");?>
</a></li><?php if ($_SESSION['own']['om_id']=='admin'){?><li><a href="?m=backup&a=index" class="backupss"><?php echo L("备份");?>
</a></li><?php }?></ul></li></ul></nav></div><div class="minipage" style="overflow: hidden;" ><?php if ($_smarty_tpl->tpl_vars['mininav']->value!=null){?><nav class="mininav" style='background: transparent;'><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mininav']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><a title='<?php echo L(((string)$_smarty_tpl->tpl_vars['item']->value['name']));?>
' class="ctips" <?php if ($_smarty_tpl->tpl_vars['item']->value['next']!=''){?>href="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
"<?php }else{ ?>style="color:#111;text-decoration:none;"<?php }?>><?php ob_start();?><?php echo mbsubstr($_smarty_tpl->tpl_vars['item']->value['name'],20);?>
<?php $_tmp1=ob_get_clean();?><?php echo L($_tmp1);?>
</a><?php echo $_smarty_tpl->tpl_vars['item']->value['next'];?>
<?php } ?></nav><?php }?><div class="pagecontent mini_<?php echo $_smarty_tpl->tpl_vars['request']->value['modules'];?>
_<?php echo $_smarty_tpl->tpl_vars['request']->value['action'];?>
 " style="overflow: hidden;padding-bottom:50px;padding-top: 30px;" ><?php echo L(((string)$_smarty_tpl->tpl_vars['content']->value));?>
</div></div></section><footer><hr /><p class='hidden1'>Copyright (C) http://www.zed-3.com.cn/, All Rights Reserved</p><p class='hidden1'><?php echo L("捷思锐科技版权所有 京ICP备09032422号");?>
</p></footer><script src="?m=lang"></script><?php echo scriptafter($_smarty_tpl->tpl_vars['script']->value);?>
<script src="script/com.js"></script><div id="fade" class="black_overlay"></div></body></html>
<?php }} ?>