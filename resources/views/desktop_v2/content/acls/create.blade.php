@extends('desktop_v2.wireframe_full')

@section('content')

<?php
	//id
	$page_datas->datas['id'];
	//grant id 
	$page_datas->datas['acl']['grant_id'];
	//grant name
	$page_datas->datas['acl']['grant_name'];
	//user id
	$page_datas->datas['acl']['user_id'];
	//client id
	$page_datas->datas['acl']['client_id'];
	//scopes
	$page_datas->datas['acl']['scopes'];
?>

<div class="container">
	<div class="row m-b-1">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link active p-x-2" href="{{ route('acls.index', ['id' => $page_datas->datas['id']]) }}">APPS</a>
				</li>
			</ul>
		</div>
	</div>
	{!! Form::open(['url' => route('acls.store', ['id' => $page_datas->datas['id']]), 'class' => 'form']) !!}
		<div class="row m-b-1">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<fieldset class="form-group">
					<label>Grant Name</label>
					{!! Form::text('grant_name', null, ['class' => 'form-control']) !!}
				</fieldset>				
				<fieldset class="form-group">
					<label>Client Name</label>
					{!! Form::select('client_id', [$page_datas->datas['client']['id'] => $page_datas->datas['client']['name']], $page_datas->datas['client']['id'], ['class' => 'form-control c-select']) !!}
				</fieldset>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<fieldset class="form-group">
					<label>User ID</label>
					{!! Form::text('user_id', null, ['class' => 'form-control']) !!}
				</fieldset>
				<fieldset class="form-group">
					<label>Scope</label>
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