@extends('Dashboard.Admin.Layouts.app')

@section('content')
    <div class="card bg-white border-0 rounded-10 my-4">
        <div class="card-body ">
            <h2>ایجاد موتور جدید</h2>
            <form action="{{ route('admin.motorStore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 @if($errors->has('company_seller_id')) has-danger @endif">
                        <label for="company_seller_id" class="col-form-label">شناسه فروشنده</label>
                        <select name="company_seller_id" id="company_seller_id" class="form-control">
                            @forelse($company as $com)
                                <option value="{{$com->company->id}}">{{$com->company->company_name}}</option>
                            @empty
                                <option value="">یافت نشد.</option>
                            @endforelse
                        </select>
                        @if($errors->has('company_seller_id'))
                            <div class="form-control-feedback">{{ $errors->first('company_seller_id') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: 123</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('company_buyer_id')) has-danger @endif">
                        <label for="company_buyer_id" class="col-form-label">شناسه خریدار</label>
                        <select name="company_buyer_id" id="company_buyer_id" class="form-control">
                            @forelse($company as $com)
                                <option value="{{$com->company->id}}">{{$com->company->company_name}}</option>
                            @empty
                                <option value="">یافت نشد.</option>
                            @endforelse
                        </select>@if($errors->has('company_buyer_id'))
                            <div class="form-control-feedback">{{ $errors->first('company_buyer_id') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: 456</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('motor_name')) has-danger @endif">
                        <label for="motor_name" class="col-form-label">نام موتور</label>
                        <input type="text" name="motor_name" class="form-control" id="motor_name"
                               placeholder="نام موتور">
                        @if($errors->has('motor_name'))
                            <div class="form-control-feedback">{{ $errors->first('motor_name') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: موتور تستی</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('motor_model')) has-danger @endif">
                        <label for="motor_model" class="col-form-label">مدل موتور</label>
                        <input type="text" name="motor_model" class="form-control" id="motor_model"
                               placeholder="مدل موتور">
                        @if($errors->has('motor_model'))
                            <div class="form-control-feedback">{{ $errors->first('motor_model') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: irani</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('motor_year')) has-danger @endif">
                        <label for="motor_year" class="col-form-label">سال تولید</label>
                        <input type="text" name="motor_year" class="form-control" id="motor_year"
                               placeholder="سال تولید">
                        @if($errors->has('motor_year'))
                            <div class="form-control-feedback">{{ $errors->first('motor_year') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: 1400</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('motor_start')) has-danger @endif">
                        <label for="motor_start" class="col-form-label">تاریخ شروع</label>
                        <input type="text" name="motor_start" class="form-control" id="motor_start"
                               placeholder="تاریخ شروع">
                        @if($errors->has('motor_start'))
                            <div class="form-control-feedback">{{ $errors->first('motor_start') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: 1400/09/01</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('motor_serial')) has-danger @endif">
                        <label for="motor_serial" class="col-form-label">سریال موتور</label>
                        <input type="text" name="motor_serial" class="form-control" id="motor_serial"
                               placeholder="سریال موتور">
                        @if($errors->has('motor_serial'))
                            <div class="form-control-feedback">{{ $errors->first('motor_serial') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: 140005024507806</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('motor_address')) has-danger @endif">
                        <label for="motor_address" class="col-form-label">آدرس موتور</label>
                        <input type="text" name="motor_address" class="form-control" id="motor_address"
                               placeholder="آدرس موتور">
                        @if($errors->has('motor_address'))
                            <div class="form-control-feedback">{{ $errors->first('motor_address') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: استان ، شهر ، خیابان ، کوچه</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('motor_description')) has-danger @endif">
                        <label for="motor_description" class="col-form-label">توضیحات موتور</label>
                        <textarea name="motor_description" class="form-control" id="motor_description"
                                  placeholder="توضیحات موتور"></textarea>
                        @if($errors->has('motor_description'))
                            <div class="form-control-feedback">{{ $errors->first('motor_description') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: این توضیحات تستی برای موتور هست</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('allowable_winding_temperature')) has-danger @endif">
                        <label for="allowable_winding_temperature" class="col-form-label">حداکثر دمای سیم پیچی</label>
                        <input type="text" name="allowable_winding_temperature" class="form-control"
                               id="allowable_winding_temperature" placeholder="حداکثر دمای سیم پیچی">
                        @if($errors->has('allowable_winding_temperature'))
                            <div class="form-control-feedback">{{ $errors->first('allowable_winding_temperature') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: 4.5</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('allowable_bearing_temperature')) has-danger @endif">
                        <label for="allowable_bearing_temperature" class="col-form-label">حداکثر دمای یاتاقان</label>
                        <input type="text" name="allowable_bearing_temperature" class="form-control"
                               id="allowable_bearing_temperature" placeholder="حداکثر دمای یاتاقان">
                        @if($errors->has('allowable_bearing_temperature'))
                            <div class="form-control-feedback">{{ $errors->first('allowable_bearing_temperature') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: 5.4</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('hungarian_vibration')) has-danger @endif">
                        <label for="hungarian_vibration" class="col-form-label">لرزش</label>
                        <input type="text" name="hungarian_vibration" class="form-control" id="hungarian_vibration"
                               placeholder="لرزش">
                        @if($errors->has('hungarian_vibration'))
                            <div class="form-control-feedback">{{ $errors->first('hungarian_vibration') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: 55</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('latitude')) has-danger @endif">
                        <label for="latitude" class="col-form-label">عرض جغرافیایی</label>
                        <input type="text" name="latitude" class="form-control" id="latitude"
                               placeholder="عرض جغرافیایی">
                        @if($errors->has('latitude'))
                            <div class="form-control-feedback">{{ $errors->first('latitude') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: 35.6892</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('longitude')) has-danger @endif">
                        <label for="longitude" class="col-form-label">طول جغرافیایی</label>
                        <input type="text" name="longitude" class="form-control" id="longitude"
                               placeholder="طول جغرافیایی">
                        @if($errors->has('longitude'))
                            <div class="form-control-feedback">{{ $errors->first('longitude') }}</div>
                        @endif
                        <small class="form-text text-muted">مثال: 51.3890</small>
                    </div>


                    <div class="form-group col-md-6 @if($errors->has('file_1')) has-danger @endif">
                        <label for="file_1" class="col-form-label">فایل ۱</label>
                        <input type="file" name="file_1" class="form-control" id="file_1">
                        @if($errors->has('file_1'))
                            <div class="form-control-feedback">{{ $errors->first('file_1') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('file_2')) has-danger @endif">
                        <label for="file_2" class="col-form-label">فایل ۲</label>
                        <input type="file" name="file_2" class="form-control" id="file_2">
                        @if($errors->has('file_2'))
                            <div class="form-control-feedback">{{ $errors->first('file_2') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('file_3')) has-danger @endif">
                        <label for="file_3" class="col-form-label">فایل ۳</label>
                        <input type="file" name="file_3" class="form-control" id="file_3">
                        @if($errors->has('file_3'))
                            <div class="form-control-feedback">{{ $errors->first('file_3') }}</div>
                        @endif
                    </div>
                </div>


                <button type="submit" class="btn btn-primary m-3 px-5">ذخیره</button>
            </form>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div id="map" style="width: 100%; height: 50vh"></div>
        </div>
    </div>


@endsection



@section('js')
    <script src="{{asset('\assets\js\leaflet.js')}}"></script>
    <script>
        var map = L.map('map').setView([32.4279, 53.6880], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: ''
        }).addTo(map);
        var marker;
        //
        map.on('click', function (e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
        //
    </script>
@endsection


