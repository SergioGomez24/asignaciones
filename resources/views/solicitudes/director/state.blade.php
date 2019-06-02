@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director') }}">Curso Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director/menu/'.$course) }}">Elecciones {{$course}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Seguimiento</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-2 col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Seguimiento Elecciones {{$course}} </h4>
      </div>
      <div class="card-body">
        <h5 class="text-center" style="font-weight: bold;">Turno Profesores</h5>
        <table class="table table-striped" id="miTabla" style="margin-top: 20px;">
          <thead>
            <tr>
              <th scope="col" class="text-center">Profesor</th>
              <th scope="col" class="text-center">Permiso Profesor</th>
              <th scope="col" class="text-center">Permiso Coordinador</th>
            </tr>
          </thead>
          <tbody> 
            @foreach( $elecciones as $key => $eleccion )
              <tr>
                <td class="text-center">{{$eleccion->name}}</td>
                @if($eleccion->profPermission == 1)
                <td class="text-center">Abierto</td>
                @else
                <td class="text-center">Cerrado</td>
                @endif
                @if($eleccion->coorPermission == 1)
                <td class="text-center">Abierto</td>
                @else
                <td class="text-center">Cerrado</td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
        <h5 class="text-center" style="font-weight: bold; padding-top: 20px;">Estado Asignaturas</h5>
        <table class="table table-striped" style="margin-top: 20px;">
          <thead>
            <tr>
              <th scope="col" style="padding-left: 50px;">Asignatura</th>
              <th scope="col" style="padding-right: 30px;">Estado</th>
            </tr>
          </thead>
          <tbody> 
            @foreach( $arraySolicitudesElegidas as $key => $a )
              <tr>
                <td style="padding-left: 50px;">{{$a->name}}</td>
                @if($a->state == 1)
                <td style="padding-right: 30px;">Abierta</td>
                @else
                <td style="padding-right: 30px;">Cerrada</td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@stop