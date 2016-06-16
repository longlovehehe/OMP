<!DOCTYPE html>
{strip}
<!--[if lt IE 7 ]> <html class="ie6 lang_{$smarty.cookies.lang} can_select"> <![endif]-->
<!--[if IE 7 ]><html class="ie7 lang_{$smarty.cookies.lang} can_select"> <![endif]-->
<!--[if IE 8 ]><html class="ie8 lang_{$smarty.cookies.lang} can_select"><![endif]-->
<!--[if IE 9 ]><html class="ie9 lang_{$smarty.cookies.lang} can_select"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="lang_{$smarty.cookies.lang} can_select"><!--<![endif]-->
    <head>
        <meta charset="UTF-8">

        <meta http-equiv="pragma" content="max-age=2592000">
        <meta http-equiv="cache-control" content="max-age=2592000">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="renderer" content="webkit">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon" />
        <title>{$title}</title>
        {$style|style}
        <script src="script/libs.before.js"></script>
        <script src="script/autoselect.js"></script>

        {'before'|scriptmodule}
        <link  href="style/ie6.layout.adapter.css" rel="stylesheet" type="text/css" />
        <link href="style/layout.css"  rel="stylesheet" />
        <link  href="style/css.css" rel="stylesheet" type="text/css" />
        <!--[if lte IE 8]>{'libs/html5'|scriptnocompile}<![endif]-->
    </head>
    <body class="{$smarty.get.m}" scroll="yes">
        <span class="request none">[{$smarty.request|json_encode|escape:"htmlall"}]</span>
        <div class="lang">
            <a class="lang" data="cn_ZH">中文版</a>
            <span class='sep'>|</span>
            <a class="lang" data="en_US">English</a>
            <span class='sep'>|</span>
            <a class="lang" data="zh_TW">繁體中文</a>
        </div>

        <div class="quicktoolbar animated none">
            <input autocomplete="off"  value="{$smarty.get.u_number}" type="text" placeholder="输入需要搜索的企业用户帐号" />
            <a class="search" data="?m=enterprise&a=allusers&u_number=">{*搜索*}</a>
        </div>
        <div class="header">
            <header>
                <h1 class="title {if $smarty.cookies.lang eq en_US}_GQT_icon_logo_1x120_en_png{else}_GQT_icon_logo_1x120_png{/if}"><a>{"运营管理平台"|L}</a></h1>
                <div class="login_tips" style="overflow: hidden;" >
                    {*<div class="phone">故障联系电话：186 0000 0000</div>*}
                    <div class="account" >
                        <a href="?m=system&a=index" class="link ">{$smarty.session.own.om_id}</a>
                        <a href="?m=system&a=resetpassword" class="logout">{"修改密码"|L}</a>
                        <a href="?m=logout" class="logout">{"注销"|L}</a>
                        <a href="?m=help&a=index" target="_blank" class="link help none">{"帮助模块"|L}</a>
                    </div>
                </div>
            </header>
        </div>
        <section class="content" style="overflow: hidden;" >
            <div class="nav" >
                <nav>
                    <ul class="menu">
                        <li> <a href="?m=system&a=index" class="system"><div >{"首页"|L}</div></a></li>
                        <li><a href="?m=enterprise&a=index" href1="?m=enterprise&a=index" class="enterprise">{"企业管理"|L}</a></li>
                        <li><a href="javascript:void(0);" class="device cluster server rs ss">{"设备管理"|L}</a>
                                <ul class="submenu">
                                        <li><a href="?m=device&a=cluster" class="cluster">{"部署管理"|L}</a></li>
                                        <li><a href="?m=device&a=server" class="server">{"SERVER管理"|L}</a></li>
                                        <li><a href="?m=device&a=rs" class="rs">{"RS管理"|L}</a></li>
                                        <li><a href="?m=device&a=ss" class="ss">{"SS管理"|L}</a></li>

                                </ul>
                        </li>
                         <li><a href="javascript:void(0);" class="agents keeper_list">{"帐号管理"|L}</a>
                                <ul class="submenu">
                                        <li><a href="?m=agents&a=index"  class="agents">{"代理商管理"|L}</a></li>
                                        <li><a href="?m=terminal&a=keeper_list" class="keeper_list">{"Keeper管理"|L}</a></li>
                                </ul>
                        </li>
                                
                        <li><a href="javascript:void(0);" class="index_type index_list terminal_in history history_gprs gprs product">{"业务管理"|L}</a>
                                <ul class="submenu">
                                    <li><a href="?m=terminal&a=index_type" class="index_type">{"终端类型"|L}</a></li>
                                    <li><a href="?m=terminal&a=index_list" class="index_list terminal_in history">{"终端管理"|L}</a></li>
                                    <li><a href="?m=gprs&a=index" class="gprs history_gprs">{"流量卡管理"|L}</a></li>
                                        
                                        
                                        {if $smarty.session.ident eq VT}
                                            <li><a href="?m=product&a=index" class="product">{"功能管理"|L}</a></li>
                                       {else if $smarty.session.ident eq GQT}
                                            <li><a href="?m=product&a=index" class="product">{"产品管理"|L}</a></li>
                                       {/if}
                                </ul>
                        </li>
                      
                       <li><a href="javascript:void(0);" class="report account ">{"业务统计"|L}</a>
                                <ul class="submenu">
                                    {if $url neq ""}
                                        <li><a href="javascript:void(0);"  class="report" id="report-jump" action="{$url}">{"数据报表"|L}</a></li>
                                    {/if}
                                       <li><a href="?m=account&a=index"  class="account">{"计费报表"|L}</a></li>
                                </ul>
                        </li>
                    {if $smarty.session.own.om_id=='admin'}
                        <li><a href="javascript:void(0);" class="cms manager area">{"管理员管理"|L}</a>
                                <ul class="submenu">
                                        <li><a href="?m=cms&a=index" class="cms ">{"版本管理"|L}</a></li>
                                        <li><a href="?m=manager&a=index" class="manager">{"角色管理"|L}</a></li>
                                        <li><a href="?m=area&a=index" class="area">{"区域管理"|L}</a></li>

                                </ul>
                        </li>
                    {/if}
                     <li><a href="javascript:void(0);" class="log announcement sysconfig backup">{"其他"|L}</a>
                        <ul class="submenu">
                            <li><a href="?m=log&a=index" class="log">{"日志管理"|L}</a></li>
                            <li><a href="?m=announcement&a=index" class="announcement">{"公告管理"|L}</a></li>
                            {if $smarty.session.own.om_id=='admin'}
                            <li><a href="?m=backup&a=index" class="backupss">{"备份"|L}</a></li>
                            {/if}
{* 
                            {if $smarty.session.own.om_id=='admin'}
                                <li><a href="?m=system&a=sysconfig" class="sysconfig">{"系统"|L}</a></li>
                            {/if}
*}
                        </ul>
                     </li>
	</ul>
                </nav>
            </div>

            <div class="minipage" style="overflow: hidden;" >
                {if $mininav != null }
                <nav class="mininav" style='background: transparent;'>
                    {foreach name=mininav item=item from=$mininav}
                    <a title='{"{$item.name}"|L}' class="ctips" {if $item.next !=""}href="{$item.url}"{else}style="color:#111;text-decoration:none;"{/if}>{"{$item.name|mbsubstr: 20}"|L}</a>{$item.next}
                    {/foreach}
                </nav>
                {/if}
                <div class="pagecontent mini_{$request.modules}_{$request.action} " style="overflow: hidden;padding-bottom:50px;padding-top: 30px;" >
                    {"{$content}"|L}
                </div>
            </div>

        </section>
        <footer>
            <hr />
            <p class='hidden1'>Copyright (C) http://www.zed-3.com.cn/, All Rights Reserved</p>
            <p class='hidden1'>{"捷思锐科技版权所有 京ICP备09032422号"|L}</p>
        </footer>
        <script src="?m=lang"></script>
        {$script|scriptafter}
        <script src="script/com.js"></script>
        <div id="fade" class="black_overlay"></div>
    </body>
</html>
{/strip}
