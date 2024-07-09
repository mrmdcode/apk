
{{--<div id="sidebar-menu">--}}
{{--    <ul>--}}
{{--        <li class="menu-title">اصلی</li>--}}

{{--        <li>--}}
{{--            <a href="{{route("admin.dashboard")}}" class="waves-effect">--}}
{{--                <i class="dripicons-home"></i>--}}
{{--                <span> داشبورد </span>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        <li class="has_sub">--}}
{{--            <a href="javascript:void(0);" class="waves-effect"><i class="ion ion-md-person "></i> <span> کاربران</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>--}}
{{--            <ul class="list-unstyled">--}}
{{--                <li><a href="{{route('admin.companyManager')}}"><i class="ion ion-md-podium"></i> مدیریت شرکت ها</a></li>--}}
{{--                <li><a href="{{route('admin.companyCreate')}}"><i class="ion ion-md-person-add"></i> افزودن شرکت </a></li>--}}

{{--            </ul>--}}
{{--        </li>--}}

{{--        <li class="has_sub">--}}
{{--            <a href="javascript:void(0);" class="waves-effect"><i class="ion ion-md-person "></i> <span> موتور ها </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>--}}
{{--            <ul class="list-unstyled">--}}
{{--                <li><a href="{{route('admin.motorManager')}}"><i class="ion ion-md-podium"></i> مدیریت موتور ها</a></li>--}}
{{--                <li><a href="{{route('admin.motorCreate')}}"><i class="ion ion-md-person-add"></i> افزودن موتور </a></li>--}}

{{--            </ul>--}}
{{--        </li>--}}

{{--        <li class="has_sub">--}}
{{--            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-archive"></i> <span> دیتا </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>--}}
{{--            <ul class="list-unstyled">--}}
{{--                <li><a href="{{route('admin.motorData')}}">دیتا ها</a></li>--}}
{{--                <li><a href="{{route('admin.motorError')}}">هشدار ها </a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}


{{--        <li>--}}
{{--            <a href="{{route('admin.messages')}}" class="waves-effect">--}}
{{--                <i class="dripicons-home"></i>--}}
{{--                <span> پیام ها </span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</div>--}}



<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="index.html" class="d-block text-decoration-none">
            <img src="{{asset('img/logo.png')}}" alt="logo-icon">
        </a>
        <button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>
    <aside id="layout-menu" class="layout-menu menu-vertical menu " data-simplebar>
        <ul class="menu-inner">
            <li class="menu-item open">
                <a href="{{route('admin.dashboard')}}" class="menu-link @if(Route::current()->getName() == 'admin.dashboard') active @endif">
                    داشبورد
                </a>
            </li>
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">برنامه ها</span>
            </li>
            <li class="menu-item @if(Route::current()->getName() == 'admin.companyManager' || Route::current()->getName() == 'admin.companyCreate' ) open  @endif ">
                <a href="javascript:void(0);" class="menu-link menu-toggle  @if(Route::current()->getName() == 'admin.companyManager' || Route::current()->getName() == 'admin.companyCreate' ) active  @endif">
                    <i data-feather="folder-minus" class="menu-icon tf-icons"></i>
                    <span class="title"> شرکت ها</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{route('admin.companyManager')}}" class="menu-link @if(Route::current()->getName() == 'admin.companyManager' ) active @endif">
                            مدیریت شرکت ها
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('admin.companyCreate')}}" class="menu-link" @if(Route::current()->getName() == 'admin.companyCreate' ) active @endif>
                           افزودن شرکت
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item @if(Route::current()->getName() == 'admin.motorManager' || Route::current()->getName() == 'admin.motorCreate' ) open  @endif ">
                <a href="javascript:void(0);" class="menu-link menu-toggle  @if(Route::current()->getName() == 'admin.motorManager' || Route::current()->getName() == 'admin.motorCreate' ) active  @endif">
                    <i data-feather="folder-minus" class="menu-icon tf-icons"></i>
                    <span class="title"> موتور ها</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{route('admin.motorManager')}}" class="menu-link @if(Route::current()->getName() == 'admin.motorManager' ) active @endif">
                            مدیریت موتور ها
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('admin.motorCreate')}}" class="menu-link" @if(Route::current()->getName() == 'admin.motorCreate' ) active @endif>
                            افزودن
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">دیتا ها</span>
            </li>
            <li class="menu-item @if(Route::current()->getName() == 'admin.motorData' || Route::current()->getName() == 'admin.motorError' ) open  @endif ">
                <a href="javascript:void(0);" class="menu-link menu-toggle  @if(Route::current()->getName() == 'admin.motorData' || Route::current()->getName() == 'admin.motorError' ) active  @endif">
                    <i data-feather="folder-minus" class="menu-icon tf-icons"></i>
                    <span class="title">هشدار ها</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{route('admin.motorData')}}" class="menu-link @if(Route::current()->getName() == 'admin.motorData' ) active @endif">
                            تمامی هشدار ها
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('admin.motorError')}}" class="menu-link" @if(Route::current()->getName() == 'admin.motorError' ) active @endif>
                            مانیتور هشدار ها
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </aside>
    <div class="bg-white z-1 admin">
        <div class="d-flex align-items-center admin-info border-top">
            <div class="flex-shrink-0">
                <a href="profile.html" class="d-block">
                    <img src="assets/images/admin.jpg" class="rounded-circle wh-54" alt="admin">
                </a>
            </div>
            <div class="flex-grow-1 ms-3 info">
                <a href="profile.html" class="d-block name">جان اسمیت</a>
                <a href="logout.html">خروج</a>
            </div>
        </div>
    </div>
