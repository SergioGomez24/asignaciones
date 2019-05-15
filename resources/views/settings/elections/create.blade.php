@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/settings') }}">Ajustes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/settings/elections') }}">Elecciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Añadir Elección</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="text-center"> Añadir Elección </h5>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST" onsubmit="return validar()">
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="course" style="font-weight: bold;">Curso Acádemico</label>
               <select name="course" id="course" class="form-control" required>
                  <option value="">Selecciona un curso</option>
                  @foreach($arrayCursos as $curso)
                  <option value="{{$curso->name}}">{{$curso->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="threshold" style="font-weight: bold;">Umbral</label>
               <input type="number" name="threshold" id="threshold" class="form-control" placeholder="Umbral" required>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" id="btnAceptar">
                  Añadir
               </button>
               <a class="btn btn-secondary" href="{{ url('/settings/elections') }}" role="button" id="btnCancelar">Cancelar</a>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script language="JavaScript">
   var course = document.getElementById("course").value;

   var numElections;

   $('#course').on('change', function(e) {
      course = e.target.value;
      $.get('/asignaciones/public/json-election?course='+ course, function(data) {
         numElections = data.length;
      });
   });

   function validar(){
   
      if(numElections > 0){
         alert("Eleccion ya creada");
         return false;
      }else{
         return true;
      }
   }
</script>
@stop