<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="google-site-verification" content="04b9i8gOjrRX7zMeAMk8SWcWS7p5HlPPkEXNkWBoudM" />
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'UniqueTenders')</title>
    <meta content="Uniqe Tenders,Tender World Service" name="description">
    <meta content="Uniqe Tenders,Tender,World,Gujarat,Services" name="keywords">

    @include('user.layouts.headerscript')
    @stack('css')

    <style>
        .theme-bg-color {
            background: #ce1212 !important;
        }
        .theme-btn-color {
            background: #ce1212 !important;
            color:#fff;
        }

        .theme-btn-color:hover {
            color:#fff;
        }
    </style>
</head>

<body>

    @include('user.layouts.header')
    <!-- ======= Hero Section ======= -->

    @yield('hero')

    <!-- End Hero -->

    <main id="main">
        @yield('content')
    </main>
    <!-- ======= Footer ======= -->
    @include('user.layouts.footer')
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    @include('user.register')
    @include('user.login')
    @include('user.layouts.footerscript')



    <script>
        function openLoginModal() {
            $('#registrationModal').modal('hide');
            $('#loginModal').modal('show');
        }

        function openRegisterModal() {
            $('#loginModal').modal('hide');
            $('#registrationModal').modal('show');
        }

        // Keep the modals open if there are validation errors
        @if ($errors->any() && session('error_type') === 'login')
            $(document).ready(function() {
                $('#loginModal').modal('show');
            });
        @elseif ($errors->any() && session('error_type') === 'register')
            $(document).ready(function() {
                $('#registrationModal').modal('show');
            });
        @endif
    </script>
    @stack('scripts')

</body>

</html>
