{strip}
<h2 class="title">{"{$title}"|L}</h2>
<script src="script/plugins/intlTelInput.js"></script>
<form id="form" class="base mrbt10" action="?m=manager&a=om_save">
    <input autocomplete="off"  type="hidden" name="om_id" value="{$smarty.get.om_id|escape:'html'}" />
    <input autocomplete="off"  type="hidden" name="om_flag" value="{$smarty.get.flag}" />

    <div class="block">
        <label class="title">{"帐号"|L}：</label>
        <input maxlength="32" autocomplete="off" value="{$list.om_id|escape:'html'}" name="om_id" chinese="true" type="text" required="true" {if $smarty.get.flag eq 'edit'} readonly{/if} />
    </div>
    <div class="block" {if $smarty.get.flag eq "edit"}style="display:none;"{/if}>
         <label class="title">{"密码"|L}：</label>
        <input maxlength="32" autocomplete="off" paswd="true" id="pass" value="{$list.om_pswd}" id="password" name="om_pswd" type="password" required="true" password ="true" />
    </div>
    <div class="block" {if $smarty.get.flag eq "edit"}style="display:none;"{/if}>
         <label class="title">{"重复密码"|L}：</label>
        <input maxlength="32" autocomplete="off"  value="{$data.d_ip2}" id="password" name="om_pswd2" type="password" required="true" equalTo="#pass" />
    </div>
    <div class="block">
        <label class="title">{"手机号"|L}：</label>
        <input style="height: 28px;width: 242px;border:1px solid #ccc;" class="mobile-number" mobile1="true" maxlength="32" autocomplete="off"  value="{$list.om_phone}" name="om_phone" type="text" required="true"/>
        {*<input autocomplete="off"  type="checkbox" class="none" name="" value="" disabled="true"/>*}
    </div>
    <div class="block">
        <label class="title">{"邮箱"|L}：</label>
        <input maxlength="32" autocomplete="off"  value="{$list.om_mail}" name="om_mail" type="text" required="true"  email="true" />
    </div>
    <div class="block {if $list.om_id =='admin'}none{/if}">
        <label class="title">{"区域"|L}：</label>
        <select value='{$list.om_area}' multiple="true" name="om_area[]"  class="autofix autoeditselect " action="?m=area&a=option" selected="true">
            <option value='#'>{"全部"|L}</option>
        </select>
    </div>
    <div class="block">
        <label class="title">{"描述"|L}：</label>
    </div>
    <div class="block">
        <textarea maxlength="100" style="resize:none;width:390px;height:100px;border:1px solid #ccc;font-size:13px;padding:5px;" name="om_desc">{$list.om_desc}</textarea>
    </div>
    <div class="buttons mrtop40">
        <a goto="?m=manager&a=index" form="form" class="ajaxpost button normal">{"保存"|L}</a>
        <a class="goback button">{"取消"|L}</a>
    </div>
</form>
{/strip}