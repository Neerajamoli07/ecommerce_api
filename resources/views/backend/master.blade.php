<!DOCTYPE html>
<html>

<head>
    <title>Admin Backend</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/animate.css') }}">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style-backend.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/flat-blue.css') }}">

    <!-- SCRIPTS -->
    <script src="{{ asset('/js/jquery.min.js') }}" type="text/javascript"></script>
    {!! Rapyd::styles(false) !!}
    {!! Rapyd::head() !!}

</head>

<body class="flat-blue">
<div class="app-container">
    <div class="row content-container">
        @include('backend.navbar')
        @include('backend.sidebar')
        @yield('content')
    </div>
    <!-- FOOTER -->
    @include('backend.footer')
            <!-- //FOOTER -->
</div>

<script src="{{ asset('/js/convertdocument/jquery-3.5.1.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/convertdocument/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/convertdocument/dataTables.buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/convertdocument/jszip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/convertdocument/pdfmake.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/convertdocument/vfs_fonts.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/convertdocument/buttons.html5.min.js') }}" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $('#converter').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'pdf'
        ]
    } );
    $('#converter_filter').css("display", "none");
} );
</script>
</body>

</html>
