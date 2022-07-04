<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Identificacion</th>
        <th>Tipo Identificacion</th>
        <th>Telefono</th>
        <th>Llave </th>
        <th>Tipo Mensualidad</th>
        <th>Fecha Inicial</th>
        <th>Fecha de Expiracion</th>
        <th>Dias Restantes</th>
    </thead>
    <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{$client->name}}</td>
                <td>{{$client->identification}}</td>
                <td>{{$client->type_identification}}</td>
                <td>{{$client->phone}}</td>
                <td>{{$client->key_identification}}</td>
                <td>{{$client->typemonthlies->name}}</td>
                <td>{{$client->initial_date}}</td>
                <td>{{$client->expiration_date}}</td>
                <td>{{$client->getDaysRemaining()}}</td>
            </tr>
        @endforeach
    </tbody>
</table>