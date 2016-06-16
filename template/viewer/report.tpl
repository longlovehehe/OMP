<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{""|L}</title>
        <link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon" />
        <script src="script/jquery-1.11.1.min.js"></script>
        <script src="script/amcharts.js"></script>
        <script src="script/light.js"></script>
        <script src="script/pie.js"></script>
        <script src="script/serial.js"></script>
    </head>
    <body>
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

    </body>
</html>
<script>
     var chart1;
        var chart2;

        //var data=$("input[name=json]").val();
        var data=eval($("input[name=json]").val());
        makeCharts("light", "#E5E5E5");

        // Theme can only be applied when creating chart instance - this means
        // that if you need to change theme at run time, youhave to create whole
        // chart object once again.

        function makeCharts(theme, bgColor, bgImage){
            if(chart1){
                chart1.clear();
            }
            if(chart2){
                chart2.clear();
            }

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
                startDuration: 1,

                categoryAxis: {
                    gridPosition: "start"
                },
                valueAxes: [{
                    title: "数据统计"
                }],
                graphs: [{
                    type: "column",
                    title: "Income",
                    valueField: "income",
                    lineAlpha: 0,
                    fillAlphas: 0.8,
                    balloonText: "<b>[[value]]</b>"
                }, {
                    type: "line",
                    title: "Expenses",
                    valueField: "expenses",
                    lineThickness: 2,
                    fillAlphas: 0,
                    bullet: "round",
                    balloonText: "<b>[[value]]</b>"
                }],
                legend: {
                    useGraphSettings: true
                }

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
        }
</script>
