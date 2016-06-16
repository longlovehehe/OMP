{strip}

    <h2 class="title">{"Keeper号码"|L}：{$aResult.rm_id}&nbsp;&nbsp;{"昵称"|L}：{$aResult.rm_nickname}</h2>

<div class="toolbar">
<form action="?m=terminal&a=keeper_detail_list_item" id="form" method="post">
        <input autocomplete="off"  name="modules" value="terminal" type="hidden" />
        <input autocomplete="off"  name="action" value="keeper_detail_list_item" type="hidden" />
        <input autocomplete="off"  name="page" value="0" type="hidden" />
        <input autocomplete="off"  name="e_id" value="999999" type="hidden" />
        <input autocomplete="off"  name="rm_id" value="{$aResult.rm_id}" type="hidden" />
        <div class="line">
            <label>{"名称"|L}：</label>
            <input autocomplete="off"  class="autosend" name="u_name" type="text" />
        </div>
        <div class="line">
            <label>{"终端类型"|L}：</label>
            <select name="u_terminal_type" style='width:100px;' class="autofix" action="?m=terminal&a=option"><option value="">{"全部"|L}</option></select>
        </div>
         <div class="line">
            <label>{"系统号码"|L}：</label>
            <input autocomplete="off"  class="autosend" name="u_number" type="text" />
        </div>
        <div class="line">
            <label>IMEI：</label>
            <input autocomplete="off"  class="autosend" name="u_imei" type="text" />
        </div>
        <div class="buttons right">
            <a form="form" class="button submit"><i class="icon-search"></i>{"查询"|L}</a>
        </div>
    </form>
</div>
    <div class="content"></div>

    {/strip}