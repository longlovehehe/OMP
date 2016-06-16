$("a.ajaxpost_a").bind("click",function(){
   if ($("#form").valid()) {
       check_name();
         var form = $("a.ajaxpost_a").attr("form");
        var url = $("#" + form).attr("action");
        $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            data: $("#form").serialize(),
            success: function (result) {
                    notice(result.msg, $("a.ajaxpost_a").attr("goto"));
            }
        });
       
    }else{
        $("input.error:first").focus();
    } 
    
});


jQuery.validator.addMethod("e_pwd", function (value, element) {
    var length = value.length;
    var flag = true;
    /*        var mob = /^[0-9]{19}}$/i ;*/
    /*        var mob1 = /^[0-9]{20}$/i ;*/
    if (/[\u4E00-\u9FA5]/i.test(value)) {
        flag = false;
    }
    return flag;
}, "密码不能为中文字符");

jQuery.validator.addMethod("resource_less", function (value, element) {
    var flag = false;
    if (value == 0) {
        flag = true;
    }
    return flag;
}, "该资源已用完，只能输入0");
var sum = 0;
if($("input[name=do]").val()=="edit"){
$("input").bind("change", function () {

    var ag_phone_num = $("input[name=diff_phone]").val();
    var ag_dispatch_num = $("input[name=diff_dispatch]").val();
    var ag_gvs_num = $("input[name=diff_gvs]").val();
    var phone_num = $("input[name=phone_num]").val();
    var dispatch_num = $("input[name=dispatch_num]").val();
    var gvs_num = $("input[name=gvs_num]").val();
    if (ag_phone_num == "") {
        $("input[name=ag_phone_num]").val(0);
        ag_phone_num = 0;
    } else if (ag_dispatch_num == "") {
        $("input[name=ag_dispatch_num]").val(0);
        ag_dispatch_num = 0;
    } else if (ag_gvs_num == "") {
        $("input[name=ag_gvs_num]").val(0);
        ag_gvs_num = 0;
    }

        prange = phone_num;
        $("input[name=ag_phone_num]").attr("min", prange);

        drange =  dispatch_num;
        $("input[name=ag_dispatch_num]").attr("min", drange);

        grange =gvs_num;
        $("input[name=ag_gvs_num]").attr("min", grange);
    $("#form").valid();
});
}
//(function () {
//    var url = $("select#e_mds_id").attr("action");
//    url += "&d_area=@";
//    $.ajax({
//        url: url,
//        success: function (result) {
//            $("select#e_mds_id").html(result);
//        }
//    });
//})();

$("input").bind("change", function () {
    var e_mds_call = $("input[name=e_mds_call]").val();
    var ag_phone_num = $("input[name=ag_phone_num]").val();
    var ag_dispatch_num = $("input[name=ag_dispatch_num]").val();
    var ag_gvs_num = $("input[name=ag_gvs_num]").val();
    if (ag_phone_num == "") {
        $("input[name=ag_phone_num]").val(0);
        //ag_phone_num = 0;
    } else if (ag_dispatch_num == "") {
        $("input[name=ag_dispatch_num]").val(0);
        //ag_dispatch_num = 0;
    } else if (ag_gvs_num == "") {
        $("input[name=ag_gvs_num]").val(0);
        //ag_gvs_num = 0;
    }
    sum = parseInt(ag_phone_num) + parseInt(ag_dispatch_num) + parseInt(ag_gvs_num);
    if (isNaN(sum)) {
        $("input[name=ag_user_num]").val('N/A');
    } else {
        $("input[name=ag_user_num]").val(sum);
    }

});


/**
 * 自动匹配单位
 */
/*
   var i= $("input[name=basic_price]").val();
    var j= $("input[name=console_price]").val();
    
$("input[name=units_price]").on("input",function(){
    var units=$("input[name=units_price]").val();
    $("input[name=basic_price]").val(units+i);
    $("input[name=console_price]").val(units+j);
    valid();
});
*/
/**
 * 电话输入框（含国家代码）
 */
$("input.mobile-number").intlTelInput();
$("input.currencycode").currencyCode();

//自动去除+号
var aa=$("input[name=basic_price_amp]").val();
var jj=aa.substr(0);
$("input[name=basic_price_amp]").val(jj);
var ii1=$("input[name=console_price_amp]").val();
var jj1=ii1.substr(0);
$("input[name=console_price_amp]").val(jj1);

$("input[name=ag_name]").on("blur",function(){
    $.ajax({
        url:"?m=agents&a=check_name",
        data:{name:$("input[name=ag_name]").val(),ag_number:$("input[name=ag_number]").val()},
        success:function(res){
                if(res=="1"){
                     layer.closeAll('tips');
                }else{
                    layer.tips("<%'名称已存在'|L%>",$("input[name=ag_name]"),
                    {
                        tips:[1, '#A83A3A']
                    }
                  );
                }
        }
        });
});

function check_name(){
    $.ajax({
        url:"?m=agents&a=check_name",
        data:{name:$("input[name=ag_name]").val(),ag_number:$("input[name=ag_number]").val()},
        success:function(res){
            if(res=="1"){
                     layer.closeAll('tips');
                }else{
                    layer.tips("<%'名称已存在'|L%>",$("input[name=ag_name]"),
                    {
                        tips:[1, '#A83A3A']
                    }
                  );
          $("input[name=ag_name]").focus();
          exit();
                }
        }
        });
}