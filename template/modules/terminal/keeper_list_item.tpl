{strip}
<form class="data">
<table class="base full">
    <tr class='head'>
            <th width="100px">{"序号"|L}</th>
            <th class="rich" width="150px">{"号码"|L}</th>
            <th class="rich" width="150px">{"昵称"|L}</th>
            <th class="rich" width="110px">{"终端数"|L}</th>
            <th class="rich" width="100px">{"详情"|L}</th>
    </tr>
    {foreach name=list item=item key=key from=$list}
    <tr>
        <td>{($key+1)+10*$page}</td>
        <td>{$item.rm_id}</td>
        <td>{$item.rm_nickname}</td>
        <td>{if $item.devicesum > 0}{$item.devicesum }{else}0{/if}</td>
        <td>
            {if $item.devicesum eq 0}
            <a class="link edit dis" >{"详情"|L}</a>
            {else}
            <a href="?m=terminal&a=keeper_detail_list&rm_id={$item.rm_id}"  class="link edit" >{"详情"|L}</a>
            {/if}
        </td>
    </tr>
    {/foreach}
</table>
{if $list!=NULL}
<div class="page none_select rich">
        <div class="num">{$numinfo}</div>
        <div class="turn">
            <a page="{$prev}" class="prev">{"上一页"|L}</a>
            <a page="{$next}" class="next">{"下一页"|L}</a>
        </div>
    </div>
{/if}
</form>
{/strip}