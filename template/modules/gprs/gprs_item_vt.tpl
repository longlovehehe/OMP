{strip}
<form class="data">
<table class="base full">
    <tr class='head'>
        <th width="20px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>
        <th width="30px">{"状态"|L}</th>
        <th width="80px">ICCID</th>
        <th width="70px">IMSI</th>
        <th width="60px">Number</th>
        <th width="100px">{"系统号码"|L}</th>
        <th width="40px">{"详情"|L}</th>
        <th colspan="3" width="205px" style="text-align: center;">{"操作"|L}</th>
{*        <th width="70px">{"编辑"|L}</th>*}
       {* <th width="60px">{"历史记录"|L}</th>*}
    </tr>
    {foreach name=list item=item from=$list}
    <tr>
        <!-- <input type="hidden" name="md_type{$smarty.foreach.list.iteration}" value="{$item.md_type}">
        <input type="hidden" name="md_type_name{$smarty.foreach.list.iteration}" value="{$item.md_type}">
        <input type="hidden" name="select{$smarty.foreach.list.iteration}" value="{$item.md_type|get_termtype:$smarty.foreach.list.iteration}"> -->
        <td class="">
            <input autocomplete="off" type="checkbox" name="checkbox[]" g_status="{$item.g_status}" g_binding="{$item.g_binding}" value="{$item.g_id}" class="cb" />
            <!-- {if $item.g_binding eq 1}disabled{/if} -->
            <input type="hidden" name="g_id{$smarty.foreach.list.iteration}" value="{$item.g_id}"/>
        </td>
        <td>{if $item.g_binding eq 0}<img src="./images/unbind.png" />{else}{if $item.g_status eq 1}<img id="remark" src="./images/enable.png" />{else}<img id="remark" src="./images/disable.png" />{/if}{/if}</td>
        <td>
            <input type="text" maxlength="20" name="g_iccid{$smarty.foreach.list.iteration}" id="tl_iccid{$smarty.foreach.list.iteration}" g_iccid="true" value="{$item.g_iccid}" class="inputnothing inputstyle" disabled="true" style="width: 140px;">
            <!-- {$item.g_iccid} -->
        </td>
        <td>
            <input type="text" maxlength="15" name="g_imsi{$smarty.foreach.list.iteration}" id="tl_imsi{$smarty.foreach.list.iteration}" g_imsi="true" value="{$item.g_imsi}" class="inputnothing inputstyle" disabled="true" style="width: 105px;">
        </td>

        <td>
            <input type="text" maxlength="20" name="g_number{$smarty.foreach.list.iteration}" id="tl_number{$smarty.foreach.list.iteration}" g_number="true" value="{$item.g_number}" class="inputnothing inputstyle" disabled="true" style="width: 80px;">
        </td>

        <td>
            {$item.g_u_number}
            {*<!-- <input type="text" name="g_binding_user{$smarty.foreach.list.iteration}" value="{$item.md_imei|get_bindnum}" class="inputnothing inputstyle" disabled="true"> -->*}
            <input type="hidden" name="g_agents_id{$smarty.foreach.list.iteration}" value="{$item.g_agents_id}" />
            <input type="hidden" name="g_intime{$smarty.foreach.list.iteration}" value="{$item.g_intime}" />
        </td>
        <td>
            <a title="ICCID:{$item.g_iccid}<br />IMSI:{$item.g_imsi}<br />Number:{$item.g_number}<br />{'所属代理商'|L}:{$item.ag_name|getompman}<br >{'所属企业'|L}:{$item.e_name}<br />{'系统号码'|L}:{$item.g_u_number}<br />{'入库时间'|L}:{$item.g_intime}" class="link tips_title"><span class="icon hand"></span></a>
        </td>
        <td{if $item.g_binding eq 0} style="padding-left: 13px;" {/if}>
            <!-- class="link edit start_stop" -->
            {if $item.g_binding eq 1}
                <a class="link edit"  href="javascript:void(0);" onclick="editStatus(this,'{$item.g_iccid}');" status="{$item.g_status}" value="{$item.g_iccid}">{if $item.g_status eq 1}<img class="enable" src='images/Enable1.png' onMouseOver="this.src='images/enable_pass.png'" onMouseOut="this.src='images/Enable1.png'"></a><!-- {"停用"|L} -->{else}<img class="disable" src='images/Disable1.png' onMouseOver="this.src='images/disable_pass.png'" onMouseOut="this.src='images/Disable1.png'"></a><!-- {"启用"|L} -->{/if}</a> 
            {else}
                {"无"|L}
            {/if}
        </td>
        <td>
            {if $item.g_binding eq 1}
            <a href="javascript:void(0);"  class="link edit dis" ><img class="edit" src='images/edit.png' onMouseOver="this.src='images/edit_pass.png'" onMouseOut="this.src='images/edit.png'"/></a><!-- {"编辑"|L} --></a>
            <a id="del" class="mrlf15 link dis "><img class="delete" src='images/delete.png' onMouseOver="this.src='images/delete_pass.png'" onMouseOut="this.src='images/delete.png'"/></a><!-- {"删除"|L} --></a>
            {else}
            <a href="javascript:void(0);"  class="link edit" onclick="edit_gprs(this,'{$smarty.foreach.list.iteration}','{$item.g_iccid}')"><img class="edie" src='images/edit.png' onMouseOver="this.src='images/edit_pass.png'" onMouseOut="this.src='images/edit.png'"/></a><!-- {"编辑"|L} --></a>
            <!-- <a href="?m=gprs&a=gprs_edit&g_id={$item.g_id}"  class="link edit" >{"编辑"|L}</a> -->
            <!-- onclick="edit_term(this,'{$smarty.foreach.list.iteration}','{$item.md_imei}');" -->
            <!-- <a id="del" class="mrlf5 link {if $item.status eq 'yes'}msg{/if}" onclick="del_term(this,'{$smarty.foreach.list.iteration}')">{"删除"|L}</a> -->
            <a id="del" class="mrlf15 link {if $item.status eq 'yes'}msg{/if}" status="3" onclick="editStatus(this,'{$item.g_iccid}')"><img class="delete" src='images/delete.png' onMouseOver="this.src='images/delete_pass.png'" onMouseOut="this.src='images/delete.png'"/></a><!-- {"删除"|L} --></a>
            {/if}
        </td>
        <td>
            <a href="?m=gprs&a=history_gprs&g_iccid={$item.g_iccid}&g_id={$item.g_id}" class="link edit view"></a>
        </td>
        <!-- <td>
            <input type="text" name="md_serial_number{$smarty.foreach.list.iteration}" id="md_serial_number{$smarty.foreach.list.iteration}" value="{$item.md_serial_number}" class="inputnothing itermstyle" style="width:80px;" disabled="true">
        </td> -->
        <!-- |get_imei_ep -->
        
        
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
<div class="buttom">
    <span class="img_start">{"启用"|L}</span>
    <span class="img_stop">{"停用"|L}</span>
    <span class="img_unbind">{"未绑定"|L}</span>
</div>
</form>
{/strip}
