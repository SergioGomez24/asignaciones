@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Curso Solicitudes</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-2 col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Solicitudes por Curso Academico </h4>
      </div>
      <div class="card-body">
      @if($cont == 0)
        <h5>No hay elecciones creadas</h5>
      @else 
      @foreach( $arrayElecciones as $key => $eleccion )
      <h5><a href="{{ url('/coordinators/index/' . $eleccion->course ) }}" style="color: #000000;">Curso {{$eleccion->course}}</a></h5>
        </br>
      @endforeach
      @endif
      </div>
    </div>
  </div>
</div>
@stop