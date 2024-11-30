@extends('user.layouts.master')
@section('title','Unique Tenders - Services')

@section('hero')
    <!-- ======= Hero Section ======= -->

    <div class="col-sm-12">
        <img src="{{ asset('public/assets/img/tworld/service-banner.png')}}" width="100%" height="100%" alt="">
    </div>
    <!-- End Hero -->
@endsection

@section('content')

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>TENDERS SERVICES</h2>
                <p style="font-size: 30px;">Unique Tenders - <span>Unlocking Opportunities through Exceptional Tender Services</span></p>
            </div>

            <div class="row gy-4">

                <div class="col-lg-12 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
                    <div class="content ps-0 ps-lg-5">
                        <ul style="font-size: 20px;">
                            <li><i class="bi bi-check2-all"></i> Welcome to Tendersworld.com, your trusted partner in navigating the competitive landscape of tenders. We specialize in
                            delivering comprehensive tender services that empower businesses to secure and excel in procurement opportunities.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->


    <!-- ======= Events Section ======= -->
    <section id="events" class="events">
        <div class="container-fluid" data-aos="fade-up">

            <div class="section-header">
                <h2>Services</h2>
                <p>Our <span>Services</span></p>
            </div>

            <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">

                    <div class="swiper-slide event-item d-flex flex-column justify-content-end"
                        style="background-image: url(public/assets/img/tworld/analysis.png)">
                        <h3>Tender Identification and Analysis</h3>
                        <p class="description">
                            Stay ahead of the competition with our meticulous identification and analysis of relevant tenders in your industry.
                        </p>
                    </div><!-- End Event item -->

                    <div class="swiper-slide event-item d-flex flex-column justify-content-end"
                        style="background-image: url(public/assets/img/tworld/proposal-development.png)">
                        <h3>Proposal Development</h3>
                        <p class="description">
                            Leverage our expertise to craft compelling and competitive proposals that showcase your strengths and meet the
                            requirements of potential clients.
                        </p>
                    </div><!-- End Event item -->

                    <div class="swiper-slide event-item d-flex flex-column justify-content-end"
                        style="background-image: url(public/assets/img/tworld/bid-managemenht.jpg)">
                        <h3>Bid Management</h3>
                        <p class="description">
                            Seamlessly manage the entire bid process with our end-to-end bid management services, ensuring compliance and timely
                            submission.
                        </p>
                    </div><!-- End Event item -->

                    <div class="swiper-slide event-item d-flex flex-column justify-content-end"
                        style="background-image: url(public/assets/img/tworld/strategic-planning.jpg)">
                        <h3>Strategic Consulting</h3>
                        <p class="description">
                            Benefit from our strategic insights and guidance to enhance your tendering strategy, maximize success rates, and
                            optimize your overall procurement approach.
                        </p>
                    </div><!-- End Event item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>
    <!-- End Events Section -->

@endsection
