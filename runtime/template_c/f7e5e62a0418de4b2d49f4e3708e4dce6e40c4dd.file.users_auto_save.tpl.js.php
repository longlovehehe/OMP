<?php /* Smarty version Smarty-3.1.11, created on 2016-05-13 10:08:00
         compiled from "..\static\script\modules\enterprise\users_auto_save.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:269057353700b72d98-14226318%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7e5e62a0418de4b2d49f4e3708e4dce6e40c4dd' => 
    array (
      0 => '..\\static\\script\\modules\\enterprise\\users_auto_save.tpl.js',
      1 => 1427362536,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '269057353700b72d98-14226318',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57353700bf7ab8_86419192',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57353700bf7ab8_86419192')) {function content_57353700bf7ab8_86419192($_smarty_tpl) {?>var request = eval($("span.request").text());
var request = request[0];
var type = $("input:radio:checked").attr("value");
var e_mds_phone = $("input[name=e_mds_phone]").val();
var e_mds_dispatch = $("input[name=e_mds_dispatch]").val();
var e_mds_gvs = $("input[name=e_mds_gvs]").val();
//var msg = " 手机用户当前最大可输入" + e_mds_phone;

function next() {
    var step = parseInt($("input[name=step]").val());
    var u_auto_number = parseInt($("input[name=u_auto_number]").val());
    if (step < u_auto_number) {
        step++;
        $("input[name=step]").val(step);
        $("progress").attr("value", step);
        $("#u_step_text").text(step);
        $("#u_step_number_text").text(u_auto_number - step);
    }
}

$("#create").click(function () {
    if ($("#form").valid()) {
        var maxnumber = parseInt($("input[name=u_auto_pre]").val()) + parseInt($("input[name=u_auto_number]").val());
        if ($("#num_sure").html() != "") {

        } else {

            var mobile = /^1\d{10}$/;
            if (maxnumber > 99999 && !mobile.test(maxnumber)) {
                alert("<?php echo L('添加的用户数量超过企业总数量');?>
！");
            } else {
                $("#form").hide(222);
                $("progress").attr("max", parseInt($("input[name=u_auto_number]").val()));
                $(".info_text").removeClass("hide");
                var step = parseInt($("input[name=step]").val());
                var u_auto_number = parseInt($("input[name=u_auto_number]").val());
                if (step < u_auto_number) {
                    step++;
                    $("input[name=step]").val(step);
                    $("progress").attr("value", step);
                    $("#u_step_text").text(step);
                    $("#u_step_number_text").text(u_auto_number - step);
                    $("#form").submit();
                }
            }
        }
    }
});
(function () {
    function utypeedit(cur) {

        $("div.sw").hide();
        if (cur == "<?php echo L('手机用户');?>
") {
            $("input[name=u_auto_pre]").removeAttr("u_number_shell").attr("u_number", "TRUE");
            $("div.user").show();
        }
        if (cur == "<?php echo L('调度台用户');?>
") {
            $("input[name=u_auto_pre]").removeAttr("u_number").attr("u_number_shell", "TRUE");
            $("div.shelluser").show();
            $("input[name=u_auto_config][value=0]").trigger("click");
        }
        if (cur == "<?php echo L('GVS用户');?>
") {
            $("input[name=u_auto_pre]").removeAttr("u_number").attr("u_number_shell", "TRUE");
            $("div.gvsuser").show();
        }
    }
    $("#radioset>label").bind("click", function () {
        utypeedit($(this).text());
    });
    utypeedit("<?php echo L('手机用户');?>
");
})();
jQuery.validator.addMethod("resource_less", function (value, element) {
    var flag = false;
    if (value == 0) {
        flag = true;
    }
    return flag;
}, "<?php echo L('该资源已用完，只能输入0');?>
");
$("input:radio.checked_radio").bind("click", function () {
    type = $("input:radio:checked").attr("value");
    $("#num_sure").text("");
    var val = $("input[name=u_auto_number]").val();
    if (type == 1 && (val > e_mds_phone || val == "")) {
        msg = " <?php echo L('可用手机用户数为');?>
 " + e_mds_phone;
        $("#num_sure").text("");
        $("#num_sure").text(msg);
    }
    if (type == 2 && (val > e_mds_dispatch || val == "")) {
        msg = " <?php echo L('可用调度台用户数为');?>
 " + e_mds_dispatch;
        $("#num_sure").text(msg);
    }
    if (type == 3 && (val > e_mds_gvs || val == "")) {
        msg = " <?php echo L('可用GVS用户数为');?>
 " + e_mds_gvs;
        $("#num_sure").text("");
        $("#num_sure").text(msg);
    }

});

(function () {
    $("input[name=u_auto_config]").bind("click", function () {
        var autoc = $(this).val();
        if (autoc == 1) {
            $("div.auto_config").show();
        } else {
            $("div.auto_config").hide();
        }
    });
})();
$("input[name=u_auto_number]").bind("change", function () {
    var val = $("input[name=u_auto_number]").val();
    var match = /^[0]+$/;
    if (match.test(val)) {
        $("input[name=u_auto_number]").val(1);
    }
    if (type == 1) {
        if (e_mds_phone == 0) {
            msg = " <?php echo L('可用手机用户数为');?>
 " + e_mds_phone;
            $("#num_sure").text("");
            $("#num_sure").text(msg);
        } else if (e_mds_phone - val < 0 || val.length == 0) {
            msg = " <?php echo L('可用手机用户数为');?>
 " + e_mds_phone;
            $("#num_sure").text("");
            $("#num_sure").text(msg);
        } else if (e_mds_phone - val >= 0) {
            $("#num_sure").text("");
        }
    } else if (type == 2) {
        if (e_mds_dispatch == 0) {
            msg = " <?php echo L('可用调度台用户数为');?>
 " + e_mds_dispatch;
            $("#num_sure").text("");
            $("#num_sure").text(msg);
        } else if (e_mds_dispatch - val < 0 || val.length == 0) {
            msg = " <?php echo L('可用调度台用户数为');?>
 " + e_mds_dispatch;
            $("#num_sure").text("");
            $("#num_sure").text(msg);
        } else if (e_mds_dispatch - val >= 0) {
            $("#num_sure").text("");
        }
    } else if (type == 3) {
        if (e_mds_gvs == 0) {
            msg = " <?php echo L('可用GVS用户数为');?>
 " + e_mds_gvs;
            $("#num_sure").text("");
            $("#num_sure").text(msg);
        } else if (e_mds_gvs - val < 0 || val.length == 0) {
            msg = " <?php echo L('可用GVS用户数为');?>
 " + e_mds_gvs;
            $("#num_sure").text("");
            $("#num_sure").text(msg);
        } else if (e_mds_gvs - val >= 0) {
            $("#num_sure").text("");
        }
    }
});
jQuery.validator.addMethod("u_number_shell", function (value, element) {
    var flag = false;
    if (value >= 20000 && value <= 69999) {
        flag = true;
    }
    return flag;
}, "<?php echo L('用户号码格式错误【填写20000 至 69999之间的数字】');?>
");
jQuery.validator.addMethod("u_number", function (value, element) {
    var length = value.length;
    var flag = false;
    /*var mob = /^(13[0-9]|15[0|3|6|7|8|9]|18[6|8|9])\d{8}$/;*/
    var mob = /^1\d{10}$/;
    if (length == 11 && mob.test(value)) {
        flag = true;
    } else if (value >= 20000 && value <= 69999) {
        flag = true;
    }
    return flag;
}, "<?php echo L('用户号码格式错误【填写手机号或者20000 至 69999之间的数字】');?>
");
/*
 jQuery.validator.addMethod("u_auto_number", function (value, element) {
 var flag = true;
 //type = $("input:radio:checked").attr("value");
 console.log(type);
 if (type == 1 && value > e_mds_phone) {
 $("#num_sure").addClass("none");
 flag = false;
 } else if (type == 2 && value > e_mds_dispatch) {
 $("#num_sure").addClass("none");
 flag = false;
 } else if (type == 3 && value > e_mds_gvs) {
 $("#num_sure").addClass("none");
 flag = false;
 } else {
 return flag;
 }
 }, msg);
 */
<?php }} ?>