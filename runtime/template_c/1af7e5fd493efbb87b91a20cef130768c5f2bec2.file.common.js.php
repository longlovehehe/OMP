<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:00
         compiled from "..\static\script\common.js" */ ?>
<?php /*%%SmartyHeaderCode:30819576223500fcd13-38107979%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1af7e5fd493efbb87b91a20cef130768c5f2bec2' => 
    array (
      0 => '..\\static\\script\\common.js',
      1 => 1462762765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30819576223500fcd13-38107979',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576223501c0239_53306479',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576223501c0239_53306479')) {function content_576223501c0239_53306479($_smarty_tpl) {?>document.onmousewheel = function() {return true;}
$.timepicker.regional['ru'] = {
    timeOnlyTitle: '',
    timeText: "<?php echo L('时间');?>
",
    hourText: "<?php echo L('小时');?>
",
    minuteText: "<?php echo L('分钟');?>
",
    secondText: "<?php echo L('秒钟');?>
",
    millisecText: '',
    timezoneText: '',
    currentText: "<?php echo L('当前时间');?>
",
    closeText: "<?php echo L('确定');?>
",
    timeFormat: 'HH:mm',
    amNames: ['AM', 'A'],
    pmNames: ['PM', 'P'],
    isRTL: false
};
$.timepicker.setDefaults($.timepicker.regional['ru']);

/**
 * @param {type} notice 消息
 * @param {type} type 消息类型
 * 1 自动消失
 * 2 进行遮罩
 * 4 具有关闭按钮
 * 8 具有loading
 * 16 自动刷新当前页
 * @returns {undefined}
 **/
function log(msg) {
    if (typeof (console.log) !== "undefined") {
        console.log(msg);
    }
}
function notice(notice, url, callback, button_text) {
    var id = "notice_" + new Date().getTime();

    if (typeof (button_text) === 'undefined') {
        button_text = "<?php echo L('关闭');?>
";
    }

    $("div.notice_mask").hide();
    $notice_mask = $("<div class='notice_mask sync '></div>");
    $notice_content = $("<div class='notice_content animated fadeIn'></div>");
    $notice = $("<div class='notice'></div>");
    $notice_mask.attr("id", id);
    $notice.html(notice);
    $notice_content.append($notice);
    $toolbar = $("<div class='toolbar'><a class='button close notransition'>" + button_text + "</a></div>");
    $notice_content.append($toolbar);
    $notice_mask.append($notice_content);
    $("body").append($notice_mask);
    $("#" + id + " div.notice_content").draggable({containment: "parent"});

    if (typeof (url) !== 'undefined') {
        $("#" + id + " a.close").bind("click", function () {
            window.location.href = url;
        });
    } else {
        $("#" + id + " a.close").bind("click", function () {
            if (typeof (callback) !== 'undefined') {
                callback();
            } else {
                $("#" + id).hide();
            }
        });
    }
    return id;
}
var con = "<?php echo L('取消');?>
";
function confirm(notice) {
    var id = "notice_" + new Date().getTime();
    $("div.notice_mask").remove();
    $notice_mask = $("<div class='notice_mask sync '></div>");
    $notice_content = $("<div class='notice_content animated fadeIn'></div>");
    $notice = $("<div class='notice'></div>");
    $notice_mask.attr("id", id);
    $notice.html(notice);
    $notice_content.append($notice);
    $toolbar1 = $("<div style='float:right' class='toolbar'><a class='button cancel notransition'><?php echo L('取消');?>
</a></div>");
    $toolbar = $("<div  class='toolbar'><a class='button determine notransition'><?php echo L('确定');?>
</a></div>");
    $notice_content.append($toolbar1);
    $notice_content.append($toolbar);
    $notice_mask.append($notice_content);
    $("body").append($notice_mask);
    $("#" + id + " div.notice_content").draggable({containment: "parent"});


    $("#" + id + " a.determine").bind("click", function () {
        con = $("a.determine").html();
        $("#" + id).remove();
        var flag = $("input[name='flag']").val();
        if (ptype == 'android') {
            if (flag == "del") {
                del_android_dir();
            } else if (flag == "empty") {
                empty_android_dir();
            }
        } else if(ptype == 'ios'){
            if (flag == "del") {
                del_ios_dir();
            } else if (flag == "empty") {
                empty_ios_dir();
            }
        }else if(ptype == 'console'){
            if (flag == "del") {
                del_console_dir();
            } else if (flag == "empty") {
                empty_console_dir();
            }
        }
    });
    $("#" + id + " a.cancel").bind("click", function () {
        con = $("a.cancel").html();
        $("#" + id).remove();
    });

    return con;
}
$.ajaxSetup({
    type: 'POST',
    async: 'FALSE',
    error: function (XMLHttpRequest) {
        if (XMLHttpRequest.status === 401) {
            notice("<?php echo L('登录异常，请重新登录');?>
", '?m=login');
        } else {
            if (XMLHttpRequest.status === 500) {
                notice("<?php echo L('服务器错误，请尝试刷新或检查网络是否正确');?>
？");
            } else {
                /* notice('服务器错误，错误信息：' + XMLHttpRequest.responseText);*/
            }

        }
    }
});
function  valid() {
    if ($("#form").length != 0) {
        $("#form").valid();
    }
}
function send(reset) {
    if (typeof (reset) != "undefined" && reset == "prev") {
        var page = $('input[name=page]').val();
        page--;
        if (page < 0) {
            page = 0;
        }

        $('input[name=page]').val(page);
    }

    var form = $(".submit").attr("form");
    var formown = $("#" + form);
    var url = $("#" + form).attr("action");
    var option = $("#" + form).attr("data");
    if (typeof (option) == 'undefined') {
        option = {"type": "next"};
    }

    if (formown.valid()) {
        if (option['type'] == 'next') {
            $("div.content").html("");
            $("div.content").addClass("loading _301_1_gif");
        }
        $.ajax({
            url: url,
            method: "POST",
            //dataType: "html",
            async: true,
            data: formown.serialize(),
            success: function (result) {
                if (result.indexOf("<?php echo L('该资源需要超级管理员才可以使用');?>
") > 0) {
                    $("html").html("");
                    location.reload();
                }
//                if(result.indexOf("<?php echo L('<');?>
") != 0){
//                    layer.msg(result);
//                    exit();
//                }
               // layer.msg(eval(result));
              // var res=eval(result);
               //alert(res[0].msg);
               
               
                if (option['type'] == 'next') {
                    $("div.content").removeClass("loading _301_1_gif");
                    if (result != "") {
                        $("div.content").html(result);
                    }
                    if(result=="\"<?php echo L('该月份报表不存在');?>
。。。(；′⌒`)\""){
                        $("input[name=ep_id]").val("0");
                        $("input[name=ep_id1]").val("0");
                        $("input[name=ep_name]").val("<?php echo L('直属企业');?>
");
                        $("input[name=type]").val("emp");
                    }
                    (function () {
                        var cur = Number($("span.totalpages").text());
                        var pages = Number($("span.pages").text());

                        if (cur == pages) {
                            $(".page .next").addClass("lock");
                        }
                        if (cur == '1') {
                            $(".page .prev").addClass("lock");
                        }

                        /** 产生页码 */
                        var gotopage = $("<select></select");

                        if (pages > 0) {
                            for (var i = 1; i <= pages; i++) {
                                var tmp = $("<option></option>");
                                tmp.text(i);
                                tmp.attr("page", i);
                                gotopage.append(tmp);
                            }
                            gotopage.val(cur);
                            $(".page .next").after(gotopage);
                        }
                    })();
                } else {
                    if (result == "false") {
                        $(".addmore").addClass("none");
                        $("div.newtable").unbind("scroll");
                        $("a.init_button").trigger("click");
                        return;
                    }
                    if (result == "none") {
                        $(".addmore").addClass("none");
                        $("div.newtable").unbind("scroll");
                        $("table.base tr").not(".head").remove();
                        $("a.init_button").trigger("click");
                        return;
                    }
                    var page = formown.find('input[name=page]');
                    if (page.val() == '0') {
                        $("table.content tr").remove();
                    }
                    $("table.content").append(result);
                    $("div.newtable").unbind("scroll");
                    $("div.newtable").bind("scroll", scr);
                    $(".addmore").removeClass("none");
                    $("a.init_button").trigger("click");
                }
                /** Tools Tips*/
                $("tr[title],a.title,td[title],.tips_title,a").tooltip({
                    content: function () {
                        return $(this).attr('title');
                    }
                    , track: true
                    , show: false
                    , hide: false
                });

                $("a.init_button").trigger("click");
            }
        });
    }

}


jQuery.validator.addMethod("selected", function (value, element) {
    if (value == "" || value == null || value == "@") {
        return false;
    } else {
        return true;
    }
}, "<?php echo L('*');?>
");
$.ajaxSetup({
    async: false
});
var timestamp = new Date().getTime();

function initPage() {
    $("div.content").delegate(".page .prev,.page .next", "click", function () {
        if (!$(this).hasClass("lock")) {
            var page = $(this).attr("page");
            $("input[name=page]").val(page);
            send();
        }
    });
    var pa = $("input[name=page]").val();
    if (pa > 0) {
        $(function () {
            $("input[name=page]").val(pa);
            send();
        });
    }
    $("div.content").delegate(".page select", "change", function () {
        var page = $(this).val();
        $("input[name=page]").val(Number(page) - 1);
        send();

    });
}

function initTable() {
    $("div.content").delegate("#checkall", "click", function () {
        if ($("#checkall").is(":checked")) {
            $("input.cb:not([disabled])").prop("checked", "checked");
            var checkd = [];
            $("input.cb:checkbox:checked").each(function () {
                checkd.push($(this).val());
            });
            $("#num").html(checkd.length);
        } else {
            var checkd = [];
            $("input.cb").removeAttr("checked");
            $("input.cb:checkbox:checked").each(function () {
                checkd.push($(this).val());
            });
            $("#num").html(checkd.length);
        }
    });
}

function initSubmit() {
    $(".submit").click(function () {
        $("input[name=page]").val(0);
        send();
    });
}

function autoEditInit() {
    if ($("select.autofix").length === 0) {
        autoEdit();
        $("script[type=ready]").each(function () {
            eval($(this).html());
            $(this).removeAttr("type");
        });
        valid();
    }
    if ($("div.autofix").length === 0) {
        autoEdit();
        $("script[type=ready]").each(function () {
            eval($(this).html());
            $(this).removeAttr("type");
        });
        valid();
    }
}

/**/
function autoEdit() {
    $("select.autoedit").each(function () {
        var val = $(this).attr("value");
        $(this).val(val);
    });
    $("select.autoeditselect").each(function () {
        var val = eval($(this).attr("value"));
        $(this).val(val);
    });
    $("div.radioset").each(function () {
        var val = $(this).attr("value");
        if (val === "") {
            $(this).find("input").first().prop("checked", "checked");
        } else {
            $(this).find("input[value=" + val + "]").prop("checked", "checked");
        }
        $(this).buttonset();
    });

    $("div.checkbox").each(function () {
        var val = $(this).attr("value");
        if (val == "1") {
            $(this).find("input[type=checkbox]").prop("checked", "checked");
        }
    });

    $("div.radio").each(function () {
        var val = $(this).attr("value");
        if (val !== "") {
            $(this).find("input[value=" + val + "]").trigger("click");
        }
    });
}

function initFix() {
    $("select.autofix").each(function () {
        var url = $(this).attr("action");
        var owner = $(this);
        $.ajax({
            url: url,
            success: function (result) {
                owner.append(result);
                owner.removeClass("autofix");
                autoEditInit();
            }
        });
    });
    $("div.autofix").each(function () {
        var url = $(this).attr("action");
        var owner = $(this);
        $.ajax({
            url: url,
            success: function (result) {
                owner.append(result);
                owner.removeClass("autofix");
                autoEditInit();
            }
        });
    });
}
var scr = function () {
    var own = $(this);
    var height = $(".newtable > table").height() - own.scrollTop();
    if ((parseInt(height) - 250) < 0) {
        $("a.addmore").trigger("click");
    }
};

$("a.addmore").bind("click", function () {
    var owner = $(this);
    var page = $("input[name=page]").val();
    page++;
    $("input[name=page]").val(page);
    owner.attr("page", page);
    var pagen = $("input[name=page]").val();
    var pagem = Math.ceil(($("#ninfo").text()) / 10);
    if (pagen >= pagem) {
        $("a.addmore").addClass("none");
    }
    send();
});

(function autoInit() {
    initSubmit();
    initFix();
    initPage();
    initTable();
    autoEditInit();
    $(".submit").trigger("click");
})();
(function () {
    $("input.auto_toggle").bind("click", function () {
        var url = $(this).attr("action");
        var owner = $("." + url);
        if ($(this).is(":checked")) {
            owner.show();
            $(".auto_toggle_open").attr("disabled", false);
        } else {
            owner.hide();
            $(".auto_toggle_open").attr("disabled", true);
        }
    });
})();
(function () {
    $(".auto_next_toggle").click(function () {
        $(this).next().toggle(222);
    });
})();
/**
 * 日历控件时间格式化
 * @returns {undefined}
 */
(function () {
    var picker_date=$("input.datepickeraccount.start").val();
    $("input.datepicker.start").datetimepicker({timeFormat: "HH:mm:ss",
        dateFormat: "yy-mm-dd"});
    $("input.datepicker.end").datetimepicker({timeFormat: "HH:mm:ss",
        dateFormat: "yy-mm-dd"});
     $("input.datepickers.start").datepicker({timeFormat: "HH:mm:ss",
        dateFormat: "dd/mm/yy"});
    $("input.datepickeraccount.start").datepicker( { 
        changeMonth: true, 
        changeYear: true, 
        showButtonPanel: false, 
        dateFormat: 'yy-mm', 
        defaultDate:"-1M", 
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            
            $(this).datepicker('setDate', new Date(year, month, 1));
            month=parseInt(month)+1;
            if(month<10&&month>=1){
                month="0"+month;
            }
             var date=year+"-"+month;
             $("input.datepickeraccount.start").attr("value",date);
                $("select[name=ag_number]").attr('action',"?m=account&a=option&start="+date);
                var url = $("select[name=ag_number]").attr("action");
                //url += "&d_area=@";
                $.ajax({
                    url: url,
                    success: function (result) {
                        var res="<option value='0'><?php echo L('直属企业');?>
</option>";
                        res +=result;
                        $("select[name=ag_number]").html(res);
                    }
                });
                 if($("input[name=ep_name]").val()!=""){
                var option_ag=$("input[name=ep_id]").val();
                $("#select_ag option").each(function(){
                   if(option_ag==$(this).val()){
                       $(this).attr("selected","selected");
                   }
                    
                });
                //$("#select_ag").find("option[text='"+option_ag+"']").attr("selected",true);
            }
            send();
        },

        onChangeMonthYear : function(year, month, inst) {
            if(month<10&&month>=1){
                month="0"+month;
            }
             var date=year+"-"+month;
            $("input.datepickeraccount.start").attr("value",date);
            $("select[name=ag_number]").attr('action',"?m=account&a=option&start="+date);
            var url = $("select[name=ag_number]").attr("action");
            //url += "&d_area=@";
            $.ajax({
                url: url,
                success: function (result) {
                    var res="<option value='0'><?php echo L('直属企业');?>
</option>";
                    res +=result;
                    $("select[name=ag_number]").html(res);
                }
            });
            if($("input[name=ep_name]").val()!=""){
                var option_ag=$("input[name=ep_id]").val();
                $("#select_ag option").each(function(){
                   if(option_ag==$(this).val()){
                       $(this).attr("selected","selected");
                   }
                    
                });
                //$("#select_ag").find("option[text='"+option_ag+"']").attr("selected",true);
            }
            send();
        }
    });
     $("input.datepickerreport.start").datepicker({timeFormat: "HH:mm:ss",
        dateFormat: "yy-mm-dd"});
     $("input.datepickerreport.end").datepicker({timeFormat: "HH:mm:ss",
        dateFormat: "yy-mm-dd"});
})();
(function () {
    valid();
    var submiting = function () {
        notice("<?php echo L('正在提交中，无法再次提交。如需要提交，请刷新后操作');?>
");
    };
    var submitpost = function () {
        if ($("#form").valid()) {
            var form = $("a.ajaxpost").attr("form");
            var goto = $("a.ajaxpost").attr("goto");
            var url = $("#" + form).attr("action");
            var data = $("#form").serialize();
            $(this).unbind("click");
            $.ajax({
                url: url,
                method: "POST",
                dataType: "json",
                data: data,
                success: function (result) {
                    if (result.status == 0) {
                        notice(result.msg, goto);
                    } else {
                        $("a.ajaxpost").bind("click", submitpost);
                        notice(result.msg);
                    }
                }
            });
        } else {
            $("select.error:first").focus();
            $("input.error:first").focus();

        }
    };
    $("a.ajaxpost").bind("click", submitpost);
})();
(function () {
    $("a.goback").click(function () {
        var href = typeof ($(this).attr("action"));
        if (href == "undefined") {
            window.history.back();
        } else {
            location.href = $(this).attr("action");
        }
    });
})();
$("select.clickfix").each(function () {
    $(this).bind("click", function () {
        var owner = $(this);
        var url = $(this).attr("action");
        $.ajax({
            url: url,
            success: function (result) {
                owner.append(result);
                owner.unbind("click");
            }
        });
    });
});
function hereDoc(f) {
    return f.toString().replace(/^[^\/]+\/\*!?\s?/, '').replace(/\*\/[^\/]+$/, '');
}
var bug = hereDoc(function () {
    /*
     */
});
(function () {
    $(".renderjson").each(function () {
        var owner = $(this);
        var json = eval(owner.text());
        var span = $("<span></span>");
        span.text(json[0].name);
        span.attr('data', owner.text());
        owner.html(span);
        owner.removeClass('renderjson').addClass('rendered');
    });
})();
/**
 * 去除数组重复元素
 */
function uniqueArray(data) {
    data = data || [];
    var a = {};
    for (var i = 0; i < data.length; i++) {
        var v = data[i];
        if (typeof (a[v]) == 'undefined') {
            a[v] = 1;
        }
    }
    ;
    data.length = 0;
    for (var i in a) {
        data[data.length] = i;
    }
    return data;
}
Array.prototype.indexOf = function (val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == val)
            return i;
    }
    return -1;
};
Array.prototype.remove = function (val) {
    var index = this.indexOf(val);
    if (index > -1) {
        this.splice(index, 1);
    }
};
/**
 * 查看密码
 */
$("label.show_passwd").mousedown(function(){
        //$(this).val($("#password").val());
        $("#password").attr("type","text");
        $("label.show_passwd").html("<?php echo L('隐藏密码');?>
");
});
$("label.show_passwd").mouseup (function(){
        //$(this).prev().val($("input[type=password]").val());
        $("#password").attr("type","password");
        $("label.show_passwd").html("<?php echo L('查看密码');?>
");
});
/**
 * 密码框 延迟加载
 */
/*
$(document).ready(function(){	
    $("input[type=password]").iPass();
    if($("input[name=do]").val()=="edit"){
            $("input[name=password-0]").val("●●●●●●●●●●●●●●");
    }
});
*/

function banBackSpace(e){     
    var ev = e || window.event;//获取event对象     
    var obj = ev.target || ev.srcElement;//获取事件源     
      
    var t = obj.type || obj.getAttribute('type');//获取事件源类型    
      
    //获取作为判断条件的事件类型  
    var vReadOnly = obj.getAttribute('readonly');  
    var vEnabled = obj.getAttribute('enabled');  
    //处理null值情况  
    vReadOnly = (vReadOnly == null) ? false : vReadOnly;  
    vEnabled = (vEnabled == null) ? true : vEnabled;  
      
    //当敲Backspace键时，事件源类型为密码或单行、多行文本的，  
    //并且readonly属性为true或enabled属性为false的，则退格键失效  
    var flag1=(ev.keyCode == 8 && (t=="password" || t=="text" || t=="textarea" || t=="number")   
                && (vReadOnly==true || vEnabled!=true))?true:false;  
     
    //当敲Backspace键时，事件源类型非密码或单行、多行文本的，则退格键失效  
    var flag2=(ev.keyCode == 8 && t != "password" && t != "text" && t != "textarea"&& t != "number")  
                ?true:false;          
      
    //判断  
    if(flag2){  
        return false;  
    }  
    if(flag1){     
        return false;     
    }     
}  
  
//禁止后退键 作用于Firefox、Opera  
document.onkeypress=banBackSpace;  
//禁止后退键  作用于IE、Chrome  
document.onkeydown=banBackSpace;  
  /**
   * 键盘限制输入 
   * @returns {undefined}
   */
  function keyPress() {  
     var keyCode = event.keyCode;  
     if ((keyCode >= 48 && keyCode <= 57))  
    {  
         event.returnValue = true;  
     } else {  
           event.returnValue = false;  
    }  
 } 

 //列表页分条数显示
function clickPage(self){
    var url = $(self).parent().attr("url");
    var num = parseInt($(self).html());
    var type = $(self).parent().attr("type");
    var args = {num:num};
    switch (type) {
        case 'ent':
            args = {ent_num:num};
            break;
        case 'user':
            args = {user_num:num};
            break;
        case 'gprs':
            args = {gprs_num:num};
            break;
        case 'ter':
            args = {ter_num:num};
        case 'cont':
            args = {cont_num:num};
            break;
    }
    $("input[name=page]").val(0);
    $("input[name=num]").val(num);
    $(self).css('background','#E5E5E5');
    $(self).siblings().css('background','#CCCCCC');
    $.ajax({
        url: url,
        method: "POST",
        data: args,
        success: function (result) {
           setTimeout( function(){ send(); }, 100 );
        }
    });
}<?php }} ?>