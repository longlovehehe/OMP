{strip}
<table class="base full">
    <tr class='head'>
        <th width="100px" class="">{"序号"|L}</th>
        <th>{"终端型号"|L}</th>
        <th>{"终端图片"|L}</th>
        <th width="100px">{"操作"|L}</th>
    </tr>
    {foreach name=list item=item from=$list}
    <tr>
        <td>{$smarty.foreach.list.iteration}</td>
        <td>{$item.tt_type}</td>
        <td  height="40px;"><img src="?m=terminal&a=show_pic&pid={$item.tt_pic}"  onclick="start_big('{$item.tt_pic}',this);"  style="width: 50px;"></td>
        <td>
            <a href="javascript:void(0);"  class="link" onclick="replace('{$item.tt_type}');">{"编辑"|L}</a>
             {if $item.tt_type|get_used eq 0}
                 <a class="mrlf5 link" onclick="del_type('{$item.tt_type}');" >{"删除"|L}</a>
             {else}
                 <a class="mrlf5 link dis" >{"删除"|L}</a>
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
{/strip}