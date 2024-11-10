<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="{{route('home')}}" class="logo d-flex align-items-center me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="{{ 'public/assets/img/logo.png' }}" alt=""> -->
            <img src="{{ asset('public/assets/img/tworld/logo-remove-bg.png')}}">
            <h1><span style="color: blue;">Tenders</span>&nbsp;<span>World</span></h1>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('gem-registration')}}">Gem Registration</a></li>
                <li><a href="{{ route('front.tender') }}">Tender Services</a></li>
                <li><a href="{{ route('certificate')}}">Certificate</a></li>
                <li><a href="{{ route('contact')}}">Contact Us</a></li>
                <li><a href="{{ route('about')}}">About Us</a></li>
                <li><a href="{{ route('home') }}">+91 7600607216</a></li>
            </ul>
        </nav><!-- .navbar -->
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header>
<!-- End Header -->
<br><br>
