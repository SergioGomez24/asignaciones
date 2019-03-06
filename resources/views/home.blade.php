@extends('layouts.master')

@section('content')
<div class="row" style="margin-top:40px">
<div class="container">
    <div class="jumbotron">
  <h1 class="display-4">Universidad de Cádiz</h1>
  <p class="lead">Elecciones de asigaturas para los profesores de la UCA</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="{{url('/applications/create')}}" role="button">Iniciar solicitud</a>
  </p>
</div>
</div>
@endsection
