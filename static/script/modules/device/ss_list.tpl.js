 (function () {
        var url = $("select#e_ss_id").attr("action");
        $.ajax({
            url: url,
            success: function (result) {
                $("select#e_ss_id").html(result);
            }
        });
    })();
    
      var e_id_list='';
    $("td.e_id_list").each(function(){
        e_id_list +=$(this).html()+",";
    });
    $("input[name=e_id_list]").val(e_id_list);
    $("select#e_ss_id").bind("change",function(){
        var d_space_free = $(this).children('option:selected').attr("d_space_free");
        $("input[name=d_space_free]").val(d_space_free);
    });
    
     $("#move_ss").click(function () {

        if ($("#form").valid()) {
            var flag = false;
            var old_e_vcr_id = $("#old_e_vcr_id").val();
            var new_e_ss_id = parseInt($("select[name=e_ss_id] option:selected").val());

//            var e_ss_id = parseInt($("select[name=e_ss_id] option:selected").attr("d_have"));
//            var cur_e_rs_rec = $('.cur_e_rs_rec').text();
//            if(e_rs_rec < cur_e_rs_rec)
//            {
//                notice("<%'迁移到的{$smarty.session.ident}-SS可用空间比当前设备已使用空间小，无法迁移，请选择其他设备'|L%>");
//                flag = true;
//            }
            $("input[name=e_ss_id]").val(new_e_ss_id);
    if (!flag) {
    $("#dialog-confirm").dialog({
    resizable: false,
            height: 180,
            modal: true,
            buttons: {
            "<%'迁移'|L%>": function () {
            $(this).dialog("close");
//            if (sub == false) {
//            return false;
//            }
            notice("<%'正在操作中'|L%>");
                var url=$("#form").attr("action");
                    $.ajax({
                    url: url,
                            data: $("#form").serialize(),
                            dataType: "json",
                            success: function (result) {
                            if (result.status == 0) {
                            notice(result.msg, '?m=device&a=ss');
                            } else {
                            notice(result.msg);
                            }

                            }
                    });
            },
                    "<%'取消'|L%>": function () {
                    $(this).dialog("close");
                    }
            }
    });
    }
    }
    });
