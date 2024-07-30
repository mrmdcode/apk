

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
                <a href="{{route('company.dashboard')}}" class="menu-link @if(Route::current()->getName() == 'company.dashboard') active @endif">
                    داشبورد
                </a>
            </li>
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">برنامه ها</span>
            </li>
            <li class="menu-item @if(Route::current()->getName() == 'company.motorManager' || Route::current()->getName() == 'company.motorCreate' ) open  @endif ">
                <a href="javascript:void(0);" class="menu-link menu-toggle  @if(Route::current()->getName() == 'company.motorManager' || Route::current()->getName() == 'company.motorCreate' ) active  @endif">
                    <i data-feather="folder-minus" class="menu-icon tf-icons"></i>
                    <span class="title"> موتور ها</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{route('company.motorManager')}}" class="menu-link @if(Route::current()->getName() == 'company.motorManager' ) active @endif">
                            مدیریت موتور ها
                        </a>
                    </li>

                </ul>
            </li>
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">دیتا ها</span>
            </li>
            <li class="menu-item @if(Route::current()->getName() == 'company.motorData' || Route::current()->getName() == 'company.motorError' ) open  @endif ">
                <a href="javascript:void(0);" class="menu-link menu-toggle  @if(Route::current()->getName() == 'company.motorData' || Route::current()->getName() == 'company.motorError' ) active  @endif">
                    <i data-feather="folder-minus" class="menu-icon tf-icons"></i>
                    <span class="title">هشدار ها</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{route('company.motorData')}}" class="menu-link @if(Route::current()->getName() == 'company.motorData' ) active @endif">
                            تمامی هشدار ها
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('company.motorError')}}" class="menu-link" @if(Route::current()->getName() == 'company.motorError' ) active @endif>
                            مانیتور هشدار ها
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </aside>
    <div class="bg-white z-1 company">
        <div class="d-flex align-items-center company-info border-top">
            <div class="flex-shrink-0">
                <a href="{{route('company.dashboard')}}" class="d-block">
                    <img src="{{auth()->user()->company->company_logo}}" class="rounded-circle wh-54" alt="admin">
                </a>
            </div>
            <div class="flex-grow-1 ms-3 info">
                <a href="{{route('company.dashboard')}}" class="d-block name">{{auth()->user()->company->company_name}}</a>
                <form class="d-none" id="f-logout" action="{{route('logout')}}" method="post">
                    @csrf
                </form>
                <a onclick="$('#f-logout').submit()">خروج</a>
            </div>
        </div>
    </div>
</div>
