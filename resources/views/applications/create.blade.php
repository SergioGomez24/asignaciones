@extends('layouts.master')

@section('content')
<div class="row" style="margin-top:40px">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h5> Selección de asignaturas </h5>
          </div>
          <div class="card-body" style="padding:30px">
            <form method="POST" onsubmit="return validacion()">
              {{ csrf_field() }}

         			<h5 class="text-center"> Profesor: {{ auth()->user()->name }} </h5>
              <h6 class="text-center"> Curso: {{$course->course}} </h6>

              <div class="form-group row">
                <div class="col-md-4">
                  <h6><label for="certification">Selecciona una Titulación</label></h6>
                  <select name="certification" id="certification" class="form-control" required>
                    <option value="">Elige una titulación</option>
                    @foreach($arrayTitulaciones as $t)
                      <option value="{{$t->id}}">{{$t->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <h6><label for="campus">Selecciona un campus</label></h6>
                  <select name="campus" id="campus" class="form-control" required>
                    <option value="">Elige un campus</option>
                    @foreach($arrayCampus as $c)
                      <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <h6><label for="imparted">Selecciona el curso en la que se imparte</label></h6>
                  <select name="imparted" id="imparted" class="form-control" required>
                    <option value="">Elige el curso en la que se imparte</option>
                      <option value="Primero">Primero</option>
                      <option value="Segundo">Segundo</option>
                  </select>
                </div>
              </div>

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
                  <h6>Area</h6>
                  <p id="area"></p>
                </div>

                <div class="col-md-3">
                  <h6>Duración</h6>
                  <p id="duration"></p>
                </div>

                <div class="col-md-3">
                  <h6>Tipo de Asignatura</h6>
                  <p id="typeSubject"></p>
                </div>

                <div class="col-md-3">
                  <h6>Coordinador</h6>
                  <p id="coordinator"></p>
                </div>
              </div>     

              <div class="form-group row">
                <div class="col-md-4">
                  <h6><label for="credT" >Creditos Teoria</label></h6>
                  <input type="number" name="credT" id="credT" class="form-control" step="0.01" placeholder="Introduce créditos"></input>
                </div>
                <div class="col-md-4">
                  <h6><label for="credP">Creditos Prácticas</label></h6>
                  <input type="number" name="credP" id="credP" class="form-control" step="0.01" placeholder="Introduce créditos"></input>
                </div>
                <div class="col-md-4">
                  <h6><label for="credS">Creditos Seminarios</label></h6>
                  <input type="number" name="credS" id="credS" class="form-control" step="0.01" placeholder="Introduce créditos"></input>
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
  function validacion(){
    var vCredT = document.getElementById("credT").value;
    var vCredP = document.getElementById("credP").value;
    var vCredS = document.getElementById("credS").value;

    if(vCredS == "" && vCredT == "" && vCredP == ""){
      alert("Introduce los créditos");
      return false;
    }else{
      return true;
    }
  }

  var certification_id = document.getElementById("certification").value;
  var campus_id = document.getElementById("campus").value;
  var imparted_name = document.getElementById("imparted").value;
  var subject_id = document.getElementById("subject").value;

  $('#certification').on('change', function(e) {
    console.log(e);
    certification_id = e.target.value;
    console.log(certification_id);
    $.get('/asignaciones/public/json-subjects?certification_id='+ certification_id + '&campus_id='+ campus_id + '&imparted='+ imparted_name, function(data) {
      console.log(data);
      $('#subject').empty();
      $('#subject').append('<option value="">Elige una asignatura</option>');

      $.each(data, function(index, subjectsObj) {
        $('#subject').append('<option value="'+ subjectsObj.id +'">'+ subjectsObj.name +'</option>');
      })
    });
  });

  $('#campus').on('change', function(e) {
    console.log(e);
    campus_id = e.target.value;
    $.get('/asignaciones/public/json-subjects?certification_id='+ certification_id + '&campus_id='+ campus_id + '&imparted='+ imparted_name, function(data) {
      console.log(data);
      $('#subject').empty();
      $('#subject').append('<option value="">Elige una asignatura</option>');

      $.each(data, function(index, subjectsObj) {
        $('#subject').append('<option value="'+ subjectsObj.id +'">'+ subjectsObj.name +'</option>');
      })
    });
  });

  $('#imparted').on('change', function(e) {
    console.log(e);
    imparted_name = e.target.value;
    $.get('/asignaciones/public/json-subjects?certification_id='+ certification_id + '&campus_id='+ campus_id + '&imparted='+ imparted_name, function(data) {
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
      $('#area').empty();
      $('#duration').empty();
      $('#typeSubject').empty();
      $('#coordinator').empty();
      $('#credT').empty();
      $.each(data, function(index, subjectObj) {
        $('#code').append('<p>'+ subjectObj.code +'</p>');
        $('#area').append('<p>'+ subjectObj.area_id +'</p>');
        $('#duration').append('<p>'+ subjectObj.duration +'</p>');
        $('#typeSubject').append('<p>'+ subjectObj.typeSubject +'</p>');
        $('#coordinator').append('<p>'+ subjectObj.coordinator +'</p>');
        $('#credT').append('<input placeholder="'+subjectObj.cTheory+'"></input>');
      })
    });
  });

</script>
@stop