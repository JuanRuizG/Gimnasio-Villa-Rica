@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Actualizar Datos del Clientes </h2>
            <hr>
            <p class="h4 text-primary">{{$client->name}} - {{$client->identification}}</p>
            <hr>

            @include('errors.error-validation')

            {!!Form::open(['route' => 'clients.renovation.membership.contact.store','method' =>'POST'])!!}
                <div class="form-group">
                    {!!Form::number('price',null,['class' => 'form-control','placeholder'=>'Ingrese el precio'])!!}
                </div>
                <div class="form-group">
                    {!!Form::number('days',null,['class' => 'form-control','placeholder'=>'Ingrese la cantidad de dias', 'min:1'])!!}
                </div>
                <div class="form-group">
                    <input type="hidden" name="client_identification" value="{{$client->identification}}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success">Actualizar Membresia</button>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection

