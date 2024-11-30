<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tender World - Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="{{ asset('public/assets/img/tworld/logo-width-bg.png') }}" type="image/gif" sizes="16x16">
    @include('layouts.headerscript')

    @yield('style')
    <style>
        .btn-theme {
            background: #6969CD;
            color: white;
        }

        .btn-theme:hover {
            color: white;
        }

        .select2-container .select2-selection--single {
            border-radius: 0px;
            height: 35px;
        }

        .error {
            color: red;
            font-weight: bold;
            font-size: 12px;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
        @include('layouts.navbar')
        @include('layouts.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('layouts.footer')
    </div>
    @include('layouts.footerscript')

    @yield('script')
    <script>
        $(document).ready(function() {
            //swal("Hello world!");
            //Initialize Select2 Elements
            $('.select2').select2()
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-purple'
            });

            CKEDITOR.replace('description');

            $('.logout').on('click', function(e) {
                e.preventDefault();
                $('#logout').submit();
            });

            @if (Session::has('message'))
                swal("{{ $moduleName }}", "{{ Session::get('message') }}", "success")
            @endif

            @if (Session::has('error'))
                swal("{{ $moduleName }}", "{{ Session::get('error') }}", "error")
            @endif

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var linkURL = $(this).attr("href");
                Swal.fire({
                    title: 'Are you sure want to Delete?',
                    text: "As that can be undone by doing reverse.",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = linkURL;
                    }
                });
            });
        });

        $(function() {
            //Add text editor
            $("#ck-editor").wysihtml5();
        });
    </script>
</body>

</html>
