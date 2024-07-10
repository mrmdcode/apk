@extends('Dashboard.Admin.Layouts.app')
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
                <h4 class="fw-semibold fs-18 mb-sm-0">لیست کاربران</h4>
                <a href="{{route('admin.companyCreate')}}" class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                <span class="py-sm-1 d-block">
                    <i class="ri-add-line text-white"></i>
                    <span>افزودن شرکت</span>
                </span>
                </a>
            </div>

            <div class="default-table-area members-list">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-primary text-start">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label ms-2" for="flexCheckDefault">نام</label>
                                </div>
                            </th>
                            <th scope="col">ایمیل</th>
                            <th scope="col">نقش</th>
                            <th scope="col">تعداد موتور</th>
                            <th scope="col">افزوده شده در </th>
                            <th scope="col">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)


                            <tr class="text-center">
                                <td class="text-start">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check pe-2">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 lh-1">
                                                <img src="{{$user->company->company_logo}}" class="wh-44 rounded-circle" alt="user">
                                            </div>
                                            <div class="flex-grow-1 ms-10">
                                                <h4 class="fw-semibold fs-16 mb-0">{{$user->company->company_name}}</h4>
                                                <span class="text-gray-light">@if($user->company->name_agent_company != null){{$user->company->name_agent_company}}@elseفاقد نماینده  @endif</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                </td>
                                <td>
                                    @switch($user->company->type)
                                        @case('buyer')
                                            <span>خریدار</span>
                                            @break
                                        @case('seller')
                                            <span>فروشنده</span>
                                            @break
                                        @case('both')
                                            <span>خریدار\فروشنده</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <span class="bg-success bg-opacity-10 text-success fs-13 fw-semibold py-1 px-2 rounded-1">{{$user->company->boughtMotors->count() }}</span>
                                        <span class="bg-danger bg-opacity-10 text-danger fs-13 fw-semibold py-1 px-2 rounded-1">{{ $user->company->soldMotors->count() }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span>{{verta($user->company->created_at)}}</span>
                                </td>
                                <td>
                                    <div class="dropdown action-opt">
                                        <button class="btn bg p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i data-feather="more-horizontal"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                            <li>
                                                <a class="dropdown-item" href="{{route('admin.companyEdit',$user->id)}}">
                                                    <i data-feather="edit-2"></i>
                                                    ویرایش
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{route('admin.companyView',$user->id)}}">
                                                    <i data-feather="link-2"></i>
                                                    مشاهده
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:;">
                                                    <i data-feather="link-2"></i>
                                                    دریافت گزارشات (Excel)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{route('admin.companyDelete',$user->id)}}">
                                                    <i data-feather="trash-2"></i>
                                                    حذف
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
                {{$users->links()}}
            </div>
        </div>
    </div>
@endsection
