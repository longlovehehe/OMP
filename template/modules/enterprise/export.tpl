{strip}
{include file="modules/enterprise/nav.tpl" }
<h2 class="title">{"导入导出"|L}</h2>
<div class="info hide"></div>
<div class="block">
    <h3 class="title">{"企业用户"|L}</h3>
{*    <a id="uimport" class=" button" action="user">{"导入"|L}</a>*}
    <a class="export button" action="user">{"导出"|L}</a>
</div>
{*
<div class="info none">
    企业用户导入注意事项：<br />
    1、只能导入手机号用户
</div>

<div class="block">
    <h3 class="title">{"企业群组"|L}</h3>
    <a id="ptimport"  class=" button " action="ptt_group">{"导入"|L}</a>
    <a class="export button" action="ptt_group">{"导出"|L}</a>
</div>

<div class="block">
    <h3 class="title">{"企业部门"|L}</h3>
    <a id="ugimport" class=" button " action="user_group">{"导入"|L}</a>
    <a class="export button" action="user_group">{"导出"|L}</a>
</div>
<div class="info none">
    部门导入注意事项：<br />
    1、导入的EXCEL不要包含任何样式。例如加粗，设置字体，标色，设置超链接，电子邮箱等<br />
    2、数据遵守部门定义规则<br />
    · 名称只由字母，数字，汉字，下划线，.()#等内容组成<br />
    · 表格列不能超过6列<br />
    3、Excel格式为xls<br />
    4、导入时会先清空现有的部门结构，以及用户部门属性。<br />
    5、导入过程中不要做其它事，保持网络通畅<br />
    <br />
    已设置的异常<br />
    单元格第二行以下的名称不符合规范，包含 字母数字汉字下划线等以外的字符<br />
    总列数超出<br />
    重复的部门名称或部门ID<br />
    部门级数超过六级<br />
    没有选择上传的文件<br />
    超出服务器最大上传文件限制<br />
    未知的上传错误，网络连接不稳定，异常断开等<br />
    文件大小超过999999999，提示文件过大，中断上传<br />
    xls文件格式以外的格式<br />
    project/runtime/tmp/无可写权限或磁盘空间不够，文件创建失败<br />
    上传的文件被其它程序删除或锁定<br />
</div>


<!--导入 企业群组-->
<form class="hide" id="pt_import" name="fileupdate" method="post" action="?"  enctype="multipart/form-data" target="hidden_frame">
    <input name="m" value="enterprise" />
    <input name="a" value="importShellPT" />
    <input name="e_id" value="{$data.e_id}" />
    <input autocomplete="off"  name="step" type="text" value="if" />
    <input autocomplete="off"  id="pt_import_up" name="fileToUpload" type="file"  />
</form>

<!-- 群组数据检查 -->
<form class="hide" id="pt_ic" method="get" action="?"  target="hidden_frame">
    <input name="m" value="enterprise" />
    <input name="a" value="importShellPT" />
    <input name="e_id" value="{$data.e_id}" />
    <input autocomplete="off"  name="step" type="text" value="ic" />
    <input name="f" type="hidden" />
</form>

<!-- 群组数据导入 -->
<form class="hide" id="pt_i" method="get" action="?"  target="hidden_frame">
    <input name="m" value="enterprise" />
    <input name="a" value="importShellPT" />
    <input name="e_id" value="{$data.e_id}" />
    <input autocomplete="off"  name="step" type="text" value="i" />
    <input name="f" type="hidden" />
</form>
<!--/群组导入结束-->


<!--导入 企业用户-->
<form class="hide" id="user_import" name="fileupdate" method="post" action="?"  enctype="multipart/form-data" target="hidden_frame">
    <input name="m" value="enterprise" />
    <input name="a" value="importShellUser" />
    <input name="e_id" value="{$data.e_id}" />
    <input autocomplete="off"  name="step" type="text" value="if" />
    <input autocomplete="off"  id="user_import_up" name="fileToUpload" type="file"  />
</form>

<!-- 用户数据检查 -->
<form class="hide" id="u_ic" method="get" action="?"  target="hidden_frame">
    <input name="m" value="enterprise" />
    <input name="a" value="importShellUser" />
    <input name="e_id" value="{$data.e_id}" />
    <input autocomplete="off"  name="step" type="text" value="ic" />
    <input name="f" type="hidden" />
</form>

<!-- 用户数据导入 -->
<form class="hide" id="u_i" method="get" action="?"  target="hidden_frame">
    <input name="m" value="enterprise" />
    <input name="a" value="importShellUser" />
    <input name="e_id" value="{$data.e_id}" />
    <input autocomplete="off"  name="step" type="text" value="i" />
    <input name="f" type="hidden" />
</form>
<!--/用户导入结束-->



<!--导入 企业部门-->
<form class="hide" id="user_group_import" name="fileupdate" method="post" action="?m=enterprise&a=importShellUserGroup&e_id={$data.e_id}"  enctype="multipart/form-data" target="hidden_frame">
    <input autocomplete="off"  name="step" type="text" value="if" />
    <input autocomplete="off"  id="user_group_import_up" name="fileToUpload" type="file"  />
</form>

<!-- 部门数据检查 -->
<form class="hide" id="ug_ic" method="get" action="?"  target="hidden_frame">
    <input name="m" value="enterprise" />
    <input name="a" value="importShellUserGroup" />
    <input name="e_id" value="{$data.e_id}" />
    <input autocomplete="off"  name="step" type="text" value="ic" />
    <input name="f" type="hidden" />
</form>

<!-- 部门数据导入 -->
<form class="hide" id="ug_i" method="get" action="?"  target="hidden_frame">
    <input name="m" value="enterprise" />
    <input name="a" value="importShellUserGroup" />
    <input name="e_id" value="{$data.e_id}" />
    <input autocomplete="off"  name="step" type="text" value="i" />
    <input name="f" type="hidden" />
</form>
<!--/部门数据导入结束-->
*}
<!--输出台-->
<iframe id="ifr" name="hidden_frame"></iframe>
{/strip}