@extends("Dashboard.Company.Layouts.app")
@section("content")
    <div class="card m-t-5">
        <div class="card-body">

            {{--            <h4 class="mt-0 header-title"> مدیریت اخطار ها - {{$motor->name}}</h4>--}}
            <div class="row px-4 justify-content-center">
                {{--                <a href="{{route('admin.motorEventStore',$motor->id)}}" class="btn btn-outline-success">افزودن اخطار</a>--}}
                {{$logs->links()}}
            </div>
            @if(Route::current()->getName() == 'company.motorError')

                <a href="{{route('company.motorErrorWON')}}" class="btn btn-secondary">بدون مقادیر normal</a>
            @endif

            <div class="my-5">
                @forelse($logs as $log)
                    @if($log->process == "warning")
                        <div class="alert alert-warning">موتور {{$log->motor->motor_name}} که
                            توسط {{$log->motor->buyer->company_name}} خریداری شده در زمان {{verta($log->created_at)}}
                            خطای Warning دارد .
                        </div>
                    @elseif($log->process == "error")
                        <div class="alert alert-danger">موتور {{$log->motor->motor_name}} که
                            توسط {{$log->motor->buyer->company_name}} خریداری شده در زمان {{verta($log->created_at)}}
                            خطای Error دارد .
                        </div>
                    @elseif('normal')
                        <div class="alert alert-success">موتور {{$log->motor->motor_name}} که
                            توسط {{$log->motor->buyer->company_name}} خریداری شده در زمان {{verta($log->created_at)}}
                            خطای Normal دارد .
                        </div>

                    @endif
                @empty
                    <div class="alert alert-success">
                        هیچ خطای Error و Warning وجود ندارد.
                    </div>
                @endforelse
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
