<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.2/css/all.css' integrity='sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns' crossorigin='anonymous'>

    <script src="{{ url('/assets/bootstrap/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ url('/assets/bootstrap/popper.min.js') }}"></script>

    <script src="{{ url('/assets/bootstrap/js/bootstrap.min.js') }}"></script>

  </head>
  <body>
    <!-- Header -->
    @include('partials.navbar')
    <div class="container">
    @notification()
    @yield('content')
    </div>
  </body>
</html>