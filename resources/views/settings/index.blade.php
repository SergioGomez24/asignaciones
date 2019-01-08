@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header text-center">
            			<h5 > Ajustes </h5>
            		</div>
            		<div class="card-body text-center">
					<h5><a href="{{ url('/settings/categories') }}" style="color: #000000;">Categorias</a></h5>
					<h5><a href="{{ url('/settings/areas') }}" style="color: #000000;">Areas</a></h5>
					<h5><a href="{{ url('/settings/certifications') }}" style="color: #000000;">Titulaciones</a></h5>
					<h5><a href="{{ url('/settings/campus') }}" style="color: #000000;">Campus</a></h5>
					<h5><a href="{{ url('/settings/centers') }}" style="color: #000000;">Centros</a></h5>
		  			</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
