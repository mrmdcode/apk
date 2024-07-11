@extends('Dashboard.Admin.Layouts.app')

@section('content')
    <input type="hidden" id="motor_id" value="{{$motor->id}}">
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card bg-white border-0 rounded-10 mt-5">
                <div class="card-body" >
                    <h3 class="border-bottom fs-18 mb-20 pb-20">هشدار ها</h3>
                    <div class="row"  style="height: 266px;overflow: auto;" >

                        @forelse($logs as $log)
                            @if($log->process == 'error')
                                <div class="alert alert-danger">موتور در ساعت {{verta($log->created_at)->format('H:i:s')}} اررور {{$log->event->name}} داده و مقادیر طبیعی خود را رد کرده .</div>
                            @endif
                            @if($log->process == 'warning')
                                <div class="alert alert-warning">   موتور در ساعت {{verta($log->created_at)->format('H:i:s')}} وارنینگ {{$log->event->name}}  داده و مقادیر طبیعی خود را رد کرده . </div>
                            @endif
                        @empty
                            <div class="alert alert-success">
                                هیچ دیتا error یا warning ندارد .
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card bg-white border-0 rounded-10 mt-5">
                <div class="card-body">
                    <h3 class="fs-18 mb-20 pb-20  border-bottom">حجم درتای دریافتی</h3>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card bg-white mt-5">
                <div class="card-body">
                    <div class="row border-bottom  justify-content-between mb-20 pb-20">
                        <h3 class="fs-18  col">رویداد ها</h3>
                        <a href="{{route('admin.motorEvent',$motor->id)}}" class="col-3 text-primary">مشاهده همه </a>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <th>نام</th>
                        <th>کمترین</th>
                        <th>عادی</th>
                        <th>بیشترین</th>
                        <th>---</th>
                        </thead>
                        <tbody>
                        @forelse($motor->events->take(3) as $event)
                            <tr>
                                <td>{{$event->name}}</td>
                                <td>{{$event->min}}</td>
                                <td>{{$event->normal}}</td>
                                <td>{{$event->max}}</td>
                                <td><a href="{{route('admin.motorEventEdit',$event->id)}}" class="btn btn-secondary fw-semibold text-white py-2 px-2 me-2"><i class="ri-add-line"></i> ویرایش</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">no data     </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card bg-white mt-5">
                <div class="card-body">
                    <h3 class="fs-18 mb-20 pb-20 border-bottom">دمای محیط</h3>
                    <div id="gauge_1" style="height: 350px;"></div>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card bg-white mt-5">
                <div class="card-body">
                    <h3 class="fs-18 mb-20 pb-20 border-bottom">دمای سیم پیچ</h3>
                    <div id="gauge_2" style="height: 350px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card bg-white mt-5">
                <div class="card-body">
                    <h3 class="fs-18 mb-20 pb-20 border-bottom">جریان ها</h3>
                    <div id="date_axis" style="height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card bg-white border-0 rounded-10 my-2">
            <div class="card-body">
                <a href="{{route('motor.listener',[$motor->id,$motor->seller->id,$motor->seller->company_name,$motor->buyer->id,$motor->buyer->company_name,$motor->motor_name])}}" class="btn btn-warning">صفخه سوپروایز</a>
                <form>
                    <div class="form-row">
                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label for="company_seller_id" class="col-form-label">شناسه فروشنده</label>
                                <input type="text" value="{{$motor->seller->company_name}}" class="form-control" disabled/>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="company_buyer_id" class="col-form-label">شناسه خریدار</label>
                                <input type="text" value="{{$motor->buyer->company_name}}" class="form-control" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label for="motor_name" class="col-form-label">نام موتور</label>
                                <input type="text" name="motor_name" value="{{$motor->motor_name}}" disabled
                                       class="form-control" id="motor_name" placeholder="نام موتور">
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="motor_model" class="col-form-label">مدل موتور</label>
                                <input type="text" name="motor_model" value="{{$motor->motor_model}}" disabled
                                       class="form-control" id="motor_model" placeholder="مدل موتور">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label for="motor_year" class="col-form-label">سال تولید</label>
                                <input type="text" name="motor_year" value="{{$motor->motor_year}}" disabled
                                       class="form-control" id="motor_year" placeholder="سال تولید" />
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="motor_start" class="col-form-label">تاریخ شروع</label>
                                <input type="text" name="motor_start" value="{{$motor->motor_start}}" disabled
                                       class="form-control" id="motor_start" placeholder="تاریخ شروع">
                            </div>
                        </div>

                       <div class="row">
                           <div class="form-group col-md-6 ">
                               <label for="motor_serial" class="col-form-label">سریال موتور</label>
                               <input type="text" name="motor_serial" value="{{$motor->motor_serial}}" disabled
                                      class="form-control" id="motor_serial" placeholder="سریال موتور">
                           </div>

                           <div class="form-group col-md-6 ">
                               <label for="motor_address" class="col-form-label">آدرس موتور</label>
                               <input type="text" name="motor_address" value="{{$motor->motor_address}}" disabled
                                      class="form-control" id="motor_address" placeholder="آدرس موتور">
                           </div>
                       </div>

                       <div class="row">
                        <div class="form-group col-md-6 ">
                            <label for="motor_description" class="col-form-label">توضیحات موتور</label>
                            <textarea name="motor_description" value="{{$motor->motor_description}}"
                                      class="form-control  control" disabled id="motor_description"
                                      placeholder="توضیحات موتور"></textarea>
                        </div>

                           <div class="form-group col-md-6 ">
                               <label for="allowable_winding_temperature" class="col-form-label">حداکثر دمای سیم پیچی</label>
                               <input type="text" name="allowable_winding_temperature"
                                      value="{{$motor->allowable_winding_temperature}}" disabled class="form-control"
                                      id="allowable_winding_temperature" placeholder="حداکثر دمای سیم پیچی">
                           </div>
                       </div>

                       <div class="row">
                           <div class="form-group col-md-6 ">
                               <label for="allowable_bearing_temperature" class="col-form-label">حداکثر دمای یاتاقان</label>
                               <input type="text" name="allowable_bearing_temperature"
                                      value="{{$motor->allowable_bearing_temperature}}" disabled class="form-control"
                                      id="allowable_bearing_temperature" placeholder="حداکثر دمای یاتاقان">
                           </div>

                           <div class="form-group col-md-6 ">
                               <label for="hungarian_vibration" class="col-form-label">لرزش</label>
                               <input type="text" name="hungarian_vibration" value="{{$motor->hungarian_vibration}}" disabled
                                      class="form-control" id="hungarian_vibration" placeholder="لرزش">
                           </div>
                       </div>


                        <div class="col-md-6 mt-4">
                            <a class="btn btn-outline-secondary text-center ">دانلود فایل 1</a>
                            <a class="btn btn-outline-secondary mx-3">دانلود فایل 2</a>
                            <a class="btn btn-outline-secondary">دانلود فایل 3</a>
                        </div>


                    </div>


                </form>

            </div>
        </div>
    </div>

@endsection



@section('js')
{{--    <script src="{{asset('\assets\dashboard\plugins\leaflet\leaflet.js')}}"></script>--}}


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const getData = async () => {
          data = await fetch(`/dashboard/admin/motorManager/${$('#motor_id').val()}/data`)
            data = await data.json();
            console.log(data)
        }
        getData()
        const ctx = document.getElementById('myChart');
        const linechart = document.getElementById('linechart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        let chart = new Chart(linechart, {

            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [
                    {
                        label: '# of Votes',
                        data: [12, 1, 3, 5, 2, 3],
                        fill: false, // <-- Here
                    },
                    {
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 13],
                        fill: false, // <-- Here
                    },{
                        label: '# of Votes',
                        data: [12, 19, 31, 50, 2, 3],
                        fill: false, // <-- Here
                    }

                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        am5.ready(function () {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("gauge_1");


            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/radar-chart/
            var chart = root.container.children.push(am5radar.RadarChart.new(root, {
                panX: false,
                panY: false,
                startAngle: 160,
                endAngle: 380
            }));


            // Create axis and its renderer
            // https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Axes
            var axisRenderer = am5radar.AxisRendererCircular.new(root, {
                innerRadius: -40
            });

            axisRenderer.grid.template.setAll({
                stroke: root.interfaceColors.get("background"),
                visible: true,
                strokeOpacity: 0.8
            });

            var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0,
                min: 10,
                max: 90,
                strictMinMax: true,
                renderer: axisRenderer
            }));


            var axisDataItem = xAxis.makeDataItem({});

            var clockHand = am5radar.ClockHand.new(root, {
                pinRadius: am5.percent(20),
                radius: am5.percent(100),
                bottomWidth: 40
            })

            var bullet = axisDataItem.set("bullet", am5xy.AxisBullet.new(root, {
                sprite: clockHand
            }));

            xAxis.createAxisRange(axisDataItem);

            var label = chart.radarContainer.children.push(am5.Label.new(root, {
                fill: am5.color(0xffffff),
                centerX: am5.percent(50),
                textAlign: "center",
                centerY: am5.percent(50),
                fontSize: "3em"
            }));

            axisDataItem.set("value", 50);
            bullet.get("sprite").on("rotation", function () {
                var value = axisDataItem.get("value");
                var text = Math.round(axisDataItem.get("value")).toString();
                var fill = am5.color(0x000000);
                xAxis.axisRanges.each(function (axisRange) {
                    if (value >= axisRange.get("value") && value <= axisRange.get("endValue")) {
                        fill = axisRange.get("axisFill").get("fill");
                    }
                })

                label.set("text", Math.round(value).toString());

                clockHand.pin.animate({key: "fill", to: fill, duration: 500, easing: am5.ease.out(am5.ease.cubic)})
                clockHand.hand.animate({key: "fill", to: fill, duration: 500, easing: am5.ease.out(am5.ease.cubic)})
            });

            setInterval(function () {
                axisDataItem.animate({
                    key: "value",
                    to: Math.round(Math.random() * 14 + 50),
                    duration: 500,
                    easing: am5.ease.out(am5.ease.cubic)
                });
            }, 2000)

            chart.bulletsContainer.set("mask", undefined);


            // Create axis ranges bands
            // https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Bands
            var bandsData = [{
                title: "Warning",
                color: "#b0d136",
                lowScore: 10,
                highScore: 20
            }, {
                title: "Normal",
                color: "#f3eb0c",
                lowScore: 20,
                highScore: 40
            }, {
                title: "Warning",
                color: "#fdae19",
                lowScore: 40,
                highScore: 50
            }, {
                title: "Danger",
                color: "#f04922",
                lowScore: 50,
                highScore: 90
            },];

            am5.array.each(bandsData, function (data) {
                var axisRange = xAxis.createAxisRange(xAxis.makeDataItem({}));

                axisRange.setAll({
                    value: data.lowScore,
                    endValue: data.highScore
                });

                axisRange.get("axisFill").setAll({
                    visible: true,
                    fill: am5.color(data.color),
                    fillOpacity: 0.8
                });

                axisRange.get("label").setAll({
                    text: data.title,
                    inside: true,
                    radius: 15,
                    fontSize: "0.9em",
                    fill: root.interfaceColors.get("background")
                });
            });


            // Make stuff animate on load
            chart.appear(1000, 100);
        });
        am5.ready(function () {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("gauge_2");


            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/radar-chart/
            var chart = root.container.children.push(am5radar.RadarChart.new(root, {
                panX: false,
                panY: false,
                startAngle: 160,
                endAngle: 380
            }));


            // Create axis and its renderer
            // https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Axes
            var axisRenderer = am5radar.AxisRendererCircular.new(root, {
                innerRadius: -40
            });

            axisRenderer.grid.template.setAll({
                stroke: root.interfaceColors.get("background"),
                visible: true,
                strokeOpacity: 0.8
            });

            var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0,
                min: 10,
                max: 90,
                strictMinMax: true,
                renderer: axisRenderer
            }));


            var axisDataItem = xAxis.makeDataItem({});

            var clockHand = am5radar.ClockHand.new(root, {
                pinRadius: am5.percent(20),
                radius: am5.percent(100),
                bottomWidth: 40
            })

            var bullet = axisDataItem.set("bullet", am5xy.AxisBullet.new(root, {
                sprite: clockHand
            }));

            xAxis.createAxisRange(axisDataItem);

            var label = chart.radarContainer.children.push(am5.Label.new(root, {
                fill: am5.color(0xffffff),
                centerX: am5.percent(50),
                textAlign: "center",
                centerY: am5.percent(50),
                fontSize: "3em"
            }));

            axisDataItem.set("value", 50);
            bullet.get("sprite").on("rotation", function () {
                var value = axisDataItem.get("value");
                var text = Math.round(axisDataItem.get("value")).toString();
                var fill = am5.color(0x000000);
                xAxis.axisRanges.each(function (axisRange) {
                    if (value >= axisRange.get("value") && value <= axisRange.get("endValue")) {
                        fill = axisRange.get("axisFill").get("fill");
                    }
                })

                label.set("text", Math.round(value).toString());

                clockHand.pin.animate({key: "fill", to: fill, duration: 500, easing: am5.ease.out(am5.ease.cubic)})
                clockHand.hand.animate({key: "fill", to: fill, duration: 500, easing: am5.ease.out(am5.ease.cubic)})
            });

            setInterval(function () {
                axisDataItem.animate({
                    key: "value",
                    to: Math.round(Math.random() * 14 + 50),
                    duration: 500,
                    easing: am5.ease.out(am5.ease.cubic)
                });
            }, 2000)

            chart.bulletsContainer.set("mask", undefined);


            // Create axis ranges bands
            // https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Bands
            var bandsData = [{
                title: "Warning",
                color: "#b0d136",
                lowScore: 10,
                highScore: 20
            }, {
                title: "Normal",
                color: "#f3eb0c",
                lowScore: 20,
                highScore: 40
            }, {
                title: "Warning",
                color: "#fdae19",
                lowScore: 40,
                highScore: 50
            }, {
                title: "Danger",
                color: "#f04922",
                lowScore: 50,
                highScore: 90
            },];

            am5.array.each(bandsData, function (data) {
                var axisRange = xAxis.createAxisRange(xAxis.makeDataItem({}));

                axisRange.setAll({
                    value: data.lowScore,
                    endValue: data.highScore
                });

                axisRange.get("axisFill").setAll({
                    visible: true,
                    fill: am5.color(data.color),
                    fillOpacity: 0.8
                });

                axisRange.get("label").setAll({
                    text: data.title,
                    inside: true,
                    radius: 15,
                    fontSize: "0.9em",
                    fill: root.interfaceColors.get("background")
                });
            });


            // Make stuff animate on load
            chart.appear(1000, 100);
        });
        // Date axis with labels near minor grid lines
        am5.ready(function () {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("date_axis");

            const myTheme = am5.Theme.new(root);

            // Move minor label a bit down
            myTheme.rule("AxisLabel", ["minor"]).setAll({
                dy: 1
            });

            // Tweak minor grid opacity
            myTheme.rule("Grid", ["minor"]).setAll({
                strokeOpacity: 0.08
            });

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root),
                myTheme
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                paddingLeft: 0
            }));


            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "zoomX"
            }));
            cursor.lineY.set("visible", false);

            var date = new Date();
            date.setHours(0, 0, 0, 0);
            var value = 100;

            function generateData() {
                value = Math.round((Math.random() * 10 - 5) + value);
                am5.time.add(date, "day", 1);
                return {
                    date: date.getTime(),
                    value: value
                };
            }

            function generateDatas(count) {
                var data = [];
                for (var i = 0; i < count; ++i) {
                    data.push(generateData());
                }
                return data;
            }


            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                maxDeviation: 0,
                baseInterval: {
                    timeUnit: "day",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {
                    minorGridEnabled: true,
                    minGridDistance: 200,
                    minorLabelsEnabled: true
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));

            xAxis.set("minorDateFormats", {
                day: "dd",
                month: "MM"
            });

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));


            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(am5xy.LineSeries.new(root, {
                name: "Series",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            // Actual bullet
            series.bullets.push(function () {
                var bulletCircle = am5.Circle.new(root, {
                    radius: 5,
                    fill: series.get("fill")
                });
                return am5.Bullet.new(root, {
                    sprite: bulletCircle
                })
            })

            // Add scrollbar
            // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
            chart.set("scrollbarX", am5.Scrollbar.new(root, {
                orientation: "horizontal"
            }));

            var data = generateDatas(30);
            series.data.setAll(data);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear(1000);
            chart.appear(1000, 100);

        });


    </script>
@endsection

