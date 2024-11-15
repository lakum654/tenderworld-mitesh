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
            <li><a href="#" active>Add</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create New {{ $moduleName }}</h3>

                <div class="box-tools pull-right">


                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                        title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                <form action="{{ route("$route.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf()
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="file">*Import Tender File (.xlsx,.xls):</label>
                                    <input type="file" class="form-control" id="file" name="file">
                                    <a href="{{ asset('public/tender/tender-sampless.xlsx') }}">Download Sample</a>
                                    <span class="error"> {{ $errors->first('file') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{ route("$route.index") }}" class="btn btn-sm btn-default">Cancel</a>
                        <input type="submit" value="Submit" class="btn btn-sm btn-info">
                    </div>
                </form>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
