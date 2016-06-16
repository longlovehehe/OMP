{strip}
<style>
    form.base label.title, .form label.title{
        width: 250px;
    }
     form.base label.title1, .form label.title1{
        width: 100px;
    }
</style>
<h2 class="title">{"{$title}"|L}</h2>
<form id="form" class="base mrbt10" action="api.php?type=records">
     <div  class="line">
            <label>{"选则要生成的日期"|L}：</label>
            <input autocomplete="off" style="height:24px;" class="datepickeraccount start" name="start" required="true" value="{$date}" type="text"/>
    </div>
</form>
 <style>
                .ui-datepicker-calendar { 
                    display: none; 
                }  
            </style>
<iframe name="hidden_frame" id="hidden_frame" class="hidden_frame"></iframe>
<div class="buttons mrtop40">
    <a goto="?m=account&a=index" form="form" class="ajaxpost_u button normal">{"保存"|L}</a>
    <a class="goback button" action="?m=account&a=index">{"取消"|L}</a>
</div>
{/strip}
<script>
    $(document).ready(function () {
        $("a.ajaxpost_u").click(function () {
            if ($("#form").valid()) {
                var form = $("a.ajaxpost_u").attr("form");
                var url = $("#" + form).attr("action");
                $.ajax({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: $("#form").serialize(),
                    success: function (result) {
                            layer.alert(result.msg);
                    }

                });
            }
        });
    });
</script>
