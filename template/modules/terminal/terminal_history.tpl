{strip}


    <h2 class="title">{"历史记录"|L}</h2>

    <div class="toolbar">
        <form action="?m=terminal&a=history_item" id="form" method="post">
            <input autocomplete="off"  name="modules" value="terminal" type="hidden" />
            <input autocomplete="off"  name="action" value="history_item" type="hidden" />
            <input autocomplete="off"  name="page" value="0" type="hidden" />
            <input autocomplete="off"  name="th_imei" value="{$smarty.request.th_imei}" type="hidden" />
            <input autocomplete="off"  name="md_imei" value="{$smarty.request.th_imei}" type="hidden" />

            <div class="line">
                <label>IMEI：</label>
                <span>{$data.md_imei}</span>
            </div>
            <div class="line">
                <label>{"终端类型"|L}：</label>
                <span>{$data.md_type|default:{"无"|L}}</span>
            </div>
            <div class="line">
                <label>{"序列号"|L}：</label>
                <span>{$data.md_serial_number}</span>
            </div>

            <div class="buttons right none">
                <a form="form" class="button submit"><i class="icon-search"></i>{"查询"|L}</a>
            </div>
        </form>
    </div>
    <div class="content"></div>

{/strip}