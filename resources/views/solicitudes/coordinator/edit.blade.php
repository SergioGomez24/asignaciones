@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header"> 
            <h5 class="text-center"> Modificar solicitud </h5>
            <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/solicitudes/coordinator/course/'.$course) }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>  
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

   var subject_id = "{{$solicitud->subject_id}}";
   var subObj_credT;
   var subObj_credS;
   var subObj_credP;

   window.onload = function() {
      $.get('/asignaciones/public/json-subject?id='+ subject_id, function(data) {
         $('#cT').empty();
         $('#cP').empty();
         $('#cS').empty();
         $.each(data, function(index, subjectObj) {
            $('#cT').append('<p>'+subjectObj.cTheory+'</p>');
            $('#cP').append('<p>'+subjectObj.cPractice+'</p>');
            $('#cS').append('<p>'+subjectObj.cSeminar+'</p>');
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