@extends('layouts.master')

@section('content')
<div class="row" style="margin-top:40px">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h5> Elecciones de asigaturas para los profesores de la UCA </h5>
                </div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{url('/applications/create')}}" role="button" class="btn btn-primary" aria-pressed="true">Iniciar solicitud</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
