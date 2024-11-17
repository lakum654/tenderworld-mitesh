@extends('user.layouts.master')
@section('title', 'Tenders World - Services')

@section('css')
    <style>
        /* Adjust the filter section styling */
        #events .border {
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        #events h5 {
            color: #004085;
        }

        #events .btn-outline-secondary,
        .btn-primary {
            font-weight: bold;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.1rem;
        }

        .card {
            border-radius: 8px;
        }

        .page-link {
            color: #ce1212 !important;
        }
    </style>
@endsection

@section('content')
    <section id="events" class="events">
        <div class="container" data-aos="fade-up">
            <h2 class="text-center">Latest 2024 Government eTenders</h2>
            <p class="text-center">Discover the latest tenders offering lucrative opportunities. Stay updated with our
                real-time listings, ensuring you never miss a chance to bid on valuable contracts in your industry.</p>

            <!-- Search Box -->
            <div class="row mb-4 justify-content-center">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <form id="searchForm">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search Your Tender Here" name="query"
                                id="searchQuery" value="{{ $_GET['query'] ?? "" }}">
                            {{-- <button class="btn btn-primary" type="button" onclick="fetchTenders()">Search</button> --}}
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <!-- Filter Sidebar -->
                <div class="col-md-3">
                    <div class="border p-3 mb-4">
                        <h5>Filters By:</h5>
                        <div class="mb-3">
                            <label for="t18RefNo" class="form-label">Ref No</label>
                            <input type="text" class="form-control" id="t18RefNo" placeholder="Enter Ref No...">
                        </div>
                        <div class="mb-3">
                            <label for="keyword" class="form-label">Keyword</label>
                            <input type="text" class="form-control" id="keyword" placeholder="Enter Keyword...">
                        </div>
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <select class="form-control" id="state">
                                <option>Select State</option>
                                @foreach ($states as $key => $state)
                                    <option value="{{ $state->name }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <select class="form-control" id="city">
                                <option>Select City</option>
                                @foreach ($cities as $key => $city)
                                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tenders Listing -->
                <div class="col-md-9">
                    <div class="row" id="tenderList">
                        <!-- Tenders will be loaded here dynamically -->
                    </div>
                    <div class="mt-4" id="paginationLinks">
                        <!-- Pagination links will be rendered here -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- JavaScript for AJAX request -->
    <script>
        $(document).ready(function() {
            // Load tenders on page load
            fetchTenders();

            // Trigger fetchTenders when any filter input changes
            $('#searchQuery, #t18RefNo, #keyword, #state,#city').on('input change', function() {
                fetchTenders();
            });

            // Bind search form submit
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                fetchTenders();
            });
        });

        function fetchTenders(page = 1) {
            $.ajax({
                url: "{{ route('fetch.tenders') }}",
                method: "GET",
                data: {
                    page: page,
                    query: $('#searchQuery').val(),
                    refNo: $('#t18RefNo').val(),
                    keyword: $('#keyword').val(),
                    state: $('#state').val(),
                    city: $('#city').val()
                },
                success: function(response) {
                    renderTenders(response.data);
                    renderPagination(response);
                }
            });
        }

        function renderTenders(tenders) {
            let html = '';

            // Check if tenders array is not empty
            if (tenders.length) {
                tenders.forEach(tender => {
                    // Destructure the tender object for better readability
                    const {
                        tender_id,
                        city,
                        state,
                        work,
                        department,
                        end_date,
                        tender_value,
                        id
                    } = tender;

                    // Append each tender's HTML to the variable
                    html += `
                <div class="col-md-12 col-lg-12 mb-4">
                    <div class="card border-0 shadow">
                        <!-- Card Header -->
                        <div class="card-header bg-danger text-white d-flex justify-content-between">
                            <strong>Ref No: ${tender_id || 'N/A'}</strong>
                            <span>Location: ${city || 'Unknown'}, ${state || 'Unknown'}</span>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <h5 class="card-title">${work || 'No Work Description Available'}</h5>
                            <p class="card-text">
                                <strong>Agency / Dept:</strong> ${department || 'Not Specified'}<br>
                                <strong>Due Date:</strong> ${end_date
                                    ? new Date(end_date).toLocaleDateString('en-US', {
                                        month: 'short',
                                        day: 'numeric',
                                        year: 'numeric'
                                    })
                                    : 'No Date Available'}<br>
                                <strong>Tender Value:</strong> ${tender_value ?? 'Refer Document'}
                            </p>
                            <a href="tender/${id}" class="btn btn-outline-danger">View Documents</a>
                        </div>
                    </div>
                </div>
            `;
                });
            } else {
                // If no tenders are available
                html += `
            <div class="col-12 text-center">
                <h3 class="text-muted">No Tenders Found</h3>
            </div>
        `;
            }

            // Update the tender list container
            $('#tenderList').html(html);
        }


        function renderPagination(data) {
            let html = '<nav><ul class="pagination justify-content-center align-items-center">';

            // Show "Previous" button if there is a previous page
            if (data.prev_page_url) {
                html += `
            <li class="page-item">
                <a class="page-link text-danger" href="javascript:void(0)" onclick="fetchTenders(${data.current_page - 1})" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span> Previous
                </a>
            </li>`;
            } else {
                // Disabled "Previous" button if there is no previous page
                html += `
            <li class="page-item disabled">
                <a class="page-link text-danger" href="javascript:void(0)" tabindex="-1" aria-disabled="true">
                    <span aria-hidden="true">&laquo;</span> Previous
                </a>
            </li>`;
            }

            // Show the current page and total pages information as text, styled for clarity
            html += `
                <li class="page-item disabled">
                    <span class="page-link text-danger">Page ${data.current_page} of ${data.last_page}</span>
                </li>`;

            // Show "Next" button if there is a next page
            if (data.next_page_url) {
                html += `
            <li class="page-item">
                <a class="page-link text-danger" href="javascript:void(0)" onclick="fetchTenders(${data.current_page + 1})" aria-label="Next">
                    Next <span aria-hidden="true">&raquo;</span>
                </a>
            </li>`;
            } else {
                // Disabled "Next" button if there is no next page
                html += `
            <li class="page-item disabled">
                <a class="page-link text-danger" href="javascript:void(0)" tabindex="-1" aria-disabled="true">
                    Next <span aria-hidden="true">&raquo;</span>
                </a>
            </li>`;
            }

            html += '</ul></nav>';

            if(data.data.length <= 0) {
                html = '';
            }
            $('#paginationLinks').html(html);
        }




        // The DOM elements you wish to replace with Tagify
        var input1 = document.querySelector("#keyword");


        // Initialize Tagify components on the above inputs
        new Tagify(input1);
    </script>
@endpush
