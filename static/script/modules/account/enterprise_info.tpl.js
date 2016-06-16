$("a.export").click(function(){
    var ep_id = $("input[name=ep_id]").val();
    var start = $("input[name=start]").val();
    var er_id = $("input[name=er_id]").val();

    $("#ifr").attr("src","?m=account&a=export_emp&er_id="+er_id+"&ep_id="+ep_id+"&start="+start);
    
});