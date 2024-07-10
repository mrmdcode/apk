@extends("Dashboard.Admin.Layouts.app")

@section('content')
    <div class="card bg-white border-0 rounded-10 my-5">
        <div class="card-body">
            <h2>ایجاد شرکت جدید</h2>
            <form action="{{ route('admin.companyStore') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 @if($errors->has('company_name')) has-danger @endif">
                        <label for="company_name" class="col-form-label">نام شرکت</label>
                        <input type="text" name="company_name" class="form-control" id="company_name">
                        @if($errors->has('company_name'))
                            <div class="form-control-feedback">لطفاً نام شرکت را وارد کنید</div>
                        @endif
                        <small class="form-text text-muted">مثال: شرکت ABC</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('company_registration_number')) has-danger @endif">
                        <label for="company_registration_number" class="col-form-label">شماره ثبت شرکت</label>
                        <input type="text" name="company_registration_number" class="form-control"
                               id="company_registration_number">
                        @if($errors->has('company_registration_number'))
                            <div class="form-control-feedback">لطفاً شماره ثبت شرکت را وارد کنید</div>
                        @endif
                        <small class="form-text text-muted">مثال: 123456</small>
                    </div>
                </div>
                <div class="row">


                    <div class="form-group col-md-6 @if($errors->has('email')) has-danger @endif">
                        <label for="email" class="col-form-label">ایمیل</label>
                        <input type="email" name="email" class="form-control" id="company_registration_number">
                        @if($errors->has('email'))
                            <div class="form-control-feedback">لطفاً ایمیل را وارد کنید</div>
                        @endif
                        <small class="form-text text-muted">مثال: a@a.a</small>
                    </div>


                    <div class="form-group col-md-6 @if($errors->has('password')) has-danger @endif">
                        <label for="password" class="col-form-label">رمز عبور</label>
                        <input type="text" name="password" class="form-control" id="company_registration_number">
                        @if($errors->has('company_registration_number'))
                            <div class="form-control-feedback">لطفاً رمز را وارد کنید</div>
                        @endif
                        <small class="form-text text-muted">مثال: 123456</small>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-md-6 @if($errors->has('company_address')) has-danger @endif">
                        <label for="company_address" class="col-form-label">آدرس شرکت</label>
                        <input type="text" name="company_address" class="form-control" id="company_address">
                        @if($errors->has('company_address'))
                            <div class="form-control-feedback">لطفاً آدرس شرکت را وارد کنید</div>
                        @endif
                        <small class="form-text text-muted">مثال: تهران، خیابان ولیعصر</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('legal_address_company')) has-danger @endif">
                        <label for="legal_address_company" class="col-form-label">آدرس حقوقی شرکت</label>
                        <input type="text" name="legal_address_company" class="form-control" id="legal_address_company">
                        @if($errors->has('legal_address_company'))
                            <div class="form-control-feedback">لطفاً آدرس حقوقی شرکت را وارد کنید</div>
                        @endif
                        <small class="form-text text-muted">مثال: تهران، خیابان انقلاب</small>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 @if($errors->has('economic_code_company')) has-danger @endif">
                        <label for="economic_code_company" class="col-form-label">کد اقتصادی شرکت</label>
                        <input type="text" name="economic_code_company" class="form-control" id="economic_code_company">
                        @if($errors->has('economic_code_company'))
                            <div class="form-control-feedback">لطفاً کد اقتصادی شرکت را وارد کنید</div>
                        @endif
                        <small class="form-text text-muted">مثال: 789456</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('postal_code_company')) has-danger @endif">
                        <label for="postal_code_company" class="col-form-label">کد پستی شرکت</label>
                        <input type="text" name="postal_code_company" class="form-control" id="postal_code_company">
                        @if($errors->has('postal_code_company'))
                            <div class="form-control-feedback">لطفاً کد پستی شرکت را وارد کنید</div>
                        @endif
                        <small class="form-text text-muted">مثال: 1234567890</small>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 @if($errors->has('name_agent_company')) has-danger @endif">
                        <label for="name_agent_company" class="col-form-label">نام نماینده شرکت</label>
                        <input type="text" name="name_agent_company" class="form-control" id="name_agent_company">
                        @if($errors->has('name_agent_company'))
                            <div class="form-control-feedback">لطفاً نام نماینده شرکت را وارد کنید</div>
                        @endif
                        <small class="form-text text-muted">مثال: محمد رضایی</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('phone_agent_company')) has-danger @endif">
                        <label for="phone_agent_company" class="col-form-label">تلفن نماینده شرکت</label>
                        <input type="text" name="phone_agent_company" class="form-control" id="phone_agent_company">
                        @if($errors->has('phone_agent_company'))
                            <div class="form-control-feedback">لطفاً تلفن نماینده شرکت را وارد کنید</div>
                        @endif
                        <small class="form-text text-muted">مثال: 09121234567</small>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 @if($errors->has('national_ID')) has-danger @endif">
                        <label for="national_ID" class="col-form-label">کد ملی</label>
                        <input type="text" name="national_ID" class="form-control" id="national_ID">
                        @if($errors->has('national_ID'))
                            <div class="form-control-feedback">لطفاً کد ملی را وارد کنید</div>
                        @endif
                        <small class="form-text text-muted">مثال: 1234567890</small>
                    </div>

                    <div class="form-group col-md-6 @if($errors->has('type')) has-danger @endif">
                        <label for="type" class="col-form-label">نوع شرکت</label>
                        <select name="type" class="form-control" id="type">
                            <option value="seller">فروشنده</option>
                            <option value="buyer">خریدار</option>
                            <option value="both">هردو</option>
                        </select>
                        @if($errors->has('type'))
                            <div class="form-control-feedback">لطفاً نوع شرکت را انتخاب کنید</div>
                        @endif
                        <small class="form-text text-muted">مثال: خصوصی</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
