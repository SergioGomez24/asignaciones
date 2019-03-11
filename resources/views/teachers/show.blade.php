@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header text-center">
        <h2 > {{$profesor->name}} </h2>
      </div>
      <div class="card-body">
        <div class="group row">
          <div class="col-md-4">
            <h5 > DNI</h5> {{$profesor->dni}}
          </div>
          <div class="col-md-4">
            <h5 > Correo electrónico</h5> {{$usuario->email}}
          </div>
          <div class="col-md-4">
            <h5 > Rol</h5> {{$usuario->role}}
          </div>
          <div class="col-md-4">
            <p><h5 > Categoría</h5> {{$categoria->name}} </p>
          </div>
          <div class="col-md-4">
            <p><h5 > Area</h5> {{$area->name}} </p>
          </div>
          <div class="col-md-4">
            <p><h5 > Créditos iniciales</h5> {{$profesor->cInitial}} </p>
          </div>
          <div class="col-md-4">
            <h5 > Fecha inicio categoría</h5> {{$profesor->dateCategory}}
          </div>
          <div class="col-md-4">
            <h5 > Fecha inicio UCA</h5> {{$profesor->dateUCA}}
          </div>
        </div>
      </div>
		</div>
	</div>
</div>
@stop