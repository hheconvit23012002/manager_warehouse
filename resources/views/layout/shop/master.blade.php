<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
{{--    <title>{{ config('app.name') }}</title>--}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

{{--    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css">--}}
    <link href="{{ asset('css/shop/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/shop/now-ui-kit.css_v=1.1.0.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('css')
</head>

<body class="ecommerce-page" style="color: black!important">
<!-- Begin page -->
<div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
{{--    @include('layout.shop.sidebar')--}}
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-page">
            <!-- Topbar Start -->
            @include('layout.shop.header')
            <!-- end Topbar -->

            <!-- Start Content-->
            <div class="container" >
                @yield('content')
            </div>
            <!-- container -->
        <!-- content -->

        <!-- Footer Start -->
        @include('layout.shop.footer')
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>

<!-- END wrapper -->

<!-- Right Sidebar -->
@include('layout.shop.sidebar')
<!-- /Right-bar -->

<!-- bundle -->
<script src="{{ asset('js/shop/popper.min.js') }}"></script>
<script src="{{ asset('js/shop/main.js') }}"></script>
<script src="{{ asset('js/jquery.toast.min.js') }}"></script>
<script src="{{ asset('js/shop/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/shop/jasny-bootstrap.min.js') }}"></script>
{{--<script src="{{ asset('js/shop/now-ui-kit.js_v=1.1.0') }}"></script>--}}

{{--<script src="{{ asset('js/hyper.js') }}"></script>--}}
{{--<script src="{{ asset('js/layout.js') }}"></script>--}}
{{--<script src="{{ asset('js/moment.js') }}"></script>--}}

<script src="https://kit.fontawesome.com/89d8fa102b.js" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('js/api.js') }}"></script>

@include('common.notification')

@stack('js')
<!-- end demo js-->
</body>
</html>
