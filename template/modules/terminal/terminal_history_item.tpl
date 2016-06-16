{strip}
<form class="data">
    <table class="base full">
        <tr class='head'>
            <th width="10px">{"编号"|L}</th>
            <th class="" width="260px">{"用户属性"|L}</th>
            {*<th class="" width="50px">{"企业ID"|L}</th>*}
            {*<th class="" width="80px">{"用户ID"|L}</th>
            <th class="" width="70px">{"用户姓名"|L}</th>*}
            <th class="" width="260px">{"流量卡属性"|L}</th>
            {*<th class="" width="80px">{"IMSI"|L}</th>
            <th class="" width="70px">{"手机号"|L}</th>*}
            <th class="" width="70px">{"终端状态"|L}</th>
            <th class="" width="100px">{"变更时间"|L}</th>
        </tr>
        {foreach name=list item=item from=$list}
            <tr>
                <td class="">{$smarty.foreach.list.iteration}</td>
                <td title="{$item.th_e_name}">{"企业名称"|L}:{$item.th_e_name}<br />
                {"用户姓名"|L}:{$item.th_u_name}<br />
                {"用户ID"|L}:{$item.th_u_number}</td>
                <td>ICCID：{$item.th_u_iccid}<br />
                IMSI：{$item.th_u_imsi}<br />
                {"手机号"|L}：{$item.th_u_mobile_phone}</td>
                <td>{if $item.th_status eq "start"}<span class="img_start"></span>{else if $item.th_status eq "stop"}<span class="img_stop"></span>{else if $item.th_status eq "unbind"}<span class="img_unbind"></span>{else}{/if}</td>
                <td>{$item.th_change_time|date_format:"Y-m-d"}</td>
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