{{--<div class="topbar">--}}

{{--    <div class="topbar-left	d-none d-lg-block">--}}
{{--        <div class="text-center">--}}
{{--            <a  class="logo"><img src="{{asset('assets/dashboard/images/logo_dark.png')}}" class="w-100" alt="logo"></a>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <nav class="navbar-custom">--}}



{{--        <ul class="list-inline float-right mb-0">--}}


{{--            <li class="list-inline-item dropdown notification-list">--}}
{{--                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"--}}
{{--                   aria-haspopup="false" aria-expanded="false">--}}
{{--                    <i class="mdi mdi-bell-outline noti-icon"></i>--}}
{{--                    <span class="badge badge-danger badge-pill noti-icon-badge">{{\App\Http\Controllers\appChatController::dontSeenMessages(auth()->user()->company->id)->count()}}</span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg dropdown-menu-animated">--}}
{{--                    <!-- item-->--}}
{{--                    <div class="dropdown-item noti-title">--}}

{{--                    </div>--}}

{{--                    <div class="slimscroll-noti">--}}
{{--                        <!-- item-->--}}

{{--                        @forelse(\App\Http\Controllers\appChatController::dontSeenMessages(auth()->user()->company->id) as $message)--}}
{{--                            <a href="javascript:void(0);" class="dropdown-item notify-item active">--}}
{{--                                <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i></div>--}}
{{--                                <p class="notify-details"><b>{{$message->message}}</b><span>&nbsp;</span></p>--}}
{{--                            </a>--}}
{{--                        @empty--}}

{{--                            <a href="javascript:void(0);" class="dropdown-item notify-item active">--}}
{{--                                <div class="notify-icon bg-success"></div>--}}
{{--                                <p class="notify-details"><b>سفارش شما قرار داده شده است</b><span class="text-muted">شما هیچ پیام مشاهده نشده ای ندارید .</span></p>--}}
{{--                            </a>--}}
{{--                        @endforelse--}}


{{--                    </div>--}}


{{--                    <!-- All-->--}}
{{--                    <a href="{{route('admin.messages')}}" class="dropdown-item notify-all">--}}
{{--                        مشاهده همه--}}
{{--                    </a>--}}

{{--                </div>--}}
{{--            </li>--}}




{{--            <li class="list-inline-item dropdown notification-list nav-user">--}}
{{--                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"--}}
{{--                   aria-haspopup="false" aria-expanded="false">--}}

{{--                    <span class="d-none d-md-inline-block ml-1"> {{auth()->user()->company->company_name}} <i class="mdi mdi-chevron-down"></i> </span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">--}}
{{--                    <a class="dropdown-item" href="#"><i class="dripicons-box text-muted"></i>تغییر زبان EN</a>--}}
{{--                    <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i> قفل صفحه</a>--}}
{{--                    <div class="dropdown-divider"></div>--}}

{{--                    <button class="dropdown-item" onclick=" "><i class="dripicons-exit text-muted"></i> خروج</button>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--        </ul>--}}

{{--        <ul class="list-inline menu-left mb-0">--}}
{{--            <li class="list-inline-item">--}}
{{--                <button type="button" class="button-menu-mobile open-left waves-effect">--}}
{{--                    <i class="mdi mdi-menu"></i>--}}
{{--                </button>--}}
{{--            </li>--}}

{{--        </ul>--}}

{{--    </nav>--}}

{{--</div>--}}



<header class="header-area bg-white mb-4 rounded-bottom-10" id="header-area">
    <div class="row align-items-center">
        <div class="col-lg-4 col-sm-6 col-md-4">
            <div class="left-header-content">
                <ul class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-sm-start">
                    <li>
                        <button class="header-burger-menu bg-transparent p-0 border-0" id="header-burger-menu">
                            <i data-feather="menu"></i>
                        </button>
                    </li>
                    <li>
                        <form class="src-form position-relative">
                            <input type="text" class="form-control" placeholder="جستجو موتور ...">
                            <button type="submit" class="src-btn position-absolute top-50 end-0 translate-middle-y bg-transparent p-0 border-0">
                                <i data-feather="search"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8 col-sm-6 col-md-8">
            <div class="right-header-content mt-2 mt-sm-0">
                <ul class="d-flex align-items-center justify-content-center justify-content-sm-end ps-0 mb-0 list-unstyled">
                    <li class="header-right-item">
                        <div class="dropdown notifications language">
                            <button class="btn btn-secondary border-0 p-0 position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/assets/images/united-states.jpg" class="rounded-circle wh-22" alt="united-states">
                            </button>
                            <div class="dropdown-menu dropdown-lg p-0 border-0 p-4">
                                <div class="notification-menu">
                                    <a href="#" class="dropdown-item p-0">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="/assets/images/united-states.jpg" class="wh-22 rounded-circle" alt="united-states">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h4>English</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="header-right-item">
                        <div class="dropdown notifications noti">
                            <button class="btn btn-secondary border-0 p-0 position-relative @if(\App\Http\Controllers\appChatController::dontSeenMessages(auth()->user()->company->id)->count() > 0) badge @endif " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="bell"></i>
                            </button>
                            <div class="dropdown-menu dropdown-lg p-0 border-0 p-4">
                                <h5 class="m-0 p-0 fw-bold d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                                    <span>اطلاعیه </span>
                                    <button class="p-0 m-0 bg-transparent border-0">حذف همه</button>
                                </h5>

                                <div class="notification-menu mb-0">
                                    <a href="notification.html" class="dropdown-item p-0">
                                        <h4>ایجاد یک پروژه جدید</h4>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="assets/images/notifications-1.jpg" alt="notifications">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p>به کاربران اجازه دهید محصولات موجود در ووکامرس شما را دنبال کنند</p>
                                            </div>
                                        </div>
                                        <span>21 دی 1402</span>
                                    </a>
                                </div>
                                <a href="{{route('admin.messages')}}" class="dropdown-item text-center text-primary d-block view-all pt-3 pb-0 fw-semibold">
                                    مشاهده همه
                                    <i data-feather="chevron-left"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="header-right-item d-none d-md-block">
                        <div class="today-date">
                            <span id="digitalDate"></span>
                            <i data-feather="calendar"></i>
                        </div>
                    </li>
                    <li class="header-right-item">
                        <div class="dropdown admin-profile">
                            <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor" data-bs-toggle="dropdown">
                                <div class="flex-shrink-0">
                                    <img class="rounded-circle wh-54" src="{{auth()->user()->company->company_logo}}" alt="admin">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-none d-xxl-block">
                                            <span class="degeneration">شرکت</span>
                                            <div class="d-flex align-content-center">
                                                <h3>{{auth()->user()->company->company_name}}</h3>
                                                <div class="down">
                                                    <i data-feather="chevron-down"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="dropdown-menu border-0 bg-white w-100 admin-link">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center text-body" href="profile.html">
                                        <i data-feather="user"></i>
                                        <span class="ms-2">پروفایل</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center text-body" href="account.html">
                                        <i data-feather="settings"></i>
                                        <span class="ms-2">تنظیمات</span>
                                    </a>
                                </li>
                                <form action="{{route('logout')}}" method="post" class="d-none" id="fmlogout">
                                    @csrf
                                </form>
                                <li >
                                    <a class="dropdown-item d-flex align-items-center text-body" onclick="$('#fmlogout').submit()">
                                        <i data-feather="log-out"></i>
                                        <span class="ms-2" >خروج</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
