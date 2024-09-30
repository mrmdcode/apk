@extends('Dashboard.Company.Layouts.app')
@section('content')


    <div class="row justify-content-center">
        <div class="col-xxl-3 col-sm-6 col-xxxl-6">
            <div class="stats-box style-three card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div class="flex-shrink-0">
                            <div class="icon transition">
                                <i class="flaticon-donut-chart"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-md-3 mt-3 mt-md-0">
                            <span class="fs-15 fw-semibold">تعداد موتور ها</span>
                            <div class="d-flex align-items-center justify-content-between my-1 up-down">
                                <h3 class="body-font fw-bold fs-3 mb-0">{{$motor->count()}}</h3>
                                {{--                                <span class="bg-success text-success bg-opacity-10 fs-13 fw-semibold py-1 px-2 rounded-2">%5.80 <i class="flaticon-arrow-up fs-13 fw-normal ms-1"></i></span>--}}
                            </div>
                            <p class="fs-15">با احتساب موتور های غیرفعال</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-xxxl-6">
            <div class="stats-box style-three card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div class="flex-shrink-0">
                            <div class="icon transition">
                                <i class="flaticon-goal"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-md-3 mt-3 mt-md-0">
                            <span class="fs-15 fw-semibold">پیام های خوانده نشده</span>
                            <div class="d-flex align-items-center justify-content-between my-1 up-down">
                                <h3 class="body-font fw-bold fs-3 mb-0">+5 </h3>
                                {{--                                <span class="bg-danger text-danger bg-opacity-10 fs-13 fw-semibold py-1 px-2 rounded-2">%1.04 <i class="flaticon-down-filled-triangular-arrow fs-13 fw-normal ms-1"></i></span>--}}
                            </div>
                            <p class="fs-15">شرکت فروشنده و خریدار</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-xxxl-6">
            <div class="stats-box style-three card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div class="flex-shrink-0">
                            <div class="icon transition">
                                <i class="flaticon-timer"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-md-3 mt-3 mt-md-0">
                            <span class="fs-15 fw-semibold">تعداد هشدار</span>
                            <div class="d-flex align-items-center justify-content-between my-1 up-down">
                                <h3 class="body-font fw-bold fs-3 mb-0">{{$logs}}</h3>
                                {{--                                <span class="bg-success text-success bg-opacity-10 fs-13 fw-semibold py-1 px-2 rounded-2">%5.80 <i class="flaticon-arrow-up fs-13 fw-normal ms-1"></i></span>--}}
                            </div>
                            <p class="fs-15">تمامی هشدار ها</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-xxxl-6">
            <div class="stats-box style-three card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div class="flex-shrink-0">
                            <div class="icon transition">
                                <i class="flaticon-award"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-md-3 mt-3 mt-md-0">
                            <span class="fs-15 fw-semibold">تعداد هشدار E </span>
                            <div class="d-flex align-items-center justify-content-between my-1 up-down">
                                <h3 class="body-font fw-bold fs-3 mb-0">{{$logsE}}</h3>
                                {{--                                <span class="bg-success text-success bg-opacity-10 fs-13 fw-semibold py-1 px-2 rounded-2">%5.80 <i class="flaticon-arrow-up fs-13 fw-normal ms-1"></i></span>--}}
                            </div>
                            <p class="fs-15">فقط هشدار های Error</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card  bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div style="direction: ltr;" id="sales_by_locations"></div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card bg-white border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-bold fs-18 mb-0">آخرین موتور های ثبتی</h4>
                    </div>
                    <ul class="ps-0 mb-0 list-unstyled max-h-406" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="left: -34px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">

                                            @forelse($motors as $motorSingle)

                                                <li class="border-bottom border-color-gray mb-3 pb-3">
                                                    <div class="d-sm-flex justify-content-between align-content-center">
                                                        <a href="{{route('admin.motorView',$motorSingle->id)}}" class="d-flex align-items-center text-decoration-none">
                                                            <div class="flex-grow-1 ms-10">
                                                                <h4 class="fw-semibold fs-15 mb-0 text-body">{{$motorSingle->motor_name}}</h4>
                                                                <span class="text-primary fs-14"> سریال :{{$motorSingle->motor_serial}}</span>
                                                            </div>
                                                        </a>
                                                        <div class="d-flex align-items-center mt-2 mt-sm-0">
                                                            <span class="text-success">{{$motorSingle->data()->where('process','normal')->count()}}</span>
                                                            <span class="ms-4 text-warning">{{$motorSingle->data()->where('process','warning')->count()}}</span>
                                                            <span class="ms-4 text-danger">{{$motorSingle->data()->where('process','error')->count()}}</span>
                                                            {{--                                       <span class=" fs-14 fw-semibold text-danger ms-4">asdasdasd</span>--}}
                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="border-bottom border-color-gray mb-3 pb-3">
                                                    دیتا در دسترس نیست
                                                </li>
                                            @endforelse

                                        </div>
                                    </div></div></div><div class="simplebar-placeholder" style="width: auto; height: 410px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 4px, 0px); display: block; height: 402px;"></div></div></ul>
                </div>
            </div>
        </div>

    </div>


    <div class="row mb-4">
        <div class="col" >
            <div class="card bg-white border-0">
                <div class="card-body" id="dataList">

                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card bg-white border-0">
                <div class="card-body">
                    <h6 class="border-bottom pb-4 p-1">دیتای درحال دریافت</h6>
                    <div id="dataReceivering"></div>

                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script src="https://cdn.amcharts.com/lib/5/geodata/iranLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/iranHigh.js"></script>
    <script src="{{asset('/js/Dashboard/Company/Dashboard.js')}}"></script>
@endsection
@section('css')
    <style>
        #dataList *{
            font-size: 12px;
        }
        #dataList{
            height: 450px;
            overflow: auto;
            -webkit-overflow-scrolling: none;
        }

    </style>
@endsection
