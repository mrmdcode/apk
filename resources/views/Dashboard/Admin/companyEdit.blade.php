@extends("Dashboard.Admin.Layouts.app")

@section('content')
    <div class="card mt-3">
        <div class="card-body">
            <h2>{{$user->company->company_name}}</h2>
            <form action="{{ route('admin.companyUpdate',$user->id) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="row">


                    <div class="form-group col-md-6">
                        <label for="company_registration_number" class="col-form-label">شماره ثبت شرکت</label>
                        <input type="text" name="company_registration_number"
                               value="{{$user->company->company_registration_number ? $user->company->company_registration_number : "" }}"
                               user class="user form-control" id="company_registration_number"
                               placeholder="شماره ثبت شرکت">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email" class="col-form-label">ایمیل</label>
                        <input type="email" name="email" value="{{$user->email ? $user->email : ""}}" user
                               class="user form-control" id="company_registration_number" placeholder="a@a.a">

                    </div>

                </div>


                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="company_address" class="col-form-label">آدرس شرکت</label>
                        <input type="text" name="company_address"
                               value="{{$user->company->company_address ? $user->company->company_address : "" }}" user
                               class="user form-control" id="company_address" placeholder="آدرس شرکت">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="legal_address_company" class="col-form-label">آدرس حقوقی شرکت</label>
                        <input type="text" name="legal_address_company"
                               value="{{$user->company->legal_address_company ? $user->company->legal_address_company : "" }}"
                               user class="user form-control" id="legal_address_company" placeholder="آدرس حقوقی شرکت">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label for="economic_code_company" class="col-form-label">کد اقتصادی شرکت</label>
                        <input type="text" name="economic_code_company"
                               value="{{$user->company->economic_code_company ? $user->company->economic_code_company : "" }}"
                               user class="user form-control" id="economic_code_company" placeholder="کد اقتصادی شرکت">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="postal_code_company" class="col-form-label">کد پستی شرکت</label>
                        <input type="text" name="postal_code_company"
                               value="{{$user->company->postal_code_company ? $user->company->postal_code_company : "" }}"
                               user class="user form-control" id="postal_code_company" placeholder="کد پستی شرکت">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label for="name_agent_company" class="col-form-label">نام نماینده شرکت</label>
                        <input type="text" name="name_agent_company"
                               value="{{$user->company->name_agent_company ? $user->company->name_agent_company : "" }}"
                               user class="user form-control" id="name_agent_company" placeholder="نام نماینده شرکت">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="phone_agent_company" class="col-form-label">تلفن نماینده شرکت</label>
                        <input type="text" name="phone_agent_company"
                               value="{{$user->company->phone_agent_company ? $user->company->phone_agent_company : "" }}"
                               user class="user form-control" id="phone_agent_company" placeholder="تلفن نماینده شرکت">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label for="national_ID" class="col-form-label">کد ملی</label>
                        <input type="text" name="national_ID"
                               value="{{$user->company->national_ID ? $user->company->national_ID : "" }}" user
                               class="user form-control" id="national_ID" placeholder="کد ملی">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="type" class="col-form-label" r>نوع شرکت</label>
                        <select name="type" class="form-control" id="type">
                            @switch($user->company->type)
                                @case('seller')
                                    <option value="seller" selected>فروشنده</option>
                                    <option value="buyer">خریدار</option>
                                    <option value="both">هردو</option>
                                    @break
                                @case('buyer')
                                    <option value="seller">فروشنده</option>
                                    <option value="buyer" selected>خریدار</option>
                                    <option value="both">هردو</option>
                                    @break
                                @case('both')
                                    <option value="seller">فروشنده</option>
                                    <option value="buyer">خریدار</option>
                                    <option value="both" selected>هردو</option>
                                    @break
                            @endswitch
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary m-3 px-4 text-light">بروزرسانی</button>
            </form>


            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
