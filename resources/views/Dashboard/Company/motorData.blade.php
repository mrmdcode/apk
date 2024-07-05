@extends("Dashboard.Company.Layouts.app")

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
                        <th>خریدار</th>
                        <th>فروشنده</th>
                        <th>دیتا</th>
                        <th>پردازش</th>
                        <th>زمان پردازش</th>
                        <th>زمان دریافت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @forelse($logs as $log)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$log->motor->motor_name}}</td>
                            <td>{{$log->motor->buyer->company_name}}</td>
                            <td>{{$log->motor->seller->company_name}}</td>
                            <td>{{$log->data}}</td>
                            <td>@if($log->process)
                                    شده
                                @else
                                    نشده
                                @endif</td>
                            <td>{{verta($log->processed_at)}}</td>
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

@section('js')
    <script src="{{asset('assets/dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{asset('assets/dashboard/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/dashboard/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/dasboard/plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/dasboard/plugins/datatables/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('assets/dasboard/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script !src="">
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection
@section('css')
    <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection
