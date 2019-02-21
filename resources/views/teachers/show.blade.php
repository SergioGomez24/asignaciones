@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div id="titlistado">
               <h2 > {{$profesor->name}} </h2>
            </div>
            <div id="btnCabecera">
               <a class="btn btn-primary btn-sm" href="{{ url('/teachers') }}">Volver al listado</a>
            </div>
          </div>
          <div class="card-body">
      		  <p><h5 style="display: inline-block;">DNI:</h5> {{$profesor->dni}} </p>
            <p><h5 style="display: inline-block;">Correo electrónico:</h5> {{$usuario->email}} </p>
            <p><h5 style="display: inline-block;">Rol:</h5> {{$usuario->role}} </p>
      		  <p><h5 style="display: inline-block;">Categoría:</h5> {{$categoria->name}} </p>
      		  <p><h5 style="display: inline-block;">Area:</h5> {{$area->name}} </p>
      		  <p><h5 style="display: inline-block;">Créditos iniciales:</h5> {{$profesor->cInitial}} </p>
      		  <p><h5 style="display: inline-block;">Fecha inicio categoría:</h5> {{$profesor->dateCategory}} </p>
      		  <p><h5 style="display: inline-block;">Fecha inicio UCA:</h5> {{$profesor->dateUCA}} </p>
          </div>
        </div>
		</div>
	</div>
@stop