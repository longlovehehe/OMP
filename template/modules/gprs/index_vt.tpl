{strip}
<h2 class="title">{"流量卡管理"|L}</h2>

<div class="toptoolbar">
    <a href="?m=gprs&a=gprs_add" class="button orange">{"办理入库"|L}</a>
</div>
<div class="toolbar">
    <form action="?m=gprs&a=gprs_item" id="form" method="post">
        <input autocomplete="off"  name="modules" value="gprs" type="hidden" />
        <input autocomplete="off"  name="action" value="gprs_item" type="hidden" />
        <input autocomplete="off"  name="page" value="0" type="hidden" />
        <div class="line">
            <label>{"ICCID"|L}：</label>
            <input autocomplete="off"  class="autosend" name="g_iccid" type="text" />
        </div>
        <div class="line">
            <label>{"IMSI"|L}：</label>
            <input autocomplete="off"  class="autosend" name="g_imsi" type="text" />
        </div>

        <div class="line">
            <label>{"Number"|L}：</label>
            <input autocomplete="off"  class="autosend" name="g_number" type="text" />
        </div>

        <div class="line">
            <label>{"状态"|L}：</label>
            <select name="g_status">
                <option value="">{"全部"|L}</option>
                <option value="2">{"未绑定"|L}</option>
                <option value="1">{"启用"|L}</option>
                <option value="0">{"停用"|L}</option>
            </select>
        </div>
        <div class="line">
            <label>{"所属企业"|L}：</label> 
            <select  name="g_e_id" value="{$item.g_e_id}" class="autofix" action="?m=gprs&a=e_option">
                <option value="">{"全部"|L}</option>
            </select>
            {*<input autocomplete="off"  class="autosend" name="g_binding" type="text" />*}
        </div>
        <div class="line">
            <label>{"系统号码"|L}：</label>
            <input autocomplete="off"  class="autosend" name="g_u_number" type="text" />
        </div>

        <div class="line">
            <label>{"所属代理"|L}：</label>
            <select  name="g_agents_id" value="{$item.g_agents_id}" class="autofix" action="?m=gprs&a=ag_option">
                <option value="">{"全部"|L}</option>
                <option value="0">{"OMP"|L}</option>
            </select>
            {*<input autocomplete="off"  class="autosend" name="md_binding" type="text" />*}
        </div>

        <div class="line">
            <label>{"入库时间"|L}：</label>
            <input autocomplete="off"  {*class="datepicker start"*} name="g_intime" type="text" {*datatime='true'*} />
{*            <span>-</span>
            <input autocomplete="off"  class="datepicker end" name="end" type="text" datatime="true" />*}
        </div>

        <div class="buttons right">
            <a form="form" class="button submit">{"查询"|L}</a>
        </div>
    </form>
</div>

<div class="toolbar">
  <a id="delall" class="button">{"批量删除"|L}</a>
  <a id="refreshall" class="refreshall button" data="?m=gprs&a=refresh" >{"分配代理商"|L}</a>
  <a name="up_or_down" type="up" class="button">{"批量启用"|L}</a>
  <a name="up_or_down" type="down" class="button">{"批量停用"|L}</a>
    <form action="?m=gprs&a=bind_gprs" class="batch hide" id="batch"  method="post">
        <div class="line">
            <label>{"代理商"|L}：</label>
            <select name="agents" class="autofix" action="?m=gprs&a=ag_option" required="true">
            <option value="0">{"OMP"|L}</option>
            </select>
        </div>

        <a id="batch_submit" class="button">{"批量分配"|L}</a>
    </form>
</div>

<div>
    <table class="full">
        <tr class='head' style="height: 35px;" type="gprs" url="?m=gprs&action=gprs_item">
            <td width="110px" class="clickPage">{"流量卡列表"|L}</td>
            <td width="490px" class="clickPage" style="text-align:right;">{"显示条数"|L}：</td>
            <td width="50px" onclick="clickPage(this)" class="clickPage" {$smarty.session.color.10} onmouseover="this.style.cursor='pointer'">10</td>
            <td width="50px" onclick="clickPage(this)" class="clickPage" {$smarty.session.color.20} onmouseover="this.style.cursor='pointer'">20</td>
            <td width="50px" onclick="clickPage(this)" class="clickPage" {$smarty.session.color.50} onmouseover="this.style.cursor='pointer'">50</td>
        </tr>
    </table>
</div>

<div class="content"></div>

<div id="dialog-confirm" class="hide" title="{'删除选中项'|L}?">
    <p>{"确定要删除选中的流量卡吗"|L}?</p>
</div>
<div id="dialog-bind" class="hide" title="{'更新选中项'|L}?">
    <p>{"确定要进行此操作吗"|L}?</p>
</div>
<div id="dialog-update" class="hide" title="{'更新选中项'|L}?">
    <p>{"确定要进行此操作吗"|L}?</p>
</div>
{/strip}
