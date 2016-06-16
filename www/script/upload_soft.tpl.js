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
        var ptt_version=$("input[name=ptt_version]").val();
        var old_ptt_version=$("input[name=old_ptt_version]").val();
        var path=$("input[name=path]").val();
        var match_version = /^(\d{1,})\.(\d{1,})\.(\d{1,})\.(\d){1,}$/;
        if(ptt_version==""&&path==""){
            if(ptt_version==""||!match_version.test(ptt_version)){
                  var index=layer.tips(L('请填写正确的版本号,例：1.0.0.10'), ptt_version=$("input[name=ptt_version]"),{
                                tips:[1, '#A83A3A'],
                                time:4000000
                            });
                return;
            }else{
                layer.closeAll('tips');
            }

            //判断keeper包是否符合规则
           var soft_name=$("input[name=soft_name]").val();
           var match= /.apk$/i;
           if(!match.test(soft_name)){
               var index=layer.tips(L('上传文件格式不正确'), $("input[name=soft_name]"),{
                            tips:[1, '#A83A3A'],
                            time:4000000
                        });
              return;
            }
        }else{
            $("input[name=do]").val("edit");
            if(path==""){
                 if(!match_version.test(ptt_version)){
                    var index=layer.tips(L('请填写正确的版本号,例：1.0.0.10'), $("input[name=ptt_version]"),{
                            tips:[1, '#A83A3A'],
                            time:4000000
                        });
                    return;
                }
               
            }else{
                if(ptt_version==""||!match_version.test(ptt_version)){
                    var index=layer.tips(L('请填写正确的版本号,例：1.0.0.10'), $("input[name=ptt_version]"),{
                            tips:[1, '#A83A3A'],
                            time:4000000
                        });
                    return;
                }
                var soft_name=$("input[name=soft_name]").val();
                var match= /.apk$/i;
                if(!match.test(soft_name)){
                    var index=layer.tips(L('上传文件格式不正确'), $("input[name=soft_name]"),{
                            tips:[1, '#A83A3A'],
                            time:4000000
                        });
                   return;
                 }
                
            }
            
        }
        

        $("#form").ajaxSubmit({  //dataType:'script',
                                type:'post',
                                url: "?m=cms&a=upload_soft_keeper",    
                                beforeSubmit: function(){
                                    parent.layer.msg(L('上传中...'));
                                },
                                success: function(data){
                                    
                                    if(data=="1"){
                                            parent.layer.msg(L('上传完成'), {
                                                                        icon: 1,
                                                                        time: 2000 //3秒关闭（如果不配置，默认是3秒）
                                                                    }, function(){
                                                                     parent.location.href="?m=cms&a=index_keeper";                                            
                                                                    //parent.layer.close(index);
                                                                    });

                                            
                                    }else if(data=="2"){
                                        parent.layer.msg(L('文件上传失败'));
                                    }           
                                },
                                resetForm: false,
                                clearForm: false
                            });

       
    });
    function check_version(obj){
        console.log(obj);
       var ptt_version=$("input[name=ptt_version]").val();
        var match_version = /^(\d{1,})\.(\d{1,})\.(\d{1,})\.(\d){1,}$/;

        if(ptt_version==""){
             var index=layer.tips(L('请填写正确的版本号,例：1.0.0.10'), obj,{
                                tips:[1, '#A83A3A'],
                                time:4000000
                            });
             return;
        }else if(!match_version.test(ptt_version)){
             var index=layer.tips(L('请填写正确的版本号,例：1.0.0.10'), obj,{
                                tips:[1, '#A83A3A'],
                                time:4000000
                            });
            //parent.layer.tips('请填写正确的版本号',obj);
            return;
        }else{
        layer.closeAll('tips');
        }
    }
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
        parent.layer.tips(L('请填写正确的版本号,例：1.0.0.10'), '#closeIframe');
        parent.layer.close(index);
    });

