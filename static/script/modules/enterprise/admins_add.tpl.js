/*限制文本域长度*/
function checktextare() {
    var regC = /[^ -~]+/g;
    var regE = /\D+/g;
    var str = t1.value;

    if (regC.test(str)) {
        t1.value = t1.value.substr(0, 10);
    }

    if (regE.test(str)) {
        t1.value = t1.value.substr(0, 20);
    }
}
jQuery.validator.addMethod("em_pswd", function (value, element) {
    var length = value.length;
    var flag = true;
    /*var mob = /^[0-9]{19}}$/i ;
     var mob1 = /^[0-9]{20}$/i ;*/
    if (/[\u4E00-\u9FA5]/i.test(value)) {
        flag = false;
    }
    return flag;
}, "<%'密码不能为中文字符'|L%>");
jQuery.validator.addMethod("em_pswd1", function (value, element) {
    var length = value.length;
    var flag = true;
    /*var mob = /^[0-9]{19}}$/i ;
     var mob1 = /^[0-9]{20}$/i ;*/
if(!/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,14}$/.test(value)){
         flag = false;
    }
    return flag;
}, "<%'密码为6-14位的数字和字母的组合'|L%>");
jQuery.validator.addMethod("em_name", function (value, element) {
    var flag = false;
    if (/[\u4E00-\u9FA5a-zA-Z\.]$/i.test(value)) {
        flag = true;
    }
    return flag;
}, "<%'姓名只能是汉字、英文字符、.'|L%>");

/**
 * 电话输入框（含国家代码）
 */
$("input.mobile-number").intlTelInput();