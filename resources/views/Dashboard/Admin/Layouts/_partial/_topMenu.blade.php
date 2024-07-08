<div class="topbar">

    <div class="topbar-left	d-none d-lg-block">
        <div class="text-center">
            <a  class="logo"><img src="{{asset('assets/dashboard/images/logo_dark.png')}}" class="w-100" alt="logo"></a>
        </div>
    </div>

    <nav class="navbar-custom">



        <ul class="list-inline float-right mb-0">


            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell-outline noti-icon"></i>
                    <span class="badge badge-danger badge-pill noti-icon-badge">{{\App\Http\Controllers\appChatController::dontSeenMessages(auth()->user()->company->id)->count()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg dropdown-menu-animated">
                    <!-- item-->
                    <div class="dropdown-item noti-title">

                    </div>

                    <div class="slimscroll-noti">
                        <!-- item-->

                        @forelse(\App\Http\Controllers\appChatController::dontSeenMessages(auth()->user()->company->id) as $message)
                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i></div>
                                <p class="notify-details"><b>{{$message->message}}</b><span>&nbsp;</span></p>
                            </a>
                        @empty

                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                <div class="notify-icon bg-success"></div>
                                <p class="notify-details"><b>سفارش شما قرار داده شده است</b><span class="text-muted">شما هیچ پیام مشاهده نشده ای ندارید .</span></p>
                            </a>
                        @endforelse


                    </div>


                    <!-- All-->
                    <a href="{{route('admin.messages')}}" class="dropdown-item notify-all">
                        مشاهده همه
                    </a>

                </div>
            </li>




            <li class="list-inline-item dropdown notification-list nav-user">
                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">

                    <span class="d-none d-md-inline-block ml-1"> {{auth()->user()->company->company_name}} <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                    <a class="dropdown-item" href="#"><i class="dripicons-box text-muted"></i>تغییر زبان EN</a>
                    <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i> قفل صفحه</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{route('logout')}}" method="post" id="fmlogout">
                        @csrf
                    </form>
                    <button class="dropdown-item" onclick=" $('#fmlogout').submit()"><i class="dripicons-exit text-muted"></i> خروج</button>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>

        </ul>

    </nav>

</div>
