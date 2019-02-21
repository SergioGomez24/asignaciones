@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div id="titlistado">
               <h2 > {{$asignatura->name}} </h2>
            </div>
            <div id="btnCabecera">
               <a class="btn btn-primary btn-sm" href="{{ url('/subjects') }}">Volver al listado</a>
            </div>
          </div>
          <div class="card-body">
            <div class="col-md-5" style="float: left;">
              <p><h5 style="display: inline-block;"> Código:</h5> {{$asignatura->code}}</p>
      		    <p><h5 style="display: inline-block;"> Titulación:</h5> {{$certification->name}} </p>
      		    <p><h5 style="display: inline-block;"> Area:</h5> {{$area->name}} </p>
      		    <p><h5 style="display: inline-block;"> Campus:</h5> {{$campus->name}} </p>
      		    <p><h5 style="display: inline-block;"> Centro:</h5> {{$center->name}} </p>
              <p><h5 style="display: inline-block;"> Duración:</h5> {{$duration->name}} </p>
              <p><h5 style="display: inline-block;"> Curso en la que se imparte:</h5> {{$imparted->name}} </p>
              <p><h5 style="display: inline-block;"> Tipo de asignatura:</h5> {{$typeSubject->name}} </p>
              <p><h5 style="display: inline-block;"> Coordinador:</h5> {{$asignatura->coordinator}} </p>
            </div>
            <div class="col-md-5" style="float: right;">
              <p><h5 style="display: inline-block;"> Créditos teoria:</h5> {{$asignatura->cTheory}} </p>
              <p><h5 style="display: inline-block;"> Créditos seminario:</h5> {{$asignatura->cSeminar}} </p>
              <p><h5 style="display: inline-block;"> Créditos prácticas:</h5> {{$asignatura->cPractice}} </p>
            </div>
          </div>
        </div>
		</div>
	</div>
@stop