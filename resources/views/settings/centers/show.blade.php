@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h2> {{$centro->name}} </h2>
          </div>
          <div class="card-body">
            <div class="col-md-5" style="float: left;">
              
            </div>
          </div>
          <div>
            <a class="btn btn-link btn-sm" href="{{ url('/settings/centers') }}" style="float: right;">Volver al listado</a>
          </div>
        </div>
	  </div>
	</div>
@stop