var iccid=$("input[name=g_iccid]");
var imsi=$("input[name=g_imsi]");
var number=$("input[name=g_number]");
var one_remarks=$("textarea[name=g_one_remarks]");
var two_remarks=$("textarea[name=g_two_remarks]");
var iccid_num=$("input[name=g_iccid]").val();
var imsi_num=$("input[name=g_imsi]").val();
var number_num=$("input[name=g_number]").val();
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
                    if(msg==1&&iccid_num!=g_iccid){
                        layer.tips("<%'此ICCID已存在'|L%>", iccid,{
                            tips:[1, '#A83A3A'],
                        });
                        flag=false;
                        exit();
                    }else if(msg==2&&imsi_num!=g_imsi){
                        layer.tips("<%'此IMSI已存在'|L%>", imsi,{
                            tips:[1, '#A83A3A'],
                        });
                        flag=false;
                        exit();
                    }else if(msg==3&&number_num!=g_number){
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
