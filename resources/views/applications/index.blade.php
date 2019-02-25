@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div id="titlistado">
          <h5 > Selecciones por Curso Academico </h5>
        </div>
      </div>
      <div class="card-body">	
		  @foreach( $arrayCursos as $key => $curso )
		    <div id="nombrelist">
			    <h5><a href="{{ url('/applications/course/' . $curso->course ) }}" style="color: #000000;">Curso {{$curso->course}}</a></h5>
		    </div>
		    </br><hr />
		  @endforeach
	  </div>
  </div>
</div>
@stop