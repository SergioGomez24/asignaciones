@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header"> 
            <h5 class="text-center"> Editar solicitud </h5>
            @if (Auth()->user()->role == 'Profesor')
            <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/solicitudes/teacher/index/'.$course) }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
            @else
            <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/solicitudes/director/index/'.$course) }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
            @endif
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST" onsubmit="return validacion()">
         		{{ method_field('PUT') }}
         		{{ csrf_field() }}

            <div class="group row text-center" style="align-content: center;">
            <div class="col-md-4">
            <h6>Créditos Teoria</h6>
            <p id="cT"></p>
            </div>

            <div class="col-md-4">
            <h6>Créditos Práctica</h6>
            <p id="cP"></p>
            </div>

            <div class="col-md-4">
            <h6>Créditos Seminario</h6>
            <p id="cS"></p>
            </div>
            </div>

            <div class="form-group">
               <label for="cTheory" style="font-weight: bold;">Créditos Teoria</label>
               <input type="number" name="cTheory" id="cTheory" value="{{$solicitud->cTheory}}" step="0.1" class="form-control">
            </div>

            <div class="form-group">
               <label for="cPractice" style="font-weight: bold;">Créditos Práctica</label>
               <input type="number" name="cPractice" id="cPractice" value="{{$solicitud->cPractice}}" step="0.1" class="form-control">
            </div>

            <div class="form-group">
               <label for="cSeminar" style="font-weight: bold;">Créditos Seminario</label>
               <input type="number" name="cSeminar" id="cSeminar" value="{{$solicitud->cSeminar}}" step="0.1" class="form-control">
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary">
                  Editar
               </button>
               @if (Auth()->user()->role == 'Profesor')
               <a class="btn btn-secondary" href="{{ url('/solicitudes/teacher/index/'.$course) }}" role="button">Cancelar</a>
               @else
               <a class="btn btn-secondary" href="{{ url('/solicitudes/director/index/'.$course) }}" role="button">Cancelar</a>
               @endif
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">

   var subject_id = "{{$solicitud->subject_id}}";
   var subObj_credT;
   var subObj_credS;
   var subObj_credP;

   $.ajax({
      url: "{{url('json-subject')}}",
      type:"GET", 
      data: {"id":subject_id}, 
      success: function(result){
        $("#cT").text(result.cTheory);  
        $("#cP").text(result.cPractice);
        $("#cS").text(result.cSeminar);
        subObj_credT = result.cTheory;
        subObj_credP = result.cPractice;
        subObj_credS = result.cSeminar;
      }
   });
   

function validacion(){
   var vCredT = document.getElementById("cTheory").value;
   var vCredP = document.getElementById("cPractice").value;
   var vCredS = document.getElementById("cSeminar").value;
   var enviar = false;

   subObj_credT = parseFloat(subObj_credT);
   subObj_credP = parseFloat(subObj_credP);
   subObj_credS = parseFloat(subObj_credS);

   if(vCredS == "" && vCredT == "" && vCredP == ""){
      alert("Introduce los créditos");
   }else if(vCredT == "0" || vCredP == "0" || vCredS == "0"){
      alert("Introduce un valor mayor que 0");
   }else if(vCredT == "0.0" || vCredP == "0.0" || vCredS == "0.0"){
      alert("Introduce un valor mayor que 0");
   }else if(vCredT < 0 || vCredP < 0 || vCredS < 0){
      alert("Introduce un valor positivo");
   }else if(vCredT > subObj_credT || vCredP > subObj_credP || vCredS > subObj_credS) {
      alert("Créditos introducidos no validos");
   }else {
      enviar = true;
   }
   return enviar;
  }

</script>
@stop