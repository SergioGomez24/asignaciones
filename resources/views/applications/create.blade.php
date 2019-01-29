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

         			<!--@foreach( $arrayAsignaturas as $asignatura )
                <h5> {{$asignatura->name}} </h5>
                  <div class="form-group row">
                    <div class="col-md-2">
                      <h6>Titulación</h6>
                      <p>{{$asignatura->certification}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Area</h6>
                      <p>{{$asignatura->area}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Campus</h6>
                      <p>{{$asignatura->campus}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Centro</h6>
                      <p>{{$asignatura->center}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Curso</h6>
                      <p>{{$asignatura->imparted}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Duración</h6>
                      <p>{{$asignatura->duration}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Tipo de asignatura</h6>
                      <p>{{$asignatura->typeSubject}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Coordinador</h6>
                      <p>{{$asignatura->coordinator}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6><label for="credT" >Creditos Teoria</label></h6>
                      <input type="number" name="credT" id="credT" class="form-control" placeholder="1-3 créditos">
                    </div>
                    <div class="col-md-2">
                      <h6><label for="credP">Creditos Prácticas</label></h6>
                      <input type="number" name="credP" id="credP" class="form-control" placeholder="1-3 créditos">
                    </div>
                    <div class="col-md-2">
                      <h6><label for="credS">Creditos Seminarios</label></h6>
                      <input type="number" name="credS" id="credS" class="form-control" placeholder="1-3 créditos">
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary" style="margin-top:35px;">elegir
                      </button>
                    </div>
                  </div>
              @endforeach-->
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

              <div class="col-md-2">
                <h6>Coordinador</h6>
                <p>{{$asignatura->coordinator}}</p>
              </div>

              <div class="form-group row">
                <div class="col-md-4">
                  <h6><label for="credT" >Creditos Teoria</label></h6>
                  <input type="number" name="credT" id="credT" class="form-control" placeholder="0-{{$asignatura->cTheory}} créditos">
                </div>
                <div class="col-md-4">
                  <h6><label for="credP">Creditos Prácticas</label></h6>
                  <input type="number" name="credP" id="credP" class="form-control" placeholder="0-{{$asignatura->cPractice}} créditos">
                </div>
                <div class="col-md-4">
                  <h6><label for="credS">Creditos Seminarios</label></h6>
                  <input type="number" name="credS" id="credS" class="form-control" placeholder="0-{{$asignatura->cSeminar}} créditos">
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

  $('#certification').on('change', function(e) {
    console.log(e);
    certification_id = e.target.value;
    console.log(imparted_name);
    console.log(campus_id);
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
    console.log(imparted_name);
    console.log(campus_id);
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

  $('#imparted').on('change', function(a) {
    console.log(a);
    imparted_name = a.target.value;
    console.log(imparted_name);
    console.log(campus_id);
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

</script>
@stop