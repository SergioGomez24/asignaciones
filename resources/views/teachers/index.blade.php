@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <div class="text-center">
          <h4> Lista de profesores </h4>
        </div>
        @if (Auth()->user()->role == 'Director')
          <a class="btn btn-primary btn-sm" href="{{ url('/teachers/create') }}">Añadir profesor</a>
        @endif
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="font-weight: bold;">Profesor</td>
              @if (Auth()->user()->role == 'Director')
              <td align="right" style="font-weight: bold;">Editar</td>
              <td align="right" style="font-weight: bold;">Eliminar</td>
              @endif
            </tr>
          </thead>
          <tbody> 
            @foreach( $arrayProfesores as $key => $profesor )
              <tr>
                <td><button class="btn btn-light btn-sm" type="button" data-toggle="modal" data-target="#showTeacher" data-whatever="{{$profesor->id}}" style="font-weight: bold;">{{$profesor->name}}</button>
                <div class="modal fade" id="showTeacher" tabindex="-1" role="dialog" aria-labelledby="showTeacherTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="showTeacherTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="group row">
                          <div class="col-md-3">
                            <p style="font-weight: bold;">Código</p>
                            <p id="code"></p> 
                          </div>
                          <div class="col-md-3">
                            <p style="font-weight: bold;">Titulación</p>
                            <p id="cert">  </p> 
                          </div>
                          <div class="col-md-3">
                            <p style="font-weight: bold;">Area</p>
                            <p id="area">  </p>  
                          </div>
                          <div class="col-md-3">
                            <p style="font-weight: bold;">Campus</p>
                            <p id="cam">  </p>
                          </div>
                          <div class="col-md-3" >
                            <p style="font-weight: bold;">Centro</p>
                            <p id="center">  </p>
                          </div>
                          <div class="col-md-3">
                            <p style="font-weight: bold;">Duración</p>
                            <p id="duration"> </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </td>

                @if (Auth()->user()->role == 'Director')
                  <td align="right"><a class="btn btn-secondary btn-sm" href="{{ url('/teachers/edit/'.$profesor->id) }}">Editar</a></td>

                  <td align="right"><form name="formBorrar" action="{{action('TeachersController@deleteTeacher', $profesor->id)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-sm" type="submit" onclick="return pregunta()">Borrar</button> 
                  </form></td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
	  </div>
	</div>
</div>

<script language="JavaScript"> 

  $('#showTeacher').on('show.bs.modal', function(e) {
    var button = $(e.relatedTarget)
    var teacher_id = button.data('whatever');

    console.log(teacher_id);
  });

  function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar este profesor?');

    if(mensaje) {
      document.formBorrar.submit();
      return true;
    }else{
      return false;
    }
    
  } 
</script>
@stop