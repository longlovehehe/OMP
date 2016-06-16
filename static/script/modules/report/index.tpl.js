/*
Ajax 三级省市联动
日期：2012-7-18

settings 参数说明
-----
url:省市数据josn文件路径
prov:默认省份
city:默认城市
dist:默认地区（县）
nodata:无数据状态
required:必选项
------------------------------ */
(function($){
	$.fn.citySelect=function(settings){
		if(this.length<1){return;};

		// 默认值
		settings=$.extend({
			url:"js/city.min.js",
			prov:null,
			city:null,
			dist:null,
			nodata:null,
			required:false
		},settings);

		var box_obj=this;
		var prov_obj=box_obj.find(".prov");
		var city_obj=box_obj.find(".city");
		var dist_obj=box_obj.find(".dist");
		var prov_val=settings.prov;
		var city_val=settings.city;
		var dist_val=settings.dist;
		var select_prehtml=(settings.required) ? "" : "<option value=''>全部</option>";
		var city_json;

		// 赋值二级函数
		var cityStart=function(){
			var prov_id=prov_obj.get(0).selectedIndex;
			if(!settings.required){
				prov_id--;
			};
			city_obj.empty().attr("disabled",true);
			dist_obj.empty().attr("disabled",true);
			if(prov_id<0||city_json.citylist[prov_id].list==null){

				if(settings.nodata=="none"){
					city_obj.css("display","none");
					dist_obj.css("display","none");
				}else if(settings.nodata=="hidden"){
					city_obj.css("visibility","hidden");
					dist_obj.css("visibility","hidden");
				};
				return;
			};
			
			// 遍历赋值二级下拉列表
			temp_html=select_prehtml;
                        
			$.each(city_json.citylist[prov_id].list,function(i,city){
                                                            if(city.list!=null){
                                                                temp_html+="<option value='"+city.ag_number+"' style='color:#a43838'>┣━"+city.ag_name+"</option>";
                                                            }else{
				temp_html+="<option value='"+city.ag_number+"'>┣"+city.ag_name+"</option>";                                                                
                                                            }
				//temp_html+="<option value='"+city.ag_number+"'>"+city.ag_name+"</option>";
			});
			city_obj.html(temp_html).attr("disabled",false).css({"display":"","visibility":""});
			distStart();
		};

		// 赋值三级函数
		var distStart=function(){
			var prov_id=prov_obj.get(0).selectedIndex;
			var city_id=city_obj.get(0).selectedIndex;
			if(!settings.required){
				prov_id--;
				city_id--;
			};
			dist_obj.empty().attr("disabled",true);

			if(prov_id<0||city_id<0||city_json.citylist[prov_id].list[city_id].list==null){
				if(settings.nodata=="none"){
					dist_obj.css("display","none");
				}else if(settings.nodata=="hidden"){
					dist_obj.css("visibility","hidden");
				};
				return;
			};
			
			// 遍历赋值市级下拉列表
			temp_html=select_prehtml;
			$.each(city_json.citylist[prov_id].list[city_id].list,function(i,dist){
				temp_html+="<option value='"+dist.ag_number+"'>"+dist.ag_name+"</option>";
			});
			dist_obj.html(temp_html).attr("disabled",false).css({"display":"","visibility":""});
		};

		var init=function(){
			// 遍历赋值一级下拉列表
			temp_html=select_prehtml;
			$.each(city_json.citylist,function(i,prov){
                                                            if(prov.list!=null){
                                                                temp_html+="<option value='"+prov.ag_number+"' style='color:#a43838'>┣━"+prov.ag_name+"</option>";
                                                            }else{
				temp_html+="<option value='"+prov.ag_number+"'>┣"+prov.ag_name+"</option>";                                                                
                                                            }

			});
			prov_obj.html(temp_html);

			// 若有传入一级与二级的值，则选中。（setTimeout为兼容IE6而设置）
			setTimeout(function(){
				if(settings.prov!=null){
					prov_obj.val(settings.prov);
					cityStart();
					setTimeout(function(){
						if(settings.city!=null){
							city_obj.val(settings.city);
							distStart();
							setTimeout(function(){
								if(settings.dist!=null){
									dist_obj.val(settings.dist);
								};
							},1);
						};
					},1);
				};
			},1);

			// 选择省份时发生事件
			prov_obj.bind("change",function(){
				cityStart();
			});

			// 选择市级时发生事件
			city_obj.bind("change",function(){
				distStart();
			});
		};

		// 设置省市json数据
		if(typeof(settings.url)=="string"){
			$.getJSON(settings.url,function(json){
				city_json=json;
				init();
			});
		}else{
			city_json=settings.url;
			init();
		};
	};
})(jQuery);


$(function(){	
    $.ajax({
            url:'?m=report&a=getjson',
            dataType:'json',
            success:function(res){
                $("#city_5").citySelect({
                    url:res,
                    prov:"",
                    city:"",
                    dist:"",
                    nodata:"none"
                });
                }
        });
});

$("select[name=lv1]").on("change",function(){
    $("input[name=ep_id]").val($(this).children("option:selected").val());
})
$("select[name=lv2]").on("change",function(){
    $("input[name=ep_id]").val($(this).children("option:selected").val());
})
$("select[name=lv3]").on("change",function(){
    $("input[name=ep_id]").val($(this).children("option:selected").val());
    //alert($(this).children("option:selected").val());
})

function get_report(){
    //alert($("#form").serialize());
    var data=$("#form").serialize();
    var ep_id=$("input[name=ep_id]").val();
    var lv1=$("input[name=lv1]").val();
    var lv2=$("input[name=lv2]").val();
    var lv3=$("input[name=lv3]").val();
    var json=$("input[name=json]").val();
    var start=$("input[name=start]").val();
    var end=$("input[name=end]").val();
    $.ajax({
        url:"?m=report&a=get_report_pic",
       async: true,
       dataType: "html",
        data: {ep_id:ep_id,lv1:lv1,lv2:lv2,lv3:lv3,json:json,start:start,end:end},
        success:function(res){
            $("#replace").html(res);
          
        }
    });


}

$("a.add").on("click",function(){
   $("a.button").each(function(){
       $(this).removeClass("active");
   }); 
   $(this).addClass("active");
      $("input[name=status]").val("");
    send();
});
$("a.act").on("click",function(){
   $("a.button").each(function(){
       $(this).removeClass("active");
   }); 
   $(this).addClass("active");
   $("input[name=status]").val("act");
   send();
});
$("a.loss").on("click",function(){
   $("a.button").each(function(){
       $(this).removeClass("active");
   }); 
   $(this).addClass("active");
   $("input[name=status]").val("loss");
   send();
});
$("a.all").on("click",function(){
   $("a.button").each(function(){
       $(this).removeClass("active");
   }); 
   $(this).addClass("active");
   $("input[name=status]").val("all");
   send();
});