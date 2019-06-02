@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director') }}">Curso Solicitudes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Elecciones {{$course}}</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-3 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Elecciones {{$course}} </h4>
      </div>
      <div class="card-body">  
      <h5><a href="{{ url('/solicitudes/director/state/' . $course ) }}" style="color: #000000;">Seguimiento</a></h5>
      <h5><a href="{{ url('/solicitudes/director/teacher/' . $course ) }}" style="color: #000000;">Gestión Elecciones</a></h5>
      </div>
    </div>
  </div>
</div>
@stop