@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header text-center">
            			<h5 > Ajustes </h5>
            		</div>
            		<div class="card-body text-center">
					<h5><a href="{{ url('/settings/categories') }}" style="color: #000000;">Categorias</a></h5>
		  			</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
