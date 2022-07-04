<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Factura</title>
	<link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body>
	<div class="container">
		<div class="row justify-content-center mb-4">
			<div class="col-12 text-center">
				<img src="{{ asset('img/Logo.jpg') }}" alt="Logo" class="img-responsive" height="75px">
				<h2> <b> C.A.F Salud y Belleza </b> </h2>
				<p>NIT: 900817131</p>
				<p>Telefono: 3108246911</p>
				<p>Direccion Calle 3 # 9-57</p>
				<p>Correo: cafsaludybelleza@gmail.com</p>
			</div>
		</div>

		<hr>
		<div class="row justify-content-between mb-4">
			<div class="col-6">
				<b>Nombre </b> <br>
				<b> Fecha de transaccion </b> <br>
				<b> Vendedor </b> <br>
				<b> Metodo de Pago </b> <br>
				<b> Estado </b> <br>
				<b> Numero de Transaccion </b> <br>
			</div>
			<div class="col-6 float-right">
				{{$client->name}} <br>
				{{\Carbon\Carbon::now()->toDateString()}} <br>
				C.A.F Salud y Belleza <br>
				Efectivo <br>
				Pagado <br>
				Generando
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				{{-- Tabla de Productos --}}
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Productos</td>
							<td>Cant.</td>
							<td>Precio U.</td>
							<td>Valor</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{$client->typemonthlies->name }}</td>
							<td>1</td>
							<td>{{$client->typemonthlies->value}}</td>
							<td>{{$client->typemonthlies->value}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<hr>

		<div class="row justify-content-between">
			<div class="col-4">
				<h2>Total</h2>
			</div>
			<div class="col-4 float-right">
				<h2> $ {{$client->typemonthlies->value }}</h2>
			</div>
		</div>
	</div>
</body>
</html>