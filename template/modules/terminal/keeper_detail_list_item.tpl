{strip}
<form class="data">
<table class="base full">
    <tr class='head'>
            <th width="80px">{"序号"|L}</th>
            <th class="rich" width="150px">{"名称"|L}</th>
            <th class="rich" width="150px">{"IMEI"|L}</th>
            <th class="rich" width="110px">{"系统号码"|L}</th>
            <th class="rich" width="100px">{"终端类型"|L}</th>
            <th class="rich" width="120px">{"所属群组"|L}</th>
    </tr>
    {foreach name=list item=item key=key from=$list}
    <tr>
        <td>{($key+1)+10*$page}</td>
        <td>{$item.u_name}</td>
        <td>{$item.u_imei}</td>
        <td>{$item.u_number}</td>
        <td>{$item.md_type}</td>
        <td>
            <select name="groups" style="width: 100px" >
                <option>{"点击查看"|L}</option>
                {foreach from=$item.groups item=item1 key=key1}
                    <option>{$item1}</option>
                {/foreach}
            </select>
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