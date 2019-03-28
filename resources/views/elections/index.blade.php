@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-2 col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Selecciona el curso </h4>
        <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/') }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
      </div>
      <div class="card-body">	
		  @foreach( $arrayElecciones as $key => $cursoEleccion )
			<h5><a href="{{ url('/elections/course/' . $cursoEleccion->course ) }}" style="color: #000000;">Curso {{$cursoEleccion->course}}</a></h5>
		    </br>
		  @endforeach
	  </div>
  </div>
</div>
@stop