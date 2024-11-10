<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="{{ 'public/assets/img/logo.png' }}" alt=""> -->
            <img src="{{ asset('public/assets/img/tworld/logo-remove-bg.png') }}">
            <h1><span style="color: blue;">Tenders</span>&nbsp;<span>World</span></h1>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('gem-registration') }}">Gem Registration</a></li>
                <li><a href="{{ route('front.tender') }}">Tender Services</a></li>
                <li><a href="{{ route('certificate') }}">Certificate</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                @if (!Auth::check())
                    <li><a href="javascript:void(0);" onclick="openLoginModal()">Login</a></li>
                    <li><a href="javascript:void(0);" onclick="openRegisterModal()">Register</a></li>
                @else
                    <!-- Logout link with a hidden form for security -->
                    <li>
                        <a href="javascript:void(0);"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('front.auth.logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                @endif

            </ul>
        </nav><!-- .navbar -->
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header>
<!-- End Header -->
<br><br>
