<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 13:00:35
         compiled from "..\static\script\login.js" */ ?>
<?php /*%%SmartyHeaderCode:31504576232735be389-73526558%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9bb47332685a2f3440c6ed0bc3fc58c8c16f85c' => 
    array (
      0 => '..\\static\\script\\login.js',
      1 => 1437362616,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31504576232735be389-73526558',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57623273608711_58553826',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57623273608711_58553826')) {function content_57623273608711_58553826($_smarty_tpl) {?>/** * 登录自动提交 *//*function loginSubmit() {    if ($("input[name=username]").val().length === 0 || $("input[name=password]").val().length === 0 || $("input[name=username]").val() === "<?php echo L('输入帐号');?>
" || $("input[name=password]").val() == "<?php echo L('输入密码');?>
") {        $("div.tips").removeClass("none").addClass("pulse");        $("div.login").addClass("bounce");        $("div.tips span").text("<?php echo L('帐号或密码为空，请检查输入');?>
");        setTimeout(function () {            $("div.login").removeClass("bounce");            if ($("input[name=username]").val().length === 0) {                $("input[name=username]").focus();            } else {                $("input[name=password]").focus();            }        }, 555);        return;    }    if (!$("a.submit").hasClass("lock")) {        $("a.submit").addClass("lock");        $("#login1").submit();    }}*/function loginSubmit() {    if ($("input[name=username]").val().length === 0 || $("input[name=password]").val().length === 0 || $("input[name=username]").val() === "<?php echo L('输入帐号');?>
" || $("input[name=password]").val() == "<?php echo L('输入密码');?>
") {        //$("div.tips").removeClass("none").addClass("pulse");        $("div.login").addClass("bounce");        layer.msg("<?php echo L('帐号或密码为空，请检查输入');?>
",{            offset: 0,            shift: 6        });        setTimeout(function () {            $("div.login").removeClass("bounce");            if ($("input[name=username]").val().length === 0) {                $("input[name=username]").focus();            } else {                $("input[name=password]").focus();            }        }, 555);        return;    }    if (!$("a.submit").hasClass("lock")) {        $("a.submit").addClass("lock");        $("#login1").submit();    }}$("a.submit").click(function () {    loginSubmit();});(function () {    $("input.autosend").keydown(function (e) {        var key = e.keyCode;        if (key === 13) {            loginSubmit();        }    });})();$("a.lang").bind('click', function () {    var lang = $(this).attr('data');    $.cookie('lang', lang, {expires: 999999});    window.location.reload();});$(function () {    if (!placeholderSupport()) {   // 判断浏览器是否支持 placeholder        $('[placeholder]').focus(function () {            var input = $(this);            if (input.val() == input.attr('placeholder')) {                input.val('');                input.removeClass('placeholder');                input.removeClass('phcolor');                if (input.attr('placeholder') == "<?php echo L('输入密码');?>
") {                    $("input[name=password]").attr("type", "password");                }            }        }).blur(function () {            var input = $(this);            if (input.val() == '' || input.val() == input.attr('placeholder')) {                input.addClass('placeholder');                input.addClass('phcolor');                input.val(input.attr('placeholder'));                if (input.attr('placeholder') == "<?php echo L('输入密码');?>
") {                    $("input[name=password]").attr("type", "");                }            }        }).blur();    }    ;})function placeholderSupport() {    return 'placeholder' in document.createElement('input');}<?php }} ?>