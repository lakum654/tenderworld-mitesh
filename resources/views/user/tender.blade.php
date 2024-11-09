@extends('user.layouts.master')
@section('title','Tenders World - Services')

@section('hero')
    <div class="col-sm-12">
        <img src="{{ asset('public/assets/img/tworld/service-banner.png')}}" width="100%" height="100%" alt="">
    </div>
@endsection

@section('content')
    <section id="events" class="events">
        <div class="container" data-aos="fade-up">
            <h2 class="text-center">Latest 2024 Government eTenders</h2>
            <p class="text-center">Discover latest new tenders offering lucrative opportunities. Stay updated with our real-time listings, ensuring you never miss a chance to bid on valuable contracts in your industry.</p>

            <div class="row">
                @foreach($tenders as $tender)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-primary text-white">
                                <strong>Ref No: {{ $tender->tender_id }}</strong>
                                <span class="float-right">Location: {{ $tender->city }}, {{ $tender->state }}</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $tender->work }}</h5>
                                <p class="card-text">
                                    <strong>Agency / Dept:</strong> {{ $tender->department }}<br>
                                    <strong>Due Date:</strong> {{ \Carbon\Carbon::parse($tender->end_date)->format('M d, Y') }}<br>
                                    <strong>Tender Value:</strong> {{ $tender->tender_value ?? 'Refer Document' }}
                                </p>
                                <a href="{{ route('tender.index', $tender->id) }}" class="btn btn-outline-primary">View Documents</a>
                                {{-- <a href="https://wa.me/?text={{ urlencode('Check out this tender: '.$tender->work) }}" target="_blank" class="btn btn-outline-success"><i class="fa fa-whatsapp"></i></a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
