@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Lista de areas </h4>
        <a class="btn btn-primary btn-sm" href="{{ url('/settings/areas/create') }}">Añadir area</a>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="font-weight: bold;">Area</td>
              <td align="right" style="font-weight: bold;">Editar</td>
              <td align="right" style="font-weight: bold;">Eliminar</td>
            </tr>
          </thead>
          <tbody> 
            @foreach( $arrayAreas as $key => $area )
              <tr>
                <td style="font-weight: bold;">{{$area->name}}</td>

                <td align="right" ><a class="btn btn-secondary btn-sm" href="{{ url('/settings/areas/edit/'.$area->id) }}">Editar</a></td>

                <td align="right" ><form name="formBorrar" action="{{action('AreasController@deleteArea', $area->id)}}" method="POST">
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
    var mensaje = confirm('¿Estas seguro de que quieres borrar esta area?');
    if(mensaje) {
       document.formBorrar.submit();
       return true; 
    } else {
      return false;
    }
} 
</script>
@stop