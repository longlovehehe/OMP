{strip}
<form class="data">
<table class="base full">
    <tr class='head'>
        <th width="10px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>
        <th class="" width="30px">{"状态"|L}</th>
        <th class="" width="90px">IMEI</th>
        <th class="" width="110px">{"终端型号"|L}</th>
        <th class="" width="50px">{"序列号"|L}</th>
        <th class="" width="90px">{"系统号码"|L}</th>
        <th class="" width="50px">{"详情"|L}</th>
        <th class="" colspan="3" width="200px" style="text-align: center;">{"操作"|L}</th>
{*        <th class="" width="100px">{"编辑"|L}</th>*}
    {*    <th class="" width="60px">{"历史记录"|L}</th>*}
    </tr>
    {foreach name=list item=item from=$list}
    <tr>
        <input type="hidden" name="md_type{$smarty.foreach.list.iteration}" value="{$item.md_type}">
        <input type="hidden" name="md_type_name{$smarty.foreach.list.iteration}" value="{$item.md_type}">
        <input type="hidden" name="select{$smarty.foreach.list.iteration}" value="{$item.md_type|get_termtype:$smarty.foreach.list.iteration}">
        <td class=""><input autocomplete="off"  type="checkbox" name="checkbox[]" value="{$item.md_imei}" class="cb" {if $item.md_binding eq 1}{*disabled*}{/if} /><input type="hidden" name="md_id{$smarty.foreach.list.iteration}" value="{$item.md_id}"/></td>
        <td>{$item.md_binding|get_isbind:{$item.md_imei}}</td>
        <td><input type="text" maxlength="15" name="md_imei{$smarty.foreach.list.iteration}" id="tl_imei{$smarty.foreach.list.iteration}" u_imei="true" value="{$item.md_imei}" class="inputnothing inputstyle" disabled="true"></td>
        <td>{$item.md_type}</td>
        <td><input type="text" name="md_serial_number{$smarty.foreach.list.iteration}" onblur="serial_test(this);" id="md_serial_number{$smarty.foreach.list.iteration}"
                   value="{$item.md_serial_number}" class="inputnothing itermstyle" style="width:70px;" disabled="true"></td>
        <td><input type="text" name="md_binding_user{$smarty.foreach.list.iteration}" value="{$item.md_imei|get_bindnum}" class="inputnothing inputstyle" disabled="true"></td>
        <!-- |get_imei_ep -->
        <td><a title="IMEI:{$item.md_imei}<br />{'终端型号'|L}:{$item.md_type}<br />{'序列号'|L}:{$item.md_serial_number}<br />{'所属代理商'|L}:{$item.ag_name|getompman}<br >{'所属企业'|L}:{$item.e_name}<br />{'系统号码'|L}:{$item.md_binding_user}<br />{'入库时间'|L}:{$item.md_time}" class="link tips_title"><span class="icon hand"></span></a></td>
        <td {if $item.md_binding eq 0} style="padding-left: 13px;" {/if}>{if $item.md_binding eq
                0}{"无"|L}{else}{if $item.md_imei|get_isstat eq 1}<a class="link edit start_stop " md_stat="{$item.md_imei|get_isstat}" value="{$item.md_imei}"  href="javascript:void(0);"><img class="enable" src='images/Enable1.png' onMouseOver="this.src='images/enable_pass.png'" onMouseOut="this.src='images/Enable1.png'"></a><!-- {"启用"|L} --></a>{else if $item.md_imei|get_isstat eq 0}<a class="link edit start_stop" md_stat="{$item.md_imei|get_isstat}" value="{$item.md_imei}"  href="javascript:void(0);"><img class="disable" src='images/Disable1.png' onMouseOver="this.src='images/disable_pass.png'" onMouseOut="this.src='images/Disable1.png'"></a><!-- {"停用"|L} --></a>{/if}{/if}</td>
        <td>
            {if $item.md_binding eq 1}
            <a href="javascript:void(0);"  class="link edit dis set_gray" ><img class="edit" src='images/edit.png' onMouseOver="this.src='images/edit_pass.png'" onMouseOut="this.src='images/edit.png'"/></a><!-- {"编辑"|L} --></a>
            <a id="del" class="mrlf15 link dis set_gray"><img class="delete" src='images/delete.png' onMouseOver="this.src='images/delete_pass.png'" onMouseOut="this.src='images/delete.png'"/></a><!-- {"删除"|L} --></a>
            {else}
            <a href="javascript:void(0);"  class="link edit"  num="{$smarty.foreach.list.iteration}" onclick="edit_term(this,'{$smarty.foreach.list.iteration}','{$item.md_imei}','{$item.md_serial_number}','{$item.md_parent_ag}','{$item.md_meid}');"><img class="edie" src='images/edit.png' onMouseOver="this.src='images/edit_pass.png'" onMouseOut="this.src='images/edit.png'"/></a><!-- {"编辑"|L} --></a>
            <a id="del" class="mrlf15 link {if $item.status eq 'yes'}msg{/if}" onclick="del_term(this,'{$smarty.foreach.list.iteration}')"><img class="delete" src='images/delete.png' onMouseOver="this.src='images/delete_pass.png'" onMouseOut="this.src='images/delete.png'"/><!-- {"删除"|L} --></a>
            <input type="hidden" name="list_id" value="{$smarty.foreach.list.iteration}" />
            {/if}
        </td>
        <td><a href="?m=terminal&a=history&th_imei={$item.md_imei}" class="link edit view"></a></td>
        <input type="hidden" name="ag_name{$smarty.foreach.list.iteration}" value="{$item.ag_name|getompman}">
        <input type="hidden" name="e_name{$smarty.foreach.list.iteration}" value="{$item.e_name}">
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
    <span class="img_unbind">{"未绑定"|L}</span>
</div>
{/strip}
<script>
   (function () {
        $("a.start_stop").each(function(){
            $(this).on("click",function(){
                setstatus(this);
        });
    });
    })();
</script>
