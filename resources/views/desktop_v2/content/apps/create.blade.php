@extends('desktop_v2.wireframe_full')

@section('content')

<div class="container">
	<div class="row m-b-1">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link active p-x-2" href="#">APPS</a>
				</li>
			</ul>
		</div>
	</div>
	{!! Form::open(['url' => route('apps.store'), 'class' => 'form']) !!}
		<div class="row m-b-1">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<fieldset class="form-group">
					<label>Name</label>
					{!! Form::text('name', $page_datas->datas['name'], ['class' => 'form-control']) !!}
				</fieldset>
				<fieldset class="form-group">
					<label>Key</label>
					<div class="input-group">
						{!! Form::text('key', $page_datas->datas['key'], ['class' => 'form-control']) !!} &nbsp;&nbsp;
						<a href="#" class="btn btn-secondary btn-md white-hover-text">Generate</a>
					</div>
				</fieldset>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<fieldset class="form-group">
					<label>Domain</label>
					{!! Form::text('domain', $page_datas->datas['domain'], ['class' => 'form-control']) !!}
				</fieldset>
				<fieldset class="form-group">
					<label>Secret</label>
					<div class="input-group">
						{!! Form::text('secret', $page_datas->datas['secret'], ['class' => 'form-control']) !!} &nbsp;&nbsp;
						<a href="#" class="btn btn-secondary btn-md white-hover-text">Generate</a>
					</div>
				</fieldset>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<fieldset class="form-group">
					<label>Grant Type</label>
					{!! Form::select('grant', ['client_credential' => 'Client Credential', 'password' => 'Password'], $page_datas->datas['grant']['name'], ['class' => 'c-select form-control']) !!}
				</fieldset>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<fieldset class="form-group">
					<label>Scopes</label>
					{!! Form::select('scopes', [], null, ['class' => 'form-control select-scope', 'multiple' => 'multiple']) !!}
				</fieldset>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-xs-right pt-xl">
				<a href="{{ route('apps.index') }}" class="btn btn-secondary btn-md white-hover-text">Cancel</a> &nbsp;
				{!! Form::submit('Save', ['class' => 'btn btn-primary btn-md']) !!}
			</div>
		</div>
	{!! Form::close() !!}
</div>

<!-- End of Auth Index -->
@stop

@push('js')
	@include('plugins.select2')
@endpush