$("#refreshall").click(function () {
    var checkd = "";
    var url = $(this).attr("data");
    $("input.cb:checkbox:checked").each(function () {
        checkd += $(this).val() + ",";
    });
    if (checkd === "") {
        notice("<%'未选中任何项'|L%>");
    } else {
        $.ajax({
            url: url,
            dataType: "JSON",
            data: $("form.data").serialize(),
            success: function (result) {
                notice(result.msg);
                setTimeout(function () {
                    send();
                }, 888);
            }
        });
    }
});
$("#delall").click(function () {
    var checkd = "";
    $("input.cb:checkbox:checked").each(function () {
        checkd += $(this).val() + ",";
    });
    if (checkd === "") {
        notice("<%'未选中任何项'|L%>");
    } else {
        $("#dialog-confirm").dialog({
            resizable: false,
            height: 180,
            modal: true,
            buttons: {
                "<%'删除'|L%>": function () {
                    $(this).dialog("close");
                    notice("<%'正在删除'|L%>");
                    $.ajax({
                        url: "?modules=device&action=mds_del",
                        data: $("form.data").serialize(),
                        success: function (result) {
                            notice("<%'成功删除'|L%> " + result + " <%'台设备'|L%>");
                            setTimeout(function () {
                                send("prev");
                            }, 888);
                        }
                    });
                },
                "<%'取消'|L%>": function () {
                    $(this).dialog("close");
                }
            }
        });
    }
});/* The file is auto create */
