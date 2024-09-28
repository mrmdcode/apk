@extends("Dashboard.CompanyEN.Layouts.app")

@section("content")
    <div class="card mt-5">
        <div class="card-body">

            <h4 class="mt-0 header-title">مدیریت موتور</h4>


            <div class="table-responsive my-5">
                <table class="table table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Event Name</th>
                        <th>Data Count</th>
                        <th> Values (min - normal - max)</th>
                        <th>Count E</th>
                        <th>Count W</th>
                        <th>Count N</th>
                        <th>Payload</th>
                        <th>Topic</th>
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


                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">Data is not available</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
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

            updateHref('#view', targer);
            updateHref('#edit', targer);
            updateHref('#delete', targer);

            if (targer != null) {
                $('#view').removeClass('disabled')
                $('#edit').removeClass('disabled')
                $('#delete').removeClass('disabled')
            }

        })

    </script>
@endsection
