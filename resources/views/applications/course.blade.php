@extends('layouts.master')
@section('content')
<!--<script language="JavaScript"> 
function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar esta asignatura?');
    if(mensaje) {
       document.formBorrar.submit();
       return true; 
    } else {
    	return false;
    }
} 
</script>-->

<div class="row" style="margin-top:40px">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div id="titlistado">
          <h5 > Selecciones Curso {{$course}} </h5>
        </div>
      </div>
      <div class="card-body">
      @if (Auth()->user()->role == 'Director')	
		    @foreach( $arraySolicitudes as $key => $solicitud )
		    <div id="nombrelist">
			    <h5 style="color: #000000;">{{$solicitud->subject_id}}</h5>
		    </div>
		  </br><hr />
		  @endforeach
      @endif
	  </div>
	</div>
</div>
@stop