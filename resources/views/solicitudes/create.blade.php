@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/teacher') }}">Curso Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/teacher/index/'.$course) }}">Solicitudes Curso {{$course}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Selección de Asignaturas</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center"> Selección de asignaturas </h4>
            
            <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#filters" style="font-weight: bold;float: right;">Filtrar por</button>
          </div>

          <div class="card-body" style="padding:30px">
            <form method="POST" onsubmit="return validacion()">
              {{ csrf_field() }}

         			<h5 class="text-center" id="teacher">Profesor: {{ auth()->user()->name }}</h5>
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
                <div class="col-md-3">
                  <h6>Código</h6>
                  <p id="code"></p>
                </div>

                <div class="col-md-3">
                  <h6>Titulación</h6>
                  <p id="cert"></p>
                </div>

                <div class="col-md-3">
                  <h6>Area</h6>
                  <p id="area"></p>
                </div>

                <div class="col-md-3">
                  <h6>Campus</h6>
                  <p id="cam"></p>
                </div>

                <div class="col-md-3">
                  <h6>Centro</h6>
                  <p id="center"></p>
                </div>

                <div class="col-md-3">
                  <h6>Duración</h6>
                  <p id="duration"></p>
                </div>

                <div class="col-md-3">
                  <h6>Curso en la que se imparte</h6>
                  <p id="imp"></p>
                </div>

                <div class="col-md-3">
                  <h6>Tipo de Asignatura</h6>
                  <p id="typeSubject"></p>
                </div>

                <div class="col-md-3">
                  <h6>Coordinador</h6>
                  <p id="coordinator"></p>
                </div>

                <div class="col-md-3">
                  <h6>Créditos Teoria</h6>
                  <p id="cT"></p>
                </div>

                <div class="col-md-3">
                  <h6>Créditos Prácticas</h6>
                  <p id="cP"></p>
                </div>

                <div class="col-md-3">
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
              <a class="btn btn-primary btn-sm" href="{{ url('/solicitudes/teacher/index/'.$course) }}" style="float: right;">finalizar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="filters" tabindex="-1" role="dialog" aria-labelledby="filtersTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Filtrar por</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="bntCerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form href = "solicitudes/create/{$course}" method="GET">

        <div class="form-group">
          <label style="font-weight: bold;">Titulaciones</label>
          <select name="certification" id="certification" class="form-control">
            <option value="">Titulaciones</option>
            @foreach($arrayTitulaciones as $t)
              <option value="{{$t->id}}">{{$t->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label style="font-weight: bold;">Campus</label>
          <select name="campus" id="campus" class="form-control">
            <option value="">Campus</option>
            @foreach($arrayCampus as $c)
              <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label style="font-weight: bold;">Cursos</label>
          <select name="imparted" id="imparted" class="form-control">
            <option value="">Cursos</option>
            @foreach($arrayCursoAsignaturas as $c)
              <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
          </select>
        </div>

        <button class="btn-info btn-sm" type="submit">Aplicar</button>
          @if($filter != 0)
            <button class="btn-secondary btn-sm" type="submit" style="margin-left: 5px;">Quitar filtros</button>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  var subject_id = document.getElementById("subject").value;
  var teacher_id = "{{ auth()->user()->id }}";
  var course = "{{$course}}";
  var subObj_credT;
  var subObj_credS;
  var subObj_credP;

  $('#subject').on('change', function(e) {
    subject_id = e.target.value;

    $.ajax({
      url: "{{url('json-subject')}}",
      type:"GET", 
      data: {"id":subject_id}, 
      success: function(result){
        $("#code").text(result.code);
        $("#cT").text(result.cTheory);  
        $("#cP").text(result.cPractice);
        $("#cS").text(result.cSeminar);
        subObj_credT = result.cTheory;
        subObj_credS = result.cSeminar;
        subObj_credP = result.cPractice;
        $.ajax({
          url: "{{url('json-certification')}}",
          type:"GET", 
          data: {"id":result.certification_id}, 
          success: function(result){
            $("#cert").text(result.name);
          }
        });
        $.ajax({
          url: "{{url('json-area')}}",
          type:"GET", 
          data: {"id":result.area_id}, 
          success: function(result){
            $("#area").text(result.name);
          }
        });
        $.ajax({
          url: "{{url('json-campus')}}",
          type:"GET", 
          data: {"id":result.campus_id}, 
          success: function(result){
            $("#cam").text(result.name);
          }
        });
        $.ajax({
          url: "{{url('json-center')}}",
          type:"GET", 
          data: {"id":result.center_id}, 
          success: function(result){
            $("#center").text(result.name);
          }
        });
        $.ajax({
          url: "{{url('json-duration')}}",
          type:"GET", 
          data: {"id":result.duration_id}, 
          success: function(result){
            $("#duration").text(result.name);
          }
        });
        $.ajax({
          url: "{{url('json-imparted')}}",
          type:"GET", 
          data: {"id":result.imparted_id}, 
          success: function(result){
            $("#imp").text(result.name);
          }
        });
        $.ajax({
          url: "{{url('json-typeSubject')}}",
          type:"GET", 
          data: {"id":result.typeSubject_id}, 
          success: function(result){
            $("#typeSubject").text(result.name);
          }
        });
        $.ajax({
          url: "{{url('json-coordinator')}}",
          type:"GET", 
          data: {"id":result.coordinator_id}, 
          success: function(result){
            $("#coordinator").text(result.name);
          }
        });
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