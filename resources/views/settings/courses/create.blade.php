@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="text-center"> Añadir curso </h5>
            <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/settings/courses') }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
         </div>
         <div class="card-body" style="padding:30px">
         	<form method="POST" onsubmit="return validacion()">
         		{{ csrf_field() }}

            <div class="form-group">
               <label for="name" style="font-weight: bold;">Nombre</label>
               <input type="text" name="name" id="name" class="form-control" placeholder="formato: yyyy-yy" required pattern="[0-9]{4}-[0-9]{2}">
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary">
                  Añadir
               </button>
               <a class="btn btn-secondary" href="{{ url('/settings/courses') }}" role="button">Cancelar</a>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">

   var course = document.getElementById("name").value;
   var existe;

   $('#name').on('change', function(e) {
      course = e.target.value;

      $.ajax({
         url: "{{url('json-course')}}",
         type:"GET", 
         data: {"name":course}, 
         success: function(result){
            existe = result.length;
         }
      });
   });

   function validacion(){
      if(existe > "0") {
         alert("El curso ya existe");
         return false;
      } else {
         return true;
      }
   }
</script>
@stop



