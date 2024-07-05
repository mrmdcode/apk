
<div id="sidebar-menu">
    <ul>
        <li class="menu-title">اصلی</li>

        <li>
            <a href="{{route("admin.dashboard")}}" class="waves-effect">
                <i class="dripicons-home"></i>
                <span> داشبورد </span>
            </a>
        </li>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="ion ion-md-person "></i> <span> کاربران</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li><a href="{{route('admin.companyManager')}}"><i class="ion ion-md-podium"></i> مدیریت شرکت ها</a></li>
                <li><a href="{{route('admin.companyCreate')}}"><i class="ion ion-md-person-add"></i> افزودن شرکت </a></li>

            </ul>
        </li>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="ion ion-md-person "></i> <span> موتور ها </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li><a href="{{route('admin.motorManager')}}"><i class="ion ion-md-podium"></i> مدیریت موتور ها</a></li>
                <li><a href="{{route('admin.motorCreate')}}"><i class="ion ion-md-person-add"></i> افزودن موتور </a></li>

            </ul>
        </li>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-archive"></i> <span> دیتا </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li><a href="{{route('admin.motorData')}}">دیتا ها</a></li>
                <li><a href="{{route('admin.motorError')}}">هشدار ها </a></li>
            </ul>
        </li>


        <li>
            <a href="{{route('admin.messages')}}" class="waves-effect">
                <i class="dripicons-home"></i>
                <span> پیام ها </span>
            </a>
        </li>
    </ul>
</div>
