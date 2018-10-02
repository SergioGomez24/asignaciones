@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Añadir profesor
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST">
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="name">Nombre</label>
               <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
               <label for="dni">DNI</label>
               <input type="text" name="dni" id="dni" class="form-control">
            </div>

            <div class="form-group">
               <label for="category">Categoría</label>
               <input type="text" name="category" id="category" class="form-control">
            </div>

            <div class="form-group">
               <label for="area">Área</label>
               <input type="text" name="area" id="area" class="form-control">
            </div>

            <div class="form-group">
               <label for="cInitial">Créditos iniciales</label>
               <input type="number" name="cInitial" id="cInitial" class="form-control">
            </div>

            <div class="form-group">
               <label for="dateCategory">Fecha inicio categoria</label>
               <input type="date" name="dateCategory" id="dateCategory" class="form-control">
            </div>

            <div class="form-group">
               <label for="dateUCA">Fecha inicio UCA</label>
               <input type="date" name="dateUCA" id="dateUCA" class="form-control">
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Añadir profesor
               </button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
@stop