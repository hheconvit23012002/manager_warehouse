<nav class="navbar navbar-expand-lg bg-white fixed-top" color-on-scroll="500">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="http://demos.creative-tim.com/now-ui-kit-pro/presentation.html" rel="tooltip" title="" data-placement="bottom" target="_blank" data-original-title="Designed by Invision. Coded by Creative Tim">
                Now Ui Kit Pro
            </a>
        </div>
        <div class="collapse navbar-collapse" data-nav-image="../assets/img/blurred-image-1.jpg" data-color="orange">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">
                        <i class="fa-solid fa-gear"></i>
                        <p>Setting</p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn btn-primary header_cart" onclick="checkout({{ $centerId }})" >
                        <p>Buy Now</p>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>
