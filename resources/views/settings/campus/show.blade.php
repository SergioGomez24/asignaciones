@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div style="float: left; margin-left: 350px;">
               <h2> {{$campus->name}} </h2>
            </div>
            <div id="btnCabecera">
               <a class="btn btn-primary btn-sm" href="{{ url('/settings/campus') }}">Volver al listado</a>
            </div>
          </div>
          <div class="card-body">
            <div class="col-md-5" style="float: left;">
              
            </div>
          </div>
        </div>
	  </div>
	</div>
@stop