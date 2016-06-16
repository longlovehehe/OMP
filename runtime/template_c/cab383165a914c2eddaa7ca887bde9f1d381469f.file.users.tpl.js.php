<?php /* Smarty version Smarty-3.1.11, created on 2016-05-23 13:36:36
         compiled from "..\static\script\modules\enterprise\users.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:26694574296e4525d08-98868290%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cab383165a914c2eddaa7ca887bde9f1d381469f' => 
    array (
      0 => '..\\static\\script\\modules\\enterprise\\users.tpl.js',
      1 => 1460104922,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26694574296e4525d08-98868290',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574296e4583918_49681128',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574296e4583918_49681128')) {function content_574296e4583918_49681128($_smarty_tpl) {?>var request = eval($("span.request").text());
var request = request[0];
var e_id = request.e_id;
$("div.autoactive[action=users]").addClass("active");
$("a#batch_toggle").click(function () {
    $("form.move_user").hide();
    $("form.product").hide();
    $("form.move_u_default_pg").hide();
    $("form.batch").toggle();
});
$("a#batch_product").click(function () {
    $("form.move_user").hide();
    $("form.move_u_default_pg").hide();
    $("form.batch").hide();
    $("form.product").toggle();
});
$("a#move_user").click(function () {
    $("form.batch").hide();
    $("form.product").hide();
    $("form.move_u_default_pg").hide();
    $("form.move_user").toggle();
});
$("a#move_u_default_pg").click(function () {
    $("form.move_user").hide();
    $("form.product").hide();
    $("form.batch").hide();
    $("form.move_u_default_pg").toggle();
});

$("input[name=u_alarm_inform_svp_num]").bind("change", function () {
    var length=$(this).val().length;
    var u_number = $(this).val();
    $.ajax({
        url:'?modules=enterprise&action=check_number',
        data:{e_id:e_id,u_number:u_number},
        success:function(res){
            if(res=="1"&&length==11||u_number==""){
                $("#u_alarm_inform_svp_num-error").attr('class','error none');
            }
            else{
                $("#u_alarm_inform_svp_num-error").attr('class','error');
            }
        }
    });
});

$("select[name=u_alarm_inform_svp_num]").bind("change", function () {
    $("#u_alarm_inform_svp_num-error").attr('class','error none');
});
/**
 $("input[name=move_u_default]").on('click', function () {
 var own = $(this);
 $('select[name=move_u_default_pg]>option').remove();
 if (own.is(":checked")) {
 $('select[name=move_u_default_pg]').addClass('autofix').attr('action', '?m=enterprise&a=groups_option&safe=true&e_id=' + e_id);
 } else {
 $('select[name=move_u_default_pg]').addClass('autofix').attr('action', '?m=enterprise&a=groups_option&e_id=' + e_id);
 }
 initFix();
 });
 */
<?php }} ?>