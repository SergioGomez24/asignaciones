@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/teachers') }}">Profesores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Añadir Profesor</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="text-center" > Añadir Profesor </h5>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST">
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="name" style="font-weight: bold;">Nombre</label>
               <input type="text" name="name" id="name" class="form-control" placeholder="Nombre Apellidos" required>
            </div>

            <div class="form-group">
               <label for="dni" style="font-weight: bold;">DNI</label>
               <input type="text" name="dni" id="dni" class="form-control" placeholder="Ejemplo: 123A" required>
            </div>

            <div class="form-group">
               <label for="email" style="font-weight: bold;">Correo electrónico</label>
               <input type="email" name="email" id="email" class="form-control" placeholder="Ejemplo: correo@uca.es" required>
            </div>

            <div class="form-group">
               <label for="password" style="font-weight: bold;">Contraseña</label>
               <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña inicio sesion" required>
            </div>

            <div class="form-group">
               <label for="role" style="font-weight: bold;">Rol</label>
               <select name="role" id="role" class="form-control" required>
                  <option value="">Selecciona un rol</option>
                  <option value="Profesor">Profesor</option>
                  <option value="Director">Director</option>
               </select>
            </div>

            <div class="form-group">
               <label for="category_id" style="font-weight: bold;">Categoría</label>
               <select name="category_id" id="category_id" class="form-control" required>
                  <option value="">Selecciona una categoría</option>
                  @foreach($arrayCategorias as $categoria)
                  <option value="{{$categoria->id}}">{{$categoria->name}}</option>
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
               <label for="cInitial" style="font-weight: bold;">Créditos iniciales</label>
               <input type="number" name="cInitial" id="cInitial" class="form-control" placeholder="Ejemplo: 24" required>
            </div>

            <div class="form-group">
               <label for="dateCategory" style="font-weight: bold;">Fecha inicio categoria</label>
               <input type="date" name="dateCategory" id="dateCategory" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="dateUCA" style="font-weight: bold;">Fecha inicio UCA</label>
               <input type="date" name="dateUCA" id="dateUCA" class="form-control" required>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary">
                   Añadir
               </button>
               <a class="btn btn-secondary" href="{{ url('/teachers') }}" role="button">Cancelar</a>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
@stop