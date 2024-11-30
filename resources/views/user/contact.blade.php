@extends('user.layouts.master')
@section('title','Tenders World - Contact Us')

@section('hero')
    <!-- ======= Hero Section ======= -->
    <div class="col-sm-12">
        <img src="{{ asset('public/assets/img/tworld/contact-banner.jpg')}}" width="100%" height="100%" alt="">
    </div>
    <!-- End Hero -->
@endsection

@section('content')
<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2>Contact</h2>
            <p>Need Help? <span>Contact Us</span></p>
        </div>
{{--
        <div class="mb-3">
            <iframe style="border:0; width: 100%; height: 350px;"
                src="https://maps.google.com/maps?q=607,%20Dev%20Prime,%20Corporate%20Road,%20Makarba,%20Sg%20Highway,%20Ahmedabad,%20Gujarat%C2%A0-%C2%A0380051&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                frameborder="0" allowfullscreen></iframe>
        </div> --}}
        <!-- End Google Maps -->

        <div class="row gy-4">

            <div class="col-md-6">
                <div class="info-item  d-flex align-items-center">
                    <i class="icon bi bi-map flex-shrink-0"></i>
                    <div>
                        <h3>Our Address</h3>
                        <p>C/317,SUMEL BUSINESS PARK-7, NEAR SONI NI CHALI, N.H. ,RAKHIAL,AHMEDABAD, 380023 GUJARAT</p>
                    </div>
                </div>
            </div><!-- End Info Item -->

            <div class="col-md-6">
                <div class="info-item d-flex align-items-center">
                    <i class="icon bi bi-envelope flex-shrink-0"></i>
                    <div>
                        <h3>Email Us</h3>
                        <p><b>uniquesolution317@gmail.com</b></p>
                    </div>
                </div>
            </div><!-- End Info Item -->

            <div class="col-md-6">
                <div class="info-item  d-flex align-items-center">
                    <i class="icon bi bi-telephone flex-shrink-0"></i>
                    <div>
                        <h3>Call Us</h3>
                        <p><b>+91 8866002529</b> & <b>+91 9016209954</b></p>
                    </div>
                </div>
            </div><!-- End Info Item -->

            <div class="col-md-6">
                <div class="info-item  d-flex align-items-center">
                    <i class="icon bi bi-share flex-shrink-0"></i>
                    <div>
                        <h3>Opening Hours</h3>
                        <div><strong>Mon-Sat:</strong> 9AM - 7PM;
                            <strong>Sunday:</strong> Closed
                        </div>
                    </div>
                </div>
            </div><!-- End Info Item -->

        </div>

        <form action="{{ route('contact.store') }}" method="post" class="php-email-form p-3 p-md-4">
            @csrf
            <div class="row">
                <div class="col-xl-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-xl-6 form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="my-3">
                <div class="loading">Loading</div>
                @if(session()->has('error'))
                    <div class="error-message d-block"></div>
                @endif
                @if(session()->has('success'))
                    <div class="sent-message">{{ session()->get('success')}}</div>
                @endif
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
        </form><!--End Contact Form -->

    </div>
</section>
<!-- End Contact Section -->

@endsection
