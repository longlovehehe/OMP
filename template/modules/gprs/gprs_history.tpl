{strip}


    <h2 class="title">{"历史记录"|L}</h2>

    <div class="toolbar">
        <form action="?m=gprs&a=history_item" id="form" method="post">
            <input autocomplete="off"  name="modules" value="gprs" type="hidden" />
            <input autocomplete="off"  name="action" value="history_item" type="hidden" />
            <input autocomplete="off"  name="page" value="0" type="hidden" />
            <input autocomplete="off"  name="gh_iccid" value="{$smarty.request.g_iccid}" type="hidden" />
            <input autocomplete="off"  name="g_iccid" value="{$smarty.request.g_iccid}" type="hidden" />

            <div class="line">
                <label>ICCID：</label>
                <span>{$data.g_iccid}</span>
            </div>
            <div class="line">
                <label>{"IMSI"|L}：</label>
                <span>{$data.g_imsi}</span>
            </div>
            <div class="line">
                <label>{"Number"|L}：</label>
                <span>{$data.g_number}</span>
            </div>

            <div class="buttons right none">
                <a form="form" class="button submit"><i class="icon-search"></i>{"查询"|L}</a>
            </div>
        </form>
    </div>
    <div class="content"></div>

{/strip}