@extends("Dashboard.Layouts.app")
@section("content")
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">داشبورد</h4>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end page-title-box -->
        </div>

        <!-- end page title -->
    </div>

    <div class="card pt-3 px-3 row ">
        <div class="row ">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary mini-stat text-white">
                    <div class="p-3 mini-stat-desc">
                        <div class="clearfix">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">تعداد موتور ها</h6>
                            <h4 class="mb-3 mt-0 float-right">{{$motor->count()}}</h4>
                        </div>


                    </div>
                    <div class="p-3">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-cube-outline h5"></i></a>
                        </div>
                        <p class="font-14 m-0">فعال ها : {{$motor->where('motor_start')->count()}}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-info mini-stat text-white">
                    <div class="p-3 mini-stat-desc">
                        <div class="clearfix">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">تعداد شرکت ها </h6>
                            <h4 class="mb-3 mt-0 float-right">{{ $company }}</h4>
                        </div>

                    </div>
                    <div class="p-3">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-buffer h5"></i></a>
                        </div>
                        <p class="font-14 m-0">درحال مانیتور</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-pink mini-stat text-white">
                    <div class="p-3 mini-stat-desc">
                        <div class="clearfix">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">تعداد اخطار ها </h6>
                            <h4 class="mb-3 mt-0 float-right">15</h4>
                        </div>

                    </div>
                    <div class="p-3">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-tag-text-outline h5"></i></a>
                        </div>
                        <p class="font-14 m-0">بیشترین اخطار : موتور یک</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-success mini-stat text-white">
                    <div class="p-3 mini-stat-desc">
                        <div class="clearfix">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">'گزارشات ثبت شده </h6>
                            <h4 class="mb-3 mt-0 float-right">{{$logs}}</h4>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-briefcase-check h5"></i></a>
                        </div>
                        <p class="font-14 m-0">امروز : {{$logsT}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->




    <div id="map" class="mb-4"></div>



    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">گزارش فروش ها</h4>
                    <div class="row">
                        <div class="col-lg-8">
                            <canvas class="flot-overlay" width="536" height="320" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 536px; height: 320px;"></canvas>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <h5 class="font-14 mb-5">گزارش فروش سالانه</h5>

                                <div>
                                    <h5 class="mb-3">2018 : 19523 تومان</h5>
                                    <p class="text-muted mb-4">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                                    <a href="#" class="btn btn-primary btn-sm">ادامه مطلب <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">تجزیه و تحلیل فروش</h4>
                    </div>
            </div>
        </div>
    </div>


    <div class="card pt-3 px-3 row ">
        <div class="row ">
            <div class="col-xl-3 col-md-6">
                <div id="gaugeContainer_1"></div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div id="gaugeContainer_2"></div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div id="gaugeContainer_3"></div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div id="gaugeContainer_4"></div>
            </div>
        </div>
    </div>




@endsection

@section('js')
    <script src="{{asset('\assets\dashboard\plugins\leaflet\leaflet.js')}}"></script>
    <script src="{{asset('\assets\dashboard\plugins\raphael\raphael.min.js')}}"></script>
    <script src="{{asset('/assets/dashboard/plugins/justgage/justgage.min.js')}}"></script>
{{--    <script src="{{asset('/assets/dashboard/plugins/flot-chart/jquery.flot.min.js')}}"></script>--}}
{{--    <script src="{{asset('/assets/dashboard/plugins/flot-chart/jquery.flot.time.js')}}"></script>--}}
{{--    <script src="{{asset('/assets/dashboard/plugins/flot-chart/jquery.flot.tooltip.min.js')}}"></script>--}}
{{--    <script src="{{asset('/assets/dashboard/plugins/flot-chart/jquery.flot.resize.js')}}"></script>--}}
{{--    <script src="{{asset('/assets/dashboard/plugins/flot-chart/jquery.flot.pie.js')}}"></script>--}}
{{--    <script src="{{asset('/assets/dashboard/plugins/flot-chart/jquery.flot.selection.js')}}"></script>--}}
{{--    <script src="{{asset('/assets/dashboard/plugins/flot-chart/jquery.flot.stack.js')}}"></script>--}}
{{--    <script src="{{asset('/assets/dashboard/plugins/flot-chart/curvedLines.js')}}"></script>--}}
{{--    <script src="{{asset('/assets/dashboard/plugins/flot-chart/jquery.flot.crosshair.js')}}"></script>--}}
{{--    <script src="{{asset('/assets/dashboard/pages/flot.init.js')}}"></script>--}}
    <script>




        const getMotorLocation = async () => {
          motorLocation = await fetch('/dashboard/admin/motorLoc');
          motorLocation = await motorLocation.json();
            console.log(motorLocation);



            // let motorLocation ;



            var map = L.map('map').setView([32.4279, 53.6880], 6);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: ''
            }).addTo(map);
            //
            var points = motorLocation;






            points.forEach(point => {
                var marker = L.marker(point.coordinates).addTo(map);
                marker.bindPopup(`<b>${point.text}</b>`);

                var divIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: `<div style='background-color: ${point.color}; width: 15px;height: 15px;  ' class='marker-pin'></div><div class='marker-label'>${point.text}</div>`
                });

                marker.setIcon(divIcon);
            });




            var g_1 = new JustGage({
                id: "gaugeContainer_1",
                value: 2, // مقدار اولیه نمودار
                min: 0,    // حداقل مقدار
                max: 100,  // حداکثر مقدار
                title: "میزان آمپر", // عنوان نمودار
                label: "آمپر",        // برچسب
                levelColors: ['#FF0000', '#FFCC00', '#00FF00'] // رنگ‌های مختلف برای مقادیر مختلف
            });

            var g_2 = new JustGage({
                id: "gaugeContainer_2",
                value: 72, // مقدار اولیه نمودار
                min: 0,    // حداقل مقدار
                max: 100,  // حداکثر مقدار
                title: "میزان آمپر", // عنوان نمودار
                label: "آمپر",        // برچسب
                levelColors: ['#FF0000', '#FFCC00', '#00FF00'] // رنگ‌های مختلف برای مقادیر مختلف
            });
            var g_3 = new JustGage({
                id: "gaugeContainer_3",
                value: 52, // مقدار اولیه نمودار
                min: 0,    // حداقل مقدار
                max: 100,  // حداکثر مقدار
                title: "میزان آمپر", // عنوان نمودار
                label: "آمپر",        // برچسب
                levelColors: ['#FF0000', '#FFCC00', '#00FF00'] // رنگ‌های مختلف برای مقادیر مختلف
            });
            var g_4 = new JustGage({
                id: "gaugeContainer_4",
                value: 92, // مقدار اولیه نمودار
                min: 0,    // حداقل مقدار
                max: 100,  // حداکثر مقدار
                title: "میزان آمپر", // عنوان نمودار
                label: "آمپر",        // برچسب
                levelColors: ['#FF0000', '#FFCC00', '#00FF00'] // رنگ‌های مختلف برای مقادیر مختلف
            });
            // به‌روزرسانی داده‌ها پس از 3 ثانیه
            setTimeout(function() {
                g_1.refresh(45); // مقدار جدید برای به‌روزرسانی
                g_2.refresh(51); // مقدار جدید برای به‌روزرسانی
                g_3.refresh(92); // مقدار جدید برای به‌روزرسانی
                g_4.refresh(7); // مقدار جدید برای به‌روزرسانی
            }, 3000);
        }


        getMotorLocation();
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map { height: 400px; }
    </style>
@endsection
