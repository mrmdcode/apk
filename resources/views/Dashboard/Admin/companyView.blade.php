@extends("Dashboard.Admin.Layouts.app")
@section('content')
    <div class="card bg-white border-0  my-5">
        <div class="card-body">
            <h2>{{$user->company->company_name}}</h2>
            <form>

                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="company_registration_number" class="col-form-label">شماره ثبت شرکت</label>
                        <input type="text" name="company_registration_number"
                               value="{{$user->company->company_registration_number ? $user->company->company_registration_number : "" }}"
                               disabled class="disabled form-control" id="company_registration_number"
                               placeholder="شماره ثبت شرکت">
                    </div>


                    <div class="form-group col-md-6">
                        <label for="email" class="col-form-label">ایمیل</label>
                        <input type="email" name="email" value="{{$user->email ? $user->email : ""}}" disabled
                               class="disabled form-control" id="company_registration_number" placeholder="a@a.a">

                    </div>


                </div>


                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="company_address" class="col-form-label">آدرس شرکت</label>
                        <input type="text" name="company_address"
                               value="{{$user->company->company_address ? $user->company->company_address : "" }}"
                               disabled class="disabled form-control" id="company_address" placeholder="آدرس شرکت">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="legal_address_company" class="col-form-label">آدرس حقوقی شرکت</label>
                        <input type="text" name="legal_address_company"
                               value="{{$user->company->legal_address_company ? $user->company->legal_address_company : "" }}"
                               disabled class="disabled form-control" id="legal_address_company"
                               placeholder="آدرس حقوقی شرکت">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label for='economic_code_company' class="col-form-label"> کد اقتصادی شرکت </label>
                        <input type="text" name="economic_code_company"
                               value="{{$user->company->economic_code_company ? $user->company->economic_code_company : "" }}"
                               disabled class="disabled form-control" id="economic_code_company"
                               placeholder="کد اقتصادی شرکت">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="postal_code_company" class="col-form-label">کد پستی شرکت</label>
                        <input type="text" name="postal_code_company"
                               value="{{$user->company->postal_code_company ? $user->company->postal_code_company : "" }}"
                               disabled class="disabled form-control" id="postal_code_company"
                               placeholder="کد پستی شرکت">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label for="name_agent_company" class="col-form-label">نام نماینده شرکت</label>
                        <input type="text" name="name_agent_company"
                               value="{{$user->company->name_agent_company ? $user->company->name_agent_company : "" }}"
                               disabled class="disabled form-control" id="name_agent_company"
                               placeholder="نام نماینده شرکت">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="phone_agent_company" class="col-form-label">تلفن نماینده شرکت</label>
                        <input type="text" name="phone_agent_company"
                               value="{{$user->company->phone_agent_company ? $user->company->phone_agent_company : "" }}"
                               disabled class="disabled form-control" id="phone_agent_company"
                               placeholder="تلفن نماینده شرکت">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label for="national_ID" class="col-form-label">کد ملی</label>
                        <input type="text" name="national_ID"
                               value="{{$user->company->national_ID ? $user->company->national_ID : "" }}" disabled
                               class="disabled form-control" id="national_ID" placeholder="کد ملی">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="type" class="col-form-label ">نوع شرکت</label>
                        <select name="type" class="form-control disabled" disabled id="type">
                            @switch($user->company->type)
                                @case('seller')
                                    <option value="seller">فروشنده</option>
                                    @break
                                @case('buyer')
                                    <option value="buyer">خریدار</option>
                                    @break
                                @case('both')
                                    <option value="both">هردو</option>
                                    @break
                            @endswitch
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
                                    <label class="form-check-label ms-2" for="flexCheckDefault">نام/مالک</label>
                                </div>
                            </th>
                            <th scope="col">سریال</th>
                            <th scope="col">زمان استارت</th>
                            <th scope="col">زمان نصب</th>
                            <th scope="col">هشدار Err\هشدار War\هشدار Nor</th>
                            <th scope="col">عملیات</th>
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
                                    {{ $motor->motor_start? $motor->motor_start : "راه اندازی نشده"  }}
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
                                                <a class="dropdown-item" href="{{route('admin.motorEdit',$motor->id)}}">
                                                    <i data-feather="edit-2"></i>
                                                    ویرایش
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{route('admin.motorView',$motor->id)}}">
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
                                                <a class="dropdown-item" href="{{route('admin.motorDelete',$motor->id)}}">
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
            </div>
        </div>
    </div>
@endsection

