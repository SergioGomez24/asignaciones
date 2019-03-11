@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-2 col-md-8">
    <div class="card">
      <div class="card-header text-center">
          <h5> Solicitudes por Curso Academico </h5>
      </div>
      <div class="card-body text-center">	
		  @foreach( $arrayCursos as $key => $curso )
		    <div>
			    <h5><a href="{{ url('/applications/course/' . $curso->course ) }}" style="color: #000000;">Curso {{$curso->course}}</a></h5>
		    </div>
		    </br><hr />
		  @endforeach
	  </div>
  </div>
</div>
@stop