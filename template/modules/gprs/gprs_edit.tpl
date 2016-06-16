{strip}
<h2 class="title">{"流量卡编辑"|L}</h2>

<div class="block none">
    <a id="tmimport"  class=" button " action="terminal_group">{"批量入库"|L}</a>
    <a class="export button" action="terminal_group">{"下载模板"|L}</a>
</div>
<div class="toolbar" style="padding: 10px 0px 10px 10px;background: #e5e5e5;float: left;">
<form id="form" class="" method="post" action="?m=gprs&a=batch_gprs_gqt">
    <input type="hidden" name="do" value="edit" />
    <input type="hidden" name="g_id" value="{$item.g_id}" />
        <div class="line">
            <label>{"名称"|L}：</label>
            <input autocomplete="off"  class="autosend" name="g_name" type="text" value="{$item.g_name}"/>
        </div>
        <div class="line">
            <label>ICCID：</label>
            <input autocomplete="off"maxlength='20' class="autosend" name="g_iccid" type="text" value="{$item.g_iccid}"/>
        </div>
        <div class="line">
            <label>Number：</label>
            <input autocomplete="off"maxlength='32' class="autosend" name="g_number" type="text" value="{$item.g_number}"/>
        </div>
        <div class="line">
            <label>{"所属代理商"|L}：</label>
            <select  name="g_agents_id" value="{$item.g_agents_id}" class="autofix autoedit" action="?m=gprs&a=ag_option">
                <option value="0">{"OMP"|L}</option>
            </select>
        </div>
        <div class="line">
            <label>{"IMSI"|L}：</label>
            <input autocomplete="off" maxlength='15' class="autosend" name="g_imsi" type="text" value="{$item.g_imsi}"/>
        </div>
        <div class="line">
            <label>{"开卡日"|L}：</label>
            <input autocomplete="off" maxlength='32' class="autosend" name="g_a_date" type="text" value="{$item.g_a_date}"/>
        </div>
        
         <div class="line">
            <label>{"入库单号"|L}：</label>
            <input autocomplete="off" maxlength='64' class="autosend" name="g_in_number" type="text" value="{$item.g_in_number}"/>
        </div>
         <div class="line">
            <label>{"入库日期"|L}：</label>
            <input autocomplete="off" maxlength='64' name="g_intime" type="text"  value="{$item.g_intime}"/>
        </div>
        <div class="line">
             <label>{"批次"|L}：</label>
             <input autocomplete="off" maxlength='64' class="autosend" name="g_batch" type="text" value="{$item.g_batch}"/>
         </div>
       
       <div class="line"  style="width: 300px;float: left;margin-top: 10px;">
            <div style="float:left;">{"备注"|L}1：</div>
            <div>
                <textarea name="g_one_remarks" maxlength='128' style="width:240px;height: 175px;padding: 5px;">{$item.g_one_remarks}</textarea>
            </div>
        </div>
        <div class="line" style="width: 300px;margin-top: 10px;">
            <div style="float:left;">{"备注"|L}2：</div>
            <div>
                <textarea name="g_two_remarks" maxlength='128' style="width:240px;height: 175px;padding: 5px;">{$item.g_two_remarks}</textarea>
            </div>
        </div>
    
    
    <div class="buttons mrtop40" style="clear: both;">
        <a goto="?m=gprs&a=index" form="form" class="ajaxpost_g button normal">{"保存"|L}</a>
        <a class="goback button">{"取消"|L}</a>
    </div>
</form>
</div>
{/strip}