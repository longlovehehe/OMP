<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:25:43
         compiled from "..\static\script\modules\log\index.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:9932574cf627590028-79568972%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6a31b660c66f352035b61b2857f9287a6be21ac' => 
    array (
      0 => '..\\static\\script\\modules\\log\\index.tpl.js',
      1 => 1428044656,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9932574cf627590028-79568972',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf6275a38a2_68326046',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf6275a38a2_68326046')) {function content_574cf6275a38a2_68326046($_smarty_tpl) {?>
$("input[name=el_id]").on("input",function(){
	var flag = false;
	var mob = /^\d+$/;
    if (mob.test($("input[name=el_id]").val())||$("input[name=el_id]").val()=="") {
        flag = true;
    }
    if(flag==false){
    	notice("<?php echo L('日志ID只能为数字');?>
");
    	$("input[name=el_id]").val("");
    }
});

/*
jQuery.validator.addMethod("el_id", function (value, element) {
    var flag = false;
    var mob = /^\d+$/;
    if (mob.test(value)||value=="") {
        flag = true;
    }
    if(flag==false){
    	notice("<?php echo L('日志ID只能为数字');?>
");
    }
});
*/<?php }} ?>