{strip}
<h2 class="title">{"新增设备"|L}</h2>

<form id="form" class="base mrbt10" action="?modules=device&action=mds_save">
    <div class="block">
        <div class="radioset none" id="radioset" value="{$data.d_type}">
            <input autocomplete="off"  value="rs" type="radio" id="radio_rs" name="d_type"  checked="checked" /><label for="radio_rs">{$smarty.session.ident}-RS</label>
            <input autocomplete="off"  value="mds" type="radio" id="radio_mds" name="d_type" /><label for="radio_mds">{$smarty.session.ident}-Server</label>
            <input autocomplete="off"  value="vcr" type="radio" id="radio_vcr" name="d_type" /><label for="radio_vcr">VCR</label>
            <input autocomplete="off"  value="vcrs" type="radio" id="radio_vcrs" name="d_type" /><label for="radio_vcrs">VCR-S</label>
        </div>
    </div>
    <div class="block">
        <label class="title">{"设备名称"|L}：</label>
        <input chinese="true" autocomplete="off"   maxlength="32" name="d_name" type="text" required="true" />
    </div>
    <div class="block">
        <label class="title">{"部署方式"|L}：</label>
        <select name="d_deployment_type">
            <option value="0">{"本地部署"|L}</option>
            <option value="1">{"异地部署"|L}</option>
        </select>
    </div>
    <div class="block">
        <label class="title">{"内网地址"|L}：</label>
        <input autocomplete="off"   maxlength="32" name="d_ip1" type="text" required="true" ip="true" />
    </div>
    <div class="block">
        <label class="title">{"外网地址"|L}：</label>
        <input autocomplete="off"   maxlength="32"  name="d_ip2" type="text" required="true" ip="true"/>
        <input autocomplete="off"   maxlength="32" name="d_port1" type="hidden" required="true" value="2002" />
        <input autocomplete="off"   maxlength="32" name="d_port2" type="hidden" required="true" value="2002" />
        <input autocomplete="off"   maxlength="32" name="d_area[]" type="hidden" required="true" value="#" />
    </div>
    <div class="block">
        <label class="title">{"网络接入方式"|L}：</label>
        <select name="d_network_type">
            <option value="0">{"非端口映射"|L}</option>
            <option value="1">{"端口映射"|L}</option>
        </select>
    </div>
    <div class="block">
        <label class="title">{"部署ID"|L}：</label>
        <select name="d_deployment_id">
        {foreach name=list item=item key=key from=$aCluster}
            <option value="{$item.cluster_id}">{$item.cluster_name}</option>
        {/foreach}
        </select>
    </div>
    <!-- <div class="block">
        <label class="title">{"区域"|L}：</label>
        <select name="d_area[]" class="autofix" multiple="true" action="?m=area&a=option" selected="true">
            {"<option value='#'>{'全部'|L}</option>"|isallarea}
        </select>
    </div> -->

   
    <div class="buttons mrtop40">
        <a goto="?m=device&a=rs" form="form" class="ajaxpost button normal">{"保存"|L}</a>
        <a class="goback button">{"取消"|L}</a>
    </div>
</form>
{/strip}