{strip}
<div class="toolbar" style="margin-top:-15px;">
    {"自动备份"|L}（{"请选择一个备份周期"|L}）
</div>
<div class="line">
    <label>{"周期"|L}：</label>
    <select style="width:50px;" onchange="backup_cycle(this)">
        {foreach name=selectArr item=item  from=$selectArr}
            <option value='{$item}' {if $ctime eq $item}selected='selected'{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>&nbsp;{"天"|L}</label>
</div>
<h2 class="title"></h2>


<div class="toolbar">
    <form action="?m=backup&a=backup_item" id="form" method="post">
        <input autocomplete="off"  name="modules" value="backup" type="hidden" />
        <input autocomplete="off"  name="action" value="backup_item" type="hidden" />
        <a form="form" class="submit"></a>
    </form>
</div>
<div class="toolbar">
    {"手动备份"|L}
</div>
<div class="toolbar">
  <a onclick="backup(this)" class="button">{"备份"|L}</a>
</div>

<div class="content"></div>

<div id="dialog-confirm" class="hide" title="{'删除选中项'|L}?">
    <p>{"确定要删除选中的备份文件吗"|L}?</p>
</div>
{/strip}
