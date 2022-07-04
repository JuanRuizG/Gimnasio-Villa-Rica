@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1> Editar Cliente</h1>
			{!!Form::model($client,['route' => ['clients.update',$client],'method' => 'PUT'])!!}
				@include('clients.partials.form',['btnText'=>'Actualizar'])
			{!!Form::close()!!}
		</div>
	</div>
</div>
@stop