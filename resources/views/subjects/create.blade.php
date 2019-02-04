@extends('layouts.master')
@section('content')
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

<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header">
            <div style="float: left; margin-left: 170px;">
               <h5 > Añadir asignatura </h5>
            </div>
            <div id="btnCabecera">
               <a class="btn btn-primary btn-sm" href="{{ url('/subjects') }}">Volver al listado</a>
            </div>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST" onsubmit="return validar()">
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="code">Código</label>
               <input type="text" name="code" id="code" class="form-control" placeholder="Ejemplo:111" required>
            </div>

            <div class="form-group">
               <label for="name">Nombre</label>
               <input type="text" name="name" id="name" class="form-control" placeholder="Nombre Apellidos" required>
            </div>

            <div class="form-group">
               <label for="certification_id">Titulación</label>
               <select name="certification_id" id="certification_id" class="form-control" required>
                  <option value="">Selecciona una titulación</option>
                  @foreach($arrayTitulaciones as $titulacion)
                  <option value="{{$titulacion->id}}">{{$titulacion->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="area_id">Área</label>
               <select name="area_id" id="area_id" class="form-control" required>
                  <option value="">Selecciona un area</option>
                  @foreach($arrayAreas as $area)
                  <option value="{{$area->id}}">{{$area->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="campus_id">Campus</label>
               <select name="campus_id" id="campus_id" class="form-control" required>
                  <option value="">Selecciona un campus</option>
                  @foreach($arrayCampus as $campus)
                  <option value="{{$campus->id}}">{{$campus->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="center_id">Centro</label>
               <select name="center_id" id="center_id" class="form-control" required>
                  <option value="">Selecciona un centro</option>
                  @foreach($arrayCentros as $centro)
                  <option value="{{$centro->id}}">{{$centro->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="cTheory">Creditos Teoria</label>
               <input type="number" name="cTheory" id="cTheory" class="form-control" placeholder="Ejemplo:2">
            </div>

            <div class="form-group">
               <label for="cSeminar">Creditos Seminario</label>
               <input type="number" name="cSeminar" id="cSeminar" class="form-control" placeholder="Ejemplo:2">
            </div>

            <div class="form-group">
               <label for="cPractice">Creditos Práctica</label>
               <input type="number" name="cPractice" id="cPractice" class="form-control" placeholder="Ejemplo:2">
            </div>

            <div class="form-group">
               <label for="duration_id">Duración</label>
               <select name="duration_id" id="duration_id" class="form-control">
                  <option value="">Selecciona la duración de la asignatura</option>
                  @foreach($arrayDuracionAsignaturas as $duracionA)
                  <option value="{{$duracionA->id}}">{{$duracionA->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="imparted_id">Curso en la que se imparte</label>
               <select name="imparted_id" id="imparted_id" class="form-control">
                  <option value="">Selecciona el curso en la que se imparte</option>
                  @foreach($arrayCursoAsignaturas as $cursoA)
                  <option value="{{$cursoA->id}}">{{$cursoA->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="typeSubject_id">Tipo de asignatura</label>
               <select name="typeSubject_id" id="typeSubject_id" class="form-control">
                  <option value="">Selecciona el tipo de la asignatura</option>
                  @foreach($arrayTipoAsignaturas as $tipoA)
                  <option value="{{$tipoA->id}}">{{$tipoA->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="coordinator">Coordinador</label>
               <input type="text" name="coordinator" id="coordinator" class="form-control" placeholder="Nombre Apellidos" required>
            </div>


            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Añadir asignatura
               </button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
@stop