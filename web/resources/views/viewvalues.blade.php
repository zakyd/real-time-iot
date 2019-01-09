@extends('template\main')

@section('title')
    View Values
@endsection

@section('head')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src = "https://code.highcharts.com/highcharts.js"></script>
@endsection

@section('content')

    <div id="temperatureChart" style="width:100%; height:400px;"></div>

    <script>
        var tempChart;
        var time = <?php echo json_encode($date); ?>;
        $(function () {
            var temperature = <?php echo json_encode($temperature); ?>, humidity = <?php echo json_encode($humidity); ?>;
            tempChart = Highcharts.chart('temperatureChart', {
                chart: {
                    type: 'line',
                    events: {
                        load: function () {
                            var lastTime = '<?php echo $last->created_at; ?>';
                            setInterval(function () {
                            
                                console.log(lastTime);
                                $.ajax({
                                    type     : "GET",
                                    url      : "/request-data?lasttime="+lastTime,
                                    async    : true,
                                    cache    : false,
                                    dataType : "json",
                                    success  : function(point){
                                        console.log("sukses");
                                        var celcius = tempChart.series[0],
                                            reamur = tempChart.series[1],
                                            fahenheit = tempChart.series[2],
                                            kelvin = tempChart.series[3],
                                            humidity = tempChart.series[4],
                                            xAxis = tempChart.xAxis[0];
                                        var x = point.created_at;
                                        var t = point.temperature;
                                        var h = point.humidity;
                                        time.push(x);
                                        if (x!=lastTime) {
                                            xAxis.update({
                                                categories: time
                                            });
                                            celcius.addPoint(t, true, time.length>10);
                                            reamur.addPoint(t*4/5, true, time.length>10);
                                            fahenheit.addPoint(t*9/5+32, true, time.length>10);
                                            kelvin.addPoint(t+273.15, true, time.length>10);
                                            humidity.addPoint(h, true, time.length>10);
                                            lastTime = x;    
                                        }
                                    }
                                });
                            }, 1000);
                        }
                    }
                },
                title: {
                    text: 'Temperature Chart'
                },
                xAxis: {
                    categories: time
                },
                yAxis: {
                    title: {
                        text: 'Degrees'
                    }
                },
                plotOptions: {
                    series: {
                        events: {
                            show: (function() {
                                var chart = this.chart,
                                    series = chart.series,
                                    i = series.length,
                                    otherSeries;
                                while(i--) {
                                    otherSeries = series[i];
                                    if (otherSeries != this && otherSeries.visible) {
                                        otherSeries.hide();
                                    }
                                }
                            })
                        }
                    }
                },
                series: [{
                    name: 'Celcius',
                    data: temperature
                },{
                    name: 'Reamur',
                    data: temperature.map(function(t) { return t*4/5; }),
                    visible: false
                },{
                    name: 'Fahrenheit',
                    data: temperature.map(function(t) { return t*9/5+32; }),
                    visible: false
                },{
                    name: 'Kelvin',
                    data: temperature.map(function(t) { return t+273.15; }),
                    visible: false
                },{
                    name: 'Humidity',
                    data: humidity,
                    visible: false
                }]
            });
        });
    </script>
@endsection