@extends('layouts.master')
@section('content')
	<div class="row" style="margin-top:40px">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h2> {{$categoria->name}} </h2>
          </div>
          <div class="card-body">
            <div class="col-md-5" style="float: left;">
              <h5> Rango: {{$categoria->rank}}</h5>
            </div>
          </div>
        </div>
	  </div>
	</div>
@stop