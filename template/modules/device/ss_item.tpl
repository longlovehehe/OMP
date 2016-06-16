

<form class="data">
    <table class="base full">
        <tr class='head'>
            <th width="20px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>
            <th width="40px">{"ID"|L}</th>
            <th width="120px">{"名称"|L}</th>
            <th width="120px">{"内网地址"|L}</th>
            <th width="120px">{"外网地址"|L}</th>
            <th width="80px">{"部署ID名称"|L}</th>
            <th width="70px">{"状态"|L}</th>
            <th width="50px">{"详情"|L}</th>
            <th width="150px">{"操作"|L}</th>
        </tr>
        {foreach name=list item=item from=$list}
        <tr>
            <td><input autocomplete="off"  type="checkbox" name="checkbox[]" value="{if $item.status eq 'no'}{$item.d_id}{else}0{/if}" class="cb" {if $item.status eq 'yes'}disabled{/if} /></td>
            <td>{$item.d_id}</td>
            <td>{$item.d_name}</td>
            <td>{$item.d_ip1}</td>
            <td>{$item.d_ip2}</td>
            <td>{$item.cluster_name}</td>
            <!-- <td><span class="ellipsis" style="width: 60px">{$item.d_area|mod_area_name:option}</span></td> -->
            <td>{$item.d_status|modDeviceStatus}</td>
            <td class="rich"><a  title="{'ID'|L}: 【{$item.d_id}】<br />{'设备名称'|L}: 【{$item.d_name}】<br />{'部署方式'|L}: 【{$item.d_deployment_type|modDeploymentType}】<br />{'内网地址'|L}: 【{$item.d_ip1}】<br />{'外网地址'|L}: 【{$item.d_ip2}】<br />{'网络接入方式'|L}: 【{$item.d_network_type|modNetworkType}】<br />{'部署ID名称'|L}: 【{$item.cluster_name}】<br />{'已用/总存储空间'|L}: 【{$item.d_space - $item.d_space_free}|{$item.d_space}】<br />{'状态'|L}: 【{$item.d_status|modDeviceStatus}】<br />" class="link tips_title"><span class="icon hand"></span></a></td>
            <td>
                {if $item.status eq 'yes'}
                <a title="{'此设备下有企业在用不能编辑'|L}" class="link dis">{"编辑"|L}</a>
                {else}
                <a href="?m=device&a=ss_edit&d_id={$item.d_id}" class="link">{"编辑"|L}</a>
                {/if}
                <!-- |<a href="javascript:void(0);" class="link" {if $item.d_area != '["#"]'}onclick="new_creat({$item.d_id});"{else}onclick="title_notice();"{/if}>{"区域"|L}</a> -->|<a href="?m=device&a=ss_list&device_id={$item.d_id}&do=ss&d_name={$item.d_name}&d_ip2={$item.d_ip2}" class="link">{if $smarty.cookies.lang eq en_US}Info{else}详情{/if}</a>
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
