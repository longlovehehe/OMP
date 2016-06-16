  (function () {
        var url = $("select#e_vcr_id").attr("action");
        $.ajax({
            url: url,
            success: function (result) {
                $("select#e_vcr_id").html(result);
            }
        });
    })();
    var e_id_list='';
    $("td.e_id_list").each(function(){
        e_id_list +=$(this).html()+",";
    });
    $("input[name=e_id_list]").val(e_id_list);
    $("select#e_vcr_id").bind("change",function(){
        var diff_rec = $(this).children('option:selected').attr("diff_rec");
        $("input[name=diff_rec]").val(diff_rec);
    });
    $("#move_rs").click(function () {

        if ($("#form").valid()) {
            var flag = false;
            var old_e_vcr_id = $("#old_e_vcr_id").val();
            var new_e_vcr_id = parseInt($("select[name=new_vcr_id] option:selected").val());
            if(old_e_vcr_id == new_e_vcr_id)
            {
                notice("<%'您没有更改RS， 请重新选择或取消迁移'|L%>");
                flag = true;
            }
            var e_rs_rec = parseInt($("select[name=new_vcr_id] option:selected").attr("d_have"));
            var cur_e_rs_rec = $('.cur_e_rs_rec').text();
            if(e_rs_rec < cur_e_rs_rec)
            {
                notice("<%'迁移到的{$smarty.session.ident}-RS可用并发数比当前企业并发数小，无法迁移，请选择其他设备'|L%>");
                flag = true;
            }
            $("input[name=e_vcr_id]").val(new_e_vcr_id);
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
                            notice(result.msg, '?m=device&a=rs');
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