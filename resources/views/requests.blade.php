@extends('layouts.master')

@section('content')
<div class="row" style="margin-top:40px">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header text-center">
                    <h5> Selección de asignaturas </h5>
                </div>
                <div class="card-body" style="padding:30px">
         			<form method="POST">
         			{{ csrf_field() }}

            		<div class="form-group">
            			<h6> Base de Datos </h6>
               			<label for="credT">Creditos Teoria</label>
               			<input type="text" name="credT" id="credT" class="form-control">
               			<label for="credP">Creditos Prácticas</label>
               			<input type="text" name="credP" id="credP" class="form-control">
               			<label for="credS">Creditos Seminarios</label>
               			<input type="text" name="credS" id="credS" class="form-control">
            		</div>

            	 	</form>
            	</div>
            </div>
        </div>
    </div>
</div>
@stop