{strip}
<h2 class="title">{*{$data.do|upper}*}{$smarty.session.ident}-Server [{$data.d_ip2}] {"使用详情"|L}</h2>
<div class="toolbar">
   <!--  <form action="?modules=device&action=device_list_item" id="form" method="post">
        <input autocomplete="off"  name="device_id" value="{$data.device_id}" type="hidden" />
        <input autocomplete="off"  name="do" value="{$data.do}" type="hidden" />
        <input autocomplete="off"  name="page" value="0" type="hidden" />
        <a form="form" class="button submit none">{"查询"|L}</a>
        <a class="goback button">{"返回"|L}</a>
    </form> -->
    <a goto class="goback button">{"返回"|L}</a>
</div>



<form id="form" class="base mrbt10" action="?modules=device&action=device_move_batch">
<input name="d_deployment_id" type="hidden" value="{$data.d_deployment_id}">
<input name="diff_phone" type="hidden" value="{$data.diff_phone}">
<input name="diff_dispatch" type="hidden" value="{$data.diff_dispatch}">
<input name="diff_gvs" type="hidden" value="{$data.diff_gvs}">
<input name="device_id" type="hidden" value="{$data.device_id}">
	<div class="content">
		<table class="base full cb">
			<tr class='head'>
				<th style="padding-left: 2px;display:inline;margin:0px;"><div style="width:15px;"><input autocomplete="off"  type="checkbox" id="checkall" /></div></th>
				<th><div style="width:50px;">{"企业ID"|L}</div></th>
				<th><div style="width:50px;">{"企业名称"|L}</div></th>
				<th><div style="width:80px;">{"企业总用户数"|L}</div></th>
				<th><div style="width:80px;">{"手机用户数"|L}</div></th>
				<th><div style="width:80px;">{"调度台用户数"|L}</div></th>
				<th><div style="width:90px;">{"GVS用户数"|L}</div></th>
			</tr>
		</table>
		<div  style="height:250px;overflow-y: scroll;">
		<table class="base full cb">
			{foreach name=list item=item from=$list}
			<tr>
				<td width="20px" style="padding: 0px;display:inline;margin:0px;"><input style="margin-left: 2px;" type="checkbox" name="checkbox[]" value="{$item.e_id}" class="cb" /></td>
				<td width="50px">{$item.e_id}</td>
				<td width="50px">{$item.e_name}</td>
				<td width="80px">{$item.phone_num+$item.dispatch_num+$item.gvs_num}/{$item.e_mds_users}</td>
				<td width="80px">{$item.phone_num}/{$item.e_mds_phone}</td>
				<td width="80px">{$item.dispatch_num}/{$item.e_mds_dispatch}</td>
				<td width="80px">{$item.gvs_num}/{$item.e_mds_gvs}</td>
			</tr>
			{/foreach}
		</table>
		</div>
	</div>
<div class="onelv none">
    <div class="block none">
        <label class="title">{"区域"|L}：</label>
        <select name="e_area" class="" action="?m=area&a=option" selected="true" data='[{ "to": "e_mds_id","field": "d_area","view":"false" }]'>
            <option value='@'>{"未选择"|L}</option>
        </select>
    </div>

    <div class="block">
        <label class="title">{"请选择所属"|L} {$smarty.session.ident}-Server：</label>
        <select value="" id="e_mds_id" name="e_mds_id" size="10"  class="autofix long" action="?m=device&action=mds_option_area&d_id={$data.device_id}" selected="true" data='[{ "to": "e_vcr_id","field": "d_deployment_id","view":"false" }]'></select>
    </div>
    <div class="twolv none">
    <div class="block">
        <label class="title">{"请选择所属"|L} {$smarty.session.ident}-RS：</label>
        <select value="" id="e_vcr_id" name="e_vcr_id" size="10"  class=" long" action="?m=device&action=rs_option" ></select>
    </div>
    <div class="block">
        <label class="title">{"请选择所属"|L} {$smarty.session.ident}-SS：</label>
        <select value="" id="e_ss_id" name="e_ss_id" size="10"  class=" long" action="?m=device&action=ss_option" selected="true"></select>
    </div>
    </div>
    <div class="buttons mrtop40">
        <a goto="?m=device&a=server" form="form" class="ajaxpost_d_batch button normal">{"保存"|L}</a>
        <a class="goback button">{"取消"|L}</a>
    </div>
</div>
</form>

{/strip}