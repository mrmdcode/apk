@extends("Dashboard.Layouts.app")
@section('content')
   <div class="card mt-3">
       <div class="card-body">
           <h2>{{$user->company->company_name}}</h2>
           <form>

               <div class="form-row">

                   <div class="form-group col-md-6">
                       <label for="company_registration_number" class="col-form-label">شماره ثبت شرکت</label>
                       <input type="text" name="company_registration_number" value="{{$user->company->company_registration_number ? $user->company->company_registration_number : "" }}" disabled class="disabled form-control" id="company_registration_number" placeholder="شماره ثبت شرکت">
                   </div>




                   <div class="form-group col-md-6">
                       <label for="email" class="col-form-label">ایمیل</label>
                       <input type="email" name="email" value="{{$user->company->email ? $user->company->email : ""}}" disabled class="disabled form-control" id="company_registration_number" placeholder="a@a.a">

                   </div>


               </div>




               <div class="form-row">
                   <div class="form-group col-md-6">
                       <label for="company_address" class="col-form-label">آدرس شرکت</label>
                       <input type="text" name="company_address" value="{{$user->company->company_address ? $user->company->company_address : "" }}" disabled class="disabled form-control" id="company_address" placeholder="آدرس شرکت">
                   </div>

                   <div class="form-group col-md-6">
                       <label for="legal_address_company" class="col-form-label">آدرس حقوقی شرکت</label>
                       <input type="text" name="legal_address_company" value="{{$user->company->legal_address_company ? $user->company->legal_address_company : "" }}" disabled class="disabled form-control" id="legal_address_company" placeholder="آدرس حقوقی شرکت">
                   </div>
               </div>

               <div class="form-row">
                   <div class="form-group col-md-6 ">
                       <label for='economic_code_company' class="col-form-label" > کد اقتصادی شرکت </label>
                       <input type="text" name="economic_code_company" value="{{$user->company->economic_code_company ? $user->company->economic_code_company : "" }}" disabled class="disabled form-control" id="economic_code_company" placeholder="کد اقتصادی شرکت">
                   </div>

                   <div class="form-group col-md-6">
                       <label for="postal_code_company" class="col-form-label">کد پستی شرکت</label>
                       <input type="text" name="postal_code_company" value="{{$user->company->postal_code_company ? $user->company->postal_code_company : "" }}" disabled class="disabled form-control" id="postal_code_company" placeholder="کد پستی شرکت">
                   </div>
               </div>

               <div class="form-row">
                   <div class="form-group col-md-6 ">
                       <label for="name_agent_company" class="col-form-label">نام نماینده شرکت</label>
                       <input type="text" name="name_agent_company" value="{{$user->company->name_agent_company ? $user->company->name_agent_company : "" }}" disabled class="disabled form-control" id="name_agent_company" placeholder="نام نماینده شرکت">
                   </div>

                   <div class="form-group col-md-6 ">
                       <label for="phone_agent_company" class="col-form-label">تلفن نماینده شرکت</label>
                       <input type="text" name="phone_agent_company" value="{{$user->company->phone_agent_company ? $user->company->phone_agent_company : "" }}" disabled class="disabled form-control" id="phone_agent_company" placeholder="تلفن نماینده شرکت">
                   </div>
               </div>

               <div class="form-row">
                   <div class="form-group col-md-6 ">
                       <label for="national_ID" class="col-form-label">کد ملی</label>
                       <input type="text" name="national_ID" value="{{$user->company->national_ID ? $user->company->national_ID : "" }}" disabled class="disabled form-control" id="national_ID" placeholder="کد ملی">
                   </div>

                   <div class="form-group col-md-6 ">
                       <label for="type" class="col-form-label " >نوع شرکت</label>
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
   <div class="card mt-5">
       <div class="card-body">

           <h4 class="mt-0 header-title">مدیریت موتور</h4>


           <div class="table-responsive my-5">
               <table class="table table-bordered mb-0">
                   <thead>
                   <tr>
                       <th>#</th>
                       <th>نام موتور</th>
                       <th>سریال موتور</th>
                       <th>زمان استارت</th>
                       <th>زمان نصب</th>
                       <th>تعداد اخطار</th>
                       <th>توضیخات موتور</th>
                       <th>انتخاب</th>
                   </tr>
                   </thead>
                   <tbody>
                   @php $i=1; @endphp
                   @forelse($motors as $motor)
                       <tr>
                           <th scope="row">{{$i++}}</th>
                           <td>{{$motor->motor_name}}</td>
                           <td>{{$motor->motor_serial}}</td>
                           <td>{{ $motor->motor_start? $motor->motor_start : "راه اندازی نشده"  }}</td>
                           <td>{{ verta($motor->instalation_date)->format("y/m") }}</td>
                           <td> 0 </td>
                           <td>{{\Illuminate\Support\Str::substr($motor->motor_description,0,50)}}</td>
                           <td>
                               <input type="radio" name="choice" value="{{$motor->id}}" id="motor_{{$motor->id}}">
                           </td>
                       </tr>
                   @empty
                       <tr>
                           <td colspan="8">دیتا نا موجود</td>
                       </tr>
                   @endforelse
                   </tbody>
               </table>
           </div>
           <div class="card pt-3 px-3 row ">
               <div class="row ">
                   <div class="col-xl-4 col-md-6">
                       <a href="{{route('admin.motorView',0)}}" class="btn btn-primary btn-block disabled" id="view">مشاهده کلی</a>
                   </div>
                   <div class="col-xl-4 col-md-6">
                       <a href="{{route('admin.motorEdit',0)}}" class="btn btn-warning btn-block disabled" id="edit">ویرایش</a>
                   </div>
                   <div class="col-xl-4 col-md-6">
                       <a href="{{route('admin.motorDelete',0)}}" class="btn btn-danger btn-block disabled" id="delete">حذف</a>
                   </div>
               </div>
               <div class="row">
                   <a href="{{route('admin.motorEvent',0)}}" class="btn btn-block btn-outline-secondary disabled" id="event">تنظیم اخطار</a>
               </div>
           </div>
       </div>
   </div>
@endsection
@section('js')
    <script !src="">
        let targer ;
        console.log("ff")
        $('input[name="choice"]').on('change',function (){
            targer = $('input[name="choice"]:checked').val()

            function updateHref(elementId, target) {
                let url = $(elementId).attr('href');
                url = url.split('/');
                url.pop();
                url = url.join('/');
                $(elementId).attr('href', url + '/' + target);
            }

            updateHref('#view',targer);
            updateHref('#edit',targer);
            updateHref('#delete',targer);
            updateHref('#event',targer);
            if(targer !=  null){
                $('#view').removeClass('disabled')
                $('#edit').removeClass('disabled')
                $('#delete').removeClass('disabled')
                $('#event').removeClass('disabled')
            }

        })
    </script>

@endsection
