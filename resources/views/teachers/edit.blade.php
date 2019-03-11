@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            <h5 > Modificar profesor </h5>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST">
         		{{ method_field('PUT') }}
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="name" style="font-weight: bold;">Nombre Apellidos</label>
               <input type="text" name="name" id="name" value="{{$profesor->name}}" class="form-control">
            </div>

            <div class="form-group">
               <label for="dni" style="font-weight: bold;">DNI</label>
               <input type="text" name="dni" id="dni" value="{{$profesor->dni}}" class="form-control">
            </div>

            <div class="form-group">
               <label for="email" style="font-weight: bold;">Correo electrónico</label>
               <input type="email" name="email" id="email" value="{{$usuario->email}}" class="form-control">
            </div>

            <div class="form-group">
               <label for="role" style="font-weight: bold;">Rol</label>
               <select name="role" id="role" class="form-control" required>
                  <option value="{{$usuario->role}}">{{$usuario->role}}</option>
                  <option value="Profesor">Profesor</option>
                  <option value="Director">Director</option>
               </select>
            </div>

            <div class="form-group">
               <label for="category_id" style="font-weight: bold;">Categoría</label>
               <select name="category_id" id="category_id" class="form-control" required>
                  <option value="{{$profesor->category_id}}">{{$categoria->name}}</option>
                  @foreach($arrayCategorias as $categoria)
                  <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="area_id" style="font-weight: bold;">Área</label>
               <select name="area_id" id="area_id" class="form-control" required>
                  <option value="{{$profesor->area_id}}">{{$area->name}}</option>
                  @foreach($arrayAreas as $area)
                  <option value="{{$area->id}}">{{$area->name}}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="cInitial" style="font-weight: bold;">Créditos iniciales</label>
               <input type="number" name="cInitial" id="cInitial" value="{{$profesor->cInitial}}" class="form-control">
            </div>

            <div class="form-group">
               <label for="dateCategory" style="font-weight: bold;">Fecha inicio categoria</label>
               <input type="date" name="dateCategory" id="dateCategory" value="{{$profesor->dateCategory}}" class="form-control">
            </div>

            <div class="form-group">
               <label for="dateUCA" style="font-weight: bold;">Fecha inicio UCA</label>
               <input type="date" name="dateUCA" id="dateUCA" value="{{$profesor->dateUCA}}" class="form-control">
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