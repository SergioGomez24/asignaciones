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
              <h5> Código: {{$asignatura->code}}</h5>
      		    <h5> Titulación: {{$certification->name}} </h5>
      		    <h5> Area: {{$area->name}} </h5>
      		    <h5> Campus: {{$campus->name}} </h5>
      		    <h5> Centro: {{$center->name}} </h5>
              <h5> Duración: {{$asignatura->duration}} </h5>
              <h5> Curso en la que se imparte: {{$asignatura->imparted}} </h5>
              <h5> Tipo de asignatura: {{$asignatura->typeSubject}} </h5>
              <h5> Coordinador: {{$asignatura->coordinator}} </h5>
            </div>
            <div class="col-md-5" style="float: right;">
              <h5> Créditos teoria: {{$asignatura->cTheory}} </h5>
              <p><h5> Créditos seminario: {{$asignatura->cSeminar}} </h5></p>
              <p><h5> Créditos prácticas: {{$asignatura->cPractice}} </h5></p>
            </div>
          </div>
        </div>
		</div>
	</div>
@stop