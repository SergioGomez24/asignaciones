<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/bootstrap/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">

    <script src="{{ url('/assets/bootstrap/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ url('/assets/bootstrap/popper.min.js') }}"></script>
    <!--<script src="{{ url('/assets/bootstrap/dropdown.js') }}"></script>-->

    <script src="{{ url('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/js/jquery.tablesorter.min.js') }}"></script>

  </head>
  <body background="{{ asset('img/fondo.jpg') }}">
    <!-- Header -->
    @include('partials.navbar')
    @yield('breadcrumb')
    <div class="container">
        @notification()
        @yield('content')
    </div>
  </body>
</html>