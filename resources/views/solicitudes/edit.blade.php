@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>

    @if (Auth()->user()->role == 'Profesor')
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/teacher') }}">Curso Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/teacher/index/'.$course) }}">Solicitudes Curso {{$course}}</a></li>
    @else
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director') }}">Curso Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director/index/'.$course) }}">Solicitudes Curso {{$course}}</a></li>
    @endif
    <li class="breadcrumb-item active" aria-current="page">Editar Solicitud</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
	<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header"> 
            <h5 class="text-center"> Editar Solicitud </h5>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST" onsubmit="return validacion()">
         		{{ method_field('PUT') }}
         		{{ csrf_field() }}

            <h6 style="text-align:right;" id="cD"></h6>

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
  var teacher_id = "{{$solicitud->teacher_id}}";
  var course = "{{$course}}";
  var vCredT = document.getElementById("cTheory").value;
  var vCredP = document.getElementById("cPractice").value;
  var vCredS = document.getElementById("cSeminar").value;
  var auxCredT;
  var auxCredP;
  var auxCredS;
  var subObj_credT;
  var subObj_credS;
  var subObj_credP;
  var cAvailable = 0;

  $('#cTheory').on('change', function(e) {
    auxCredT = e.target.value;
    var diferencia = 0;

    if (auxCredT == "") {
      auxCredT = 0;
    }

    if (vCredT < auxCredT) {
      diferencia = auxCredT - vCredT;
      cAvailable = cAvailable - diferencia;
    }else if(vCredT > auxCredT){
      diferencia = vCredT - auxCredT;
      cAvailable = cAvailable + diferencia;
    }
    console.log(cAvailable);
    $("#cD").text("Créditos Disponibles: "+cAvailable.toFixed(1));
  });

  $('#cPractice').on('change', function(e) {
    auxCredP = e.target.value;
    var diferencia = 0;

    if (auxCredP == "") {
      auxCredP = 0;
    }

    if (vCredP < auxCredP) {
      diferencia = auxCredP - vCredP;
      cAvailable = cAvailable - diferencia;
    }else if(vCredP > auxCredP){
      diferencia = vCredP - auxCredP;
      cAvailable = cAvailable + diferencia;
    }
    console.log(cAvailable);
    $("#cD").text("Créditos Disponibles: "+cAvailable.toFixed(1));
  });

  $('#cSeminar').on('change', function(e) {
    auxCredS = e.target.value;
    var diferencia = 0;

    if (auxCredS == "") {
      auxCredS = 0;
    }

    if (vCredS < auxCredS) {
      diferencia = auxCredS - vCredS;
      cAvailable = cAvailable - diferencia;
    }else if(vCredS > auxCredS){
      diferencia = vCredS - auxCredS;
      cAvailable = cAvailable + diferencia;
    }
    console.log(cAvailable);
    $("#cD").text("Créditos Disponibles: "+cAvailable.toFixed(1));
  });

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

  $.ajax({
    url: "{{url('json-electionProf')}}",
    type:"GET", 
    data: {"id":teacher_id, "course":course}, 
    success: function(result){
      cAvailable = result.cAvailable;
      $("#cD").text("Créditos Disponibles: "+cAvailable);
      cAvailable = parseFloat(cAvailable);
    }
  });

  function validacion(){
    var enviar = false;

    subObj_credT = parseFloat(subObj_credT);
    subObj_credP = parseFloat(subObj_credP);
    subObj_credS = parseFloat(subObj_credS);

    if(cAvailable < 0){
      alert("No tienes créditos disponibles");
    }else if(vCredS == "" && vCredT == "" && vCredP == ""){
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