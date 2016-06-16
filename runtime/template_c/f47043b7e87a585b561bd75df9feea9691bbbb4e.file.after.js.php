<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:00
         compiled from "..\static\script\after.js" */ ?>
<?php /*%%SmartyHeaderCode:7264576223501cfc48-29110336%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f47043b7e87a585b561bd75df9feea9691bbbb4e' => 
    array (
      0 => '..\\static\\script\\after.js',
      1 => 1463997014,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7264576223501cfc48-29110336',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576223501f2ec9_77015435',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576223501f2ec9_77015435')) {function content_576223501f2ec9_77015435($_smarty_tpl) {?>$("input[required]").focus(function () {
    $("#form").valid();
});

$("a.toggle").click(function () {
    var owner = $(this);
    var toggle = $("." + owner.attr('data'));
    if (owner.text() == "<?php echo L('收缩');?>
↑") {
        owner.text("<?php echo L('展开');?>
↓");
        toggle.addClass('none');
    } else {
        owner.text("<?php echo L('收缩');?>
↑");
        toggle.removeClass('none');
    }
});

$('div.content').delegate('select.only_show', 'change', function () {
    $(this).val(1);
});

/**
*调度台号码选择其他号码
*/

$("select[name=u_alarm_inform_svp_num]").change(function(){
       $("input[name=u_alarm_inform_svp_num]").val($(this).val());
        if($("select[name=u_alarm_inform_svp_num] option:selected").val()=="@"){
               $("input[name=u_alarm_inform_svp_num]").removeClass("none");
               $("input[name=u_alarm_inform_svp_num]").val("");
            }else{
                $("input[name=u_alarm_inform_svp_num]").addClass("none");
            }
});
/**
 * 导航栏访问后背景颜色
 * @type @arr;request
 */
var request = eval($("span.request").text());
var request = request[0];
(function ()
{
    var nav = request.a;
    if (nav != "")
    {
        $("nav a." + nav).addClass("active");
    }
})();

$('div.content').delegate('select.only_show', 'change', function () {
    $(this).val(1);
});

$("#report-jump").bind("click",function(){
    $.ajax({
        url:"?m=get_sessionid",
        success:function(res){
            sessionid=res;
        }
    });
    var url=$("#report-jump").attr('action');
$.ajax({
	url:"?m=ajaxcheck_out",
	dataType:"json",
	success:function(res){
		if(res==-1){
			layer.alert("<?php echo L('帐号长时间未操作,请重新登录');?>
", {icon: 2,title:false,closeBtn:0},function(){
				window.location.href='?m=login';
			});
			
		}else{
			$.ajax({
				url:url+'/validate.php?session_id='+sessionid,
				dataType:"jsonp",
				success:function(data){
					if(data==-2||data==-1){
						layer.msg("账号验证不通过，请检查账号");
					}else{
						window.open(data); 
					}

				}
			});
		}
	}
});	
   
});<?php }} ?>