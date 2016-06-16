<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:55:59
         compiled from "..\static\script\libs\jquery-ui-1.11.1\i18n\jquery.ui.datepicker-zh-CN.js" */ ?>
<?php /*%%SmartyHeaderCode:218325762234fd97572-33433338%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31fbb8f47044765779a0ae715abeecf6f63191a6' => 
    array (
      0 => '..\\static\\script\\libs\\jquery-ui-1.11.1\\i18n\\jquery.ui.datepicker-zh-CN.js',
      1 => 1412923116,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '218325762234fd97572-33433338',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762234fd9b3f4_26406028',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762234fd9b3f4_26406028')) {function content_5762234fd9b3f4_26406028($_smarty_tpl) {?>/* Chinese initialisation for the jQuery UI date picker plugin. */
/* Written by Cloudream (cloudream@gmail.com). */
jQuery(function($){
	$.datepicker.regional['zh-CN'] = {
		closeText: '关闭',
		prevText: '&#x3C;上月',
		nextText: '下月&#x3E;',
		currentText: '今天',
		monthNames: ['一月','二月','三月','四月','五月','六月',
		'七月','八月','九月','十月','十一月','十二月'],
		monthNamesShort: ['一月','二月','三月','四月','五月','六月',
		'七月','八月','九月','十月','十一月','十二月'],
		dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
		dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
		dayNamesMin: ['日','一','二','三','四','五','六'],
		weekHeader: '周',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: '年'};
	$.datepicker.setDefaults($.datepicker.regional['zh-CN']);
});<?php }} ?>