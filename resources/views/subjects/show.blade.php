@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h2> {{$asignatura->name}} </h2>
          </div>
          <div class="card-body">
            <div class="col-md-5" style="float: left;">
              <h5> Código: {{$asignatura->code}}</h5>
      		    <h5> Titulación: {{$asignatura->certification}} </h5>
      		    <h5> Area: {{$asignatura->area}} </h5>
      		    <h5> Campus: {{$asignatura->campus}} </h5>
      		    <h5> Centro: {{$asignatura->center}} </h5>
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