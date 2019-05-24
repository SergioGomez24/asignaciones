@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director') }}">Curso Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director/teacher/'.$course) }}">Créditos Profesores</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director/index',['course' => $course, 'teacher_id' => $teacher_id]) }}">Solicitudes Profesor</a></li>
    <li class="breadcrumb-item active" aria-current="page">Selección de Asignaturas</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
  <div class="container">
      <div class="offset-md-2 col-md-8">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center"> Selección de asignaturas </h4>
          </div>

          <div class="card-body" style="padding:30px">
            <form method="POST" onsubmit="return validacion()">
              {{ csrf_field() }}

         			<h5 class="text-center" id="teacher">Profesor: {{$name}}</h5>
              <h6 class="text-center" id="course"> Curso: {{$course}} </h6>
              <h6 class="text-right" id="cAvailable"> Créditos Disponibles: {{$cAvailable}}</h6>

              <div class="form-group">
               <h6><label for="subject">Selecciona una asignatura</label></h6>
               <select name="subject" id="subject" class="form-control" required>
                  <option value="">Elige una asignatura</option>
                  @foreach($arrayAsignaturas as $a)
                  <option value="{{$a->id}}">{{$a->name}}</option>
                  @endforeach
               </select>
              </div>

              <div class="form-group row">
                <div class="col-md-4">
                  <h6>Créditos Teoria</h6>
                  <p id="cT"></p>
                </div>

                <div class="col-md-4">
                  <h6>Créditos Prácticas</h6>
                  <p id="cP"></p>
                </div>

                <div class="col-md-4">
                  <h6>Créditos Seminarios</h6>
                  <p id="cS"></p>
                </div>
              </div>      

              <div class="form-group row">
                <div class="col-md-4">
                  <h6><label for="cTheory" >Creditos Teoria</label></h6>
                  <input type="number" name="cTheory" id="cTheory" class="form-control" step="0.1" placeholder="Introduce créditos"></input>
                </div>
                <div class="col-md-4">
                  <h6><label for="credP">Creditos Prácticas</label></h6>
                  <input type="number" name="cPractice" id="cPractice" class="form-control" step="0.1" placeholder="Introduce créditos"></input>
                </div>
                <div class="col-md-4">
                  <h6><label for="cSeminar">Creditos Seminarios</label></h6>
                  <input type="number" name="cSeminar" id="cSeminar" class="form-control" step="0.1" placeholder="Introduce créditos"></input>
                </div>
              </div>

              <div class="form-group text-center">
                <button type="submit" id="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                  enviar solicitud
                </button>
              </div>
            </form>
            <div>
              <a class="btn btn-primary btn-sm" href="{{ url('/solicitudes/director/index',['course' => $course, 'teacher_id' => $teacher_id]) }}" style="float: right;">finalizar</a>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<script type="text/javascript">

  var subject_id = document.getElementById("subject").value;
  var teacher_id = "{{$teacher_id}}";
  var course = "{{$course}}";
  var subObj_credT;
  var subObj_credS;
  var subObj_credP;

  $('#subject').on('change', function(e) {
    subject_id = e.target.value;

    $.ajax({
      url: "{{url('json-solicitudesSubject')}}",
      type:"GET", 
      data: {"subject_id":subject_id, "course":course}, 
      success: function(result){
        $("#cT").text(result.totalT);  
        $("#cP").text(result.totalP);
        $("#cS").text(result.totalS);
        subObj_credT = result.totalT;
        subObj_credS = result.totalP;
        subObj_credP = result.totalS;
      }
    });
  });

  function validacion(){
    var vCredT = document.getElementById("cTheory").value;
    var vCredP = document.getElementById("cPractice").value;
    var vCredS = document.getElementById("cSeminar").value;
    var cAvailable = "{{$cAvailable}}";
    var enviar = false;

    cAvailable = cAvailable - vCredT - vCredP - vCredS;

    if(vCredS == "" && vCredT == "" && vCredP == ""){
      alert("Introduce los créditos");
    }else if(vCredT == "0" || vCredP == "0" || vCredS == "0"){
      alert("Introduce un valor mayor que 0");
    }else if(vCredT < 0 || vCredP < 0 || vCredS < 0){
      alert("Introduce un valor positivo");
    }else if(vCredT > subObj_credT) {
      alert("Créditos de teoría introducidos no validos");
    }else if(vCredP > subObj_credP) {
      alert("Créditos de prácticas introducidos no validos");
    }else if(vCredS > subObj_credS) {
      alert("Créditos de seminarios introducidos no validos");
    }else if(cAvailable < 0) {
      alert("Créditos disponibles insuficientes");
    }else {
      enviar = true;
    }
    return enviar;
  }
</script>
@stop