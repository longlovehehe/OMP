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
    var list_str="<tr class='number add_gprs number_"+len+"'><td>"+len+"</td><td><input name='g_iccid[]' maxlength='20' onblur='iccid_test(this);' type='text' value='' /></td><td><input name='g_imsi[]' maxlength='15' type='text' onblur='imsi_test(this);' value='' ></td><td><input name='g_number[]' maxlength='20' onblur='number_test(this);' type='text' value='' ></td><td class='rich'><select name='g_agents_id[]' style='width:120px;' class='autofix' action='?m=terminal&a=option'>"+ag_option_str+"</select></td><td class='rich'><a type='button'  class='add_button' onclick='add_gprs(" + len + "); '><div  style='background: url(\"images/add.png\") no-repeat ;background-size:18px;width:25px;height:25px; float: left;'></div></a><a type='button'  class='del_button' onclick='del_terminal(" + len + "); '><div  style='background: url(\"images/del.png\") no-repeat ;background-size:18px;width:20px;height:20px;margin-left: 30px;'></div></a></td></tr>";
    
    $(this).parent().parent().parent().append(list_str);
   var uxid=1;
   $("tr.number").each(function(){
       $(this).children().eq(0).html(uxid);
       uxid++;
   });
});

function add_gprs(num){
    len++;
    var time=CurentTime();
    var option_str=$("tr.number_1").find("select").html();
    var ag_option_str=$("tr.number_1").find("select.ag_option").html();
    var list_str="<tr class='number add_gprs number_"+len+"'><td>"+len+"</td><td><input name='g_iccid[]' maxlength='20' onblur='iccid_test(this);' type='text' value='' /></td><td><input name='g_imsi[]' maxlength='15' type='text' onblur='imsi_test(this);' value='' /></td><td><input name='g_number[]' maxlength='20' type='text' onblur='number_test(this);' value='' /></td><td class='rich'><select name='g_agents_id[]' style='width:120px;' class='autofix' action='?m=terminal&a=option'>"+ag_option_str+"</select></td><td class='rich'><a type='button'  class='add_button' onclick='add_gprs(" + len + "); '><div  style='background: url(\"images/add.png\") no-repeat ;background-size:18px;width:25px;height:25px; float: left;'></div></a><a type='button'  class='del_button' onclick='del_terminal(" + len + "); '><div  style='background: url(\"images/del.png\") no-repeat ;background-size:18px;width:20px;height:20px;margin-left: 30px;'></div></a></td></tr>";
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
        url = "?m=gprs&a=gprs_export_vt";
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

$("a.ajaxpost_t").click(function(){
    var form = $("a.ajaxpost_t").attr("form");
    var goto = $("a.ajaxpost_t").attr("goto");
    var data = $("#form").serialize();
    var url = $("#" + form).attr("action");
    $("tr.number").each(function(){
        var that=$(this);
        //验证规则
        var iccid_match=/^[0-9a-zA-Z]{19}$|^[0-9a-zA-Z]{20}$/i;
        var imsi_match=/^\s*$|^[0-9]{15}$/i; // /^[0-9]{15}$/i;
        var number_match=/^\d+$/;
        //var number_match=/^\s*$|^1\d{10}$/;
        //获取iccid、imsi、number
        var g_iccid = that.children().next().children().val();
        var g_imsi = that.children().next().next().children().val();
        var g_number = that.children().next().next().next().children().val();

        flag=true;

        if(!iccid_match.test(g_iccid)){
            layer.tips("<%'请输入19或20位数字或字母'|L%>", that.children().next().children().eq(0),{
                tips:[1, '#A83A3A'],
            });
            flag=false;
            exit();
        }else if(!imsi_match.test(g_imsi)){
            layer.tips("<%'请输入15位数字'|L%>", that.children().next().next().children().eq(0),{
                tips:[1, '#A83A3A'],
            });
            flag=false;
            exit();
        }else if(!number_match.test(g_number)){
            layer.tips("<%'请输入正确手机号格式'|L%>", that.children().next().next().next().children().eq(0),{
                tips:[1, '#A83A3A'],
            });
            flag=false;
            exit();
        }else{
            var check = check_isset();
            if(check[0]==false){
                layer.msg("<%'ICCID重复'|L%>",{time: 2000 });
                exit();
            }else if(check[1]==false){
                layer.msg("<%'IMSI重复'|L%>",{time: 2000 });
                exit();
            }else if(check[2]==false){
                layer.msg("<%'NUMBER重复'|L%>",{time: 2000 });
                exit();
            }
            $.ajax({
                url:"?m=gprs&a=check_edit",
                data:{g_iccid:g_iccid,g_imsi:g_imsi,g_number:g_number,type:'add'},
                success:function(msg){
                    if(msg==1){
                        layer.tips("<%'此ICCID已存在'|L%>", that.children().next().children().eq(0),{
                            tips:[1, '#A83A3A'],
                        });
                        flag=false;
                        exit();
                    }else if(msg==2){
                        layer.tips("<%'此IMSI已存在'|L%>", that.children().next().next().children().eq(0),{
                            tips:[1, '#A83A3A'],
                        });
                        flag=false;
                        exit();
                    }else if(msg==3){
                        layer.tips("<%'此Number已存在'|L%>", that.children().next().next().next().children().eq(0),{
                            tips:[1, '#A83A3A'],
                        });
                        flag=false;
                        exit();
                    }
                }
            });
            layer.closeAll('tips');
        }

    });
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

//验证流量卡的三个字段是否存在重复的
function check_isset(){
    var iccids = $("input[name='g_iccid[]']");
    var imsis = $("input[name='g_imsi[]']");
    var numbers = $("input[name='g_number[]']");
    var check = new Array();
    //验证iccids
    var iccidArr = new Array();
    iccids.each(function(index){
        if($(this).val()!=''){
            iccidArr[index] = $(this).val();
        }
    });
    var s = iccidArr.join(",") +",";
    for(var i = 0; i < iccidArr.length; i++)
    {
       if(s.replace(iccidArr[i] + ",", "").indexOf(iccidArr[i] +",") > -1)
        {
            check[0] = false;
            break;
        }else{
            check[0] = true;
        }
    }

    //验证imsis
    var imsiArr = new Array();
    imsis.each(function(index){
        if($(this).val()!=''){
            imsiArr[index] = $(this).val();
        }
    });
    var m = imsiArr.join(",") +",";
    for(var i = 0; i < imsiArr.length; i++)
    {
       if(m.replace(imsiArr[i] + ",", "").indexOf(imsiArr[i] +",") > -1)
        {
            check[1] = false;
            break;
        }else{
            check[1] = true;
        }
    }

    //验证numbers
    var numberArr = new Array();
    numbers.each(function(index){
        if($(this).val()!=''){
            numberArr[index] = $(this).val();
        }
    });
    var n = numberArr.join(",") +",";
    for(var i = 0; i < numberArr.length; i++)
    {
       if(n.replace(numberArr[i] + ",", "").indexOf(numberArr[i] +",") > -1)
        {
            check[2] = false;
            break;
        }else{
            check[2] = true;
        }
    }
    return check;
}

//blur验证
function blurcheck(args,type,that){
    if(type=='g_iccid'){
        g_iccid = args;
        g_imsi='';
        g_number=''
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
 