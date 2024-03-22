<div class="left-side-menu">

    @php

        use App\Models\Order;use App\Models\Staff;use Illuminate\Support\Facades\Auth;
        $userLogin = Auth::user();
        $queryRequest = Order::query()->where('status', Order::STATUS_PENDING);
        if(!is_null($userLogin->center_id)){
            $queryRequest = $queryRequest->where('seller_id', $userLogin->center_id);
        }
        $numberRequest = $queryRequest->count('id');
        $superAdmin = [
            [
                'name' => 'Staff',
                'route' => 'admin.web.staff.index',
            ],
            [
                'name' => 'Center',
                'route' => 'admin.web.center.index',
            ],
        ];
        $warehouse = [
            [
                'name' => 'Product',
                'route' => 'admin.web.product.index',
            ],
            [
                'name' => 'Request' . ($numberRequest > 0 ?' ('.$numberRequest.') ' : ''),
                'route' => 'admin.web.request.index',
            ],
            [
                'name' => 'Add Number',
                'route' => 'admin.web.product.history',
            ],
        ]
    @endphp
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
                    <span> Manager </span>
                    <i class="fa-solid fa-chevron-down"></i>

                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    @if($userLogin->position === Staff::POSITION_SUPPER_ADMIN)
                        @foreach($superAdmin as $nav)
                            <li>
                                <a href="{{ route($nav['route']) }}">{{ $nav['name'] }}</a>
                            </li>
                        @endforeach
                    @endif
                    @foreach($warehouse as $nav)
                        <li>
                            <a href="{{ route($nav['route']) }}">{{ $nav['name'] }}</a>
                        </li>
                    @endforeach

                </ul>
            </li>
        </ul>

        <!-- Help Box -->
        <!-- end Help Box -->
        <!-- End Sidebar -->

    </div>
    <!-- Sidebar -left -->

</div>
