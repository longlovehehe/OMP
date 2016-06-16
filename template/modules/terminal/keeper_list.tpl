{strip}

<h2 class="title">{"Keeper管理"|L}</h2>

<div class="toolbar">
<form action="?m=terminal&a=keeper_list_item" id="form" method="post">
        <input autocomplete="off"  name="modules" value="terminal" type="hidden" />
        <input autocomplete="off"  name="action" value="keeper_list_item" type="hidden" />
        <input autocomplete="off"  name="page" value="0" type="hidden" />
        <div class="line">
            <label>{"昵称"|L}：</label>
            <input autocomplete="off"  class="autosend" name="rm_nickname" type="text" />
        </div>
        <div class="line">
            <label>{"号码"|L}：</label>
            <input autocomplete="off"  class="autosend" name="rm_id" type="text" />
        </div>
        
        <div class="line buttons right">
            <a form="form" class="button submit"><i class="icon-search"></i>{"查询"|L}</a>
        </div>
    </form>
</div>
    <div class="content"></div>

    {/strip}