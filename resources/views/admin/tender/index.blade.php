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
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm hidden" id="delete_all_btn"><i
                            class="fa fa-trash"> </i> Delete</a>
                    <a href="{{ route("$route.create") }}" class="btn btn-theme btn-sm">+ New</a>
                </div>
            </div>


            <div class="box-body">
                <div class="card-body shadow">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label for="start_date">Start Date <span class="requride_cls">*</span>
                                </label>
                                <input type="text" id="start_date" name="start_date" class="form-control"
                                    placeholder="Start Date" readonly>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label for="end_date">End Date <span class="requride_cls">*</span>
                                </label>
                                <input type="text" id="end_date" name="end_date" class="form-control"
                                    placeholder="Enter End Date" readonly>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:3%">
                                <button type="submit" class="btn btn-success searchData btn-sm">Apply Filters</button>
                                <button class="btn btn-danger searchClear btn-sm" data-toggle="collapse"
                                    data-target="#filterBody">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered datatable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" id="select_all" class="form-check-input" />
                                    </div>
                                </th>
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
            ajax: {
                url: "{{ route('tender.data') }}",
                type: "GET",
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    width: '10px'

                },
                {
                    data: 'bid_no',
                    name: 'bid_no',
                    width: '70px'
                },
                {
                    data: 'category.name',
                    name: 'tender_name',
                    width: '70px'
                },
                {
                    data: 'work',
                    name: 'work',
                    width: '300px'
                },
                {
                    data: 'department',
                    name: 'department',
                    width: '150px'
                },
                {
                    data: 'emd_exemption',
                    name: 'emd_exemption',
                    width: '150px'
                },
                {
                    data: 'start_date',
                    name: 'start_date',
                    width: '70px'
                },
                {
                    data: 'end_date',
                    name: 'end_date',
                    width: '70px'
                },
                {
                    data: 'tender_open',
                    name: 'tender_open',
                    width: '70px'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });


        $('.searchData').on('click', function(e) {
            e.preventDefault();
            table.draw();
        });

        $('.searchClear').on('click', function(e) {
            e.preventDefault();
            $('body').find('#start_date').val('');
            $('body').find('#end_date').val('');
            table.draw();
        });

        let deleteTenderArray = [];

        // Handle "Select All" checkbox
        $(document).on('change', '#select_all', function() {
            if ($(this).prop('checked')) {
                $('body').find('#delete_all_btn').removeClass('hidden');
                $('body').find('.checkbox').prop('checked', true).trigger('change');
            } else {
                $('body').find('.checkbox').prop('checked', false).trigger('change');
                $('body').find('#delete_all_btn').addClass('hidden');
            }
        });

        // Handle individual checkboxes
        $(document).on('change', '.checkbox', function() {
            let tenderId = $(this).val();

            if ($(this).prop('checked')) {
                // Add to the array if not already present
                if (!deleteTenderArray.includes(tenderId)) {
                    deleteTenderArray.push(tenderId);
                }
            } else {
                // Remove from the array
                deleteTenderArray = deleteTenderArray.filter(id => id !== tenderId);
            }

            // Toggle "Delete All" button visibility
            if ($('body').find('.checkbox:checked').length > 0) {
                $('body').find('#delete_all_btn').removeClass('hidden');
            } else {
                $('body').find('#delete_all_btn').addClass('hidden');
            }

            // Log the current array
            console.log(deleteTenderArray.join(','));
        });


        // Bulk delete function
        function deleteBulkTender() {
            $.ajax({
                type: "POST",
                url: "{{ route('tender.bulk_delete') }}",
                data: {
                    tender_ids: deleteTenderArray,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    // Optionally, remove deleted tenders from the UI
                    // deleteTenderArray.forEach(id => {
                    //     $(`.checkbox[value="${id}"]`).closest('tr').remove();
                    // });
                    deleteTenderArray = []; // Reset the array
                    $('body').find('#delete_all_btn').addClass('hidden');
                    table.draw();
                    $('body').find('#select_all').prop('checked', false).trigger('change');
                    if (response['status']) {
                        swal("Tenders", "Tenders Deleted Successfully.", "success")
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        }

        $(document).on('click', '#delete_all_btn', function(e) {
            e.preventDefault();
            var linkURL = $(this).attr("href");
            Swal.fire({
                title: 'Are you sure want to Delete Select Tenders?',
                text: "As that can be undone by doing reverse.",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    deleteBulkTender();
                }
            });
        });


        $('#start_date').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: true,
                autoclose: true,
            })
            .on('changeDate', function(selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#end_date').datepicker('setStartDate', minDate);
            });

        $('#end_date').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: true,
                autoclose: true,
            })
            .on('changeDate', function(selected) {
                var maxDate = new Date(selected.date.valueOf());
                $('#start_date').datepicker('setEndDate', maxDate);
            });
    </script>
@endsection
