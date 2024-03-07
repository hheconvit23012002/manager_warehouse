<div class="left-side-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="assets/images/logo.png" alt="" height="16">
                    </span>
        <span class="logo-sm">
                        <img src="assets/images/logo_sm.png" alt="" height="16">
                    </span>
    </a>

    <div class="h-100" id="left-side-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">


            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Manager </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route("admin.web.staff.index") }}">Staff</a>
                    </li>
                    <li>
                        <a href="{{ route("admin.web.center.index") }}">Center</a>
                    </li>
                    <li>
                        <a href="{{ route("admin.web.center.index") }}">Center</a>
                    </li>
                </ul>
            </li>


        </ul>

        <!-- Help Box -->
        <!-- end Help Box -->
        <!-- End Sidebar -->

    </div>
    <!-- Sidebar -left -->

</div>
