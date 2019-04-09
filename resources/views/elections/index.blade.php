@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Elecciones Curso {{$course}} </h4>
        <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/elections') }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
        @if($elecPermission == 1)
        <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/elections/pdf/'.$course) }}"><img src="{{ asset('img/descarga.png') }}" height="15" width="15"/></a></button>
        

        <button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="font-weight: bold; float: right;">Filtrar por</button>
        @endif
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <form href = "elections/index/{$course}" method="GET">
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
                      <option value="{{$p->id}}">{{$p->name}}</option>
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