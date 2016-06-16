<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:00
         compiled from "..\static\script\lang.js" */ ?>
<?php /*%%SmartyHeaderCode:1682576223500c6209-47941675%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f26173fe457bf56afd3148a40bbec4f7d8c43ea6' => 
    array (
      0 => '..\\static\\script\\lang.js',
      1 => 1437368502,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1682576223500c6209-47941675',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576223500e9488_79148413',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576223500e9488_79148413')) {function content_576223500e9488_79148413($_smarty_tpl) {?>$(function ($) {
        /*
        (function () {
                var quick = function () {
                        var u_number = $("div.quicktoolbar input").val();
                        var data = $("div.quicktoolbar a.search").attr('data');
                        window.location.href = data + u_number;
                };
                $("div.quicktoolbar input").keydown(function (e) {
                        var key = e.keyCode;
                        if (key === 13) {
                                quick();
                        }
                });
                $("div.quicktoolbar a.search").bind('click', quick);
        })();
        */
        $("a.lang").bind('click', function () {
                var lang = $(this).attr('data');
                $.cookie('lang', lang, {expires: 999999});
                window.location.reload();
        });
        (function () {
                var nav = $("body").attr("class");
                if (nav != "") {
                        $('nav a.' + nav).addClass('active');
                }
        })();
});<?php }} ?>