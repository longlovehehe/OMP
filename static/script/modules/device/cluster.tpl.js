function del_cluster(cluster_id){
    layer.confirm("<%'是否删除该部署ID?'|L%>",{btn: ["<%'确定'|L%>", "<%'取消'|L%>"],title:"<%'删除'|L%>"},function(){
        $.ajax({
        url:'?m=device&a=cluster_del',
        data:{cluster_id:cluster_id},
        success:function(msg){
            if(msg==0)
            {
            	layer.msg("<%'删除失败'|L%>"); 
            }
            else
            {
                 layer.msg("<%'删除成功'|L%>"); 
                window.location.reload(); 
            }
        }
    });
    });
    
}
