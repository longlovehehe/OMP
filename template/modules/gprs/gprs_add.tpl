{strip}
<h2 class="title">{"办理入库"|L}</h2>

<div class="block">
    <a id="tmimport"  class=" button " action="terminal_group">{"批量入库"|L}</a>
    <a class="export button" action="terminal_group">{"下载模板"|L}</a>
</div>
<div class="toolbar" style="padding: 10px 0px 10px 10px;background: #e5e5e5;float: left;">
<form id="form" class="" method="post" action="?m=gprs&a=batch_gprs_gqt">
        <div class="line">
            <label>{"名称"|L}：</label>
            <input autocomplete="off"  class="autosend" name="g_name" type="text" />
        </div>
        <div class="line">
            <label>ICCID：</label>
            <input autocomplete="off"maxlength='20' class="autosend" name="g_iccid" type="text" />
        </div>
        <div class="line">
            <label>Number：</label>
            <input autocomplete="off"maxlength='32' class="autosend" name="g_number" type="text" />
        </div>
        <div class="line">
            <label>{"所属代理商"|L}：</label>
            <select  name="g_agents_id" class="autofix" action="?m=gprs&a=ag_option">
                <option value="0">{"OMP"|L}</option>
            </select>
        </div>
        <div class="line">
            <label>{"IMSI"|L}：</label>
            <input autocomplete="off" maxlength='15' class="autosend" name="g_imsi" type="text" />
        </div>
        <div class="line">
            <label>{"开卡日"|L}：</label>
            <input autocomplete="off" maxlength='32' class="autosend" name="g_a_date" type="text" />
        </div>
        
         <div class="line">
            <label>{"入库单号"|L}：</label>
            <input autocomplete="off" maxlength='64' class="autosend" name="g_in_number" type="text" />
        </div>
         <div class="line">
            <label>{"入库日期"|L}：</label>
            <input autocomplete="off" maxlength='64' name="g_intime" type="text" />
        </div>
        <div class="line">
             <label>{"批次"|L}：</label>
             <input autocomplete="off" maxlength='64' class="autosend" name="g_batch" type="text" />
         </div>
             <div style="clear: both;"></div>
       <div class="line"  style="width: 350px;float: left;margin-top: 10px;">
            <div style="float:left;">{"备注"|L}1：</div>
            <div>
                <textarea name="g_one_remarks" maxlength='128' onblur="checkremark(this)" style="width:270px;height: 175px;"></textarea>
            </div>
        </div>
        <div class="line" style="width: 350px;margin-top: 10px;">
            <div style="float:left;">{"备注"|L}2：</div>
            <div>
                <textarea name="g_two_remarks" maxlength='128' style="width:270px;height: 175px;"></textarea>
            </div>
        </div>
    
    
    <div class="buttons mrtop40" style="clear: both;">
        <a goto="?m=gprs&a=index" form="form" class="ajaxpost_g button normal">{"保存"|L}</a>
        <a class="goback button">{"取消"|L}</a>
    </div>
</form>
</div>
<!--导入流量卡-->
<form class="hide" id="tm_import" name="fileupdate" method="post" action="?"  enctype="multipart/form-data" target="hidden_frame">
    <input name="m" value="gprs" />
    <input name="a" value="importShellICCID" />
    <input autocomplete="off"  name="step" type="text" value="if" />
    <input autocomplete="off"  id="tm_import_up" name="fileToUpload" type="file"  />
</form>

<!-- 流量卡数据检查 -->
<form class="hide" id="tm_ic" method="get" action="?"  target="hidden_frame">
    <input name="m" value="gprs" />
    <input name="a" value="importShellICCID" />
    <input autocomplete="off"  name="step" type="text" value="ic" />
    <input name="f" type="hidden" />
</form>

<!-- 流量卡数据导入 -->
<form class="hide" id="tm_i" method="get" action="?"  target="hidden_frame">
    <input name="m" value="gprs" />
    <input name="a" value="importShellICCID" />
    <input autocomplete="off"  name="step" type="text" value="i" />
    <input name="f" type="hidden" />
</form>
<!--/群组导入结束-->

<!--输出台-->
<iframe id="ifr" name="hidden_frame"></iframe>
{/strip}