@extends('layouts.master')

@section('content')
<div class="row" style="margin-top:40px">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center"> Selección de asignaturas </h4>
            <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/') }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
            
            <button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="font-weight: bold;float: right;">Filtrar por</button>

            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                  <div class="group row">
                    <div class="col-md-3">
                      <select name="certification" id="certification" class="form-control">
                        <option value="">Titulaciones</option>
                        @foreach($arrayTitulaciones as $t)
                          <option value="{{$t->id}}">{{$t->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-3">
                      <select name="campus" id="campus" class="form-control">
                        <option value="">Campus</option>
                        @foreach($arrayCampus as $c)
                          <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-3">
                      <select name="imparted" id="imparted" class="form-control">
                        <option value="">Cursos</option>
                        @foreach($arrayCursoAsignaturas as $c)
                          <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <button class="btn-primary btn-sm" id="filters" type="button">Aplicar</button>

                  </div>
              </div>
            </div>
          </div>
          <div class="card-body" style="padding:30px">
            <form method="POST" onsubmit="return validacion()">
              {{ csrf_field() }}

         			<h5 class="text-center" id="teacher">Profesor: {{ auth()->user()->name }}</h5>
              <h6 class="text-center" id="course"> Curso: {{$course}} </h6>
              <h6 class="text-right" id="cAvailable"> Créditos Disponibles: {{$cAvailable}} </h6>

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
              <a class="btn btn-primary btn-sm" href="{{ url('/') }}" style="float: right;">finalizar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  var certification_id = document.getElementById("certification").value;
  var campus_id = document.getElementById("campus").value;
  var imparted_id = document.getElementById("imparted").value;
  var subject_id = document.getElementById("subject").value;
  var teacher = "{{ auth()->user()->name }}";
  var course = "{{$course}}";
  var subObj_credT;
  var subObj_credS;
  var subObj_credP;
  var numAplication;

  $('#certification').on('change', function(e) {
    certification_id = e.target.value;
    console.log(certification_id);
  });

  $('#campus').on('change', function(e) {
    campus_id = e.target.value;
    console.log(campus_id);
  });

  $('#imparted').on('change', function(e) {
    imparted_id = e.target.value;
    console.log(imparted_id);
  });

  $('#filters').on('click', function(e) {
    $.get('/asignaciones/public/json-subjects?certification_id='+ certification_id + '&campus_id='+ campus_id + '&imparted_id='+ imparted_id, function(data) {
      console.log(data);
      $('#subject').empty();
      $('#subject').append('<option value="">Elige una asignatura</option>');

      $.each(data, function(index, subjectsObj) {
        $('#subject').append('<option value="'+ subjectsObj.id +'">'+ subjectsObj.name +'</option>');
      })
    });
  });

  $('#subject').on('change', function(e) {
    subject_id = e.target.value;
    $.get('/asignaciones/public/json-subject?id='+ subject_id, function(data) {
      $('#code').empty();
      $('#coordinator').empty();
      $('#cT').empty();
      $('#cP').empty();
      $('#cS').empty();
      $.each(data, function(index, subjectObj) {
        $('#code').append('<p>'+ subjectObj.code +'</p>');
        $('#coordinator').append('<p>'+ subjectObj.coordinator +'</p>');
        $('#cT').append('<p>'+subjectObj.cTheory+'</p>');
        $('#cP').append('<p>'+subjectObj.cPractice+'</p>');
        $('#cS').append('<p>'+subjectObj.cSeminar+'</p>');
        subObj_credT = subjectObj.cTheory;
        subObj_credP = subjectObj.cPractice;
        subObj_credS = subjectObj.cSeminar;
        $.get('/asignaciones/public/json-certification?id='+ subjectObj.certification_id, function(d) {
          $('#cert').empty();
          $.each(d, function(index, certificationObj) {
            $('#cert').append('<p>'+ certificationObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-area?id='+ subjectObj.area_id, function(d) {
          $('#area').empty();
          $.each(d, function(index, areaObj) {
            $('#area').append('<p>'+ areaObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-campus?id='+ subjectObj.campus_id, function(d) {
          $('#cam').empty();
          $.each(d, function(index, campusObj) {
            $('#cam').append('<p>'+ campusObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-center?id='+ subjectObj.center_id, function(d) {
          $('#center').empty();
          $.each(d, function(index, centerObj) {
            $('#center').append('<p>'+ centerObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-duration?id='+ subjectObj.duration_id, function(da) {
          $('#duration').empty();
          $.each(da, function(index, durationObj) {
            $('#duration').append('<p>'+ durationObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-imparted?id='+ subjectObj.imparted_id, function(da) {
          $('#imp').empty();
          $.each(da, function(index, impartedObj) {
            $('#imp').append('<p>'+ impartedObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-typeSubject?id='+ subjectObj.typeSubject_id, function(dat) {
          $('#typeSubject').empty();
          $.each(dat, function(index, typeSubjectObj) {
            $('#typeSubject').append('<p>'+ typeSubjectObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-solicitude?subject_id='+ subject_id + '&teacher='+ teacher + '&course='+ course, function(d) {
            numAplication = d.length;
        });
      })
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
    }else if(vCredT > subObj_credT || vCredP > subObj_credP || vCredS > subObj_credS) {
      alert("Créditos introducidos no validos");
    }else if(numAplication > "0") {
      alert("Asignatura ya elegida");
    }else if(cAvailable < 0) {
      alert("Créditos disponibles insuficientes");
    }else {
      enviar = true;
    }
    return enviar;
  }
</script>
@stop