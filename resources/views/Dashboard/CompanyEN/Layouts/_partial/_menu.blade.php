

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
                <a href="{{route('company.dashboard.en')}}" class="menu-link @if(Route::current()->getName() == 'company.dashboard.en') active @endif">
                    Dashboard
                </a>
            </li>
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">Prop</span>
            </li>
            <li class="menu-item @if(Route::current()->getName() == 'company.motorManager.en' || Route::current()->getName() == 'company.motorCreate.en' ) open  @endif ">
                <a href="javascript:void(0);" class="menu-link menu-toggle  @if(Route::current()->getName() == 'company.motorManager.en' || Route::current()->getName() == 'company.motorCreate.en' ) active  @endif">
                    <i data-feather="folder-minus" class="menu-icon tf-icons"></i>
                    <span class="title">Motors</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{route('company.motorManager.en')}}" class="menu-link @if(Route::current()->getName() == 'company.motorManager.en' ) active @endif">
                            Motor Manager
                        </a>
                    </li>

                </ul>
            </li>
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">دیتا ها</span>
            </li>
            <li class="menu-item @if(Route::current()->getName() == 'company.motorData.en' || Route::current()->getName() == 'company.motorError.en' ) open  @endif ">
                <a href="javascript:void(0);" class="menu-link menu-toggle  @if(Route::current()->getName() == 'company.motorData.en' || Route::current()->getName() == 'company.motorError.en' ) active  @endif">
                    <i data-feather="folder-minus" class="menu-icon tf-icons"></i>
                    <span class="title">Warnings</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{route('company.motorData.en')}}" class="menu-link @if(Route::current()->getName() == 'company.motorData.en' ) active @endif">
                            All of Warnings
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('company.motorError.en')}}" class="menu-link" @if(Route::current()->getName() == 'company.motorError.en' ) active @endif>
                            Warning Monitor
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </aside>
    <div class="bg-white z-1 company">
        <div class="d-flex align-items-center company-info border-top">
            <div class="flex-shrink-0">
                <a href="profile.html" class="d-block">
                    <img src="{{auth()->user()->company->company_logo}}" class="rounded-circle wh-54" alt="admin">
                </a>
            </div>
            <div class="flex-grow-1 ms-3 info">
                <a href="{{route('company.dashboard.en')}}" class="d-block name">{{auth()->user()->company->company_name}}</a>
                <form class="d-none" id="f-logout" action="{{route('logout')}}" method="post">
                    @csrf
                </form>
                <a onclick="$('#f-logout').submit()">خروج</a>
            </div>
        </div>
    </div>
</div>
