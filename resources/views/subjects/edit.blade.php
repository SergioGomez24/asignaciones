@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/subjects') }}">Asignaturas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar Asignatura</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="text-center"> Editar Asignatura </h5>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST" onsubmit="return validar()">
         		{{ method_field('PUT') }}
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="code" style="font-weight: bold;">Código</label>
               <input type="text" name="code" id="code" value="{{$asignatura->code}}" class="form-control" pattern="[0-9]+" title="Caracteres numericos" required>
            </div>

            <div class="form-group">
               <label for="name" style="font-weight: bold;">Nombre</label>
               <input type="text" name="name" id="name" value="{{$asignatura->name}}" class="form-control" pattern="[A-Za-z]+" title="Caracteres" required>
            </div>

            <div class="form-group">
               <label for="certification_id" style="font-weight: bold;">Titulación</label>
               <select name="certification_id" id="certification_id" class="form-control" required>
                  <option value="{{$asignatura->certification_id}}">{{$certification->name}}</option>
                  @foreach($arrayTitulaciones as $titulacion)
                  <option value="{{$titulacion->id}}">{{$titulacion->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="area_id" style="font-weight: bold;">Área</label>
               <select name="area_id" id="area_id" class="form-control" required>
                  <option value="{{$asignatura->area_id}}">{{$area->name}}</option>
                  @foreach($arrayAreas as $area)
                  <option value="{{$area->id}}">{{$area->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="campus_id" style="font-weight: bold;">Campus</label>
               <select name="campus_id" id="campus_id" class="form-control" required>
                  <option value="{{$asignatura->campus_id}}">{{$campus->name}}</option>
                  @foreach($arrayCampus as $campus)
                  <option value="{{$campus->id}}">{{$campus->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="center_id" style="font-weight: bold;">Centro</label>
               <select name="center_id" id="center_id" class="form-control" required>
                  <option value="{{$asignatura->center_id}}">{{$center->name}}</option>
                  @foreach($arrayCentros as $centro)
                  <option value="{{$centro->id}}">{{$centro->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="cTheory" style="font-weight: bold;">Créditos Teoria</label>
               <input type="number" name="cTheory" id="cTheory" value="{{$asignatura->cTheory}}" class="form-control">
            </div>

            <div class="form-group">
               <label for="cPractice" style="font-weight: bold;">Créditos Práctica</label>
               <input type="number" name="cPractice" id="cPractice" value="{{$asignatura->cPractice}}" class="form-control">
            </div>

            <div class="form-group">
               <label for="cSeminar" style="font-weight: bold;">Créditos Seminario</label>
               <input type="number" name="cSeminar" id="cSeminar" value="{{$asignatura->cSeminar}}" class="form-control">
            </div>

            <div class="form-group">
               <label for="duration_id" style="font-weight: bold;">Duración</label>
               <select name="duration_id" id="duration_id" class="form-control" required>
                  <option value="{{$asignatura->duration_id}}">{{$duration->name}}</option>
                  @foreach($arrayDuracionAsignaturas as $duracionA)
                  <option value="{{$duracionA->id}}">{{$duracionA->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="imparted_id" style="font-weight: bold;">Curso en la que se imparte</label>
               <select name="imparted_id" id="imparted_id" class="form-control" required>
                  <option value="{{$asignatura->imparted_id}}">{{$imparted->name}}</option>
                  @foreach($arrayCursoAsignaturas as $cursoA)
                  <option value="{{$cursoA->id}}">{{$cursoA->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="typeSubject_id" style="font-weight: bold;">Tipo de asignatura</label>
               <select name="typeSubject_id" id="typeSubject_id" class="form-control" required>
                  <option value="{{$asignatura->typeSubject_id}}">{{$typeSubject->name}}</option>
                  @foreach($arrayTipoAsignaturas as $tipoA)
                  <option value="{{$tipoA->id}}">{{$tipoA->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="coordinator_id" style="font-weight: bold;">Coordinador</label>
               <select name="coordinator_id" id="coordinator_id" class="form-control" required>
                  <option value="{{$asignatura->coordinator_id}}">{{$teacher->name}}</option>
                  @foreach($arrayProfesores as $profesor)
                  <option value="{{$profesor->id}}">{{$profesor->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" id="btnAceptar">
                  Editar
               </button>
               <a class="btn btn-secondary" href="{{ url('/subjects') }}" role="button" id="btnCancelar">Cancelar</a>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script language="JavaScript"> 
  function validar(){
    var vCredT = document.getElementById("cTheory").value;
    var vCredP = document.getElementById("cPractice").value;
    var vCredS = document.getElementById("cSeminar").value;

    if(vCredS == "" && vCredT == "" && vCredP == ""){
      alert("Introduce los créditos");
      return false;
    }else{
      return true;
    }
  }
</script>
@stop