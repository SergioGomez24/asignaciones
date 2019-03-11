@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header text-center">
        <h2 > {{$asignatura->name}} </h2>
      </div>
      <div class="card-body">
        <div class="group row">
          <div class="col-md-4">
            <h5 > Código</h5> {{$asignatura->code}}
          </div>
          <div class="col-md-4">
      		  <h5 > Titulación</h5> {{$certification->name}}
          </div>
          <div class="col-md-4">
      		  <h5 > Area</h5> {{$area->name}} 
          </div>
          <div class="col-md-4">
      		  <p><h5 > Campus</h5> {{$campus->name}} </p>
          </div>
          <div class="col-md-4" >
      		  <p><h5 > Centro</h5> {{$center->name}} </p>
          </div>
          <div class="col-md-4">
            <p><h5> Duración</h5> {{$duration->name}} </p>
          </div>
          <div class="col-md-4">
            <h5> Curso en la que se imparte</h5> {{$imparted->name}} 
          </div>
          <div class="col-md-4" >
            <h5 > Tipo de asignatura</h5> {{$typeSubject->name}} 
          </div>
          <div class="col-md-4">
            <h5> Coordinador</h5> {{$asignatura->coordinator}} 
          </div>
            
          <div class="col-md-4">
            <p><h5> Créditos teoria</h5> {{$asignatura->cTheory}} </p>
          </div>
          <div class="col-md-4">
            <p><h5> Créditos seminario</h5> {{$asignatura->cSeminar}} </p>
          </div>
          <div class="col-md-4">
            <p><h5> Créditos prácticas</h5> {{$asignatura->cPractice}} </p>
          </div>
        </div>
      </div>
    </div>
	</div>
</div>
@stop