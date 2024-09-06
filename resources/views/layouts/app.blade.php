<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="/logistic-assets/images/favicon-osave.ico" />
    <link rel="stylesheet" href="/logistic-assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="/logistic-assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="/logistic-assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/logistic-assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="/logistic-assets/vendor/remixicon/fonts/remixicon.css">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- DataTables Buttons CSS -->
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">

</head>

<body class="  ">

    @include('elements.navbar')
    @include('elements.sidebar')


    <div class="content-page">
        @yield('content')
    </div>




    <!-- Backend Bundle JavaScript -->
    <script src="/logistic-assets/js/backend-bundle.min.js"></script>


    <!-- app JavaScript -->
    <script src="/logistic-assets/js/app.js"></script>


    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>

    <!-- Buttons HTML5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

    <!-- Buttons Print JS -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <!-- Buttons ColVis JS -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>

    <script src="https://cdn.datatables.net/plug-ins/1.10.20/api/makeCellsEditable.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('scripts')
</body>

</html>
