@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/coordinators') }}">Curso Solicitudes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Solicitudes Curso {{$course}}</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Solicitudes Curso {{$course}} </h4>
      </div>

      <div class="card-body">
        @if($coorPermission == 1)
          
            <h6><label for="subject">Selecciona una asignatura</label></h6>
              @foreach($arrayAsignaturasCoor as $a)
                <h5><a href="{{url("coordinators/index/{$course}/{$a->id}")}}">{{$a->name}}</a></h5>
                </br>
              @endforeach

          @else
          <h6>Las solicitudes del coordinador no está disponible</h6>
        @endif
      </div>
    </div>
  </div>
</div>
@stop