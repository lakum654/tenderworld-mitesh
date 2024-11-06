@extends('user.layouts.master')
@section('title','Tenders World - About Us')

@section('hero')
    <!-- ======= Hero Section ======= -->

    <div class="col-sm-12">
        <img class="abc" src="{{ asset('public/assets/img/tworld/about-banner.jpg')}}" width="100%" height="100%" alt="">
    </div>
    <!-- End Hero -->
@endsection

@section('content')
<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2>About Us</h2>
            <p>Learn More <span>About Us</span></p>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <img src="{{ asset('public/assets/img/tworld/about.jpg') }}" width="100%"><br/><br/>
                <img src="{{ asset('public/assets/img/tworld/about-2.jpg') }}" width="100%">
            </div>
            <div class="col-sm-6">
                <br/>
                <h4><center>Welcome to Tendersworld.com</center></h4><br/>

                <h5>Team Tendersworld.com</h5><br/>
                <p>
                    &emsp;<i class="bi bi-check2-all" style="color: red;"></i> Meet the passionate individuals who drive Tendersworld forward. <br/>
                    &emsp;<i class="bi bi-check2-all" style="color: red;"></i> Our team is a blend of understand all type of governement tenders and    dedicated to eveluate your tenders.<br/>
                </p>
                <br/>

                <h5>Our Approach</h5><br />
                <p>
                    &emsp;<i class="bi bi-check2-all" style="color: red;"></i> Tendersworld is looking forward to tendering you. <br />
                    &emsp;<i class="bi bi-check2-all" style="color: red;"></i> At Tendersworld, our approach is grounded in a commitment to grow business in governement.<br />
                    &emsp;<i class="bi bi-check2-all" style="color: red;"></i> We believe that government tenders is the key to achieving to great business from indian government.<br/>
                    &emsp;<i class="bi bi-check2-all" style="color: red;"></i> Here's how we approach Tender's service.<br/><br/>

                    <b>&emsp;<i class="bi bi-check2-all" style="color: red;"></i> Empowering our clients is a key objective.</b><br/>
                    <b>&emsp;<i class="bi bi-check2-all" style="color: red;"></i> We not only provide solutions but also knowledge transfer and training, ensuring that our clients are equipped for
                    sustained success.</b><br /><br/>

                    &emsp;<i class="bi bi-check2-all" style="color: red;"></i> After getting your order Tendersworld will allow you one technical person who will assisst you to win your Tenders.<br/>

                    &emsp;<i class="bi bi-check2-all" style="color: red;"></i> Have questions or want to learn more? Please Fill out contact Form.<br/>
                    &emsp;<i class="bi bi-check2-all" style="color: red;"></i> Thank you for considering Tendersworld.com as your Tender partner. We look forward to achieving Tenders with you.
                </p>
                <br/>
                <br/>
                &emsp;
                <a href="{{route('contact')}}" type="button" style="
                color: white;
                background-color: red;
                border: none;
                border-radius: 20px;
                padding: 10px;
                width: 100%;
                text-align: center;
                ">Contact Us</a>
            </div>
        </div>

    </div>
</section>
<!-- End About Section -->

@endsection
