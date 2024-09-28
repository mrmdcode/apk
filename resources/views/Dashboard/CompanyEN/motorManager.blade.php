@extends('Dashboard.CompanyEN.Layouts.app')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">لیست موتور ها</h4>
            </div>

            <div class="default-table-area members-list">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-primary text-start">
                                <div class="form-check">
                                    <label class="form-check-label ms-2" for="flexCheckDefault">Name/Owner</label>
                                </div>
                            </th>
                            <th scope="col">Serial</th>
                            <th scope="col">Start Data</th>
                            <th scope="col">Installation Data</th>
                            <th scope="col">alert Nor\alert War\alert Err</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($motors as $motor)


                            <tr class="text-center">
                                <td class="text-start">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check pe-2">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                        </div>
                                        <div class="d-flex align-items-center">

                                            <div class="flex-grow-1 ms-10">
                                                <h4 class="fw-semibold fs-16 mb-0">{{$motor->motor_name}}</h4>
                                                <span class="text-gray-light">{{$motor->buyer->company_name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{$motor->motor_serial}}
                                </td>
                                <td>
                                    {{ $motor->motor_start? $motor->motor_start : "no Data"  }}
                                </td>
                                <td>
                                    {{ verta($motor->instalation_date)->format("y/m") }}
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <span class="bg-danger bg-opacity-10 text-danger fs-13 fw-semibold py-1 px-2 rounded-1">{{$motor->data->where('process','error')->count()}}</span>
                                        <span class="bg-warning bg-opacity-10 text-warning fs-13 fw-semibold py-1 px-2 rounded-1">{{$motor->data->where('process','warning')->count()}}</span>
                                        <span class="bg-success bg-opacity-10 text-success fs-13 fw-semibold py-1 px-2 rounded-1">{{$motor->data->where('process','normal')->count()}}</span>
                                    </div>
                                </td>

                                <td>
                                    <div class="dropdown action-opt">
                                        <button class="btn bg p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i data-feather="more-horizontal"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                            <li>
                                                <a class="dropdown-item" href="{{route('company.motorView',$motor->id)}}">
                                                    <i data-feather="link-2"></i>
                                                    View
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:;">
                                                    <i data-feather="link-2"></i>
                                                    Receive Report (Excel)
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>not data</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{$motors->links()}}
            </div>
        </div>
    </div>
@endsection
