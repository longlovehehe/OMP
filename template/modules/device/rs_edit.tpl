{strip}
<h2 class="title">{"编辑设备"|L}</h2>

<form id="form" class="base mrbt10" action="?modules=device&action=mds_save">
<input type="hidden" name="d_id" value="{$data.d_id}">
<input type="hidden" name="d_type" value="rs">   
    <div class="block">
        <label class="title">{"设备名称"|L}：</label>
        <input chinese="true" autocomplete="off" value="{$data.d_name}"   maxlength="32" name="d_name" type="text" required="true" />
    </div>
    <div class="block">
        <label class="title">{"部署方式"|L}：</label>
        <select name="d_deployment_type">
            <option value="0" {if $data.d_deployment_type eq 0}selected{/if}>{"本地部署"|L}</option>
            <option value="1" {if $data.d_deployment_type eq 1}selected{/if}>{"异地部署"|L}</option>
        </select>
    </div>
    <div class="block">
        <label class="title">{"内网地址"|L}：</label>
        <input autocomplete="off" value="{$data.d_ip1}"   maxlength="32" name="d_ip1" type="text" required="true" ip="true" />
    </div>
    <div class="block">
        <label class="title">{"外网地址"|L}：</label>
        <input autocomplete="off" value="{$data.d_ip2}"   maxlength="32" name="d_ip2" type="text" required="true" ip="true" />
   </div>
    <div class="block">
        <label class="title">{"网络接入方式"|L}：</label>
        <select name="d_network_type">
            <option value="0" {if $data.d_network_type eq 0}selected{/if}>{"非端口映射"|L}</option>
            <option value="1" {if $data.d_network_type eq 1}selected{/if}>{"端口映射"|L}</option>
        </select>
    </div>
    <div class="block">
        <label class="title">{"部署ID"|L}：</label>
        <select name="d_deployment_id">
        {foreach name=list item=item key=key from=$aCluster}
            <option {if $data.d_deployment_id eq $item.cluster_id}selected{/if} value="{$item.cluster_id}">{$item.cluster_name}</option>
        {/foreach}
        </select>
    </div>
    
    <div class="buttons mrtop40">
        <a goto="?m=device&a=rs" form="form" class="ajaxpost button normal">{"保存"|L}</a>
        <a class="goback button">{"取消"|L}</a>
    </div>
</form>
{/strip}