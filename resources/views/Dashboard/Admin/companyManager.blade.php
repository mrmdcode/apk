@extends("Dashboard.Admin.Layouts.app")
@section("content")
    <div class="card row my-5 ">
        <div class="card-body">
            <h4 class="mt-0 header-title">مدیریت شرکت ها</h4>
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>شرکت</th>
                        <th>نوع شرکت</th>
                        <th>تعداد موتور ها</th>

                        <th>انتخاب</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @forelse($users as $user)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$user->company->company_name}}</td>
                            <td>
                                @switch($user->company->type)
                                    @case('seller')
                                        فروشنده
                                        @break
                                    @case('buyer')
                                        خریدار
                                        @break
                                    @case('both')
                                        فروشنده / خریدار
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @switch($user->company->type)
                                    @case('seller')
                                        {{$user->company->soldMotors->count()}}
                                        @break
                                    @case('buyer')
                                        {{$user->company->boughtMotors->count()}}
                                        @break
                                    @case('both')
                                        {{$user->company->soldMotors->count() + $user->company->boughtMotors->count()}}

                                        @break
                                @endswitch
                            </td>

                            <td>
                                <input type="radio" name="choice" id="choice_{{$user->id}}" value="{{$user->id}}">
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td>دیتا نا موجود</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card pt-3 px-3 row ">
                <div class="row ">
                    <div class="col-xl-4 col-md-6">
                        <a href="{{route('admin.companyView',0)}}" class="btn btn-primary btn-block disabled" id="view">مشاهده
                            کلی</a>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <a href="{{route('admin.companyEdit',0)}}" class="btn btn-warning btn-block disabled" id="edit">ویرایش</a>
                    </div>

                    <div class="col-xl-4 col-md-6">
                        <a href="{{route('admin.companyDelete',0)}}" class="btn btn-danger btn-block disabled"
                           id='delete'>حذف</a>
                    </div>
                </div>
                <div class="row">
                    <a href="{{route('admin.companyMotors',0)}}" class="btn btn-block btn-outline-secondary disabled"
                       id="motors">موتور ها</a>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script !src="">


        let targer;


        $('input[name="choice"]').on('change', function () {
            targer = $('input[name="choice"]:checked').val()

            function updateHref(elementId, target) {
                let url = $(elementId).attr('href');
                url = url.split('/');
                url.pop();
                url = url.join('/');
                $(elementId).attr('href', url + '/' + target);
            }

            updateHref('#view', targer);
            updateHref('#edit', targer);
            updateHref('#delete', targer);
            updateHref('#motors', targer);
            if (targer != null) {
                $('#view').removeClass('disabled')
                $('#edit').removeClass('disabled')
                $('#delete').removeClass('disabled')
                $('#motors').removeClass('disabled')
            }

        })


    </script>
@endsection
