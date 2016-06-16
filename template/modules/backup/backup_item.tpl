{strip}
<form class="data">
<table class="base full">
    <tr class='head'>
        <th width="30px" style="text-align: center;"></th>   
        <th width="150px" style="text-align: center;">{"名称"|L}</th>
        <th width="150px" style="text-align: center;">{"大小"|L}</th>
        <th width="150px" style="text-align: center;">{"日期"|L}</th>
        <th width="150px" style="text-align: center;">{"操作"|L}</th>
    </tr>
    {foreach name=list item=item key=key from=$list}
    <tr>
        <td style="text-align: center;height: 25px;">{$key+1}</td>
        <td style="text-align: center;height: 25px;">{$item.name}</td>
        <td style="text-align: center;height: 25px;">{$item.size}</td>
        <td style="text-align: center;height: 25px;">{$item.create_time}</td>
        <td style="text-align: center;height: 25px;">
            <a href='{$item.file}' download="{$item.name}" style="color:blue;border-bottom:1px solid blue;">{"下载"|L}</a>
            &nbsp;&nbsp;&nbsp;
            <a href="javascript:void(0)" onclick='del(this)' bname="{$item.name}" style="color:blue;border-bottom:1px solid blue;">{"删除"|L}</a>
        </td>
    </tr>
    {/foreach}
</table>
</form>
{/strip}
