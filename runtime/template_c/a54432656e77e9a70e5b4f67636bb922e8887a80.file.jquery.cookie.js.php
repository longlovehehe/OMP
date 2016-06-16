<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 13:00:35
         compiled from "..\static\script\libs\jquery.cookie.js" */ ?>
<?php /*%%SmartyHeaderCode:25555576232735aaaf4-17672014%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a54432656e77e9a70e5b4f67636bb922e8887a80' => 
    array (
      0 => '..\\static\\script\\libs\\jquery.cookie.js',
      1 => 1412062530,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25555576232735aaaf4-17672014',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576232735b2803_33112233',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576232735b2803_33112233')) {function content_576232735b2803_33112233($_smarty_tpl) {?>/**//*!* jQuery Cookie Plugin v1.3.1* https://github.com/carhartl/jquery-cookie** Copyright 2013 Klaus Hartl* Released under the MIT license*/(function(factory) {if (typeof define === 'function' && define.amd) {define(['jquery'], factory);} else {factory(jQuery);}}(function($) {var pluses = /\+/g;function raw(s) {return s;}function decoded(s) {return decodeURIComponent(s.replace(pluses, ' '));}function converted(s) {if (s.indexOf('"') === 0) {s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');}try {return config.json ? JSON.parse(s) : s;} catch (er) {}}var config = $.cookie = function(key, value, options) {if (value !== undefined) {options = $.extend({}, config.defaults, options);if (typeof options.expires === 'number') {var days = options.expires, t = options.expires = new Date();t.setDate(t.getDate() + days);}value = config.json ? JSON.stringify(value) : String(value);return (document.cookie = [config.raw ? key : encodeURIComponent(key),'=',config.raw ? value : encodeURIComponent(value),options.expires ? '; expires=' + options.expires.toUTCString() : '',options.path ? '; path=' + options.path : '',options.domain ? '; domain=' + options.domain : '',options.secure ? '; secure' : ''].join(''));}var decode = config.raw ? raw : decoded;var cookies = document.cookie.split('; ');var result = key ? undefined : {};for (var i = 0, l = cookies.length; i < l; i++) {var parts = cookies[i].split('=');var name = decode(parts.shift());var cookie = decode(parts.join('='));if (key && key === name) {result = converted(cookie);break;}if (!key) {result[name] = converted(cookie);}}return result;};config.defaults = {};$.removeCookie = function(key, options) {if ($.cookie(key) !== undefined) {$.cookie(key, '', $.extend(options, {expires: -1}));return true;}return false;};}));/**/<?php }} ?>