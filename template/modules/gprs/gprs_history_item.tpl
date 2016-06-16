{strip}
<form class="data">
    <table class="base full">
        <tr class='head'>
            <th width="10px">{"编号"|L}</th>
            <th class="" width="280px">{"用户属性"|L}</th>
{*            <th class="" width="50px">{"企业ID"|L}</th>*}
          {*  <th class="" width="70px">{"用户姓名"|L}</th>
            <th class="" width="80px">{"用户ID"|L}</th>*}
            <th class="" width="200px">{"终端属性"|L}</th>
            <th class="" width="100px">{"流量卡状态"|L}</th>
            <th class="" width="100px">{"变更时间"|L}</th>
        </tr>
        {foreach name=list item=item from=$list}
            <tr>
                <td class="">{$smarty.foreach.list.iteration}</td>
                <td>{"企业名称"|L}:{$item.gh_e_name|mbsubstr:12}<br />
{*                <td>{$item.gh_e_id}</td>*}
                {"用户姓名"|L}:{$item.gh_u_name}<br />
                {"用户ID"|L}:{$item.gh_u_number}</td>
                
                <td>IMEI:{$item.gh_md_imei}<br />
                        {"终端型号"|L}:{$item.gh_md_type}
                </td>
                {*<td title="{$item.gh_u_imsi}">{$item.gh_u_imsi|mbsubstr:5}</td>
                <td title="{$item.gh_u_mobile_phone}">{$item.gh_u_mobile_phone|mbsubstr:5}</td>*}
                <td>{if $item.gh_status eq "start"}<span class="img_start"></span>{else if $item.gh_status eq "stop"}<span class="img_stop"></span>{else if $item.gh_status eq "unbind"}<span class="img_unbind"></span>{else}{/if}</td>
                <td>{$item.gh_change_time|date_format:"Y-m-d"}</td>
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
<div class="buttom">
    <span class="img_start">{"启用"|L}</span>
    <span class="img_stop">{"停用"|L}</span>
    <span class="img_unbind">{"解绑"|L}</span>
</div>
{/strip}