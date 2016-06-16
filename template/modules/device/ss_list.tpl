{strip}
<h2 class="title">{*{$data.do|upper}*}{$smarty.session.ident}-SS [{$data.d_ip2}] {"使用详情"|L}</h2>
<div class="toolbar">
{*    <form action="?modules=device&action=device_list_item" id="form" method="post">*}        

        <a form="form" class="button submit none">{"查询"|L}</a>
        <a class="goback button">{"返回"|L}</a>
{*    </form>*}
</div>
<p style="color:#a43838;" align="right">{"已用/总空间"|L}:{$space.space}/{$space.d_space}MB</p>
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
    
<form id="form" class="base mrbt10" action="?modules=device&action=ss_move_batch">
    <input autocomplete="off"  value="{$data.e_id}" name="e_id_list" type="hidden" />
    <input autocomplete="off"  value="" name="d_space_free" type="hidden" />
    <input autocomplete="off"  name="device_id" value="{$data.device_id}" type="hidden" />
    <input autocomplete="off"  value="" name="e_ss_id" type="hidden" />
    <input autocomplete="off"  name="do" value="ss" type="hidden" />
     <div class="block">
        <label class="title">{"请选择所属"|L} {$smarty.session.ident}-SS：</label>
        <select value="" id="e_ss_id" name="e_ss_id" size="10"  class=" long" action="?m=device&action=ss_option&d_deployment_id={$space.d_deployment_id}&d_id_self={$data.device_id}" selected="true"></select>
    </div>
    <div class="buttons mrtop40">
        <a goto="?m=device&a=ss" id="move_ss" class="button green">{"迁移{$smarty.session.ident}-SS"|L}</a>
        <a href="?m=device&a=ss" class="button">{"取消"|L}</a>
    </div>
</form>
<div id="dialog-confirm" class="hide" title="{'操作确认'|L}">
    <p>{"确定要迁移吗"|L}？</p>
</div>
{/strip}
