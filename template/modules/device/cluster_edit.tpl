{strip}
<h2 class="title">{"编辑部署ID"|L}</h2>
{if $status eq 'yes'}
<div class="block">
        <label>该部署ID已被使用，不能编辑</label>
       <a class="goback button">{"返回"|L}</a>
</div>
{else}
<form id="form" class="base mrbt10" action="?modules=device&action=cluster_save">
<input type="hidden" name="cluster_id" value="{$data.cluster_id}">
    <div class="block">
        <label class="title">{"部署ID"|L}：</label>
        {$data.cluster_id}
    </div>
    <div class="block">
        <label class="title">{"名称"|L}：</label>
        <input chinese="true" autocomplete="off" value="{$data.cluster_name}"  maxlength="32" name="cluster_name" type="text" required="true" />
    </div>
    <div class="block">
        <label class="title">{"备注"|L}：</label>
        <textarea name="cluster_desc" style="resize:none;width:230px;height:100px;border:1px solid #ccc;font-size:13px;padding:5px;" maxlength="100" class="valid">{$data.cluster_desc}</textarea>
    </div>
        
    <div class="buttons mrtop40">
        <a goto="?m=device&a=cluster" form="form" class="ajaxpost button normal">{"保存"|L}</a>
        <a class="goback button">{"取消"|L}</a>
    </div>
</form>
{/if}
{/strip}