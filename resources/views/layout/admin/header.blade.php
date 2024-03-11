<div class="navbar-custom">
    <ul class="list-unstyled topbar-right-menu float-right mb-0">

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false"
               aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="{{ asset("storage/". \session()->get('user')->avatar ?? "") }}" alt=""
                         class="rounded-circle">
                </span>
                <span>
                    <span class="account-user-name">{{ \session()->get('user')->name }}</span>
                    <span class="account-position">{{ \session()->get('user')->position }}</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">

                <!-- item-->
                <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout mr-1"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>

    </ul>
</div>
