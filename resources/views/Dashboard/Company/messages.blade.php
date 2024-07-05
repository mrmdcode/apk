@extends("Dashboard.Company.Layouts.app")


@section('content')
    <div class="card mt-5">
        <div class="card-body">

            <div class="row">
                <form action="#" method="post">
                    @csrf

                </form>
            </div>

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

