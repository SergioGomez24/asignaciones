@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/settings') }}">Ajustes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Duraciones</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Lista de duraciones </h4>
        <a class="btn btn-primary btn-sm" href="{{ url('/settings/duration/create') }}" style="float: right;"><i class="fas fa-plus"></i> Añadir duración</a>
      </div>
      <div class="card-body">	
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="font-weight: bold;">Duración</td>
              <td align="right" style="font-weight: bold;">Editar</td>
              <td align="right" style="font-weight: bold;">Eliminar</td>
            </tr>
          </thead>
          <tbody> 
            @foreach( $arrayDuraciones as $key => $duracion )
              <tr>
                <td style="font-weight: bold;">{{$duracion->name}}</td>

                <td align="right" ><a class="btn btn-secondary btn-sm" href="{{ url('/settings/duration/edit/'.$duracion->id) }}"><i class="fas fa-edit"></i> Editar</a></td>

                <td align="right" ><form name="formBorrar" action="{{action('DurationsController@deleteDuration', $duracion->id)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                  <button class="btn btn-danger btn-sm" type="submit" onclick="return pregunta()"><i class="fas fa-trash"></i> Borrar</button> 
                </form></td>
              </tr>
            @endforeach
          </tbody>
        </table>      
		  </div>
	  </div>
	</div>
</div>

<script language="JavaScript"> 
  $(document).ready(initTableSorter);
  
  function initTableSorter() {
  // call the tablesorter plugin
    $('table').tablesorter({
    // Sort on the second column, in ascending order
      sortList: [[1,0]]
    });
  }

  function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar esta duración?');
    if(mensaje) {
       document.formBorrar.submit();
       return true; 
    } else {
      return false;
    }
  } 
</script>
@stop