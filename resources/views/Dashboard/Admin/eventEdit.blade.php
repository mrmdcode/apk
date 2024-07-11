@extends('Dashboard.Admin.Layouts.app')

@section('content')
    <div class="card bg-white border-0 mt-1">
        <div class="card-body">
            <form action="{{ route('admin.motorEventUpdate',$event->id) }}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" name="motor_id" value="{{$event->motor->id}}">
                <div class="row">
                    <div class="form-group col-md-3 mb-4">
                        <label for="motor_id">نام موتور</label>
                        <input type="text" class="form-control" disabled value="{{ $event->motor->motor_name }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name">نام اخطار</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $event->name }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="topic">Topic</label>
                        <input type="text" name="topic" id="topic" class="form-control @error('topic') is-invalid @enderror" value="{{ $event->topic}}">
                        @error('topic')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="payload">Payload</label>
                        <input type="text" name="payload" id="payload" class="form-control @error('payload') is-invalid @enderror" value="{{ $event->payload }}">
                        @error('payload')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="normal">Normal</label>
                        <input type="number" name="normal" id="normal" class="form-control @error('normal') is-invalid @enderror" value="{{ $event->normal }}">
                        @error('normal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="min">Min</label>
                        <input type="number" name="min" id="min" class="form-control @error('min') is-invalid @enderror" value="{{ $event->min }}">
                        @error('min')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="max">Max</label>
                        <input type="number" name="max" id="max" class="form-control @error('max') is-invalid @enderror" value="{{ $event->max }}">
                        @error('max')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary m-2 px-3 text-light">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection
