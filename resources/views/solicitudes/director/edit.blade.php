@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director') }}">Curso Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director/index/'.$course) }}">Solicitudes Curso {{$course}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar Solicitud</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
	<div class="row" style="margin-top:40px">
   <div class="offset-md-2 col-md-8">
      <div class="card">
         <div class="card-header"> 
            <h5 class="text-center"> Editar Solicitud </h5> 
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST" onsubmit="return validacion()">
         		{{ method_field('PUT') }}
         		{{ csrf_field() }}

            <div class="group row">
            <div class="col-md-4">
            <h6>Profesor</h6>
            <p id="teacher"></p>
            </div>

            <div class="col-md-4">
            <h6>Créditos Disponibles</h6>
            <p id="cD"></p>
            </div>

            <div class="col-md-4">
            <h6>Asignatura</h6>
            <p id="subj"></p>
            </div>
            </div>

            <div class="group row">
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

            <div class="group row">
            <div class="col-md-4">
               <label for="cTheory" style="font-weight: bold;">Créditos Teoria</label>
               <input type="number" name="cTheory" id="cTheory" value="{{$solicitud->cTheory}}" step="0.1" class="form-control">
            </div>

            <div class="col-md-4">
               <label for="cPractice" style="font-weight: bold;">Créditos Práctica</label>
               <input type="number" name="cPractice" id="cPractice" value="{{$solicitud->cPractice}}" step="0.1" class="form-control">
            </div>

            <div class="col-md-4">
               <label for="cSeminar" style="font-weight: bold;">Créditos Seminario</label>
               <input type="number" name="cSeminar" id="cSeminar" value="{{$solicitud->cSeminar}}" step="0.1" class="form-control">
            </div>
            </div>

            <input type="hidden" name="cds" id="cds" value="">

            <div class="form-group text-center" style="margin-top: 30px;">
               <button type="submit" class="btn btn-primary" id="btnAceptar">
                  Editar
               </button>
               <a class="btn btn-secondary" href="{{ url('/solicitudes/director/index/'.$course) }}" role="button" id="btnCancelar">Cancelar</a>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">

  var subject_id = "{{$solicitud->subject_id}}";
  var teacher_id = "{{$solicitud->teacher_id}}";
  var course = "{{$course}}";
  var id = "{{$solicitud->id}}";
  var vCredT = document.getElementById("cTheory").value;
  var vCredP = document.getElementById("cPractice").value;
  var vCredS = document.getElementById("cSeminar").value;
  var auxCredT;
  var auxCredP;
  var auxCredS;
  var credTavailable;
  var credPavailable;
  var credSavailable;
  var cAvailable = 0;

  $.ajax({
    url: "{{url('json-subject')}}",
    type:"GET", 
    data: {"id":subject_id}, 
    success: function(result){
      $("#subj").text(result.name);
    }
  });

  $.ajax({
    url: "{{url('json-teacher')}}",
    type:"GET", 
    data: {"id":teacher_id}, 
    success: function(result){
      $("#teacher").text(result.name);
    }
  });

  $.ajax({
    url: "{{url('json-solicitudes')}}",
    type:"GET", 
    data: {"subject_id":subject_id, "course":course, "id":id}, 
    success: function(result){
      $("#cT").text(result.totalT);  
      $("#cP").text(result.totalP);
      $("#cS").text(result.totalS);
      credTavailable = result.totalT;
      credPavailable = result.totalP;
      credSavailable = result.totalS;
    }
  });

  $.ajax({
    url: "{{url('json-electionProf')}}",
    type:"GET", 
    data: {"id":teacher_id, "course":course}, 
    success: function(result){
      cAvailable = result.cAvailable;
      $("#cD").text(cAvailable);
      cAvailable = parseFloat(cAvailable);
    }
  });

  $('#cTheory').on('change', function(e) {
    auxCredT = e.target.value;
    var diferencia = 0;

    if (auxCredT == "") {
      auxCredT = 0;
    }

    if (vCredT < auxCredT) {
      diferencia = auxCredT - vCredT;
      if (cAvailable - diferencia >= 0){
        cAvailable = cAvailable - diferencia;
        $("#cD").text(cAvailable.toFixed(1));
        $('#cds').val(cAvailable);
        vCredT = auxCredT;
      }else {
        alert("No tiene créditos disponibles");
      }
    }else if(vCredT > auxCredT){
      diferencia = vCredT - auxCredT;
      cAvailable = cAvailable + diferencia;
      $("#cD").text(cAvailable.toFixed(1));
      $('#cds').val(cAvailable);
      vCredT = auxCredT;
    }
    
  });

  $('#cPractice').on('change', function(e) {
    auxCredP = e.target.value;
    var diferencia = 0;

    if (auxCredP == "") {
      auxCredP = 0;
    }

    if (vCredP < auxCredP) {
      diferencia = auxCredP - vCredP;
      if (cAvailable - diferencia >= 0){
        cAvailable = cAvailable - diferencia;
        $("#cD").text(cAvailable.toFixed(1));
        $('#cds').val(cAvailable);
        vCredP = auxCredP;
      }else {
        alert("No tiene créditos disponibles");
      }
    }else if(vCredP > auxCredP){
      diferencia = vCredP - auxCredP;
      cAvailable = cAvailable + diferencia;
      $("#cD").text(cAvailable.toFixed(1));
      $('#cds').val(cAvailable);
      vCredP = auxCredP;
    }
  });

  $('#cSeminar').on('change', function(e) {
    auxCredS = e.target.value;
    
    var diferencia = 0;

    if (auxCredS == "") {
      auxCredS = 0;
    }

    if (vCredS < auxCredS) {
      diferencia = auxCredS - vCredS;
      if (cAvailable - diferencia >= 0){
        cAvailable = cAvailable - diferencia;
        $("#cD").text(cAvailable.toFixed(1));
        $('#cds').val(cAvailable);
        vCredS = auxCredS;
      }else {
        alert("No tiene créditos disponibles");
      }
    }else if(vCredS > auxCredS){
      diferencia = vCredS - auxCredS;
      cAvailable = cAvailable + diferencia;
      $("#cD").text(cAvailable.toFixed(1));
      $('#cds').val(cAvailable);
      vCredS = auxCredS;
    }
  });

  function validacion(){

    var enviar = false;

    credTavailable = parseFloat(credTavailable);
    credPavailable = parseFloat(credPavailable);
    credSavailable = parseFloat(credSavailable);

    if (auxCredT == 0) {
      auxCredT = "";
    }

    if (auxCredP == 0) {
      auxCredP = "";
    }

    if (auxCredS == 0) {
      auxCredS = "";
    }

    if(auxCredT == "" && auxCredP == "" && auxCredS == ""){
      alert("Introduce los créditos");
    }else if(auxCredT == "" && vCredP == "" && vCredS == ""){
      alert("Introduce los créditos");
    }else if(vCredT == "" && auxCredP == "" && vCredS == ""){
      alert("Introduce los créditos");
    }else if(vCredT == "" && vCredP == "" && auxCredS == ""){
      alert("Introduce los créditos");
    }else if(auxCredT == "" && auxCredP == "" && vCredS == ""){
      alert("Introduce los créditos");
    }else if(vCredT == "" && auxCredP == "" && auxCredS == ""){
      alert("Introduce los créditos");
    }else if(auxCredT == "" && vCredP == "" && auxCredS == ""){
      alert("Introduce los créditos");
    }else if(auxCredT < 0 || auxCredP < 0 || auxCredS < 0){
      alert("Introduce un valor positivo");
    }else if(auxCredT > credTavailable){
      alert("Los créditos de teoria introducidos no son validos");
    }else if(auxCredP > credPavailable){
      alert("Los créditos de práctica introducidos no son validos");
    }else if(auxCredS > credSavailable){
      alert("Los créditos de seminario introducidos no son validos");
    }else {
      enviar = true;
    }
    return enviar;
  }

</script>
@stop