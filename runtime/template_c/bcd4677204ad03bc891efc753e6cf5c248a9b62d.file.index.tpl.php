<?php /* Smarty version Smarty-3.1.11, created on 2016-05-20 15:32:52
         compiled from "..\template\modules\announcement\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5655573ebda49b40a9-85513363%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bcd4677204ad03bc891efc753e6cf5c248a9b62d' => 
    array (
      0 => '..\\template\\modules\\announcement\\index.tpl',
      1 => 1426926377,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5655573ebda49b40a9-85513363',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_573ebda4b139f0_91646031',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_573ebda4b139f0_91646031')) {function content_573ebda4b139f0_91646031($_smarty_tpl) {?>
<h2 class="title"><?php echo L(((string)$_smarty_tpl->tpl_vars['title']->value));?>
</h2>
<div class="toptoolbar">
    <a href="?m=announcement&a=an_add" class="button orange"><?php echo L("发布公告");?>
</a>
</div>

<form id="form" action="?m=announcement&a=index_item" method="post">
    <div class="toolbar">
        <input autocomplete="off"  name="modules" value="announcement" type="hidden" />
        <input autocomplete="off"  name="action" value="index_item" type="hidden" />
        <input autocomplete="off"  name="page" value="0" type="hidden" />

        <div class="line">
            <label><?php echo L("公告标题");?>
：</label>
            <input autocomplete="off"  class="autosend" name="an_title" type="text" />
        </div>
        <?php if ($_SESSION['own']['om_id']=='admin'){?><div class="line">
            <label><?php echo L("发布人");?>
：</label>
            <input autocomplete="off"  class="autosend" name="an_user" type="text" />
        </div><?php }?>
        <div class="line">
            <label><?php echo L("发布状态");?>
：</label>
            <select name="an_status">
                <option value=""><?php echo L("全部");?>
</option>
                <option value="1"><?php echo L("已发布");?>
</option>
                <option value="0"><?php echo L("草稿");?>
</option>
            </select>
        </div>
        <div class="line">
            <label><?php echo L("可见区域");?>
：</label>
            <select value='#' name="an_area" class="autofix" action="?m=area&a=option">
                <option value="#"><?php echo L("全部");?>
</option>
            </select>
        </div>
        <div class="line">
            <label><?php echo L("发布时间");?>
：</label>
            <input autocomplete="off"  class="datepicker start" name="start" type="text" date="true" />
            <span>-</span>
            <input autocomplete="off"  class="datepicker end" name="end" type="text" date="true" />
        </div>
        <div class="buttons right">
            <a form="form" class="button submit"><?php echo L("查询");?>
</a>
        </div>
    </div>
</form>

<div class="content"></div>
<div id="dialog-confirm" class="hide" title="<?php echo L('删除选中项');?>
？">
    <p><?php echo L("确定要删除该公告吗");?>
？</p>
</div>
<script <?php echo "type='ready'";?>
>
    $('nav a.announcement').addClass('active');
            $(document).ready(function () {
    $("div.content").delegate("#del", "click", function () {
    var id = $(this).attr("data");
            $("#dialog-confirm").dialog({
    resizable: false,
            height: 180,
            modal: true,
            buttons: {
            "<?php echo L("删除");?>
": function () {
            $(this).dialog("close");
                    notice("<?php echo L("正在删除");?>
");
                    $.ajax({
                    url: "?modules=announcement&action=an_del",
                            data: "id=" + id,
                            success: function (result) {
                            if (result == 0) {
                            notice("<?php echo L("没有记录被删除。非停用状态企业无法直接删除");?>
");
                            } else {
                            notice("<?php echo L("成功删除");?>
 " + result + " <?php echo L("记录");?>
");
                            }
                            setTimeout(function () {
                            send("prev");
                            }, 888);
                            }
                    });
            },
                    "<?php echo L("取消");?>
": function () {
                    $(this).dialog("close");
                    }
            }
    });
    });
    })
</script>
<?php }} ?>