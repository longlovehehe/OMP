{strip}
<h2 class="title">{"办理入库"|L}</h2>

<div class="block">
    <a id="tmimport"  class=" button " action="terminal_group">{"批量入库"|L}</a>
    <a class="export button" action="terminal_group">{"下载模板"|L}</a>
</div>
<div class="toolbar" style="padding: 10px 0px 10px 10px;background: #e5e5e5;float: left;">
<form id="form" class="" method="post" action="?m=terminal&a=save_terminal">
    <div class="top">    
        <div class="line">
        <label>IMEI：</label>
        <input autocomplete="off" maxlength='15' class="autosend" name="md_imei" type="text" />
        </div>
        <div class="line">
        <label>MEID：</label>
        <input autocomplete="off" maxlength='14' class="autosend" name="md_meid" type="text" placeholder="{"当使用电信卡时,请务必填写该项"|L}" style="width:185px;" />
        </div>
        <div class="line">
            <label>{"终端型号"|L}：</label>
            <select  name="md_type" value="{$item.md_type}" class="autofix" action="?m=terminal&a=option" style="width:100px;">
            </select>
        </div>
        
    </div>
    <div style="width: 285px;float: left;">
        <div class="block">
            <label>{"所属代理"|L}：</label>
            <select  style="border-color: #bfbfbf" name="md_parent_ag" value="{$item.md_parent_ag}" class="autofix" action="?m=terminal&a=ag_option">
                <option value="0">{"OMP"|L}</option>
            </select>
        </div>
        <div class="block">
            <label>{"序列号"|L}：</label>
            <input autocomplete="off" maxlength='32' class="autosend" name="md_serial_number" type="text" />
        </div>
         <div class="block">
            <label>{"入库单号"|L}：</label>
            <input autocomplete="off" maxlength='64' class="autosend" name="md_in_number" type="text" />
        </div>
         <div class="block">
            <label>{"入库日期"|L}：</label>
            <input autocomplete="off" maxlength='64' name="md_time" type="text" />
        </div>
        <div class="block">
             <label>{"批次"|L}：</label>
             <input autocomplete="off"  maxlength='64' class="autosend" name="md_batch" type="text" />
         </div>
        <div class="block">
            <label>{"名称"|L}：</label>
            <input autocomplete="off"  maxlength='64' class="autosend" name="md_name" type="text" />
        </div>
    </div>
    <div style="width: 400px;float: left;margin-top: 10px;">
            <div style="float:left;">{"备注"|L}：</div>
            <div>
                <textarea name="md_remarks" maxlength='128' style="width:350px;height:197px;"></textarea>
            </div>
    </div>
   {* <div class="line">
        <label>{"所属代理商"|L}：</label>
        <select  name="md_parent_ag" value="{$item.md_parent_ag}" class="autofix" action="?m=terminal&a=ag_option">
            <option value="">{"全部"|L}</option>
            <option value="0">{"OMP"|L}</option>
        </select>
        {*<input autocomplete="off"  class="autosend" name="md_binding" type="text" />*}
{*    </div>*}
    </form>
</div>

    <div class="buttons mrtop40" style="margin-top: 250px;text-align: center;clear: both;">
        <a goto="?m=terminal&a=terminal_in" form="form" class="ajaxpost_t button normal">{"确认"|L}</a>
        <a class="goback button">{"取消"|L}</a>
    </div>
</form>

<!--导入IMEI-->
<form class="hide" id="tm_import" name="fileupdate" method="post" action="?"  enctype="multipart/form-data" target="hidden_frame">
    <input name="m" value="terminal" />
    <input name="a" value="importShellIMEI" />
    <input autocomplete="off"  name="step" type="text" value="if" />
    <input autocomplete="off"  id="tm_import_up" name="fileToUpload" type="file"  />
</form>

<!-- IMEI数据检查 -->
<form class="hide" id="tm_ic" method="get" action="?"  target="hidden_frame">
    <input name="m" value="terminal" />
    <input name="a" value="importShellIMEI" />
    <input autocomplete="off"  name="step" type="text" value="ic" />
    <input name="f" type="hidden" />
</form>

<!-- IMEI数据导入 -->
<form class="hide" id="tm_i" method="get" action="?"  target="hidden_frame">
    <input name="m" value="terminal" />
    <input name="a" value="importShellIMEI" />
    <input autocomplete="off"  name="step" type="text" value="i" />
    <input name="f" type="hidden" />
</form>
<!--/群组导入结束-->

<!--输出台-->
<iframe id="ifr" name="hidden_frame"></iframe>
{/strip}