{strip}
<h2 class="title">{"{$title}"|L}</h2>
<script src="script/plugins/intlTelInput.js"></script>
<form id="form" class="base mrbt10" action="?modules=agents&action=save&ag_number={$data}">
    <input autocomplete="off"  value="0" name="ag_parent_id" type="hidden" />
    <input autocomplete="off"  value="{$res.do}" name="do" type="hidden" />
    <input autocomplete="off"  value="{$info.ag_level}" name="ag_level" type="hidden" />
    <input autocomplete="off"  value="{$info.ag_path}" name="ag_path" type="hidden" />
    <input autocomplete="off"  value="{$info.ag_phone_num}" name="diff_phone" type="hidden" />
    <input autocomplete="off"  value="{$info.ag_dispatch_num}" name="diff_dispatch" type="hidden" />
    <input autocomplete="off"  value="{$info.ag_gvs_num}" name="diff_gvs" type="hidden" />
    <input autocomplete="off"  value="{$phone_num}" name="phone_num" type="hidden" />
    <input autocomplete="off"  value="{$dispatch_num}" name="dispatch_num" type="hidden" />
    <input autocomplete="off"  value="{$gvs_num}" name="gvs_num" type="hidden" />
    <input autocomplete="off"  value='{$info.ag_area}' name="ag_area" type="hidden" />
    <div class="block">
        <label class="title">{"编号"|L}：</label>
        {if $res.do eq "edit"}
        <input chinese="true" autocomplete="off"   maxlength="32" value="{$info.ag_number}" name="ag_number" type="text" required="true" readonly="true" />
        {else}
        <input chinese="true" autocomplete="off"   maxlength="32" value="{$data}" name="ag_number" type="text" required="true" readonly="true" />
        {/if}
    </div>
    <div class="block none">
        <label class="title">{"登陆帐号"|L}：</label>
        {if $res.do eq "edit"}
        <input chinese="true" autocomplete="off"   maxlength="32" value="{$info.ag_id}" name="ag_id" type="text" required="true" readonly="true" />
        {else}
        <input chinese="true" autocomplete="off"  maxlength="32" name="ag_id" type="text" required="true" />
        {/if}
    </div>
    <div class="block">
        <label class="title">{"密码"|L}：</label>
        <input autocomplete="off"  maxlength="32" id="password" paswd="true" value="{$info.ag_pswd}" name="ag_pswd" type="password" required="true" />
        {if $res.do eq "edit"}
        <label class="show_passwd" style="font-size: 12px;color: #a43838;">{"查看密码"|L}</label>
        {/if}
    </div>
    <div class="block">
        <label class="title">{"代理商名称"|L}：</label>
        <input  autocomplete="off"  value="{$info.ag_name}" maxlength="128" name="ag_name" type="text" required="true" />
    </div>
    <div class="block">
        <label class="title">{"地址"|L}：</label>
        <input autocomplete="off"  value="{$info.ag_addr}"   name="ag_addr" type="text" required="true" />
    </div>
    <div class="block">
        <label class="title">{"名字"|L}：</label>
       <input  maxlength="32" autocomplete="off"  maxlength="32" value="{$info.ag_conname}" placeholder="{'名字'|L}" chinese="true" name="ag_conname" type="text"  required="true" />
    </div>
    <div class="block">
        <label class="title">{"姓氏"|L}：</label>
        <input  maxlength="32" autocomplete="off"   maxlength="32" value="{$info.ag_username}" placeholder="{'姓氏'|L}" chinese="true" name="ag_username" type="text"  required="true" />
    </div>

    <div class="block">
        <label class="title">{"手机号"|L}：</label>
        <input class="mobile-number" mobile1="true" type="text" style="height: 28px;width: 245px;border:1px solid #ccc;" name="ag_phone" value="{$info.ag_phone}" />
        {*
        <input  maxlength="32" autocomplete="off" style="width:60px;"  maxlength="32" value="{$info.ag_contry_num}" placeholder="{'国家代码'|L}" chinese="true" name="ag_contry_num" type="text"  required="true" />
        <input  maxlength="32" autocomplete="off" style="width:140px;"  maxlength="32" value="{$info.ag_phone}" placeholder="{'手机号码'|L}" mobile="true" name="ag_phone" type="text"  required="true" />
        *}
        </div>
    <div class="block">
        <label class="title">{"邮箱"|L}：</label>
        <input autocomplete="off"  maxlength="32" value="{$info.ag_mail}" name="ag_mail" type="text" required="true"  email="true"  />
    </div>
    <div class="block">
        <label class="title">{"联系传真"|L}：</label>
        <input fox="true"  maxlength="64" autocomplete="off" value="{$info.ag_fox}" maxlength="32" name="ag_fox" type="text" />
    </div>
    <div class="block">
        <label class="title" style="float:left;">{"备注"|L}：</label>
        <textarea autocomplete="off" maxlength="100" name="ag_remark" remark="true" style="width:240px;height:100px;padding:5px;">{$info.ag_remark}</textarea>
    </div>
    <div class="block">
        <label class="title">{"区域"|L}：</label>
        <select name="ag_area" class="autofix {if $res.do eq "edit"}autoeditselect{/if}" {if $res.do eq "edit"}disabled{/if} value='{$info.ag_area}'  action="?m=area&a=option" selected="true" data='[{ "to": "e_mds_id","field": "d_area","view":"false" }]'>
            <option value='@'>{"未选择"|L}</option>
        </select>
    </div>
    <div class="block none ">
        <label maxlength="32" class="title">{"企业用户数"|L}：</label>
        <input  maxlength="32" autocomplete="off"  value='{$info.ag_user_num}' name="ag_user_num" type="text"  readonly />
    </div>
    <hr />
    <div class="block">
        <label class="title">{"分配手机用户数"|L}：</label>
        <input  maxlength="32"  autocomplete="off"  maxlength="32" value='{$info.ag_phone_num|default:0}' range="[0,999999999]" name="ag_phone_num" type="text" required="true" digits ="true" />
    </div>
    <div class="block">
        <label class="title">{"分配调度台用户数"|L}：</label>
        <input  maxlength="32"  autocomplete="off"  maxlength="32" value='{$info.ag_dispatch_num|default:0}' range="[0,999999999]" name="ag_dispatch_num" type="text"  digits ="true" />
    </div>
    <div class="block">
        <label class="title">{"分配GVS用户数"|L}：</label>
        <input  maxlength="32" autocomplete="off"  maxlength="32" value='{$info.ag_gvs_num|default:0}' range="[0,999999999]" name="ag_gvs_num" type="text"  digits ="true" />
    </div>
    <h2 class="title">{"价格配置"|L}</h2>
    <div class="block">
        <label class="title">{"价格单位"|L}：</label>
        <input autocomplete="off" class="currencycode" readonly="true" style="width:142px;" value="{$result.units_price}"  maxlength="16" units="true" name="units_price" type="text" required="true" />
        {*<input type="text" class="currencycode" style="height: 24px;" units="true" name="units_price" value="{$result.basic_price}" rmb="true"  required="true"/>*}
    </div>
    <div class="block">
        <label class="title">{"基本功能价格"|L}：</label>
        {*<input type="text" class="currencycode" style="height: 24px;" name="basic_price" value="{$result.basic_price}" rmb="true"  required="true"/>*}
         <input rmb="true" autocomplete="off" style="width:120px;" value="{$result.basic_price_amp|default:0}"  maxlength="16"  name="basic_price_amp" type="text" required="true" />
    </div>
    <div class="block">
        <label class="title">{"Console用户价格"|L}：</label>
        {*<input type="text" class="currencycode" style="height: 24px;" name="console_price" value="{$result.console_price}" rmb="true" display="true" required="true"/>*}
        <input rmb="true" autocomplete="off" style="width:120px;" value="{$result.console_price_amp|default:0}"  maxlength="16"  name="console_price_amp" type="text" required="true" />
    </div>
    <div class="buttons mrtop40">
        <a goto="?m=agents&a=index" form="form" class="ajaxpost_a button normal">{"保存"|L}</a>
        <a class="goback button">{"取消"|L}</a>
    </div>
</form>
{/strip}