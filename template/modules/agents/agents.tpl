{strip}
<div class="toptoolbar ">
    <a href="?m=agents&a=agents_save" class="button orange">{"新增代理商"|L}</a>
</div>
<h2 class="title"><span class='ellipsis2' style='max-width: 350px;height: 20px;'>{"代理商管理"|L}</h2>


<div class="toolbar">
    <form action="?m=agents&a=agents_item" id="form" method="post">
        <input autocomplete="off"  name="modules" value="agents" type="hidden" />
        <input autocomplete="off"  name="action" value="agents_item" type="hidden" />
        <input autocomplete="off"  name="page" value="0" type="hidden" />

        <h3 class="title">{"基本属性"|L}</h3>
        <div class="line">
            <label>{"编号"|L}：</label>
            <input  autocomplete="off"  class="autosend" name="ag_number" type="text" />
        </div>
        <div class="line none">
            <label>{"登陆帐号"|L}：</label>
            <input  autocomplete="off"  class="autosend" name="ag_id" type="text" />
        </div>
        <div class="line">
            <label>{"代理商名称"|L}：</label>
            <input  autocomplete="off"  class="autosend" name="ag_name" type="text" />
        </div>
        <div class="line">
            <label>{"联系人姓名"|L}：</label>
            <input  autocomplete="off"  class="autosend" name="ag_admin_name" type="text" />
        </div>
        <div class="line">
            <label>{"电话"|L}：</label>
            <input  autocomplete="off"  class="autosend" name="ag_phone" type="text" />
        </div>
        <div class="line">
            <label>{"E-Mail"|L}：</label>
            <input  autocomplete="off"  class="autosend" name="ag_mail" type="text" />
        </div>
        {*
        <h3 class="title">详细属性<a class="toggle alink" data="detailed">展开↓</a></h3>
        <div class="detailed none">
            <div class="line">
                <label>头像：</label>
                <select name="u_pic">
                    <option value="">全部</option>
                    <option value="1">有头像</option>
                    <option value="0">无头像</option>
                </select>
            </div>

            <div class="line">
                <label>性别：</label>
                <select name="u_sex">
                    <option value="">全部</option>
                    <option value="M">男</option>
                    <option value="F">女</option>
                </select>
            </div>

            <div class="line">
                <label>手机号：</label>
                <input autocomplete="off"  class="autosend" name="u_mobile_phone" type="text" />
            </div>
            <div class="line">
                <label>UDID：</label>
                <input autocomplete="off"  class="autosend" name="u_udid" type="text" />
            </div>
            <div class="line">
                <label>IMSI：</label>
                <input autocomplete="off"  class="autosend" name="u_imsi" type="text" />
            </div>
            <div class="line">
                <label>IMEI：</label>
                <input autocomplete="off"  class="autosend" name="u_imei" type="text" />
            </div>
            <div class="line">
                <label>ICCID：</label>
                <input autocomplete="off"  class="autosend" name="u_iccid" type="text" />
            </div>
            <div class="line">
                <label>MAC：</label>
                <input autocomplete="off"  class="autosend" name="u_mac" type="text" />
            </div>
            <div class="line">
                <label>终端类型：</label>
                <input autocomplete="off"  class="autosend" name="u_terminal_type" type="text" />
            </div>
        </div>
        *}
        <div class="buttons right">
            <a form="form" class="button submit"><i class="icon-search"></i>{"查询"|L}</a>
        </div>
    </form>
</div>

<div class="toolbar">
    <a id="delall" class="button">{"批量删除"|L}</a>
    {*
    <a id="batch_toggle" class="button green">选中项批量修改</a>
    <a id="move_user" class="button green">选中项移动到企业</a>
    <a id="move_u_default_pg" class="button green">选中项分配到群组</a>
    <form class="batch hide" id="batch" action="?modules=enterprise&action=users_item&e_id={$data.e_id}">
        <div class="line">
            <label>订购产品：</label>
            <select name="u_product_id" class="autofix" action="?m=product&a=option&e_id={$data.e_id}" required="true">
                <option value="">清除产品信息</option>
                <option selected='selected' value="%">保留产品信息</option>
            </select>
        </div>

        <div class="line none">
            <label>默认群组：</label>
            <select name="u_default_pg" class="autofix" action="?m=enterprise&a=groups_option&safe=true&e_id={$data.e_id}" required="true">
                <option value="">清除群组信息</option>
                <option selected='selected' value="%">保留群组信息</option>
            </select>
        </div>
        <div class="line">
            <label>所属部门：</label>
            <select name="u_ug_id" class="autofix" action="?modules=api&action=get_groups_list&e_id={$data.e_id}" required="true">
                <option value="">清除部门信息</option>
                <option selected='selected' value="%">保留部门信息</option>
            </select>
        </div>
        <a id="batch_submit" class="button">批量修改</a>
    </form>

    <form class="move_user hide">
        <div class="line">
            <label>移动至该企业：</label>
            <select name="to_e_id" class="autofix" action="?modules=enterprise&action=index_item&do=console&ec_id={$data.e_id}"></select>
        </div>

        <a id="move_all" class="button">批量移动</a>
    </form>

    <form class="move_u_default_pg hide">
        <div class="line">
            <label>分配至该群组：</label>
            <select name="move_u_default_pg" class="autofix" action="?modules=api&action=get_ptt_member_list&e_id={$data.e_id}" required="true"></select>
        </div>
        <div class="line">
            <label>设置成员级别：</label>
            <input autocomplete="off"  name="move_u_level" value="255" range='[0,255]' />
        </div>
        <div class="line">
            <label><input autocomplete="off"  name="move_u_hangup" type="checkbox" />被叫挂断权限</label>
        </div>
        <div class="line">
            <label><input autocomplete="off"  name="move_u_default" type="checkbox" />设为默认组</label>
        </div>
        <a id="groups_move_all" class="button">批量分配</a>
    </form>
    *}
</div>


<div class="content"></div>

<div id="dialog-confirm" class="hide" title="{'删除选中项'|L}？">
    <p>{"确定要删除选中的企业用户吗"|L}？</p>
</div>

<div id="dialog-confirm-batch" class="hide" title="{'更新选中项'|L}？">
    <p>{"确定要批量更新选中的企业用户吗"|L}？</p>
</div>

{/strip}