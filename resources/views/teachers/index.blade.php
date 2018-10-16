@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
   	  <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h5> Lista de profesores </h5>
          </div>
          <div class="card-body">	
		  @foreach( $arrayProfesores as $key => $profesor )
			  <a href="{{ url('/teachers/show/' . $profesor->id ) }}">
			    <h5 style="min-height:35px;margin:5px;color:#000000">
					{{$profesor->name}}
				</h5>
				<hr /> 
			  </a>
		  @endforeach
		  </div>
	    </div>
	  </div>
	</div>
@stop