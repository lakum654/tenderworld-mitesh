@extends('user.layouts.master')
@section('title','Tenders World - Certificates')

@section('hero')
    <!-- ======= Hero Section ======= -->

    <div class="col-sm-12">
        <img src="{{ asset('public/assets/img/tworld/service-banner.png') }}" width="100%" height="100%" alt="">
    </div>
    <!-- End Hero -->
@endsection

@section('content')
    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <p><span>Certificates</span></p>
            </div>

            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">

                <li class="nav-item">
                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-msme">
                        <h4>Msme Certificate</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-iso">
                        <h4>ISO Certificate</h4>
                    </a><!-- End tab nav item -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-sir">
                        <h4>Startup india registratio</h4>
                    </a>
                </li><!-- End tab nav item -->

            </ul>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

                <div class="tab-pane fade active show" id="menu-msme">
                    <br /><br />

                    <div class="row gy-5">

                        <div class="col-lg-4 menu-item">
                            <img src="{{ asset('public/assets/img/tworld/msme.png') }}" class="menu-img img-fluid"
                                alt="">
                        </div>
                        <div class="col-lg-8">
                            <br />
                            <h3>Msme Certificate</h3>
                            <p>
                                <i class="bi bi-check2-all" style="color: red;"></i> You will get Msmecertificate in 10
                                minutes.<br />
                                <i class="bi bi-check2-all" style="color: red;"></i> Just fill form or contact from Contact
                                Us.
                            </p>
                        </div><!-- Menu Item -->
                    </div>
                </div>



                <div class="tab-pane fade" id="menu-iso">

                    <br /><br />

                    <div class="row gy-5">

                        <div class="col-lg-4 menu-item">
                            <img src="{{ asset('public/assets/img/tworld/iso.jpg') }}" class="menu-img img-fluid"
                                alt="">
                        </div>
                        <div class="col-lg-8">
                            <br />
                            <h3>ISO Certificate</h3>
                            <p>
                                <i class="bi bi-check2-all" style="color: red;"></i> Did you want to make ISO Certificate
                                for your business standerd ?<br />
                                <i class="bi bi-check2-all" style="color: red;"></i> We will help you to make it.<br />
                                <i class="bi bi-check2-all" style="color: red;"></i> India actively pursues a multitude of
                                tenders, aligning with its commitment to stringent ISO standards across various
                                sectors.<br />
                            </p>
                        </div><!-- Menu Item -->
                    </div>
                </div><!-- End Breakfast Menu Content -->

                <div class="tab-pane fade" id="menu-sir">

                    <br /><br />

                    <div class="row gy-5">

                        <div class="col-lg-4 menu-item">
                            <img src="{{ asset('public/assets/img/tworld/startup.jpg') }}" class="menu-img img-fluid"
                                alt="">
                        </div>
                        <div class="col-lg-8">
                            <br />
                            <h3>Startup india registration</h3>
                            <p>
                                <i class="bi bi-check2-all" style="color: red;"></i> Did you want to register in startup
                                india skim for your business ? <br />
                                <i class="bi bi-check2-all" style="color: red;"></i> Startup India registration services
                                offer a holistic solution, guiding entrepreneurs through the entire process of
                                registering their startup under the Startup India initiative. These services typically
                                include assistance with
                                documentation, compliance requirements, government liaisons, and advisory support,
                                streamlining the registration journey
                                for aspiring startups.
                                sectors.<br />
                            </p>
                        </div><!-- Menu Item -->
                    </div>
                </div><!-- End Breakfast Menu Content -->

                <div class="tab-pane fade" id="menu-dinner">

                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>Dinner</h3>
                    </div>

                    <div class="row gy-5">

                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset('public/assets/img/menu/menu-item-1.png') }}" class="glightbox"><img
                                    src="{{ asset('public/assets/img/menu/menu-item-1.png') }}" class="menu-img img-fluid"
                                    alt=""></a>
                            <h4>Magnam Tiste</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $5.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset('public/assets/img/menu/menu-item-2.png') }}" class="glightbox"><img
                                    src="{{ asset('public/assets/img/menu/menu-item-2.png') }}" class="menu-img img-fluid"
                                    alt=""></a>
                            <h4>Aut Luia</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $14.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset('public/assets/img/menu/menu-item-3.png') }}" class="glightbox"><img
                                    src="{{ asset('public/assets/img/menu/menu-item-3.png') }}" class="menu-img img-fluid"
                                    alt=""></a>
                            <h4>Est Eligendi</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $8.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset('public/assets/img/menu/menu-item-4.png') }}" class="glightbox"><img
                                    src="{{ asset('public/assets/img/menu/menu-item-4.png') }}" class="menu-img img-fluid"
                                    alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset('public/assets/img/menu/menu-item-5.png') }}" class="glightbox"><img
                                    src="{{ asset('public/assets/img/menu/menu-item-5.png') }}"
                                    class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset('public/assets/img/menu/menu-item-6.png') }}" class="glightbox"><img
                                    src="{{ asset('public/assets/img/menu/menu-item-6.png') }}"
                                    class="menu-img img-fluid" alt=""></a>
                            <h4>Laboriosam Direva</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $9.95
                            </p>
                        </div><!-- Menu Item -->

                    </div>
                </div><!-- End Dinner Menu Content -->

            </div>

        </div>
    </section>
    <!-- End Menu Section -->
@endsection
