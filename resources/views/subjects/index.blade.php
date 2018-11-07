@extends('layouts.master')
@section('content')
<script language="JavaScript"> 
function pregunta(){ 
    if (confirm('¿Estas seguro de que quieres borrar esta asignatura?')){ 
       document.formBorrar.submit() 
    } 
} 
</script>

	<div class="row" style="margin-top:40px">
   	  <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h5> Lista de asignaturas </h5>
          </div>
          <div class="card-body">	
		  @foreach( $arrayAsignaturas as $key => $asignatura )
		  <div id="nombreAsignatura">
			<h5><a href="{{ url('/subjects/show/' . $asignatura->id ) }}" style="color: #000000;">{{$asignatura->name}}</a></h5>
		  </div>
		  <div id="iconoEditar">
			<a class="fas" href="{{ url('/subjects/edit/'.$asignatura->id) }}" style="color: #000000;">&#xf044</a>
		  </div>
		  <div id="iconoBorrar">
		  	<form name="formBorrar" action="{{action('SubjectsController@deleteSubject', $asignatura->id)}}" method="POST" style="display:inline">
        		  {{ method_field('DELETE') }}
        		  {{ csrf_field() }}
        		  <button type="submit" class="fas" onclick="pregunta()" style="display:inline">&#xf2ed
        		  </button>
      		</form>
			<!--<a class="fas" href="{{ url('/subjects/delete/'.$asignatura->id) }}" style="color: #000000;">&#xf2ed</a>-->
		  </div>	
		  </br><hr />
		  @endforeach
		  </div>
	    </div>
	  </div>
	</div>
@stop