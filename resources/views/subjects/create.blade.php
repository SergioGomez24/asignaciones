@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            <h5> Añadir asignatura </h5>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST">
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="code">Código</label>
               <input type="text" name="code" id="code" class="form-control">
            </div>

            <div class="form-group">
               <label for="name">Nombre</label>
               <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
               <label for="certification">Titulación</label>
               <select name="certification" id="certification" class="form-control">
                  <option value="">Elige una titulación</option>
                  @foreach($arrayTitulaciones as $titulacion)
                  <option value="{{$titulacion->id}}">{{$titulacion->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="area">Área</label>
               <select name="area" id="area" class="form-control">
                  <option value="">Elige un area</option>
                  @foreach($arrayAreas as $area)
                  <option value="{{$area->id}}">{{$area->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="campus">Campus</label>
               <select name="campus" id="campus" class="form-control">
                  <option value="">Elige un campus</option>
                  @foreach($arrayCampus as $campus)
                  <option value="{{$campus->id}}">{{$campus->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="center">Centro</label>
               <select name="center" id="center" class="form-control">
                  <option value="">Elige un centro</option>
                  @foreach($arrayCentros as $centro)
                  <option value="{{$centro->id}}">{{$centro->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="cTheory">Creditos Teoria</label>
               <input type="number" name="cTheory" id="cTheory" class="form-control">
            </div>

            <div class="form-group">
               <label for="cSeminar">Creditos Seminario</label>
               <input type="number" name="cSeminar" id="cSeminar" class="form-control">
            </div>

            <div class="form-group">
               <label for="cPractice">Creditos Práctica</label>
               <input type="number" name="cPractice" id="cPractice" class="form-control">
            </div>

            <div class="form-group">
               <label for="duration">Duración</label>
               <select name="duration" id="duration" class="form-control">
                  <option>Primer semestre
                  <option>Segundo semestre
               </select>
            </div>

            <div class="form-group">
               <label for="imparted">Curso en la que se imparte</label>
               <select name="imparted" id="imparted" class="form-control">
                  <option>Primero
                  <option>Segundo
                  <option>Tercero
                  <option>Cuarto
               </select>
            </div>

            <div class="form-group">
               <label for="typeSubject">Tipo de asignatura</label>
               <select name="typeSubject" id="typeSubject" class="form-control">
                  <option>Obligatoria
                  <option>Optativa
               </select>
            </div>

            <div class="form-group">
               <label for="coordinator">Coordinador</label>
               <input type="text" name="coordinator" id="coordinator" class="form-control">
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