@extends('layouts.master')
@section('content')
<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ajustes</li>
  </ol>
</nav>
</div>

<div class="row" style="margin-top:40px">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
            			<h4 class="text-center"> Ajustes </h4>
            		</div>
            		<div class="card-body">
            		<h5><a href="{{ url('/settings/elections') }}" style="color: #000000;">Elecciones</a></h5>
					<h5><a href="{{ url('/settings/categories') }}" style="color: #000000;">Categorias</a></h5>
					<h5><a href="{{ url('/settings/areas') }}" style="color: #000000;">Areas</a></h5>
					<h5><a href="{{ url('/settings/certifications') }}" style="color: #000000;">Titulaciones</a></h5>
					<h5><a href="{{ url('/settings/campus') }}" style="color: #000000;">Campus</a></h5>
					<h5><a href="{{ url('/settings/centers') }}" style="color: #000000;">Centros</a></h5>
					<h5><a href="{{ url('/settings/courses') }}" style="color: #000000;">Cursos</a></h5>
					<h5><a href="{{ url('/settings/duration') }}" style="color: #000000;">Duración asignatura</a></h5>
					<h5><a href="{{ url('/settings/coursesSubjects') }}" style="color: #000000;">Curso asignatura</a></h5>
					<h5><a href="{{ url('/settings/typesSubjects') }}" style="color: #000000;">Tipo asignatura</a></h5>
		  			</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
