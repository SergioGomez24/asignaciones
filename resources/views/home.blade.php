@extends('layouts.master')

@section('content')
<div class="row" style="margin-top:40px">
<div class="container">
	<div class="offset-md-1 col-md-10">
    <div class="jumbotron">
  		<h1 class="display-4"> Elecciones de asigaturas para los profesores de la UCA</h1>
  		<p class="lead">Universidad de Cádiz</p>
  		<hr class="my-4">
  		<p></p>
  		<p class="lead">
    		<a class="btn btn-primary btn-lg" href="{{url('/applications/create')}}" role="button">Iniciar solicitud</a>
  		</p>
	</div>
</div>
</div>
@endsection
