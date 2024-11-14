@extends('master')


@section('content')
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box">
                    <div class="inner">
                        <h3>{{$usersCount}}</h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box">
                    <div class="inner">
                        <h3>{{$tendersCount}}<sup style="font-size: 20px"></sup></h3>

                        <p>Tenders</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box">
                    <div class="inner">
                        <h3>{{$contactCount}}</h3>

                        <p>Contacts</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-video-camera" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-xs-6">
                <div class="small-box">
                    <div class="inner">
                        <h3>$650000</h3>

                        <p>Total Revenue</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div> --}}
        </div>
    </section>
@endsection

@section('script')
@endsection
