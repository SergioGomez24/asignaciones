@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/subjects') }}">Asignaturas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Añadir Asignatura</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="text-center"> Añadir Asignatura </h5>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST" onsubmit="return validar()">
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="code" style="font-weight: bold;">Código</label>
               <input type="text" name="code" id="code" class="form-control" placeholder="Código" pattern="[0-9]+" title="Caracteres numericos" required>
            </div>

            <div class="form-group">
               <label for="name" style="font-weight: bold;">Nombre</label>
               <input type="text" name="name" id="name" class="form-control" placeholder="Nombre asignatura" pattern="[A-Za-z ]+" title="Caracteres" required>
            </div>

            <div class="form-group">
               <label for="certification_id" style="font-weight: bold;">Titulación</label>
               <select name="certification_id" id="certification_id" class="form-control" required>
                  <option value="">Selecciona una titulación</option>
                  @foreach($arrayTitulaciones as $titulacion)
                  <option value="{{$titulacion->id}}">{{$titulacion->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="area_id" style="font-weight: bold;">Área</label>
               <select name="area_id" id="area_id" class="form-control" required>
                  <option value="">Selecciona un area</option>
                  @foreach($arrayAreas as $area)
                  <option value="{{$area->id}}">{{$area->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="campus_id" style="font-weight: bold;">Campus</label>
               <select name="campus_id" id="campus_id" class="form-control" required>
                  <option value="">Selecciona un campus</option>
                  @foreach($arrayCampus as $campus)
                  <option value="{{$campus->id}}">{{$campus->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="center_id" style="font-weight: bold;">Centro</label>
               <select name="center_id" id="center_id" class="form-control" required>
                  <option value="">Selecciona un centro</option>
                  @foreach($arrayCentros as $centro)
                  <option value="{{$centro->id}}">{{$centro->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="cTheory" style="font-weight: bold;">Créditos Teoria</label>
               <input type="number" name="cTheory" id="cTheory" class="form-control" placeholder="Ejemplo: 2">
            </div>

            <div class="form-group">
               <label for="cSeminar" style="font-weight: bold;">Créditos Seminario</label>
               <input type="number" name="cSeminar" id="cSeminar" class="form-control" placeholder="Ejemplo: 2">
            </div>

            <div class="form-group">
               <label for="cPractice" style="font-weight: bold;">Créditos Práctica</label>
               <input type="number" name="cPractice" id="cPractice" class="form-control" placeholder="Ejemplo: 2">
            </div>

            <div class="form-group">
               <label for="duration_id" style="font-weight: bold;">Duración</label>
               <select name="duration_id" id="duration_id" class="form-control" required>
                  <option value="">Selecciona la duración de la asignatura</option>
                  @foreach($arrayDuracionAsignaturas as $duracionA)
                  <option value="{{$duracionA->id}}">{{$duracionA->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="imparted_id" style="font-weight: bold;">Curso en la que se imparte</label>
               <select name="imparted_id" id="imparted_id" class="form-control" required>
                  <option value="">Selecciona el curso en la que se imparte</option>
                  @foreach($arrayCursoAsignaturas as $cursoA)
                  <option value="{{$cursoA->id}}">{{$cursoA->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="typeSubject_id" style="font-weight: bold;">Tipo de asignatura</label>
               <select name="typeSubject_id" id="typeSubject_id" class="form-control" required>
                  <option value="">Selecciona el tipo de la asignatura</option>
                  @foreach($arrayTipoAsignaturas as $tipoA)
                  <option value="{{$tipoA->id}}">{{$tipoA->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group" style="font-weight: bold;">
               <label for="coordinator_id">Coordinador</label>
               <select name="coordinator_id" id="coordinator_id" class="form-control" required>
                  <option value="">Selecciona el coordinador</option>
                  @foreach($arrayProfesores as $profesor)
                  <option value="{{$profesor->id}}">{{$profesor->name}}</option>
                  @endforeach
               </select>
            </div>


            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" id="btnAceptar">
                   Añadir
               </button>
               <a class="btn btn-secondary" href="{{ url('/subjects') }}" role="button" id="btnCancelar">Cancelar</a>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script language="JavaScript">

  var codigo = document.getElementById("code").value;
  var nombre = document.getElementById("name").value;

  var numCode;
  var numName;

  $('#code').on('change', function(e) {
    codigo = e.target.value;
    $.ajax({
      url: "{{url('json-subjectCode')}}",
      type:"GET", 
      data: {"code":codigo}, 
      success: function(result){
        numCode = result.cont;
      }
    });
  });

  $('#name').on('change', function(e) {
    nombre = e.target.value;
    $.ajax({
      url: "{{url('json-subjectName')}}",
      type:"GET", 
      data: {"name":nombre}, 
      success: function(result){
        numName = result.cont;
      }
    });
  });

  function validar(){
    var vCredT = document.getElementById("cTheory").value;
    var vCredP = document.getElementById("cPractice").value;
    var vCredS = document.getElementById("cSeminar").value;
    var enviar = false;

    if(vCredS == "" && vCredT == "" && vCredP == ""){
      alert("Introduce los créditos");
    }else if(numCode > 0){
      alert("El código introducido ya existe");
    }else if(numName > 0){
      alert("El nombre de la asignatura introducido ya existe");
    }else{
      enviar = true;
    }
    return enviar;
  }
</script>
@stop