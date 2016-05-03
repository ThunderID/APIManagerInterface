@extends('desktop_v2.wireframe_full')

@section('content')
<div class="container">
	<div class="row m-b-1">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link active p-x-2" href="#">APPS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link p-x-2" href="#">ACL</a>
				</li>
			</ul>
		</div>
	</div>
	{!! Form::open(['url' => route('apps.store'), 'class' => 'form']) !!}
		<div class="row m-b-1">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<fieldset class="form-group">
					<label>Name</label>
					{!! Form::text('name', null, ['class' => 'form-control']) !!}
				</fieldset>
				<fieldset class="form-group">
					<label>Key</label>
					{!! Form::text('key', null, ['class' => 'form-control']) !!}
				</fieldset>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<fieldset class="form-group">
					<label>Domain</label>
					{!! Form::text('domain', null, ['class' => 'form-control']) !!}
				</fieldset>
				<fieldset class="form-group">
					<label>Secret</label>
					{!! Form::text('secret', null, ['class' => 'form-control']) !!}
				</fieldset>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				{!! Form::submit('Save', ['class' => 'btn btn-primary btn-md']) !!}
			</div>
		</div>
	{!! Form::close() !!}
</div>

<!-- End of Auth Index -->
@stop