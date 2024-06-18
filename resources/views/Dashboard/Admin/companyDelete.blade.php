@extends("Dashboard.Layouts.app")
@section("content")
    <form action="{{route('admin.companyDestroy',$company->id)}}" method="post" class="d-none" id="formd">
        @csrf
        @method('delete')
        @method('DELETE')
    </form>
    <div class="card row my-5 ">
        <div class="card-body">
            <h3 class="mt-0 header-title" id="name">حذف  {{$company->company->company_name}}</h3>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8  ">
                    <div class="alert alert-danger ">
                        آیا از حذف  {{$company->company ->company_name}} مطمئن هستید.
                    </div>
                    <div class="alert alert-danger ">
                        آیا از حذف تمام موتور هایی که شرکت مذکور در آن نقش داشته باشد (خریدار/فروشنده) حذف میشود .
                    </div>
                    <div class="alert alert-danger ">
                     با مدیریت یا نماینده مدیر شرکت اسرار پایش کوشما مشورت کنید .
                    </div>
                    <div class="alert alert-danger ">
                        تمامی دیتا ها از پایگاه داده حذف میشوند دیگه قابل بازگت نیستند
                    </div>
                    <div class="alert alert-warning">
                        باید مد نظر داشته باشید دیگر شرکت بازنخواهد گشت .
                        <br>
                        <input type="checkbox" class="form-control-sm" id="ch1">
                        با تایید مدیریت شرکت اسرار پایش کوشا اقدام به حذف و پاک کردن میکنید.
                        <br>
                        <input type="checkbox" class="form-control-sm" id="ch2">
                        با شرکت فروشنده به توافق رسیده اید.
                        <br>
                        <input type="checkbox" class="form-control-sm" id="ch3">
                        با شرکت خریدار به توافق رسیده اید.
                        <br>
                    </div>
                    <div class="alert alert-warning">
                        <label for="agentName">نام و نام خانوادگی </label>
                        <input type="text" name="agentName" id="agentName" class="form-control">
                    </div>

                    <div class="alert alert-warning">
                        <label for="password">پسورد ورود شرکت اسرار پایش کوشا   </label>
                        <input type="password" name="password" id="password" class="form-control" >
                    </div>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <button class="btn btn-outline-danger btn-block" id="submit">حذف شرکت </button>
                        </div>
                        <div class="col-3"></div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script !src="">

        console.log($('#ch1'),$('#ch2'),$('#ch3'),$('#agentName'),$('#password'),)


        const alerty=()=>{

            let timerInterval;
            Swal.fire({
                title: "شما با حذف شرکت موافقت کردید ؟",
                html: "آیا با "+$("#name").text()+" موافق هستید . <b></b>",
                timer: 20000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                deleteAlert();
                }
            });

        }


        const deleteAlert = () => {
            Swal.fire({
                title: "آیا مطمئمنید ؟",
                text: "برای "+$("#name").text()+"دکمه حذف را بزنید.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#fdd309",
                confirmButtonText: "بله ، حذف شود .",
                cancelButtonText : "خیر ، حذف نشود"
            }).then((result) => {
                if (result.isConfirmed) {
                    submitF();
                }
            });
        }
        const submitF = () => {
          $("#formd").submit();
        }
        $('#submit').click(alerty);
    </script>
@endsection
