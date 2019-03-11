@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-2 col-md-8">
    <div class="card">
      <div class="card-header text-center">
          <h4> Solicitudes por Curso Academico </h4>
      </div>
      <div class="card-body">	
		  @foreach( $arrayCursos as $key => $curso )
			<h5><a href="{{ url('/applications/course/' . $curso->course ) }}" style="color: #000000;">Curso {{$curso->course}}</a></h5>
		    </br>
		  @endforeach
	  </div>
  </div>
</div>
@stop