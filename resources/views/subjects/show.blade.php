@extends('layouts.master')
@section('content')
	<div class="row">
		<div class="col-sm-12">
			<h2> {{$asignatura->name}} </h2>
      		<h5> Código: {{$asignatura->code}} </h5>
      		<h5> Titulación: {{$asignatura->certification}} </h5>
      		<h5> Area: {{$asignatura->area}} </h5>
      		<h5> Campus: {{$asignatura->campus}} </h5>
      		<h5> Centro: {{$asignatura->center}} </h5>
      		<h5> Créditos teoria: {{$asignatura->cTheory}} </h5>
      		<h5> Créditos seminario: {{$asignatura->cSeminar}} </h5>
      		<h5> Créditos prácticas: {{$asignatura->cPractice}} </h5>
      		<h5> Duración: {{$asignatura->duration}} </h5>
      		<h5> Curso en la que se imparte: {{$asignatura->imparted}} </h5>
      		<h5> Tipo de asignatura: {{$asignatura->typeSubject}} </h5>

      		<a class="btn btn-warning" href="{{ url('/subjects/edit/'.$asignatura->id) }}" role="button">
        	Editar asignatura
      		</a>
      		
      		<a class="btn btn-default" href="{{ url('/subjects') }}" role="button">
        	Volver al listado
      		</a>
		</div>
	</div>
@stop