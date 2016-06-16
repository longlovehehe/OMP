{strip}
<div class="toolbar ">
    <a href="?m=device&a=server" class="button none">{"部署管理"|L}</a>
    <a href="?m=device&a=vcr" class="button none">{"VCR管理"|L}</a>
    <a href="?m=device&a=vcrs" class="button none">{"VCR-S管理"|L}</a>
</div>
<h2 class="title">{"{$title}"|L}</h2>

<div class="toptoolbar">
    <a href="?m=device&a=cluster_add" class="button orange">{"新增部署ID"|L}</a>
</div>
<form id="form" action="?modules=device&action=cluster_item" method="post">
    <div class="toolbar">
        <input autocomplete="off"  name="page" value="0" type="hidden" />
        <input autocomplete="off"  name="num" value="10" type="hidden" />
        <input autocomplete="off"  form="form" class="button submit" type="hidden"/>
    </div>

</form>

<div class="content"></div>

<form id="form" class="base mrbt10" >
    <input autocomplete="off"  name="d_id" class="d_id" value="{$data.d_id}" type="hidden" />
    <input autocomplete="off"  name="d_area1" class="d_area" value="{$data.d_area}" type="hidden" />
    <input autocomplete="off"  name="d_ip1" id="d_ip1" value="{$data.d_ip1}" type="hidden" />
    <input autocomplete="off"  name="d_port1" value="{$data.d_port1}" type="hidden" />
    <input autocomplete="off"  name="d_ip2" value="{$data.d_ip2}" type="hidden" />
    <input autocomplete="off"  name="d_port2" value="{$data.d_port2}" type="hidden" />
    <input autocomplete="off"  name="d_type" value="{$data.d_type}" type="hidden" />
    <div  id="light" class="white_content" style="height: 320px;">
        <div style="background-color:#DCE0E1;"><div style="float:left;width: 20px;">&nbsp;</div><div class="c_dir">{"新增区域"|L}</div></div>
        <br />
        <div class="block">
            {"设备名称"|L}：
            <input readonly autocomplete="off"  style="width: 150px;"  maxlength="32"   name="d_name" value="" type="text" />
        </div>
        <br />
        <div class="block">
            {"已有区域"|L}：
            <span class="d_area"></span>
        </div>
        <div class="block">
            <label>{"增加区域"|L}：</label>
            <select name="d_area[]" class="moreselect" size="5" multiple="true">

            </select>
        </div>

        <div class="buttons mrtop40" style="float: right;">
            <a class="button normal" onclick="do_set();">{"保存"|L}</a>
            <a class=" button" onclick="closed();">{"取消"|L}</a>
        </div>
    </div>
</form>

<div id="dialog-confirm" class="hide" title="{'删除选中项'|L}？">
    <p>{"确定要删除选中的设备吗"|L}?</p>
</div>
{/strip}