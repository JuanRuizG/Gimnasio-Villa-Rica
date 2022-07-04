@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
                <div class="card-header">Cliente {{$client->name}}</div>

                <div class="card-body">
                	<div class="alert alert-info">
                		<ul>
                			<li> telefono : {{$client->phone}} </li>
                			<li> Tipo mensualidad : {{$client->typemonthlies ? $client->typemonthlies->name : 'No definido'}} </li>
                			<li> Fecha Inicial : {{$client->initial_date}}</li>
                			<li>Fecha fin {{$client->expiration_date}}</li>
                			<li>Dias restante {{$client->getDaysRemaining()}}</li>
                		</ul>
                	</div>
                </div>
            </div>
		</div>
	</div>
</div>
@stop