@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/settings') }}">Ajustes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/settings/elections') }}">Elecciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar Elección</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
	<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="text-center"> Editar Elección </h5>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST">
         		{{ method_field('PUT') }}
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="course" style="font-weight: bold;">Curso</label>
               <input type="text" name="course" id="course" value="{{$course}}" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="threshold" style="font-weight: bold;">Umbral</label>
               <input type="number" name="threshold" id="threshold" value="{{$threshold}}" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="state" style="font-weight: bold;">Estado</label>
               <select name="state" id="state" class="form-control" required>
                  @if($state == 0)
                  <option value="{{$state}}">Cerrada</option>
                  @else
                  <option value="{{$state}}">Abierta</option>
                  @endif
                  <option value="1">Abierta</option>
                  <option value="0">Cerrada</option>
               </select>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" id="btnAceptar">
                  Editar
               </button>
               <a class="btn btn-secondary" href="{{ url('/settings/elections') }}" role="button" id="btnCancelar">Cancelar</a>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
@stop