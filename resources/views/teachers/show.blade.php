@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h2> {{$profesor->name}} </h2>
          </div>
          <div class="card-body">
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

      		  <a class="btn btn-warning" href="{{ url('/teachers/edit/'.$profesor->id) }}" role="button" style="margin-right: 15px">
        	   Editar profesor
      		  </a>
      		
      		  <a class="btn btn-default" href="{{ url('/teachers') }}" role="button" style="margin-right: 15px">
        	   Volver al listado
      		  </a>

      		  <form action="{{action('TeachersController@deleteTeacher', $profesor->id)}}" method="POST" style="display:inline">
        		  {{ method_field('DELETE') }}
        		  {{ csrf_field() }}
        		  <button type="submit" class="btn btn-default" style="display:inline">
          			 Eliminar profesor
        		  </button>
      		  </form>
          </div>
        </div>
		</div>
	</div>
@stop