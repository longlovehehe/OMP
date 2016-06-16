function edit_term(obj,id,imei,value){
    var shtml = '<img class="save" src="images/save.png" onMouseOver="this.src=\'images/save_pass.png\'" onMouseOut="this.src=\'images/save.png\'"/>';
    var chtml = '<img class="cancel1" src="images/cancel1.png" onMouseOver="this.src=\'images/cancel1_pass.png\'" onMouseOut="this.src=\'images/cancel1.png\'"/>';
    var ehtml = '<img class="edit" src="images/edit.png" onMouseOver="this.src=\'images/edit_pass.png\'" onMouseOut="this.src=\'images/edit.png\'"/>';
    var dhtml = '<img class="delete" src="images/delete.png" onMouseOver="this.src=\'images/delete_pass.png\'" onMouseOut="this.src=\'images/delete.png\'"/>';
    $("td").children().prop("disabled","true");
    $("a.link").addClass("set_gray");
    $("a.start_stop").each(function(){
        $(this).unbind("click");
    });
    $("tr").each(function(){
           if($(this).children().eq(10).text()!=""&&$(this).children().eq(10).text()=="<%'无'|L%>"){
               $(this).children().eq(11).children().attr("onclick","return false;");
           }
   });
    $(obj).removeClass("set_gray");
    $(obj).attr("onclick","edit_term(this,'"+id+"','"+imei+"','"+value+"')");
    $(obj).next().attr("onclick","del_term(this,'"+id+"')");
    $(obj).next().removeClass("set_gray");
    $(obj).parent().parent().each(function(){
        $(this).children().children().removeAttr("disabled","");
        $(this).children().children().removeClass("inputnothing").addClass("inputfocs");
        $(obj).removeClass("inputfocs");
        $(obj).next().removeClass("inputfocs");
        $(obj).parent().next().children().removeClass("inputfocs").addClass("inputnothing");
        $(obj).parent().prev().children().removeClass("inputfocs").addClass("inputnothing");
        $(obj).parent().prev().prev().children().removeClass("inputfocs").addClass("inputnothing");
        $(obj).parent().prev().prev().prev().prev().prev().prev().prev().children().removeClass("inputfocs").addClass("inputnothing");
    }); 
    $("input[name=md_binding_user"+id+"]").attr("disabled","true");
    $("input[name=md_binding_user"+id+"]").css("border","none");
    $("input[name=md_time"+id+"]").attr("disabled","true");
    $("input[name=md_time"+id+"]").css("border","none");
    
    var select=$("input[name=select"+id+"]").val();
    $(obj).parent().prev().prev().prev().prev().prev().html(select);
    var md_imei=$("input[name=md_imei"+id+"]").val();
    var md_type=$("input[name=md_type"+id+"]").val();

    var md_type_name=$("input[name=md_type_name"+id+"]").val();
    var md_serial_number=$("input[name=md_serial_number"+id+"]").val();
    var tl_system_num=$("input[name=tl_system_num"+id+"]").val();
    var md_time=$("input[name=md_time"+id+"]").val();
    var md_id=$("input[name=md_id"+id+"]").val();
    $("select[name=md_type"+id+"]").change(function(){
        
       md_type_name=$("select[name=md_type"+id+"] option:selected").text();
//        md_type=$("select[name=md_type"+id+"] option:selected").val();
        $("input[name=md_type_name"+id+"]").val(md_type_name);
//        $("input[name=md_type"+id+"]").val(md_type);
    });
//IMEI验证
    var match=/^\d{15}$/;
    if(!match.test(md_imei)){
    $(obj).html(shtml);
      var index=layer.tips("<%'请输入15位数字或字母'|L%>", $(obj).parent().prev().prev().prev().prev().prev().prev(),{
          tips:[1, '#A83A3A'],
      });
      $(obj).next().attr("onclick","cancel(this,'"+id+"','"+value+"','"+imei+"','"+md_type+"');");
      return;
    }else{
        layer.closeAll('tips');
    }
    //终端序列号验证
    var res=serial_test($(obj).parent().prev().prev().prev().prev().children());
    if(res==false){
        var index=layer.tips("<%'只能输入数字和字母'|L%>", $(obj).parent().prev().prev().prev().prev(),{
          tips:[1, '#A83A3A'],
      });
      $(obj).next().attr("onclick","cancel(this,'"+id+"','"+value+"','"+imei+"','"+md_type+"');");
      return;
    }else{
        layer.closeAll(index);
    }
    
    if($(obj).children().attr('class')=="save"){
        $.ajax({
            url:'?m=terminal&a=check_imei',
            data:{md_id:md_id,md_imei:md_imei},
            success:function(msg){
                if(msg==1){
                    var index=layer.tips("<%'此IMEI已存在'|L%>", $(obj).parent().prev().prev().prev().prev().prev().prev(),{
                                  tips:[1, '#A83A3A'],
                              });
                }else{
                    $.ajax({
                        url:'?m=terminal&a=save_terminal',
                        dataType:"json",
                        data:{md_id:md_id,md_imei:md_imei,md_type:$("input[name=md_type_name"+id+"]").val(),md_serial_number:md_serial_number,md_time:md_time,do:"edit"},
                        success:function(msg){
                            if(msg.status==0){
                                layer.msg(msg.msg);
                                $(obj).parent().prev().prev().prev().prev().prev().html(md_type_name);
                                $("input.cb").removeAttr("disabled");
                                $("a.link").removeClass("set_gray");
                                $("a.start_stop").each(function(){
                                    $(this).on("click",function(){
                                            setstatus(this);
                                    });
                                });
                                $("tr").each(function(){//保存成功后 恢复原有界面
                                    if($(this).children().eq(10).html()!=""&&$(this).children().eq(10).html()!="<%'无'|L%>"){
                                        $(this).children().eq(11).children().addClass("set_gray");
                                    }else if($(this).children().eq(10).text()!=""&&$(this).children().eq(10).text()=="<%'无'|L%>"){
                                        var that=$(this).children().eq(11).children();
                            //               console.log($(this).children().eq(3));
                                           var md_id=$(this).children().eq(11).children().next().next().val();
                                           var imei=$(this).children().eq(5).children().val();
                                           that.attr("onclick","edit_term(this,'"+id+"','"+imei+"','"+value+"')");
                                           that.next().attr("onclick","del_term(this,'"+md_id+"')");
                                       }
                                });
                                $("input[name=md_type"+id+"]").val(md_type_name);
                                $(obj).parent().parent().each(function(){
                                    $(this).children().children().attr("disabled","true");
                                    $("input[name=md_id"+id+"]").prev().removeAttr("disabled");
                                    $("a.tips_title").removeAttr("disabled");
                                    $(this).children().children().removeClass("inputfocs").addClass("inputnothing");
                                    $(obj).removeClass("inputnothing");
                                    $(obj).next().removeClass("inputnothing");
                                    $(obj).html(ehtml);
                                    $(obj).next().html(dhtml);
//                                    $(obj).next().attr("onclick","cancel(this,'"+id+"');");
                                    exit();
                                }); 
                                
                            }else{
                                layer.msg(msg.msg);
                                $(this).children().children().removeClass("inputfocs").addClass("inputnothing");
                                $("input[name=md_id"+id+"]").prev().removeAttr("disabled");
                                $("a.tips_title").removeAttr("disabled");
                                $(obj).removeClass("inputnothing");
                                $(obj).next().removeClass("inputnothing");
                            }
                        }
                    });
                }
            }
        });
    }
    $(obj).html(shtml);
    $(obj).next().html(chtml);
    $(obj).next().attr("onclick","cancel(this,'"+id+"','"+value+"','"+imei+"','"+md_type+"');");
}

function cancel(obj,id,value,imei,md_type){
    var ehtml = '<img class="edit" src="images/edit.png" onMouseOver="this.src=\'images/edit_pass.png\'" onMouseOut="this.src=\'images/edit.png\'"/>';
    var dhtml = '<img class="delete" src="images/delete.png" onMouseOver="this.src=\'images/delete_pass.png\'" onMouseOut="this.src=\'images/delete.png\'"/>';
    $("input.cb").removeAttr("disabled");
    $("a.link").removeClass("set_gray");
    $("a.start_stop").each(function(){
        $(this).on("click",function(){
            setstatus(this);
        });
    });
    $("tr").each(function(){//保存成功后 恢复原有界面
           if($(this).children().eq(10).children().html()!=""&&$(this).children().eq(10).html()!="<%'无'|L%>"){
               $(this).children().eq(11).children().addClass("set_gray");
           }else if($(this).children().eq(10).text()!=""&&$(this).children().eq(10).text()=="<%'无'|L%>"){
            var that=$(this).children().eq(11).children();
//               console.log($(this).children().eq(3));
               var md_id=$(this).children().eq(11).children().next().next().val();
               var imei=$(this).children().eq(5).children().val();
               that.attr("onclick","edit_term(this,'"+id+"','"+imei+"','"+value+"')");
               that.next().attr("onclick","del_term(this,'"+md_id+"')");
           }
   });
     var md_type_name=$("input[name=md_type_name"+id+"]").val();
     if($(obj).children().attr('class')=='cancel1'){
          $(obj).parent().prev().prev().prev().prev().prev().html(md_type);
           $(obj).parent().parent().each(function(){
                            $(this).children().children().attr("disabled","true");
                            $("input[name=md_id"+id+"]").prev().removeAttr("disabled");
                            $("a.tips_title").removeAttr("disabled");
                            $(this).children().children().removeClass("inputfocs").addClass("inputnothing");
                            $(obj).removeClass("inputnothing");
                            $(obj).next().removeClass("inputnothing");
                            $(obj).prev().html(ehtml);
                            $(obj).html(dhtml);
                            $(obj).attr("onclick","del_term(this,'"+id+"');");
            });
            $("input[name=md_serial_number"+id+"]").val(value);
            $("input[name=md_imei"+id+"]").val(imei);
    }
}

function del_term(obj,id,md_imei){
    layer.confirm("<%'确定要删除该终端吗'|L%>",{btn: ["<%'确定'|L%>", "<%'取消'|L%>"],title:"<%'删除'|L%>"},function(){
            $.ajax({
                       url:'?m=terminal&a=del_term',
                       dataType:"json",
                       data:{md_imei:md_imei},
                       success:function(msg){
                           if(msg==2){
                               layer.msg("<%'终端被绑定不能删除'|L%>");
                           }else if(msg==0){
                               layer.msg("<%'删除失败'|L%>"); 
                           }else{
                                layer.msg("<%'删除成功'|L%>",{
                                   icon: 1,
                                   time: 2000 //2秒关闭（如果不配置，默认是3秒）
                               },function(){
                                   location.href="?m=terminal&a=index_list";
                               }); 
                           }
                       }
                   });
     });
}


/**
 * imei验证

function imei_test(val,obj){
    var match=/^\d{15}/;
    if(!match.test(val)){
        alert(val);
      var index=layer.tips('我是另外一个tips，只不过我长得跟之前那位稍有些不一样。', obj);
    }else{
        layer.closeAll('tips');
    }
} */

    $("#delall").click(function () {
    var checkd = "";
            $("input.cb:checkbox:checked").each(function () {
    checkd += $(this).val() + ",";
    });
            if (checkd === "") {
    notice("<%'未选中任何终端'|L%>");
    } else {
    $("#dialog-confirm").dialog({
    resizable: false,
            height: 180,
            modal: true,
            buttons: {
            "<%'删除'|L%>": function () {
            $(this).dialog("close");
                    $.ajax({
                    url: "?modules=terminal&action=batch_del_term",
                            data: $("form.data").serialize(),
                            success: function (result) {
                                layer.msg("<%'成功删除'|L%> " + result + " <%'个终端设备'|L%>",{
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            
                            location.reload();
                        });
                            }
                    });
            },
                    "<%'取消'|L%>": function () {
                    $(this).dialog("close");
                    }
            }
    });
    }
    });
    
$("a#batch_toggle").click(function () {
    $("form.move_user").hide();
    $("form.move_u_default_pg").hide();
    $("form.batch").toggle();
});
$("#allstart").on("click",function () {
    var checkd = "";
    $("input.cb:checkbox:checked").each(function () {
        checkd += $(this).val() + ",";
    });
    if (checkd === "") {
        notice("<%'未选中任何终端'|L%>");
    } else {
        var data = $("form.data").serialize();
        $("#dialog-confirm-batch").dialog({
            resizable: false,
            height: 180,
            modal: true,
            buttons: {
                "<%'更新'|L%>": function () {
                    $(this).dialog("close");
                    $.ajax({
                        url: "?modules=terminal&action=term_allstart",
                        data: data,
                        success: function () {
                            send();
                        }
                    });
                },
                "<%'取消'|L%>": function () {
                    $(this).dialog("close");
                }
            }
        });
    }
});
$("#allstop").on("click",function () {
    var checkd = "";
    $("input.cb:checkbox:checked").each(function () {
        checkd += $(this).val() + ",";
    });
    if (checkd === "") {
        notice("<%'未选中任何终端'|L%>");
    } else {
        var data =$("form.data").serialize();
        $("#dialog-confirm-batch").dialog({
            resizable: false,
            height: 180,
            modal: true,
            buttons: {
                "<%'更新'|L%>": function () {
                    $(this).dialog("close");
                    $.ajax({
                        url: "?modules=terminal&action=term_allstop",
                        data: data,
                        success: function () {
                            send();
                        }
                    });
                },
                "<%'取消'|L%>": function () {
                    $(this).dialog("close");
                }
            }
        });
    }
});


 
function setstatus(obj){
        var stat=$(obj).attr("md_stat");
       var imei=$(obj).attr("value");
       if(stat=="0"){
           var md_status=1;
           $(obj).attr("md_stat","1");
           $(obj).parent().prev().prev().prev().prev().prev().prev().html("<img src='./images/enable.png' />");
           $(obj).html("<img class=''enable' src='images/Enable1.png' onMouseOver=\"this.src='images/enable_pass.png'\" onMouseOut=\"this.src='images/Enable1.png'\">");
       }else if(stat=="1"){
           var md_status=0;
           $(obj).attr("md_stat","0");
           $(obj).parent().prev().prev().prev().prev().prev().prev().html("<img src='./images/disable.png' />");
           $(obj).html("<img class='disable' src='images/Disable1.png' onMouseOver=\"this.src='images/disable_pass.png'\" onMouseOut=\"this.src='images/Disable1.png'\">");
       }
       $.ajax({
           url:"?m=terminal&a=set_stat",
           dataType:'json',
           data:{
               md_imei:imei,
               md_status:md_status
           },
           success:function(res){
               if(res.status==0){
                   layer.msg(res.msg);

               }
           }
   });
}
/**
 * 序列号的验证
 * @param {type} obj
 * @returns {undefined}
 */
function serial_test(obj){
    var val=$(obj).val();
    var match= /^([^\s\\s]|[a-zA-Z0-9]+)$/;
    if(!match.test(val)&&val!=""){
      var index=layer.tips("<%'只能输入数字和字母'|L%>", obj,{
          tips:[1, '#A83A3A'],
          time:4000000
      });
      return false;
    }else{
        layer.closeAll(index);
    }
} 