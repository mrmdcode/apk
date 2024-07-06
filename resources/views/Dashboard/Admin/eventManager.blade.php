@extends("Dashboard.Admin.Layouts.app")
@section("content")
    <div class="card mt-5">
        <div class="card-body">

            <h4 class="mt-0 header-title">مدیریت موتور</h4>
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif

            <div class="table-responsive my-5">
                <table class="table table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام رویداد</th>
                        <th>تعداد دیتا</th>
                        <th> مقادیر (کم - نرمال - زیاد)</th>
                        <th>مقدار E</th>
                        <th>مقدار W</th>
                        <th>مقدار N</th>
                        <th>payload</th>
                        <th>topic</th>
                        <th>انتخاب</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @forelse($events as $event)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$event->name}}</td>
                            <td>{{$event->data->count()}}</td>
                            <td>({{$event->min}} < {{$event->normal}} > {{$event->max}})</td>
                            <td>{{$event->data->where('process',"error")->count()}}</td>
                            <td>{{$event->data->where('process',"warning")->count()}}</td>
                            <td>{{$event->data->where('process',"normal")->count()}}</td>
                            <td>{{$event->payload}}</td>
                            <td>{{$event->topic}}</td>

                            <td>
                                <input type="radio" name="choice" value="{{$event->id}}">
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
                        <a href="{{route('admin.motorEventEdit',0)}}" class="btn btn-warning btn-block disabled" id="edit">ویرایش</a>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <a class="btn btn-outline-secondary btn-block" href="{{route('admin.motorEventCreate',$motorId)}}">ساخت اخطار</a>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <a href="{{route('admin.motorDelete',0)}}" class="btn btn-danger btn-block disabled"
                           id="delete">حذف</a>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let targer;


        console.log("ff")
        $('input[name="choice"]').on('change', function () {
            targer = $('input[name="choice"]:checked').val()

            function updateHref(elementId, target) {
                let url = $(elementId).attr('href');
                url = url.split('/');
                url.pop();
                url = url.join('/');
                $(elementId).attr('href', url + '/' + target);
            }

            updateHref('#edit', targer);
            updateHref('#delete', targer);

            if (targer != null) {
                $('#edit').removeClass('disabled')
                $('#delete').removeClass('disabled')
            }

        })

    </script>
@endsection
