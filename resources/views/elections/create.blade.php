@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="text-center"> Añadir elección </h5>
            <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/') }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST">
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="course" style="font-weight: bold;">Curso</label>
               <input type="text" name="course" id="course" class="form-control" required>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Añadir elección
               </button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
@stop