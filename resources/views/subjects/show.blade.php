@extends('layouts.master')
@section('content')
	<div class="row">
		<div class="col-sm-12">
			<h2> {{$asignatura->name}} </h2>
      		<h4> Código: {{$asignatura->code}} </h4>
      		<h4> Titulación: {{$asignatura->certification}} </h4>
      		<h4> Area: {{$asignatura->area}} </h4>
      		<h4> Campus: {{$asignatura->campus}} </h4>
      		<h4> Centro: {{$asignatura->center}} </h4>
      		<h4> Créditos teoria: {{$asignatura->cTheory}} </h4>
      		<h4> Créditos seminario: {{$asignatura->cSeminar}} </h4>
      		<h4> Créditos prácticas: {{$asignatura->cPractice}} </h4>
      		<h4> Duración: {{$asignatura->duration}} </h4>
      		<h4> Curso en la que se imparte: {{$asignatura->imparted}} </h4>
      		<h4> Tipo de asignatura: {{$asignatura->typeSubject}} </h4>

      		<a class="btn btn-warning" href="{{ url('/subject/edit/'.$asignatura->id) }}" role="button">
        	Editar asignatura
      		</a>
      		
      		<a class="btn btn-default" href="{{ url('/subject') }}" role="button">
        	Volver al listado
      		</a>
		</div>
	</div>
@stop