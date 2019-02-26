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
        <div class="group row">
          <div class="col-md-2">
            <h5 style="color: #000000;">Asignatura</h5>
          </div>

          <div class="col-md-2">
            <h5 style="color: #000000;">Profesor</h5>
          </div>

          <div class="col-md-2">
            <h5 style="color: #000000;">Créditos Teoría</h5>
          </div>

          <div class="col-md-2">
            <h5 style="color: #000000;">Créditos Prácticas</h5>
          </div>

          <div class="col-md-2">
            <h5 style="color: #000000;">Créditos Seminario</h5>
          </div>
        </div>
        @if (Auth()->user()->role == "Director")	
		      @foreach( $arraySolicitudes as $key => $solicitud )
		      <div class="group row">
            <div class="col-md-2">
			       <h6 style="color: #000000;">{{$solicitud->subject_id}}</h6>
            </div>

            <div class="col-md-2">
              <h6 style="color: #000000;">{{$solicitud->teacher}}</h6>
            </div>

            <div class="col-md-2">
              <h6 style="color: #000000;">{{$solicitud->cTheory}}</h6>
            </div>

            <div class="col-md-2">
              <h6 style="color: #000000;">{{$solicitud->cPractice}}</h6>
            </div>

            <div class="col-md-2">
              <h6 style="color: #000000;">{{$solicitud->cSeminar}}</h6>
            </div>
		      </div>
		      </br><hr />
		      @endforeach
        @else
          @foreach( $arraySolicitudesCoor as $key => $sol )
              
                <div class="group row">
                  <div class="col-md-2">
                    <h6 style="color: #000000;">{{$sol->subject_id}}</h6>
                  </div>

                  <div class="col-md-2">
                    <h6 style="color: #000000;">{{$sol->teacher}}</h6>
                  </div>

                  <div class="col-md-2">
                    <h6 style="color: #000000;">{{$sol->cTheory}}</h6>
                  </div>

                  <div class="col-md-2">
                    <h6 style="color: #000000;">{{$sol->cPractice}}</h6>
                  </div>

                  <div class="col-md-2">
                    <h6 style="color: #000000;">{{$sol->cSeminar}}</h6>
                  </div>
                </div>
                </br><hr />
              
          @endforeach
        @endif
      </div>
	  </div>
	</div>
</div>
@stop