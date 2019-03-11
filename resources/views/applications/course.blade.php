@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Selecciones Curso {{$course}} </h4>
        <button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="font-weight: bold;">Filtrar por</button>
          <div class="collapse" id="collapseExample">
            <div class="card card-body">
              <form href = "applications/course/{$course}" method="GET">
                <div class="group row">

                  <div class="col-md-3">
                    <select name="subject_id" id="subject_id" class="form-control">
                      <option value="">Asignaturas</option>
                      @foreach($arrayAsignaturas as $a)
                        <option value="{{$a->id}}">{{$a->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-3">
                    <select name="teacher" id="teacher" class="form-control">
                      <option value="">Profesores</option>
                      @foreach($arrayProfesores as $p)
                        <option value="{{$p->name}}">{{$p->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <button class="btn-info btn-sm" type="submit">Aplicar</button>
                </div>
              </form>
            </div>
          </div>
      </div>

      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Asignatura</th>
              <th scope="col">Profesor</th>
              <th scope="col">Créditos Teoría</th>
              <th scope="col">Créditos Prácticas</th>
              <th scope="col">Créditos Seminarios</th>
              <th scope="col">Editar</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
          <tbody>
            @if (Auth()->user()->role == "Director")  
              @foreach( $arraySolicitudes as $key => $solicitud )
                <tr>
                  <td>{{$solicitud->name}}</td>
                  <td>{{$solicitud->teacher}}</td>
                  <td>{{$solicitud->cTheory}}</td>
                  <td>{{$solicitud->cPractice}}</td>
                  <td>{{$solicitud->cSeminar}}</td>
                  <td><a class="btn btn-secondary btn-sm" href="{{ url('/applications/edit/'.$solicitud->id) }}">Editar</a></td>
                  <td><form name="formBorrar" action="{{action('ApplicationsController@deleteApplication', $solicitud->id)}}" method="POST" style="display:inline">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <input class="btn btn-danger btn-sm" type="button" onclick="pregunta()" value="Borrar"/>
                  </form></td>
                </tr>
              @endforeach
              {!! $arraySolicitudes->render() !!}
            @else
              @foreach( $arraySolicitudesCoor as $key => $solicitud )
                <tr>
                  <td>{{$solicitud->name}}</td>
                  <td>{{$solicitud->teacher}}</td>
                  <td>{{$solicitud->cTheory}}</td>
                  <td>{{$solicitud->cPractice}}</td>
                  <td>{{$solicitud->cSeminar}}</td>
                  <td><a class="btn btn-secondary btn-sm" href="{{ url('/applications/edit/'.$solicitud->id) }}">Editar</a></td>
                  <td><form name="formBorrar" action="{{action('ApplicationsController@deleteApplication', $solicitud->id)}}" method="POST" style="display:inline">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <input class="btn btn-danger btn-sm" type="button" onclick="pregunta()" value="Borrar"/>
                  </form></td>
                </tr>
              @endforeach
              {!! $arraySolicitudesCoor->render() !!}
            @endif
          </tbody>
        </table>
      </div>
	  </div>
	</div>
</div>

<script language="JavaScript">

  function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar esta solicitud?');
    var enviar = false;

    if(mensaje) {
      document.formBorrar.submit();
      enviar = true; 
    }
    return enviar;
  }

</script>
@stop