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
            <li><a href="#" active>{{ $moduleName }}</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $moduleName }}</h3>
                {{-- <div class="box-tools">
                    <a href="{{ route("$route.create") }}" class="btn btn-theme btn-sm">+ New</a>
                </div> --}}
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Tender</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
            {{-- <div class="box-footer">

            </div> --}}
            <!-- /.box-footer-->
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script>
        var table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route("$route.data") }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'tender.tender_id',
                    name: 'tender_id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'company_name',
                    name: 'company_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    </script>
@endsection
