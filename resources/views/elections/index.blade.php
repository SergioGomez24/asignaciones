@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/elections') }}">Curso Elecciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Elecciones Curso {{$course}}</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Elecciones Curso {{$course}} </h4>
        @if($elecPermission == 1)
        <a href="{{ url('/elections/pdf/'.$course) }}" type="btn btn-light btn-sm" style="float: left;"><img src="{{ asset('img/descarga.png') }}" height="15" width="15"/></a>

        <button class="btn btn-light btn-sm" type="button" data-toggle="modal" data-target="#filters" style="font-weight: bold; float: right;">Filtrar por</button>

        @endif
      </div>
      <div class="card-body">
        @if($elecPermission == 1)
        <table class="table table-striped" id="miTabla">
          <thead>
            <tr>
              <th scope="col">Asignatura</th>
              <th scope="col">Profesor</th>
              <th scope="col" class="text-center">Créditos Teoría</th>
              <th scope="col" class="text-center">Créditos Prácticas</th>
              <th scope="col" class="text-center">Créditos Seminarios</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $arraySolicitudes as $key => $solicitud )
              <tr>
                <td>{{$solicitud->asig}}</td>
                <td>{{$solicitud->prof}}</td>
                <td class="text-center">{{$solicitud->cTheory}}</td>
                <td class="text-center">{{$solicitud->cPractice}}</td>
                <td class="text-center">{{$solicitud->cSeminar}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <h6>La elección seleccionada no está disponible</h6>
        @endif
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
        <form href = "elections/index/{$course}" method="GET">
          <div class="form-group">
            <label style="font-weight: bold;">Asignaturas</label>
            <select name="subject_id" id="subject_id" class="form-control">
            <option value="">Asignaturas</option>
              @foreach($arrayAsignaturas as $a)
                <option value="{{$a->id}}">{{$a->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label style="font-weight: bold;">Profesores</label>
            <select name="teacher_id" id="teacher_id" class="form-control">
              <option value="">Profesores</option>
              @foreach($arrayProfesores as $p)
                <option value="{{$p->id}}">{{$p->name}}</option>
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

<script language="JavaScript">

  $(document).ready(function() {
    initTableSorter();
  });
  
  function initTableSorter() {
  // call the tablesorter plugin
    $('table').tablesorter({
    // Sort on the second column, in ascending order
     // sortList: [[1,0]]
    });
  }

</script>
@stop