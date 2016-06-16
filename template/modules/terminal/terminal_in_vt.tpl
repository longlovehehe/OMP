{strip}
<h2 class="title">{"办理入库"|L}</h2>

<div class="block">
    <a id="tmimport"  class=" button " action="terminal_group">{"批量入库"|L}</a>
    <a class="export button" action="terminal_group">{"下载模板"|L}</a>
</div>
<form id="form" class="" method="post" action="?m=terminal&a=batch_terminal">
    <table class="base full" >
        <tr class='head' id="user_list">
            <th width="100px">{"序号"|L}</th>
            <th width="200px">IMEI</th>
            <th class="rich" width="160px">{"终端型号"|L}</th>
            <th class="rich" width="110px">{"序列号"|L}</th>
            <th class="rich" width="150px">{"所属代理商"|L}</th>
            <th class="rich" width="110px"></th>

        </tr>
        <tr class="number add_terminal number_1">
            <td>1</td>
            <td><input name="md_imei[]" maxlength='15' class="imei_check" onblur="imei_test(this);" type="text"></td>
            <td class="rich"><select name="md_type[]" style='width:100px;' class="autofix" action="?m=terminal&a=option"></select></td>
            <td title='' class="rich"><input name="md_serial_number[]" onblur="serial_test(this);" type="text" maxlength='32' value=""></td>
            <td style="white-space: nowrap"><select name="md_parent_ag[]" style='width:120px;' class="autofix ag_option" action="?m=terminal&a=ag_option"><option value='0'>OMP</option></select>{*<input name="md_parent_ag[]" onblur="get_time(this);"type="text" value="">*}</td>
            <td class="rich">
                <a type="button"  class="add_button"><div  style="background: url('images/add.png') no-repeat ;background-size:18px;width:25px;height:25px; float: left;"></div></a>
                <a type="button"  class="del_button" id="gprs"><div  style="background-size:18px;width:20px;height:20px;margin-left: 30px;"></div></a></td>
        </tr>
    </table>

    <div class="buttons mrtop40" style="clear: both;">
        <a goto="?m=terminal&a=index_list" form="form" class="ajaxpost_t button normal">{"保存"|L}</a>
        <a class="goback button">{"取消"|L}</a>
    </div>
</form>

<!--导入流量卡-->
<form class="hide" id="tm_import" name="fileupdate" method="post" action="?"  enctype="multipart/form-data" target="hidden_frame">
    <input name="m" value="terminal" />
    <input name="a" value="importShellIMEI" />
    <input autocomplete="off"  name="step" type="text" value="if" />
    <input autocomplete="off"  id="tm_import_up" name="fileToUpload" type="file"  />
</form>

<!-- 流量卡数据检查 -->
<form class="hide" id="tm_ic" method="get" action="?"  target="hidden_frame">
    <input name="m" value="terminal" />
    <input name="a" value="importShellIMEI" />
    <input autocomplete="off"  name="step" type="text" value="ic" />
    <input name="f" type="hidden" />
</form>

<!-- 流量卡数据导入 -->
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