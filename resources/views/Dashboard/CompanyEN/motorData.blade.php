@extends("Dashboard.CompanyEN.Layouts.app")
@section("content")
    <div class="card m-t-5">
        <div class="card-body">

            {{--            <h4 class="mt-0 header-title"> مدیریت اخطار ها - {{$motor->name}}</h4>--}}
            <div class="row px-4">
                {{--                <a href="{{route('admin.motorEventStore',$motor->id)}}" class="btn btn-outline-success">افزودن اخطار</a>--}}
            </div>

            <div class="table-responsive my-5">
                <table class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام موتور</th>
                        <th>نام رویداد</th>
                        <th>buyer</th>
                        <th>volume of data</th>
                        <th>status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @forelse($logs as $log)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$log->motor->motor_name}}</td>
                            <td>{{$log->event->name}}</td>
                            <td>{{$log->motor->buyer->company_name}}</td>
                            <td>{{$log->data}}</td>
                            <td>{{$log->process}}</td>
                            <td>{{verta($log->created_at)}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">دیتا نا موجود</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="row justify-content-center">
                    {{$logs->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

