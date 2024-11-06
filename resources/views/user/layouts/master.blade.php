<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="google-site-verification" content="04b9i8gOjrRX7zMeAMk8SWcWS7p5HlPPkEXNkWBoudM" />
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title','Tenders World - Home')</title>
    <meta content="Tender World Service" name="description">
    <meta content="Tender,World,Gujarat,Services" name="keywords">

    @include('user.layouts.headerscript')
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

    @include('user.layouts.footerscript')

</body>

</html>
