@extends('layouts.master')

@section('content')
<div class="row" style="margin-top:40px">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h5> Selección de asignaturas </h5>
          </div>
          <div class="card-body" style="padding:30px">
            <form method="POST">
              {{ csrf_field() }}

         			<h5 class="text-center"> Profesor: {{ auth()->user()->name }} </h5>
              <h6 class="text-center"> Curso: {{$course->course}} </h6>

         			@foreach( $arrayAsignaturas as $asignatura )
                <h5> {{$asignatura->name}} </h5>
                  <div class="form-group row">
                    <div class="col-md-2">
                      <h6>Titulación</h6>
                      <p>{{$asignatura->certification}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Area</h6>
                      <p>{{$asignatura->area}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Campus</h6>
                      <p>{{$asignatura->campus}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Centro</h6>
                      <p>{{$asignatura->center}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Curso</h6>
                      <p>{{$asignatura->imparted}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Duración</h6>
                      <p>{{$asignatura->duration}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Tipo de asignatura</h6>
                      <p>{{$asignatura->typeSubject}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6>Coordinador</h6>
                      <p>{{$asignatura->coordinator}}</p>
                    </div>
                    <div class="col-md-2">
                      <h6><label for="credT" >Creditos Teoria</label></h6>
                      <input type="number" name="credT[]" id="credT" class="form-control" placeholder="1-3 créditos">
                    </div>
                    <div class="col-md-2">
                      <h6><label for="credP">Creditos Prácticas</label></h6>
                      <input type="number" name="credP[]" id="credP" class="form-control" placeholder="1-3 créditos">
                    </div>
                    <div class="col-md-2">
                      <h6><label for="credS">Creditos Seminarios</label></h6>
                      <input type="number" name="credS[]" id="credS" class="form-control" placeholder="1-3 créditos">
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary" style="margin-top:35px;">elegir
                      </button>
                    </div>
                  </div>
              @endforeach
              <div class="form-group text-center">
               	<button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                  enviar
               	</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop