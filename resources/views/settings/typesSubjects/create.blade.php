@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="text-center"> Añadir Tipo Asignatura </h5>
            <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/settings/typesSubjects') }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST">
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="name" style="font-weight: bold;">Nombre</label>
               <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Añadir tipo asignatura
               </button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
@stop