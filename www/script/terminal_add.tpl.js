/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function L(str) {
    window.lang=eval(window.lang);
    if (typeof (window.lang[str]) !== 'undefined') {
        str = window.lang[str];
    }
    return str;
}
var index = parent.layer.getFrameIndex(window.name);

    $("#submit").click(function(){
        //判断版本号是否符合规则
    var flag=false;
        var tt_type=$("input[name=tt_type]").val();
        var match = /^([a-zA-Z0-9\-\－])+$/;
         if(tt_type==""||!match.test(tt_type)){
                 var index=layer.tips(L("类型名称中可包含英文大小写，数字以及符号 '-'"), $("input[name=tt_type]"),{
                            tips:[1, '#A83A3A'],
                            time:4000000
                        });
                flag=true;
                exit();
            }
        if($("input[name=do]").val()!="replace"||$("input[name=old_tt_type]").val()!=$("input[name=tt_type]").val()){
                $.ajax({
                url:'?m=terminal&a=check_type_name',
                async: false,
                data:{tt_type:tt_type},
                success:function(res){
                        if(res=="0"){
                        var index=layer.tips(L('终端名称已存在'), $("input[name=tt_type]"),{
                            tips:[1, '#A83A3A'],
                            time:4000000
                        });
                            flag=true;
                            exit();
                        }else{
                             layer.close(index);
                            flag=false;
                        }
                    }
                });
    }
          var soft_name=$("input[name=fileToUpload]").val();
             var match= /.jpg$/i;
        if(($("input[name=do]").val()=="replace"&&$("input[name=fileToUpload]").val()!="")||$("input[name=old_tt_type]").val()==""){
               //判断上传图片是否符合规则
           
              if(!match.test(soft_name)){
                 var index=layer.tips(L('终端图片格式不正确'), $("input[name=fileToUpload]"),{
                            tips:[1, '#A83A3A'],
                            time:4000000
                        });
                 flag=true;
             }else{
                flag=false; 
                }
        }
      if(flag==false){
        $("#form").ajaxSubmit({  //dataType:'script',
                                type:'post',
                                url: "?m=terminal&a=terminal_upload",    
                                beforeSubmit: function(){
                                    parent.layer.msg(L('上传中...'));
                                },
                                success: function(data){
                                    if(data=="1"){
                                            parent.layer.msg(L('上传完成'), {
                                                                        icon: 1,
                                                                        time: 2000 //3秒关闭（如果不配置，默认是3秒）
                                                                    }, function(){
                                                                     parent.location.href="?m=terminal&a=index_type";                                            
                                                                    //parent.layer.close(index);
                                                                    });

                                            
                                    }else if(data=="2"){
                                        parent.layer.msg(L('文件上传失败'), '#closeIframe');
                                    }           
                                },
                                resetForm: false,
                                clearForm: false
                            });
                        }

       
    });
   
    /**
     * 获得上传文件路径
     * @param {type} obj
     * @returns {undefined}
     */
    function getFiles(obj) {
    document.work_form.path.value = obj.value;

    var pt = $("input[name='ptype']").val();
    var match_an = /.apk$/i;
    var match_ios = /.ipa$/i;

    if (navigator.userAgent.indexOf("MSIE") != -1 && !obj.files) {
        $("input[name='browsversion']").val('ie');
        var filePath = obj.value;
        if (pt == 'android' && !match_an.test(filePath)) {
            notice(L('上传文件应以【.apk】格式结尾'));
            document.getElementById('light').style.display = 'none';
            document.getElementById('fade').style.display = 'none';
        } else if (pt == 'ios' && !match_ios.test(filePath)) {
            notice(L('上传文件应以【.ipa】格式结尾'));
            document.getElementById('light').style.display = 'none';
            document.getElementById('fade').style.display = 'none';
        }

    } else {
        var file = document.forms['work_form']['soft_name'].files[0];
        if (file.size >= 31457280 || file.size == 0) {
            notice(L('上传文件超出允许上传限制30M或文件大小为0'));
            document.getElementById('light').style.display = 'none';
            document.getElementById('fade').style.display = 'none';
        }
        if (pt == 'android' && !match_an.test(file.name)) {
            notice(L('上传文件应以【.apk】格式结尾'));
            document.getElementById('light').style.display = 'none';
            document.getElementById('fade').style.display = 'none';
        } else if (pt == 'ios' && !match_ios.test(file.name)) {
            notice(L('上传文件应以【.ipa】格式结尾'));
            document.getElementById('light').style.display = 'none';
            document.getElementById('fade').style.display = 'none';
        }
    }
}    

    //关闭iframe
    $('#closeIframe').click(function(){
        parent.layer.tips(L('请填写正确的版本号'), '#closeIframe');
        parent.layer.close(index);
    });

function checktype(){
    var tt_type=$("input[name=tt_type]").val();
    var match = /^([a-zA-Z0-9\-\－])+$/;
     if(tt_type==""||!match.test(tt_type)){
                 var index=layer.tips(L("类型名称中可包含英文大小写，数字以及符号 '-'"), $("input[name=tt_type]"),{
                            tips:[1, '#A83A3A'],
                            time:4000000
                        });
                exit();
            }else{
                layer.closeAll();
            }
}