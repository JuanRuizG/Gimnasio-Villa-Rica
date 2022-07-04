@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>Listado de Clientes</h2>
            <a href="{{ route('clients.create')}}" class="btn btn-outline-dark float-right">Crear</a>
            <a href="{{ route('clients.download')}}" class="btn btn-outline-success">Descargar Excel</a>
        </div>

        <div class="col-md-12">
            {!!Form::open(['route'=>'clients.index', 'method'=>'GET', 'class' => 'form-inline mt-4 float-right'])!!}
                <div class="form-group">
                    {!!Form::number('identification',null,['class'=>'form-control mr-3','placeholder'=>'Ingrese # Documento'])!!}
                </div>
                <div class="form-group">
                    {!!Form::number('key_identification',null,['class'=>'form-control mr-3','placeholder'=>'Ingrese # de llave'])!!}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success">Buscar</button>
                </div>
            {!!Form::close()!!}
        </div>

        <div class="col-md-12">
            <table class="table table-hover table-striped" id="example">
                <thead>
                    <th>Nombre</th>
                    <th>Identificacion</th>
                    <th>Tipo Identificacion</th>
                    <th>Telefono</th>
                    <th>Llave </th>
                    <th>Tipo Mensualidad</th>
                    <th>Fecha Inicial</th>
                    <th>Fecha de Expiracion</th>
                    <th>Dias Restantes</th>
                    <th colspan="3">Acciones</th>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{$client->name}}</td>
                            <td>{{$client->identification}}</td>
                            <td>{{$client->type_identification}}</td>
                            <td>{{$client->phone}}</td>
                            <td>{{$client->key_identification}}</td>
                            {{-- <td>{{$client->type_monthly_pay}}</td> --}}
                            <td>{{$client->typemonthlies ? $client->typemonthlies->name : '' }}</td>
                            <td>{{$client->initial_date}}</td>
                            <td>{{$client->expiration_date}}</td>
                            <td>{{$client->getDaysRemaining()}}</td>
                            <td>
                                <a href="{{ route('clients.show',$client)}}" class="btn btn-outline-info">Ver</a>
                            </td>
                            <td>
                                <a href="{{ route('clients.edit',$client)}}" class="btn btn-outline-dark">Editar</a>
                            </td>
                            <td>
                                {!!Form::open(['route' =>['clients.destroy',$client],'method' => 'DELETE' ])!!}
                                    <button class="btn btn-outline-danger">Eliminar</button>
                                {!!Form::close()!!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!!$clients->appends(Request::only(['identification','key_identification']))->render()!!}
        </div>
    </div>
</div>
@endsection

