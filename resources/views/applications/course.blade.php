@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div id="titlistado">
          <h5 > Selecciones Curso {{$course}} </h5>
        </div>
      </div>
      <div class="card-body">
        <p><button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Filtros</button></p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <div class="group row">
              <div class="col-md-4">
                <h6><label for="subject">Selecciona una Asignatura</label></h6>
                <select name="subject" id="subject" class="form-control">
                  <option value="">Elige una asignatura</option>
                  @foreach($arrayAsignaturas as $a)
                    <option value="{{$a->id}}">{{$a->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-4">
                <h6><label for="teacher">Selecciona un Profesor</label></h6>
                <select name="teacher" id="teacher" class="form-control">
                  <option value="">Elige un profesor</option>
                  @foreach($arrayProfesores as $p)
                    <option value="{{$p->name}}">{{$p->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-4">
                <button class="btn-info btn-sm" type="button" id="filters" style="margin-top: 40px;">Aplicar</button>
              </div>
            </div>
          </div>
        </div>

        <div class="group row" style="margin-top: 10px;">
          <div class="col-md-2">
            <h5 style="color: #000000;">Asignatura</h5>
          </div>

          <div class="col-md-2">
            <h5 style="color: #000000;">Profesor</h5>
          </div>

          <div class="col-md-2">
            <h5 style="color: #000000;">Créditos Teoría</h5>
          </div>

          <div class="col-md-2">
            <h5 style="color: #000000;">Créditos Prácticas</h5>
          </div>

          <div class="col-md-2">
            <h5 style="color: #000000;">Créditos Seminario</h5>
          </div>
        </div>
        @if (Auth()->user()->role == "Director")	
		      @foreach( $arraySolicitudes as $key => $solicitud )
		      <div class="group row">
            <div class="col-md-2">
			       <h6 id="nameSol" style="color: #000000;">{{$solicitud->name}}</h6>
            </div>

            <div class="col-md-2">
              <h6 id="teacherSol" style="color: #000000;">{{$solicitud->teacher}}</h6>
            </div>

            <div class="col-md-2">
              <h6 id="cTSol" style="color: #000000;">{{$solicitud->cTheory}}</h6>
            </div>

            <div class="col-md-2">
              <h6 id="cPSol" style="color: #000000;">{{$solicitud->cPractice}}</h6>
            </div>

            <div class="col-md-2">
              <h6 id="cSSol" style="color: #000000;">{{$solicitud->cSeminar}}</h6>
            </div>

            <div class="col-md-1">
              <a class="btn btn-secondary btn-sm" href="{{ url('/applications/edit/'.$solicitud->id) }}">Editar</a>
            </div>

            <div class="col-md-1">
              <form name="formBorrar" action="{{action('ApplicationsController@deleteApplication', $solicitud->id)}}" method="POST" style="display:inline">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <input class="btn btn-danger btn-sm" type="submit" onclick="pregunta()" value="Borrar"/>
              </form>
            </div>
		      </div>
		      </br><hr />
		      @endforeach
        @else
          @foreach( $arraySolicitudesCoor as $key => $solicitud )
            <div class="group row">
              <div class="col-md-2">
                <h6 style="color: #000000;">{{$solicitud->name}}</h6>
              </div>

              <div class="col-md-2">
                <h6 style="color: #000000;">{{$solicitud->teacher}}</h6>
              </div>

              <div class="col-md-2">
                <h6 style="color: #000000;">{{$solicitud->cTheory}}</h6>
              </div>

              <div class="col-md-2">
                <h6 style="color: #000000;">{{$solicitud->cPractice}}</h6>
              </div>

              <div class="col-md-2">
                <h6 style="color: #000000;">{{$solicitud->cSeminar}}</h6>
              </div>

              <div class="col-md-1">
                <a class="btn btn-secondary btn-sm" href="{{ url('/applications/edit/'.$solicitud->id) }}">Editar</a>
              </div>

              <div class="col-md-1">
                <form name="formBorrar" action="{{action('ApplicationsController@deleteApplication', $solicitud->id)}}" method="POST" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <input class="btn btn-danger btn-sm" type="submit" onclick="pregunta()" value="Borrar"/>
                </form>
              </div>
            </div>
            </br><hr />
          @endforeach
        @endif
      </div>
	  </div>
	</div>
</div>

<script language="JavaScript">

  var subject_id = document.getElementById("subject").value;
  var teacher = document.getElementById("teacher").value;
  var course = "{{$course}}";


  $('#subject').on('change', function(e) {
    subject_id = e.target.value;
    console.log(subject_id);
  });

  $('#teacher').on('change', function(e) {
    teacher = e.target.value;
    console.log(teacher);
  });

  $('#filters').on('click', function(e) {
   
  });



  function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar esta solicitud?');
    if(mensaje) {
      document.formBorrar.submit();
      return true; 
    } else {
      return false;
    }
  }



</script>
@stop