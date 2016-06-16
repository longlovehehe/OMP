

<form class="data">
    <table class="base full">
        <tr class='head'>
            <th width="40px">{"序号"|L}</th>
            <th width="40px">{"部署ID"|L}</th>
            <th width="120px">{"名称"|L}</th>
            <th width="120px">{"备注"|L}</th>
            <th width="150px">{"操作"|L}</th>
        </tr>
        {foreach name=list item=item key=key from=$list}
        <tr>
            <td>{($key+1)+10*($page)}</td>
            <td>{$item.cluster_id}</td>
            <td>{$item.cluster_name}</td>
            <td>{$item.cluster_desc}</td>  
            <td>
                {if $item.status eq 'yes'}
                <a title="{'此部署下有设备在用不能编辑'|L}" class="link dis">{"编辑"|L}</a>
                |<a title="{'此部署下有设备在用不能删除'|L}" class="link dis">{"删除"|L}</a>
                {else}
                <a href="?m=device&a=cluster_edit&cluster_id={$item.cluster_id}" class="link">{"编辑"|L}</a>
                |<a onclick="del_cluster('{$item.cluster_id}');" class="link">{"删除"|L}</a>
                {/if}
                
            </td>
        </tr>
        {/foreach}
    </table>


    {if $list!=NULL}
    <div class="page none_select">
        <div class="num">{$numinfo}</div>
        <div class="turn">
            <a page="{$prev}" class="prev">{"上一页"|L}</a>
            <a page="{$next}" class="next">{"下一页"|L}</a>
        </div>
    </div>
</form>
{/if}
