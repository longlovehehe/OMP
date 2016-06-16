<?php /* Smarty version Smarty-3.1.11, created on 2016-05-21 18:23:36
         compiled from "..\static\script\modules\enterprise\users_save.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:1709057403728d75a18-63416297%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84eddc3dfb46059aa47d300ba07272ed86b55715' => 
    array (
      0 => '..\\static\\script\\modules\\enterprise\\users_save.tpl.js',
      1 => 1454038385,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1709057403728d75a18-63416297',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57403728f07ff8_79553839',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57403728f07ff8_79553839')) {function content_57403728f07ff8_79553839($_smarty_tpl) {?>var request = eval($("span.request").text());
var request = request[0];
var e_id = request.e_id;

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
jQuery.validator.addMethod("u_number_shell", function (value, element) {
    var flag = false;
    if (value >= 20000 && value <= 69999) {
        flag = true;
    }
    return flag;
}, "<?php echo L('用户号码格式错误【填写20000 至 69999之间的数字】');?>
");

jQuery.validator.addMethod("u_number1", function (value, element) {
    var length = value.length;
    var flag = false;
    /*var mob = /^(13[0-9]|15[0|3|6|7|8|9]|18[6|8|9])\d{8}$/;*/
    var mob = /^1\d{10}$/;
    if (length == 11 && mob.test(value)) {
        flag = true;
    } else if (value >= parseInt(e_id+"20000") && value <= parseInt(e_id+"69999")) {
        flag = true;
    }
    return flag;
}, "<?php echo L('用户号码格式错误');?>
");
jQuery.validator.addMethod("u_number_shell1", function (value, element) {
    var flag = false;
    if (value >= parseInt(e_id+"20000") && value <= parseInt(e_id+"69999")) {
        flag = true;
    }
    return flag;
}, "<?php echo L('用户号码格式错误');?>
");



jQuery.validator.addMethod("u_name", function (value, element) {
    var chinese = /^([\u4e00-\u9fa5]|[a-zA-Z0-9\.])+$/;
    return this.optional(element) || (chinese.test(value));
}, "<?php echo L('名称中包含不可用字符');?>
");


function callback(result) {
    if (result.status == 0) {
        notice("<?php echo L('上传成功');?>
");
        $("img.face").attr("src", '?m=enterprise&a=users_face_item&pid=' + result.msg);
        $("input[name=u_pic]").val(result.msg);
        $("#fileToUpload").val("");
        $("#file_name_text").text("");
    } else {
        notice(result.msg);
    }
}

(function () {
    $("#fileToUploadT").click(function () {
        $("#fileToUpload").trigger("click");
    });
    $("#upload").click(function () {
        if ($("#fileToUpload").val() == "") {
            notice("<?php echo L('请选择文件');?>
");
        } else {
            $("#uppic").trigger('click');
            notice("<?php echo L('上传中');?>
");
        }
    });
})();

(function () {
    var request = eval($("span.request").text());
    var request = request[0];
    if (request.d == 'edit') {
        function utypeedit(cur) {
            $('div.sw').hide();
            if (cur == "<?php echo L('手机用户');?>
") {
                $("input[name=u_number]").removeAttr("u_number_shell1").attr("u_number1", "TRUE");
                $('div.user').show();
            }
            if (cur == "<?php echo L('调度台用户');?>
") {
                $("input[name=u_number]").removeAttr("u_number1").attr("u_number_shell1", "TRUE");
                $('div.shelluser').show();
                $("input[name=u_auto_config][value=0]").trigger("click");
            }
            if (cur == "<?php echo L('GVS用户');?>
") {
                $("input[name=u_number]").removeAttr("u_number1").attr("u_number_shell1", "TRUE");
                $('div.gvsuser').show();
            }
        }
        $("#radioset>label").bind('click', function () {
            utypeedit($(this).text());
        });
        var ctypearr = Array();
        ctypearr[1] = "<?php echo L('手机用户');?>
";
        ctypearr[2] = "<?php echo L('调度台用户');?>
";
        ctypearr[3] = "<?php echo L('GVS用户');?>
";
        utypeedit(ctypearr[$("#radioset").attr("value")]);
    } else {
        function utype(cur) {
            $('div.sw').hide();
            if (cur == "<?php echo L('手机用户');?>
") {
                $("input[name=u_number]").removeAttr("u_number_shell").attr("u_number", "TRUE");
                $('div.user').show();
            }
            if (cur == "<?php echo L('调度台用户');?>
") {
                $("input[name=u_number]").removeAttr("u_number").attr("u_number_shell", "TRUE");
                $('div.shelluser').show();
                $("input[name=u_auto_config][value=0]").trigger("click");
            }
            if (cur == "<?php echo L('GVS用户');?>
") {
                $("input[name=u_number]").removeAttr("u_number").attr("u_number_shell", "TRUE");
                $('div.gvsuser').show();
            }
        }
        $("#radioset>label").bind('click', function () {
            utype($(this).text());
        });
        var ctypearr = Array();
        ctypearr[1] = "<?php echo L('手机用户');?>
";
        ctypearr[2] = "<?php echo L('调度台用户');?>
";
        ctypearr[3] = "<?php echo L('GVS用户');?>
";
        utype(ctypearr[$("#radioset").attr("value")]);
    }
})();
(function () {
    $("input[name=u_auto_config]").bind("click", function () {
        var autoc = $(this).val();
        $("input[name=auto_config]").val(autoc);
        if (autoc == 1) {
            u_auto_config.eq(0).attr("checked","checked");
            u_auto_config.eq(1).attr("checked",false);
            $('div.auto_config').show();
        } else {
            u_auto_config.eq(1).attr("checked","checked");
            u_auto_config.eq(0).attr("checked",false);
            layer.closeAll("tips");
            $('div.auto_config').hide();
        }
    });
})();
$("input[name=u_mobile_phone]").attr("u_mobile", "TRUE");
$("input[name=u_mobile_phone]").attr("u_mobile_phone", "TRUE");
var u_number=$("input[name=u_number]").val();
/*jQuery.validator.addMethod("u_mobile", function (value, element) {
    var length = value.length;
    var flag = false;
    var mob = /^\d{7,11}$/;
    if ( mob.test(value) || length == 0) {
          $.ajax({
            url:'?m=enterprise&a=getmob&u_number='+u_number,
            data:{u_mobile_phone:value,e_id:e_id},
            success:function(res){
                if(res==2){
                    flag = false;
                }else{
                    flag = true;
                }
            }
        });
    }
    return flag;
}, "<?php echo L('此手机号已经存在');?>
");*/
$("input[name=u_udid]").attr("udid", "TRUE");
$("input[name=u_udid]").attr("u_udid", "TRUE");
jQuery.validator.addMethod("udid", function (value, element) {
    var length = value.length;
    var flag = false;
    var mob = /^\s*$|^(?!(?:\d+|[a-zA-Z]+)$)[\da-zA-Z]{40}$/i;
    if ((length == 0 && mob.test(value)) || (length == 40 && mob.test(value))) {
         $.ajax({
            url:'?m=enterprise&a=getudid&u_number='+u_number,
            data:{u_udid:value},
            success:function(res){
                if(res==2){
                    flag = false;
                }else{
                    flag = true;
                }
            }
        });
    }
    return flag;
}, "<?php echo L('此UDID已存在');?>
");
$("input[name=u_imsi]").attr("imsi", "TRUE");
$("input[name=u_imsi]").attr("u_imsi", "TRUE");
/*jQuery.validator.addMethod("imsi", function (value, element) {
    var length = value.length;
    var flag = false;
    var mob = /^\s*$|^[0-9]{15}$/i;
    if ((length == 0 && mob.test(value)) || (length == 15 && mob.test(value))) {
         $.ajax({
            url:'?m=enterprise&a=getimsi&u_number='+u_number,
            data:{u_imsi:value,e_id:e_id},
            success:function(res){
                if(res==2){
                    flag = false;
                }else{
                    flag = true;
                }
            }
        });
    }
    return flag;
}, "<?php echo L('此IMSI已存在');?>
");*/
//$("input[name=u_imei]").attr("imei", "TRUE");
$("input[name=u_imei]").attr("u_imei", "TRUE");
//jQuery.validator.addMethod("imei", function (value, element) {
//    var length = value.length;
//    var flag = false;
//    var mob = /^\s*$|^[0-9]{15}$/i;
//    if ((length == 0 && mob.test(value)) || (length == 15 && mob.test(value))) {
//        flag = true;
//    }
//    return flag;
//}, "<?php echo L('此IMEI已存在');?>
");
//$("input[name=u_iccid]").attr("iccid", "TRUE");
$("input[name=u_iccid]").attr("u_iccid", "TRUE");
/*jQuery.validator.addMethod("iccid", function (value, element) {
    var length = value.length;
    var flag = false;

    var mob = /^\s*$|^\d{19}$|^\d{20}$/i;
    if (mob.test(value)) {
         $.ajax({
            url:'?m=enterprise&a=geticcid&u_number='+u_number,
            data:{u_iccid:value,e_id:e_id},
            success:function(res){
                if(res==2){
                    flag = false;
                }else{
                    flag = true;
                }
            }
        });
    }
    return flag;
}, "<?php echo L('此ICCID已存在');?>
");*/

//-----------------
$("input[name=u_mac]").attr("mac", "TRUE");
$("input[name=u_mac]").attr("u_mac", "TRUE");
jQuery.validator.addMethod("mac", function (value, element) {
    var length = value.length;
    var flag = false;
    var mob = /^\s*$|[A-F\d]{2}[A-F\d]{2}[A-F\d]{2}[A-F\d]{2}[A-F\d]{2}[A-F\d]{2}/i;
    if (length == 12 && mob.test(value) || length == 0) {
        $.ajax({
            url:'?m=enterprise&a=getmac&u_number='+u_number,
            data:{u_mac:value},
            success:function(res){
                if(res==2){
                    flag = false;
                }else{
                    flag = true;
                }
            }
        });
    }
    return flag;
}, "<?php echo L('此MAC已存在');?>
");

function confirm2(notice) {
    var id = "notice_" + new Date().getTime();
    $("div.notice_mask").remove();
    $notice_mask = $("<div class='notice_mask sync '></div>");
    $notice_content = $("<div class='notice_content animated fadeIn'></div>");
    $notice = $("<div class='notice'></div>");
    $notice_mask.attr("id", id);
    $notice.html(notice);
    $notice_content.append($notice);
    $toolbar1 = $("<div style='float:right' class='toolbar'><a class='button cancel notransition'><?php echo L('取消');?>
</a></div>");
    $toolbar = $("<div  class='toolbar'><a class='button determine notransition'><?php echo L('确定');?>
</a></div>");
    $notice_content.append($toolbar1);
    $notice_content.append($toolbar);
    $notice_mask.append($notice_content);
    $("body").append($notice_mask);
    $("#" + id + " div.notice_content").draggable({containment: "parent"});


    $("#" + id + " a.determine").bind("click", function () {
        con = $("a.determine").html();
        $("#" + id).remove();
        saveGVSuser();

    });
    $("#" + id + " a.cancel").bind("click", function () {
        con = $("a.cancel").html();
        $("#" + id).remove();
    });

    return con;
}
/**
 * Comment
 */
function saveGVSuser() {
    var data = $("#form").serialize();
    $.ajax({
        url: '?modules=enterprise&action=saveGVS&e_id=' + e_id,
        data: data,
        dataType: 'json',
        success: function (result) {
            notice(result.msg,$("a.ajaxpost_u").attr("goto"));
        }
    });
}

function getFiles(obj) {
    document.fileupdate.path.value = obj.value;
}
/*
$("input[name=u_mobile_phone]").on("input",function(){
    var mob=$("input[name=u_mobile_phone]").val();
    var mobile = /^1\d{10}$/;
    var length = mob.length;
    if(length == 11 && mobile.test(mob)){
           $.ajax({
            url:'?m=enterprise&a=getmob',
            data:{u_mobile_phone:mob},
            success:function(res){
                if(res=="nnn"){
                    notice("此手机号已经存在");
                }
            }
        });
    }
});
*/
/**
 * 是否绑定手机
 * 
 * 
 */
var u_bind_phone=$("input[name=u_bind_phone]:checked").val();
if(u_bind_phone==1){
        $("input[name=u_terminal_number]").attr("readonly","readonly");
        $("input[name=u_iccid]").attr("required", "true");
        $("input[name=u_imei]").attr("required", "true");
        $("input[name=u_iccid]").focus();
        $("input[name=u_imei]").focus();
}else{
        $("input[name=u_iccid]").removeAttr("required");
        $("input[name=u_imei]").removeAttr("required");
}
$("input[name=u_bind_phone]").bind('change',function(){
    u_bind_phone=$("input[name=u_bind_phone]:checked").val();
    if(u_bind_phone==1){
        $("input[name=u_terminal_number]").attr("readonly","readonly");
        $("input[name=u_iccid]").attr("required", "true");
        $("input[name=u_imei]").attr("required", "true");
        $("input[name=u_iccid]").focus();
        $("input[name=u_imei]").focus();
        valid();
    }else{
        if( $("select[name=u_terminal_type]").val()==""){
            $("input[name=u_terminal_number]").removeAttr("readonly");
            $("input[name=u_imei]").removeAttr("required");
        }
       $("input[name=u_iccid]").removeAttr("required");
        valid();
    }
});
/**
 * 计算选中功能价格
 */
$("#selectprice option:selected").each(function(){
        var price=0; 
        price += parseFloat($(this).attr("title")); 
        $("#price").html(price);
});
$("#selectprice").change(function(){
     var price=0;
    $("#selectprice option:selected").each(function(){
        price += parseFloat($(this).attr("title")); 
        $("#price").html(price);
    });
});
/**
 * 填写号码不能为自身号码
 */

jQuery.validator.addMethod("u_alarm_inform_svp_num", function (value, element) {
    var flag = true;
    var length=value.length;
    if(length==11){
    if($("input[name=do]").val()=="edit"){
        if (value ==$("input[name=u_number]").val()&&value!="") {
            flag = false;
        }
    }else{
        if (value ==(e_id+$("input[name=u_number]").val())&&value!="") {
            flag = false;
        }
    }
}
    return flag;
}, "<?php echo L('所填号码不能是自己');?>
");
/**
 * 填写号码不能为自身号码
 */

jQuery.validator.addMethod("check_number", function (value, element) {
    var flag = false;
    var length=value.length;
    $.ajax({
        url:'?modules=enterprise&action=check_number',
        data:{e_id:e_id,u_number:value},
        success:function(res){
            if(res=="1"&&length==11||value==""){
                flag=true;
            }
        }
    });
    return flag;
}, "<?php echo L('该号码不存在');?>
");
/*
    var product=$("div.autocheck").attr("value");
    product =eval('(' + product + ')');
    for(var i=0;i<product.length;i++){
        $("div.autocheck label.autocheck div input").each(function () {
                    var val = $(this).attr("value");
                    if(val==product[i]){
                        $(this).attr("checked", "checked");
                    }
                //$(this).buttonset();
            });
    }*/
var globals="selected";
$("select[name=u_alarm_inform_svp_num] option").each(function(){
    if($(this).val()==$("select[name=u_alarm_inform_svp_num]").val()){
        globals=$(this).val();
    }
});
if(globals=="selected"){
    //$("select[name=u_alarm_inform_svp_num]").val()="@";
    $("select[name=u_alarm_inform_svp_num] option").each(function(){
    if($(this).val()=="@"){
        $(this).attr("selected","selected");
        $("input[name=u_alarm_inform_svp_num]").removeClass('none');
    }
});
}else{
    $("input[name=u_alarm_inform_svp_num]").val(globals);
}
if($("input[name=do]").val()=="edit"){
    var u_product_id = $("select[name=u_product_id]").val();
    var u_product_id_new = $("input[name=u_product_id_new]").val();
    if(u_product_id_new!=""){
        $("input[name=isused]").attr("checked","checked");
        $("div.show_info").addClass("none");
    }else{
        $("input[name=isused]").removeAttr("checked");
         $("div.show_info").addClass("none");
    }
    $("input[name=isused]").on("click",function(){
        if($("input[name=isused]").is(":checked")){
                if(u_product_id_new!=""){
                    $("div.show_info").removeClass("none");
                }
                u_product_id_new=$("select[name=u_product_id] option:selected").val();
                $("input[name=u_product_id_new]").val(u_product_id_new);
                //$("select[name=u_product_id]").val(u_product_id);
        }else{
                $("div.show_info").addClass("none");
                $("input[name=u_product_id_new]").val("");
        }
    });

$("select[name=u_product_id]").on("change",function(){
    var select_val=$(this).val();
    if(select_val==u_product_id){
        $("div.show_info").addClass("none");
    }else{
        if(!$("input[name=isused]").is(":checked")){
            $("input[name=u_product_id_new]").val("");
        }else{
            var index=layer.confirm("<?php echo L('产品被修改，次月生效');?>
",{btn: ["<?php echo L('确定');?>
", "<?php echo L('取消');?>
"],title:"<?php echo L('产品修改');?>
"},function(){
                  $.ajax({
                      url:"?m=product&a=get_product_name",
                      data:{u_product_id_new:select_val},
                      success:function(res){
                          if(res=="noselected"){
                              $("a.show_product_new").html("<?php echo L('暂无选择');?>
");
                              $("input[name=u_product_id_new]").val("noselected");
                              $("div.show_info").removeClass("none");
                              $("span.product_new").removeClass("none");
                              $("select[name=u_product_id]").val(u_product_id);
                              //$("input[name=u_product_id_new]").val(select_val);
                          }else{
                              $("a.show_product_new").html(res);
                              $("div.show_info").removeClass("none");
                              $("span.product_new").removeClass("none");
                              $("select[name=u_product_id]").val(u_product_id);
                              $("input[name=u_product_id_new]").val(select_val);
                          }
                      }
                  });
                              layer.close(index);
             });
                    $("select[name=u_product_id]").val(u_product_id);
        }

    }

});

$("a.delete").on('click',function(){
    $("div.show_info").addClass("none");
    $("span.product_new").addClass("none");
    $("input[name=u_product_id_new]").val("");
});
 if(u_product_id_new==""){
        $("div.show_info").addClass("none");
        $("span.product_new").addClass("none");
        }else{
            $.ajax({
                url:"?m=product&a=get_product_name",
                data:{u_product_id_new:u_product_id_new},
                success:function(res){

                if(res=="noselected"){
                    $("a.show_product_new").html("<?php echo L('暂无选择');?>
");
                    //$("input[name=u_product_id_new]").val("noselected");
                    $("div.show_info").removeClass("none");
                    $("span.product_new").removeClass("none");
                    $("select[name=u_product_id]").val(u_product_id);
                }else{
                    $("a.show_product_new").html(res);
                    $("div.show_info").removeClass("none");
                    $("span.product_new").removeClass("none");
                    $("select[name=u_product_id]").val(u_product_id);
                }
            }
        });
    }
}


/**
 * 选择终端类型 来判断是否打开自动登录开关
 */
$("select[name=u_terminal_type]").on("change",function(){
    var u_terminal_type=$("select[name=u_terminal_type]").val();
    if(u_terminal_type!=""){
        $("input[name=u_terminal_number]").attr("readonly","readonly");
        $("input[name=md_type]").val(u_terminal_type);
        $("input[name=u_auto_config][value=1]").trigger("click");
        $("input[name=u_auto_config][value=0]").attr("disabled","");
        $("input[name=u_imei]").blur();
        check_imei();
        $("input[name=u_imei]").attr("required","true");
        $("input[name=u_imei]").focus();
        valid();
//        valid();
    }else{
        if($("input[name=u_bind_phone]:checked").val()=="0"){
            $("input[name=u_terminal_number]").removeAttr("readonly");
        }
        $("input[name=md_type]").val("");
        $("input[name=u_imei]").removeAttr("required");
        $("input[name=u_auto_config][value=0]").removeAttr("disabled","");
        $("input[name=u_imei]").blur();
        //$("input[name=u_auto_config][value=0]").prop("checked","checked");
        $("input[name=u_auto_config][value=0]").trigger("click");
        layer.closeAll("tips");
    }
});

if($("input[name=md_type]").val()!=""){
     $("input[name=u_auto_config][value=1]").trigger("click");
        $("input[name=u_auto_config][value=0]").attr("disabled","");
        $("input[name=u_imei]").attr("required","true");
        $("input[name=u_imei]").focus();
        valid();
}


/**
 * 验证imei 是否符合规则
 * @returns {undefined}
 */
function check_imei(){
            var u_imei=$("input[name=u_imei]").val();
            var md_type=$("input[name=md_type]").val();
            if(md_type!=""){
                var u_terminal_type="&u_terminal_type="+md_type;
                $("input[name=u_imei]").attr("required","true");
            }else{
                var u_terminal_type="";
            }
            if(md_type!=""&&u_imei==""){
                $("input[name=u_terminal_number]").val("");
            }
                $.ajax({
                    url:'?m=enterprise&a=getimei&e_id='+$("input[name=e_id]").val()+'&u_number='+$("input[name=u_number]").val()+u_terminal_type,
                    data:{u_imei:$("input[name=u_imei]").val(),e_id:e_id,u_bind_phone:$("input[name=u_bind_phone]:checked").val()},
                    success:function(res){
                        if(res==2){
                            $("input[name=imei_flag]").val("Error");
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").attr("aria-required","true");
                            $("input[name=u_imei]").attr("aria-invalid","true");

                            layer.tips("<?php echo L('此IMEI已存在');?>
",$("input[name=u_imei]"),{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            $("input[name=u_imei]").focus();
                            
                        }else if(res==1){
                            $("input[name=imei_flag]").val("OK");
                            $("input[name=u_imei]").removeClass("error");
                            $("input[name=imei_stat]").val(res);
                            layer.closeAll('tips');
                        }else if(res==3){
                            $("input[name=imei_flag]").val("Error");
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").addClass("error");
                            $("input[name=u_imei]").attr("aria-required","true");
                            $("input[name=u_imei]").attr("aria-invalid","true");
                            $("input[name=u_imei]").focus();
                            layer.tips("<?php echo L('IMEI已绑定， 请确认后重新输入');?>
",$("input[name=u_imei]"),{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }else if(res==4){
                            $("input[name=imei_flag]").val("Error");
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").addClass("error");
                            $("input[name=u_imei]").attr("aria-required","true");
                            $("input[name=u_imei]").attr("aria-invalid","true");
                            $("input[name=u_imei]").focus();
                            layer.tips("<?php echo L('所填IMEI不正确，请检查所选终端类型与IMEI后重新输入');?>
"+",code 102",$("input[name=u_imei]"),{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }else if(res==5){
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").removeClass("error");
                            $("input[name=imei_flag]").val("OK");
                            layer.closeAll('tips');
                        }else if(res=="isnull"){
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").removeClass("error");
                            $("input[name=imei_flag]").val("OK");
                            layer.closeAll('tips');
                        }else if(res=="issame"){
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").removeClass("error");
                            $("input[name=imei_flag]").val("OK");
                            layer.closeAll('tips');
                        }else if(res==7){
                            $("input[name=imei_flag]").val("Error");
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").addClass("error");
                            $("input[name=u_imei]").attr("aria-required","true");
                            $("input[name=u_imei]").attr("aria-invalid","true");
                            $("input[name=u_imei]").focus();
                            layer.tips("<?php echo L('所填IMEI不正确，请检查所选终端类型与IMEI后重新输入');?>
"+",code 103",$("input[name=u_imei]"),{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }else if(res==8){
                            $("input[name=imei_flag]").val("Error");
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").addClass("error");
                            $("input[name=u_imei]").attr("aria-required","true");
                            $("input[name=u_imei]").attr("aria-invalid","true");
                            $("input[name=u_imei]").focus();
                            layer.tips("<?php echo L('所填IMEI不正确，请检查所选终端类型与IMEI后重新输入');?>
"+",code 101",$("input[name=u_imei]"),{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }else{
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").addClass("error");
                            $("input[name=imei_flag]").val("Error");
                        }
                    }
                });
         if(md_type!=""){
             $.ajax({
                         url:"?m=terminal&a=getById_foruser",
                         data:{md_imei:u_imei},
                         success:function(result){
                             //var result=eval(res);
                             var res = eval("("+result+")");
                            $("input[name=u_terminal_number]").val(res.md_serial_number);
                            $("input[name=u_terminal_number]").blur();
                         }
                    });
//            if($("input[name=u_terminal_number]").val()==""&&u_imei!=""){
//                     $.ajax({
//                       url:"?m=terminal&a=getById_foruser",
//                       data:{md_imei:u_imei},
//                       success:function(result){
//                           //var result=eval(res);
//                           var res = eval("("+result+")");
//                            if($("input[name=u_terminal_number]").val()!=res.md_serial_number&&res.md_serial_number!=""){
//                                $("input[name=imei_flag]").val("Error");
//                                $("input[name=u_terminal_number]").removeClass("valid");
//                                $("input[name=u_terminal_number]").addClass("error");
//                                $("input[name=u_terminal_number]").attr("aria-required","true");
//                                $("input[name=u_terminal_number]").attr("aria-invalid","true");
//                               layer.tips("<?php echo L('终端序列号与IMEI不符');?>
",$("input[name=u_terminal_number]"),{
//                                       tips:[1, '#A83A3A'],
//                                       time:600000
//                                   });
//                               exit();
//                           }
//                       }
//                   });
//                }else{
//                     
//                }
            }
        }

/**
 * 失去焦点 验证imei 是否符合规则
 * @returns {undefined}
 */
function check_imei_blur(){
            var u_imei=$("input[name=u_imei]").val();
            var md_type=$("input[name=md_type]").val();
            if(md_type!=""){
                var u_terminal_type="&u_terminal_type="+md_type;
                $("input[name=u_imei]").attr("required","true");
                valid();
            }else{
                var u_terminal_type="";
            }
            if(md_type!=""&&u_imei==""){
                $("input[name=u_terminal_number]").val("");
            }
                $.ajax({
                    url:'?m=enterprise&a=getimei&e_id='+$("input[name=e_id]").val()+'&u_number='+$("input[name=u_number]").val()+u_terminal_type,
                    data:{u_imei:$("input[name=u_imei]").val(),e_id:e_id,u_bind_phone:$("input[name=u_bind_phone]:checked").val()},
                    success:function(res){
                        if(res==2){
                            $("input[name=imei_flag]").val("Error");
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").attr("aria-required","true");
                            $("input[name=u_imei]").attr("aria-invalid","true");
                            layer.tips("<?php echo L('此IMEI已存在');?>
",$("input[name=u_imei]"),{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            
                        }else if(res==1){
                            $("input[name=imei_flag]").val("OK");
                            $("input[name=u_imei]").removeClass("error");
                            $("input[name=imei_stat]").val(res);
                            layer.closeAll('tips');
                        }else if(res==3){
                            $("input[name=imei_flag]").val("Error");
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").addClass("error");
                            $("input[name=u_imei]").attr("aria-required","true");
                            $("input[name=u_imei]").attr("aria-invalid","true");
                            layer.tips("<?php echo L('IMEI已绑定， 请确认后重新输入');?>
",$("input[name=u_imei]"),{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }else if(res==4){
                            $("input[name=imei_flag]").val("Error");
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").addClass("error");
                            $("input[name=u_imei]").attr("aria-required","true");
                            $("input[name=u_imei]").attr("aria-invalid","true");
                            layer.tips("<?php echo L('所填IMEI不正确，请检查所选终端类型与IMEI后重新输入');?>
"+",code 102",$("input[name=u_imei]"),{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }else if(res==5){
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").removeClass("error");
                            $("input[name=imei_flag]").val("OK");
                            layer.closeAll('tips');
                        }else if(res=="isnull"){
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").removeClass("error");
                            $("input[name=imei_flag]").val("OK");
                            layer.closeAll('tips');
                        }else if(res=="issame"){
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").removeClass("error");
                            $("input[name=imei_flag]").val("OK");
                            layer.closeAll('tips');
                        }else if(res==7){
                            $("input[name=imei_flag]").val("Error");
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").addClass("error");
                            $("input[name=u_imei]").attr("aria-required","true");
                            $("input[name=u_imei]").attr("aria-invalid","true");
                            layer.tips("<?php echo L('所填IMEI不正确，请检查所选终端类型与IMEI后重新输入');?>
"+",code 103",$("input[name=u_imei]"),{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }else if(res==8){
                            $("input[name=imei_flag]").val("Error");
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").addClass("error");
                            $("input[name=u_imei]").attr("aria-required","true");
                            $("input[name=u_imei]").attr("aria-invalid","true");
                            layer.tips("<?php echo L('所填IMEI不正确，请检查所选终端类型与IMEI后重新输入');?>
"+",code 101",$("input[name=u_imei]"),{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }else{
                            $("input[name=imei_stat]").val(res);
                            $("input[name=u_imei]").addClass("error");
                            $("input[name=imei_flag]").val("Error");
                        }
                    }
                });
        if(md_type!=""){
             $.ajax({
                         url:"?m=terminal&a=getById_foruser",
                         data:{md_imei:u_imei},
                         success:function(result){
                             //var result=eval(res);
                             var res = eval("("+result+")");
                            $("input[name=u_terminal_number]").val(res.md_serial_number);
                            $("input[name=u_terminal_number]").blur();
                         }
                    });
//            if($("input[name=u_terminal_number]").val()==""&&u_imei!=""){
//                     $.ajax({
//                       url:"?m=terminal&a=getById_foruser",
//                       data:{md_imei:u_imei},
//                       success:function(result){
//                           //var result=eval(res);
//                           var res = eval("("+result+")");
//                            if($("input[name=u_terminal_number]").val()!=res.md_serial_number&&res.md_serial_number!=""){
//                                $("input[name=imei_flag]").val("Error");
//                                $("input[name=u_terminal_number]").removeClass("valid");
//                                $("input[name=u_terminal_number]").addClass("error");
//                                $("input[name=u_terminal_number]").attr("aria-required","true");
//                                $("input[name=u_terminal_number]").attr("aria-invalid","true");
//                               layer.tips("<?php echo L('终端序列号与IMEI不符');?>
",$("input[name=u_terminal_number]"),{
//                                       tips:[1, '#A83A3A'],
//                                       time:600000
//                                   });
//                               exit();
//                           }
//                       }
//                   });
//                }else{
//                     
//                }
            }
}

function check_iccid(){
     var isbind = $("input[name=u_bind_phone]:checked").val();
            var ciccid = arg_iccid.val();
            if(isbind=='1'){
                $("input[name=u_iccid]").attr("required", "true");
//                valid();
//                if(ciccid==''){
//                    $("input[name=u_iccid]").focus();
//                    exit();
//                }
            }
            $.ajax({
                url:'?m=enterprise&a=geticcid&u_number='+$("input[name=u_number]").val(),
                data:{
                    u_iccid:arg_iccid.val(),
                    e_id:e_id,
                    type:'iccid'
                },
                dataType:'json',
                success:function(res){
                    if(res.status==2){
                        flag.val("Error");
                        iccid_stat.val(res.status);
                        layer.tips("<?php echo L('ICCID已绑定，请确认后重新输入');?>
",arg_iccid,{
                            tips:[1, '#A83A3A'],
                            time:600000
                        });
                        exit();
                    }else if(res.status==1){
                        flag.val("OK");
                        iccid_stat.val(res.status);
                    }else if(res.status==5){
                        var u_bind_phone = $("input[name=u_bind_phone]:checked").val();
                        iccid_stat.val(res.status);
                        var iccid = arg_iccid.val();
                        if(u_bind_phone=='1'){
                            if(iccid!=''){
                                flag.val("Error");
                                layer.tips("<?php echo L('此ICCID库中不存在，请检查后重新填写');?>
",arg_iccid,{
                                    tips:[1, '#A83A3A'],
                                    time:600000
                                });
                                exit();
                            }
                        }else{
                           flag.val("OK");
                        }
                    }else if(res.status==4){
                        var check = true;
                        var check1 = true;
                        //如果填写的iccid存在，并适用,自动填充imsi,手机号 以及对应判断
                        if(arg_imsi.val()==''){
                            arg_imsi.val(res.info.g_imsi);
                        }else{
                            //res.info.g_imsi!='' && 
                            if(res.info.g_imsi!=arg_imsi.val()){
                                flag.val("Error");
                                imsi_stat.val(res.status);
                                layer.tips("<?php echo L('所填写的IMSI不正确，请检查后重新填写');?>
",arg_imsi,{
                                    tips:[1, '#A83A3A'],
                                    time:600000
                                });
                                check = false;
                            }else{
                                check = true;
                            }
                        }

                        if(arg_number.val()==''){
                            arg_number.val(res.info.g_number);
                        }else{
                            if(res.info.g_number!='' && res.info.g_number!=arg_number.val()){
                                flag.val("Error");
                                number_stat.val(res.status);
                                layer.tips("<?php echo L('所填写的手机号不正确，请检查后重新填写');?>
",arg_number,{
                                    tips:[1, '#A83A3A'],
                                    time:600000
                                });
                                check1 = false;
                            }else{
                                check1 = true;
                            }
                        }

                        if(check==false || check1==false){
                            flag.val("Error");
                            exit();
                        }else{
                            flag.val("OK");
                            iccid_stat.val(res.status);
                        }
                        
                    }else if(res.status==3){
                        flag.val("Error");
                        iccid_stat.val(res.status);
                        layer.tips("<?php echo L('所填写的ICCID不正确，请检查后重新填写');?>
",arg_iccid,{
                            tips:[1, '#A83A3A'],
                            time:600000
                        });
                        exit();
                    }
                    //做到提示信息 不正确 还有 自动填充
                    layer.closeAll('tips');
                }
            });
}
$("a.get_passwd").on("click",function(){
    $.ajax({
        url:"?m=enterprise&a=get_random_passwd",
        success:function(pswd){
            $("input[name=u_passwd]").val(pswd);
        }
    });
});<?php }} ?>