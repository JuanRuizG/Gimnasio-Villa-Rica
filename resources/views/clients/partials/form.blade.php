<div class="form-grouo">
	{!!Form::label('name','Nombre Cliente')!!}
	{!!Form::text('name',null,['class' => 'form-control','autofocus','required'])!!}
</div>
<div class="form-group">
	{!!Form::label('type_identification','Tipo Identificacion')!!}
	{!!Form::select('type_identification',config('enum.identifications'),null,['class' => 'form-control'])!!}
</div>
<div class="form-group">
	{!!Form::label('identification','# Identificacion')!!}
	{!!Form::text('identification',null,['class' => 'form-control'])!!}
</div>
<div class="form-grouo">
	{!!Form::label('email','Correo Electronico')!!}
	{!!Form::email('email',null,['class' => 'form-control'])!!}
</div>
<div class="form-group">
	{!!Form::label('phone','# Numero Telefonico')!!}
	{!!Form::number('phone',null,['class' => 'form-control'])!!}
</div>
<div class="form-group">
	{!!Form::label('initial_date','Fecha Inicial')!!}
	{!!Form::date('initial_date',null,['class '=> 'form-control'])!!}
</div>
{{-- <div class="form-group">
	{!!Form::label('type_monthly_pay','Seleccione tipo de Mensualidad')!!}
	{!!Form::select('type_monthly_pay',config('enum.type_monthly'),null,['class' => 'form-control'])!!}
</div> --}}
<div class="form-group">
	{!!Form::label('type_monthlies_id','Seleccione tipo de Mensualidad')!!}
	{!!Form::select('type_monthlies_id',$type_monthly,null,['class' => 'form-control'])!!}
</div>
<div class="form-group">
	{!!Form::submit($btnText,['class' => 'btn btn-outline-success btn-block'])!!}
</div>