@extends('Dashboard.Layouts.app')

@section('content')
    <div class="card mt-5">
        <div class="card-body">

            <form >
                <div class="form-row">
                    <div class="form-group col-md-6 " >
                        <label for="company_seller_id" class="col-form-label">شناسه فروشنده</label>
                        <input type="text" value="{{$motor->seller->company_name}}" class="form-control" disabled/>
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="company_buyer_id" class="col-form-label">شناسه خریدار</label>
                        <input type="text" value="{{$motor->buyer->company_name}}" class="form-control" disabled/>
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="motor_name" class="col-form-label">نام موتور</label>
                        <input type="text" name="motor_name" value="{{$motor->motor_name}}" disabled class="form-control" id="motor_name" placeholder="نام موتور">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="motor_model" class="col-form-label">مدل موتور</label>
                        <input type="text" name="motor_model" value="{{$motor->motor_model}}" disabled class="form-control" id="motor_model" placeholder="مدل موتور">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="motor_year" class="col-form-label">سال تولید</label>
                        <input type="text" name="motor_year" value="{{$motor->motor_year}}" disabled class="form-control" id="motor_year" placeholder="سال تولید">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="motor_start" class="col-form-label">تاریخ شروع</label>
                        <input type="text" name="motor_start" value="{{$motor->motor_start}}" disabled class="form-control" id="motor_start" placeholder="تاریخ شروع">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="motor_serial" class="col-form-label">سریال موتور</label>
                        <input type="text" name="motor_serial" value="{{$motor->motor_serial}}" disabled class="form-control" id="motor_serial" placeholder="سریال موتور">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="motor_address" class="col-form-label">آدرس موتور</label>
                        <input type="text" name="motor_address" value="{{$motor->motor_address}}" disabled class="form-control" id="motor_address" placeholder="آدرس موتور">
                    </div>

                    <div class="form-group col-md-12 ">
                        <label for="motor_description" class="col-form-label">توضیحات موتور</label>
                        <textarea name="motor_description" value="{{$motor->motor_description}}" class="form-control  control" disabled id="motor_description" placeholder="توضیحات موتور"></textarea>
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="allowable_winding_temperature" class="col-form-label">حداکثر دمای سیم پیچی</label>
                        <input type="text" name="allowable_winding_temperature" value="{{$motor->allowable_winding_temperature}}" disabled class="form-control" id="allowable_winding_temperature" placeholder="حداکثر دمای سیم پیچی">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="allowable_bearing_temperature" class="col-form-label">حداکثر دمای یاتاقان</label>
                        <input type="text" name="allowable_bearing_temperature" value="{{$motor->allowable_bearing_temperature}}" disabled class="form-control" id="allowable_bearing_temperature" placeholder="حداکثر دمای یاتاقان">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="hungarian_vibration" class="col-form-label">لرزش</label>
                        <input type="text" name="hungarian_vibration" value="{{$motor->hungarian_vibration}}" disabled class="form-control" id="hungarian_vibration" placeholder="لرزش">
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
<div class="row">
    <div id="map" style="max-height: 400px; margin: 50px"></div>
</div>
@endsection



@section('js')
    <script src="{{asset('\assets\dashboard\plugins\leaflet\leaflet.js')}}"></script>

<script>
</script>
@endsection

