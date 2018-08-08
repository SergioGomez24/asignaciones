<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/bootstrap/js/bootstrap.min.js') }}">

  </head>
  <body>
    @include('partials.navbar')
    <div class="container">
    @notification()
    @yield('content')
    </div>
  </body>
</html>