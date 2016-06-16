{strip}

<h2 class="title">{"终端列表"|L}</h2>

<div class="toptoolbar">
    <a href="?m=terminal&a=terminal_in" id="add_type" class="button orange">{"终端入库"|L}</a>
</div>
<div class="toolbar">
<form action="?m=terminal&a=index_list_item" id="form" method="post">
    <input autocomplete="off"  name="modules" value="terminal" type="hidden" />
    <input autocomplete="off"  name="action" value="index_list_item" type="hidden" />
    <input autocomplete="off"  name="page" value="0" type="hidden" />

    <div class="line">
        <label>IMEI：</label>
        <input autocomplete="off"  class="autosend" name="md_imei" type="text" />
    </div>
    <div class="line">
        <label>MEID：</label>
        <input autocomplete="off"  class="autosend" name="md_meid" type="text" />
    </div>
    <div class="line">
        <label>{"终端型号"|L}：</label>
        <select  name="md_type" value="{$item.md_type}" class="autofix" action="?m=terminal&a=option">
            <option value="">{"全部"|L}</option>
        </select>
    </div>
    <div class="line">
        <label>{"序列号"|L}：</label>
        <input autocomplete="off"  class="autosend" name="md_serial_number" type="text" />
    </div>
    <div class="line">
        <label>{"状态"|L}：</label>
        <select  name="md_status">
            <option value="">{"全部"|L}</option>
            <option value="2">{"未绑定"|L}</option>
            <option value="1">{"启用"|L}</option>
            <option value="0">{"停用"|L}</option>
        </select>
        {*<input autocomplete="off"  class="autosend" name="md_binding" type="text" />*}
    </div>
    <div class="line">
        <label>{"所属企业"|L}：</label>
        <select  name="md_ent_id" value="{$item.md_ent_id}" class="autofix" action="?m=terminal&a=e_option">
            <option value="">{"全部"|L}</option>
        </select>
        {*<input autocomplete="off"  class="autosend" name="md_binding" type="text" />*}
    </div>
    <div class="line">
        <label>{"系统号码"|L}：</label>
        <input autocomplete="off"  class="autosend" name="md_binding_user" type="text" />
    </div>
    <div class="line">
        <label>{"批次"|L}：</label>
        <input autocomplete="off"  class="autosend" name="md_batch" type="text" />
    </div>
    <div class="line">
        <label>{"名称"|L}：</label>
        <input autocomplete="off"  class="autosend" name="md_name" type="text" />
    </div>
    <div class="line">
        <label>{"入库单号"|L}：</label>
        <input autocomplete="off"  class="autosend" name="md_in_number" type="text" />
    </div>
    <div class="line">
        <label>{"入库时间"|L}：</label>
        <input autocomplete="off"  name="md_time" type="text" />
    </div>
    <div class="line">
        <label>{"所属代理商"|L}：</label>
        <select  name="md_parent_ag" value="{$item.md_parent_ag}" class="autofix" action="?m=terminal&a=ag_option">
            <option value="">{"全部"|L}</option>
            <option value="0">{"OMP"|L}</option>
        </select>
        {*<input autocomplete="off"  class="autosend" name="md_binding" type="text" />*}
    </div>



        
        <div class="buttons right">
            <a form="form" class="button submit"><i class="icon-search"></i>{"查询"|L}</a>
        </div>
    </form>
</div>
<div class="toolbar">
    <a id="delall" class="button">{"批量删除"|L}</a>
    <a id="batch_toggle" class="button green">{"选中项批量修改"|L}</a>
    <a id="allstart" class="button">{"批量启用"|L}</a>
    <a id="allstop" class="button">{"批量停用"|L}</a>

 <form class="batch hide" id="batch">
        <div class="line">
            <label>{"终端型号"|L}：</label>
            <select name="md_type" class="autofix" action="?m=terminal&a=option" required="true">
                <option selected='selected' value="%">{"保留当前型号"|L}</option>
            </select>
            
        </div>
        <div class="line">
            <label>{"所属代理商"|L}：</label>
            <select  name="md_parent_ag" value="{$item.md_parent_ag}" class="autofix" action="?m=terminal&a=ag_option">
                <option selected='selected' value="%">{"保留当前所属代理"|L}</option>
                <option value="0">{"OMP"|L}</option>
            </select>
            {*<input autocomplete="off"  class="autosend" name="md_binding" type="text" />*}
        </div>
        <a id="batch_submit" class="button">{"批量修改"|L}</a>
    </form>
</div>

<div>
    <table class="full">
        <tr class='head' style="height: 35px;" type="ter" url="?m=terminal&action=index_list_item">
            <td width="110px" class="clickPage">{"终端列表"|L}</td>
            <td width="490px" class="clickPage" style="text-align:right;">{"显示条数"|L}：</td>
            <td width="50px" onclick="clickPage(this)" class="clickPage" {$smarty.session.color.10} onmouseover="this.style.cursor='pointer'">10</td>
            <td width="50px" onclick="clickPage(this)" class="clickPage" {$smarty.session.color.20} onmouseover="this.style.cursor='pointer'">20</td>
            <td width="50px" onclick="clickPage(this)" class="clickPage" {$smarty.session.color.50} onmouseover="this.style.cursor='pointer'">50</td>
        </tr>
    </table>
</div>

    <div class="content"></div>
    
    <div id="dialog-confirm" class="hide" title="{'删除选中项'|L}？">
        <p>{"确定要删除选中的设备吗"|L}？</p>
    </div>

<div id="dialog-confirm-batch" class="hide" title="{'更新选中项'|L}？">
    <p>{"确定要进行此操作吗"|L}？</p>
</div>

<script  {'type="ready"'}>
 $("#batch_submit").click(function () {
    var checkd = "";
        $("input.cb:checkbox:checked").each(function () {
    checkd += $(this).val() + ",";
    });
            if (checkd === "") {
    notice("{'未选中任何终端'|L}");
    } else {
    var data = $("form#batch").serialize() + "&" + $("form.data").serialize();
    $("#dialog-confirm-batch").dialog({
    resizable: false,
            height: 180,
            modal: true,
            buttons: {
            "{"更新"|L}": function () {
            $(this).dialog("close");
                    $.ajax({
                    url: "?modules=terminal&action=term_batch",
                            data: data,
                            success: function () {
                            send();
                            }
                    });
            },
                    "{"取消"|L}": function () {
                    $(this).dialog("close");
                    }
            }
    });
    }
    });
    </script>
    {/strip}