@extends('Dashboard.Admin.Layouts.app')

@section('content')
    <div class="row">
        <div class="card mt-5">
            <div class="card-body">
                <a href="{{route('motor.listener',[$motor->id,$motor->seller->id,$motor->seller->company_name,$motor->buyer->id,$motor->buyer->company_name,$motor->motor_name])}}" class="btn btn-warning">صفخه سوپروایز</a>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6 ">
                            <label for="company_seller_id" class="col-form-label">شناسه فروشنده</label>
                            <input type="text" value="{{$motor->seller->company_name}}" class="form-control" disabled/>
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="company_buyer_id" class="col-form-label">شناسه خریدار</label>
                            <input type="text" value="{{$motor->buyer->company_name}}" class="form-control" disabled/>
                        </div>

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

                        <div class="form-group col-md-6 ">
                            <label for="motor_year" class="col-form-label">سال تولید</label>
                            <input type="text" name="motor_year" value="{{$motor->motor_year}}" disabled
                                   class="form-control" id="motor_year" placeholder="سال تولید">
                        </div>

                        <div class="form-group col-md-6 ">
                            <label for="motor_start" class="col-form-label">تاریخ شروع</label>
                            <input type="text" name="motor_start" value="{{$motor->motor_start}}" disabled
                                   class="form-control" id="motor_start" placeholder="تاریخ شروع">
                        </div>

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

                        <div class="form-group col-md-12 ">
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
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mt-5">
                <div class="card-body">
                    @forelse($logs as $log)
                        @if($log->process == 'error')
                            <div class="alert alert-danger">موتور در ساعت {{$log->created_At}} اررور {{$log->event->name}} داده و مقادیر طبیعی خود را رد کرده .</div>
                        @endif
                        @if($log->process == 'warning')
                            <div class="alert alert-warning">موتور در ساعت {{$log->created_At}} وارنینگ {{$log->event->name}} داده و مقادیر طبیعی خود را رد کرده .</div>
                        @endif
                    @empty
                        <div class="alert alert-success">
                            هیچ دیتا error یا warning ندارد .
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mt-5">
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mt-5">
                <div class="card-body">
                    <div id="gaugeContainer_1"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mt-5">
                <div class="card-body">
                    <div id="gaugeContainer_2"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mt-5">
                <div class="card-body">
                    <canvas id="linechart" class="chart chart-line" data="data" labels="labels" legend="true" series="series" options="options" click="onClick"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mt-5">
                <div class="card-body">
                    col 3
                </div>
            </div>
        </div>
    </div>@endsection



@section('js')
{{--    <script src="{{asset('\assets\dashboard\plugins\leaflet\leaflet.js')}}"></script>--}}

<script src="{{asset('\assets\dashboard\plugins\raphael\raphael.min.js')}}"></script>
<script src="{{asset('/assets/dashboard/plugins/justgage/justgage.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

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

    </script>
@endsection

