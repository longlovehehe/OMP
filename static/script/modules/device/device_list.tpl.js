var d_deployment_id_own=$("input[name=d_deployment_id]").val();
$("#e_mds_id").bind('change', function () {
        var d_deployment_id = $(this).children('option:selected').attr("d_deployment_id");
        var diff_phone = $(this).children('option:selected').attr("diff_phone");
        var diff_dispatch = $(this).children('option:selected').attr("diff_dispatch");
        var diff_gvs = $(this).children('option:selected').attr("diff_gvs");
        $("input[name=diff_phone]").val(diff_phone);
        $("input[name=diff_dispatch]").val(diff_dispatch);
        $("input[name=diff_gvs]").val(diff_gvs);
        var tdata = eval($(this).attr('data'));
        var data = tdata[0];
        var to = $("#e_vcr_id");
        var url = to.attr("action") + "&" + data.field + "=" + d_deployment_id;
        //获取同一部署ID下的rs设备
        var owner = to;
        $.ajax({
            url: url,
            success: function (result) {

                if (data.view == "true") {
                    owner.html("<option value=''><%'全部'|L%></option>" + result);
                } else {
                    owner.html(result);
                }
            }
        });
        if(d_deployment_id!=d_deployment_id_own){
            //获取同一部署ID下的ss设备
            var to1 = $("#e_ss_id");
            var url1 = to1.attr("action") + "&" + data.field + "=" + d_deployment_id;

            var owner1 = to1;
            $.ajax({
                url: url1,
                success: function (result) {
                    if (data.view == "true") {
                        owner1.html("<option value=''><%'全部'|L%></option>" + result);
                    } else {
                        owner1.html(result);
                    }
                }
            });
            $("div.twolv").removeClass("none");
            $("input[name=d_deployment_id]").val(d_deployment_id);
            }else{
                $("div.twolv").addClass("none");
                $("input[name=d_deployment_id]").val(d_deployment_id_own);
            }
    });
$("select#e_vcr_id").bind("change", function () {
    // $("#e_has_vcr").val('1');
    // $("input[name=e_rs_rec]").removeAttr('resource_less').removeAttr('range');

    var e_vcr_id = $(this).children('option:selected').val();

    if(e_vcr_id != '')
    {
         check_rs_rec();
        $("#e_has_vcr").val('1');        
    }
    else
    {
        $("#e_has_vcr").val('0');
    }
});
 $("input.cb").on("click",function(evn){
    if($("input.cb").is(":checked")){
            $("div.onelv").removeClass('none');
            valid();
        }else{
            $("div.onelv").addClass('none');
        }
});
$("#checkall").on("click",function(evn){
          if($("#checkall").is(":checked")&&$("input.cb").length>0){
            $("div.onelv").removeClass('none');
            valid();
        }else{
            $("div.onelv").addClass('none');
        }
});
$("a.ajaxpost_d_batch").click(function () {
                if ($("#form").valid()) {
                    check_rs_rec();
                        var form = $("a.ajaxpost_d_batch").attr("form");
                        var url = $("#" + form).attr("action");
                        $.ajax({
                            url: url,
                            method: "POST",
                            dataType: "json",
                            data: $("#form").serialize(),
                            success: function (result) {
                                    notice(result.msg,$("a.ajaxpost_d_batch").attr("goto"));
                            }
                        });
                }else{
                    $("input.error:first").focus();
                }
        });
        
        function check_rs_rec(){
            $.ajax({
                        url: "?m=device&a=check_rs_rec",
                        method: "POST",
                        dataType: "json",
                        data: $("#form").serialize(),
                        success: function (result) {
                               if(result==-1){
                                   notice("目标设备并发不足， 请重新选择");
                                   exit();
                               }
                        }
                    });
        }