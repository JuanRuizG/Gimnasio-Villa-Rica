@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Renovacion Clientes</h2>
            {!!Form::open(['route' => 'clients.renovation.membership.contact','method' => 'GET'])!!}
                <div class="form-group">
                    {!!Form::number('identification',null, ['class' => 'form-control','placeholder'=>'Ingrese la identificacion'])!!}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success">
                        Buscar
                    </button>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection

