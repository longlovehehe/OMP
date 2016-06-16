function getintime() {
    var now = new Date();
    var monthn = parseInt(now.getMonth()) + 1;
    var yearn = now.getFullYear();
    var daten = now.getDate();
    var hourn = now.getHours();
    var minutn = now.getMinutes();
    var secon = now.getSeconds();
    var dtime = yearn + "-" + monthn + "-" + daten+" "+hourn+":"+minutn+":"+secon;
    return dtime;
}
function CurentTime()
    { 
        var now = new Date();
        var year = now.getFullYear();       //年
        var month = now.getMonth() + 1;     //月
        var day = now.getDate();            //日
        var hh = now.getHours();            //时
        var mm = now.getMinutes();          //分
        var ss = now.getSeconds();          //分
        var clock = year + "-";
        if(month < 10)
            clock += "0";
        clock += month + "-";
        if(day < 10)
            clock += "0";
        clock += day + " ";
        if(hh < 10)
            clock += "0";
        clock += hh + ":";
        if (mm < 10) clock += '0'; 
        clock += mm + ":"; 
        if (ss < 10) clock += '0'; 
        clock += ss ; 
        return(clock); 
    } 

/****************************************************************************************
 * 导出模块
 */
$(".export").click(function () {
    var action = $(this).attr("action");
    var url = '';
    if (action === 'terminal_group') {
        url = "?m=gprs&a=gprs_export";
    }
    $("#ifr").attr("src", url);
});

/** 设备导入 **/
$("#tmimport").click(function () {
    $("#tm_import_up").trigger("click");
});
$("#tm_import").bind("change", function () {
    if ($("#tm_import_up").val() !== "") {
        notice("<%'上传中'|L%>","?m=gprs&a=gprs_add");
        $("#tm_import").submit();

    }
});

/**文件上传*/
function tm_if_callback(result) {
    if (result.status !== 0) {
        notice(result.msg, "?m=gprs&a=gprs_add");
    } else {
        notice("<%'上传成功，正在解析'|L%>","?m=gprs&a=gprs_add");
        $("form#tm_ic input[name=f]").val(result.data);
        $("form#tm_ic").submit();
    }
}

/**内容检查*/
function tm_ic_callback(result) {
    if (result.status !== 0) {
        notice(result.msg, "?m=gprs&a=gprs_add");
    } else {
        notice(result.msg, undefined, function () {
            $("form#tm_i input[name=f]").val(result.data); 
            $("form#tm_i").submit();
        }, "<%'导入'|L%>");
    }
}
/**数据导入*/
function tm_i_callback(result) {
    if (result.status !== 0) {
        notice(result.msg, "?m=gprs&a=gprs_add");
    } else {
        notice(result.msg, undefined, function () {
            window.location.href='?m=gprs&a=index';
        });
    }
}

//ICCID验证

function iccid_test(obj){
    var that = $(obj);
    var val=$(obj).val();
    var match=/^[0-9a-zA-Z]{19}$|^[0-9a-zA-Z]{20}$/i;
    if(!match.test(val)){
      var index=layer.tips("<%'请输入19或20位数字或字母'|L%>", obj,{
          tips:[1, '#A83A3A'],
          time:4000000
      });
    }else{
        var iccids = $("input[name='g_iccid[]']");
        var i=0;
        iccids.each(function(){
            if($(this).val()==val){
                i++;
            }
        });
        if(i>=2){
            var index=layer.tips("<%'ICCID重复'|L%>", obj,{
                  tips:[1, '#A83A3A'],
                  time:4000000
              });
            exit();
        }
        blurcheck(val,'g_iccid',that);
        layer.closeAll('tips');
    }
} 

function imsi_test(obj){
    var that = $(obj);
    var val=$(obj).val();
    //var match=/^[0-9]{15}$/i;
    var match=/^\s*$|^[0-9]{15}$/i;
    if(!match.test(val)){
      var index=layer.tips("<%'请输入15位数字'|L%>", obj,{
          tips:[1, '#A83A3A'],
          time:4000000
      });
    }else{
        var imsis = $("input[name='g_imsi[]']");
        var i=0;
        imsis.each(function(){
            if(val!=''){
                if($(this).val()==val){
                    i++;
                }
            }
        });
        if(i>=2){
            var index=layer.tips("<%'IMSI重复'|L%>", obj,{
                  tips:[1, '#A83A3A'],
                  time:4000000
              });
            exit();
        }
        blurcheck(val,'g_imsi',that);
        layer.closeAll('tips');
    }
}

function number_test(obj){
    var that = $(obj);
    var val=$(obj).val();
    var match=/^\d+$/;
    //var match=/^\s*$|^1\d{10}$/;
    if(!match.test(val)){
      var index=layer.tips("<%'请输入正确手机号格式'|L%>", obj,{
          tips:[1, '#A83A3A'],
          time:4000000
      });
    }else{
        var numbers = $("input[name='g_number[]']");
        var i=0;
        numbers.each(function(){
            if($(this).val()==val){
                i++;
            }
        });
        if(i>=2){
            var index=layer.tips("<%'NUMBER重复'|L%>", obj,{
                  tips:[1, '#A83A3A'],
                  time:4000000
              });
            exit();
        }
        blurcheck(val,'g_number',that);
        layer.closeAll('tips');
    }
}

var iccid=$("input[name=g_iccid]");
var imsi=$("input[name=g_imsi]");
var number=$("input[name=g_number]");
var one_remarks=$("textarea[name=g_one_remarks]");
var two_remarks=$("textarea[name=g_two_remarks]");
var iccid_num=iccid.val();
var imsi_num=imsi.val();
var number_num=number.val();
$("a.ajaxpost_g").click(function(){
    var form = $("a.ajaxpost_g").attr("form");
    var goto = $("a.ajaxpost_g").attr("goto");
    var data = $("#form").serialize();
    var url = $("#" + form).attr("action");

        //验证规则
        var iccid_match=/^[0-9a-zA-Z]{19}$|^[0-9a-zA-Z]{20}$/i;
        var imsi_match=/^\s*$|^[0-9]{15}$/i; // /^[0-9]{15}$/i;
        var number_match=/^\d+$/;
        var remark_match = /^[\u4e00-\u9fa5\uFE30-\uFFA0a-zA-Z0-9\w\W]{0,128}$/;
        //var number_match=/^\s*$|^1\d{10}$/;
        //获取iccid、imsi、number
        var g_iccid = iccid.val();
        var g_imsi = imsi.val();
        var g_number = number.val();
        var remark1 = one_remarks.val();
        var remark2 = two_remarks.val();

        flag=true;

        if(!iccid_match.test(g_iccid)){
            layer.tips("<%'请输入19或20位数字或字母'|L%>", iccid,{
                tips:[1, '#A83A3A'],
            });
            flag=false;
            exit();
        }else if(!imsi_match.test(g_imsi)){
            layer.tips("<%'请输入15位数字'|L%>", imsi,{
                tips:[1, '#A83A3A'],
            });
            flag=false;
            exit();
        }else if(!number_match.test(g_number)){
            layer.tips("<%'请输入正确手机号格式'|L%>", number,{
                tips:[1, '#A83A3A'],
            });
            flag=false;
            exit();
        }else if(!remark_match.test(remark1)){
            layer.tips("<%'字符长度不能超过128位'|L%>", one_remarks,{
                tips:[1, '#A83A3A'],
            });
            flag=false;
            exit();
        }else if(!remark_match.test(remark2)){
            layer.tips("<%'字符长度不能超过128位'|L%>", two_remarks,{
                tips:[1, '#A83A3A'],
            });
            flag=false;
            exit();
        }else{
            $.ajax({
                url:"?m=gprs&a=check_edit",
                data:{g_iccid:g_iccid,g_imsi:g_imsi,g_number:g_number,type:'add'},
                success:function(msg){
                    if(msg==1){
                        layer.tips("<%'此ICCID已存在'|L%>",iccid,{
                            tips:[1, '#A83A3A'],
                        });
                        flag=false;
                        exit();
                    }else if(msg==2){
                        layer.tips("<%'此IMSI已存在'|L%>", imsi,{
                            tips:[1, '#A83A3A'],
                        });
                        flag=false;
                        exit();
                    }else if(msg==3){
                        layer.tips("<%'此Number已存在'|L%>", number,{
                            tips:[1, '#A83A3A'],
                        });
                        flag=false;
                        exit();
                    }
                }
            });
            layer.closeAll('tips');
        }

       if(flag){
            $.ajax({
                url: url,
                method: "POST",
                dataType: "json",
                data: data,
                success: function (result) {
                    if (result.status == 0) {
                        layer.msg(result.msg,{
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            //location.href=goto;
                            location.replace("?m=gprs&a=gprs_add");
                        });
                    } else {
                        //$("a.ajaxpost_t").bind("click", submitpost);
                        layer.msg(result.msg);
                    }
                }
            });
    }
});

function get_time(obj){
    $(obj).datetimepicker({timeFormat: "HH:mm:ss",
        dateFormat: "yy-mm-dd"});
}

//blur验证
function blurcheck(args,type,that){
    if(type=='g_iccid'){
        g_iccid = args;
        g_imsi='';
        g_number='';
    }else if(type=='g_imsi'){
        g_iccid = '';
        g_imsi = args;
        g_number='';
    }else{
        g_iccid = '';
        g_number = args;
        g_imsi='';
    }
    $.ajax({
        url:"?m=gprs&a=check_edit",
        data:{g_iccid:g_iccid,g_imsi:g_imsi,g_number:g_number,type:'add',blur:'blur'},
        success:function(msg){
            if(msg==1){
                layer.tips("<%'此ICCID已存在'|L%>", that,{
                    tips:[1, '#A83A3A'],
                });
                flag=false;
                exit();
            }else if(msg==2){
                layer.tips("<%'此IMSI已存在'|L%>", that,{
                    tips:[1, '#A83A3A'],
                });
                flag=false;
                exit();
            }else if(msg==3){
                layer.tips("<%'此Number已存在'|L%>", that,{
                    tips:[1, '#A83A3A'],
                });
                flag=false;
                exit();
            }
        }
    });
}
 