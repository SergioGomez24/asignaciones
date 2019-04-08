@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="text-center"> Añadir elección </h5>
            <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/settings/elections') }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
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

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary">
                  Añadir
               </button>
               <a class="btn btn-secondary" href="{{ url('/settings/elections') }}" role="button">Cancelar</a>
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