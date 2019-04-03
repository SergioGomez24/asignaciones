@extends('layouts.master')

@section('content')
<div class="row" style="margin-top:40px">
<div class="container">
	<div class="offset-md-1 col-md-10">
    <div class="jumbotron">
  		<h1 class="display-4">Universidad de Cádiz</h1>
  		<p class="lead">Elecciones de asignaturas para los profesores de la UCA</p>
  		<hr class="my-4">
  		<p></p>
  		<p class="lead">
        @if (Auth()->user()->role == 'Profesor')
          <a class="btn btn-primary btn-lg" href="{{url('/solicitudes/course')}}" role="button">Iniciar solicitud</a>
        @endif
  		</p>
	</div>
</div>
</div>
@endsection
