@extends('master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $moduleName }}
            {{-- <small>it all starts here</small> --}}
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">{{ $moduleName }}</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Update Profile</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                        title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <!-- Profile Update Form -->
                <form action="{{ route($route . '.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="phone">Phone *</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Your Phone" value="{{ old('phone', Helper::settings()->phone) }}">
                                    <span class="error"> {{ $errors->first('phone') }}</span>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="email">Email: *</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Your Email" value="{{ old('email', Helper::settings()->phone) }}">
                                    <span class="error"> {{ $errors->first('email') }}</span>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="profile">Profile Picture:</label>
                                    <input type="file" class="form-control" id="profile" name="profile">
                                    <span class="error"> {{ $errors->first('profile') }}</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{ route($route . '.index') }}" class="btn btn-sm btn-default">Cancel</a>
                        <input type="submit" value="Update Profile" class="btn btn-sm btn-info">
                    </div>
                </form>

                <hr>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
