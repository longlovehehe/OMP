var md_imei=$("input[name=md_imei]");
var md_meid=$("input[name=md_meid]");
var md_serial_number=$("input[name=md_serial_number]");
var remark = $("textarea[name=md_remarks]");
var imei=md_imei.val();
var meid=md_meid.val();
var serial_number=md_serial_number.val();
$("a.ajaxpost_t").click(function(){
   
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
                if(md_imei.val()!=imei){
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
                }

                //验证meid
                if(md_meid.val()!='' && md_meid.val()!=meid){
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
