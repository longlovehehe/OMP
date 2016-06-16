<form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
        <div id="chartdiv1" style="width: 800px; height: 400px;"></div>
        {*<div id="chartdiv2" style="width: 600px; height: 400px;"></div>*}
        <input type="hidden" name="json" value='{$json}'>
        <script src="./script/report/amcharts.js"></script>
        <script src="./script/report/serial.js"></script>
        <script> 
        var chart1;
        var chart2;
        //var data=$("input[name=json]").val();
        var data=eval($("input[name=json]").val());
        makeCharts("light", "#E5E5E5");

        function makeCharts(theme, bgColor, bgImage){

          

            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;
                document.body.style.backgroundImage = "url(" + bgImage + ")";
            }
            // column chart
            chart1 = AmCharts.makeChart("chartdiv1", {
                type: "serial",
                theme:theme,
                dataProvider: data,//折线数据
                categoryField: "date",
                startDuration: 1.5,

                categoryAxis: {
                    gridPosition: "start",
                    fillColor: "#A83A3A",
                    //startOnAxis: "true",
                    //equalSpacing: "true",
                    //minPeriod:"dd",
                   // parseDates:"true",
                },
                valueAxes: [{
                    title: "{"数据统计"|L}"
                }],
                AxisBase:{
                tickLength:1
                },
                graphs: [
                    //{
                    //type: "column",
                    //title: "Income",
                   // valueField: "income",
                   // lineAlpha: 0,
                    //fillAlphas: 0.8,
                   // balloonText: "<b>[[value]]</b>"
               // }, 
                {
                    type: "line",
                    title: "{"人数"|L}",
                    valueField: "expenses",
                    lineThickness: 4,
                    fillAlphas: 0,
                    lineColor:"#A83A3A",
                    bullet: "round",
                    balloonText: "[[title]]:<b>[[value]]</b><br><b>[[date]]</b>"
                }],
                legend: {
                    useGraphSettings: true
                },

            });
//饼状图
            // pie chart
            chart2 = AmCharts.makeChart("chartdiv2", {
                type: "pie",
                theme: theme,
                dataProvider: [{
                    "country": "Czech Republic",
                        "litres": 156.9
                }, {
                    "country": "Ireland",
                        "litres": 131.1
                }, {
                    "country": "Germany",
                        "litres": 115.8
                }, {
                    "country": "Australia",
                        "litres": 109.9
                }, {
                    "country": "Austria",
                        "litres": 108.3
                }, {
                    "country": "UK",
                        "litres": 65
                }, {
                    "country": "Belgium",
                        "litres": 50
                }],
                titleField: "country",
                valueField: "litres",
                balloonText: "[[title]]<br><b>[[value]]</b> ([[percents]]%)",
                legend: {
                    align: "center",
                    markerType: "circle"
                }
            });

        }</script>
    <table class="base full" style="width: 750px;margin-left:20px;margin-right:20px;">
        <tr class='head'>
            {*<th width="25px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>*}
            <th width="50%">{"日期"|L}</th>
            <th width="50%">{"个数"|L}</th>
        </tr>
        {foreach name=list item=item from=$list}
        <tr>
            {*<td><input autocomplete="off"  type="checkbox" name="checkbox" value="{if $item.om_id  neq 'admin'}{$item.om_id}{/if}" class="cb" {if $item.om_id  eq 'admin'}disabled{/if}/></td>*}
            <td>{$item.create_time}</td>
            <td>{$item.user_num}</td>
        </tr>
        {/foreach}
    </table>
</form>
    