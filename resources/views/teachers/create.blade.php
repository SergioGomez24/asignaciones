@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header">
            <div style="float: left; margin-left: 170px;">
               <h5 > Añadir profesor </h5>
            </div>
            <div id="btnCabecera">
               <a class="btn btn-primary btn-sm" href="{{ url('/teachers') }}">Volver al listado</a>
            </div>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST">
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="name">Nombre</label>
               <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="dni">DNI</label>
               <input type="text" name="dni" id="dni" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="email">Correo electrónico</label>
               <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="password">Contraseña</label>
               <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="role">Rol</label>
               <select name="role" id="role" class="form-control" required>
                  <option value="">Elige un rol</option>
                  <option value="Profesor">Profesor</option>
                  <option value="Director">Director</option>
               </select>
            </div>

            <div class="form-group">
               <label for="category_id">Categoría</label>
               <select name="category_id" id="category_id" class="form-control" required>
                  <option value="">Elige una categoría</option>
                  @foreach($arrayCategorias as $categoria)
                  <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="area_id">Área</label>
               <select name="area_id" id="area_id" class="form-control" required>
                  <option value="">Elige un area</option>
                  @foreach($arrayAreas as $area)
                  <option value="{{$area->id}}">{{$area->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="cInitial">Créditos iniciales</label>
               <select name="cInitial" id="cInitial" class="form-control" required>
                  <option>10</option>
               </select>
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