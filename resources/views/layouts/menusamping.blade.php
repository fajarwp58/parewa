@section('menusamping')
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <i class="ion-md-speedometer"></i>
                        <span>  Dashboard  </span>
                    </a>
                </li>
                 <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion ion-ios-hourglass"></i>
                        <span> Penjualan </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion-md-basket"></i>
                        <span> Pembelian </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion-ios-apps"></i>
                        <span> Stock </span>
                    </a>
                </li>
               
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion-md-copy"></i>
                        <span> Report </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="pages-profile.html">Profile</a></li>
                        <li><a href="pages-timeline.html">Timeline</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
@endsection