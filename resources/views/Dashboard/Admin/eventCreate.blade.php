@extends('Dashboard.Admin.Layouts.app')

@section('content')
    <div class="card bg-white border-0 mt-1">
        <div class="card-body">
            <form action="{{ route('admin.motorEventStore',$motor->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3 mb-4">
                        <label for="motor_id">نام موتور</label>
                        <input type="text" class="form-control" disabled value="{{ $motor->motor_name }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name">نام اخطار</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="topic">Topic</label>
                        <input type="text" name="topic" id="topic" class="form-control @error('topic') is-invalid @enderror" value="{{ old('topic') }}">
                        @error('topic')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="payload">Payload</label>
                        <input type="text" name="payload" id="payload" class="form-control @error('payload') is-invalid @enderror" value="{{ old('payload') }}">
                        @error('payload')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="normal">Normal</label>
                        <input type="number" name="normal" id="normal" class="form-control @error('normal') is-invalid @enderror" value="{{ old('normal') }}">
                        @error('normal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="min">Min</label>
                        <input type="number" name="min" id="min" class="form-control @error('min') is-invalid @enderror" value="{{ old('min') }}">
                        @error('min')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="max">Max</label>
                        <input type="number" name="max" id="max" class="form-control @error('max') is-invalid @enderror" value="{{ old('max') }}">
                        @error('max')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-3 m-2 text-light">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
