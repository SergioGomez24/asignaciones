@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
   	  <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h5> Lista de asignaturas </h5>
          </div>
          <div class="card-body">	
		  @foreach( $arrayAsignaturas as $key => $asignatura )
			<a href="{{ url('/subjects/show/' . $asignatura->id ) }}">
				<h5 style="min-height:35px;margin:5px;color:#000000">
					{{$asignatura->name}}
				</h5>
			</a>
			<a class="fas" href="{{ url('/subjects/edit/'.$asignatura->id) }}" style="margin-left: 850px">&#xf044</a>

			<a class="fas" href="{{ url('/subjects/delete/'.$asignatura->id) }}" style="margin-left: 900px">&#xf2ed</a>
					
			<hr /> 
			  
		  @endforeach
		  </div>
	    </div>
	  </div>
	</div>
@stop