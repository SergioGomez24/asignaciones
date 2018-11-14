@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h2> {{$profesor->name}} </h2>
          </div>
          <div class="card-body">
      		  <h5> DNI: {{$profesor->dni}} </h5>
      		  <h5> Categoría: {{$profesor->category}} </h5>
      		  <h5> Area: {{$profesor->area}} </h5>
      		  <h5> Créditos iniciales: {{$profesor->cInitial}} </h5>
      		  <h5> Fecha inicio categoría: {{$profesor->dateCategory}} </h5>
      		  <h5> Fecha inicio UCA: {{$profesor->dateUCA}} </h5>
          </div>
        </div>
		</div>
	</div>
@stop