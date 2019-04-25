@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/coordinators') }}">Curso Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/coordinators/index/'.$course) }}">Solicitudes Curso {{$course}}</a></li>
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

            <div class="group row text-center" style="align-content: center;">
            <div class="col-md-4">
            <h6>Créditos Teoria Disponibles</h6>
            <p id="cT"></p>
            </div>

            <div class="col-md-4">
            <h6>Créditos Práctica Disponibles</h6>
            <p id="cP"></p>
            </div>

            <div class="col-md-4">
            <h6>Créditos Seminario Disponibles</h6>
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
               <a class="btn btn-secondary" href="{{ url('/coordinators/index/'.$course) }}" role="button">Cancelar</a>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">

  var subject_id = "{{$solicitud->subject_id}}";
  var course = "{{$course}}";
  var id = "{{$solicitud->id}}";
  var vCredT = null;
  var vCredP = null;
  var vCredS = null;
  var credTsubject;
  var credSsubject;
  var credPsubject;
  var credTavailable;
  var credPavailable;
  var credSavailable;

  $.ajax({
    url: "{{url('json-subject')}}",
    type:"GET", 
    data: {"id":subject_id}, 
    success: function(result){
      credTsubject = result.cTheory;
      credPsubject = result.cPractice;
      credSsubject = result.cSeminar;
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

  $('#cTheory').on('change', function(e) {
    vCredT = e.target.value;
    console.log(vCredT);
  });

  $('#cPractice').on('change', function(e) {
    vCredP = e.target.value;
    console.log(vCredP);
    console.log(vCredT);
    console.log(vCredS);
  });

  $('#cSeminar').on('change', function(e) {
    vCredS = e.target.value;
    console.log(vCredS);
  });

  function validacion(){

    var enviar = false;

    credTavailable = parseFloat(credTavailable);
    credPavailable = parseFloat(credPavailable);
    credSavailable = parseFloat(credSavailable);

    credTsubject = parseFloat(credTsubject);
    credPsubject = parseFloat(credPsubject);
    credSsubject = parseFloat(credSsubject);

    if(vCredS == "" && vCredT == "" && vCredP == ""){
      alert("Introduce los créditos");
    }else if(vCredT == "0" || vCredP == "0" || vCredS == "0"){
      alert("Introduce un valor mayor que 0");
    }else if(vCredT == "0.0" || vCredP == "0.0" || vCredS == "0.0"){
      alert("Introduce un valor mayor que 0");
    }else if(vCredT < 0 || vCredP < 0 || vCredS < 0){
      alert("Introduce un valor positivo");
    }else if(vCredT > credTavailable){
      alert("Los créditos de teoria introducidos no son validos");
    }else if(vCredP > credPavailable){
      alert("Los créditos de prácticas introducidos no son validos");
    }else if(vCredS > credSavailable){
      alert("Los créditos de seminarios introducidos no son validos");
    }else if(vCredT > credTsubject || vCredP > credPsubject || vCredS > credSsubject) {
      alert("Valores introducidos incorrectos");
    }else {
      enviar = true;
    }
    return enviar;
  }

</script>
@stop