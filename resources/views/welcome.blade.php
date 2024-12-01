@extends('user.layouts.master')

@push('css')
<style>
    .hero-section {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .hero-section .hero-bg {
        width: 100%;
        height: auto;
        object-fit: cover; /* Ensures image fits the container nicely */
        position: relative;
        z-index: 1;
    }

    .search-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        text-align: center;
        padding: 20px;
        background: rgba(255, 255, 255, 0.8); /* Subtle translucent background */
        border-radius: 12px; /* Rounded edges for a modern look */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Add a soft shadow for emphasis */
        max-width: 600px; /* Limit the container width */
        width: 90%; /* Make it responsive */
    }

    .search-container form {
        display: flex;
        gap: 10px; /* Add spacing between input and button */
    }

    .search-container form input {
        flex-grow: 1; /* Allow the input to expand */
        padding: 12px 15px;
        font-size: 18px; /* Slightly larger text for better readability */
        border: 2px solid #ff6f61; /* Coral border */
        border-radius: 8px; /* Rounded corners */
        outline: none;
        transition: border-color 0.3s ease;
    }

    .search-container form input:focus {
        border-color: #e85d54; /* Slightly darker coral on focus */
        box-shadow: 0 0 5px rgba(255, 111, 97, 0.5); /* Subtle glow */
    }

    .search-container form button {
        padding: 12px 20px;
        font-size: 18px;
        font-weight: bold;
        background-color: #ff6f61; /* Coral button background */
        color: #fff;
        border: none;
        border-radius: 8px; /* Rounded corners */
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-container form button:hover {
        background-color: #e85d54; /* Slightly darker coral on hover */
    }
</style>
@endpush

@section('hero')
    <!-- ======= Hero Section ======= -->
    <div class="hero-section position-relative">
        <!-- Background Image -->
        <img src="{{ asset('public/assets/img/tworld/home-banner.jpg') }}" class="hero-bg" alt="Hero Background">

        <!-- Search Box -->
        @if (Route::is('home'))
            <div class="search-container position-absolute top-50 start-50 translate-middle text-center container">
                <form action="{{ route('front.tender.search') }}" method="GET" class="d-flex justify-content-center">
                    <input type="text" name="query" class="form-control me-2" placeholder="Search Your Tender Here">
                    <button type="submit" class="btn btn-danger">Search</button>
                </form>
            </div>
        @endif
    </div>
    <!-- End Hero -->
@endsection


@section('content')
    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4">

                <div class="col-lg-2" data-aos="fade-up" data-aos-delay="100">

                </div><!-- End Why Box -->


                <div class="col-lg-8 d-flex align-items-center">
                    <div class="row gy-4">

                        <div class="section-header">
                            <p>Services <span>You Will Get</span></p>
                        </div>

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-gem"></i>
                                <h4>Gem Registration & Service</h4>
                                <p>Get yuor GeM Portal Profile for any type of government Tenders</p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi-bookmark"></i>
                                <h4>Vender Assessment</h4>
                                <p>Get your Oem Dashboard with your Brand, we will help to to Get Oem Panel</p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi-hammer"></i>
                                <h4>Tenders Biding</h4>
                                <p>Bid your tender with Help of Tenders World, We will Help you to win your Tender</p>
                            </div>
                        </div><!-- End Icon Box -->

                    </div>
                </div>

            </div>

        </div>

        &emsp13;
        <div class="container" data-aos="fade-up">

            <div class="row gy-4">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 d-flex align-items-center">
                    <div class="row gy-4">

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-clipboard-data"></i>
                                <h4>Vendor Registration of any department and portal</h4>
                                <p>Be the Vendor of any government department, We will make your Profile in any Department
                                </p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi-file-earmark"></i>
                                <h4>Tenders information & document checklist</h4>
                                <p>India Secure lot of tenders , we will provide you every tender's Information which is
                                    releted to your Business</p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi-globe"></i>
                                <h4>Web Devlopment</h4>
                                <p>Make your Website within 2-5 day, we will make your Web</p>
                            </div>
                        </div><!-- End Icon Box -->

                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Why Us Section -->
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <p>Certificate <span>You Will Get</span></p>
            </div>

            <div class="slides-1 swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="row gy-4 justify-content-center">
                                <div class="col-lg-6">
                                    <div class="testimonial-content">
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            Make Msme Certificate and Get exmeption From EMD of Tender, You will get Msme
                                            Certificate in 30 minutes.
                                            Just fill Inquiry form or contact on below number. +91 7600607105
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                        <h3>Msme – Udyam adhar certificate</h3>
                                    </div>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <img src="{{ 'public/assets/img/tworld/msme.png' }}" class="img-fluid testimonial-img"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="row gy-4 justify-content-center">
                                <div class="col-lg-6">
                                    <div class="testimonial-content">
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            Did you want to register in startup india skim for your business ?
                                            Startup India registration services offer a holistic solution, guiding
                                            entrepreneurs through the entire process of registering their startup under the
                                            Startup India initiative. These services typically include assistance with
                                            documentation, compliance requirements, government liaisons, and advisory
                                            support, streamlining the registration journey for aspiring startups
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                        <h3>Statup india Registration</h3>
                                    </div>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <img src="{{ 'public/assets/img/tworld/startup.jpg' }}"
                                        class="img-fluid testimonial-img" alt="">
                                </div>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="row gy-4 justify-content-center">
                                <div class="col-lg-6">
                                    <div class="testimonial-content">
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            India actively pursues a multitude of tenders, aligning with its commitment to
                                            stringent ISO standards across various sectors.
                                            We will help you to make it.
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                        <h3>ISO Certificate</h3>
                                    </div>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <img src="{{ 'public/assets/img/tworld/iso.jpg' }}" class="img-fluid testimonial-img"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="row gy-4 justify-content-center">
                                <div class="col-lg-6">
                                    <div class="testimonial-content">
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            if you want bid E tender than you must have DSC class 3. we are providng Dsc
                                            class 3 with Signing and Encryption. Dsc class 3 is valid till 2 year
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                        <h3>DSC Class 3</h3>
                                    </div>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <img src="{{ 'public/assets/img/tworld/certificate.jpg' }}"
                                        class="img-fluid testimonial-img" alt="">
                                </div>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->


    <!-- ======= Our Section ======= -->
    <section id="chefs" class="chefs section-bg">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="chef-member">
                        <div class="member-img">

                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info"><br /><br />
                            <h3>Our Vision</h3> <br />
                            <p style="text-align: left;">
                                <i class="bi bi-check2-all" style="color: red;"></i>
                                At Tendersworld.com, we strive to make things easy. <br />

                                <i class="bi bi-check2-all" style="color: red;"></i>
                                Our vision is to simplify Government Tenders, providing an
                                effortless experience for our clients. <br />

                                <i class="bi bi-check2-all" style="color: red;"></i>
                                We're dedicated to removing complexity and ensuring simplicity in every
                                interaction. <br />

                                <i class="bi bi-check2-all" style="color: red;"></i>
                                It's not just a vision; it's our commitment to making things easy for you.<br />
                            </p>
                        </div>
                    </div>
                </div><!-- End Our Vision Member -->

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="chef-member">
                        <div class="member-img">

                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info"><br /><br />
                            <h3>Our Mission</h3> <br />
                            <p style="text-align: left;">
                                <i class="bi bi-check2-all" style="color: red;"></i>
                                At Tendersworld.com, our mission is to provide quality to Partner. <br />

                                <i class="bi bi-check2-all" style="color: red;"></i>
                                We are dedicated to provide valuable tenders services. <br />

                                <i class="bi bi-check2-all" style="color: red;"></i>
                                The company's mission encapsulates a steadfast commitment to provide best and Reliable
                                services, driving innovation,
                                fostering sustainable growth, and delivering exceptional value to our partner.<br />

                                <i class="bi bi-check2-all" style="color: red;"></i>
                                as we strive to uphold the highest standards of integrity, excellence, and social
                                responsibility in all our endeavors.<br />
                            </p>
                        </div>
                    </div>
                </div><!-- End Missiion Member -->

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="chef-member">
                        <div class="member-img">

                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info"><br /><br />
                            <h3>Why Us ?</h3> <br />
                            <p style="text-align: left;">
                                <i class="bi bi-check2-all" style="color: red;"></i>
                                <font style="color: blue; font-weight: bold;">Expertise:</font> Our team of seasoned
                                professionals brings a wealth of experience in tendering across diverse industries.<br />

                                <i class="bi bi-check2-all" style="color: red;"></i>
                                <font style="color: blue; font-weight: bold;">Tailored Solutions:</font> We understand that
                                each tender is unique. Our services are customized to suit the specific needs and
                                objectives of your business.<br />

                                <i class="bi bi-check2-all" style="color: red;"></i>
                                <font style="color: blue; font-weight: bold;">Result-Driven Approach:</font> We are
                                committed to delivering results. Your success in securing tenders is our primary goal.<br />

                                <i class="bi bi-check2-all" style="color: red;"></i>
                                <font style="color: blue; font-weight: bold;">Compliance Assurance:</font> With a keen eye
                                for detail, we ensure that your proposals are not only competitive but also fully
                                compliant with all tender requirements.<br />
                            </p>
                        </div>
                    </div>
                </div><!-- End Why Us Member -->

            </div>

        </div>
    </section>
    <!-- End Our Section -->
@endsection
