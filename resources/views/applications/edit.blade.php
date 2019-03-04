@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header">
            <div style="float: left; margin-left: 170px;">
               <h5 > Modificar solicitud </h5>
            </div>
            <div id="btnCabecera">
               <a class="btn btn-primary btn-sm" href="{{ url('/applications/course/'. $course) }}">Volver al listado</a>
            </div>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST" onsubmit="return validacion()">
         		{{ method_field('PUT') }}
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="cTheory">Creditos Teoria</label>
               <input type="number" name="cTheory" id="cTheory" value="{{$application->cTheory}}" step="0.01" class="form-control">
            </div>

            <div class="form-group">
               <label for="cPractice">Creditos Práctica</label>
               <input type="number" name="cPractice" id="cPractice" value="{{$application->cPractice}}" step="0.01" class="form-control">
            </div>

            <div class="form-group">
               <label for="cSeminar">Creditos Seminario</label>
               <input type="number" name="cSeminar" id="cSeminar" value="{{$application->cSeminar}}" step="0.01" class="form-control">
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Modificar solicitud
               </button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">

   var subject_id = "{{$application->subject_id}}";
   var subObj_credT;
   var subObj_credS;
   var subObj_credP;

   window.onload = function() {
      $.get('/asignaciones/public/json-subject?id='+ subject_id, function(data) {
         $.each(data, function(index, subjectObj) {
            subObj_credT = subjectObj.cTheory;
            subObj_credP = subjectObj.cPractice;
            subObj_credS = subjectObj.cSeminar;
         })
      });
   }

function validacion(){
   var vCredT = document.getElementById("cTheory").value;
   var vCredP = document.getElementById("cPractice").value;
   var vCredS = document.getElementById("cSeminar").value;
   var enviar = false;

   if(vCredT == "0" || vCredP == "0" || vCredS == "0"){
      alert("Introduce un valor mayor que 0");
   }else if(vCredT > subObj_credT || vCredP > subObj_credP || vCredS > subObj_credS) {
      alert("Créditos introducidos no validos");
   }else {
      enviar = true;
   }
   return enviar;
  }

</script>
@stop