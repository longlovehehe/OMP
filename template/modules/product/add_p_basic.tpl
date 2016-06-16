{strip}
<h2 class="title">{"增加代理商基础产品价格"|L}</h2>

<form id="form" class="base mrbt10" action="?modules=product&action=price_save">
    <div class="block">
        <div class="radioset none" id="radioset" value="{$data.d_type}">
            <input autocomplete="off"  value="mds" type="radio" id="radio_mds" name="d_type"  checked="checked" /><label for="radio_mds">{$smarty.session.ident}-Server</label>
            <input autocomplete="off"  value="vcr" type="radio" id="radio_vcr" name="d_type" /><label for="radio_vcr">VCR</label>
            <input autocomplete="off"  value="vcrs" type="radio" id="radio_vcrs" name="d_type" /><label for="radio_vcrs">VCR-S</label>
        </div>
    </div>
    <div class="block">
        <label class="title">{"选择代理商"|L}：</label>
        <select name="id" action="?m=agents&a=option" class="autofix" selected="true">
        </select>
    </div>
        <div class="block">
            <label class="title">{"手机用户价格"|L}：</label>
            <input autocomplete="off"   maxlength="32" value="0" name="phone_price" type="text" required="true" rmb="true" />
        </div>
        <div class="block">
            <label class="title">{"调度台用户价格"|L}：</label>
            <input autocomplete="off"   maxlength="32" value="0" name="console_price" type="text" required="true" rmb ="true" range="[0,999999999]" />
        </div>
        <div class="block">
            <label class="title">{"基础功能价格"|L}：</label>
            <input autocomplete="off"   maxlength="32" value="0" name="basic_price" type="text" required="true" rmb ="true" range="[0,999999999]" />
        </div>
    <div class="buttons mrtop40">
        <a goto="?m=product&a=p_basic" form="form" class="ajaxpost button normal">{"保存"|L}</a>
        <a class="goback button">{"取消"|L}</a>
    </div>
</form>
{/strip}
