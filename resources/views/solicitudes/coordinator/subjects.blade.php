@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-2 col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Asignaturas Coordinador </h4>
        <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/') }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
      </div>
      <div class="card-body">
      @foreach( $arrayAsignaturasCoor as $key => $a )
      <h5><a href="{{ url('/coordinators/index/'.$course + $a->id) }}" style="color: #000000;"> {{$a->name}}</a></h5>
        </br>
      @endforeach
      </div>
    </div>
  </div>
</div>
@stop