//点击备份数据库 848589
function backup(arg){
    var self = $(arg);
    self.html("<%'备份中'|L%>... ");
    self.removeAttr('onclick');
    self.css("background",'#CCCCCC');
    var index = layer.load(1, {
        shade: [0.3,'#000'] //0.3透明度的黑色背景
    });
    $.ajax({
        async:true,
        url: "?modules=backup&action=makebackup",
        data: {backup:'yes'},
        success: function (data) {
            if(data=='full'){
                layer.closeAll('loading');
                self.html("<%'备份'|L%>");
                self.attr('onclick','backup(this)');
                self.css("background",'#848589');
                notice("<%'手动备份已达上限，请先删除其他记录后再进行备份'|L%>!");
            }else{
                if(data=='yes'){
                    layer.closeAll('loading');
                    layer.msg("<%'备份成功'|L%> ",{
                        icon: 1,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            send();
                        }
                    );
                    self.html("<%'备份'|L%>");
                    self.attr('onclick','backup(this)');
                    self.css("background",'#848589');
                }else{
                    layer.closeAll('loading');
                    self.html("<%'备份'|L%>");
                    self.attr('onclick','backup(this)');
                    self.css("background",'#848589');
                    notice("<%'备份失败请重试'|L%>!");
                }
            }
        }
    });
}

//点击删除对应数据库备份文件
function del(arg){
    var self = $(arg);
    var bname = self.attr('bname');
    layer.confirm("<%'确定要删除此备份文件吗'|L%>?",{btn: ["<%'确定'|L%>", "<%'取消'|L%>"],title:"<%'删除'|L%>"},function(){
        $.ajax({
            url: "?modules=backup&action=delbackup",
            data: {bname:bname},
            success: function (data) {
                if(data=='yes'){
                    layer.msg("<%'删除成功'|L%> ",{
                        icon: 1,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            send();
                        }
                    );
                }else{
                    notice("<%'删除失败请重试'|L%>");
                }
            }
        });
    });
}

//修改自动备份周期
function backup_cycle(arg){
    var self = $(arg);
    var cycletime = self.val();
    $.ajax({
        url: "?modules=backup&action=changeBackupCycle",
        data: {cycletime:cycletime},
        success: function (data) {
            if(data=='yes'){
                layer.msg("<%'修改成功'|L%> ",{
                    icon: 1,
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }
                );
            }else{
                notice("<%'修改失败请重试'|L%>");
            }
        }
    });
}