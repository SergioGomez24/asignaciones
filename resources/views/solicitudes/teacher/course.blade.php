@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-2 col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Solicitudes por Curso Academico </h4>
        <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/') }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
      </div>
      <div class="card-body">
      @if($cont == 0)
        <h5>No hay elecciones creadas</h5>
      @else   
      @foreach( $arrayElecciones as $key => $eleccion )
      <h5><a href="{{ url('/solicitudes/teacher/index/' . $eleccion->course ) }}" style="color: #000000;">Curso {{$eleccion->course}}</a></h5>
        </br>
      @endforeach
      @endif
    </div>
    </div>
  </div>
</div>
@stop