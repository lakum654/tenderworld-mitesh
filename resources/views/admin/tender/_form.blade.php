@extends('master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Tender
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tenders</a></li>
        <li class="active">Edit</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Tender</h3>
        </div>
        <div class="box-body">
            <form action="{{ route("$route.update", $tender->id) }}" method="POST" enctype="multipart/form-data">
                @csrf()

                <div class="form-group">
                    <div class="row">

                        <!-- Category -->
                        <div class="col-md-6 col-sm-12">
                            <label for="category_id">Category: *</label>
                            <select name="category_id" class="form-control select2" id="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $tender->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="error">{{ $errors->first('category_id') }}</span>
                        </div>

                        <!-- Bid No -->
                        <div class="col-md-6 col-sm-12">
                            <label for="bid_no">Bid No: *</label>
                            <input type="text" class="form-control" id="bid_no" name="bid_no" value="{{ old('bid_no', $tender->bid_no) }}">
                            <span class="error">{{ $errors->first('bid_no') }}</span>
                        </div>

                        <!-- Work -->
                        <div class="col-md-12 col-sm-12">
                            <label for="ck-editor">Work Description: *</label>
                            <textarea id="ck-editor" class="form-control" name="work">{{ old('work', $tender->work) }}</textarea>
                            <span class="error">{{ $errors->first('work') }}</span>
                        </div>

                        <!-- Tender ID -->
                        <div class="col-md-6 col-sm-12">
                            <label for="tender_id">Tender ID: *</label>
                            <input type="text" class="form-control" id="tender_id" name="tender_id" value="{{ old('tender_id', $tender->tender_id) }}">
                            <span class="error">{{ $errors->first('tender_id') }}</span>
                        </div>

                        <!-- City -->
                        <div class="col-md-6 col-sm-12">
                            <label for="city">City: *</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $tender->city) }}">
                            <span class="error">{{ $errors->first('city') }}</span>
                        </div>

                        <!-- State -->
                        <div class="col-md-6 col-sm-12">
                            <label for="state">State: *</label>
                            <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $tender->state) }}">
                            <span class="error">{{ $errors->first('state') }}</span>
                        </div>

                        <!-- Department -->
                        <div class="col-md-6 col-sm-12">
                            <label for="department">Department: *</label>
                            <input type="text" class="form-control" id="department" name="department" value="{{ old('department', $tender->department) }}">
                            <span class="error">{{ $errors->first('department') }}</span>
                        </div>

                        <!-- EMD Exemption -->
                        <div class="col-md-6 col-sm-12">
                            <label for="emd_exemption">EMD Exemption:</label>
                            <input type="text" class="form-control" id="emd_exemption" name="emd_exemption" value="{{ old('emd_exemption', $tender->emd_exemption) }}">
                        </div>

                        <!-- MSE Exemption -->
                        <div class="col-md-6 col-sm-12">
                            <label for="mse_exemption">MSE Exemption:</label>
                            <input type="text" class="form-control" id="mse_exemption" name="mse_exemption" value="{{ old('mse_exemption', $tender->mse_exemption) }}">
                        </div>

                        <!-- Tender Value -->
                        <div class="col-md-6 col-sm-12">
                            <label for="tender_value">Tender Value:</label>
                            <input type="text" class="form-control" id="tender_value" name="tender_value" value="{{ old('tender_value', $tender->tender_value) }}">
                        </div>

                        <!-- Tender EMD -->
                        <div class="col-md-6 col-sm-12">
                            <label for="tender_emd">Tender EMD:</label>
                            <input type="text" class="form-control" id="tender_emd" name="tender_emd" value="{{ old('tender_emd', $tender->tender_emd) }}">
                        </div>

                        <!-- Tender Fee -->
                        <div class="col-md-6 col-sm-12">
                            <label for="tender_fee">Tender Fee:</label>
                            <input type="number" class="form-control" id="tender_fee" name="tender_fee" step="0.01" value="{{ old('tender_fee', $tender->tender_fee) }}">
                        </div>

                        <!-- Dates -->
                        <div class="col-md-6 col-sm-12">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $tender->start_date) }}">
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $tender->end_date) }}">
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label for="tender_open">Tender Open Date:</label>
                            <input type="date" class="form-control" id="tender_open" name="tender_open" value="{{ old('tender_open', $tender->tender_open) }}">
                        </div>


                        <div class="col-md-6 col-sm-12">
                            <label for="document_link">Document Link:</label>
                            <input type="text" class="form-control" id="document_link" name="document_link" value="{{ old('document_link', $tender->document_link) }}">
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label for="qty">Qty:</label>
                            <input type="number" class="form-control" id="qty" name="qty" step="0.01" value="{{ old('qty', $tender->qty) }}">
                        </div>

                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="{{ route("$route.index") }}" class="btn btn-sm btn-default">Cancel</a>
                    <input type="submit" value="Update Tender" class="btn btn-sm btn-info">
                </div>
            </form>
            <!-- /.box-footer-->
        </div>
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
@endsection
