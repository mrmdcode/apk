@extends("Dashboard.Layouts.app")
@section("content")
    <div class="card mt-5">
        <div class="card-body">

            <h4 class="mt-0 header-title">مدیریت موتور</h4>


            <div class="table-responsive my-5">
                <table class="table table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام موتور</th>
                        <th>سریال موتور</th>
                        <th>زمان استارت</th>
                        <th>زمان نصب</th>
                        <th>تعداد اخطار</th>
                        <th>توضیخات موتور</th>
                        <th>انتخاب</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @forelse($motors as $motor)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$motor->motor_name}}</td>
                            <td>{{$motor->motor_serial}}</td>
                            <td>{{ $motor->motor_start? $motor->motor_start : "راه اندازی نشده"  }}</td>
                            <td>{{ verta($motor->instalation_date)->format("y/m") }}</td>
                            <td> 0 </td>
                            <td>{{\Illuminate\Support\Str::substr($motor->motor_description,0,50)}}</td>
                            <td>
                                <input type="radio" name="choice" value="{{$motor->id}}" id="motor_{{$motor->id}}">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">دیتا نا موجود</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card pt-3 px-3 row ">
                <div class="row ">
                    <div class="col-xl-4 col-md-6">
                        <a href="/view/" class="btn btn-primary btn-block disabled" id="view">مشاهده کلی</a>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <a href="/edit/" class="btn btn-warning btn-block disabled" id="edit">ویرایش</a>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <a href="/delete/" class="btn btn-danger btn-block disabled" id="delete">حذف</a>
                    </div>
                </div>
                <div class="row">
                    <a href="/event/" class="btn btn-block btn-outline-secondary disabled" id="event">تنظیم اخطار</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let targer ;


        console.log("ff")
        $('input[name="choice"]').on('change',function (){
            targer = $('input[name="choice"]:checked').val()
            $('#view').attr('href',$('#view').attr('href')+targer)
            $('#edit').attr('href',$('#edit').attr('href')+targer)
            $('#delete').attr('href',$('#delete').attr('href')+targer)
            $('#event').attr('href',$('#event').attr('href')+targer)

            if(targer !=  null){
                $('#view').removeClass('disabled')
                $('#edit').removeClass('disabled')
                $('#delete').removeClass('disabled')
                $('#event').removeClass('disabled')
            }

        })
    </script>
@endsection
