@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Lista de titulaciones </h4>
        <a class="btn btn-primary btn-sm" href="{{ url('/settings/certifications/create') }}">Añadir titulación</a>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="font-weight: bold;">Titulación</td>
              <td align="right" style="font-weight: bold;">Editar</td>
              <td align="right" style="font-weight: bold;">Eliminar</td>
            </tr>
          </thead>
          <tbody> 
            @foreach( $arrayTitulaciones as $key => $titulacion )
              <tr>
                <td style="font-weight: bold;">{{$titulacion->name}}</td>

                <td align="right" ><a class="btn btn-secondary btn-sm" href="{{ url('/settings/certifications/edit/'.$titulacion->id) }}">Editar</a></td>

                <td align="right" ><form name="formBorrar" action="{{action('CertificationsController@deleteCertification', $titulacion->id)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                  <button class="btn btn-danger btn-sm" type="submit" onclick="return pregunta()">Borrar</button> 
                </form></td>
              </tr>
            @endforeach
          </tbody>
        </table>     	
		  </div>
      <div>
        <a class="btn btn-link btn-sm" href="{{ url('/settings') }}">Volver a ajustes</a>
      </div>
	  </div>
	</div>
</div>

<script language="JavaScript"> 
function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar esta titulación?');
    if(mensaje) {
       document.formBorrar.submit();
       return true; 
    } else {
      return false;
    }
} 
</script>
@stop