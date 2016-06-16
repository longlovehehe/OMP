/* The file is auto create */
/**
 *
 */

  var len = 1;
$("a.add_button").click(function () {
    len++;
    var time=CurentTime();
    var option_str=$("tr.number_1").find("select").html();
    var ag_option_str=$("tr.number_1").find("select.ag_option").html();
    //var list_str="<tr class='number add_terminal number_"+len+"'><td>"+len+"</td><td><input name='md_imei[]' maxlength='15' type='text' value='' /></td><td class='rich'><select name='md_type[]' class='autofix' action='?m=terminal&a=option'>"+option_str+"</select></td><td title='' class='rich'><input name='md_serial_number[]' type='text' value=''></td><td class='rich'><input name='md_time[]' disabled type='text' value='"+time+"'></td><td class='rich'><a type='button'  class='add_button' onclick='add_terminal(" + len + "); '><div  style='background: url(\"images/add.png\") no-repeat ;background-size:18px;width:25px;height:25px; float: left;'></div></a><a type='button'  class='del_button' onclick='del_terminal(" + len + "); '><div  style='background: url(\"images/del.png\") no-repeat ;background-size:18px;width:20px;height:20px;margin-left: 30px;'></div></a></td></tr>";
    var list_str="<tr class='number add_terminal number_"+len+"'><td>"+len+"</td><td><input name='md_imei[]' maxlength='15' type='text' value='' /></td><td class='rich'><select name='md_type[]' style='width:100px;' class='autofix' action='?m=terminal&a=option'>"+option_str+"</select></td><td title='' class='rich'><input name='md_serial_number[]' maxlength='32' type='text' value=''></td><td class='rich'><select name='md_parent_ag[]' style='width:120px;' class='autofix' action='?m=terminal&a=option'>"+ag_option_str+"</select></td><td class='rich'><a type='button'  class='add_button' onclick='add_terminal(" + len + "); '><div  style='background: url(\"images/add.png\") no-repeat ;background-size:18px;width:25px;height:25px; float: left;'></div></a><a type='button'  class='del_button' onclick='del_terminal(" + len + "); '><div  style='background: url(\"images/del.png\") no-repeat ;background-size:18px;width:20px;height:20px;margin-left: 30px;'></div></a></td></tr>";
    
    $(this).parent().parent().parent().append(list_str);
   var uxid=1;
   $("tr.number").each(function(){
       $(this).children().eq(0).html(uxid);
       uxid++;
   });
});

function add_terminal(num){
    len++;
   var time=CurentTime();
   var option_str=$("tr.number_1").find("select").html();
    var ag_option_str=$("tr.number_1").find("select.ag_option").html();
   //var list_str="<tr class='number add_terminal number_"+len+"'><td>"+len+"</td><td><input name='md_imei[]' maxlength='15' type='text' value='' /></td><td class='rich'><select name='md_type[]' class='autofix' action='?m=terminal&a=option'>"+option_str+"</select></td><td title='' class='rich'><input name='md_serial_number[]' type='text' value=''></td><td class='rich'><input name='md_time[]' disabled type='text' value='"+time+"'></td><td class='rich'><a type='button'  class='add_button' onclick='add_terminal(" + len + "); '><div  style='background: url(\"images/add.png\") no-repeat ;background-size:18px;width:25px;height:25px; float: left;'></div></a><a type='button'  class='del_button' onclick='del_terminal(" + len + "); '><div  style='background: url(\"images/del.png\") no-repeat ;background-size:18px;width:20px;height:20px;margin-left: 30px;'></div></a></td></tr>";
   var list_str="<tr class='number add_terminal number_"+len+"'><td>"+len+"</td><td><input name='md_imei[]' maxlength='15' type='text' value='' /></td><td class='rich'><select name='md_type[]' style='width:100px;' class='autofix' action='?m=terminal&a=option'>"+option_str+"</select></td><td title='' class='rich'><input name='md_serial_number[]' maxlength='32' type='text' value=''></td><td class='rich'><select name='md_parent_ag[]' style='width:120px;' class='autofix' action='?m=terminal&a=option'>"+ag_option_str+"</select></td><td class='rich'><a type='button'  class='add_button' onclick='add_terminal(" + len + "); '><div  style='background: url(\"images/add.png\") no-repeat ;background-size:18px;width:25px;height:25px; float: left;'></div></a><a type='button'  class='del_button' onclick='del_terminal(" + len + "); '><div  style='background: url(\"images/del.png\") no-repeat ;background-size:18px;width:20px;height:20px;margin-left: 30px;'></div></a></td></tr>";
   $("tr.number_"+num).after(list_str);
   var uxid=1;
   $("tr.number").each(function(){
       $(this).children().eq(0).html(uxid);
       uxid++;
   });
}
function del_terminal(num) {
    $("tr.number_" + num).remove();
    var uxid=1;
   $("tr.number").each(function(){
       $(this).children().eq(0).html(uxid);
       uxid++;
   });
}

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
        url = "?m=terminal&a=terminal_export";
    }
    $("#ifr").attr("src", url);
});

/** 设备导入 **/
$("#tmimport").click(function () {
    $("#tm_import_up").trigger("click");
});
$("#tm_import").bind("change", function () {
    if ($("#tm_import_up").val() !== "") {
        notice("<%'上传中'|L%>","?m=terminal&a=terminal_in");
        $("#tm_import").submit();

    }
});

/**文件上传*/
function tm_if_callback(result) {
    if (result.status !== 0) {
        notice(result.msg, "?m=terminal&a=terminal_in");
    } else {
        notice("<%'上传成功，正在解析'|L%>","?m=terminal&a=terminal_in");
        $("form#tm_ic input[name=f]").val(result.data);
        $("form#tm_ic").submit();
    }
}

/**内容检查*/
function tm_ic_callback(result) {
    if (result.status !== 0) {
        notice(result.msg, "?m=terminal&a=terminal_in");
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
        notice(result.msg, "?m=terminal&a=terminal_in");
    } else {
        notice(result.msg, undefined, function () {
            window.location.href='?m=terminal&a=index_list';
        });
    }
}

//IMEI验证
function imei_test(obj){
    var val=$(obj).val();
    var match=/^[0-9a-zA-Z]{15}$/;
    if(!match.test(val)){
      var index=layer.tips("<%'请输入15位数字或字母'|L%>", obj,{
          tips:[1, '#A83A3A'],
          time:4000000
      });
    }else{
        layer.closeAll('tips');
    }
}
//MEID验证
function meid_test(obj){
    var val=$(obj).val();
    var match=/^[0-9a-zA-Z]{14}$/;
    if(!match.test(val)){
      var index=layer.tips("<%'请输入14位数字或字母'|L%>", obj,{
          tips:[1, '#A83A3A'],
          time:4000000
      });
    }else{
        layer.closeAll('tips');
    }
} 

$("a.ajaxpost_t").click(function(){
    var md_imei=$("input[name=md_imei]");
    var md_meid=$("input[name=md_meid]");
    var md_serial_number=$("input[name=md_serial_number]");
    var remark = $("textarea[name=md_remarks]");
     var form = $("a.ajaxpost_t").attr("form");
            var goto = $("a.ajaxpost_t").attr("goto");
            var data = $("#form").serialize();
            var url = $("#" + form).attr("action");
        serial_test(md_serial_number);
            //var match=/^\d{15}$/;  /(?!^\d+$)(?!^[a-zA-Z]+$)[0-9a-zA-Z]{15}/;
            var match=/^[0-9a-zA-Z]{15}$/;
            var meid_match=/^[0-9a-zA-Z]{14}$/;
            var remark_match = /^[\u4e00-\u9fa5\uFE30-\uFFA0a-zA-Z0-9\w\W]{0,128}$/;
            flag=true;
            if(!match.test(md_imei.val())){
              layer.tips("<%'请输入15位数字或字母'|L%>", md_imei,{
                  tips:[1, '#A83A3A'],
              });
            //$("input.error:first").focus();
            flag=false;
            exit();
            }else if(!meid_match.test(md_meid.val())){
              if(md_meid.val()!=''){
                  layer.tips("<%'请输入14位数字或字母'|L%>", md_meid,{
                    tips:[1, '#A83A3A'],
                  }); 
                  flag=false;
                  exit();
              }
            }else if(!remark_match.test(remark.val())){
                layer.tips("<%'字符长度不能超过128位'|L%>", remark,{
                    tips:[1, '#A83A3A'],
                });
                flag=false;
                exit();
            }else{
                //验证imei 是否已存在
                $.ajax({
                    url:"?m=terminal&a=check_imei",
                    data:{md_imei:md_imei.val()},
                    success:function(res){
                        if(res==1){
                            var index=layer.tips("<%'此IMEI已存在'|L%>", md_imei,{
                                tips:[1, '#A83A3A'],
                            });
                          //$("input.error:first").focus();
                          flag=false;
                          exit();
                        }
                    }
                });
                layer.closeAll('tips');

                if(md_meid.val()!=''){
                    //验证meid是否已存在
                    $.ajax({
                        url:"?m=terminal&a=check_meid",
                        data:{md_meid:md_meid.val()},
                        success:function(res){
                            if(res==1){
                                var index=layer.tips("<%'此MEID已存在'|L%>", md_meid,{
                                    tips:[1, '#A83A3A'],
                                });
                                flag=false;
                                exit();
                            }
                        }
                    });
                    layer.closeAll('tips');
                }
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
                            
                            location.href=goto;
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
 
 
 function serial_test(obj){
    var val=$(obj).val();
    var match= /^([^\s\\s]|[a-zA-Z0-9]+)$/;
    if(!match.test(val)&&val!=""){
      var index=layer.tips("<%'只能输入数字和字母'|L%>", obj,{
          tips:[1, '#A83A3A'],
          time:4000000
      });
      exit();
    }else{
        layer.closeAll(index);
    }
} 
