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

         			<h5 class="text-center"> Curso: {{$course->course}} </h5>

         			<h6> Base de Datos </h6>
            		<div class="form-group row">
            			<div class="credT" style="margin-left:15px">
							<label for="credT" >Creditos Teoria</label>
               				<input type="text" name="credT" id="credT" class="form-control" placeholder="1-3 créditos">
               			</div>
               			<div class="credP" style="margin-left:15px">
							<label for="credP">Creditos Prácticas</label>
               				<input type="text" name="credP" id="credP" class="form-control" placeholder="1-3 créditos">
               			</div>
               			<div class="clasS" style="margin-left:15px">
               				<label for="credS">Creditos Seminarios</label>
               				<input type="text" name="credS" id="credS" class="form-control" placeholder="1-3 créditos">
               			</div>
            		</div>

            		<h6> Programación web </h6>
            		<div class="form-group row">
            			<div class="credT" style="margin-left:15px">
							<label for="credT" >Creditos Teoria</label>
               				<input type="text" name="credT" id="credT" class="form-control" placeholder="1-3 créditos">
               			</div>
               			<div class="credP" style="margin-left:15px">
							<label for="credP">Creditos Prácticas</label>
               				<input type="text" name="credP" id="credP" class="form-control" placeholder="1-3 créditos">
               			</div>
               			<div class="clasS" style="margin-left:15px">
               				<label for="credS">Creditos Seminarios</label>
               				<input type="text" name="credS" id="credS" class="form-control" placeholder="1-3 créditos">
               			</div>
            		</div>

            		<div class="form-group text-center">
               			<button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   		enviar
               			</button>
            		</div>

            	 	</form>
            	</div>
            </div>
        </div>
    </div>
</div>
@stop