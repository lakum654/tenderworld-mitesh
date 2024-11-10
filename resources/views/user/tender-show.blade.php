@extends('user.layouts.master')
@section('title', 'Tenders World - Services')

{{-- @section('hero')
    <div class="col-sm-12">
        <img src="{{ asset('public/assets/img/tworld/service-banner.png') }}" width="100%" height="100%" alt="">
    </div>
@endsection --}}

@section('content')
    <section id="events" class="events">
        <div class="container" data-aos="fade-up">

            <!-- Tender Title -->
            <h4 class="my-4">{{ $tender->work }}</h4>
            <p class="mb-4">
                Latest Tender Detail From {{ $tender->department }} For {{ $tender->work }} In {{ $tender->city }},
                {{ $tender->state }}, Reference Number {{ $tender->tender_id }}. Don't Miss Out On This Chance To Be Part Of
                A Significant Project.
            </p>

            <!-- Tender Basic Details -->
            <div class="row mb-4">
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-white">
                            <strong>Tender Basic Details</strong>
                        </div>
                        <div class="card-body">
                            <p><strong>T18 Ref No:</strong> {{ $tender->tender_id }}</p>
                            <p><strong>Tender ID:</strong> {{ $tender->tender_id }}</p>
                            <p><strong>Tender Agency:</strong> {{ $tender->department }}</p>
                            <p><strong>City:</strong> {{ $tender->city }}</p>
                            <p><strong>State:</strong> {{ $tender->state }}</p>
                            <p><strong>Description:</strong> {{ $tender->work }}</p>
                        </div>
                    </div>

                    <!-- Key Values and Dates -->
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-white">
                            <strong>Key Values and Dates</strong>
                        </div>
                        <div class="card-body">
                            <p><strong>Tender Value:</strong> {{ $tender->tender_value ?? 'Refer Document' }}</p>
                            <p><strong>Tender EMD:</strong> {{ $tender->tender_emd ?? 'Refer Document' }}</p>
                            <p><strong>Tender Fee:</strong> {{ $tender->tender_fee ?? 'Refer Document' }}</p>
                            <p><strong>Published Date:</strong>
                                {{ \Carbon\Carbon::parse($tender->start_date)->format('M d, Y') }}</p>
                            <p><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($tender->end_date)->format('M d, Y') }}
                            </p>
                            <p><strong>Tender Opening Date:</strong>
                                {{ \Carbon\Carbon::parse($tender->tender_open)->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <!-- Tender Documents -->
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-white">
                            <strong>Tender Documents</strong>
                        </div>
                        <div class="card-body text-center">
                            <a href="{{ route('front.tender.download', $tender->id) }}" class="btn btn-danger">Download
                                Document</a>
                        </div>
                    </div>

                    <!-- Disclaimer -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <strong>Disclaimer</strong>
                        </div>
                        <div class="card-body">
                            <p>We Take All Possible Care For Accurate & Authentic Tender Information, However Users Are
                                Requested To Refer Original Source Of Tender Notice / Tender Document Published By Tender
                                Issuing Agency Before Taking Any Call Regarding This front.Tender.</p>
                        </div>
                    </div>
                </div>

                <!-- Tender Inquiry Form -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <strong>Tender Inquiry</strong>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('front.tender.inquiry') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" required>
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" required>
                                </div>
                                <button type="submit" class="btn btn-danger w-100">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
