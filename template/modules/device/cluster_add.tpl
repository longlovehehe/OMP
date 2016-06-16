{strip}
<h2 class="title">{"新增部署ID"|L}</h2>

<form id="form" class="base mrbt10" action="?modules=device&action=cluster_save">
    <div class="block">
        <label class="title">{"名称"|L}：</label>
        <input chinese="true" autocomplete="off"   maxlength="32" name="cluster_name" type="text" required="true" />
    </div>
    <div class="block">
        <label class="title">{"备注"|L}：</label>
        <textarea name="cluster_desc" style="resize:none;width:230px;height:100px;border:1px solid #ccc;font-size:13px;padding:5px;" maxlength="100" class="valid"></textarea>
    </div>
        
    <div class="buttons mrtop40">
        <a goto="?m=device&a=cluster" form="form" class="ajaxpost button normal">{"保存"|L}</a>
        <a class="goback button">{"取消"|L}</a>
    </div>
</form>
{/strip}