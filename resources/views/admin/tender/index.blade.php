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
                <div class="box-tools">
                    <a href="{{ route("$route.create") }}" class="btn btn-theme btn-sm">+ New</a>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Bid No</th>
                                <th>Category Name</th>
                                <th>Details</th>
                                <th>Department</th>
                                <th>Emd Exemption</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Open Date</th>
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
                    name: 'DT_RowIndex',
                    width:'10px'

                },
                {
                    data: 'bid_no',
                    name: 'bid_no',
                    width:'70px'
                },
                {
                    data: 'category.name',
                    name: 'tender_name',
                    width:'70px'
                },
                {
                    data: 'work',
                    name: 'work',
                    width:'300px'
                },
                {
                    data: 'department',
                    name: 'department',
                    width:'150px'
                },
                {
                    data: 'emd_exemption',
                    name: 'emd_exemption',
                    width:'150px'
                },
                {
                    data: 'start_date',
                    name: 'start_date',
                    width:'70px'
                },
                {
                    data: 'end_date',
                    name: 'end_date',
                    width:'70px'
                },
                {
                    data: 'tender_open',
                    name: 'tender_open',
                    width:'70px'
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
