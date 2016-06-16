{strip}
<h2 class="title">{*{$data.do|upper}*}{$smarty.session.ident}-RS [{$data.d_ip2}] {"使用详情"|L}</h2>
<div class="toolbar">
  {*  <form action="?modules=device&action=device_list_item" id="form" method="post">*}
       
{*        <input autocomplete="off"  name="page" value="0" type="hidden" />*}
        <a form="form" class="button submit none">{"查询"|L}</a>
        <a class="goback button">{"返回"|L}</a>
{*    </form>*}
</div>
<p style="color:#a43838;" align="right">{"已用/总并发数"|L}:{$rec.sum_recnum}/{$rec.d_recnum}</p>
<table class="base full cb">
    <tr class='head'>
        <th width="400px">{"企业ID"|L}</th>
        <th width="415px">{"企业名称"|L}</th>
    </tr>
</table>
<div  style="height:250px;overflow-y: scroll;">
        <table class="base full cb">
                {foreach name=list item=item from=$list}
                <tr>
                    <td class="e_id_list" width="400px">{$item.e_id}</td>
                    <td width="400px">{$item.e_name}</td>
                </tr>
                {/foreach}
        </table>
</div>
{*<div class="content"></div>*}


<form id="form" class="base mrbt10" action="?modules=device&action=rs_move_batch">
    <input autocomplete="off"  value="{$data.e_id}" name="e_id_list" type="hidden" />
    <input autocomplete="off"  value="" name="diff_rec" type="hidden" />
    <input autocomplete="off"  value="" name="e_vcr_id" type="hidden" />
    <input autocomplete="off"  name="device_id" value="{$data.device_id}" type="hidden" />
    <input autocomplete="off"  name="do" value="rs" type="hidden" />
    <div class="block ">
        <label class="title">{"新的{$smarty.session.ident}-RS地址"|L}</label>
        <select id="e_vcr_id" name="new_vcr_id" new_vcr_id="true" class="long " size="10" action="?m=device&a=rs_option&d_deployment_id={$rec.d_deployment_id}&d_id_self={$rec.d_id}" selected="true" digits ="true"></select>
        <span class="vcr_error none">{"该设备可用用户数少于目前企业用户数，无法迁移，请选择其他设备"|L}</span>
    </div>
    <div class="buttons mrtop40">
        <a goto="?m=device&a=rs" id="move_rs" class="button green">{"迁移{$smarty.session.ident}-RS"|L}</a>
        <a href="?m=device&a=rs" class="button">{"取消"|L}</a>
    </div>
</form>
<div id="dialog-confirm" class="hide" title="{'操作确认'|L}">
    <p>{"确定要迁移吗"|L}？</p>
</div>
{/strip}