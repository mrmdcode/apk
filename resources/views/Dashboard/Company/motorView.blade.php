@extends('Dashboard.Company.Layouts.app')

@section('content')
    <input type="hidden" id="motor_id" value="{{$motor->id}}">


    <div class="row">

        <div class="col-md-6 col-xl-8">
            <div class="card bg-white mt-5">
                <div class="card-body">
                    <h3 class="fs-18 mb-20 pb-20 border-bottom">جریان ها</h3>
                    <div id="currents" style="height: 350px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card bg-white mt-5">
                <div class="card-body">
                    <h3 class="fs-18 mb-20 pb-20 border-bottom">دمای محیط</h3>
                    <div id="gauge_1" style="height: 350px;"></div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-8">
            <div class="card bg-white mt-5">
                <div class="card-body">
                    <h3 class="fs-18 mb-20 pb-20 border-bottom">دمای </h3>
                    <div id="temperatureChart" class="w-100" style="height: 350px;"></div>
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
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-8">
            <div class="card bg-white border-0 rounded-10 mt-5">
                <div class="card-body">
                    <h3 class="fs-18 mb-20 pb-20  border-bottom">لرزش</h3>
                    <div id="vibrations"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card bg-white border-0 rounded-10 mt-5" style="height: 350px;">
                <div class="card-body">
                    <h3 class="fs-18 mb-20 pb-20  border-bottom">حجم درتای دریافتی</h3>
                    <canvas id="eventChart" ></canvas>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6 col-xl-8 p-5">
            <canvas id="mototoImage" class="w-100"></canvas>
            <div class="card bg-white mt-5">
                <div class="card-body">
                    <div class="row border-bottom  justify-content-between mb-20 pb-20">
                        <h3 class="fs-18  col">اطلاعات استارت</h3>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <th>تایم تحویل</th>
                        <th>مدت خاموشی</th>
                        <th>مدت کار</th>
                        <th>تعداد خاموشی ها</th>
                        <th>تعداد استارت ها</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$data['total_time']}}</td>
                            <td>{{$data['off_time']}}</td>
                            <td>{{$data['on_time']}}</td>
                            <td>{{$data['off_count']}}</td>
                            <td>{{$data['on_count']}}</td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
            <div class="card bg-white mt-5">
                <div class="card-body">
                    <div class="row border-bottom  justify-content-between mb-20 pb-20">
                        <h3 class="fs-18  col">رویداد ها</h3>
                        <a href="{{route('company.motorEvent',$motor->id)}}" class="col-3 text-primary">مشاهده همه </a>
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
    <script src="{{asset('/js/Dashboard/Company/motorView.js')}}"></script>
@endsection

