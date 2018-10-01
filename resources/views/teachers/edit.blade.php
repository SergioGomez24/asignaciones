@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Modificar profesor
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST">
         		{{ method_field('PUT') }}
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="code">Código</label>
               <input type="text" name="code" id="code" value={{$asignatura->code}} class="form-control">
            </div>

            <div class="form-group">
               <label for="name">Nombre</label>
               <input type="text" name="name" id="name" value={{$asignatura->name}} class="form-control">
            </div>

            <div class="form-group">
               <label for="certification">Titulación</label>
               <input type="text" name="certification" id="certification" value = {{$asignatura->certification}} class="form-control">
            </div>

            <div class="form-group">
               <label for="area">Área</label>
               <input type="text" name="area" id="area" value={{$asignatura->area}} class="form-control">
            </div>

            <div class="form-group">
               <label for="campus">Campus</label>
               <input type="text" name="campus" id="campus" value={{$asignatura->campus}} class="form-control">
            </div>

            <div class="form-group">
               <label for="center">Centro</label>
               <input type="text" name="center" id="center" value={{$asignatura->center}} class="form-control">
            </div>

            <div class="form-group">
               <label for="cTheory">Creditos Teoria</label>
               <input type="number" name="cTheory" id="cTheory" value={{$asignatura->cTheory}} class="form-control">
            </div>

            <div class="form-group">
               <label for="cSeminar">Creditos Seminario</label>
               <input type="number" name="cSeminar" id="cSeminar" value={{$asignatura->cSeminar}} class="form-control">
            </div>

            <div class="form-group">
               <label for="cPractice">Creditos Práctica</label>
               <input type="number" name="cPractice" id="cPractice" value={{$asignatura->cPractice}} class="form-control">
            </div>

            <div class="form-group">
               <label for="duration">Duración</label>
               <input type="text" name="duration" id="duration" value={{$asignatura->duration}} class="form-control">
            </div>

            <div class="form-group">
               <label for="imparted">Curso en la que se imparte</label>
               <input type="text" name="imparted" id="imparted" value={{$asignatura->imparted}} class="form-control">
            </div>

            <div class="form-group">
               <label for="typeSubject">Tipo de asignatura</label>
               <input type="text" name="typeSubject" id="typeSubject" value={{$asignatura->typeSubject}} class="form-control">
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Modificar profesor
               </button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
@stop