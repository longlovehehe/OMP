<?php /* Smarty version Smarty-3.1.11, created on 2016-05-21 18:23:35
         compiled from "..\template\modules\enterprise\users_save.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1350357403727a410c2-36517710%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee37c31cf309a22bd48d02374aded8940da20a95' => 
    array (
      0 => '..\\template\\modules\\enterprise\\users_save.tpl',
      1 => 1462762765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1350357403727a410c2-36517710',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'data' => 0,
    'item' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5740372838e543_20515279',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5740372838e543_20515279')) {function content_5740372838e543_20515279($_smarty_tpl) {?><style>form.base label.title, .form label.title{width: 250px;}form.base label.title1, .form label.title1{width: 100px;}</style><h2 class="title"><?php echo L(((string)$_smarty_tpl->tpl_vars['title']->value));?>
</h2><form id="form" class="base mrbt10" action="?m=enterprise&a=users_save_shell"><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" name="e_id" type="hidden" /><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['data']->value['do'];?>
" name="do" type="hidden"><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_product_id_new'];?>
" name="u_product_id_new" type="hidden"><input autocomplete="off"  value="" name="number_stat" type="hidden"><input autocomplete="off"  value="" name="imsi_stat" type="hidden"><input autocomplete="off"  value="" name="iccid_stat" type="hidden"><input autocomplete="off"  value="" name="imei_stat" type="hidden"><input autocomplete="off"  value="OK" name="flag" type="hidden"><input autocomplete="off"  value="OK" name="imei_flag" type="hidden"><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_terminal_type'];?>
" name="md_type" type="hidden"><input type="hidden" name="auto_config" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_auto_config'];?>
"><div class="block <?php if ($_smarty_tpl->tpl_vars['data']->value['do']=='edit'){?>none<?php }?>"><div class="radioset" id="radioset" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['u_sub_type'])===null||$tmp==='' ? 1 : $tmp);?>
"><input autocomplete="off"  value="1" type="radio" id="radio_user" name="u_sub_type"  checked="checked" /><label for="radio_user"><?php echo L("手机用户");?>
</label><input autocomplete="off"  value="2" type="radio" id="radio_shelluser" name="u_sub_type" /><label for="radio_shelluser"><?php echo L("调度台用户");?>
</label><input autocomplete="off"  value="3" type="radio" id="radio_gvsuser" name="u_sub_type" /><label for="radio_gvsuser"><?php echo L("GVS用户");?>
</label></div></div><h3 class="title"><?php echo L("基本属性");?>
</h3><hr /><div class="block"><label class="title"><?php echo L("用户号码");?>
：</label><?php if ($_smarty_tpl->tpl_vars['data']->value['do']!='edit'){?><input autocomplete="off"   maxlength="32" value="" name="u_number"u_number="true" type="text" required="true" /><?php }else{ ?><span class="gradient_light"><?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
</span><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
" name="u_number" type="hidden"><?php }?></div><div class="block"><div style="margin:10px 10px 10px 0px;float:left;"><label class="title"><?php echo L("用户密码");?>
：</label><input autocomplete="off"   maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_passwd'];?>
" pwd="true" name="u_passwd" type="text"  required="true" /><a href="javascript:void(0);" class="get_passwd" style="margin-left:5px;"><?php echo L("使用随机密码");?>
</a></div><div style="clear:both;"></div></div><div class="block"><label class="title"><?php echo L("姓名");?>
：</label><input autocomplete="off"  u_name='true'  maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_name'];?>
" name="u_name" type="text" required="true" /></div><div class="block"><label class="title"><?php echo L("手机号");?>
：</label><input autocomplete="off"   maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_mobile_phone'];?>
" name="u_mobile_phone" type="text" /></div><div class="block"><label class="title" style="float:left;"><?php echo L("备注");?>
：</label><textarea autocomplete="off" maxlength="100" name="u_remark" remark="true" style="width:240px;height:100px;padding:5px;"><?php echo $_smarty_tpl->tpl_vars['item']->value['u_remark'];?>
</textarea></div><div class="block radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_active_state'];?>
"><div class="line"><label class="title"><?php echo L("用户状态");?>
：</label><label class="radiotext"><input autocomplete="off"  value="1" name="u_active_state" type="radio"  checked="checked" /><span><?php echo L("启用");?>
</span></label><label class="radiotext"><input autocomplete="off"  value="0" name="u_active_state" type="radio" /><span><?php echo L("停用");?>
</span></label></div></div><div id="u_only_show_my_grp" class="sw user  shelluser block radio" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['u_only_show_my_grp'])===null||$tmp==='' ? 0 : $tmp);?>
"><label class="title"><?php echo L("只显示本部门");?>
：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" class="u_only_show_my_grp" name="u_only_show_my_grp" type="radio"   /><?php echo L("启用");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" class="u_only_show_my_grp" name="u_only_show_my_grp" type="radio" checked="checked"  /><?php echo L("停用");?>
</label></div></div><div class="block sw user shelluser"><label class="title"><?php echo L("默认群组");?>
：</label><select value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_default_pg'];?>
" name="u_default_pg" class="autofix autoedit" action="?m=enterprise&a=groups_option&safe=true&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" ><option value=""><?php echo L("无");?>
</option></select></div><div class="block sw user"><label class="title"><?php echo L("订购产品");?>
：</label><select value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_product_id'];?>
" name="u_product_id" class="autofix autoedit" action="?m=product&a=option&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" ><option value=""><?php echo L("无");?>
</option></select><div  style="width:220px;padding:5px 0px 5px 250px;"><input name="isused" type="checkbox" value="on"/><label><?php echo L("次月生效");?>
</label><div style="color:#8B2929;padding-top: 10px;" class="show_info none"><?php echo L("次月生效");?>
：<span class="product_new none"><a class="show_product_new"></a><a class="delete " href="javascript:void(0);">×</a></span></div></div></div><div class="block"><label class="title"><?php echo L("部门");?>
：</label><select value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_ug_id'];?>
" name="u_ug_id" class="autofix autoedit" action="?modules=api&action=get_groups_list&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" ><option value=""><?php echo L("无");?>
</option></select></div><div class="sw user block" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_alarm_inform_svp_num'];?>
"><label class="title"><?php echo L("一键告警号码");?>
：</label><select value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_alarm_inform_svp_num'];?>
" action="?m=enterprise&a=shelluser&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" class="autofix autoedit" name="u_alarm_inform_svp_num"><option value=""><?php echo L("无");?>
</option><option value="@"><?php echo L("自定义");?>
</option></select><input class="none" style="margin-left:10px;width:120px;"maxlength="11" type="text" check_number="true" u_alarm_inform_svp_num="true" name="u_alarm_inform_svp_num" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_alarm_inform_svp_num'];?>
"></div><div class="sw user block"><label class="title"><?php echo L("拍传接收号码");?>
：</label><select value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_mms_default_rec_num'];?>
" action="?m=enterprise&a=shelluser&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" class="autofix autoedit"  name="u_mms_default_rec_num"><option value=""><?php echo L("无");?>
</option></select></div><div class="block radio none" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_audio_rec'];?>
"><div class="line"><label class="title"><?php echo L("录音");?>
：</label><label class="radiotext"><input autocomplete="off"  value="1" name="u_audio_rec" type="radio"  /><span><?php echo L("启用");?>
</span></label><label class="radiotext"><input autocomplete="off"  value="0" name="u_audio_rec" type="radio" checked="checked"  /><span><?php echo L("停用");?>
</span></label></div></div><div class="block radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_attr_type'];?>
"><div class="line"><label class="title"><?php echo L("用户分类");?>
：</label><label class="radiotext"><input autocomplete="off"  value="1" name="u_attr_type" type="radio"  /><span><?php echo L("测试");?>
</span></label><label class="radiotext"><input autocomplete="off"  value="0" name="u_attr_type" type="radio" checked="checked"  /><span><?php echo L("商用");?>
</span></label></div></div><div class="block radio none" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_video_rec'];?>
"><div class="line"><label class="title"><?php echo L("录像");?>
：</label><label class="radiotext"><input autocomplete="off"  value="1" name="u_video_rec" type="radio"  /><span><?php echo L("启用");?>
</span></label><label class="radiotext"><input autocomplete="off"  value="0" name="u_video_rec" type="radio" checked="checked"  /><span><?php echo L("停用");?>
</span></label></div></div><div class="sw user block"><label class="title"><?php echo L("GPS定位上报方式");?>
：</label><select name="u_gis_mode" class="autoedit" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['u_gis_mode'])===null||$tmp==='' ? 3 : $tmp);?>
"><option value="0"><?php echo L("不上报");?>
</option><option value="1"><?php echo L("强制百度智能定位");?>
</option><option value="3"><?php echo L("强制百度GPS定位");?>
</option><option value="4"><?php echo L("强制GPS定位");?>
</option><option value="2"><?php echo L("客户端设置");?>
</option></select></div><div class="sw user block"><label class="title"><?php echo L("终端型号");?>
：</label><select  name="u_terminal_type" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_terminal_type'];?>
" class="autoedit autofix" action="?m=terminal&a=option"><option value=""><?php echo L("其他");?>
</option></select></div><div class="block radio sw user" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_auto_config'];?>
"><label class="title"><?php echo L("自动登录开关");?>
：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" name="u_auto_config" type="radio" /><?php echo L("开");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" name="u_auto_config" type="radio" checked="checked" /><?php echo L("关");?>
</label></div></div><div class="auto_config <?php if ($_smarty_tpl->tpl_vars['item']->value['u_auto_config']==0){?>hide<?php }?> "><div class="sw user block none"><label class="title">UDID：</label><input autocomplete="off"   maxlength="40" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_udid'];?>
" name="u_udid" u_udid="true" type="text" req /></div><div class="sw user block"><label class="title">IMSI：</label><input autocomplete="off"   maxlength="15" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_imsi'];?>
" name="u_imsi" u_imsi="true" type="text"  /></div><div class="sw user block"><label class="title">IMEI：</label><input autocomplete="off"   maxlength="15" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_imei'];?>
" name="u_imei" u_imei="true" type="text"  /></div><div class="sw user block"><label class="title">ICCID：</label><input autocomplete="off"   maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_iccid'];?>
" name="u_iccid" u_iccid="true" type="text"  /></div><div class="sw user block"><label class="title">MAC：</label><input autocomplete="off"   maxlength="12" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_mac'];?>
" name="u_mac" u_mac="true" type="text" /></div><div class="block user radio" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['u_bind_phone'])===null||$tmp==='' ? 0 : $tmp);?>
"><label class="title"><?php echo L("机卡绑定");?>
：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" name="u_bind_phone" type="radio" /><?php echo L("是");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" name="u_bind_phone" type="radio" checked="checked" /><?php echo L("否");?>
</label></div></div><div class="block user radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_gprs_genus'];?>
"><label class="title"><?php echo L("流量卡所属");?>
：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" name="u_gprs_genus" type="radio" /><?php echo L("用户自有");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" name="u_gprs_genus" type="radio" checked="checked" /><?php echo L("运营商提供");?>
</label></div></div><div class="block user radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_auto_run'];?>
"><label class="title"><?php echo L("强制开机启动");?>
(<?php echo L("仅限App");?>
)：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" name="u_auto_run" type="radio" /><?php echo L("启用");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" name="u_auto_run" type="radio" checked="checked" /><?php echo L("停用");?>
</label></div></div><div class="sw block user radio" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['u_checkup_grade'])===null||$tmp==='' ? 1 : $tmp);?>
"><label class="title"><?php echo L("程序检查更新");?>
(<?php echo L("仅限App");?>
)：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" name="u_checkup_grade" type="radio" /><?php echo L("启用");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" name="u_checkup_grade" type="radio" checked="checked" /><?php echo L("停用");?>
</label></div></div><div class="sw block user radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_encrypt'];?>
"><label class="title"><?php echo L("信令加密");?>
：</label><div class="line"><label class="radiotext"><input autocomplete="off"  value="1" name="u_encrypt" type="radio" /><?php echo L("启用");?>
</label></div><div class="line"><label class="radiotext"><input autocomplete="off"  value="0" name="u_encrypt" type="radio" checked="checked" /><?php echo L("停用");?>
</label></div></div><div class="sw user block radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_audio_mode'];?>
"><div class="line radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_audio_mode'];?>
"><label class="title"><?php echo L("语音通话方式");?>
：</label><label class="radiotext"><input autocomplete="off"  value="0" name="u_audio_mode" type="radio"  /><span><?php echo L("移动电话");?>
</span></label><label class="radiotext"><input autocomplete="off"  value="1" name="u_audio_mode" type="radio" checked="checked"  /><span><?php echo L("VoIP电话");?>
</span></label></div></div></div><div class="sw user"><h3 class="title"><?php echo L("详细属性");?>
</h3><hr /><!-- <div class="block radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_sex'];?>
"><label class="title"><?php echo L("性别");?>
：</label><div class="line"><label><input autocomplete="off"  value="M" name="u_sex" type="radio" checked="checked" />&nbsp;<?php echo L("男");?>
&nbsp;&nbsp;&nbsp;</label></div><div class="line"><label><input autocomplete="off"  value="F" name="u_sex" type="radio" />&nbsp;<?php echo L("女");?>
</label></div></div> --><div class="block"><label class="title"><?php echo L("职位");?>
：</label><input autocomplete="off"   maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_position'];?>
" name="u_position" type="text"  /></div><div class="block"><label class="title"><?php echo L("购买日期");?>
：</label><input autocomplete="off" class="datepickers start"  maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_purch_date'];?>
" name="u_purch_date" type="text"  /></div><div class="block"><label class="title"><?php echo L("终端序列号");?>
：</label><input autocomplete="off" chrnum="true"  maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_terminal_number'];?>
" name="u_terminal_number" type="text"  /></div><div class="block none"><label class="title"><?php echo L("机型");?>
：</label><input autocomplete="off"   maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_terminal_model'];?>
" name="u_terminal_model" type="text"  /></div><div class="block none"><label class="title"><?php echo L("蓝牙标识号");?>
：</label><input autocomplete="off"   maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_zm'];?>
" name="u_zm" type="text"  /></div></div><div class="block sw user none"><label class="title"><?php echo L("头像");?>
：</label><input autocomplete="off"  value="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_pic'];?>
" name="u_pic" type="hidden"  /><a id="fileToUploadT" class="button normal small none"><?php echo L("浏览");?>
</a><a id="upload" class="button normal small none"><?php echo L("上传");?>
</a><span id="file_name_text"></span><div class="info"><?php echo L("仅支持jpg格式，2M以下");?>
</div></div></form><div class="sw user none"><form class="" id="fileupdate" name="fileupdate" method="post" action="?m=enterprise&a=users_face"  enctype="multipart/form-data" target="hidden_frame">&nbsp;&nbsp;&nbsp;<input type="text" name="path" readonly style="width: 130px;"><a id="zdll" href="javascript:void(0);" ><?php echo L("浏览");?>
<input id="fileToUpload" name="fileToUpload" type="file" style="position:absolute;left:0;top:0;width:80px;height:35px;z-index:999;background-color:transparent ;filter:alpha(opacity=0);-moz-opacity:0;opacity:0;clear: both;" onchange="getFiles(this);"/></a>&nbsp;&nbsp;&nbsp;<input id='uppic' type="submit" value="<?php echo L('上传');?>
" /></form></div><iframe name="hidden_frame" id="hidden_frame" class="hidden_frame"></iframe><div class="buttons mrtop40"><a goto="?m=enterprise&a=users&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" form="form" class="ajaxpost_u button normal"><?php echo L("保存");?>
</a><a class="goback button" action="?m=enterprise&a=users&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><?php echo L("取消");?>
</a></div>
<script>
    var e_id = '<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
';
    var arg_iccid = $("input[name=u_iccid]");
    var arg_imsi = $("input[name=u_imsi]");
    var arg_number = $("input[name=u_mobile_phone]");
    var flag = $("input[name=flag]");
    var iccid_stat = $("input[name=iccid_stat]");
    var imsi_stat = $("input[name=imsi_stat]");
    var number_stat = $("input[name=number_stat]");
    var u_auto_config = $("input[name=u_auto_config]");
    var auto_config = '0';
    var md_type = $("input[name=md_type]").val();
    if(md_type!=""){
        $("input[name=u_terminal_number]").attr("readonly","readonly");
    }
     $(document).ready(function () {
        $("a.ajaxpost_u").click(function () {
            if($("input[name=md_type]").val()==""&&$("input[name=auto_config]").val()=="0"){
                $("input[name=imei_flag]").val("OK");
                $("input[name=u_imei]").removeClass("error");
                $("input[name=u_imei]").val("");
                $("input[name=u_iccid]").val("");
                $("input[name=u_imsi]").val("");
            }
            check_imei();
            if($("input[name=imei_flag]").val() == "OK"){
                 check_form();
                if ($("#form").valid()) {
                    var form = $("a.ajaxpost_u").attr("form");
                    var url = $("#" + form).attr("action");
                    $.ajax({
                        url: url,
                        method: "POST",
                        dataType: "json",
                        data: $("#form").serialize(),
                        success: function (result) {
                            if (result.msg == "<?php echo L('更改为GVS用户会丢失群组信息，是否更改');?>
？") {
                                confirm2(result.msg);
                            } else {
                                notice(result.msg, $("a.ajaxpost_u").attr("goto"));
                            }
                        }
                    });
                }else{
                    $("input.error:first").focus();
                }
            }else{
                    $("input.error:first").focus();
                    $("input.error:first").blur();
                }
        });  
         //验证终端序列号
        $("input[name=u_terminal_number]").on("blur",function(){
            var md_type=$("input[name=md_type]").val();
            if(md_type!=""&&$("input[name=u_imei]").val()!=""){
                 $.ajax({
                    url:"?m=terminal&a=getById_foruser",
                    data:{
                            md_imei:$("input[name=u_imei]").val()
                            },
                    success:function(result){
                        //var result=eval(res);
                        var res = eval("("+result+")");
                         if($("input[name=u_terminal_number]").val()!=res.md_serial_number&&res.md_serial_number!=""){
                                $("input[name=imei_flag]").val("Error");
                                $("input[name=u_terminal_number]").removeClass("valid");
                                $("input[name=u_terminal_number]").addClass("error");
                                $("input[name=u_terminal_number]").attr("aria-required","true");
                                $("input[name=u_terminal_number]").attr("aria-invalid","true");
                                layer.tips("<?php echo L('终端序列号与IMEI不符');?>
",$("input[name=u_terminal_number]"),{
                                    tips:[1, '#A83A3A'],
                                    time:600000
                                });
                                exit();
                        }
                    }
                });
            }
        });
        //验证imei
        $("input[name=u_imei]").on("blur",function(){
            check_imei_blur();
        });
     //验证iccid
        $("input[name=u_iccid]").on("blur",function(){
           check_iccid();
        });
        //验证imsi
        $("input[name=u_imsi]").on("blur",function(){
            $.ajax({
                url:'?m=enterprise&a=geticcid&u_number='+$("input[name=u_number]").val(),
                data:{
                    u_imsi:arg_imsi.val(),
                    e_id:<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
,
                    type:'imsi'
                },
                dataType:'json',
                success:function(res){
                    if(res.status==2){
                        flag.val("Error");
                        imsi_stat.val(res.status);
                        arg_imsi.addClass("error");
                        arg_imsi.attr("aria-required","true");
                        arg_imsi.attr("aria-invalid","true");
                        layer.tips("<?php echo L('IMSI已绑定，请确认后重新输入');?>
",arg_imsi,{
                            tips:[1, '#A83A3A'],
                            time:600000
                        });
                        exit();
                    }else if(res.status==1){
                        flag.val("OK");
                        imsi_stat.val(res.status);

                    }else if(res.status==4){
                        var check = true;
                        var check1 = true;
                        //如果填写的iccid存在，并适用,自动填充imsi,手机号 以及对应判断
                        if(arg_number.val()==''){
                            arg_number.val(res.info.g_number);
                        }else{
                            if(res.info.g_number!='' && res.info.g_number!=arg_number.val()){
                                flag.val("Error");
                                number_stat.val(res.status);
                                arg_number.addClass("error");
                                arg_number.attr("aria-required","true");
                                arg_number.attr("aria-invalid","true");
                                layer.tips("<?php echo L('所填写的手机号不正确，请检查后重新填写');?>
",arg_number,{
                                    tips:[1, '#A83A3A'],
                                    time:600000
                                });
                                check = false;
                            }else{
                                check =true;
                            }
                        }

                        if(arg_iccid.val()==''){
                            arg_iccid.val(res.info.g_iccid);
                        }else{
                            if(res.info.g_iccid!='' && res.info.g_iccid!=arg_iccid.val()){
                                flag.val("Error");
                                iccid_stat.val(res.status);
                                arg_iccid.addClass("error");
                                arg_iccid.attr("aria-required","true");
                                arg_iccid.attr("aria-invalid","true");
                                layer.tips("<?php echo L('所填写的ICCID不正确，请检查后重新填写');?>
",arg_iccid,{
                                    tips:[1, '#A83A3A'],
                                    time:600000
                                });
                                check1 = false;
                            }else{
                                check1=true;
                            }
                        }
                        if(check==false || check1==false){
                            flag.val("Error");
                            exit();
                        }else{
                            flag.val("OK");
                            number_stat.val(res.status);
                        }
                    }else if(res.status==3){
                        flag.val("Error");
                        imsi_stat.val(res.status);
                        arg_imsi.addClass("error");
                        arg_imsi.attr("aria-required","true");
                        arg_imsi.attr("aria-invalid","true");
                        layer.tips("<?php echo L('所填写的IMSI不正确，请检查后重新填写');?>
",arg_imsi,{
                            tips:[1, '#A83A3A'],
                            time:600000
                        });
                        exit();
                    }
                    //做到提示信息 不正确 还有 自动填充
                    layer.closeAll('tips');
                }
            });

        });
        //验证u_mobile_number
        $("input[name=u_mobile_phone]").on("blur",function(){
            $.ajax({
                url:'?m=enterprise&a=geticcid&u_number='+$("input[name=u_number]").val(),
                data:{
                    u_mobile_phone:arg_number.val(),
                    e_id:<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
,
                    type:'number'
                },
                dataType:'json',
                success:function(res){
                    if(res.status==2){
                        flag.val("Error");
                        number_stat.val(res.status);
                         arg_number.addClass("error");
                        arg_number.attr("aria-required","true");
                        arg_number.attr("aria-invalid","true");
                        layer.tips("<?php echo L('手机号已绑定，请确认后重新输入');?>
",arg_number,{
                            tips:[1, '#A83A3A'],
                            time:600000
                        });
                        exit();
                    }else if(res.status==1){
                        flag.val("OK");
                        number_stat.val(res.status);
                    }else if(res.status==5){
                        flag.val("OK");
                        number_stat.val(res.status);
                    }else if(res.status==4){
                        auto_config = $("input[name=u_auto_config]:checked").val();
                        if(auto_config=='1'){
                            var check = true;
                            var check1 = true;
                            //如果填写的iccid存在，并适用,自动填充imsi,手机号 以及对应判断
                            if(arg_imsi.val()==''){
                                arg_imsi.val(res.info.g_imsi);
                            }else{
                                if(res.info.g_imsi!='' && res.info.g_imsi!=arg_imsi.val()){
                                    flag.val("Error");
                                    imsi_stat.val(res.status);
                                    arg_imsi.addClass("error");
                                    arg_imsi.attr("aria-required","true");
                                    arg_imsi.attr("aria-invalid","true");
                                    layer.tips("<?php echo L('所填写的IMSI不正确，请检查后重新填写');?>
",arg_imsi,{
                                        tips:[1, '#A83A3A'],
                                        time:600000
                                    });
                                    check = false;
                                }else{
                                    check=true;
                                }
                            }

                            if(arg_iccid.val()==''){
                                arg_iccid.val(res.info.g_iccid);
                            }else{
                                if(res.info.g_iccid!='' && res.info.g_iccid!=arg_iccid.val()){
                                    flag.val("Error");
                                    iccid_stat.val(res.status);
                                    arg_iccid.addClass("error");
                                    arg_iccid.attr("aria-required","true");
                                    arg_iccid.attr("aria-invalid","true");
                                    layer.tips("<?php echo L('所填写的ICCID不正确，请检查后重新填写');?>
",arg_iccid,{
                                        tips:[1, '#A83A3A'],
                                        time:600000
                                    });
                                    check1 = false;
                                }else{
                                    check1=true;
                                }
                            }
                            if(check==false || check1==false){
                                flag.val("Error");
                                exit();
                            }else{
                                flag.val("OK");
                                number_stat.val(res.status);
                            }
                        }else{
                            if(arg_imsi.val()==''){
                                arg_imsi.val(res.info.g_imsi);
                            }
                            if(arg_iccid.val()==''){
                                arg_iccid.val(res.info.g_iccid);
                            }
                            flag.val("OK");
                        }
                    }else if(res.status==3){
                        flag.val("Error");
                        number_stat.val(res.status);
                         arg_number.addClass("error");
                        arg_number.attr("aria-required","true");
                        arg_number.attr("aria-invalid","true");
                        layer.tips("<?php echo L('所填写的手机号不正确，请检查后重新填写');?>
",$("input[name=u_mobile_phone]"),{
                            tips:[1, '#A83A3A'],
                            time:600000
                        });
                        exit();
                    }
                    //做到提示信息 不正确 还有 自动填充
                    layer.closeAll('tips');
                }
            });
        });
        //提交表单时验证iccid imsi 手机号
        function check_form(){
            auto_config = $("input[name=u_auto_config]:checked").val();
            var u_type = $("#radioset").attr("value");
            if(auto_config=='1' || u_type=='2' || u_type=='3'){
                var isbind = $("input[name=u_bind_phone]:checked").val();
                var ciccid = arg_iccid.val();
                if(isbind=='1'){
                    $("input[name=u_iccid]").attr("required", "true");

                    if(ciccid==''){
                        $("input[name=u_iccid]").focus();
                        exit();
                    }
                }
                //验证iccid
                $.ajax({
                    url:'?m=enterprise&a=geticcid&u_number='+$("input[name=u_number]").val(),
                    data:{
                        u_iccid:arg_iccid.val(),
                        e_id:<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
,
                        type:'iccid'
                    },
                    dataType:'json',
                    success:function(res){
                        if(res.status==2){
                            flag.val("Error");
                            iccid_stat.val(res.status);
                            arg_iccid.addClass("error");
                            arg_iccid.attr("aria-required","true");
                            arg_iccid.attr("aria-invalid","true");
                            arg_iccid.focus();
                            layer.tips("<?php echo L('ICCID已绑定，请确认后重新输入');?>
",arg_iccid,{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }else if(res.status==1){
                            flag.val("OK");
                            iccid_stat.val(res.status);
                        }else if(res.status==5){
                            var u_bind_phone = $("input[name=u_bind_phone]:checked").val();
                            iccid_stat.val(res.status);
                            if(u_bind_phone=='1'){
                                flag.val("Error");
                                arg_iccid.addClass("error");
                                arg_iccid.attr("aria-required","true");
                                arg_iccid.attr("aria-invalid","true");
                                arg_iccid.focus();
                                layer.tips("<?php echo L('此ICCID库中不存在，请检查后重新填写');?>
",arg_iccid,{
                                    tips:[1, '#A83A3A'],
                                    time:600000
                                });
                                exit();
                            }else{
                               flag.val("OK");
                            }
                        }else if(res.status==4){
                            var check = true;
                            var check1 = true;
                            //如果填写的iccid存在并适用，提交时验证imsi是否匹配
                            //res.info.g_imsi!='' && 
                            if(res.info.g_imsi!=arg_imsi.val()){
                                flag.val("Error");
                                imsi_stat.val(res.status);
                                arg_imsi.addClass("error");
                                arg_imsi.attr("aria-required","true");
                                arg_imsi.attr("aria-invalid","true");
                                arg_imsi.focus();
                                layer.tips("<?php echo L('所填写的IMSI不正确，请检查后重新填写');?>
",arg_imsi,{
                                    tips:[1, '#A83A3A'],
                                    time:600000
                                });
                                check = false;
                            }else{
                                check = true;
                            }

                            //如果填写的iccid存在并适用，提交时验证手机号是否匹配
                            if(res.info.g_number!='' && res.info.g_number!=arg_number.val()){
                                flag.val("Error");
                                number_stat.val(res.status);
                                 arg_number.addClass("error");
                                arg_number.attr("aria-required","true");
                                arg_number.attr("aria-invalid","true");
                                arg_number.focus();
                                layer.tips("<?php echo L('所填写的手机号不正确，请检查后重新填写');?>
",arg_number,{
                                    tips:[1, '#A83A3A'],
                                    time:600000
                                });
                                check1 = false;
                            }else{
                                check1 = true;
                            }
                            
                            if(check==false || check1==false){
                                flag.val("Error");
                                exit();
                            }else{
                                flag.val("OK");
                                iccid_stat.val(res.status);
                            }
                            
                        }else if(res.status==3){
                            flag.val("Error");
                            iccid_stat.val(res.status);
                            arg_iccid.addClass("error");
                            arg_iccid.attr("aria-required","true");
                            arg_iccid.attr("aria-invalid","true");
                            arg_iccid.focus();
                            layer.tips("<?php echo L('所填写的ICCID不正确，请检查后重新填写');?>
",arg_iccid,{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }
                        //做到提示信息 不正确 还有 自动填充
                        layer.closeAll('tips');
                    }
                });
                //验证手机号
                $.ajax({
                    url:'?m=enterprise&a=geticcid&u_number='+$("input[name=u_number]").val(),
                    data:{
                        u_mobile_phone:arg_number.val(),
                        e_id:<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
,
                        type:'number'
                    },
                    dataType:'json',
                    success:function(res){
                        if(res.status==2){
                            flag.val("Error");
                            number_stat.val(res.status);
                            arg_number.addClass("error");
                            arg_number.attr("aria-required","true");
                            arg_number.attr("aria-invalid","true");
                            arg_number.focus();
                            layer.tips("<?php echo L('手机号已绑定，请确认后重新输入');?>
",arg_number,{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }else if(res.status==1){
                            flag.val("OK");
                            number_stat.val(res.status);
                        }else if(res.status==4){
                            auto_config = $("input[name=u_auto_config]:checked").val();
                            if(auto_config=='1'){
                                var check = true;
                                var check1 = true;
                                //如果填写的手机号存在并适用，提交时验证IMSI是否匹配
                                if(res.info.g_imsi!='' && res.info.g_imsi!=arg_imsi.val()){
                                    flag.val("Error");
                                    imsi_stat.val(res.status);
                                    arg_imsi.addClass("error");
                                    arg_imsi.attr("aria-required","true");
                                    arg_imsi.attr("aria-invalid","true");
                                    arg_imsi.focus();
                                    layer.tips("<?php echo L('所填写的IMSI不正确，请检查后重新填写');?>
",arg_imsi,{
                                        tips:[1, '#A83A3A'],
                                        time:600000
                                    });
                                    check = false;
                                }else{
                                    check=true;
                                }
                                
                                //如果填写的手机号存在并适用，提交时验证ICCID是否匹配
                                if(res.info.g_iccid!='' && res.info.g_iccid!=arg_iccid.val()){
                                    flag.val("Error");
                                    iccid_stat.val(res.status);
                                    arg_iccid.addClass("error");
                                    arg_iccid.attr("aria-required","true");
                                    arg_iccid.attr("aria-invalid","true");
                                    arg_iccid.focus();
                                    layer.tips("<?php echo L('所填写的ICCID不正确，请检查后重新填写');?>
",arg_iccid,{
                                        tips:[1, '#A83A3A'],
                                        time:600000
                                    });
                                    check1 = false;
                                }else{
                                    check1=true;
                                }
                                
                                if(check==false || check1==false){
                                    flag.val("Error");
                                    exit();
                                }else{
                                    flag.val("OK");
                                    number_stat.val(res.status);
                                }
                            }else{
                                if(arg_imsi.val()==''){
                                    arg_imsi.val(res.info.g_imsi);
                                }
                                if(arg_iccid.val()==''){
                                    arg_iccid.val(res.info.g_iccid);
                                }
                                flag.val("OK");
                            }
                        }else if(res.status==3){
                            flag.val("Error");
                            number_stat.val(res.status);
                             arg_number.addClass("error");
                            arg_number.attr("aria-required","true");
                            arg_number.attr("aria-invalid","true");
                            arg_number.focus();
                            layer.tips("<?php echo L('所填写的手机号不正确，请检查后重新填写');?>
",$("input[name=u_mobile_phone]"),{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }
                        //做到提示信息 不正确 还有 自动填充
                        layer.closeAll('tips');
                    }
                });
                //验证imsi
                $.ajax({
                    url:'?m=enterprise&a=geticcid&u_number='+$("input[name=u_number]").val(),
                    data:{
                        u_imsi:arg_imsi.val(),
                        e_id:<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
,
                        type:'imsi'
                    },
                    dataType:'json',
                    success:function(res){
                        if(res.status==2){
                            flag.val("Error");
                            imsi_stat.val(res.status);
                            arg_imsi.addClass("error");
                            arg_imsi.attr("aria-required","true");
                            arg_imsi.attr("aria-invalid","true");
                            arg_imsi.focus();
                            layer.tips("<?php echo L('IMSI已绑定，请确认后重新输入');?>
",arg_imsi,{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }else if(res.status==1){
                            flag.val("OK");
                            imsi_stat.val(res.status);

                        }else if(res.status==4){
                            var check = true;
                            var check1 = true;
                            //如果填写的IMSI存在并适用，提交时验证手机号是否匹配
                            if(res.info.g_number!='' && res.info.g_number!=arg_number.val()){
                                flag.val("Error");
                                number_stat.val(res.status);
                                arg_number.addClass("error");
                                arg_number.attr("aria-required","true");
                                arg_number.attr("aria-invalid","true");
                                arg_number.focus();
                                layer.tips("<?php echo L('所填写的手机号不正确，请检查后重新填写');?>
",arg_number,{
                                    tips:[1, '#A83A3A'],
                                    time:600000
                                });
                                check = false;
                            }else{
                                check =true;
                            }
                            
                            //如果填写的IMSI存在并适用，提交时验证ICCID是否匹配
                            if(res.info.g_iccid!='' && res.info.g_iccid!=arg_iccid.val()){
                                flag.val("Error");
                                iccid_stat.val(res.status);
                                arg_iccid.addClass("error");
                                arg_iccid.attr("aria-required","true");
                                arg_iccid.attr("aria-invalid","true");
                                arg_iccid.focus();
                                layer.tips("<?php echo L('所填写的ICCID不正确，请检查后重新填写');?>
",arg_iccid,{
                                    tips:[1, '#A83A3A'],
                                    time:600000
                                });
                                check1 = false;
                            }else{
                                check1=true;
                            }
                            
                            if(check==false || check1==false){
                                flag.val("Error");
                                exit();
                            }else{
                                flag.val("OK");
                                number_stat.val(res.status);
                            }
                        }else if(res.status==3){
                            flag.val("Error");
                            imsi_stat.val(res.status);
                            arg_imsi.addClass("error");
                            arg_imsi.attr("aria-required","true");
                            arg_imsi.attr("aria-invalid","true");
                            arg_imsi.focus();
                            layer.tips("<?php echo L('所填写的IMSI不正确，请检查后重新填写');?>
",arg_imsi,{
                                tips:[1, '#A83A3A'],
                                time:600000
                            });
                            exit();
                        }
                        //做到提示信息 不正确 还有 自动填充
                        layer.closeAll('tips');
                    }
                });
            }
        }
        
});
</script>
<?php }} ?>