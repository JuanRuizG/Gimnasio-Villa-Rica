@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1> Crear Cliente</h1>

			@include('errors.error-validation')

			@if(session('info'))
 				<div class="alert alert-info">
 					<p>{{session('info')}}</p>
				</div>
			@endif

			{!!Form::open(['route' => ['clients.store'],'method'=>'POST'])!!}
				@include('clients.partials.form',['btnText'=>'Guardar'])
			{!!Form::close()!!}
		</div>
	</div>
</div>
@stop